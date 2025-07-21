<?php
namespace App\Providers;

use App\Contracts\SmsServiceInterface;
use App\Services\FarazsmsService;
use App\Services\TestingSmsService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->bindSmsService();
    }

    private function bindSmsService()
    {
        $this->app->singleton(SmsServiceInterface::class, function ($app) {

            $driver = config('services.sms.driver','testing');

            $services = [
                'farazsms' => FarazsmsService::class,
                'testing'  => TestingSmsService::class,
            ];

            return $app->make($services[$driver]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
