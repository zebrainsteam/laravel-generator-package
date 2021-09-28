<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Builder;

use Zebrainsteam\LaravelGeneratorPackage\Builder\Components\Migration;
use Zebrainsteam\LaravelGeneratorPackage\Facades\Field;
use Zebrainsteam\LaravelGeneratorPackage\Tests\TestCase;

class MigrationTest extends TestCase
{
    /**
     * setUp
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test Generation Field
     */
    public function testGenerationField()
    {
        $field = Field::text('title', 'Title')->references('App\Models\User::class', 'table_name', 'field_name', 'hasOne');
        $codeFunction = app(Migration::class)->generationField($field);
        $this->assertTrue(is_string($codeFunction));
    }
}
