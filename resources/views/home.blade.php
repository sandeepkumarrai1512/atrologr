@include('layouts.header')

<nav class="secondary-nav">
    <div class="container-fluid">
        <ul class="nav-categories">
            <li class="nav-item">
                <a href="/" class="nav-link">
                    All Categories
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">Electronics</a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">Machinery</a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">Raw Materials</a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">Instruments</a>
            </li>
        </ul>
    </div>
</nav>

<section class="marketplace-section">
    <div class="container-fluid">
        <div class="welcome-section">
            
            <h1 class="welcome-title">Welcome to MLNO’Smart</h1>

            <p class="welcome-text home-banner-text" style="color: #0a0a0a;">
                Your trusted platform to buy, sell, and connect for equipment, spares, 
                raw material, consumables and instruments: all at one place!
            </p>

            <div class="category-grid">

                <div class="category-card">
                    <a href="#">
                        <div class="category-header">Electronics</div>
                        <div class="image-card">
                            <img class="img-fluid" src="{{ asset('image/no_image.png') }}">
                        </div>
                    </a>
                </div>

                <div class="category-card">
                    <a href="#">
                        <div class="category-header">Machinery</div>
                        <div class="image-card">
                            <img class="img-fluid" src="{{ asset('image/no_image.png') }}">
                        </div>
                    </a>
                </div>

                <div class="category-card">
                    <a href="#">
                        <div class="category-header">Raw Materials</div>
                        <div class="image-card">
                            <img class="img-fluid" src="{{ asset('image/no_image.png') }}">
                        </div>
                    </a>
                </div>

                <div class="category-card">
                    <a href="#">
                        <div class="category-header">Instruments</div>
                        <div class="image-card">
                            <img class="img-fluid" src="{{ asset('image/no_image.png') }}">
                        </div>
                    </a>
                </div>

            </div>

        </div>
    </div>
</section>

@include('layouts.footer')
