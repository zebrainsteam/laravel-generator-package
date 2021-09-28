<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Builder;

class DirGenerator
{
    private Package $package;

    /**
     * @param Package $package
     * @return bool
     */
    public function make(Package $package): bool
    {
        $this->package = $package;
        $this->mkdir($this->package->getPath('.github/workflows'));
        $this->mkdir($this->package->getPath('config'));
        $this->mkdir($this->package->getPath('database/migrations'));
        $this->mkdir($this->package->getPath('src/Controllers'));
        $this->mkdir($this->package->getPath('src/Models'));
        $this->mkdir($this->package->getPath('src/Cases'));
        $this->makeTests();
        $this->makeSeeds();
        $this->makeApi();
        $this->makeApiFrontend();
        $this->makeLaravelAdmin();
        return true;
    }

    /**
     * @return bool
     */
    public function makeTests(): bool
    {
        if (!$this->package->getGeneratorTests()) {
            return false;
        }
        $this->mkdir($this->package->getPath('tests'));
        return true;
    }

    /**
     * @return bool
     */
    public function makeSeeds(): bool
    {
        if (!$this->package->getGeneratorSeed()) {
            return false;
        }
        $this->mkdir($this->package->getPath('database/Seeders'));
        $this->mkdir($this->package->getPath('database/Factories'));
        return true;
    }

    /**
     * @return bool
     */
    public function makeApi(): bool
    {
        if (!$this->package->getGeneratorApi()) {
            return false;
        }
        $this->mkdir($this->package->getPath('src/Cases/Api'));
        return true;
    }

    /**
     * @return bool
     */
    public function makeApiFrontend(): bool
    {
        if (!$this->package->getGeneratorApiFrontend()) {
            return false;
        }
        $this->mkdir($this->package->getPath('src/Cases/Api/Frontend'));
        return true;
    }

    /**
     * @return bool
     */
    public function makeLaravelAdmin(): bool
    {
        if (!$this->package->getGeneratorLaravelAdmin()) {
            return false;
        }
        $this->mkdir($this->package->getPath('src/Admin'));
        return true;
    }

    /**
     * @param string $path
     * @return bool
     */
    public function mkdir(string $path): bool
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
            return true;
        }
        return false;
    }
}
