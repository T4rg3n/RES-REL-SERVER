<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reponses_commentaires', function (Blueprint $table) {
            $table->id('id_reponse');
            $table->text('contenu_reponse');
            $table->timestamp('date_publication_reponse')->useCurrent();
            $table->boolean('reponse_supprime')->default(false);
            $table->integer('nombre_signalement_commentaire')->default(0);
            $table->unsignedBigInteger('fk_id_uti');
            $table->unsignedBigInteger('fk_id_commentaire');

            $table->foreign('fk_id_uti')
                ->references('id_uti')
                ->on('utilisateurs')
                ->onDelete('cascade');

            $table->foreign('fk_id_commentaire')
                ->references('id_commentaire')
                ->on('commentaires')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reponses_commentaires');
    }
};
