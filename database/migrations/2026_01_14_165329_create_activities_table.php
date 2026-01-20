<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Table des activités : Enregistre toutes les activités et projets de l'ONG
     * Ces informations sont utilisées dans les rapports envoyés aux donateurs
     */
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            
            // Informations de base sur l'activité
            $table->string('title'); // Titre de l'activité
            $table->text('description'); // Description détaillée
            $table->text('short_description')->nullable(); // Description courte (pour les listes)
            
            // Catégorisation
            $table->enum('type', ['project', 'event', 'campaign', 'program', 'other'])->default('project');
            // Type d'activité : projet, événement, campagne, programme, autre
            $table->string('category')->nullable(); // Catégorie (éducation, santé, environnement, etc.)
            $table->json('tags')->nullable(); // Tags pour faciliter la recherche
            
            // Dates et localisation
            $table->date('start_date'); // Date de début
            $table->date('end_date')->nullable(); // Date de fin (null si en cours)
            $table->string('location')->nullable(); // Lieu de l'activité
            $table->string('country')->nullable(); // Pays
            
            // Budget et financement
            $table->decimal('budget', 15, 2)->nullable(); // Budget prévu
            $table->decimal('amount_raised', 15, 2)->default(0); // Montant collecté
            $table->decimal('amount_spent', 15, 2)->default(0); // Montant dépensé
            
            // Statut et visibilité
            $table->enum('status', ['planned', 'ongoing', 'completed', 'cancelled', 'on_hold'])->default('planned');
            // planned: planifié, ongoing: en cours, completed: terminé, cancelled: annulé, on_hold: en attente
            $table->boolean('is_featured')->default(false); // Mise en avant sur le site
            $table->boolean('is_public')->default(true); // Visible publiquement
            $table->boolean('include_in_reports')->default(true); // Inclure dans les rapports aux donateurs
            
            // Contenu média
            $table->string('image')->nullable(); // Image principale
            $table->json('images')->nullable(); // Galerie d'images
            $table->string('video_url')->nullable(); // URL de vidéo
            
            // Résultats et impact
            $table->text('results')->nullable(); // Résultats obtenus
            $table->text('impact')->nullable(); // Impact de l'activité
            $table->integer('beneficiaries_count')->nullable(); // Nombre de bénéficiaires
            $table->json('impact_metrics')->nullable(); // Métriques d'impact (JSON)
            
            // Métadonnées
            $table->text('notes')->nullable(); // Notes internes
            $table->json('metadata')->nullable(); // Données supplémentaires
            $table->integer('views_count')->default(0); // Nombre de vues
            $table->integer('likes_count')->default(0); // Nombre de likes (si applicable)
            
            $table->timestamps();
            $table->softDeletes(); // Soft delete pour conserver l'historique
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
