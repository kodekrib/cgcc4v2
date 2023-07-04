<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessibilityFeatureVenuePivotTable extends Migration
{
    public function up()
    {
        Schema::create('accessibility_feature_venue', function (Blueprint $table) {
            $table->unsignedBigInteger('venue_id');
            $table->foreign('venue_id', 'venue_id_fk_7806639')->references('id')->on('venues')->onDelete('cascade');
            $table->unsignedBigInteger('accessibility_feature_id');
            $table->foreign('accessibility_feature_id', 'accessibility_feature_id_fk_7806639')->references('id')->on('accessibility_features')->onDelete('cascade');
        });
    }
}
