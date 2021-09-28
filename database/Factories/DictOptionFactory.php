<?php

declare(strict_types=1);

namespace Database\Factories\Zebrainsteam\LaravelGeneratorPackage\Models;

use Zebrainsteam\LaravelGeneratorPackage\Models\Dict;
use Zebrainsteam\LaravelGeneratorPackage\Models\DictOption;
use Illuminate\Database\Eloquent\Factories\Factory;

class DictOptionFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DictOption::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->slug,
            'json' => null,
            'dict_id' => Dict::factory(),
        ];
    }
}
