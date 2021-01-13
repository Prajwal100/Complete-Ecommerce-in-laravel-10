<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShippingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('shippings')->delete();
        
        \DB::table('shippings')->insert(array (
            0 => 
            array (
                'created_at' => '2020-08-14 04:22:17',
                'id' => 1,
                'price' => '100.00',
                'status' => 'active',
                'type' => 'Kahtmandu',
                'updated_at' => '2020-08-14 04:22:17',
            ),
            1 => 
            array (
                'created_at' => '2020-08-14 04:22:41',
                'id' => 2,
                'price' => '300.00',
                'status' => 'active',
                'type' => 'Out of valley',
                'updated_at' => '2020-08-14 04:22:41',
            ),
            2 => 
            array (
                'created_at' => '2020-08-15 06:54:04',
                'id' => 3,
                'price' => '400.00',
                'status' => 'active',
                'type' => 'Pokhara',
                'updated_at' => '2020-08-15 06:54:04',
            ),
            3 => 
            array (
                'created_at' => '2020-08-17 20:50:48',
                'id' => 4,
                'price' => '400.00',
                'status' => 'active',
                'type' => 'Dharan',
                'updated_at' => '2020-08-17 20:50:48',
            ),
        ));
        
        
    }
}