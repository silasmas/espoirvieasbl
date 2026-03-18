<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Numéro de téléphone pour les dons Mobile Money (anonymes ou non).
     */
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->string('phone', 30)->nullable()->after('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn('phone');
        });
    }
};
