<?php

    namespace Database\Factories;

    use App\Models\Shipping;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class ShippingFactory extends Factory
    {
        protected $model = Shipping::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition(): array
        {
            return [
                'type'       => $this->faker->word,
                'price'      => $this->faker->numberBetween(1, 100),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
    }
