<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('coupons')->delete();
        
        \DB::table('coupons')->insert(array (
            0 => 
            array (
                'code' => 'abc123',
                'created_at' => NULL,
                'id' => 1,
                'status' => 'active',
                'type' => 'fixed',
                'updated_at' => NULL,
                'value' => '300.00',
            ),
            1 => 
            array (
                'code' => '111111',
                'created_at' => NULL,
                'id' => 2,
                'status' => 'active',
                'type' => 'percent',
                'updated_at' => NULL,
                'value' => '10.00',
            ),
            2 => 
            array (
                'code' => 'abcd',
                'created_at' => '2020-08-17 20:54:58',
                'id' => 5,
                'status' => 'active',
                'type' => 'fixed',
                'updated_at' => '2020-08-17 20:54:58',
                'value' => '250.00',
            ),
        ));
        
        
    }
}