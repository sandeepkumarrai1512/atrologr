    <style>
        .header {
            background-color: #fff;
            border-bottom: 1px solid #e9ecef;
            padding: 0.75rem 0;
        }
        
        .logo {
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        
        .logo:hover {
            text-decoration: none;
        }
        
        .logo-img {
            height: 40px;
            width: auto;
            margin-left: 25px;
        }
        
        .search-container {
            position: relative;
            max-width: 500px;
            margin: 0 auto;
        }
        
        .search-input {
            border: 1px solid #dee2e6;
            border-radius: 25px;
            padding: 0.5rem 1rem;
            padding-right: 3rem;
            width: 100%;
            font-size: 0.95rem;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        
        .search-btn {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            padding: 0.25rem 0.5rem;
        }
        
        .nav-icons {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            flex-wrap: nowrap;
        }
        
        .nav-icon {
            color: #6c757d;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 0.85rem;
            transition: color 0.2s;
        }
        
        .nav-icon:hover {
            color: #007bff;
            text-decoration: none;
        }
        
        .nav-icon i {
            font-size: 1.2rem;
            margin-bottom: 0.25rem;
        }
        
        .cart-badge {
            position: relative;
        }
        
        .cart-badge::after {
            content: '';
            position: absolute;
            top: -2px;
            right: -2px;
            width: 8px;
            height: 8px;
            background-color: #dc3545;
            border-radius: 50%;
        }
        
        /* Hamburger Menu Styles */
        .navbar-toggler {
            border: none;
            padding: 0.4rem 0.6rem;
            background: transparent;
            font-size: 1.2rem;
            color: #6c757d;
            border-radius: 6px;
            min-width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }
        
        .navbar-toggler:hover {
            color: #007bff;
        }
        
        .navbar-toggler-icon {
            background-image: none;
            display: inline-block;
            width: 1.5em;
            height: 1.5em;
        }
        
        /* Mobile Navigation Collapse */
        .mobile-nav-collapse {
            background-color: #fff;
            border-top: 1px solid #e9ecef;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .mobile-nav-icons {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            padding: 1rem;
        }
        
        .mobile-nav-icon {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem;
            color: #6c757d;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s;
            font-size: 0.95rem;
        }
        
        .mobile-nav-icon:hover {
            background-color: #f8f9fa;
            color: #007bff;
            text-decoration: none;
        }
        
        .mobile-nav-icon i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }
        
        /* Secondary Navigation Styles */
        .secondary-nav {
            background-color: #f0f2f7;
            border-bottom: 1px solid #e9ecef;
            padding: 0.5rem 0;
        }
        
        .nav-categories {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin: 0;
            padding: 0;
            list-style: none;
        }
        
        .nav-item {
            position: relative;
        }
        
        .dropdown-icon {
            margin-left: 0.5rem;
            font-size: 0.75rem;
            transition: transform 0.2s;
        }
        
        .nav-item:hover .dropdown-icon {
            transform: rotate(180deg);
        }
        
        /* Mobile Category Navigation */
        .mobile-categories {
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
            padding: 1rem;
        }
        
        .mobile-categories h6 {
            color: #495057;
            margin-bottom: 0.75rem;
            font-weight: 600;
        }
        
        .mobile-category-list {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }
        
        .mobile-category-link {
            padding: 0.5rem 0.75rem;
            color: #6c757d;
            text-decoration: none;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        
        .mobile-category-link:hover {
            background-color: #e9ecef;
            color: #495057;
            text-decoration: none;
        }
        
        /* Enhanced Responsive Styles */
        
        /* Large screens (1200px and up) */
        @media (min-width: 1200px) {
            .navbar-toggler {
                display: none;
            }
            
            .nav-icons {
                gap: 1.8rem;
            }
            
            .nav-categories {
                gap: 2.5rem;
            }
        }
        
        /* Medium to Large tablets (992px to 1199px) */
        @media (max-width: 1199.98px) and (min-width: 992px) {
            .navbar-toggler {
                display: none;
            }
            
            .nav-icons {
                gap: 1rem;
            }
            
            .nav-icon {
                font-size: 0.75rem;
            }
            
            .nav-categories {
                gap: 1.8rem;
            }
        }
        
        /* Tablets (768px to 991px) */
        @media (max-width: 991.98px) and (min-width: 768px) {
            .navbar-toggler {
                display: none;
            }
            
            .nav-icons {
                gap: 0.8rem;
            }
            
            .nav-icon {
                font-size: 0.7rem;
            }
            
            .nav-icon i {
                font-size: 1rem;
            }
            
            .nav-categories {
                gap: 1.5rem;
                overflow-x: auto;
                padding-bottom: 0.25rem;
            }
            
            .nav-categories::-webkit-scrollbar {
                height: 2px;
            }
            
            .nav-categories::-webkit-scrollbar-thumb {
                background-color: #dee2e6;
                border-radius: 2px;
            }
            
            .nav-link {
                font-size: 0.85rem;
                white-space: nowrap;
            }
        }
        
        /* Small tablets and large phones (576px to 767px) */
        @media (max-width: 767.98px) and (min-width: 576px) {
            .header {
                padding: 0.6rem 0;
            }
            
            .search-container {
                max-width: 100%;
            }
            
            .navbar-toggler {
                font-size: 1.1rem;
                min-width: 36px;
                height: 36px;
            }
            
            .logo-img {
                height: 32px;
                margin-left: 15px;
            }
            
            .secondary-nav .nav-categories {
                display: none; /* Hide on mobile, show in collapse */
            }
        }
        
        /* Mobile phones (up to 575px) */
        @media (max-width: 575.98px) {
            .header {
                padding: 0.5rem 0;
            }
            
            .logo-img {
                height: 28px;
                margin-left: 10px;
            }
            
            .search-container {
                max-width: 100%;
            }
            
            .search-input {
                font-size: 16px;
                padding: 0.6rem 1rem;
                padding-right: 3rem;
            }
            
            .navbar-toggler {
                font-size: 1rem;
                min-width: 34px;
                height: 34px;
            }
            
            .secondary-nav .nav-categories {
                display: none;
            }
            
            .mobile-nav-icon {
                font-size: 0.9rem;
                padding: 0.6rem;
            }
            
            .mobile-category-link {
                font-size: 0.85rem;
                padding: 0.4rem 0.6rem;
            }
        }
        
        /* Extra small phones (up to 375px) */
        @media (max-width: 375px) {
            .logo-img {
                height: 24px;
                margin-left: 8px;
            }
            
            .navbar-toggler {
                font-size: 0.9rem;
                min-width: 32px;
                height: 32px;
            }
            
            .mobile-nav-icon {
                font-size: 0.85rem;
                padding: 0.5rem;
            }
            
            .mobile-category-link {
                font-size: 0.8rem;
            }
        }
    
        .demo-content {
            padding: 2rem;
            text-align: center;
            color: #666;
        }
        
        /* Animation for collapse */
        .collapse {
            transition: height 0.35s ease;
        }
        
        .collapsing {
            height: 0;
            overflow: hidden;
            transition: height 0.35s ease;
        }
    </style>
    <!-- Main Header -->
    <header class="header">
        <div class="container-fluid">
            
            <div class="row align-items-center">
                <!-- Logo -->
                <div class="col-6 col-md-3 col-lg-2">
                    <a href="/" class="logo">
                        <img src="{{ asset('image/c751356c9358241c07be3a060a83d66761dd74da.jpg') }}" alt="MLNov Smart" class="logo-img">
                    </a>
                </div>
                
                <!-- Search Bar + Mobile Toggle -->
                <div class="col-12 col-md-5 col-lg-7 order-md-2 order-lg-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="search-container flex-grow-1">
                            <input type="text" class="form-control search-input" placeholder="Search products">
                            <button class="search-btn" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <!-- Mobile Hamburger Toggle -->
                        <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNavCollapse" aria-controls="mobileNavCollapse" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Navigation Icons (Desktop only) -->
                <div class="col-6 col-md-4 col-lg-3 order-md-3 order-lg-3 d-none d-md-block">
                    <!-- Desktop Navigation Icons -->
                    <div class="nav-icons justify-content-end">
                        <a href="#" class="nav-icon">
                            <div class="cart-badge">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <span>Cart</span>
                        </a>
                        <a href="#" class="nav-icon">
                            <i class="fas fa-heart"></i>
                            <span>Wishlist</span>
                        </a>
                        <a href="#" class="nav-icon">
                            <i class="fas fa-bell"></i>
                            <span>Notifications</span>
                        </a>
                        <a href="#" class="nav-icon">
                            <i class="fas fa-envelope"></i>
                            <span>Messages</span>
                        </a>
                        <a href="#" class="nav-icon">
                            <i class="fas fa-th-large"></i>
                            <span>Sell</span>
                        </a>
                        <a href="#Logged-in-sidebar" class="nav-icon">
                            <i class="fas fa-user"></i>
                            <span>Login</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Mobile Navigation Collapse -->
        <div class="collapse mobile-nav-collapse" id="mobileNavCollapse">
            <div class="container-fluid">
                <!-- Mobile Navigation Icons -->
                <div class="mobile-nav-icons">
                    <a href="#" class="mobile-nav-icon">
                        <i class="fas fa-user"></i>
                        <span>Login / Register</span>
                    </a>
                    <a href="#" class="mobile-nav-icon">
                        <div class="cart-badge">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <span>My Cart</span>
                    </a>
                    <a href="#" class="mobile-nav-icon">
                        <i class="fas fa-heart"></i>
                        <span>Wishlist</span>
                    </a>
                    <a href="#" class="mobile-nav-icon">
                        <i class="fas fa-bell"></i>
                        <span>Notifications</span>
                    </a>
                    <a href="#" class="mobile-nav-icon">
                        <i class="fas fa-envelope"></i>
                        <span>Messages</span>
                    </a>
                    <a href="#" class="mobile-nav-icon">
                        <i class="fas fa-th-large"></i>
                        <span>Sell on MLNov</span>
                    </a>
                </div>
                
                <!-- Mobile Categories -->
                <div class="mobile-categories">
                    <h6>Categories</h6>
                    <div class="mobile-category-list">
                        <a href="#" class="mobile-category-link">
                            <i class="fas fa-th-large me-2"></i>
                            All Categories
                        </a>
                        <a href="#" class="mobile-category-link">
                            <i class="fas fa-wrench me-2"></i>
                            Tools
                        </a>
                        <a href="#" class="mobile-category-link">
                            <i class="fas fa-cogs me-2"></i>
                            Equipment
                        </a>
                        <a href="#" class="mobile-category-link">
                            <i class="fas fa-box me-2"></i>
                            Consumables
                        </a>
                        <a href="#" class="mobile-category-link">
                            <i class="fas fa-balance-scale me-2"></i>
                            Scales
                        </a>
                        <a href="#" class="mobile-category-link">
                            <i class="fas fa-microscope me-2"></i>
                            Instruments
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
                <!-- Sidebar -->
    <div class="Logged-in-sidebar" id="Logged-in-sidebar">
        <a href="#" class="Logged-in-close-btn">
            <i class="fas fa-times"></i>
        </a>
        
        <!-- User Info -->
        <div class="Logged-in-user-info">
            <h4 class="Logged-in-user-name">Katrina Watt</h4>
            <p class="Logged-in-company-name">ABCD Company</p>
        </div>

        <!-- Dashboard -->
        <div class="Logged-in-menu-section">
            <a href="/Seller/Seller-Dashboard.html" class="Logged-in-menu-item active ">
                <i class="fas fa-th Logged-in-menu-icon"></i>
                Dashboard
            </a>
        </div>

       <!-- Seller Section -->
        <div class="Logged-in-menu-section">
            <input type="checkbox" id="seller-dropdown" class="Logged-in-dropdown-toggle" checked>
            <label for="seller-dropdown" class="Logged-in-menu-item">
                <i class="fas fa-user-tie Logged-in-menu-icon"></i>
                Seller
                <i class="fas fa-chevron-down Logged-in-dropdown-arrow"></i>
            </label>
            <div class="Logged-in-submenu">
                <a href="#" class="Logged-in-submenu-item">Add Product</a>
                <a href="#" class="Logged-in-submenu-item">My Product</a>
                <a href="#" class="Logged-in-submenu-item">Chat</a>
                <a href="#" class="Logged-in-submenu-item">Order</a>
                <a href="#" class="Logged-in-submenu-item">Payment</a>
            </div>
        </div>

        <!-- Buyer Section -->
        <div class="Logged-in-menu-section">
            <button class="Logged-in-menu-item" type="button">
                <i class="fas fa-shopping-bag Logged-in-menu-icon"></i>
                Buyer
                <i class="fas fa-chevron-down Logged-in-dropdown-arrow"></i>
            </button>
            <div class="Logged-in-submenu">
                <a href="#" class="Logged-in-submenu-item">Listing</a>
                <a href="#" class="Logged-in-submenu-item">Wish List</a>
                <a href="#" class="Logged-in-submenu-item">My Order</a>
                <a href="#" class="Logged-in-submenu-item">Chat</a>
            </div>
        </div>

        <!-- Account Settings -->
        <div class="Logged-in-menu-section Logged-in-account-setting">
            <a href="#" class="Logged-in-menu-item">
                <i class="fas fa-cog Logged-in-menu-icon"></i>
                Account Setting
            </a>
            <a href="#" class="Logged-in-menu-item Logged-in-sign-out">
                <i class="fas fa-sign-out-alt Logged-in-menu-icon"></i>
                Sign Out
            </a>
        </div>
    </div>
    
   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
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
        
        // Close mobile menu when clicking on a link
        document.querySelectorAll('.mobile-nav-icon, .mobile-category-link').forEach(link => {
            link.addEventListener('click', function() {
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