<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Form;

use Zebrainsteam\LaravelGeneratorPackage\Configuration;

class Filter
{
    protected Configuration $config;

    /**
     * @var bool
     */
    protected bool $required = true;
    protected bool $nullable = true;
    protected bool $unique = false;

    /**
     * @var string
     */
    protected string $type = 'string';

    /**
     * @var int
     */
    protected ?int $max = null;
    protected ?int $min = null;

    /**
     * @var string|null
     */
    protected ?string $mask = null;

    /**
     * Filter constructor.
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    /**
     * @param bool $nullable
     * @return Filter
     */
    public function nullable(bool $nullable = true): self
    {
        $this->nullable = $nullable;
        return $this;
    }

    /**
     * @param bool $unique
     * @return Filter
     */
    public function unique(bool $unique = true): self
    {
        $this->unique = $unique;
        return $this;
    }

    /**
     * @param string $type
     * @return Filter
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string|null $mask
     * @return Filter
     */
    public function setMask(?string $mask = null): self
    {
        $this->mask = $mask;
        return $this;
    }

    /**
     * @param bool $required
     * @return $this
     */
    public function required(bool $required = true): self
    {
        $this->required = $required;
        return $this;
    }

    /**
     * @param int|null $light
     * @return $this
     */
    public function max(?int $light = null): self
    {
        $this->max = $light;
        return $this;
    }

    /**
     * @param int|null $light
     * @return $this
     */
    public function min(?int $light = null): self
    {
        $this->min = $light;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getMask(): ?string
    {
        return $this->mask;
    }

    /**
     * @return bool
     */
    public function getRequired(): bool
    {
        return $this->required;
    }

    /**
     * @return int|null
     */
    public function getMax(): ?int
    {
        return $this->max;
    }

    /**
     * @return int|null
     */
    public function getMin(): ?int
    {
        return $this->min;
    }

    /**
     * @return bool
     */
    public function getNullable(): bool
    {
        return $this->nullable;
    }

    /**
     * @return bool
     */
    public function getUnique(): bool
    {
        return $this->unique;
    }
}
