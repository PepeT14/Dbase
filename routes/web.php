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
});



// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@authenticate')->name('login.submit');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::prefix('register')->group(function(){
    Route::get('superAdminRegister','Auth\SuperAdmin\SuperAdminRegisterController@showSuperAdminRegister')->name('superAdmin.register');
    Route::post('superAdminRegister','Auth\SuperAdmin\SuperAdminRegisterController@create')->name('superAdmin.submit');
    Route::get('adminRegister/{club}/','Auth\Admin\AdminRegisterController@showAdminRegister');
    Route::post('adminRegister','Auth\Admin\AdminRegisterController@registerAdmin')->name('admin.submit');
    Route::get('misterRegister/{team}','Auth\Mister\MisterRegisterController@showMisterRegister');
    Route::post('misterRegister','Auth\Mister\MisterRegisterController@registerMister')->name('mister.submit');
    Route::get('tutorRegister','Auth\Tutor\TutorRegisterController@showTutorRegister');
    Route::post('tutorRegister','Auth\Tutor\TutorRegisterController@registerTutor');
    Route::get('playerRegister','Auth\Player\PlayerRegisterController@showPlayerRegister');
    Route::post('playerRegister','Auth\Player\PlayerRegisterController@registerPlayer');
});

//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');

//SuperAdmin
Route::group(['middleware' => ['auth:superAdmin']],function(){
    Route::get('superAdmin/home','SuperAdminController@home')->name('superAdmin.home');
    Route::get('superAdmin/invitar','SuperAdminController@invite')->name('superAdmin.invite');

    //League
    Route::get('superAdmin/league','leagueController@create')->name('league.create');

    //Club
    Route::get('superAdmin/club','clubController@create')->name('club.create');
});

//Admin
Route::group(['middleware' => ['auth:admin']],function(){
   Route::get('/admin/home','adminController@home')->name('admin.home');


    //Material
    Route::get('admin/material/create','adminController@createMaterial')->name('material.create');
    Route::get('admin/material','adminController@material')->name('admin.material');

    //Equipos
    Route::get('admin/teams','adminController@teams')->name('admin.teams');
    Route::get('admin/teams/create','teamController@create')->name('team.create');

    //Entrenadores
    Route::get('admin/invitar','adminController@misterInvite')->name('mister.invite');
});

//Mister
Route::group(['middleware' => ['auth:mister']],function(){
   Route::get('/mister/home','misterController@home')->name('mister.home');
});