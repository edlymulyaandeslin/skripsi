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
            $table->id();
            $table->foreignId('judul_id')->constrained('juduls')->cascadeOnDelete();
            $table->text('target_bimbingan');
            $table->string('file_proposal')->nullable();
            $table->text('hasil')->nullable();
            $table->enum('kategori', ['proposal', 'komprehensif'])->nullable();
            $table->enum('status', ['diajukan', 'ditolak', 'diterima', 'acc proposal', 'acc komprehensif'])->default('diajukan');
            $table->timestamps();
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
