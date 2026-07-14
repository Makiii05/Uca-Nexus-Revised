<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('curricula', function (Blueprint $table) {
            $table->id();
            $table->string('curriculum');
            $table->string('status');
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('prospectuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curriculum_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('level_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('term_id')->nullable()->constrained('academic_terms')->nullOnDelete();
            $table->foreignId('subject_id')->nullable()->constrained()->nullOnDelete();
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prospectuses');
        Schema::dropIfExists('curricula');
    }
};
