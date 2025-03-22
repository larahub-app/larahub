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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users'); // The user_id of the package owner, not neccessarily the submitter
            $table->foreignId('submitter_id')->nullable()->constrained('users'); // The user_id of the package submitter
            // Package name, as given by GitHub, not neccessarily unique or the packagist name
            $table->string('name')->nullable();
            // Vendor name, should be the username of the user_id
            $table->string('vendor')->nullable();
            // Display name is for the package owner to update should they want to
            // will default to name
            $table->string('display_name')->nullable();

            // As pulled from github
            $table->text('description')->nullable();

            // The github url
            $table->text('repo_url');

            // Official packages are those that are created by "laravel"
            $table->boolean('official')->default(false);

            // This will be the parsed readme contents
            $table->longText('parsed_readme')->nullable();
            $table->dateTime('readme_last_parsed_at')->nullable();

            // Package misc
            $table->string('type')->nullable(); // php, javascript, other
            $table->string('installation_method')->nullable(); // composer, npm, other
            $table->string('website')->nullable();
            $table->string('languages')->nullable(); // pull from github
            $table->unsignedBigInteger('stars_count')->default(0);
            $table->dateTime('last_synced_at')->nullable();
            $table->string('default_branch')->nullable();

            // JSON encoded repo payload from github
            $table->json('meta')->nullable();

            $table->dateTime('processed_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
