<?php

    namespace Database\Factories;

    use App\Models\Patient;
    use App\Models\Treatment;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class TreatmentFactory extends Factory
    {
        protected $model = Treatment::class;

        public function definition(): array
        {
            return [
                'description' => $this->faker->text(),
                'notes' => $this->faker->word(),
                'price' => $this->faker->randomNumber(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'patient_id' => Patient::inRandomOrder()->value('id'),
                'user_id' => User::inRandomOrder()->value('id'),

                //'patient_id' => Patient::factory(),
            ];
        }
    }
