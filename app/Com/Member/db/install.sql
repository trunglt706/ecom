-- ----------------------------
-- Table structure for member_categories
-- ----------------------------
DROP TABLE IF EXISTS `member_categories`;
CREATE TABLE `member_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_category` int(10) unsigned NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of member_categories
-- ----------------------------
INSERT INTO `member_categories` VALUES ('1', 'Fillet', '0', '0', '2016-03-14 07:20:07', '2016-04-11 06:17:57');
INSERT INTO `member_categories` VALUES ('2', 'Fillet Cutting', '0', '5', '2016-03-19 08:50:58', '2016-04-11 06:17:57');
INSERT INTO `member_categories` VALUES ('3', 'Cutting', '0', '4', '2016-03-19 08:51:23', '2016-04-11 06:17:57');
INSERT INTO `member_categories` VALUES ('4', 'Value-added', '0', '3', '2016-03-19 08:51:39', '2016-04-11 06:17:57');
INSERT INTO `member_categories` VALUES ('5', 'Meal', '0', '2', '2016-03-19 08:52:01', '2016-04-11 06:17:57');
INSERT INTO `member_categories` VALUES ('6', 'Oil', '0', '1', '2016-03-19 08:52:18', '2016-04-11 06:17:57');

-- ----------------------------
-- Table structure for member_certificate_approves
-- ----------------------------
DROP TABLE IF EXISTS `member_certificate_approves`;
CREATE TABLE `member_certificate_approves` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) unsigned NOT NULL,
  `member_certificate_id` int(11) unsigned NOT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `approved_by` int(11) unsigned DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of member_certificate_approves
-- ----------------------------

-- ----------------------------
-- Table structure for member_certificate_types
-- ----------------------------
DROP TABLE IF EXISTS `member_certificate_types`;
CREATE TABLE `member_certificate_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_certificate_type_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `member_certificate_type_note` text COLLATE utf8_unicode_ci,
  `logo` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of member_certificate_types
-- ----------------------------
INSERT INTO `member_certificate_types` VALUES ('14', 'Inno Soft certificate', 'có anh admin là ịt man! de de', 'http://localhost/vpa_ecom/storage/upload/a86b441d22a83ee59413dd4794199770/DelDsh-Ruggio-Lg-17.jpg', '2016-04-01 05:20:58', '2016-04-01 05:20:58');

-- ----------------------------
-- Table structure for member_certificates
-- ----------------------------
DROP TABLE IF EXISTS `member_certificates`;
CREATE TABLE `member_certificates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_certificate_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `member_certificate_certified_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_certificate_certified_at` date DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `note` text COLLATE utf8_unicode_ci,
  `member_id` int(11) unsigned NOT NULL,
  `member_certificate_type_id` int(11) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of member_certificates
-- ----------------------------

-- ----------------------------
-- Table structure for member_level_approves
-- ----------------------------
DROP TABLE IF EXISTS `member_level_approves`;
CREATE TABLE `member_level_approves` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned DEFAULT NULL,
  `member_level_id` int(10) unsigned DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `approved_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of member_level_approves
-- ----------------------------
INSERT INTO `member_level_approves` VALUES ('1', '2', '2', null, '1', '2016-03-29 14:00:32', '2016-04-04 03:16:09');
INSERT INTO `member_level_approves` VALUES ('2', '3', '2', null, '1', '2016-04-01 17:45:59', '2016-04-04 03:16:14');
INSERT INTO `member_level_approves` VALUES ('3', '1', '2', null, '1', '2016-04-01 17:46:04', '2016-04-04 03:16:17');
INSERT INTO `member_level_approves` VALUES ('4', '4', '2', null, '1', '2016-04-02 10:30:19', '2016-04-04 03:16:21');
INSERT INTO `member_level_approves` VALUES ('7', '5', '1', null, '1', '2016-04-03 20:49:26', '2016-04-03 20:49:26');
INSERT INTO `member_level_approves` VALUES ('8', '5', '2', null, '1', '2016-04-03 20:49:31', '2016-04-03 20:49:31');
INSERT INTO `member_level_approves` VALUES ('9', '5', '1', null, '1', '2016-04-03 21:00:41', '2016-04-03 21:00:41');
INSERT INTO `member_level_approves` VALUES ('10', '6', '1', null, '1', '2016-04-03 21:02:54', '2016-04-03 21:02:54');
INSERT INTO `member_level_approves` VALUES ('11', '5', '2', null, '1', '2016-04-04 06:30:38', '2016-04-04 06:30:38');
INSERT INTO `member_level_approves` VALUES ('12', '5', '1', null, '1', '2016-04-04 06:30:47', '2016-04-04 06:30:47');
INSERT INTO `member_level_approves` VALUES ('13', '1', '1', null, '24', '2016-04-04 17:33:03', '2016-04-04 17:33:03');
INSERT INTO `member_level_approves` VALUES ('14', '2', '2', null, '34', '2016-04-05 01:25:18', '2016-04-05 01:25:18');
INSERT INTO `member_level_approves` VALUES ('15', '3', '1', null, '35', '2016-04-05 01:27:23', '2016-04-05 01:27:23');
INSERT INTO `member_level_approves` VALUES ('16', '4', '2', null, '24', '2016-04-05 01:57:37', '2016-04-05 01:57:37');
INSERT INTO `member_level_approves` VALUES ('17', '1', '1', null, '1', '2016-04-07 02:39:02', '2016-04-07 02:39:02');

-- ----------------------------
-- Table structure for member_levels
-- ----------------------------
DROP TABLE IF EXISTS `member_levels`;
CREATE TABLE `member_levels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` text COLLATE utf8_unicode_ci,
  `level` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of member_levels
-- ----------------------------
INSERT INTO `member_levels` VALUES ('1', 'Thành viên', null, '1', null, null);
INSERT INTO `member_levels` VALUES ('2', 'Thành viên vàng', null, '2', null, null);

-- ----------------------------
-- Table structure for member_media_categories
-- ----------------------------
DROP TABLE IF EXISTS `member_media_categories`;
CREATE TABLE `member_media_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attribs` text COLLATE utf8_unicode_ci NOT NULL,
  `parent_category` int(10) unsigned NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of member_media_categories
-- ----------------------------
INSERT INTO `member_media_categories` VALUES ('3', 'Logo', '', '', '', '0', '0', '2016-03-20 08:10:55', '2016-04-07 12:24:05');
INSERT INTO `member_media_categories` VALUES ('4', 'Banner', '', '', '', '0', '1', '2016-03-20 08:11:00', '2016-04-07 12:24:05');

-- ----------------------------
-- Table structure for member_medias
-- ----------------------------
DROP TABLE IF EXISTS `member_medias`;
CREATE TABLE `member_medias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  `media_category_id` int(10) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=272 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of member_medias
-- ----------------------------
INSERT INTO `member_medias` VALUES ('119', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/ad711d4dac9af02edbf04c95d762b6ba/12517.png', '1', '3', '2', null, null);
INSERT INTO `member_medias` VALUES ('120', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/ad711d4dac9af02edbf04c95d762b6ba/8743625711828430.png', '1', '4', '2', null, null);
INSERT INTO `member_medias` VALUES ('121', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/1efbbf29d05a1a9af9e3c26b8ce8c6c7/logo_hung_ca.jpg', '1', '3', '3', null, null);
INSERT INTO `member_medias` VALUES ('122', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/1efbbf29d05a1a9af9e3c26b8ce8c6c7/8743625711828430.png', '1', '4', '3', null, null);
INSERT INTO `member_medias` VALUES ('125', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/6a99d919aabaeb674616e68988420b4a/logoBienDong2.png', '1', '3', '5', null, null);
INSERT INTO `member_medias` VALUES ('126', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/6a99d919aabaeb674616e68988420b4a/timthumb.jpg', '1', '4', '5', null, null);
INSERT INTO `member_medias` VALUES ('127', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/010c0bcc5fccdf86a9a75964766573a5/logo-idi.png', '1', '3', '6', null, null);
INSERT INTO `member_medias` VALUES ('128', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/010c0bcc5fccdf86a9a75964766573a5/timthumb.jpg', '1', '4', '6', null, null);
INSERT INTO `member_medias` VALUES ('129', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/7cc5bf2ebbb13c3c2d242536ee6269d2/cafatex_logo.jpg', '1', '3', '7', null, null);
INSERT INTO `member_medias` VALUES ('130', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/7cc5bf2ebbb13c3c2d242536ee6269d2/timthumb.jpg', '1', '4', '7', null, null);
INSERT INTO `member_medias` VALUES ('131', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/fbd52caff5319bcbcac79b54bd812a2f/logo_caseamex.jpg', '1', '3', '8', null, null);
INSERT INTO `member_medias` VALUES ('132', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/fbd52caff5319bcbcac79b54bd812a2f/8743625711828430.png', '1', '4', '8', null, null);
INSERT INTO `member_medias` VALUES ('133', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/c59f31bc8828ee41c06ad050269d3fe5/dongaseafood.jpg', '1', '3', '9', null, null);
INSERT INTO `member_medias` VALUES ('134', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/c59f31bc8828ee41c06ad050269d3fe5/8743625711828430.png', '1', '4', '9', null, null);
INSERT INTO `member_medias` VALUES ('135', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/c63f2fa67436109873abae073a85c3d2/logo_AGIFISH.jpg', '1', '3', '10', null, null);
INSERT INTO `member_medias` VALUES ('136', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/c63f2fa67436109873abae073a85c3d2/bg_slide.png', '1', '4', '10', null, null);
INSERT INTO `member_medias` VALUES ('137', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5a5b1a656c0337fc1f492762a9c9a51c/logohhhweb.png', '1', '3', '11', null, null);
INSERT INTO `member_medias` VALUES ('138', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5a5b1a656c0337fc1f492762a9c9a51c/bg_slide.png', '1', '4', '11', null, null);
INSERT INTO `member_medias` VALUES ('139', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/bd006844d8712e5f0283f7847118fe31/logo_faquimex.jpg', '1', '3', '12', null, null);
INSERT INTO `member_medias` VALUES ('140', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/bd006844d8712e5f0283f7847118fe31/timthumb.jpg', '1', '4', '12', null, null);
INSERT INTO `member_medias` VALUES ('141', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/c5a72ed816c2e4d4efb8952462600b4b/timthumb.jpg', '1', '4', '14', null, null);
INSERT INTO `member_medias` VALUES ('142', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/e09c902bfafe896f65890b4c47d307a8/timthumb.jpg', '1', '4', '15', null, null);
INSERT INTO `member_medias` VALUES ('143', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/fc6924ddec70fdf6aba405f90fc27a1a/timthumb.jpg', '1', '4', '16', null, null);
INSERT INTO `member_medias` VALUES ('146', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/0d2bb7b0be32e1ac389184ca4a3ba69c/ban va toi.png', '1', '3', '18', null, null);
INSERT INTO `member_medias` VALUES ('147', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/0d2bb7b0be32e1ac389184ca4a3ba69c/BT_title4website.png', '1', '4', '18', null, null);
INSERT INTO `member_medias` VALUES ('148', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/2230c8cc16586beddebfb60022ae88e4/santafood_LaoUI.jpg', '1', '3', '19', null, null);
INSERT INTO `member_medias` VALUES ('149', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/2230c8cc16586beddebfb60022ae88e4/timthumb.jpg', '1', '4', '19', null, null);
INSERT INTO `member_medias` VALUES ('150', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/49134004f74c371c321b822b83801822/SOUTHVINA.jpg', '1', '3', '20', null, null);
INSERT INTO `member_medias` VALUES ('151', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/49134004f74c371c321b822b83801822/bg_slide.png', '1', '4', '20', null, null);
INSERT INTO `member_medias` VALUES ('152', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/8368fa0c3b6845848f037aa057b8f2c7/Daidaithanhseafoods.png', '1', '3', '21', null, null);
INSERT INTO `member_medias` VALUES ('153', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/8368fa0c3b6845848f037aa057b8f2c7/timthumb.jpg', '1', '4', '21', null, null);
INSERT INTO `member_medias` VALUES ('154', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/b3de234501d89fc50a11d38687b46dba/DATHACO.jpg', '1', '3', '22', null, null);
INSERT INTO `member_medias` VALUES ('155', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/b3de234501d89fc50a11d38687b46dba/timthumb.jpg', '1', '4', '22', null, null);
INSERT INTO `member_medias` VALUES ('156', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/3725f71f29e84a1737d2927bcd940e8e/timthumb.jpg', '1', '4', '23', null, null);
INSERT INTO `member_medias` VALUES ('157', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/b887218a79f3692ca70ce6681acf62ac/ctychannuoivietthang.bmp', '1', '3', '24', null, null);
INSERT INTO `member_medias` VALUES ('158', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/b887218a79f3692ca70ce6681acf62ac/timthumb.jpg', '1', '4', '24', null, null);
INSERT INTO `member_medias` VALUES ('159', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/1cefc31e2c5247bbbe65ce6e5eacf567/THUFICO.jpg', '1', '3', '25', null, null);
INSERT INTO `member_medias` VALUES ('160', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/1cefc31e2c5247bbbe65ce6e5eacf567/timthumb.jpg', '1', '4', '25', null, null);
INSERT INTO `member_medias` VALUES ('161', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/084cee3df930ea59cd6590be9042ddf6/quangdai.jpg', '1', '3', '26', null, null);
INSERT INTO `member_medias` VALUES ('162', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/084cee3df930ea59cd6590be9042ddf6/timthumb.jpg', '1', '4', '26', null, null);
INSERT INTO `member_medias` VALUES ('166', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/99b3df54c948d2c8ce9b9bb5d9dd535d/BUREAU.jpg', '1', '3', '28', null, null);
INSERT INTO `member_medias` VALUES ('167', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/99b3df54c948d2c8ce9b9bb5d9dd535d/timthumb.jpg', '1', '4', '28', null, null);
INSERT INTO `member_medias` VALUES ('168', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/9f122462ed0e13c444244862a25c4291/bienviet.jpg', '1', '3', '29', null, null);
INSERT INTO `member_medias` VALUES ('169', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/9f122462ed0e13c444244862a25c4291/timthumb.jpg', '1', '4', '29', null, null);
INSERT INTO `member_medias` VALUES ('170', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/a4993926fbd7bfade29ae54d7c463a83/truonggiang.png', '1', '3', '30', null, null);
INSERT INTO `member_medias` VALUES ('171', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/a4993926fbd7bfade29ae54d7c463a83/timthumb.jpg', '1', '4', '30', null, null);
INSERT INTO `member_medias` VALUES ('172', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/828dae3ec293b8ca7e8fe3ea27c96eae/ok.jpg', '1', '3', '31', null, null);
INSERT INTO `member_medias` VALUES ('173', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/828dae3ec293b8ca7e8fe3ea27c96eae/timthumb.jpg', '1', '4', '31', null, null);
INSERT INTO `member_medias` VALUES ('174', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/a6a7e259c61b4699499bd54a835acf20/hsQUOCTE.png', '1', '3', '32', null, null);
INSERT INTO `member_medias` VALUES ('175', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/a6a7e259c61b4699499bd54a835acf20/bg_slide.png', '1', '4', '32', null, null);
INSERT INTO `member_medias` VALUES ('176', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/d7c82260d527f8af54d4598f7bf7a7e3/Logo-Safeseafood2.jpg', '1', '3', '33', null, null);
INSERT INTO `member_medias` VALUES ('177', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/d7c82260d527f8af54d4598f7bf7a7e3/timthumb.jpg', '1', '4', '33', null, null);
INSERT INTO `member_medias` VALUES ('178', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5940f54eb3e080637f57019cb9ac28f6/BAYER.jpg', '2', '3', '34', null, null);
INSERT INTO `member_medias` VALUES ('179', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5940f54eb3e080637f57019cb9ac28f6/Naming_Vietnam_995.png', '1', '4', '34', null, null);
INSERT INTO `member_medias` VALUES ('180', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/872f6d20a72d6bec588915034f024c86/HHFISH.jpg', '1', '3', '35', null, null);
INSERT INTO `member_medias` VALUES ('181', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/872f6d20a72d6bec588915034f024c86/timthumb.jpg', '1', '4', '35', null, null);
INSERT INTO `member_medias` VALUES ('182', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/d7b576f153fef7ebaf1fee34f19922d2/AQUATEXBENTRE.jpg', '1', '3', '36', null, null);
INSERT INTO `member_medias` VALUES ('183', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/d7b576f153fef7ebaf1fee34f19922d2/timthumb.jpg', '1', '4', '36', null, null);
INSERT INTO `member_medias` VALUES ('184', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/2062defb827318d054cf04df88a299a1/FATIFISHCO.jpg', '1', '3', '37', null, null);
INSERT INTO `member_medias` VALUES ('185', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/2062defb827318d054cf04df88a299a1/bg_slide.png', '1', '4', '37', null, null);
INSERT INTO `member_medias` VALUES ('186', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/4f0071ed64467e0b2e2c7987cf4676a6/logo_AGIFISH.jpg', '1', '3', '38', null, null);
INSERT INTO `member_medias` VALUES ('187', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/4f0071ed64467e0b2e2c7987cf4676a6/bg_slide.png', '1', '4', '38', null, null);
INSERT INTO `member_medias` VALUES ('188', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/6ffcdcca327344383581cddcd4793cd9/PHUTHANH.jpg', '1', '3', '39', null, null);
INSERT INTO `member_medias` VALUES ('189', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/6ffcdcca327344383581cddcd4793cd9/timthumb.jpg', '1', '4', '39', null, null);
INSERT INTO `member_medias` VALUES ('190', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/befa0f2ecb4ff855a15152a113ec7419/NTACO.jpg', '1', '3', '40', null, null);
INSERT INTO `member_medias` VALUES ('191', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/befa0f2ecb4ff855a15152a113ec7419/timthumb.jpg', '1', '4', '40', null, null);
INSERT INTO `member_medias` VALUES ('192', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/49a2200aa3aef3d4aef7fc94fd838257/SEAPRODEX.jpg', '1', '3', '41', null, null);
INSERT INTO `member_medias` VALUES ('193', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/49a2200aa3aef3d4aef7fc94fd838257/timthumb.jpg', '1', '4', '41', null, null);
INSERT INTO `member_medias` VALUES ('194', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/d5a49613e5587bdb6b3db181603f29a7/IDICORPORATION.jpg', '1', '3', '42', null, null);
INSERT INTO `member_medias` VALUES ('195', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/d5a49613e5587bdb6b3db181603f29a7/timthumb.jpg', '1', '4', '42', null, null);
INSERT INTO `member_medias` VALUES ('196', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/abab09396d1c355f13a30680d4b7c1eb/dongaseafood.jpg', '1', '3', '43', null, null);
INSERT INTO `member_medias` VALUES ('197', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/abab09396d1c355f13a30680d4b7c1eb/timthumb.jpg', '1', '4', '43', null, null);
INSERT INTO `member_medias` VALUES ('198', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/d2e9f60c8cc908b485c06085fa5a081b/CLFISH.jpg', '1', '3', '44', null, null);
INSERT INTO `member_medias` VALUES ('199', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/d2e9f60c8cc908b485c06085fa5a081b/timthumb.jpg', '1', '4', '44', null, null);
INSERT INTO `member_medias` VALUES ('200', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/2693c33d3f4997e56d99e207cabd60fc/16918.png', '1', '3', '45', null, null);
INSERT INTO `member_medias` VALUES ('201', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/2693c33d3f4997e56d99e207cabd60fc/timthumb.jpg', '1', '4', '45', null, null);
INSERT INTO `member_medias` VALUES ('202', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/07f3e5b0f2df573800a9b21e54dca074/PHARMAQ.jpg', '1', '3', '46', null, null);
INSERT INTO `member_medias` VALUES ('203', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/07f3e5b0f2df573800a9b21e54dca074/timthumb.jpg', '1', '4', '46', null, null);
INSERT INTO `member_medias` VALUES ('206', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/03faadc0a11407a8504369fbdad23759/BIANFISHCO.jpg', '1', '3', '48', null, null);
INSERT INTO `member_medias` VALUES ('207', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/03faadc0a11407a8504369fbdad23759/timthumb.jpg', '1', '4', '48', null, null);
INSERT INTO `member_medias` VALUES ('208', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/43e02cfba20992e9817b2b16ece67756/logogepimex.bmp', '1', '3', '49', null, null);
INSERT INTO `member_medias` VALUES ('209', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/43e02cfba20992e9817b2b16ece67756/timthumb.jpg', '1', '4', '49', null, null);
INSERT INTO `member_medias` VALUES ('210', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/dc6906f7ac338a406b1668dc859cdf73/CASEAMEX.jpg', '1', '3', '50', null, null);
INSERT INTO `member_medias` VALUES ('211', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/dc6906f7ac338a406b1668dc859cdf73/timthumb.jpg', '1', '4', '50', null, null);
INSERT INTO `member_medias` VALUES ('212', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/3bd7d9badd2a764930c7a3b42e113525/CAFATEXCORP.jpg', '1', '3', '51', null, null);
INSERT INTO `member_medias` VALUES ('213', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/3bd7d9badd2a764930c7a3b42e113525/timthumb.jpg', '1', '4', '51', null, null);
INSERT INTO `member_medias` VALUES ('214', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/8c9a3e6435db2c7380242e5a9672e833/logoctyphuocanh .png', '1', '3', '52', null, null);
INSERT INTO `member_medias` VALUES ('215', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/8c9a3e6435db2c7380242e5a9672e833/timthumb.jpg', '1', '4', '52', null, null);
INSERT INTO `member_medias` VALUES ('216', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/2bf983715940e9d33b4d648341a92395/TRAVIFACO.jpg', '1', '3', '53', null, null);
INSERT INTO `member_medias` VALUES ('217', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/2bf983715940e9d33b4d648341a92395/timthumb.jpg', '1', '4', '53', null, null);
INSERT INTO `member_medias` VALUES ('218', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/3f3ff9e99748427fbb38f0848c607905/SAMEFICO.jpg', '1', '3', '54', null, null);
INSERT INTO `member_medias` VALUES ('219', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/3f3ff9e99748427fbb38f0848c607905/bg_slide.png', '1', '4', '54', null, null);
INSERT INTO `member_medias` VALUES ('220', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/810a53f55af9e12113166c4a189a8bcc/THANHHUNG.jpg', '1', '3', '55', null, null);
INSERT INTO `member_medias` VALUES ('221', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/810a53f55af9e12113166c4a189a8bcc/timthumb.jpg', '1', '4', '55', null, null);
INSERT INTO `member_medias` VALUES ('222', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/0198e9f1a5b6c743f600540a2b02c9c2/docifish.jpg', '1', '3', '56', null, null);
INSERT INTO `member_medias` VALUES ('223', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/0198e9f1a5b6c743f600540a2b02c9c2/bg_slide.png', '1', '4', '56', null, null);
INSERT INTO `member_medias` VALUES ('224', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/2dcaf967e1dc8cdcce4951ad0bb87eb1/TOCHAUJSC.jpg', '1', '3', '57', null, null);
INSERT INTO `member_medias` VALUES ('225', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/2dcaf967e1dc8cdcce4951ad0bb87eb1/bg_slide.png', '1', '4', '57', null, null);
INSERT INTO `member_medias` VALUES ('226', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/e9d6e8cdbf1927fcc8914580e2630581/ANVIFISH.jpg', '1', '3', '58', null, null);
INSERT INTO `member_medias` VALUES ('227', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/e9d6e8cdbf1927fcc8914580e2630581/bg_slide.png', '1', '4', '58', null, null);
INSERT INTO `member_medias` VALUES ('228', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/eb50175de7aef6dfe822832872f9c423/NAVICO.jpg', '1', '3', '59', null, null);
INSERT INTO `member_medias` VALUES ('229', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/eb50175de7aef6dfe822832872f9c423/timthumb.jpg', '1', '4', '59', null, null);
INSERT INTO `member_medias` VALUES ('230', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/7516e7722ba3fa644cf8067d5441c41f/AFIEX.jpg', '1', '3', '60', null, null);
INSERT INTO `member_medias` VALUES ('231', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/7516e7722ba3fa644cf8067d5441c41f/timthumb.jpg', '1', '4', '60', null, null);
INSERT INTO `member_medias` VALUES ('232', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/269a0417782fb17f07ef6ce6b68b11a3/TUV1.jpg', '1', '3', '17', null, null);
INSERT INTO `member_medias` VALUES ('233', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/269a0417782fb17f07ef6ce6b68b11a3/timthumb.jpg', '1', '4', '17', null, null);
INSERT INTO `member_medias` VALUES ('234', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/9efdbfd238c7d1270e690cfaddd1015c/logoDLBenTre.png', '2', '3', '27', null, null);
INSERT INTO `member_medias` VALUES ('235', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/9efdbfd238c7d1270e690cfaddd1015c/2slider_pic01.jpg', '1', '4', '27', null, null);
INSERT INTO `member_medias` VALUES ('236', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/605df19c7e25da2ecf7f30f340b55d11/logoc.pvn.gif', '2', '3', '47', null, null);
INSERT INTO `member_medias` VALUES ('237', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/605df19c7e25da2ecf7f30f340b55d11/timthumb.jpg', '1', '4', '47', null, null);
INSERT INTO `member_medias` VALUES ('238', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/ab89acbc1a8b625a74038d1a66622dc4/logo-web.png', '1', '3', '61', null, null);
INSERT INTO `member_medias` VALUES ('239', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5dae336c17dc37c1a3b9b4baa567bc62/306789_213916965339789_429070798_n.jpg', '1', '3', '62', null, null);
INSERT INTO `member_medias` VALUES ('240', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/8ad8dca4f34a6851a91323a5491dbe1a/vietuc_05.jpg', '1', '3', '63', null, null);
INSERT INTO `member_medias` VALUES ('241', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/8ad8dca4f34a6851a91323a5491dbe1a/timthumb.jpg', '1', '4', '63', null, null);
INSERT INTO `member_medias` VALUES ('242', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/601007b979f29b4904f5ddae736f5774/logo-hungvuong.png', '1', '3', '64', null, null);
INSERT INTO `member_medias` VALUES ('243', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/601007b979f29b4904f5ddae736f5774/timthumb.jpg', '1', '4', '64', null, null);
INSERT INTO `member_medias` VALUES ('244', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/870431734e9ae0ae4f08feda2f95bd6f/logo_NgocXuan.jpg', '1', '3', '65', null, null);
INSERT INTO `member_medias` VALUES ('245', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/870431734e9ae0ae4f08feda2f95bd6f/timthumb.jpg', '1', '4', '65', null, null);
INSERT INTO `member_medias` VALUES ('246', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/333eca0944a456a72c2a7162814f22dd/logo.gif', '1', '3', '66', null, null);
INSERT INTO `member_medias` VALUES ('247', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/333eca0944a456a72c2a7162814f22dd/bg_slide.png', '1', '4', '66', null, null);
INSERT INTO `member_medias` VALUES ('248', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/b614cd85a57b0b96431ec814ef1a2f0c/ASEAFOOD.jpg', '1', '3', '67', null, null);
INSERT INTO `member_medias` VALUES ('249', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/b614cd85a57b0b96431ec814ef1a2f0c/banner2.jpg', '1', '4', '67', null, null);
INSERT INTO `member_medias` VALUES ('268', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/434afd37f92ed4866da1538903ac77ca/L80300002.jpg', '1', '3', '4', null, null);
INSERT INTO `member_medias` VALUES ('269', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/434afd37f92ed4866da1538903ac77ca/timthumb.jpg', '1', '4', '4', null, null);
INSERT INTO `member_medias` VALUES ('270', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5ad9eb0a761abd9933835ba1866ff8e1/comay1.png', '1', '3', '1', null, null);
INSERT INTO `member_medias` VALUES ('271', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5ad9eb0a761abd9933835ba1866ff8e1/food.jpg', '1', '4', '1', null, null);

-- ----------------------------
-- Table structure for member_product_approves
-- ----------------------------
DROP TABLE IF EXISTS `member_product_approves`;
CREATE TABLE `member_product_approves` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_product_id` int(10) unsigned DEFAULT NULL,
  `member_product_request_id` int(10) unsigned DEFAULT NULL,
  `approved` tinyint(4) DEFAULT NULL,
  `approved_by` int(10) unsigned DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of member_product_approves
-- ----------------------------
INSERT INTO `member_product_approves` VALUES ('1', '1', '1', null, '1', null, '2016-04-07 10:17:21', '2016-04-07 03:17:21');
INSERT INTO `member_product_approves` VALUES ('2', '1', '2', null, '1', null, '2016-04-06 03:07:24', '2016-04-06 03:07:24');
INSERT INTO `member_product_approves` VALUES ('3', '1', '3', null, '1', null, '2016-04-06 03:07:26', '2016-04-06 03:07:26');
INSERT INTO `member_product_approves` VALUES ('4', '1', '4', null, null, null, '2016-04-07 10:33:34', '2016-04-07 10:33:34');
INSERT INTO `member_product_approves` VALUES ('5', '1', '71', null, '1', null, '2016-04-07 10:33:42', '2016-04-07 03:33:42');
INSERT INTO `member_product_approves` VALUES ('6', '1', '122', null, null, null, '2016-04-07 10:33:34', '2016-04-07 10:33:34');

-- ----------------------------
-- Table structure for member_product_requests
-- ----------------------------
DROP TABLE IF EXISTS `member_product_requests`;
CREATE TABLE `member_product_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_product_id` int(10) unsigned DEFAULT NULL,
  `member_product_approve_id` int(10) unsigned DEFAULT NULL,
  `requested` tinyint(4) DEFAULT NULL,
  `requested_by` int(10) unsigned DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of member_product_requests
-- ----------------------------
INSERT INTO `member_product_requests` VALUES ('1', '1', '1', null, '1', null, '2016-04-07 10:17:21', '2016-04-07 03:17:21');
INSERT INTO `member_product_requests` VALUES ('2', '1', '2', null, '1', null, '2016-04-06 03:07:24', '2016-04-06 03:07:24');
INSERT INTO `member_product_requests` VALUES ('3', '1', '3', null, '1', null, '2016-04-06 03:07:26', '2016-04-06 03:07:26');
INSERT INTO `member_product_requests` VALUES ('4', '1', '4', null, null, null, '2016-04-07 10:33:34', '2016-04-07 10:33:34');
INSERT INTO `member_product_requests` VALUES ('5', '1', '71', null, '1', null, '2016-04-07 10:33:42', '2016-04-07 03:33:42');
INSERT INTO `member_product_requests` VALUES ('6', '1', '122', null, null, null, '2016-04-07 10:33:34', '2016-04-07 10:33:34');

-- ----------------------------
-- Table structure for member_products
-- ----------------------------
DROP TABLE IF EXISTS `member_products`;
CREATE TABLE `member_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned DEFAULT NULL,
  `product_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of member_products
-- ----------------------------
INSERT INTO `member_products` VALUES ('7', '64', '18', '1', '2016-04-07 10:31:46', '2016-04-07 10:31:46');
INSERT INTO `member_products` VALUES ('8', '64', '17', '1', '2016-04-07 10:32:05', '2016-04-07 10:32:05');
INSERT INTO `member_products` VALUES ('9', '64', '16', '1', '2016-04-07 10:32:26', '2016-04-07 10:32:26');
INSERT INTO `member_products` VALUES ('10', '64', '15', '1', '2016-04-07 10:32:44', '2016-04-07 10:32:44');
INSERT INTO `member_products` VALUES ('11', '64', '83', '1', '2016-04-07 10:34:29', '2016-04-07 10:34:29');
INSERT INTO `member_products` VALUES ('12', '64', '29', '1', '2016-04-07 10:34:43', '2016-04-07 10:34:43');
INSERT INTO `member_products` VALUES ('13', '64', '28', '1', '2016-04-07 10:34:57', '2016-04-07 10:34:57');
INSERT INTO `member_products` VALUES ('14', '64', '40', '1', '2016-04-07 10:35:56', '2016-04-07 10:35:56');
INSERT INTO `member_products` VALUES ('15', '63', '14', '1', '2016-04-07 10:38:29', '2016-04-07 10:38:29');
INSERT INTO `member_products` VALUES ('16', '63', '42', '1', '2016-04-07 10:43:19', '2016-04-07 10:43:19');
INSERT INTO `member_products` VALUES ('17', '63', '41', '1', '2016-04-07 10:43:33', '2016-04-07 10:43:33');
INSERT INTO `member_products` VALUES ('18', '63', '61', '1', '2016-04-07 10:44:18', '2016-04-07 10:44:18');
INSERT INTO `member_products` VALUES ('19', '63', '62', '1', '2016-04-07 10:44:37', '2016-04-07 10:44:37');
INSERT INTO `member_products` VALUES ('20', '6', '1', '1', '2016-04-07 10:54:30', '2016-04-07 10:54:30');
INSERT INTO `member_products` VALUES ('22', '6', '5', '1', '2016-04-07 10:56:38', '2016-04-07 10:56:38');
INSERT INTO `member_products` VALUES ('24', '6', '71', '1', '2016-04-07 10:57:21', '2016-04-07 10:57:21');
INSERT INTO `member_products` VALUES ('25', '27', '76', '1', '2016-04-07 11:07:59', '2016-04-07 11:07:59');
INSERT INTO `member_products` VALUES ('26', '27', '77', '1', '2016-04-07 11:09:07', '2016-04-07 11:09:07');
INSERT INTO `member_products` VALUES ('27', '61', '3', '1', '2016-04-07 11:10:24', '2016-04-07 11:10:24');
INSERT INTO `member_products` VALUES ('29', '49', '4', '1', '2016-04-07 11:14:45', '2016-04-07 11:14:45');
INSERT INTO `member_products` VALUES ('30', '49', '39', '1', '2016-04-07 11:15:56', '2016-04-07 11:15:56');
INSERT INTO `member_products` VALUES ('31', '2', '2', '1', '2016-04-07 11:22:54', '2016-04-07 11:22:54');
INSERT INTO `member_products` VALUES ('35', '2', '119', '1', '2016-04-07 11:25:42', '2016-04-07 11:25:42');
INSERT INTO `member_products` VALUES ('36', '2', '94', '1', '2016-04-07 18:29:13', '2016-04-07 11:29:13');
INSERT INTO `member_products` VALUES ('37', '2', '120', '1', '2016-04-07 11:26:50', '2016-04-07 11:26:50');
INSERT INTO `member_products` VALUES ('38', '8', '74', '1', '2016-04-07 11:28:34', '2016-04-07 11:28:34');
INSERT INTO `member_products` VALUES ('41', '8', '35', '1', '2016-04-07 11:30:20', '2016-04-07 11:30:20');
INSERT INTO `member_products` VALUES ('44', '65', '13', '1', '2016-04-07 11:35:58', '2016-04-07 11:35:58');
INSERT INTO `member_products` VALUES ('45', '65', '67', '1', '2016-04-07 11:37:05', '2016-04-07 11:37:05');
INSERT INTO `member_products` VALUES ('48', '3', '75', '1', '2016-04-07 11:38:53', '2016-04-07 11:38:53');
INSERT INTO `member_products` VALUES ('49', '3', '24', '1', '2016-04-07 11:39:12', '2016-04-07 11:39:12');
INSERT INTO `member_products` VALUES ('50', '3', '6', '1', '2016-04-07 11:42:44', '2016-04-07 11:42:44');
INSERT INTO `member_products` VALUES ('51', '3', '27', '1', '2016-04-07 11:43:21', '2016-04-07 11:43:21');
INSERT INTO `member_products` VALUES ('54', '3', '85', '1', '2016-04-07 11:45:53', '2016-04-07 11:45:53');
INSERT INTO `member_products` VALUES ('55', '3', '93', '1', '2016-04-07 11:46:09', '2016-04-07 11:46:09');
INSERT INTO `member_products` VALUES ('56', '4', '95', '1', '2016-04-07 11:47:51', '2016-04-07 11:47:51');
INSERT INTO `member_products` VALUES ('59', '4', '110', '1', '2016-04-07 12:12:23', '2016-04-07 12:12:23');
INSERT INTO `member_products` VALUES ('60', '4', '109', '1', '2016-04-07 12:12:36', '2016-04-07 12:12:36');
INSERT INTO `member_products` VALUES ('61', '4', '111', '1', '2016-04-07 12:13:04', '2016-04-07 12:13:04');
INSERT INTO `member_products` VALUES ('62', '4', '112', '1', '2016-04-07 12:13:25', '2016-04-07 12:13:25');
INSERT INTO `member_products` VALUES ('63', '4', '113', '1', '2016-04-07 12:13:35', '2016-04-07 12:13:35');
INSERT INTO `member_products` VALUES ('64', '4', '114', '1', '2016-04-07 12:14:15', '2016-04-07 12:14:15');
INSERT INTO `member_products` VALUES ('65', '4', '116', '1', '2016-04-07 12:14:43', '2016-04-07 12:14:43');
INSERT INTO `member_products` VALUES ('66', '67', '87', '1', '2016-04-07 12:15:14', '2016-04-07 12:15:14');
INSERT INTO `member_products` VALUES ('67', '67', '88', '1', '2016-04-07 12:15:27', '2016-04-07 12:15:27');
INSERT INTO `member_products` VALUES ('69', '67', '23', '1', '2016-04-07 12:15:53', '2016-04-07 12:15:53');
INSERT INTO `member_products` VALUES ('70', '67', '37', '1', '2016-04-07 12:16:22', '2016-04-07 12:16:22');
INSERT INTO `member_products` VALUES ('71', '67', '36', '1', '2016-04-07 12:16:35', '2016-04-07 12:16:35');
INSERT INTO `member_products` VALUES ('73', '67', '34', '1', '2016-04-07 12:17:11', '2016-04-07 12:17:11');
INSERT INTO `member_products` VALUES ('74', '67', '47', '1', '2016-04-07 12:17:59', '2016-04-07 12:17:59');
INSERT INTO `member_products` VALUES ('75', '67', '48', '1', '2016-04-07 12:18:12', '2016-04-07 12:18:12');
INSERT INTO `member_products` VALUES ('77', '67', '92', '1', '2016-04-07 12:19:09', '2016-04-07 12:19:09');
INSERT INTO `member_products` VALUES ('80', '61', '19', '1', '2016-04-07 13:44:33', '2016-04-07 13:44:33');
INSERT INTO `member_products` VALUES ('81', '61', '20', '1', '2016-04-07 13:44:54', '2016-04-07 13:44:54');
INSERT INTO `member_products` VALUES ('82', '10', '21', '1', '2016-04-07 13:47:53', '2016-04-07 13:47:53');
INSERT INTO `member_products` VALUES ('83', '3', '22', '1', '2016-04-07 13:48:50', '2016-04-07 13:48:50');
INSERT INTO `member_products` VALUES ('84', '62', '25', '1', '2016-04-07 13:50:11', '2016-04-07 13:50:11');
INSERT INTO `member_products` VALUES ('85', '62', '26', '1', '2016-04-07 13:51:41', '2016-04-07 13:51:41');
INSERT INTO `member_products` VALUES ('86', '66', '30', '1', '2016-04-07 13:55:01', '2016-04-07 13:55:01');
INSERT INTO `member_products` VALUES ('87', '66', '31', '1', '2016-04-07 13:56:13', '2016-04-07 13:56:13');
INSERT INTO `member_products` VALUES ('88', '66', '32', '1', '2016-04-07 13:56:53', '2016-04-07 13:56:53');
INSERT INTO `member_products` VALUES ('89', '9', '38', '1', '2016-04-07 14:03:36', '2016-04-07 14:03:36');
INSERT INTO `member_products` VALUES ('90', '64', '43', '1', '2016-04-07 14:04:57', '2016-04-07 14:04:57');
INSERT INTO `member_products` VALUES ('91', '65', '44', '1', '2016-04-07 14:06:19', '2016-04-07 14:06:19');
INSERT INTO `member_products` VALUES ('92', '59', '89', '1', '2016-04-07 14:06:56', '2016-04-07 14:06:56');
INSERT INTO `member_products` VALUES ('93', '45', '46', '1', '2016-04-07 14:08:11', '2016-04-07 14:08:11');
INSERT INTO `member_products` VALUES ('94', '20', '49', '1', '2016-04-07 14:10:24', '2016-04-07 14:10:24');
INSERT INTO `member_products` VALUES ('95', '20', '50', '1', '2016-04-07 14:10:45', '2016-04-07 14:10:45');
INSERT INTO `member_products` VALUES ('96', '20', '51', '1', '2016-04-07 14:11:51', '2016-04-07 14:11:51');
INSERT INTO `member_products` VALUES ('97', '62', '52', '1', '2016-04-07 14:12:37', '2016-04-07 14:12:37');
INSERT INTO `member_products` VALUES ('98', '62', '53', '1', '2016-04-07 14:13:07', '2016-04-07 14:13:07');
INSERT INTO `member_products` VALUES ('99', '62', '54', '1', '2016-04-07 14:13:28', '2016-04-07 14:13:28');
INSERT INTO `member_products` VALUES ('100', '62', '55', '1', '2016-04-07 14:13:59', '2016-04-07 14:13:59');
INSERT INTO `member_products` VALUES ('101', '62', '56', '1', '2016-04-07 14:14:27', '2016-04-07 14:14:27');
INSERT INTO `member_products` VALUES ('102', '62', '57', '1', '2016-04-07 14:15:08', '2016-04-07 14:15:08');
INSERT INTO `member_products` VALUES ('103', '62', '60', '1', '2016-04-07 14:15:43', '2016-04-07 14:15:43');
INSERT INTO `member_products` VALUES ('104', '62', '59', '1', '2016-04-07 14:15:56', '2016-04-07 14:15:56');
INSERT INTO `member_products` VALUES ('105', '62', '68', '1', '2016-04-07 14:19:13', '2016-04-07 14:19:13');
INSERT INTO `member_products` VALUES ('106', '4', '69', '1', '2016-04-07 14:20:01', '2016-04-07 14:20:01');
INSERT INTO `member_products` VALUES ('107', '2', '78', '1', '2016-04-07 14:23:06', '2016-04-07 14:23:06');
INSERT INTO `member_products` VALUES ('108', '2', '79', '1', '2016-04-07 14:23:36', '2016-04-07 14:23:36');
INSERT INTO `member_products` VALUES ('109', '2', '80', '1', '2016-04-07 14:24:36', '2016-04-07 14:24:36');
INSERT INTO `member_products` VALUES ('110', '62', '82', '1', '2016-04-07 14:28:46', '2016-04-07 14:28:46');
INSERT INTO `member_products` VALUES ('111', '66', '84', '1', '2016-04-07 14:29:55', '2016-04-07 14:29:55');
INSERT INTO `member_products` VALUES ('112', '66', '86', '1', '2016-04-07 14:31:39', '2016-04-07 14:31:39');
INSERT INTO `member_products` VALUES ('113', '3', '119', '1', '2016-04-07 14:32:52', '2016-04-07 14:32:52');
INSERT INTO `member_products` VALUES ('114', '67', '90', '1', '2016-04-07 14:33:37', '2016-04-07 14:33:37');
INSERT INTO `member_products` VALUES ('115', '67', '91', '1', '2016-04-07 14:33:55', '2016-04-07 14:33:55');
INSERT INTO `member_products` VALUES ('116', '67', '96', '1', '2016-04-07 14:35:33', '2016-04-07 14:35:33');
INSERT INTO `member_products` VALUES ('117', '67', '97', '1', '2016-04-07 14:36:40', '2016-04-07 14:36:40');
INSERT INTO `member_products` VALUES ('118', '20', '98', '1', '2016-04-07 14:37:46', '2016-04-07 14:37:46');
INSERT INTO `member_products` VALUES ('119', '20', '99', '1', '2016-04-07 14:38:10', '2016-04-07 14:38:10');
INSERT INTO `member_products` VALUES ('120', '20', '100', '1', '2016-04-07 14:38:30', '2016-04-07 14:38:30');
INSERT INTO `member_products` VALUES ('121', '5', '89', '1', '2016-04-07 14:39:38', '2016-04-07 14:39:38');
INSERT INTO `member_products` VALUES ('122', '3', '50', '1', '2016-04-07 14:40:51', '2016-04-07 14:40:51');
INSERT INTO `member_products` VALUES ('123', '20', '103', '1', '2016-04-07 14:41:48', '2016-04-07 14:41:48');
INSERT INTO `member_products` VALUES ('124', '3', '93', '1', '2016-04-07 14:43:43', '2016-04-07 14:43:43');
INSERT INTO `member_products` VALUES ('125', '20', '105', '1', '2016-04-07 14:44:39', '2016-04-07 14:44:39');
INSERT INTO `member_products` VALUES ('126', '4', '106', '1', '2016-04-07 14:45:34', '2016-04-07 14:45:34');
INSERT INTO `member_products` VALUES ('127', '4', '107', '1', '2016-04-07 14:45:52', '2016-04-07 14:45:52');
INSERT INTO `member_products` VALUES ('128', '4', '108', '1', '2016-04-07 14:46:13', '2016-04-07 14:46:13');
INSERT INTO `member_products` VALUES ('129', '62', '121', '1', '2016-04-07 14:47:45', '2016-04-07 14:47:45');
INSERT INTO `member_products` VALUES ('130', '4', '122', '1', '2016-04-07 14:48:40', '2016-04-07 14:48:40');
INSERT INTO `member_products` VALUES ('131', '62', '123', '1', '2016-04-07 14:49:23', '2016-04-07 14:49:23');
INSERT INTO `member_products` VALUES ('132', '62', '124', '1', '2016-04-07 14:49:47', '2016-04-07 14:49:47');

-- ----------------------------
-- Table structure for member_users
-- ----------------------------
DROP TABLE IF EXISTS `member_users`;
CREATE TABLE `member_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ic` int(10) unsigned NOT NULL,
  `ic_certified_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ic_certified_at` date DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `member_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of member_users
-- ----------------------------
INSERT INTO `member_users` VALUES ('21', '132465', 'Inno Soft', '2016-03-31', '24', '3', '2016-04-05 15:20:20', '2016-04-05 08:20:20');
INSERT INTO `member_users` VALUES ('22', '123456', 'admin', '0000-00-00', '1', '4', '2016-04-07 16:41:12', '2016-04-07 09:41:12');
INSERT INTO `member_users` VALUES ('32', '1', '', '1970-01-01', '34', '2', '2016-04-05 08:24:56', '2016-04-05 01:24:56');
INSERT INTO `member_users` VALUES ('33', '2', null, '1970-01-01', '35', '3', '2016-04-05 01:24:44', '2016-04-05 01:24:44');

-- ----------------------------
-- Table structure for members
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `member_shortname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_othername` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_tin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `member_phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `member_fax` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_google` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_youtube` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_ads` tinyint(4) DEFAULT NULL,
  `member_block` tinyint(4) NOT NULL,
  `member_categories` text COLLATE utf8_unicode_ci,
  `sort` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `member_alias_unique` (`member_alias`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of members
-- ----------------------------
INSERT INTO `members` VALUES ('1', 'Công ty TNHH Cỏ May Lai Vung', 'Cỏ May', '', 'co-may', '', 'Lô 18-19, KCN Sông Hậu, Tân Thành, Lai Vung, Đồng Tháp', '(067) 361.5999', '', '', 'www.comaygroup.com', '', '', '', '', '1', '0', null, '0', '2016-03-23 06:09:39', '2016-04-13 10:24:12');
INSERT INTO `members` VALUES ('2', 'CÔNG TY TNHH VẠN DẠT', 'VẠN DẠT', '', 'van-dat', null, 'Lầu 1, 799 Nguyễn Văn Linh, P. Tân Phú, Q.7, TP. Hồ Chí Minh, Việt Nam', '08 54 126 555', '', '', 'vandatfood.com.vn', '', '', '', '', '1', '0', null, '0', '2016-03-23 06:09:40', '2016-03-23 06:09:40');
INSERT INTO `members` VALUES ('3', 'Công ty TNHH Hùng Cá', 'Hùng Cá', '', 'hung-ca', null, 'Khu công nghiệp Thanh Bình, Đường quốc lộ 30, Q.Thanh Bình, Tỉnh Đồng Tháp, Việt Nam', '(+84) 67 354 1359', '', '', 'hungca.com', '', '', '', '', '1', '1', null, '0', '2016-03-29 14:52:38', '2016-03-29 14:52:38');
INSERT INTO `members` VALUES ('4', 'Công ty Cổ phần Vĩnh Hoàn', 'Vĩnh Hoàn', '', 'vinh-hoan', null, 'Công Ty Cổ Phần Vĩnh Hoàn Quốc Lộ 30, Phường 11, Thành Phố Cao Lãnh, Tỉnh Đồng Tháp, Việt Nam', '(84.67) 3891166', '', '', 'http://www.vinhhoan.com.vn/', '', '', '', '', '1', '0', null, '0', '2016-03-23 06:09:42', '2016-03-23 06:09:42');
INSERT INTO `members` VALUES ('5', 'Công ty TNHH Thủy sản Biển Đông', 'Biển Đông', '', 'bien-dong', null, 'Lô II - 18B1, 18B2 khu công nghiệp Trà Nóc 2, phường Phước Thới, Quận Ô Môn, Tp. Cần Thơ, Việt Nam', '+84.71-844.201', '', '', 'biendongseafood.com.vn', '', '', '', '', '0', '0', null, '0', '2016-03-23 06:09:43', '2016-03-23 06:09:43');
INSERT INTO `members` VALUES ('6', 'CÔNG TY CỔ PHẦN ĐẦU TƯ  VÀ PHÁT TRIỂN ĐA QUỐC GIA', 'IDI', '', 'idi', null, 'Quốc lộ 80, Cụm CN Vàm Cống, ấp An Thạnh, xã Bình Thành, huyện Lấp Vò, Đồng Tháp', '0673 680 383', '', '', 'www.idiseafood.com', '', '', '', '', '0', '0', null, '0', '2016-03-23 06:09:47', '2016-03-23 06:09:47');
INSERT INTO `members` VALUES ('7', 'Cafatex Corporation', 'Cafatex', '', 'cafatex', null, 'No.1A Chau Thanh A Dist. Hau Giang Provice - Vietnam', '84(710)384 6134', '', '', 'cafatex.com.vn', '', '', '', '', '0', '0', null, '0', '2016-03-23 06:19:01', '2016-03-23 06:19:01');
INSERT INTO `members` VALUES ('8', 'CÔNG TY CỔ PHẦN XUẤT NHẬP KHẨU THỦY SẢN CẦN THƠ', 'CASEAMEX', '', 'caseamex', null, 'Lô 2.12, Khu công nghiệp Trà Noc II, Q.  Ô Môn Tp. Cần Thơ, Việt Nam', '+84 710 3 744619', '', '', 'caseamex.com.vn', '', '', '', '', '0', '0', null, '0', '2016-03-23 06:19:13', '2016-03-23 06:19:13');
INSERT INTO `members` VALUES ('9', 'Công Ty Đông Á Seafood', 'Đông Á', '', 'dong-a', null, 'Số 13C Lê Lai, phường Mỹ Bình, Tp.Long Xuyên, tỉnh An Giang', '(+84-76) 3935 931', '', '', 'www.dongaseafood.com', '', '', '', '', '0', '0', null, '0', '2016-03-23 06:34:22', '2016-03-23 06:34:22');
INSERT INTO `members` VALUES ('10', 'Công ty Cổ phần XNK Thủy sản An Giang', 'AGIFISH', '', 'agifish', null, '1234 Trần Hưng Đạo - P. Bình Đức - TP. Long Xuyên - An Giang', '(076) 3852368', '', '', 'agifish.com.vn', '', '', '', '', '0', '0', null, '0', '2016-03-23 06:34:24', '2016-03-23 06:34:24');
INSERT INTO `members` VALUES ('11', 'Hùng Hậu', 'Hùng Hậu', '', 'hung-hau', null, '1004 A, Âu Cơ, Phường Phú Trung, Quận Tân Phú, TP.HCM', '(+84) 08 39 77 0333', '', '', 'www.hunghau.vn', '', '', '', '', '0', '0', null, '0', '2016-03-23 06:42:13', '2016-03-23 06:42:13');
INSERT INTO `members` VALUES ('12', 'Công ty CP XNK Lâm Thủy Sản Bến Tre', 'Aquimex', '', 'aquimex', null, '71 Quốc lộ 60, thị trấn Châu Thành, huyện Châu Thành, tỉnh Bến Tre', '(84) 75.3895 795', '', '', 'www.faquimex.com.vn', '', '', '', '', '0', '0', null, '0', '2016-03-23 06:42:14', '2016-03-23 06:42:14');
INSERT INTO `members` VALUES ('14', 'CN Tại TP HCM Công ty TNHH Hai Thành Viên Hải Sản 404', null, null, 'cn-tai-tp-hcm-cong-ty-tnhh-hai-thanh-vien-hai-san-404', null, 'Số 43 Hoa Đào, Phường 02,Q. Phú Nhuận, TP.Hồ Chí Minh ', '0835178473 ', null, 'cnhcm404@gmail.com ', null, '', '', '', '', null, '0', null, null, '2016-04-04 06:58:12', '2016-04-04 06:58:12');
INSERT INTO `members` VALUES ('15', 'Công ty TNHH Thương Mại Thú Y Tân Tiến ', '', 'Modern Veterinary Tranding co.,ltd ', 'cong-ty-tnhh-thuong-mai-thu-y-tan-tien', null, '62/8-62/10-62/12 Bàu Cát, P.14,Q.Tân Bình', '0838492975 ', '083493177 ', 'tantien@tantien.com', '', '', '', '', '', '0', '0', null, '0', '2016-04-04 14:11:21', '2016-04-04 07:11:21');
INSERT INTO `members` VALUES ('16', 'Công ty TNHH Việt Hiếu Nghĩa', '', '', 'cong-ty-tnhh-viet-hieu-nghia', null, '9/9 Lý Văn Phức, P.Tân Dinh, Quận 1, TP.Hồ Chí Minh', '0835170075 ', '0835178470 ', 'hieunghia@hieunghia.com ', '', '', '', '', '', '0', '0', null, '0', '2016-04-04 14:11:45', '2016-04-04 07:11:45');
INSERT INTO `members` VALUES ('17', 'Công ty TNHH TUV SUD Việt Nam', '', 'TUV SUD Vietnam Company limited ', 'cong-ty-tnhh-tuv-sud-viet-nam', null, 'Lô III-26, đường 19/5A, nhóm công nghiệp III, KCN Tân Bình, P. Tây Thạnh, Q. Tân Phú, Tp Hồ Chí Minh', '0862678507 ', '0862678511 ', 'info@tuv-sud-psb.vn ', '', '', '', '', '', '0', '0', null, '0', '2016-04-04 14:12:02', '2016-04-04 07:12:02');
INSERT INTO `members` VALUES ('18', 'Công ty Cổ phần Thực phẩm Bạn và Tôi', '', 'BAN VA TOI FOODS CORPORATION ', 'cong-ty-co-phan-thuc-pham-ban-va-toi', null, '79-80 E1, Khu đô thị Sao Mai, P. BÌnh Khánh, Tp Long Xuyên, An Giang ', '0763957136', '0763934953', 'salesdept@bntpangamekong.vn ', 'http://www.pangamekong.com/', '', '', '', '', null, '0', null, null, '2016-04-04 07:24:30', '2016-04-04 07:24:30');
INSERT INTO `members` VALUES ('19', 'Công ty Cổ phần Santafood ', null, 'SANTAFOOD JOINT STOCK COMPANY', 'cong-ty-co-phan-santafood', null, '11B Ngô Văn Sở, P. Tân An, Q. Ninh Kiều, Tp CT', '07103768721 ', '07103768723 ', 'phuocthien@santafood.com.vn', 'http://www.santafood.vn/', '', '', '', '', null, '0', null, null, '2016-04-04 07:25:55', '2016-04-04 07:25:55');
INSERT INTO `members` VALUES ('20', 'Công ty TNHH Công nghiệp Thủy sản Miền Nam', null, 'SOUTH VINA', 'cong-ty-tnhh-cong-nghiep-thuy-san-mien-nam', null, 'Lô 2.14 KCN Trà Nóc II, phường Phước Thới, Quận Ô Môn, Cần Thơ', '07103744150 ', '07103844454 ', 'southvinafish@vnn.vn', 'http://www.southvinafish.com/', '', '', '', '', null, '0', null, null, '2016-04-04 07:27:04', '2016-04-04 07:27:04');
INSERT INTO `members` VALUES ('21', 'Công ty TNHH Đại Đại Thành', null, 'DAIDAITHANH SEAFOODS ', 'cong-ty-tnhh-dai-dai-thanh', null, 'Ấp Đông Hòa, xã Sông Thuận, Châu Thành, Tiền Giang ', '0732216214 ', '0733611678 ', 'info@daidaithanh.com ', 'www.daidaithanh.com ', '', '', '', '', null, '0', null, null, '2016-04-04 07:28:24', '2016-04-04 07:28:24');
INSERT INTO `members` VALUES ('22', 'Công ty TNHH Đại Thành', '', 'DAITHANH SEAFOODS', 'cong-ty-tnhh-dai-thanh', null, 'Âp Đông Hòa, Xã Đông Thuận, Châu Thành, Tiền Giang', '0733611115 ', '0733611101 ', 'contact@daithanhseafoods.com', 'www.daithanhseafoods.com', '', '', '', '', null, '0', null, null, '2016-04-04 07:34:16', '2016-04-04 07:34:16');
INSERT INTO `members` VALUES ('23', 'Doanh nghiệp tư nhân Ngân Phúc', null, null, 'doanh-nghiep-tu-nhan-ngan-phuc', null, '404 Lê Hồng Phong, P. Bình Thủy, Q. Bình Thủy, Tp Cần Thơ', '07103881693 ', '07103881833', 'docs@nganphucseafood.com.vn', null, '', '', '', '', null, '0', null, null, '2016-04-04 07:35:06', '2016-04-04 07:35:06');
INSERT INTO `members` VALUES ('24', 'CÔNG TY CP THỨC ĂN CHĂN NUÔI VIỆT THẮNG', null, 'VIET THANG CO.,LTD ', 'cong-ty-cp-thuc-an-chan-nuoi-viet-thang', null, 'Lô II-1, II-2, II-3, Khu C, KCN Sa Đéc, xã Tân Thành Đông, TX Sa Đéc, Đồng Tháp', '0673762678 ', '0673762679 ', 'vietthang@vietthangfeed.com.vn', 'www.vietthangfeed.com.vn ', '', '', '', '', null, '0', null, null, '2016-04-04 07:36:07', '2016-04-04 07:36:07');
INSERT INTO `members` VALUES ('25', 'Công ty TNHH Thuận Hưng ', 'THUFICO ', null, 'cong-ty-tnhh-thuan-hung', null, 'Km2078+300, QL1A, P.Bá Láng, Q.Cái Răng,TP.Cần Thơ', '07103911624 ', '07103911623 ', 'thuanhung@hcm.vnn.vn ', 'www.thufico.com ', '', '', '', '', null, '0', null, null, '2016-04-04 07:36:57', '2016-04-04 07:36:57');
INSERT INTO `members` VALUES ('26', 'Công ty TNHH MTV Thủy Hải sản Quang Đại', null, 'QUANG DAI SEAFOOD COMPANY LIMITED', 'cong-ty-tnhh-mtv-thuy-hai-san-quang-dai', null, '538 Lê Quang Sung, P.9, Q.6, TPHCM ', '0837613278 ', '0837613279 ', 'quangdai_seafoodcompany@yahoo.com', null, '', '', '', '', null, '0', null, null, '2016-04-04 07:37:40', '2016-04-04 07:37:40');
INSERT INTO `members` VALUES ('27', 'Công ty Cổ Phần Chăn Nuôi C.P VN - Chi nhánh ĐL Bến Tre', '', 'C.P VIETNAM CORPORATION', 'cong-ty-co-phan-chan-nuoi-cp-vn-chi-nhanh-dl-ben-tre', null, 'Lô A21-35, KCN An Hiệp, H. Châu Thành, T. Bến Tre ', '0753627509', '0753627509 ', 'minh.kha.9481@gmail.com', 'www.cp.com.vn', '', '', '', '', '0', '0', null, '0', '2016-04-05 15:15:47', '2016-04-05 08:15:47');
INSERT INTO `members` VALUES ('28', 'Công ty TNHH Bureau Veritas Việt Nam', '', 'BUREAU VERITAS VIETNAM LTD ', 'cong-ty-tnhh-bureau-veritas-viet-nam', null, 'Phòng 804, Tầng 8, Tòa Nhà PVFC, 131 Đường Trần Hưng Đạo, Quận An Phú, Quận Ninh Kiều, TP. Cần Thơ', '84.7103734476', '84.7103734486', 'bvmarkerting@vn.bureauveritas.com', 'www.bureauveritas.com', '', '', '', '', '0', '0', null, '0', '2016-04-04 14:41:43', '2016-04-04 07:41:43');
INSERT INTO `members` VALUES ('29', 'Công ty TNHH Biển Việt', null, 'VINASEA CO.,LTD', 'cong-ty-tnhh-bien-viet', null, '259 Thống Nhất, Phường Phương Sài, Tp Nha Trang, Tỉnh Khánh Hòa, Việt Nam', '0583562911 ', '0583562912 ', 'vinasea@vinasea.com ', 'www.vinasea.com', '', '', '', '', null, '0', null, null, '2016-04-04 07:40:29', '2016-04-04 07:40:29');
INSERT INTO `members` VALUES ('30', 'Công ty CP Thủy sản Trường Giang ', null, 'TG FISHERY', 'cong-ty-cp-thuy-san-truong-giang', null, 'Lô IV-8, Khu A1, KCN Sadec, P. An Hòa, Tp. Sadec, tỉnh Đồng Tháp', '0673761361 ', '0673761350 ', 'mekong_sales@truonggiangfish.com.vn', 'www.truonggiangfish.com.vn', '', '', '', '', null, '0', null, null, '2016-04-04 07:43:06', '2016-04-04 07:43:06');
INSERT INTO `members` VALUES ('31', 'Công ty Cổ phần Chứng nhận và Giám định Vinacert', null, 'VINACERT CERTIFICATION ANH INSPECTION JOINT STOCK COMPANY', 'cong-ty-co-phan-chung-nhan-va-giam-dinh-vinacert', null, 'Số nhà F2-63, đường số 6, KDC 586, Phú Thứ, Q. Cái Răng, TP. Cần Thơ', '07103917579', '07103881749 ', 'baongoc@vinacert.vn', 'ww.vinacert.vn', '', '', '', '', null, '0', null, null, '2016-04-04 07:44:19', '2016-04-04 07:44:19');
INSERT INTO `members` VALUES ('32', 'Công ty Cổ phần Hải sản Quốc Tế', null, 'INTERNATIONAL SEAFOOD CORP', 'cong-ty-co-phan-hai-san-quoc-te', null, '12 Nguyễn Sĩ Sách, P.15, Q. Tân Bình, Tp HCM', '0862925576', '0862843579', 'inspection.ssf@gmail.com', 'internationalseafoodcorp.com', '', '', '', '', null, '0', null, null, '2016-04-04 07:45:22', '2016-04-04 07:45:22');
INSERT INTO `members` VALUES ('33', 'Công ty TNHH Xây dựng và Hải sản An toàn', null, 'SAFE SEAFOOD CO,LTD', 'cong-ty-tnhh-xay-dung-va-hai-san-an-toan', null, '11 Nguyễn Sĩ Sách, P.15, Q. Tân Bình, Tp HCM', '0862925312', '0862925249', 'tungnguyen.seafood@gmail.com', 'www.vietnamese-safeseafood.com', '', '', '', '', null, '0', null, null, '2016-04-04 07:46:35', '2016-04-04 07:46:35');
INSERT INTO `members` VALUES ('34', 'CHI NHÁNH CÔNG TY TNHH BAYER VIỆT NAM', null, 'Branch of Bayer Vietnam Ltd', 'chi-nhanh-cong-ty-tnhh-bayer-viet-nam', null, '106 Nguyễn Văn Trổi, P.8, Q. Phú Nhuận, TP HCM', '0838450828 ', '0839979204 ', 'hong.pham@bayer.com', 'www.bayer.com.vn', '', '', '', '', null, '0', null, null, '2016-04-04 07:47:30', '2016-04-04 07:47:30');
INSERT INTO `members` VALUES ('35', 'CÔNG TY CỔ PHẦN THỦY SẢN HẢI HƯƠNG', null, 'HHFISH', 'cong-ty-co-phan-thuy-san-hai-huong', null, 'Lô A8 - A9, KCN An Hiệp, huyện Châu Thành, tỉnh Bến Tre', '0753626666 ', '0753627222 ', 'haihuong@hhfish.com.vn', 'www.hhfish.com.vn', '', '', '', '', null, '0', null, null, '2016-04-04 07:48:18', '2016-04-04 07:48:18');
INSERT INTO `members` VALUES ('36', 'CÔNG TY CP XNK THỦY SẢN BẾN TRE', null, 'AQUATEX BENTRE', 'cong-ty-cp-xnk-thuy-san-ben-tre', null, 'Ấp 9, Xã Tân Thạch, H Châu Thành, Bến Tre', '0753860265', '0753860346', 'abt@aquatexbentre.com', 'www.aquatexbentre.com', '', '', '', '', null, '0', null, null, '2016-04-04 07:49:08', '2016-04-04 07:49:08');
INSERT INTO `members` VALUES ('37', 'CÔNG TY TNHH THỦY SẢN PHÁT TIẾN', null, 'FATIFISHCO', 'cong-ty-tnhh-thuy-san-phat-tien', null, 'Số 642, Phạm Hữu Lầu, P.6, Tp. Cao Lãnh, Đồng Tháp', '0673883555', '0673883789', 'info@fatifish.com.vn', 'www.fatifish.com.vn', '', '', '', '', null, '0', null, null, '2016-04-04 07:50:00', '2016-04-04 07:50:00');
INSERT INTO `members` VALUES ('38', 'CÔNG TY CỔ PHẦN XNK THỦY SẢN AN GIANG', null, 'AGIFISH', 'cong-ty-co-phan-xnk-thuy-san-an-giang', null, '1234 Trần Hưng Đạo, Phường Bình Đức, TP. Long Xuyên, An Giang ', '0763852368', '0763852202', 'info@agifish.com.vn', 'www.agifish.com.vn', '', '', '', '', null, '0', null, null, '2016-04-04 07:50:51', '2016-04-04 07:50:51');
INSERT INTO `members` VALUES ('39', 'CÔNG TY TNHH PHÚ THẠNH', null, 'PHU THANH CO.,LTD', 'cong-ty-tnhh-phu-thanh', null, '690 Quốc lộ 1A, Xã Tân phú Thạnh, H.Châu Thành A, Tỉnh Hậu Giang', '07113848708 ', '07113848363 ', 'xndlphuthanh@hcm.vnn.vn', null, '', '', '', '', null, '0', null, null, '2016-04-04 07:51:47', '2016-04-04 07:51:47');
INSERT INTO `members` VALUES ('40', 'CÔNG TY CỔ PHẦN NTACO', null, 'NTACO CORP', 'cong-ty-co-phan-ntaco', null, 'Số 99 đường Hùng Vương, KCN Mỹ Quý, Tp. Long Xuyên, tỉnh An Giang', '0763931478 ', '0763931797 ', 'ntacoag@hcm.vnn.vn', 'www.ntaco.com.vn', '', '', '', '', null, '0', null, null, '2016-04-04 07:53:51', '2016-04-04 07:53:51');
INSERT INTO `members` VALUES ('41', 'TỔNG CÔNG TY THỦY SẢN VIỆT NAM', null, 'SEAPRODEX', 'tong-cong-ty-thuy-san-viet-nam', null, 'Địa chỉ 2-4-6 Đường Đồng khởi, Quận 1, Tp.HCM', '0838291924 ', '088290146 ', 'seaprodex@seaprodex.vn', 'www.seaprodex.com.vn', '', '', '', '', null, '0', null, null, '2016-04-04 07:54:47', '2016-04-04 07:54:47');
INSERT INTO `members` VALUES ('42', 'CÔNG TY CỔ PHẦN ĐẦU TƯ VÀ PHÁT TRIỂN ĐA QUỐC GIA', null, 'IDI CORP', 'cong-ty-co-phan-dau-tu-va-phat-trien-da-quoc-gia', null, 'Quốc lộ 80, Cụm công nghiệp Vàm Cống, ấp An Thạnh, Xã Bình Thành, huyện Lấp Vò, tỉnh Đồng Tháp', '0673680383', '0673680382', 'idiseafood@vnn.vn', 'www.idiseafood.com', '', '', '', '', null, '0', null, null, '2016-04-04 07:55:44', '2016-04-04 07:55:44');
INSERT INTO `members` VALUES ('43', 'CÔNG TY TNHH XNK THỦY SẢN ĐÔNG Á', null, 'DONG A SEAFOOD CO', 'cong-ty-tnhh-xnk-thuy-san-dong-a', null, 'Lô B KCN Bình Long, xã Bình Long, H. Châu Phú, tỉnh An Giang, VN', '0763648646 ', '0763648647 ', 'dongaseafood@vnn.vn', 'www.dongaseafood.com', '', '', '', '', null, '0', null, null, '2016-04-04 07:56:35', '2016-04-04 07:56:35');
INSERT INTO `members` VALUES ('44', 'CÔNG TY CỔ PHẦN XNK THỦY SẢN CỬU LONG AN GIANG', null, 'CL-FISH CORP', 'cong-ty-co-phan-xnk-thuy-san-cuu-long-an-giang', null, 'Số 90 đường Hùng Vương, KCN Mỹ Quý, Tp. Long Xuyên, An Giang', '0763931000', '0763934034', 'clfish@vnn.vn', 'www.clfish.com', '', '', '', '', null, '0', null, null, '2016-04-04 07:57:26', '2016-04-04 07:57:26');
INSERT INTO `members` VALUES ('45', 'Chi Nhánh Công Ty Cổ Phần Thủy Sản Số 4 - Đồng Tâm', null, 'Seafood Joint Stock Company No.4 Branch DongTam Fisheries Processing Company', 'chi-nhanh-cong-ty-co-phan-thuy-san-so-4-dong-tam', null, 'Cụm công Nghiệp Bình Thành, Huyện Thanh Bình, Tỉnh Đồng Tháp', '84 67 3541903', '84 67 3541904', 'ntdungts4@gmail.com', 'www.dongtampanga.com', '', '', '', '', null, '0', null, null, '2016-04-04 07:58:42', '2016-04-04 07:58:42');
INSERT INTO `members` VALUES ('46', 'Công ty TNHH Pharmaq Việt Nam', null, 'PHARMAQ VIETNAM', 'cong-ty-tnhh-pharmaq-viet-nam', null, 'Lầu 11, tòa nhà AGEX, 58 Võ Văn Tần, P.6, Q3, TPHCM', '083.9301993', '083.9301997', 'van.nguyen@pharmaq.no', 'www.pharmaq.no', '', '', '', '', null, '0', null, null, '2016-04-04 07:59:29', '2016-04-04 07:59:29');
INSERT INTO `members` VALUES ('47', 'Công ty Cổ phần Chăn nuôi C.P Việt Nam - Chi nhánh SX KD Thức ăn thủy sản', '', 'C.P VIETNAM LIVESTOCK CORP', 'cong-ty-co-phan-chan-nuoi-cp-viet-nam-chi-nhanh-sx-kd-thuc-an-thuy-san', null, 'Lô 16A3, KCN Trà Nóc, P Trà Nóc, Q Bình Thủy, TP Cần Thơ', '0838.2920342 ', '+84.710.3843987', 'kinhdoanhtscpct@gmail.com', 'www.cp.com.vn', '', '', '', '', '0', '0', null, '0', '2016-04-05 15:17:14', '2016-04-05 08:17:14');
INSERT INTO `members` VALUES ('48', 'Công ty CP Thủy sản Bình An', null, 'BIANFISHCO', 'cong-ty-cp-thuy-san-binh-an', null, 'Lô 2.17 KCN Trà Nóc II, Phường Phước Thới, quận Ô Môn, Tp Cần Thơ', '+84.710.6251400', '+84.710.6251409', 'bianfishco@bianfishco.com', 'www.bianfishco.com', '', '', '', '', null, '0', null, null, '2016-04-04 08:01:45', '2016-04-04 08:01:45');
INSERT INTO `members` VALUES ('49', 'Công ty TNHH HTV Hải sản 404', null, 'GEPIMEX 404', 'cong-ty-tnhh-htv-hai-san-404', null, 'Số 404, Đường Lê Hồng Phong, Q Bình Thủy, TP Cần Thơ', '+84.710.3841083', '+84.710.3841071', 'gepimex404@hcm.vnn.vn', 'www.gepimex404.com', '', '', '', '', null, '0', null, null, '2016-04-04 08:02:36', '2016-04-04 08:02:36');
INSERT INTO `members` VALUES ('50', 'Công ty CP XNK Thủy sản Cần Thơ', null, 'CASEAMEX', 'cong-ty-cp-xnk-thuy-san-can-tho', null, 'Lô 2-12 KCN Trà Nóc II, phường Phước Thới, Quận Ô Môn, Cần Thơ', '+84.710.3841819', '+84.710.3844455', 'sales@caseamex.com', 'www.caseamex.com.vn', '', '', '', '', null, '0', null, null, '2016-04-04 08:03:31', '2016-04-04 08:03:31');
INSERT INTO `members` VALUES ('51', 'Công ty Cổ phần Thủy sản Cafatex', null, 'CAFATEX CORP', 'cong-ty-co-phan-thuy-san-cafatex', null, 'Km 2081, QL1A, Huyện Châu Thành A, Hậu Giang ', '+84.710.3846134 ', '+84.710.3847775 ', 'mk@cafatex.com.vn', 'www.cafatex.info', '', '', '', '', null, '0', null, null, '2016-04-04 08:04:21', '2016-04-04 08:04:21');
INSERT INTO `members` VALUES ('52', 'Công ty TNHH TMDV Phước Anh', '', 'PHUOC ANH CO., LTD', 'cong-ty-tnhh-tmdv-phuoc-anh', null, 'số 101 Phạm Thái Bường, P 4, TX Vĩnh Long, tỉnh Vĩnh Long', '+84.70.3852762', '+84.70.6258888', 'contact@phuocanhseafood.com.vn', 'www.phuocanhseafood.com.vn', '', '', '', '', null, '0', null, null, '2016-04-04 08:05:03', '2016-04-04 08:05:03');
INSERT INTO `members` VALUES ('53', 'Công ty Nông sản Thực phẩm Trà Vinh', null, 'TRAVIFACO', 'cong-ty-nong-san-thuc-pham-tra-vinh', null, 'Ấp Vĩnh Yên, Xã Long Đức, Tp Trà Vinh', '+84.74.3616919', '+84.74.3616989', 'travifaco@vnn.vn', 'www.travifaco.com', '', '', '', '', null, '0', null, null, '2016-04-04 08:05:55', '2016-04-04 08:05:55');
INSERT INTO `members` VALUES ('54', 'CÔNG TY TNHH THỦY HẢI SẢN SAIGON - MEKONG', null, 'SAMEFICO', 'cong-ty-tnhh-thuy-hai-san-saigon-mekong', null, 'Ấp Vĩnh Hội, Xã Long Đức, TP Trà Vinh, tỉnh Trà Vinh', '84.743746768', '84.743746670', 'saigonmekong@vnn.vn', 'www.samefico.vn', '', '', '', '', null, '0', null, null, '2016-04-04 08:09:24', '2016-04-04 08:09:24');
INSERT INTO `members` VALUES ('55', 'CÔNG TY TNHH THANH HÙNG', null, 'THANH HUNG CO. LTD', 'cong-ty-tnhh-thanh-hung', null, 'Lô C III - 1 , Khu C, KCN Sa Đéc, Thị Xã Sa Đéc, Tỉnh Đồng Tháp', '84.6733763427', '84.6733763429', 'thanhhungsd@vnn.vn', 'www.thanhhungseafood.com.vn', '', '', '', '', null, '0', null, null, '2016-04-04 08:11:10', '2016-04-04 08:11:10');
INSERT INTO `members` VALUES ('56', 'CÔNG TY CỔ PHẦN DOCIFISH', null, 'DOCIFISH', 'cong-ty-co-phan-docifish', null, 'Khu C, lô 6,KCN Sa Đéc, TX Sa Đéc, Tỉnh Đồng Tháp', '84.673762429', '84.673762430', 'docifish@docifish.com.vn', 'www.docifish.com.vn', '', '', '', '', null, '0', null, null, '2016-04-04 08:12:15', '2016-04-04 08:12:15');
INSERT INTO `members` VALUES ('57', 'CÔNG TY CP TÔ CHÂU', null, 'TO CHAU JSC', 'cong-ty-cp-to-chau', null, '1553, QL 30,Khóm 4, P 11, Tp Cao Lãnh Đồng Tháp', '84.673894104', '84.673894111', 'tochaujsc@vnn.vn', 'www.tochau.vn', '', '', '', '', null, '0', null, null, '2016-04-04 08:14:04', '2016-04-04 08:14:04');
INSERT INTO `members` VALUES ('58', 'CÔNG TY CỔ PHẦN VIỆT AN', null, 'ANVIFISH CO', 'cong-ty-co-phan-viet-an', null, 'QL 91, Khóm Thạnh An, P. Mỹ Thới, Tp. Long Xuyên, An Giang', '84.763932545', '84.763932554', 'info@anvifish.com', 'www.anvifish.com', '', '', '', '', null, '0', null, null, '2016-04-04 08:14:43', '2016-04-04 08:14:43');
INSERT INTO `members` VALUES ('59', 'CÔNG TY CỔ PHẦN NAM VIỆT', null, 'NAVICO', 'cong-ty-co-phan-nam-viet', null, '19D Trần Hưng Đạo, Phường Mỹ Quí, TP Long Xuyên, An Giang', '84.763834065', '84.763634054', 'namvietagg@hcm.vnn.vn', ' www.navicorp.com.vn', '', '', '', '', null, '0', null, null, '2016-04-04 08:16:24', '2016-04-04 08:16:24');
INSERT INTO `members` VALUES ('60', 'CÔNG TY CỔ PHẦN XUẤT NHẬP KHẨU NÔNG SẢN THỰC PHẨM AN GIANG', null, 'AFIEX', 'cong-ty-co-phan-xuat-nhap-khau-nong-san-thuc-pham-an-giang', null, 'ố 25/40 Trần Hưng Đạo, phường Mỹ Thới, thành phố Long Xuyên, tỉnh An Giang', '84.763932963', '84.763932981', 'xnknstpagg@hcm.vnn.vn', 'www.afiex.com.vn ', '', '', '', '', null, '0', null, null, '2016-04-04 08:17:08', '2016-04-04 08:17:08');
INSERT INTO `members` VALUES ('61', 'CÔNG TY TNHH CHẾ BIẾN THỦY SẢN MINH QUÝ', 'MINH QUY SEAFOOD', 'MINH QUY SEAFOOD COMPANY', 'cong-ty-tnhh-che-bien-thuy-san-minh-quy', null, 'Lô 14 CCN -TTCN Tân Mỹ Chánh, P.9, Tp Mỹ Tho - T. Tiền Giang.', ' +84 733 958 889', '', 'admin@minhquysf.com', 'www.minhquysf.com', '', '', '', '', '0', '0', null, '0', '2016-04-05 17:36:28', '2016-04-05 10:36:28');
INSERT INTO `members` VALUES ('62', 'Công ty TNHH SX - TM - DV Thuận An', 'Thuan An', 'Thuan An Production - Trading And Service Co., Ltd:', 'cong-ty-tnhh-sx-tm-dv-thuan-an', null, '478 - National road 91, Hoa Long 3 Hamlet, An Chau Town, Chau Thanh Dist, An Giang Pro.', '(+84) 0763 652 066', '(+84) 0763 652 067', 'contact@tafishco.com.vn', '', '', '', '', '', '0', '0', null, '0', '2016-04-05 18:43:33', '2016-04-05 11:43:33');
INSERT INTO `members` VALUES ('63', 'CÔNG TY TNHH XNK ĐẠI DƯƠNG VIỆT ÚC', 'Viet Uc', '', 'cong-ty-tnhh-xnk-dai-duong-viet-uc', null, '195 Thống Nhất, F.Tân Thành, Q. Tân Phú, Tp.HCM', '(84-8) 3849 5790', '(84-8) 3842 5087', 'vietucimex@hotmail.com', 'www.vietucimex.com', '', '', '', '', '0', '0', null, '0', '2016-04-05 19:03:33', '2016-04-05 12:03:33');
INSERT INTO `members` VALUES ('64', 'CÔNG TY CỔ PHẦN HÙNG VƯƠNG', 'HV corp', 'Hung Vuong Corporation', 'cong-ty-co-phan-hung-vuong', null, 'Lô 44 khu công nghiệp Mỹ Tho, tỉnh Tiền Giang, Việt Nam', '+ 84 73 385 4245', '+ 84 73 385 4248', 'info@hungvuongpanga.com', 'www.hungvuongpanga.com', '', '', '', '', '0', '0', null, '0', '2016-04-05 19:18:31', '2016-04-05 12:18:31');
INSERT INTO `members` VALUES ('65', 'Ngoc Xuan Seafood Corp', '', 'Ngoc Xuan Seafood Corp', 'ngoc-xuan-seafood-corp', null, 'Dong Hoa Hamlet, Song Thuan Village, Chau Thanh Dist., Tien Giang Province,Vietnam', '+84 (073) 3619 138', '+84 (073) 3619 136', 'info@ngocxuanseafood.com', 'www.ngocxuanseafood.com', '', '', '', '', '0', '0', null, '0', '2016-04-05 19:34:40', '2016-04-05 12:34:40');
INSERT INTO `members` VALUES ('66', 'Công ty TNHH Thủy Sản Phương Đông', '', 'PHUONG DONG SEAFOOD CO., LTD', 'cong-ty-tnhh-thuy-san-phuong-dong', null, 'Lô 17D, đường số 05, KCN Trà Nóc Thành phố Cấn Thơ, Việt Nam', '+84.7103.841.707 ', '＋84.7103.843 699', 'info@phuongdongseafood.com.vn', 'www.phuongdongseafood.com.vn ', '', '', '', '', '0', '0', null, '0', '2016-04-05 19:45:09', '2016-04-05 12:45:09');
INSERT INTO `members` VALUES ('67', 'CÔNG TY CP THỦY HẢI SẢN AN PHÚ', 'ASEAFOOD', 'AN PHU SEAFOOD CORP', 'cong-ty-cp-thuy-hai-san-an-phu', null, 'Ấp An phú, xã An Nhơn, huyện Châu Thành, tỉnh Đồng Tháp', 'www.aseafood.com', '84 67 3627079', 'info@aseafood.com', 'www.aseafood.com', '', '', '', '', '0', '0', null, '0', '2016-04-05 20:07:46', '2016-04-05 13:07:46');
