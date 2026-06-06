<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::post('/links', [LinkController::class, 'store']);
Route::get('/links/{code}/stats', [LinkController::class, 'stats']);
