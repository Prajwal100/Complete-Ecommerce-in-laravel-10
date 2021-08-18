<?php

  use App\Http\Controllers\Auth\LoginController;
  use App\Http\Controllers\CartController;
  use App\Http\Controllers\FrontendController;
  use App\Http\Controllers\OrderFrontController;
  use App\Http\Controllers\PaypalController;
  use App\Http\Controllers\PostCommentController;
  use App\Http\Controllers\ProductReviewController;
  use App\Http\Controllers\WishlistController;
  use Illuminate\Support\Facades\Auth;
  use Illuminate\Support\Facades\Route;
  use Spatie\Feed\Http\FeedController;
  use UniSharp\LaravelFilemanager\Lfm;

  /*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
  */
  Route::get('feed', FeedController::class)->name("feeds.main");

  Auth::routes();
// Socialite
  Route::get('login/{provider}/', [LoginController::class, 'redirect'])->name('login.redirect');
  Route::get('login/{provider}/callback/', [LoginController::class, 'Callback'])->name('login.callback');


// Frontend Routes
  Route::get('/', [FrontendController::class, 'index'])->name('home');
  Route::get('/about-us', [FrontendController::class, 'aboutUs'])->name('about-us');
  Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
  Route::post('/contact/message', [FrontendController::class, 'messageStore'])->name('contact.store');
  Route::get('product-detail/{slug}', [FrontendController::class, 'productDetail'])->name('product-detail');
  Route::post('/product/search', [FrontendController::class, 'productSearch'])->name('product.search');
  Route::get('/product-cat/{slug}', [FrontendController::class, 'productCat'])->name('product-cat');
  Route::get('/product-brand/{slug}', [FrontendController::class, 'productBrand'])->name('product-brand');
// Cart section
  Route::get('/add-to-cart/{slug}', [CartController::class, 'addToCart'])->name('add-to-cart');
  Route::post('/add-to-cart',
      [CartController::class, 'singleAddToCart'])->name('single-add-to-cart');
  Route::get('cart-delete/{id}', [CartController::class, 'cartDelete'])->name('cart-delete');
  Route::post('cart-update', [CartController::class, 'cartUpdate'])->name('cart.update');

  Route::get('/cart', function () {
    return view('frontend.pages.cart');
  })->name('cart');
  Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
// Wishlist
  Route::get('/wishlist', function () {
    return view('frontend.pages.wishlist');
  })->name('wishlist');
  Route::get('/wishlist/{slug}',
      [WishlistController::class, 'wishlist'])->name('add-to-wishlist');
  Route::get('wishlist-delete/{id}', [WishlistController::class, 'wishlistDelete'])->name('wishlist-delete');
  Route::post('cart/order', [OrderFrontController::class, 'store'])->name('cart.order');
  Route::get('order/pdf/{id}', [OrderFrontController::class, 'pdf'])->name('order.pdf');
  Route::get('/income', [OrderFrontController::class, 'incomeChart'])->name('product.order.income');
  Route::get('/product-grids', [FrontendController::class, 'productGrids'])->name('product-grids');
  Route::get('/product-lists', [FrontendController::class, 'productLists'])->name('product-lists');
  Route::match(['get', 'post'], '/filter', [FrontendController::class, 'productFilter'])->name('shop.filter');
// Order Track
  Route::get('/product/track', [OrderFrontController::class, 'orderTrack'])->name('order.track');
  Route::post('product/track/order', [OrderFrontController::class, 'productTrackOrder'])->name('product.track.order');
// Blog
  Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
  Route::get('/blog-detail/{slug}', [FrontendController::class, 'blogDetail'])->name('blog.detail');
  Route::get('/blog/search', [FrontendController::class, 'blogSearch'])->name('blog.search');
  Route::post('/blog/filter', [FrontendController::class, 'blogFilter'])->name('blog.filter');
  Route::get('blog-cat/{slug}', [FrontendController::class, 'blogByCategory'])->name('blog.category');
  Route::get('blog-tag/{slug}', [FrontendController::class, 'blogByTag'])->name('blog.tag');

// NewsLetter
  Route::post('/subscribe', [FrontendController::class, 'subscribe'])->name('subscribe');

// Product Review
  Route::post('product/{slug}/review', [ProductReviewController::class, 'store'])->name('product.review.store');
  Route::resource('/review', ProductReviewController::class);

// Post Comment
  Route::post('post/{slug}/comment', [PostCommentController::class, 'store'])->name('post-comment.store');
  Route::resource('/comment', PostCommentController::class);
// Coupon
  Route::post('/coupon-store', [FrontendController::class, 'couponStore'])->name('coupon-store');
// Payment
  Route::get('payment', [PayPalController::class, 'payment'])->name('payment');
  Route::get('cancel', [PayPalController::class, 'cancel'])->name('payment.cancel');
  Route::get('payment/success', [PayPalController::class, 'success'])->name('payment.success');

//Filemanager
  Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
  });

  Route::get('/file-manager', function () {
    return view('backend.layouts.file');
  })->name('file-manager')->middleware(['web', 'auth']);
