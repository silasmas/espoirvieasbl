<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Table des rapports : Stocke les rapports générés pour les donateurs
     * Ces rapports contiennent les activités et les dépenses de l'ONG
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            
            // Informations de base sur le rapport
            $table->string('title'); // Titre du rapport
            $table->text('description')->nullable(); // Description du rapport
            $table->enum('type', ['quarterly', 'biannual', 'annual', 'custom'])->default('quarterly');
            // Type de rapport : trimestriel, semestriel, annuel, personnalisé
            
            // Période couverte
            $table->date('start_date'); // Date de début de la période
            $table->date('end_date'); // Date de fin de la période
            
            // Contenu du rapport
            $table->longText('content')->nullable(); // Contenu HTML/textuel du rapport
            $table->json('activities_summary')->nullable(); // Résumé des activités (JSON)
            $table->json('financial_summary')->nullable(); // Résumé financier (JSON)
            // Structure du financial_summary :
            // {
            //   "total_donations": 50000,
            //   "total_expenses": 45000,
            //   "expenses_by_category": {...},
            //   "activities_count": 10,
            //   "beneficiaries_count": 500
            // }
            
            // Fichiers associés
            $table->string('pdf_path')->nullable(); // Chemin vers le PDF généré
            $table->json('images')->nullable(); // Images incluses dans le rapport
            
            // Statistiques
            $table->decimal('total_donations', 15, 2)->default(0); // Total des dons sur la période
            $table->decimal('total_expenses', 15, 2)->default(0); // Total des dépenses sur la période
            $table->integer('activities_count')->default(0); // Nombre d'activités
            $table->integer('beneficiaries_count')->default(0); // Nombre total de bénéficiaires
            
            // Statut et visibilité
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            // draft: brouillon, published: publié, archived: archivé
            $table->boolean('is_public')->default(true); // Accessible publiquement
            $table->timestamp('published_at')->nullable(); // Date de publication
            
            // Métadonnées
            $table->text('notes')->nullable(); // Notes internes
            $table->json('metadata')->nullable(); // Données supplémentaires
            $table->integer('views_count')->default(0); // Nombre de vues
            $table->integer('downloads_count')->default(0); // Nombre de téléchargements
            
            $table->timestamps();
            $table->softDeletes(); // Soft delete pour conserver l'historique
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
