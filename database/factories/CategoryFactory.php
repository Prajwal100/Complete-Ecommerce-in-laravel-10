<?php

    use App\Models\Category;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class CategoryFactory extends Factory
    {
        protected $model = Category::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition(): array
        {
            return [
                'title' => $this->faker->word,
                'slug' => $this->faker->slug,
                'summary' => $this->faker->text,
                'photo' => $this->faker->word,
                'is_parent' => $this->faker->randomNumber(),
                'parent_id' => $this->faker->randomNumber(),
                'added_by' => $this->faker->randomNumber(),
                'status' => $this->faker->word,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
    }
