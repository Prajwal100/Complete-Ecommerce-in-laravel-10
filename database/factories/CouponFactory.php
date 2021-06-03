<?php

    use App\Models\Coupon;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class CouponFactory extends Factory
    {
        protected $model = Coupon::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition(): array
        {
            return [
                'code' => $this->faker->word,
                'type' => $this->faker->word,
                'value' => $this->faker->word,
                'status' => $this->faker->word,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
    }
