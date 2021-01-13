<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'added_by' => NULL,
                'created_at' => '2020-08-14 04:26:15',
                'id' => 1,
                'is_parent' => 1,
                'parent_id' => NULL,
                'photo' => '/storage/photos/1/Category/mini-banner1.jpg',
                'slug' => 'mens-fashion',
                'status' => 'active',
                'summary' => NULL,
                'title' => 'Men\'s Fashion',
                'updated_at' => '2020-08-14 04:26:15',
            ),
            1 => 
            array (
                'added_by' => NULL,
                'created_at' => '2020-08-14 04:26:40',
                'id' => 2,
                'is_parent' => 1,
                'parent_id' => NULL,
                'photo' => '/storage/photos/1/Category/mini-banner2.jpg',
                'slug' => 'womens-fashion',
                'status' => 'active',
                'summary' => NULL,
                'title' => 'Women\'s Fashion',
                'updated_at' => '2020-08-14 04:26:40',
            ),
            2 => 
            array (
                'added_by' => NULL,
                'created_at' => '2020-08-14 04:27:10',
                'id' => 3,
                'is_parent' => 1,
                'parent_id' => NULL,
                'photo' => '/storage/photos/1/Category/mini-banner3.jpg',
                'slug' => 'kids',
                'status' => 'active',
                'summary' => NULL,
                'title' => 'Kid\'s',
                'updated_at' => '2020-08-14 04:27:42',
            ),
            3 => 
            array (
                'added_by' => NULL,
                'created_at' => '2020-08-14 04:32:14',
                'id' => 4,
                'is_parent' => 0,
                'parent_id' => 1,
                'photo' => NULL,
                'slug' => 't-shirts',
                'status' => 'active',
                'summary' => NULL,
                'title' => 'T-shirt\'s',
                'updated_at' => '2020-08-14 04:32:14',
            ),
            4 => 
            array (
                'added_by' => NULL,
                'created_at' => '2020-08-14 04:32:49',
                'id' => 5,
                'is_parent' => 0,
                'parent_id' => 1,
                'photo' => NULL,
                'slug' => 'jeans-pants',
                'status' => 'active',
                'summary' => NULL,
                'title' => 'Jeans pants',
                'updated_at' => '2020-08-14 04:32:49',
            ),
            5 => 
            array (
                'added_by' => NULL,
                'created_at' => '2020-08-14 04:33:37',
                'id' => 6,
                'is_parent' => 0,
                'parent_id' => 1,
                'photo' => NULL,
                'slug' => 'sweater-jackets',
                'status' => 'active',
                'summary' => NULL,
                'title' => 'Sweater & Jackets',
                'updated_at' => '2020-08-14 04:33:37',
            ),
            6 => 
            array (
                'added_by' => NULL,
                'created_at' => '2020-08-14 04:34:04',
                'id' => 7,
                'is_parent' => 0,
                'parent_id' => 1,
                'photo' => NULL,
                'slug' => 'rain-coats-trenches',
                'status' => 'active',
                'summary' => NULL,
                'title' => 'Rain Coats & Trenches',
                'updated_at' => '2020-08-14 04:34:04',
            ),
        ));
        
        
    }
}