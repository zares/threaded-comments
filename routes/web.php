<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () { return view('index'); });

Route::prefix('comment')->group(function () {
    Route::get('', function () { return redirect('/'); });
    Route::get('list', [CommentsController::class, 'list'])->name('comment.list');
    Route::get('thread/{id?}', [CommentsController::class, 'thread'])->name('comment.thread');
    Route::get('form/{id?}/{token?}', [CommentsController::class, 'form'])->name('comment.form');
    Route::post('create', [CommentsController::class, 'create'])->name('comment.create');
    Route::post('update', [CommentsController::class, 'update'])->name('comment.update');
    Route::post('remove', [CommentsController::class, 'remove'])->name('comment.remove');
});
