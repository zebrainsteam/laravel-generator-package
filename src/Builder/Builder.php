<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Builder;

use Zebrainsteam\LaravelGeneratorPackage\Configuration;
use Illuminate\Support\Facades\Log;

class Builder
{
    /**
     * @var Configuration
     */
    private Configuration $config;

    /**
     * @var string|null
     */
    private ?string $packageVendor = null;
    private ?string $packageName = null;

    /**
     * Builder constructor.
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    /**
     * @param string|null $packageFilter
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function init(?string $packageFilter = null): bool
    {
        $this->initFilter($packageFilter);
        $configGenerator = $this->config->getGenerator();
        $countPackage = 0;
        foreach ($configGenerator as $package) {
            $package = app(Package::class)->init($package);
            if ($this->isIgnore(/** @scrutinizer ignore-type */ $package->getPackageVendor(), /** @scrutinizer ignore-type */ $package->getPackageName())) {
                continue;
            }
            /* Generation */
            echo ++$countPackage . ': Generation: ' . $package->getPackageVendor() . '/' . $package->getPackageName() . "\n";
            app(DirGenerator::class)->make($package);
            app(FileGenerator::class)->make($package);
        }
        return true;
    }

    /**
     * @param string $vandor
     * @param string $name
     * @return bool
     */
    public function isIgnore(string $vandor, string $name): bool
    {
        if (!is_null($this->getPackageVendor()) && $this->getPackageVendor() != $vandor) {
            return true;
        }
        if (!is_null($this->getPackageName()) && $this->getPackageName() != $name) {
            return true;
        }
        return false;
    }

    /**
     * @param string|null $package
     * @return bool
     */
    public function initFilter(?string $package = null): bool
    {
        if (is_null($package)) {
            return true;
        }
        $package = mb_strtolower($package);
        $package = str_replace('\\', '/', $package);
        if (!mb_stripos($package, '/')) {
            $this->packageVendor = $package;
            return true;
        }
        $match = explode('/', $package, 2);
        $this->packageVendor = $match[0];
        $this->packageName = mb_strlen(trim($match[1])) > 0 ? $match[1] : null;
        return true;
    }

    /**
     * @return string|null
     */
    public function getPackageVendor(): ?string
    {
        return $this->packageVendor;
    }

    /**
     * @return string|null
     */
    public function getPackageName(): ?string
    {
        return $this->packageName;
    }
}
