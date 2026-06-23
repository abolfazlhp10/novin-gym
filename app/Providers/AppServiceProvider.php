<?php

namespace App\Providers;

use App\Classes\ApiResponse;
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
        $this->bindApiResonse();
    }

    private function bindSmsService()
    {
        $this->app->bind(SmsServiceInterface::class, function () {

            if (config('services.sms.driver') == 'testing') {
                return new TestingSmsService;
            }

            $config = config('services.sms.farazsms');

            return new FarazsmsService(
                base_url: $config['base_url'],
                username: $config['username'],
                password: $config['password'],
                from: $config['from'],
                pattern_code: $config['pattern_code']
            );
        });
    }

    private function bindApiResonse()
    {
        $this->app->singleton(ApiResponse::class, function ($app) {
            return new ApiResponse;
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
