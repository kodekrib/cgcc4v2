<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCihCentersInspectionsTable extends Migration
{
    public function up()
    {
        Schema::table('cih_centers_inspections', function (Blueprint $table) {
            $table->unsignedBigInteger('center_visited_id')->nullable();
            $table->foreign('center_visited_id', 'center_visited_fk_7830212')->references('id')->on('centres');
        });
    }
}
