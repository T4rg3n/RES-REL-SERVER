<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('piece_jointes', function (Blueprint $table) {
            $table->id('id_piece_jointe');
            $table->enum('type_pj', ['IMAGE', 'VIDEO', 'PDF', 'ACTIVITE']);
            $table->string('titre_pj');
            $table->timestamp('date_creation_pj')->useCurrent();
            $table->string('description_pj');
            $table->string('contenu_pj');
            $table->dateTime('date_activite_pj');
            $table->string('lieu_pj');
            $table->string('code_postal_pj');
            $table->unsignedBigInteger('fk_id_uti');
            
            $table->foreign('fk_id_uti')
                ->references('id_uti')
                ->on('utilisateurs')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('piece_jointes');
    }
};
