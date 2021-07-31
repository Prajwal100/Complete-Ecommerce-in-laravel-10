<?php

    namespace Database\Factories;

    use App\Models\Brand;
    use App\Models\Product;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class ProductFactory extends Factory
    {
        protected $model = Product::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition(): array
        {
            return [
                'title'       => $this->faker->unique(true)->word,
                'summary'     => $this->faker->text,
                'description' => $this->faker->text,
                'photo'       => $this->faker->imageUrl(640, 480),
                'stock'       => 100,
                'price'       => 2000,
                'discount'    => 10,
                'is_featured' => false,
                'brand_id'    => function () {
                    return Brand::factory()->create()->id;
                },
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ];
        }
    }
