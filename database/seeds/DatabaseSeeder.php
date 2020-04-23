<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([usersTableSeeder::class, field_supervisorsTableSeeder::class, studentsTableSeeder::class]);
    }
}

//composer dump-autoload in terminal everytime new seeder is created
//php artisan db:seed .... in terminal, this helps run the seeds created