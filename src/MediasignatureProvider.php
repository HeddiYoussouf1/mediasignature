<?php
namespace Heddiyoussouf\Mediasignature;
use Illuminate\Support\ServiceProvider;
class MediasignatureProvider extends ServiceProvider{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/mediasignature.php' => config_path('mediasignature.php'),
        ]);
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }
}
