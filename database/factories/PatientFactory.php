<?php

    namespace Database\Factories;

    use App\Models\Animal;
    use App\Models\Owner;
    use App\Models\Patient;
    use App\Models\Raza;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class PatientFactory extends Factory
    {
        protected $model = Patient::class;

        public function definition(): array
        {
            return [
                'date_of_birth' => Carbon::now(),
                'name' => $this->faker->firstName(),
                'gender' => $this->faker->randomElement(['Macho', 'Hembra']),
                'animal_id' => Animal::value('id'),
                'raza_id' => Raza::inRandomOrder()->value('id'),
                'owner_id' => Owner::inRandomOrder()->value('id'),
                'user_id' => User::inRandomOrder()->value('id'),
                // 'created_at' => Carbon::now(),
                //  'updated_at' => Carbon::now(),

                //	'owner_id' => Owner::factory(),
                //	'user_id' => User::factory(),
            ];
        }
    }
