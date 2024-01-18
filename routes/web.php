<?php

use Illuminate\Support\Facades\Route;
class Auth extends Illuminate\Support\Facades\Auth {}

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::prefix('/evento')->group (function () {
        Route::get('/list', [App\Http\Controllers\EventoController::class, 'list'])->name('evento.list');
        Route::get('/novo', [App\Http\Controllers\EventoController::class, 'create'])->name('evento.create');
        Route::get('/{id}/edit', [App\Http\Controllers\EventoController::class, 'edit'])->name('evento.edit');
        Route::get('/{id}/manage', [App\Http\Controllers\EventoController::class, 'manage'])->name('evento.manage');
    });

    Route::prefix('/inscricao')->group (function () {
        Route::get('/', [App\Http\Controllers\InscricaoController::class, 'list'])->name('inscricao.list');
        Route::get('/nova/{eventoId}', [App\Http\Controllers\InscricaoController::class, 'create'])->name('inscricao.create');
        Route::post('/nova', [App\Http\Controllers\InscricaoController::class, 'store'])->name('inscricao.store');
        Route::post('/cancel', [App\Http\Controllers\InscricaoController::class, 'cancel'])->name('inscricao.cancel');
    });

    Route::prefix('/pagamento')->group (function () {
        Route::post('/{inscricaoId}/novo', [App\Http\Controllers\PagamentoController::class, 'create'])->name('pagamento.create');
        Route::post('/guarda', [App\Http\Controllers\PagamentoController::class, 'store'])->name('pagamento.store');
        Route::get('/{id}', [App\Http\Controllers\PagamentoController::class, 'show'])->name('pagamento.show');
        Route::post('/{id}/aprovar', [App\Http\Controllers\PagamentoController::class, 'approve'])->name('pagamento.approve');
        Route::post('/{id}/rejeitar', [App\Http\Controllers\PagamentoController::class, 'reject'])->name('pagamento.reject');
    });
});

Route::get('/', [App\Http\Controllers\EventoController::class, 'index'])->name('evento.index');
Route::get('/evento', [App\Http\Controllers\EventoController::class, 'index'])->name('evento.index');
Route::prefix('/evento')->group (function () {
    Route::get('/{id}', [App\Http\Controllers\EventoController::class, 'show'])->name('evento.show');
    Route::post('/store', [App\Http\Controllers\EventoController::class, 'store'])->name('evento.store');
    Route::post('/{id}/status', [App\Http\Controllers\EventoController::class, 'status'])->name('evento.status');
    Route::patch('/{id}', [App\Http\Controllers\EventoController::class, 'update'])->name('evento.update');
});



