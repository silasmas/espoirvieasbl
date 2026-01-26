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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom du témoin
            $table->string('role')->nullable(); // Rôle (Bénévole, Donateur, Partenaire, etc.)
            $table->string('photo')->nullable(); // Photo du témoin
            $table->text('content'); // Contenu du témoignage
            $table->integer('rating')->default(5); // Note (1-5 étoiles)
            $table->boolean('is_active')->default(true); // Actif ou non
            $table->integer('display_order')->default(0); // Ordre d'affichage
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
