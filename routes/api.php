<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RelaySettingController;
use App\Http\Controllers\SensorDataController;
use App\Http\Controllers\RelayControlController;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/profile', [AuthController::class, 'updateProfile']);

    Route::get('/relay-setting', [RelaySettingController::class, 'show']);
    Route::put('/relay-setting', [RelaySettingController::class, 'update']);

    Route::get('/sensor-data', [SensorDataController::class, 'index']);
    Route::post('/sensor-data', [SensorDataController::class, 'store']);
    Route::get('/sensor-data/latest', [SensorDataController::class, 'latest']);

    Route::get('/relay-control/setting', [RelayControlController::class, 'check']);

    Route::get('/relay-control/sensor', [RelaySettingController::class, 'viewControl']);
    Route::post('/relay-control/update-mode', [RelaySettingController::class, 'updateMode']);
    Route::post('/relay-control/update-status', [RelaySettingController::class, 'updateStatus']);
    Route::post('/relay-control/update-fan-status', [RelaySettingController::class, 'updateStatusFan']);
});