<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fname', 20);
            $table->string('other', 20);
            $table->string('gender', 1)->nullable();
            $table->string('phonenumber', 15);
            $table->string('email')->unique();
            $table->integer('role')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('user_approved', 10)->nullable();
            $table->string('password')->nullable();
            $table->integer('status_id')->nullable();
            $table->string('Device_Browser', 20)->nullable();
            $table->string('Device_platform', 20)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
