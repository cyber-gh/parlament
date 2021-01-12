<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect("/members");
});
//
Route::resource('members', \App\Http\Controllers\MembersController::class);


//
//Route::get('', [\App\Http\Controllers\MembersController::class, "index"]);
//Route::get('details/{id}', [\App\Http\Controllers\MembersController::class, "show"]);
