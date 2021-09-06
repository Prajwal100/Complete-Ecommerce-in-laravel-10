<?php

    namespace Database\Factories;

    use App\Models\Cart;
    use App\Models\Order;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class CartFactory extends Factory
    {
        protected $model = Cart::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition(): array
        {
            return [
                'user_id'    => $this->faker->numberBetween(1, 3),
                'price'      => $this->faker->numberBetween(1, 7777),
                'quantity'   => $this->faker->numberBetween(1, 7777),
                'amount'     => $this->faker->numberBetween(1, 7777),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'product_id' => $this->faker->numberBetween(1, 500),
                'order_id'   => function () {
                    return Order::factory()->create()->id;
                },
            ];
        }
    }
