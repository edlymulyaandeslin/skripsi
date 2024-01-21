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
            $table->string('penguji1');
            $table->string('penguji2')->nullable();
            $table->string('penguji3')->nullable();
            $table->string('penguji4')->nullable();
            $table->string('penguji5')->nullable();
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
