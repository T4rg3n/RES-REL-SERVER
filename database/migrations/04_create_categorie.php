<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id('id_categorie');
            $table->string('nom_categorie');
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
