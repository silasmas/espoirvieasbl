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
            $table->string('phone', 30)->nullable()->after('email');
            $table->string('country', 100)->nullable()->after('phone');
            $table->string('donation_period', 50)->nullable()->after('country');
            $table->decimal('donation_amount', 10, 2)->nullable()->after('donation_period');
            $table->string('donation_type', 100)->nullable()->after('donation_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'country',
                'donation_period',
                'donation_amount',
                'donation_type',
            ]);
        });
    }
};

