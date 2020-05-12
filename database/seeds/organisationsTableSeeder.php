<?php

use Illuminate\Database\Seeder;

class organisationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organisations')->insert([
            [
                'name' => 'airport',
                'address' => 'entebbe',
                'additional_address_info' => 'main',
                'region' => 'Entebbe Area',
                'town' => 'Abayita Ababili',
                'phonenumber' => '9999999999',
                'email' => 'airport@gmail.com' 
            ]
        ]);
    }
}
