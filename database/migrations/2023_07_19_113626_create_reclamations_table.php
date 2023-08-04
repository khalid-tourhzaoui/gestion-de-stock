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
	
id	
message	
date_reclamation */
        Schema::create('reclamations', function (Blueprint $table) {
            $table->id("id_reclamation");
            $table->unsignedBigInteger("id");
            $table->foreign("id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->string("message");
            $table->date("date_reclamation");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reclamations');
    }
};
