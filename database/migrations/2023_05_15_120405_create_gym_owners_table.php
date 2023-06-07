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
        Schema::create('gym_owners', function (Blueprint $table) {
            $table->id();
            $table->string('gym_name');
            $table->string('owner_name')->nullable();
            $table->string('registration_number');
            $table->string('contact_phone')->nullable();
            $table->string('address')->nullable();
            $table->longText('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('opening_hours')->nullable();
            $table->float('average_rating')->default(0);
            $table->json('social_media_links')->nullable();
            $table->string('legal_docs')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //$table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gym_owners');
    }
};
