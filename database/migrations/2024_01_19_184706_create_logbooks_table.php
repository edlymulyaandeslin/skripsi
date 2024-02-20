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
        Schema::create('logbooks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('judul_id')->constrained('juduls')->cascadeOnDelete();
            $table->text('target_bimbingan');
            $table->string('file_proposal')->nullable();
            $table->text('hasil')->nullable();
            $table->uuid('pembimbing_id')->nullable();
            $table->enum('kategori', ['proposal', 'komprehensif'])->nullable();
            $table->enum('status', ['diajukan', 'ditolak', 'diterima', 'acc proposal', 'acc komprehensif'])->default('diajukan');
            $table->timestamps();

            // relasi
            $table->foreign('pembimbing_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbooks');
    }
};
