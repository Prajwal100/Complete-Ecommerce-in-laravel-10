<?php

    namespace Database\Factories;

    use App\Models\Setting;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class SettingFactory extends Factory
    {
        protected $model = Setting::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition(): array
        {
            return [
                'description' => $this->faker->text,
                'short_des'   => $this->faker->word,
                'logo'        => $this->faker->word,
                'photo'       => $this->faker->word,
                'address'     => $this->faker->address,
                'phone'       => $this->faker->phoneNumber,
                'email'       => $this->faker->unique()->safeEmail,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ];
        }
    }
