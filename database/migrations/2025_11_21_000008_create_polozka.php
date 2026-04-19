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
        Schema::create('polozka', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nakup_id')->index()->nullable();
            $table->unsignedBigInteger('vino_id')->index()->nullable();
            $table->unsignedInteger('pocet_lahvi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polozka');
    }
};
