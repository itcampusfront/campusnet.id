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

	// Website
	Route::get('/admin/website', 'WebsiteController@index');
	Route::get('/admin/website/activation/{id}', 'WebsiteController@activation');
	Route::post('/admin/website/activate', 'WebsiteController@activate');

	// AJAX
	Route::get('/admin/ajax/show-images', 'QuizController@show_images');
	Route::post('/admin/ajax/upload-image', 'QuizController@upload_image');

	// User
	Route::get('/admin/user', 'UserController@index');
	Route::get('/admin/user/create', 'UserController@create');
	Route::post('/admin/user/store', 'UserController@store');
	Route::get('/admin/user/edit/{id}', 'UserController@edit');
	Route::post('/admin/user/update', 'UserController@update');
	Route::post('/admin/user/delete', 'UserController@delete');

	// Kategori
	Route::get('/admin/kategori', 'KategoriController@index');
	Route::get('/admin/kategori/create', 'KategoriController@create');
	Route::post('/admin/kategori/store', 'KategoriController@store');
	Route::get('/admin/kategori/edit/{id}', 'KategoriController@edit');
	Route::post('/admin/kategori/update', 'KategoriController@update');
	Route::post('/admin/kategori/delete', 'KategoriController@delete');

	// Kelas
	Route::get('/admin/kelas', 'KelasController@index');
	Route::get('/admin/kelas/create', 'KelasController@create');
	Route::post('/admin/kelas/store', 'KelasController@store');
	Route::get('/admin/kelas/detail/{id}', 'KelasController@detail');
	Route::get('/admin/kelas/edit/{id}', 'KelasController@edit');
	Route::post('/admin/kelas/update', 'KelasController@update');
	Route::post('/admin/kelas/delete', 'KelasController@delete');
	Route::post('/admin/kelas/add-topik', 'TopikController@add_topik');
	Route::post('/admin/kelas/update-topik', 'TopikController@update_topik');
	Route::post('/admin/kelas/delete-topik', 'TopikController@delete_topik');
	Route::post('/admin/kelas/sort-topik', 'TopikController@sort_topik');
	Route::post('/admin/kelas/add-konten', 'KontenController@add_konten');
	Route::post('/admin/kelas/edit-konten', 'KontenController@edit_konten');
	Route::post('/admin/kelas/update-konten', 'KontenController@update_konten');
	Route::post('/admin/kelas/delete-konten', 'KontenController@delete_konten');
	Route::post('/admin/kelas/sort-konten', 'KontenController@sort_konten');
	Route::post('/admin/kelas/upload-video', 'KontenController@upload_video');
	Route::post('/admin/kelas/upload-file', 'KontenController@upload_file');

	// Kuis
	Route::get('/admin/kuis', 'QuizController@index');

	// Quiz Generator
	Route::get('/quiz/create', 'QuizController@create');
	Route::post('/quiz/save', 'QuizController@save');
	Route::get('/quiz/edit/{code}', 'QuizController@edit');
	Route::post('/quiz/submit', 'QuizController@submit');

	// Progress
	Route::get('/admin/progress/', 'ProgressController@all');
	Route::get('/admin/progress/{category}', 'ProgressController@index');
	Route::post('/admin/progress/{category}/delete', 'ProgressController@delete');
	Route::post('/admin/progress/tugas/beri-penilaian', 'ProgressController@penilaian_tugas');

	// Pengaturan
	Route::get('/admin/pengaturan/umum', 'SettingController@umum');
	Route::get('/admin/pengaturan/warna', 'SettingController@warna');
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

	// Website
	Route::get('/member/website', 'WebsiteController@index');
	Route::get('/member/website/create', 'WebsiteController@create');
	Route::post('/member/website/store', 'WebsiteController@store');

	// Aktivitas Kelas
	Route::get('/kelas/{permalink}/aktivitas/{id}', 'KelasController@activity');
	Route::get('/kelas/{permalink}/aktivitas/penilaian/kelas', 'PenilaianKelasController@form');
	Route::get('/kelas/{permalink}/aktivitas/penilaian/pengajar', 'PenilaianPengajarController@form');
});

// Guest Capabilities...
Route::group(['middleware' => ['guest']], function(){
	// Home
	Route::get('/', 'DashboardController@home');

	// Check
	Route::get('/check', 'WebsiteController@check');

	// User
	Route::get('/profil', 'UserController@profile');
	Route::post('/profil/update-profil', 'UserController@update_profile');
	Route::post('/profil/update-foto', 'UserController@update_photo');
	Route::post('/profil/update-password', 'UserController@update_password');
	Route::get('/list-kelas', 'KelasController@list');
	Route::get('/riwayat-kelas', 'KelasController@history');
	Route::get('/ganti-password', 'UserController@update_password_form');

	// Kategori
	Route::get('/kategori', 'KategoriController@index');
	Route::get('/kategori/{permalink}', 'KategoriController@detail');

	// Kelas
	Route::get('/kelas', 'KelasController@index');
	Route::get('/kelas/{permalink}', 'KelasController@detail');

	// Pengajar
	Route::get('/pengajar', 'PengajarController@index');
	Route::get('/pengajar/{permalink}', 'KelasController@detail');

	// Quiz Generator
	Route::get('/quiz/embed/{code}', 'QuizController@view');

	// Login dan Recovery Password
	Route::get('/login', 'Auth\LoginController@showLoginForm');
	Route::post('/login', 'Auth\LoginController@login');
	Route::get('/recovery-password', 'Auth\LoginController@showRecoveryPasswordForm');
	Route::post('/recovery-password', 'Auth\LoginController@recoveryPassword');
});