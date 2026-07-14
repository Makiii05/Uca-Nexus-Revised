<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('application_no')->unique();
            $table->string('level');
            $table->string('student_type');
            $table->string('year_level')->nullable();
            $table->foreignId('strand')->nullable()->constrained('programs')->nullOnDelete();
            $table->foreignId('first_program_choice')->nullable()->constrained('programs')->nullOnDelete();
            $table->foreignId('second_program_choice')->nullable()->constrained('programs')->nullOnDelete();
            $table->foreignId('third_program_choice')->nullable()->constrained('programs')->nullOnDelete();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('sex');
            $table->string('citizenship');
            $table->string('religion');
            $table->date('birthdate');
            $table->string('place_of_birth');
            $table->string('civil_status');
            $table->string('status')->default('pending');
            $table->string('academic_year')->nullable();
            $table->string('reject_reason')->nullable();
            $table->timestamps();
        });

        Schema::create('applicant_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->constrained()->cascadeOnDelete();
            $table->string('zip_code');
            $table->string('present_address');
            $table->string('permanent_address');
            $table->string('telephone_number')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('email')->unique();
            $table->timestamps();
        });

        Schema::create('applicant_guardians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->constrained()->cascadeOnDelete();
            $table->string('type');
            $table->string('name');
            $table->string('occupation')->nullable();
            $table->string('contact_number')->nullable();
            $table->decimal('monthly_income', 10, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('applicant_education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->constrained()->cascadeOnDelete();
            $table->string('level');
            $table->string('school_name');
            $table->string('school_address');
            $table->string('inclusive_years');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applicant_education');
        Schema::dropIfExists('applicant_guardians');
        Schema::dropIfExists('applicant_contacts');
        Schema::dropIfExists('applicants');
    }
};
