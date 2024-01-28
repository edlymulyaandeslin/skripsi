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
            $table->foreignId('kompre_id')->constrained()->cascadeOnDelete();
            $table->integer('nilai1')->default(0);
            $table->integer('nilai2')->default(0);
            $table->integer('nilai3')->default(0);
            $table->integer('nilai4')->default(0);
            $table->integer('nilai5')->default(0);
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
