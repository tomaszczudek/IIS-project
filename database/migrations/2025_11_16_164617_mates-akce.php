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
        Schema::create('radky', function (Blueprint $table) {
            $table->id();
            $table->integer('odruda_enum');
            $table->integer('pocet_hlav');
            $table->integer('rok_vysadby');
        });
        Schema::create('osetreni', function (Blueprint $table) {
            $table->id();
            $table->foreignId('radky_id')->index()->nullable();
            $table->date('datum');
            $table->integer('typ_enum');
            $table->integer('postrik_enum')->nullable();
            $table->integer('koncentrace')->nullable();
            $table->string("poznamka")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('radky');
        Schema::dropIfExists('osetreni');
    }
};
