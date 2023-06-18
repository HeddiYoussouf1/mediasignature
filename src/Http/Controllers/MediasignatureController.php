<?php
namespace Heddiyoussouf\Mediasignature\Http\Controllers;

use Heddiyoussouf\Mediasignature\Facades\Mediasignature;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
class MediasignatureController extends Controller
{

    public function getFile($path,$type)
    {
        if($type==="public"){
            return response()->file(public_path(Mediasignature::decrypt($path)));
        }else{
            $type==="storage";
            $path=Mediasignature::decrypt($path);
            $file = Storage::get($path);
            $fileMimeType = Storage::mimeType($path);
            return  response($file, 200, ['Content-Type' => $fileMimeType]);
        }

    }
}
