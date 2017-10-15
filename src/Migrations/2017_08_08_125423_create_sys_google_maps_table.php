<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysGoogleMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_google_maps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('latitude',50);
            $table->string('longitude',50);
            $table->string('company',200);
            $table->string('region',200);
            $table->string('city',200);
            $table->string('address',200);
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
        Schema::dropIfExists('sys_google_maps');
    }
}
