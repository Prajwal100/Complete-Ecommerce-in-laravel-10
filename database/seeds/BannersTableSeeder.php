<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('banners')->delete();
        
        \DB::table('banners')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Lorem Ipsum is',
                'slug' => 'lorem-ipsum-is',
                'photo' => '/storage/photos/1/Banner/banner-01.jpg',
            'description' => '<h2><span style="font-weight: bold; color: rgb(99, 99, 99);">Up to 10%</span></h2>',
                'status' => 'active',
                'created_at' => '2020-08-14 01:47:38',
                'updated_at' => '2020-08-14 01:48:21',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Lorem Ipsum',
                'slug' => 'lorem-ipsum',
                'photo' => '/storage/photos/1/Banner/banner-07.jpg',
                'description' => '<p>Up to 90%</p>',
                'status' => 'active',
                'created_at' => '2020-08-14 01:50:23',
                'updated_at' => '2020-08-14 01:50:23',
            ),
            2 => 
            array (
                'id' => 4,
                'title' => 'Banner',
                'slug' => 'banner',
                'photo' => '/storage/photos/1/Banner/banner-06.jpg',
            'description' => '<h2><span style="color: rgb(156, 0, 255); font-size: 2rem; font-weight: bold;">Up to 40%</span><br></h2><h2><span style="color: rgb(156, 0, 255);"></span></h2>',
                'status' => 'active',
                'created_at' => '2020-08-17 20:46:59',
                'updated_at' => '2020-08-17 20:46:59',
            ),
        ));
        
        
    }
}