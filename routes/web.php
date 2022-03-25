<?php

use App\Http\Controllers\Cart_controllers;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\layoutControllers;
use App\http\Controllers\Controller_Login;
use App\Http\Controllers\EmailControllers;
use App\Http\Controllers\LoadControllers;
use App\Http\Controllers\ProductControllers;

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
// test view
// Route::view('/view','pages.thank');
// admin route
Route::get('/add-category', [ProductControllers::class, 'add_cate']);
Route::get('/edit-category', [ProductControllers::class, 'edit_catalog']);
Route::post('/handle-edit-catalog', [ProductControllers::class, 'handle_edit_catalog']);
Route::delete('/delete-category', [ProductControllers::class, 'delete_catalog']);
Route::get('/show-category', [ProductControllers::class, 'show_cate']);

Route::get('/add-product', [ProductControllers::class, 'add_product']);
Route::get('/edit-product', [ProductControllers::class, 'edit_product']);
Route::delete('/delete-product', [ProductControllers::class, 'delete_product']);
Route::get('/show-product', [ProductControllers::class, 'show_product']);
Route::get('/add-coupon', [ProductControllers::class, 'add_coupon']);
Route::get('/show-coupon', [ProductControllers::class, 'show_coupon']);
Route::delete('/delete-coupon', [ProductControllers::class, 'delete_coupon']);

Route::get('/management-order', [ProductControllers::class, 'manage_order']);
Route::get('/view-order', [ProductControllers::class, 'manage_view_order']);
Route::post('/accept-order', [ProductControllers::class, 'accept_order']);

// admin route handle




Route::post('/handle-add-product', [ProductControllers::class, 'handle_product']);
Route::put('/handle-edit-product', [ProductControllers::class, 'handle_edit_product']);
Route::post('/handle-add-coupon', [ProductControllers::class, 'handle_coupon']);

// controller-view layoutcontroller
Route::get('/', [layoutControllers::class, 'Home']);
Route::get('/dashboard', [layoutControllers::class, 'Dashboard'])->middleware('Auth_admin');
Route::get('/load-data', [layoutControllers::class, 'Load_more']);
Route::get('/load-data-sale', [layoutControllers::class, 'Load_more_sale']);
Route::get('/load-data-lastest', [layoutControllers::class, 'Load_more_lastest']);


// controller-view loadcontroller
Route::get('/my-account', [LoadControllers::class, 'User_data']);
Route::get('/product-detail', [LoadControllers::class, 'Load_product_detail']);

Route::get('/Ban', [LoadControllers::class, 'Load_product_Ban']);
Route::get('/ban-hoc-sinh', [LoadControllers::class, 'Load_ban_hocsinh']);
Route::get('/ban-van-phong', [LoadControllers::class, 'Load_ban_vanphong']);
Route::get('/ban-an', [LoadControllers::class, 'Load_ban_an']);

Route::get('/Ghe', [LoadControllers::class, 'Load_product_Ghe']);
Route::get('/ghe-van-phong', [LoadControllers::class, 'Load_ghe_vanphong']);
Route::get('/ghe-lanh-dao', [LoadControllers::class, 'Load_ghe_lanhdao']);
Route::get('/ghe-gaming', [LoadControllers::class, 'Load_ghe_gaming']);

Route::get('/Tu', [LoadControllers::class, 'Load_product_Tu']);
Route::get('/tu-sach-van-phong', [LoadControllers::class, 'Load_tu_sachvanphong']);
Route::get('/tu-dau-giuong', [LoadControllers::class, 'Load_tu_daugiuong']);

Route::get('/SOFA', [LoadControllers::class, 'Load_product_SOFA']);
Route::get('/bo-sofa', [LoadControllers::class, 'Load_bo_sofa']);

Route::get('/search', [LoadControllers::class, 'Search']);
Route::get('/order-tracker', [LoadControllers::class, 'Load_tracker'])->middleware('Auth_checkout');
Route::post('/view-order', [LoadControllers::class, 'Handle_tracker']);

// add cart
Route::post('/add-to-cart', [Cart_controllers::class, 'Add_cart']);
Route::get('/view-cart', [Cart_controllers::class, 'View_cart']);
Route::get('/remove', [Cart_controllers::class, 'Remove']);

// check-out form
Route::get('/checkout-form', [LoadControllers::class, 'Load_form'])->middleware('Auth_checkout');
Route::post('/handle-province', [LoadControllers::class, 'handle_province']);
Route::post('/handle-giftcode', [LoadControllers::class, 'check_gitfcode']);
Route::post('/handle-order', [LoadControllers::class, 'handle_order']);

// user login controller
Route::get('/login-account', [layoutControllers::class, 'Login']);
Route::get('/register-account', [layoutControllers::class, 'Register']);

Route::get('/view-history', [layoutControllers::class, 'view_history']);
Route::get('/view-details', [layoutControllers::class, 'view_details']);
Route::get('/view-giftcode', [layoutControllers::class, 'view_giftcode']);

// check login and register account
Route::post('/check-login-user', [Controller_Login::class, 'login_user']);
Route::post('/check-register-user', [Controller_Login::class, 'register_user']);
// logout account
Route::get('/logout-user', [Controller_Login::class, 'logout_user']);
Route::get('/logout', [Controller_Login::class, 'Logout_admin']);
// admin login view
Route::get('/admin-login', [layoutControllers::class, 'Admin_login']);
Route::get('/admin-register', [layoutControllers::class, 'Admin_register']);
// handle login and register admin
Route::post('/handle-register-admin', [Controller_Login::class, 'handle_register_admin']);
Route::post('/handle-login-admin', [Controller_Login::class, 'handle_login_admin']);
Route::post('/update-password', [Controller_Login::class, 'update_passwd']);
