<?php

    namespace Database\Factories;

    use App\Models\Coupon;
    use Illuminate\Database\Eloquent\Factories\Factory;

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
                'code'  => $this->faker->word,
                'value' => $this->faker->randomFloat(),
            ];
        }
    }
