<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'fname' => 'Collins',
                'other' => 'Tamale',
                'gender' => 'M',
                'phonenumber' => '+256787689679',
                'email' => 'collins@gmail.com',
                'role' => '7',
                'email_verified_at' => '2020-05-04 11:01:26',
                'user_approved' => '1',
                'password' => bcrypt('collins1234')
            ],[
                'fname' => 'Jesse',
                'other' => 'Kigula',
                'gender' => 'M',
                'phonenumber' => '+256787699568',
                'email' => 'jesse@gmail.com',
                'role' => '7',
                'email_verified_at' => '2020-05-04 11:01:26',
                'user_approved' => '1',
                'password' => bcrypt('jesse1234')
            ],[
                'fname' => 'Golder',
                'other' => 'Doki',
                'gender' => 'F',
                'phonenumber' => '+256786386635',
                'email' => 'doki@gmail.com',
                'role' => '6',
                'email_verified_at' => '2020-05-04 11:01:26',
                'user_approved' => '1',
                'password' => bcrypt('doki1234')
            ],[
                'fname' => 'Kenny',
                'other' => 'Ssali',
                'gender' => 'M',
                'phonenumber' => '+256786386635',
                'email' => 'kenny@gmail.com',
                'role' => '3',
                'email_verified_at' => '2020-05-04 11:01:26',
                'user_approved' => '1',
                'password' => bcrypt('kenny1234')
            ]
        ]);
    }
}
