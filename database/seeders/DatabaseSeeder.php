<?php

    namespace Database\Seeders;

    use App\Models\Animal;
    use App\Models\AnimalsRazas;
    use App\Models\Owner;
    use App\Models\Raza;
    use App\Models\User;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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

            $animales = ['Gato', 'Perro', 'Pez', 'Tortuga', 'Gallina', 'Loro', 'Vaca', 'Caballo'];

            foreach ($animales as $animal) {
                Animal::factory()->create([
                    'name' => $animal
                ]);
            }

            $razasAnimales = ['Persa', 'Maine Coon', 'Collin', 'Siamés', 'Cocker', 'YorkShire', 'Bulldog', 'Labrador', 'Poodle', 'Golden Retriever', 'Pomeranian', 'Chihuahua', 'Bull Terrier', 'Podenco', 'Loro Guinea', 'Rubia',];

            foreach ($razasAnimales as $raza) {
                Raza::factory()->create([
                    'name' => $raza,
                    'animal_id' => Animal::inRandomOrder()->value('id'),
                ]);
            }


            User::factory(10)->create();
            Owner::factory(10)->create();
            //Patient::factory(15)->create();
            // Treatment::factory(15)->create();
        }
    }
