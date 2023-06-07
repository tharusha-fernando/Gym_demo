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
        Schema::table('gym_members', function (Blueprint $table) {
            $table->unsignedBigInteger('gym_owner_id')->nullable()->change();
            
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gym_members', function (Blueprint $table) {
            $table->unsignedBigInteger('gym_owner_id')->nullable(true)->change();
            //
        });
    }
};
