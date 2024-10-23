<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ArticleController;


Route::resource('tags', TagController::class)->missing(function (Request $request) {
    return Redirect::route('tags.index');
})->except('edit', 'create');

Route::resource('articles', ArticleController::class)->missing(function (Request $request) {
    return Redirect::route('articles.index');
})->except('edit', 'create');
