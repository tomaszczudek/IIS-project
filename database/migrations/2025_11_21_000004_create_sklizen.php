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
        Schema::create('sklizen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('radek_id')->index()->nullable();
            $table->decimal('hmotnost_hroznu_kg', 10, 2);
            $table->decimal('litry_vina', 8, 2)->nullable();
            $table->unsignedInteger('odruda_hroznu');
            $table->decimal('cukernatost_hroznu', 5, 2);
            $table->date('datum_sklizne');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sklizen');
    }
};
