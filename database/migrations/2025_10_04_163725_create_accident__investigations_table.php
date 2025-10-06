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
        Schema::create('accident_investigations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('accident_id')->constrained('accidents')->cascadeOnDelete();
            $table->string('investigator');
            $table->string('root_cause');
            $table->string('corrective_action');
            $table->enum('status',['open', 'close'])->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accident_investigations');
    }
};
