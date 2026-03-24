<!DOCTYPE html>
<html lang="en">
	
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>MLNO Smart</title>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
		<link rel="icon" href="{{ asset('image/favicon.png') }}" type="image/x-icon">
		<meta property="og:image" content="{{ asset('image/main-logo-1024x1024.jpg') }}">
		<link href="{{ asset('css/style.css') }}?v={{ rand(0, 9999) }}" rel="stylesheet">
        <link href="{{ asset('css/user-style.css') }}?v={{ rand(0, 9999) }}" rel="stylesheet">

	</head>
	<style>
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
		.mobile-menu{
		    display: none;
		}
		.mobile-menu.active{
		    display: block !important;
		}
		
		#splashScreenImg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1000;
        opacity: 1;
        transition: opacity 1s ease-in-out;
        }
        
        /* Updated class name */
        .splash-fade-out {
            opacity: 0;
        }
        @media (max-width:575px){
         .spalshScreenCls{
        width: 100% !important;
        height: 100% !important;
        max-width: 100% !important;
        object-fit: contain !important;
        background: white !important;
         }   
        }
	</style>
	
	<body>
	    @if(Route::is('home'))
        <img src="/image/splash_screen_with_credits.jpg" alt="splash-screen" id="splashScreenImg" class="spalshScreenCls">
        
        <script>
            window.onload = function() {
                const splashScreen = document.getElementById('splashScreenImg');
                setTimeout(() => {
                    splashScreen.classList.add('splash-fade-out');
                    setTimeout(() => {
                        splashScreen.style.display = 'none';
                    }, 600);
                }, 600);
            };
        </script>
    @endif

		<!-- Main Header -->
		<header class="header header-fixed">
			<div class="container-fluid">
				<div class="row align-items-center">
					<!-- Logo -->
					<div class="col-md-3 col-lg-2 col-sm-12 col-xs-12">
						<a href="/" class="logo">
							<img src="{{ asset('image/main-logo.jpg') }}" alt="MLNov Smart" class="logo-img">
						</a>
					</div>
					
					<!-- Search Bar + Mobile Toggle -->
					<div class="col-12 col-md-5 col-lg-7 order-md-2 order-lg-2">
						<div class="d-flex align-items-center gap-2">
							<div class="search-container flex-grow-1">
								<form action="{{ route('search.results') }}" method="GET">
									<input type="text" class="form-control search-input" placeholder="Search products"
									name="product_name" required>
									<button class="search-btn" type="submit">
										<i class="fas fa-search"></i>
									</button>
								</form>
							</div>
							<!-- Mobile Hamburger Toggle -->
							<button class="navbar-toggler d-md-none" class="btn btn-primary d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNavCollapse" aria-expanded="false" aria-controls="mobileNavCollapse">
								<i class="fas fa-bars"></i>
							</button>
						</div>
					</div>
					
					<!-- Desktop Navigation Icons -->
					<div class="col-6 col-md-4 col-lg-3 order-md-3 order-lg-3 d-none d-md-block">
						<div class="nav-icons justify-content-end">
							@if(auth()->check())
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
							<a href="/seller-messages" class="nav-icon">
								<img src="{{ asset('image/message-top.png') }}" alt="Messages" class="img-fluid">
								<span>Messages</span>
							</a>
							<a href="{{ route('products.index') }}" class="nav-icon sellIconCls">
								<img src="{{ asset('image/sell.png') }}" alt="Sell" class="img-fluid">
								<span>Sell</span>
							</a>
							<div class="dropdown profile-dropdown">
								<a href="/my-profile" class="nav-icon d-flex align-items-center profile-toggle">
									<img src="{{ asset('image/user-top.png') }}" alt="Profile" class="img-fluid">
									<span>Profile</span>
								</a>
								<div class="dropdown-menu">
									@include('user.layouts.sidebar')
								</div>
							</div>
							@else
							<a href="/login" class="nav-icon">
								<i class="fas fa-user"></i>
								<span>Login</span>
							</a>
							@endif
						</div>
					</div>
				</div>
			</div>
			
			<!-- ✅ Mobile Navigation -->
			<div class="mobile-menu" id="mobileNavCollapsenew">
				<div class=" bg-white p-3">
					@if(auth()->check())
					<a href="/my-wishlist" class="d-flex align-items-center py-2">
						<img src="{{ asset('image/wishlist.png') }}" class="me-2" style="width: 20px;"> Wishlist
					</a>
					<a href="/seller-messages" class="d-flex align-items-center py-2">
						<img src="{{ asset('image/message-top.png') }}" class="me-2" style="width: 20px;"> Messages
					</a>
					<a href="{{ route('products.index') }}" class="d-flex align-items-center py-2">
						<img src="{{ asset('image/sell.png') }}" class="me-2" style="width: 20px;"> Sell
					</a>
					
					<!-- Mobile Profile Dropdown -->
					<a class="d-flex justify-content-between align-items-center py-2" data-bs-toggle="collapse"
                    href="#mobileProfileDropdown" role="button" aria-expanded="false"
                    aria-controls="mobileProfileDropdown">
						<span>
							<img src="{{ asset('image/user-top.png') }}" class="me-2" style="width: 20px;"> Profile
						</span>
						<i class="fas fa-chevron-down"></i>
					</a>
					<div class="collapse ps-3" id="mobileProfileDropdown">
						<a href="/my-profile" class="d-block py-2">My Profile</a>
						<a href="/user-dashboard" class="d-block py-2">Dashboard</a>
						<a href="{{ route('user.logout') }}" class="nav-link header-item Dashboard-sign-out" id="dropdown-logout-btn2">	Sign Out</a>
						<form id="logout-form2" action="{{ route('user.logout') }}" method="POST" style="display: none;">@csrf</form>
					</div>
					@else
					<a href="/login" class="d-flex align-items-center py-2">
						<i class="fas fa-user me-2"></i> Login
					</a>
					@endif
				</div>
			</div>
		</header>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
		

	<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.querySelector('.navbar-toggler');
        const collapseMenu = document.getElementById('mobileNavCollapsenew');

        toggleBtn.addEventListener('click', function () {
            if (collapseMenu.classList.contains('active')) {
                // Close
                collapseMenu.classList.remove('active');
            } else {
                // Open
                collapseMenu.classList.add('active');
            }
        });
    });
</script>

		<script>
			// Close mobile menu when clicking on a link
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
			
			function toggleNotificationPanel() {
				const panel = document.getElementById("notificationDrawer");
				panel.classList.toggle("open");
			}
		</script>
		<script>
			const icon = document.getElementById('notificationIcon');
			const popup = document.getElementById('notificationPopup');
			
			icon.addEventListener('click', function (e) {
				e.preventDefault();
				popup.classList.toggle('d-none');
			});
			
			// Optional: hide popup when clicking outside
			document.addEventListener('click', function (e) {
				if (!icon.contains(e.target) && !popup.contains(e.target)) {
					popup.classList.add('d-none');
				}
			});
		</script>
		<script>
			document.addEventListener('DOMContentLoaded', function () {
				const headers = document.querySelectorAll('.Search-Filter-section-header');
				
				headers.forEach(header => {
					header.addEventListener('click', function () {
						const targetId = this.getAttribute('data-bs-target');
						const target = document.querySelector(targetId);
						
						// Create Bootstrap collapse instance
						const bsCollapse = new bootstrap.Collapse(target, {
							toggle: false
						});
						
						// Toggle manually
						if (target.classList.contains('show')) {
							bsCollapse.hide();
							} else {
							bsCollapse.show();
						}
					});
				});
			});
		</script>
		
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
                            $('#note-' + id).addClass("seen"); // optional CSS change
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
					
					// Run every 10 seconds and on page load
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

				


