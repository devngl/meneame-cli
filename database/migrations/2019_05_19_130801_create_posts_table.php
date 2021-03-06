<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('posts', static function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedInteger('link_id')->unique();
            $table->string('title');
            $table->unsignedInteger('votes')->default(0);
            $table->integer('karma')->default(0);
            $table->unsignedInteger('comments')->default(0);
            $table->string('status')->default('queued');
            $table->integer('order')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
}
