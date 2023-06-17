<?php
use Heddiyoussouf\Mediasignature\Facades\Mediasignature;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::get('/{path}/{type}', function ($path,$type) {
    if($type==="public"){
        dump("1");
        return response()->file(public_path(Mediasignature::decrypt($path)));
    }
    $file = Storage::get($path);
    $fileMimeType = Storage::mimeType($path);
    dump("2");
    return  response($file, 200, ['Content-Type' => $fileMimeType]);
})->name("mediasignature")->middleware('signed');
