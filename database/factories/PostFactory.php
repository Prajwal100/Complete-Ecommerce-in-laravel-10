<?php

    use App\Models\Post;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class PostFactory extends Factory
    {
        protected $model = Post::class;

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
                'description' => $this->faker->text,
                'quote' => $this->faker->word,
                'photo' => $this->faker->word,
                'tags' => $this->faker->word,
                'post_cat_id' => $this->faker->randomNumber(),
                'post_tag_id' => $this->faker->randomNumber(),
                'added_by' => $this->faker->randomNumber(),
                'status' => $this->faker->word,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
    }
