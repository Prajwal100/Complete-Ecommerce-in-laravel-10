<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('brands')->delete();
        
        \DB::table('brands')->insert(array (
            0 => 
            array (
                'created_at' => '2020-08-14 04:23:00',
                'id' => 1,
                'slug' => 'adidas',
                'status' => 'active',
                'title' => 'Adidas',
                'updated_at' => '2020-08-14 04:23:00',
            ),
            1 => 
            array (
                'created_at' => '2020-08-14 04:23:08',
                'id' => 2,
                'slug' => 'nike',
                'status' => 'active',
                'title' => 'Nike',
                'updated_at' => '2020-08-14 04:23:08',
            ),
            2 => 
            array (
                'created_at' => '2020-08-14 04:23:48',
                'id' => 3,
                'slug' => 'kappa',
                'status' => 'active',
                'title' => 'Kappa',
                'updated_at' => '2020-08-14 04:23:48',
            ),
            3 => 
            array (
                'created_at' => '2020-08-14 04:24:08',
                'id' => 4,
                'slug' => 'prada',
                'status' => 'active',
                'title' => 'Prada',
                'updated_at' => '2020-08-14 04:24:08',
            ),
            4 => 
            array (
                'created_at' => '2020-08-17 20:50:31',
                'id' => 6,
                'slug' => 'brand',
                'status' => 'active',
                'title' => 'Brand',
                'updated_at' => '2020-08-17 20:50:31',
            ),
        ));
        
        
    }
}