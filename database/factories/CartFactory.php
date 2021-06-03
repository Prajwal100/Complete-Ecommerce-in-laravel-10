<?php

    use App\Models\Cart;
    use App\Models\Order;
    use App\Models\Product;
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
                'user_id' => $this->faker->randomNumber(),
                'price' => $this->faker->randomFloat(),
                'status' => $this->faker->word,
                'quantity' => $this->faker->randomNumber(),
                'amount' => $this->faker->randomFloat(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'product_id' => function () {
                    return Product::factory()->create()->id;
                },
                'order_id' => function () {
                    return Order::factory()->create()->id;
                },
            ];
        }
    }
