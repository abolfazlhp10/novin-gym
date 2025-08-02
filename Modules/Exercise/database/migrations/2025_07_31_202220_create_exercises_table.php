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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('name_fa')->unique();
            $table->string('name_en')->unique();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnUpdate();
            $table->string('video');
            $table->foreignId('equipment_id')->constrained('equipments')->cascadeOnUpdate();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
