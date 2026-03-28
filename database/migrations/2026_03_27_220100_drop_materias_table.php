<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('materias');
    }

    public function down()
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('clave')->unique();
            $table->timestamps();
        });
    }
};
