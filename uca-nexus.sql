-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table uca-nexus.academic_terms
CREATE TABLE IF NOT EXISTS `academic_terms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'semester',
  `department_id` bigint unsigned DEFAULT NULL,
  `academic_year_id` bigint unsigned NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `academic_terms_department_id_foreign` (`department_id`),
  KEY `academic_terms_academic_year_id_foreign` (`academic_year_id`),
  CONSTRAINT `academic_terms_academic_year_id_foreign` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`) ON DELETE CASCADE,
  CONSTRAINT `academic_terms_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.academic_years
CREATE TABLE IF NOT EXISTS `academic_years` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_year` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_year` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.admissions
CREATE TABLE IF NOT EXISTS `admissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `applicant_id` bigint unsigned NOT NULL,
  `interview_schedule_id` bigint unsigned NOT NULL,
  `interview_score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interview_remark` text COLLATE utf8mb4_unicode_ci,
  `interview_result` enum('passed','failed','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `exam_schedule_id` bigint unsigned NOT NULL,
  `math_score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `science_score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `english_score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filipino_score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abstract_score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exam_score` text COLLATE utf8mb4_unicode_ci,
  `exam_result` enum('passed','failed','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `final_score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decision` enum('accepted','rejected','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `program_id` bigint unsigned DEFAULT NULL,
  `evaluation_schedule_id` bigint unsigned NOT NULL,
  `evaluated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `evaluated_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admissions_applicant_id_foreign` (`applicant_id`),
  KEY `admissions_interview_schedule_id_foreign` (`interview_schedule_id`),
  KEY `admissions_exam_schedule_id_foreign` (`exam_schedule_id`),
  KEY `admissions_program_id_foreign` (`program_id`),
  KEY `admissions_evaluation_schedule_id_foreign` (`evaluation_schedule_id`),
  CONSTRAINT `admissions_applicant_id_foreign` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`) ON DELETE CASCADE,
  CONSTRAINT `admissions_evaluation_schedule_id_foreign` FOREIGN KEY (`evaluation_schedule_id`) REFERENCES `schedules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `admissions_exam_schedule_id_foreign` FOREIGN KEY (`exam_schedule_id`) REFERENCES `schedules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `admissions_interview_schedule_id_foreign` FOREIGN KEY (`interview_schedule_id`) REFERENCES `schedules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `admissions_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.applicants
CREATE TABLE IF NOT EXISTS `applicants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `application_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `strand` bigint unsigned DEFAULT NULL,
  `first_program_choice` bigint unsigned DEFAULT NULL,
  `second_program_choice` bigint unsigned DEFAULT NULL,
  `third_program_choice` bigint unsigned DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `citizenship` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `place_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civil_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` int NOT NULL,
  `present_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permanent_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_occupation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_monthly_income` int NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_occupation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_monthly_income` int NOT NULL,
  `guardian_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_occupation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_monthly_income` int NOT NULL,
  `elementary_school_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `elementary_school_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `elementary_inclusive_years` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `junior_school_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `junior_school_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `junior_inclusive_years` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senior_school_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senior_school_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senior_inclusive_years` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `college_school_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `college_school_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `college_inclusive_years` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','interview','exam','evaluation','rejected','accepted','admitted') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reject_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `applicants_application_no_unique` (`application_no`),
  UNIQUE KEY `applicants_email_unique` (`email`),
  KEY `applicants_strand_foreign` (`strand`),
  KEY `applicants_first_program_choice_foreign` (`first_program_choice`),
  KEY `applicants_second_program_choice_foreign` (`second_program_choice`),
  KEY `applicants_third_program_choice_foreign` (`third_program_choice`),
  CONSTRAINT `applicants_first_program_choice_foreign` FOREIGN KEY (`first_program_choice`) REFERENCES `programs` (`id`) ON DELETE SET NULL,
  CONSTRAINT `applicants_second_program_choice_foreign` FOREIGN KEY (`second_program_choice`) REFERENCES `programs` (`id`) ON DELETE SET NULL,
  CONSTRAINT `applicants_strand_foreign` FOREIGN KEY (`strand`) REFERENCES `programs` (`id`) ON DELETE SET NULL,
  CONSTRAINT `applicants_third_program_choice_foreign` FOREIGN KEY (`third_program_choice`) REFERENCES `programs` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.assessment_histories
CREATE TABLE IF NOT EXISTS `assessment_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `academic_term_id` bigint unsigned NOT NULL,
  `date_printed` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assessment_histories_student_id_foreign` (`student_id`),
  KEY `assessment_histories_academic_term_id_foreign` (`academic_term_id`),
  CONSTRAINT `assessment_histories_academic_term_id_foreign` FOREIGN KEY (`academic_term_id`) REFERENCES `academic_terms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `assessment_histories_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.assessment_history_enlistments
CREATE TABLE IF NOT EXISTS `assessment_history_enlistments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `assessment_history_id` bigint unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `units` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assessment_history_enlistments_assessment_history_id_foreign` (`assessment_history_id`),
  CONSTRAINT `assessment_history_enlistments_assessment_history_id_foreign` FOREIGN KEY (`assessment_history_id`) REFERENCES `assessment_histories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.assessment_history_fees
CREATE TABLE IF NOT EXISTS `assessment_history_fees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `assessment_history_id` bigint unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assessment_history_fees_assessment_history_id_foreign` (`assessment_history_id`),
  CONSTRAINT `assessment_history_fees_assessment_history_id_foreign` FOREIGN KEY (`assessment_history_id`) REFERENCES `assessment_histories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.assessment_history_students
CREATE TABLE IF NOT EXISTS `assessment_history_students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `assessment_history_id` bigint unsigned NOT NULL,
  `student_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assessment_history_students_assessment_history_id_foreign` (`assessment_history_id`),
  CONSTRAINT `assessment_history_students_assessment_history_id_foreign` FOREIGN KEY (`assessment_history_id`) REFERENCES `assessment_histories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.components
CREATE TABLE IF NOT EXISTS `components` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` decimal(5,2) NOT NULL,
  `department_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `components_department_id_code_unique` (`department_id`,`code`),
  CONSTRAINT `components_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.curricula
CREATE TABLE IF NOT EXISTS `curricula` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `curriculum` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `curricula_department_id_foreign` (`department_id`),
  CONSTRAINT `curricula_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `education_level` enum('K12','college') COLLATE utf8mb4_unicode_ci DEFAULT 'college',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.enlistments
CREATE TABLE IF NOT EXISTS `enlistments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `academic_term_id` bigint unsigned NOT NULL,
  `subject_offering_id` bigint unsigned NOT NULL,
  `final_grade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `enlistments_student_id_foreign` (`student_id`),
  KEY `enlistments_academic_term_id_foreign` (`academic_term_id`),
  KEY `enlistments_subject_offering_id_foreign` (`subject_offering_id`),
  CONSTRAINT `enlistments_academic_term_id_foreign` FOREIGN KEY (`academic_term_id`) REFERENCES `academic_terms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `enlistments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  CONSTRAINT `enlistments_subject_offering_id_foreign` FOREIGN KEY (`subject_offering_id`) REFERENCES `subject_offerings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.fees
CREATE TABLE IF NOT EXISTS `fees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `type` text COLLATE utf8mb4_unicode_ci,
  `month_to_pay` double DEFAULT NULL,
  `group` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_id` bigint unsigned NOT NULL,
  `academic_term_id` bigint unsigned DEFAULT NULL,
  `student_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fees_program_id_foreign` (`program_id`),
  KEY `fees_academic_term_id_foreign` (`academic_term_id`),
  KEY `fees_student_id_foreign` (`student_id`),
  CONSTRAINT `fees_academic_term_id_foreign` FOREIGN KEY (`academic_term_id`) REFERENCES `academic_terms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fees_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fees_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.grade
CREATE TABLE IF NOT EXISTS `grade` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `teacher_offering_id` bigint unsigned NOT NULL,
  `student_id` bigint unsigned NOT NULL,
  `period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `initial_grade` decimal(5,2) DEFAULT NULL,
  `period_grade` decimal(5,2) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `submitted_at` datetime DEFAULT NULL,
  `approved_by` bigint unsigned DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `finalized_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_grade_offering_student_period` (`teacher_offering_id`,`student_id`,`period`),
  KEY `grade_student_id_foreign` (`student_id`),
  KEY `grade_approved_by_foreign` (`approved_by`),
  CONSTRAINT `grade_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `grade_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  CONSTRAINT `grade_teacher_offering_id_foreign` FOREIGN KEY (`teacher_offering_id`) REFERENCES `teacher_offerings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.grade_column
CREATE TABLE IF NOT EXISTS `grade_column` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `teacher_offering_id` bigint unsigned NOT NULL,
  `period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `component_id` bigint unsigned NOT NULL,
  `column_number` int NOT NULL,
  `highest_score` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_gc_offering_comp_col` (`teacher_offering_id`,`component_id`,`column_number`),
  KEY `grade_column_component_id_foreign` (`component_id`),
  CONSTRAINT `grade_column_component_id_foreign` FOREIGN KEY (`component_id`) REFERENCES `components` (`id`) ON DELETE CASCADE,
  CONSTRAINT `grade_column_teacher_offering_id_foreign` FOREIGN KEY (`teacher_offering_id`) REFERENCES `teacher_offerings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.grading_components
CREATE TABLE IF NOT EXISTS `grading_components` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `component_id` bigint unsigned NOT NULL,
  `grading_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `grading_components_component_id_grading_id_unique` (`component_id`,`grading_id`),
  KEY `grading_components_grading_id_foreign` (`grading_id`),
  CONSTRAINT `grading_components_component_id_foreign` FOREIGN KEY (`component_id`) REFERENCES `components` (`id`) ON DELETE CASCADE,
  CONSTRAINT `grading_components_grading_id_foreign` FOREIGN KEY (`grading_id`) REFERENCES `grading_systems` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.grading_systems
CREATE TABLE IF NOT EXISTS `grading_systems` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_percentage` decimal(6,2) NOT NULL DEFAULT '0.00',
  `department_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `grading_systems_department_id_foreign` (`department_id`),
  CONSTRAINT `grading_systems_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.levels
CREATE TABLE IF NOT EXISTS `levels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_id` bigint unsigned NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `levels_program_id_foreign` (`program_id`),
  CONSTRAINT `levels_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.payment_accounts
CREATE TABLE IF NOT EXISTS `payment_accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.payment_types
CREATE TABLE IF NOT EXISTS `payment_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.programs
CREATE TABLE IF NOT EXISTS `programs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enrollment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `programs_department_id_foreign` (`department_id`),
  CONSTRAINT `programs_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.prospectuses
CREATE TABLE IF NOT EXISTS `prospectuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `curriculum_id` bigint unsigned DEFAULT NULL,
  `level_id` bigint unsigned DEFAULT NULL,
  `term_id` bigint unsigned DEFAULT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `prospectuses_curriculum_id_foreign` (`curriculum_id`),
  KEY `prospectuses_level_id_foreign` (`level_id`),
  KEY `prospectuses_term_id_foreign` (`term_id`),
  KEY `prospectuses_subject_id_foreign` (`subject_id`),
  CONSTRAINT `prospectuses_curriculum_id_foreign` FOREIGN KEY (`curriculum_id`) REFERENCES `curricula` (`id`) ON DELETE SET NULL,
  CONSTRAINT `prospectuses_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`) ON DELETE SET NULL,
  CONSTRAINT `prospectuses_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE SET NULL,
  CONSTRAINT `prospectuses_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `academic_terms` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.raw_score
CREATE TABLE IF NOT EXISTS `raw_score` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `grade_id` bigint unsigned NOT NULL,
  `grade_column_id` bigint unsigned NOT NULL,
  `score` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_rs_grade_column` (`grade_id`,`grade_column_id`),
  KEY `raw_score_grade_column_id_foreign` (`grade_column_id`),
  CONSTRAINT `raw_score_grade_column_id_foreign` FOREIGN KEY (`grade_column_id`) REFERENCES `grade_column` (`id`) ON DELETE CASCADE,
  CONSTRAINT `raw_score_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.schedules
CREATE TABLE IF NOT EXISTS `schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `proctor_id` bigint unsigned DEFAULT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `process` enum('exam','interview','evaluation') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'exam',
  PRIMARY KEY (`id`),
  KEY `schedules_proctor_id_foreign` (`proctor_id`),
  CONSTRAINT `schedules_proctor_id_foreign` FOREIGN KEY (`proctor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.statuses
CREATE TABLE IF NOT EXISTS `statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `enrollment_status` enum('open','close') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'close',
  `student_portal_status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off',
  `visible_grade` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off',
  `submission_of_grade` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.students
CREATE TABLE IF NOT EXISTS `students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `student_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lrn` bigint NOT NULL,
  `department_id` bigint unsigned NOT NULL,
  `program_id` bigint unsigned NOT NULL,
  `level_id` bigint unsigned NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` enum('Male','Female') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Male',
  `citizenship` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `place_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civil_status` enum('Single','Married','Widow/Widower') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Single',
  `student_type` enum('new','old') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `academic_year_admitted` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `application_id` bigint unsigned NOT NULL,
  `status` enum('enrolled','withdrawn','dropped','graduated','regular','irregular') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'enrolled',
  `is_exported` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `students_student_number_unique` (`student_number`),
  KEY `students_department_id_foreign` (`department_id`),
  KEY `students_program_id_foreign` (`program_id`),
  KEY `students_level_id_foreign` (`level_id`),
  KEY `students_application_id_foreign` (`application_id`),
  CONSTRAINT `students_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applicants` (`id`) ON DELETE CASCADE,
  CONSTRAINT `students_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `students_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`) ON DELETE CASCADE,
  CONSTRAINT `students_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.student_academic_histories
CREATE TABLE IF NOT EXISTS `student_academic_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `student_id` bigint unsigned NOT NULL,
  `elementary_school_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `elementary_school_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `elementary_inclusive_years` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `junior_school_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `junior_school_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `junior_inclusive_years` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senior_school_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senior_school_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senior_inclusive_years` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `college_school_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `college_school_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `college_inclusive_years` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_academic_histories_student_id_foreign` (`student_id`),
  CONSTRAINT `student_academic_histories_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.student_accounts
CREATE TABLE IF NOT EXISTS `student_accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `account_status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `examination_permit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_accounts_student_id_unique` (`student_id`),
  CONSTRAINT `student_accounts_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.student_contacts
CREATE TABLE IF NOT EXISTS `student_contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `student_id` bigint unsigned NOT NULL,
  `zip_code` int NOT NULL,
  `present_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permanent_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_contacts_email_unique` (`email`),
  KEY `student_contacts_student_id_foreign` (`student_id`),
  CONSTRAINT `student_contacts_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.student_fees
CREATE TABLE IF NOT EXISTS `student_fees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `fee_id` bigint unsigned NOT NULL,
  `academic_term_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_fees_student_id_foreign` (`student_id`),
  KEY `student_fees_fee_id_foreign` (`fee_id`),
  KEY `student_fees_academic_term_id_foreign` (`academic_term_id`),
  CONSTRAINT `student_fees_academic_term_id_foreign` FOREIGN KEY (`academic_term_id`) REFERENCES `academic_terms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `student_fees_fee_id_foreign` FOREIGN KEY (`fee_id`) REFERENCES `fees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `student_fees_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.student_guardians
CREATE TABLE IF NOT EXISTS `student_guardians` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `student_id` bigint unsigned NOT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_occupation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_monthly_income` int NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_occupation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_monthly_income` int NOT NULL,
  `guardian_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_occupation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_monthly_income` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_guardians_student_id_foreign` (`student_id`),
  CONSTRAINT `student_guardians_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.student_profile_pictures
CREATE TABLE IF NOT EXISTS `student_profile_pictures` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_profile_pictures_student_id_foreign` (`student_id`),
  CONSTRAINT `student_profile_pictures_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.subjects
CREATE TABLE IF NOT EXISTS `subjects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` int NOT NULL,
  `lech` int NOT NULL,
  `lecu` int NOT NULL,
  `labh` int NOT NULL,
  `labu` int NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `education_level` enum('K12','college') COLLATE utf8mb4_unicode_ci DEFAULT 'college',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.subject_fees
CREATE TABLE IF NOT EXISTS `subject_fees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subject_id` bigint unsigned NOT NULL,
  `fee_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_fees_subject_id_foreign` (`subject_id`),
  KEY `subject_fees_fee_id_foreign` (`fee_id`),
  CONSTRAINT `subject_fees_fee_id_foreign` FOREIGN KEY (`fee_id`) REFERENCES `fees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subject_fees_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.subject_offerings
CREATE TABLE IF NOT EXISTS `subject_offerings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `academic_term_id` bigint unsigned NOT NULL,
  `subject_id` bigint unsigned NOT NULL,
  `department_id` bigint unsigned NOT NULL,
  `program_id` bigint unsigned NOT NULL,
  `level_id` bigint unsigned DEFAULT NULL,
  `grading_id` bigint unsigned DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_size` int NOT NULL DEFAULT '40',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_offerings_academic_term_id_foreign` (`academic_term_id`),
  KEY `subject_offerings_subject_id_foreign` (`subject_id`),
  KEY `subject_offerings_department_id_foreign` (`department_id`),
  KEY `subject_offerings_program_id_foreign` (`program_id`),
  KEY `subject_offerings_level_id_foreign` (`level_id`),
  KEY `subject_offerings_grading_id_foreign` (`grading_id`),
  CONSTRAINT `subject_offerings_academic_term_id_foreign` FOREIGN KEY (`academic_term_id`) REFERENCES `academic_terms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subject_offerings_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subject_offerings_grading_id_foreign` FOREIGN KEY (`grading_id`) REFERENCES `grading_systems` (`id`) ON DELETE SET NULL,
  CONSTRAINT `subject_offerings_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`) ON DELETE SET NULL,
  CONSTRAINT `subject_offerings_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subject_offerings_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.teachers
CREATE TABLE IF NOT EXISTS `teachers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` text COLLATE utf8mb4_unicode_ci,
  `last_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teachers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.teacher_accounts
CREATE TABLE IF NOT EXISTS `teacher_accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `teacher_id` bigint unsigned DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher_accounts_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `teacher_accounts_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.teacher_offerings
CREATE TABLE IF NOT EXISTS `teacher_offerings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `teacher_id` bigint unsigned DEFAULT NULL,
  `offering_id` bigint unsigned DEFAULT NULL,
  `academic_term_id` bigint unsigned DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher_offerings_teacher_id_foreign` (`teacher_id`),
  KEY `teacher_offerings_offering_id_foreign` (`offering_id`),
  KEY `teacher_offerings_academic_term_id_foreign` (`academic_term_id`) USING BTREE,
  CONSTRAINT `teacher_offerings_academic_term_id_foreign` FOREIGN KEY (`academic_term_id`) REFERENCES `academic_terms` (`id`) ON DELETE SET NULL,
  CONSTRAINT `teacher_offerings_offering_id_foreign` FOREIGN KEY (`offering_id`) REFERENCES `subject_offerings` (`id`) ON DELETE SET NULL,
  CONSTRAINT `teacher_offerings_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `academic_term_id` bigint unsigned NOT NULL,
  `cashier_id` bigint unsigned DEFAULT NULL,
  `or_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_id` bigint unsigned DEFAULT NULL,
  `type_id` bigint unsigned DEFAULT NULL,
  `amount` decimal(12,2) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_student_id_foreign` (`student_id`),
  KEY `transactions_academic_term_id_foreign` (`academic_term_id`),
  KEY `transactions_cashier_id_foreign` (`cashier_id`),
  KEY `transactions_description_id_foreign` (`description_id`),
  KEY `transactions_type_id_foreign` (`type_id`),
  CONSTRAINT `transactions_academic_term_id_foreign` FOREIGN KEY (`academic_term_id`) REFERENCES `academic_terms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transactions_cashier_id_foreign` FOREIGN KEY (`cashier_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `transactions_description_id_foreign` FOREIGN KEY (`description_id`) REFERENCES `payment_accounts` (`id`) ON DELETE SET NULL,
  CONSTRAINT `transactions_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transactions_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `payment_types` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` bigint unsigned DEFAULT NULL,
  `student_id` bigint unsigned DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_department_id_foreign` (`department_id`),
  KEY `users_student_id_foreign` (`student_id`),
  CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `users_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table uca-nexus.websites
CREATE TABLE IF NOT EXISTS `websites` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `event_date` date DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `embedded_url` text COLLATE utf8mb4_unicode_ci,
  `days` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_open` tinyint(1) DEFAULT '1',
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
