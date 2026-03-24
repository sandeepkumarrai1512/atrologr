@extends('user.layouts.master')

@section('title', 'User Dashboard')

@section('content')
<style>
	table.actionProduct {
	width: 100%;
	border-collapse: collapse;
	}
	table a {
	    color: #222 ;
	}
	
	.seller-row td { background-color: #f4e9ff !important; }
	.buyer-row td { background-color: #e6fffa !important; }
	
	table.actionProduct th, 
	table.actionProduct td {
	text-align: center;
	padding: 10px;
	}
	
	.btn {
	padding: 5px 15px;
	border-radius: 4px;
	border: none;
	cursor: pointer;
	}
	
	.btn-blue {
	background-color: #3498db;
	color: white;
	}
	
	.btn-black {
	background-color: #000;
	color: white;
	}
	
	/* Scoped only to actionProduct table */
	.actionProduct {
	border-collapse: collapse;
	width: 100%;
	text-align: center;
	font-family: Arial, sans-serif;
	}
	.actionProduct th, 
	.actionProduct td {
	border: 1px solid #ddd;
	padding: 10px;
	}
	.actionProduct th {
	background: #f8f9fa;
	}
	.actionProduct .btn {
	padding: 6px 12px;
	border: none;
	border-radius: 4px;
	cursor: pointer;
	color: #fff;
	font-size: 14px;
	}
	.actionProduct .btn-blue { background: #007bff; }
	.actionProduct .btn-black { background: #000; }
	.actionProduct .btn-blue:hover { background: #0056b3; }
	.actionProduct .btn-black:hover { background: #333; }
</style>

<div class="Dashboard-main-content">
	<div class="Dashboard-content-area">
		
		<!-- Stats Cards Row -->
		<div class="row Dashboard-stats-row">
			
			<div class="col-lg-4 col-md-4 col-sm-12 mb-3">
				<div class="Dashboard-stat-card">
					<img src="../image/clipboard.png" alt="" width="70px" height="70px" style="margin-right: 10px;">
					<div class="counter-div">
						<a href="{{ route('products.index') }}">
							<div class="counter-inner">
								<p class="Dashboard-stat-number mb-0" style="font-size:15px !important;">Seller: {{ $products->count() }}</p>
								<p class="Dashboard-stat-label mb-1">Products</p>
							</div>
						</a>
						<a href="{{ route('getBuyerMsg.getAllbmsg') }}">
							<div class="counter-inner">
								<p class="Dashboard-stat-number mb-0" style="font-size:15px !important;">Buyer: {{ $buyerProducts->count() }}</p>
								<p class="Dashboard-stat-label mb-0">Products</p>
							</div>
						</a>
					</div>
				</div>
			</div>
			
			<div class="col-lg-4 col-md-4 col-sm-12 mb-3">
				<a href="{{ route('my.wish.list') }}">
					<div class="Dashboard-stat-card">
						<img src="../image/heart (1).png" alt="" width="70px" height="70px" style="margin-right: 10px;">
						<h3 class="Dashboard-stat-number">{{ $wishlistItems->count() }}</h3>&nbsp;
						<p class="Dashboard-stat-label">My WishList</p>
					</div>
				</a>
			</div>
			
			<div class="col-lg-4 col-md-4 col-sm-12 mb-3">
				<a href="#">
					<div class="Dashboard-stat-card">
						<img src="../image/box.png" alt="" width="70px" height="70px" style="margin-right: 10px;">
						<div class="counter-div">
							<a href="{{ route('seller.order') }}">
								<div class="counter-inner">
									<p class="Dashboard-stat-number mb-0" style="font-size:15px !important;"><strong>Seller: {{ $sellerOrderCount ?? 0 }}</strong></p>
									<p class="Dashboard-stat-label mb-1">Orders</p>
								</div>
							</a>
							<a href="{{ route('buyer.order') }}">
								<div class="counter-inner">
									<p class="Dashboard-stat-number mb-0" style="font-size:15px !important;"><strong>Buyer: {{ $buyerOrderCount ?? 0 }}</strong></p>
									<p class="Dashboard-stat-label mb-0">Orders</p>
								</div>
							</a>
						</div>
					</div>
				</a>
			</div>
			
		</div>
		
		<style>
			.seller-td { background-color: #d4edda !important; }
			.buyer-td { background-color: #fff3cd !important; }
			.topLegendSection {
			display: flex
			;
			gap: 40px;
			margin-bottom: 10px;
			}
			table.actionProduct.table.table-bordered {
			box-shadow: 0 6px 10px -2px rgba(0, 0, 0, 0.3);
			margin-bottom: 20px !important;
			}
		</style>
	
		
		{{-- Things To Do Section --}}
@if(isset($products) || isset($buyerProducts))
    @php
        $toDoTasks = [];
    @endphp

    {{-- SELLER TASKS --}}
    @foreach($products as $product)
        @foreach($product->messages->unique('buyer_id') as $msg)
            @php
                // Reuse offer/commission logic
                $offers = $product->messages
                    ->where('buyer_id', $msg->buyer_id)
                    ->where('is_offer', 1)
                    ->sortByDesc('id');

                $latestOffer = $offers->first();
                $offerStatus = $latestOffer?->offer_status;

                if($offerStatus === 'pending' && $latestOffer && $latestOffer->user_type === 'buyer') {
                    $toDoTasks[] = [
                        'title' => "Offer Received",
                        'desc'  => "A new offer has been received for the product '{$product->product_name}'. Please check and proceed accordingly.",
                        'btn'   => '<a href="/chat-with-buyer/'.$msg->buyer_id.'/'.$product->id.'" class="btn btn-primary btn-sm">View Details</a>'
                    ];
                }

                // Commission check for seller
                $acceptedOffer = $offers->where('offer_status', 'accept')->first();
                if($acceptedOffer) {
                    $transactions = \App\Models\Transactions::where('offer_id', $acceptedOffer->id)
                        ->where('type', 'commission')
                        ->orderBy('id', 'desc')
                        ->get()
                        ->groupBy('user_type');

                    if(isset($transactions['buyer'])) {
                        $latestBuyerTran = $transactions['buyer']->first();
                        if($latestBuyerTran && $latestBuyerTran->status === 'approve' && !isset($transactions['seller'])) {
                            $toDoTasks[] = [
                                'title' => "Pay Commission",
                                'desc'  => "The offer has been finalized for the product '{$product->product_name}'. Please pay your commission to proceed further.",
                                'btn'   => '<a href="/pay-commission-seller/'.$latestBuyerTran->order_id.'" class="btn btn-primary btn-sm">Pay Now</a>'
                            ];
                        }
                    }
                }
            @endphp
        @endforeach
    @endforeach

    {{-- BUYER TASKS --}}
    @foreach($buyerProducts as $product)
        @php
            $buyerId = auth()->id();
            $sellerId = $product->messages->first()->seller_id;

            $offers = $product->messages
                ->where('seller_id', $sellerId)
                ->where('buyer_id', $buyerId)
                ->where('is_offer', 1);

            $latestOffer = $offers->sortByDesc('id')->first();
            $offerStatus = $latestOffer?->offer_status;

            if($offerStatus === 'pending' && $latestOffer && $latestOffer->user_type === 'seller') {
                $toDoTasks[] = [
                    'title' => "Offer Approval Pending",
                    'desc'  => "Seller has sent you an offer for the product '{$product->product_name}'. Please review and respond.",
                    'btn'   => '<a href="/chat-with-seller/'.$product->id.'" class="btn btn-primary btn-sm">View</a>'
                ];
            }

            $acceptedOffer = $offers->where('offer_status', 'accept')->first();
            if($acceptedOffer) {
                $transactions = \App\Models\Transactions::where('offer_id', $acceptedOffer->id)
                    ->where('type', 'commission')
                    ->orderBy('id', 'asc')
                    ->get();

                $latestTran = $transactions->last();
                if(!$transactions->where('status', 'approve')->where('user_type', 'buyer')->count()) {
                    $toDoTasks[] = [
                        'title' => "Pay Commission",
                        'desc'  => "The offer has been finalized for the product '{$product->product_name}'. Please pay your commission to proceed further.",
                        'btn'   => '<a href="/pay-commission/'.$acceptedOffer->id.'" class="btn btn-primary btn-sm">Pay Now</a>'
                    ];
                }
            }
        @endphp
    @endforeach

    {{-- Render the To-Do Section --}}
    @if(!empty($toDoTasks))
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                Things To Do :
            </div>
            <ul class="list-group list-group-flush">
                @foreach($toDoTasks as $task)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $task['title'] }}</strong><br>
                            <small>{{ $task['desc'] }}</small>
                        </div>
                        {!! $task['btn'] !!}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endif

	<div class="mt-3">
			<div class= "topLegendSection">
				<div class="mb-2">
					<span style="display:inline-block; width:50px; height:15px; background-color:#e6fffa; vertical-align:middle; border:1px solid #80808052;"></span>
					<span class="ms-2">Buying</span>
				</div>
				<div>
					<span style="display:inline-block; width:50px; height:15px; background-color:#f4e9ff; vertical-align:middle; border:1px solid #80808052;"></span>
					<span class="ms-2">Selling</span>
				</div>
			</div>
		</div>
		
		<!-- Action Product Table -->
	    
        <table class="actionProduct table table-bordered" style="margin-bottom:10px;">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>In Chat</th>
                    <th>Offers</th>
                    <th>Commission</th>
                    <th>Contact</th>
                    <th>Order Status</th>
                </tr>
            </thead>
            <tbody>
                {{-- ================= SELLER PRODUCTS ================= --}}
                @foreach($products as $product)
                    @if($product->messages->isEmpty())
                        @continue
                    @endif
        
                    @php
                        $buyers = $product->messages->unique('buyer_id');
                        $rowspan = $buyers->count();
                    @endphp
        
                    @foreach($buyers as $index => $msg)
                        @php
                            $userName = substr(hash('crc32b', "user-{$product->id}-{$msg->buyer_id}"), 0, 10);
        
                            $offers = $product->messages
                                ->where('buyer_id', $msg->buyer_id)
                                ->where('is_offer', 1)
                                ->sortByDesc('id');
        
                            $latestOffer = $offers->first();
        
                            $offerStatus = null;
                            $buyerCommissionStatus = null;
                            $sellerCommissionStatus = null;
                            $orderId = '';
                            $orderStatus = '';
        
                            if($offers->isNotEmpty()) {
                                $acceptedOffer = $offers
                                    ->where('offer_status', 'accept')
                                    ->sortByDesc('id')
                                    ->first();
        
                                if($acceptedOffer) {
                                    $offerStatus = 'accept';
                                } elseif($latestOffer) {
                                    $offerStatus = $latestOffer->offer_status;
                                }
                            }
        
                            if($offerStatus === 'accept' && isset($acceptedOffer)) {
                                $transactions = \App\Models\Transactions::where('offer_id', $acceptedOffer->id)
                                    ->where('type', 'commission')
                                    ->orderBy('id', 'desc')
                                    ->get()
                                    ->groupBy('user_type');
        
                                $buyerCommissionStatus = 'pending';
                                $sellerCommissionStatus = 'waiting';
        
                                if(isset($transactions['buyer'])) {
                                    $latestBuyerTran = $transactions['buyer']->first();
                                    if($latestBuyerTran->status === 'approve') {
                                        $buyerCommissionStatus = 'done';
                                        $orderId = $latestBuyerTran->order_id;
                                        if($orderId) {
                                            $order = \App\Models\Orders::find($orderId);
                                            if($order) {
                                                $orderStatus = $order->status;
                                            }
                                        }
                                    } elseif($latestBuyerTran->status === 'reject') {
                                        $buyerCommissionStatus = 'rejected';
                                    }
                                }
        
                                if(isset($transactions['seller'])) {
                                    $latestSellerTran = $transactions['seller']->first();
                                    if($latestSellerTran->status === 'approve') {
                                        $sellerCommissionStatus = 'done';
                                        $orderId = $latestSellerTran->order_id;
                                    } elseif($latestSellerTran->status === 'reject') {
                                        $sellerCommissionStatus = 'rejected';
                                    } elseif($latestSellerTran->status === 'pending') {
                                        $sellerCommissionStatus = 'pending';
                                    }
                                }
                            }
                        @endphp
        
                        <tr class="seller-row">
                            {{-- Product Name once only --}}
                            @if($index === 0)
                                <td rowspan="{{ $rowspan }}">
                                    <a href="/product/{{ $product->id }}">
                                        <strong>{{ $product->product_name }}</strong>
                                    </a>
                                </td>
                            @endif
        
                            <td>
                                <a href="/chat-with-buyer/{{$msg->buyer_id}}/{{$product->id}}">
                                    <strong> Buyer-{{ $userName }} </strong>
                                </a>
                            </td>
        
                            {{-- Offer Status --}}
                            <td>
                                @if(!$offerStatus)
                                    -
                                @elseif($offerStatus === 'pending')
                                    @if($latestOffer)
                                        @if($latestOffer->user_type === 'buyer')
                                            @if(auth()->id() == $msg->buyer_id)
                                                Waiting For Approval
                                            @else
                                                <a href="/chat-with-buyer/{{$msg->buyer_id}}/{{$product->id}}" class="btn btn-primary btn-sm">
                                                    View
                                                </a>
                                            @endif
                                        @elseif($latestOffer->user_type === 'seller')
                                            @if(auth()->id() == $msg->seller_id)
                                                <a href="/chat-with-buyer/{{$msg->buyer_id}}/{{$product->id}}">Waiting For Approval</a>
                                            @else
                                                <a href="/chat-with-buyer/{{$msg->buyer_id}}/{{$product->id}}" class="btn btn-primary btn-sm">
                                                    View
                                                </a>
                                            @endif
                                        @endif
                                    @endif
                                @elseif($offerStatus === 'accept')
                                   <a href="/chat-with-buyer/{{$msg->buyer_id}}/{{$product->id}}"> <span style="color:green; font-weight:bold;">✔ Accepted</span></a>
                                @elseif($offerStatus === 'reject')
                                  <a href="/chat-with-buyer/{{$msg->buyer_id}}/{{$product->id}}">  ❌ Rejected</a>
                                @endif
                            </td>

        
                            {{-- Commission Status --}}
                            <td>
                                @if($buyerCommissionStatus && $buyerCommissionStatus === 'done' && $sellerCommissionStatus && $sellerCommissionStatus === 'waiting')
                                    <a href="/pay-commission-seller/{{$orderId}}" class="btn btn-primary btn-sm">
                                        Pay Now
                                    </a>
                                @elseif($sellerCommissionStatus && $sellerCommissionStatus === 'done')
                                    <span style="color:green; font-weight:bold;">✔ Done</span>
                                @elseif($sellerCommissionStatus && $sellerCommissionStatus === 'pending')
                                    Waiting For Approval
                                @else
                                    -
                                @endif
                            </td>
        
                            <td>
                                @if($buyerCommissionStatus && $buyerCommissionStatus === 'done' && $sellerCommissionStatus && $sellerCommissionStatus === 'done')    
                                    <a href="/seller-order-detail/{{$orderId}}" class="btn btn-primary btn-sm">
                                        View
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
        
                            <td>
                                @if($buyerCommissionStatus && $buyerCommissionStatus === 'done' && $sellerCommissionStatus && $sellerCommissionStatus === 'done' && $orderStatus != 'pending')
                                    {{$orderStatus}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endforeach
        
                {{-- ================= BUYER PRODUCTS ================= --}}
                @foreach($buyerProducts as $product)
                    @if($product->messages->isEmpty())
                        @continue
                    @endif
        
                    @php
                        $buyerId = auth()->id();
                        $sellerId = $product->messages->first()->seller_id;
                        $userName = substr(hash('crc32b', "user-{$product->id}-{$sellerId}"), 0, 10);
        
                        $offers = $product->messages
                            ->where('seller_id', $sellerId)
                            ->where('buyer_id', $buyerId)
                            ->where('is_offer', 1);
        
                        $latestOffer = $offers->sortByDesc('id')->first();
        
                        $offerStatus = null;
                        $commissionStatus = null;
                        $acceptedOffer = null;
                        $offerId = '';
                        $orderId = '';
                        $userType = '';
        
                        if($offers->isNotEmpty()) {
                            $acceptedOffer = $offers->where('offer_status', 'accept')
                            //    ->where('user_type', 'buyer')
                                ->first();
        
                            if($acceptedOffer) {
                                $offerId = $acceptedOffer->id;
                                $offerStatus = 'accept';
                            } elseif($latestOffer) {
                                $offerStatus = $latestOffer->offer_status;
                            }
                        }
        
                        $orderStatus = null;
                        $commissionStatus = null;
        
                       if ($offerStatus === 'accept' && $acceptedOffer) {
                        $transactions = \App\Models\Transactions::where('offer_id', $acceptedOffer->id)
                            ->where('type', 'commission')
                            ->orderBy('id', 'asc')
                            ->get();
                    
                        $buyerApproved  = false;
                        $sellerApproved = false;
                        $commissionStatus = null;
                    
                        if ($transactions->isNotEmpty()) {
                            $latestTran = $transactions->last();
                    
                            foreach ($transactions as $tran) {
                                if ($tran->status === 'approve' && $tran->user_type === 'buyer') {
                                    $buyerApproved = true;
                                }
                                if ($tran->status === 'approve' && $tran->user_type === 'seller') {
                                    $sellerApproved = true;
                                    $orderId = $tran->order_id;
                                    if ($orderId) {
                                        $order = \App\Models\Orders::find($orderId);
                                        $orderStatus = $order ? $order->status : null;
                                    }
                                }
                            }
                    
                            if ($latestTran->status === 'reject') {
                                $commissionStatus = 'rejected';
                            } elseif ($buyerApproved && $sellerApproved) {
                                $commissionStatus = 'done';
                            } elseif ($buyerApproved && !$sellerApproved) {
                                $commissionStatus = 'pending'; // buyer paid, seller approval left
                            } elseif (!$buyerApproved && $latestTran->status === 'pending' && $latestTran->user_type === 'buyer') {
                                $commissionStatus = 'buyer_pending';
                            }
                        }
                    }


                    @endphp
        
                    <tr class="buyer-row">
                        <td>
                            <a href="/product/{{ $product->id }}">
                                <strong>{{ $product->product_name }}</strong>
                            </a>
                        </td>
                        <td>
                            <a href="/chat-with-seller/{{$product->id}}">
                                <strong>Seller-{{ $userName }}</strong>
                            </a>
                        </td>
        
                       {{-- Offer Status --}}
                        <td>
                            @if(!$offerStatus)
                                -
                            @elseif($offerStatus === 'pending')
                                @if($latestOffer)
                                    @if($latestOffer->user_type === 'buyer')
                                        @if(auth()->id() == $buyerId)
                                         <a href="/chat-with-seller/{{$product->id}}">    Waiting For Approval</a>
                                        @else
                                            <a href="/chat-with-seller/{{$product->id}}" class="btn btn-sm btn-primary">View</a>
                                        @endif
                                    @elseif($latestOffer->user_type === 'seller')
                                        @if(auth()->id() == $sellerId)
                                           <a href="/chat-with-seller/{{$product->id}}">  Waiting For Approval</a>
                                        @else
                                            <a href="/chat-with-seller/{{$product->id}}" class="btn btn-sm btn-primary">View</a>
                                        @endif
                                    @endif
                                @endif
                            @elseif($offerStatus === 'accept')
                                <a href="/chat-with-seller/{{$product->id}}"> <span style="color:green; font-weight:bold;">✔ Accepted</span></a>
                            @elseif($offerStatus === 'reject')
                                <a href="/chat-with-seller/{{$product->id}}">❌ Rejected</a>
                            @endif
                        </td>


        
                        {{-- Commission Status --}}
                        <td>
                            @if($offerStatus === 'accept')
                                @if(!$commissionStatus)
                                    <a href="/pay-commission/{{$offerId}}" class="btn btn-primary btn-sm">
                                        Pay now
                                    </a>
                                @elseif($commissionStatus === 'buyer_pending')
                                    Waiting for approval
                                @elseif($commissionStatus === 'pending')
                                    Waiting for approval
                                @elseif($commissionStatus === 'done')
                                    <span style="color:green; font-weight:bold;">✔ Done</span>
                                @elseif($commissionStatus === 'rejected')
                                <a href = "/pay-commission/{{$offerId}}">    ❌ Rejected</a>
                                @endif
                            @else
                                -
                            @endif
                        </td>
        
                        <td>
                            @if($commissionStatus === 'done')
                                <a href="/buyer-order-detail/{{$orderId}}" class="btn btn-primary btn-sm">
                                    View
                                </a>
                            @else
                                -
                            @endif
                        </td>
        
                        <td>
                            @if($commissionStatus === 'done' && $orderStatus === 'pending')
                                <a href="/cart/{{$offerId}}" class="btn btn-primary btn-sm">
                                    Checkout
                                </a>
                            @elseif($commissionStatus != 'done')
                                -
                            @else
                                {{$orderStatus}}
                            @endif
                        </td>
                    </tr>
                @endforeach
        
                @if($products->isEmpty() && $buyerProducts->isEmpty())
                    <tr>
                        <td colspan="6" class="text-muted text-center mt-3">No records found.</td>
                    </tr>
                @endif
            </tbody>
        </table>

		
		{{-- Pending Offers Section --}}
		@if ($latestPendingOffers->count() > 0)
		<div class="my-3 d-flex align-items-center" style="justify-content: space-between;">
			<h6>Pending Offers</h6>
		</div>
		<div class="table-responsive mt-4">
			<table class="table table-borderless">
				<thead>
					<tr style="background-color: #f8f9fa;">
						<th>NO.</th>
						<th>Quantity</th>
						<th>Amount</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($latestPendingOffers as $index => $offer)
					<tr>
						<td>{{ $index + 1 }}</td>
						<td>#{{ $offer->quantity ?? '-' }}</td>
						<td>₹ {{ number_format($offer->amount ?? 0, 2) }}</td>
						<td>
							<a href="/chat-with-buyer/{{$offer->buyer_id}}/{{$offer->product_id}}" class="btn btn-primary btn-sm" style="background-color: #1C75BC;">View Details</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		@endif
		
		{{-- Recent Orders Section --}}
		@if ($latestSellerOrders->count() > 0)
		<div class="my-3 d-flex align-items-center" style="justify-content: space-between;">
			<h6>Recent Orders</h6>
		</div>
		<div class="table-responsive mt-4">
			<table class="table table-borderless">
				<thead>
					<tr style="background-color: #f8f9fa;">
						<th>NO.</th>
						<th>Order ID</th>
						<th>Quantity</th>
						<th>Amount</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($latestSellerOrders as $index => $order)
					<tr>
						<td>{{ $index + 1 }}</td>
						<td>#{{ $order->id ?? '-' }}</td>
						<td>{{ $order->quantity ?? '-' }}</td>
						<td>₹ {{ number_format($order->amount ?? 0, 2) }}</td>
						<td>
							<a href="/seller-order" class="btn btn-primary btn-sm" style="background-color: #1C75BC;">View Details</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		@endif
		
		{{-- Selling Chart --}}
		@if($hasProducts)
		<div class="dashboard-1-card mt-4">
			<div class="dashboard-1-header">
				<h3 class="dashboard-1-title mb-2">Selling View</h3>
			</div>
			<canvas id="sellingChart" height="120"></canvas>
		</div>
		@endif
		
		{{-- Recent Activities / Notifications --}}
		<div class="dashboard-1-card">
			<div class="dashboard-1-header">
				<h3 class="dashboard-1-title">Recent Activities</h3>
			</div>
			<div class="notification-drawer-body">
				@if(isset($userNotifications) && count($userNotifications) > 0)
				@foreach($userNotifications->take(10) as $note)
				<div class="notification-item" id="note-{{ $note->id }}">
					<div class="content">
						<div class="title">{{ $note->page_name }}</div>
						<div class="meta">{!! $note->notification !!}</div>
					</div>
				</div>
				@endforeach
				@else
				<div class="text-muted text-center mt-3">No notifications</div>
				@endif
			</div>
		</div>
		
	</div>
</div>

@if($hasProducts)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		const ctx = document.getElementById('sellingChart').getContext('2d');
		const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
		const rawData = {!! json_encode($sellingChartDataRaw) !!};
		const data = [];
		for (let i=1; i<=12; i++) {
			data.push(rawData[i.toString()] ?? 0);
		}
		new Chart(ctx, {
			type: 'bar',
			data: {
				labels: months,
				datasets: [{
					label: 'Approved Orders',
					data: data,
					backgroundColor: 'rgba(0, 123, 255, 0.6)',
					borderColor: '#007bff',
					borderWidth: 1
				}]
			},
			options: {
				responsive: true,
				scales: {
					y: { beginAtZero: true, ticks: { precision: 0, stepSize: 1 } }
				},
				plugins: {
					legend: { display: false },
					tooltip: {
						callbacks: {
							label: function(context) { return 'Orders: ' + context.parsed.y; }
						}
					}
				}
			}
		});
	});
</script>
@endif

@endsection