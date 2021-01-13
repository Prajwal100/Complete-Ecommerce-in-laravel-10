<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(SettingTableSeeder::class);

        $this->call(BannersTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CouponsTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
        $this->call(PostCategoriesTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(PostCommentsTableSeeder::class);
        $this->call(PostTagsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ProductReviewsTableSeeder::class);
        $this->call(ShippingsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(CartsTableSeeder::class);
    }
}
