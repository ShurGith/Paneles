<?php

namespace Database\Seeders;

use App\Models\Owner;
use App\Models\Patient;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'JuanJota',
            'email' => 'esnola@gmail.com',
            'password' => Hash::make('1234'),
            'phone' => '6183456789',
            'photo' => 'images/veterinarios/1735091634-john_lennon.png',
        ]);
        User::factory()->create([
            'name' => 'Mario',
            'email' => 'mario@gmail.com',
            'phone' => '188898721',
            'password' => Hash::make('1234'),
        ]);

         User::factory(10)->create();
         Owner::factory(10)->create();
         Patient::factory(15)->create();
    }
}
