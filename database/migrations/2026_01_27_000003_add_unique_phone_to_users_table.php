<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // S'assurer que la colonne existe déjà (ajoutée par une migration précédente)
            if (Schema::hasColumn('users', 'phone')) {
                // Index unique sur le téléphone (plusieurs NULL autorisés selon le SGBD)
                $table->unique('phone');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'phone')) {
                $table->dropUnique(['phone']);
            }
        });
    }
};

