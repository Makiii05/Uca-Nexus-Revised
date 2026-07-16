<?php

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\Registrar\AcademicTermController;
use App\Http\Controllers\Web\Registrar\CurriculumController;
use App\Http\Controllers\Web\Registrar\DepartmentController;
use App\Http\Controllers\Web\Registrar\LevelController;
use App\Http\Controllers\Web\Registrar\ProgramController;
use App\Http\Controllers\Web\Registrar\SchoolYearController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::middleware('guest')->group(function () {
    Route::get('login/{type}', [LoginController::class, 'create'])->name('login');
    Route::post('login/{type}', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('registrar')->name('registrar.')->group(function () {
        Route::get('departments', [DepartmentController::class, 'index'])->name('departments.index');
        Route::post('departments', [DepartmentController::class, 'store'])->name('departments.store');
        Route::put('departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');
        Route::delete('departments/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');

        Route::get('programs', [ProgramController::class, 'index'])->name('programs.index');
        Route::post('programs', [ProgramController::class, 'store'])->name('programs.store');
        Route::put('programs/{program}', [ProgramController::class, 'update'])->name('programs.update');
        Route::delete('programs/{program}', [ProgramController::class, 'destroy'])->name('programs.destroy');

        Route::get('levels', [LevelController::class, 'index'])->name('levels.index');
        Route::post('levels', [LevelController::class, 'store'])->name('levels.store');
        Route::put('levels/{level}', [LevelController::class, 'update'])->name('levels.update');
        Route::delete('levels/{level}', [LevelController::class, 'destroy'])->name('levels.destroy');

        Route::get('curricula', [CurriculumController::class, 'index'])->name('curricula.index');
        Route::post('curricula', [CurriculumController::class, 'store'])->name('curricula.store');
        Route::put('curricula/{curriculum}', [CurriculumController::class, 'update'])->name('curricula.update');
        Route::delete('curricula/{curriculum}', [CurriculumController::class, 'destroy'])->name('curricula.destroy');

        Route::get('academic-terms', [AcademicTermController::class, 'index'])->name('academic-terms.index');
        Route::post('academic-terms', [AcademicTermController::class, 'store'])->name('academic-terms.store');
        Route::put('academic-terms/{academic_term}', [AcademicTermController::class, 'update'])->name('academic-terms.update');
        Route::delete('academic-terms/{academic_term}', [AcademicTermController::class, 'destroy'])->name('academic-terms.destroy');

        Route::get('school-years', [SchoolYearController::class, 'index'])->name('school-years.index');
        Route::post('school-years', [SchoolYearController::class, 'store'])->name('school-years.store');
        Route::put('school-years/{school_year}', [SchoolYearController::class, 'update'])->name('school-years.update');
        Route::delete('school-years/{school_year}', [SchoolYearController::class, 'destroy'])->name('school-years.destroy');
    });
});
