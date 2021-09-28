<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Tests\Builder;

use Zebrainsteam\LaravelGeneratorPackage\Builder\DirGenerator;
use Zebrainsteam\LaravelGeneratorPackage\Builder\Package;
use Zebrainsteam\LaravelGeneratorPackage\Tests\TestCase;

class DirGeneratorTest extends TestCase
{

    private Package $package;
    private DirGenerator $dirGenerator;

    /**
     * setUp
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->package = app(Package::class);
        $this->dirGenerator = app(DirGenerator::class);
    }

    /**
     * Test addone false
     */
    public function testMakeAddoneFalse()
    {
        $this->package->setPackageVendor('test_vendor');
        $this->package->setPackageName('test_name');
        $this->package->setGeneratorTests(false);
        $this->package->setGeneratorSeed(false);
        $this->package->setGeneratorApi(false);
        $this->package->setGeneratorApiFrontend(false);
        $this->package->setGeneratorLaravelAdmin(false);
        $init = $this->dirGenerator->make($this->package);
        $this->assertTrue($init);
    }

    /**
     * Test make dir if isset dir
     */
    public function testMakeIssetDir()
    {
        $this->assertFalse($this->dirGenerator->mkdir(base_path()));
        $this->assertTrue($this->dirGenerator->mkdir(base_path(time())));
    }
}
