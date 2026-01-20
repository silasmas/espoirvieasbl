<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Table des dons : Enregistre tous les dons (spontanés et récurrents)
     * effectués par les donateurs
     */
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            
            // Relation avec le donateur
            $table->foreignId('donor_id')->constrained('donors')->onDelete('cascade'); // Lien vers le donateur
            
            // Relation avec le don récurrent (si applicable)
            // Note: La contrainte de clé étrangère sera ajoutée dans une migration séparée
            // car recurring_donations est créée après donations
            $table->unsignedBigInteger('recurring_donation_id')->nullable();
            // Si le don fait partie d'un abonnement récurrent
            
            // Informations sur le don
            $table->decimal('amount', 15, 2); // Montant du don
            $table->string('currency', 3)->default('EUR'); // Devise (EUR, USD, etc.)
            $table->enum('type', ['one_time', 'recurring'])->default('one_time'); // Type de don
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            // Statut du paiement
            
            // Informations de paiement
            $table->string('payment_method')->nullable(); // Méthode de paiement (carte, virement, chèque, etc.)
            $table->string('payment_reference')->nullable()->unique(); // Référence unique du paiement
            $table->string('transaction_id')->nullable(); // ID de transaction du processeur de paiement
            $table->timestamp('paid_at')->nullable(); // Date et heure du paiement effectif
            
            // Informations fiscales
            $table->boolean('tax_receipt_sent')->default(false); // Reçu fiscal envoyé
            $table->timestamp('tax_receipt_sent_at')->nullable(); // Date d'envoi du reçu fiscal
            $table->string('tax_receipt_number')->nullable()->unique(); // Numéro du reçu fiscal
            
            // Métadonnées
            $table->text('notes')->nullable(); // Notes internes sur ce don spécifique
            $table->string('source')->nullable(); // Source du don (site web, événement, campagne, etc.)
            $table->json('metadata')->nullable(); // Données supplémentaires en JSON (données du processeur, etc.)
            
            $table->timestamps();
            $table->softDeletes(); // Soft delete pour conserver l'historique comptable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
