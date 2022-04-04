<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['apiAuth']], function(){
    Route::controller(LibraryController::class)->group(function () {
        Route::get('authors', 'getAllAuthors');
        Route::get('authors/paginate/', 'getAllAuthorsWithPaginate');
        Route::get('author/{id}', 'getAuthorById');
    });
});

