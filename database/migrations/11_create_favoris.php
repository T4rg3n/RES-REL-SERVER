<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('favoris', function (Blueprint $table) {
            $table->id('id_favoris');
            $table->timestamp('date_fav')->useCurrent();
            $table->unsignedBigInteger('fk_id_uti');
            $table->unsignedBigInteger('fk_id_ressource');

            $table->foreign('fk_id_uti')
                ->references('id_uti')
                ->on('utilisateurs')
                ->onDelete('cascade');

            $table->foreign('fk_id_ressource')
                ->references('id_ressource')
                ->on('ressources')
                ->onDelete('cascade');
      });
    }

    public function down()
    {
        Schema::dropIfExists('favoris');
    }
};
