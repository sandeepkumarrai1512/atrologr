<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'User Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/user-style.css') }}?v={{ time() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="icon" href="{{ asset('image/favicon.png') }}" type="image/x-icon">
	<meta property="og:image" content="{{ asset('image/main-logo-1024x1024.jpg') }}">

</head>

<body>
    @include('user.layouts.header')
    <section class="marketplace-section">
        <div class="container-fluid">
            <div class="welcome-section">
            <div class="user-main">
                <button class="sidebar-toggle" id="sidebarToggle">
  ☰ 
</button>
            @include('user.layouts.sidebar')
            <div class="main-content">
                @yield('content')
            </div>
            </div>
                
            </div>
        </div>
    </section>



    @include('user.layouts.footer')
</body>

</html>