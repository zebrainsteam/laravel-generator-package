<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage;

use Exception;
use Zebrainsteam\LaravelGeneratorPackage\Commands\MakeCommand;
use Zebrainsteam\LaravelGeneratorPackage\Form\Field;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap the application services...
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeCommand::class,
            ]);
        }

        $configPath = $this->configPath();

        $this->publishes([
            $configPath . '/config.php' => $this->publishPath('laravel-generator-package.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     * @throws Exception
     */
    public function register()
    {
        $this->app->singleton(Configuration::class, function() {
            return new Configuration;
        });
        $this->app->bind(Field::class, function() {
            return new Field(app(Configuration::class));
        });
    }

    /**
     * @return string
     */
    protected function configPath(): string
    {
        return __DIR__ . '/../config';
    }

    /**
     * @param $configFile
     * @return string
     */
    protected function publishPath($configFile): string
    {
        return config_path($configFile);
    }
}
