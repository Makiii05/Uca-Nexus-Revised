<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('type')->nullable()->after('email');
            $table->string('role')->nullable()->after('type');
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete()->after('role');
            $table->foreignId('student_id')->nullable()->constrained()->nullOnDelete()->after('department_id');
            $table->string('status')->default('active')->after('student_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('department_id');
            $table->dropConstrainedForeignId('student_id');
            $table->dropColumn(['type', 'role', 'status']);
        });
    }
};
