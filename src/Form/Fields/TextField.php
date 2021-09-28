<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Form\Fields;

use Exception;
use Zebrainsteam\LaravelGeneratorPackage\Contracts\FieldInterface;

class TextField extends FieldAbstract
{
    /**
     * TextField init.
     * @param array $arguments
     * @return FieldInterface
     * @throws Exception
     */
    public function init(array $arguments): FieldInterface
    {
        parent::init($arguments);
        $this->setType('text');
        $this->setCast('string');
        return $this;
    }
}
