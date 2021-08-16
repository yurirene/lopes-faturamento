<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm');

Route::middleware(['auth', 'usuario-ativo'])->group(function () {
    Route::get('/inicio', 'HomeController@index')->name('home');

    Route::resource('/empresa', EmpresaController::class)->middleware('can:is_admin');
    Route::get('/empresa/{empresa}/status', 'EmpresaController@status')->name('empresa.status');
    
    Route::resource('/documentos', DocumentosController::class)->except('destroy');
    Route::get('/documentos/{documento}/delete', 'DocumentosController@delete')->name('documentos.delete')->middleware('can:is_admin');

    Route::resource('/tipos', TipoController::class)->except('destroy')->middleware('can:is_admin');
    Route::get('/tipos/{tipo}/delete', 'TipoController@delete')->name('tipos.delete')->middleware('can:is_admin');

    Route::get('/trocar-senha', 'HomeController@trocarSenha')->name('trocar-senha');
    Route::post('/alterar-senha', 'HomeController@alterarSenha')->name('alterar-senha');

});