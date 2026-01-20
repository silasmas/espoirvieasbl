<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Table de liaison entre donateurs et rapports : Suit quels rapports
     * ont été envoyés à quels donateurs et leur statut de lecture
     */
    public function up(): void
    {
        Schema::create('donor_reports', function (Blueprint $table) {
            $table->id();
            
            // Relations
            $table->foreignId('donor_id')->constrained('donors')->onDelete('cascade');
            $table->foreignId('report_id')->constrained('reports')->onDelete('cascade');
            
            // Statut d'envoi
            $table->enum('status', ['pending', 'sent', 'failed', 'bounced'])->default('pending');
            // pending: en attente d'envoi, sent: envoyé, failed: échec, bounced: email rejeté
            
            // Dates importantes
            $table->timestamp('sent_at')->nullable(); // Date et heure d'envoi
            $table->timestamp('opened_at')->nullable(); // Date d'ouverture de l'email
            $table->timestamp('clicked_at')->nullable(); // Date de clic sur le lien
            $table->timestamp('downloaded_at')->nullable(); // Date de téléchargement du PDF
            
            // Suivi de l'engagement
            $table->boolean('email_opened')->default(false); // Email ouvert
            $table->boolean('link_clicked')->default(false); // Lien cliqué
            $table->boolean('report_viewed')->default(false); // Rapport consulté
            $table->boolean('pdf_downloaded')->default(false); // PDF téléchargé
            $table->integer('view_count')->default(0); // Nombre de fois consulté
            
            // Informations sur l'envoi
            $table->string('email_id')->nullable(); // ID de l'email dans le système d'envoi
            $table->string('email_subject')->nullable(); // Sujet de l'email envoyé
            $table->text('error_message')->nullable(); // Message d'erreur si échec
            
            // Métadonnées
            $table->text('notes')->nullable(); // Notes internes
            $table->json('metadata')->nullable(); // Données supplémentaires (tracking, etc.)
            
            $table->timestamps();
            
            // Index unique pour éviter les doublons
            $table->unique(['donor_id', 'report_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donor_reports');
    }
};
