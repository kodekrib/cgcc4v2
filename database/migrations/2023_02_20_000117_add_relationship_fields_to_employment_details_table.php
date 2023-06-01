<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEmploymentDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('employment_details', function (Blueprint $table) {
            $table->unsignedBigInteger('industry_id')->nullable();
            $table->foreign('industry_id', 'industry_fk_7962086')->references('id')->on('industry_sectors');
            $table->unsignedBigInteger('subsector_id')->nullable();
            $table->foreign('subsector_id', 'subsector_fk_7962095')->references('id')->on('sub_sectors');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7612481')->references('id')->on('users');
        });
    }
}
