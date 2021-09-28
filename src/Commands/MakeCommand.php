<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Commands;

use Zebrainsteam\LaravelGeneratorPackage\Builder\Builder;
use Illuminate\Console\Command;
use Illuminate\Support\Composer;

class MakeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'lgp:make {package?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generator the composer package from config file laravel-generator-package';

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'lgp:make {package?}';

    /**
     * @var Composer
     */
    public Composer $composer;

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the command.
     *
     * @return mixed
     */
    public function handle()
    {
        $arguments = $this->arguments();
        $this->line('Start composer package generation');
        app(Builder::class)->init($arguments['package']);
        $this->line('Stop generation');
        return 1;
    }
}
