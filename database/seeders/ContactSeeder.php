<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run()
    {
        $contacts = [
            [
                'title' => 'Телефон',
                'content' => '+7 (999) 123-45-67'
            ],
            [
                'title' => 'Email',
                'content' => 'info@stonehill.ru'
            ],
            [
                'title' => 'Адрес',
                'content' => 'г. Москва, ул. Каменная, д. 1'
            ],
            [
                'title' => 'Время работы',
                'content' => 'Пн-Пт: 9:00-18:00, Сб: 10:00-15:00'
            ]
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
} 