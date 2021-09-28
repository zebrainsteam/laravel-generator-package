<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Tests\Builder;

use Zebrainsteam\LaravelGeneratorPackage\Builder\Builder;
use Zebrainsteam\LaravelGeneratorPackage\Tests\TestCase;

class BuilderTest extends TestCase
{
    private Builder $builder;

    /**
     * setUp
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->builder = app(Builder::class);
    }

    /**
     * Test ignore generation
     */
    public function testInit()
    {
        $init = $this->builder->init('test_vendor/test_name');
        $this->assertTrue($init);
    }

    /**
     * Filter with no arguments
     */
    public function testInitFilterNull()
    {
        $this->builder->initFilter(null);
        $this->assertTrue(is_null($this->builder->getPackageVendor()));
        $this->assertTrue(is_null($this->builder->getPackageName()));
    }

    /**
     * Filter from vendor args, it does not have a name argument
     */
    public function testInitFilterVendorArgument()
    {
        $this->builder->initFilter('vendor');
        $this->assertTrue($this->builder->getPackageVendor() == 'vendor');
        $this->assertTrue(is_null($this->builder->getPackageName()));
        $this->builder->initFilter('vendor/');
        $this->assertTrue($this->builder->getPackageVendor() == 'vendor');
        $this->assertTrue(is_null($this->builder->getPackageName()));
        $this->builder->initFilter('test/');
        $this->assertTrue($this->builder->getPackageVendor() == 'test');
        $this->assertTrue(is_null($this->builder->getPackageName()));
        $this->builder->initFilter('test/ ');
        $this->assertTrue($this->builder->getPackageVendor() == 'test');
        $this->assertTrue(is_null($this->builder->getPackageName()));
    }

    /**
     * Filter from full args
     */
    public function testInitFilterFullArgument()
    {
        $this->builder->initFilter('vendor/test1');
        $this->assertTrue($this->builder->getPackageVendor() == 'vendor');
        $this->assertTrue($this->builder->getPackageName() == 'test1');
        $this->builder->initFilter('test/packagename');
        $this->assertTrue($this->builder->getPackageVendor() == 'test');
        $this->assertTrue($this->builder->getPackageName() == 'packagename');
    }

    /**
     * Test ignore generation
     */
    public function testIsIgnore()
    {
        $this->builder->initFilter('vendor/packagename');
        $this->assertFalse($this->builder->isIgnore('vendor', 'packagename'));
        $this->assertTrue($this->builder->isIgnore('vendor', 'test'));
        $this->assertTrue($this->builder->isIgnore('vendor2', 'packagename'));
        $this->assertTrue($this->builder->isIgnore('vendor2', 'packagename2'));
    }
}
