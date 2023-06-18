<?php
namespace Heddiyoussouf\Mediasignature;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
class MediasignatureProvider extends ServiceProvider{
    public function boot()
    {
        $this->app->singleton('Mediasignature', function ($app) {
            return new \Heddiyoussouf\Mediasignature\Mediasignature();
        });
        if ($this->app->runningInConsole()) {


        $this->publishes([
            __DIR__.'/../config/mediasignature.php' => config_path('mediasignature.php'),
        ]);
        }
        $this->registerRoutes();
    }
    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    /**
     * Get the Press route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            'prefix' => "media-signature",
            'namespace' => 'Heddiyoussouf\Mediasignature\Http\Controllers',
        ];
    }
}
