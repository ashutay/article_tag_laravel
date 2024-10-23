<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\TagController;

Route::resource('tags', TagController::class)->missing(function (Request $request) {
    return Redirect::route('tags.index');
})->except('edit', 'create');
