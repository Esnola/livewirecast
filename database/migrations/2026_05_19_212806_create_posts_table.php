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
        Schema::create('posts', function (Blueprint $table) {
          $table->id();
          $table->string('creator');
          $table->string('title');
          $table->text('content');
          $table->integer('status');
          $table->integer('views');
          $table->integer('likes');
          $table->integer('dislikes');
          $table->bigInteger('price');
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
