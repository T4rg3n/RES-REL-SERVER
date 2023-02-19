<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id('id_uti');
            $table->string('mail_uti');
            $table->string('mdp_uti');
            $table->timestamp('date_inscription_uti')->useCurrent();
            $table->datetime('date_naissance_uti');
            $table->string('code_postal_uti');
            $table->string('nom_uti');
            $table->string('prenom_uti');
            $table->string('photo_uti');
            $table->text('bio_uti');
            $table->string('url_profil_uti');
            $table->boolean('compte_actif_uti')->default(true);
            $table->string('raison_banni_uti');
        });
    }

    public function down()
    {
        Schema::dropIfExists('utilisateurs');
    }
};
