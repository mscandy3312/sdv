<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('es_ES');

        // Crear 30 clientes
        for ($i = 0; $i < 30; $i++) {
            Customer::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'dni' => $faker->unique()->numerify('########'),
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'status' => true
            ]);
        }
    }
}
