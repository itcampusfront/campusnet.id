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
	Route::get('/admin', 'DashboardController@admin')->name('admin.dashboard');

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

	// Artikel
	Route::get('/admin/artikel', 'ArtikelController@index')->name('admin.artikel.index');
	Route::get('/admin/artikel/create', 'ArtikelController@create')->name('admin.artikel.create');
	Route::post('/admin/artikel/store', 'ArtikelController@store')->name('admin.artikel.store');
	Route::get('/admin/artikel/edit/{id}', 'ArtikelController@edit')->name('admin.artikel.edit');
	Route::post('/admin/artikel/update', 'ArtikelController@update')->name('admin.artikel.update');
	Route::post('/admin/artikel/delete', 'ArtikelController@delete')->name('admin.artikel.delete');
	Route::get('/admin/artikel/images', 'ArtikelController@showImages')->name('admin.artikel.images');

	// Kategori Artikel
	Route::get('/admin/artikel/kategori', 'KategoriArtikelController@index')->name('admin.artikel.kategori.index');
	Route::get('/admin/artikel/kategori/create', 'KategoriArtikelController@create')->name('admin.artikel.kategori.create');
	Route::post('/admin/artikel/kategori/store', 'KategoriArtikelController@store')->name('admin.artikel.kategori.store');
	Route::get('/admin/artikel/kategori/edit/{id}', 'KategoriArtikelController@edit')->name('admin.artikel.kategori.edit');
	Route::post('/admin/artikel/kategori/update', 'KategoriArtikelController@update')->name('admin.artikel.kategori.update');
	Route::post('/admin/artikel/kategori/delete', 'KategoriArtikelController@delete')->name('admin.artikel.kategori.delete');

	// Tag Artikel
	Route::get('/admin/artikel/tag', 'TagController@index')->name('admin.artikel.tag.index');
	Route::get('/admin/artikel/tag/create', 'TagController@create')->name('admin.artikel.tag.create');
	Route::post('/admin/artikel/tag/store', 'TagController@store')->name('admin.artikel.tag.store');
	Route::get('/admin/artikel/tag/edit/{id}', 'TagController@edit')->name('admin.artikel.tag.edit');
	Route::post('/admin/artikel/tag/update', 'TagController@update')->name('admin.artikel.tag.update');
	Route::post('/admin/artikel/tag/delete', 'TagController@delete')->name('admin.artikel.tag.delete');

	// Kontributor Artikel
	Route::get('/admin/artikel/kontributor', 'KontributorController@index')->name('admin.artikel.kontributor.index');
	Route::get('/admin/artikel/kontributor/create', 'KontributorController@create')->name('admin.artikel.kontributor.create');
	Route::post('/admin/artikel/kontributor/store', 'KontributorController@store')->name('admin.artikel.kontributor.store');
	Route::get('/admin/artikel/kontributor/edit/{id}', 'KontributorController@edit')->name('admin.artikel.kontributor.edit');
	Route::post('/admin/artikel/kontributor/update', 'KontributorController@update')->name('admin.artikel.kontributor.update');
	Route::post('/admin/artikel/kontributor/delete', 'KontributorController@delete')->name('admin.artikel.kontributor.delete');

	// Fitur
	Route::get('/admin/fitur', 'FiturController@index');
	Route::get('/admin/fitur/create', 'FiturController@create');
	Route::post('/admin/fitur/store', 'FiturController@store');
	Route::get('/admin/fitur/edit/{id}', 'FiturController@edit');
	Route::post('/admin/fitur/update', 'FiturController@update');
	Route::post('/admin/fitur/sort', 'FiturController@sorting');
	Route::post('/admin/fitur/delete', 'FiturController@delete');

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

	// Artikel
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