<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContainerApiController;

Route::post('/update-container', [ContainerApiController::class, 'update']);
Route::get('/containers', [ContainerApiController::class, 'index']);