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
id_payment
id
prix_paiement
date_paiemen */
        Schema::create('paiements', function (Blueprint $table) {
            $table->id("id_paiement");
            $table->unsignedBigInteger("id");
            $table->foreign("id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->float("prix_paiement");
            $table->date("date_paiement");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
