<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\CategoryPost;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
//                                       FRONT-END
// Home
Route::get('/', function () {
    return view('layout');
});
Route::get('/trang-chu', [HomeController::class, 'index']);

//Danh-muc-san-pham (HOME)
Route::get('/danh-muc-san-pham/{category_id}', [CategoryProduct::class, 'show_category_home']);
//Thuong-hieu-san-pham (HOME)
Route::get('/thuong-hieu-san-pham/{brand_id}', [BrandProduct::class, 'show_brand_home']);
//Chi-tiet-san-pham
Route::get('/chi-tiet-san-pham/{product_id}', [ProductController::class, 'details_product']);

//CART
Route::post('/save-cart', [CartController::class, 'save_cart']);
Route::get('/show_cart', [CartController::class, 'show_cart']);
Route::get('/delete-to-cart/{rowId}', [CartController::class, 'delete_to_cart']);
Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity']);

//CART AJAX
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax']);
Route::post('/update-cart', [CartController::class, 'update_cart']);
Route::get('/gio-hang', [CartController::class, 'gio_hang']);
Route::get('/del-product/{session_id}', [CartController::class, 'del_product']);
Route::get('/del-all-product', [CartController::class, 'del_all_product']);

//COUPON
Route::post('/check-coupon', [CartController::class, 'check_coupon']);



//CHECKOUT
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);
Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout']);
Route::post('/save-checkout-customer', [CheckoutController::class, 'save_checkout_customer']);
Route::get('/payment', [CheckoutController::class, 'payment']);

Route::post('/select-delivery-home', [CheckoutController::class, 'select_delivery_home']);
Route::post('/calculate-fee', [CheckoutController::class, 'calculate_fee']);
Route::get('/del-fee', [CheckoutController::class, 'del_fee']);



//ORDER
Route::post('/order-place', [CheckoutController::class, 'order_place']);


//Login-Customer
Route::post('/add-customer', [CheckoutController::class, 'add_customer']);
Route::post('/login-customer', [CheckoutController::class, 'login_customer']);

//Search
Route::post('/tim-kiem', [HomeController::class, 'search']);

//Send Mail 
Route::get('/send-mail', [HomeController::class, 'sendMail']);


//Post-Category
Route::get('/danh-muc-bai-viet/{post_id}', [PostController::class, 'danh_muc_bai_viet']);
Route::get('/edit-post/{post_id}', [PostController::class, 'editPost']);
Route::get('/bai-viet/{post_id}', [PostController::class, 'bai_viet']);
Route::post('/update-post/{post_id}', [PostController::class, 'updatePost']);

//Gallery
Route::get('/add-gallery/{product_id}', [GalleryController::class, 'add_gallery']);
Route::post('/select-gallery', [GalleryController::class, 'select_gallery']);
Route::post('/insert-gallery/{pro_id}', [GalleryController::class, 'insert_gallery']);
Route::post('/update-gallery-name', [GalleryController::class, 'update_gallery_name']);
Route::post('/delete-gallery', [GalleryController::class, 'delete_gallery']);
Route::post('/update-gallery', [GalleryController::class, 'update_gallery']);


//Comment
Route::post('/send-comment', [ProductController::class, 'send_comment']);
Route::post('/load-comment', [ProductController::class, 'load_comment']);








//                                       BACK-END


// Admin
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);

//Authentication Roles - Admin
Route::get('/register-auth', [AuthController::class, 'register_auth']);
Route::get('/login-auth', [AuthController::class, 'login_auth']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout-auth', [AuthController::class, 'logout_auth']);

//Phân quyền chỉ có Admin or Author mới quản lí các chức năng
// Route::group(['middleware' => 'auth.roles', 'auth.roles' => ['admin', 'author']], function () {

//Category-Product

// Comment
Route::get('/comment', [ProductController::class, 'list_comment']);
Route::post('/allow-comment', [ProductController::class, 'allow_comment']);
Route::post('/reply-comment', [ProductController::class, 'reply_comment']);

Route::get('/add-category-product', [CategoryProduct::class, 'add_category_product']);
Route::get('/all-category-product', [CategoryProduct::class, 'all_category_product']);

Route::post('/save-category-product', [CategoryProduct::class, 'save_category_product']);
Route::get('/edit-category-product/{category_product_id}', [CategoryProduct::class, 'edit_category_product']);
Route::post('/update-category-product/{category_product_id}', [CategoryProduct::class, 'update_category_product']);

Route::get('/delete-category-product/{category_product_id}', [CategoryProduct::class, 'delete_category_product']);

Route::get('/unactive-category-product/{category_product_id}', [CategoryProduct::class, 'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}', [CategoryProduct::class, 'active_category_product']);

//Brand
Route::get('/add-brand-product', [BrandProduct::class, 'add_brand_product']);
Route::get('/all-brand-product', [BrandProduct::class, 'all_brand_product']);

Route::post('/save-brand-product', [BrandProduct::class, 'save_brand_product']);
Route::get('/edit-brand-product/{brand_product_id}', [BrandProduct::class, 'edit_brand_product']);
Route::post('/update-brand-product/{brand_product_id}', [BrandProduct::class, 'update_brand_product']);

Route::get('/delete-brand-product/{brand_product_id}', [BrandProduct::class, 'delete_brand_product']);

Route::get('/unactive-brand-product/{brand_product_id}', [BrandProduct::class, 'unactive_brand_product']);
Route::get('/active-brand-product/{brand_product_id}', [BrandProduct::class, 'active_brand_product']);

//Product
Route::get('/add-product', [ProductController::class, 'add_product']);
Route::get('/all-product', [ProductController::class, 'all_product']);

Route::post('/save-product', [ProductController::class, 'save_product']);
Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);

Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);

Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product']);
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']);


//MANAGE-ORDER
Route::get('/manage-order', [OrderController::class, 'manage_order']);
Route::get('/view-order/{order_code}', [OrderController::class, 'view_order']);

//COUPON
Route::get('/insert-coupon', [CouponController::class, 'insert_coupon']);
Route::get('/list-coupon', [CouponController::class, 'list_coupon']);
Route::get('/delete-coupon/{coupon_id}', [CouponController::class, 'delete_coupon']);
Route::get('/unset-coupon', [CouponController::class, 'unset_coupon']);
Route::post('/insert-coupon-code', [CouponController::class, 'insert_coupon_code']);

//Delivery
Route::get('/delivery', [DeliveryController::class, 'delivery']);
Route::post('/select-delivery', [DeliveryController::class, 'select_delivery']);
Route::post('/insert-delivery', [DeliveryController::class, 'insert_delivery']);
Route::post('/select-feeship', [DeliveryController::class, 'select_feeship']);
Route::post('/update-delivery', [DeliveryController::class, 'update_delivery']);

//Checkout
Route::post('/confirm_order', [CheckoutController::class, 'confirm_order']);

//Slider 
Route::get('/manage-slider', [SliderController::class, 'manage_slider']);
Route::get('/add-slider', [SliderController::class, 'add_slider']);
Route::post('/insert-slider', [SliderController::class, 'insert_slider']);

Route::get('/unactive-slide/{slider_id}', [SliderController::class, 'unactive_slide']);
Route::get('/active-slide/{slider_id}', [SliderController::class, 'active_slide']);

Route::get('/delete-slide/{slider_id}', [SliderController::class, 'delete_slide']);

//ORDER-Hàng tồn
Route::post('/update-order-qty', [OrderController::class, 'update_order_qty']);
Route::post('/update-qty', [OrderController::class, 'update_qty']);
Route::get('/delete-order/{order_code}', [OrderController::class, 'order_code']);

// //Authentication Roles - Admin
// Route::get('/register-auth', [AuthController::class, 'register_auth']);
// Route::get('/login-auth', [AuthController::class, 'login_auth']);
// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);
// Route::get('/logout-auth', [AuthController::class, 'logout_auth']);

//Phân quyền chỉ có Admin or Author mới quản lí các chức năng

Route::group(['middleware' => 'auth.roles', 'auth.roles' => ['admin', 'author']], function () {
    //User

    Route::get('/add-users', [UserController::class, 'add_users']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/delete-user-roles/{admin_id}', [UserController::class, 'delete_user_roles']);
    Route::post('/store-users', [UserController::class, 'store_users']);
    Route::post('/assign-roles', [UserController::class, 'assign_roles']);
});

//Category-Post
Route::get('/add-category-post', [CategoryPost::class, 'add_category_post']);
Route::get('/all-category-post', [CategoryPost::class, 'all_category_post']);
Route::get('/delete-category-post/{cate_id}', [CategoryPost::class, 'delete_category_post']);
Route::get('/edit-category-post/{category_post_id}', [CategoryPost::class, 'edit_category_post']);
Route::post('/save-category-post', [CategoryPost::class, 'save_category_post']);
Route::post('/update-category-post/{cate_id}', [CategoryPost::class, 'update_category_post']);

// Post
Route::get('/add-post', [PostController::class, 'add_post']);
Route::get('/all-post', [PostController::class, 'all_post']);
Route::post('/save-post', [PostController::class, 'save_post']);
Route::get('/delete-post/{post_id}', [PostController::class, 'delete_post']);


// });
// Không để middleware vì có thể chuyển sang user
Route::get('/impersonate/{admin_id}', [UserController::class, 'impersonate']);
Route::get('/impersonate-destroy', [UserController::class, 'impersonate_destroy']);
 


// Route::get('users', [UserController::class, 'index'])
//     ->name('Users')
//     ->middleware(['roles']); 
