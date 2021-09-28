<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\DataBase\Seeders;

use Zebrainsteam\LaravelGeneratorPackage\Models\DictOption;
use Zebrainsteam\LaravelGeneratorPackage\Models\Dict;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $dict = Dict::create([
            'name' => 'Статус',
            'type' => 'select',
        ]);
        $create = [
            [
                'name' => 'Активно',
                'json' => null,
                'dict_id' => $dict->id,
            ],
            [
                'name' => 'Не активно',
                'json' => null,
                'dict_id' => $dict->id,
            ],
        ];
        DictOption::insert($create);
        $dicts = Dict::factory(10)->create();
        foreach ($dicts as $dict) {
            DictOption::factory(rand(2,7))->state([
                'dict_id' => $dict->id,
            ])->create();
        }
    }
}
