<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\EventoController::class, 'index'])->name('evento.index');
Route::get('/evento', [App\Http\Controllers\EventoController::class, 'index'])->name('evento.index');
Route::prefix('/evento')->group (function () {
    Route::get('/novo', [App\Http\Controllers\EventoController::class, 'create'])->name('evento.create');
    Route::post('/store', [App\Http\Controllers\EventoController::class, 'store'])->name('evento.store');
    Route::get('/{id}', [App\Http\Controllers\EventoController::class, 'show'])->name('evento.show');
    Route::get('/{id}/edit', [App\Http\Controllers\EventoController::class, 'edit'])->name('evento.edit');
    Route::patch('/{id}', [App\Http\Controllers\EventoController::class, 'update'])->name('evento.update');
    Route::get('/{id}/gerir', [App\Http\Controllers\EventoController::class, 'manage'])->name('evento.manage');
});

Route::get('/inscricao', [App\Http\Controllers\InscricaoController::class, 'index'])->name('inscricao.index');
Route::prefix('/inscricao')->group (function () {
    Route::get('/novo', [App\Http\Controllers\InscricaoController::class, 'create'])->name('inscricao.create');
    Route::post('/store', [App\Http\Controllers\InscricaoController::class, 'store'])->name('inscricao.store');
    Route::get('/{id}', [App\Http\Controllers\InscricaoController::class, 'show'])->name('inscricao.show');
    Route::patch('/{id}', [App\Http\Controllers\InscricaoController::class, 'cancel'])->name('inscricao.cancel');
});

Route::get('/pagamento', [App\Http\Controllers\PagamentoController::class, 'create'])->name('pagamento.create');
Route::prefix('/pagamento')->group (function () {
    Route::post('/pagamento', [App\Http\Controllers\PagamentoController::class, 'store'])->name('pagamento.store');
    Route::get('/pagamento/{id}', [App\Http\Controllers\PagamentoController::class, 'show'])->name('pagamento.show');
    Route::patch('/pagamento/{id}', [App\Http\Controllers\PagamentoController::class, 'approve'])->name('pagamento.approve');
});

