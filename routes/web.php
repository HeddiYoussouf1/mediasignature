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
        return response()->file(public_path(Mediasignature::decrypt($path)));
    }elseif($type==="storage"){
        $path=Mediasignature::decrypt($path);
        $file = Storage::get($path);
        $fileMimeType = Storage::mimeType($path);
        return  response($file, 200, ['Content-Type' => $fileMimeType]);
    }
    return response("",400);
})->name("mediasignature")->middleware('signed');
