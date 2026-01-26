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
        Schema::table('admins', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('name');
            $table->string('position')->nullable()->after('photo'); // Poste / Fonction
            $table->text('bio')->nullable()->after('position'); // Description / Biographie
            $table->string('facebook_url')->nullable()->after('bio');
            $table->string('twitter_url')->nullable()->after('facebook_url');
            $table->string('linkedin_url')->nullable()->after('twitter_url');
            $table->string('instagram_url')->nullable()->after('linkedin_url');
            $table->boolean('is_team_visible')->default(false)->after('instagram_url'); // Visible dans la section équipe
            $table->integer('team_order')->default(0)->after('is_team_visible'); // Ordre d'affichage
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn([
                'photo',
                'position',
                'bio',
                'facebook_url',
                'twitter_url',
                'linkedin_url',
                'instagram_url',
                'is_team_visible',
                'team_order',
            ]);
        });
    }
};
