<?
namespace Heddiyoussouf\Mediasignature;
use Illuminate\Support\ServiceProvider;
class MediasignatureProvider extends ServiceProvider{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/courier.php' => config_path('courier.php'),
        ]);
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }
}
