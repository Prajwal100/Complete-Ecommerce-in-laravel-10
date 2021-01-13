<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('orders')->delete();
        
        \DB::table('orders')->insert(array (
            0 => 
            array (
                'address1' => 'Koteshwor',
                'address2' => 'Kathmandu',
                'country' => 'NP',
                'coupon' => 573.9,
                'created_at' => '2020-08-14 07:20:44',
                'email' => 'prajwal.iar@gmail.com',
                'first_name' => 'Prajwal',
                'id' => 1,
                'last_name' => 'Rai',
                'order_number' => 'ORD-PMIQF5MYPK',
                'payment_method' => 'cod',
                'payment_status' => 'unpaid',
                'phone' => '9800887778',
                'post_code' => '44600',
                'quantity' => 6,
                'shipping_id' => 1,
                'status' => 'delivered',
                'sub_total' => 14399.0,
                'total_amount' => 13925.1,
                'updated_at' => '2020-08-14 09:37:37',
                'user_id' => 3,
            ),
            1 => 
            array (
                'address1' => 'Lalitpur',
                'address2' => NULL,
                'country' => 'NP',
                'coupon' => NULL,
                'created_at' => '2020-08-14 22:14:49',
                'email' => 'user@gmail.com',
                'first_name' => 'Sandhya',
                'id' => 2,
                'last_name' => 'Rai',
                'order_number' => 'ORD-YFF8BF0YBK',
                'payment_method' => 'cod',
                'payment_status' => 'unpaid',
                'phone' => '90000000990',
                'post_code' => NULL,
                'quantity' => 1,
                'shipping_id' => 1,
                'status' => 'delivered',
                'sub_total' => 1939.03,
                'total_amount' => 2039.03,
                'updated_at' => '2020-08-14 22:15:19',
                'user_id' => 2,
            ),
            2 => 
            array (
                'address1' => 'Kathmandu',
                'address2' => 'Kadaghari',
                'country' => 'NP',
                'coupon' => NULL,
                'created_at' => '2020-08-15 06:40:49',
                'email' => 'prajwal.iar@gmail.com',
                'first_name' => 'Prajwal',
                'id' => 3,
                'last_name' => 'Rai',
                'order_number' => 'ORD-1CKWRWTTIK',
                'payment_method' => 'paypal',
                'payment_status' => 'paid',
                'phone' => '9807009999',
                'post_code' => '44600',
                'quantity' => 1,
                'shipping_id' => 1,
                'status' => 'process',
                'sub_total' => 200.0,
                'total_amount' => 300.0,
                'updated_at' => '2020-08-17 20:52:40',
                'user_id' => 3,
            ),
            3 => 
            array (
                'address1' => 'Pokhara',
                'address2' => NULL,
                'country' => 'NP',
                'coupon' => 150.0,
                'created_at' => '2020-08-15 07:54:52',
                'email' => 'prajwal.iar@gmail.com',
                'first_name' => 'Prajwal',
                'id' => 4,
                'last_name' => 'Rai',
                'order_number' => 'ORD-HVO0KX0YHW',
                'payment_method' => 'paypal',
                'payment_status' => 'paid',
                'phone' => '9800098878',
                'post_code' => '44600',
                'quantity' => 6,
                'shipping_id' => 3,
                'status' => 'new',
                'sub_total' => 23660.0,
                'total_amount' => 23910.0,
                'updated_at' => '2020-08-15 07:54:52',
                'user_id' => 3,
            ),
        ));
        
        
    }
}