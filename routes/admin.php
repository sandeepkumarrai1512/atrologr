<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Admin\Auth\LoginController as AdminLogin;
	use App\Http\Controllers\Admin\Auth\RegisterController as AdminRegister;
	use App\Http\Controllers\Admin\DashboardController;
	use App\Http\Controllers\Admin\ProductController;
	use App\Http\Controllers\Admin\UserController;
	use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
	use App\Http\Controllers\Admin\Auth\ResetPasswordController;
	use App\Http\Controllers\Admin\OrderDelivery;
	use App\Http\Controllers\Admin\ChatModeration;
	use App\Http\Controllers\Admin\AdminCategoryController;
	use App\Http\Controllers\Admin\ManualApprovals;
	use App\Http\Controllers\Admin\CommissionPayments;
	use App\Http\Controllers\Admin\QaManagement;
	use App\Http\Controllers\Admin\SellerAnswer;
	use App\Http\Controllers\Admin\BuyerQuestions;
	use App\Http\Controllers\Admin\ReportsAnalytics;
	use App\Http\Controllers\Admin\SettingsControl;
	
	
		Route::middleware(['web'])->prefix('admin')->name('admin.')->group(function () {
		Route::get('/login', [AdminLogin::class, 'showLoginForm'])->name('login');
		// Routes for guests
		Route::middleware('guest:admin')->group(function () {
			Route::post('/login', [AdminLogin::class, 'login']);
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
			
			// ********* Category ***********************//
			Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
			Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
			Route::post('/categories/store', [AdminCategoryController::class, 'store'])->name('categories.store');
			Route::get('/categories/edit/{id}', [AdminCategoryController::class, 'edit'])->name('categories.edit');
			Route::post('/categories/update/{id}', [AdminCategoryController::class, 'update'])->name('categories.update');
			Route::delete('/categories/delete/{id}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');
			
			
			//************ Create Product **************//
			Route::get('/products/create-step-1', [ProductController::class, 'createStep1'])->name('products.create.step1');
			Route::post('/products/store-step-1', [ProductController::class, 'storeStep1'])->name('products.store.step1');
			
			Route::get('/products/edit-step-1/{id}', [ProductController::class, 'editStep1'])->name('products.edit.step1');
			Route::post('/products/update-step-1/{id}', [ProductController::class, 'updateStep1'])->name('products.update.step1');
			
			Route::get('/products/edit-step-2/{id}', [ProductController::class, 'createStep2'])->name('products.create.step2');
			Route::post('/products/store-step-2/{id}', [ProductController::class, 'storeStep2'])->name('products.store.step2');
			
			Route::match(['get', 'post'], '/products/step-3/{id}', [ProductController::class, 'step3'])->name('products.step3');
			
			Route::get('/products', [ProductController::class, 'index'])->name('products.index');
			Route::get('/products/published', [ProductController::class, 'publishedProducts'])->name('products.published');
			Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
			Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
			Route::post('/admin/products/update-status', [ProductController::class, 'updateStatus'])->name('products.update.status');
			Route::post('admin/products/bulk-approve', [ProductController::class, 'bulkApprove'])->name('products.bulk.approve');
			
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
			
			Route::get('/order-delivery', [OrderDelivery::class, 'index'])->name('order.delivery');
			Route::get('/chat-offer-moderation', [ChatModeration::class, 'index'])->name('chat.offer');
			Route::get('/manual-approvals', [ManualApprovals::class, 'index'])->name('manual.approvals');
			Route::get('/commission-payments', [CommissionPayments::class, 'index'])->name('commission.payments');
			Route::get('/q-a-management', [QaManagement::class, 'index'])->name('qa.management');
			Route::get('/buyer-questions', [BuyerQuestions::class, 'index'])->name('buye.questions');
			Route::get('/seller-answers', [SellerAnswer::class, 'index'])->name('seller.answers');
			Route::get('/reports-analytics', [ReportsAnalytics::class, 'index'])->name('reports.analytics');
			Route::get('/settings-access-control', [SettingsControl::class, 'index'])->name('settings.access.control');
			
			Route::post('/logout', [AdminLogin::class, 'logout'])->name('logout');
		});
	});