<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Builder;

use Zebrainsteam\LaravelGeneratorPackage\Configuration;
use Zebrainsteam\LaravelGeneratorPackage\Facades\Field;

class Package
{
    /**
     * @var string
     */
    private string $name = 'name new package';
    private string $description = 'Description new package';

    /**
     * @var string
     */
    private string $packageVendor = '';
    private string $packageName = '';
    private string $model = 'Test';
    private string $table = 'test';

    /**
     * @var bool
     */
    private bool $generator_tests = true;
    private bool $generator_seed = true;
    private bool $generator_api = true;
    private bool $generator_api_frontend = true;
    private bool $generator_laravel_admin = true;

    /**
     * @var array
     */
    private array $fields = [];
    private array $form = [];
    private array $filter = [];

    /**
     * @param array $package
     * @return $this
     */
    public function init(array $package): self
    {
        $this->setName($package['name'] ?? $this->name);
        $this->setDescription($package['description'] ?? $this->description);
        $this->setPackageVendor($package['vendor'] ?? $this->packageVendor);
        $this->setPackageName($package['package'] ?? $this->packageName);
        $this->setModel($package['model'] ?? ucfirst($this->getPackageVendor()) . ucfirst($this->getPackageName()));
        $this->setTable($package['table'] ?? $this->getPackageVendor() . '_' . $this->getPackageName());

        $this->setGeneratorTests($package['generator']['tests'] ?? $this->generator_tests);
        $this->setGeneratorSeed($package['generator']['seed'] ?? $this->generator_seed);
        $this->setGeneratorApi($package['generator']['api'] ?? $this->generator_api);
        $this->setGeneratorApiFrontend($package['generator']['api_frontend'] ?? $this->generator_api_frontend);
        $this->setGeneratorLaravelAdmin($package['generator']['laravel_admin'] ?? $this->generator_laravel_admin);

        $this->setFields($package['fields'] ?? null);
        $this->setForm($package['form'] ?? $this->form);
        $this->setFilter($package['filter'] ?? $this->filter);

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string $packageVendor
     * @return $this
     */
    public function setPackageVendor(string $packageVendor): self
    {
        $this->packageVendor = mb_strtolower($packageVendor);
        return $this;
    }

    /**
     * @param string $packageName
     * @return $this
     */
    public function setPackageName(string $packageName): self
    {
        $this->packageName = mb_strtolower($packageName);
        return $this;
    }

    /**
     * @param string $model
     * @return $this
     */
    public function setModel(string $model): self
    {
        $this->model = ucfirst(mb_strtolower($model));
        return $this;
    }

    /**
     * @param string $table
     * @return $this
     */
    public function setTable(string $table): self
    {
        $this->table = mb_strtolower($table);
        return $this;
    }

    /**
     * @param bool $generator_tests
     * @return $this
     */
    public function setGeneratorTests(bool $generator_tests = true): self
    {
        $this->generator_tests = $generator_tests;
        return $this;
    }

    /**
     * @param bool $generator_seed
     * @return $this
     */
    public function setGeneratorSeed(bool $generator_seed = true): self
    {
        $this->generator_seed = $generator_seed;
        return $this;
    }

    /**
     * @param bool $generator_api
     * @return $this
     */
    public function setGeneratorApi(bool $generator_api = true): self
    {
        $this->generator_api = $generator_api;
        return $this;
    }

    /**
     * @param bool $generator_api_frontend
     * @return $this
     */
    public function setGeneratorApiFrontend(bool $generator_api_frontend = true): self
    {
        $this->generator_api_frontend = $generator_api_frontend;
        return $this;
    }

    /**
     * @param bool $generator_laravel_admin
     * @return $this
     */
    public function setGeneratorLaravelAdmin(bool $generator_laravel_admin = true): self
    {
        $this->generator_laravel_admin = $generator_laravel_admin;
        return $this;
    }

    /**
     * @param array|null $fields
     * @return $this
     */
    public function setFields(?array $fields = null): self
    {
        if (is_null($fields)) {
            return $this;
        }
        foreach ($fields as $fieldKey => $fieldParam) {
            $this->fields[$fieldKey] = Field::loadFieldFromArray($fieldKey, $fieldParam);
        }
        return $this;
    }

    /**
     * @param array $form
     * @return $this
     */
    public function setForm(array $form): self
    {
        $this->form = $form;
        return $this;
    }

    /**
     * @param array $filter
     * @return $this
     */
    public function setFilter(array $filter): self
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->spacer($this->getPackageVendor()) . '\\' . $this->spacer($this->getPackageName());
    }

    /**
     * @return string
     */
    public function getNamespaceSlashes(): string
    {
        return $this->spacer($this->getPackageVendor()) . '\\\\' . $this->spacer($this->getPackageName());
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescripton(): string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getPackageVendor(): ?string
    {
        return $this->packageVendor;
    }

    /**
     * @return string|null
     */
    public function getPackageName(): ?string
    {
        return $this->packageName;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * @return bool
     */
    public function getGeneratorTests(): bool
    {
        return $this->generator_tests;
    }

    /**
     * @return bool
     */
    public function getGeneratorSeed(): bool
    {
        return $this->generator_seed;
    }

    /**
     * @return bool
     */
    public function getGeneratorApi(): bool
    {
        return $this->generator_api;
    }

    /**
     * @return bool
     */
    public function getGeneratorApiFrontend(): bool
    {
        return $this->generator_api_frontend;
    }

    /**
     * @return bool
     */
    public function getGeneratorLaravelAdmin(): bool
    {
        return $this->generator_laravel_admin;
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
    public function getForm(): array
    {
        return $this->form;
    }

    /**
     * @return array
     */
    public function getFilter(): array
    {
        return $this->filter;
    }

    /**
     * @param string|null $path
     * @return string
     */
    public function getPath(?string $path = null): ?string
    {
        $basePath = app(Configuration::class)->getBasePath();
        return $basePath . '/packages/' . $this->getPackageVendor() . '/' . $this->getPackageName() . '/' . $path;
    }

    /**
     * @param string $name
     * @return string
     */
    public function spacer(string $name): string
    {
        $name = preg_replace('~[^a-z0-9]~isuU', ' ', $name);
        $name = ucwords($name);
        $name = str_replace(' ', '', $name);
        return $name;
    }
}
