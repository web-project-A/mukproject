<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip_addr', 20);
            $table->bigInteger('user_id')->unsigned();
            $table->decimal('lon', 7, 5);
            $table->decimal('lat', 6, 5);
            $table->string('city');
            $table->string('country');
            $table->string('countryCode');
            $table->string('regionName');
            $table->string('timezone');
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
        Schema::dropIfExists('locations');
    }
}
