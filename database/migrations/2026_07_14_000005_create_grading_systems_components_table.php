<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grading_systems', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->decimal('total_percentage', 6, 2)->default(0);
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('description');
            $table->decimal('percentage', 5, 2);
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->unique(['department_id', 'code']);
            $table->timestamps();
        });

        Schema::create('grading_components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('component_id')->constrained()->cascadeOnDelete();
            $table->foreignId('grading_id')->constrained('grading_systems')->cascadeOnDelete();
            $table->unique(['component_id', 'grading_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grading_components');
        Schema::dropIfExists('components');
        Schema::dropIfExists('grading_systems');
    }
};
