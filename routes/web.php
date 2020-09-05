<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/senha/resetar/{email}', 'PasswordController@passwordReset')->name('senha.resetar');

Route::post('/entrar', 'LoginController@entrar')->name('entrar')->middleware('guest');
Route::get('/sair', 'LoginController@sair')->name('sair')->middleware('auth');

Route::middleware(['auth'])->group(function(){
    
    Route::get('/home', 'HomeController@home')->name('home');

    Route::middleware(['admin'])->group(function(){
        Route::get('/usuarios', 'UserController@usuarios')->name('usuarios');
        Route::get('/usuarios/novo', 'UserController@novo')->name('usuarios.novo');
        Route::post('/usuarios/criar', 'UserController@criar')->name('usuarios.criar');
        Route::get('/usuarios/edicao/{user}', 'UserController@edicao')->name('usuarios.edicao');
        Route::post('/usuarios/editar/{user}', 'UserController@editar')->name('usuarios.editar');
    });
    
});

Route::get('/usuarios/alterar_senha/{token}', 'UserController@alterarSenha')->name('usuarios.alterar_senha');
Route::post('/senha/alterar/{user}', 'PasswordController@alteraSenha')->name('senha.alterar');