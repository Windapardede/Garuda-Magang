/*
 Navicat Premium Dump SQL

 Source Server         : localhost_3307
 Source Server Type    : MySQL
 Source Server Version : 110502 (11.5.2-MariaDB)
 Source Host           : 127.0.0.1:3307
 Source Schema         : maganggci

 Target Server Type    : MySQL
 Target Server Version : 110502 (11.5.2-MariaDB)
 File Encoding         : 65001

 Date: 24/06/2025 20:00:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for _prisma_migrations
-- ----------------------------
DROP TABLE IF EXISTS `_prisma_migrations`;
CREATE TABLE `_prisma_migrations` (
  `id` varchar(36) NOT NULL,
  `checksum` varchar(64) NOT NULL,
  `finished_at` datetime(3) DEFAULT NULL,
  `migration_name` varchar(255) NOT NULL,
  `logs` text DEFAULT NULL,
  `rolled_back_at` datetime(3) DEFAULT NULL,
  `started_at` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `applied_steps_count` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of _prisma_migrations
-- ----------------------------
BEGIN;
INSERT INTO `_prisma_migrations` (`id`, `checksum`, `finished_at`, `migration_name`, `logs`, `rolled_back_at`, `started_at`, `applied_steps_count`) VALUES ('2215fe92-22cb-4279-af7e-064a67c0fcb4', 'a6d7327a24f3cb2a92476e3685307967b33af26408834c71e6a3149b6301acf5', '2025-03-23 16:28:16.090', '20250323162814_', NULL, NULL, '2025-03-23 16:28:14.348', 1);
COMMIT;

-- ----------------------------
-- Table structure for attendances
-- ----------------------------
DROP TABLE IF EXISTS `attendances`;
CREATE TABLE `attendances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time DEFAULT NULL,
  `latlon_in` varchar(255) NOT NULL,
  `latlon_out` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attendances_user_id_foreign` (`user_id`),
  CONSTRAINT `attendances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of attendances
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for buku
-- ----------------------------
DROP TABLE IF EXISTS `buku`;
CREATE TABLE `buku` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `jenis_buku` bigint(20) DEFAULT NULL,
  `tahun_terbit` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of buku
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cache
-- ----------------------------
BEGIN;
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('0aa9da29be78dc0aeda63dd10220c1ba', 'i:1;', 1750767107);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('0aa9da29be78dc0aeda63dd10220c1ba:timer', 'i:1750767107;', 1750767107);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('0e01e2a600b8acb7e92c58d887246814', 'i:3;', 1749005845);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('0e01e2a600b8acb7e92c58d887246814:timer', 'i:1749005845;', 1749005845);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('1742593a1a6e0a0ce5f1a20446a19e86', 'i:1;', 1750742274);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('1742593a1a6e0a0ce5f1a20446a19e86:timer', 'i:1750742274;', 1750742274);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('1edaad88cba54d34af58e628fdd8eef3', 'i:1;', 1748506893);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('1edaad88cba54d34af58e628fdd8eef3:timer', 'i:1748506893;', 1748506893);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('27d49bc88b88aed5656f58a6043ffa2c', 'i:1;', 1750769657);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('27d49bc88b88aed5656f58a6043ffa2c:timer', 'i:1750769657;', 1750769657);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('2861853fa7ce0282322e9ac686bff42e', 'i:1;', 1750742011);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('2861853fa7ce0282322e9ac686bff42e:timer', 'i:1750742011;', 1750742011);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('52281b435f311fcde876254c0d5d7a02', 'i:1;', 1749654894);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('52281b435f311fcde876254c0d5d7a02:timer', 'i:1749654894;', 1749654894);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('52e73a479bef039d5e52958f251326f8', 'i:1;', 1750736649);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('52e73a479bef039d5e52958f251326f8:timer', 'i:1750736649;', 1750736649);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('66a52cf486a369f1714f6f4211447e2f', 'i:1;', 1750736008);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('66a52cf486a369f1714f6f4211447e2f:timer', 'i:1750736008;', 1750736008);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('6c4e9f6924f83720172530c2e79896db', 'i:1;', 1750769715);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('6c4e9f6924f83720172530c2e79896db:timer', 'i:1750769715;', 1750769715);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('6cd8279593f378760a362f9387d8c898', 'i:1;', 1749878188);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('6cd8279593f378760a362f9387d8c898:timer', 'i:1749878188;', 1749878188);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('721cb751be8a22c9e4499244befa0261', 'i:2;', 1748849791);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('721cb751be8a22c9e4499244befa0261:timer', 'i:1748849791;', 1748849791);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('a9b146432033b2cf69453b232aad1af8', 'i:1;', 1749876750);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('a9b146432033b2cf69453b232aad1af8:timer', 'i:1749876750;', 1749876750);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('admin@gmail.com|127.0.0.1', 'i:1;', 1749560045);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('admin@gmail.com|127.0.0.1:timer', 'i:1749560045;', 1749560045);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('administrator@gmail.com|127.0.0.1', 'i:1;', 1748506893);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('administrator@gmail.com|127.0.0.1:timer', 'i:1748506893;', 1748506893);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('c525a5357e97fef8d3db25841c86da1a', 'i:1;', 1749560045);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('c525a5357e97fef8d3db25841c86da1a:timer', 'i:1749560045;', 1749560045);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('f6bcfa1784e0d9fff1dc3cd19c420d6a', 'i:1;', 1748847159);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('f6bcfa1784e0d9fff1dc3cd19c420d6a:timer', 'i:1748847159;', 1748847159);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('sdsas@gmadssads|127.0.0.1', 'i:1;', 1749876750);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('sdsas@gmadssads|127.0.0.1:timer', 'i:1749876750;', 1749876750);
COMMIT;

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for detail_project
-- ----------------------------
DROP TABLE IF EXISTS `detail_project`;
CREATE TABLE `detail_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` enum('proses','diterima','revisi') DEFAULT 'proses',
  `persentasi` int(11) NOT NULL,
  `revisi` text DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of detail_project
-- ----------------------------
BEGIN;
INSERT INTO `detail_project` (`id`, `project_id`, `deskripsi`, `status`, `persentasi`, `revisi`, `created_at`, `updated_at`) VALUES (1, 1, 'lalalla', 'proses', 20, NULL, '2025-05-22', NULL);
INSERT INTO `detail_project` (`id`, `project_id`, `deskripsi`, `status`, `persentasi`, `revisi`, `created_at`, `updated_at`) VALUES (2, 2, 'Implementasi Fitur Login dan Registrasi User', 'diterima', 100, NULL, '2025-06-02', '2025-06-02');
INSERT INTO `detail_project` (`id`, `project_id`, `deskripsi`, `status`, `persentasi`, `revisi`, `created_at`, `updated_at`) VALUES (3, 2, 'øke sudah valid', 'diterima', 100, NULL, '2025-06-02', '2025-06-02');
INSERT INTO `detail_project` (`id`, `project_id`, `deskripsi`, `status`, `persentasi`, `revisi`, `created_at`, `updated_at`) VALUES (4, 3, 'analisa data magang', 'proses', 50, NULL, '2025-06-02', '2025-06-02');
INSERT INTO `detail_project` (`id`, `project_id`, `deskripsi`, `status`, `persentasi`, `revisi`, `created_at`, `updated_at`) VALUES (5, 3, 'pembuatan database magang', 'proses', 90, NULL, '2025-06-02', '2025-06-02');
INSERT INTO `detail_project` (`id`, `project_id`, `deskripsi`, `status`, `persentasi`, `revisi`, `created_at`, `updated_at`) VALUES (6, 6, 'membuat test', 'proses', 10, NULL, '2025-06-11', '2025-06-11');
INSERT INTO `detail_project` (`id`, `project_id`, `deskripsi`, `status`, `persentasi`, `revisi`, `created_at`, `updated_at`) VALUES (7, 7, 'login validate', 'diterima', 10, NULL, '2025-06-11', '2025-06-12');
INSERT INTO `detail_project` (`id`, `project_id`, `deskripsi`, `status`, `persentasi`, `revisi`, `created_at`, `updated_at`) VALUES (8, 7, 'Judah diperbaiki', 'diterima', 100, NULL, '2025-06-12', '2025-06-12');
INSERT INTO `detail_project` (`id`, `project_id`, `deskripsi`, `status`, `persentasi`, `revisi`, `created_at`, `updated_at`) VALUES (9, 7, 'coba lagi', 'diterima', 100, NULL, '2025-06-12', '2025-06-12');
INSERT INTO `detail_project` (`id`, `project_id`, `deskripsi`, `status`, `persentasi`, `revisi`, `created_at`, `updated_at`) VALUES (10, 8, 'membuat animasi', 'diterima', 100, NULL, '2025-06-14', '2025-06-14');
INSERT INTO `detail_project` (`id`, `project_id`, `deskripsi`, `status`, `persentasi`, `revisi`, `created_at`, `updated_at`) VALUES (11, 9, 'membuat aplikasi medis login', 'diterima', 50, NULL, '2025-06-14', '2025-06-14');
INSERT INTO `detail_project` (`id`, `project_id`, `deskripsi`, `status`, `persentasi`, `revisi`, `created_at`, `updated_at`) VALUES (12, 9, 'membuat data member', 'diterima', 10, NULL, '2025-06-14', '2025-06-14');
INSERT INTO `detail_project` (`id`, `project_id`, `deskripsi`, `status`, `persentasi`, `revisi`, `created_at`, `updated_at`) VALUES (13, 9, 'membuat transaksi', 'diterima', 40, NULL, '2025-06-14', '2025-06-14');
INSERT INTO `detail_project` (`id`, `project_id`, `deskripsi`, `status`, `persentasi`, `revisi`, `created_at`, `updated_at`) VALUES (14, 10, 'tes selesai', 'proses', 10, NULL, '2025-06-24', '2025-06-24');
INSERT INTO `detail_project` (`id`, `project_id`, `deskripsi`, `status`, `persentasi`, `revisi`, `created_at`, `updated_at`) VALUES (15, 10, 'adsas', 'proses', 40, NULL, '2025-06-24', '2025-06-24');
INSERT INTO `detail_project` (`id`, `project_id`, `deskripsi`, `status`, `persentasi`, `revisi`, `created_at`, `updated_at`) VALUES (16, 10, 'sd dadas', 'proses', 50, NULL, '2025-06-24', '2025-06-24');
COMMIT;

-- ----------------------------
-- Table structure for details_session
-- ----------------------------
DROP TABLE IF EXISTS `details_session`;
CREATE TABLE `details_session` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name_playstation` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `rent_session_id` int(11) NOT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of details_session
-- ----------------------------
BEGIN;
INSERT INTO `details_session` (`id`, `name_playstation`, `note`, `rent_session_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 'ps bagian 1', 'warna hijau', 1, 23, 23, NULL, '2025-03-15 08:31:48', '2025-03-15 08:34:52', NULL);
INSERT INTO `details_session` (`id`, `name_playstation`, `note`, `rent_session_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 'PS 4 sesi 2', 'jaga kebersihan yaa', 2, 23, NULL, NULL, '2025-03-15 17:33:11', '2025-03-15 17:33:11', NULL);
INSERT INTO `details_session` (`id`, `name_playstation`, `note`, `rent_session_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 'PS 5 meja 1', 'jaga kebersihan', 3, 23, NULL, NULL, '2025-03-15 18:15:34', '2025-03-15 18:15:34', NULL);
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for instansi
-- ----------------------------
DROP TABLE IF EXISTS `instansi`;
CREATE TABLE `instansi` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `kuota` int(11) DEFAULT NULL,
  `kuota_tersedia` int(100) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of instansi
-- ----------------------------
BEGIN;
INSERT INTO `instansi` (`id`, `nama`, `kuota`, `kuota_tersedia`, `is_active`, `created_at`, `updated_at`) VALUES (1, 'Politeknik Caltex Riau', 3, 10, 1, NULL, '2025-05-29');
INSERT INTO `instansi` (`id`, `nama`, `kuota`, `kuota_tersedia`, `is_active`, `created_at`, `updated_at`) VALUES (2, 'Universitas Riau', 3, 10, 0, NULL, '2025-05-29');
INSERT INTO `instansi` (`id`, `nama`, `kuota`, `kuota_tersedia`, `is_active`, `created_at`, `updated_at`) VALUES (3, 'Universitas Lancang Kuning', 3, 9, 1, '2025-05-15', '2025-06-24');
INSERT INTO `instansi` (`id`, `nama`, `kuota`, `kuota_tersedia`, `is_active`, `created_at`, `updated_at`) VALUES (4, 'Univeristas Riau', 5, 10, 1, '2025-05-15', '2025-05-15');
INSERT INTO `instansi` (`id`, `nama`, `kuota`, `kuota_tersedia`, `is_active`, `created_at`, `updated_at`) VALUES (5, 'Politeknik Bengkalis', 3, 10, 1, '2025-05-22', '2025-05-29');
COMMIT;

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of job_batches
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for jurusan
-- ----------------------------
DROP TABLE IF EXISTS `jurusan`;
CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jurusan_name_key` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of jurusan
-- ----------------------------
BEGIN;
INSERT INTO `jurusan` (`id`, `nama`, `created_at`, `updated_at`) VALUES (1, 'Teknik Informatika', NULL, NULL);
INSERT INTO `jurusan` (`id`, `nama`, `created_at`, `updated_at`) VALUES (2, 'Sistem Informasi', NULL, NULL);
INSERT INTO `jurusan` (`id`, `nama`, `created_at`, `updated_at`) VALUES (4, 'Hubungan Internasional', '2025-05-15', '2025-05-15');
INSERT INTO `jurusan` (`id`, `nama`, `created_at`, `updated_at`) VALUES (8, 'Manajemen informatika', '2025-05-29', '2025-05-29');
COMMIT;

-- ----------------------------
-- Table structure for kriteria_penilaian
-- ----------------------------
DROP TABLE IF EXISTS `kriteria_penilaian`;
CREATE TABLE `kriteria_penilaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posisi_id` int(11) DEFAULT NULL,
  `evaluation_name` varchar(191) DEFAULT NULL,
  `evaluation_type` enum('personal','competence') DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evaluation_criteria_templates_position_id_fkey` (`posisi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of kriteria_penilaian
-- ----------------------------
BEGIN;
INSERT INTO `kriteria_penilaian` (`id`, `posisi_id`, `evaluation_name`, `evaluation_type`, `created_at`, `updated_at`) VALUES (29, 8, 'kurikudi', 'personal', '2025-05-31', '2025-05-31');
INSERT INTO `kriteria_penilaian` (`id`, `posisi_id`, `evaluation_name`, `evaluation_type`, `created_at`, `updated_at`) VALUES (30, 8, 'kurikudi ko', 'competence', '2025-05-31', '2025-05-31');
INSERT INTO `kriteria_penilaian` (`id`, `posisi_id`, `evaluation_name`, `evaluation_type`, `created_at`, `updated_at`) VALUES (31, 7, 'Inisiatif', 'personal', '2025-05-31', '2025-05-31');
INSERT INTO `kriteria_penilaian` (`id`, `posisi_id`, `evaluation_name`, `evaluation_type`, `created_at`, `updated_at`) VALUES (32, 7, 'Kerja Sama Tim', 'personal', '2025-05-31', '2025-05-31');
INSERT INTO `kriteria_penilaian` (`id`, `posisi_id`, `evaluation_name`, `evaluation_type`, `created_at`, `updated_at`) VALUES (33, 7, 'tes kemampuan', 'personal', '2025-05-31', '2025-05-31');
INSERT INTO `kriteria_penilaian` (`id`, `posisi_id`, `evaluation_name`, `evaluation_type`, `created_at`, `updated_at`) VALUES (34, 7, 'Keterampilan Teknis', 'competence', '2025-05-31', '2025-05-31');
INSERT INTO `kriteria_penilaian` (`id`, `posisi_id`, `evaluation_name`, `evaluation_type`, `created_at`, `updated_at`) VALUES (35, 7, 'Merakit Komputer', 'competence', '2025-05-31', '2025-05-31');
INSERT INTO `kriteria_penilaian` (`id`, `posisi_id`, `evaluation_name`, `evaluation_type`, `created_at`, `updated_at`) VALUES (42, 11, 'Tata krama', 'personal', '2025-06-03', '2025-06-03');
INSERT INTO `kriteria_penilaian` (`id`, `posisi_id`, `evaluation_name`, `evaluation_type`, `created_at`, `updated_at`) VALUES (43, 11, 'Kedisplinan', 'personal', '2025-06-03', '2025-06-03');
INSERT INTO `kriteria_penilaian` (`id`, `posisi_id`, `evaluation_name`, `evaluation_type`, `created_at`, `updated_at`) VALUES (44, 11, 'kerja sama', 'personal', '2025-06-03', '2025-06-03');
INSERT INTO `kriteria_penilaian` (`id`, `posisi_id`, `evaluation_name`, `evaluation_type`, `created_at`, `updated_at`) VALUES (45, 11, 'keterampilan', 'competence', '2025-06-03', '2025-06-03');
INSERT INTO `kriteria_penilaian` (`id`, `posisi_id`, `evaluation_name`, `evaluation_type`, `created_at`, `updated_at`) VALUES (46, 11, 'design figma', 'competence', '2025-06-03', '2025-06-03');
INSERT INTO `kriteria_penilaian` (`id`, `posisi_id`, `evaluation_name`, `evaluation_type`, `created_at`, `updated_at`) VALUES (47, 11, 'ide', 'competence', '2025-06-03', '2025-06-03');
COMMIT;

-- ----------------------------
-- Table structure for mentor
-- ----------------------------
DROP TABLE IF EXISTS `mentor`;
CREATE TABLE `mentor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `posisi_mentor` varchar(100) DEFAULT NULL,
  `posisi_id` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of mentor
-- ----------------------------
BEGIN;
INSERT INTO `mentor` (`id`, `nama`, `posisi_mentor`, `posisi_id`, `email`, `password`, `is_active`, `created_at`, `updated_at`) VALUES (1, 'walid', 'programmer', 11, 'walid@gmail.com', '12345', 0, NULL, '2025-06-11 00:58:04');
INSERT INTO `mentor` (`id`, `nama`, `posisi_mentor`, `posisi_id`, `email`, `password`, `is_active`, `created_at`, `updated_at`) VALUES (9, 'Winda Mentor', 'Programmer', 12, 'windamentor@gmail.com', '12345678', 1, '2025-05-30 16:47:31', '2025-06-12 08:35:04');
INSERT INTO `mentor` (`id`, `nama`, `posisi_mentor`, `posisi_id`, `email`, `password`, `is_active`, `created_at`, `updated_at`) VALUES (10, 'Endru Phoenix', NULL, 7, 'endru@gmail.com', '12345678', 1, '2025-06-10 14:55:53', '2025-06-10 14:55:53');
INSERT INTO `mentor` (`id`, `nama`, `posisi_mentor`, `posisi_id`, `email`, `password`, `is_active`, `created_at`, `updated_at`) VALUES (11, 'PENTOR', NULL, NULL, 'pnetor@gmail.com', '12345678', 1, '2025-06-11 03:00:46', '2025-06-11 03:00:46');
INSERT INTO `mentor` (`id`, `nama`, `posisi_mentor`, `posisi_id`, `email`, `password`, `is_active`, `created_at`, `updated_at`) VALUES (12, 'assa', NULL, NULL, 'mentoro@gmail.com', '12345678', 1, '2025-06-11 03:01:47', '2025-06-11 03:01:47');
INSERT INTO `mentor` (`id`, `nama`, `posisi_mentor`, `posisi_id`, `email`, `password`, `is_active`, `created_at`, `updated_at`) VALUES (13, 'Endru Phoenix', NULL, NULL, 'endru1@gmail.com', '12345678', 1, '2025-06-18 13:34:02', '2025-06-18 13:34:02');
INSERT INTO `mentor` (`id`, `nama`, `posisi_mentor`, `posisi_id`, `email`, `password`, `is_active`, `created_at`, `updated_at`) VALUES (14, 'Endru Phoenix3', 'programmer', NULL, 'endru2@gmail.com', '12345678', 1, '2025-06-18 13:37:52', '2025-06-18 13:37:52');
INSERT INTO `mentor` (`id`, `nama`, `posisi_mentor`, `posisi_id`, `email`, `password`, `is_active`, `created_at`, `updated_at`) VALUES (15, 'heru mentor', 'UI/UX', NULL, 'herumentor@gmail.com', '12345678', 1, '2025-06-24 03:32:08', '2025-06-24 03:32:08');
INSERT INTO `mentor` (`id`, `nama`, `posisi_mentor`, `posisi_id`, `email`, `password`, `is_active`, `created_at`, `updated_at`) VALUES (16, 'herumentori', 'DESAIN GRAFIK', NULL, 'herumentori@gmail.com', '12345678', 1, '2025-06-24 03:42:54', '2025-06-24 03:42:54');
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4, '2024_04_18_143500_add_two_factor_columns_to_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5, '2024_04_18_144203_add_phone_role_at_users', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6, '2024_04_23_140225_add_some_field_to_users', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7, '2024_04_23_141411_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8, '2024_04_23_144808_create_companies_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9, '2024_04_23_151801_create_attendances_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10, '2024_04_24_135413_create_permissions_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11, '2024_04_24_142533_create_notes_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12, '2024_06_12_125714_create_kategori_buku_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (13, '2024_06_12_130700_buku', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (14, '2024_06_12_131204_create_pinjam_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (16, '2025_03_13_104225_create_master_ps_table', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (17, '2025_03_15_062421_create_bill', 3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (18, '2025_03_15_062406_create_queque_session', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (19, '2025_03_15_061934_create_details_session', 5);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (20, '2025_03_15_061917_create_rent_session', 6);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (21, '2024_05_01_034750_add_two_factor_columns_to_users_table', 7);
COMMIT;

-- ----------------------------
-- Table structure for mitra
-- ----------------------------
DROP TABLE IF EXISTS `mitra`;
CREATE TABLE `mitra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kuota` int(11) NOT NULL,
  `kuota_tersedia` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `createdAt` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `updatedAt` datetime(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of mitra
-- ----------------------------
BEGIN;
INSERT INTO `mitra` (`id`, `kuota`, `kuota_tersedia`, `is_active`, `createdAt`, `updatedAt`) VALUES (1, 3, 2, 1, '2025-05-12 14:35:16.000', '0000-00-00 00:00:00.000');
COMMIT;

-- ----------------------------
-- Table structure for notes
-- ----------------------------
DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notes_user_id_foreign` (`user_id`),
  CONSTRAINT `notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of notes
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for notification
-- ----------------------------
DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `subtitle` text NOT NULL,
  `is_viewed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `updated_at` datetime(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `notification_user_id_fkey` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of notification
-- ----------------------------
BEGIN;
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (4, 1, 'Pendaftaran', 'Dedi Andika Baru saja melakukan pendaftaran', 0, '2025-06-13 09:30:26.000', '2025-06-13 09:30:26.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (5, 2, 'Pendaftaran', 'Dedi Andika Baru saja melakukan pendaftaran', 0, '2025-06-13 09:30:30.000', '2025-06-13 09:30:30.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (6, 23, 'Pendaftaran', 'Dedi Andika Baru saja melakukan pendaftaran', 0, '2025-06-13 09:30:31.000', '2025-06-13 09:30:31.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (19, 1, 'Project Selesai', 'kanza Telah Menyelesaikan Project : membuat animasi, Segera berikan nilai untuk pekerjaan ini.', 0, '2025-06-14 03:03:13.000', '2025-06-14 03:03:13.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (20, 2, 'Project Selesai', 'kanza Telah Menyelesaikan Project : membuat animasi, Segera berikan nilai untuk pekerjaan ini.', 0, '2025-06-14 03:03:16.000', '2025-06-14 03:03:16.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (21, 23, 'Project Selesai', 'kanza Telah Menyelesaikan Project : membuat animasi, Segera berikan nilai untuk pekerjaan ini.', 0, '2025-06-14 03:03:18.000', '2025-06-14 03:03:18.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (22, 44, 'Project Selesai', 'kanza Telah Menyelesaikan Project : membuat animasi, Segera berikan nilai untuk pekerjaan ini.', 0, '2025-06-14 03:03:20.000', '2025-06-14 03:03:20.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (23, 44, 'Review Project', 'kanza Telah Menambahkan progres project : membuat data member, Segera review untuk pekerjaan ini.', 0, '2025-06-14 03:19:58.000', '2025-06-14 03:19:58.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (24, 44, 'Review Project', 'kanza Telah Menambahkan progres project : membuat transaksi, Segera review untuk pekerjaan ini.', 0, '2025-06-14 03:24:35.000', '2025-06-14 03:24:35.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (25, 53, 'Review Mentor', 'Mentor telah mereview project : membuat data member, Segera cek hasil review.', 1, '2025-06-14 03:35:27.000', '2025-06-14 03:35:27.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (26, 53, 'Review Mentor', 'Mentor telah mereview project : membuat transaksi, Segera cek hasil review.', 1, '2025-06-14 03:36:47.000', '2025-06-14 03:36:47.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (27, 53, 'Review Mentor', 'Mentor telah mereview project : membuat data member, Segera cek hasil review.', 1, '2025-06-14 03:38:22.000', '2025-06-14 03:38:22.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (32, 57, 'Administrasi', 'Selamat Administrasi Anda Telah diterima, Tunggu Proses Selanjutnya', 0, '2025-06-14 03:46:26.000', '2025-06-14 03:46:26.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (33, 57, 'Administrasi', 'Maaf Administrasi Anda Ditolak.', 0, '2025-06-14 03:48:41.000', '2025-06-14 03:48:41.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (34, 57, 'Administrasi', 'Maaf Administrasi Anda Ditolak. Alasan Ditolak : ', 0, '2025-06-14 03:49:43.000', '2025-06-14 03:49:43.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (35, 57, 'Administrasi', 'Maaf Administrasi Anda Ditolak. Alasan Ditolak : ', 0, '2025-06-14 03:52:01.000', '2025-06-14 03:52:01.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (36, 57, 'Administrasi', 'Maaf Administrasi Anda Ditolak. Alasan Ditolak : data tidak lengkap', 0, '2025-06-14 03:52:32.000', '2025-06-14 03:52:32.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (37, 57, 'Administrasi', 'Selamat Administrasi Anda Telah diterima, Tunggu Proses Selanjutnya', 0, '2025-06-14 03:53:40.000', '2025-06-14 03:53:40.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (38, 57, 'Administrasi', 'Selamat Administrasi Anda Telah diterima, Tunggu Proses Selanjutnya', 0, '2025-06-14 03:54:12.000', '2025-06-14 03:54:12.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (39, 57, 'Tes Kemampuan', 'Maaf Tes Kemampuan Anda Ditolak. Alasan Ditolak : data tidak lengkap', 0, '2025-06-14 03:57:30.000', '2025-06-14 03:57:30.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (40, 57, 'Tes Kemampuan', 'Maaf Tes Kemampuan Anda Ditolak. Alasan Ditolak : tidak sesuai harapan', 0, '2025-06-14 03:59:00.000', '2025-06-14 03:59:00.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (41, 57, 'Tes Kemampuan', 'Selamat Tes kemampuan Anda Telah diterima, Tunggu Proses Selanjutnya', 0, '2025-06-14 04:01:11.000', '2025-06-14 04:01:11.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (42, 57, 'Wawancara', 'Maaf Tes Kemampuan Anda Ditolak. Alasan Ditolak : tidak memenuhi kriteria', 0, '2025-06-14 04:49:26.000', '2025-06-14 04:49:26.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (44, 57, 'Wawancara', 'Halo Dedi Andika kamu akan wawancara 1 Hari Lagi, pastikan melengkapi semua kebutuhan', 0, '2025-06-14 05:09:56.000', '2025-06-14 05:09:56.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (45, 1, 'Proses Pendaftaran', 'Kamu belum memproses pendaftaran iwan1 selama 12 Hari, segera lakukan proses pendaftaran', 0, '2025-06-14 05:46:37.000', '2025-06-14 05:46:37.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (46, 2, 'Proses Pendaftaran', 'Kamu belum memproses pendaftaran iwan1 selama 12 Hari, segera lakukan proses pendaftaran', 0, '2025-06-14 05:46:41.000', '2025-06-14 05:46:41.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (47, 23, 'Proses Pendaftaran', 'Kamu belum memproses pendaftaran iwan1 selama 12 Hari, segera lakukan proses pendaftaran', 0, '2025-06-14 05:46:43.000', '2025-06-14 05:46:43.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (48, 50, 'Proses Pendaftaran', 'Admin belum memproses pendaftaran iwan1 selama 12 Hari, segera lakukan proses pendaftaran', 0, '2025-06-14 05:46:45.000', '2025-06-14 05:46:45.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (49, 1, 'Proses Pendaftaran', 'Kamu belum memproses pendaftaran iwan1 selama 13 Hari, segera lakukan proses pendaftaran', 0, '2025-06-15 13:09:03.000', '2025-06-15 13:09:03.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (50, 2, 'Proses Pendaftaran', 'Kamu belum memproses pendaftaran iwan1 selama 13 Hari, segera lakukan proses pendaftaran', 0, '2025-06-15 13:09:07.000', '2025-06-15 13:09:07.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (51, 23, 'Proses Pendaftaran', 'Kamu belum memproses pendaftaran iwan1 selama 13 Hari, segera lakukan proses pendaftaran', 0, '2025-06-15 13:09:10.000', '2025-06-15 13:09:10.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (52, 50, 'Proses Pendaftaran', 'Admin belum memproses pendaftaran iwan1 selama 13 Hari, segera lakukan proses pendaftaran', 0, '2025-06-15 13:09:12.000', '2025-06-15 13:09:12.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (53, 27, 'Administrasi', 'Selamat Administrasi Anda Telah diterima, Tunggu Proses Selanjutnya', 0, '2025-06-15 13:09:49.000', '2025-06-15 13:09:49.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (54, 27, 'Administrasi', 'Selamat Administrasi Anda Telah diterima, Tunggu Proses Selanjutnya', 0, '2025-06-15 13:09:54.000', '2025-06-15 13:09:54.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (55, 1, 'Pendaftaran', 'Heru Pranata Baru saja melakukan pendaftaran', 0, '2025-06-24 04:07:57.000', '2025-06-24 04:07:57.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (56, 2, 'Pendaftaran', 'Heru Pranata Baru saja melakukan pendaftaran', 0, '2025-06-24 04:08:00.000', '2025-06-24 04:08:00.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (57, 23, 'Pendaftaran', 'Heru Pranata Baru saja melakukan pendaftaran', 0, '2025-06-24 04:08:02.000', '2025-06-24 04:08:02.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (58, 50, 'Pendaftaran', 'Heru Pranata Baru saja melakukan pendaftaran', 0, '2025-06-24 04:08:03.000', '2025-06-24 04:08:03.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (59, 62, 'Administrasi', 'Selamat Administrasi Anda Telah diterima, Tunggu Proses Selanjutnya', 0, '2025-06-24 04:20:20.000', '2025-06-24 04:20:20.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (60, 62, 'Tes Kemampuan', 'Selamat Tes kemampuan Anda Telah diterima, Tunggu Proses Selanjutnya', 0, '2025-06-24 04:23:18.000', '2025-06-24 04:23:18.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (61, 62, 'Wawancara', 'Selamat Wawancara Anda Telah diterima, Tunggu Proses Selanjutnya', 0, '2025-06-24 04:24:46.000', '2025-06-24 04:24:46.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (62, 44, 'Review Project', 'Heru Pranata Telah Menambahkan progres project : tes selesai, Segera review untuk pekerjaan ini.', 0, '2025-06-24 04:28:45.000', '2025-06-24 04:28:45.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (63, 44, 'Review Project', 'Heru Pranata Telah Menambahkan progres project : adsas, Segera review untuk pekerjaan ini.', 0, '2025-06-24 04:32:22.000', '2025-06-24 04:32:22.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (64, 44, 'Review Project', 'Heru Pranata Telah Menambahkan progres project : sd dadas, Segera review untuk pekerjaan ini.', 0, '2025-06-24 04:36:08.000', '2025-06-24 04:36:08.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (65, 62, 'Wawancara', 'Selamat Wawancara Anda Telah diterima, Tunggu Proses Selanjutnya', 0, '2025-06-24 04:50:52.000', '2025-06-24 04:50:52.000');
INSERT INTO `notification` (`id`, `user_id`, `title`, `subtitle`, `is_viewed`, `created_at`, `updated_at`) VALUES (66, 62, 'Wawancara', 'Selamat Wawancara Anda Telah diterima, Tunggu Proses Selanjutnya', 0, '2025-06-24 05:07:06.000', '2025-06-24 05:07:06.000');
COMMIT;

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------
BEGIN;
INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES ('kanza@gmail.com', '$2y$12$.WTGRqtzxe.a8lbKTZzVm.t3BKB0vURoHTT5kINhWlSrFL5tAtd1O', '2025-06-13 06:58:08');
COMMIT;

-- ----------------------------
-- Table structure for pengajuan
-- ----------------------------
DROP TABLE IF EXISTS `pengajuan`;
CREATE TABLE `pengajuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `posisi_id` int(11) DEFAULT NULL,
  `periode_id` int(11) DEFAULT NULL,
  `soal_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `status_administrasi` enum('belumDiproses','diterima','proses','ditolak') DEFAULT 'belumDiproses',
  `status_tes_kemampuan` enum('belumDiproses','diterima','proses','ditolak') DEFAULT 'belumDiproses',
  `status_wawancara` enum('belumDiproses','diterima','proses','ditolak') DEFAULT 'belumDiproses',
  `status` enum('belumDiproses','proses','alumni','tes_kemampuan','ditolak','administrasi','wawancara','diterima') DEFAULT 'belumDiproses',
  `tanggal_wawancara` date DEFAULT NULL,
  `jam_wawancara` time DEFAULT NULL,
  `tanggal_awal_tes_kemampuan` date DEFAULT NULL,
  `tanggal_akhir_tes_kemampuan` date DEFAULT NULL,
  `link_wawancara` text DEFAULT NULL,
  `catatan_tolak_administrasi` text DEFAULT NULL,
  `catatan_tolak_tes_kemampuan` text DEFAULT NULL,
  `catatan_tolak_wawancara` text DEFAULT NULL,
  `catatan_terima_wawancara` text DEFAULT NULL,
  `created_at` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `updated_at` datetime(3) NOT NULL,
  `jawaban_tes_kemampuan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengajuan_user_id_fkey` (`user_id`),
  KEY `pengajuan_posisi_id_fkey` (`posisi_id`),
  KEY `pengajuan_periode_id_fkey` (`periode_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pengajuan
-- ----------------------------
BEGIN;
INSERT INTO `pengajuan` (`id`, `user_id`, `posisi_id`, `periode_id`, `soal_id`, `is_active`, `status_administrasi`, `status_tes_kemampuan`, `status_wawancara`, `status`, `tanggal_wawancara`, `jam_wawancara`, `tanggal_awal_tes_kemampuan`, `tanggal_akhir_tes_kemampuan`, `link_wawancara`, `catatan_tolak_administrasi`, `catatan_tolak_tes_kemampuan`, `catatan_tolak_wawancara`, `catatan_terima_wawancara`, `created_at`, `updated_at`, `jawaban_tes_kemampuan`) VALUES (1, 2, 1, 1, NULL, 1, 'proses', 'diterima', 'diterima', 'diterima', '2025-05-21', NULL, '2025-05-22', '2025-05-30', 'wawancara.com', NULL, NULL, NULL, NULL, '2025-05-21 13:51:33.000', '0000-00-00 00:00:00.000', NULL);
INSERT INTO `pengajuan` (`id`, `user_id`, `posisi_id`, `periode_id`, `soal_id`, `is_active`, `status_administrasi`, `status_tes_kemampuan`, `status_wawancara`, `status`, `tanggal_wawancara`, `jam_wawancara`, `tanggal_awal_tes_kemampuan`, `tanggal_akhir_tes_kemampuan`, `link_wawancara`, `catatan_tolak_administrasi`, `catatan_tolak_tes_kemampuan`, `catatan_tolak_wawancara`, `catatan_terima_wawancara`, `created_at`, `updated_at`, `jawaban_tes_kemampuan`) VALUES (5, 1, 1, 1, NULL, 1, 'diterima', 'belumDiproses', 'belumDiproses', 'belumDiproses', '2025-05-16', NULL, '2025-05-14', '2025-05-16', 'wawancara.com', NULL, NULL, NULL, NULL, '2025-05-11 11:46:54.000', '0000-00-00 00:00:00.000', NULL);
INSERT INTO `pengajuan` (`id`, `user_id`, `posisi_id`, `periode_id`, `soal_id`, `is_active`, `status_administrasi`, `status_tes_kemampuan`, `status_wawancara`, `status`, `tanggal_wawancara`, `jam_wawancara`, `tanggal_awal_tes_kemampuan`, `tanggal_akhir_tes_kemampuan`, `link_wawancara`, `catatan_tolak_administrasi`, `catatan_tolak_tes_kemampuan`, `catatan_tolak_wawancara`, `catatan_terima_wawancara`, `created_at`, `updated_at`, `jawaban_tes_kemampuan`) VALUES (10, 36, 12, 2, NULL, NULL, 'ditolak', 'belumDiproses', 'belumDiproses', 'ditolak', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-01 02:05:18.000', '2025-06-02 06:37:51.000', '');
INSERT INTO `pengajuan` (`id`, `user_id`, `posisi_id`, `periode_id`, `soal_id`, `is_active`, `status_administrasi`, `status_tes_kemampuan`, `status_wawancara`, `status`, `tanggal_wawancara`, `jam_wawancara`, `tanggal_awal_tes_kemampuan`, `tanggal_akhir_tes_kemampuan`, `link_wawancara`, `catatan_tolak_administrasi`, `catatan_tolak_tes_kemampuan`, `catatan_tolak_wawancara`, `catatan_terima_wawancara`, `created_at`, `updated_at`, `jawaban_tes_kemampuan`) VALUES (11, 36, 11, 3, 6, NULL, 'diterima', 'diterima', 'diterima', 'diterima', '2025-06-02', '10:53:42', '2025-06-01', '2025-06-06', 'https://zoom.com', NULL, 'SALAH', '', NULL, '2025-06-01 02:34:50.000', '2025-06-02 06:56:05.000', 'jawaban/jawaban-2025060202335257517.pdf');
INSERT INTO `pengajuan` (`id`, `user_id`, `posisi_id`, `periode_id`, `soal_id`, `is_active`, `status_administrasi`, `status_tes_kemampuan`, `status_wawancara`, `status`, `tanggal_wawancara`, `jam_wawancara`, `tanggal_awal_tes_kemampuan`, `tanggal_akhir_tes_kemampuan`, `link_wawancara`, `catatan_tolak_administrasi`, `catatan_tolak_tes_kemampuan`, `catatan_tolak_wawancara`, `catatan_terima_wawancara`, `created_at`, `updated_at`, `jawaban_tes_kemampuan`) VALUES (13, 53, 11, 5, 7, NULL, 'diterima', 'diterima', 'diterima', 'diterima', '2025-06-13', '22:47:00', '2025-06-11', '2025-06-11', 'https://zoom.com', NULL, NULL, NULL, 'bagus sekali', '2025-06-11 15:31:50.000', '2025-06-11 15:51:04.000', 'jawaban/jawaban-2025061103445231696.pdf');
INSERT INTO `pengajuan` (`id`, `user_id`, `posisi_id`, `periode_id`, `soal_id`, `is_active`, `status_administrasi`, `status_tes_kemampuan`, `status_wawancara`, `status`, `tanggal_wawancara`, `jam_wawancara`, `tanggal_awal_tes_kemampuan`, `tanggal_akhir_tes_kemampuan`, `link_wawancara`, `catatan_tolak_administrasi`, `catatan_tolak_tes_kemampuan`, `catatan_tolak_wawancara`, `catatan_terima_wawancara`, `created_at`, `updated_at`, `jawaban_tes_kemampuan`) VALUES (19, 57, 11, 11, 8, NULL, 'diterima', 'diterima', 'diterima', 'diterima', '2025-06-15', '11:45:00', '2025-06-14', '2025-06-13', 'http:zombie.com', 'data tidak lengkap', 'tidak sesuai harapan', 'tidak memenuhi kriteria', NULL, '2025-06-13 09:30:26.000', '2025-06-14 04:49:30.000', NULL);
INSERT INTO `pengajuan` (`id`, `user_id`, `posisi_id`, `periode_id`, `soal_id`, `is_active`, `status_administrasi`, `status_tes_kemampuan`, `status_wawancara`, `status`, `tanggal_wawancara`, `jam_wawancara`, `tanggal_awal_tes_kemampuan`, `tanggal_akhir_tes_kemampuan`, `link_wawancara`, `catatan_tolak_administrasi`, `catatan_tolak_tes_kemampuan`, `catatan_tolak_wawancara`, `catatan_terima_wawancara`, `created_at`, `updated_at`, `jawaban_tes_kemampuan`) VALUES (20, 62, 11, 12, 9, NULL, 'diterima', 'diterima', 'diterima', 'diterima', '2025-06-30', '12:30:00', '2025-06-28', '2025-06-30', 'http:fb.com', NULL, NULL, NULL, 'bagus sekali', '2025-06-24 04:07:57.000', '2025-06-24 05:07:09.000', 'jawaban/jawaban-2025062404224661522.pdf');
COMMIT;

-- ----------------------------
-- Table structure for penilaian
-- ----------------------------
DROP TABLE IF EXISTS `penilaian`;
CREATE TABLE `penilaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pengajuan_id` int(11) DEFAULT NULL,
  `mentor_id` int(10) DEFAULT NULL,
  `evaluation_name` varchar(191) NOT NULL,
  `evaluation_type` enum('personal','competence') NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of penilaian
-- ----------------------------
BEGIN;
INSERT INTO `penilaian` (`id`, `pengajuan_id`, `mentor_id`, `evaluation_name`, `evaluation_type`, `value`, `created_at`, `updated_at`) VALUES (1, 1, 1, '', '', 0, NULL, NULL);
INSERT INTO `penilaian` (`id`, `pengajuan_id`, `mentor_id`, `evaluation_name`, `evaluation_type`, `value`, `created_at`, `updated_at`) VALUES (14, NULL, NULL, 'keterampilan', 'competence', 80, '2025-06-03', '2025-06-03');
INSERT INTO `penilaian` (`id`, `pengajuan_id`, `mentor_id`, `evaluation_name`, `evaluation_type`, `value`, `created_at`, `updated_at`) VALUES (15, NULL, NULL, 'design figma', 'competence', 90, '2025-06-03', '2025-06-03');
INSERT INTO `penilaian` (`id`, `pengajuan_id`, `mentor_id`, `evaluation_name`, `evaluation_type`, `value`, `created_at`, `updated_at`) VALUES (16, NULL, NULL, 'ide', 'competence', 90, '2025-06-03', '2025-06-03');
INSERT INTO `penilaian` (`id`, `pengajuan_id`, `mentor_id`, `evaluation_name`, `evaluation_type`, `value`, `created_at`, `updated_at`) VALUES (17, NULL, NULL, 'revisi', 'competence', 100, '2025-06-03', '2025-06-03');
INSERT INTO `penilaian` (`id`, `pengajuan_id`, `mentor_id`, `evaluation_name`, `evaluation_type`, `value`, `created_at`, `updated_at`) VALUES (25, 11, 9, 'keterampilan', 'competence', 80, '2025-06-03', '2025-06-03');
INSERT INTO `penilaian` (`id`, `pengajuan_id`, `mentor_id`, `evaluation_name`, `evaluation_type`, `value`, `created_at`, `updated_at`) VALUES (26, 11, 9, 'design figma', 'competence', 90, '2025-06-03', '2025-06-03');
INSERT INTO `penilaian` (`id`, `pengajuan_id`, `mentor_id`, `evaluation_name`, `evaluation_type`, `value`, `created_at`, `updated_at`) VALUES (27, 11, 9, 'ide', 'competence', 90, '2025-06-03', '2025-06-03');
INSERT INTO `penilaian` (`id`, `pengajuan_id`, `mentor_id`, `evaluation_name`, `evaluation_type`, `value`, `created_at`, `updated_at`) VALUES (28, 11, 9, 'revisi', 'competence', 100, '2025-06-03', '2025-06-03');
INSERT INTO `penilaian` (`id`, `pengajuan_id`, `mentor_id`, `evaluation_name`, `evaluation_type`, `value`, `created_at`, `updated_at`) VALUES (29, 11, 9, 'Tata krama', 'personal', 80, '2025-06-03', '2025-06-03');
INSERT INTO `penilaian` (`id`, `pengajuan_id`, `mentor_id`, `evaluation_name`, `evaluation_type`, `value`, `created_at`, `updated_at`) VALUES (30, 11, 9, 'Kedisplinan', 'personal', 80, '2025-06-03', '2025-06-03');
INSERT INTO `penilaian` (`id`, `pengajuan_id`, `mentor_id`, `evaluation_name`, `evaluation_type`, `value`, `created_at`, `updated_at`) VALUES (31, 11, 9, 'kerja sama', 'personal', 70, '2025-06-03', '2025-06-03');
INSERT INTO `penilaian` (`id`, `pengajuan_id`, `mentor_id`, `evaluation_name`, `evaluation_type`, `value`, `created_at`, `updated_at`) VALUES (32, 11, 9, 'absensi', 'personal', 100, '2025-06-03', '2025-06-03');
INSERT INTO `penilaian` (`id`, `pengajuan_id`, `mentor_id`, `evaluation_name`, `evaluation_type`, `value`, `created_at`, `updated_at`) VALUES (36, 13, 9, 'keterampilan', 'competence', 80, '2025-06-24', '2025-06-24');
INSERT INTO `penilaian` (`id`, `pengajuan_id`, `mentor_id`, `evaluation_name`, `evaluation_type`, `value`, `created_at`, `updated_at`) VALUES (37, 13, 9, 'design figma', 'competence', 75, '2025-06-24', '2025-06-24');
INSERT INTO `penilaian` (`id`, `pengajuan_id`, `mentor_id`, `evaluation_name`, `evaluation_type`, `value`, `created_at`, `updated_at`) VALUES (38, 13, 9, 'ide', 'competence', 80, '2025-06-24', '2025-06-24');
INSERT INTO `penilaian` (`id`, `pengajuan_id`, `mentor_id`, `evaluation_name`, `evaluation_type`, `value`, `created_at`, `updated_at`) VALUES (39, 13, 9, 'Tata krama', 'personal', 90, '2025-06-24', '2025-06-24');
INSERT INTO `penilaian` (`id`, `pengajuan_id`, `mentor_id`, `evaluation_name`, `evaluation_type`, `value`, `created_at`, `updated_at`) VALUES (40, 13, 9, 'Kedisplinan', 'personal', 40, '2025-06-24', '2025-06-24');
INSERT INTO `penilaian` (`id`, `pengajuan_id`, `mentor_id`, `evaluation_name`, `evaluation_type`, `value`, `created_at`, `updated_at`) VALUES (41, 13, 9, 'kerja sama', 'personal', 50, '2025-06-24', '2025-06-24');
COMMIT;

-- ----------------------------
-- Table structure for periode
-- ----------------------------
DROP TABLE IF EXISTS `periode`;
CREATE TABLE `periode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `created_at` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `updated_at` datetime(3) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `periode_user_id_fkey` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of periode
-- ----------------------------
BEGIN;
INSERT INTO `periode` (`id`, `user_id`, `tanggal_pengajuan`, `tanggal_selesai`, `created_at`, `updated_at`, `is_active`) VALUES (1, 1, '2025-05-25', '2025-08-25', '0000-00-00 00:00:00.000', '0000-00-00 00:00:00.000', 0);
INSERT INTO `periode` (`id`, `user_id`, `tanggal_pengajuan`, `tanggal_selesai`, `created_at`, `updated_at`, `is_active`) VALUES (2, 36, '2025-06-01', '2025-08-30', '2025-06-01 02:05:18.000', '2025-06-01 02:05:18.000', 1);
INSERT INTO `periode` (`id`, `user_id`, `tanggal_pengajuan`, `tanggal_selesai`, `created_at`, `updated_at`, `is_active`) VALUES (3, 36, '2025-06-01', '2025-08-30', '2025-06-01 02:34:50.000', '2025-06-01 02:34:50.000', 1);
INSERT INTO `periode` (`id`, `user_id`, `tanggal_pengajuan`, `tanggal_selesai`, `created_at`, `updated_at`, `is_active`) VALUES (4, 27, '2025-06-02', '2025-08-31', '2025-06-02 06:54:08.000', '2025-06-02 06:54:08.000', 1);
INSERT INTO `periode` (`id`, `user_id`, `tanggal_pengajuan`, `tanggal_selesai`, `created_at`, `updated_at`, `is_active`) VALUES (5, 53, '2025-06-11', '2025-09-09', '2025-06-11 15:31:50.000', '2025-06-11 15:31:50.000', 1);
INSERT INTO `periode` (`id`, `user_id`, `tanggal_pengajuan`, `tanggal_selesai`, `created_at`, `updated_at`, `is_active`) VALUES (11, 57, '2025-06-13', '2025-09-11', '2025-06-13 09:30:26.000', '2025-06-13 09:30:26.000', 1);
INSERT INTO `periode` (`id`, `user_id`, `tanggal_pengajuan`, `tanggal_selesai`, `created_at`, `updated_at`, `is_active`) VALUES (12, 62, '2025-06-24', '2025-09-22', '2025-06-24 04:07:57.000', '2025-06-24 04:07:57.000', 1);
COMMIT;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `date_permission` date NOT NULL,
  `reason` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_user_id_foreign` (`user_id`),
  CONSTRAINT `permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for permissions_email
-- ----------------------------
DROP TABLE IF EXISTS `permissions_email`;
CREATE TABLE `permissions_email` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `createdAt` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `updatedAt` datetime(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_key` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions_email
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for pinjam
-- ----------------------------
DROP TABLE IF EXISTS `pinjam`;
CREATE TABLE `pinjam` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_buku` bigint(20) unsigned NOT NULL,
  `id_user` bigint(20) unsigned NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `status_peminjaman` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pinjam_id_buku_foreign` (`id_buku`),
  KEY `pinjam_id_user_foreign` (`id_user`),
  CONSTRAINT `pinjam_id_buku_foreign` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pinjam_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pinjam
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for posisi
-- ----------------------------
DROP TABLE IF EXISTS `posisi`;
CREATE TABLE `posisi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `total_kuota` int(11) DEFAULT NULL,
  `kuota_tersedia` int(100) DEFAULT NULL,
  `persyaratan` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `status` enum('publish','unpublish') NOT NULL DEFAULT 'publish',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of posisi
-- ----------------------------
BEGIN;
INSERT INTO `posisi` (`id`, `nama`, `total_kuota`, `kuota_tersedia`, `persyaratan`, `deskripsi`, `is_active`, `status`, `created_at`, `updated_at`) VALUES (7, 'DevOps Engineer', 2, 1, 'w', 'w', 1, 'publish', '2025-05-22 18:56:55', '2025-05-31 02:14:06');
INSERT INTO `posisi` (`id`, `nama`, `total_kuota`, `kuota_tersedia`, `persyaratan`, `deskripsi`, `is_active`, `status`, `created_at`, `updated_at`) VALUES (8, 'UI/UX Designer ya test', 2, 1, 'dx', NULL, 1, 'unpublish', '2025-05-22 19:09:31', '2025-06-04 02:12:27');
INSERT INTO `posisi` (`id`, `nama`, `total_kuota`, `kuota_tersedia`, `persyaratan`, `deskripsi`, `is_active`, `status`, `created_at`, `updated_at`) VALUES (9, 'Backend Developer ss', 23, 12, 'sdasdsad', NULL, 1, 'publish', '2025-05-28 15:30:39', '2025-06-04 02:12:34');
INSERT INTO `posisi` (`id`, `nama`, `total_kuota`, `kuota_tersedia`, `persyaratan`, `deskripsi`, `is_active`, `status`, `created_at`, `updated_at`) VALUES (11, 'Frontend End', 12, 9, 'asdasd', NULL, 1, 'publish', '2025-05-29 04:24:23', '2025-06-24 05:07:06');
INSERT INTO `posisi` (`id`, `nama`, `total_kuota`, `kuota_tersedia`, `persyaratan`, `deskripsi`, `is_active`, `status`, `created_at`, `updated_at`) VALUES (12, 'FULL STACK TEST GANTI LAGI', 11, 3, 'asda', 'mengerjakan apa yang disuruh membuat aplikasi yang lebih bagus', 1, 'publish', '2025-05-29 04:24:53', '2025-06-24 03:29:40');
COMMIT;

-- ----------------------------
-- Table structure for project
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `pengajuan_id` int(11) DEFAULT NULL,
  `detail_id` int(11) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of project
-- ----------------------------
BEGIN;
INSERT INTO `project` (`id`, `user_id`, `pengajuan_id`, `detail_id`, `title`, `jenis`, `created_at`, `updated_at`) VALUES (1, 1, 1, 1, 'smart', NULL, '2025-05-22', NULL);
INSERT INTO `project` (`id`, `user_id`, `pengajuan_id`, `detail_id`, `title`, `jenis`, `created_at`, `updated_at`) VALUES (2, 36, 11, NULL, 'Sistem Magan', NULL, '2025-06-02', '2025-06-03');
INSERT INTO `project` (`id`, `user_id`, `pengajuan_id`, `detail_id`, `title`, `jenis`, `created_at`, `updated_at`) VALUES (3, 36, 11, NULL, 'Sistem Magang test', NULL, '2025-06-02', '2025-06-02');
INSERT INTO `project` (`id`, `user_id`, `pengajuan_id`, `detail_id`, `title`, `jenis`, `created_at`, `updated_at`) VALUES (4, 36, 11, NULL, 'Membuat antrian siswa', NULL, '2025-06-02', '2025-06-02');
INSERT INTO `project` (`id`, `user_id`, `pengajuan_id`, `detail_id`, `title`, `jenis`, `created_at`, `updated_at`) VALUES (5, 36, 11, NULL, 'membuat sistem klinik', NULL, '2025-06-03', '2025-06-03');
INSERT INTO `project` (`id`, `user_id`, `pengajuan_id`, `detail_id`, `title`, `jenis`, `created_at`, `updated_at`) VALUES (6, 53, 13, NULL, 'membuat crut', 'Side Project', '2025-06-11', '2025-06-11');
INSERT INTO `project` (`id`, `user_id`, `pengajuan_id`, `detail_id`, `title`, `jenis`, `created_at`, `updated_at`) VALUES (7, 53, 13, NULL, 'Membuat Halaman Login', 'Main Project', '2025-06-11', '2025-06-12');
INSERT INTO `project` (`id`, `user_id`, `pengajuan_id`, `detail_id`, `title`, `jenis`, `created_at`, `updated_at`) VALUES (8, 53, 13, NULL, 'sadasdsa', 'Main Project', '2025-06-11', '2025-06-11');
INSERT INTO `project` (`id`, `user_id`, `pengajuan_id`, `detail_id`, `title`, `jenis`, `created_at`, `updated_at`) VALUES (9, 53, 13, NULL, 'test project', 'Main Project', '2025-06-11', '2025-06-11');
INSERT INTO `project` (`id`, `user_id`, `pengajuan_id`, `detail_id`, `title`, `jenis`, `created_at`, `updated_at`) VALUES (10, 62, 20, NULL, 'membuat api', 'Main Project', '2025-06-24', '2025-06-24');
COMMIT;

-- ----------------------------
-- Table structure for queque_session
-- ----------------------------
DROP TABLE IF EXISTS `queque_session`;
CREATE TABLE `queque_session` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL,
  `date` date NOT NULL,
  `details_rent_playstation_id` int(11) NOT NULL,
  `note` varchar(255) NOT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of queque_session
-- ----------------------------
BEGIN;
INSERT INTO `queque_session` (`id`, `status`, `date`, `details_rent_playstation_id`, `note`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 0, '2025-03-15', 2, 'jaga kebersihan yaa, Orders on holidays will be subject to an additional charge of 30000', 23, NULL, NULL, '2025-03-15 18:59:20', '2025-03-15 18:59:20', NULL);
INSERT INTO `queque_session` (`id`, `status`, `date`, `details_rent_playstation_id`, `note`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 0, '2025-03-15', 1, 'warna hijau, Orders on holidays will be subject to an additional charge of 30000', 23, NULL, NULL, '2025-03-15 19:01:54', '2025-03-15 19:01:54', NULL);
COMMIT;

-- ----------------------------
-- Table structure for rent_session
-- ----------------------------
DROP TABLE IF EXISTS `rent_session`;
CREATE TABLE `rent_session` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name_session` varchar(255) NOT NULL,
  `start_session` varchar(255) NOT NULL,
  `end_session` varchar(255) NOT NULL,
  `masterps_id` int(11) NOT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of rent_session
-- ----------------------------
BEGIN;
INSERT INTO `rent_session` (`id`, `name_session`, `start_session`, `end_session`, `masterps_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 'Sesi 1', '10:00', '13:00', 1, 23, 23, NULL, '2025-03-15 07:26:06', '2025-03-15 07:57:14', NULL);
INSERT INTO `rent_session` (`id`, `name_session`, `start_session`, `end_session`, `masterps_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 'SESi 2', '12:00', '15:00', 1, 23, NULL, NULL, '2025-03-15 17:32:46', '2025-03-15 17:32:46', NULL);
INSERT INTO `rent_session` (`id`, `name_session`, `start_session`, `end_session`, `masterps_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 'Sesi 1 PS 5', '10:00', '13:00', 2, 23, NULL, NULL, '2025-03-15 18:15:18', '2025-03-15 18:15:18', NULL);
COMMIT;

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `id` int(11) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `createdAt` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `updatedAt` datetime(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_has_permissions_role_id_fkey` (`roles_id`),
  KEY `role_has_permissions_permission_id_fkey` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `createdAt` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `updatedAt` datetime(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_key` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` (`id`, `name`, `createdAt`, `updatedAt`) VALUES (1, 'admin', '2025-05-14 14:01:45.000', '0000-00-00 00:00:00.000');
INSERT INTO `roles` (`id`, `name`, `createdAt`, `updatedAt`) VALUES (2, 'hrd', '2025-05-14 14:02:07.000', '0000-00-00 00:00:00.000');
INSERT INTO `roles` (`id`, `name`, `createdAt`, `updatedAt`) VALUES (3, 'mentor', '2025-05-14 14:02:07.000', '0000-00-00 00:00:00.000');
INSERT INTO `roles` (`id`, `name`, `createdAt`, `updatedAt`) VALUES (4, 'user', '2025-05-14 14:02:58.000', '0000-00-00 00:00:00.000');
COMMIT;

-- ----------------------------
-- Table structure for sertifikat
-- ----------------------------
DROP TABLE IF EXISTS `sertifikat`;
CREATE TABLE `sertifikat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pengajuan_id` int(11) NOT NULL,
  `location` text NOT NULL,
  `created_at` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `updated_at` datetime(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sertifikat_mentee_pengajuan_id_key` (`pengajuan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of sertifikat
-- ----------------------------
BEGIN;
INSERT INTO `sertifikat` (`id`, `pengajuan_id`, `location`, `created_at`, `updated_at`) VALUES (18, 13, 'sertifikat/final_kanza_13.pdf', '2025-06-24 10:50:11.000', '2025-06-24 10:50:11.000');
COMMIT;

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of sessions
-- ----------------------------
BEGIN;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('rCe1lXxSM8pdF6Ehj8uYQznEetdTIk6BZUMP6OO9', 23, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM0tSZGRyaUdmVEx3VnZjQVl3N1VuZTY0RUQwNm1nS2JsdWZ1M0JObyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9maWxlP3BhZ2U9cHJvZmlsZS1waG90b3MlMkZDUlNpNEJ5c0s4cjE1WU14RVBGSkNCSElmR2ZpbndVUjVKMUs5cnRMLmpwZyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjIzO30=', 1750769933);
COMMIT;

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `key` varchar(191) NOT NULL,
  `value` text NOT NULL,
  `createdAt` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `updatedAt` datetime(3) NOT NULL,
  PRIMARY KEY (`key`),
  UNIQUE KEY `settings_key_key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of settings
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for soal_kemampuan
-- ----------------------------
DROP TABLE IF EXISTS `soal_kemampuan`;
CREATE TABLE `soal_kemampuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` text DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `soal` text DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of soal_kemampuan
-- ----------------------------
BEGIN;
INSERT INTO `soal_kemampuan` (`id`, `deskripsi`, `tanggal_mulai`, `tanggal_selesai`, `soal`, `updated_at`, `created_at`) VALUES (6, 'Tes kemampuan dasar ini dirancang untuk mengukur pemahaman Anda tentang logika dan pemecahan masalah sederhana. Anda akan diberikan serangkaian pertanyaan pilihan ganda yang harus dijawab dalam waktu yang ditentukan. Pastikan Anda membaca setiap pertanyaan dengan cermat sebelum memilih jawaban.', '2025-06-01', '2025-06-06', 'Studi Kasus: Perusahaan \"Tech Innovations\" sedang menghadapi tantangan dalam mengelola proyek-proyek pengembangan perangkat lunak mereka. Tim proyek seringkali mengalami keterlambatan dalam penyelesaian tugas, komunikasi yang kurang efektif antar anggota tim, dan kesulitan dalam melacak kemajuan proyek secara keseluruhan.\r\n\r\nSebagai seorang manajer proyek yang baru diangkat, Anda diminta untuk menganalisis situasi ini dan mengusulkan solusi konkret untuk meningkatkan efisiensi dan efektivitas manajemen proyek di Tech Innovations. Pertimbangkan aspek-aspek seperti metodologi pengembangan, alat kolaborasi, dan strategi komunikasi.\r\n\r\nPertanyaan:\r\n1. Metodologi pengembangan apa yang paling cocok untuk Tech Innovations, dan mengapa?\r\n2. Alat kolaborasi apa yang dapat direkomendasikan untuk meningkatkan komunikasi dan pelacakan proyek?\r\n3. Strategi komunikasi seperti apa yang harus diterapkan untuk mengatasi masalah antar anggota tim?', '2025-06-02 03:38:09', '2025-06-02 03:38:09');
INSERT INTO `soal_kemampuan` (`id`, `deskripsi`, `tanggal_mulai`, `tanggal_selesai`, `soal`, `updated_at`, `created_at`) VALUES (7, 'ini adalah test ya', '2025-06-11', '2025-06-11', 'asda asd asdsa', '2025-06-11 15:34:23', '2025-06-11 15:34:23');
INSERT INTO `soal_kemampuan` (`id`, `deskripsi`, `tanggal_mulai`, `tanggal_selesai`, `soal`, `updated_at`, `created_at`) VALUES (8, 'asdsadsadas', '2025-06-14', '2025-06-13', 'ssadasasdasd asdasd', '2025-06-14 03:54:46', '2025-06-14 03:54:46');
INSERT INTO `soal_kemampuan` (`id`, `deskripsi`, `tanggal_mulai`, `tanggal_selesai`, `soal`, `updated_at`, `created_at`) VALUES (9, 'asdadas', '2025-06-28', '2025-06-30', 'ascascas', '2025-06-24 04:22:20', '2025-06-24 04:22:20');
COMMIT;

-- ----------------------------
-- Table structure for storage
-- ----------------------------
DROP TABLE IF EXISTS `storage`;
CREATE TABLE `storage` (
  `name` varchar(191) NOT NULL,
  `location` text NOT NULL,
  UNIQUE KEY `storage_name_key` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of storage
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for template_sertifikat
-- ----------------------------
DROP TABLE IF EXISTS `template_sertifikat`;
CREATE TABLE `template_sertifikat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of template_sertifikat
-- ----------------------------
BEGIN;
INSERT INTO `template_sertifikat` (`id`, `file`, `created_at`, `updated_at`) VALUES (1, 'template/template-2025061109171060280.docx', '2025-06-11 09:17:10', '2025-06-11 09:17:10');
COMMIT;

-- ----------------------------
-- Table structure for testimoni
-- ----------------------------
DROP TABLE IF EXISTS `testimoni`;
CREATE TABLE `testimoni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `mentor_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `updated_at` datetime(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `testimonials_user_id_fkey` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of testimoni
-- ----------------------------
BEGIN;
INSERT INTO `testimoni` (`id`, `user_id`, `mentor_id`, `content`, `created_at`, `updated_at`) VALUES (1, 1, 1, 'saya sangat bangga', '2025-05-13 23:58:47.000', '0000-00-00 00:00:00.000');
INSERT INTO `testimoni` (`id`, `user_id`, `mentor_id`, `content`, `created_at`, `updated_at`) VALUES (3, 53, 9, 'magang disini sangat nyaman bagus sekali', '2025-06-12 06:27:33.000', '2025-06-12 06:27:33.000');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `posisi_id` int(11) DEFAULT NULL,
  `instansi_id` int(11) DEFAULT NULL,
  `jurusan_id` int(11) DEFAULT NULL,
  `roles_id` int(11) DEFAULT NULL,
  `role` enum('admin','hrd','mentor','user') NOT NULL,
  `mentor_id` int(11) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `nim` varchar(100) DEFAULT NULL,
  `religion` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `status` enum('proses','lulus','tes_kema...') DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `surat` varchar(100) DEFAULT NULL,
  `cv` varchar(191) DEFAULT NULL,
  `mulai_magang` date DEFAULT NULL,
  `selesai_magang` date DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `status_otp` enum('1','2') DEFAULT '1',
  `position` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `phone`, `posisi_id`, `instansi_id`, `jurusan_id`, `roles_id`, `role`, `mentor_id`, `image`, `nim`, `religion`, `is_active`, `status`, `gender`, `surat`, `cv`, `mulai_magang`, `selesai_magang`, `otp`, `status_otp`, `position`) VALUES (1, 'winda sari', 'winda@gmail.com', NULL, '$2y$12$t0z2Ya5Q5zKTZgAcxR9S0O3njtlJyiza/hRKkEolGxHKSoMNSM1mm', NULL, NULL, NULL, NULL, '2025-05-11 07:47:08', '2025-05-11 07:47:08', '083838654532', 1, 1, NULL, NULL, 'admin', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL);
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `phone`, `posisi_id`, `instansi_id`, `jurusan_id`, `roles_id`, `role`, `mentor_id`, `image`, `nim`, `religion`, `is_active`, `status`, `gender`, `surat`, `cv`, `mulai_magang`, `selesai_magang`, `otp`, `status_otp`, `position`) VALUES (2, 'wawan', 'wawan@gmail.com', '2025-05-21 13:53:42', '$2y$12$OPEmzolbc.ypoBJgUXEgEuyKbJIqPQMTHe1dUwUWCeMp/5bhZ5rI2', NULL, NULL, NULL, '2mvBDNCA6IsTJt19f6g5ZPScdnVYeoT5X1IZ9xTMKlkRakxPkLXb5YZZOhqr', '2025-05-21 13:53:42', '2025-06-14 04:52:22', '123456789', 1, 1, 1, 1, 'admin', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL);
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `phone`, `posisi_id`, `instansi_id`, `jurusan_id`, `roles_id`, `role`, `mentor_id`, `image`, `nim`, `religion`, `is_active`, `status`, `gender`, `surat`, `cv`, `mulai_magang`, `selesai_magang`, `otp`, `status_otp`, `position`) VALUES (23, 'iwan mardiansyah wawan', 'iwan@gmail.com', NULL, '$2y$12$y.PXtKT41cIEnF4Q.fXfpeLdIKm7LU.tyNAr1U50rWEUTX07Sb1LS', NULL, NULL, NULL, NULL, NULL, '2025-06-12 09:02:27', NULL, NULL, NULL, NULL, NULL, 'admin', NULL, 'profile-photos/CRSi4BysK8r15YMxEPFJCBHIfGfinwUR5J1K9rtL.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'Administrator');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `phone`, `posisi_id`, `instansi_id`, `jurusan_id`, `roles_id`, `role`, `mentor_id`, `image`, `nim`, `religion`, `is_active`, `status`, `gender`, `surat`, `cv`, `mulai_magang`, `selesai_magang`, `otp`, `status_otp`, `position`) VALUES (26, 'asas', 'iwanwawan@gmail.com', NULL, '$2y$12$6671WE.usFO8ZMcaHpNyG.ezKFZ74LFbhm61v.mxQvngCw7RT1hPq', NULL, NULL, NULL, NULL, '2025-05-29 06:29:04', '2025-05-29 06:29:04', NULL, NULL, NULL, NULL, NULL, 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL);
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `phone`, `posisi_id`, `instansi_id`, `jurusan_id`, `roles_id`, `role`, `mentor_id`, `image`, `nim`, `religion`, `is_active`, `status`, `gender`, `surat`, `cv`, `mulai_magang`, `selesai_magang`, `otp`, `status_otp`, `position`) VALUES (27, 'iwan1', 'iwanwawan1@gmail.com', NULL, '$2y$12$x6Iq5fCvmg9GlX5pXyIQXu1rs70XkYuO29ximOBSXeL06XZVYzQdC', NULL, NULL, NULL, NULL, '2025-05-29 06:31:26', '2025-06-11 03:03:09', '3231321321', 9, 1, 1, NULL, 'user', 9, 'photo/2025060206535940477.webp', '383939', 'Islam', NULL, NULL, 'Laki-laki', NULL, NULL, '2025-06-01', '2025-06-30', NULL, '1', NULL);
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `phone`, `posisi_id`, `instansi_id`, `jurusan_id`, `roles_id`, `role`, `mentor_id`, `image`, `nim`, `religion`, `is_active`, `status`, `gender`, `surat`, `cv`, `mulai_magang`, `selesai_magang`, `otp`, `status_otp`, `position`) VALUES (36, 'Winda User', 'windauser@gmail.com', NULL, '$2y$12$3h6mpv2ruFssGcdKto904ubrbdSptlUMvYhko5Ygbv2k6ka4J8wzu', NULL, NULL, NULL, NULL, '2025-05-29 07:49:02', '2025-06-01 02:34:50', '2826383', 11, 2, 2, NULL, 'user', 9, 'photo/2025053102455820189.webp', '8373838', 'Islam', NULL, NULL, 'Laki-laki', 'surat/surat-2025053102510314070.pdf', 'cv/cv-2025053102510324357.pdf', '2025-02-01', '2025-03-31', NULL, '1', NULL);
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `phone`, `posisi_id`, `instansi_id`, `jurusan_id`, `roles_id`, `role`, `mentor_id`, `image`, `nim`, `religion`, `is_active`, `status`, `gender`, `surat`, `cv`, `mulai_magang`, `selesai_magang`, `otp`, `status_otp`, `position`) VALUES (44, 'Winda Mentor', 'windamentor@gmail.com', NULL, '$2y$12$wwzOtiPZrG0mLfGRxEjmbOEsJu.xGNEIxK7KN2jVZNd4HItmFS7ZK', NULL, NULL, NULL, NULL, '2025-05-30 16:47:31', '2025-06-12 08:46:31', NULL, NULL, NULL, NULL, NULL, 'mentor', 9, 'profile-photos/UHWiXJlQ7iaMxJSGBKL4voyoNqwe2JoBuRhmJiqV.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'Programmer');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `phone`, `posisi_id`, `instansi_id`, `jurusan_id`, `roles_id`, `role`, `mentor_id`, `image`, `nim`, `religion`, `is_active`, `status`, `gender`, `surat`, `cv`, `mulai_magang`, `selesai_magang`, `otp`, `status_otp`, `position`) VALUES (50, 'Winda Hrd', 'windahrd@gmail.com', NULL, '$2y$12$dKABcNxZSewuzqQDV2EyBeycrm.nu9tjuFVCfXnjQqWmPFl.QUWSC', NULL, NULL, NULL, NULL, '2025-05-30 17:37:54', '2025-06-12 08:48:56', NULL, NULL, NULL, NULL, NULL, 'hrd', NULL, 'profile-photos/35j8wOiWXZI3r2E7WpRudEE4RctuVfNG3xfWE7eA.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'programmer');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `phone`, `posisi_id`, `instansi_id`, `jurusan_id`, `roles_id`, `role`, `mentor_id`, `image`, `nim`, `religion`, `is_active`, `status`, `gender`, `surat`, `cv`, `mulai_magang`, `selesai_magang`, `otp`, `status_otp`, `position`) VALUES (53, 'kanza', 'kanza@gmail.com', NULL, '$2y$12$pqyrMmp/jcPiJt5KI5gsA.mMoANtctSYy0clE41JgS136pPeyJolq', NULL, NULL, NULL, 'zSoBfeQd9a0i7uBE857Dqkme79lTvNGSedO2XJrkRb4ZOauFGjv55xDuVq8J', '2025-06-03 05:17:50', '2025-06-24 12:54:01', '082385603528', 11, 2, 2, NULL, 'user', 9, 'photo/2025060305470416278.webp', '8337399', 'Katolik', NULL, NULL, 'Laki-laki', 'surat/surat-2025062412540167890.pdf', 'cv/cv-2025062412540176496.pdf', '2025-06-24', '2025-06-30', 511567, '2', NULL);
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `phone`, `posisi_id`, `instansi_id`, `jurusan_id`, `roles_id`, `role`, `mentor_id`, `image`, `nim`, `religion`, `is_active`, `status`, `gender`, `surat`, `cv`, `mulai_magang`, `selesai_magang`, `otp`, `status_otp`, `position`) VALUES (54, 'Endru Phoenix', 'endru@gmail.com', NULL, '$2y$12$SRLX7/ypPrhg.9bxN0BLBeIZMFEWBaRD0AGvkMr0KMI/wrSjG97B2', NULL, NULL, NULL, NULL, '2025-06-10 14:55:54', '2025-06-10 14:55:54', NULL, NULL, NULL, NULL, NULL, 'mentor', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL);
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `phone`, `posisi_id`, `instansi_id`, `jurusan_id`, `roles_id`, `role`, `mentor_id`, `image`, `nim`, `religion`, `is_active`, `status`, `gender`, `surat`, `cv`, `mulai_magang`, `selesai_magang`, `otp`, `status_otp`, `position`) VALUES (55, 'PENTOR', 'pnetor@gmail.com', NULL, '$2y$12$t4RCth.pGvX20LCeYljdZ.B9hKJtZPqmxdg2MneFDOyGaOabnS5mu', NULL, NULL, NULL, NULL, '2025-06-11 03:00:46', '2025-06-11 03:00:46', NULL, NULL, NULL, NULL, NULL, 'mentor', 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL);
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `phone`, `posisi_id`, `instansi_id`, `jurusan_id`, `roles_id`, `role`, `mentor_id`, `image`, `nim`, `religion`, `is_active`, `status`, `gender`, `surat`, `cv`, `mulai_magang`, `selesai_magang`, `otp`, `status_otp`, `position`) VALUES (56, 'assa', 'mentoro@gmail.com', NULL, '$2y$12$uSCTwnC1z5n670DrUN9mtuWlbKu/yBkUQnLe/FzN4xr606LUdkLV2', NULL, NULL, NULL, NULL, '2025-06-11 03:01:47', '2025-06-11 03:01:47', NULL, NULL, NULL, NULL, NULL, 'mentor', 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL);
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `phone`, `posisi_id`, `instansi_id`, `jurusan_id`, `roles_id`, `role`, `mentor_id`, `image`, `nim`, `religion`, `is_active`, `status`, `gender`, `surat`, `cv`, `mulai_magang`, `selesai_magang`, `otp`, `status_otp`, `position`) VALUES (57, 'Dedi Andika', 'dediandika@gmail.com', NULL, '$2y$12$QDRVKwUrvBiJwUKaDipe9.LSwFR92dAH/rJMs26f3klwAWBHwMBii', NULL, NULL, NULL, NULL, '2025-06-13 09:21:00', '2025-06-13 09:30:26', '082385603528', 11, 1, 1, NULL, 'user', NULL, 'photo/2025061309214893142.webp', '8337399', 'Islam', NULL, NULL, 'Laki-laki', NULL, NULL, '2025-06-01', '2025-06-30', 894613, '2', NULL);
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `phone`, `posisi_id`, `instansi_id`, `jurusan_id`, `roles_id`, `role`, `mentor_id`, `image`, `nim`, `religion`, `is_active`, `status`, `gender`, `surat`, `cv`, `mulai_magang`, `selesai_magang`, `otp`, `status_otp`, `position`) VALUES (58, 'Endru Phoenix', 'endru1@gmail.com', NULL, '$2y$12$Xn73hMDvOslAROB2mxwCWeS.apzUbXePs411rSTyvkdBgL3NMP/zy', NULL, NULL, NULL, NULL, '2025-06-18 13:34:03', '2025-06-18 13:34:03', NULL, NULL, NULL, NULL, NULL, 'mentor', 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL);
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `phone`, `posisi_id`, `instansi_id`, `jurusan_id`, `roles_id`, `role`, `mentor_id`, `image`, `nim`, `religion`, `is_active`, `status`, `gender`, `surat`, `cv`, `mulai_magang`, `selesai_magang`, `otp`, `status_otp`, `position`) VALUES (59, 'Endru Phoenix3', 'endru2@gmail.com', NULL, '$2y$12$hQNKyCmirFP63Qm044tJYuvTLrm3XwmrvJ5BQXxPIBRD6bZsoZmvK', NULL, NULL, NULL, NULL, '2025-06-18 13:37:52', '2025-06-18 13:37:52', NULL, NULL, NULL, NULL, NULL, 'mentor', 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL);
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `phone`, `posisi_id`, `instansi_id`, `jurusan_id`, `roles_id`, `role`, `mentor_id`, `image`, `nim`, `religion`, `is_active`, `status`, `gender`, `surat`, `cv`, `mulai_magang`, `selesai_magang`, `otp`, `status_otp`, `position`) VALUES (60, 'heru mentor', 'herumentor@gmail.com', NULL, '$2y$12$ezBGSVgCUlZXVUgUweR.xuy3RS2kJW6gCdeLp4GQYET4SyQkCv9Q.', NULL, NULL, NULL, NULL, '2025-06-24 03:32:08', '2025-06-24 03:32:08', NULL, NULL, NULL, NULL, NULL, 'mentor', 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL);
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `phone`, `posisi_id`, `instansi_id`, `jurusan_id`, `roles_id`, `role`, `mentor_id`, `image`, `nim`, `religion`, `is_active`, `status`, `gender`, `surat`, `cv`, `mulai_magang`, `selesai_magang`, `otp`, `status_otp`, `position`) VALUES (61, 'herumentori', 'herumentori@gmail.com', NULL, '$2y$12$8LRquERNda1ukE1eUQofd.qfK88/TbCwkwYZk2hkWBKwfFUUvlL1O', NULL, NULL, NULL, NULL, '2025-06-24 03:42:55', '2025-06-24 03:42:55', NULL, NULL, NULL, NULL, NULL, 'mentor', 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'DESAIN GRAFIK');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `phone`, `posisi_id`, `instansi_id`, `jurusan_id`, `roles_id`, `role`, `mentor_id`, `image`, `nim`, `religion`, `is_active`, `status`, `gender`, `surat`, `cv`, `mulai_magang`, `selesai_magang`, `otp`, `status_otp`, `position`) VALUES (62, 'Heru Pranata', 'herupranata8@gmail.com', NULL, '$2y$12$zEMVuTInvkfpZeX/bBu6L.aoyZKxL5OaSTOrFouM2G2/LBrnzBZ.G', NULL, NULL, NULL, NULL, '2025-06-24 03:56:19', '2025-06-24 04:27:25', '082385603528', 11, 3, 2, NULL, 'user', 9, NULL, '0383738', 'Kristen', NULL, NULL, 'Perempuan', 'surat/surat-2025062403581419779.pdf', 'cv/cv-2025062403581461980.pdf', '2025-06-24', '2025-07-24', 692372, '2', NULL);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
