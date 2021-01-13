<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostCommentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('post_comments')->delete();
        
        \DB::table('post_comments')->insert(array (
            0 => 
            array (
                'comment' => 'Testing comment edited',
                'created_at' => '2020-08-14 07:08:42',
                'id' => 1,
                'parent_id' => NULL,
                'post_id' => 2,
                'replied_comment' => NULL,
                'status' => 'active',
                'updated_at' => '2020-08-15 06:59:58',
                'user_id' => 1,
            ),
            1 => 
            array (
                'comment' => 'testing 2',
                'created_at' => '2020-08-14 07:11:03',
                'id' => 2,
                'parent_id' => 1,
                'post_id' => 2,
                'replied_comment' => NULL,
                'status' => 'active',
                'updated_at' => '2020-08-14 07:11:03',
                'user_id' => 3,
            ),
            2 => 
            array (
                'comment' => 'That\'s cool',
                'created_at' => '2020-08-14 07:12:27',
                'id' => 3,
                'parent_id' => 2,
                'post_id' => 2,
                'replied_comment' => NULL,
                'status' => 'active',
                'updated_at' => '2020-08-14 07:12:27',
                'user_id' => 2,
            ),
            3 => 
            array (
                'comment' => 'nice',
                'created_at' => '2020-08-15 07:31:19',
                'id' => 4,
                'parent_id' => NULL,
                'post_id' => 2,
                'replied_comment' => NULL,
                'status' => 'active',
                'updated_at' => '2020-08-15 07:31:19',
                'user_id' => 1,
            ),
            4 => 
            array (
                'comment' => 'nice blog',
                'created_at' => '2020-08-15 07:51:01',
                'id' => 5,
                'parent_id' => NULL,
                'post_id' => 5,
                'replied_comment' => NULL,
                'status' => 'active',
                'updated_at' => '2020-08-15 07:51:01',
                'user_id' => 3,
            ),
            5 => 
            array (
                'comment' => 'nice',
                'created_at' => '2020-08-17 21:13:29',
                'id' => 6,
                'parent_id' => NULL,
                'post_id' => 3,
                'replied_comment' => NULL,
                'status' => 'active',
                'updated_at' => '2020-08-17 21:13:29',
                'user_id' => 2,
            ),
            6 => 
            array (
                'comment' => 'really',
                'created_at' => '2020-08-17 21:13:51',
                'id' => 7,
                'parent_id' => 6,
                'post_id' => 3,
                'replied_comment' => NULL,
                'status' => 'active',
                'updated_at' => '2020-08-17 21:13:51',
                'user_id' => 2,
            ),
        ));
        
        
    }
}