<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'created_at' => NULL,
                'email' => 'admin@gmail.com',
                'email_verified_at' => NULL,
                'id' => 1,
                'name' => 'Prajwal Rai',
                'password' => '$2y$10$GOGIJdzJydYJ5nAZ42iZNO3IL1fdvXoSPdUOH3Ajy5hRmi0xBmTzm',
                'photo' => '/storage/photos/1/users/user1.jpg',
                'provider' => NULL,
                'provider_id' => NULL,
                'remember_token' => 'j3HsNG66YHyVUW5Y8JEiLq3OT3zcg2RHpodDxujcIKtAu0IKaLUX7Tf1h54g',
                'role' => 'admin',
                'status' => 'active',
                'updated_at' => '2020-08-15 06:47:13',
            ),
            1 => 
            array (
                'created_at' => NULL,
                'email' => 'user@gmail.com',
                'email_verified_at' => NULL,
                'id' => 2,
                'name' => 'User',
                'password' => '$2y$10$10jB2lupSfvAUfocjguzSeN95LkwgZJUM7aQBdb2Op7XzJ.BhNoHq',
                'photo' => '/storage/photos/1/users/user2.jpg',
                'provider' => NULL,
                'provider_id' => NULL,
                'remember_token' => NULL,
                'role' => 'user',
                'status' => 'active',
                'updated_at' => '2020-08-15 07:30:07',
            ),
            2 => 
            array (
                'created_at' => '2020-08-11 04:20:58',
                'email' => 'prajwal.iar@gmail.com',
                'email_verified_at' => NULL,
                'id' => 3,
                'name' => 'Prajwal Rai',
                'password' => '$2y$10$15ZVMgH040v4Ukf9KSAFiucPJcfDwmeRKCaguVJBXplTs93m48F1G',
                'photo' => '/storage/photos/1/users/user3.jpg',
                'provider' => NULL,
                'provider_id' => NULL,
                'remember_token' => NULL,
                'role' => 'user',
                'status' => 'active',
                'updated_at' => '2020-08-15 07:56:58',
            ),
            3 => 
            array (
                'created_at' => '2020-08-14 21:18:52',
                'email' => 'ernestina.wehner@example.net',
                'email_verified_at' => '2020-08-14 21:18:52',
                'id' => 4,
                'name' => 'Cynthia Beier',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'photo' => NULL,
                'provider' => NULL,
                'provider_id' => NULL,
                'remember_token' => 'fzmQDfEoaP',
                'role' => 'user',
                'status' => 'active',
                'updated_at' => '2020-08-14 21:18:52',
            ),
            4 => 
            array (
                'created_at' => '2020-08-14 21:18:54',
                'email' => 'wolf.harvey@example.org',
                'email_verified_at' => '2020-08-14 21:18:52',
                'id' => 5,
                'name' => 'Prof. Maybell Zulauf',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'photo' => NULL,
                'provider' => NULL,
                'provider_id' => NULL,
                'remember_token' => 'B8cYq4huyT',
                'role' => 'user',
                'status' => 'active',
                'updated_at' => '2020-08-14 21:18:54',
            ),
            5 => 
            array (
                'created_at' => '2020-08-14 21:18:54',
                'email' => 'schroeder.emile@example.net',
                'email_verified_at' => '2020-08-14 21:18:52',
                'id' => 6,
                'name' => 'Diego Lind II',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'photo' => NULL,
                'provider' => NULL,
                'provider_id' => NULL,
                'remember_token' => 'xLUaF26dE1',
                'role' => 'user',
                'status' => 'active',
                'updated_at' => '2020-08-14 21:18:54',
            ),
            6 => 
            array (
                'created_at' => '2020-08-12 21:18:54',
                'email' => 'ashlee16@example.com',
                'email_verified_at' => '2020-08-14 21:18:52',
                'id' => 7,
                'name' => 'Ian Macejkovic',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'photo' => NULL,
                'provider' => NULL,
                'provider_id' => NULL,
                'remember_token' => 'i2ZIKbiM9O',
                'role' => 'user',
                'status' => 'active',
                'updated_at' => '2020-08-14 21:18:54',
            ),
            7 => 
            array (
                'created_at' => '2020-08-14 21:18:55',
                'email' => 'mayer.ashlynn@example.org',
                'email_verified_at' => '2020-08-14 21:18:52',
                'id' => 8,
                'name' => 'Perry McClure DDS',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'photo' => NULL,
                'provider' => NULL,
                'provider_id' => NULL,
                'remember_token' => 'VD1MlsvW3I',
                'role' => 'user',
                'status' => 'active',
                'updated_at' => '2020-08-14 21:18:55',
            ),
            8 => 
            array (
                'created_at' => '2020-08-11 21:19:50',
                'email' => 'carter47@example.net',
                'email_verified_at' => '2020-08-14 21:19:50',
                'id' => 9,
                'name' => 'Juana Yost',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'photo' => NULL,
                'provider' => NULL,
                'provider_id' => NULL,
                'remember_token' => 'kARxoay0FT',
                'role' => 'user',
                'status' => 'active',
                'updated_at' => '2020-08-14 21:19:50',
            ),
            9 => 
            array (
                'created_at' => '2020-08-10 21:19:50',
                'email' => 'lowell06@example.net',
                'email_verified_at' => '2020-08-14 21:19:50',
                'id' => 10,
                'name' => 'Louvenia Will DDS',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'photo' => NULL,
                'provider' => NULL,
                'provider_id' => NULL,
                'remember_token' => 'QkbNNnO7ZG',
                'role' => 'user',
                'status' => 'active',
                'updated_at' => '2020-08-14 21:19:50',
            ),
            10 => 
            array (
                'created_at' => '2020-08-08 21:19:51',
                'email' => 'dcummings@example.com',
                'email_verified_at' => '2020-08-14 21:19:50',
                'id' => 11,
                'name' => 'Miss Layla McClure',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'photo' => NULL,
                'provider' => NULL,
                'provider_id' => NULL,
                'remember_token' => 'DFnCS0bKFa',
                'role' => 'user',
                'status' => 'active',
                'updated_at' => '2020-08-14 21:19:51',
            ),
            11 => 
            array (
                'created_at' => '2020-08-09 21:19:51',
                'email' => 'anderson.luz@example.net',
                'email_verified_at' => '2020-08-14 21:19:50',
                'id' => 12,
                'name' => 'Mrs. Taya Ziemann',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'photo' => NULL,
                'provider' => NULL,
                'provider_id' => NULL,
                'remember_token' => '4Xgvb1HnFT',
                'role' => 'user',
                'status' => 'active',
                'updated_at' => '2020-08-14 21:19:51',
            ),
            12 => 
            array (
                'created_at' => '2020-08-14 21:19:51',
                'email' => 'jaden24@example.com',
                'email_verified_at' => '2020-08-14 21:19:50',
                'id' => 13,
                'name' => 'Porter Olson',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'photo' => NULL,
                'provider' => NULL,
                'provider_id' => NULL,
                'remember_token' => 'gFX2w4WaMj',
                'role' => 'user',
                'status' => 'active',
                'updated_at' => '2020-08-14 21:19:51',
            ),
            13 => 
            array (
                'created_at' => '2020-08-15 07:36:29',
                'email' => 'rae.prajwal@gmail.com',
                'email_verified_at' => NULL,
                'id' => 29,
                'name' => 'Prajwal Rai',
                'password' => NULL,
                'photo' => NULL,
                'provider' => 'google',
                'provider_id' => '110717103019405487938',
                'remember_token' => NULL,
                'role' => 'user',
                'status' => 'active',
                'updated_at' => '2020-08-15 07:36:29',
            ),
        ));
        
        
    }
}