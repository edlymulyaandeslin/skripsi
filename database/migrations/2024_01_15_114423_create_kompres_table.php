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
        Schema::create('kompres', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('judul_id')->constrained('juduls')->cascadeOnDelete();
            $table->date('tanggal_seminar')->nullable();
            $table->time('jam')->nullable();
            $table->string('ruang')->nullable();
            $table->uuid('penguji1_id')->nullable();
            $table->uuid('penguji2_id')->nullable();
            $table->uuid('penguji3_id')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['diajukan', 'diterima', 'lulus', 'tidak lulus', 'perbaikan', 'penilaian'])->default('diajukan');
            $table->string('pembayaran')->nullable();
            $table->string('lembar_bimbingan')->nullable();
            $table->timestamps();

            // Relasi
            $table->foreign('penguji1_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('penguji2_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('penguji3_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kompres');
    }
};
