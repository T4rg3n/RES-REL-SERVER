<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reponses_commentaire', function (Blueprint $table) {
            $table->id('id_reponse');
            $table->text('contenu_reponse');
            $table->timestamp('date_publication_reponse')->useCurrent();
            $table->boolean('reponse_supprime');
            $table->integer('nombre_signalement_commentaire');
            $table->unsignedBigInteger('fk_id_uti');
            $table->unsignedBigInteger('fk_id_commentaire');

            $table->foreign('fk_id_uti')
                ->references('id_uti')
                ->on('utilisateur')
                ->onDelete('cascade');

            $table->foreign('fk_id_commentaire')
                ->references('id_commentaire')
                ->on('commentaire')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reponses_commentaire');
    }
};
