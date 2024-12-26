<?php

    namespace Database\Factories;

    use App\Models\Animal;
    use Illuminate\Database\Eloquent\Factories\Factory;

    class AnimalFactory extends Factory
    {
        protected $model = Animal::class;

//        public function run()
//        {
//
//            $animales = ['Gato', 'Perro', 'Pez', 'Tortuga', 'Gallina', 'Loro', 'Vaca', 'Caballo'];
//
//            DB::table('animals')->insert($animales);
//        }


        public function definition(): array
        {
            return [
                'name' => $this->faker->randomElement(['Gato', 'Perro', 'Pez', 'Tortuga', 'Gallina', 'Loro', 'Vaca', 'Caballo']),
                // 'raza_id' => Raza::inRandomOrder()->value('id') ?: Raza::Factory(),
                // DB::table('animal_raza')->create(['raza_id' => Raza::factory(), 'animal_id' => Animal::factory()]),
            ];
        }
    }
