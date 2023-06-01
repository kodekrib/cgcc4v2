<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenueVenueAccessoryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('venue_venue_accessory', function (Blueprint $table) {
            $table->unsignedBigInteger('venue_id');
            $table->foreign('venue_id', 'venue_id_fk_7684378')->references('id')->on('venues')->onDelete('cascade');
            $table->unsignedBigInteger('venue_accessory_id');
            $table->foreign('venue_accessory_id', 'venue_accessory_id_fk_7684378')->references('id')->on('venue_accessories')->onDelete('cascade');
        });
    }
}
