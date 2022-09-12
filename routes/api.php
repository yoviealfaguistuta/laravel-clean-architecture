<?php

use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\OvertimeController;
use App\Http\Controllers\API\SettingController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::patch('/settings', [SettingController::class, 'index'])->name('setting');
Route::post('/employees', [EmployeeController::class, 'index'])->name('employee');
Route::post('/overtimes', [OvertimeController::class, 'overtime'])->name('overtime');
Route::get('/overtimes-pays/calculate', [OvertimeController::class, 'overtime_pays'])->name('overtime_pays');
// Route::prefix('perusahaan')->group(function () {
// });