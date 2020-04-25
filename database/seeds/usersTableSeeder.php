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
                'user_type' => 'Student',
                'gender' => 'Male',
                'phonenumber' => '+256787689679',
                'email' => 'collins@gmail.com',
                'role' => '6',
                'password' => bcrypt('collins1234')
            ],[
                'fname' => 'Jesse',
                'other' => 'Kigula',
                'user_type' => 'Student',
                'gender' => 'Male',
                'phonenumber' => '+256787699568',
                'email' => 'jesse@gmail.com',
                'role' => '6',
                'password' => bcrypt('jesse1234')
            ],[
                'fname' => 'Golder',
                'other' => 'Doki',
                'user_type' => 'Field Supervisor',
                'gender' => 'Female',
                'phonenumber' => '+256786386635',
                'email' => 'doki@gmail.com',
                'role' => '5',
                'password' => bcrypt('doki1234')
            ]
        ]);
    }
}
