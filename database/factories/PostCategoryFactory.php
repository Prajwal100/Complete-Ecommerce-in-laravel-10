<?php

    namespace Database\Factories;

    use App\Models\PostCategory;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class PostCategoryFactory extends Factory
    {
        protected $model = PostCategory::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition(): array
        {
            return [
                'title'      => $this->faker->unique()->title,
                'slug'       => $this->faker->slug,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
    }
