<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Table des dépenses : Enregistre toutes les dépenses de l'ONG
     * Utilisée pour la transparence financière dans les rapports aux donateurs
     */
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            
            // Relation avec l'activité (si la dépense est liée à une activité spécifique)
            $table->foreignId('activity_id')->nullable()->constrained('activities')->onDelete('set null');
            
            // Informations de base sur la dépense
            $table->string('title'); // Titre/description de la dépense
            $table->text('description')->nullable(); // Description détaillée
            
            // Montant et devise
            $table->decimal('amount', 15, 2); // Montant de la dépense
            $table->string('currency', 3)->default('EUR'); // Devise
            
            // Catégorisation
            $table->enum('category', [
                'program',      // Dépenses de programme (activités principales)
                'administrative', // Frais administratifs
                'fundraising',  // Frais de collecte de fonds
                'personnel',    // Salaires et charges
                'equipment',    // Équipement et matériel
                'transport',    // Transport et déplacements
                'communication', // Communication et marketing
                'other'         // Autres
            ])->default('program');
            
            $table->string('subcategory')->nullable(); // Sous-catégorie plus spécifique
            
            // Dates
            $table->date('expense_date'); // Date de la dépense
            $table->date('payment_date')->nullable(); // Date de paiement effectif
            
            // Informations de paiement
            $table->string('payment_method')->nullable(); // Méthode de paiement (virement, chèque, etc.)
            $table->string('payment_reference')->nullable(); // Référence de paiement
            $table->string('vendor')->nullable(); // Fournisseur/prestataire
            
            // Justificatifs
            $table->string('invoice_number')->nullable(); // Numéro de facture
            $table->date('invoice_date')->nullable(); // Date de facture
            $table->json('attachments')->nullable(); // Fichiers justificatifs (factures, reçus, etc.)
            
            // Statut et validation
            $table->enum('status', ['pending', 'approved', 'paid', 'rejected', 'cancelled'])->default('pending');
            // pending: en attente, approved: approuvé, paid: payé, rejected: rejeté, cancelled: annulé
            $table->foreignId('approved_by')->nullable()->constrained('admins')->onDelete('set null');
            // Administrateur qui a approuvé la dépense
            $table->timestamp('approved_at')->nullable(); // Date d'approbation
            
            // Métadonnées
            $table->text('notes')->nullable(); // Notes internes
            $table->json('metadata')->nullable(); // Données supplémentaires
            $table->boolean('is_public')->default(true); // Visible dans les rapports publics
            
            $table->timestamps();
            $table->softDeletes(); // Soft delete pour conserver l'historique comptable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
