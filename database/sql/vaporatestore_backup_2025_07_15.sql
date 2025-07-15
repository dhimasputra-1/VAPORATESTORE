/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 8.0.30 : Database - vaporatestore
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`vaporatestore` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `vaporatestore`;

/*Table structure for table `cache` */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache` */

/*Table structure for table `cache_locks` */

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache_locks` */

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories` */

insert  into `categories`(`id`,`category_name`,`created_at`,`updated_at`) values 
(1,'MOD','2025-07-07 09:34:31','2025-07-07 09:34:31'),
(3,'POD','2025-07-12 14:31:53','2025-07-12 14:31:53'),
(4,'AKSESORIS','2025-07-12 14:32:02','2025-07-12 14:32:02'),
(5,'LIQUID','2025-07-12 14:32:09','2025-07-12 14:32:09');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
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

/*Data for the table `failed_jobs` */

/*Table structure for table `job_batches` */

DROP TABLE IF EXISTS `job_batches`;

CREATE TABLE `job_batches` (
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

/*Data for the table `job_batches` */

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
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

/*Data for the table `jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2025_07_07_083320_create_categories_table',1),
(5,'2025_07_07_085314_create_categories_table',2),
(6,'2025_07_07_085447_create_suppliers_table',3),
(7,'2025_07_07_085524_create_products_table',4),
(8,'2025_07_07_085549_create_transactions_table',5),
(9,'2025_07_07_085611_create_transactions_details_table',6),
(10,'2025_07_07_091131_create_personal_access_tokens_table',7),
(11,'2025_07_07_123431_add_role_to_users_table',8),
(12,'2025_07_12_085012_alter_transactions_add_qris_to_payment_method_enum',9),
(13,'2025_07_12_090016_add_payment_status_and_proof_to_transactions_table',10),
(14,'2025_07_12_091327_add_payment_channel_to_transactions_table',11),
(15,'2025_07_12_143434_add_category_id_to_products_table',12);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `supplier_id` bigint unsigned DEFAULT NULL,
  `price` decimal(12,2) NOT NULL,
  `stock` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_supplier_id_foreign` (`supplier_id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`product_name`,`category_id`,`supplier_id`,`price`,`stock`,`image`,`created_at`,`updated_at`) values 
(1,'Hexohm',1,1,3000000.00,2,NULL,'2025-07-07 19:44:46','2025-07-14 12:06:01'),
(3,'Panda',1,2,500000.00,4,NULL,'2025-07-10 07:50:56','2025-07-12 15:25:58'),
(4,'LIQUID  SONIX',5,2,150000.00,7,NULL,'2025-07-12 14:53:21','2025-07-14 12:06:01');

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
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

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values 
('bHkQcwRogdFPKRBb22M8DnPb5thAD7sbcWlpQhdM',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidXk3Znk5QWs1bXkyeFlzTVFRMEk3WFNIV2cyMnRLNEt6c2lFZ2hDQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQtcGVtaWxpayI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==',1752498668),
('VDJjkzh4CfImQdQwKsgno3tdHFwFEQkjC6OmC7OP',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZWcwc2YxUFNaMlNkSFF4cGtKaTJqZWQzSVI4NnFHUk11Ym5kUHhZdiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQtcGVtaWxpayI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==',1752554509);

/*Table structure for table `suppliers` */

DROP TABLE IF EXISTS `suppliers`;

CREATE TABLE `suppliers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `suppliers` */

insert  into `suppliers`(`id`,`supplier_name`,`phone`,`address`,`created_at`,`updated_at`) values 
(1,'kelvin','08456464898','sijunjung','2025-07-07 19:30:28','2025-07-07 19:37:39'),
(2,'nanda','05469865994','sijunjung','2025-07-07 19:37:52','2025-07-07 19:37:52');

/*Table structure for table `transaction_details` */

DROP TABLE IF EXISTS `transaction_details`;

CREATE TABLE `transaction_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_details_transaction_id_foreign` (`transaction_id`),
  KEY `transaction_details_product_id_foreign` (`product_id`),
  CONSTRAINT `transaction_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `transaction_details_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transaction_details` */

insert  into `transaction_details`(`id`,`transaction_id`,`product_id`,`quantity`,`price`,`subtotal`,`created_at`,`updated_at`) values 
(1,5,1,1,3000000.00,3000000.00,'2025-07-07 20:46:24','2025-07-07 20:46:24'),
(2,6,1,1,3000000.00,3000000.00,'2025-07-07 20:51:04','2025-07-07 20:51:04'),
(3,7,1,2,3000000.00,6000000.00,'2025-07-07 20:55:35','2025-07-07 20:55:35'),
(4,8,1,2,3000000.00,6000000.00,'2025-07-07 21:15:38','2025-07-07 21:15:38'),
(5,12,1,1,3000000.00,3000000.00,'2025-07-10 08:31:32','2025-07-10 08:31:32'),
(6,12,3,1,500000.00,500000.00,'2025-07-10 08:31:32','2025-07-10 08:31:32'),
(7,13,1,1,3000000.00,3000000.00,'2025-07-12 08:02:38','2025-07-12 08:02:38'),
(8,13,3,2,500000.00,1000000.00,'2025-07-12 08:02:38','2025-07-12 08:02:38'),
(9,14,1,1,3000000.00,3000000.00,'2025-07-12 08:52:17','2025-07-12 08:52:17'),
(10,15,1,1,3000000.00,3000000.00,'2025-07-12 09:03:10','2025-07-12 09:03:10'),
(11,16,1,1,3000000.00,3000000.00,'2025-07-12 09:06:38','2025-07-12 09:06:38'),
(12,17,1,1,3000000.00,3000000.00,'2025-07-12 09:15:40','2025-07-12 09:15:40'),
(13,18,3,1,500000.00,500000.00,'2025-07-12 09:33:47','2025-07-12 09:33:47'),
(14,19,1,1,3000000.00,3000000.00,'2025-07-12 09:39:18','2025-07-12 09:39:18'),
(15,20,1,1,3000000.00,3000000.00,'2025-07-12 15:25:58','2025-07-12 15:25:58'),
(16,20,4,1,150000.00,150000.00,'2025-07-12 15:25:58','2025-07-12 15:25:58'),
(17,20,3,2,500000.00,1000000.00,'2025-07-12 15:25:58','2025-07-12 15:25:58'),
(18,21,1,1,3000000.00,3000000.00,'2025-07-12 16:25:18','2025-07-12 16:25:18'),
(19,21,4,1,150000.00,150000.00,'2025-07-12 16:25:18','2025-07-12 16:25:18'),
(20,22,1,1,3000000.00,3000000.00,'2025-07-14 12:06:01','2025-07-14 12:06:01'),
(21,22,4,1,150000.00,150000.00,'2025-07-14 12:06:01','2025-07-14 12:06:01');

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaction_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `total_price` decimal(12,2) NOT NULL,
  `payment_status` enum('pending','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` enum('cash','transfer','ewallet','qris') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_channel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_date` datetime NOT NULL,
  `print_status` tinyint(1) NOT NULL DEFAULT '0',
  `printed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transactions_transaction_code_unique` (`transaction_code`),
  KEY `transactions_user_id_foreign` (`user_id`),
  CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transactions` */

insert  into `transactions`(`id`,`transaction_code`,`user_id`,`total_price`,`payment_status`,`payment_proof`,`payment_method`,`payment_channel`,`transaction_date`,`print_status`,`printed_at`,`created_at`,`updated_at`) values 
(5,'TRX20250707202929',1,3000000.00,'paid',NULL,'cash',NULL,'2025-07-07 00:00:00',0,NULL,'2025-07-07 20:46:24','2025-07-12 09:03:21'),
(6,'TRX20250707203732',1,3000000.00,'pending',NULL,'cash',NULL,'2025-07-08 00:00:00',0,NULL,'2025-07-07 20:51:04','2025-07-07 20:51:04'),
(7,'TRX20250707203733',1,6000000.00,'pending',NULL,'cash',NULL,'2025-07-08 00:00:00',0,NULL,'2025-07-07 20:55:35','2025-07-07 20:55:35'),
(8,'TRX20250707203734',1,6000000.00,'pending',NULL,'cash',NULL,'2025-07-08 00:00:00',0,NULL,'2025-07-07 21:15:38','2025-07-07 21:15:38'),
(12,'TRX20250707203735',1,3500000.00,'pending',NULL,'cash',NULL,'2025-07-10 00:00:00',0,NULL,'2025-07-10 08:31:32','2025-07-10 08:31:32'),
(13,'TRX20250707203736',1,4000000.00,'pending',NULL,'cash',NULL,'2025-07-12 00:00:00',0,NULL,'2025-07-12 08:02:38','2025-07-12 08:02:38'),
(14,'TRX20250707203737',1,3000000.00,'pending',NULL,'qris',NULL,'2025-07-12 00:00:00',0,NULL,'2025-07-12 08:52:17','2025-07-12 08:52:17'),
(15,'TRX20250707203738',1,3000000.00,'paid',NULL,'transfer',NULL,'2025-07-12 00:00:00',0,NULL,'2025-07-12 09:03:10','2025-07-12 09:08:05'),
(16,'TRX20250707203739',1,3000000.00,'paid',NULL,'ewallet','OVO','2025-07-12 00:00:00',0,NULL,'2025-07-12 09:06:38','2025-07-12 09:30:29'),
(17,'TRX20250707203740',1,3000000.00,'paid',NULL,'transfer','BCA','2025-07-12 00:00:00',0,NULL,'2025-07-12 09:15:40','2025-07-12 09:23:24'),
(18,'TRX20250707203741',1,500000.00,'paid',NULL,'transfer','BRI','2025-07-12 00:00:00',0,NULL,'2025-07-12 09:33:47','2025-07-12 09:38:42'),
(19,'TRX20250707203742',1,3000000.00,'paid',NULL,'ewallet','ShopeePay','2025-07-12 00:00:00',0,NULL,'2025-07-12 09:39:18','2025-07-12 09:48:58'),
(20,'TRX20250707203743',1,4150000.00,'paid',NULL,'transfer','Mandiri','2025-07-12 00:00:00',0,NULL,'2025-07-12 15:25:58','2025-07-12 15:26:20'),
(21,'TRX20250712162452',1,3150000.00,'paid',NULL,'transfer','BNI','2025-07-12 00:00:00',0,NULL,'2025-07-12 16:25:18','2025-07-12 16:25:43'),
(22,'TRX20250714120543',1,3150000.00,'pending',NULL,'transfer',NULL,'2025-07-14 00:00:00',0,NULL,'2025-07-14 12:06:01','2025-07-14 12:06:01');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('kasir','pemilik') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'kasir',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`role`,`remember_token`,`created_at`,`updated_at`) values 
(1,'dhimas','dhimas@gmail.com',NULL,'$2y$12$bZcbuRqCh.o7dDULdZgXduyeBqqoX9HJhGSNWzl01MKNm7KsYVw8K','kasir',NULL,'2025-07-07 10:57:51','2025-07-07 10:57:51'),
(2,'nanda','nanda@gmail.com',NULL,'$2y$12$PTDWoZPBjqqfA/BCMsHe0u9xLNAosZFa2TDOptI/FoX5Q2epW4Vfe','pemilik',NULL,'2025-07-07 11:10:30','2025-07-07 11:10:30'),
(3,'ihza','ihza@gmail.com',NULL,'$2y$12$lV1U3GRFHwA2ONxvUd5/nO4Xp7eoKQrgfI/XMEAEdIs7l0zN3hx/O','kasir',NULL,'2025-07-07 11:20:45','2025-07-07 11:20:45'),
(4,'attaya','attaya@gmail.com',NULL,'$2y$12$RU9iY/8fxBLx9jdO8sXfPOGtT1.DxG0g5IggU5on7jFkUDfKyHvl6','kasir',NULL,'2025-07-07 12:38:18','2025-07-07 12:38:18');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
