<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CommentController;

Route::post('/comment/{comment}/reply', [CommentController::class, 'reply'])->name('comment.reply');

Route::get('/', function () {
    return view('welcome');
});

