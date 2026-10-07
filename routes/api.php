<?php

use App\Http\Controllers\BookCatalogApiController;
use App\Http\Controllers\BookPagesApiController;
use Illuminate\Support\Facades\Route;

Route::get('/v1/books', [BookCatalogApiController::class, 'index'])
    ->middleware('throttle:60,1')
    ->name('api.v1.books.index');

Route::get('/v1/books/{slug}/pages', [BookPagesApiController::class, 'index'])
    ->middleware('throttle:60,1')
    ->name('api.v1.books.pages.index');
