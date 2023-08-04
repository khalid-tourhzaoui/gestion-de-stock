<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {/*

id_commande
id
adress
date_livraison
etat	 */
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id("id_livraison");
            $table->unsignedBigInteger("id_commande");
            $table->unsignedBigInteger("id");
            $table->string("adresse");
            $table->date("date_livraison");
            $table->integer("etat");
            $table->foreign("id_commande")->references("id_commande")->on("commandes")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livraisons');
    }
};
