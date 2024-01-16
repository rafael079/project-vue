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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'comment_user_id'
            );

            $table->foreignId('post_id')->nullable()->constrained(
                table: 'contents',
                indexName: 'comment_post_id'
            );

            $table->foreignId('comment_id')->nullable()->constrained(
                table: 'comments',
                indexName: 'comment_parent_id'
            );

            $table->text('message');
            $table->bigInteger('votes')->default(0);
            $table->bigInteger('shares')->default(0);
            $table->boolean('active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
