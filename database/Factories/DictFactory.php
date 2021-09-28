<?php

declare(strict_types=1);

namespace Database\Factories\Zebrainsteam\LaravelGeneratorPackage\Models;

use Zebrainsteam\LaravelGeneratorPackage\Models\Dict;
use Illuminate\Database\Eloquent\Factories\Factory;

class DictFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dict::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->slug,
            'type' => 'select',
        ];
    }
}
