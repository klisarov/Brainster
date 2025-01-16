-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 08, 2025 at 05:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brainster_labs`
--

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
(1, '0001_01_01_000000_create_projects_table', 1),
(2, '0001_01_01_000000_create_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `subtitle`, `image`, `url`, `description`, `created_at`, `updated_at`) VALUES
(9, '10 кобни грешки што можат да ти ја уништат кариерата како програмер!', 'Дознај кои се најчестите стапици во кои паѓаат и искусните програмери (и како да ги избегнеш)', 'https://www.epitech-it.es/wp-content/uploads/2022/07/danial-igdery-FCHlYvR5gJI-unsplash.jpg', 'http://example.com', 'Во светот на програмирањето, една мала грешка може да доведе до големи последици. Без разлика дали си почетник или искусен програмер, овие критични грешки демнат во секој проект.', '2025-01-05 14:36:42', '2025-01-05 14:36:42'),
(10, 'Дали PHP е \"скриениот џокер\"? 🤔', 'Изненадувачката вистина за јазикот што се држи цврсто после толку години!', 'https://media.licdn.com/dms/image/sync/v2/D4E27AQGGgPAhDpFiZg/articleshare-shrink_800/articleshare-shrink_800/0/1728737610843?e=2147483647&v=beta&t=wjADNzEa7wF9-JmcJVandOzZ8fOWupKjDVnCdvVuIdo', 'https://example.com', 'PHP тивко продолжува да поддржува 77% од веб страните во светот. Дали овој \"застарен\" јазик всушност има тајна супермоќ што другите ја немаат?', '2025-01-05 14:42:51', '2025-01-05 14:42:51'),
(12, 'Тест Картичка', 'Test', 'https://fastly.picsum.photos/id/142/536/354.jpg?hmac=6yyeLsSzkdNr0fHUb-cSvU98ueoNysWIltjdgq4rMoc', 'https://example.com', 'Test картичка', '2025-01-08 14:14:30', '2025-01-08 14:14:30'),
(13, 'Test2', 'Test2', 'https://fastly.picsum.photos/id/441/536/354.jpg?hmac=qHaUqO3vqlz-C811TXJPtRw-FV4ciRCazlDZb1gdodg', 'https://example.com', 'test2', '2025-01-08 14:41:04', '2025-01-08 14:41:04');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('f0RixZBgFgMBs6UGWaDTiHbCo8Z6vNZyhJf150BP', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiakVhdnY2RGtUMWE3NTlrMHVCODVRU2NGUjVoM0hydVJZVDRnY3ExSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6OToibG9nZ2VkX2luIjtiOjE7czo3OiJlZGl0aW5nIjtzOjI6IjEzIjt9', 1736352147);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin@brainster.com', '$2y$10$BH4X.ixfYgoOhjpyVoU2HOh1TKbqDFJ0MB2XPHxvhdq4NbqdpdKTG', '2025-01-05 14:05:44', '2025-01-05 14:05:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
