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
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->string('title');
            $table->enum('priority', ['Low', 'Medium', 'High'])->default('Medium');
            $table->string('description');
            $table->boolean('is_checked');
            $table->timestamp('due_date')->default(now());
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
