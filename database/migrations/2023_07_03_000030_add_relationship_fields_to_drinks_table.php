<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDrinksTable extends Migration
{
    public function up()
    {
        Schema::table('drinks', function (Blueprint $table) {
            $table->unsignedBigInteger('barista_id')->nullable();
            $table->foreign('barista_id', 'barista_fk_8702133')->references('id')->on('users');
            $table->unsignedBigInteger('drink_type_id')->nullable();
            $table->foreign('drink_type_id', 'drink_type_fk_8702134')->references('id')->on('drinks_types');
        });
    }
}
