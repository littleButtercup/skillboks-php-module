<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TextController;
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
});
Route::get('text/show', [TextController::class, 'show'])->name('show');
Route::post('text/update', [TextController::class, 'update']);
Route::get('text/list', [TextController::class, 'list'])->name('list');
Route::get('text/create', [TextController::class, 'create']);
Route::post('text/delete', [TextController::class, 'delete']);
