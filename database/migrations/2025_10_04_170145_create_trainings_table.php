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
       Schema::create('trainings', function (Blueprint $table) {
    $table->id();
    $table->foreignId('site_id')->constrained('sites')->cascadeOnDelete();
    $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
    $table->string('name'); // ex: POP, POM, AK3U, First Aid
    $table->enum('type', ['mandatory', 'non-mandatory']);
    $table->string('provider')->nullable(); // kasih nullable biar fleksibel
    $table->date('expired_date')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
