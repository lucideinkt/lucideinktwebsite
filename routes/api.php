<?php

use App\Http\Controllers\Api\MobileBooksController;
use Illuminate\Support\Facades\Route;

Route::prefix('mobile/v1')
    ->middleware(['mobile.api', 'throttle:60,1'])
    ->group(function () {
        Route::get('/books/manifest', [MobileBooksController::class, 'manifest']);
        Route::get('/books/{slug}', [MobileBooksController::class, 'show']);
    });
