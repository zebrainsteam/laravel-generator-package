<?php
// Zebrainsteam\LaravelGeneratorPackage

use Zebrainsteam\LaravelGeneratorPackage\Form\Fields\FloatField;
use Zebrainsteam\LaravelGeneratorPackage\Form\Fields\IntegerField;
use Zebrainsteam\LaravelGeneratorPackage\Form\Fields\StringField;
use Zebrainsteam\LaravelGeneratorPackage\Form\Fields\TextField;

return [
    'fields' => [
        'text' => TextField::class,
        'string' => StringField::class,
        'integer' => IntegerField::class,
        'float' => FloatField::class,
    ],
    'generator' => [
        /*
         * Package Zebrainsteam/test
         */
        [
            'name' => 'Name package',
            'description' => 'Description package',
            'vendor' => 'Zebrainsteam',
            'package' => 'test',
            'model' => 'test',
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
                        'nullable' => true,
                        'unique' => false,
                        'required' => true,
                        'max' => null,
                        'min' => null,
                        'mask' => null,
                    ]
                ]
            ],
            'form' => [
                [
                    'title',
                ],
            ],
            'filter' => [
                [
                    'title',
                ],
            ]
        ]
    ]
];
