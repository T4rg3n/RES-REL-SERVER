<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ressources', function (Blueprint $table) {
            $table->id('id_ressource');
            $table->timestamp('date_creation_ressource')->useCurrent();
            $table->enum('status', ['PENDING', 'APPROVED', 'REJECTED', 'DELETED'])->default('PENDING');
            $table->unsignedBigInteger('fk_id_uti');
            $table->enum('partage_ressource', ['PRIVATE', 'PUBLIC', 'RESTRICTED'])->default('PRIVATE');
            $table->string('titre_ressource');
            $table->text('contenu_texte_ressource');
            $table->dateTime('date_publication_ressource')->nullable();
            $table->string('raison_refus_ressource')->nullable();
            $table->unsignedBigInteger('fk_id_categorie');
            $table->dateTime('date_modification')->nullable();
            $table->unsignedBigInteger('fk_id_piece_jointe')->nullable();

            $table->foreign('fk_id_uti')
                ->references('id_uti')
                ->on('utilisateurs')
                ->onDelete('cascade');

            $table->foreign('fk_id_categorie')
                ->references('id_categorie')
                ->on('categories')
                ->onDelete('cascade');

            $table->foreign('fk_id_piece_jointe')
                ->references('id_piece_jointe')
                ->on('piece_jointes')
                ->onDelete('set null')
                ->onUpdate('cascade');
                
        });
    }

    public function down()
    {
        Schema::dropIfExists('ressources');
    }
};
