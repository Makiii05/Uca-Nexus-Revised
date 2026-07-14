<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('description');
            $table->string('education_level')->nullable()->default('college');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('description');
            $table->string('status');
            $table->string('enrollment_type');
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('description');
            $table->foreignId('program_id')->constrained()->cascadeOnDelete();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('levels');
        Schema::dropIfExists('programs');
        Schema::dropIfExists('departments');
    }
};
