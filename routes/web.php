<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

Route::get('/login', function(){
    return redirect()->route('login');
});
Route::get('/login-page', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('/register', function(){
    return redirect()->route('register');
});
Route::get('/register-account', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');
//end
// Password Reset Routes...
Route::get('/forget-password', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password-email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password-reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password-reset', 'Auth\ResetPasswordController@reset');
Route::get('/films', 'UserController@show_film')->name('films');
Route::get('/submission', 'UserController@show_submission')->name('submission');
Route::get('/how-this-work', 'UserController@how_this_work')->name('how_this_work');
Route::get('/distribution', 'UserController@distribution')->name('distribution');

Route::prefix('admin')->group(function(){
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/login', 'Admin\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Admin\AdminLoginController@login');
    Route::get('/logout', 'Admin\AdminLoginController@logout')->name('admin.logout');
    //Admin Password Reset Routes...
    Route::get('/forget-password', 'Admin\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'Admin\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password-reset/{token}', 'Admin\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password-reset', 'Admin\AdminResetPasswordController@reset');
    //end
    Route::get('/admin-profile', 'AdminController@admin_profile')->name('admin.profile');
    Route::get('/pages', 'AdminController@admin_pages')->name('admin.pages');
    Route::get('/user-management', 'AdminController@user_management')->name('admin.user_management');
    Route::post('/delete-user', 'AdminController@delete_user')->name('admin.user_delete');
    //change admin info
    Route::post('/change-admin-name', 'AdminController@change_admin_name')->name('admin.change_admin_name');
    Route::post('/change-admin-avatar', 'AdminController@change_avatar')->name('admin.change_avatar');
    Route::post('/change-password', 'AdminController@change_password')->name('admin.change_password');
    Route::post('/change-phone', 'AdminController@change_phone')->name('admin.change_phone');
    Route::post('/change-email', 'AdminController@change_email')->name('admin.change_email');
    //end
    Route::get('/get-page-info', 'PageController@get_page_info')->name('admin.get_page_info');
    Route::post('/edit-term', 'PageController@update_terms')->name('admin.update_terms');
    Route::post('/edit-privacy', 'PageController@update_privacy')->name('admin.update_privacy');
    Route::post('/edit-aboutus', 'PageController@update_aboutus')->name('admin.update_aboutus');
    Route::post('/edit-how-work', 'PageController@update_howitwork')->name('admin.update_howitwork');
});
