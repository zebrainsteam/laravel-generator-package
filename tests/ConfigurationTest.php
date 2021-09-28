<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Tests;

use Zebrainsteam\LaravelGeneratorPackage\Configuration;
use Zebrainsteam\LaravelGeneratorPackage\Form\Fields\TextField;

class ConfigurationTest extends \Zebrainsteam\LaravelGeneratorPackage\Tests\TestCase
{
    private Configuration $config;

    /**
     * setUp
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->config = app(Configuration::class);
    }

    /**
     * set\get Fields
     */
    public function testSetFields()
    {
        $this->config->setFields(['text' => TextField::class]);
        $fields = $this->config->getFields();
        $this->assertTrue(isset($fields['text']));
    }

    /**
     * set\get one Field
     */
    public function testSetField()
    {
        $this->config->setField('test', TextField::class);
        $fields = $this->config->getFields();
        $this->assertTrue(isset($fields['test']));
    }

    /**
     * set\get Configuration
     */
    public function testSetGenerator()
    {
        $generatorConfig = [['vendor' => 'vendor', 'package' => 'packagename']];
        $this->config->setGenerator($generatorConfig);
        $this->assertTrue($generatorConfig === $this->config->getGenerator());
    }

    /**
     * load Configuration
     */
    public function testLoad()
    {
        $config = $this->config->load();
        $this->assertTrue($config instanceof Configuration);
    }
}
