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
        Schema::create('nilai_kompres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kompre_id')->constrained('kompres')->cascadeOnDelete();
            $table->integer('nilai1')->default(0);
            $table->integer('nilai2')->default(0);
            $table->integer('nilai3')->default(0);
            $table->integer('nilai4')->default(0);
            $table->integer('nilai5')->default(0);
            $table->text('notes1')->nullable();
            $table->integer('nilai6')->default(0);
            $table->integer('nilai7')->default(0);
            $table->integer('nilai8')->default(0);
            $table->integer('nilai9')->default(0);
            $table->integer('nilai10')->default(0);
            $table->text('notes2')->nullable();
            $table->integer('nilai11')->default(0);
            $table->integer('nilai12')->default(0);
            $table->integer('nilai13')->default(0);
            $table->integer('nilai14')->default(0);
            $table->integer('nilai15')->default(0);
            $table->text('notes3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_kompres');
    }
};
