<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrinksTypesTable extends Migration
{
    public function up()
    {
        Schema::create('drinks_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
