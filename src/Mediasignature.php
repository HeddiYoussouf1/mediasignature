<?php
namespace Heddiyoussouf\Mediasignature;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
class Mediasignature{

    public function wrapForMultiple(array $uris,$ttl=null,$filesystem=null,$disk=null):array{
        $array=[];
        foreach($uris as $uri){
            array_push($array,$this->wrap($uri,$ttl,$filesystem,$disk));
        }
        return $array;
    }
   public function wrap(string $uri,$ttl=null,$filesystem=null,$disk=null):string{
        $filesystem=$this->setFilesystem($filesystem);
        $disk=$this->setDisk($disk,$filesystem);
        $generated_path=$this->generatePath($uri);
        $ttl=$this->setTTL($ttl);
        return URL::temporarySignedRoute('mediasignature', now()->addMinutes($ttl), ['path' => $generated_path,"disk"=>$disk]);
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
   protected function setFilesystem($value) : string {
        if(is_null($value)){
            return config("mediasignature.filesystem");
        }
        return $value;
   }
   protected function setDisk($value,$filesystem) {
    $filesystem=!$this->setFilesystem($filesystem);
    if(!$filesystem){
        return null;
    }elseif($filesystem && is_null($value)){
        return config("mediasignature.disk");
    }
    return $value;
}
protected function setTTL($value) {
    if(is_null($value)){
        return config("mediasignature.ttl");
    }
    return $value;
}
   public function generatePath ($path) :string {
    $encrypt=config('mediasignature.encrypt');
    if($encrypt){
        return $this->encrypt($path);
    }
    return str_replace("/", "$$", $path);
}
public function reversePath ($path) :string {
    $encrypt=config('mediasignature.encrypt');
    if($encrypt){
        return Mediasignature::decrypt($path);
    }
    return str_replace("$$", "/", $path);
}
}
