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
                'user_id' => '3'            ]
        ]);
    }
}
