<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm');

Route::middleware(['auth'])->group(function () {
    Route::get('/inicio', 'HomeController@index')->name('home');
    
    Route::get('/dados-cadastrais', 'DadosCadastraisController@index')->name('dados-cadastrais.index');
    Route::get('/dados-cadastrais/importar', 'DadosCadastraisController@importar')->name('dados-cadastrais.importar');
    Route::post('/dados-cadastrais/importar', 'DadosCadastraisController@importarPlanilha')->name('dados-cadastrais.importar-planilha');


    Route::get('/xml', 'XMLController@index')->name('xml.importar');
    Route::post('/xml/importar', 'XMLController@importar')->name('xml.importar-xml');

    Route::get('/trocar-senha', 'HomeController@trocarSenha')->name('trocar-senha');
    Route::post('/alterar-senha', 'HomeController@alterarSenha')->name('alterar-senha');

    Route::get('/notas', 'NotasController@index')->name('notas.index');
});