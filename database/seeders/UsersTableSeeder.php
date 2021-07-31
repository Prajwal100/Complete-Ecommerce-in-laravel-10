<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Hash;

    class UsersTableSeeder extends Seeder
    {
        /**
         * Run the database seeders.
         *
         * @return void
         */
        public function run()
        {
            $data = [
                [
                    'name'     => 'Admin',
                    'email'    => 'admin@gmail.com',
                    'password' => Hash::make('1111'),
                    'role'     => 'admin',
                    'status'   => 'active',
                ],
                [
                    'name'     => 'User',
                    'email'    => 'user@gmail.com',
                    'password' => Hash::make('1111'),
                    'role'     => 'user',
                    'status'   => 'active',
                ],
            ];

            DB::table('users')->insert($data);
        }
    }
