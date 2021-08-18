<?php

  use App\Http\Controllers\Admin\AdminController;
  use App\Http\Controllers\Admin\BannerController;
  use App\Http\Controllers\Admin\BrandController;
  use App\Http\Controllers\Admin\CategoryController;
  use App\Http\Controllers\Admin\CouponController;
  use App\Http\Controllers\Admin\MessageController;
  use App\Http\Controllers\Admin\NotificationController;
  use App\Http\Controllers\Admin\OrderController;
  use App\Http\Controllers\Admin\PostController;
  use App\Http\Controllers\Admin\PostTagController;
  use App\Http\Controllers\Admin\ProductController;
  use App\Http\Controllers\Admin\RoleController;
  use App\Http\Controllers\Admin\ShippingController;
  use App\Http\Controllers\Admin\UsersController;
  use Illuminate\Support\Facades\Route;

// Backend section start
  Route::get('/', [AdminController::class, 'index'])->name('admin');
// user route
  Route::resource('users', UsersController::class);
// Banner
  Route::resource('banners', BannerController::class);
// Brand
  Route::resource('brands', BrandController::class);
// Profile
  Route::get('/profile', [AdminController::class, 'profile'])->name('admin-profile');
  Route::post('/profile/{id}', [AdminController::class, 'profileUpdate'])->name('profile-update');
// Category
  Route::resource('/categories', CategoryController::class);
// Product
  Route::resource('/products', ProductController::class);
// Post tag
  Route::resource('/tags', PostTagController::class);
// Post
  Route::resource('/posts', PostController::class);
// Message
  Route::resource('/messages', MessageController::class);
  Route::get('/messages/five', [AdminController::class, 'messageFive'])->name('messages.five');
// Role
  Route::resource('roles', RoleController::class);
// Shipping
  Route::resource('/shipping', ShippingController::class);
// Coupon
  Route::resource('/coupons', CouponController::class);
  Route::resource('orders', OrderController::class);
// Settings
  Route::get('settings', [AdminController::class, 'settings'])->name('settings');
  Route::post('setting/update', [AdminController::class, 'settingsUpdate'])->name('settings.update');
// Notification
  Route::get('/notification/{id}', [NotificationController::class, 'show'])->name('admin.notification');
  Route::get('/notifications', [NotificationController::class, 'index'])->name('all.notification');
  Route::delete('/notification/{id}', [NotificationController::class, 'delete'])->name('notification.delete');
  //Filemanager
