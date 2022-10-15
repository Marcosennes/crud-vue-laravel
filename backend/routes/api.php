<?php

use App\Http\Controllers\CidadeController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('api')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/about', [HomeController::class, 'about']);

    Route::controller(EstadoController::class)->group(function () {
        Route::get('/estado/listar', 'index')->name('estado.index');
        Route::post('/estado/inserir', 'inserir')->name('estado.inserir');
        Route::get('/estado/alterar', 'alterarIndex')->name('estado.alterar.index');
        Route::put('/estado/alterar', 'alterar')->name('estado.alterar');
        Route::delete('/estado/excluir/{id}', 'excluir')->name('estado.excluir');
    });

    Route::controller(CidadeController::class)->group(function () {
        Route::get('/cidade/listar', 'index')->name('cidade.index');
        Route::get('/cidade/inserir', 'inserirIndex')->name('cidade.inserir.index');
        Route::post('/cidade/inserir', 'inserir')->name('cidade.inserir');
        Route::get('/cidade/alterar', 'alterarIndex')->name('cidade.alterar.index');
        Route::put('/cidade/alterar', 'alterar')->name('cidade.alterar');
        Route::post('/cidade/excluir', 'excluir')->name('cidade.excluir');
    });
// });
