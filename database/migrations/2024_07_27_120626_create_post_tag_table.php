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
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            // $table->foreignID('post_id')->constrained()->cascadeOnDelete();
            // $table->foreignID('tag_id')->constrained()->cascadeOnDelete();
            $table->string('post_id');
            $table->string('tag_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_tag', function (Blueprint $table) {
            // Supprimer les clés étrangères avant de supprimer les colonnes
            $table->dropForeign(['post_id']);
            $table->dropForeign(['tag_id']);
        });

        // Supprimer la table
        Schema::dropIfExists('post_tag');

    }
};
