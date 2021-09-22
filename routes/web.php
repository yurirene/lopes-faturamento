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
    Route::get('/notas/{nota}/itens', 'NotasController@itens')->name('notas.itens');
    Route::get('/notas/{nota}/edit', 'NotasController@edit')->name('notas.edit');
    Route::put('/notas/{nota}/update', 'NotasController@update')->name('notas.update');
    Route::get('/notas/{nota}/detele', 'NotasController@delete')->name('notas.delete');

    Route::resource('clientes', 'ClienteController')->except(['destroy']);
    Route::get('/clientes/{cliente}/delete', 'ClienteController@delete')->name('clientes.delete');

    Route::resource('industrias', 'IndustriaController')->except(['destroy']);
    Route::get('/industrias/{industria}/delete', 'IndustriaController@delete')->name('industrias.delete');
    


});