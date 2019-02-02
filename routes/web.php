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

Route::get('/', 'HomeController@index')->name('home');



// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@authenticate')->name('login.submit');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('loginSA', 'Auth\LoginController@showLoginSAForm')->name('login');
Route::post('loginSA','Auth\LoginController@authenticateSA')->name('loginSA.submit');

// Registration Routes...
Route::prefix('register')->group(function(){
    Route::middleware(['guest'])->group(function(){
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
    Route::get('superAdmin/home','SuperAdminController@home')->name('superAdmin.home');
    Route::get('superAdmin/invitar','SuperAdminController@invite')->name('superAdmin.invite');

    //League
    Route::get('superAdmin/league','leagueController@create')->name('league.create');

    //Club
    Route::get('superAdmin/club','ClubController@create')->name('club.create');
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
    Route::group(['prefix' => 'mister'],function(){
        Route::get('/home','misterController@home')->name('mister.home');
        Route::get('/tactica','misterController@tactica')->name('mister.tactica');

        Route::get('/calendar','misterController@calendar')->name('mister.calendar');

        //Partido
        Route::get('/partido/{id}','MatchController@show')->name('mister.start.partido');
        Route::post('/match','MatchController@create')->name('mister.create.match');
        Route::post('/match/{id}/changePlayer','MatchController@changePlayer')->name('match.changePlayer');
        Route::post('/match/{id}/updateMinutes','MatchController@updateMinutes')->name('match.updateMinutes');

        //Equipo
        Route::get('/equipo','teamController@show')->name('mister.equipo');
        Route::post('/player','playerController@create')->name('mister.create.player');

    });
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
Route::get('/clubRegister','ClubController@register')->name('club.register');