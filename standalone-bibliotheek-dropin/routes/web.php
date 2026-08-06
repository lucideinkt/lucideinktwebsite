<?php

use App\Http\Controllers\OnlineLezenController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('onlineLezen'))->name('home');

Route::get('/bibliotheek', [OnlineLezenController::class, 'index'])->name('onlineLezen');
Route::get('/bibliotheek/zoeken-alles', [OnlineLezenController::class, 'searchAllBooks'])->name('onlineLezenSearchAll');
Route::get('/bibliotheek/{slug}', [OnlineLezenController::class, 'read'])->name('onlineLezenRead');
Route::get('/bibliotheek/{slug}/lees', [OnlineLezenController::class, 'readHtml'])->name('onlineLezenReadHtml');
Route::get('/bibliotheek/{slug}/zoeken', [OnlineLezenController::class, 'searchApi'])->name('onlineLezenSearchApi');
Route::get('/bibliotheek/{slug}/paginas', [OnlineLezenController::class, 'pagesApi'])->name('onlineLezenPagesApi');

