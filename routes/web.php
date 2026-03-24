<?php
	use Illuminate\Support\Facades\Route;
	use App\Http\Controllers\Admin\Auth\LoginController as AdminLogin;
	use App\Http\Controllers\Admin\Auth\RegisterController as AdminRegister;
	use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
	use App\Http\Controllers\Admin\Auth\ResetPasswordController;
	use App\Http\Controllers\Admin\DashboardController;
	use App\Http\Controllers\Admin\UserController;
	use App\Http\Controllers\Admin\ChatManagement;
	use App\Http\Controllers\Admin\PaymentDetails;
	use App\Http\Controllers\Admin\Services;
	use App\Http\Controllers\Admin\Shop;
	use App\Http\Controllers\Admin\Order;
	
	
	
	use Illuminate\Support\Facades\DB;
	
	// Front
	use App\Http\Controllers\HomeController;
	use App\Http\Controllers\FrontUserController;
	use App\Http\Controllers\User\UserDashboardController;
	
	use App\Http\Controllers\User\Auth\UserForgotPasswordController;
    use App\Http\Controllers\User\Auth\UserResetPasswordController;
    
    Route::get('/techadmin1s', [AdminLogin::class, 'showLoginForm'])->name('admin.login');
    Route::post('/techadmin1s', [AdminLogin::class, 'login']);
	Route::middleware(['web'])->prefix('admin')->name('admin.')->group(function () {
		// Routes for guests
		Route::middleware('guest:admin')->group(function () {
			Route::get('/register', [AdminRegister::class, 'showRegisterForm'])->name('register');
			Route::post('/register', [AdminRegister::class, 'register']);
			
			// Forgot password
			Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
			Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
			
			// Reset password
			Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
			Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
		});
		
		
		// Routes for authenticated admins
		Route::middleware('admin.auth')->group(function () {
			Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
			// ************** User Management ***************//
			Route::get('/users', [UserController::class, 'index'])->name('users.index');
			Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
			Route::post('/users', [UserController::class, 'store'])->name('users.store');
			Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
			Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
			Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
			Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
			Route::post('/admin/users/update-status', [UserController::class, 'updateStatus'])->name('users.updateStatus');
			Route::post('/admin/users/bulk-update-status', [UserController::class, 'bulkUpdateStatus'])->name('users.bulkUpdateStatus');
			
		    Route::get('/chat-management', [ChatManagement::class, 'index'])->name('chat.index');
		    
		    Route::get('/payment-details', [PaymentDetails::class, 'index'])->name('payment.index');
            Route::get('/payment-details/create', [PaymentDetails::class, 'create'])->name('payment.create');
            Route::post('/payment-details/store', [PaymentDetails::class, 'store'])->name('payment.store');




			Route::get('/services', [Services::class, 'index'])->name('services.index');
			Route::get('/shop', [Shop::class, 'index'])->name('shop.index');
			Route::get('/order', [Order::class, 'index'])->name('order.index');
			
			
		    Route::post('/logout', [AdminLogin::class, 'logout'])->name('logout');
			
		});
	});
	
	//***************************** Front Url Start From Here ********************************//
	
    Route::get('/', [HomeController::class, 'index'])->name('home');
     Route::get('/search', function () { return "Search Working";})->name('search.results');
    Route::get('/category/{slug}-{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('/product/{id}', [ProductControllerUser::class, 'show'])->name('product.show');
	
	//********************************* User register Login ********************************************************************
    Route::get('/register', [FrontUserController::class, 'showRegisterForm'])->name('user.register.form');
    Route::post('/register', [FrontUserController::class, 'register'])->name('user.register');
	
    Route::get('/login', [FrontUserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [FrontUserController::class, 'login'])->name('user.login');
    
    Route::get('forgot-password', [UserForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
	
    // Send email
    Route::post('forgot-password', [UserForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
	
    // Show reset password form
    Route::get('reset-password/{token}', [UserResetPasswordController::class, 'showResetForm'])->name('password.reset');
	
    // Submit new password
    Route::post('reset-password', [UserResetPasswordController::class, 'reset'])->name('password.update');
	
    Route::middleware(['auth'])->group(function () {
        Route::get('/user-dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
        Route::post('/logout', [FrontUserController::class, 'logout'])->name('user.logout');
        
	});