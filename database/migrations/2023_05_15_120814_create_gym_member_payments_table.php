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
        Schema::create('gym_member_payments', function (Blueprint $table) {
            $table->id();
            $table->string('amount');
            $table->float('commission')->default(0);
            $table->string('profit');
            $table->string('payment_type')->default('deposit');
            $table->unsignedBigInteger('gym_owner_id');
            $table->foreign('gym_owner_id')->references('id')->on('gym_owners');
            $table->unsignedBigInteger('gym_member_id');
            $table->foreign('gym_member_id')->references('id')->on('gym_members');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gym_member_payments');
    }
};
