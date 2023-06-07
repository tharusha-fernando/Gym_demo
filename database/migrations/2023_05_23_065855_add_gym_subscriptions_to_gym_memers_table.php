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
            $table->string('profile_pic')->nullable();
            $table->string('nic')->nullable();
            $table->unsignedBigInteger('gym_subscription_id')->nullable();
            $table->foreign('gym_subscription_id')->references('id')->on('gym_subscriptions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gym_members', function (Blueprint $table) {
            $table->dropColumn('profile_pic');
            $table->dropColumn('nic');
            $table->dropForeign(['gym_subscription_id']);
            $table->dropColumn('gym_subscription_id');
        });
    }
};
