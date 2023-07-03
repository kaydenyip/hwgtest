<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppoitmentServicePivotTable extends Migration
{
    public function up()
    {
        Schema::create('appoitment_service', function (Blueprint $table) {
            $table->unsignedBigInteger('appoitment_id');
            $table->foreign('appoitment_id', 'appoitment_id_fk_8691694')->references('id')->on('appoitments')->onDelete('cascade');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id', 'service_id_fk_8691694')->references('id')->on('services')->onDelete('cascade');
        });
    }
}
