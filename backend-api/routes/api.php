<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccessControlController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route за проверка на RFID пристап
Route::post('/access-check', [AccessControlController::class, 'checkAccess']);
?>