<?php

use App\Models\Constant;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\ConstantController;

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

Route::post('/register/{role}', [UserController::class, 'register']); //middleware superAdmin
Route::post('/login', [UserController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ConstantController::class)->prefix('/constant')->group(function () {
        Route::post('/', 'create');
        Route::put('/{constant}', 'update');
        Route::delete('/{constant}', 'delete');
        Route::get('/', 'view');
        Route::get('/{constant}', 'get');
        Route::get('/search/{search}', 'constantSearch');
    });
});
Route::get('/bla', function () {
    $countryId = Country::where('name', 'Syria')->first()->_id;
    return ['c'=>Country::where('name', 'Damascus')->first()];
});


