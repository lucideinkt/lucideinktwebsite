<?php

use App\Http\Controllers\AllBooksSearchApiController;
use App\Http\Controllers\BookCatalogApiController;
use App\Http\Controllers\BookNavigationApiController;
use App\Http\Controllers\BookSearchApiController;
use App\Http\Controllers\BookPagesApiController;
use Illuminate\Support\Facades\Route;

Route::get('/v1/books', [BookCatalogApiController::class, 'index'])
    ->middleware('throttle:60,1')
    ->name('api.v1.books.index');

Route::get('/v1/books/{slug}/pages', [BookPagesApiController::class, 'index'])
    ->middleware('throttle:60,1')
    ->name('api.v1.books.pages.index');

Route::get('/v1/books/{slug}/navigation', [BookNavigationApiController::class, 'index'])
    ->middleware('throttle:60,1')
    ->name('api.v1.books.navigation.index');

Route::get('/v1/books/{slug}/search', [BookSearchApiController::class, 'index'])
    ->middleware('throttle:60,1')
    ->name('api.v1.books.search.index');

Route::get('/v1/search', [AllBooksSearchApiController::class, 'index'])
    ->middleware('throttle:30,1')
    ->name('api.v1.search.index');
