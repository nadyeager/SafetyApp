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
       Schema::create('manpowers', function (Blueprint $table) {
    $table->id();
    $table->foreignId('site_id')->constrained('sites')->cascadeOnDelete();  
    $table->enum('type', ['organik', 'partner']);
    $table->enum('gender', ['male', 'female']);
    $table->integer('total');
    $table->unsignedTinyInteger('month'); // 1-12
    $table->year('year'); // Laravel punya year() valid
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manpowers');
    }
};
