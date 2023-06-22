<?php
namespace Heddiyoussouf\Mediasignature\Http\Controllers;

use Heddiyoussouf\Mediasignature\Facades\Mediasignature;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
class MediasignatureController extends Controller
{

    public function getFile($path,$disk=null)
    {
        if(is_null($disk)){
            return response()->file(public_path(Mediasignature::reversePath($path)));
        }else{
            $path=Mediasignature::reversePath($path);
            $file = Storage::disk($disk)->get($path);
            $mimeType = Storage::disk($disk)->mimeType($path);
            return  response($file, 200, ['Content-Type' => $mimeType]);
        }

    }
}
