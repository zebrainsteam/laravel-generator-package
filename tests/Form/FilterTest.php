<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Tests\Form;

use Zebrainsteam\LaravelGeneratorPackage\Configuration;
use Zebrainsteam\LaravelGeneratorPackage\Form\Filter;

class FilterTest extends \Zebrainsteam\LaravelGeneratorPackage\Tests\TestCase
{
    protected Filter $filter;
    protected Configuration $config;

    /**
     * setUp
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->config = app(Configuration::class);
        $this->filter = new Filter($this->config);
    }

    /**
     * Test create filter
     */
    public function testFilterInit()
    {

        $this->assertTrue($this->filter->setType('int')->getType() == 'int');
    }

    /**
     * Test required
     */
    public function testRequired()
    {
        $this->assertFalse($this->filter->required(false)->getRequired());
    }

    /**
     * Test required
     */
    public function testMax()
    {
        $this->assertTrue($this->filter->max(123)->getMax() == 123);
    }

    /**
     * Test required
     */
    public function testMin()
    {
        $this->assertTrue($this->filter->min(321)->getMin() == 321);
    }

    /**
     * Test nullable
     */
    public function testNullable()
    {
        $this->assertTrue($this->filter->nullable()->getNullable());
    }

    /**
     * Test unique
     */
    public function testUnique()
    {
        $this->assertTrue($this->filter->unique()->getUnique());
    }
}
