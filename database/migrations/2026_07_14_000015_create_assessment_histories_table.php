<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessment_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('academic_term_id')->constrained()->cascadeOnDelete();
            $table->timestamp('date_printed');
            $table->timestamps();
        });

        Schema::create('assessment_history_enlistments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_history_id')->constrained()->cascadeOnDelete();
            $table->string('code');
            $table->string('description');
            $table->decimal('units', 5, 2);
            $table->timestamps();
        });

        Schema::create('assessment_history_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_history_id')->constrained()->cascadeOnDelete();
            $table->string('type');
            $table->string('description');
            $table->decimal('amount', 15, 2);
            $table->timestamps();
        });

        Schema::create('assessment_history_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_history_id')->constrained()->cascadeOnDelete();
            $table->string('student_number');
            $table->string('name');
            $table->string('year_level');
            $table->string('program');
            $table->string('department');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessment_history_students');
        Schema::dropIfExists('assessment_history_fees');
        Schema::dropIfExists('assessment_history_enlistments');
        Schema::dropIfExists('assessment_histories');
    }
};
