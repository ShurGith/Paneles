<?php

    namespace Database\Factories;

    use App\Models\Animal;
    use App\Models\Owner;
    use App\Models\Patient;
    use App\Models\Raza;
    use App\Models\User;

    use Faker\Core\DateTime;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class PatientFactory extends Factory
    {
        protected $model = Patient::class;

        public function definition(): array
        {
          /*  $max=Animal::count();

            $a=rand(1, $max);
            for($i=$a; $i < $max ; $i++){
                if(Raza::where('animal_id', $i)->count() > 0){
                    $animalId = $i;
                    break;
                }

            }*/
            $date_now = date('d-m-Y');
            $pasado = strtotime('-1230 day', strtotime($date_now));

            $razaId = rand(1, Raza::count());
            $animalId = Raza::where('id', $razaId)->value('animal_id');
            return [
                'date_of_birth' =>date('Y-m-d',$pasado),//Carbon::now(),
                'name' => $this->faker->firstName(),
                'gender' => $this->faker->randomElement(['Macho', 'Hembra']),
                'raza_id' => 13,//intval($razaId),
                'animal_id' => 2,//intval($animalId),
                'owner_id' => 2,// rand(1, Owner::count()),
                'user_id' =>1, //rand(1, User::count()),
                // 'created_at' => Carbon::now(),
                //  'updated_at' => Carbon::now(),

                //	'owner_id' => Owner::factory(),
                //	'user_id' => User::factory(),
            ];
        }
    }
