<body>
    <style>
		.mobile-nav .nav-link {
		font-weight: 400;
		color: #6c757d;
		padding: 10px 0;
		display: flex;
		align-items: center;
		border-bottom: 1px solid #eee;
		}
		
		#mobileProfileDropdown .nav-link {
		border-bottom: none;
		padding-left: 20px;
		font-size: 15px;
		}
		.notification-count {
		position: absolute;
		top: -8px;
		right: 20px;
		background-color: #0776bd;
		color: white;
		font-size: 11px;
		padding: 0px;
		border-radius: 50%;
		font-weight: bold;
		line-height: 1;
		z-index: 100;
		height: 17px;
		width: 17px;
		display: flex;
		align-items: center;
		justify-content: center;
		}
		
		span#unreadMessageCount {
        position: absolute !important;
        top: -8px;
        right: 8px;
        background-color: #0776bd;
        color: white;
        font-size: 11px;
        padding: 0px;
        border-radius: 50%;
        font-weight: bold;
        line-height: 1;
        z-index: 100;
        height: 17px;
        width: 17px;
        display: flex
		;
        align-items: center;
        justify-content: center;
		}
		
		
	</style>
    <!-- Main Header -->
    <header class="header header-fixed">
        <div class="container-fluid">
			<div class="row align-items-center">
				<!-- Logo -->
				<div class=" col-md-3 col-lg-2 col-xs-12">
					<a href="/" class="logo">
						<img src="{{ asset('image/main-logo.jpg') }}" alt="MLNov Smart" class="logo-img">
					</a>
				</div>
				
				<!-- Search Bar + Mobile Toggle -->
				<div class="col-12 col-md-5 col-lg-7 order-md-2 order-lg-2">
					<div class="d-flex align-items-center gap-2">
						<div class="search-container flex-grow-1 d-flex">
							<form action="{{ route('products.index') }}" method="GET" onsubmit="return validateSearch()">
								@csrf
								<input type="text" id="search-input" name="product" class="form-control search-input"
								placeholder="Search products" value="{{ request('search') }}" required>
								<button class="search-btn" type="submit">
									<i class="fas fa-search"></i>
								</button>
							</form>
						</div>
						<script>
							function validateSearch() {
								const input = document.getElementById('search-input').value.trim();
								return input !== '';
							}
						</script>
						
						<!-- Mobile Hamburger Toggle -->
						<button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse"
						data-bs-target="#mobileNavCollapse" aria-controls="mobileNavCollapse" aria-expanded="false"
						aria-label="Toggle navigation">
							<i class="fas fa-bars"></i>
						</button>
					</div>
				</div>
				
				<!-- Navigation Icons (Desktop only) -->
				<div class="col-6 col-md-4 col-lg-3 order-md-3 order-lg-3 d-none d-md-block">
					<div class="nav-icons justify-content-end">
						<a href="/my-wishlist" class="nav-icon">
							<img src="{{ asset('image/wishlist.png') }}" alt="Wishlist" class="img-fluid">
							<span>Wishlist</span>
						</a>
						
						<div class="dropdown profile-dropdown">
							<a class="nav-icon profile-toggle position-relative" onclick="toggleNotificationPanel()">
								<img src="{{ asset('image/notification.png') }}" alt="Notifications" class="img-fluid">
								<span class="notification-count" style="display: none;"></span>
								<span>Notifications</span>
							</a>
							
							<div class="notification-drawer" id="notificationDrawer">
								<div class="notification-drawer-header">
									<span>Notifications</span>
									<i class="fas fa-times close-btn" onclick="toggleNotificationPanel()"></i>
								</div>
								<div class="notification-drawer-body" id="ajaxNotificationsBody">
									<div class="text-muted text-center mt-3">Loading...</div>
								</div>
							</div>
						</div>
						
						<div class="nav-icon-wrapper position-relative" style="display: inline-block;">
                            <span id="unreadMessageCount" class="badge badge-danger position-absolute">
							</span>
							
                            <a href="{{ route('getSellMsg.getAllmsg') }}" class="nav-icon">
                                <img src="{{ asset('image/message-top.png') }}" alt="Messages" class="img-fluid">
                                <span>Messages</span>
							</a>
						</div>
						
						<a href="{{route('products.index')}}" class="nav-icon sellIconCls">
							<img src="{{ asset('image/sell.png') }}" alt="Sell" class="img-fluid">
							<span>Sell</span>
						</a>
						
						<div class="dropdown profile-dropdown">
							<a href="/my-profile" class="nav-icon d-flex align-items-center profile-toggle">
								<img src="{{ asset('image/user-top.png') }}" alt="Profile" class="img-fluid">
								<span>Profile</span>
							</a>
							<div class="dropdown-menu" style="border: 1px solid #d5d5d5; min-width: 180px;">
								<div class="header-sidebar">
									<a href="/user-dashboard" class="header-item @if(request()->is('user-dashboard')) active @endif">
										Dashboard
									</a>
									<a href="/seller-order" class="header-item @if(request()->is('seller-order')) active @endif">
										Orders
									</a>
									<a href="/seller-transactions" class="header-item @if(request()->is('seller-transactions')) active @endif">
										Payments
									</a>
									<a href="/my-wishlist" class="header-item @if(request()->is('my-wishlist')) active @endif">
										Wishlist
									</a>
									<a href="{{ route('user.logout') }}" class="header-item Dashboard-sign-out" id="dropdown-logout-btn">
										Sign Out
									</a>
									
									<form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Mobile Navigation Collapse -->
			<div class="collapse d-md-none" id="mobileNavCollapse">
				<div class="mobile-nav bg-white p-3 mt-2">
					<ul class="nav flex-column">
						
						<li class="nav-item">
							<a class="nav-link" href="/my-wishlist">
								<img src="{{ asset('image/wishlist.png') }}" class="me-2" style="width: 20px;"> Wishlist
							</a>
						</li>
						
						<li class="nav-item">
							<a class="nav-link" href="{{route('getSellMsg.getAllmsg')}}">
								<img src="{{ asset('image/message-top.png') }}" class="me-2" style="width: 20px;"> Messages
							</a>
						</li>
						
						<li class="nav-item">
							<a class="nav-link" href="{{route('products.index')}}">
								<img src="{{ asset('image/sell.png') }}" class="me-2" style="width: 20px;"> Sell
							</a>
						</li>
						
						<!-- Profile Dropdown Toggle -->
						<li class="nav-item">
							<a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#mobileProfileDropdown" role="button" aria-expanded="false" aria-controls="mobileProfileDropdown">
								<span>
									<img src="{{ asset('image/user-top.png') }}" class="me-2" style="width: 20px;"> Profile
								</span>
								<i class="fas fa-chevron-down"></i>
							</a>
						</li>
						
						<!-- Profile Dropdown Items -->
						<div class="collapse ps-3" id="mobileProfileDropdown">
							<li class="nav-item">
								<a class="nav-link" href="/my-profile">My Profile</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="/user-dashboard">Dashboard</a>
							</li>
							<li class="nav-item">
									<a href="{{ route('user.logout') }}" class="nav-link header-item Dashboard-sign-out" id="dropdown-logout-btn2">
										Sign Out
									</a>
									
									<form id="logout-form2" action="{{ route('user.logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
							</li>
						</div>
						
					</ul>
				</div>
			</div>
		</div>
		
	</header>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
	
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	
	<script>
		$(document).ready(function () {
			// Delete Notification
			$(document).on('click', '.delete-user-note', function() {
				var id = $(this).data('id');
				var element = $('#note-' + id);
				
				$.ajax({
					url: "/ajax/header-notifications/" + id,
					type: "DELETE",
					headers: {
						'X-CSRF-TOKEN': '{{ csrf_token() }}'
					},
					success: function(res) {
						if (res.success) {
							element.remove();
							loadNotifications();
						}
					}
				});
			});
			
			$(document).on('click', '.notification-click', function () {
                const id = $(this).data('id');
                const url = $(this).data('url');
                
                if (!url || url === '#') return;
                
                $.ajax({
                    url: "/ajax/header-notifications/" + id + "/seen",
                    type: "PATCH",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        if (res.success) {
                            $('#note-' + id).addClass("seen"); 
                            window.location.href = url;
                        }
                    },
                    error: function () {
                        console.error("Could not mark notification as seen.");
                        window.location.href = url; 
                    }
                });
            });
        });
		
	</script>
	
	<script>
		function toggleNotificationPanel() {
			$('#notificationDrawer').toggleClass('open');
			if ($('#notificationDrawer').hasClass('open')) {
				loadNotifications();
			}
		}
		
        	function loadNotifications() {
            $.ajax({
                url: "{{ url('/ajax/header-notifications') }}",
                type: "GET",
                success: function (response) {
                    const data = response.data || [];
                    
                    // 🔹 Count only unseen notifications
                    let unseenCount = data.filter(note => note.is_seen === 0).length;
                    if (unseenCount > 0) {
                        $('.notification-count').text(unseenCount).show();
                    } else {
                        $('.notification-count').hide();
                    }
                    
                    if ($('#notificationDrawer').is(':visible')) {
                        let html = '';
                        
                        data.forEach(function (note) {
                            const url = note.url && note.url !== '#' ? note.url : '';
                            const clickableDiv = url
                                ? `<a href="javascript:void(0);" class="notification-click" data-id="${note.id}" data-url="${url}" style="text-decoration: none; color: inherit;">`
                                : '';
                            const closeTag = url ? '</a>' : '';
                            
                            html += `
                                <div class="notification-item ${note.is_seen === 0 ? 'unseen' : ''}" id="note-${note.id}">
                                    ${clickableDiv}
                                        <div class="icon"><i class="bi bi-bell-fill"></i></div>
                                        <div class="content">
                                            <div class="title">${note.page_name}</div>
                                            <div class="meta">
                                                ${note.notification}
                                                (${note.time})
                                            </div>
                                        </div>
                                    ${closeTag}
                                    <i class="fas fa-times delete-user-note" data-id="${note.id}" style="cursor: pointer; color: red; margin-left: auto;"></i>
                                </div>`;
                        });
                        
                        if (data.length === 0) {
                            html = `<div class="text-muted text-center mt-3">No notifications</div>`;
                        }
                        
                        $('.notification-drawer-body').html(html);
                    }
                }
            });
        }

				
				loadNotifications();
				
				setInterval(loadNotifications, 15000);
			</script>
			
			<script>
				function fetchMessageCount() {
					$.ajax({
						url: '/ajax/unread-message-count',
						method: 'GET',
						success: function (response) {
							if (response.total > 0) {
								$('#unreadMessageCount').text(response.total).show();
								} else {
								$('#unreadMessageCount').hide();
							}
						},
						error: function () {
							console.warn('Failed to fetch message count');
						}
					});
				}
				setInterval(fetchMessageCount, 15000);
				fetchMessageCount();
			</script>
			
			
			
			<script>
				function toggleNotificationPanel() {
					const panel = document.getElementById("notificationDrawer");
					panel.classList.toggle("open");
				}
			</script>
			<script>
				document.addEventListener('click', function (event) {
					const mobileNavCollapse = document.getElementById('mobileNavCollapse');
					const navToggler = document.querySelector('.navbar-toggler');
					
					if (mobileNavCollapse && mobileNavCollapse.classList.contains('show')) {
						if (!mobileNavCollapse.contains(event.target) && !navToggler.contains(event.target)) {
							const bsCollapse = new bootstrap.Collapse(mobileNavCollapse, {
								toggle: false
							});
							bsCollapse.hide();
						}
					}
				});
				
				document.querySelectorAll('.mobile-nav-icon, .mobile-category-link').forEach(link => {
					link.addEventListener('click', function () {
						const mobileNavCollapse = document.getElementById('mobileNavCollapse');
						if (mobileNavCollapse && mobileNavCollapse.classList.contains('show')) {
							const bsCollapse = new bootstrap.Collapse(mobileNavCollapse, {
								toggle: false
							});
							bsCollapse.hide();
						}
					});
				});
			</script>
			<script>
				const icon = document.getElementById('notificationIcon');
				const popup = document.getElementById('notificationPopup');
				
				icon.addEventListener('click', function (e) {
					e.preventDefault();
					popup.classList.toggle('d-none');
				});
				
				document.addEventListener('click', function (e) {
					if (!icon.contains(e.target) && !popup.contains(e.target)) {
						popup.classList.add('d-none');
					}
				});
				
				
					window.addEventListener("pageshow", function (event) {
    if (event.persisted) {
        // Page was restored from back-forward cache
        location.reload();
    }
});
			</script>
		
			
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.getElementById('dropdown-logout-btn').addEventListener('click', function (e) {
    e.preventDefault();

    Swal.fire({
      title: 'Are you sure?',
      text: "You will be logged out.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, logout'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('logout-form').submit();
      }
    });
  });

  document.getElementById('dropdown-logout-btn2').addEventListener('click', function (e) {
    e.preventDefault();

    Swal.fire({
      title: 'Are you sure?',
      text: "You will be logged out.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, logout'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('logout-form2').submit();
      }
    });
  });
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  window.addEventListener("scroll", function () {
    let y = window.scrollY; // scrollTop in pure JS

    if (y > 150) {
      document.querySelector(".header-fixed")?.classList.add("fixed");
      document.body.classList.add("fixed-menu");
    } else {
      document.querySelector(".header-fixed")?.classList.remove("fixed");
      document.body.classList.remove("fixed-menu");
    }
  });
});
</script>
