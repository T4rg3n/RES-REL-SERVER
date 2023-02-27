<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('groupes', function (Blueprint $table) {
            $table->id('id_groupe');
            $table->string('nom_groupe');
            $table->text('description_groupe');
            $table->boolean('est_prive_groupe')->default(true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('groupes');
    }
};
