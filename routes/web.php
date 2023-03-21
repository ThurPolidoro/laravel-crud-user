<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('', [CustomerController::class, 'index']);

Route::group(['as' => 'customers', 'prefix' => '/v1/customers', 'controller' => CustomerController::class], function () {
    Route::get('', 'all');
    Route::post('', 'store');
    Route::get('/{id}', 'unique')->where(['id' => '[0-9+]']);
    Route::put('{id}', 'edit')->where(['id' => '[0-9+]']);
    Route::delete('{id}', 'destroy')->where(['id' => '[0-9+]']);
});
