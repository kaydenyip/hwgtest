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
            $table->foreign('barista_id', 'barista_fk_8701354')->references('id')->on('users');
            $table->unsignedBigInteger('drinks_types_id')->nullable();
            $table->foreign('drinks_types_id', 'drinks_types_fk_8701358')->references('id')->on('drinks_types');
        });
    }
}
