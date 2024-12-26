<?php

    namespace Database\Factories;

    use App\Models\Raza;
    use Illuminate\Database\Eloquent\Factories\Factory;

    class RazaFactory extends Factory
    {
        protected $model = Raza::class;

        public function definition(): array
        {
            return [
                'name' => $this->faker->randomElement(['Persa', 'Maine Coon', 'Collin', 'Siamés', 'Coker', 'YorkShire', 'Bulldog', 'Labrador', 'Poodle', 'Golden Retriever', 'Siames', 'Pomeranian', 'Chihuahua', 'Bull Terrier', 'Podenco']),
                // 'animal_id' => Animal::inRandomOrder()->value('id') ?: Animal::Factory(),
            ];
        }
    }
