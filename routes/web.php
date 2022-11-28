<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodolistsController;

Route::get('/', function () {
    return view('todolist');
});



Route::resource('/todolist', TodolistsController::class);