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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Titre de l'article
            $table->string('slug')->unique(); // URL slug
            $table->text('excerpt')->nullable(); // Résumé / Extrait
            $table->longText('content'); // Contenu de l'article
            $table->string('image')->nullable(); // Image principale
            $table->string('category')->nullable(); // Catégorie (Don, Santé, Éducation, etc.)
            $table->json('tags')->nullable(); // Tags
            $table->foreignId('author_id')->nullable()->constrained('admins')->nullOnDelete(); // Auteur
            $table->string('author_name')->nullable(); // Nom de l'auteur (si pas d'admin lié)
            $table->boolean('is_published')->default(false); // Publié ou brouillon
            $table->boolean('is_featured')->default(false); // Mis en avant
            $table->timestamp('published_at')->nullable(); // Date de publication
            $table->integer('views_count')->default(0); // Nombre de vues
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
