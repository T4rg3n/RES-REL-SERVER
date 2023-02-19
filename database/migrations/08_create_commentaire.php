<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id('id_commentaire');
            $table->text('contenu_commentaire');
            $table->timestamp('date_publication_commentaire')->useCurrent();
            $table->integer('nombre_reponses_commentaire');
            $table->boolean('commentaire_supprime');
            $table->integer('nombre_signalement_commentaire');
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
        Schema::dropIfExists('commentaires');
    }
};
