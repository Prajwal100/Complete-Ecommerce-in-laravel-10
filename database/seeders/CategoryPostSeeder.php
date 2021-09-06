<?php

    namespace Database\Seeders;

    use App\Models\Category;
    use App\Models\Post;
    use Illuminate\Database\Seeder;

    class CategoryPostSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $categories = Category::factory()->count(10)->create();
            Post::factory()
                ->count(100)
                ->hasAttached($categories)
                ->create();
        }
    }
