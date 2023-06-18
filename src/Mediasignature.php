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
    $generated_path=$this->generatePath($uri);
    $temporary=config("mediasignature.temporary");
    if($temporary){
        $ttl=config("mediasignature.ttl");
        $url= URL::temporarySignedRoute('mediasignature', now()->addMinutes($ttl), ['path' => $generated_path,"type"=>$type]);
    }else{
         $url= URL::signedRoute('mediasignature',["path"=>$generated_path,"type"=>$type]);
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
   public function generatePath ($path) :string {
    $encrypt=config('mediasignature.encrypt');
    if($encrypt){
        return $this->encrypt($path);
    }
    return urlencode($path);
}
public function reversePath ($path) :string {
    $encrypt=config('mediasignature.encrypt');
    if($encrypt){
        return Mediasignature::decrypt($path);
    }
    return urldecode($path);


}
}
