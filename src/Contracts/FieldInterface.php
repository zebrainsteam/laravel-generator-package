<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Contracts;

use Closure;
use Exception;

interface FieldInterface
{
    /**
     * TextField init.
     * @param array $arguments
     * @return FieldInterface
     * @throws Exception
     */
    public function init(array $arguments): FieldInterface;

    /**
     * @param string $label
     * @return FieldInterface
     */
    public function setLabel(string $label = ''): FieldInterface;

    /**
     * @param string $type
     * @return FieldInterface
     */
    public function setType(string $type): FieldInterface;

    /**
     * @param string $cast
     * @return FieldInterface
     */
    public function setCast(string $cast): FieldInterface;

    /**
     * @param string|null $mask
     * @return FieldInterface
     */
    public function setMask(?string $mask = null): FieldInterface;

    /**
     * @param string|null $placeholder
     * @return FieldInterface
     */
    public function setPlaceholder(?string $placeholder = null): FieldInterface;

    /**
     * @param int|null $light
     * @return $this
     */
    public function max(?int $light = null): FieldInterface;

    /**
     * @param int|null $light
     * @return $this
     */
    public function min(?int $light = null): FieldInterface;

    /**
     * @param mixed|null $value
     * @return FieldInterface
     */
    public function default($value = null): FieldInterface;

    /**
     * @param array|null $param
     * @return FieldInterface
     */
    public function setParam(array $param = null): FieldInterface;

    /**
     * @param string $model
     * @param string $table
     * @param string $field
     * @param string $hasMany
     * @return FieldInterface
     * @throws Exception
     */
    public function references(string $model, string $table, string $field, string $hasMany = 'hasMany'): FieldInterface;

    /**
     * @return FieldInterface
     */
    public function referencesDisabled(): FieldInterface;

    /**
     * @param bool $required
     * @return $this
     */
    public function required(bool $required = true): FieldInterface;

    /**
     * @param bool $index
     * @return FieldInterface
     */
    public function index(bool $index = true): FieldInterface;

    /**
     * @param bool $nullable
     * @return FieldInterface
     */
    public function nullable(bool $nullable = true): FieldInterface;

    /**
     * @param bool $fillable
     * @return FieldInterface
     */
    public function fillable(bool $fillable = true): FieldInterface;

    /**
     * @param bool $unique
     * @return FieldInterface
     */
    public function unique(bool $unique = true): FieldInterface;

    /**
     * @param bool $hidden
     * @return FieldInterface
     */
    public function hidden(bool $hidden = true): FieldInterface;

    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @return string
     */
    public function getColumn(): string;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return string|null
     */
    public function getCast(): ?string;

    /**
     * @return string|null
     */
    public function getMask(): ?string;

    /**
     * @return string|null
     */
    public function getReferencesModel(): ?string;

    /**
     * @return string|null
     */
    public function getReferencesTable(): ?string;

    /**
     * @return string|null
     */
    public function getReferencesField(): ?string;

    /**
     * @return string
     */
    public function getReferencesHas(): string;

    /**
     * @return string|null
     */
    public function getPlaceholder(): ?string;

    /**
     * @return mixed
     */
    public function getDefault();

    /**
     * @return int|null
     */
    public function getMax(): ?int;

    /**
     * @return int|null
     */
    public function getMin(): ?int;

    /**
     * @return array|null
     */
    public function getParam(): ?array;

    /**
     * @return bool
     */
    public function isFillable(): bool;

    /**
     * @return bool
     */
    public function isHidden(): bool;

    /**
     * @return bool
     */
    public function isRequired(): bool;

    /**
     * @return bool
     */
    public function isIndex(): bool;

    /**
     * @return bool
     */
    public function isNullable(): bool;

    /**
     * @return bool
     */
    public function isUnique(): bool;
}
