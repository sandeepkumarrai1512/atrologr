<?php
	
	namespace App\Http\Controllers\Admin;
	use Illuminate\Support\Facades\Hash;
	use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;
	use App\Models\User;
	use Illuminate\Support\Facades\DB;
	
	class UserController extends Controller
	{
		public function index(Request $request)
		{
			$query = User::query();
			
			if ($request->filled('name')) {
				$query->where('name', 'like', '%' . $request->name . '%');
			}
			
			if ($request->filled('status')) {
				$query->where('status', $request->status);
			}
			
			if ($request->filled('date')) {
				$query->whereDate('created_at', $request->date);
			}
			
			$users = $query->orderBy('created_at', 'desc')->paginate(10); 
			
			
			return view('admin.users.index', compact('users'));
		}
		
		
		public function create()
		{
			return view('admin.users.create');
		}
		
		public function store(Request $request)
        {
            try {
                $validated = $request->validate([
                    'name' => 'required|string|min:3|max:30',
                    'phone' => 'required|numeric|digits_between:10,13',
                    'company_name' => 'nullable|string|max:255',
                    'gst_number'   => 'nullable|string|max:50',
                    'address'      => 'nullable|string|max:255',
                    'state'        => 'nullable|string|max:100',
                    'pin_code'     => 'nullable|string|max:10',
                    'email' => 'required|email:rfc,dns|min:5|max:50|unique:users,email',
                    'password' => 'required|min:6|max:20',
                ]);
        
                $validated['status'] = 'deactive';
                $validated['password'] = Hash::make($validated['password']);
        
                $user = User::create($validated);
        
                DB::table('notification')->insert([
                    'userid'        => 0,
                    'page_name'     => 'User Creation',
                    'notification'  => 'A new user has been added by the admin: ' . $user->name,
                    'url'           => '/admin/users/'.$user->id.'/edit',
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
        
                return response()->json(['message' => 'User added successfully.'], 200);
        
            } catch (\Illuminate\Validation\ValidationException $e) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors'  => $e->errors()
                ], 422);
            }
        }

		public function show($id)
		{
			$user = User::findOrFail($id);
			return view('admin.users.show', compact('user'));
		}
		
		
		public function edit($id)
		{
			$user = User::findOrFail($id);
			return view('admin.users.edit', compact('user'));
		}
		
		public function update(Request $request, $id)
        {
            $user = User::findOrFail($id);
        
            $validated = $request->validate([
                'name'          => 'required|string|max:255',
                'email'         => 'required|email|unique:users,email,' . $id,
                'phone'         => 'required|string',
                'company_name'  => 'nullable|string',
                'gst_number'    => 'nullable|string',
                'address'       => 'nullable|string',
                'state'         => 'nullable|string',
                'pin_code'      => 'nullable|string',
                'status'        => 'nullable|string',
            ]);
        
            // Check if password is provided
            if ($request->filled('password')) {
                $request->validate([
                    'password' => 'required|string|min:8|confirmed',
                ]);
        
                $validated['password'] = Hash::make($request->password);
            }
        
            $user->update($validated);
        
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
        }

		
		public function destroy($id)
		{
			$user = User::findOrFail($id);
			$user->delete();
			
			return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
		}
		
		public function updateStatus(Request $request)
		{
			$user = User::findOrFail($request->id);
			$user->status = $request->status === 'active' ? 'active' : 'deactive';
			$user->save();
			
			return response()->json(['message' => 'Status updated successfully.']);
		}
		
		public function bulkUpdateStatus(Request $request)
		{
			$request->validate([
			'user_ids' => 'required|array',
			'status' => 'required|in:active,deactive',
			]);
			
			User::whereIn('id', $request->user_ids)->update(['status' => $request->status]);
			
			return response()->json(['message' => 'Users updated successfully.']);
		}
		
	}