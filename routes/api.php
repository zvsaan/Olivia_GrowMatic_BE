<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RelaySettingController;
use App\Http\Controllers\SensorDataController;
use App\Http\Controllers\RelayControlController;

Route::get('/relay-setting', [RelaySettingController::class, 'show']);
Route::put('/relay-setting', [RelaySettingController::class, 'update']);

Route::get('/sensor-data/table/all', [SensorDataController::class, 'allTableData']);
Route::get('/sensor-data/chart', [SensorDataController::class, 'chartData']);
Route::get('/sensor-data/table', [SensorDataController::class, 'tableData']);
Route::get('/sensor-data', [SensorDataController::class, 'index']);
Route::post('/sensor-data', [SensorDataController::class, 'store']);
Route::get('/sensor-data/latest', [SensorDataController::class, 'latest']); // opsional

Route::get('/relay-control/setting', [RelayControlController::class, 'check']);

Route::get('/relay-control/sensor', [RelaySettingController::class, 'viewControl']);
Route::post('/relay-control/update-mode', [RelaySettingController::class, 'updateMode']);
Route::post('/relay-control/update-status', [RelaySettingController::class, 'updateStatus']);
Route::post('/relay-control/update-fan-status', [RelaySettingController::class, 'updateStatusFan']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
