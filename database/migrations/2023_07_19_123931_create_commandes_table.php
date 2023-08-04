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
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id("id_commande");
            $table->unsignedBigInteger("id");
            $table->foreign("id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->float("quantite_commande");
            $table->float("prix_commande");
            $table->date("date_commande");
            $table->integer("status")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
