<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartamentoController;

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/', function () {
        return view('home');
    });

    Route::resource('pessoas', PessoaController::class)->except(['destroy']);
    Route::get('/pessoas/{id}/destroy', [PessoaController::class, 'destroy'])->name('pessoas.destroy');

    Route::resource('enderecos', EnderecoController::class);
    Route::resource('contatos', ContatoController::class);

    Route::resource('users', UserController::class)->except(['destroy']);
    Route::get('/users/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy');

    Route::resource('departamentos', DepartamentoController::class)->except(['destroy']);
    Route::get('/departamentos/{id}/destroy', [DepartamentoController::class, 'destroy'])->name('departamentos.destroy');
});
