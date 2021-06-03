<?php

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
                'title' => $this->faker->word,
                'slug' => $this->faker->slug,
                'photo' => $this->faker->word,
                'description' => $this->faker->text,
                'status' => $this->faker->word,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
    }
