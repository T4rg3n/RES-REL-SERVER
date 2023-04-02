<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id('id_role');
            $table->string('nom_role');
            $table->string('ascendant_role')->nullable();
            $table->string('descendant_role');
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
