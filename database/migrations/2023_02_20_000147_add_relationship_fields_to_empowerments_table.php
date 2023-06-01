<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEmpowermentsTable extends Migration
{
    public function up()
    {
        Schema::table('empowerments', function (Blueprint $table) {
            $table->unsignedBigInteger('ats_membership_no_id')->nullable();
            $table->foreign('ats_membership_no_id', 'ats_membership_no_fk_8035599')->references('id')->on('ats_membership_records');
        });
    }
}
