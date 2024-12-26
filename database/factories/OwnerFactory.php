<?php

    namespace Database\Factories;

    use App\Models\Owner;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class OwnerFactory extends Factory
    {
        protected $model = Owner::class;

        public function definition(): array
        {
            return [
                'email' => $this->faker->unique()->safeEmail(),
                'name' => $this->faker->name(),
                'phone' => $this->faker->phoneNumber(),
                'created_at' => Carbon::now(),
            ];
        }
    }
