<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placements', function (Blueprint $table) {
            $table->string('field_supervisor_fname');
            $table->string('field_supervisor_other');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('organisation');
            $table->string('address');
            $table->string('additional_add_info');
            $table->string('region');
            $table->string('city');
            $table->string('phone_number');
            $table->string('email');
            $table->timestamps();
            $table->primary(['field_supervisor_fname', 'field_supervisor_other']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('placements');
    }
}
