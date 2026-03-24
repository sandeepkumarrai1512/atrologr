@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')

<div class="astro-dashboard">
    <div class="astro-card">
        <h2>
            Welcome,
            <span>{{ Auth::guard('admin')->user()->name }}</span>
        </h2>
        <p>Cosmic control panel is ready for management.</p>
    </div>
</div>

<style>

/* Dashboard background */
.astro-dashboard{
    padding:30px;
    min-height:calc(100vh - 60px);
    background: radial-gradient(circle at bottom,#0f2027,#203a43,#2c5364);
}

/* Glass card */
.astro-card{
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(16px);
    border-radius:16px;
    padding:40px;
    color:white;
    box-shadow:0 20px 45px rgba(0,0,0,.5);
    max-width:700px;
}

/* Heading */
.astro-card h2{
    font-size:26px;
    font-weight:600;
    margin-bottom:12px;
    color:white;
}

/* Name highlight */
.astro-card h2 span{
    color:#ffd369;
}

/* Subtitle */
.astro-card p{
    color:#e0e6ed;
    font-size:15px;
}

</style>

@endsection
