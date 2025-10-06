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
        Schema::create('accidents', function (Blueprint $table) {
             $table->id();
        $table->foreignId('site_id')->constrained('sites')->cascadeOnDelete();
        $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
        $table->enum('type', ['fatal', 'major', 'minor', 'traffic', 'non-work']);
        $table->text('description')->nullable();
        $table->date('date');
        $table->enum('status', ['open', 'close'])->default('open');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accidents');
    }
};
