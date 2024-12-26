<?php

    namespace Database\Factories;

    use App\Models\Animal;
    use Illuminate\Database\Eloquent\Factories\Factory;

    class AnimalFactory extends Factory
    {
        protected $model = Animal::class;

        public function definition(): array
        {
            return [
                'name' => $this->faker->randomElement(['Gato', 'Perro', 'Pez', 'Tortuga', 'Gallina', 'Loro', 'Vaca', 'Caballo']),
            ];
        }
    }
