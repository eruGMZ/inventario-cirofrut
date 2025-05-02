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
        Schema::table('users', function (Blueprint $table) {
            $table->string('user')->nullable()->after('name');
            $table->string('rol')->nullable()->after('password');
            $table->string('status')->nullable()->after('remember_token');
            $table->boolean('is_locked')->default(false)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user');
            $table->dropColumn('rol');
            $table->dropColumn('status');
            $table->dropColumn('is_locked');
        });
    }
};
