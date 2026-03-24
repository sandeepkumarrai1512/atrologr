@extends('admin.layouts.master')

@section('title', 'Admin - Users')

@section('content')
<!-- jQuery + SweetAlert -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="Admin-Dashboard-main">
	
    <!-- Add User Modal -->
    <div class="modal fade" id="addNewModal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between align-items-center border-0">
                    <div class="text-center w-100">
                        <h5 class="modal-title mb-0">Add New</h5>
                        <p class="mb-0">Business information</p>
					</div>
                    <button type="button" class="btn-close position-absolute end-0 top-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				
                <div class="modal-body">
                    <form id="addUserForm" method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        <div class="form-row-custom mb-3">
                            <div><input type="text" class="form-control" name="name" placeholder="Full name *" required /></div>
                            <div><input type="tel" class="form-control" name="phone" placeholder="Phone number *" required /></div>
						</div>
						
                        <div class="mb-3"><input type="text" class="form-control" name="company_name" placeholder="Company Name" /></div>
                        <div class="mb-3"><input type="text" class="form-control" name="gst_number" placeholder="GST number" /></div>
                        <div class="mb-3"><input type="text" class="form-control" name="address" placeholder="Address" /></div>
						
                        <div class="form-row-custom mb-3">
                            <div><input type="text" class="form-control" name="state" placeholder="State" /></div>
                            <div><input type="text" class="form-control" name="pin_code" placeholder="PIN Code" /></div>
						</div>
						
                        <div class="mb-3"><input type="email" class="form-control" name="email" placeholder="Email address *" required /></div>
                        <div class="mb-4"><input type="password" class="form-control" name="password" placeholder="Password *" required /></div>
						
                        <button type="submit" class="btn btn-submit w-100">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<h2 class="seller-product-header mb-3">User Approvals</h2>
    
    <!--<div class="Admin-Dashboard-header d-flex justify-content-between align-items-center"></div>-->
	
    <div class="top-date-div">
		<div class="Admin-Dashboard-tab-nav d-flex">
			<a href="/admin/commission-payments" class="Admin-Dashboard-tab-btn @if (request()->is('admin/commission-payments')) active @endif">Payments</a>
			<a href="/admin/users" class="Admin-Dashboard-tab-btn @if (request()->is('admin/users')) active @endif">Users</a>
			<a href="/admin/products" class="Admin-Dashboard-tab-btn @if (request()->is('admin/products')) active @endif">Products</a>
			<a href="/admin/order-delivery" class="Admin-Dashboard-tab-btn @if (request()->is('admin/order-delivery')) active @endif">Orders</a>
		</div>
		<form method="GET" action="{{ route('admin.users.index') }}">
			<div class="row mb-3">
				<div class="col-md-3">
					<select name="status" class="form-select">
						<option value="">All Status</option>
						<option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
						<option value="deactive" {{ request('status') == 'deactive' ? 'selected' : '' }}>Deactive</option>
					</select>
				</div>
				<div class="col-md-3">
					<input type="text" name="name" class="form-control" value="{{ request('name') }}" placeholder="Name">
				</div>
				<div class="col-md-3">
					<input type="date" name="date" class="form-control" value="{{ request('date') }}">
				</div>
				<div class="col-md-3">
					<button class="btn btn-primary w-100" style="background-color: #1C75BC;">Search</button>
				</div>
			</div>
		</form>
		
	</div>
    <div class="container py-4">
        <!-- Top Buttons -->
		<div class="d-flex gap-2 mb-3 acti-de-buttons"><button class="btn btn-primary custom-btn" data-bs-toggle="modal" data-bs-target="#addNewModal">Add
			New</button>
            <button type="button" id="bulk-approve" class="btn btn-success">
                 Activate
            </button>
        
            <button type="button" id="bulk-reject" class="btn btn-danger">
                Deactivate
            </button>
        </div>

		
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>S. No.</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Company Name</th>
                        <th>Status</th>
                        <th>Action</th>
					</tr>
				</thead>
                <tbody>
                    @forelse($users as $index => $user)
					<tr>
						<td><input type="checkbox" class="user-checkbox" value="{{ $user->id }}"></td>
						<!--<td>{{ $index + 1 }}</td>-->
						<td>{{ $users->firstItem() + $index }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->phone }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->company_name }}</td>
						<td>
							<label class="toggle-switch">
								<input type="checkbox" class="status-toggle" data-id="{{ $user->id }}" {{ $user->status === 'active' ? 'checked' : '' }}>
								<span class="slider"></span>
							</label>
							<span class="ms-1 {{ $user->status === 'active' ? '' : 'text-danger' }}">
								{{ $user->status === 'active' ? 'Active' : 'Deactive' }}
							</span>
						</td>
						<td class="action-icons">
							<a href="{{ route('admin.users.show', $user->id) }}"><i class="bi bi-eye"></i></a>
							<a href="{{ route('admin.users.edit', $user->id) }}"><i class="bi bi-pencil"></i></a>
							<form class= "d-none" id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
								@csrf
								@method('DELETE')
								<button type="button" onclick="confirmDelete({{ $user->id }})" style="border: none; background: none;" disabled>
									<i class="bi bi-trash text-danger"></i>
								</button>
							</form>
						</td>
					</tr>
                    @empty
					<tr><td colspan="8" class="text-center">No users found.</td></tr>
                    @endforelse
				</tbody>
			</table>
			@php
			$queryParams = request()->except('page'); // remove old page param
			@endphp
			
			<div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
				
				{{-- Left side --}}
				<div class="text-muted">
					Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} entries
				</div>
				
				{{-- Right side --}}
				<div>
					<nav>
						<ul class="pagination mb-0">
							{{-- Previous --}}
							@if ($users->onFirstPage())
							<li class="page-item disabled"><span class="page-link">Previous</span></li>
							@else
							<li class="page-item">
								<a class="page-link" href="{{ url()->current() }}?page={{ $users->currentPage() - 1 }}@if($queryParams)&{{ http_build_query($queryParams) }}@endif">Previous</a>
							</li>
							@endif
							
							{{-- Pages --}}
							@foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
							<li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
								<a class="page-link" href="{{ url()->current() }}?page={{ $page }}@if($queryParams)&{{ http_build_query($queryParams) }}@endif">{{ $page }}</a>
							</li>
							@endforeach
							
							{{-- Next --}}
							@if ($users->hasMorePages())
							<li class="page-item">
								<a class="page-link" href="{{ url()->current() }}?page={{ $users->currentPage() + 1 }}@if($queryParams)&{{ http_build_query($queryParams) }}@endif">Next</a>
							</li>
							@else
							<li class="page-item disabled"><span class="page-link">Next</span></li>
							@endif
						</ul>
					</nav>
				</div>
				
			</div>
			
			
			
		</div>
	</div>
</div>

<!-- jQuery and SweetAlert CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This will permanently delete the user!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            reverseButtons: true
			}).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
			}
		});
	}
	
    $(document).ready(function () {
        // Status toggle
        $('.status-toggle').change(function () {
            var userId = $(this).data('id');
            var newStatus = $(this).is(':checked') ? 'active' : 'deactive';
			
            $.ajax({
                url: "{{ route('admin.users.updateStatus') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: userId,
                    status: newStatus
				},
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Status Updated',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
					});
					
                    const label = $('input[data-id="' + userId + '"]').closest('td').find('span.ms-1');
                    label.text(newStatus === 'active' ? 'Active' : 'Deactive')
					.toggleClass('text-danger', newStatus !== 'active');
				},
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!',
					});
				}
			});
		});
		
        // Add user form AJAX submit
        $('#addUserForm').on('submit', function (e) {
            e.preventDefault();
            $('.text-danger').remove(); // Remove old errors
			
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    $('#addNewModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'User Added',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
					});
					
                    $('#addUserForm')[0].reset();
                    setTimeout(() => location.reload(), 1000);
				},
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = '';
						
                        for (let field in errors) {
                            errorMessages += errors[field].join('<br>') + '<br>';
						}
						
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            html: errorMessages,
						});
						} else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON?.message || 'Something went wrong!'
						});
					}
				}
			});
		});
		
        $('#select-all').on('click', function () {
			$('.user-checkbox').prop('checked', this.checked);
		});
		
		// If any checkbox is unchecked, uncheck "Select All"
		$('.user-checkbox').on('change', function () {
			if (!$(this).prop('checked')) {
				$('#select-all').prop('checked', false);
				} else if ($('.user-checkbox:checked').length === $('.user-checkbox').length) {
				$('#select-all').prop('checked', true);
			}
		});
		
		function bulkAction(actionType) {
			let userIds = $('.user-checkbox:checked').map(function () {
				return $(this).val();
			}).get();
			
			if (userIds.length === 0) {
				Swal.fire('No Users Selected', 'Please select at least one user.', 'warning');
				return;
			}
			
			Swal.fire({
				title: `Are you sure you want to ${actionType} selected users?`,
				icon: 'question',
				showCancelButton: true,
				confirmButtonText: `Yes, ${actionType}`,
				reverseButtons: true
				}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: "{{ route('admin.users.bulkUpdateStatus') }}",
						method: 'POST',
						data: {
							_token: '{{ csrf_token() }}',
							user_ids: userIds,
							status: actionType === 'approve' ? 'active' : 'deactive'
						},
						success: function (response) {
							Swal.fire('Success', response.message, 'success');
							setTimeout(() => location.reload(), 1000);
						},
						error: function () {
							Swal.fire('Error', 'Something went wrong.', 'error');
						}
					});
				}
			});
		}
		
		$('#bulk-approve').on('click', function () {
			bulkAction('approve');
		});
		
		$('#bulk-reject').on('click', function () {
			bulkAction('reject');
		});
        
        
        
	});
</script>

@endsection