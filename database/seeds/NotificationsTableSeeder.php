<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notifications')->delete();
        
        \DB::table('notifications')->insert(array (
            0 => 
            array (
                'created_at' => '2020-08-15 07:31:21',
                'data' => '{"title":"New Comment created","actionURL":"http:\\/\\/e-shop.loc\\/blog-detail\\/where-can-i-get-some","fas":"fas fa-comment"}',
                'id' => '2145a8e3-687d-444a-8873-b3b2fb77a342',
                'notifiable_id' => 1,
                'notifiable_type' => 'App\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\StatusNotification',
                'updated_at' => '2020-08-15 07:31:21',
            ),
            1 => 
            array (
                'created_at' => '2020-08-15 07:54:52',
                'data' => '{"title":"New order created","actionURL":"http:\\/\\/localhost:8000\\/admin\\/order\\/4","fas":"fa-file-alt"}',
                'id' => '3af39f84-cab4-4152-9202-d448435c67de',
                'notifiable_id' => 1,
                'notifiable_type' => 'App\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\StatusNotification',
                'updated_at' => '2020-08-15 07:54:52',
            ),
            2 => 
            array (
                'created_at' => '2020-08-17 21:13:51',
                'data' => '{"title":"New Comment created","actionURL":"http:\\/\\/localhost:8000\\/blog-detail\\/the-standard-lorem-ipsum-passage-used-since-the-1500s","fas":"fas fa-comment"}',
                'id' => '4a0afdb0-71ad-4ce6-bc70-c92ef491a525',
                'notifiable_id' => 1,
                'notifiable_type' => 'App\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\StatusNotification',
                'updated_at' => '2020-08-17 21:13:51',
            ),
            3 => 
            array (
                'created_at' => '2020-08-14 07:12:28',
                'data' => '{"title":"New Comment created","actionURL":"http:\\/\\/e-shop.loc\\/blog-detail\\/where-can-i-get-some","fas":"fas fa-comment"}',
                'id' => '540ca3e9-0ff9-4e2e-9db3-6b5abc823422',
                'notifiable_id' => 1,
                'notifiable_type' => 'App\\User',
                'read_at' => '2020-08-15 07:30:44',
                'type' => 'App\\Notifications\\StatusNotification',
                'updated_at' => '2020-08-15 07:30:44',
            ),
            4 => 
            array (
                'created_at' => '2020-08-15 07:51:02',
                'data' => '{"title":"New Comment created","actionURL":"http:\\/\\/localhost:8000\\/blog-detail\\/the-standard-lorem-ipsum-passage","fas":"fas fa-comment"}',
                'id' => '5da09dd1-3ffc-43b0-aba2-a4260ba4cc76',
                'notifiable_id' => 1,
                'notifiable_type' => 'App\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\StatusNotification',
                'updated_at' => '2020-08-15 07:51:02',
            ),
            5 => 
            array (
                'created_at' => '2020-08-15 07:44:07',
                'data' => '{"title":"New Product Rating!","actionURL":"http:\\/\\/localhost:8000\\/product-detail\\/white-sports-casual-t","fas":"fa-star"}',
                'id' => '5e91e603-024e-45c5-b22f-36931fef0d90',
                'notifiable_id' => 1,
                'notifiable_type' => 'App\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\StatusNotification',
                'updated_at' => '2020-08-15 07:44:07',
            ),
            6 => 
            array (
                'created_at' => '2020-08-14 07:11:03',
                'data' => '{"title":"New Comment created","actionURL":"http:\\/\\/e-shop.loc\\/blog-detail\\/where-can-i-get-some","fas":"fas fa-comment"}',
                'id' => '73a3b51a-416a-4e7d-8ca2-53b216d9ad8e',
                'notifiable_id' => 1,
                'notifiable_type' => 'App\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\StatusNotification',
                'updated_at' => '2020-08-14 07:11:03',
            ),
            7 => 
            array (
                'created_at' => '2020-08-14 07:20:44',
                'data' => '{"title":"New order created","actionURL":"http:\\/\\/e-shop.loc\\/admin\\/order\\/1","fas":"fa-file-alt"}',
                'id' => '8605db5d-1462-496e-8b5f-8b923d88912c',
                'notifiable_id' => 1,
                'notifiable_type' => 'App\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\StatusNotification',
                'updated_at' => '2020-08-14 07:20:44',
            ),
            8 => 
            array (
                'created_at' => '2020-08-17 21:17:03',
                'data' => '{"title":"New order created","actionURL":"http:\\/\\/localhost:8000\\/admin\\/order\\/5","fas":"fa-file-alt"}',
                'id' => 'a6ec5643-748c-4128-92e2-9a9f293f53b5',
                'notifiable_id' => 1,
                'notifiable_type' => 'App\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\StatusNotification',
                'updated_at' => '2020-08-17 21:17:03',
            ),
            9 => 
            array (
                'created_at' => '2020-08-14 22:14:55',
                'data' => '{"title":"New order created","actionURL":"http:\\/\\/e-shop.loc\\/admin\\/order\\/2","fas":"fa-file-alt"}',
                'id' => 'b186a883-42f2-4a05-8fc5-f0d3e10309ff',
                'notifiable_id' => 1,
                'notifiable_type' => 'App\\User',
                'read_at' => '2020-08-15 04:17:24',
                'type' => 'App\\Notifications\\StatusNotification',
                'updated_at' => '2020-08-15 04:17:24',
            ),
            10 => 
            array (
                'created_at' => '2020-08-14 07:08:50',
                'data' => '{"title":"New Comment created","actionURL":"http:\\/\\/e-shop.loc\\/blog-detail\\/where-can-i-get-some","fas":"fas fa-comment"}',
                'id' => 'd2fd7c33-b0fe-47d6-8bc6-f377d404080d',
                'notifiable_id' => 1,
                'notifiable_type' => 'App\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\StatusNotification',
                'updated_at' => '2020-08-14 07:08:50',
            ),
            11 => 
            array (
                'created_at' => '2020-08-15 06:40:54',
                'data' => '{"title":"New order created","actionURL":"http:\\/\\/e-shop.loc\\/admin\\/order\\/3","fas":"fa-file-alt"}',
                'id' => 'dff78b90-85c8-42ee-a5b1-de8ad0b21be4',
                'notifiable_id' => 1,
                'notifiable_type' => 'App\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\StatusNotification',
                'updated_at' => '2020-08-15 06:40:54',
            ),
            12 => 
            array (
                'created_at' => '2020-08-17 21:08:16',
                'data' => '{"title":"New Product Rating!","actionURL":"http:\\/\\/localhost:8000\\/product-detail\\/lorem-ipsum-is-simply","fas":"fa-star"}',
                'id' => 'e28b0a73-4819-4016-b915-0e525d4148f5',
                'notifiable_id' => 1,
                'notifiable_type' => 'App\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\StatusNotification',
                'updated_at' => '2020-08-17 21:08:16',
            ),
            13 => 
            array (
                'created_at' => '2020-08-17 21:13:29',
                'data' => '{"title":"New Comment created","actionURL":"http:\\/\\/localhost:8000\\/blog-detail\\/the-standard-lorem-ipsum-passage-used-since-the-1500s","fas":"fas fa-comment"}',
                'id' => 'ffffa177-c54e-4dfe-ba43-27c466ff1f4b',
                'notifiable_id' => 1,
                'notifiable_type' => 'App\\User',
                'read_at' => NULL,
                'type' => 'App\\Notifications\\StatusNotification',
                'updated_at' => '2020-08-17 21:13:29',
            ),
        ));
        
        
    }
}