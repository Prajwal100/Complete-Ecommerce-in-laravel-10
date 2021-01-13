<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostTagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('post_tags')->delete();
        
        \DB::table('post_tags')->insert(array (
            0 => 
            array (
                'created_at' => '2020-08-14 01:53:52',
                'id' => 1,
                'slug' => 'enjoy',
                'status' => 'active',
                'title' => 'Enjoy',
                'updated_at' => '2020-08-14 01:53:52',
            ),
            1 => 
            array (
                'created_at' => '2020-08-14 01:54:09',
                'id' => 2,
                'slug' => '2020',
                'status' => 'active',
                'title' => '2020',
                'updated_at' => '2020-08-14 01:54:09',
            ),
            2 => 
            array (
                'created_at' => '2020-08-14 01:54:33',
                'id' => 3,
                'slug' => 'visit-nepal-2020',
                'status' => 'active',
                'title' => 'Visit nepal 2020',
                'updated_at' => '2020-08-14 01:54:33',
            ),
            3 => 
            array (
                'created_at' => '2020-08-15 06:59:31',
                'id' => 4,
                'slug' => 'tag',
                'status' => 'active',
                'title' => 'Tag',
                'updated_at' => '2020-08-15 06:59:31',
            ),
        ));
        
        
    }
}