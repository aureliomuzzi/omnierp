<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\UserController;

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/', function () {
        return view('home');
    });

    Route::resource('pessoas', PessoaController::class);
    Route::resource('enderecos', EnderecoController::class);
    Route::resource('contatos', ContatoController::class);
    Route::resource('users', UserController::class);
});
