<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Astro Admin Login</title>
		
		<style>
			*{
			margin:0;
			padding:0;
			box-sizing:border-box;
			font-family:'Segoe UI', sans-serif;
			}
			
			body{
			height:100vh;
			display:flex;
			justify-content:center;
			align-items:center;
			overflow:hidden;
			background: radial-gradient(circle at bottom,#0f2027,#203a43,#2c5364);
			}
			
			/* Stars */
			body::before{
			content:"";
			position:absolute;
			width:200%;
			height:200%;
			background:url("https://www.transparenttextures.com/patterns/stardust.png");
			animation: moveStars 120s linear infinite;
			opacity:.35;
			}
			
			@keyframes moveStars{
			from{transform:translate(0,0);}
			to{transform:translate(-600px,-600px);}
			}
			
			/* Panel */
			.login-box{
			position:relative;
			width:400px;
			padding:38px;
			border-radius:20px;
			background:rgba(255,255,255,0.08);
			backdrop-filter:blur(20px);
			box-shadow:0 25px 60px rgba(0,0,0,.65);
			color:white;
			text-align:center;
			animation: float 6s ease-in-out infinite;
			}
			
			@keyframes float{
			0%,100%{transform:translateY(0);}
			50%{transform:translateY(-12px);}
			}
			
			.login-box::before{
			content:"";
			position:absolute;
			inset:-2px;
			border-radius:20px;
			background:linear-gradient(45deg,#ffdd75,#ff8c00,#6f00ff,#00d4ff);
			z-index:-1;
			filter:blur(22px);
			opacity:.55;
			}
			
			/* Login Icon */
			.login-icon{
			width:60px;
			height:60px;
			margin:0 auto 10px;
			display:flex;
			justify-content:center;
			align-items:center;
			background:linear-gradient(45deg,#ffd369,#ff9f43);
			border-radius:50%;
			}
			
			.login-icon svg{
			width:28px;
			fill:#222;
			}
			
			/* Titles */
			h2{
			margin-bottom:5px;
			color:#ffd369;
			}
			
			.title{
			margin-bottom:22px;
			color:#ddd;
			font-size:14px;
			}
			
			/* Inputs */
			.input-group{
			margin-bottom:18px;
			text-align:left;
			position:relative;
			}
			
			.input-group label{
			font-size:14px;
			margin-bottom:6px;
			display:block;
			color:#ddd;
			}
			
			.input-group input{
			width:100%;
			padding:14px;
			border-radius:10px;
			border:none;
			background:rgba(255,255,255,0.15);
			color:white;
			outline:none;
			transition:.3s;
			}
			
			.input-group input:focus{
			background:rgba(255,255,255,0.28);
			box-shadow:0 0 10px rgba(255,211,105,.4);
			}
			
			/* Password toggle */
			.password-toggle{
			position:absolute;
			right:12px;
			top:40px;
			cursor:pointer;
			width:22px;
			fill:white;
			opacity:.85;
			}
			
			/* Button */
			.login-btn{
			width:100%;
			padding:14px;
			margin-top:12px;
			border:none;
			border-radius:10px;
			font-size:16px;
			font-weight:bold;
			cursor:pointer;
			background:linear-gradient(45deg,#ffd369,#ff9f43);
			color:#222;
			transition:.3s;
			}
			
			.login-btn:hover{
			transform:translateY(-3px);
			box-shadow:0 12px 30px rgba(255,211,105,.55);
			}
			
			.extra{
			display:flex;
			justify-content:space-between;
			align-items:center;
			margin-top:12px;
			font-size:14px;
			}
			
			.extra a{
			color:#ffd369;
			text-decoration:none;
			}
			
			.error{
			color:#ff6b6b;
			font-size:20px;
			}
			
			.footer{
			margin-top:20px;
			font-size:13px;
			color:#ccc;
			}
		</style>
	</head>
	
	<body>
		
		<div class="login-box">
			
			<div class="login-icon">
				<svg viewBox="0 0 24 24">
					<path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-4.3 0-8 2.2-8 5v3h16v-3c0-2.8-3.7-5-8-5z"/>
				</svg>
			</div>
			
			<h2>🔮 Astro Admin</h2>
			
			<form method="POST" action="{{ route('admin.login') }}">
				@csrf
				@error('email') <div class="error">{{ $message }}</div> @enderror
				<div class="input-group">
					<label>Email</label>
					
					<input type="email" name="email"
					value="{{ old('email') }}"
					placeholder="Enter email" required>
				</div>
				
				<div class="input-group">
					<label>Password</label>
					
					<input type="password"
					name="password"
					id="passwordField"
					placeholder="Enter password"
					required>
					
					<!-- eye icon -->
					<svg id="toggleIcon" class="password-toggle"
					onclick="togglePassword()" viewBox="0 0 24 24">
						<path d="M12 5c-7 0-11 7-11 7s4 7 11 7 11-7 11-7-4-7-11-7zm0 11a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/>
					</svg>
					
				</div>
				
				<div class="extra">
					<label>
						<input type="checkbox" name="remember"> Remember me
					</label>
					<a href="{{ url('admin/forgot-password') }}">Forgot password?</a>
				</div>
				
				<button type="submit" class="login-btn">
					Enter Dashboard
				</button>
				
			</form>
			
			<div class="footer">
				Astrology Admin Control Panel
			</div>
			
		</div>
		
		<script>
			function togglePassword() {
				let field = document.getElementById("passwordField");
				let icon = document.getElementById("toggleIcon");
				
				if(field.type === "password"){
					field.type = "text";
					icon.innerHTML =
					`<path d="M3 3l18 18M10.6 10.6a2 2 0 002.8 2.8M9.9 4.2A10.9 10.9 0 0112 4c7 0 11 8 11 8a21.7 21.7 0 01-5.2 6.1M6.1 6.1A21.7 21.7 0 001 12s4 8 11 8c2.1 0 4-.6 5.6-1.6"/>`;
					}else{
					field.type = "password";
					icon.innerHTML =
					`<path d="M12 5c-7 0-11 7-11 7s4 7 11 7 11-7 11-7-4-7-11-7zm0 11a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/>`;
				}
			}
		</script>
		
	</body>
</html>