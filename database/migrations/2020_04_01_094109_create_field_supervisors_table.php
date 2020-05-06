<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldSupervisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_supervisors', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->primary('user_id');
            $table->bigInteger('org_id')->unsigned()->nullable();
            $table->timestamps();

            //foreign
            $table->foreign('org_id')->references('id')->on('organisations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('field_supervisors');
    }
}
