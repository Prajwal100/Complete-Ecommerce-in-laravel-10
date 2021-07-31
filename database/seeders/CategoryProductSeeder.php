<?php

    namespace Database\Seeders;

    use App\Models\Category;
    use App\Models\Product;
    use Illuminate\Database\Seeder;

    class CategoryProductSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $categories = Category::factory()->count(10)->create();
            Product::factory()
                ->count(500)
                ->hasAttached($categories)
                ->create();
        }
    }
