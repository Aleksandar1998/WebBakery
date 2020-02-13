/*
 Navicat Premium Data Transfer

 Source Server         : root
 Source Server Type    : MySQL
 Source Server Version : 100410
 Source Host           : localhost:3306
 Source Schema         : posi

 Target Server Type    : MySQL
 Target Server Version : 100410
 File Encoding         : 65001

 Date: 03/02/2020 11:47:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for korpa
-- ----------------------------
DROP TABLE IF EXISTS `korpa`;
CREATE TABLE `korpa`  (
  `korpa_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `proizvod_id` int(10) UNSIGNED NOT NULL,
  `kolicina` double(10, 2) UNSIGNED NOT NULL,
  `cena` double(10, 2) NOT NULL,
  PRIMARY KEY (`korpa_id`) USING BTREE,
  INDEX `fk_korpa_proizvod_id`(`proizvod_id`) USING BTREE,
  CONSTRAINT `fk_korpa_proizvod_id` FOREIGN KEY (`proizvod_id`) REFERENCES `proizvodi` (`proizvod_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for magacin
-- ----------------------------
DROP TABLE IF EXISTS `magacin`;
CREATE TABLE `magacin`  (
  `magacin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ime` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kolicina` double(10, 2) UNSIGNED NOT NULL,
  `na_stanju` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`magacin_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of magacin
-- ----------------------------
INSERT INTO `magacin` VALUES (1, 'Šećer-kristal', 'Šečer', 2877.74, 1);
INSERT INTO `magacin` VALUES (2, 'Brašno', 'Brašno', 9954.28, 1);
INSERT INTO `magacin` VALUES (3, 'Čokolada-crna', 'Čokolada', 80.25, 1);
INSERT INTO `magacin` VALUES (4, 'Vanilin šećer', 'Dodaci', 45.30, 1);
INSERT INTO `magacin` VALUES (5, 'Orah', 'Orah', 205.07, 1);
INSERT INTO `magacin` VALUES (6, 'Maslac', 'Mlečni proizvodi', 1001.26, 1);
INSERT INTO `magacin` VALUES (7, 'Lešnik', 'Lešnik', 892.39, 1);
INSERT INTO `magacin` VALUES (8, 'Mleko', 'Mleko', 77.16, 1);
INSERT INTO `magacin` VALUES (9, 'Gustin', 'Dodaci', 52.78, 1);
INSERT INTO `magacin` VALUES (10, 'Slatka Pavlaka', 'Mlečni proizvodi', 108.34, 1);
INSERT INTO `magacin` VALUES (11, 'Višnje-smrznute', 'Smrznuto voće', 57.17, 1);
INSERT INTO `magacin` VALUES (12, 'Ananas', 'Sveže voće', 89.22, 1);
INSERT INTO `magacin` VALUES (13, 'Ananas-konzerva', 'Konzervirano voće', 50.00, 1);
INSERT INTO `magacin` VALUES (14, 'Čokolada-mlečna', 'Čokolada', 98.84, 1);
INSERT INTO `magacin` VALUES (15, 'Kiselo mleko', 'Mlečni proizvodi', 71.90, 1);
INSERT INTO `magacin` VALUES (16, 'Šećer-prah', 'Šećer', 693.63, 1);
INSERT INTO `magacin` VALUES (17, 'Kakao-prah', 'Kakao', 16.47, 1);
INSERT INTO `magacin` VALUES (18, 'Kajsija-džem', 'Džem', 13.17, 1);
INSERT INTO `magacin` VALUES (19, 'Limun-aroma', 'Arome', 14.74, 1);
INSERT INTO `magacin` VALUES (20, 'Vanila-aroma', 'Arome', 64.74, 1);
INSERT INTO `magacin` VALUES (21, 'Jaja-kokošija', 'Jaja', 738.00, 1);
INSERT INTO `magacin` VALUES (22, 'Margarin', 'Mlečni proizvodi', 126.11, 1);
INSERT INTO `magacin` VALUES (23, 'Želatin', 'Dodaci', 57.23, 1);
INSERT INTO `magacin` VALUES (24, 'Jagode-sveže', 'Sveže voće', 12.00, 1);
INSERT INTO `magacin` VALUES (25, 'Jagoda-aroma', 'Arome', 111.00, 1);
INSERT INTO `magacin` VALUES (26, 'Jagoda-džem', 'Džem', 5.00, 1);
INSERT INTO `magacin` VALUES (27, 'Maline-sveže', 'Sveže voće', 15.00, 1);
INSERT INTO `magacin` VALUES (28, 'Vanila-puding', 'Dodaci', 10.00, 1);

-- ----------------------------
-- Table structure for prijem
-- ----------------------------
DROP TABLE IF EXISTS `prijem`;
CREATE TABLE `prijem`  (
  `prijem_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ime` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kolicina` double(10, 2) UNSIGNED NOT NULL,
  `datum` datetime(0) NOT NULL DEFAULT current_timestamp(0),
  `same` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`prijem_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of prijem
-- ----------------------------
INSERT INTO `prijem` VALUES (1, 'Ananas-konzerva', 'Konzervirano voće', 25.00, '2019-12-06 22:21:26', 22);
INSERT INTO `prijem` VALUES (2, 'Čokolada-crna', 'Čokolada', 70.00, '2019-12-06 22:21:26', 22);
INSERT INTO `prijem` VALUES (3, 'Čokolada-mlečna', 'Čokolada', 80.00, '2019-12-06 22:21:26', 22);
INSERT INTO `prijem` VALUES (4, 'Gustin', 'Dodaci', 50.00, '2019-12-06 22:21:26', 22);
INSERT INTO `prijem` VALUES (5, 'Jaja-kokošija', 'Jaja', 1000.00, '2019-12-06 22:21:26', 22);
INSERT INTO `prijem` VALUES (6, 'Maslac', 'Mlečni proizvodi', 1000.00, '2019-12-06 22:24:10', 23);
INSERT INTO `prijem` VALUES (7, 'Lešnik', 'Lešnik', 750.00, '2019-12-06 22:24:10', 23);
INSERT INTO `prijem` VALUES (8, 'Mleko', 'Mleko', 50.00, '2019-12-06 22:24:10', 23);
INSERT INTO `prijem` VALUES (9, 'Želatin', 'Dodaci', 50.00, '2019-12-06 22:24:10', 23);
INSERT INTO `prijem` VALUES (10, 'Vanila Aroma', 'Arome', 50.00, '2019-12-06 22:24:10', 23);
INSERT INTO `prijem` VALUES (11, 'Vanila-aroma', 'Arome', 50.00, '2019-12-06 22:25:32', 24);
INSERT INTO `prijem` VALUES (12, 'Slatka Pavlaka', 'Mlečni proizvodi', 10.00, '2019-12-07 23:22:42', 25);
INSERT INTO `prijem` VALUES (13, 'Ananas', 'Sveže voće', 1.00, '2020-01-07 23:02:38', 26);
INSERT INTO `prijem` VALUES (14, 'Jagoda-aroma', 'Arome', 1.00, '2020-01-16 19:12:32', 27);
INSERT INTO `prijem` VALUES (15, 'Jagoda-aroma', 'Arome', 1.00, '2020-01-16 19:14:15', 28);
INSERT INTO `prijem` VALUES (16, 'Jagoda-aroma', 'Arome', 1.00, '2020-01-16 19:14:50', 29);
INSERT INTO `prijem` VALUES (17, 'Ananas', 'Sveže voće', 1.00, '2020-01-16 19:17:01', 30);
INSERT INTO `prijem` VALUES (18, 'Jaja-kokošija', 'Jaja', 1.00, '2020-01-16 19:17:01', 30);
INSERT INTO `prijem` VALUES (19, 'Margarin', 'Mlečni proizvodi', 1.00, '2020-01-16 19:17:01', 30);
INSERT INTO `prijem` VALUES (20, 'Maslac', 'Mlečni proizvodi', 1.00, '2020-01-16 19:17:01', 30);
INSERT INTO `prijem` VALUES (21, 'Vanilin šećer', 'Dodaci', 1.00, '2020-01-16 19:17:01', 30);
INSERT INTO `prijem` VALUES (22, 'Jagoda-Džem', 'Džem', 5.00, '2020-01-16 19:17:59', 31);
INSERT INTO `prijem` VALUES (23, 'Maline-sveže', 'Sveže voće', 15.00, '2020-01-16 22:20:32', 32);
INSERT INTO `prijem` VALUES (24, 'Jaja-kokošija', 'Jaja', 1.00, '2020-01-16 23:05:51', 33);
INSERT INTO `prijem` VALUES (25, 'Kiselo mleko', 'Mlečni proizvodi', 10.00, '2020-01-16 23:05:51', 33);
INSERT INTO `prijem` VALUES (26, 'Vanila-puding', 'Dodaci', 10.00, '2020-01-16 23:05:51', 33);
INSERT INTO `prijem` VALUES (27, 'Jagoda-aroma', 'Arome', 100.00, '2020-02-01 22:38:36', 34);

-- ----------------------------
-- Table structure for prijempomocna
-- ----------------------------
DROP TABLE IF EXISTS `prijempomocna`;
CREATE TABLE `prijempomocna`  (
  `prijempomocna_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ime` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kolicina` double(10, 2) UNSIGNED NOT NULL,
  PRIMARY KEY (`prijempomocna_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of prijempomocna
-- ----------------------------
INSERT INTO `prijempomocna` VALUES (1, 'Jagoda-aroma', 'Arome', 100.00);

-- ----------------------------
-- Table structure for prodaja
-- ----------------------------
DROP TABLE IF EXISTS `prodaja`;
CREATE TABLE `prodaja`  (
  `prodaja_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `proizvod_id` int(10) UNSIGNED NOT NULL,
  `kolicina` int(10) UNSIGNED NOT NULL,
  `ukupno` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `datum` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`prodaja_id`) USING BTREE,
  INDEX `fk_prodaja_proizvod_id`(`proizvod_id`) USING BTREE,
  INDEX `fk_prodaja_user_id`(`user_id`) USING BTREE,
  CONSTRAINT `fk_prodaja_proizvod_id` FOREIGN KEY (`proizvod_id`) REFERENCES `proizvodi` (`proizvod_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_prodaja_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 51 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of prodaja
-- ----------------------------
INSERT INTO `prodaja` VALUES (1, 1, 1, 1000, 2, '2019-12-25 01:44:45');
INSERT INTO `prodaja` VALUES (2, 2, 1, 1000, 2, '2019-12-25 01:44:45');
INSERT INTO `prodaja` VALUES (3, 3, 1, 1000, 2, '2019-12-25 01:44:45');
INSERT INTO `prodaja` VALUES (4, 4, 1, 1000, 2, '2019-12-25 01:44:45');
INSERT INTO `prodaja` VALUES (5, 5, 1, 135, 2, '2019-12-25 01:44:45');
INSERT INTO `prodaja` VALUES (6, 6, 1, 135, 2, '2019-12-25 01:44:45');
INSERT INTO `prodaja` VALUES (7, 7, 1, 135, 2, '2019-12-25 01:44:45');
INSERT INTO `prodaja` VALUES (8, 8, 1, 135, 2, '2019-12-25 01:44:45');
INSERT INTO `prodaja` VALUES (9, 1, 1, 1000, 2, '2019-12-25 01:45:09');
INSERT INTO `prodaja` VALUES (10, 2, 1, 1000, 2, '2019-12-25 01:45:09');
INSERT INTO `prodaja` VALUES (11, 3, 1, 1000, 2, '2019-12-25 01:45:09');
INSERT INTO `prodaja` VALUES (12, 4, 5, 5000, 2, '2019-12-25 01:45:09');
INSERT INTO `prodaja` VALUES (13, 5, 1, 135, 2, '2019-12-25 01:45:09');
INSERT INTO `prodaja` VALUES (14, 6, 1, 135, 2, '2019-12-25 01:45:09');
INSERT INTO `prodaja` VALUES (15, 7, 1, 135, 2, '2019-12-25 01:45:09');
INSERT INTO `prodaja` VALUES (16, 8, 1, 135, 2, '2019-12-25 01:45:09');
INSERT INTO `prodaja` VALUES (17, 1, 1, 1000, 2, '2019-12-25 01:48:22');
INSERT INTO `prodaja` VALUES (18, 1, 1, 1000, 2, '2020-01-07 02:21:05');
INSERT INTO `prodaja` VALUES (19, 2, 1, 1000, 2, '2020-01-07 02:21:05');
INSERT INTO `prodaja` VALUES (20, 3, 1, 1000, 2, '2020-01-07 02:21:05');
INSERT INTO `prodaja` VALUES (21, 4, 1, 1000, 2, '2020-01-07 02:21:05');
INSERT INTO `prodaja` VALUES (22, 5, 1, 135, 2, '2020-01-07 02:21:05');
INSERT INTO `prodaja` VALUES (23, 6, 1, 135, 2, '2020-01-07 02:21:05');
INSERT INTO `prodaja` VALUES (24, 7, 1, 135, 2, '2020-01-07 02:21:05');
INSERT INTO `prodaja` VALUES (25, 8, 1, 135, 2, '2020-01-07 02:21:05');
INSERT INTO `prodaja` VALUES (26, 1, 2, 2000, 2, '2020-01-07 02:59:49');
INSERT INTO `prodaja` VALUES (27, 2, 2, 2000, 2, '2020-01-07 02:59:49');
INSERT INTO `prodaja` VALUES (28, 3, 2, 2000, 2, '2020-01-07 02:59:49');
INSERT INTO `prodaja` VALUES (29, 4, 2, 2000, 2, '2020-01-07 02:59:49');
INSERT INTO `prodaja` VALUES (30, 5, 2, 270, 2, '2020-01-07 02:59:49');
INSERT INTO `prodaja` VALUES (31, 6, 2, 270, 2, '2020-01-07 02:59:49');
INSERT INTO `prodaja` VALUES (32, 7, 2, 270, 2, '2020-01-07 02:59:49');
INSERT INTO `prodaja` VALUES (33, 8, 2, 270, 2, '2020-01-07 02:59:49');
INSERT INTO `prodaja` VALUES (35, 1, 1, 1000, 2, '2020-01-07 18:19:47');
INSERT INTO `prodaja` VALUES (36, 1, 1, 1000, 2, '2020-01-07 18:20:38');
INSERT INTO `prodaja` VALUES (37, 2, 1, 1000, 2, '2020-01-07 18:20:38');
INSERT INTO `prodaja` VALUES (38, 3, 1, 1000, 2, '2020-01-07 18:20:38');
INSERT INTO `prodaja` VALUES (39, 4, 1, 1000, 2, '2020-01-07 18:20:38');
INSERT INTO `prodaja` VALUES (40, 5, 5, 675, 2, '2020-01-07 19:05:19');
INSERT INTO `prodaja` VALUES (41, 1, 1, 1000, 2, '2020-01-16 22:27:03');
INSERT INTO `prodaja` VALUES (42, 1, 1, 1000, 2, '2020-01-16 23:20:59');
INSERT INTO `prodaja` VALUES (43, 3, 1, 1000, 2, '2020-01-16 23:20:59');
INSERT INTO `prodaja` VALUES (44, 8, 2, 270, 2, '2020-01-16 23:20:59');
INSERT INTO `prodaja` VALUES (45, 1, 1, 1000, 2, '2020-02-01 22:40:08');
INSERT INTO `prodaja` VALUES (46, 4, 1, 1000, 2, '2020-02-01 22:40:08');
INSERT INTO `prodaja` VALUES (47, 1, 1, 1000, 2, '2020-02-02 16:26:47');
INSERT INTO `prodaja` VALUES (48, 2, 1, 1000, 2, '2020-02-02 16:26:47');
INSERT INTO `prodaja` VALUES (49, 3, 1, 1000, 2, '2020-02-02 16:26:47');
INSERT INTO `prodaja` VALUES (50, 1, 1, 1000, 2, '2020-02-02 16:29:40');

-- ----------------------------
-- Table structure for proizvod_magacin
-- ----------------------------
DROP TABLE IF EXISTS `proizvod_magacin`;
CREATE TABLE `proizvod_magacin`  (
  `proizvod_magacin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `proizvod_id` int(10) UNSIGNED NOT NULL,
  `magacin_id` int(10) UNSIGNED NOT NULL,
  `kolicina` double(10, 2) UNSIGNED NOT NULL,
  PRIMARY KEY (`proizvod_magacin_id`) USING BTREE,
  INDEX `fk_proizvod_magacin_proizvod_id`(`proizvod_id`) USING BTREE,
  INDEX `fk_proizvod_magacin_magacin_id`(`magacin_id`) USING BTREE,
  CONSTRAINT `fk_proizvod_magacin_magacin_id` FOREIGN KEY (`magacin_id`) REFERENCES `magacin` (`magacin_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_proizvod_magacin_proizvod_id` FOREIGN KEY (`proizvod_id`) REFERENCES `proizvodi` (`proizvod_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of proizvod_magacin
-- ----------------------------
INSERT INTO `proizvod_magacin` VALUES (1, 1, 21, 4.00);
INSERT INTO `proizvod_magacin` VALUES (2, 1, 1, 0.30);
INSERT INTO `proizvod_magacin` VALUES (3, 1, 16, 0.08);
INSERT INTO `proizvod_magacin` VALUES (4, 1, 22, 0.18);
INSERT INTO `proizvod_magacin` VALUES (5, 1, 3, 0.20);
INSERT INTO `proizvod_magacin` VALUES (6, 1, 2, 0.10);
INSERT INTO `proizvod_magacin` VALUES (7, 1, 20, 0.01);
INSERT INTO `proizvod_magacin` VALUES (8, 1, 18, 0.10);
INSERT INTO `proizvod_magacin` VALUES (9, 1, 10, 0.10);
INSERT INTO `proizvod_magacin` VALUES (10, 1, 17, 0.04);
INSERT INTO `proizvod_magacin` VALUES (11, 1, 23, 0.02);
INSERT INTO `proizvod_magacin` VALUES (12, 1, 19, 0.01);
INSERT INTO `proizvod_magacin` VALUES (13, 2, 21, 5.00);
INSERT INTO `proizvod_magacin` VALUES (14, 2, 1, 0.15);
INSERT INTO `proizvod_magacin` VALUES (15, 2, 2, 0.03);
INSERT INTO `proizvod_magacin` VALUES (16, 2, 5, 0.13);
INSERT INTO `proizvod_magacin` VALUES (17, 2, 3, 0.04);
INSERT INTO `proizvod_magacin` VALUES (18, 2, 6, 0.10);
INSERT INTO `proizvod_magacin` VALUES (19, 2, 4, 0.01);
INSERT INTO `proizvod_magacin` VALUES (20, 2, 14, 0.04);
INSERT INTO `proizvod_magacin` VALUES (21, 2, 15, 0.05);
INSERT INTO `proizvod_magacin` VALUES (22, 2, 16, 0.15);
INSERT INTO `proizvod_magacin` VALUES (23, 3, 21, 8.00);
INSERT INTO `proizvod_magacin` VALUES (24, 3, 1, 0.20);
INSERT INTO `proizvod_magacin` VALUES (25, 3, 4, 0.01);
INSERT INTO `proizvod_magacin` VALUES (26, 3, 5, 0.40);
INSERT INTO `proizvod_magacin` VALUES (27, 3, 6, 0.20);
INSERT INTO `proizvod_magacin` VALUES (28, 4, 21, 4.00);
INSERT INTO `proizvod_magacin` VALUES (29, 4, 1, 0.10);
INSERT INTO `proizvod_magacin` VALUES (30, 4, 5, 0.10);
INSERT INTO `proizvod_magacin` VALUES (31, 4, 7, 0.05);
INSERT INTO `proizvod_magacin` VALUES (32, 4, 2, 0.15);
INSERT INTO `proizvod_magacin` VALUES (33, 4, 4, 0.20);
INSERT INTO `proizvod_magacin` VALUES (34, 4, 8, 0.15);
INSERT INTO `proizvod_magacin` VALUES (35, 4, 9, 0.10);
INSERT INTO `proizvod_magacin` VALUES (36, 4, 6, 0.05);
INSERT INTO `proizvod_magacin` VALUES (37, 4, 10, 0.15);
INSERT INTO `proizvod_magacin` VALUES (38, 4, 11, 0.15);
INSERT INTO `proizvod_magacin` VALUES (39, 4, 12, 0.08);

-- ----------------------------
-- Table structure for proizvodi
-- ----------------------------
DROP TABLE IF EXISTS `proizvodi`;
CREATE TABLE `proizvodi`  (
  `proizvod_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ime` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cena` double(10, 2) UNSIGNED NOT NULL,
  `is_aktivan` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`proizvod_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of proizvodi
-- ----------------------------
INSERT INTO `proizvodi` VALUES (1, 'Saher-Kg', 'Čokoladna', 1000.00, 1);
INSERT INTO `proizvodi` VALUES (2, 'Grilijaš-Kg', 'Čokoladna', 1000.00, 1);
INSERT INTO `proizvodi` VALUES (3, 'Reforma-Kg', 'Čokoladna', 1000.00, 1);
INSERT INTO `proizvodi` VALUES (4, 'Moskva-Kg', 'Voćna', 1000.00, 1);
INSERT INTO `proizvodi` VALUES (5, 'Saher-parče', 'Čokoladna', 135.00, 1);
INSERT INTO `proizvodi` VALUES (6, 'Grilijaš-parče', 'Čokoladna', 135.00, 1);
INSERT INTO `proizvodi` VALUES (7, 'Reforma-parče', 'Čokoladna', 135.00, 1);
INSERT INTO `proizvodi` VALUES (8, 'Moskva-parče', 'Voćna', 135.00, 1);

-- ----------------------------
-- Table structure for proizvodkolicina
-- ----------------------------
DROP TABLE IF EXISTS `proizvodkolicina`;
CREATE TABLE `proizvodkolicina`  (
  `proizvodKolicina_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `proizvod_id` int(10) UNSIGNED NOT NULL,
  `kolicina` double(10, 2) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`proizvodKolicina_id`) USING BTREE,
  INDEX `fk_proizvodKolicina_proizvod_id`(`proizvod_id`) USING BTREE,
  CONSTRAINT `fk_proizvodKolicina_proizvod_id` FOREIGN KEY (`proizvod_id`) REFERENCES `proizvodi` (`proizvod_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of proizvodkolicina
-- ----------------------------
INSERT INTO `proizvodkolicina` VALUES (1, 1, 14.00);
INSERT INTO `proizvodkolicina` VALUES (2, 2, 9.00);
INSERT INTO `proizvodkolicina` VALUES (3, 3, 24.00);
INSERT INTO `proizvodkolicina` VALUES (4, 4, 28.00);
INSERT INTO `proizvodkolicina` VALUES (5, 5, 109.00);
INSERT INTO `proizvodkolicina` VALUES (6, 6, 90.00);
INSERT INTO `proizvodkolicina` VALUES (7, 7, 170.00);
INSERT INTO `proizvodkolicina` VALUES (8, 8, 236.00);

-- ----------------------------
-- Table structure for proizvodnja
-- ----------------------------
DROP TABLE IF EXISTS `proizvodnja`;
CREATE TABLE `proizvodnja`  (
  `proizvodnja_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `proizvod_id` int(10) UNSIGNED NOT NULL,
  `kolicina` int(10) UNSIGNED NOT NULL,
  `datum` datetime(0) NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`proizvodnja_id`) USING BTREE,
  INDEX `fk_proizvodnja_proizvod_id`(`proizvod_id`) USING BTREE,
  CONSTRAINT `fk_proizvodnja_proizvod_id` FOREIGN KEY (`proizvod_id`) REFERENCES `proizvodi` (`proizvod_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 72 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of proizvodnja
-- ----------------------------
INSERT INTO `proizvodnja` VALUES (1, 1, 1, '2019-12-06 22:18:04');
INSERT INTO `proizvodnja` VALUES (2, 2, 2, '2019-12-06 22:18:05');
INSERT INTO `proizvodnja` VALUES (3, 3, 3, '2019-12-06 22:18:07');
INSERT INTO `proizvodnja` VALUES (4, 4, 4, '2019-12-06 22:18:10');
INSERT INTO `proizvodnja` VALUES (5, 5, 5, '2019-12-06 22:18:12');
INSERT INTO `proizvodnja` VALUES (6, 6, 6, '2019-12-06 22:18:13');
INSERT INTO `proizvodnja` VALUES (7, 7, 7, '2019-12-06 22:18:15');
INSERT INTO `proizvodnja` VALUES (8, 8, 8, '2019-12-06 22:18:17');
INSERT INTO `proizvodnja` VALUES (9, 7, 5, '2019-12-10 04:02:15');
INSERT INTO `proizvodnja` VALUES (10, 8, 5, '2019-12-10 04:02:17');
INSERT INTO `proizvodnja` VALUES (11, 6, 5, '2019-12-10 04:02:20');
INSERT INTO `proizvodnja` VALUES (12, 5, 5, '2019-12-10 04:02:23');
INSERT INTO `proizvodnja` VALUES (13, 3, 5, '2019-12-10 04:02:25');
INSERT INTO `proizvodnja` VALUES (14, 4, 5, '2019-12-10 04:02:26');
INSERT INTO `proizvodnja` VALUES (15, 2, 5, '2019-12-10 04:02:28');
INSERT INTO `proizvodnja` VALUES (16, 1, 5, '2019-12-10 04:02:30');
INSERT INTO `proizvodnja` VALUES (17, 3, 40, '2019-12-10 04:04:18');
INSERT INTO `proizvodnja` VALUES (18, 1, 10, '2019-12-25 00:52:55');
INSERT INTO `proizvodnja` VALUES (19, 1, 10, '2019-12-25 00:53:08');
INSERT INTO `proizvodnja` VALUES (20, 8, 10, '2019-12-25 00:53:19');
INSERT INTO `proizvodnja` VALUES (21, 1, 1, '2019-12-25 00:53:57');
INSERT INTO `proizvodnja` VALUES (22, 2, 1, '2019-12-25 00:54:41');
INSERT INTO `proizvodnja` VALUES (23, 3, 1, '2019-12-25 00:54:47');
INSERT INTO `proizvodnja` VALUES (24, 4, 1, '2019-12-25 00:54:51');
INSERT INTO `proizvodnja` VALUES (25, 1, 1, '2019-12-25 00:58:14');
INSERT INTO `proizvodnja` VALUES (26, 5, 1, '2019-12-25 00:58:42');
INSERT INTO `proizvodnja` VALUES (27, 2, 1, '2019-12-25 01:00:57');
INSERT INTO `proizvodnja` VALUES (28, 2, 1, '2019-12-25 01:01:08');
INSERT INTO `proizvodnja` VALUES (29, 8, 1, '2019-12-27 00:03:45');
INSERT INTO `proizvodnja` VALUES (30, 1, 1, '2020-01-07 23:03:00');
INSERT INTO `proizvodnja` VALUES (31, 1, 1, '2020-01-11 02:44:38');
INSERT INTO `proizvodnja` VALUES (32, 1, 1, '2020-01-11 02:46:05');
INSERT INTO `proizvodnja` VALUES (33, 1, 1, '2020-01-11 02:46:50');
INSERT INTO `proizvodnja` VALUES (34, 1, 1, '2020-01-11 02:48:01');
INSERT INTO `proizvodnja` VALUES (35, 1, 1, '2020-01-11 02:49:03');
INSERT INTO `proizvodnja` VALUES (36, 1, 1, '2020-01-11 02:50:31');
INSERT INTO `proizvodnja` VALUES (37, 1, 1, '2020-01-11 02:50:38');
INSERT INTO `proizvodnja` VALUES (38, 1, 1, '2020-01-11 02:51:28');
INSERT INTO `proizvodnja` VALUES (39, 1, 1, '2020-01-11 02:52:02');
INSERT INTO `proizvodnja` VALUES (40, 1, 1, '2020-01-11 02:53:19');
INSERT INTO `proizvodnja` VALUES (41, 2, 1, '2020-01-11 02:53:36');
INSERT INTO `proizvodnja` VALUES (42, 3, 1, '2020-01-11 02:53:48');
INSERT INTO `proizvodnja` VALUES (43, 4, 1, '2020-01-11 02:53:56');
INSERT INTO `proizvodnja` VALUES (44, 5, 1, '2020-01-11 02:54:04');
INSERT INTO `proizvodnja` VALUES (45, 7, 1, '2020-01-11 02:56:20');
INSERT INTO `proizvodnja` VALUES (46, 1, 1, '2020-01-11 02:56:37');
INSERT INTO `proizvodnja` VALUES (47, 1, 1, '2020-01-11 02:57:20');
INSERT INTO `proizvodnja` VALUES (48, 6, 1, '2020-01-11 02:57:24');
INSERT INTO `proizvodnja` VALUES (49, 5, 1, '2020-01-11 02:58:41');
INSERT INTO `proizvodnja` VALUES (50, 1, 1, '2020-01-11 02:59:52');
INSERT INTO `proizvodnja` VALUES (51, 2, 1, '2020-01-11 02:59:54');
INSERT INTO `proizvodnja` VALUES (52, 3, 1, '2020-01-11 02:59:56');
INSERT INTO `proizvodnja` VALUES (53, 4, 1, '2020-01-11 02:59:58');
INSERT INTO `proizvodnja` VALUES (54, 5, 1, '2020-01-11 03:00:00');
INSERT INTO `proizvodnja` VALUES (55, 6, 1, '2020-01-11 03:00:02');
INSERT INTO `proizvodnja` VALUES (56, 7, 1, '2020-01-11 03:00:04');
INSERT INTO `proizvodnja` VALUES (57, 8, 1, '2020-01-11 03:00:07');
INSERT INTO `proizvodnja` VALUES (58, 1, 1, '2020-01-16 22:07:51');
INSERT INTO `proizvodnja` VALUES (59, 2, 1, '2020-01-16 22:07:56');
INSERT INTO `proizvodnja` VALUES (60, 7, 1, '2020-01-16 22:08:20');
INSERT INTO `proizvodnja` VALUES (61, 1, 1, '2020-01-16 23:10:47');
INSERT INTO `proizvodnja` VALUES (62, 2, 1, '2020-01-16 23:10:52');
INSERT INTO `proizvodnja` VALUES (63, 1, 1, '2020-01-16 23:12:48');
INSERT INTO `proizvodnja` VALUES (64, 7, 8, '2020-01-16 23:13:04');
INSERT INTO `proizvodnja` VALUES (65, 8, 8, '2020-01-16 23:13:22');
INSERT INTO `proizvodnja` VALUES (66, 5, 1, '2020-01-16 23:13:37');
INSERT INTO `proizvodnja` VALUES (67, 6, 1, '2020-01-16 23:13:52');
INSERT INTO `proizvodnja` VALUES (68, 5, 1, '2020-01-16 23:16:15');
INSERT INTO `proizvodnja` VALUES (69, 4, 25, '2020-01-16 23:17:06');
INSERT INTO `proizvodnja` VALUES (70, 7, 1, '2020-01-16 23:17:16');
INSERT INTO `proizvodnja` VALUES (71, 5, 1, '2020-02-01 22:40:50');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ime` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jedinica` int(10) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', -1, '$2y$10$rADiHb2o0mCLiXepB/.oQulJDXTBx8zSNTpyYAFHeuy.63BC1NCKq');
INSERT INTO `users` VALUES (2, 'magacin', 0, '$2y$10$tdLSoL1uzNW.W3YnycW/EeuX4UiOuwbxi/a2oWiJJWk45SeBIEH2C');
INSERT INTO `users` VALUES (3, 'proizvodnja', 1, '$2y$10$jnPYSsLKzQIiJyfsXa8Afe0Nrkre5GTI9LoJ1Mx72RD0Nv4S3JtOi');
INSERT INTO `users` VALUES (4, 'radnja1', 2, '$2y$10$SkkXwjO9/qyLfCiSA0Zn2.SALd3cfNAthkceL3JvMXkNRjvzsv8NG');

SET FOREIGN_KEY_CHECKS = 1;
