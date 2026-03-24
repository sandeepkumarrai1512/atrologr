<!-- Toggle Button -->
<style>
    
/* Sidebar Base Style */
.Dashboard-sidebar {
  background-color: #ffffff;
  width: 260px;
  overflow-y: auto;
  padding: 5px 20px;
  transition: transform 0.3s ease;
  z-index: 9;
}
.dropdown-icons-style {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}
.Dashboard-menu-item .fa-user-tie {
    font-size: 21px;
    margin-right: 10px;
}

/* Overlay Style */
.sidebar-overlay {
  position: fixed;
  top: 0;
  left: 0;
  background: rgba(0, 0, 0, 0.5);
  width: 100%;
  height: 100%;
  z-index: 8;
  display: none;
}

.sidebar-overlay.active {
  display: block;
}

/* Toggle Button Style */
.sidebar-toggle {
  display: none;
  background-color: #0776bd;
color: white;
    border: none;
    padding: 5px 10px;
    font-size: 20px;
    margin: 10px;
    cursor: pointer !important;
    position: relative;
    border-radius: 5px;
}
button#adminSideToggle {
    background-color: #0776bd;
    color: white;
    border: none;
    padding: 5px 10px;
    font-size: 20px;
    margin: 0;
    cursor: pointer !important;
    position: relative;
    border-radius: 5px;
}

/* Hide default checkbox */
.Dashboard-dropdown-toggle {
  display: none;
}

/* Hide submenu by default */
.Dashboard-submenu {
  display: none;
  padding-left: 20px;
}

/* Show submenu when checkbox is checked */
.Dashboard-dropdown-toggle:checked + label + .Dashboard-submenu {
  display: block;
}

/* Rotate chevron when open */
.Dashboard-dropdown-toggle:checked + label i.fas.fa-chevron-down {
  transform: rotate(180deg);
  transition: 0.3s ease;
}

/* Mobile/Tablet Styles */
@media (max-width: 991px) {
  .sidebar-toggle {
    display: inline-block;
  }
  .Dashboard-sidebar {
  height: 100vh;
  height: 100% !important;
}


  .Dashboard-sidebar {
    position: fixed;
    top: 0;
    left: 0;
    transform: translateX(-100%);
  }

  .Dashboard-sidebar.active {
    transform: translateX(0);
  }
}

</style>
<!-- Sidebar -->
<div id="mobileSidebar" class="Dashboard-sidebar user-admin-sidebar">
  <div class="Dashboard-user-info">
    <div class="Dashboard-user-avatar">
      <img src="{{ asset(Auth::check() && Auth::user()->profile ? Auth::user()->profile : '../image/default-user.png') }}" alt="Profile" width="60">
    </div>
    <div class="Dashboard-user-details">
      <h4>{{ Auth::user()->name }}</h4>
      <p>{{ Auth::user()->company_name }}</p>
    </div>
  </div>

  <div class="Dashboard-menu-section">
    <a href="/user-dashboard" class="Dashboard-menu-item @if(request()->is('user-dashboard')) active @endif">
      <img src="{{ asset('image/admin-dashboard-icon.png')}}" width="20"> Dashboard
    </a>

    <a href="/my-profile" class="Dashboard-menu-item @if(request()->is('my-profile') || request()->is('chat')) active @endif">
      <img src="{{ asset('image/user-admin-profile.png')}}" width="20"> My Profile
    </a>

    <a href="/seller-messages" class="Dashboard-menu-item @if(request()->is('seller-messages')) active @endif">
      <img src="{{ asset('image/message-top.png')}}" width="20"> Messages
    </a>

    <a href="{{ route('home') }}" class="Dashboard-menu-item @if(request()->routeIs('home')) active @endif">
      <img src="{{ asset('image/admin-product-listings.png')}}" width="20"> Listing
    </a>

    <!-- Seller Dropdown -->
    <div class="Dashboard-dropdown">
      <input type="checkbox" id="seller-dropdown" class="Dashboard-dropdown-toggle"
        @if(request()->is('products/*') || request()->is('my-products') || request()->is('seller-order') || request()->is('seller-transactions')) checked @endif>
      <label for="seller-dropdown" class="Dashboard-menu-item dropdown-label">
        <div class="dropdown-icons-style">
          <div><i class="fas fa-user-tie"></i> Seller</div>
          <i class="fas fa-chevron-down"></i>
        </div>
      </label>
      <div class="Dashboard-submenu">
        <a href="{{ route('products.create.step1') }}" class="Dashboard-submenu-item @if(request()->routeIs('products.create.step1')) active @endif">Add Product</a>
        <a href="{{ route('products.index') }}" class="Dashboard-submenu-item @if(request()->is('products/*') || request()->is('my-products')) active @endif">My Products</a>
        <a href="/seller-order" class="Dashboard-submenu-item @if(request()->is('seller-order')) active @endif">Orders</a>
        <a href="/seller-transactions" class="Dashboard-submenu-item @if(request()->is('seller-transactions')) active @endif">Payments</a>
      </div>
    </div>

    <!-- Buyer Dropdown -->
    <div class="Dashboard-dropdown">
      <input type="checkbox" id="buyer-dropdown" class="Dashboard-dropdown-toggle"
        @if(request()->is('buyer-order') || request()->is('my-wishlist') || request()->is('buyer-transactions')) checked @endif>
      <label for="buyer-dropdown" class="Dashboard-menu-item dropdown-label">
        <div class="dropdown-icons-style">
          <div><img src="{{ asset('image/user-admin-buyer.png')}}" width="20"> Buyer</div>
          <i class="fas fa-chevron-down"></i>
        </div>
      </label>
      <div class="Dashboard-submenu">
        <a href="{{ route('my.wish.list') }}" class="Dashboard-submenu-item @if(request()->routeIs('my.wish.list')) active @endif">Wish List</a>
        <a href="/buyer-transactions" class="Dashboard-submenu-item @if(request()->is('buyer-transactions')) active @endif">Payments</a>
        <a href="/buyer-order" class="Dashboard-submenu-item @if(request()->is('buyer-order')) active @endif">Orders</a>
      </div>
    </div>

    <div class="Dashboard-account-setting">
      <a href="/my-profile" class="Dashboard-menu-item @if(request()->is('my-profile')) active @endif d-none">
        <img src="{{ asset('image/user-admin-setting.png')}}" width="20"> Account Setting
      </a>
      <a href="#" class="Dashboard-menu-item Dashboard-sign-out" id="logout-btnn">
        <img src="{{ asset('image/user-admin-logtout.png') }}" width="20"> Sign Out
      </a>
      <form id="logout-formm" action="{{ route('user.logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </div>
  </div>
</div>

<!-- Overlay (click outside to close) -->
<div id="sidebarOverlay" class="sidebar-overlay"></div>
<!-- SweetAlert2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('logout-btnn').addEventListener('click', function (e) {
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
			document.getElementById('logout-formm').submit();
		}
	});
});
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById("sidebarToggle");
    const sidebar = document.getElementById("mobileSidebar");
    const overlay = document.getElementById("sidebarOverlay");

    toggleBtn.addEventListener("click", function () {
      sidebar.classList.add("active");
      overlay.classList.add("active");
    });

    overlay.addEventListener("click", function () {
      sidebar.classList.remove("active");
      overlay.classList.remove("active");
    });
  });
</script>