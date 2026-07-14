<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('interview_schedule_id')->constrained('schedules')->cascadeOnDelete();
            $table->decimal('interview_score', 5, 2)->nullable();
            $table->text('interview_remark')->nullable();
            $table->string('interview_result')->default('pending');
            $table->foreignId('exam_schedule_id')->constrained('schedules')->cascadeOnDelete();
            $table->decimal('math_score', 5, 2)->nullable();
            $table->decimal('science_score', 5, 2)->nullable();
            $table->decimal('english_score', 5, 2)->nullable();
            $table->decimal('filipino_score', 5, 2)->nullable();
            $table->decimal('abstract_score', 5, 2)->nullable();
            $table->decimal('exam_score', 5, 2)->nullable();
            $table->string('exam_result')->default('pending');
            $table->decimal('final_score', 5, 2)->nullable();
            $table->string('decision')->default('pending');
            $table->foreignId('program_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('evaluation_schedule_id')->constrained('schedules')->cascadeOnDelete();
            $table->string('evaluated_by')->nullable();
            $table->timestamp('evaluated_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
