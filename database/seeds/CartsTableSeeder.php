<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CartsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('carts')->delete();
        
        \DB::table('carts')->insert(array (
            0 => 
            array (
                'amount' => 400.0,
                'created_at' => '2020-08-14 07:15:45',
                'id' => 1,
                'order_id' => 1,
                'price' => 200.0,
                'product_id' => 8,
                'quantity' => 2,
                'status' => 'new',
                'updated_at' => '2020-08-14 07:20:45',
                'user_id' => 3,
            ),
            1 => 
            array (
                'amount' => 1999.0,
                'created_at' => '2020-08-14 07:15:59',
                'id' => 2,
                'order_id' => 1,
                'price' => 1939.03,
                'product_id' => 7,
                'quantity' => 1,
                'status' => 'new',
                'updated_at' => '2020-08-14 07:20:45',
                'user_id' => 3,
            ),
            2 => 
            array (
                'amount' => 12000.0,
                'created_at' => '2020-08-14 07:16:12',
                'id' => 3,
                'order_id' => 1,
                'price' => 3600.0,
                'product_id' => 5,
                'quantity' => 3,
                'status' => 'new',
                'updated_at' => '2020-08-14 07:20:45',
                'user_id' => 3,
            ),
            3 => 
            array (
                'amount' => 1939.03,
                'created_at' => '2020-08-14 22:13:51',
                'id' => 4,
                'order_id' => 2,
                'price' => 1939.03,
                'product_id' => 7,
                'quantity' => 1,
                'status' => 'new',
                'updated_at' => '2020-08-14 22:14:59',
                'user_id' => 2,
            ),
            4 => 
            array (
                'amount' => 200.0,
                'created_at' => '2020-08-15 06:39:59',
                'id' => 5,
                'order_id' => 3,
                'price' => 200.0,
                'product_id' => 8,
                'quantity' => 1,
                'status' => 'new',
                'updated_at' => '2020-08-15 06:41:00',
                'user_id' => 3,
            ),
            5 => 
            array (
                'amount' => 380.0,
                'created_at' => '2020-08-15 07:44:53',
                'id' => 8,
                'order_id' => 4,
                'price' => 190.0,
                'product_id' => 9,
                'quantity' => 2,
                'status' => 'new',
                'updated_at' => '2020-08-15 07:54:53',
                'user_id' => 3,
            ),
            6 => 
            array (
                'amount' => 23280.0,
                'created_at' => '2020-08-15 07:45:29',
                'id' => 9,
                'order_id' => 4,
                'price' => 5820.0,
                'product_id' => 6,
                'quantity' => 4,
                'status' => 'new',
                'updated_at' => '2020-08-15 07:54:53',
                'user_id' => 3,
            ),
            7 => 
            array (
                'amount' => 270.0,
                'created_at' => '2020-08-17 21:07:33',
                'id' => 10,
                'order_id' => NULL,
                'price' => 270.0,
                'product_id' => 10,
                'quantity' => 1,
                'status' => 'new',
                'updated_at' => '2020-08-17 21:17:03',
                'user_id' => 2,
            ),
            8 => 
            array (
                'amount' => 380.0,
                'created_at' => '2020-08-17 21:08:35',
                'id' => 11,
                'order_id' => NULL,
                'price' => 190.0,
                'product_id' => 9,
                'quantity' => 2,
                'status' => 'new',
                'updated_at' => '2020-08-17 21:17:03',
                'user_id' => 2,
            ),
        ));
        
        
    }
}