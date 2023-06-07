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
        Schema::create('gym_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('price');
            $table->float('price__')->nullable();
            //$table->softDeletes();
            $table->integer('member_count')->nullable();
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
        Schema::dropIfExists('gym_subscriptions');
    }
};
