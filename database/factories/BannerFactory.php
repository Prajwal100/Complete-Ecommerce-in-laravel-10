<?php

    namespace Database\Factories;

    use App\Models\Banner;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class BannerFactory extends Factory
    {
        protected $model = Banner::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition(): array
        {
            return [
                'title'       => $this->faker->unique()->word,
                'photo'       => $this->faker->word,
                'description' => $this->faker->text,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ];
        }
    }
