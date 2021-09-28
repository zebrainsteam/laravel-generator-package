<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Tests\Models;

use Zebrainsteam\LaravelGeneratorPackage\Models\DictOption;
use Mockery;

class DictOptionTest extends \Zebrainsteam\LaravelGeneratorPackage\Tests\TestCase
{
    /**
     * setUp
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test DictOption
     */
    public function testDictOption()
    {
        $dict = Mockery::mock(DictOption::class);
        $this->assertInstanceOf(DictOption::class, $dict);
    }
}
