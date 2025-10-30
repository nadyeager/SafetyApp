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
        Schema::table('safety_activities', function (Blueprint $table) {
            $table->enum('frequency', ['daily', 'weekly', 'monthly'])->default('daily')->after('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('safety_activities', function (Blueprint $table) {
            $table->dropColumn('frequency');
        });
    }
};
