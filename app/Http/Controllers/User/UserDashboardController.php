<?php
	
	namespace App\Http\Controllers\User;
	use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;
	use App\Models\Product;
	use App\Models\Wishlist;
	use App\Models\Transactions;
	use App\Models\Orders;
	use App\Models\Message;
	use App\Models\Notification;
	use App\Models\SellerBankDetail;
	use App\Models\User;
	use App\Models\SettingLog;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Hash;
	
	
	class UserDashboardController extends Controller
	{
		public function __construct()
		{
			// Require user to be authenticated
			//   $this->middleware('auth');
		}
		
		public function index()
		{
			$user = Auth::user();
			
			$products = Product::where('user_id', $user->id)->get();
			
			$wishlistItems = Wishlist::where('user_id', $user->id)->get();
			
			$buyerProductIds = Message::where('buyer_id', $user->id)
			->distinct()
			->pluck('product_id');
			
			$buyerProducts = Product::whereIn('id', $buyerProductIds)->get();
			
			$sellerProductsWithBuyers = Product::where('user_id', $user->id)
			->with(['messages.user' => function ($q) {
				$q->select('id', 'name', 'email');
			}])
			->get();
			
			$allProducts = $buyerProducts->merge($sellerProductsWithBuyers);
			
			$buyerOrderCount = Orders::where('user_id', $user->id)->count();
			
			$sellerOrderCount = Orders::where('seller_id', $user->id)
			->whereIn('c_status', ['completed', 'pending_seller_payment'])
			->count();
			
			$sellingChartDataRaw = Orders::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
			->where('seller_id', $user->id)
			->whereIn('status', ['completed', 'processing'])
			->groupBy('month')
			->pluck('total', 'month')
			->toArray();
			
			$sellingChartDataRaw = array_map('intval', $sellingChartDataRaw);
			$sellingChartDataRaw = array_combine(
			array_map('strval', array_keys($sellingChartDataRaw)),
			array_values($sellingChartDataRaw)
			);
			
			$notifications = Notification::where('userid', auth()->id())
			->orderBy('id', 'desc')
			->take(10)
			->get();
			
			$latestPendingOffers = Message::where('seller_id', $user->id)
			->where('is_offer', 1)
			->where('offer_status', 'pending')
			->where('user_type', 'buyer')
			->latest()
			->take(5)
			->get();
			
			$latestSellerOrders = Orders::with([
			'user',
			'latestTransaction' => function ($q) {
				$q->where('user_type', 'buyer')
                ->where('type', 'product_payment')
                ->orderBy('id', 'desc');
			}
			])
			->where('seller_id', Auth::id())
			->where('status', '!=', 'completed')
			->where('c_status', '!=', 'pending_buyer_approval')
			->orderBy('id', 'desc')
			->take(5)
			->get();
			
			$hasProducts = $products->count() > 0;
			
			return view('user.dashboard.index', compact(
			'user',
			'products',                 
			'wishlistItems',
			'buyerProducts',            
			'sellerProductsWithBuyers',
			'allProducts',           
			'buyerOrderCount',
			'sellerOrderCount',
			'hasProducts',
			'sellingChartDataRaw',
			'notifications',
			'latestPendingOffers',
			'latestSellerOrders'
			));
		}
		
		public function myProfile()
		{
			$user = Auth::user();
			
			$bankDetails = SellerBankDetail::where('user_id', $user->id)->first();
			
			$logs = [];
			if ($bankDetails) {
				$logs = \App\Models\SettingLog::where('table_id', $bankDetails->id)
				->orderByDesc('created_at')
				->get();
			}
			
			return view('user.dashboard.myProfile', compact('user', 'bankDetails', 'logs'));
		}
		
		public function updateProfile(Request $request)
		{
			$user = Auth::user();
			
			$validated = $request->validate([
            'name' => 'required|string|min:3|max:30',
            'company-name' => 'nullable|string|max:255',
            'phone-number' => 'required|numeric|digits_between:10,13',
            'email' => 'required|email:rfc,dns|min:5|max:50|unique:users,email,' . $user->id,
            'address' => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'gst-number' => 'nullable|string|max:20',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'new-password' => 'nullable|string|min:6|confirmed',
			]);
			
			/*	$user->name = $validated['name'];
				$user->company_name = $request->input('company-name');
				$user->phone = $request->input('phone-number');
				$user->email = $validated['email'];
				$user->address = $request->input('address');
				$user->pin_code = $request->input('pincode');
				$user->state = $request->input('state');
				$user->gst_number = $request->input('gst-number');
				
				if ($request->hasFile('profile_photo')) {
				$image = $request->file('profile_photo');
				$filename = time() . '_' . $image->getClientOriginalName();
				$destinationPath = public_path('profile-photos');
				
				// Create directory if it doesn't exist
				if (!file_exists($destinationPath)) {
				mkdir($destinationPath, 0755, true);
				}
				
				$image->move($destinationPath, $filename);
				$user->profile = 'profile-photos/' . $filename;
				}
			*/
			// Update password if new password is provided & confirmed
			
		    if (!$request->filled('new-password')) {
                return redirect()->back()->withErrors([
				'new-password' => 'Please provide a new password.',
                ]);
			}
            $user->password = Hash::make($request->input('new-password'));
            $user->save();
			
			return redirect()->back()->with('success', 'Password updated successfully.');
		}
		
		
		public function saveBankDetails(Request $request)
		{
			$user = Auth::user();
			
			$validated = $request->validate([
			'bank_name' => 'required|string|max:255',
			'account_name' => 'required|string|max:255',
			'account_number' => 'required|string|max:50',
			'ifsc_code' => 'required|string|max:50',
			'qr_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
			]);
			
			$bankDetails = SellerBankDetail::where('user_id', $user->id)->first();
			$original = $bankDetails ? $bankDetails->toArray() : [];
			
			$data = [
			'bank_name' => $validated['bank_name'],
			'account_name' => $validated['account_name'],
			'account_number' => $validated['account_number'],
			'ifsc_code' => $validated['ifsc_code'],
			];
			
			$logContent = [];
			
			foreach ($data as $key => $value) {
				$old = $original[$key] ?? null;
				if ($old != $value) {
					$logContent[$key] = [
					'old' => $old,
					'new' => $value,
					];
				}
			}
			
			if ($request->hasFile('qr_image')) {
				$file = $request->file('qr_image');
				$fileName = time() . '_' . $file->getClientOriginalName();
				$destinationPath = public_path('qr-images');
				
				if (!file_exists($destinationPath)) {
					mkdir($destinationPath, 0755, true);
				}
				
				$file->move($destinationPath, $fileName);
				$data['qr_image'] = 'qr-images/' . $fileName;
				
				if (!$bankDetails || $bankDetails->qr_image != $data['qr_image']) {
					$logContent['qr_image'] = [
					'old' => $bankDetails->qr_image ?? '',
					'new' => 'Image updated',
					];
				}
			}
			
			$bankDetails = SellerBankDetail::updateOrCreate(
			['user_id' => $user->id],
			$data
			);
			
			if (!empty($logContent)) {
				\App\Models\SettingLog::create([
				'userId'   => $user->id,
				'table_id' => $bankDetails->id,
				'ip'       => $request->ip(),
				'log_type' => 'Seller Bank Details',
				'content'  => json_encode($logContent),
				]);
			}
			
			return redirect()->back()->with('success', 'Bank details saved successfully.');
		}
		
		
		
		
	}