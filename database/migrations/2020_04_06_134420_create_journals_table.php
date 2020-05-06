<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('field_supervisor_id')->unsigned()->nullable();
            $table->date('date');
            $table->string('task_completed');
            $table->string('task_in_progress');
            $table->string('next_day_tasks');
            $table->string('problems');
            $table->string('field_supervisor_comments')->nullable();
            $table->integer('score')->nullable();
            $table->string('User_Ip', 20);
            $table->string('Device_Browser_Detail', 20);
            $table->timestamps();

            //foreign
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('field_supervisor_id')->references('user_id')->on('field_supervisors')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journals');
    }
}
