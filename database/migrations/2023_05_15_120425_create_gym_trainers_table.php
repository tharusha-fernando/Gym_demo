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
        Schema::create('gym_trainers', function (Blueprint $table) {
            $table->id();
            $table->longText('details')->nullable();
            $table->unsignedBigInteger('user_id');
            //$table->unsignedBigInteger('gym_owner');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //$table->foreign('gym_owner')->references('id')->on('gym_owners')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gym_trainers');
    }
};
