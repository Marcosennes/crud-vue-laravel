<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Password;
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

Route::middleware('api')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/about', [HomeController::class, 'about']);

    Route::controller(EstadoController::class)->group(function () {
        Route::get('/estado/listar', 'index')->name('estado.index');
        Route::post('/estado/inserir', 'inserir')->name('estado.inserir');
        Route::get('/estado/detalhar/{id}', 'detalhar')->name('estado.detalhar');
        Route::post('/estado/alterar', 'alterar')->name('estado.alterar');
        Route::delete('/estado/excluir/{id}', 'excluir')->name('estado.excluir');
        Route::get('/estado/filtrar/{filter}', 'filtrar')->name('estado.filtrar');
    });

    Route::controller(CidadeController::class)->group(function () {
        Route::get('/cidade/listar', 'index')->name('cidade.index');
        Route::post('/cidade/inserir', 'inserir')->name('cidade.inserir');
        Route::get('/cidade/detalhar/{id}', 'detalhar')->name('cidade.detalhar');
        Route::post('/cidade/alterar', 'alterar')->name('cidade.alterar');
        Route::delete('/cidade/excluir/{id}', 'excluir')->name('cidade.excluir');
        Route::get('/cidade/filtrar/{filter}', 'filtrar')->name('cidade.filtrar');
        Route::get('/cidade/cidadesPag/{current_page}', 'cidadesPag')->name('cidade.paginacao');
    });

    // Route::controller(AuthController::class)
    //     ->prefix('auth')
    //     ->group(function () {
    //         Route::post('/login', 'login')->name('auth.login');
    //         Route::post('/logout', 'logout')->name('auth.logout');
    //         Route::post('/refresh', 'refresh')->name('auth.refresh');
    //         Route::post('/me', 'me')->name('auth.me');
    // });


    // $router->get('password/reset', ForgotPasswordController::class, 'showLinkRequestForm')->name('admin.password.reset');
    // Route::get('/', [HomeController::class, 'index'])->name('home');


    // Password Reset Routes...
    // $router->get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.reset');
    // $router->post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
    // $router->get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.token');
    // $router->post('password/reset', 'ResetPasswordController@reset');
});
