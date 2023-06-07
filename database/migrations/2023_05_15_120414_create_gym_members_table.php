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
        Schema::create('gym_members', function (Blueprint $table) {
            $table->id();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('gym_owner_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('gym_owner_id')->references('id')->on('gym_owners')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gym_members');
    }
};
