<?php

    use App\Models\Post;
    use App\Models\PostComment;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class PostCommentFactory extends Factory
    {
        protected $model = PostComment::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition(): array
        {
            return [
                'user_id' => $this->faker->randomNumber(),
                'comment' => $this->faker->word,
                'status' => $this->faker->word,
                'replied_comment' => $this->faker->word,
                'parent_id' => $this->faker->randomNumber(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'post_id' => function () {
                    return Post::factory()->create()->id;
                },
            ];
        }
    }
