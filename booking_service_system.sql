/*
 Navicat Premium Dump SQL

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 80300 (8.3.0)
 Source Host           : localhost:3306
 Source Schema         : booking_service_system

 Target Server Type    : MySQL
 Target Server Version : 80300 (8.3.0)
 File Encoding         : 65001

 Date: 27/02/2025 16:09:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for brand_categories
-- ----------------------------
DROP TABLE IF EXISTS `brand_categories`;
CREATE TABLE `brand_categories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `category_id` bigint UNSIGNED NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT 1,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of brand_categories
-- ----------------------------
INSERT INTO `brand_categories` VALUES (1, 'Ford', 5, 1, 1, NULL, '2025-02-26 10:00:45', '2025-02-26 10:21:50');
INSERT INTO `brand_categories` VALUES (2, 'BMW', 4, 1, 1, NULL, '2025-02-26 10:04:06', '2025-02-27 09:32:25');
INSERT INTO `brand_categories` VALUES (3, 'Giant', 3, 1, 1, NULL, '2025-02-26 10:18:40', '2025-02-26 10:23:57');
INSERT INTO `brand_categories` VALUES (4, 'heheh', 3, 0, 1, '2025-02-26 10:24:13', '2025-02-26 10:24:07', '2025-02-26 10:24:13');
INSERT INTO `brand_categories` VALUES (5, 'pp', 3, 1, 1, '2025-02-26 10:29:22', '2025-02-26 10:29:18', '2025-02-26 10:29:22');
INSERT INTO `brand_categories` VALUES (6, 'ff', 3, 1, 1, '2025-02-26 10:30:08', '2025-02-26 10:29:48', '2025-02-26 10:30:08');
INSERT INTO `brand_categories` VALUES (7, 'Mercedes', 5, 1, 1, NULL, '2025-02-27 10:04:34', '2025-02-27 10:12:08');

-- ----------------------------
-- Table structure for business_settings
-- ----------------------------
DROP TABLE IF EXISTS `business_settings`;
CREATE TABLE `business_settings`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `value` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of business_settings
-- ----------------------------
INSERT INTO `business_settings` VALUES (1, 'language', '[{\"id\":\"1\",\"name\":\"english\",\"direction\":\"ltr\",\"code\":\"en\",\"status\":1,\"default\":true},{\"id\":2,\"name\":\"Khmer\",\"code\":\"kh\",\"direction\":\"ltr\",\"status\":1,\"default\":false}]', NULL, NULL);
INSERT INTO `business_settings` VALUES (2, 'pnc_language', '[\"en\",\"kh\"]', NULL, NULL);
INSERT INTO `business_settings` VALUES (3, 'web_header_logo', NULL, NULL, NULL);
INSERT INTO `business_settings` VALUES (4, 'fav_icon', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT 1,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'heheh', 'heheh', 1, 1, '2025-02-26 09:59:42', '2025-02-26 10:00:11', '2025-02-26 10:00:11');
INSERT INTO `categories` VALUES (2, 'hehehe', 'hehehe', 1, 1, '2025-02-26 10:00:23', '2025-02-26 10:21:29', '2025-02-26 10:21:29');
INSERT INTO `categories` VALUES (3, 'Bike', 'bike', 1, 1, '2025-02-26 10:21:11', '2025-02-26 10:21:11', NULL);
INSERT INTO `categories` VALUES (4, 'Moto', 'moto', 1, 1, '2025-02-26 10:21:20', '2025-02-26 10:21:20', NULL);
INSERT INTO `categories` VALUES (5, 'Car', 'car', 1, 1, '2025-02-26 10:21:25', '2025-02-27 10:04:39', NULL);

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `country` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1, 'Sros', 'Thai', '0123456789', 'papathai@gmail.com', '1740553752-ai3.png', 'North Korea', 1, '2025-02-26 14:09:12', '2025-02-26 14:09:12', NULL, NULL);
INSERT INTO `customers` VALUES (2, 'Chan', 'Darong', '012 345 6781', 'darong@gmail.com', '1740563597-2024-11-28-674818d3d623e.jpg', 'Germany', 1, '2025-02-26 15:14:47', '2025-02-27 15:31:35', NULL, NULL);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2022_12_15_232210_create_business_settings_table', 1);
INSERT INTO `migrations` VALUES (6, '2022_12_17_083144_create_permission_tables', 1);
INSERT INTO `migrations` VALUES (7, '2022_12_19_054410_create_products_table', 1);
INSERT INTO `migrations` VALUES (8, '2023_08_25_092523_create_translations_table', 1);
INSERT INTO `migrations` VALUES (9, '2023_08_26_035115_add_some_column_to_users_table', 1);
INSERT INTO `migrations` VALUES (10, '2023_08_28_112457_create_categories_table', 1);
INSERT INTO `migrations` VALUES (11, '2023_08_29_144037_add_columns_to_products_table', 1);
INSERT INTO `migrations` VALUES (12, '2023_08_30_140724_add_column_user_id_to_users_table', 1);
INSERT INTO `migrations` VALUES (13, '2025_02_20_105147_create_sliders_table', 2);
INSERT INTO `migrations` VALUES (14, '2025_02_20_112948_add_missing_fields_to_products_table', 2);
INSERT INTO `migrations` VALUES (15, '2025_02_20_113712_add_deleted_at_to_categories_table', 2);
INSERT INTO `migrations` VALUES (16, '2025_02_20_155237_create_brand_categories_table', 2);
INSERT INTO `migrations` VALUES (17, '2025_02_21_083846_create_customers_table', 2);
INSERT INTO `migrations` VALUES (18, '2025_02_21_085302_create_promotions_table', 2);
INSERT INTO `migrations` VALUES (19, '2025_02_21_085506_create_promotion_products_table', 2);
INSERT INTO `migrations` VALUES (20, '2025_02_21_093026_drop_model_id_from_products_table', 2);
INSERT INTO `migrations` VALUES (21, '2025_02_21_093135_add_brand_category_id_to_products_table', 2);
INSERT INTO `migrations` VALUES (22, '2025_02_21_110121_create_transactions_table', 2);
INSERT INTO `migrations` VALUES (23, '2025_02_21_110320_create_transaction_sell_lines_table', 2);
INSERT INTO `migrations` VALUES (24, '2025_02_21_113324_add_created_by_to_customers_table', 2);
INSERT INTO `migrations` VALUES (25, '2025_02_21_133637_add_updated_by_to_transactions_table', 2);
INSERT INTO `migrations` VALUES (26, '2025_02_21_133733_add_deleted_at_to_transaction_sell_lines', 2);
INSERT INTO `migrations` VALUES (27, '2025_02_21_133733_add_deleted_at_to_transactions', 2);
INSERT INTO `migrations` VALUES (28, '2025_02_21_141002_add_deleted_at_to_customers', 2);
INSERT INTO `migrations` VALUES (29, '2025_02_22_095235_create_product_dates_table', 2);
INSERT INTO `migrations` VALUES (30, '2025_02_22_161311_add_price_to_product_dates_table', 2);
INSERT INTO `migrations` VALUES (31, '2025_02_25_161311_add_new_field_to_permissions_table', 2);
INSERT INTO `migrations` VALUES (32, '2025_02_26_113341_create_promotion_categories_table', 3);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES (1, 'App\\Models\\User', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `display` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `module` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'user.view', 'web', '2025-02-26 09:13:47', '2025-02-26 09:13:47', 'View Users', 'User');
INSERT INTO `permissions` VALUES (2, 'user.create', 'web', '2025-02-26 09:13:47', '2025-02-26 09:13:47', 'Create User', 'User');
INSERT INTO `permissions` VALUES (3, 'user.edit', 'web', '2025-02-26 09:13:48', '2025-02-26 09:13:48', 'Edit User', 'User');
INSERT INTO `permissions` VALUES (4, 'user.delete', 'web', '2025-02-26 09:13:48', '2025-02-26 09:13:48', 'Delete User', 'User');
INSERT INTO `permissions` VALUES (5, 'product.view', 'web', '2025-02-26 09:13:48', '2025-02-26 09:13:48', 'View Products', 'Product');
INSERT INTO `permissions` VALUES (6, 'product.create', 'web', '2025-02-26 09:13:48', '2025-02-26 09:13:48', 'Create Product', 'Product');
INSERT INTO `permissions` VALUES (7, 'product.edit', 'web', '2025-02-26 09:13:48', '2025-02-26 09:13:48', 'Edit Product', 'Product');
INSERT INTO `permissions` VALUES (8, 'product.delete', 'web', '2025-02-26 09:13:48', '2025-02-26 09:13:48', 'Delete Product', 'Product');
INSERT INTO `permissions` VALUES (9, 'product.book', 'web', '2025-02-26 09:13:48', '2025-02-26 09:13:48', 'Book Product', 'Product');
INSERT INTO `permissions` VALUES (10, 'category.view', 'web', '2025-02-26 09:13:48', '2025-02-26 09:13:48', 'View Categories', 'Category');
INSERT INTO `permissions` VALUES (11, 'category.create', 'web', '2025-02-26 09:13:48', '2025-02-26 09:13:48', 'Create Category', 'Category');
INSERT INTO `permissions` VALUES (12, 'category.edit', 'web', '2025-02-26 09:13:48', '2025-02-26 09:13:48', 'Edit Category', 'Category');
INSERT INTO `permissions` VALUES (13, 'category.delete', 'web', '2025-02-26 09:13:48', '2025-02-26 09:13:48', 'Delete Category', 'Category');
INSERT INTO `permissions` VALUES (14, 'brand.view', 'web', '2025-02-26 09:13:48', '2025-02-26 09:13:48', 'View Brands', 'Brand');
INSERT INTO `permissions` VALUES (15, 'brand.create', 'web', '2025-02-26 09:13:48', '2025-02-26 09:13:48', 'Create Brand', 'Brand');
INSERT INTO `permissions` VALUES (16, 'brand.edit', 'web', '2025-02-26 09:13:48', '2025-02-26 09:13:48', 'Edit Brand', 'Brand');
INSERT INTO `permissions` VALUES (17, 'brand.delete', 'web', '2025-02-26 09:13:49', '2025-02-26 09:13:49', 'Delete Brand', 'Brand');
INSERT INTO `permissions` VALUES (18, 'transaction.view', 'web', '2025-02-26 09:13:49', '2025-02-26 09:13:49', 'View Transactions', 'Transaction');
INSERT INTO `permissions` VALUES (19, 'transaction.create', 'web', '2025-02-26 09:13:49', '2025-02-26 09:13:49', 'Create Transaction', 'Transaction');
INSERT INTO `permissions` VALUES (20, 'transaction.edit', 'web', '2025-02-26 09:13:49', '2025-02-26 09:13:49', 'Edit Transaction', 'Transaction');
INSERT INTO `permissions` VALUES (21, 'transaction.delete', 'web', '2025-02-26 09:13:49', '2025-02-26 09:13:49', 'Delete Transaction', 'Transaction');
INSERT INTO `permissions` VALUES (22, 'transaction.confirm', 'web', '2025-02-26 09:13:49', '2025-02-26 09:13:49', 'Confirm Transaction', 'Transaction');
INSERT INTO `permissions` VALUES (23, 'transaction.request', 'web', '2025-02-26 09:13:49', '2025-02-26 09:13:49', 'Request Transaction', 'Transaction');
INSERT INTO `permissions` VALUES (24, 'setting.view', 'web', '2025-02-26 09:13:49', '2025-02-26 09:13:49', 'View Settings', 'Settings');
INSERT INTO `permissions` VALUES (25, 'setting.edit', 'web', '2025-02-26 09:13:49', '2025-02-26 09:13:49', 'Edit Settings', 'Settings');
INSERT INTO `permissions` VALUES (26, 'slider.view', 'web', '2025-02-26 09:13:50', '2025-02-26 09:13:50', 'View Sliders', 'Slider');
INSERT INTO `permissions` VALUES (27, 'slider.create', 'web', '2025-02-26 09:13:50', '2025-02-26 09:13:50', 'Create Slider', 'Slider');
INSERT INTO `permissions` VALUES (28, 'slider.edit', 'web', '2025-02-26 09:13:50', '2025-02-26 09:13:50', 'Edit Slider', 'Slider');
INSERT INTO `permissions` VALUES (29, 'slider.delete', 'web', '2025-02-26 09:13:50', '2025-02-26 09:13:50', 'Delete Slider', 'Slider');
INSERT INTO `permissions` VALUES (30, 'promotion.view', 'web', '2025-02-26 09:13:50', '2025-02-26 09:13:50', 'View Promotions', 'Promotion');
INSERT INTO `permissions` VALUES (31, 'promotion.create', 'web', '2025-02-26 09:13:50', '2025-02-26 09:13:50', 'Create Promotion', 'Promotion');
INSERT INTO `permissions` VALUES (32, 'promotion.edit', 'web', '2025-02-26 09:13:50', '2025-02-26 09:13:50', 'Edit Promotion', 'Promotion');
INSERT INTO `permissions` VALUES (33, 'promotion.delete', 'web', '2025-02-26 09:13:50', '2025-02-26 09:13:50', 'Delete Promotion', 'Promotion');
INSERT INTO `permissions` VALUES (34, 'customer.view', 'web', '2025-02-26 09:13:50', '2025-02-26 09:13:50', 'View Customers', 'Customer');
INSERT INTO `permissions` VALUES (35, 'customer.create', 'web', '2025-02-26 09:13:50', '2025-02-26 09:13:50', 'Create Customer', 'Customer');
INSERT INTO `permissions` VALUES (36, 'customer.edit', 'web', '2025-02-26 09:13:50', '2025-02-26 09:13:50', 'Edit Customer', 'Customer');
INSERT INTO `permissions` VALUES (37, 'customer.delete', 'web', '2025-02-26 09:13:50', '2025-02-26 09:13:50', 'Delete Customer', 'Customer');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for product_dates
-- ----------------------------
DROP TABLE IF EXISTS `product_dates`;
CREATE TABLE `product_dates`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `number` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` decimal(11, 2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_dates
-- ----------------------------
INSERT INTO `product_dates` VALUES (1, 2, '2025-02-27', '2025-02-27', 1, 20, '2025-02-26 10:52:55', '2025-02-26 10:52:55', 1200.00);
INSERT INTO `product_dates` VALUES (2, 2, '2025-02-28', '2025-02-28', 1, 10, '2025-02-26 10:53:25', '2025-02-26 10:53:25', 2000.00);
INSERT INTO `product_dates` VALUES (3, 2, '2025-03-01', '2025-03-01', 0, 5, '2025-02-26 10:53:41', '2025-02-26 10:54:14', 1500.00);

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `event_id` bigint UNSIGNED NULL DEFAULT NULL,
  `category_id` bigint UNSIGNED NULL DEFAULT NULL,
  `price` decimal(11, 2) NOT NULL DEFAULT 0.00,
  `brand_category_id` bigint UNSIGNED NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `partner_id` bigint UNSIGNED NULL DEFAULT NULL,
  `discount_type` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'percent',
  `discount` decimal(8, 2) NOT NULL DEFAULT 0.00,
  `status` int NOT NULL DEFAULT 1,
  `number_available` int NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'BWM S 1000 RR', 1, 4, 12000.00, 2, '1740541233-bmw-s1000rr-standard1737458444675.webp', 1, NULL, '2025-02-26 10:40:33', '2025-02-26 10:47:44', 1, 'percent', 10.00, 1, 10, 'Best Selling');
INSERT INTO `products` VALUES (2, 'Giant Mountain Bike', 2, 3, 1000.00, 3, '1740541728-BMT26764-15.webp', 1, NULL, '2025-02-26 10:48:48', '2025-02-27 09:31:58', 2, 'percent', 20.00, 1, 20, 'Best Selling');
INSERT INTO `products` VALUES (3, 'Ford Car', 99, 4, 99.00, 3, '1740541823-pngwing.com (1).png', 1, '2025-02-26 10:52:32', '2025-02-26 10:49:37', '2025-02-26 10:52:32', 99, 'fix', 99.00, 0, 99, '99');
INSERT INTO `products` VALUES (4, 'Mercedes-AMG-GT-Coupe', 10, 5, 20000.00, 7, '1740626783-mercedes.jpg', 1, NULL, '2025-02-27 10:22:41', '2025-02-27 10:26:23', 1, 'percent', 10.00, 1, 5, 'Modern Car');

-- ----------------------------
-- Table structure for promotion_categories
-- ----------------------------
DROP TABLE IF EXISTS `promotion_categories`;
CREATE TABLE `promotion_categories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `promotion_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `promotion_categories_promotion_id_foreign`(`promotion_id` ASC) USING BTREE,
  INDEX `promotion_categories_category_id_foreign`(`category_id` ASC) USING BTREE,
  CONSTRAINT `promotion_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `promotion_categories_promotion_id_foreign` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of promotion_categories
-- ----------------------------
INSERT INTO `promotion_categories` VALUES (2, 1, 3, '2025-02-26 11:37:53', '2025-02-26 11:37:53');

-- ----------------------------
-- Table structure for promotion_products
-- ----------------------------
DROP TABLE IF EXISTS `promotion_products`;
CREATE TABLE `promotion_products`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `promotion_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `promotion_products_promotion_id_foreign`(`promotion_id` ASC) USING BTREE,
  INDEX `promotion_products_product_id_foreign`(`product_id` ASC) USING BTREE,
  CONSTRAINT `promotion_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `promotion_products_promotion_id_foreign` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of promotion_products
-- ----------------------------
INSERT INTO `promotion_products` VALUES (1, 1, 1, '2025-02-26 13:41:58', '2025-02-26 13:41:58');
INSERT INTO `promotion_products` VALUES (2, 4, 2, '2025-02-26 13:51:53', '2025-02-26 13:51:53');

-- ----------------------------
-- Table structure for promotions
-- ----------------------------
DROP TABLE IF EXISTS `promotions`;
CREATE TABLE `promotions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `discount_type` enum('fix','percent') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `discount_value` decimal(10, 2) NOT NULL,
  `promotion_type` enum('product','category') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `default_key` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of promotions
-- ----------------------------
INSERT INTO `promotions` VALUES (1, 'Mega Sale', 'Promotion Mega Sale', 'fix', 99.00, 'product', '2025-02-01', '2025-03-01', '1740552151-rb_2149830269.png', NULL, '2025-02-26 11:28:21', '2025-02-26 13:53:34');
INSERT INTO `promotions` VALUES (4, 'Black Friday', 'Big Promotion for Black Friday', 'percent', 10.00, 'product', '2025-02-21', '2025-02-28', '1740552712-34012994_black_friday_facebook_banner_06.jpg', NULL, '2025-02-26 13:51:52', '2025-02-26 14:03:42');

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id` ASC) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES (1, 2);
INSERT INTO `role_has_permissions` VALUES (2, 2);
INSERT INTO `role_has_permissions` VALUES (5, 2);
INSERT INTO `role_has_permissions` VALUES (6, 2);
INSERT INTO `role_has_permissions` VALUES (10, 2);
INSERT INTO `role_has_permissions` VALUES (11, 2);
INSERT INTO `role_has_permissions` VALUES (12, 2);
INSERT INTO `role_has_permissions` VALUES (13, 2);
INSERT INTO `role_has_permissions` VALUES (14, 2);
INSERT INTO `role_has_permissions` VALUES (15, 2);
INSERT INTO `role_has_permissions` VALUES (16, 2);
INSERT INTO `role_has_permissions` VALUES (17, 2);
INSERT INTO `role_has_permissions` VALUES (26, 2);
INSERT INTO `role_has_permissions` VALUES (30, 2);
INSERT INTO `role_has_permissions` VALUES (5, 3);
INSERT INTO `role_has_permissions` VALUES (9, 3);
INSERT INTO `role_has_permissions` VALUES (5, 4);
INSERT INTO `role_has_permissions` VALUES (10, 4);
INSERT INTO `role_has_permissions` VALUES (18, 5);
INSERT INTO `role_has_permissions` VALUES (20, 5);
INSERT INTO `role_has_permissions` VALUES (22, 5);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'admin', 'web', NULL, NULL);
INSERT INTO `roles` VALUES (2, 'member', 'web', NULL, NULL);
INSERT INTO `roles` VALUES (3, 'customer', 'web', NULL, NULL);
INSERT INTO `roles` VALUES (4, 'visitor', 'web', NULL, NULL);
INSERT INTO `roles` VALUES (5, 'partner', 'web', NULL, NULL);

-- ----------------------------
-- Table structure for sliders
-- ----------------------------
DROP TABLE IF EXISTS `sliders`;
CREATE TABLE `sliders`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `default_key` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sliders
-- ----------------------------
INSERT INTO `sliders` VALUES (1, 'Slider 1', '2025-02-27-67c01939aae71.jpg', NULL, '2025-02-27 14:50:17', '2025-02-27 14:50:17');
INSERT INTO `sliders` VALUES (2, 'Slider 2', '2025-02-27-67c0220d8c644.jpg', NULL, '2025-02-27 15:07:55', '2025-02-27 15:27:57');

-- ----------------------------
-- Table structure for transaction_selllines
-- ----------------------------
DROP TABLE IF EXISTS `transaction_selllines`;
CREATE TABLE `transaction_selllines`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `discount_type` enum('fix','percent') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `discount_amount` decimal(10, 2) NOT NULL,
  `sub_total` decimal(10, 2) NOT NULL,
  `final_total` decimal(10, 2) NOT NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `transaction_selllines_transaction_id_foreign`(`transaction_id` ASC) USING BTREE,
  INDEX `transaction_selllines_product_id_foreign`(`product_id` ASC) USING BTREE,
  CONSTRAINT `transaction_selllines_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `transaction_selllines_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaction_selllines
-- ----------------------------
INSERT INTO `transaction_selllines` VALUES (1, 1, 1, 5, 'percent', 10.00, 60000.00, 54000.00, 1, '2025-02-26 14:10:08', '2025-02-26 14:10:52', '2025-02-26 14:10:52');
INSERT INTO `transaction_selllines` VALUES (2, 1, 1, 5, 'percent', 10.00, 60000.00, 54000.00, 1, '2025-02-26 14:10:52', '2025-02-26 14:45:03', '2025-02-26 14:45:03');
INSERT INTO `transaction_selllines` VALUES (3, 1, 1, 5, 'percent', 10.00, 60000.00, 54000.00, 1, '2025-02-26 14:45:04', '2025-02-26 14:45:14', '2025-02-26 14:45:14');
INSERT INTO `transaction_selllines` VALUES (4, 1, 1, 5, 'percent', 10.00, 60000.00, 54000.00, 1, '2025-02-26 14:45:14', '2025-02-26 14:45:14', NULL);
INSERT INTO `transaction_selllines` VALUES (5, 2, 2, 2, 'fix', 50.00, 2000.00, 1950.00, 1, '2025-02-26 14:51:42', '2025-02-26 14:51:42', NULL);
INSERT INTO `transaction_selllines` VALUES (6, 3, 1, 2, 'fix', 100.00, 24000.00, 23900.00, 1, '2025-02-26 15:04:11', '2025-02-26 15:04:11', NULL);
INSERT INTO `transaction_selllines` VALUES (7, 4, 1, 2, 'percent', 50.00, 24000.00, 12000.00, 1, '2025-02-26 15:06:55', '2025-02-26 15:09:25', '2025-02-26 15:09:25');
INSERT INTO `transaction_selllines` VALUES (8, 4, 2, 2, 'fix', 100.00, 2000.00, 1900.00, 1, '2025-02-26 15:06:55', '2025-02-26 15:09:25', '2025-02-26 15:09:25');
INSERT INTO `transaction_selllines` VALUES (9, 4, 1, 2, 'percent', 50.00, 24000.00, 12000.00, 1, '2025-02-26 15:09:25', '2025-02-26 15:15:39', '2025-02-26 15:15:39');
INSERT INTO `transaction_selllines` VALUES (10, 4, 2, 2, 'fix', 100.00, 2000.00, 1900.00, 1, '2025-02-26 15:09:25', '2025-02-26 15:15:39', '2025-02-26 15:15:39');
INSERT INTO `transaction_selllines` VALUES (11, 4, 1, 2, 'percent', 50.00, 24000.00, 12000.00, 1, '2025-02-26 15:15:39', '2025-02-26 15:15:39', '2025-02-26 15:15:39');
INSERT INTO `transaction_selllines` VALUES (12, 4, 2, 2, 'fix', 100.00, 2000.00, 1900.00, 1, '2025-02-26 15:15:39', '2025-02-26 15:15:39', '2025-02-26 15:15:39');
INSERT INTO `transaction_selllines` VALUES (13, 4, 1, 2, 'percent', 50.00, 24000.00, 12000.00, 1, '2025-02-26 15:15:39', '2025-02-26 15:16:53', '2025-02-26 15:16:53');
INSERT INTO `transaction_selllines` VALUES (14, 4, 2, 2, 'fix', 100.00, 2000.00, 1900.00, 1, '2025-02-26 15:15:39', '2025-02-26 15:16:53', '2025-02-26 15:16:53');
INSERT INTO `transaction_selllines` VALUES (15, 4, 1, 2, 'percent', 50.00, 24000.00, 12000.00, 1, '2025-02-26 15:16:53', '2025-02-26 15:17:24', '2025-02-26 15:17:24');
INSERT INTO `transaction_selllines` VALUES (16, 4, 1, 2, 'percent', 50.00, 24000.00, 12000.00, 1, '2025-02-26 15:17:24', '2025-02-26 15:21:18', '2025-02-26 15:21:18');
INSERT INTO `transaction_selllines` VALUES (17, 4, 1, 2, 'percent', 50.00, 24000.00, 12000.00, 1, '2025-02-26 15:21:18', '2025-02-26 15:21:18', NULL);
INSERT INTO `transaction_selllines` VALUES (18, 4, 2, 2, 'fix', 500.00, 2000.00, 1500.00, 1, '2025-02-26 15:21:18', '2025-02-26 15:21:18', NULL);

-- ----------------------------
-- Table structure for transactions
-- ----------------------------
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `guest_info` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sub_total` decimal(10, 2) NOT NULL,
  `final_total` decimal(10, 2) NOT NULL,
  `invoice_no` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `booking_date` date NOT NULL,
  `payment_method` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `payment_status` enum('paid','unpaid') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` enum('request','confirmed','cancel') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `transactions_invoice_no_unique`(`invoice_no` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transactions
-- ----------------------------
INSERT INTO `transactions` VALUES (1, 1, 1, '[{\"first_name\":\"Sros\",\"last_name\":\"Thai\",\"email\":\"papathai@gmail.com\"}]', 60000.00, 54000.00, 'INV-67BEBE5089B0B', '2025-02-27', 'cash', 'paid', 'confirmed', 1, 1, '2025-02-26 14:10:08', '2025-02-26 14:45:14', NULL);
INSERT INTO `transactions` VALUES (2, 1, 1, '[{\"first_name\":\"Sros\",\"last_name\":\"Thai\",\"email\":\"papathai@gmail.com\"}]', 2000.00, 1900.00, 'INV-67BEC80DED2DA', '2025-02-26', 'credit_card', 'unpaid', 'request', 1, NULL, '2025-02-26 14:51:41', '2025-02-26 14:51:41', NULL);
INSERT INTO `transactions` VALUES (3, 1, 1, '[{\"first_name\":\"Sros\",\"last_name\":\"Thai\",\"email\":\"papathai@gmail.com\"}]', 24000.00, 23800.00, 'INV-67BECAFB00E4D', '2025-03-01', 'bank_transfer', 'unpaid', 'request', 1, NULL, '2025-02-26 15:04:11', '2025-02-26 15:04:11', NULL);
INSERT INTO `transactions` VALUES (4, 1, 2, '[{\"first_name\":\"Chan\",\"last_name\":\"Darong\",\"email\":\"darong@gmail.com\"}]', 26000.00, 13000.00, 'INV-67BECB9FA65A5', '2025-03-01', 'credit_card', 'unpaid', 'cancel', 1, 1, '2025-02-26 15:06:55', '2025-02-26 15:21:18', NULL);

-- ----------------------------
-- Table structure for translations
-- ----------------------------
DROP TABLE IF EXISTS `translations`;
CREATE TABLE `translations`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `translationable_type` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `translationable_id` bigint UNSIGNED NULL DEFAULT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `key` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `value` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of translations
-- ----------------------------
INSERT INTO `translations` VALUES (1, 'App\\Models\\BrandCategory', 2, 'kh', 'name', 'eh eh eh', NULL, NULL);
INSERT INTO `translations` VALUES (2, 'App\\Models\\BrandCategory', 3, 'kh', 'name', 'Model 1', NULL, NULL);
INSERT INTO `translations` VALUES (5, 'App\\Models\\Product', 2, 'kh', 'name', 'Giant Mountain Bike', NULL, NULL);
INSERT INTO `translations` VALUES (6, 'App\\Models\\BrandCategory', 7, 'kh', 'name', 'Mercedes', NULL, NULL);
INSERT INTO `translations` VALUES (7, 'App\\Models\\Product', 4, 'kh', 'name', 'Mercedes-AMG-GT-Coupe', NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `first_name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `telegram` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'superadmin', 'admin@gmail.com', NULL, '$2y$10$78nrUBLUIqOO0lWLNWCCde1Njlk4Vdq90Bh6SaevJFCIDJr0xGe5K', NULL, '2023-09-07 17:11:02', '2025-02-27 09:26:13', 'Super', 'Admin', '012 345 678', NULL, NULL, NULL, '1');

SET FOREIGN_KEY_CHECKS = 1;
