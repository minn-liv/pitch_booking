-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 11:41 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pitch_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_created` int(11) NOT NULL,
  `pitch_information_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `total` bigint(20) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT 0,
  `booking_status` int(11) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `user_created`, `pitch_information_id`, `note`, `total`, `payment_status`, `booking_status`, `date`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'note bla', 1000000, 0, 1, '2024-02-02', '08:00:00', '10:00:00', '2024-04-19 21:01:30', '2024-04-23 03:36:34'),
(2, 5, 1, 'note bla', 10000, 0, 0, '2024-02-02', '08:00:00', '10:00:00', '2024-04-19 21:09:36', '2024-04-19 21:09:36'),
(3, 4, 1, 'note bla', 10000, 0, 0, '2024-02-02', '08:00:00', '10:00:00', '2024-04-21 08:04:27', '2024-04-21 08:04:27'),
(4, 5, 3, 'note bla', 10000, 0, 0, '2024-02-02', '08:00:00', '10:00:00', '2024-04-25 02:33:20', '2024-04-25 02:33:20'),
(5, 5, 1, 'note bla', 10000, 0, 0, '2024-02-02', '08:00:00', '10:00:00', '2024-04-25 02:33:37', '2024-04-25 02:33:37');

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
-- Table structure for table `match`
--

CREATE TABLE `match` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `pitch_id` int(11) NOT NULL,
  `pitch_information_id` int(11) DEFAULT NULL,
  `note` text NOT NULL,
  `rules` text NOT NULL,
  `teams_numbers` int(11) NOT NULL,
  `match_status` int(11) NOT NULL,
  `duration` time NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `match`
--

INSERT INTO `match` (`id`, `created_by`, `pitch_id`, `pitch_information_id`, `note`, `rules`, `teams_numbers`, `match_status`, `duration`, `start_time`, `end_time`, `date`, `created_at`, `updated_at`) VALUES
(1, 4, 2, NULL, 'note lba bla', 'rules bl abla', 10, 0, '08:00:00', '09:00:00', '10:00:00', '2024-03-03', '2024-04-24 03:16:47', '2024-04-24 03:16:47'),
(2, 4, 2, NULL, 'note lba bla', 'rules bl abla', 10, 0, '08:00:00', '09:00:00', '10:00:00', '2024-03-03', '2024-04-24 03:19:42', '2024-04-24 03:19:42');

-- --------------------------------------------------------

--
-- Table structure for table `match_details`
--

CREATE TABLE `match_details` (
  `match_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
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
(19, '2014_10_12_000000_create_users_table', 1),
(20, '2014_10_12_100000_create_password_resets_table', 1),
(21, '2019_08_19_000000_create_failed_jobs_table', 1),
(22, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(23, '2024_03_25_133111_create_booking_table', 1),
(24, '2024_03_25_133112_create_pitch_table', 1),
(25, '2024_03_25_133114_create_match_table', 1),
(26, '2024_03_25_133115_create_pitch_information_table', 1),
(27, '2024_03_25_133116_create_match_details_table', 1),
(33, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(34, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(35, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(36, '2016_06_01_000004_create_oauth_clients_table', 2),
(37, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('12f52cae0da6eb02ac8de7b5259f79e2227528114419e46f2ae9309d533fd2cda26a51b6481e1d01', 5, '9be27e42-4f13-402a-94d9-b0809232f47b', 'client', '[]', 0, '2024-04-24 22:25:11', '2024-04-24 22:25:11', '2025-04-25 05:25:11'),
('51cdbd8a52394cbd6d91100af327b5c10b2568f2e43edb0ac6b6940fcd1a0065a88ec2b9fad56d9c', 6, '9be27e42-4f13-402a-94d9-b0809232f47b', 'client', '[]', 0, '2024-04-24 21:30:53', '2024-04-24 21:30:53', '2025-04-25 04:30:53'),
('6ced1614408b6a6bf478c3241bf88d69129d7169030709a394c721878251ea0cf71b950cd4294cb7', 5, '9be27e42-4f13-402a-94d9-b0809232f47b', 'client', '[]', 0, '2024-04-24 09:35:59', '2024-04-24 09:35:59', '2025-04-24 16:35:59'),
('76496ba655dff492f8be5eb6eab8fd9f3407f104c3440affc9657d3a8409031071b5272328112efc', 6, '9be27e42-4f13-402a-94d9-b0809232f47b', 'client', '[]', 0, '2024-04-24 08:03:03', '2024-04-24 08:03:03', '2025-04-24 15:03:03'),
('929a03e8e031820bc7b765b0c301b1d8366832410f2a34ebdcd24b5e5aaf7ea62eb0b2e9d06f265e', 5, '9be27e42-4f13-402a-94d9-b0809232f47b', 'client', '[]', 0, '2024-04-25 02:29:16', '2024-04-25 02:29:16', '2025-04-25 09:29:16'),
('aceb0377b2e1aa7b97ee4632018c0682ae33e6c8dd2a344a227c547fb42636cfd745e51c9748894b', 6, '9be27e42-4f13-402a-94d9-b0809232f47b', 'client', '[]', 0, '2024-04-24 08:07:14', '2024-04-24 08:07:14', '2025-04-24 15:07:14'),
('caea7f4843843603323c16edf1cec564d53fc4dcf15a9a07b779eeff1c240f958fec0df4b4812f6b', 6, '9be27e42-4f13-402a-94d9-b0809232f47b', 'client', '[]', 0, '2024-04-24 09:17:54', '2024-04-24 09:17:54', '2025-04-24 16:17:54');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` char(36) NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
('9be27e42-4f13-402a-94d9-b0809232f47b', NULL, 'Laravel Personal Access Client', 'Quz7FHoNNNJ6q5CgnLeL80UT5EaoWJd2dtKDHRuJ', NULL, 'http://localhost', 1, 0, 0, '2024-04-24 08:00:31', '2024-04-24 08:00:31'),
('9be27e42-52f8-4711-9e51-332af3baab5d', NULL, 'Laravel Password Grant Client', 'GownVCFgU2RRIuatbgfBcKyvHLGztf52tRUR64OS', 'users', 'http://localhost', 0, 1, 0, '2024-04-24 08:00:31', '2024-04-24 08:00:31');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, '9be27e42-4f13-402a-94d9-b0809232f47b', '2024-04-24 08:00:31', '2024-04-24 08:00:31');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 4, 'tony', '3b02f9abc10443eb105cd9c00726338f3a5c43d470bfb2f905cc25c28c6523f3', '[\"*\"]', NULL, '2024-04-24 03:42:33', '2024-04-24 03:42:33'),
(2, 'App\\Models\\User', 4, 'tony', '4c45092b6fe082fe9feec1c244246adf74815c44ca81bdaf91f92077256aa872', '[\"*\"]', NULL, '2024-04-24 03:45:19', '2024-04-24 03:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `pitch`
--

CREATE TABLE `pitch` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `hotline` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `host_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pitch`
--

INSERT INTO `pitch` (`id`, `name`, `address`, `hotline`, `description`, `image`, `longitude`, `latitude`, `host_by`, `created_at`, `updated_at`) VALUES
(5, 'Sân Thủ Đức', 'Phường Bình Chiểu, Thủ Đức', '19001811', 'Sân bóng đá từ 5 đến 8 người', NULL, NULL, NULL, 6, '2024-04-24 22:24:04', '2024-04-24 22:26:55'),
(6, 'Sân Quận 9', 'Xa lộ Hà Nội Quận 9', '19001811', 'Sân bóng đá từ 7 đến 10 người', NULL, NULL, NULL, 6, '2024-04-24 22:25:43', '2024-04-24 22:25:43');

-- --------------------------------------------------------

--
-- Table structure for table `pitch_information`
--

CREATE TABLE `pitch_information` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `pitch_type` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `pitch_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pitch_information`
--

INSERT INTO `pitch_information` (`id`, `name`, `pitch_type`, `price`, `pitch_id`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(3, 'Sân 5', 'Sân 5 đến 7 người', 70000, 5, '08:00:00', '10:00:00', '2024-04-24 22:49:52', '2024-04-25 01:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `latitude` decimal(8,2) DEFAULT NULL,
  `longitude` decimal(8,2) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `dob`, `address`, `phone`, `user_type`, `latitude`, `longitude`, `avatar`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'minhy09', '$2y$10$9Pwk.z1gBxZZrdqI.8JmyOVy8O6LJI8A.T8CTBTeLlA2n/xLfO.8O', 'Minh', '2002-02-02', 'Chung Cu TDH', '0354147718', 'admin', NULL, NULL, NULL, 1, NULL, '2024-04-15 07:33:47', '2024-04-15 07:33:47'),
(5, 'user', '$2y$10$jkEcdYjMIzJtWpYtI4fcz.c/k5Xr2XQChAZy4uY63Wb3/ok3JuJKC', 'user', '2002-02-02', 'Chung Cu TDH', '0354147718', 'user', NULL, NULL, NULL, 1, NULL, '2024-04-18 02:13:42', '2024-04-18 02:13:42'),
(6, 'admin', '$2y$10$pCfc/0P45CEVElth0DCX4OizXf2DyVC93rs9i73tw3FYAYpibD1E2', 'admin', '2002-03-02', 'Chung Cu TDH', '0354147718', 'host', NULL, NULL, NULL, 1, NULL, '2024-04-24 06:12:43', '2024-04-24 06:12:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `match`
--
ALTER TABLE `match`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `match_details`
--
ALTER TABLE `match_details`
  ADD PRIMARY KEY (`match_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pitch`
--
ALTER TABLE `pitch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pitch_information`
--
ALTER TABLE `pitch_information`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `match`
--
ALTER TABLE `match`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `match_details`
--
ALTER TABLE `match_details`
  MODIFY `match_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pitch`
--
ALTER TABLE `pitch`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pitch_information`
--
ALTER TABLE `pitch_information`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
