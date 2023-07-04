<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMemberRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members_affinity_groups', function (Blueprint $table) {
            $table->dropForeign('created_by_fk_7635265');
            $table->unsignedBigInteger('member_Id')->nullable();
            $table->foreign('member_Id', 'member_Id_fk_7612185')->references('id')->on('members');
            $table->foreign('created_by_id', 'created_by_fk_7635265')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
