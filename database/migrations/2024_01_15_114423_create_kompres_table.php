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
            $table->id();
            $table->foreignId('judul_id')->constrained('juduls')->cascadeOnDelete();
            $table->date('tanggal_seminar')->nullable();
            $table->time('jam')->nullable();
            $table->string('ruang')->nullable();
            $table->foreignId('penguji1_id')->default(0);
            $table->foreignId('penguji2_id')->default(0);
            $table->foreignId('penguji3_id')->default(0);
            $table->text('notes')->nullable();
            $table->enum('status', ['diajukan', 'diterima', 'lulus', 'tidak lulus', 'perbaikan', 'penilaian'])->default('diajukan');
            $table->string('pembayaran')->nullable();
            $table->string('lembar_bimbingan')->nullable();
            $table->timestamps();
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
