<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StoneType;

class StoneTypeSeeder extends Seeder
{
    public function run()
    {
        $stoneTypes = [
            [
                'title' => 'Мрамор',
                'description' => 'Элегантный натуральный камень с уникальными узорами',
                'full_description' => 'Мрамор - это метаморфическая горная порода, состоящая из перекристаллизованного карбоната кальция. Используется в строительстве и скульптуре с древних времен.',
                'image' => 'stone-types/marble.jpg'
            ],
            [
                'title' => 'Гранит',
                'description' => 'Прочный и долговечный натуральный камень',
                'full_description' => 'Гранит - это магматическая горная порода, состоящая в основном из кварца, полевого шпата и слюды. Известен своей прочностью и долговечностью.',
                'image' => 'stone-types/granite.jpg'
            ],
            [
                'title' => 'Кварцит',
                'description' => 'Твердый метаморфический камень с высокой устойчивостью',
                'full_description' => 'Кварцит - это метаморфическая горная порода, образованная из песчаника. Отличается высокой твердостью и устойчивостью к химическим воздействиям.',
                'image' => 'stone-types/quartzite.jpg'
            ]
        ];

        foreach ($stoneTypes as $stoneType) {
            StoneType::create($stoneType);
        }
    }
}