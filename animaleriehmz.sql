-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2026 at 03:35 PM
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
-- Database: `animaleriehmz`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address_line_1` varchar(255) NOT NULL,
  `address_line_2` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'France',
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `type` enum('billing','shipping') NOT NULL DEFAULT 'shipping',
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Chiens', 'chiens', 'pets', 'images/cat_chien.jpg', 1, '2026-05-16 10:09:26', '2026-05-16 10:09:26'),
(2, 'Chats', 'chats', 'pets', 'images/cat_chat.png', 1, '2026-05-16 10:09:26', '2026-05-16 10:09:26'),
(3, 'Oiseaux', 'oiseaux', 'flutter', 'images/cat_oiseaux.png', 1, '2026-05-16 10:09:26', '2026-05-16 10:09:26'),
(4, 'Poissons', 'poissons', 'water_drop', 'images/cat_poissons.png', 1, '2026-05-16 10:09:26', '2026-05-16 10:09:26'),
(5, 'Pigeons', 'pigeons', 'flutter', 'images/cat_pigeons.png.png', 1, '2026-05-16 10:09:26', '2026-05-16 10:09:26');

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
(4, '2026_05_16_000001_create_categories_table', 1),
(5, '2026_05_16_000002_create_sub_categories_table', 1),
(6, '2026_05_16_000003_create_offers_table', 1),
(7, '2026_05_16_000004_create_products_table', 1),
(8, '2026_05_16_114600_create_addresses_table', 2),
(9, '2026_05_16_114605_create_orders_table', 2),
(10, '2026_05_16_114606_create_order_items_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `badge` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `bg_color` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `title`, `subtitle`, `badge`, `image`, `link`, `bg_color`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Jusqu\'à 25% de remise', 'Sur toute la gamme Chien', 'Offre Spéciale', 'https://lh3.googleusercontent.com/aida-public/AB6AXuAx-idpF478hzoaaBIUHLUhWNsH922i7ik4yZ4LO2wsFxOXaaH0vCZmjypSNPW30ShDtsjn1yqpnEmIm97kK9VU2iG19ZN0Q_Bc01sr9tKItR4y8LpQcFN8bjT3Gitg7YSmWhoFXxNmov5igt9yvFvKOsFHinogyokHHUyUpIb_jSnIM_foyONoR63ppruzz3Kjj8Q09IM4NcqFWBLcnyUiLmE9JLA5fHEoOWGVZ_SAE5fIRWwLEjQDLqOAa20bHz9MgNHftU0xCdA', '/categories/chiens', '#0855b1', 1, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(2, '-15% sur les Accessoires', 'Pour Chats et Rongeurs', 'Exclusivité Web', 'https://lh3.googleusercontent.com/aida-public/AB6AXuAD1AcP45gJpBLS8Tr-pXiMNBhB2iQJSA2af3qaDZ7Y417iW3jYCPMEXodTymh_btgwzlODtmGfx9-9WBkmqrr92jmmOl6Hza6t5TQcw34Wpzi1TDXqjiwXuSGQQifpo2cGqNLGMLJfYc4Aj2c7zH9Fns2agYHMc6JfqKBDoNvaF9nY6Bo7nEr_DfAPkZIxRgoqa0c5x6SpMwoaoUhfwM8UHOGaNy0FYVCh2S0XffBGisL1pEt11w0B4A0aiW25uQwPR5_UGGg2YU4', '/categories/chats', '#4fa5d8', 1, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(3, 'Pack Bienvenue', 'Offert pour votre 1ère commande', 'Nouveauté', 'https://lh3.googleusercontent.com/aida-public/AB6AXuBqASyV7URQYtB7AufDQq3zsXl7XSv9FkFZ2rS7cvCY8SjFBpNtd44dmKeXIseCB9VNUADcDBsTZFb6lITNOv2FLAuO2mwJu_CqbbtFdL1nnCHvOh3gcNgP6etzuggSPuFxOHrjFd94gobAlyjJdlEbFYg-J5N8E9XGz90YLgl0NJs0XhBpPwWcq_WERVUX8hBqXIcEE5Wjyp6mSiNEde_o2uE8CHpFJxQr9iCfpJSCMSWgZ8U6B2nbcBOlsTz53qAdUrzB7JupVkA', '/offres', '#ffffff', 1, '2026-05-16 10:09:27', '2026-05-16 10:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shipping_first_name` varchar(255) NOT NULL,
  `shipping_last_name` varchar(255) NOT NULL,
  `shipping_email` varchar(255) NOT NULL,
  `shipping_phone` varchar(255) NOT NULL,
  `shipping_address_line_1` varchar(255) NOT NULL,
  `shipping_address_line_2` varchar(255) DEFAULT NULL,
  `shipping_city` varchar(255) NOT NULL,
  `shipping_postal_code` varchar(255) NOT NULL,
  `shipping_country` varchar(255) NOT NULL DEFAULT 'France',
  `billing_first_name` varchar(255) DEFAULT NULL,
  `billing_last_name` varchar(255) DEFAULT NULL,
  `billing_address_line_1` varchar(255) DEFAULT NULL,
  `billing_address_line_2` varchar(255) DEFAULT NULL,
  `billing_city` varchar(255) DEFAULT NULL,
  `billing_postal_code` varchar(255) DEFAULT NULL,
  `billing_country` varchar(255) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `payment_method` enum('card','paypal','bank_transfer','cash_on_delivery') NOT NULL DEFAULT 'cash_on_delivery',
  `payment_status` enum('pending','paid','failed','refunded') NOT NULL DEFAULT 'pending',
  `paid_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','confirmed','processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `customer_notes` text DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `shipping_first_name`, `shipping_last_name`, `shipping_email`, `shipping_phone`, `shipping_address_line_1`, `shipping_address_line_2`, `shipping_city`, `shipping_postal_code`, `shipping_country`, `billing_first_name`, `billing_last_name`, `billing_address_line_1`, `billing_address_line_2`, `billing_city`, `billing_postal_code`, `billing_country`, `subtotal`, `shipping_cost`, `tax`, `discount`, `total`, `payment_method`, `payment_status`, `paid_at`, `status`, `customer_notes`, `admin_notes`, `created_at`, `updated_at`) VALUES
(1, 'ORD-6A085A8A3C22C', 1, 'Elmo', 'Kilback', 'admin@hmz.com', '678-240-9731', '801 Alice Fork Apt. 352', NULL, 'Bessieburgh', '58905', 'France', 'Alexie', 'O\'Keefe', '5181 Samanta Burgs', NULL, 'Elmerfurt', '22503', 'France', 443.60, 0.00, 88.72, 0.00, 532.32, 'bank_transfer', 'pending', NULL, 'shipped', 'Et esse veritatis aut et.', NULL, '2026-03-25 10:52:42', '2026-05-16 10:52:42'),
(2, 'ORD-6A085A8A402F3', 2, 'Jalyn', 'Hansen', 'client@test.com', '+1 (425) 801-6503', '2721 Lenore Village', NULL, 'North Ashtonmouth', '18673', 'France', 'Armand', 'Ward', '572 Hope Islands Apt. 895', NULL, 'North Jacksonport', '03508', 'France', 1027.47, 0.00, 205.49, 0.00, 1232.96, 'paypal', 'paid', '2026-05-16 10:52:42', 'cancelled', NULL, 'Provident aut quos beatae est deleniti qui asperiores.', '2026-03-25 10:52:42', '2026-05-16 10:52:42'),
(3, 'ORD-6A085A8A436A9', 2, 'Freeman', 'DuBuque', 'client@test.com', '1-364-247-3118', '455 Ziemann Parkways Apt. 330', 'Apt. 166', 'North Sheridan', '21454-6662', 'France', 'Cruz', 'Kertzmann', '20663 Ardella Grove Suite 744', 'Apt. 523', 'Dickenstown', '46672-8205', 'France', 140.98, 0.00, 28.20, 0.00, 169.18, 'bank_transfer', 'paid', '2026-05-06 10:52:42', 'processing', 'Optio a neque non sit non dolore.', NULL, '2026-03-26 10:52:42', '2026-05-16 10:52:42'),
(4, 'ORD-6A085A8A451B2', 2, 'Kennith', 'Gislason', 'client@test.com', '562-254-1719', '694 Candida Ridges Apt. 192', NULL, 'Yadiraville', '62269-8264', 'France', 'Keyon', 'Becker', '1202 Goyette Mews Suite 902', NULL, 'Port Scot', '19950', 'France', 358.86, 0.00, 71.77, 0.00, 430.63, 'cash_on_delivery', 'pending', NULL, 'pending', NULL, NULL, '2026-04-06 10:52:42', '2026-05-16 10:52:42'),
(5, 'ORD-6A085A8A47C34', 1, 'Abelardo', 'Crooks', 'admin@hmz.com', '(435) 602-9384', '440 Kylie Drive', NULL, 'North Wilber', '33971-9420', 'France', 'Logan', 'Kuvalis', '87097 Jacobi Streets Suite 419', NULL, 'Stromanview', '46961-1106', 'France', 54.99, 15.00, 11.00, 0.00, 80.99, 'card', 'paid', '2026-05-15 10:52:42', 'shipped', 'Est earum inventore molestiae.', 'Quia cum facere aut ut.', '2026-05-14 10:52:42', '2026-05-16 10:52:42'),
(6, 'ORD-6A085A8A48DEA', 1, 'Freda', 'Funk', 'admin@hmz.com', '478-612-0609', '7137 Waters Spur Apt. 609', NULL, 'North Haileyside', '82626', 'France', 'Zaria', 'Huel', '27433 King Road Suite 179', NULL, 'Huelschester', '05853-1979', 'France', 300.67, 0.00, 60.13, 0.00, 360.80, 'card', 'paid', '2026-04-29 10:52:42', 'pending', NULL, NULL, '2026-04-19 10:52:42', '2026-05-16 10:52:42'),
(7, 'ORD-6A085A8A4B905', 2, 'Art', 'Grimes', 'client@test.com', '401.501.2804', '477 Lesch Streets', 'Suite 219', 'Noblebury', '67215', 'France', 'Rico', 'Koepp', '3045 Luciano Via Suite 667', 'Apt. 941', 'Port Myah', '48898-6620', 'France', 91.98, 15.00, 18.40, 0.00, 125.38, 'cash_on_delivery', 'pending', NULL, 'delivered', NULL, 'Optio labore accusantium dolore et molestias rerum.', '2026-04-07 10:52:42', '2026-05-16 10:52:42'),
(8, 'ORD-6A085A8A4CBC4', 2, 'Eugenia', 'Quitzon', 'client@test.com', '657-970-6685', '2942 Fritsch Cove', NULL, 'Johnsfurt', '91858-9697', 'France', 'Lorine', 'Kris', '71302 Huels Courts', NULL, 'Lake Sebastian', '45422-3524', 'France', 452.97, 0.00, 90.59, 0.00, 543.56, 'bank_transfer', 'pending', NULL, 'delivered', NULL, NULL, '2026-05-01 10:52:42', '2026-05-16 10:52:42'),
(9, 'ORD-6A085A8A4F2B9', 1, 'Dominic', 'Feest', 'admin@hmz.com', '769-976-4448', '3794 VonRueden Forges', 'Suite 185', 'Dickifurt', '41472', 'France', 'Karson', 'Gorczany', '888 Alana Plains Suite 578', NULL, 'Schroederborough', '13897', 'France', 375.98, 0.00, 75.20, 0.00, 451.18, 'card', 'pending', NULL, 'pending', 'Quibusdam vero culpa aut.', NULL, '2026-04-25 10:52:42', '2026-05-16 10:52:42'),
(10, 'ORD-6A085A8A51244', 1, 'Charlie', 'Labadie', 'admin@hmz.com', '1-740-335-7913', '4977 Kuhlman Pass', 'Apt. 291', 'Hellertown', '36879-2173', 'France', 'Levi', 'Hettinger', '1832 Johns Square', 'Suite 748', 'East Caliberg', '44768', 'France', 167.70, 0.00, 33.54, 0.00, 201.24, 'bank_transfer', 'pending', NULL, 'cancelled', 'Provident quos possimus vel facere doloremque illum est et.', NULL, '2026-05-14 10:52:42', '2026-05-16 10:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_sku` varchar(255) DEFAULT NULL,
  `product_image` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `product_sku`, `product_image`, `price`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 'Aquarium Design 60L Complet', 'AQU-60L-KIT', 'https://lh3.googleusercontent.com/aida-public/AB6AXuBqASyV7URQYtB7AufDQq3zsXl7XSv9FkFZ2rS7cvCY8SjFBpNtd44dmKeXIseCB9VNUADcDBsTZFb6lITNOv2FLAuO2mwJu_CqbbtFdL1nnCHvOh3gcNgP6etzuggSPuFxOHrjFd94gobAlyjJdlEbFYg-J5N8E9XGz90YLgl0NJs0XhBpPwWcq_WERVUX8hBqXIcEE5Wjyp6mSiNEde_o2uE8CHpFJxQr9iCfpJSCMSWgZ8U6B2nbcBOlsTz53qAdUrzB7JupVkA', 189.00, 2, 378.00, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(2, 1, 5, 'Litière Agglomérante Premium 15L', 'LIT-PREM-15', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCIgvNYgMNUX5dDqy9Ji_Xgxifl2RujROG1NGbtl-Mih2srLRpvr-ALYegp6tS66MyQnjGxpl4olvyw9hCamdiCkFivkf896OtEa385MGru_6Q019kTiqpbFtKgGowNvA-C_TqIx5l22H157bz1Kcvgw2kJCLW2ErRaYX-3bMGsSF7HTL6rLtQi-kLHDBGF2tudqZjjiCzdZKJopX7DanJL1aNaI1FjSwc8AKJscFoxJWMwFwX9dD2EIjNlqIw5XwkaHGF8gSSmNmY', 18.90, 3, 56.70, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(3, 1, 9, 'Balançoire en Bois Naturel', 'SWING-NAT-S', 'https://lh3.googleusercontent.com/aida-public/AB6AXuC4n77pofZu0M7VUhuXGR57lrTtl_tb-uNTk86gHkIkGqm1VFQc7Ht2jLvyEZKkW0AIbNxsAawhHLmTYSyIluEMqF1ZTczZNvtpUpaEaABo4njvV99IleGHi4r6DK88eCwSmUKJI6JGjFSXwyIX_a05sHUoItu8TmjYM6jQ4Qa4yXFWe19SAQJdSHxcvN0O8vOKKeF-cOkmKKYTsKwPH218RptL2fIyj5VYNURR36Np6h6wrZFTBawkN2X8PygsVeVd_OzbAr9Lpp8', 8.90, 1, 8.90, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(4, 2, 7, 'Volière Design White Edition', 'VOL-WHT-L', 'https://lh3.googleusercontent.com/aida-public/AB6AXuClYWz_RZMFkeB388ZG-bh97mfPIVfjx52xnIAnsFCry5DWZr8JkZXXkvrfCd2JOvT3T7_e_oaDJovqOm9TBKI3IPyEu2oy5WBERvzx8P9OZF6BSRW8An7kMKAtFYnnXop35gZx-PEXS_yHmFD-LtMRfnHJT1pW5KpMrlxiH3KmQsMgNQ4Tw1qRfUb6-hhALmKaLq4mLRU_KmVH0ZVgQ14sGqeKKwRf8YeIsbeMVZX3BKvf70UPS2eUrgW-ETcGeGK4Byx_hIfiVFw', 129.00, 3, 387.00, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(5, 2, 2, 'Croquettes Premium Vitality 15kg', 'VIT-DOG-15', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A', 38.50, 3, 115.50, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(6, 2, 7, 'Volière Design White Edition', 'VOL-WHT-L', 'https://lh3.googleusercontent.com/aida-public/AB6AXuClYWz_RZMFkeB388ZG-bh97mfPIVfjx52xnIAnsFCry5DWZr8JkZXXkvrfCd2JOvT3T7_e_oaDJovqOm9TBKI3IPyEu2oy5WBERvzx8P9OZF6BSRW8An7kMKAtFYnnXop35gZx-PEXS_yHmFD-LtMRfnHJT1pW5KpMrlxiH3KmQsMgNQ4Tw1qRfUb6-hhALmKaLq4mLRU_KmVH0ZVgQ14sGqeKKwRf8YeIsbeMVZX3BKvf70UPS2eUrgW-ETcGeGK4Byx_hIfiVFw', 129.00, 3, 387.00, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(7, 2, 1, 'Croquettes Royal Canin Medium Adult', 'RC-MED-001', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A', 45.99, 3, 137.97, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(8, 3, 8, 'Mélange Graines Premium 5kg', 'SEED-PREM-5', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCQXx6hiUnOCX6DzOYQFjw2OrpfOIMoRhffQpWaGCqdsUlortBdVqSqAR_xd6Fn6gCZZUFji4VdfAmXhX5s9pzWEhG5UH0lcp21npAq9fuGnRxAzrecick6_ERfAUEza0zCesRzz7kF6nnzRK2ioGzio6gLFkdV9n4QIJMRSH5Rb4rk8a7uyW_yBHJxsVn-H1Qv975itGYfYFVHtLTgQnig4KiM5eMzekLdU-8CzNjmglwOOp0ov466FOPQqMVrFSAg8dhT_-nR4Ko', 24.50, 2, 49.00, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(9, 3, 1, 'Croquettes Royal Canin Medium Adult', 'RC-MED-001', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A', 45.99, 2, 91.98, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(10, 4, 4, 'Croquettes Royal Canin Sterilised 10kg', 'RC-CAT-ST10', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A', 54.99, 3, 164.97, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(11, 4, 4, 'Croquettes Royal Canin Sterilised 10kg', 'RC-CAT-ST10', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A', 54.99, 1, 54.99, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(12, 4, 12, 'Mélange Graines Pigeons Sport 20kg', 'PIG-SPORT-20', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCQXx6hiUnOCX6DzOYQFjw2OrpfOIMoRhffQpWaGCqdsUlortBdVqSqAR_xd6Fn6gCZZUFji4VdfAmXhX5s9pzWEhG5UH0lcp21npAq9fuGnRxAzrecick6_ERfAUEza0zCesRzz7kF6nnzRK2ioGzio6gLFkdV9n4QIJMRSH5Rb4rk8a7uyW_yBHJxsVn-H1Qv975itGYfYFVHtLTgQnig4KiM5eMzekLdU-8CzNjmglwOOp0ov466FOPQqMVrFSAg8dhT_-nR4Ko', 42.00, 3, 126.00, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(13, 4, 3, 'Jouet Interactif Kong Classic', 'KONG-CL-M', 'https://lh3.googleusercontent.com/aida-public/AB6AXuAx-idpF478hzoaaBIUHLUhWNsH922i7ik4yZ4LO2wsFxOXaaH0vCZmjypSNPW30ShDtsjn1yqpnEmIm97kK9VU2iG19ZN0Q_Bc01sr9tKItR4y8LpQcFN8bjT3Gitg7YSmWhoFXxNmov5igt9yvFvKOsFHinogyokHHUyUpIb_jSnIM_foyONoR63ppruzz3Kjj8Q09IM4NcqFWBLcnyUiLmE9JLA5fHEoOWGVZ_SAE5fIRWwLEjQDLqOAa20bHz9MgNHftU0xCdA', 12.90, 1, 12.90, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(14, 5, 4, 'Croquettes Royal Canin Sterilised 10kg', 'RC-CAT-ST10', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A', 54.99, 1, 54.99, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(15, 6, 4, 'Croquettes Royal Canin Sterilised 10kg', 'RC-CAT-ST10', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A', 54.99, 3, 164.97, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(16, 6, 6, 'Arbre à Chat Oasis 120cm', 'TREE-OAS-120', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCf13j3hn9fIiDpqfSIlA9_FGHwtCP_eI4a3XaBc8PRii4W1Xpek9f00xWvJE9IUbjlRXdu8-LuGY5LKKcih9AXo-YkFHi7qYjMJd47ArOAqqoOoWn9leyXVBBQuw1n3PCI2GBC55QG4gMu1HBDQkpsFbkZS_WJ0_q_vf2YXJFxlB0HrVo3E1bjSgW_uyEks74dsBVn7FKDLKCduZjyu-6-aJScVW_a1dPEPCDq1rgNwr8q4NCWWeiWomcEutvwHdKGXHPcFYJEMAw', 79.00, 1, 79.00, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(17, 6, 5, 'Litière Agglomérante Premium 15L', 'LIT-PREM-15', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCIgvNYgMNUX5dDqy9Ji_Xgxifl2RujROG1NGbtl-Mih2srLRpvr-ALYegp6tS66MyQnjGxpl4olvyw9hCamdiCkFivkf896OtEa385MGru_6Q019kTiqpbFtKgGowNvA-C_TqIx5l22H157bz1Kcvgw2kJCLW2ErRaYX-3bMGsSF7HTL6rLtQi-kLHDBGF2tudqZjjiCzdZKJopX7DanJL1aNaI1FjSwc8AKJscFoxJWMwFwX9dD2EIjNlqIw5XwkaHGF8gSSmNmY', 18.90, 2, 37.80, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(18, 6, 5, 'Litière Agglomérante Premium 15L', 'LIT-PREM-15', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCIgvNYgMNUX5dDqy9Ji_Xgxifl2RujROG1NGbtl-Mih2srLRpvr-ALYegp6tS66MyQnjGxpl4olvyw9hCamdiCkFivkf896OtEa385MGru_6Q019kTiqpbFtKgGowNvA-C_TqIx5l22H157bz1Kcvgw2kJCLW2ErRaYX-3bMGsSF7HTL6rLtQi-kLHDBGF2tudqZjjiCzdZKJopX7DanJL1aNaI1FjSwc8AKJscFoxJWMwFwX9dD2EIjNlqIw5XwkaHGF8gSSmNmY', 18.90, 1, 18.90, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(19, 7, 1, 'Croquettes Royal Canin Medium Adult', 'RC-MED-001', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A', 45.99, 2, 91.98, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(20, 8, 1, 'Croquettes Royal Canin Medium Adult', 'RC-MED-001', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A', 45.99, 3, 137.97, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(21, 8, 10, 'Aquarium Design 60L Complet', 'AQU-60L-KIT', 'https://lh3.googleusercontent.com/aida-public/AB6AXuBqASyV7URQYtB7AufDQq3zsXl7XSv9FkFZ2rS7cvCY8SjFBpNtd44dmKeXIseCB9VNUADcDBsTZFb6lITNOv2FLAuO2mwJu_CqbbtFdL1nnCHvOh3gcNgP6etzuggSPuFxOHrjFd94gobAlyjJdlEbFYg-J5N8E9XGz90YLgl0NJs0XhBpPwWcq_WERVUX8hBqXIcEE5Wjyp6mSiNEde_o2uE8CHpFJxQr9iCfpJSCMSWgZ8U6B2nbcBOlsTz53qAdUrzB7JupVkA', 189.00, 1, 189.00, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(22, 8, 12, 'Mélange Graines Pigeons Sport 20kg', 'PIG-SPORT-20', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCQXx6hiUnOCX6DzOYQFjw2OrpfOIMoRhffQpWaGCqdsUlortBdVqSqAR_xd6Fn6gCZZUFji4VdfAmXhX5s9pzWEhG5UH0lcp21npAq9fuGnRxAzrecick6_ERfAUEza0zCesRzz7kF6nnzRK2ioGzio6gLFkdV9n4QIJMRSH5Rb4rk8a7uyW_yBHJxsVn-H1Qv975itGYfYFVHtLTgQnig4KiM5eMzekLdU-8CzNjmglwOOp0ov466FOPQqMVrFSAg8dhT_-nR4Ko', 42.00, 2, 84.00, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(23, 8, 12, 'Mélange Graines Pigeons Sport 20kg', 'PIG-SPORT-20', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCQXx6hiUnOCX6DzOYQFjw2OrpfOIMoRhffQpWaGCqdsUlortBdVqSqAR_xd6Fn6gCZZUFji4VdfAmXhX5s9pzWEhG5UH0lcp21npAq9fuGnRxAzrecick6_ERfAUEza0zCesRzz7kF6nnzRK2ioGzio6gLFkdV9n4QIJMRSH5Rb4rk8a7uyW_yBHJxsVn-H1Qv975itGYfYFVHtLTgQnig4KiM5eMzekLdU-8CzNjmglwOOp0ov466FOPQqMVrFSAg8dhT_-nR4Ko', 42.00, 1, 42.00, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(24, 9, 6, 'Arbre à Chat Oasis 120cm', 'TREE-OAS-120', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCf13j3hn9fIiDpqfSIlA9_FGHwtCP_eI4a3XaBc8PRii4W1Xpek9f00xWvJE9IUbjlRXdu8-LuGY5LKKcih9AXo-YkFHi7qYjMJd47ArOAqqoOoWn9leyXVBBQuw1n3PCI2GBC55QG4gMu1HBDQkpsFbkZS_WJ0_q_vf2YXJFxlB0HrVo3E1bjSgW_uyEks74dsBVn7FKDLKCduZjyu-6-aJScVW_a1dPEPCDq1rgNwr8q4NCWWeiWomcEutvwHdKGXHPcFYJEMAw', 79.00, 2, 158.00, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(25, 9, 12, 'Mélange Graines Pigeons Sport 20kg', 'PIG-SPORT-20', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCQXx6hiUnOCX6DzOYQFjw2OrpfOIMoRhffQpWaGCqdsUlortBdVqSqAR_xd6Fn6gCZZUFji4VdfAmXhX5s9pzWEhG5UH0lcp21npAq9fuGnRxAzrecick6_ERfAUEza0zCesRzz7kF6nnzRK2ioGzio6gLFkdV9n4QIJMRSH5Rb4rk8a7uyW_yBHJxsVn-H1Qv975itGYfYFVHtLTgQnig4KiM5eMzekLdU-8CzNjmglwOOp0ov466FOPQqMVrFSAg8dhT_-nR4Ko', 42.00, 3, 126.00, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(26, 9, 1, 'Croquettes Royal Canin Medium Adult', 'RC-MED-001', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A', 45.99, 2, 91.98, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(27, 10, 3, 'Jouet Interactif Kong Classic', 'KONG-CL-M', 'https://lh3.googleusercontent.com/aida-public/AB6AXuAx-idpF478hzoaaBIUHLUhWNsH922i7ik4yZ4LO2wsFxOXaaH0vCZmjypSNPW30ShDtsjn1yqpnEmIm97kK9VU2iG19ZN0Q_Bc01sr9tKItR4y8LpQcFN8bjT3Gitg7YSmWhoFXxNmov5igt9yvFvKOsFHinogyokHHUyUpIb_jSnIM_foyONoR63ppruzz3Kjj8Q09IM4NcqFWBLcnyUiLmE9JLA5fHEoOWGVZ_SAE5fIRWwLEjQDLqOAa20bHz9MgNHftU0xCdA', 12.90, 3, 38.70, '2026-05-16 10:52:42', '2026-05-16 10:52:42'),
(28, 10, 7, 'Volière Design White Edition', 'VOL-WHT-L', 'https://lh3.googleusercontent.com/aida-public/AB6AXuClYWz_RZMFkeB388ZG-bh97mfPIVfjx52xnIAnsFCry5DWZr8JkZXXkvrfCd2JOvT3T7_e_oaDJovqOm9TBKI3IPyEu2oy5WBERvzx8P9OZF6BSRW8An7kMKAtFYnnXop35gZx-PEXS_yHmFD-LtMRfnHJT1pW5KpMrlxiH3KmQsMgNQ4Tw1qRfUb6-hhALmKaLq4mLRU_KmVH0ZVgQ14sGqeKKwRf8YeIsbeMVZX3BKvf70UPS2eUrgW-ETcGeGK4Byx_hIfiVFw', 129.00, 1, 129.00, '2026-05-16 10:52:42', '2026-05-16 10:52:42');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `price_old` decimal(10,2) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `sku` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_new` tinyint(1) NOT NULL DEFAULT 0,
  `is_bestseller` tinyint(1) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `discount_percentage` int(11) NOT NULL DEFAULT 0,
  `rating` decimal(2,1) NOT NULL DEFAULT 5.0,
  `review_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `name`, `slug`, `description`, `short_description`, `price`, `price_old`, `stock`, `sku`, `image`, `is_active`, `is_new`, `is_bestseller`, `is_featured`, `discount_percentage`, `rating`, `review_count`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Croquettes Royal Canin Medium Adult', 'croquettes-royal-canin-medium-adult', 'Aliment complet pour chiens adultes de taille moyenne (11 à 25 kg) à partir de 12 mois.', 'Nutrition équilibrée pour chiens moyens', 45.99, 52.99, 50, 'RC-MED-001', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A', 1, 0, 1, 0, 13, 4.8, 127, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(2, 1, 1, 'Croquettes Premium Vitality 15kg', 'croquettes-premium-vitality-15kg', 'Croquettes premium pour chiens actifs avec poulet frais et légumes.', 'Haute énergie pour chiens actifs', 38.50, 45.00, 35, 'VIT-DOG-15', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A', 1, 1, 0, 0, 14, 4.6, 89, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(3, 1, 2, 'Jouet Interactif Kong Classic', 'jouet-interactif-kong-classic', 'Jouet résistant en caoutchouc naturel pour chiens. Idéal pour le jeu et la mastication.', 'Jouet indestructible pour chiens', 12.90, NULL, 80, 'KONG-CL-M', 'https://lh3.googleusercontent.com/aida-public/AB6AXuAx-idpF478hzoaaBIUHLUhWNsH922i7ik4yZ4LO2wsFxOXaaH0vCZmjypSNPW30ShDtsjn1yqpnEmIm97kK9VU2iG19ZN0Q_Bc01sr9tKItR4y8LpQcFN8bjT3Gitg7YSmWhoFXxNmov5igt9yvFvKOsFHinogyokHHUyUpIb_jSnIM_foyONoR63ppruzz3Kjj8Q09IM4NcqFWBLcnyUiLmE9JLA5fHEoOWGVZ_SAE5fIRWwLEjQDLqOAa20bHz9MgNHftU0xCdA', 1, 0, 0, 1, 0, 4.9, 234, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(4, 2, 5, 'Croquettes Royal Canin Sterilised 10kg', 'croquettes-royal-canin-sterilised-10kg', 'Aliment complet pour chats stérilisés. Aide au maintien du poids idéal.', 'Spécial chats stérilisés', 54.99, 62.99, 45, 'RC-CAT-ST10', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A', 1, 0, 1, 0, 13, 4.7, 156, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(5, 2, 6, 'Litière Agglomérante Premium 15L', 'litiere-agglomerante-premium-15l', 'Litière agglomérante ultra-absorbante avec contrôle des odeurs. 100% naturelle.', 'Contrôle des odeurs 30 jours', 18.90, 22.90, 120, 'LIT-PREM-15', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCIgvNYgMNUX5dDqy9Ji_Xgxifl2RujROG1NGbtl-Mih2srLRpvr-ALYegp6tS66MyQnjGxpl4olvyw9hCamdiCkFivkf896OtEa385MGru_6Q019kTiqpbFtKgGowNvA-C_TqIx5l22H157bz1Kcvgw2kJCLW2ErRaYX-3bMGsSF7HTL6rLtQi-kLHDBGF2tudqZjjiCzdZKJopX7DanJL1aNaI1FjSwc8AKJscFoxJWMwFwX9dD2EIjNlqIw5XwkaHGF8gSSmNmY', 1, 0, 1, 0, 17, 4.5, 98, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(6, 2, 7, 'Arbre à Chat Oasis 120cm', 'arbre-a-chat-oasis-120cm', 'Arbre à chat avec griffoirs, plateformes et hamac. Structure stable et design moderne.', 'Arbre à chat 3 niveaux', 79.00, 99.00, 25, 'TREE-OAS-120', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCf13j3hn9fIiDpqfSIlA9_FGHwtCP_eI4a3XaBc8PRii4W1Xpek9f00xWvJE9IUbjlRXdu8-LuGY5LKKcih9AXo-YkFHi7qYjMJd47ArOAqqoOoWn9leyXVBBQuw1n3PCI2GBC55QG4gMu1HBDQkpsFbkZS_WJ0_q_vf2YXJFxlB0HrVo3E1bjSgW_uyEks74dsBVn7FKDLKCduZjyu-6-aJScVW_a1dPEPCDq1rgNwr8q4NCWWeiWomcEutvwHdKGXHPcFYJEMAw', 1, 0, 0, 1, 20, 4.8, 67, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(7, 3, 9, 'Volière Design White Edition', 'voliere-design-white-edition', 'Grande volière élégante avec mangeoires et perchoirs. Facile à nettoyer.', 'Volière spacieuse et design', 129.00, 159.00, 15, 'VOL-WHT-L', 'https://lh3.googleusercontent.com/aida-public/AB6AXuClYWz_RZMFkeB388ZG-bh97mfPIVfjx52xnIAnsFCry5DWZr8JkZXXkvrfCd2JOvT3T7_e_oaDJovqOm9TBKI3IPyEu2oy5WBERvzx8P9OZF6BSRW8An7kMKAtFYnnXop35gZx-PEXS_yHmFD-LtMRfnHJT1pW5KpMrlxiH3KmQsMgNQ4Tw1qRfUb6-hhALmKaLq4mLRU_KmVH0ZVgQ14sGqeKKwRf8YeIsbeMVZX3BKvf70UPS2eUrgW-ETcGeGK4Byx_hIfiVFw', 1, 0, 0, 1, 19, 4.6, 43, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(8, 3, 10, 'Mélange Graines Premium 5kg', 'melange-graines-premium-5kg', 'Mélange équilibré de graines pour oiseaux. Riche en vitamines et minéraux.', 'Nutrition complète pour oiseaux', 24.50, NULL, 60, 'SEED-PREM-5', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCQXx6hiUnOCX6DzOYQFjw2OrpfOIMoRhffQpWaGCqdsUlortBdVqSqAR_xd6Fn6gCZZUFji4VdfAmXhX5s9pzWEhG5UH0lcp21npAq9fuGnRxAzrecick6_ERfAUEza0zCesRzz7kF6nnzRK2ioGzio6gLFkdV9n4QIJMRSH5Rb4rk8a7uyW_yBHJxsVn-H1Qv975itGYfYFVHtLTgQnig4KiM5eMzekLdU-8CzNjmglwOOp0ov466FOPQqMVrFSAg8dhT_-nR4Ko', 1, 0, 1, 0, 0, 4.7, 112, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(9, 3, 11, 'Balançoire en Bois Naturel', 'balancoire-bois-naturel', 'Balançoire en bois naturel non traité. Stimule l\'activité physique.', 'Jouet naturel pour oiseaux', 8.90, NULL, 95, 'SWING-NAT-S', 'https://lh3.googleusercontent.com/aida-public/AB6AXuC4n77pofZu0M7VUhuXGR57lrTtl_tb-uNTk86gHkIkGqm1VFQc7Ht2jLvyEZKkW0AIbNxsAawhHLmTYSyIluEMqF1ZTczZNvtpUpaEaABo4njvV99IleGHi4r6DK88eCwSmUKJI6JGjFSXwyIX_a05sHUoItu8TmjYM6jQ4Qa4yXFWe19SAQJdSHxcvN0O8vOKKeF-cOkmKKYTsKwPH218RptL2fIyj5VYNURR36Np6h6wrZFTBawkN2X8PygsVeVd_OzbAr9Lpp8', 1, 0, 0, 0, 0, 4.4, 56, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(10, 4, 12, 'Aquarium Design 60L Complet', 'aquarium-design-60l-complet', 'Aquarium complet avec filtre, éclairage LED et décoration. Prêt à l\'emploi.', 'Kit aquarium tout inclus', 189.00, 229.00, 12, 'AQU-60L-KIT', 'https://lh3.googleusercontent.com/aida-public/AB6AXuBqASyV7URQYtB7AufDQq3zsXl7XSv9FkFZ2rS7cvCY8SjFBpNtd44dmKeXIseCB9VNUADcDBsTZFb6lITNOv2FLAuO2mwJu_CqbbtFdL1nnCHvOh3gcNgP6etzuggSPuFxOHrjFd94gobAlyjJdlEbFYg-J5N8E9XGz90YLgl0NJs0XhBpPwWcq_WERVUX8hBqXIcEE5Wjyp6mSiNEde_o2uE8CHpFJxQr9iCfpJSCMSWgZ8U6B2nbcBOlsTz53qAdUrzB7JupVkA', 1, 1, 0, 0, 17, 4.8, 34, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(11, 4, 13, 'Flocons Premium Poissons Tropicaux', 'flocons-premium-poissons-tropicaux', 'Nourriture en flocons pour poissons tropicaux. Formule enrichie en vitamines.', 'Nutrition équilibrée poissons', 12.90, NULL, 75, 'FLAKE-TROP-250', 'https://lh3.googleusercontent.com/aida-public/AB6AXuBqASyV7URQYtB7AufDQq3zsXl7XSv9FkFZ2rS7cvCY8SjFBpNtd44dmKeXIseCB9VNUADcDBsTZFb6lITNOv2FLAuO2mwJu_CqbbtFdL1nnCHvOh3gcNgP6etzuggSPuFxOHrjFd94gobAlyjJdlEbFYg-J5N8E9XGz90YLgl0NJs0XhBpPwWcq_WERVUX8hBqXIcEE5Wjyp6mSiNEde_o2uE8CHpFJxQr9iCfpJSCMSWgZ8U6B2nbcBOlsTz53qAdUrzB7JupVkA', 1, 0, 0, 0, 0, 4.6, 89, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(12, 5, 15, 'Mélange Graines Pigeons Sport 20kg', 'melange-graines-pigeons-sport-20kg', 'Mélange spécial pour pigeons de compétition. Haute énergie.', 'Graines haute performance', 42.00, 48.00, 30, 'PIG-SPORT-20', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCQXx6hiUnOCX6DzOYQFjw2OrpfOIMoRhffQpWaGCqdsUlortBdVqSqAR_xd6Fn6gCZZUFji4VdfAmXhX5s9pzWEhG5UH0lcp21npAq9fuGnRxAzrecick6_ERfAUEza0zCesRzz7kF6nnzRK2ioGzio6gLFkdV9n4QIJMRSH5Rb4rk8a7uyW_yBHJxsVn-H1Qv975itGYfYFVHtLTgQnig4KiM5eMzekLdU-8CzNjmglwOOp0ov466FOPQqMVrFSAg8dhT_-nR4Ko', 1, 0, 0, 0, 13, 4.7, 45, '2026-05-16 10:09:27', '2026-05-16 10:09:27');

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
('atpatLprJ8r1sZGprbXNQIoPnnLT22y0IRK29HC3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZjF0dlowbk5EenFXUEYxZVdNWFlCek9ibHdqODA3ckVadFlYeHB4bSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==', 1778938489),
('BteJJ7ZXsF1JJn75eDmansaIimyENTCqZ91f2xpO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMXR5ZnlORTBnbjN5RHJVZnBsU0tRbkU0Zld4UUJnNFE3c3c3Mk5XdyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778935952);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `slug`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Croquettes pour chien', 'croquettes-chien', NULL, 1, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(2, 1, 'Jouets pour chien', 'jouets-chien', NULL, 1, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(3, 1, 'Accessoires chien', 'accessoires-chien', NULL, 1, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(4, 1, 'Soins & Hygiène chien', 'soins-chien', NULL, 1, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(5, 2, 'Croquettes pour chat', 'croquettes-chat', NULL, 1, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(6, 2, 'Litière', 'litiere', NULL, 1, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(7, 2, 'Arbres à chat', 'arbres-chat', NULL, 1, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(8, 2, 'Jouets pour chat', 'jouets-chat', NULL, 1, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(9, 3, 'Cages & Volières', 'cages-volieres', NULL, 1, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(10, 3, 'Graines & Nutrition', 'graines-oiseaux', NULL, 1, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(11, 3, 'Jouets & Balançoires', 'jouets-oiseaux', NULL, 1, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(12, 4, 'Aquariums', 'aquariums', NULL, 1, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(13, 4, 'Nourriture poissons', 'nourriture-poissons', NULL, 1, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(14, 4, 'Accessoires aquarium', 'accessoires-aquarium', NULL, 1, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(15, 5, 'Graines pigeons', 'graines-pigeons', NULL, 1, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(16, 5, 'Cages pigeons', 'cages-pigeons', NULL, 1, '2026-05-16 10:09:27', '2026-05-16 10:09:27'),
(17, 5, 'Compléments pigeons', 'complements-pigeons', NULL, 1, '2026-05-16 10:09:27', '2026-05-16 10:09:27');

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
  `role` enum('admin','client') NOT NULL DEFAULT 'client',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin HMZ', 'admin@hmz.com', '2026-05-16 10:09:26', '$2y$12$da2.6F3zRqOZ1/rm9sQMo.IKJ5kC2TUCfgafELVSAO9EP1nSr9A/6', 'admin', NULL, '2026-05-16 10:09:26', '2026-05-16 10:09:26'),
(2, 'Client Test', 'client@test.com', '2026-05-16 10:09:26', '$2y$12$OXfKkhEyUMqhxTwcqYgkkOcf20ZJyV.78fWVsvy6jVdAggncMtUXi', 'client', NULL, '2026-05-16 10:09:26', '2026-05-16 10:09:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

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
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_order_number_index` (`order_number`),
  ADD KEY `orders_status_index` (`status`),
  ADD KEY `orders_payment_status_index` (`payment_status`),
  ADD KEY `orders_created_at_index` (`created_at`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_subcategory_id_foreign` (`subcategory_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_categories_slug_unique` (`slug`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

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
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `sub_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
