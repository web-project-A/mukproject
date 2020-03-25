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
            $table->string('std_number');
            $table->string('reg_number');
            $table->primary('std_number', 'reg_number');
            $table->string('course');
            $table->string('fname');
            $table->string('other_name');
            $table->string('phoneCode');
            $table->string('number');
            $table->string('email');
            $table->string('organisation');
            $table->string('org_address');
            $table->string('org_number');
            $table->string('field_supervisor_fname');
            $table->string('field_supervisor_other');
            $table->string('academic_supervisor_fname')->nullable();
            $table->string('academic_supervisor_other')->nullable();
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
        Schema::dropIfExists('daily_journals');
    }
}
