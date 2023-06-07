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
        Schema::create('table_gym_member_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gym_member_id');
            $table->foreign('gym_member_id')->references('id')->on('gym_members')->onDelete('cascade');
            $table->unsignedBigInteger('document_id');
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_gym_member_documents');
    }
};
