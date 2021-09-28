<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage;

use Zebrainsteam\LaravelGeneratorPackage\Form\Fields\FloatField;
use Zebrainsteam\LaravelGeneratorPackage\Form\Fields\IntegerField;
use Zebrainsteam\LaravelGeneratorPackage\Form\Fields\StringField;
use Zebrainsteam\LaravelGeneratorPackage\Form\Fields\TextField;

class Configuration
{
    /**
     * @var string
     */
    protected string $basePath;

    /**
     * @var string
     */
    protected string $configFile = 'laravel-generator-package';

    /**
     * The array of class fields.
     *
     * @var array
     */
    protected array $fields = [
        'text' => TextField::class,
        'string' => StringField::class,
        'integer' => IntegerField::class,
        'float' => FloatField::class,
    ];

    /**
     * Конфиг генерации пакетов
     *
     * @var array
     */
    protected array $generator = [
        /*
         * Package test_vendor/test_name
         */
        [
            'name' => 'Name package',
            'description' => 'Description package',
            'vendor' => 'test_vendor',
            'package' => 'test_name',
            'model' => 'Test',
            'table' => 'test',
            'generator' => [
                'tests' => true,
                'seed' => true,
                'api' => true,
                'api_frontend' => true,
                'laravel_admin' => true,
            ],
            'fields' => [
                'title' => [
                    'field' => 'text',
                    'label' => 'Title',
                    'placeholder' => 'Enter label',
                    'default' => null,
                    'index' => false,
                    'fillable' => true,
                    'hidden' => false,
                    'references' => null,
                    'param' => null,
                    'filter' => [
                        'type' => "string",
                        'light' => 255,
                        'nullable' => true,
                        'unique' => false,
                        'required' => true,
                        'max' => null,
                        'min' => null,
                        'mask' => null,
                    ]
                ]
            ],
            'form' => [['title']],
            'filter' => [['title']]
        ]
    ];

    /**
     * Configuration constructor.
     */
    public function __construct()
    {
        $this->setBasePath(base_path());
        $this->load();
    }

    /**
     * @return $this|Configuration
     */
    public function load(): Configuration
    {
        $fields = config($this->configFile . '.fields', $this->getFields());
        if (is_array($fields)) {
            $this->setFields($fields);
        }
        $generator = config($this->configFile . '.generator', $this->getGenerator());
        if (is_array($generator)) {
            $this->setGenerator($generator);
        }
        return $this;
    }

    /**
     * @param array $generator
     * @return Configuration
     */
    public function setGenerator(array $generator): self
    {
        $this->generator = $generator;
        return $this;
    }

    /**
     * @param array $fields
     * @return Configuration
     */
    public function setFields(array $fields): self
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @param string $name
     * @param string $field
     * @return Configuration
     */
    public function setField(string $name, string $field): self
    {
        $this->fields[$name] = $field;
        return $this;
    }

    public function setBasePath(string $path): self
    {
        $this->basePath = $path;
        return $this;
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @return array
     */
    public function getGenerator(): array
    {
        return $this->generator;
    }

    /**
     * @return string
     */
    public function getBasePath(): string
    {
        return $this->basePath;
    }
}
