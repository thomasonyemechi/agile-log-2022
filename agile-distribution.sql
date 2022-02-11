-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2022 at 08:55 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agile-distribution`
--

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `freight_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `pieces` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_del` int(11) NOT NULL DEFAULT 0,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`id`, `freight_id`, `driver_id`, `pieces`, `status`, `message`, `date_del`, `created_by`, `created_at`, `updated_at`) VALUES
(3, 2, 3, 1, 0, '[{\"message\":\"what s uop\",\"time\":1638345895},{\"message\":\"helloe oeeos\",\"time\":1638346002},{\"message\":\"freight is almost there\",\"time\":1638346023}]', 0, '1', '2021-11-24 07:48:44', '2021-12-01 07:07:03'),
(4, 1, 4, 1, 0, NULL, 0, '1', '2021-11-24 07:49:16', '2021-11-24 07:49:16'),
(5, 1, 3, 1, 1, NULL, 0, '1', '2021-11-24 07:49:24', '2021-11-24 07:49:24'),
(6, 4, 5, 1, 0, NULL, 0, '1', '2021-12-04 12:51:03', '2021-12-04 12:51:03');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `freights`
--

CREATE TABLE `freights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `manifest_id` int(11) NOT NULL,
  `bill_number` bigint(20) NOT NULL,
  `consignee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consignee_email` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consignee_phone` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consignee_address` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipper` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pieces` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pieces_in` int(11) NOT NULL DEFAULT 0,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `byd_split` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `protective_service` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `approved_by` int(11) NOT NULL DEFAULT 0,
  `assigned_to` int(11) NOT NULL DEFAULT 0,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `need_appointment` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `freights`
--

INSERT INTO `freights` (`id`, `manifest_id`, `bill_number`, `consignee`, `consignee_email`, `consignee_phone`, `consignee_address`, `shipper`, `destination`, `pieces`, `pieces_in`, `weight`, `date`, `byd_split`, `protective_service`, `due_date`, `created_by`, `approved_by`, `assigned_to`, `message`, `status`, `need_appointment`, `created_at`, `updated_at`) VALUES
(1, 1, 506212182, 'LUMSON AMS LOGISTICS', 'thomasonyemechi03@gmail.com', '1832772343', 'LUMSON AMS LOGISTICS', 'ROADRUNNER - DLS', 'MORRISTOWN', '2', 0, '700', '2021-11-09', '360.85', NULL, '2021-11-27', 1, 0, 1, NULL, 3, 0, '2021-11-23 06:11:23', '2021-11-24 07:49:24'),
(2, 1, 509999355, 'RGM DIST/DECOR', 'thomasonyemechi03@gmail.com', '1832772343', 'LUMSON AMS LOGISTICS', 'ROADRUNNER - ATL', 'CARTERET', '1', 0, '155', '2021-11-11', '55.00', NULL, '2021-11-25', 1, 0, 0, NULL, 2, 0, '2021-11-23 07:13:05', '2021-11-27 04:18:53'),
(3, 1, 121212, 'LUMSON AMS LOGISTICS', 'thomasonyemechi03@gmail.com', '1832772343', 'LUMSON AMS LOGISTICS', 'ROADRUNNER - DLS', 'MORRISTOWN', '12', 0, '126', '2021-12-03', '360.85', 'mooo', '2021-11-26', 1, 0, 0, NULL, 2, 0, '2021-11-26 12:10:21', '2021-11-27 05:08:42'),
(4, 1, 949494, 'RGM DIST/DECOR', 'thomasonyemechi03@gmail.com', '1832772343', 'LUMSON AMS LOGISTICS', 'ROADRUNNER - ATL', 'MORRISTOWN', '23', 0, '700', '2021-11-29', '740', 'mooo', '2021-12-04', 1, 0, 1, NULL, 3, 0, '2021-11-27 16:06:41', '2021-12-04 12:51:03'),
(5, 1, 949494, 'RGM DIST/DECOR', 'me@gmail.com', '91292929912', 'addd', 'ROADRUNNER - DLS', 'MORRISTOWN', '23', 0, '126', '2021-12-09', '360.85', NULL, '2021-12-25', 1, 0, 1, NULL, 0, 1, '2021-12-04 13:12:23', '2021-12-04 13:12:23'),
(6, 1, 94949433333, 'RGM DIST/DECOR 99', 'me@gmail.com99', '9129292991299', 'addd99', 'ROADRUNNER - DLS99', 'MORRISTOWN99', '2399', 0, '12699', '2021-12-31', '360.8599', '99', '2022-01-05', 1, 0, 3, '[{\"message\":\"Hello WOerld\",\"time\":1638807202},{\"message\":\"heloooooooooooooooo\",\"time\":1638807597},{\"message\":\"refuesd\",\"time\":1638864480}]', 6, 1, '2021-12-04 13:12:46', '2021-12-07 07:08:00'),
(7, 3, 8823574552, 'Dantata', 'Dantata@agile.com', '1236463', 'new jerssey', 'ROADRUNNER', 'peru city', '10', 0, '700', '2022-01-05', '10000', NULL, '2022-01-15', 1, 0, 3, '[{\"message\":\"This package was refused.....\",\"time\":1641379790},{\"message\":\"I retried and the package was accepted .......\",\"time\":1641379820}]', 5, 0, '2022-01-05 09:43:45', '2022-01-05 09:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `freight_approvals`
--

CREATE TABLE `freight_approvals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `freight_id` int(11) NOT NULL,
  `pieces` int(11) NOT NULL,
  `photos` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `freight_approvals`
--

INSERT INTO `freight_approvals` (`id`, `freight_id`, `pieces`, `photos`, `message`, `approved_by`, `created_at`, `updated_at`) VALUES
(1, 3, 9, NULL, 'no message', 1, '2021-11-27 05:08:42', '2021-11-27 05:08:42'),
(2, 3, 2, NULL, NULL, 1, '2021-11-27 05:20:09', '2021-11-27 05:20:09'),
(3, 4, 12, '[\"70295071638049738.png\",\"68676861638049738.png\",\"91868391638049738.png\"]', 'hello oooo', 1, '2021-11-27 20:48:58', '2021-11-27 20:48:58'),
(4, 4, 1, '[\"23723311638519360.jpg\",\"14460261638519360.jpg\",\"82043821638519360.jpg\",\"28297231638519360.jpg\"]', 'hello', 1, '2021-12-03 07:16:01', '2021-12-03 07:16:01'),
(5, 4, 4, '[\"1182651638520142.png\",\"89734411638520142.png\",\"4255451638520142.png\",\"40803521638520142.png\",\"8966921638520142.png\",\"46882291638520142.png\",\"14956581638520142.png\",\"61191461638520142.png\",\"89407401638520142.png\",\"71744571638520142.png\"]', NULL, 1, '2021-12-03 07:29:02', '2021-12-03 07:29:02'),
(6, 4, 4, '[\"80848711638520143.png\",\"51467421638520143.png\",\"9573721638520143.png\",\"83890961638520143.png\",\"15038461638520143.png\",\"32267671638520143.png\",\"56060891638520143.png\",\"16700741638520143.png\",\"89123611638520143.png\",\"83992781638520143.png\"]', NULL, 1, '2021-12-03 07:29:03', '2021-12-03 07:29:03'),
(7, 6, 2, NULL, 'One', 1, '2021-12-06 13:55:02', '2021-12-06 13:55:02'),
(8, 6, 9, '[\"60811461638802702.jpg\",\"6877161638802702.jpg\",\"77830501638802702.jpg\"]', 'commi ng', 1, '2021-12-06 13:58:22', '2021-12-06 13:58:22'),
(9, 7, 3, '[\"67923291641379521.jpg\",\"49306181641379521.jpg\",\"13054001641379521.jpg\"]', 'comming in', 1, '2022-01-05 09:45:21', '2022-01-05 09:45:21'),
(10, 7, 6, '[\"31643231641379554.jpg\"]', 'plus six', 1, '2022-01-05 09:45:54', '2022-01-05 09:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `manifests`
--

CREATE TABLE `manifests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `org_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manifest_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tractor_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trailer_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trailer_seal_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `plac` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manifests`
--

INSERT INTO `manifests` (`id`, `org_id`, `manifest_number`, `driver`, `owner`, `tractor_no`, `trailer_no`, `trailer_seal_no`, `created_by`, `plac`, `created_at`, `updated_at`) VALUES
(1, '1', '40040111', '11652 driver, EDGAR 12', '11652 ownerBOTELLO 14', 'W2893011', 'W28930 22', 'UL-8154853 o0', 0, 20, '2021-11-21 13:00:37', '2021-12-06 13:05:00'),
(2, '3', '80891321', 'Dudu Maner', 'Gideon', 'W289930', 'W28930', 'UL-8154853', 1, 24, '2021-11-27 15:54:04', '2021-11-27 15:54:04'),
(3, '1', '8089899', 'Dudu Maner', 'Gideon', 'W2893011', 'W28930 22', 'UL-8154853 o0', 1, 10, '2022-01-05 09:41:37', '2022-01-05 09:41:37');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_10_13_114434_create_sessions_table', 1),
(7, '2021_11_20_232455_create_oranizations_table', 2),
(8, '2021_11_21_010728_create_manifests_table', 3),
(9, '2021_11_22_214650_create_freights_table', 4),
(10, '2021_11_23_073451_create_deliveries_table', 5),
(11, '2021_11_27_040619_create_freight_approvals_table', 6),
(12, '2021_11_29_053202_create_permissions_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'logo.png',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `slug`, `name`, `logo`, `email`, `phone`, `address`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(1, '6725road-runner', 'Road Runner', '3617road-runner-007.png', 'runner@gmail.com', '09038772366', 'new hressy', 1, '2021-11-20 23:13:32', '2021-11-21 13:28:07', 1),
(3, '1114amazon', 'Amazon', 'Amazon.png', 'amazon@agile.com', '09038772366', 'new land usa', 1, '2021-11-27 15:25:37', '2021-11-27 15:25:37', 1),
(4, '9944fedex', 'FEDEX', 'FEDEX.png', 'fedex@agile.com', '08067544387', 'lan mary new toork city', 1, '2021-11-27 15:26:22', '2021-11-27 15:26:22', 1),
(5, '9760aliexpress', 'AliExpress', 'AliExpress.png', 'ali@agile.com', '08067544387', 'usa usa nugeria usa', 1, '2021-11-27 15:27:55', '2021-11-27 15:27:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `dock` int(11) NOT NULL DEFAULT 0,
  `admin` int(11) NOT NULL DEFAULT 0,
  `super` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `user_id`, `dock`, `admin`, `super`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '2021-11-30 03:12:25', '2021-11-30 03:12:25'),
(2, 2, 1, 1, 0, '2021-11-30 03:12:26', '2021-11-30 03:12:26'),
(3, 3, 0, 0, 0, '2021-11-30 03:12:26', '2021-11-30 03:12:26'),
(4, 4, 0, 0, 0, '2021-11-30 03:12:26', '2021-11-30 03:12:26'),
(5, 5, 0, 0, 0, '2021-11-30 03:12:26', '2021-11-30 03:12:26'),
(6, 6, 0, 0, 0, '2021-11-30 03:12:26', '2021-11-30 03:12:26'),
(7, 7, 0, 0, 0, '2021-12-06 17:53:33', '2021-12-06 17:53:33'),
(8, 8, 0, 1, 0, '2021-12-06 17:56:23', '2021-12-06 17:56:23'),
(9, 9, 0, 0, 0, '2021-12-06 18:08:30', '2021-12-06 18:08:30'),
(10, 10, 0, 0, 0, '2021-12-06 18:10:18', '2021-12-06 18:10:18'),
(11, 11, 0, 0, 0, '2021-12-07 04:51:49', '2021-12-07 04:51:49');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6LL4HSC0JfrbKv9uQUJzys1ZKz472eiK3ke0wExC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoibHBONUlXOWh0MFdWYUlHVXlQeDRLYnZXRXNKb1JRWWVpWGN5ZlJETyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1643612669),
('DyDaLpTDzZ1Y2gqmA7I3oTnaPsqeFZUDCQToxAOw', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiZkJNTDlGZkdQUHBGV213ZHhsdTlndjZTaEg1ZENPd0puRzlsN1FZWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwL2NvbnRyb2wvZHJpdmVyL2FkZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwL2NvbnRyb2wiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkSE1JLldqM1RZNldoWkw3OWlRZHplLjhNWHRZS295VDhVQlpqTjRNb21tS2RwMk45aXR0N2UiO30=', 1643624831),
('q62enwesrFSBxXG1Nk9H3S91LjraXXymKlqeltJj', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiSDVNc2pIalFtSWlUSWZIQlB6QjNIMzI2c0s2SnQ3S1N4YkZCa0ZYRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwL2NvbnRyb2wvZnJlaWdodC9hcHByb3ZhbC83Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyODoiaHR0cDovLzEyNy4wLjAuMTo4MDAvY29udHJvbCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCRITUkuV2ozVFk2V2haTDc5aVFkemUuOE1YdFlLb3lUOFVCWmpONE1vbW1LZHAyTjlpdHQ3ZSI7fQ==', 1643565995);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `added_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `phone`, `img`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `status`, `added_by`) VALUES
(1, 5, 'agile admin', 'admin@agile.com', NULL, 'user.png', NULL, '$2y$10$HMI.Wj3TY6WhZL79iQdze.8MXtYKoyT8UBZjN4MommKdp2N9itt7e', NULL, NULL, NULL, NULL, NULL, NULL, '2021-11-20 22:15:59', 1, 0),
(2, 3, 'agile staff one', 'thomasonyemechi03@gmail.com', NULL, 'user.png', NULL, '$2y$10$HMI.Wj3TY6WhZL79iQdze.8MXtYKoyT8UBZjN4MommKdp2N9itt7e', NULL, NULL, NULL, NULL, NULL, '2021-11-20 20:33:02', '2021-11-20 20:33:02', 1, 1),
(3, 1, 'agile driver one', 'driverone@agile.com', NULL, 'user.png', NULL, '$2y$10$HMI.Wj3TY6WhZL79iQdze.8MXtYKoyT8UBZjN4MommKdp2N9itt7e', NULL, NULL, NULL, NULL, NULL, '2021-11-24 07:04:49', '2021-11-24 07:04:58', 1, 0),
(4, 1, 'some driver', 'driversome@agile.com', NULL, 'user.png', NULL, '$2y$10$FpGwtCrVGO9bWL8WpQ8RM.nyGM84VI1ErgfQIrwkWj9bv/6jffOtu', NULL, NULL, NULL, NULL, NULL, '2021-11-24 07:05:33', '2021-11-24 07:12:41', 1, 0),
(5, 1, 'Driver Another', 'driveranother@agile.com', NULL, 'user.png', NULL, '$2y$10$L2GvVGf7r1uPJD3WmKre1OE.76HU7/e9//ZXoE7cje0.rmbZ2sU1.', NULL, NULL, NULL, NULL, NULL, '2021-11-24 15:01:36', '2021-11-24 15:01:43', 1, 0),
(10, 1, 'Nimi Braidded', 'braid@gail.com', '1234', 'user.png', NULL, '$2y$10$VPvybP2herfzODe9blGmP.j/EQDqYMpTkn731i97a6RDyJPxaTQAi', NULL, NULL, NULL, NULL, NULL, '2021-12-06 18:10:18', '2021-12-06 18:10:18', 1, 0),
(11, 1, 'agile staff ten', 'aladesuyititilayomi@yahoo.com', '1234', 'user.png', NULL, '$2y$10$.L7xSZ8u5We3uSwrF7n9oOaoAHgyI3ZEEBgiV8vW.DFOeC/a40dOu', NULL, NULL, '5oO4jAQEP9yHYVoYi8zhjtrHT5lF1tSPE60mbi3x19cdv8QsHC0KJ0c68PFe', NULL, NULL, '2021-12-07 04:51:49', '2021-12-21 16:00:06', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `freights`
--
ALTER TABLE `freights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `freight_approvals`
--
ALTER TABLE `freight_approvals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manifests`
--
ALTER TABLE `manifests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `freights`
--
ALTER TABLE `freights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `freight_approvals`
--
ALTER TABLE `freight_approvals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `manifests`
--
ALTER TABLE `manifests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
