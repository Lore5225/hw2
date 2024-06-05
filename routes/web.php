<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', 'App\Http\Controllers\HomeController@checkAuth');
Route::get('index', 'App\Http\Controllers\HomeController@checkAuth');
Route::get('indexlogged', 'App\Http\Controllers\HomeLoggedController@checkAuth');
Route::get('/youtubeAPIRequest', 'App\Http\Controllers\HomeController@ApiYoutube');
Route::get('loginpage', 'App\Http\Controllers\LoginController@checkAuth');
Route::post('loginpage', 'App\Http\Controllers\LoginController@login');
Route::get('registractionpage', 'App\Http\Controllers\RegistractionController@checkAuth');
Route::post('registractionpage', 'App\Http\Controllers\RegistractionController@Signup');
Route::get('signup/check/{field}', 'App\Http\Controllers\RegistractionController@CheckIfExists');
Route::get('ShoppingPage', 'App\Http\Controllers\ShoppingPageController@checkAuth');
Route::get('/getProduct/{field}', 'App\Http\Controllers\ShoppingPageController@getproduct');
Route::post('/addtocart', 'App\Http\Controllers\CartController@addToCart');
Route::post('/removefromcart', 'App\Http\Controllers\CartController@removeFromCart');
Route::get('ShoppingCart', 'App\Http\Controllers\CartController@viewCart');
Route::post('/getUpdatedCartProducts', 'App\Http\Controllers\CartController@viewUpdatedCart');
Route::get('CheckoutPage', 'App\Http\Controllers\CheckoutController@checkAuth');
Route::post('addOrder', 'App\Http\Controllers\CheckoutController@addOrder')->name('addOrder');
Route::get('ConfirmPage', 'App\Http\Controllers\ConfirmEmailController@ConfirmationEmail')->name('ConfirmPage');
Route::get('ForgotPassword', 'App\Http\Controllers\PasswordResetController@viewReset')->name('viewReset');
Route::get('Profile', 'App\Http\Controllers\ProfileController@checkAuth');
Route::post('sendResetEmail', 'App\Http\Controllers\PasswordResetController@sendResetEmail')->name('sendResetEmail');
Route::get('sendResetEmail', 'App\Http\Controllers\ConfirmEmailController@ConfirmationEmail')->name('sendResetEmail');
Route::get('/reset_password', 'App\Http\Controllers\PasswordResetController@showResetPasswordForm')->name('reset_password');
Route::post('/ResetSubmit', 'App\Http\Controllers\PasswordResetController@resetPassword')->name('ResetSubmit');
Route::get('/getSolution', 'App\Http\Controllers\InformationFromDatabaseController@viewSolution');
Route::get('/getProductInformation', 'App\Http\Controllers\InformationFromDatabaseController@viewProductInformation');

Route::get('logout', function () {
    Session::flush();
    return redirect('index');
});
