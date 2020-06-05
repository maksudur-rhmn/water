<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

// FaqController

 Route::get('/faq', 'FaqController@index')->name('faq_index')->middleware('verified');
 Route::post('/faq/post', 'FaqController@faq_insert')->name('faq_insert')->middleware('verified');
 Route::get('/faq/delete/{faq_id}', 'FaqController@faq_delete')->name('faq_delete')->middleware('verified');
 Route::get('/faq/edit/{faq_id}', 'FaqController@faq_edit')->middleware('verified');
 Route::post('/faq/update', 'FaqController@faq_update')->middleware('verified');
 Route::get('/faq/restore/{faq_id}', 'FaqController@faq_restore')->middleware('verified');
 Route::get('/faq/permanentDelete/{faq_id}', 'FaqController@faq_permanentDelete')->middleware('verified');

// END FaqController


// ProfileController
Route::get('/edit/profile', 'ProfileController@changepassword')->name('edit_profile');
Route::post('/edit/profile/password', 'ProfileController@passwordpost')->name('passwordpost');
// End ProfileController


// CategoryController
Route::resource('category', 'CategoryController');
// ENd CategoryController

// ProductController

Route::resource('products', 'ProductController');

// END ProductController

// FrontendController

Route::get('/', 'FrontendController@index')->name('frontend.index');
Route::get('/about', 'FrontendController@about')->name('frontend.about');
Route::get('/front/faq', 'FrontendController@front_faq')->name('frontend.faq');
// END FrontendController

// GitHubController

Route::get('login/github', 'GithubController@redirectToProvider');
Route::get('login/github/callback', 'GithubController@handleProviderCallback');

// END GitHubController


// CustomerController

Route::get('/home/customer', 'CustomerController@index');
Route::get('/download/{order_id}/pdf', 'CustomerController@downloadpdf')->name('download.pdf');
Route::get('/send/{order_id}/text', 'CustomerController@sendtext')->name('send.text');
Route::get('/search', 'CustomerController@search');
Route::post('/add/review', 'CustomerController@addreview')->name('add.review');

// CustomerController


// CartController

Route::post('/cart/update', 'CartController@cartUpdate')->name('cart.custom.update');
Route::get('/cart/{cart_id}/delete', 'CartController@delete')->name('cart.delete');
Route::get('/cart/{coupon_name}', 'CartController@index');
Route::resource('cart', 'CartController');

// CartController


// ShopController

Route::get('/shop', 'ShopController@index');

// END ShopController



// CouponController

Route::resource('coupon', 'CouponController');

// END CouponController

// CheckoutController 
    Route::get('checkout', 'CheckoutController@index')->name('checkout.index'); 
    Route::post('checkout', 'CheckoutController@index')->name('checkout.index');
    Route::post('order', 'CheckoutController@order')->name('order.store');
    Route::post('/citylist', 'CheckoutController@getcitylist');
// END CheckoutController


Route::get('stripe', 'StripePaymentController@stripe');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');

// PayPal
  


Route::post('/create-payment', 'PaymentController@create')->name('create-payment');
Route::get('/execute-payment', 'PaymentController@execute')->name('execute-payment');
Route::get('/cancel', 'PaymentController@cancel')->name('cancel-payment');