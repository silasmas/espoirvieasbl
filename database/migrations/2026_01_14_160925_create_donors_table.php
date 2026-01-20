<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Table des donateurs : Stocke les informations de tous les donateurs
     * (spontanés et récurrents) de l'ONG
     */
    public function up(): void
    {
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            
            // Informations personnelles du donateur
            $table->string('first_name'); // Prénom du donateur
            $table->string('last_name'); // Nom de famille du donateur
            $table->string('email')->unique(); // Email unique pour les communications
            $table->string('phone')->nullable(); // Téléphone (optionnel)
            
            // Adresse postale pour les reçus fiscaux et communications
            $table->string('address')->nullable(); // Adresse complète
            $table->string('city')->nullable(); // Ville
            $table->string('postal_code')->nullable(); // Code postal
            $table->string('country')->nullable(); // Pays
            
            // Préférences de communication
            $table->boolean('wants_reports')->default(true); // Souhaite recevoir les rapports d'activités
            $table->boolean('wants_newsletter')->default(false); // Souhaite recevoir la newsletter
            $table->boolean('is_anonymous')->default(false); // Don anonyme (ne pas afficher le nom)
            
            // Informations pour les reçus fiscaux (si applicable)
            $table->string('tax_id')->nullable(); // Numéro d'identification fiscale
            $table->string('company_name')->nullable(); // Nom de l'entreprise (si donateur entreprise)
            
            // Statut et métadonnées
            $table->enum('status', ['active', 'inactive', 'unsubscribed'])->default('active'); // Statut du donateur
            $table->text('notes')->nullable(); // Notes internes sur le donateur
            $table->timestamp('last_donation_at')->nullable(); // Date du dernier don
            $table->decimal('total_donated', 15, 2)->default(0); // Montant total des dons (pour statistiques)
            
            $table->timestamps();
            $table->softDeletes(); // Soft delete pour conserver l'historique
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donors');
    }
};
