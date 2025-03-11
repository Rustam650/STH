<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'title' => 'Изготовление столешниц',
                'description' => 'Изготовление столешниц из натурального камня по индивидуальным размерам',
                'image' => 'services/countertops.jpg'
            ],
            [
                'title' => 'Облицовка фасадов',
                'description' => 'Облицовка фасадов зданий натуральным камнем',
                'image' => 'services/facades.jpg'
            ],
            [
                'title' => 'Изготовление лестниц',
                'description' => 'Изготовление и монтаж лестниц из натурального камня',
                'image' => 'services/stairs.jpg'
            ],
            [
                'title' => 'Реставрация изделий',
                'description' => 'Реставрация изделий из натурального камня',
                'image' => 'services/restoration.jpg'
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
} 