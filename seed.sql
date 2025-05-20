-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2025 at 07:05 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seed`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_path` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_selected` tinyint(1) NOT NULL DEFAULT '0',
  `notes` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `address`, `phone`, `instagram`, `logo_path`, `is_selected`, `notes`) VALUES
(1, 'PT FL MANDIRI SEJAHTRA', 'JALAN MONGISIDI 2, KELURAHAN BONTO SUNGGU, KEC. BISSAPPU, KABUPATEN BANTAENG, SULAWESI SELATAN 92451', '+6282193244214', NULL, NULL, 1, NULL),
(2, 'CV. Dian Latippa', 'JALAN MONGISIDI 2, KELURAHAN BONTO SUNGGU, KEC. BISSAPPU, KABUPATEN BANTAENG, SULAWESI SELATAN 92451', '+6282193244214', NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_orders`
--

CREATE TABLE `detail_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `expense_type_id` bigint UNSIGNED NOT NULL,
  `nominal` bigint DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED NOT NULL,
  `updated_by` bigint UNSIGNED NOT NULL,
  `deleted_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_types`
--

CREATE TABLE `expense_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_types`
--

INSERT INTO `expense_types` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Listrik', '2025-05-17 06:27:50', '2025-05-17 06:27:50', NULL),
(2, 'Air', '2025-05-17 06:27:50', '2025-05-17 06:27:50', NULL),
(3, 'Gaji', '2025-05-17 06:27:50', '2025-05-17 06:27:50', NULL),
(4, 'Uang makan', '2025-05-17 06:27:50', '2025-05-17 06:27:50', NULL),
(5, 'Lain-Lain', '2025-05-17 06:27:50', '2025-05-17 06:27:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` bigint UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(35, '2014_10_12_000000_create_users_table', 1),
(36, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(37, '2019_08_19_000000_create_failed_jobs_table', 1),
(38, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(39, '2023_08_19_123432_create_product_categories_table', 1),
(40, '2023_08_19_123836_create_products_table', 1),
(41, '2023_08_19_183033_create_companies_table', 1),
(42, '2023_08_22_164935_create_guests_table', 1),
(43, '2023_08_25_161824_create_partnerships_table', 1),
(44, '2023_08_26_005918_create_payment_methods_table', 1),
(45, '2023_08_26_022437_create_sale_statuses_table', 1),
(46, '2023_08_27_064718_create_sales_table', 1),
(47, '2023_08_28_172728_create_sale_details_table', 1),
(48, '2023_09_06_023108_create_expense_types_table', 1),
(49, '2023_09_06_023118_create_expenses_table', 1),
(50, '2023_09_11_090544_add_column_is_visible_to_product_categories', 1),
(51, '2023_09_12_134409_create_stock_views_table', 1),
(52, '2025_05_19_070703_add_payment_method_id_to_sales_table', 2),
(53, '2025_05_19_071525_add_name_to_partnerships_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `partnerships`
--

CREATE TABLE `partnerships` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_address` text COLLATE utf8mb4_unicode_ci,
  `social_media` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partnerships`
--

INSERT INTO `partnerships` (`id`, `type`, `full_name`, `phone`, `business_name`, `business_address`, `social_media`, `notes`, `created_at`, `updated_at`, `deleted_at`, `name`) VALUES
(1, 'CUSTOMER', 'PT. Java Cosmic', '082235561933', 'Advertising', 'Jl. Jojoran 1', NULL, 'Pesan 10kg ayam', '2025-05-18 23:21:30', '2025-05-18 23:21:30', NULL, NULL),
(2, 'CUSTOMER', 'PT. Bintang Karya Sentosa', '082235561933', 'Media', 'Jl. Raya BSD', NULL, NULL, '2025-05-20 11:15:26', '2025-05-20 11:15:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'CASH', 'Tunai', '2025-05-17 06:27:50', '2025-05-17 06:27:50'),
(2, 'TRANSFER', 'Transfer', '2025-05-17 06:27:50', '2025-05-17 06:27:50'),
(3, 'DEBIT/CREDIT', 'Debit/Kredit', '2025-05-17 06:27:50', '2025-05-17 06:27:50');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `product_category_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` bigint DEFAULT NULL,
  `price` bigint DEFAULT NULL,
  `unit` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '0',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_category_id`, `name`, `slug`, `description`, `image`, `stock`, `price`, `unit`, `is_visible`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 'AYAM FILLET SEGAR', 'ayam-fillet-segar-IvFw2', NULL, 'public/product/615-062643656846.jpg', 50, 35000, 'Kg', 0, NULL, '2025-05-18 23:26:44', '2025-05-18 23:30:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `slug`, `description`, `image`, `is_visible`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'AYAM SIAP PANEN PREMIUM', 'ayam-siap-panen-premium', 'Daging berkualitas tinggi dengan rasio daging dan lemak yang seimbang.Diproses dengan cermat untuk memastikan kebersihan dan keamanan pangan.', NULL, 0, '2025-05-17 06:27:50', '2025-05-17 06:27:50', NULL),
(2, 'AYAM FILLET SEGAR', 'ayam-fillet-segar', 'Potongan fillet dada dan paha ayam, tanpa tulang.Ideal untuk hidangan yang membutuhkan daging tanpa tulang berkualitas tinggi.Dikemas secara higienis untuk menjaga kebersihan dan kesegaran.', NULL, 0, '2025-05-17 06:27:50', '2025-05-17 06:27:50', NULL),
(3, 'AYAM POTONG KECIL', 'ayam-potong-kecil', 'Potongan ayam dengan berat lebih rendah, cocok untuk hidangan porsi individu.Tetap menyajikan kualitas dan cita rasa yang luar biasa.', NULL, 0, '2025-05-17 06:27:50', '2025-05-17 06:27:50', NULL),
(4, 'PRODUK SPESIAL PESANAN', 'produk-spesial-pesanan', 'Menyediakan layanan khusus untuk kebutuhan spesifik pelanggan.Pengolahan sesuai dengan permintaan, termasuk potongan tertentu, kemasan, dan persyaratan lainnya.', NULL, 0, '2025-05-17 06:27:50', '2025-05-17 06:27:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint UNSIGNED NOT NULL,
  `payment_method_id` bigint UNSIGNED DEFAULT NULL,
  `partnership_id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` bigint UNSIGNED DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `updated_by` bigint UNSIGNED NOT NULL,
  `deleted_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `payment_method_id`, `partnership_id`, `company_id`, `code`, `date`, `payment_method`, `total`, `notes`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 1, 1, 'P202505001', '2025-05-19', 'TRANSFER', 3500000, NULL, 'CANCEL', 2, 2, 2, '2025-05-18 23:30:23', '2025-05-18 23:31:09', '2025-05-18 23:31:09'),
(2, NULL, 1, 1, 'P202505002', '2024-05-18', 'TRANSFER', 350000, NULL, 'CANCEL', 2, 2, 2, '2025-05-18 23:31:35', '2025-05-19 01:04:32', '2025-05-19 01:04:32'),
(3, NULL, 1, 1, 'P202505003', '2025-05-19', 'CASH', 700000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 00:59:36', '2025-05-19 01:04:28', '2025-05-19 01:04:28'),
(4, NULL, 1, 1, 'P202405001', '2024-05-19', 'CASH', 175000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 01:24:50', '2025-05-19 04:47:44', '2025-05-19 04:47:44'),
(5, NULL, 1, 1, 'P202505004', '2025-05-19', 'TRANSFER', 350000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 01:25:15', '2025-05-19 04:47:48', '2025-05-19 04:47:48'),
(6, NULL, 1, 1, 'P202506001', '2025-06-01', 'CASH', 700000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 01:29:01', '2025-05-19 04:47:57', '2025-05-19 04:47:57'),
(7, NULL, 1, 1, 'P202505005', '2025-05-26', 'TRANSFER', 70000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 03:59:26', '2025-05-19 04:47:53', '2025-05-19 04:47:53'),
(8, NULL, 1, 1, 'P202506002', '2025-06-08', 'DEBIT/CREDIT', 875000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 04:22:17', '2025-05-19 04:48:01', '2025-05-19 04:48:01'),
(9, NULL, 1, 1, 'P202501001', '2025-01-05', 'CASH', 175000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 04:49:05', '2025-05-20 06:22:16', '2025-05-20 06:22:16'),
(10, NULL, 1, 1, 'P202501002', '2025-01-12', 'TRANSFER', 525000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 04:49:41', '2025-05-20 06:22:07', '2025-05-20 06:22:07'),
(11, NULL, 1, 1, 'P202501003', '2025-01-19', 'CASH', 700000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 04:50:10', '2025-05-20 06:21:57', '2025-05-20 06:21:57'),
(12, NULL, 1, 1, 'P202501004', '2025-01-26', 'TRANSFER', 875000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 04:50:45', '2025-05-20 06:21:49', '2025-05-20 06:21:49'),
(13, NULL, 1, 1, 'P202502001', '2025-02-01', 'TRANSFER', 350000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 04:52:07', '2025-05-20 06:21:40', '2025-05-20 06:21:40'),
(14, NULL, 1, 1, 'P202502002', '2025-02-07', 'CASH', 525000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 04:52:38', '2025-05-20 06:21:32', '2025-05-20 06:21:32'),
(15, NULL, 1, 1, 'P202502003', '2025-02-14', 'TRANSFER', 175000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 04:53:01', '2025-05-20 06:21:24', '2025-05-20 06:21:24'),
(16, NULL, 1, 1, 'P202502004', '2025-02-21', 'DEBIT/CREDIT', 1050000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 04:53:33', '2025-05-20 06:21:15', '2025-05-20 06:21:15'),
(17, NULL, 1, 1, 'P202502005', '2025-02-28', NULL, 525000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 04:53:55', '2025-05-19 04:54:34', '2025-05-19 04:54:34'),
(18, NULL, 1, 1, 'P202502006', '2025-02-28', 'DEBIT/CREDIT', 525000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 04:56:31', '2025-05-20 06:20:38', '2025-05-20 06:20:38'),
(19, NULL, 1, 1, 'P202503001', '2025-03-07', 'DEBIT/CREDIT', 1050000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 04:57:00', '2025-05-20 06:19:00', '2025-05-20 06:19:00'),
(20, NULL, 1, 1, 'P202503002', '2025-03-14', 'TRANSFER', 1225000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 04:57:24', '2025-05-20 06:18:49', '2025-05-20 06:18:49'),
(21, NULL, 1, 1, 'P202503003', '2025-03-21', 'TRANSFER', 1225000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 04:57:46', '2025-05-20 06:19:04', '2025-05-20 06:19:04'),
(22, NULL, 1, 1, 'P202503004', '2025-03-28', 'CASH', 1575000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 04:58:15', '2025-05-20 06:20:44', '2025-05-20 06:20:44'),
(23, NULL, 1, 1, 'P202504001', '2025-04-04', 'CASH', 1400000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 04:58:44', '2025-05-20 06:20:48', '2025-05-20 06:20:48'),
(24, NULL, 1, 1, 'P202504002', '2025-04-11', 'DEBIT/CREDIT', 910000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 04:59:18', '2025-05-20 06:20:52', '2025-05-20 06:20:52'),
(25, NULL, 1, 1, 'P202504003', '2025-04-18', 'TRANSFER', 1050000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 04:59:51', '2025-05-20 06:20:56', '2025-05-20 06:20:56'),
(26, NULL, 1, 1, 'P202504004', '2025-04-25', 'TRANSFER', 1400000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 05:00:19', '2025-05-20 06:21:00', '2025-05-20 06:21:00'),
(27, NULL, 1, 1, 'P202505006', '2025-05-05', 'TRANSFER', 1575000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 05:00:55', '2025-05-20 06:21:04', '2025-05-20 06:21:04'),
(28, NULL, 1, 1, 'P202505007', '2025-05-12', 'TRANSFER', 1400000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 05:01:19', '2025-05-20 06:19:16', '2025-05-20 06:19:16'),
(29, NULL, 1, 1, 'P202505008', '2025-05-19', 'CASH', 1750000, NULL, 'CANCEL', 2, 2, 2, '2025-05-19 05:01:47', '2025-05-20 06:19:10', '2025-05-20 06:19:10'),
(30, NULL, 1, 1, 'P202505009', '2025-05-20', 'TRANSFER', 350000, NULL, 'CANCEL', 2, 2, 2, '2025-05-20 06:47:03', '2025-05-20 06:52:14', '2025-05-20 06:52:14'),
(31, NULL, 1, 1, 'P202407001', '2024-07-01', 'TRANSFER', 350000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 08:07:42', '2025-05-20 08:07:42', NULL),
(32, NULL, 1, 1, 'P202407002', '2024-07-03', 'CASH', 175000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 08:08:13', '2025-05-20 08:08:13', NULL),
(33, NULL, 1, 1, 'P202407003', '2024-07-05', 'CASH', 70000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 08:08:50', '2025-05-20 08:08:50', NULL),
(34, NULL, 1, 1, 'P202407004', '2024-07-07', 'CASH', 700000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 08:14:00', '2025-05-20 08:14:00', NULL),
(35, NULL, 1, 1, 'P202407005', '2024-07-09', 'TRANSFER', 700000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 08:18:17', '2025-05-20 08:18:17', NULL),
(36, NULL, 1, 1, 'P202407006', '2024-07-11', 'CASH', 525000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 08:19:21', '2025-05-20 08:19:21', NULL),
(37, NULL, 1, 1, 'P202407007', '2024-07-13', 'TRANSFER', 175000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 08:20:21', '2025-05-20 08:20:21', NULL),
(38, NULL, 1, 1, 'P202407008', '2024-07-15', 'CASH', 70000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 08:22:02', '2025-05-20 08:22:02', NULL),
(39, NULL, 1, 1, 'P202407009', '2024-07-17', 'TRANSFER', 350000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 08:23:01', '2025-05-20 08:23:01', NULL),
(40, NULL, 1, 1, 'P202407010', '2024-07-19', 'CASH', 525000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:07:46', '2025-05-20 10:07:46', NULL),
(41, NULL, 1, 1, 'P202407011', '2024-07-21', 'DEBIT/CREDIT', 420000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:08:24', '2025-05-20 10:08:24', NULL),
(42, NULL, 1, 1, 'P202407012', '2024-07-23', 'DEBIT/CREDIT', 770000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:08:52', '2025-05-20 10:08:52', NULL),
(43, NULL, 1, 1, 'P202407013', '2024-07-25', 'DEBIT/CREDIT', 1050000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:09:25', '2025-05-20 10:09:25', NULL),
(44, NULL, 1, 1, 'P202407014', '2024-07-27', 'DEBIT/CREDIT', 875000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:10:08', '2025-05-20 10:10:08', NULL),
(45, NULL, 1, 1, 'P202408001', '2024-08-05', 'CASH', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:25:33', '2025-05-20 10:25:33', NULL),
(46, NULL, 1, 1, 'P202408002', '2024-08-07', 'CASH', 350000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:26:12', '2025-05-20 10:26:12', NULL),
(47, NULL, 1, 1, 'P202408003', '2024-08-09', 'CASH', 350000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:26:39', '2025-05-20 10:26:39', NULL),
(48, NULL, 1, 1, 'P202408004', '2024-08-12', 'TRANSFER', 700000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:27:37', '2025-05-20 10:27:37', NULL),
(49, NULL, 1, 1, 'P202408005', '2024-08-14', 'TRANSFER', 875000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:28:12', '2025-05-20 10:28:12', NULL),
(50, NULL, 1, 1, 'P202408006', '2024-08-17', 'TRANSFER', 875000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:28:41', '2025-05-20 10:28:41', NULL),
(51, NULL, 1, 1, 'P202408007', '2024-08-19', 'CASH', 525000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:29:10', '2025-05-20 10:29:10', NULL),
(52, NULL, 1, 1, 'P202408008', '2024-08-21', 'CASH', 700000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:29:35', '2025-05-20 10:29:35', NULL),
(53, NULL, 1, 1, 'P202408009', '2024-08-23', 'CASH', 700000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:29:59', '2025-05-20 10:29:59', NULL),
(54, NULL, 1, 1, 'P202408010', '2024-08-25', 'DEBIT/CREDIT', 875000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:32:06', '2025-05-20 10:32:06', NULL),
(55, NULL, 1, 1, 'P202408011', '2024-08-27', 'DEBIT/CREDIT', 910000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:32:30', '2025-05-20 10:32:30', NULL),
(56, NULL, 1, 1, 'P202408012', '2024-08-29', 'DEBIT/CREDIT', 770000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:33:00', '2025-05-20 10:33:00', NULL),
(57, NULL, 1, 1, 'P202408013', '2024-08-31', 'DEBIT/CREDIT', 840000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:33:28', '2025-05-20 10:33:28', NULL),
(58, NULL, 1, 1, 'P202409001', '2024-09-01', 'TRANSFER', 1050000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:41:35', '2025-05-20 10:41:35', NULL),
(59, NULL, 1, 1, 'P202409002', '2024-09-03', 'TRANSFER', 1225000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:42:01', '2025-05-20 10:42:01', NULL),
(60, NULL, 1, 1, 'P202409003', '2024-09-05', 'TRANSFER', 1190000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:42:51', '2025-05-20 10:42:51', NULL),
(61, NULL, 1, 1, 'P202409004', '2024-09-07', 'TRANSFER', 1225000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:43:14', '2025-05-20 10:43:14', NULL),
(62, NULL, 1, 1, 'P202409005', '2024-09-09', 'TRANSFER', 1190000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:43:39', '2025-05-20 10:43:39', NULL),
(63, NULL, 1, 1, 'P202409006', '2024-09-11', 'TRANSFER', 1225000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:44:03', '2025-05-20 10:44:03', NULL),
(64, NULL, 1, 1, 'P202409007', '2024-09-13', 'TRANSFER', 1225000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:46:01', '2025-05-20 10:46:01', NULL),
(65, NULL, 1, 1, 'P202409008', '2024-09-15', 'CASH', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:46:31', '2025-05-20 10:46:31', NULL),
(66, NULL, 1, 1, 'P202409009', '2024-09-17', 'CASH', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:46:53', '2025-05-20 10:46:53', NULL),
(67, NULL, 1, 1, 'P202409010', '2024-09-19', 'CASH', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:47:29', '2025-05-20 10:47:29', NULL),
(68, NULL, 1, 1, 'P202409011', '2024-09-21', 'CASH', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:47:51', '2025-05-20 10:47:51', NULL),
(69, NULL, 1, 1, 'P202409012', '2024-09-23', 'CASH', 875000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:48:29', '2025-05-20 10:48:29', NULL),
(70, NULL, 1, 1, 'P202409013', '2024-09-25', 'CASH', 1050000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:48:58', '2025-05-20 10:48:58', NULL),
(71, NULL, 1, 1, 'P202409014', '2024-09-27', 'CASH', 945000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:49:25', '2025-05-20 10:49:25', NULL),
(72, NULL, 1, 1, 'P202410001', '2024-10-01', 'CASH', 1225000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:50:03', '2025-05-20 10:50:03', NULL),
(73, NULL, 1, 1, 'P202410002', '2024-10-03', 'CASH', 1330000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:50:52', '2025-05-20 10:50:52', NULL),
(74, NULL, 1, 1, 'P202410003', '2024-10-05', 'CASH', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:51:23', '2025-05-20 10:51:23', NULL),
(75, NULL, 1, 1, 'P202410004', '2024-10-06', 'CASH', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:51:58', '2025-05-20 10:51:58', NULL),
(76, NULL, 1, 1, 'P202410005', '2024-10-08', 'CASH', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:52:34', '2025-05-20 10:52:34', NULL),
(77, NULL, 1, 1, 'P202410006', '2024-10-10', 'CASH', 1260000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:53:11', '2025-05-20 10:53:11', NULL),
(78, NULL, 1, 1, 'P202410007', '2024-10-12', 'CASH', 1505000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:53:34', '2025-05-20 10:53:34', NULL),
(79, NULL, 1, 1, 'P202409015', '2024-09-14', 'CASH', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:57:19', '2025-05-20 10:57:19', NULL),
(80, NULL, 1, 1, 'P202409016', '2024-09-24', 'CASH', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:57:56', '2025-05-20 10:57:56', NULL),
(81, NULL, 1, 1, 'P202409017', '2024-09-26', 'CASH', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:58:20', '2025-05-20 10:58:20', NULL),
(82, NULL, 1, 1, 'P202409018', '2024-09-28', 'CASH', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:58:45', '2025-05-20 10:58:45', NULL),
(83, NULL, 1, 1, 'P202410008', '2024-10-14', 'TRANSFER', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:59:21', '2025-05-20 10:59:21', NULL),
(84, NULL, 1, 1, 'P202410009', '2024-10-16', 'TRANSFER', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 10:59:48', '2025-05-20 10:59:48', NULL),
(85, NULL, 1, 1, 'P202410010', '2024-10-18', 'TRANSFER', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:00:18', '2025-05-20 11:00:18', NULL),
(86, NULL, 1, 1, 'P202410011', '2024-10-20', 'TRANSFER', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:00:41', '2025-05-20 11:00:41', NULL),
(87, NULL, 1, 1, 'P202410012', '2024-10-22', 'TRANSFER', 350000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:01:01', '2025-05-20 11:01:01', NULL),
(88, NULL, 1, 1, 'P202410013', '2024-10-24', 'TRANSFER', 875000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:01:25', '2025-05-20 11:01:25', NULL),
(89, NULL, 1, 1, 'P202410014', '2024-10-26', 'TRANSFER', 1225000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:01:48', '2025-05-20 11:01:48', NULL),
(90, NULL, 1, 1, 'P202411001', '2024-11-04', 'TRANSFER', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:02:37', '2025-05-20 11:02:37', NULL),
(91, NULL, 1, 1, 'P202411002', '2024-11-06', 'TRANSFER', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:02:56', '2025-05-20 11:02:56', NULL),
(92, NULL, 1, 1, 'P202411003', '2024-11-08', 'TRANSFER', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:03:17', '2025-05-20 11:03:17', NULL),
(93, NULL, 1, 1, 'P202411004', '2024-11-10', 'TRANSFER', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:03:48', '2025-05-20 11:03:48', NULL),
(94, NULL, 1, 1, 'P202411005', '2024-11-12', 'TRANSFER', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:04:32', '2025-05-20 11:04:32', NULL),
(95, NULL, 1, 1, 'P202411006', '2024-11-14', 'TRANSFER', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:04:54', '2025-05-20 11:04:54', NULL),
(96, NULL, 1, 1, 'P202411007', '2024-11-16', 'TRANSFER', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:05:17', '2025-05-20 11:05:17', NULL),
(97, NULL, 1, 1, 'P202411008', '2024-11-25', 'TRANSFER', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:05:54', '2025-05-20 11:05:54', NULL),
(98, NULL, 1, 1, 'P202411009', '2024-11-27', 'TRANSFER', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:06:25', '2025-05-20 11:06:25', NULL),
(99, NULL, 1, 1, 'P202411010', '2024-11-29', 'TRANSFER', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:06:50', '2025-05-20 11:06:50', NULL),
(100, NULL, 1, 1, 'P202412001', '2024-12-01', 'DEBIT/CREDIT', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:08:18', '2025-05-20 11:08:18', NULL),
(101, NULL, 1, 1, 'P202412002', '2024-12-04', 'DEBIT/CREDIT', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:08:45', '2025-05-20 11:08:45', NULL),
(102, NULL, 1, 1, 'P202412003', '2024-12-07', 'DEBIT/CREDIT', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:09:14', '2025-05-20 11:09:14', NULL),
(103, NULL, 1, 1, 'P202412004', '2024-12-16', 'DEBIT/CREDIT', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:09:35', '2025-05-20 11:09:35', NULL),
(104, NULL, 1, 1, 'P202412005', '2024-12-19', 'DEBIT/CREDIT', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:10:01', '2025-05-20 11:10:01', NULL),
(105, NULL, 1, 1, 'P202412006', '2024-12-21', 'DEBIT/CREDIT', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:10:30', '2025-05-20 11:10:30', NULL),
(106, NULL, 1, 1, 'P202412007', '2024-12-23', 'DEBIT/CREDIT', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:10:56', '2025-05-20 11:10:56', NULL),
(107, NULL, 1, 1, 'P202412008', '2024-12-25', 'DEBIT/CREDIT', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:11:15', '2025-05-20 11:11:15', NULL),
(108, NULL, 1, 1, 'P202412009', '2024-12-27', 'DEBIT/CREDIT', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:11:34', '2025-05-20 11:11:34', NULL),
(109, NULL, 2, 1, 'P202501005', '2025-01-01', 'CASH', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:16:14', '2025-05-20 11:16:14', NULL),
(110, NULL, 2, 1, 'P202501006', '2025-01-03', 'CASH', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:16:39', '2025-05-20 11:16:39', NULL),
(111, NULL, 2, 1, 'P202501007', '2025-01-05', 'CASH', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:17:09', '2025-05-20 11:17:09', NULL),
(112, NULL, 2, 1, 'P202501008', '2025-01-07', 'CASH', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:17:36', '2025-05-20 11:17:36', NULL),
(113, NULL, 2, 1, 'P202501009', '2025-01-09', 'CASH', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:17:57', '2025-05-20 11:17:57', NULL),
(114, NULL, 2, 1, 'P202501010', '2025-01-11', 'TRANSFER', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:19:46', '2025-05-20 11:19:46', NULL),
(115, NULL, 2, 1, 'P202501011', '2025-01-13', 'TRANSFER', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:20:09', '2025-05-20 11:20:09', NULL),
(116, NULL, 2, 1, 'P202501012', '2025-01-15', 'TRANSFER', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:20:57', '2025-05-20 11:20:57', NULL),
(117, NULL, 2, 1, 'P202501013', '2025-01-17', 'TRANSFER', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:21:32', '2025-05-20 11:21:32', NULL),
(118, NULL, 2, 1, 'P202501014', '2025-01-20', 'TRANSFER', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:21:58', '2025-05-20 11:21:58', NULL),
(119, NULL, 2, 1, 'P202501015', '2025-01-22', 'TRANSFER', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:22:31', '2025-05-20 11:22:31', NULL),
(120, NULL, 2, 1, 'P202501016', '2025-01-24', 'TRANSFER', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:23:00', '2025-05-20 11:23:00', NULL),
(121, NULL, 2, 1, 'P202501017', '2025-01-26', 'TRANSFER', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:23:45', '2025-05-20 11:23:45', NULL),
(122, NULL, 2, 1, 'P202501018', '2025-01-29', 'TRANSFER', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:24:10', '2025-05-20 11:24:10', NULL),
(123, NULL, 2, 1, 'P202501019', '2025-01-31', 'TRANSFER', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:24:41', '2025-05-20 11:24:41', NULL),
(124, NULL, 2, 1, 'P202502007', '2025-02-02', 'CASH', 1050000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:26:13', '2025-05-20 11:26:13', NULL),
(125, NULL, 2, 1, 'P202502008', '2025-02-04', 'CASH', 1050000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:26:34', '2025-05-20 11:26:34', NULL),
(126, NULL, 2, 1, 'P202502009', '2025-02-06', 'CASH', 1050000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:26:54', '2025-05-20 11:26:54', NULL),
(127, NULL, 2, 1, 'P202502010', '2025-02-08', 'CASH', 1050000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:27:26', '2025-05-20 11:27:26', NULL),
(128, NULL, 2, 1, 'P202502011', '2025-02-10', 'CASH', 1050000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:27:55', '2025-05-20 11:27:55', NULL),
(129, NULL, 2, 1, 'P202502012', '2025-02-12', 'CASH', 1050000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:28:16', '2025-05-20 11:28:16', NULL),
(130, NULL, 2, 1, 'P202502013', '2025-02-14', 'CASH', 1050000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:28:46', '2025-05-20 11:28:46', NULL),
(131, NULL, 2, 1, 'P202502014', '2025-02-16', 'CASH', 1225000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:29:23', '2025-05-20 11:29:23', NULL),
(132, NULL, 2, 1, 'P202502015', '2025-02-18', 'CASH', 1225000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:29:48', '2025-05-20 11:29:48', NULL),
(133, NULL, 2, 1, 'P202502016', '2025-02-20', 'CASH', 1225000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:30:08', '2025-05-20 11:30:08', NULL),
(134, NULL, 2, 1, 'P202502017', '2025-02-22', 'CASH', 1225000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:30:27', '2025-05-20 11:30:27', NULL),
(135, NULL, 2, 1, 'P202502018', '2025-02-24', 'CASH', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:30:56', '2025-05-20 11:30:56', NULL),
(136, NULL, 2, 1, 'P202502019', '2025-02-26', 'CASH', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:31:21', '2025-05-20 11:31:21', NULL),
(137, NULL, 2, 1, 'P202502020', '2025-02-28', 'CASH', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:31:45', '2025-05-20 11:31:45', NULL),
(138, NULL, 2, 1, 'P202503005', '2025-03-03', 'TRANSFER', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:32:12', '2025-05-20 11:32:12', NULL),
(139, NULL, 2, 1, 'P202503006', '2025-03-05', 'TRANSFER', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:32:33', '2025-05-20 11:32:33', NULL),
(140, NULL, 2, 1, 'P202503007', '2025-03-07', 'TRANSFER', 1400000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:32:56', '2025-05-20 11:32:56', NULL),
(141, NULL, 2, 1, 'P202503008', '2025-03-10', 'CASH', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:33:27', '2025-05-20 11:33:27', NULL),
(142, NULL, 2, 1, 'P202503009', '2025-03-12', 'CASH', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:33:46', '2025-05-20 11:33:46', NULL),
(143, NULL, 2, 1, 'P202503010', '2025-03-14', 'CASH', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:34:09', '2025-05-20 11:34:09', NULL),
(144, NULL, 2, 1, 'P202503011', '2025-03-16', 'CASH', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:34:41', '2025-05-20 11:34:41', NULL),
(145, NULL, 2, 1, 'P202503012', '2025-03-18', 'CASH', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:35:09', '2025-05-20 11:35:09', NULL),
(146, NULL, 2, 1, 'P202503013', '2025-03-20', 'CASH', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:35:28', '2025-05-20 11:35:28', NULL),
(147, NULL, 2, 1, 'P202503014', '2025-03-22', 'CASH', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:35:48', '2025-05-20 11:35:48', NULL),
(148, NULL, 2, 1, 'P202503015', '2025-03-24', 'CASH', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:36:12', '2025-05-20 11:36:12', NULL),
(149, NULL, 2, 1, 'P202503016', '2025-03-27', 'CASH', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:36:39', '2025-05-20 11:36:39', NULL),
(150, NULL, 2, 1, 'P202503017', '2025-03-29', 'CASH', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:37:05', '2025-05-20 11:37:05', NULL),
(151, NULL, 2, 1, 'P202504005', '2025-04-01', 'DEBIT/CREDIT', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:37:30', '2025-05-20 11:37:30', NULL),
(152, NULL, 2, 1, 'P202504006', '2025-04-03', 'DEBIT/CREDIT', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:37:52', '2025-05-20 11:37:52', NULL),
(153, NULL, 2, 1, 'P202504007', '2025-04-05', 'DEBIT/CREDIT', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:38:31', '2025-05-20 11:38:31', NULL),
(154, NULL, 2, 1, 'P202504008', '2025-04-06', 'DEBIT/CREDIT', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:38:55', '2025-05-20 11:38:55', NULL),
(155, NULL, 2, 1, 'P202504009', '2025-04-08', 'DEBIT/CREDIT', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:39:22', '2025-05-20 11:39:22', NULL),
(156, NULL, 2, 1, 'P202504010', '2025-04-10', 'DEBIT/CREDIT', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:39:44', '2025-05-20 11:39:44', NULL),
(157, NULL, 2, 1, 'P202504011', '2025-04-12', 'DEBIT/CREDIT', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:41:35', '2025-05-20 11:41:35', NULL),
(158, NULL, 2, 1, 'P202504012', '2025-04-14', 'DEBIT/CREDIT', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:41:58', '2025-05-20 11:41:58', NULL),
(159, NULL, 2, 1, 'P202504013', '2025-04-16', 'DEBIT/CREDIT', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:42:21', '2025-05-20 11:42:21', NULL),
(160, NULL, 2, 1, 'P202504014', '2025-04-18', 'DEBIT/CREDIT', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:42:44', '2025-05-20 11:42:44', NULL),
(161, NULL, 2, 1, 'P202504015', '2025-04-18', 'DEBIT/CREDIT', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:43:11', '2025-05-20 11:43:11', NULL),
(162, NULL, 2, 1, 'P202504016', '2025-04-20', 'CASH', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:43:34', '2025-05-20 11:43:34', NULL),
(163, NULL, 2, 1, 'P202504017', '2025-04-22', 'CASH', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:44:00', '2025-05-20 11:44:00', NULL),
(164, NULL, 2, 1, 'P202504018', '2025-04-24', 'CASH', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:44:18', '2025-05-20 11:44:18', NULL),
(165, NULL, 2, 1, 'P202505010', '2025-05-01', 'CASH', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:45:12', '2025-05-20 11:45:12', NULL),
(166, NULL, 2, 1, 'P202505011', '2025-05-05', 'CASH', 1750000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:45:46', '2025-05-20 11:45:46', NULL),
(167, NULL, 2, 1, 'P202505012', '2025-05-07', 'CASH', 1575000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:46:10', '2025-05-20 11:46:10', NULL),
(168, NULL, 2, 1, 'P202505013', '2025-05-12', 'TRANSFER', 1050000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:46:37', '2025-05-20 11:46:37', NULL),
(169, NULL, 2, 1, 'P202505014', '2025-05-14', 'TRANSFER', 1225000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:46:59', '2025-05-20 11:46:59', NULL),
(170, NULL, 2, 1, 'P202505015', '2025-05-16', 'TRANSFER', 1225000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:47:21', '2025-05-20 11:47:21', NULL),
(171, NULL, 2, 1, 'P202505016', '2025-05-18', 'TRANSFER', 1050000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:47:43', '2025-05-20 11:47:43', NULL),
(172, NULL, 2, 1, 'P202505017', '2025-05-21', 'TRANSFER', 1225000, NULL, 'ACTIVE', 2, 2, NULL, '2025-05-20 11:48:03', '2025-05-20 11:48:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `id` bigint UNSIGNED NOT NULL,
  `sale_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `price` bigint DEFAULT NULL,
  `subtotal` bigint DEFAULT NULL COMMENT 'qty * price',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`id`, `sale_id`, `product_id`, `qty`, `price`, `subtotal`, `created_at`, `updated_at`, `deleted_at`) VALUES
(35, 31, 1, 10, 35000, 350000, '2025-05-20 08:07:42', '2025-05-20 08:07:42', NULL),
(36, 32, 1, 5, 35000, 175000, '2025-05-20 08:08:13', '2025-05-20 08:08:13', NULL),
(37, 33, 1, 2, 35000, 70000, '2025-05-20 08:08:50', '2025-05-20 08:08:50', NULL),
(38, 34, 1, 20, 35000, 700000, '2025-05-20 08:14:00', '2025-05-20 08:14:00', NULL),
(39, 35, 1, 20, 35000, 700000, '2025-05-20 08:18:17', '2025-05-20 08:18:17', NULL),
(40, 36, 1, 15, 35000, 525000, '2025-05-20 08:19:21', '2025-05-20 08:19:21', NULL),
(41, 37, 1, 5, 35000, 175000, '2025-05-20 08:20:21', '2025-05-20 08:20:21', NULL),
(42, 38, 1, 2, 35000, 70000, '2025-05-20 08:22:02', '2025-05-20 08:22:02', NULL),
(43, 39, 1, 10, 35000, 350000, '2025-05-20 08:23:01', '2025-05-20 08:23:01', NULL),
(44, 40, 1, 15, 35000, 525000, '2025-05-20 10:07:46', '2025-05-20 10:07:46', NULL),
(45, 41, 1, 12, 35000, 420000, '2025-05-20 10:08:24', '2025-05-20 10:08:24', NULL),
(46, 42, 1, 22, 35000, 770000, '2025-05-20 10:08:52', '2025-05-20 10:08:52', NULL),
(47, 43, 1, 30, 35000, 1050000, '2025-05-20 10:09:25', '2025-05-20 10:09:25', NULL),
(48, 44, 1, 25, 35000, 875000, '2025-05-20 10:10:08', '2025-05-20 10:10:08', NULL),
(49, 45, 1, 40, 35000, 1400000, '2025-05-20 10:25:33', '2025-05-20 10:25:33', NULL),
(50, 46, 1, 10, 35000, 350000, '2025-05-20 10:26:12', '2025-05-20 10:26:12', NULL),
(51, 47, 1, 10, 35000, 350000, '2025-05-20 10:26:39', '2025-05-20 10:26:39', NULL),
(52, 48, 1, 20, 35000, 700000, '2025-05-20 10:27:37', '2025-05-20 10:27:37', NULL),
(53, 49, 1, 25, 35000, 875000, '2025-05-20 10:28:12', '2025-05-20 10:28:12', NULL),
(54, 50, 1, 25, 35000, 875000, '2025-05-20 10:28:41', '2025-05-20 10:28:41', NULL),
(55, 51, 1, 15, 35000, 525000, '2025-05-20 10:29:10', '2025-05-20 10:29:10', NULL),
(56, 52, 1, 20, 35000, 700000, '2025-05-20 10:29:35', '2025-05-20 10:29:35', NULL),
(57, 53, 1, 20, 35000, 700000, '2025-05-20 10:29:59', '2025-05-20 10:29:59', NULL),
(58, 54, 1, 25, 35000, 875000, '2025-05-20 10:32:06', '2025-05-20 10:32:06', NULL),
(59, 55, 1, 26, 35000, 910000, '2025-05-20 10:32:30', '2025-05-20 10:32:30', NULL),
(60, 56, 1, 22, 35000, 770000, '2025-05-20 10:33:00', '2025-05-20 10:33:00', NULL),
(61, 57, 1, 24, 35000, 840000, '2025-05-20 10:33:28', '2025-05-20 10:33:28', NULL),
(62, 58, 1, 30, 35000, 1050000, '2025-05-20 10:41:35', '2025-05-20 10:41:35', NULL),
(63, 59, 1, 35, 35000, 1225000, '2025-05-20 10:42:01', '2025-05-20 10:42:01', NULL),
(64, 60, 1, 34, 35000, 1190000, '2025-05-20 10:42:51', '2025-05-20 10:42:51', NULL),
(65, 61, 1, 35, 35000, 1225000, '2025-05-20 10:43:14', '2025-05-20 10:43:14', NULL),
(66, 62, 1, 34, 35000, 1190000, '2025-05-20 10:43:39', '2025-05-20 10:43:39', NULL),
(67, 63, 1, 35, 35000, 1225000, '2025-05-20 10:44:03', '2025-05-20 10:44:03', NULL),
(68, 64, 1, 35, 35000, 1225000, '2025-05-20 10:46:01', '2025-05-20 10:46:01', NULL),
(69, 65, 1, 40, 35000, 1400000, '2025-05-20 10:46:31', '2025-05-20 10:46:31', NULL),
(70, 66, 1, 40, 35000, 1400000, '2025-05-20 10:46:53', '2025-05-20 10:46:53', NULL),
(71, 67, 1, 40, 35000, 1400000, '2025-05-20 10:47:29', '2025-05-20 10:47:29', NULL),
(72, 68, 1, 40, 35000, 1400000, '2025-05-20 10:47:51', '2025-05-20 10:47:51', NULL),
(73, 69, 1, 25, 35000, 875000, '2025-05-20 10:48:29', '2025-05-20 10:48:29', NULL),
(74, 70, 1, 30, 35000, 1050000, '2025-05-20 10:48:58', '2025-05-20 10:48:58', NULL),
(75, 71, 1, 27, 35000, 945000, '2025-05-20 10:49:25', '2025-05-20 10:49:25', NULL),
(76, 72, 1, 35, 35000, 1225000, '2025-05-20 10:50:03', '2025-05-20 10:50:03', NULL),
(77, 73, 1, 38, 35000, 1330000, '2025-05-20 10:50:52', '2025-05-20 10:50:52', NULL),
(78, 74, 1, 40, 35000, 1400000, '2025-05-20 10:51:23', '2025-05-20 10:51:23', NULL),
(79, 75, 1, 40, 35000, 1400000, '2025-05-20 10:51:58', '2025-05-20 10:51:58', NULL),
(80, 76, 1, 45, 35000, 1575000, '2025-05-20 10:52:34', '2025-05-20 10:52:34', NULL),
(81, 77, 1, 36, 35000, 1260000, '2025-05-20 10:53:11', '2025-05-20 10:53:11', NULL),
(82, 78, 1, 43, 35000, 1505000, '2025-05-20 10:53:34', '2025-05-20 10:53:34', NULL),
(83, 79, 1, 45, 35000, 1575000, '2025-05-20 10:57:19', '2025-05-20 10:57:19', NULL),
(84, 80, 1, 45, 35000, 1575000, '2025-05-20 10:57:56', '2025-05-20 10:57:56', NULL),
(85, 81, 1, 45, 35000, 1575000, '2025-05-20 10:58:20', '2025-05-20 10:58:20', NULL),
(86, 82, 1, 45, 35000, 1575000, '2025-05-20 10:58:45', '2025-05-20 10:58:45', NULL),
(87, 83, 1, 50, 35000, 1750000, '2025-05-20 10:59:21', '2025-05-20 10:59:21', NULL),
(88, 84, 1, 50, 35000, 1750000, '2025-05-20 10:59:48', '2025-05-20 10:59:48', NULL),
(89, 85, 1, 50, 35000, 1750000, '2025-05-20 11:00:18', '2025-05-20 11:00:18', NULL),
(90, 86, 1, 50, 35000, 1750000, '2025-05-20 11:00:41', '2025-05-20 11:00:41', NULL),
(91, 87, 1, 10, 35000, 350000, '2025-05-20 11:01:01', '2025-05-20 11:01:01', NULL),
(92, 88, 1, 25, 35000, 875000, '2025-05-20 11:01:25', '2025-05-20 11:01:25', NULL),
(93, 89, 1, 35, 35000, 1225000, '2025-05-20 11:01:48', '2025-05-20 11:01:48', NULL),
(94, 90, 1, 40, 35000, 1400000, '2025-05-20 11:02:37', '2025-05-20 11:02:37', NULL),
(95, 91, 1, 40, 35000, 1400000, '2025-05-20 11:02:56', '2025-05-20 11:02:56', NULL),
(96, 92, 1, 40, 35000, 1400000, '2025-05-20 11:03:17', '2025-05-20 11:03:17', NULL),
(97, 93, 1, 50, 35000, 1750000, '2025-05-20 11:03:48', '2025-05-20 11:03:48', NULL),
(98, 94, 1, 40, 35000, 1400000, '2025-05-20 11:04:32', '2025-05-20 11:04:32', NULL),
(99, 95, 1, 40, 35000, 1400000, '2025-05-20 11:04:54', '2025-05-20 11:04:54', NULL),
(100, 96, 1, 40, 35000, 1400000, '2025-05-20 11:05:17', '2025-05-20 11:05:17', NULL),
(101, 97, 1, 40, 35000, 1400000, '2025-05-20 11:05:54', '2025-05-20 11:05:54', NULL),
(102, 98, 1, 40, 35000, 1400000, '2025-05-20 11:06:25', '2025-05-20 11:06:25', NULL),
(103, 99, 1, 40, 35000, 1400000, '2025-05-20 11:06:50', '2025-05-20 11:06:50', NULL),
(104, 100, 1, 50, 35000, 1750000, '2025-05-20 11:08:18', '2025-05-20 11:08:18', NULL),
(105, 101, 1, 50, 35000, 1750000, '2025-05-20 11:08:45', '2025-05-20 11:08:45', NULL),
(106, 102, 1, 50, 35000, 1750000, '2025-05-20 11:09:14', '2025-05-20 11:09:14', NULL),
(107, 103, 1, 50, 35000, 1750000, '2025-05-20 11:09:35', '2025-05-20 11:09:35', NULL),
(108, 104, 1, 50, 35000, 1750000, '2025-05-20 11:10:01', '2025-05-20 11:10:01', NULL),
(109, 105, 1, 50, 35000, 1750000, '2025-05-20 11:10:30', '2025-05-20 11:10:30', NULL),
(110, 106, 1, 50, 35000, 1750000, '2025-05-20 11:10:56', '2025-05-20 11:10:56', NULL),
(111, 107, 1, 50, 35000, 1750000, '2025-05-20 11:11:15', '2025-05-20 11:11:15', NULL),
(112, 108, 1, 50, 35000, 1750000, '2025-05-20 11:11:34', '2025-05-20 11:11:34', NULL),
(113, 109, 1, 50, 35000, 1750000, '2025-05-20 11:16:14', '2025-05-20 11:16:14', NULL),
(114, 110, 1, 50, 35000, 1750000, '2025-05-20 11:16:39', '2025-05-20 11:16:39', NULL),
(115, 111, 1, 50, 35000, 1750000, '2025-05-20 11:17:09', '2025-05-20 11:17:09', NULL),
(116, 112, 1, 50, 35000, 1750000, '2025-05-20 11:17:36', '2025-05-20 11:17:36', NULL),
(117, 113, 1, 50, 35000, 1750000, '2025-05-20 11:17:57', '2025-05-20 11:17:57', NULL),
(118, 114, 1, 50, 35000, 1750000, '2025-05-20 11:19:46', '2025-05-20 11:19:46', NULL),
(119, 115, 1, 50, 35000, 1750000, '2025-05-20 11:20:09', '2025-05-20 11:20:09', NULL),
(120, 116, 1, 50, 35000, 1750000, '2025-05-20 11:20:57', '2025-05-20 11:20:57', NULL),
(121, 117, 1, 50, 35000, 1750000, '2025-05-20 11:21:32', '2025-05-20 11:21:32', NULL),
(122, 118, 1, 45, 35000, 1575000, '2025-05-20 11:21:58', '2025-05-20 11:21:58', NULL),
(123, 119, 1, 50, 35000, 1750000, '2025-05-20 11:22:31', '2025-05-20 11:22:31', NULL),
(124, 120, 1, 50, 35000, 1750000, '2025-05-20 11:23:00', '2025-05-20 11:23:00', NULL),
(125, 121, 1, 40, 35000, 1400000, '2025-05-20 11:23:45', '2025-05-20 11:23:45', NULL),
(126, 122, 1, 50, 35000, 1750000, '2025-05-20 11:24:10', '2025-05-20 11:24:10', NULL),
(127, 123, 1, 50, 35000, 1750000, '2025-05-20 11:24:41', '2025-05-20 11:24:41', NULL),
(128, 124, 1, 30, 35000, 1050000, '2025-05-20 11:26:13', '2025-05-20 11:26:13', NULL),
(129, 125, 1, 30, 35000, 1050000, '2025-05-20 11:26:34', '2025-05-20 11:26:34', NULL),
(130, 126, 1, 30, 35000, 1050000, '2025-05-20 11:26:54', '2025-05-20 11:26:54', NULL),
(131, 127, 1, 30, 35000, 1050000, '2025-05-20 11:27:26', '2025-05-20 11:27:26', NULL),
(132, 128, 1, 30, 35000, 1050000, '2025-05-20 11:27:55', '2025-05-20 11:27:55', NULL),
(133, 129, 1, 30, 35000, 1050000, '2025-05-20 11:28:16', '2025-05-20 11:28:16', NULL),
(134, 130, 1, 30, 35000, 1050000, '2025-05-20 11:28:46', '2025-05-20 11:28:46', NULL),
(135, 131, 1, 35, 35000, 1225000, '2025-05-20 11:29:23', '2025-05-20 11:29:23', NULL),
(136, 132, 1, 35, 35000, 1225000, '2025-05-20 11:29:48', '2025-05-20 11:29:48', NULL),
(137, 133, 1, 35, 35000, 1225000, '2025-05-20 11:30:08', '2025-05-20 11:30:08', NULL),
(138, 134, 1, 35, 35000, 1225000, '2025-05-20 11:30:27', '2025-05-20 11:30:27', NULL),
(139, 135, 1, 40, 35000, 1400000, '2025-05-20 11:30:56', '2025-05-20 11:30:56', NULL),
(140, 136, 1, 40, 35000, 1400000, '2025-05-20 11:31:21', '2025-05-20 11:31:21', NULL),
(141, 137, 1, 40, 35000, 1400000, '2025-05-20 11:31:45', '2025-05-20 11:31:45', NULL),
(142, 138, 1, 40, 35000, 1400000, '2025-05-20 11:32:12', '2025-05-20 11:32:12', NULL),
(143, 139, 1, 40, 35000, 1400000, '2025-05-20 11:32:33', '2025-05-20 11:32:33', NULL),
(144, 140, 1, 40, 35000, 1400000, '2025-05-20 11:32:56', '2025-05-20 11:32:56', NULL),
(145, 141, 1, 45, 35000, 1575000, '2025-05-20 11:33:27', '2025-05-20 11:33:27', NULL),
(146, 142, 1, 45, 35000, 1575000, '2025-05-20 11:33:46', '2025-05-20 11:33:46', NULL),
(147, 143, 1, 45, 35000, 1575000, '2025-05-20 11:34:09', '2025-05-20 11:34:09', NULL),
(148, 144, 1, 45, 35000, 1575000, '2025-05-20 11:34:41', '2025-05-20 11:34:41', NULL),
(149, 145, 1, 45, 35000, 1575000, '2025-05-20 11:35:09', '2025-05-20 11:35:09', NULL),
(150, 146, 1, 45, 35000, 1575000, '2025-05-20 11:35:28', '2025-05-20 11:35:28', NULL),
(151, 147, 1, 45, 35000, 1575000, '2025-05-20 11:35:48', '2025-05-20 11:35:48', NULL),
(152, 148, 1, 45, 35000, 1575000, '2025-05-20 11:36:12', '2025-05-20 11:36:12', NULL),
(153, 149, 1, 45, 35000, 1575000, '2025-05-20 11:36:39', '2025-05-20 11:36:39', NULL),
(154, 150, 1, 45, 35000, 1575000, '2025-05-20 11:37:05', '2025-05-20 11:37:05', NULL),
(155, 151, 1, 50, 35000, 1750000, '2025-05-20 11:37:30', '2025-05-20 11:37:30', NULL),
(156, 152, 1, 50, 35000, 1750000, '2025-05-20 11:37:52', '2025-05-20 11:37:52', NULL),
(157, 153, 1, 50, 35000, 1750000, '2025-05-20 11:38:31', '2025-05-20 11:38:31', NULL),
(158, 154, 1, 45, 35000, 1575000, '2025-05-20 11:38:55', '2025-05-20 11:38:55', NULL),
(159, 155, 1, 50, 35000, 1750000, '2025-05-20 11:39:22', '2025-05-20 11:39:22', NULL),
(160, 156, 1, 45, 35000, 1575000, '2025-05-20 11:39:44', '2025-05-20 11:39:44', NULL),
(161, 157, 1, 50, 35000, 1750000, '2025-05-20 11:41:35', '2025-05-20 11:41:35', NULL),
(162, 158, 1, 45, 35000, 1575000, '2025-05-20 11:41:58', '2025-05-20 11:41:58', NULL),
(163, 159, 1, 50, 35000, 1750000, '2025-05-20 11:42:21', '2025-05-20 11:42:21', NULL),
(164, 160, 1, 45, 35000, 1575000, '2025-05-20 11:42:44', '2025-05-20 11:42:44', NULL),
(165, 161, 1, 50, 35000, 1750000, '2025-05-20 11:43:11', '2025-05-20 11:43:11', NULL),
(166, 162, 1, 45, 35000, 1575000, '2025-05-20 11:43:34', '2025-05-20 11:43:34', NULL),
(167, 163, 1, 50, 35000, 1750000, '2025-05-20 11:44:00', '2025-05-20 11:44:00', NULL),
(168, 164, 1, 45, 35000, 1575000, '2025-05-20 11:44:18', '2025-05-20 11:44:18', NULL),
(169, 165, 1, 45, 35000, 1575000, '2025-05-20 11:45:12', '2025-05-20 11:45:12', NULL),
(170, 166, 1, 50, 35000, 1750000, '2025-05-20 11:45:46', '2025-05-20 11:45:46', NULL),
(171, 167, 1, 45, 35000, 1575000, '2025-05-20 11:46:10', '2025-05-20 11:46:10', NULL),
(172, 168, 1, 30, 35000, 1050000, '2025-05-20 11:46:37', '2025-05-20 11:46:37', NULL),
(173, 169, 1, 35, 35000, 1225000, '2025-05-20 11:46:59', '2025-05-20 11:46:59', NULL),
(174, 170, 1, 35, 35000, 1225000, '2025-05-20 11:47:21', '2025-05-20 11:47:21', NULL),
(175, 171, 1, 30, 35000, 1050000, '2025-05-20 11:47:43', '2025-05-20 11:47:43', NULL),
(176, 172, 1, 35, 35000, 1225000, '2025-05-20 11:48:03', '2025-05-20 11:48:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_statuses`
--

CREATE TABLE `sale_statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_statuses`
--

INSERT INTO `sale_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ACTIVE', '2025-05-17 06:27:50', '2025-05-17 06:27:50'),
(2, 'PENDING', '2025-05-17 06:27:50', '2025-05-17 06:27:50'),
(3, 'CANCEL', '2025-05-17 06:27:50', '2025-05-17 06:27:50');

-- --------------------------------------------------------

--
-- Stand-in structure for view `stock_view`
-- (See below for the actual view)
--
CREATE TABLE `stock_view` (
`product_id` bigint unsigned
,`sisa` decimal(33,0)
,`stok` bigint
,`terjual` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, 'Developer', 'developer', '$2y$10$xmD0R5nb8t.3qsbS5qMXE.vFAhODV.JAAf2nSmKxP4PHYimAnr4Wu', 1, '2025-05-17 06:27:49', '2025-05-17 06:27:49'),
(2, 'Admin', 'admin', '$2y$10$YFcIT32kf2vIYL4E1bgMQukzju4f7gtfqOiK9Sq5SxImefE3rz8EK', 1, '2025-05-17 06:27:49', '2025-05-17 06:27:49'),
(3, 'Owner', 'owner', '$2y$10$T2AK11KFPYW5wmq8u.hhhOvuLsfs4LbAYknI25e6v/eu70oLLkr0C', 1, '2025-05-17 06:27:49', '2025-05-17 06:27:49'),
(4, 'Fadel07', 'fadel07', '$2y$10$LFQsS.rTRuEz/.YOCkWShOefope3IwjUGs5wFizdTXes5fG8pRNcm', 1, '2025-05-17 06:27:50', '2025-05-17 06:27:50'),
(5, 'Kasir', 'kasir', '$2y$10$qUxszK7SOZMacdaPdbR1IeQPOYM1UZE6PDy0cdCZw6d2.GtH4625W', 0, '2025-05-17 06:27:50', '2025-05-17 06:27:50');

-- --------------------------------------------------------

--
-- Structure for view `stock_view`
--
DROP TABLE IF EXISTS `stock_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `stock_view`  AS SELECT `p`.`id` AS `product_id`, coalesce(`p`.`stock`,0) AS `stok`, sum(coalesce(`sd`.`qty`,0)) AS `terjual`, (coalesce(`p`.`stock`,0) - sum(coalesce(`sd`.`qty`,0))) AS `sisa` FROM (`products` `p` left join `sale_details` `sd` on(((`p`.`id` = `sd`.`product_id`) and (`sd`.`deleted_at` is null)))) WHERE ((`p`.`stock` is not null) AND (`p`.`deleted_at` is null)) GROUP BY `p`.`id`, `p`.`stock`, `p`.`name``name`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_orders`
--
ALTER TABLE `detail_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_company_id_foreign` (`company_id`),
  ADD KEY `expenses_expense_type_id_foreign` (`expense_type_id`),
  ADD KEY `expenses_created_by_foreign` (`created_by`),
  ADD KEY `expenses_updated_by_foreign` (`updated_by`),
  ADD KEY `expenses_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `expense_types`
--
ALTER TABLE `expense_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `expense_types_name_unique` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partnerships`
--
ALTER TABLE `partnerships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_methods_name_unique` (`name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_product_category_id_foreign` (`product_category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_categories_slug_unique` (`slug`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_payment_method_foreign` (`payment_method`),
  ADD KEY `sales_status_foreign` (`status`),
  ADD KEY `sales_partnership_id_foreign` (`partnership_id`),
  ADD KEY `sales_company_id_foreign` (`company_id`),
  ADD KEY `sales_payment_method_id_foreign` (`payment_method_id`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_details_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `sale_statuses`
--
ALTER TABLE `sale_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sale_statuses_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_orders`
--
ALTER TABLE `detail_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_types`
--
ALTER TABLE `expense_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `partnerships`
--
ALTER TABLE `partnerships`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `sale_statuses`
--
ALTER TABLE `sale_statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `expenses_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `expenses_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `expenses_expense_type_id_foreign` FOREIGN KEY (`expense_type_id`) REFERENCES `expense_types` (`id`),
  ADD CONSTRAINT `expenses_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `sales_partnership_id_foreign` FOREIGN KEY (`partnership_id`) REFERENCES `partnerships` (`id`),
  ADD CONSTRAINT `sales_payment_method_foreign` FOREIGN KEY (`payment_method`) REFERENCES `payment_methods` (`name`),
  ADD CONSTRAINT `sales_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sales_status_foreign` FOREIGN KEY (`status`) REFERENCES `sale_statuses` (`name`);

--
-- Constraints for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD CONSTRAINT `sale_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `sale_details_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
