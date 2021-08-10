<?php

  namespace Database\Seeders;

  use App\Models\Banner;
  use App\Models\Brand;
  use App\Models\Cart;
  use App\Models\Order;
  use App\Models\PostComment;
  use App\Models\Setting;
  use App\Models\Tag;
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
      $this->call(PermissionTableSeeder::class);
      $this->call(CouponSeeder::class);
      Setting::factory()->create();
      Tag::factory()->count(100)->create();
      Banner::factory()->count(5)->create();
      Brand::factory()->count(10)->create();
      $this->call(CategoryProductSeeder::class);
      Order::factory()->count(200)->create();
      $this->call(CategoryPostSeeder::class);
      // Message::factory()->count(50)->create();
      Cart::factory()->count(200)->create();
      PostComment::factory()->count(200)->create();
    }
  }


