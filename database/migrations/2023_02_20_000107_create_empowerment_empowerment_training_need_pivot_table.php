<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpowermentEmpowermentTrainingNeedPivotTable extends Migration
{
    public function up()
    {
        Schema::create('empowerment_empowerment_training_need', function (Blueprint $table) {
            $table->unsignedBigInteger('empowerment_id');
            $table->foreign('empowerment_id', 'empowerment_id_fk_7952146')->references('id')->on('empowerments')->onDelete('cascade');
            $table->unsignedBigInteger('empowerment_training_need_id');
            $table->foreign('empowerment_training_need_id', 'empowerment_training_need_id_fk_7952146')->references('id')->on('empowerment_training_needs')->onDelete('cascade');
        });
    }
}
