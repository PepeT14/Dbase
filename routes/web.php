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

Route::get('/', 'HomeController@index');



// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@authenticate')->name('login.submit');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::prefix('register')->group(function(){
    Route::middleware(['guest'])->group(function(){
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
    Route::get('superAdmin/home','superAdminController@home')->name('superAdmin.home');
    Route::get('superAdmin/invitar','superAdminController@invite')->name('superAdmin.invite');

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
    Route::get('admin/material/remove/{id}','adminController@deleteMaterial')->name('material.remove');
    Route::get('admin/material/add/{id}','adminController@addMaterial')->name('material.add');

    //Equipos
    Route::get('admin/teams','adminController@teams')->name('admin.teams');
    Route::get('admin/teams/create','teamController@create')->name('team.create');

    //Entrenadores
    Route::get('admin/invitar/{team}','adminController@misterInvite')->name('mister.invite');

    //Ligas no federativas
    Route::get('admin/ligasNof','adminController@leaguesNof')->name('admin.leaguesNof');
    Route::get('admin/ligasNof/create','leaguesNofController@create')->name('leagueNof.create');

    //Instalaciones
    Route::get('admin/instalaciones','adminController@instalaciones')->name('admin.instalaciones');
    Route::get('admin/instalaciones/create','instalacionesController@create')->name('instalacion.create');
});

//Mister
Route::group(['middleware' => ['auth:mister']],function(){
   Route::get('/mister/home','misterController@home')->name('mister.home');
   Route::get('/mister/tactica','misterController@tactica')->name('mister.tactica');
});

//Player
Route::group(['middleware'=>['auth:player']],function(){
   Route::get('/player/home','playerController@home')->name('player.home');
});

//Tutor
Route::group(['middleware' => ['auth:tutor']],function(){
   Route::get('/tutor/home','tutorController@home')->name('tutor.home');
});

//PUBLIC
Route::get('/profile/{mister}','misterController@showProfile')->name('mister.profile');
Route::get('/league/{id}','leagueController@home')->name('league.home');
Route::get('/team/{id}','teamController@home')->name('team.home');

