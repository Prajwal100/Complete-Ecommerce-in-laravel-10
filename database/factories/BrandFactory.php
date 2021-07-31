<?php

    namespace Database\Factories;

    use App\Models\Brand;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class BrandFactory extends Factory
    {
        protected $model = Brand::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition(): array
        {
            return [
                'title'      => $this->faker->unique(true)->title,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
    }
