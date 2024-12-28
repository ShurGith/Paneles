<?php

    namespace Database\Factories;

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

            $date_now = date('d-m-Y');
            $pasado = strtotime('-1230 day', strtotime($date_now));

            $razaId = rand(1, Raza::count());
            $animalId = Raza::where('id', $razaId)->value('animal_id');
            return [
                'date_of_birth' => date('Y-m-d', $pasado),//Carbon::now(),
                'name' => $this->faker->firstName(),
                'gender' => $this->faker->randomElement(['Macho', 'Hembra']),
                'raza_id' => intval($razaId),
                'animal_id' => intval($animalId),
                'owner_id' => rand(Owner::min('id'), Owner::max('id')),
               // 'user_id' => rand(1, User::count()),
                'created_at' => Carbon::now()
            ];
        }
    }
