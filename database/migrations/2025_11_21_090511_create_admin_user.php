<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'group')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('group')->default(true);
            });
        }

        if (!env('ADMIN_PASSWORD') || !env('ADMIN_EMAIL')) {
            throw new Exception("ADMIN_PASSWORD OR ADMIN_EMAIL IS NOT SET");
        }

        User::query()->insert([
            'name' => 'Admin',
            'email' => env('ADMIN_EMAIL'),
            'email_verified_at' => now(),
            'group' => 'admin',
            'password' => Hash::make(env('ADMIN_PASSWORD')),
            'created_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        User::query()->where('email', env('ADMIN_EMAIL'))->delete();
    }
};
