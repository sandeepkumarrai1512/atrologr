<!-- Sidebar -->
<div class="Admin-Dashboard-sidebar" id="Admin-Dashboard-sidebar">
    <div class="Admin-Dashboard-logo">
        <a href="/admin/dashboard">
            <img class="img-fluid" src="{{ asset('image/Screenshot.png')}}">
        </a>
    </div>

    <nav>

        <!-- Dashboard -->
        <a href="/admin/dashboard"
           class="Admin-Dashboard-nav-item {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
            Dashboard
        </a>

        <!-- User Management -->
        <a class="Admin-Dashboard-nav-item d-flex justify-content-between align-items-center {{ request()->routeIs('admin.users*') ? 'active' : '' }}"
           data-bs-toggle="collapse"
           href="#userManagementMenu"
           role="button">

            <span class="d-flex align-items-center gap-2">
                User Management
            </span>

            <span class="dropdown-arrow">▾</span>
        </a>

        <div class="collapse {{ request()->routeIs('admin.users*') ? 'show' : '' }}" id="userManagementMenu">
            <div class="Admin-Dashboard-submenu">
                <a href="#">Admin</a>
                <a href="#">Users</a>
            </div>
        </div>

        <a href="/admin/chat-management"
           class="Admin-Dashboard-nav-item {{ request()->is('admin/chat-management*') ? 'active' : '' }}">
            Chat Management
        </a>
        <a href="/admin/payment-details"
           class="Admin-Dashboard-nav-item {{ request()->is('admin/payment-details*') ? 'active' : '' }}">
            Payment Details
        </a>
        <a href="/admin/services"
           class="Admin-Dashboard-nav-item {{ request()->is('admin/services*') ? 'active' : '' }}">
           Services
        </a>
        <a href="/admin/shop"
           class="Admin-Dashboard-nav-item {{ request()->is('admin/shop*') ? 'active' : '' }}">
           Shop
        </a>
        
        <a href="/admin/order"
           class="Admin-Dashboard-nav-item {{ request()->is('admin/order*') ? 'active' : '' }}">
           Order
        </a>
        
        
        <a href="log-out"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="Admin-Dashboard-nav-item">
            Logout
        </a>

        <form id="logout-form"
              action="{{ route('admin.logout') }}"
              method="POST"
              style="display: none;">
            @csrf
        </form>

    </nav>
</div>

<div id="sidebarOverlay" class="sidebar-overlay"></div>

<style>

/* Sidebar cosmic background */
.Admin-Dashboard-sidebar{
    position:fixed;
    left:0;
    top:0;
    width:260px;
    height:100vh;
    padding:20px 0;
    z-index:999;
    background:linear-gradient(
        180deg,
        rgba(15,32,39,.95),
        rgba(32,58,67,.95),
        rgba(44,83,100,.95)
    );
    backdrop-filter:blur(16px);
    box-shadow:5px 0 40px rgba(0,0,0,.7);
    overflow-y:auto;
}

/* glow border */
.Admin-Dashboard-sidebar::before{
    content:"";
    position:absolute;
    inset:-1px;
    background:linear-gradient(180deg,#ffdd75,#ff8c00,#6f00ff,#00d4ff);
    opacity:.2;
    filter:blur(15px);
    z-index:-1;
}

/* Logo */
.Admin-Dashboard-logo{
    text-align:center;
    padding:15px 20px 25px;
    border-bottom:1px solid rgba(255,255,255,0.08);
}

.Admin-Dashboard-logo img{
    max-width:150px;
    filter: drop-shadow(0 8px 15px rgba(0,0,0,.6));
}

/* Navigation */
.Admin-Dashboard-sidebar nav{
    margin-top:25px;
}

/* Menu item */
.Admin-Dashboard-nav-item{
    display:flex;
    align-items:center;
    gap:14px;
    padding:14px 24px;
    color:#d6dee8;
    font-size:15px;
    text-decoration:none;
    transition:.3s;
    position:relative;
}

.Admin-Dashboard-nav-item img{
    width:20px;
    filter:brightness(0) invert(1);
    opacity:.85;
    transition:.3s;
}

/* hover */
.Admin-Dashboard-nav-item:hover{
    background:linear-gradient(90deg,
        rgba(255,211,105,.18),
        transparent);
    color:#ffd369;
    padding-left:30px;
}

.Admin-Dashboard-nav-item:hover img{
    opacity:1;
}

/* active */
.Admin-Dashboard-nav-item.active{
    color:#ffd369;
    background:linear-gradient(
        90deg,
        rgba(255,211,105,.28),
        transparent
    );
}

.Admin-Dashboard-nav-item.active::before{
    content:"";
    position:absolute;
    left:0;
    top:0;
    height:100%;
    width:4px;
    background:#ffd369;
    box-shadow:0 0 12px #ffd369;
}

/* submenu */
.Admin-Dashboard-submenu{
    padding-left:55px;
    background:rgba(255,255,255,.03);
}

.Admin-Dashboard-submenu a{
    display:block;
    padding:10px 0;
    font-size:14px;
    color:#b9c4d0;
    text-decoration:none;
}

.Admin-Dashboard-submenu a:hover{
    color:#ffd369;
}

/* mobile overlay */
.sidebar-overlay{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.6);
    opacity:0;
    visibility:hidden;
    transition:.3s;
    z-index:998;
}

.sidebar-overlay.show{
    opacity:1;
    visibility:visible;
}
.main-content{
    margin-left:0px;   /* sidebar width */
    padding:30px;
    min-height:0vh;
    background:#f4f6f9;
}

@media(max-width:991px){
    .main-content{
        margin-left:0;
    }
}

/* mobile */
@media(max-width:991px){
    .Admin-Dashboard-sidebar{
        transform:translateX(-100%);
        transition:.3s;
    }

    .Admin-Dashboard-sidebar.show{
        transform:translateX(0);
    }
}

</style>

<script>
function toggleSidebar() {
    document.querySelector('.Admin-Dashboard-sidebar').classList.toggle('show');
}
</script>