<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class studentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            [
                'std_number' => '1800721135',
                'reg_number' => '18/U/21135/PS',
                'course' => 'BSE',
                'user_id' => '1',
                'field_supervisor_id' => '1'
            ],[
                'std_number' => '1800721090',
                'reg_number' => '18/U/21090/PS',
                'course' => 'BSE',
                'user_id' => '2',
                'field_supervisor_id' => '1'
            ]
        ]);
    }
}
