<?php declare(strict_types=1);

namespace Core45\LaravelBaselinker;

use Illuminate\Support\ServiceProvider;

class BaselinkerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/baselinker.php', 'baselinker');

        // Register the service the package provides.
        $this->app->singleton('baselinker', function ($app) {
            return new Baselinker;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        // ============ Publish assets with php artisan vendor:publish ============
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/baselinker.php' => config_path('baselinker.php'),
            ], 'laravel-baselinker');
        }
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return ['baselinker'];
    }
}
