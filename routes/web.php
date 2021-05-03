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

// Admin Capabilities...
Route::group(['middleware' => ['admin']], function(){
	// Logout
	Route::get('/admin/logout', function(){
	    return redirect('/');
	});
	Route::post('/admin/logout', 'Auth\LoginController@logout');

	// Dashboard
	Route::get('/admin', 'DashboardController@admin');

	// User
	Route::get('/admin/user', 'UserController@index');
	Route::get('/admin/user/create', 'UserController@create');
	Route::post('/admin/user/store', 'UserController@store');
	Route::get('/admin/user/detail/{id}', 'UserController@detail');
	Route::get('/admin/user/edit/{id}', 'UserController@edit');
	Route::post('/admin/user/update', 'UserController@update');
	Route::post('/admin/user/delete', 'UserController@delete');

	// Website
	Route::get('/admin/website', 'WebsiteController@index');
	Route::get('/admin/website/activation/{id}', 'WebsiteController@activation');
	Route::post('/admin/website/activate', 'WebsiteController@activate');
	Route::get('/admin/website/detail/{id}', 'WebsiteController@detail');

	// Fitur
	Route::get('/admin/fitur', 'FiturController@index');
	Route::get('/admin/fitur/create', 'FiturController@create');
	Route::post('/admin/fitur/store', 'FiturController@store');
	Route::get('/admin/fitur/edit/{id}', 'FiturController@edit');
	Route::post('/admin/fitur/update', 'FiturController@update');
	Route::post('/admin/fitur/sort', 'FiturController@sorting');
	Route::post('/admin/fitur/delete', 'FiturController@delete');

	// Artikel
	// Route::get('/admin/artikel', 'ArtikelController@index');

	// Testimoni
	Route::get('/admin/testimoni', 'TestimoniController@index');
	Route::get('/admin/testimoni/create', 'TestimoniController@create');
	Route::post('/admin/testimoni/store', 'TestimoniController@store');
	Route::get('/admin/testimoni/edit/{id}', 'TestimoniController@edit');
	Route::post('/admin/testimoni/update', 'TestimoniController@update');
	Route::post('/admin/testimoni/sort', 'TestimoniController@sorting');
	Route::post('/admin/testimoni/delete', 'TestimoniController@delete');

	// Pengaturan
	Route::get('/admin/pengaturan/umum', 'SettingController@umum');
	Route::post('/admin/pengaturan/update', 'SettingController@update');
});

// Member Capabilities...
Route::group(['middleware' => ['member']], function(){
	
	// Logout
	Route::get('/member/logout', function(){
	    return redirect('/');
	});
	Route::post('/member/logout', 'Auth\LoginController@logout');

	// Dashboard
	Route::get('/member', 'DashboardController@member');

	// Profil
	Route::get('/member/profil', 'UserController@profile');
	Route::post('/member/update-profil', 'UserController@update_profile');

	// Website
	Route::get('/member/website', 'WebsiteController@index');
	Route::get('/member/website/create', 'WebsiteController@create');
	Route::post('/member/website/store', 'WebsiteController@store');
	Route::get('/member/website/detail/{id}', 'WebsiteController@detail');
});

// Guest Capabilities...
Route::group(['middleware' => ['guest']], function(){
	// Home
	Route::get('/', 'DashboardController@home');

	// Check
	Route::get('/check', 'WebsiteController@check');

	// Forbidden
	Route::get('/forbidden', function(){
		return view('error/403');
	});


	Route::get('/artikel', 'ArtikelController@index');
	Route::get('/artikel/{permalink}', 'ArtikelController@detail');

	// Login, Daftar dan Recovery Password
	Route::get('/login', 'Auth\LoginController@showLoginForm');
	Route::post('/login', 'Auth\LoginController@login');
	Route::get('/register', 'Auth\RegisterController@showRegistrationForm');
	Route::post('/register', 'Auth\RegisterController@register');
	// Route::get('/recovery-password', 'Auth\LoginController@showRecoveryPasswordForm');
	// Route::post('/recovery-password', 'Auth\LoginController@recoveryPassword');
});