<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Facades;

class Field extends \Illuminate\Support\Facades\Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return \Zebrainsteam\LaravelGeneratorPackage\Form\Field::class;
    }
}
