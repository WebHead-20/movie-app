<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TvController;
use App\Http\Controllers\ActorsController;
use App\Http\Controllers\MoviesController;



Route::controller(MoviesController::class)->group(function () {
    Route::get('/', 'index')->name('movies.index');
    Route::get('/popular-movies/page/{page?}', 'allpopularmovies')->name('movies.allpopularmovies');
    Route::get('/now-playing-movies/page/{page?}', 'allnowplayingmovies')->name('movies.allnowplayingmovies');
    Route::get('/movies/{id}', 'show')->name('movies.show');
});
Route::controller(ActorsController::class)->group(function () {
    Route::get('/actors', 'index')->name('actors.index');
    Route::get('/actors/page/{page?}', 'index');
    Route::get('/actors/{id}', 'show')->name('actors.show');
});
Route::controller(TvController::class)->group(function () {
    Route::get('/tv', 'index')->name('tv.index');
    Route::get('/top-rated-tv/page/{page?}', 'alltopratedtv')->name('tv.alltopratedtv');
    Route::get('/popular-tv/page/{page?}', 'allpopulartv')->name('tv.allpopulartv');
    Route::get('/tv/{id}', 'show')->name('tv.show');
});