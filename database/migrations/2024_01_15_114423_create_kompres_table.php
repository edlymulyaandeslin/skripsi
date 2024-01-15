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
            $table->foreignUuid('judul_id');
            $table->date('tanggal_seminar');
            $table->foreignUuid('penguji1_id');
            $table->foreignUuid('penguji2_id');
            $table->string('status');
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
