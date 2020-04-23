<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class field_supervisorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('field_supervisors')->insert([
            [
                'fname' => 'Golder',
                'other' => 'Doki',
                'phonenumber' => '+256786386635',
                'field_email' => 'doki@gmail.com',
                'user_id' => '3'            ]
        ]);
    }
}
