<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PageController;

Route::post('/pages', [PageController::class, 'store'])->name('api.pages.store');