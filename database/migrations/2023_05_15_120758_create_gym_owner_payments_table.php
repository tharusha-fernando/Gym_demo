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
        Schema::create('gym_owner_payments', function (Blueprint $table) {
            $table->id();
            $table->string('amount');
            $table->float('commission')->default(0);
            $table->string('profit');
            $table->string('payment_type')->default('deposit');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('gym_owner_id')->nullable();
            $table->foreign('gym_owner_id')->references('id')->on('gym_owners');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gym_owner_payments');
    }
};
