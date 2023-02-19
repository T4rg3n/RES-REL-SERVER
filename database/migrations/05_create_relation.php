<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('relations', function (Blueprint $table) {
            $table->id('id_relation');
            $table->integer('demandeur_id');
            $table->integer('receveur_id');
            $table->boolean('accepte');
        });
    }

    public function down()
    {
        Schema::dropIfExists('relations');
    }
};
