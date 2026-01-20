<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Table des dons récurrents : Gère les abonnements de dons réguliers
     * Les donateurs peuvent souscrire à un don mensuel, trimestriel, etc.
     */
    public function up(): void
    {
        Schema::create('recurring_donations', function (Blueprint $table) {
            $table->id();
            
            // Relation avec le donateur
            $table->foreignId('donor_id')->constrained('donors')->onDelete('cascade');
            
            // Configuration du don récurrent
            $table->decimal('amount', 15, 2); // Montant à prélever à chaque période
            $table->string('currency', 3)->default('EUR'); // Devise
            $table->enum('frequency', ['monthly', 'quarterly', 'biannual', 'annual'])->default('monthly');
            // Fréquence : mensuel, trimestriel, semestriel, annuel
            
            // Date de début et de fin
            $table->date('start_date'); // Date de début de l'abonnement
            $table->date('end_date')->nullable(); // Date de fin (null = sans fin)
            $table->date('next_donation_date'); // Prochaine date de prélèvement prévue
            
            // Informations de paiement récurrent
            $table->string('payment_method'); // Méthode de paiement (carte, virement automatique, etc.)
            $table->string('payment_reference')->nullable(); // Référence du paiement récurrent
            $table->string('subscription_id')->nullable()->unique(); // ID de l'abonnement chez le processeur de paiement
            
            // Statut de l'abonnement
            $table->enum('status', ['active', 'paused', 'cancelled', 'expired', 'failed'])->default('active');
            // active: actif, paused: en pause, cancelled: annulé, expired: expiré, failed: échec de paiement
            
            // Statistiques
            $table->integer('total_donations')->default(0); // Nombre total de dons effectués
            $table->integer('failed_attempts')->default(0); // Nombre d'échecs de paiement consécutifs
            $table->date('last_donation_date')->nullable(); // Date du dernier prélèvement réussi
            
            // Métadonnées
            $table->text('notes')->nullable(); // Notes internes
            $table->json('metadata')->nullable(); // Données supplémentaires (données du processeur, etc.)
            $table->timestamp('cancelled_at')->nullable(); // Date d'annulation
            $table->text('cancellation_reason')->nullable(); // Raison de l'annulation
            
            $table->timestamps();
            $table->softDeletes(); // Soft delete pour conserver l'historique
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurring_donations');
    }
};
