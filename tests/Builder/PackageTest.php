<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Tests\Builder;

use Zebrainsteam\LaravelGeneratorPackage\Builder\Package;
use Zebrainsteam\LaravelGeneratorPackage\Configuration;

class PackageTest extends \Zebrainsteam\LaravelGeneratorPackage\Tests\TestCase
{

    private Package $package;
    private Configuration $config;

    /**
     * setUp
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->config = app(Configuration::class);
        $this->package = app(Package::class)->init($this->config->getGenerator()[0]);
    }

    /**
     * Test ignore generation
     */
    public function testInit()
    {
        $this->assertTrue(is_string($this->package->getPackageName()));
    }

    /**
     * Test get Name
     */
    public function testName()
    {
        $this->assertTrue($this->package->getName() == 'Name package');
    }

    /**
     * Test get\set Descripton
     */
    public function testDescripton()
    {
        $this->assertTrue($this->package->getDescripton() == 'Description package');
    }

    /**
     * Test get getGeneratorTests
     */
    public function testGetGeneratorTests()
    {
        $this->assertTrue(is_bool($this->package->getGeneratorTests()));
    }

    /**
     * Test get getGeneratorSeed
     */
    public function testGetGeneratorSeed()
    {
        $this->assertTrue(is_bool($this->package->getGeneratorSeed()));
    }

    /**
     * Test get getGeneratorApi
     */
    public function testGetGeneratorApi()
    {
        $this->assertTrue(is_bool($this->package->getGeneratorApi()));
    }

    /**
     * Test get getGeneratorApiFrontend
     */
    public function testGetGeneratorApiFrontend()
    {
        $this->assertTrue(is_bool($this->package->getGeneratorApiFrontend()));
    }

    /**
     * Test get getGeneratorLaravelAdmin
     */
    public function testGetGeneratorLaravelAdmin()
    {
        $this->assertTrue(is_bool($this->package->getGeneratorLaravelAdmin()));
    }

    /**
     * Test get getFields
     */
    public function testGetFields()
    {
        $this->assertTrue(is_array($this->package->getFields()));
    }

    /**
     * Test get getForm
     */
    public function testGetForm()
    {
        $this->assertTrue(is_array($this->package->getForm()));
    }

    /**
     * Test get getFilter
     */
    public function testGetFilter()
    {
        $this->assertTrue(is_array($this->package->getFilter()));
    }

    /**
     * Test get getFields
     */
    public function testSetFieldsNull()
    {
        $this->assertTrue(is_array($this->package->setFields(null)->getFields()));
    }
}
