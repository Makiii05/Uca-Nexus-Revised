<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grade', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_offering_id')->constrained('teacher_offerings')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->string('period');
            $table->decimal('initial_grade', 5, 2)->nullable();
            $table->decimal('period_grade', 5, 2)->nullable();
            $table->string('status')->default('draft');
            $table->datetime('submitted_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->datetime('approved_at')->nullable();
            $table->datetime('finalized_at')->nullable();
            $table->unique(['teacher_offering_id', 'student_id', 'period'], 'uq_grade_offering_student_period');
            $table->timestamps();
        });

        Schema::create('grade_column', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_offering_id')->constrained('teacher_offerings')->cascadeOnDelete();
            $table->string('period');
            $table->foreignId('component_id')->constrained()->cascadeOnDelete();
            $table->integer('column_number');
            $table->decimal('highest_score', 5, 2);
            $table->unique(['teacher_offering_id', 'component_id', 'column_number'], 'uq_gc_offering_comp_col');
            $table->timestamps();
        });

        Schema::create('raw_score', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grade_id')->constrained('grade')->cascadeOnDelete();
            $table->foreignId('grade_column_id')->constrained('grade_column')->cascadeOnDelete();
            $table->decimal('score', 5, 2)->nullable();
            $table->unique(['grade_id', 'grade_column_id'], 'uq_rs_grade_column');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('raw_score');
        Schema::dropIfExists('grade_column');
        Schema::dropIfExists('grade');
    }
};
