<?php
use Heddiyoussouf\Mediasignature\Facades\Mediasignature;
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

Route::get('/{path}', function ($path) {
    return response()->file(public_path(Mediasignature::decrypt($path)));
})->name("mediasignature")->middleware('signed');
