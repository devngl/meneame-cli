<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrontPagePostsTable extends Migration
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
            $table->string('title');
            $table->unsignedInteger('comments')->default(0);
            $table->unsignedInteger('positive_votes')->default(0);
            $table->unsignedInteger('negative_votes')->default(0);
            $table->unsignedInteger('anonymous_votes')->default(0);
            $table->unsignedInteger('karma')->default(0);
            $table->string('source')->unique();
            $table->boolean('queued')->default(true);
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
