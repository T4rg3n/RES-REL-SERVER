<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('type_relations', function (Blueprint $table) {
            $table->id('id_type_relation');
            $table->string('nom_type_relation');
        });
    }

    public function down()
    {
        Schema::dropIfExists('type_relations');
    }
};
