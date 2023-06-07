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
        Schema::create('table_gym_member_gym_trainer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gym_member_id');
            $table->foreign('gym_member_id')->references('id')->on('gym_members')->onDelete('cascade');
            $table->unsignedBigInteger('gym_owner_id');
            $table->foreign('gym_owner_id')->references('id')->on('gym_owners')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_gym_member_gym_trainer');
    }
};
