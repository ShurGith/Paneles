<?php

    namespace Database\Factories;

    use App\Models\Animal;
    use App\Models\Animals_Razas;
    use App\Models\Raza;
    use Illuminate\Database\Eloquent\Factories\Factory;

    class Animals_RazasFactory extends Factory
    {
        protected $model = Animals_Razas::class;

        public function definition(): array
        {
            return [

                'animal_id' => Animal::inRandomOrder()->value('id'),
                'raza_id' => Raza::inRandomOrder()->value('id'),
            ];
        }
    }
