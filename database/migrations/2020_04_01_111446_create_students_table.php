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
            $table->string('std_number')->unique();
            $table->string('reg_number')->unique();
            $table->primary('std_number', 'reg_number');
            $table->string('course');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('org_id')->unsigned()->nullable();
            $table->bigInteger('field_supervisor_id')->unsigned()->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();

            //foreign
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('org_id')->references('id')->on('organisations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('field_supervisor_id')->references('id')->on('field_supervisors')->onDelete('cascade')->onUpdate('cascade');
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
