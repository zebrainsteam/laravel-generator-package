<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Tests;

use Zebrainsteam\LaravelGeneratorPackage\Configuration;
use Zebrainsteam\LaravelGeneratorPackage\ServiceProvider;
use Illuminate\Foundation\Application;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     *
     */
    public function setUp(): void
    {
        parent::setUp();
        app(Configuration::class)->setBasePath(realpath(__DIR__ . '/../'));
    }

    /**
     * @param Application $app
     * @return string[]
     */
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }

    /**
     * @param Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
