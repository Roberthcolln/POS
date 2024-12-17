-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2024 at 06:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `bar_orders`
--

CREATE TABLE `bar_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemesanan_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('c525a5357e97fef8d3db25841c86da1a', 'i:1;', 1734287598),
('c525a5357e97fef8d3db25841c86da1a:timer', 'i:1734287598;', 1734287598);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

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
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kasir_transactions`
--

CREATE TABLE `kasir_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemesanan_id` bigint(20) UNSIGNED NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `jumlah_bayar` decimal(15,2) DEFAULT NULL,
  `kembalian` decimal(15,2) DEFAULT NULL,
  `status` enum('pending','paid') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id_kategori_produk` int(10) UNSIGNED NOT NULL,
  `nama_kategori_produk` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`id_kategori_produk`, `nama_kategori_produk`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', '2024-10-29 21:44:43', '2024-10-29 21:44:43'),
(2, 'Minuman', '2024-10-31 06:09:22', '2024-10-31 06:09:22'),
(3, 'Cemilan', '2024-12-13 13:23:01', '2024-12-13 13:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `kitchen_orders`
--

CREATE TABLE `kitchen_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemesanan_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_29_104018_add_two_factor_columns_to_users_table', 1),
(5, '2024_10_29_104111_create_personal_access_tokens_table', 1),
(6, '2024_10_31_123800_create_service_status_table', 2),
(7, '2024_11_07_121511_create_contact_forms_table', 3),
(8, '2024_12_09_201838_create_bar_orders_table', 4),
(9, '2024_12_09_202101_create_kitchen_orders_table', 5),
(10, '2024_12_10_154008_create_transaksi_table', 6),
(11, '2024_12_12_134558_create_kasir_transactions_table', 7),
(12, '2024_12_13_130402_add_nomor_meja_to_pemesanan_table', 8),
(13, '2024_12_13_233808_add_group_id_to_kasir_transactions_table', 9),
(14, '2024_12_15_224849_add_produk_nama_to_kasir_transactions', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` bigint(20) UNSIGNED NOT NULL,
  `id_produk` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `status` varchar(255) NOT NULL,
  `nomor_meja` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(10) UNSIGNED NOT NULL,
  `barcode` text NOT NULL,
  `id_kategori_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `stok` bigint(20) NOT NULL,
  `foto_produk` varchar(255) NOT NULL,
  `harga_produk` double(10,2) NOT NULL,
  `harga_jual` double(10,2) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `barcode`, `id_kategori_produk`, `nama_produk`, `stok`, `foto_produk`, `harga_produk`, `harga_jual`, `deskripsi_produk`, `created_at`, `updated_at`) VALUES
(1, 'barcode_1733742864.png', 1, 'Babi Guling', 0, 'FotoProduk20241209081424.jpg', 15000.00, 22000.00, '<p>Pake C Kompilt</p>', '2024-12-09 11:14:24', '2024-12-15 19:03:14'),
(2, 'barcode_1733812007.png', 2, 'Arak Mojito', 0, 'FotoProduk20241210032647.jpg', 25000.00, 34999.98, '<p>Soft Drink Type</p>', '2024-12-10 06:26:47', '2024-12-15 15:08:19'),
(3, 'barcode_1734062007.png', 1, 'Ayam Betutu', 0, 'FotoProduk20241213125326.jpeg', 30000.00, 45000.00, '<p>Paket B2</p>', '2024-12-13 03:53:27', '2024-12-15 19:03:26'),
(4, 'barcode_1734062077.png', 1, 'Sate Lilit', 0, 'FotoProduk20241213125437.jpeg', 15000.00, 20000.00, '<p>Paket 5 Tusuk</p>', '2024-12-13 03:54:37', '2024-12-15 18:32:09'),
(5, 'barcode_1734062178.png', 1, 'Nasi Jinggo', 0, 'FotoProduk20241213125618.jpeg', 4500.00, 5000.00, '<p>Nasi Babi</p>', '2024-12-13 03:56:18', '2024-12-13 17:13:34'),
(6, 'barcode_1734062277.png', 2, 'Brem Bali', 0, 'FotoProduk20241213125757.jpg', 25000.00, 35000.00, '<p>Paket 1</p>', '2024-12-13 03:57:57', '2024-12-13 13:40:19'),
(7, 'barcode_1734096482.png', 3, 'Pisang Aroma', 5, 'FotoProduk20241213102802.jpg', 4500.00, 7500.00, '<p>Rasa Cokelat</p>', '2024-12-13 13:28:02', '2024-12-13 14:35:15');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('zKFaWKGEmkhCxftNH6S8EqqZJDbhTavKbT5HEp7T', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiODc4c2pEUmlzS2toSmVZbm9TM09oQkVVYVpQM0RGVWM5VUZlMk9JTyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAva2FzaXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJC8uRU9hZkZxdmN0VnJKbW83RHVDcGVKODdGbjN2RzFEVzNvTzdiN0V6Mi5URzVhbU5yWVRHIjt9', 1734290989);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(10) UNSIGNED NOT NULL,
  `instansi_setting` varchar(255) DEFAULT NULL,
  `pimpinan_setting` varchar(255) DEFAULT NULL,
  `logo_setting` varchar(255) DEFAULT NULL,
  `favicon_setting` varchar(255) DEFAULT NULL,
  `tentang_setting` text DEFAULT NULL,
  `misi_setting` text DEFAULT NULL,
  `visi_setting` text DEFAULT NULL,
  `keyword_setting` varchar(255) DEFAULT NULL,
  `alamat_setting` varchar(255) DEFAULT NULL,
  `instagram_setting` varchar(255) DEFAULT NULL,
  `youtube_setting` varchar(255) DEFAULT NULL,
  `email_setting` varchar(255) DEFAULT NULL,
  `no_hp_setting` varchar(255) DEFAULT NULL,
  `maps_setting` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `instansi_setting`, `pimpinan_setting`, `logo_setting`, `favicon_setting`, `tentang_setting`, `misi_setting`, `visi_setting`, `keyword_setting`, `alamat_setting`, `instagram_setting`, `youtube_setting`, `email_setting`, `no_hp_setting`, `maps_setting`, `created_at`, `updated_at`) VALUES
(2, 'Point Of Sales', 'Fajar Prayoga', '1728668916_64390e09-4ddd-4a2f-968e-cbd24da33384.png', 'Screenshot (80).png', '<p>Sistem Informasi Point Of Sales Transaksi Penjualan/ Pembelian Produk</p>', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Point Of Sales', 'Bali, Indonesia', 'roberth_colln', 'https://www.youtube.com/watch?v=D9GTa9w525A', 'pattroberth13@gmail.com', '6285150914771', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253840.4913174801!2d106.66469788130048!3d-6.229720926685816!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1727152052689!5m2!1sid!2sid', NULL, '2024-12-09 11:16:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$/.EOafFqvctVrJmo7DuCpeJ87Fn3vG1DW3oO7b7Ez2.TG5amNrYTG', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-29 01:52:58', '2024-10-29 01:52:58'),
(2, 'kasir', 'kasir@gmail.com', NULL, '$2y$12$qjBUtKjs7d8udzMJ4XFp9evei9lQ6b485hpwzuC.4k56fhTOyQjZm', NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-12 06:40:26', '2024-12-12 06:40:26'),
(3, 'bar', 'bar@gmail.com', NULL, '$2y$12$H2P9xBFULx7XmjrgIi5kruucC0g0AGchL/PQNwMQYa8T5AHxInq6a', NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-12 06:41:03', '2024-12-12 06:41:03'),
(4, 'kitchen', 'kitchen@gmail.com', NULL, '$2y$12$KYMeSN0PcRXnUgqqMz3unukn84zLJADQv4XSvrg4BK0hBIhsKUzam', NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-12 06:41:35', '2024-12-12 06:41:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bar_orders`
--
ALTER TABLE `bar_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bar_orders_pemesanan_id_foreign` (`pemesanan_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kasir_transactions`
--
ALTER TABLE `kasir_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kasir_transactions_pemesanan_id_foreign` (`pemesanan_id`);

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id_kategori_produk`);

--
-- Indexes for table `kitchen_orders`
--
ALTER TABLE `kitchen_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kitchen_orders_pemesanan_id_foreign` (`pemesanan_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

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
-- AUTO_INCREMENT for table `bar_orders`
--
ALTER TABLE `bar_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kasir_transactions`
--
ALTER TABLE `kasir_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id_kategori_produk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kitchen_orders`
--
ALTER TABLE `kitchen_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bar_orders`
--
ALTER TABLE `bar_orders`
  ADD CONSTRAINT `bar_orders_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanan` (`id_pemesanan`) ON DELETE CASCADE;

--
-- Constraints for table `kasir_transactions`
--
ALTER TABLE `kasir_transactions`
  ADD CONSTRAINT `kasir_transactions_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanan` (`id_pemesanan`) ON DELETE CASCADE;

--
-- Constraints for table `kitchen_orders`
--
ALTER TABLE `kitchen_orders`
  ADD CONSTRAINT `kitchen_orders_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanan` (`id_pemesanan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
