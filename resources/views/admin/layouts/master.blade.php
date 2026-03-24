<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Expires" content="0">
		
		<title>@yield('title', 'Admin Dashboard')</title>
		
		<link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
		<link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ time() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
		
		<link rel="icon" href="" type="image/x-icon">
		<meta property="og:image" content="">
		<style>
			.notification-count {
			position: absolute;
			top: -8px;
			right: -8px;
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
		</style>
	</head>
	<body>
		<div class="admin-layout-main">
			@include('admin.layouts.sidebar')
			
			<!-- Header -->
			<div class="Admin-Dashboard-header d-flex justify-content-between align-items-center" style="background: #fff;">
				<div class="admin-toggle-div">
					<button class="sidebar-toggle" id="adminSideToggle">☰</button>
				</div>
			</div>
			
			<!-- Main Content -->
			<div class="main-content">
				@yield('content')
			</div>
		</div>

		<!-- JS -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
		
		<script>
			// Sidebar search
			document.addEventListener("DOMContentLoaded", function () {
				const input = document.getElementById("sidebarSearchInput");
				const suggestionBox = document.getElementById("sidebarSuggestions");
				const sidebarLinks = document.querySelectorAll(".Admin-Dashboard-sidebar nav a");
				
				input.addEventListener("input", function () {
					const query = this.value.toLowerCase();
					suggestionBox.innerHTML = '';
					if (!query.length) {
						suggestionBox.style.display = 'none';
						return;
					}
					let found = false;
					sidebarLinks.forEach(link => {
						const text = link.textContent.trim();
						if (text.toLowerCase().includes(query)) {
							const item = document.createElement('a');
							item.className = 'list-group-item list-group-item-action';
							item.href = link.getAttribute('href');
							item.textContent = text;
							suggestionBox.appendChild(item);
							found = true;
						}
					});
					suggestionBox.style.display = found ? 'block' : 'none';
				});
				document.addEventListener('click', function (e) {
					if (!input.contains(e.target) && !suggestionBox.contains(e.target)) {
						suggestionBox.style.display = 'none';
					}
				});
			});
		</script>
		@yield('scripts')		