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
        Schema::create('starter_kits', function (Blueprint $table) {
            $table->id();
            $table->string('display_name');
            $table->string('name')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users'); // The user_id of the package owner, not neccessarily the submitter
            $table->foreignId('submitter_id')->nullable()->constrained('users'); // The user_id of the package submitter
            $table->string('vendor')->nullable();
            $table->text('repo_url');
            $table->boolean('official')->default(false);
            $table->longText('parsed_readme')->nullable();
            $table->dateTime('readme_last_parsed_at')->nullable();
            $table->string('website')->nullable();
            $table->string('languages')->nullable(); // pull from github
            $table->unsignedBigInteger('stars_count')->default(0);
            $table->dateTime('last_synced_at')->nullable();
            $table->string('default_branch')->nullable();
            $table->json('meta')->nullable();
            $table->dateTime('processed_at')->nullable();

            // Kit specific
            $table->string('templating_engine');
            $table->string('css_framework');
            $table->boolean('inertia')->default(false);
            $table->boolean('panel_builder')->default(false);
            $table->boolean('authentication')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('starter_kits');
    }
};
