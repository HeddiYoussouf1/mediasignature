<?php
namespace Heddiyoussouf\Mediasignature;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
class Mediasignature{
    public function wrapForMultiple(array $uris):array{
        $array=[];
        foreach($uris as $uri){
            array_push($array,$this->wrap($uri));
        }
        return $array;
    }
   public function wrap(string $uri){
    $encrypted_uri=$this->encrypt($uri);
    $temporary=config("mediasignature.temporary");
    if($temporary){
        $ttl=config("mediasignature.ttl");
        return URL::temporarySignedRoute('mediasignature', now()->addMinutes($ttl), ['path' => $encrypted_uri]);
    }else{
         return URL::signedRoute('mediasignature',["path"=>$encrypted_uri]);
    }
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
