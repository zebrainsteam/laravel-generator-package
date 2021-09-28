<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Form;

use Exception;
use Zebrainsteam\LaravelGeneratorPackage\Configuration;
use Zebrainsteam\LaravelGeneratorPackage\Contracts\FieldInterface;
use Zebrainsteam\LaravelGeneratorPackage\Exceptions\FieldDoesNotExistsException;

class Field
{
    protected Configuration $config;

    /**
     * Form constructor.
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    /**
     * Find field class.
     *
     * @param string $method
     * @return bool|string
     */
    public function findFieldClass(string $method)
    {
        if (mb_strlen(trim($method)) == 0) {
            return false;
        }
        $fields = $this->config->getFields();
        if (isset($fields[$method])) {
            $class = $fields[$method];
        }
        if (isset($class) && class_exists($class)) {
            return $class;
        }
        return false;
    }

    /**
     * Generate a Field object and add to form builder if Field exists.
     *
     * @param string $method
     * @param $args
     * @return FieldInterface
     * @throws FieldDoesNotExistsException
     */
    public function __call(string $method, array $args): FieldInterface
    {
        if ($className = $this->findFieldClass($method)) {
            /** @scrutinizer ignore-call */
            return app($className)->init($args);
        }
        throw new FieldDoesNotExistsException();
    }

    /**
     * @param string $column
     * @param array $config
     * @return FieldInterface
     * @throws Exception
     */
    public function loadFieldFromArray(string $column, array $config): FieldInterface
    {
        $className = $this->findFieldClass($config['field']);
        /** @noinspection IsEmptyFunctionUsageInspection */
        if (!$className) {
            throw new Exception('Field ' . $column . ':' . $config['field'] . ' not found and not available for use');
        }
        $field = app($className)->init([$column, $config['label']]);
        $field->setLabel($config['label'] ?? '');
        $field->setPlaceholder($config['placeholder'] ?? '');
        $field->default($config['default'] ?? null);
        $field->index($config['index'] ?? false);
        $field->fillable($config['fillable'] ?? true);
        $field->hidden($config['hidden'] ?? false);
        $field->nullable($config['filter']['nullable'] ?? true);
        $field->unique($config['filter']['unique'] ?? false);
        $field->required($config['filter']['required'] ?? false);
        $field->max($config['filter']['max'] ?? null);
        $field->min($config['filter']['min'] ?? null);
        $field->setParam($config['param'] ?? null);
        $field->setMask($config['filter']['mask'] ?? null);
        if (
            isset($config['references']['model'])
            && isset($config['references']['table'])
            && isset($config['references']['field'])
        ) {
            $field->references(
                $config['references']['model'],
                $config['references']['table'],
                $config['references']['field'],
                $config['references']['has'] ?? 'hasMany',
            );
        }
        return $field;
    }
}
