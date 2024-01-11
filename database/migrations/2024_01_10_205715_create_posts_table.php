<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'content_user_id'
            );

            $table->foreignId('feed_id')->nullable()->constrained(
                table: 'feeds',
                indexName: 'content_feed_id'
            );

            $table->foreignId('category_id')->nullable()->constrained(
                table: 'categories',
                indexName: 'content_category_id'
            );

            $table->string('slug', 250)->index();
            $table->string('title', 250)->index();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('external_id', 200)->index()->nullable();
            $table->text('source')->nullable();
            $table->string('language')->nullable();
            $table->bigInteger('votes')->default(0);
            $table->bigInteger('hits')->default(0)->unsigned();
            $table->bigInteger('shares')->default(0)->unsigned();
            $table->boolean('imported')->default(false);
            $table->boolean('published')->default(true);
            $table->boolean('promoted')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
