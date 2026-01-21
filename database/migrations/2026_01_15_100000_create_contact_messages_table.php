<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Table des messages de contact : Stocke tous les messages envoyés
     * via le formulaire de contact du site
     */
    public function up(): void
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            
            // Informations du contact
            $table->string('name'); // Nom du contact
            $table->string('email'); // Adresse email du contact
            $table->string('subject'); // Sujet du message
            $table->text('message'); // Contenu du message
            
            // Statut du message
            $table->enum('status', ['new', 'read', 'replied', 'archived'])->default('new');
            // new: nouveau message non lu, read: message lu, replied: message auquel on a répondu, archived: message archivé
            
            // Informations de suivi
            $table->string('ip_address')->nullable(); // Adresse IP de l'expéditeur (pour sécurité)
            $table->timestamp('read_at')->nullable(); // Date de lecture du message
            $table->timestamp('replied_at')->nullable(); // Date de réponse au message
            
            // Métadonnées
            $table->text('admin_notes')->nullable(); // Notes internes de l'administrateur
            $table->foreignId('admin_id')->nullable()->constrained('admins')->onDelete('set null'); // Admin qui a traité le message
            
            $table->timestamps();
            
            // Index pour optimiser les requêtes
            $table->index('status');
            $table->index('created_at');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
