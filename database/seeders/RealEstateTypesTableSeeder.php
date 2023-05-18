<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RealEstateType;
use Illuminate\Support\Str;

class RealEstateTypesTableSeeder extends Seeder
{
    public function run()
    {
        $realEstateTypes = [
            'Квартира',
            'Будинок',
            'Котедж',
            'Таунхаус',
            'Садиба',
            'Дача'
        ];

        foreach ($realEstateTypes as $realEstateType) {
            RealEstateType::create([
                'name' => $realEstateType,
                'slug' => Str::slug($realEstateType, '-')
            ]);
        }
    }
}
