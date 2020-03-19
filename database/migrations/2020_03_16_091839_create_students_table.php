<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('std_number');
            $table->string('reg_number');
            $table->primary('std_number', 'reg_number');
            $table->string('fname');
            $table->string('other_name');
            $table->string('gender');
            $table->string('phoneCode');
            $table->string('number');
            $table->string('email');
            $table->string('organisation')->nullable();
            $table->string('field_supervisor_fname')->nullable();
            $table->string('field_supervisor_other')->nullable();


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
        Schema::dropIfExists('students');
    }
}
