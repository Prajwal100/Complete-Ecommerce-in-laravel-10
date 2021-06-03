<?php

    use App\Models\Order;
    use App\Models\Shipping;
    use App\Models\User;
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
                'order_number' => $this->faker->word,
                'sub_total' => $this->faker->randomFloat(),
                'coupon' => $this->faker->randomFloat(),
                'total_amount' => $this->faker->randomFloat(),
                'quantity' => $this->faker->randomNumber(),
                'payment_method' => $this->faker->word,
                'payment_status' => $this->faker->word,
                'status' => $this->faker->word,
                'first_name' => $this->faker->firstName,
                'last_name' => $this->faker->lastName,
                'email' => $this->faker->unique()->safeEmail,
                'phone' => $this->faker->phoneNumber,
                'country' => $this->faker->country,
                'post_code' => $this->faker->word,
                'address1' => $this->faker->address,
                'address2' => $this->faker->address,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'user_id' => function () {
                    return User::factory()->create()->id;
                },
                'shipping_id' => function () {
                    return Shipping::factory()->create()->id;
                },
            ];
        }
    }
