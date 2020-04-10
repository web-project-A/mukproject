<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_journals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('std_number');
            $table->bigInteger('org_id')->unsigned();
            $table->bigInteger('field_supervisor_id')->unsigned();
            $table->string('academic_supervisor_fname');
            $table->string('academic_supervisor_other');
            $table->string('Device_Browser_Detail');
            $table->string('User_Ip');
            $table->timestamps();

            //foreign
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('std_number')->references('std_number')->on('students')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('daily_journals');
    }
}
