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
        Schema::create('team_pengujis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('penguji1_id');
            $table->foreignId('penguji2_id');
            $table->foreignId('penguji3_id');
            $table->foreignId('penguji4_id');
            $table->foreignId('penguji5_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_pengujis');
    }
};
