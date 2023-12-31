<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayoutsTable extends Migration
{
    public function up()
    {
        Schema::create('payouts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->datetime('completed_at')->nullable();
            $table->decimal('commission', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
