<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class,'getUsersWithPagination'])->name('users.get');

Route::post('/user',[UserController::class,'addUser'])->name('user.add');
