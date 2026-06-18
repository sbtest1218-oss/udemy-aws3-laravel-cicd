<?php

use App\Http\Controllers\JourneyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JourneyController::class, 'index'])->name('journey');
