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
    if (Auth::check()) {
        return redirect('dashboard');
    } else {
        return redirect('login');
    }
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('makeLogin');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('dashboard', 'DashboardController');
    Route::resource('configs', 'ConfigsController');

    Route::resource('equipes', 'EquipesController');
    Route::resource('equipes.nadadores', 'Equipes\NadadoresController');

    Route::resource('competicoes', 'CompeticoesController');
    Route::resource('competicoes.provas', 'Competicoes\ProvasController');

    Route::prefix('admin')->group(function () {
        Route::resource('groups', 'GroupsController');
        Route::resource('api-integrations', 'ApiIntegrationsController');
        Route::resource('users', 'UsersController');
    });
});
