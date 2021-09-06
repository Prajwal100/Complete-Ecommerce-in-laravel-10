<?php

    namespace Database\Factories;

    use App\Models\Notification;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Carbon;

    class NotificationFactory extends Factory
    {
        protected $model = Notification::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition(): array
        {
            return [
                'type'            => $this->faker->word,
                'notifiable_type' => $this->faker->word,
                'notifiable_id'   => $this->faker->randomNumber(),
                'data'            => $this->faker->word,
                'read_at'         => $this->faker->word,
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ];
        }
    }
