<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCihRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('cih_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('requester_name_id')->nullable();
            $table->foreign('requester_name_id', 'requester_name_fk_7830138')->references('id')->on('members');
            $table->unsignedBigInteger('types_of_request_id')->nullable();
            $table->foreign('types_of_request_id', 'types_of_request_fk_7977443')->references('id')->on('cih_types_of_requests');
        });
    }
}
