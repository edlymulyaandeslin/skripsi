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
        Schema::create('juduls', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('mahasiswa_id')->constrained('users')->cascadeOnDelete();
            $table->string('judul');
            $table->text('latar_belakang');
            $table->uuid('pembimbing1_id')->nullable();
            $table->uuid('pembimbing2_id')->nullable();
            $table->enum('status', ['diajukan', 'diterima', 'ditolak'])->default('diajukan');
            $table->timestamps();
            // Relasi
            $table->foreign('pembimbing1_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('pembimbing2_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juduls');
    }
};
