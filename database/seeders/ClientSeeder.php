<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run()
    {
        $clients = [
            [
                'name' => 'Juan',
                'last name' => 'Pérez',
                'address' => 'Av. Principal 123',
                'comments' => 'Cliente frecuente',
                'phone' => '987654321',
                'email' => 'juan.perez@email.com'
            ],
            [
                'name' => 'María',
                'last name' => 'García',
                'address' => 'Jr. Las Flores 456',
                'comments' => 'Prefiere entregas por la tarde',
                'phone' => '987654322',
                'email' => 'maria.garcia@email.com'
            ],
            [
                'name' => 'Carlos',
                'last name' => 'López',
                'address' => 'Calle Los Pinos 789',
                'comments' => 'Cliente corporativo',
                'phone' => '987654323',
                'email' => 'carlos.lopez@email.com'
            ],
            [
                'name' => 'Ana',
                'last name' => 'Martínez',
                'address' => 'Av. Las Palmeras 234',
                'comments' => 'Horario de atención: 9am-5pm',
                'phone' => '987654324',
                'email' => 'ana.martinez@email.com'
            ],
            [
                'name' => 'Pedro',
                'last name' => 'Sánchez',
                'address' => 'Jr. Los Olivos 567',
                'comments' => 'Cliente nuevo',
                'phone' => '987654325',
                'email' => 'pedro.sanchez@email.com'
            ]
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
} 