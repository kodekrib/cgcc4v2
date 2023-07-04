<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAtsMembershipsTable extends Migration
{
    public function up()
    {
        Schema::table('ats_memberships', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7823966')->references('id')->on('members');
            $table->unsignedBigInteger('ats_membership_number_id')->nullable();
            $table->foreign('ats_membership_number_id', 'ats_membership_number_fk_8035598')->references('id')->on('ats_membership_records');
        });
    }
}
