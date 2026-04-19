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
        Schema::create('vino', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sklizen_id')->index()->nullable();
            $table->unsignedInteger('rocnik');
            $table->unsignedInteger('odruda');
            $table->decimal('procento_alkoholu', 4, 2);
            $table->unsignedInteger('pocet_vyrobenych_lahvi');
            $table->unsignedInteger('pocet_zbylych_lahvi');
            $table->date('datum_lahvovani')->default(DB::raw('CURRENT_DATE'));
            $table->decimal('cena', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vino');
    }
};
