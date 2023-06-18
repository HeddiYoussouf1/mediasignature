<?php
namespace Heddiyoussouf\Mediasignature;
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
    $type=$this->setStoreType($store_type);
    $encrypted_uri=$this->encrypt($uri);
    $temporary=config("mediasignature.temporary");
    if($temporary){
        $ttl=config("mediasignature.ttl");
        $url= URL::temporarySignedRoute('mediasignature1', now()->addMinutes($ttl), ['path' => $encrypted_uri,"type"=>$type]);
    }else{
         $url= URL::signedRoute('mediasignature1',["path"=>$encrypted_uri,"type"=>$type]);
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
   protected function setStoreType($value) : string {
        if(is_null($value)){
            return config("mediasignature.store_type");
        }
        return $value;
   }
}
