<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Tests\Models;

use Zebrainsteam\LaravelGeneratorPackage\Models\Dict;
use Mockery;

class DictTest extends \Zebrainsteam\LaravelGeneratorPackage\Tests\TestCase
{
    /**
     * setUp
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test Dict
     */
    public function testDict()
    {
        $dict = Mockery::mock(Dict::class);
        $this->assertInstanceOf(Dict::class, $dict);
    }
}
