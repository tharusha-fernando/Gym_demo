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
        Schema::table('users', function (Blueprint $table) {
            $table->date('subendate')->nullable();
            $table->unsignedBigInteger('subscrition')->nullable();
            $table->foreign('subscrition')->references('id')->on('subscriptions');
            $table->boolean('status')->default(true);
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['subscription']);
            $table->dropColumn('subscription');
            $table->dropColumn('subendate');
            $table->dropColumn('status');
            //
        });
    }
};
