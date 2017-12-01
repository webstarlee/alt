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

Route::get('/home', 'HomeController@view_gallery')->name('home');
Route::get('/gallery/{id}', 'HomeController@gallery_show');
Route::get('/profile', 'UserController@view_profile')->name('user.profile.view');
Route::get('/view-selection/{id}', 'HomeController@view_selection');
Route::get('/get-selection_img/{id}', 'HomeController@get_selection_img');
Route::post('/like-images', 'HomeController@like_images');
Route::get('/save-like-status/{id}', 'HomeController@like_status_save');
Route::get('/get-stamp-img/{id}', 'HomeController@get_img_for_stamp');
Route::post('/save_stamps', 'HomeController@save_all_stamps');
//Auth::routes();

Route::prefix('profile')->group(function(){
    Route::post('/change-basic', 'UserController@change_basic')->name('profile.change.basic');
    Route::post('/change-email', 'UserController@change_email')->name('profile.change.email');
    Route::post('/change-avatar', 'UserController@change_avatar')->name('profile.change.avatar');
    Route::post('/change-password', 'UserController@change_password')->name('profile.change.password');
});

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
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
    //gallery
    Route::get('/gallery-management', 'GalleryController@gallery_view')->name('admin.gallery.view');
    Route::get('/gallery-single-view/{id}', 'GalleryController@gallery_view_single')->name('admin.gallery.view.single');
    Route::get('/get-single-category-data/{id}', 'GalleryController@get_single_category');
    Route::get('/get-single-style-data/{id}', 'GalleryController@get_single_style');
    Route::post('/gallery-upload-images', 'GalleryController@gallery_upload_images')->name('admin.gallery.add.images');
    Route::post('/gallery-add-category', 'GalleryController@store_category')->name('admin.gallery.add.category');
    Route::post('/gallery-edit-category', 'GalleryController@update_category')->name('admin.gallery.edit.category');
    Route::post('/gallery-add-style', 'GalleryController@store_style')->name('admin.gallery.add.style');
    Route::post('/gallery-edit-style', 'GalleryController@update_style')->name('admin.gallery.edit.style');
});
