<?php

use Database\Seeders\SiteSectionSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crée la table des rubriques éditables du site public.
     */
    public function up(): void
    {
        Schema::create('site_sections', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('page');
            $table->string('label');
            $table->text('help_text')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('subtitle')->nullable();
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->string('image')->nullable();
            $table->string('button_label')->nullable();
            $table->string('button_url')->nullable();
            $table->json('items')->nullable();
            $table->json('extra')->nullable();
            $table->timestamps();
        });

        (new SiteSectionSeeder())->run();
    }

    /**
     * Supprime la table des rubriques du site.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_sections');
    }
};
