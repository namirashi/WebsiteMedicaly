-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2026 at 04:25 PM
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
-- Database: `medicaly`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetLowStockProducts` (IN `threshold` INT)   BEGIN
 SELECT p.id, p.name, p.stock, c.name AS category
 FROM products p JOIN categories c ON p.category_id=c.id
 WHERE p.stock < threshold AND p.is_active=1
 ORDER BY p.stock ASC;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `GetProductSalesTotal` (`product_id_param` INT) RETURNS DECIMAL(15,2) READS SQL DATA BEGIN
 DECLARE total DECIMAL(15,2) DEFAULT 0;

 SELECT IFNULL(SUM(oi.price*oi.quantity),0) INTO total
 FROM order_items oi 
 JOIN orders o ON oi.order_id=o.id
 WHERE oi.product_id=product_id_param AND o.status='delivered';

 RETURN total;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(16, 5, 24, 1, '2026-04-19 22:34:30', '2026-04-19 22:34:30');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Vitamin & Suplemen', 'vitamin-suplemen', 'capsule', '2026-04-05 08:22:47', '2026-04-05 08:22:47'),
(2, 'Obat Bebas', 'obat-bebas', 'heart-pulse', '2026-04-05 08:22:47', '2026-04-05 08:22:47'),
(3, 'Perawatan Tubuh', 'perawatan-tubuh', 'droplet', '2026-04-05 08:22:47', '2026-04-05 08:22:47'),
(4, 'Alat Kesehatan', 'alat-kesehatan', 'thermometer', '2026-04-05 08:22:47', '2026-04-05 08:22:47'),
(5, 'Ibu & Anak', 'ibu-anak', 'person-hearts', '2026-04-05 08:22:47', '2026-04-05 08:22:47'),
(6, 'Herbal', 'herbal', 'flower1', '2026-04-05 08:22:47', '2026-04-05 08:22:47');

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
(4, '2026_04_05_035334_create_categories_table', 1),
(5, '2026_04_05_035358_create_products_table', 1),
(6, '2026_04_05_035513_create_orders_table', 1),
(7, '2026_04_05_035532_create_order_items_table', 1),
(8, '2026_04_05_035615_create_reviews_table', 1),
(9, '2026_04_05_035626_create_carts_table', 1),
(10, '2026_04_05_035636_create_notifications_table', 1),
(11, '2026_04_05_035644_create_system_logs_table', 1),
(12, '2026_04_05_040430_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('00a79710-84a9-443f-9eff-987aca6c014c', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 1, '{\"order_number\":\"MED-ZQVNE9MT\",\"status\":\"pending\",\"total\":350000}', NULL, '2026-04-18 02:58:38', '2026-04-18 02:58:38'),
('1480a327-34a0-4494-94c2-a38e5c350416', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 5, '{\"order_number\":\"MED-4NCZABYT\",\"status\":\"shipped\",\"total\":\"115000.00\"}', NULL, '2026-04-19 21:41:05', '2026-04-19 21:41:05'),
('2220a9d5-1869-42f0-b62a-a8021dd840ec', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 4, '{\"order_number\":\"MED-JKEIK4FI\",\"status\":\"pending\",\"total\":0}', NULL, '2026-04-17 19:32:33', '2026-04-17 19:32:33'),
('24b81a2c-5a69-4229-8f89-79373eaf0f2e', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 1, '{\"order_number\":\"MED-ZQVNE9MT\",\"status\":\"delivered\",\"total\":\"350000.00\"}', NULL, '2026-04-18 03:00:04', '2026-04-18 03:00:04'),
('26619c19-4a58-4643-b6a5-abf9d084bbf5', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 5, '{\"order_number\":\"MED-4NCZABYT\",\"status\":\"pending\",\"total\":115000}', NULL, '2026-04-19 21:40:36', '2026-04-19 21:40:36'),
('2c820346-8142-4c10-ba67-c7eb1400576f', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 3, '{\"order_number\":\"MED-ZWS3GWOI\",\"status\":\"delivered\",\"total\":\"48000.00\"}', NULL, '2026-04-11 06:58:21', '2026-04-11 06:58:21'),
('4348ebe1-cb64-4a06-b1b9-992c3e6d3f66', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 5, '{\"order_number\":\"MED-4NCZABYT\",\"status\":\"delivered\",\"total\":\"115000.00\"}', NULL, '2026-04-19 21:42:39', '2026-04-19 21:42:39'),
('4b8983c5-23a2-469f-9b5a-3f22ed2018dd', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 3, '{\"order_number\":\"MED-1SKYRRRL\",\"status\":\"pending\",\"total\":143000}', NULL, '2026-04-06 04:59:36', '2026-04-06 04:59:36'),
('5b14f9e0-a1f0-4b30-9860-bfedf1ded131', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 1, '{\"order_number\":\"MED-ZQVNE9MT\",\"status\":\"shipped\",\"total\":\"350000.00\"}', NULL, '2026-04-18 03:00:01', '2026-04-18 03:00:01'),
('606ea9d4-f7b6-4531-9a2d-8e18cabd996a', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 3, '{\"order_number\":\"MED-JGB6FOGQ\",\"status\":\"cancelled\",\"total\":\"38000.00\"}', NULL, '2026-04-11 06:41:59', '2026-04-11 06:41:59'),
('8fcd4ee5-fa20-489b-844e-65510f1a0beb', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 3, '{\"order_number\":\"MED-CC78ITXE\",\"status\":\"pending\",\"total\":38000}', NULL, '2026-04-06 04:58:48', '2026-04-06 04:58:48'),
('924cad94-79c0-4d6c-9ef7-26abfaaaf3a7', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 4, '{\"order_number\":\"MED-M5FCTTJK\",\"status\":\"delivered\",\"total\":\"143000.00\"}', NULL, '2026-04-17 19:36:05', '2026-04-17 19:36:05'),
('944975b4-93b8-4236-bc45-3de18660c3bd', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 3, '{\"order_number\":\"MED-YTEBFIPB\",\"status\":\"delivered\",\"total\":\"38000.00\"}', NULL, '2026-04-11 06:41:54', '2026-04-11 06:41:54'),
('aa897825-d374-4648-b74f-05f731e9605b', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 4, '{\"order_number\":\"MED-JKEIK4FI\",\"status\":\"cancelled\",\"total\":\"0.00\"}', NULL, '2026-04-17 19:37:46', '2026-04-17 19:37:46'),
('b502db1e-baf7-49da-8e23-586c9665950a', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 3, '{\"order_number\":\"MED-CC78ITXE\",\"status\":\"shipped\",\"total\":\"38000.00\"}', NULL, '2026-04-11 06:41:49', '2026-04-11 06:41:49'),
('b64fa5e6-7b67-45d2-90de-f37580ff0791', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 6, '{\"order_number\":\"MED-IUNL1JYK\",\"status\":\"shipped\",\"total\":\"55000.00\"}', NULL, '2026-04-20 06:46:55', '2026-04-20 06:46:55'),
('b6c6304b-2e25-4a3f-9833-8fd2834ef2c9', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 3, '{\"order_number\":\"MED-1SKYRRRL\",\"status\":\"processing\",\"total\":\"143000.00\"}', NULL, '2026-04-11 06:23:45', '2026-04-11 06:23:45'),
('d1c41d4e-4c59-44c9-a2a9-e3698a87b92b', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 6, '{\"order_number\":\"MED-VXMRHRZR\",\"status\":\"pending\",\"total\":40003}', NULL, '2026-04-20 00:40:24', '2026-04-20 00:40:24'),
('d605722c-1723-44fb-a1ff-82728c6462e4', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 3, '{\"order_number\":\"MED-GJ4OFEFD\",\"status\":\"cancelled\",\"total\":\"38000.00\"}', NULL, '2026-04-11 06:58:15', '2026-04-11 06:58:15'),
('e332b1b9-1238-4a62-8c93-35ad216c1164', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 3, '{\"order_number\":\"MED-ZWS3GWOI\",\"status\":\"pending\",\"total\":48000}', NULL, '2026-04-11 06:56:27', '2026-04-11 06:56:27'),
('eaa0be02-36ee-419d-9be6-704e0f686630', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 4, '{\"order_number\":\"MED-M5FCTTJK\",\"status\":\"pending\",\"total\":143000}', NULL, '2026-04-17 19:32:33', '2026-04-17 19:32:33'),
('eecb41e8-5451-4d9f-87c8-dde701ab7d27', 'App\\Notifications\\OrderPlaced', 'App\\Models\\User', 6, '{\"order_number\":\"MED-VXMRHRZR\",\"status\":\"delivered\",\"total\":\"40003.00\"}', NULL, '2026-04-20 06:46:57', '2026-04-20 06:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `status` enum('pending','processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `total_amount` decimal(15,2) NOT NULL,
  `shipping_address` text NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_number`, `status`, `total_amount`, `shipping_address`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 3, 'MED-JGB6FOGQ', 'cancelled', 38000.00, 'Jipang', 'dompet_digital', '2026-04-06 04:53:58', '2026-04-11 06:41:59'),
(2, 3, 'MED-YTEBFIPB', 'delivered', 38000.00, 'Jipang', 'transfer_bank', '2026-04-06 04:54:35', '2026-04-11 06:41:54'),
(3, 3, 'MED-GJ4OFEFD', 'cancelled', 38000.00, 'Jipang', 'cod', '2026-04-06 04:55:00', '2026-04-11 06:58:15'),
(4, 3, 'MED-CC78ITXE', 'shipped', 38000.00, 'Jipang', 'cod', '2026-04-06 04:58:48', '2026-04-11 06:41:49'),
(5, 3, 'MED-1SKYRRRL', 'processing', 143000.00, 'jipang', 'dompet_digital', '2026-04-06 04:59:36', '2026-04-11 06:23:45'),
(6, 3, 'MED-ZWS3GWOI', 'delivered', 48000.00, 'Purwokerto', 'transfer_bank', '2026-04-11 06:56:27', '2026-04-11 06:58:21'),
(7, 4, 'MED-M5FCTTJK', 'delivered', 143000.00, 'Tendean', 'cod', '2026-04-17 19:32:32', '2026-04-17 19:36:05'),
(8, 4, 'MED-JKEIK4FI', 'cancelled', 0.00, 'Tendean', 'cod', '2026-04-17 19:32:33', '2026-04-17 19:37:46'),
(9, 1, 'MED-ZQVNE9MT', 'delivered', 350000.00, 'Ajibarang', 'dompet_digital', '2026-04-18 02:58:38', '2026-04-18 03:00:04'),
(10, 5, 'MED-4NCZABYT', 'delivered', 115000.00, 'Kediri', 'cod', '2026-04-19 21:40:35', '2026-04-19 21:42:39'),
(11, 6, 'MED-VXMRHRZR', 'delivered', 40003.00, 'Depok', 'transfer_bank', '2026-04-20 00:40:24', '2026-04-20 06:46:57'),
(12, 6, 'MED-IUNL1JYK', 'shipped', 55000.00, 'Bandung', 'transfer_bank', '2026-04-20 06:46:24', '2026-04-20 06:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 4, 20, 1, 38000.00, '2026-04-06 04:58:48', '2026-04-06 04:58:48'),
(2, 5, 21, 1, 18000.00, '2026-04-06 04:59:36', '2026-04-06 04:59:36'),
(3, 5, 1, 1, 125000.00, '2026-04-06 04:59:36', '2026-04-06 04:59:36'),
(4, 6, 5, 1, 48000.00, '2026-04-11 06:56:27', '2026-04-11 06:56:27'),
(5, 7, 1, 1, 125000.00, '2026-04-17 19:32:32', '2026-04-17 19:32:32'),
(6, 7, 21, 1, 18000.00, '2026-04-17 19:32:32', '2026-04-17 19:32:32'),
(7, 9, 14, 1, 350000.00, '2026-04-18 02:58:38', '2026-04-18 02:58:38'),
(8, 10, 6, 1, 95000.00, '2026-04-19 21:40:36', '2026-04-19 21:40:36'),
(9, 10, 12, 1, 20000.00, '2026-04-19 21:40:36', '2026-04-19 21:40:36'),
(10, 11, 20, 1, 5003.00, '2026-04-20 00:40:24', '2026-04-20 00:40:24'),
(11, 11, 3, 1, 35000.00, '2026-04-20 00:40:24', '2026-04-20 00:40:24'),
(12, 12, 4, 1, 55000.00, '2026-04-20 06:46:24', '2026-04-20 06:46:24');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `unit` varchar(255) NOT NULL DEFAULT 'Botol',
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `price`, `stock`, `unit`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Blackmores BIO D3 1000 IU', 'blackmores-bio-d3-1000-iu-69d27e47e1fe9', 'Blackmores Vitamin D3 1000 IU untuk memenuhi kebutuhan Vitamin D harian. Mendukung kesehatan tulang, gigi, dan sistem imun.', 125000.00, 0, 'Botol / 60 Kapsul', 'products/IuTZBXjqJsM9shaBWx5DtOOolpDcViTKnarrbCa2.jpg', 1, '2026-04-05 08:22:47', '2026-04-17 19:32:32'),
(2, 1, 'Scott\'s Emulsion Cod Liver Oil', 'scotts-emulsion-cod-liver-oil-69d27e47e3891', 'Minyak ikan cod kaya Omega-3, Vitamin A dan D untuk pertumbuhan anak.', 65000.00, 80, 'Botol / 200ml', 'products/ROhf1TRNR3cNTGUvDySoEYcxsqNRCpPUVOl0P32B.webp', 1, '2026-04-05 08:22:47', '2026-04-11 06:28:48'),
(3, 1, 'Vitacimin Vitamin C 500mg', 'vitacimin-vitamin-c-500mg-69d27e47e454f', 'Suplemen Vitamin C 500mg untuk menjaga daya tahan tubuh dan antioksidan.', 35000.00, 119, 'Strip / 10 Tablet', 'products/gGlxR2qsqYXEBkQT7fhfqSieXL0tEkKngVUdSm0M.jpg', 1, '2026-04-05 08:22:47', '2026-04-20 00:40:24'),
(4, 1, 'Natur-E Advanced 100 IU', 'natur-e-advanced-100-iu-69d27e47e527f', 'Vitamin E alami untuk menjaga kesehatan kulit dan antioksidan tubuh.', 55000.00, 59, 'Botol / 60 Kapsul', 'products/617hfOsV9GEwpT34Z2XhZzvELKFmp0Wk6LDgpyfQ.jpg', 1, '2026-04-05 08:22:47', '2026-04-20 06:46:24'),
(5, 1, 'Enervon-C Multivitamin', 'enervon-c-multivitamin-69d27e47e5e96', 'Kombinasi Vitamin C, B kompleks untuk energi dan imun tubuh.', 48000.00, 99, 'Botol / 30 Tablet', 'products/O6cSh7OdMnLODFeOkw2kflgiWvf6EMlF31EGBMte.jpg', 1, '2026-04-05 08:22:47', '2026-04-11 06:56:27'),
(6, 1, 'Omega-3 Fish Oil 1000mg', 'omega-3-fish-oil-1000mg-69d27e47e750b', 'Asam lemak Omega-3 EPA dan DHA untuk kesehatan jantung dan otak.', 95000.00, 44, 'Botol / 30 Softgel', 'products/JfhEO5Ez0CLJ33tvCvEfanRNCAMfEpqMttI9MyBR.avif', 1, '2026-04-05 08:22:47', '2026-04-19 21:40:36'),
(7, 2, 'Paracetamol 500mg', 'paracetamol-500mg-69d27e47e8276', 'Analgetik-antipiretik untuk meringankan demam dan nyeri ringan.', 12000.00, 200, 'Kaplet/ 10 Tablet', 'products/kyo0jpjQDwPNF5XVbDkCS7qzKKaWJ3NtmLwr7ZJ1.jpg', 1, '2026-04-05 08:22:47', '2026-04-11 06:32:39'),
(8, 2, 'Antangin JRG Jahe Madu', 'antangin-jrg-jahe-madu-69d27e47e8e50', 'Obat masuk angin dengan jahe dan madu alami, menghangatkan tubuh.', 18000.00, 90, 'Sachet isi 12', 'products/7J8o9BO6CxEg1pWbJSX2lp3GM53EjrapTVYN1RGT.jpg', 1, '2026-04-05 08:22:47', '2026-04-11 06:35:10'),
(9, 2, 'OBH Combi Batuk Berdahak', 'obh-combi-batuk-berdahak-69d27e47e9b6b', 'Sirup untuk meredakan batuk berdahak dengan rasa mint yang menyegarkan.', 28000.00, 70, 'Botol / 60ml', 'products/fIvRuqoOPC3X5xCxtbUX45BRojg48HykDwHqOGUB.webp', 1, '2026-04-05 08:22:47', '2026-04-11 06:35:21'),
(10, 2, 'Promag Tablet', 'promag-tablet-69d27e47ea942', 'Antasida untuk meredakan nyeri lambung dan maag.', 15000.00, 150, 'Strip / 10 Tablet', 'products/epICOYOw91hz3Iz1anIrhcTpcjEU1wnxnTtq2N1I.webp', 1, '2026-04-05 08:22:47', '2026-04-11 06:35:32'),
(11, 2, 'Ibuprofen 400mg', 'ibuprofen-400mg-69d27e47eb554', 'NSAID untuk meredakan nyeri sedang, demam, dan peradangan.', 22000.00, 3, 'Strip / 10 Tablet', 'products/r4Otw66A1MT0Vcs8F6lqDU6oWmUaXgSpMyDudcMr.avif', 1, '2026-04-05 08:22:47', '2026-04-11 06:35:45'),
(12, 3, 'Betadine Antiseptik 30ml', 'betadine-antiseptik-30ml-69d27e47ec306', 'Antiseptik povidone-iodine untuk membersihkan luka dan mencegah infeksi.', 20000.00, 109, 'Botol 30ml', 'products/ih6tY33nDnBu6JKO1pKmX3YOrqBWrVcyVceDOcJg.webp', 1, '2026-04-05 08:22:47', '2026-04-19 21:40:36'),
(13, 3, 'Hansaplast Plester 20pcs', 'hansaplast-plester-20pcs-69d27e47ed2c5', 'Plester steril untuk perawatan luka kecil sehari-hari.', 18500.00, 85, 'Pack / 20pcs', 'products/yK8V1wSHKe5bgrBRdxOHQcew2ftaczW0XOLufzPI.webp', 1, '2026-04-05 08:22:47', '2026-04-11 06:36:29'),
(14, 4, 'Tensimeter Digital Omron', 'tensimeter-digital-omron-69d27e47ee14e', 'Alat pengukur tekanan darah digital otomatis dengan layar LCD.', 350000.00, 14, 'Unit', 'products/D944CjRlExnWas7xssf1KcWJHIZjwRBLuSRgUj1t.jpg', 1, '2026-04-05 08:22:47', '2026-04-18 02:58:38'),
(15, 4, 'Termometer Digital', 'termometer-digital-69d27e47ef068', 'Termometer digital akurat untuk mengukur suhu tubuh dalam hitungan detik.', 45000.00, 40, 'Unit', 'products/RtzMPlfUjceE8uNde8bVEbpyaCV9EztH5VdJpxmn.jpg', 1, '2026-04-05 08:22:47', '2026-04-11 06:39:52'),
(16, 4, 'Masker Medis 3-ply 50pcs', 'masker-medis-3-ply-50pcs-69d27e47eff64', 'Masker medis 3 lapisan untuk perlindungan pernapasan.', 35000.00, 200, 'Box / 50pcs', 'products/izV0dN7rjxE3aZWlg6xGeZyuZqMwTRhJ239mUjtI.jpg', 1, '2026-04-05 08:22:47', '2026-04-11 06:40:15'),
(17, 5, 'Sangobion Kapsul', 'sangobion-kapsul-69d27e47f0e9c', 'Suplemen zat besi untuk ibu hamil dan menyusui, mencegah anemia.', 42000.00, 65, 'Botol / 30 Kapsul', 'products/J6vCfUOncEXlfhFcCBSi6kWVhApNiQmybumG1kbe.jpg', 1, '2026-04-05 08:22:47', '2026-04-11 06:40:28'),
(18, 5, 'Prenagen Mommy Vanilla', 'prenagen-mommy-vanilla-69d27e47f216e', 'Susu ibu hamil dan menyusui kaya DHA, asam folat, dan kalsium.', 95000.00, 35, 'Kotak / 400g', 'products/Eq4PPDoGZoQzr6MWKk5NA8kiNOae1jFUN5XyKJyj.jpg', 1, '2026-04-05 08:22:47', '2026-04-11 06:40:42'),
(19, 6, 'Tolak Angin Sido Muncul', 'tolak-angin-sido-muncul-69d27e47f3200', 'Jamu herbal tradisional untuk mengatasi masuk angin dan perut kembung.', 22000.00, 130, 'Box / 12 Sachet', 'products/KnWIzqOe6I88AwAcxeygKTv3dusYC5ybbPCOEA4d.avif', 1, '2026-04-05 08:22:47', '2026-04-11 06:40:57'),
(20, 2, 'Intunal-F', 'temulawak-kapsul-69d27e47f418d', 'Intunal F adalah obat bebas terbatas yang digunakan untuk meredakan gejala flu seperti demam, sakit kepala, hidung tersumbat, dan batuk.', 5003.00, 75, 'Strip /  4 Tablet', 'products/g7a7znEw5oVie0wuARLkbbI4peAcMEMwNYyjYvGo.jpg', 1, '2026-04-05 08:22:48', '2026-04-20 00:40:24'),
(21, 6, 'Kunyit Asam Herbal', 'kunyit-asam-herbal-69d27e4800e4a', 'Minuman herbal kunyit asam untuk meredakan nyeri haid dan melancarkan pencernaan.', 18000.00, 19, 'Botol / 150ml', 'products/XLjahyC1pWGklcoJjkfCsmf0ybqTqvoutLIGxJ5I.png', 1, '2026-04-05 08:22:48', '2026-04-17 19:32:32'),
(22, 2, 'Avil 25 mg', 'avil-25-mg-69e360e18469e', 'Antihistamin untuk alergi', 15000.00, 50, 'Tablet', 'products/qpqtMNWgvLAf2A8wIAyesM7ntZc5qTPerrsuZrT8.jpg', 1, '2026-04-18 03:45:53', '2026-04-20 06:48:01'),
(23, 2, 'Ventolin 2 mg', 'ventolin-2-mg-69e360e1874dd', 'Obat untuk asma dan sesak napas', 20000.00, 40, 'Tablet', 'products/Oqus3oDjKuemIM3uNWcd1IHUN0az6YtzslmQohtD.webp', 1, '2026-04-18 03:45:53', '2026-04-20 06:48:21'),
(24, 2, 'Vosedon 10 mg', 'vosedon-10-mg-69e360e188262', 'Obat anti mual', 18000.00, 30, 'Tablet', 'products/MQdCEtZ7kT1O2wHzTHH7vGmW9HKyg0vcZX4dBuOS.jpg', 1, '2026-04-18 03:45:53', '2026-04-18 03:49:06');

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `after_product_stock_update` AFTER UPDATE ON `products` FOR EACH ROW BEGIN
 IF NEW.stock != OLD.stock THEN
 INSERT INTO system_logs(level,message,ip_address,created_at,updated_at)
 VALUES(
 IF(NEW.stock=0,'warning','info'),
 CONCAT('Stok [',NEW.name,'] berubah: ',OLD.stock,' -> ',NEW.stock),
 '127.0.0.1', NOW(), NOW()
 );
 END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 4, 'Pengiriman cepat dan barang aman', '2026-04-18 01:48:22', '2026-04-18 01:48:22');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('8L8shLW8oq1REnMY3IL6yDDFQyzaRdJJCsDeVd6g', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNU83R0c1c0FRN09yRjdTbmRDcVJ2eGlFR0Voa2pjVWN1UG01c1lEZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9wcm9kdWN0cy9sb3ctc3RvY2stc3AiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776690692),
('hPLbdqM5pwi87wZmFKaCGYqKrJ5W4ChjS329YcQD', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYjBSMnZITzRHeGtmZ0Y0MHVrMU5jbHRYS0tHMGw0OVY3bExKdVlpRyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0LWNvdW50IjtzOjU6InJvdXRlIjtOO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2O30=', 1776674486),
('RLSeuxBOW6sKJZ6bu33kX2gUPQI7VoCHG5Dxacdi', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidHdmOW9peEYwaDhNSHVPb05ETlNJUmIwUzNPbXZuUEdYUWNKRldNNiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wcm9kdWN0cyI7czo1OiJyb3V0ZSI7czoyMDoiYWRtaW4ucHJvZHVjdHMuaW5kZXgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1776692902),
('vZrZMiLD5lfsywga0ANIN5lah0bBcJ0XXCOMJQ5F', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTkFUcDBYTWJVYXpCcWcwSlM2amNEN2NiV0FDTGJNRFRaT1FhbzlrcSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776670737);

-- --------------------------------------------------------

--
-- Table structure for table `system_logs`
--

CREATE TABLE `system_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `context` text DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_logs`
--

INSERT INTO `system_logs` (`id`, `level`, `message`, `context`, `ip_address`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'info', 'User login: admin', NULL, '127.0.0.1', 1, '2026-04-05 08:23:13', '2026-04-05 08:23:13'),
(2, 'info', 'User login: admin', NULL, '127.0.0.1', 1, '2026-04-05 20:56:14', '2026-04-05 20:56:14'),
(3, 'info', 'User login: Namira', NULL, '127.0.0.1', 3, '2026-04-06 04:35:49', '2026-04-06 04:35:49'),
(4, 'info', 'User login: admin', NULL, '127.0.0.1', 1, '2026-04-06 04:59:52', '2026-04-06 04:59:52'),
(5, 'info', 'User login: admin', NULL, '127.0.0.1', 1, '2026-04-11 06:23:30', '2026-04-11 06:23:30'),
(6, 'info', 'Order MED-1SKYRRRL status: pending → processing', NULL, '127.0.0.1', 1, '2026-04-11 06:23:45', '2026-04-11 06:23:45'),
(7, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-11 06:23:54', '2026-04-11 06:23:54'),
(8, 'info', 'Order MED-CC78ITXE status: pending → shipped', NULL, '127.0.0.1', 1, '2026-04-11 06:41:49', '2026-04-11 06:41:49'),
(9, 'info', 'Order MED-YTEBFIPB status: pending → delivered', NULL, '127.0.0.1', 1, '2026-04-11 06:41:54', '2026-04-11 06:41:54'),
(10, 'info', 'Order MED-JGB6FOGQ status: pending → cancelled', NULL, '127.0.0.1', 1, '2026-04-11 06:41:59', '2026-04-11 06:41:59'),
(11, 'info', 'User login: Namira', NULL, '127.0.0.1', 3, '2026-04-11 06:43:49', '2026-04-11 06:43:49'),
(12, 'info', 'User login: admin', NULL, '127.0.0.1', 1, '2026-04-11 06:57:00', '2026-04-11 06:57:00'),
(13, 'info', 'Order MED-GJ4OFEFD status: pending → cancelled', NULL, '127.0.0.1', 1, '2026-04-11 06:58:15', '2026-04-11 06:58:15'),
(14, 'info', 'Order MED-ZWS3GWOI status: pending → delivered', NULL, '127.0.0.1', 1, '2026-04-11 06:58:21', '2026-04-11 06:58:21'),
(15, 'info', 'User login: Namira', NULL, '127.0.0.1', 3, '2026-04-11 07:13:45', '2026-04-11 07:13:45'),
(16, 'info', 'User login: admin', NULL, '127.0.0.1', 1, '2026-04-13 06:06:42', '2026-04-13 06:06:42'),
(17, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-13 06:06:59', '2026-04-13 06:06:59'),
(18, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-13 06:07:31', '2026-04-13 06:07:31'),
(19, 'info', 'User login: admin', NULL, '127.0.0.1', 1, '2026-04-15 03:54:39', '2026-04-15 03:54:39'),
(20, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-15 05:08:07', '2026-04-15 05:08:07'),
(21, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-15 05:08:47', '2026-04-15 05:08:47'),
(22, 'info', 'User login: admin', NULL, '127.0.0.1', 1, '2026-04-16 02:28:09', '2026-04-16 02:28:09'),
(23, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-16 02:50:22', '2026-04-16 02:50:22'),
(24, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-16 02:50:54', '2026-04-16 02:50:54'),
(25, 'info', 'User login: admin', NULL, '127.0.0.1', 1, '2026-04-17 05:49:14', '2026-04-17 05:49:14'),
(26, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-17 05:49:25', '2026-04-17 05:49:25'),
(27, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-17 05:49:56', '2026-04-17 05:49:56'),
(28, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-17 05:50:27', '2026-04-17 05:50:27'),
(29, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-17 05:50:58', '2026-04-17 05:50:58'),
(30, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-17 05:51:30', '2026-04-17 05:51:30'),
(31, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-17 05:51:47', '2026-04-17 05:51:47'),
(32, 'info', 'User login: admin', NULL, '127.0.0.1', 1, '2026-04-17 06:11:09', '2026-04-17 06:11:09'),
(33, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-17 06:11:16', '2026-04-17 06:11:16'),
(34, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-17 06:11:48', '2026-04-17 06:11:48'),
(35, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-17 06:12:19', '2026-04-17 06:12:19'),
(36, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-17 06:12:50', '2026-04-17 06:12:50'),
(37, 'info', 'User login: Naura', NULL, '127.0.0.1', 4, '2026-04-17 06:13:18', '2026-04-17 06:13:18'),
(38, 'info', 'User login: Naura', NULL, '127.0.0.1', 4, '2026-04-17 19:31:53', '2026-04-17 19:31:53'),
(39, 'info', 'User login: admin', NULL, '127.0.0.1', 1, '2026-04-17 19:33:02', '2026-04-17 19:33:02'),
(40, 'info', 'Order MED-M5FCTTJK status: pending → delivered', NULL, '127.0.0.1', 1, '2026-04-17 19:36:05', '2026-04-17 19:36:05'),
(41, 'info', 'User login: Naura', NULL, '127.0.0.1', 4, '2026-04-17 19:36:37', '2026-04-17 19:36:37'),
(42, 'info', 'User login: admin', NULL, '127.0.0.1', 1, '2026-04-17 19:37:37', '2026-04-17 19:37:37'),
(43, 'info', 'Order MED-JKEIK4FI status: pending → cancelled', NULL, '127.0.0.1', 1, '2026-04-17 19:37:46', '2026-04-17 19:37:46'),
(44, 'info', 'User login: Naura', NULL, '127.0.0.1', 4, '2026-04-17 19:38:52', '2026-04-17 19:38:52'),
(45, 'info', 'User login: Naura', NULL, '127.0.0.1', 4, '2026-04-18 01:47:39', '2026-04-18 01:47:39'),
(46, 'info', 'User login: admin', NULL, '127.0.0.1', 1, '2026-04-18 01:55:50', '2026-04-18 01:55:50'),
(47, 'info', 'User login: admin', NULL, '127.0.0.1', 1, '2026-04-18 02:21:32', '2026-04-18 02:21:32'),
(48, 'info', 'Export pesanan PDF (8 data)', NULL, '127.0.0.1', 1, '2026-04-18 02:27:03', '2026-04-18 02:27:03'),
(49, 'info', 'Export pesanan PDF (8 data)', NULL, '127.0.0.1', 1, '2026-04-18 02:27:17', '2026-04-18 02:27:17'),
(50, 'info', 'Export pesanan Excel (8 data)', NULL, '127.0.0.1', 1, '2026-04-18 02:27:36', '2026-04-18 02:27:36'),
(51, 'info', 'Export produk PDF (21 data)', NULL, '127.0.0.1', 1, '2026-04-18 02:36:35', '2026-04-18 02:36:35'),
(52, 'info', 'Export produk Excel (21 data)', NULL, '127.0.0.1', 1, '2026-04-18 02:36:51', '2026-04-18 02:36:51'),
(53, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:41:14', '2026-04-18 02:41:14'),
(54, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:41:45', '2026-04-18 02:41:45'),
(55, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:42:04', '2026-04-18 02:42:04'),
(56, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:42:50', '2026-04-18 02:42:50'),
(57, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:42:54', '2026-04-18 02:42:54'),
(58, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:42:57', '2026-04-18 02:42:57'),
(59, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:43:00', '2026-04-18 02:43:00'),
(60, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:43:03', '2026-04-18 02:43:03'),
(61, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:43:34', '2026-04-18 02:43:34'),
(62, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:43:59', '2026-04-18 02:43:59'),
(63, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:44:31', '2026-04-18 02:44:31'),
(64, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:45:03', '2026-04-18 02:45:03'),
(65, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:45:35', '2026-04-18 02:45:35'),
(66, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:46:07', '2026-04-18 02:46:07'),
(67, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:46:38', '2026-04-18 02:46:38'),
(68, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:47:10', '2026-04-18 02:47:10'),
(69, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:47:41', '2026-04-18 02:47:41'),
(70, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:48:13', '2026-04-18 02:48:13'),
(71, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:48:44', '2026-04-18 02:48:44'),
(72, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:49:15', '2026-04-18 02:49:15'),
(73, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:49:46', '2026-04-18 02:49:46'),
(74, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:49:48', '2026-04-18 02:49:48'),
(75, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:49:51', '2026-04-18 02:49:51'),
(76, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:50:23', '2026-04-18 02:50:23'),
(77, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 02:54:35', '2026-04-18 02:54:35'),
(78, 'info', 'Order MED-ZQVNE9MT status: pending → shipped', NULL, '127.0.0.1', 1, '2026-04-18 03:00:01', '2026-04-18 03:00:01'),
(79, 'info', 'Order MED-ZQVNE9MT status: shipped → delivered', NULL, '127.0.0.1', 1, '2026-04-18 03:00:04', '2026-04-18 03:00:04'),
(80, 'info', 'Export pesanan PDF (9 data)', NULL, '127.0.0.1', 1, '2026-04-18 03:00:21', '2026-04-18 03:00:21'),
(81, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 03:01:08', '2026-04-18 03:01:08'),
(82, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-18 03:01:34', '2026-04-18 03:01:34'),
(83, 'info', 'Import produk: 0 berhasil, 4 dilewati', NULL, '127.0.0.1', 1, '2026-04-18 03:32:58', '2026-04-18 03:32:58'),
(84, 'info', 'Import produk: 0 berhasil, 4 dilewati', NULL, '127.0.0.1', 1, '2026-04-18 03:33:56', '2026-04-18 03:33:56'),
(85, 'info', 'Export produk Excel (21 data)', NULL, '127.0.0.1', 1, '2026-04-18 03:34:20', '2026-04-18 03:34:20'),
(86, 'info', 'Import produk: 0 berhasil, 4 dilewati', NULL, '127.0.0.1', 1, '2026-04-18 03:35:50', '2026-04-18 03:35:50'),
(87, 'info', 'Import produk: 0 berhasil, 4 dilewati', NULL, '127.0.0.1', 1, '2026-04-18 03:37:40', '2026-04-18 03:37:40'),
(88, 'info', 'Import produk: 0 berhasil, 1 dilewati', NULL, '127.0.0.1', 1, '2026-04-18 03:38:55', '2026-04-18 03:38:55'),
(89, 'info', 'Import produk: 4 berhasil, 0 dilewati', NULL, '127.0.0.1', 1, '2026-04-18 03:45:53', '2026-04-18 03:45:53'),
(90, 'info', 'User login: naura@gmail.com', NULL, '127.0.0.1', 4, '2026-04-18 06:01:18', '2026-04-18 06:01:18'),
(91, 'info', 'User login: naura@gmail.com', NULL, '127.0.0.1', 4, '2026-04-19 21:24:20', '2026-04-19 21:24:20'),
(92, 'info', 'User login: admin', NULL, '127.0.0.1', 1, '2026-04-19 21:40:52', '2026-04-19 21:40:52'),
(93, 'info', 'Order MED-4NCZABYT status: pending → shipped', NULL, '127.0.0.1', 1, '2026-04-19 21:41:05', '2026-04-19 21:41:05'),
(94, 'info', 'User login: Budi Santoso', NULL, '127.0.0.1', 5, '2026-04-19 21:41:15', '2026-04-19 21:41:15'),
(95, 'info', 'User login: admin', NULL, '127.0.0.1', 1, '2026-04-19 21:42:25', '2026-04-19 21:42:25'),
(96, 'info', 'Order MED-4NCZABYT status: shipped → delivered', NULL, '127.0.0.1', 1, '2026-04-19 21:42:39', '2026-04-19 21:42:39'),
(97, 'info', 'User login: Budi Santoso', NULL, '127.0.0.1', 5, '2026-04-19 21:42:52', '2026-04-19 21:42:52'),
(98, 'warning', 'Stok [Blackmores BIO D3 1000 IU] berubah: 48 -> 0', NULL, '127.0.0.1', NULL, '2026-04-20 12:39:54', '2026-04-20 12:39:54'),
(99, 'info', 'User login: Narendra', NULL, '127.0.0.1', 6, '2026-04-20 05:54:27', '2026-04-20 05:54:27'),
(100, 'info', 'User login: admin', NULL, '127.0.0.1', 1, '2026-04-20 06:00:00', '2026-04-20 06:00:00'),
(101, 'info', 'User login: admin', NULL, '127.0.0.1', 1, '2026-04-20 06:13:04', '2026-04-20 06:13:04'),
(102, 'info', 'Export produk Excel (24 data)', NULL, '127.0.0.1', 1, '2026-04-20 06:17:20', '2026-04-20 06:17:20'),
(103, 'info', 'User login: Narendra', NULL, '127.0.0.1', 6, '2026-04-20 06:46:01', '2026-04-20 06:46:01'),
(104, 'info', 'Stok [Natur-E Advanced 100 IU] berubah: 60 -> 59', NULL, '127.0.0.1', NULL, '2026-04-20 13:46:24', '2026-04-20 13:46:24'),
(105, 'info', 'User login: admin', NULL, '127.0.0.1', 1, '2026-04-20 06:46:47', '2026-04-20 06:46:47'),
(106, 'info', 'Order MED-IUNL1JYK status: pending → shipped', NULL, '127.0.0.1', 1, '2026-04-20 06:46:55', '2026-04-20 06:46:55'),
(107, 'info', 'Order MED-VXMRHRZR status: pending → delivered', NULL, '127.0.0.1', 1, '2026-04-20 06:46:57', '2026-04-20 06:46:57'),
(108, 'info', 'Admin mengakses halaman monitor sistem', NULL, '127.0.0.1', 1, '2026-04-20 06:47:01', '2026-04-20 06:47:01'),
(109, 'warning', 'ALERT: 1 produk kehabisan stok', NULL, '127.0.0.1', 1, '2026-04-20 06:47:01', '2026-04-20 06:47:01');

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `phone`, `address`) VALUES
(1, 'admin', 'admin@medicaly.id', NULL, '$2y$12$bT0opqHmfqTlok69RikW5uELmuC686V6aXECILhFYl0GxAIdqfKSC', NULL, '2026-04-05 08:22:47', '2026-04-05 08:22:47', 'admin', NULL, NULL),
(2, 'john', 'john@gmail.com', NULL, '$2y$12$7LAz4KTyEHs4rVxhSVhCM.3soD/neUzP1Q77sQy7YW9vlXsxiM2Gm', NULL, '2026-04-05 08:22:47', '2026-04-05 08:22:47', 'user', NULL, NULL),
(3, 'Namira', 'namirashifwah@gmail.com', NULL, '$2y$12$Vt8QBlIsrPJADDVmK42CZuPqz0WYGudm3zVDQG2FOXF6OvlQVJCtK', NULL, '2026-04-05 21:01:01', '2026-04-05 21:01:01', 'user', NULL, NULL),
(4, 'Naura', 'naura@gmail.com', NULL, '$2y$12$6d0529eGxb/r4Yx0890i0eaKp6cklaiznFRi/3ZdroOJTsBI2X6v6', NULL, '2026-04-17 05:22:31', '2026-04-17 19:38:26', 'user', NULL, NULL),
(5, 'Budi Santoso', 'budi@gmail.com', NULL, '$2y$12$F63rJhk2XbxCXbAoSzkwfeeFlABZdvWMnA7jMYeHzQ8AjhEdECEu2', NULL, '2026-04-19 21:37:29', '2026-04-19 21:37:29', 'user', NULL, NULL),
(6, 'Narendra', 'naren@gmail.com', NULL, '$2y$12$.ocrFnDwimBdemE/G1C5UuiAzC0wBYsadwEbcN30ZvAVQ/UmzO4aS', NULL, '2026-04-20 00:40:02', '2026-04-20 00:40:02', 'user', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `system_logs_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD CONSTRAINT `system_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
