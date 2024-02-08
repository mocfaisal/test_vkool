/*
 Navicat Premium Data Transfer

 Source Server         : Localhost (Laragon)
 Source Server Type    : MySQL
 Source Server Version : 50740 (5.7.40)
 Source Host           : localhost:3306
 Source Schema         : tes_vkool

 Target Server Type    : MySQL
 Target Server Version : 50740 (5.7.40)
 File Encoding         : 65001

 Date: 08/02/2024 15:40:08
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cp_menu
-- ----------------------------
DROP TABLE IF EXISTS `cp_menu`;
CREATE TABLE `cp_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `slider` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `url` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sort_no` int(11) NULL DEFAULT NULL,
  `depth_level` int(11) NULL DEFAULT NULL COMMENT 'tingkat kedalaman level menu',
  `is_external` int(11) NULL DEFAULT 0 COMMENT '0=default, link menu biasa, 1=aplikasi eksternal',
  `is_navigated` int(11) NULL DEFAULT 0 COMMENT '0=default, Menu tidak SPA, 1=Menu SPA',
  `is_active` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '1' COMMENT '0=tidak aktif, 1=aktif',
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `date_create` datetime NULL DEFAULT NULL,
  `user_create` int(11) NULL DEFAULT NULL,
  `date_update` datetime NULL DEFAULT NULL,
  `user_update` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of cp_menu
-- ----------------------------
INSERT INTO `cp_menu` VALUES (1, 'Dashboard', 0, 'fas fa-chart-line', '0', 'home', 1, 1, 0, 1, '1', 'Dashboard', '2023-09-22 07:52:37', NULL, '2024-02-08 08:23:33', NULL);
INSERT INTO `cp_menu` VALUES (3, 'Master Data', 0, 'fas fa-boxes', '1', '', 6, 1, 0, 0, '0', '', '2023-09-22 08:00:10', NULL, '2024-02-08 08:23:33', NULL);
INSERT INTO `cp_menu` VALUES (13, 'Settings', 0, 'fas fa-cogs', '1', '', 7, 1, 0, 0, '0', 'App Settings', '2023-10-05 14:11:45', NULL, '2024-02-08 08:23:33', NULL);
INSERT INTO `cp_menu` VALUES (14, 'Menu', 13, 'fas fa-th-list', '0', 'backend.admin.settings.menu', 1, 2, 0, 0, '1', 'Menu', '2023-10-05 15:16:27', NULL, '2024-02-08 08:23:33', NULL);
INSERT INTO `cp_menu` VALUES (15, 'Warna', 3, 'fas fa-eye-dropper', '0', '', 1, 2, 0, 0, '1', '', '2024-01-22 00:57:56', NULL, '2024-02-08 08:23:33', NULL);
INSERT INTO `cp_menu` VALUES (16, 'Inventory', 0, 'fab fa-dropbox', '0', 'backend.master.inventory', 3, 1, 0, 1, '1', '', '2024-02-03 19:00:50', NULL, '2024-02-08 08:23:33', NULL);
INSERT INTO `cp_menu` VALUES (17, 'Simulasi', 0, 'fas fa-tv', '0', 'backend.simulation.index', 2, 1, 0, 1, '1', '', '2024-02-03 21:00:00', NULL, '2024-02-08 08:23:33', NULL);
INSERT INTO `cp_menu` VALUES (18, 'Penjualan', 0, 'fas fa-luggage-cart', '0', 'backend.transaksi.penjualan', 4, 1, 0, 1, '1', '', '2024-02-03 21:00:20', NULL, '2024-02-08 08:23:33', NULL);
INSERT INTO `cp_menu` VALUES (19, 'Report', 0, 'fas fa-list-ol', '0', 'backend.report.index', 5, 1, 0, 1, '1', '', '2024-02-07 17:45:46', NULL, '2024-02-08 08:23:33', NULL);

-- ----------------------------
-- Table structure for m_inventory
-- ----------------------------
DROP TABLE IF EXISTS `m_inventory`;
CREATE TABLE `m_inventory`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'nama produk',
  `is_attribute` int(11) NULL DEFAULT NULL COMMENT '0=tanpa atribut, 1=ada atribut',
  `ukur_lebar` int(11) NULL DEFAULT NULL,
  `ukur_panjang` int(11) NULL DEFAULT NULL,
  `id_posisi_kaca` int(11) NULL DEFAULT NULL COMMENT 'id from m_posisi_kaca',
  `id_warna` int(11) NULL DEFAULT NULL COMMENT 'id from m_warna',
  `id_service` int(11) NULL DEFAULT NULL COMMENT 'id from m_service',
  `is_active` int(11) NULL DEFAULT 1 COMMENT '0=non active, 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_inventory
-- ----------------------------
INSERT INTO `m_inventory` VALUES (2, 'Film VK 20', 0, NULL, NULL, NULL, NULL, NULL, 1, '2024-02-03 20:53:51', 1, '2024-02-04 03:54:03', NULL);
INSERT INTO `m_inventory` VALUES (4, 'Film VK 45', 1, NULL, NULL, 2, 2, 1, 1, '2024-02-03 20:57:27', 1, '2024-02-03 20:57:27', NULL);
INSERT INTO `m_inventory` VALUES (6, 'Film VK 23', 1, 1024, 3048, 3, 2, 1, 1, '2024-02-05 05:26:06', 1, '2024-02-05 05:26:31', 1);
INSERT INTO `m_inventory` VALUES (7, 'Film VK 30', 1, 152, 30448, 1, 2, 1, 1, '2024-02-08 08:27:31', 1, '2024-02-08 08:27:43', 1);

-- ----------------------------
-- Table structure for m_posisi_kaca
-- ----------------------------
DROP TABLE IF EXISTS `m_posisi_kaca`;
CREATE TABLE `m_posisi_kaca`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'nama posisi kaca',
  `is_active` int(11) NULL DEFAULT 1 COMMENT '0=non active, 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_posisi_kaca
-- ----------------------------
INSERT INTO `m_posisi_kaca` VALUES (1, 'Depan', 1, NULL, NULL, NULL, NULL);
INSERT INTO `m_posisi_kaca` VALUES (2, 'Belakang', 1, NULL, NULL, NULL, NULL);
INSERT INTO `m_posisi_kaca` VALUES (3, 'Samping', 1, NULL, NULL, NULL, NULL);
INSERT INTO `m_posisi_kaca` VALUES (4, 'Sunroof', 1, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for m_service
-- ----------------------------
DROP TABLE IF EXISTS `m_service`;
CREATE TABLE `m_service`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'nama service',
  `is_active` int(11) NULL DEFAULT 1 COMMENT '0=non active, 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_service
-- ----------------------------
INSERT INTO `m_service` VALUES (1, 'Tidak Ada', 1, NULL, NULL, NULL, NULL);
INSERT INTO `m_service` VALUES (2, 'Maintenance', 1, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for m_warna
-- ----------------------------
DROP TABLE IF EXISTS `m_warna`;
CREATE TABLE `m_warna`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'nama warna',
  `is_active` int(11) NULL DEFAULT 1 COMMENT '0=non active, 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_warna
-- ----------------------------
INSERT INTO `m_warna` VALUES (1, 'Merah', 1, NULL, NULL, NULL, NULL);
INSERT INTO `m_warna` VALUES (2, 'Kuning', 1, NULL, NULL, NULL, NULL);
INSERT INTO `m_warna` VALUES (3, 'Hitam', 1, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for tr_penjualan
-- ----------------------------
DROP TABLE IF EXISTS `tr_penjualan`;
CREATE TABLE `tr_penjualan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) NULL DEFAULT NULL COMMENT 'default =1, still manual',
  `nama_transaksi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'nama transaksi',
  `nama_customer` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'nama customer',
  `tgl_transaksi` datetime NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT NULL COMMENT '0=pending, 1=complete',
  `total_item` int(11) NULL DEFAULT NULL COMMENT 'jumlah barang (jenis barang)',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tr_penjualan
-- ----------------------------
INSERT INTO `tr_penjualan` VALUES (2, 1, 'tes 2', 'user 2', '2024-02-07 17:08:38', 1, 3, '2024-02-07 17:08:38', 1, '2024-02-07 17:18:56', 1);
INSERT INTO `tr_penjualan` VALUES (3, 1, 'test 3', 'user', '2024-02-07 17:29:27', 1, 2, '2024-02-07 17:29:27', 1, '2024-02-07 17:41:02', 1);
INSERT INTO `tr_penjualan` VALUES (4, 1, 'Transaksi 4', 'User', '2024-02-08 08:28:36', 1, 2, '2024-02-08 08:28:36', 1, '2024-02-08 08:29:23', 1);

-- ----------------------------
-- Table structure for tr_penjualan_detail
-- ----------------------------
DROP TABLE IF EXISTS `tr_penjualan_detail`;
CREATE TABLE `tr_penjualan_detail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penjualan` int(11) NULL DEFAULT NULL COMMENT 'id from tr_penjualan',
  `id_inventory` int(11) NULL DEFAULT NULL COMMENT 'id from m_inventory',
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'nama produk',
  `is_attribute` int(11) NULL DEFAULT NULL COMMENT '0=tanpa atribut, 1=ada atribut',
  `id_posisi_kaca` int(11) NULL DEFAULT NULL COMMENT 'id from m_posisi_kaca',
  `id_warna` int(11) NULL DEFAULT NULL COMMENT 'id from m_warna',
  `id_service` int(11) NULL DEFAULT NULL COMMENT 'id from m_service',
  `ukur_lebar` int(11) NULL DEFAULT NULL,
  `ukur_panjang` int(11) NULL DEFAULT NULL,
  `nm_posisi_kaca` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nm_warna` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nm_service` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `qty` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tr_penjualan_detail
-- ----------------------------
INSERT INTO `tr_penjualan_detail` VALUES (3, 2, 4, 'Film VK 45', 1, 2, 2, 1, NULL, NULL, 'Belakang', 'Kuning', 'Tidak Ada', 3, '2024-02-07 17:08:38', NULL, '2024-02-07 17:18:41', 1);
INSERT INTO `tr_penjualan_detail` VALUES (4, 2, 6, 'Film VK 23', 1, 3, 2, 1, 1024, 3048, 'Samping', 'Kuning', 'Tidak Ada', 2, '2024-02-07 17:15:48', 1, '2024-02-07 17:18:28', 1);
INSERT INTO `tr_penjualan_detail` VALUES (5, 2, 2, 'Film VK 20', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2024-02-07 17:17:20', 1, '2024-02-07 17:18:20', 1);
INSERT INTO `tr_penjualan_detail` VALUES (8, 3, 6, 'Film VK 23', 1, 3, 2, 1, 1024, 3048, 'Samping', 'Kuning', 'Tidak Ada', 1, '2024-02-07 17:40:39', 1, NULL, NULL);
INSERT INTO `tr_penjualan_detail` VALUES (9, 3, 4, 'Film VK 45', 1, 2, 2, 1, NULL, NULL, 'Belakang', 'Kuning', 'Tidak Ada', 1, '2024-02-07 17:40:59', 1, NULL, NULL);
INSERT INTO `tr_penjualan_detail` VALUES (10, 4, 4, 'Film VK 45', 1, 2, 2, 1, NULL, NULL, 'Belakang', 'Kuning', 'Tidak Ada', 2, '2024-02-08 08:28:36', 1, '2024-02-08 08:28:53', 1);
INSERT INTO `tr_penjualan_detail` VALUES (11, 4, 2, 'Film VK 20', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-02-08 08:28:43', 1, NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_role` int(11) NULL DEFAULT NULL,
  `id_profile` int(11) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 1, 1, 'admin', 'admin', '$2y$10$xOxdxm3VscSECQfUuXw01uPeCGK.1TfaUJe9900x6f0GFEzKpOnE2', NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
