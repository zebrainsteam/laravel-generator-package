<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Tests\Form\Fields;

use Zebrainsteam\LaravelGeneratorPackage\Facades\Field;

class TextFieldTest extends \Zebrainsteam\LaravelGeneratorPackage\Tests\TestCase
{
    /**
     * Test create field
     */
    public function testTextFieldInit()
    {
        $field = Field::text('title', 'Title');
        $this->assertTrue($field->getColumn() == 'title');
        $this->assertTrue($field->getLabel() == 'Title');
    }
}
