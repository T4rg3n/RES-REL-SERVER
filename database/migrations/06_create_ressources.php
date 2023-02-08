<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ressource', function (Blueprint $table) {
            $table->id('id_ressource');
            $table->timestamp('date_creation_ressource')->useCurrent();
            $table->enum('status', ['PENDING', 'APPROVED', 'REJECTED', 'DELETED']);
            $table->unsignedBigInteger('fk_id_uti');
            $table->string('partage_ressource');
            $table->string('titre_ressource');
            $table->string('contenu_texte_ressource');
            $table->dateTime('date_publication_ressource');
            $table->string('raison_refus_ressource');
            $table->unsignedBigInteger('fk_id_categorie');

            $table->foreign('fk_id_uti')
                ->references('id_uti')
                ->on('utilisateur')
                ->onDelete('cascade');

            $table->foreign('fk_id_categorie')
                ->references('id_categorie')
                ->on('categorie')
                ->onDelete('cascade');  
        });
    }

    public function down()
    {
        Schema::dropIfExists('ressource');
    }
};
