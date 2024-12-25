<?php

	namespace Database\Factories;

	use App\Models\Owner;
    use App\Models\Patient;
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
				//'photo' => $this->faker->word(),
				'type' => $this->faker->word(),
                'gender' => $this->faker->randomElement(['Male', 'Female']),
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
                'owner_id' => Owner::inRandomOrder()->value('id') ?: Owner::Factory(),
                'user_id' => User::inRandomOrder()->value('id') ?: User::Factory(),

			//	'owner_id' => Owner::factory(),
			//	'user_id' => User::factory(),
			];
		}
	}
