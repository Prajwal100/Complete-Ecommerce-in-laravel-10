<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('post_categories')->delete();
        
        \DB::table('post_categories')->insert(array (
            0 => 
            array (
                'created_at' => '2020-08-14 01:51:03',
                'id' => 1,
                'slug' => 'contrary',
                'status' => 'active',
                'title' => 'Travel',
                'updated_at' => '2020-08-14 01:51:39',
            ),
            1 => 
            array (
                'created_at' => '2020-08-14 01:51:22',
                'id' => 2,
                'slug' => 'richard',
                'status' => 'active',
                'title' => 'Electronics',
                'updated_at' => '2020-08-14 01:52:00',
            ),
            2 => 
            array (
                'created_at' => '2020-08-14 01:52:22',
                'id' => 3,
                'slug' => 'cloths',
                'status' => 'active',
                'title' => 'Cloths',
                'updated_at' => '2020-08-14 01:52:22',
            ),
            3 => 
            array (
                'created_at' => '2020-08-14 03:16:10',
                'id' => 4,
                'slug' => 'enjoy',
                'status' => 'active',
                'title' => 'enjoy',
                'updated_at' => '2020-08-14 03:16:10',
            ),
            4 => 
            array (
                'created_at' => '2020-08-15 06:59:04',
                'id' => 5,
                'slug' => 'post-category',
                'status' => 'active',
                'title' => 'Post Category',
                'updated_at' => '2020-08-15 06:59:04',
            ),
        ));
        
        
    }
}