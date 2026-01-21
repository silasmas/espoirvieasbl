<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Table des abonnements à la newsletter : Stocke les emails des personnes
     * abonnées à la newsletter de l'ONG
     */
    public function up(): void
    {
        Schema::create('newsletter_subscriptions', function (Blueprint $table) {
            $table->id();
            
            // Informations de l'abonné
            $table->string('email')->unique(); // Adresse email unique
            $table->string('name')->nullable(); // Nom de l'abonné (optionnel)
            
            // Statut de l'abonnement
            $table->enum('status', ['active', 'unsubscribed', 'bounced'])->default('active');
            // active: abonné actif, unsubscribed: désabonné, bounced: email rejeté
            
            // Informations de suivi
            $table->string('ip_address')->nullable(); // Adresse IP lors de l'inscription
            $table->string('subscription_token')->unique()->nullable(); // Token pour désabonnement
            $table->timestamp('subscribed_at')->nullable(); // Date d'inscription
            $table->timestamp('unsubscribed_at')->nullable(); // Date de désabonnement
            $table->timestamp('last_email_sent_at')->nullable(); // Date du dernier email envoyé
            
            // Statistiques
            $table->integer('emails_received')->default(0); // Nombre d'emails reçus
            $table->integer('emails_opened')->default(0); // Nombre d'emails ouverts
            $table->integer('links_clicked')->default(0); // Nombre de liens cliqués
            
            // Métadonnées
            $table->string('source')->nullable(); // Source de l'inscription (site web, événement, etc.)
            $table->json('metadata')->nullable(); // Données supplémentaires (préférences, etc.)
            
            $table->timestamps();
            
            // Index pour optimiser les requêtes
            $table->index('status');
            $table->index('subscribed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsletter_subscriptions');
    }
};
