<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Routes pour les notifications admin
    Route::prefix('admin/notifications')->group(function () {
        Route::get('/', 'App\Http\Controllers\Admin\NotificationController@index');
        Route::post('/{id}/mark-as-read', 'App\Http\Controllers\Admin\NotificationController@markAsRead');
        Route::post('/mark-all-as-read', 'App\Http\Controllers\Admin\NotificationController@markAllAsRead');
    });
});
