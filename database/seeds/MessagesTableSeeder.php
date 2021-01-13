<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('messages')->delete();
        
        \DB::table('messages')->insert(array (
            0 => 
            array (
                'created_at' => '2020-08-14 08:00:01',
                'email' => 'prajwal.iar@gmail.com',
                'id' => 1,
                'message' => 'Hello sir i am from kathmandu nepal.',
                'name' => 'Prajwal Rai',
                'phone' => '9807009999',
                'photo' => NULL,
                'read_at' => '2020-08-14 08:25:46',
                'subject' => 'About price',
                'updated_at' => '2020-08-14 08:25:46',
            ),
            1 => 
            array (
                'created_at' => '2020-08-15 07:52:39',
                'email' => 'prajwal.iar@gmail.com',
                'id' => 2,
                'message' => 'Hello i am Prajwal Rai',
                'name' => 'Prajwal Rai',
                'phone' => '9800099000',
                'photo' => NULL,
                'read_at' => '2020-08-18 03:04:15',
                'subject' => 'About Price',
                'updated_at' => '2020-08-18 03:04:16',
            ),
            2 => 
            array (
                'created_at' => '2020-08-17 21:15:12',
                'email' => 'prajwal.iar@gmail.com',
                'id' => 3,
                'message' => 'hello sir sdfdfd dfdjf ;dfjd fd ldkfd',
                'name' => 'Prajwal Rai',
                'phone' => '1200990009',
                'photo' => NULL,
                'read_at' => NULL,
                'subject' => 'lorem ipsum',
                'updated_at' => '2020-08-17 21:15:12',
            ),
        ));
        
        
    }
}