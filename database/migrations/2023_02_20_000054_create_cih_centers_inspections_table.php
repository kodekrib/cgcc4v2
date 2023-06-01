<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCihCentersInspectionsTable extends Migration
{
    public function up()
    {
        Schema::create('cih_centers_inspections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_of_inspection')->nullable();
            $table->longText('summary_of_visit')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
