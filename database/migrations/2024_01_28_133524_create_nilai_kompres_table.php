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
            $table->uuid('id')->primary();
            $table->foreignUuid('kompre_id')->constrained('kompres')->cascadeOnDelete();
            $table->integer('nilai1_pem1')->default(0);
            $table->integer('nilai2_pem1')->default(0);
            $table->integer('nilai3_pem1')->default(0);
            $table->integer('nilai4_pem1')->default(0);
            $table->integer('nilai5_pem1')->default(0);
            $table->integer('nilai6_pem1')->default(0);
            $table->integer('nilai7_pem1')->default(0);
            $table->integer('nilai1_pem2')->default(0);
            $table->integer('nilai2_pem2')->default(0);
            $table->integer('nilai3_pem2')->default(0);
            $table->integer('nilai4_pem2')->default(0);
            $table->integer('nilai5_pem2')->default(0);
            $table->integer('nilai6_pem2')->default(0);
            $table->integer('nilai7_pem2')->default(0);
            $table->integer('nilai1_peng1')->default(0);
            $table->integer('nilai2_peng1')->default(0);
            $table->integer('nilai3_peng1')->default(0);
            $table->integer('nilai4_peng1')->default(0);
            $table->integer('nilai5_peng1')->default(0);
            $table->text('notes1')->nullable();
            $table->integer('nilai1_peng2')->default(0);
            $table->integer('nilai2_peng2')->default(0);
            $table->integer('nilai3_peng2')->default(0);
            $table->integer('nilai4_peng2')->default(0);
            $table->integer('nilai5_peng2')->default(0);
            $table->text('notes2')->nullable();
            $table->integer('nilai1_peng3')->default(0);
            $table->integer('nilai2_peng3')->default(0);
            $table->integer('nilai3_peng3')->default(0);
            $table->integer('nilai4_peng3')->default(0);
            $table->integer('nilai5_peng3')->default(0);
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
