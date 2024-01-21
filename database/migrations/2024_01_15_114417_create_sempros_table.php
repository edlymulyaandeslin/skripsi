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
        Schema::create('sempros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('judul_id')->constrained()->cascadeOnDelete();
            $table->date('tanggal_seminar')->nullable();
            $table->time('jam')->nullable();
            $table->string('ruang')->nullable();
            $table->foreignId('team_penguji_id')->nullable();
            $table->integer('nilai1')->nullable();
            $table->integer('nilai2')->nullable();
            $table->integer('nilai3')->nullable();
            $table->integer('nilai4')->nullable();
            $table->integer('nilai5')->nullable();
            $table->string('status')->default('diajukan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sempros');
    }
};
