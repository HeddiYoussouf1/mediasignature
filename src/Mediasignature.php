<?php
namespace Heddiyoussouf\Mediasignature;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
class Mediasignature{

    public function wrapForMultiple(array $uris,$store_type=null):array{
        $array=[];
        foreach($uris as $uri){
            array_push($array,$this->wrap($uri,$store_type));
        }
        return $array;
    }
   public function wrap(string $uri,$store_type=null):string{
    $type=is_null($store_type)?config("mediasignature.store_type"):null;
    $encrypted_uri=$this->encrypt($uri);
    $temporary=config("mediasignature.temporary");
    if($temporary){
        $ttl=config("mediasignature.ttl");
        $url= URL::temporarySignedRoute('mediasignature', now()->addMinutes($ttl), ['path' => $encrypted_uri,"type"=>$type]);
    }else{
         $url= URL::signedRoute('mediasignature',["path"=>$encrypted_uri,"type"=>$type]);
    }
    return $url;
   }
   protected function encrypt(string $uri):string{
    $encrypt=config("mediasignature.encrypt");
    if($encrypt){
        return Crypt::encryptString($uri);
    }
    return $uri;
   }
   public function decrypt($uri):string{
    $encrypt=config("mediasignature.encrypt");
    if($encrypt){
        return Crypt::decryptString($uri);
    }
    return $uri;
   }



}
