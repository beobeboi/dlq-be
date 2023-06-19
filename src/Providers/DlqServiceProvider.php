<?php

namespace DiagVN\Dlq\Providers;

use DiagVN\Dlq\Api\Dlq;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class DlqServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes(
            [
                //file source => file destination below
                __DIR__ . '/../Config/dlq.php' => config_path('dlq.php'),
                //you can also add more configs here
            ], 'dlq-config'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Dlq::class, function () {
            return new Dlq(
                new Client([
                    'connect_timeout' => config('dlq.timeout'),
                    'base_uri' => config('dlq.dlq_domain'),
                    'headers' => [
                        'Authorization' => 'Bearer ' . config('dlq.dlq_api_key'),
                    ],
                    'verify' => false,
                ])
            );
        });
    }
}