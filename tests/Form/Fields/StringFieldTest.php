<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Tests\Form\Fields;

use Zebrainsteam\LaravelGeneratorPackage\Facades\Field;

class StringFieldTest extends \Zebrainsteam\LaravelGeneratorPackage\Tests\TestCase
{
    /**
     * Test create field
     */
    public function testStringFieldInit()
    {
        $field = Field::string('title', 'Title');
        $this->assertTrue($field->getColumn() == 'title');
        $this->assertTrue($field->getLabel() == 'Title');
    }
}
