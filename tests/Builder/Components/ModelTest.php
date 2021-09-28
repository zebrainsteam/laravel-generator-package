<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Builder;

use Zebrainsteam\LaravelGeneratorPackage\Builder\Components\Model;
use Zebrainsteam\LaravelGeneratorPackage\Facades\Field;
use Zebrainsteam\LaravelGeneratorPackage\Tests\TestCase;

class ModelTest extends TestCase
{
    /**
     * setUp
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test Generation Function
     */
    public function testGetFunction()
    {
        $field = Field::text('title', 'Title')->references('App\Models\User::class', 'table_name', 'field_name', 'hasOne');
        $codeField = app(Model::class)->getFunction($field);
        $this->assertTrue(is_string($codeField) && mb_strlen($codeField) > 0);
    }

    /**
     * Test Generation Function Null
     */
    public function testGetFunctionNull()
    {
        $field = Field::text('title', 'Title');
        $codeField = app(Model::class)->getFunction($field);
        $this->assertTrue(mb_strlen($codeField) == 0);
    }

    /**
     * Test Generation Rules
     */
    public function testGetRules()
    {
        $field = Field::float('title', 'Title')->min(1)->max(100)->required();
        $codeRules = app(Model::class)->getRules($field);
        $this->assertTrue(is_string($codeRules) && mb_strlen($codeRules) > 0);
    }
}
