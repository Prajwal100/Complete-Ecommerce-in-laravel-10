<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductReviewsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_reviews')->delete();
        
        \DB::table('product_reviews')->insert(array (
            0 => 
            array (
                'created_at' => '2020-08-15 07:44:05',
                'id' => 1,
                'product_id' => 2,
                'rate' => 5,
                'review' => 'nice product',
                'status' => 'active',
                'updated_at' => '2020-08-15 07:44:05',
                'user_id' => 3,
            ),
            1 => 
            array (
                'created_at' => '2020-08-17 21:08:14',
                'id' => 2,
                'product_id' => 9,
                'rate' => 5,
                'review' => 'nice',
                'status' => 'active',
                'updated_at' => '2020-08-17 21:18:31',
                'user_id' => 2,
            ),
        ));
        
        
    }
}