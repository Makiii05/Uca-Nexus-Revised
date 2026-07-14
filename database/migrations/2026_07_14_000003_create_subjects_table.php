<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('description');
            $table->integer('unit');
            $table->integer('lech');
            $table->integer('lecu');
            $table->integer('labh');
            $table->integer('labu');
            $table->string('type');
            $table->string('education_level')->nullable()->default('college');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
