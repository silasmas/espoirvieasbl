<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Permet les dons anonymes : donor_id peut être null.
     */
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropForeign(['donor_id']);
        });

        $driver = Schema::getConnection()->getDriverName();
        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE donations MODIFY donor_id BIGINT UNSIGNED NULL');
        } else {
            Schema::table('donations', function (Blueprint $table) {
                $table->unsignedBigInteger('donor_id')->nullable()->change();
            });
        }

        Schema::table('donations', function (Blueprint $table) {
            $table->foreign('donor_id')->references('id')->on('donors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropForeign(['donor_id']);
        });

        $driver = Schema::getConnection()->getDriverName();
        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE donations MODIFY donor_id BIGINT UNSIGNED NOT NULL');
        } else {
            Schema::table('donations', function (Blueprint $table) {
                $table->unsignedBigInteger('donor_id')->nullable(false)->change();
            });
        }

        Schema::table('donations', function (Blueprint $table) {
            $table->foreign('donor_id')->references('id')->on('donors')->onDelete('cascade');
        });
    }
};
