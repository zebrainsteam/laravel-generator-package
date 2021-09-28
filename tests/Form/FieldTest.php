<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Tests\Form;

use Exception;
use Zebrainsteam\LaravelGeneratorPackage\Configuration;
use Zebrainsteam\LaravelGeneratorPackage\Contracts\FieldInterface;
use Zebrainsteam\LaravelGeneratorPackage\Exceptions\FieldDoesNotExistsException;
use Zebrainsteam\LaravelGeneratorPackage\Facades\Field;
use Zebrainsteam\LaravelGeneratorPackage\Form\Fields\TextField;
use Zebrainsteam\LaravelGeneratorPackage\Form\Form;
use Illuminate\Support\Str;

class FieldTest extends \Zebrainsteam\LaravelGeneratorPackage\Tests\TestCase
{
    /**
     * Test create field
     */
    public function testFieldInit()
    {
        $field = Field::text('title', 'Title');
        $this->assertTrue($field->getColumn() == 'title');
        $this->assertTrue($field->getLabel() == 'Title');
    }

    /**
     * Test Exception Type Column
     */
    public function testFieldInitExceptionTypeColumn()
    {
        $this->expectException(Exception::class);
        Field::text(123, 'Title');
    }

    /**
     * Test Exception Mask Column
     */
    public function testFieldInitExceptionMaskColumn()
    {
        $this->expectException(Exception::class);
        Field::text('проверка', 'Title');
    }

    /**
     * Test set\get type field
     */
    public function testTypeField()
    {
        $field = Field::text('title', 'Title')->setType('string');
        $this->assertTrue($field->getType() == 'string');
    }

    /**
     * Test set\get cast field
     */
    public function testCastField()
    {
        $field = Field::text('title', 'Title')->setCast('string');
        $this->assertTrue($field->getCast() == 'string');
    }

    /**
     * Test set\get mask field
     */
    public function testMaskField()
    {
        $field = Field::text('title', 'Title')->setMask('0000-0000');
        $this->assertTrue($field->getMask() == '0000-0000');
    }

    /**
     * Test set\get placeholder field
     */
    public function testPlaceholder()
    {
        $field = Field::text('title', 'Title')->setPlaceholder('Placeholder');
        $this->assertTrue($field->getPlaceholder() == 'Placeholder');
    }

    /**
     * Test set\get References field
     */
    public function testReferences()
    {
        $field = Field::text('title', 'Title')->references('App\Models\User::class', 'table_name', 'field_name', 'hasOne');
        $this->assertTrue($field->getReferencesModel() == 'App\Models\User::class');
        $this->assertTrue($field->getReferencesTable() == 'table_name');
        $this->assertTrue($field->getReferencesField() == 'field_name');
        $this->assertTrue($field->getReferencesHas() == 'hasOne');
        $this->assertTrue($field->referencesDisabled()->getReferencesField() == null);
    }

    /**
     * Test References Exception field
     */
    public function testReferencesException()
    {
        $this->expectException(Exception::class);
        $field = Field::text('title', 'Title')->references(' ', ' ', ' ');
    }

    /**
     * Test Field Does Not Exists Exception
     */
    public function testFieldDoesNotExistsException()
    {
        $this->expectException(FieldDoesNotExistsException::class);
        $field = Field::tralalaololo('title', 'Title');
    }

    /**
     * Test set\get fillable field
     */
    public function testFillable()
    {
        $field = Field::text('title', 'test')
            ->fillable(false);
        $this->assertFalse($field->isFillable());
    }

    /**
     * Test set\get param field
     */
    public function testParam()
    {
        $param = ['select' => ['dict_db_id' => 777]];
        $fieldParam = Field::text('title', 'test')->setParam($param)->getParam();
        $this->assertTrue($fieldParam['select']['dict_db_id'] == 777);
    }

    /**
     * Test set\get fillable field
     */
    public function testHidden()
    {
        $field = Field::text('title', 'test')
            ->hidden(true);
        $this->assertTrue($field->isHidden());
    }

    /**
     * Test set\get fillable field
     */
    public function testFindFieldClass()
    {
        $field = app(\Zebrainsteam\LaravelGeneratorPackage\Form\Field::class);
        $config = app(Configuration::class);
        $config->setField('test', TextField::class);
        $fieldName = array_key_first($config->getFields());
        $this->assertTrue(is_string($field->findFieldClass($fieldName)));
        $this->assertFalse($field->findFieldClass(Str::random()));
    }

    /**
     * Test set\get Nullable field
     */
    public function testNullable()
    {
        $this->assertFalse(Field::text('title', 'test')->nullable(false)->isNullable());
    }

    /**
     * Test set\get Nullable field
     */
    public function testUnique()
    {
        $this->assertFalse(Field::text('title', 'test')->unique(false)->isUnique());
        $this->assertTrue(Field::text('title', 'test')->unique(true)->isUnique());
    }

    /**
     * Test required
     */
    public function testRequired()
    {
        $this->assertFalse(Field::text('title', 'test')->required(false)->isRequired());
    }

    /**
     * Test max
     */
    public function testMax()
    {
        $this->assertTrue(Field::text('title', 'test')->max(123)->getMax() == 123);
    }

    /**
     * Test min
     */
    public function testMin()
    {
        $this->assertTrue(Field::text('title', 'test')->min(321)->getMin() == 321);
    }

    /**
     * Test index
     */
    public function testIndex()
    {
        $this->assertTrue(Field::text('title', 'test')->index()->isIndex());
    }

    /**
     * Test index
     */
    public function testDefault()
    {
        $this->assertTrue(Field::text('title', 'test')->default('testpack')->getDefault() == 'testpack');
    }

    /**
     * is name field is empty
     */
    public function testFailInit()
    {
        $this->assertFalse(Field::findFieldClass(' '));
    }

    /**
     * is name field is empty
     */
    public function testLoadFieldFromArrayFail()
    {
        $this->expectException(Exception::class);
        Field::loadFieldFromArray('test', ['field' => '___not___field___test___']);
    }

    /**
     * is name field is empty
     */
    public function testLoadFieldFromArray()
    {
        $field = Field::loadFieldFromArray('test', [
            'field' => 'text',
            'label' => 'Title',
            'placeholder' => 'Enter label',
            'default' => null,
            'index' => false,
            'fillable' => true,
            'hidden' => false,
            'references' => [],
            'filter' => [
                'nullable' => true,
                'unique' => true,
                'required' => true,
                'max' => null,
                'min' => null,
                'mask' => null,
            ]
        ]);
        $this->assertTrue($field instanceof FieldInterface);

        $field = Field::loadFieldFromArray('test', [
            'field' => 'text',
            'label' => 'Title',
            'placeholder' => 'Enter label',
            'default' => null,
            'index' => false,
            'fillable' => true,
            'hidden' => false,
            'references' => [
                'model' => 'App\Models\User',
                'table' => 'user',
                'field' => 'id',
                'has' => 'hasOne',
            ],
            'filter' => [
                'nullable' => true,
                'unique' => true,
                'required' => true,
                'max' => null,
                'min' => null,
                'mask' => null,
            ]
        ]);
        $this->assertTrue($field instanceof FieldInterface);
    }
}
