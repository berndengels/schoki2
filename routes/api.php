<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiEventController;
use App\Http\Controllers\Api\SPA\SpaEventController;
use App\Http\Controllers\Api\SPA\SpaMenuController;
use App\Http\Controllers\Api\SPA\SpaPageController;
use App\Http\Controllers\Api\SPA\SpaMusicStyleController;
use App\Http\Controllers\Api\SPA\SpaContactController;
use App\Http\Controllers\Api\SPA\SpaProductController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::post('login', 'ApiAuthController@login');
//Route::apiResource('events', 'ApiEventController');

Route::get('events/{date?}', [ApiEventController::class, 'events']);

Route::group([
    'prefix'    => 'spa',
    'namespace' => 'SPA'
], function () {
    Route::get('events/{date?}', [SpaEventController::class, 'events']);
    Route::get('events/category/{slug}', [SpaEventController::class, 'eventsByCategory']);
    Route::get('events/theme/{slug}', [SpaEventController::class, 'eventsByTheme']);
    Route::get('menu/tree', [SpaMenuController::class, 'tree']);
    Route::get('menu/top', [SpaMenuController::class, 'top']);
    Route::get('menu/bottom', [SpaMenuController::class, 'bottom']);
    Route::get('products', [SpaProductController::class, 'products']);
    Route::get('product/{id}', [SpaProductController::class, 'product']);
    Route::get('pages', [SpaPageController::class, 'pages']);
    Route::get('page/routes', [SpaPageController::class, 'routes']);
    Route::get('page/{slug}', [SpaPageController::class, 'page']);
    Route::get('musicStyles', [SpaMusicStyleController::class, 'all']);
    Route::get('contact/bands/fields', [SpaContactController::class, 'fields']);
    Route::post('contact/bands/send', [SpaContactController::class, 'send']);
});
