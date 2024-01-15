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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained(
                table: 'users',
                indexName: 'category_user_id'
            );

            $table->foreignId('community_id')->nullable()->constrained(
                table: 'communities',
                indexName: 'category_community_id'
            );

            $table->foreignId('category_id')->nullable()->constrained(
                table: 'categories',
                indexName: 'category_parent_id'
            );

            $table->string('name');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->string('color')->nullable();
            $table->text('description')->nullable();
            $table->boolean('root')->default(false);
            $table->boolean('active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
