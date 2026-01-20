<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Table des rappels de dons : Gère les rappels par email envoyés aux donateurs
     * pour leurs engagements de dons récurrents
     */
    public function up(): void
    {
        Schema::create('donation_reminders', function (Blueprint $table) {
            $table->id();
            
            // Relation avec le don récurrent
            $table->foreignId('recurring_donation_id')->constrained('recurring_donations')->onDelete('cascade');
            
            // Relation avec le donateur (pour faciliter les requêtes)
            $table->foreignId('donor_id')->constrained('donors')->onDelete('cascade');
            
            // Informations sur le rappel
            $table->enum('type', ['upcoming', 'overdue', 'payment_failed', 'renewal'])->default('upcoming');
            // Type de rappel :
            // - upcoming: rappel avant la date de prélèvement
            // - overdue: rappel après la date de prélèvement (paiement en retard)
            // - payment_failed: notification d'échec de paiement
            // - renewal: rappel de renouvellement d'abonnement
            
            // Dates importantes
            $table->date('scheduled_date'); // Date prévue pour l'envoi du rappel
            $table->date('donation_due_date'); // Date à laquelle le don est dû
            $table->timestamp('sent_at')->nullable(); // Date et heure d'envoi effectif
            
            // Statut du rappel
            $table->enum('status', ['pending', 'sent', 'failed', 'cancelled'])->default('pending');
            // pending: en attente, sent: envoyé, failed: échec d'envoi, cancelled: annulé
            
            // Informations sur l'email envoyé
            $table->string('email_subject')->nullable(); // Sujet de l'email
            $table->text('email_content')->nullable(); // Contenu de l'email (ou référence au template)
            $table->string('email_id')->nullable(); // ID de l'email dans le système d'envoi (pour tracking)
            
            // Résultat de l'envoi
            $table->boolean('email_opened')->default(false); // Email ouvert par le destinataire
            $table->boolean('email_clicked')->default(false); // Lien cliqué dans l'email
            $table->timestamp('email_opened_at')->nullable(); // Date d'ouverture
            $table->text('error_message')->nullable(); // Message d'erreur si échec d'envoi
            
            // Métadonnées
            $table->text('notes')->nullable(); // Notes internes
            $table->json('metadata')->nullable(); // Données supplémentaires
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_reminders');
    }
};
