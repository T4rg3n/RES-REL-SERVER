<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('relations', function (Blueprint $table) {
            $table->id('id_relation');
            $table->unsignedBigInteger('fk_id_type_relation');
            $table->foreign('fk_id_type_relation')
                ->references('id_type_relation')
                ->on('type_relations')
                ->onDelete('cascade');

            $table->integer('demandeur_id');
            $table->integer('receveur_id');
            $table->boolean('accepte')->nullable();
            $table->dateTime('date_acceptation')->nullable();
            $table->timestamp('date_demande')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('relations');
    }
};
