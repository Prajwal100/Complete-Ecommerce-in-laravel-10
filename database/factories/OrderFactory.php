<?php

    namespace Database\Factories;

    use App\Models\Order;
    use App\Models\Shipping;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class OrderFactory extends Factory
    {
        protected $model = Order::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition(): array
        {
            return [
                'order_number' => $this->faker->unique()->numberBetween(1, 9999),
                'sub_total'    => $this->faker->numberBetween(1, 500),
                'coupon'       => $this->faker->numberBetween(1, 5),
                'total_amount' => $this->faker->numberBetween(1, 500),
                'quantity'     => $this->faker->numberBetween(1, 500),
                'first_name'   => $this->faker->firstName,
                'last_name'    => $this->faker->lastName,
                'email'        => $this->faker->unique()->safeEmail,
                'phone'        => $this->faker->phoneNumber,
                'country'      => $this->faker->country,
                'post_code'    => $this->faker->word,
                'address1'     => $this->faker->address,
                'address2'     => $this->faker->address,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),

                'user_id'     => $this->faker->numberBetween(1, 3),
                'shipping_id' => function () {
                    return Shipping::factory()->create()->id;
                },
            ];
        }
    }
