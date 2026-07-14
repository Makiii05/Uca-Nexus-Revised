<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_number')->unique();
            $table->bigInteger('lrn');
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->foreignId('program_id')->constrained()->cascadeOnDelete();
            $table->foreignId('level_id')->constrained()->cascadeOnDelete();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('sex')->default('Male');
            $table->string('citizenship');
            $table->string('religion');
            $table->date('birthdate');
            $table->string('place_of_birth');
            $table->string('civil_status')->default('Single');
            $table->string('student_type')->default('new');
            $table->string('academic_year_admitted')->nullable();
            $table->foreignId('application_id')->constrained('applicants')->cascadeOnDelete();
            $table->string('status')->default('enrolled');
            $table->boolean('is_exported')->default(false);
            $table->timestamps();
        });

        Schema::create('student_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->string('zip_code');
            $table->string('present_address');
            $table->string('permanent_address');
            $table->string('telephone_number')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('email')->unique();
            $table->timestamps();
        });

        Schema::create('student_guardians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->string('type');
            $table->string('name');
            $table->string('occupation')->nullable();
            $table->string('contact_number')->nullable();
            $table->decimal('monthly_income', 10, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('student_academic_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->string('level');
            $table->string('school_name');
            $table->string('school_address');
            $table->string('inclusive_years');
            $table->timestamps();
        });

        Schema::create('student_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->string('account_status')->default('off');
            $table->string('password');
            $table->string('examination_permit')->nullable();
            $table->timestamps();
        });

        Schema::create('student_profile_pictures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->string('filename');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_profile_pictures');
        Schema::dropIfExists('student_accounts');
        Schema::dropIfExists('student_academic_histories');
        Schema::dropIfExists('student_guardians');
        Schema::dropIfExists('student_contacts');
        Schema::dropIfExists('students');
    }
};
