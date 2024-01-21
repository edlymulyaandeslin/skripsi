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
            $table->id();
            $table->foreignId('mahasiswa_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('judul');
            $table->text('latar_belakang');
            $table->foreignId('pembimbing1_id')->default(0);
            $table->foreignId('pembimbing2_id')->default(0);
            $table->string('status')->default('diajukan');
            $table->timestamps();
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
