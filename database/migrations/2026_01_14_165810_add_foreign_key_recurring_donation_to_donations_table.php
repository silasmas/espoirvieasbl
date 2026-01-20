<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Ajoute la contrainte de clé étrangère entre donations et recurring_donations
     * Cette migration est nécessaire car recurring_donations est créée après donations
     */
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->foreign('recurring_donation_id')
                  ->references('id')
                  ->on('recurring_donations')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropForeign(['recurring_donation_id']);
        });
    }
};
