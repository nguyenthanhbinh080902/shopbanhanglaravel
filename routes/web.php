<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Frontend
Route::get('/', [HomeController::class, 'index']);
Route::get('/trang-chu', [HomeController::class, 'index'])->name('/trang-chu');
Route::get('/tim-kiem', [HomeController::class, 'tim_kiem'])->name('/tim-kiem');

// Danh mục sản phẩm
Route::get('/danh-muc-san-pham/{category_slug}', [HomeController::class, 'show_category_home'])->name('/danh-muc-san-pham');
Route::get('/thuong-hieu-san-pham/{brand_id}', [HomeController::class, 'show_brand_home'])->name('/thuong-hieu-san-pham');
Route::get('/chi-tiet-san-pham/{product_id}', [HomeController::class, 'details_product'])->name('/chi-tiet-san-pham');

// Backend
Route::get('/admin', [AdminController::class, 'index'])->name('/login-admin');
Route::get('/dashboard', [AdminController::class, 'show_dashboard'])->name('/dashboard');
Route::post('/admin-dashboard', [AdminController::class, 'dashboard'])->name('/admin-dashboard');
Route::get('/logout', [AdminController::class, 'logout'])->name('/logout');

//CategoryProduct
Route::group(['middleware' => 'auth.roles'], function(){
    Route::get('/add-category-product', [CategoryProduct::class, 'add_category_product'])->name('/add-category-product');
    Route::get('/all-category-product', [CategoryProduct::class, 'all_category_product'])->name('/all-category-product');
    Route::post('/save-category-product', [CategoryProduct::class, 'save_category_product'])->name('/save-category-product');
    Route::get('/unactive-category-product/{category_product_id}', [CategoryProduct::class, 'unactive_category_product'])->name('/unactive-category-product');
    Route::get('/active-category-product/{category_product_id}', [CategoryProduct::class, 'active_category_product'])->name('/active-category-product');
    Route::get('/edit-category-product/{category_product_id}', [CategoryProduct::class, 'edit_category_product'])->name('/edit-category-product');
    Route::get('/delete-category-product/{category_product_id}', [CategoryProduct::class, 'delete_category_product'])->name('/delete-category-product');
    Route::post('/update-category-product/{category_product_id}', [CategoryProduct::class, 'update_category_product'])->name('/update-category-product');
});
//BrandController
Route::group(['middleware' => 'auth.roles'], function(){
    Route::get('/add-brand-product', [BrandProduct::class, 'add_brand_product'])->name('/add-brand-product');
    Route::get('/all-brand-product', [BrandProduct::class, 'all_brand_product'])->name('/all-brand-product');
    Route::post('/save-brand-product', [BrandProduct::class, 'save_brand_product'])->name('/save-brand-product');
    Route::get('/unactive-brand-product/{brand_product_id}', [BrandProduct::class, 'unactive_brand_product'])->name('/unactive-brand-product');
    Route::get('/active-brand-product/{brand_product_id}', [BrandProduct::class, 'active_brand_product'])->name('/active-brand-product');
    Route::get('/edit-brand-product/{brand_product_id}', [BrandProduct::class, 'edit_brand_product'])->name('/edit-brand-product');
    Route::get('/delete-brand-product/{brand_product_id}', [BrandProduct::class, 'delete_brand_product'])->name('/delete-brand-product');
    Route::post('/update-brand-product/{brand_product_id}', [BrandProduct::class, 'update_brand_product'])->name('/update-brand-product');
});

//ProductController
Route::group(['middleware' => 'auth.roles'], function(){
    Route::get('/add-product', [ProductController::class, 'add_product'])->name('/add-product');
    Route::get('/all-product', [ProductController::class, 'all_product'])->name('/all-product');
    Route::post('/save-product', [ProductController::class, 'save_product'])->name('/save-product');
    Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product'])->name('/unactive-product');
    Route::get('/active-product/{product_id}', [ProductController::class, 'active_product'])->name('/active-product');
    Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product'])->name('/edit-product');
    Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product'])->name('/delete-product');
    Route::post('/update-product/{product_id}', [ProductController::class, 'update_product'])->name('/update-product');
});
//Slider 

Route::group(['middleware' => 'auth.roles'], function(){
    Route::get('/add-slider', [SliderController::class, 'add_slider'])->name('/add-slider');
    Route::get('/all-slider', [SliderController::class, 'all_slider'])->name('/all-slider');
    Route::post('/save-slider', [SliderController::class, 'save_slider'])->name('/save-slider');
    Route::get('/unactive-slider/{slider_id}', [SliderController::class, 'unactive_slider'])->name('/unactive-slider');
    Route::get('/active-slider/{slider_id}', [SliderController::class, 'active_slider'])->name('/active-slider');
    Route::get('/edit-slider/{slider_id}', [SliderController::class, 'edit_slider'])->name('/edit-slider');
    Route::get('/delete-slider/{slider_id}', [SliderController::class, 'delete_slider'])->name('/delete-slider');
    Route::post('/update-slider/{slider_id}', [SliderController::class, 'update_slider'])->name('/update-slider');
});


// Cart ajax
Route::group(['middleware' => 'admin.roles'], function(){
    Route::get('/delete-to-cart/{rowId}', [CartController::class, 'delete_to_cart'])->name('/delete-to-cart');
    Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity'])->name('/update-cart-quantity');
    Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax'])->name('/add-cart-ajax');
    Route::get('/show-cart-ajax', [CartController::class, 'show_cart_ajax'])->name('/show-cart-ajax');
    Route::post('/update-cart-ajax', [CartController::class, 'update_cart_ajax'])->name('/update-cart-ajax');
    Route::get('/delete-cart-ajax/{session_id}', [CartController::class, 'delete_cart_ajax'])->name('/delete-cart-ajax');
    Route::get('/delete-all-cart-ajax', [CartController::class, 'delete_all_cart_ajax'])->name('/delete-all-cart-ajax');
    Route::post('/check-coupon', [CartController::class, 'check_coupon'])->name('/check-coupon');
    Route::get('/delete-coupon-cart-ajax', [CartController::class, 'delete_coupon_cart_ajax'])->name('/delete-coupon-cart-ajax');
});

//Checkout
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout'])->name('/login-checkout');
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout'])->name('/logout-checkout');
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('/checkout');
Route::post('/add-customer', [CheckoutController::class, 'add_customer'])->name('/add-customer');
Route::post('/save-checkout-customer', [CheckoutController::class, 'save_checkout_customer'])->name('/save-checkout-customer');
Route::post('/login-customer', [CheckoutController::class, 'login_customer'])->name('/login-customer');
Route::get('/payment', [CheckoutController::class, 'payment'])->name('/payment');
Route::post('/order-place', [CheckoutController::class, 'order_place'])->name('/order-place');
Route::post('/calculate-fee', [CheckoutController::class, 'calculate_fee'])->name('/calculate-fee');
Route::post('/select-delivery-home', [CheckoutController::class, 'select_delivery_home'])->name('/select-delivery-home');
Route::get('/delete-fee', [CheckoutController::class, 'delete_fee'])->name('/delete-fee');
Route::post('/confirm-order',[CheckoutController::class, 'confirm_order'])->name('/confirm-order');

// order
Route::group(['middleware' => 'admin.roles'], function(){
    Route::get('/manage-order', [OrderController::class, 'manage_order'])->name('/manage-order');
    Route::get('/view-order/{order_code}', [OrderController::class, 'view_order'])->name('/view-order');
    Route::get('/print-order', [OrderController::class, 'print_order'])->name('/print-order');
    Route::post('/update-order-quantity', [OrderController::class, 'update_order_quantity'])->name('/update-order-quantity');
    Route::post('/update-quantity', [OrderController::class, 'update_quantity'])->name('/update-quantity');
});
// Coupon
Route::group(['middleware' => 'auth.roles'], function(){
    Route::get('/add-coupon', [CouponController::class, 'add_coupon'])->name('/add-coupon');
    Route::get('/all-coupon', [CouponController::class, 'all_coupon'])->name('/all-coupon');
    Route::post('/save-coupon', [CouponController::class, 'save_coupon'])->name('/save-coupon');
    Route::get('/edit-coupon/{coupon_id}', [CouponController::class, 'edit_coupon'])->name('/edit-coupon');
    Route::get('/delete-coupon/{coupon_id}', [CouponController::class, 'delete_coupon'])->name('/delete-coupon');
    Route::post('/update-coupon/{coupon_id}', [CouponController::class, 'update_coupon'])->name('/update-coupon');
});

// Login facebook
Route::get('/login-facebook', [AdminController::class, 'login_facebook'])->name('/login-facebook');
Route::get('/admin/callback', [AdminController::class, 'callback_facebook'])->name('/callback-facebook');

// Delivery
Route::group(['middleware' => 'admin.roles'], function(){
    Route::get('/delivery', [DeliveryController::class, 'delivery'])->name('/delivery');
    Route::post('/select-delivery', [DeliveryController::class, 'select_delivery'])->name('/select-delivery');
    Route::post('/insert-delivery', [DeliveryController::class, 'insert_delivery'])->name('/insert-delivery');
    Route::post('/select-feeship', [DeliveryController::class, 'select_feeship'])->name('/select-feeship');
    Route::post('/update-delivery', [DeliveryController::class, 'update_delivery'])->name('/update-delivery');
});

// Authentication roles
Route::get('/register-auth', [AuthController::class, 'register_auth'])->name('/register-auth');
Route::post('/register', [AuthController::class, 'register'])->name('/register');
Route::get('/login-auth', [AuthController::class, 'login_auth'])->name('/login-auth');
Route::post('/login', [AuthController::class, 'login'])->name('/login');
Route::get('/logout-auth', [AuthController::class, 'logout_auth'])->name('/logout-auth');

// UserController
Route::group(['middleware' => 'admin.roles'], function(){
    Route::get('/add-users', [UserController::class, 'add_users'])->name('/add-users');
    Route::get('/all-users', [UserController::class, 'all_users'])->name('/all-users');
    Route::post('/store-users', [UserController::class, 'store_users'])->name('/store-users');
    Route::post('/assign-roles', [UserController::class, 'assign_roles'])->name('/assign-roles');
    Route::get('/delete-user-roles/{admin_id}', [UserController::class, 'delete_user_roles'])->name('/delete-user-roles');
    Route::get('/impersionate/{admin_id}', [UserController::class, 'impersionate'])->name('/impersionate');

  
});
