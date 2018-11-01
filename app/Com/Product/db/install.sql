-- ----------------------------
-- Table structure for product_categories
-- ----------------------------
DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE `product_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_category` int(10) unsigned NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  `product_custom_fields` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '[]',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of product_categories
-- ----------------------------
INSERT INTO `product_categories` VALUES ('1', 'Fillet', '0', '0', '[\"23\",\"22\",\"1\",\"2\",\"3\",\"4\",\"5\",\"6\"]', '2016-03-14 07:20:07', '2016-04-11 06:17:57');
INSERT INTO `product_categories` VALUES ('2', 'Fillet Cutting', '0', '5', '[\"22\",\"1\",\"2\",\"3\",\"5\"]', '2016-03-19 08:50:58', '2016-04-11 06:17:57');
INSERT INTO `product_categories` VALUES ('3', 'Cutting', '0', '4', '[\"22\",\"1\",\"2\",\"3\",\"8\"]', '2016-03-19 08:51:23', '2016-04-11 06:17:57');
INSERT INTO `product_categories` VALUES ('4', 'Value-added', '0', '3', '[\"22\",\"1\",\"2\",\"3\",\"8\"]', '2016-03-19 08:51:39', '2016-04-11 06:17:57');
INSERT INTO `product_categories` VALUES ('5', 'Meal', '0', '2', '[\"1\"]', '2016-03-19 08:52:01', '2016-04-11 06:17:57');
INSERT INTO `product_categories` VALUES ('6', 'Oil', '0', '1', '[\"1\"]', '2016-03-19 08:52:18', '2016-04-11 06:17:57');

-- ----------------------------
-- Table structure for product_comments
-- ----------------------------
DROP TABLE IF EXISTS `product_comments`;
CREATE TABLE `product_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `parent_comment` int(10) unsigned NOT NULL,
  `like` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of product_comments
-- ----------------------------

-- ----------------------------
-- Table structure for product_custom_field_datas
-- ----------------------------
DROP TABLE IF EXISTS `product_custom_field_datas`;
CREATE TABLE `product_custom_field_datas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `field_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1367 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of product_custom_field_datas
-- ----------------------------
INSERT INTO `product_custom_field_datas` VALUES ('365', '1', '19', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('366', '2', '19', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('367', '3', '19', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('368', '1', '20', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('369', '2', '20', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('370', '3', '20', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('409', '1', '32', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('410', '2', '32', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('411', '3', '32', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('460', '1', '49', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('461', '2', '49', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('462', '3', '49', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('463', '1', '50', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('464', '2', '50', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('465', '3', '50', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('466', '1', '51', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('467', '2', '51', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('468', '3', '51', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('469', '1', '52', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('470', '2', '52', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('471', '3', '52', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('496', '1', '59', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('497', '2', '59', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('498', '3', '59', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('508', '1', '63', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('509', '2', '63', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('510', '3', '63', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('511', '1', '64', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('512', '2', '64', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('513', '3', '64', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('514', '1', '65', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('515', '2', '65', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('516', '3', '65', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('517', '1', '66', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('518', '2', '66', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('519', '3', '66', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('524', '1', '69', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('525', '1', '70', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('527', '1', '72', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('540', '1', '2', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('541', '2', '2', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('542', '3', '2', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('543', '4', '2', 'Skinless, boneless, red meat off, belly off, fat off', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('544', '22', '2', '120-170, 170-220, 220up', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('545', '5', '2', 'IQF 1kg/bag, 5 kg bulk or interleaved 5 kg/block x 2/ctn', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('546', '6', '2', 'Europe, Middle East, North America, Asia, South America, Africa', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('547', '23', '2', 'HACCP,BRC, FDA, IFS,KOSHER, Europe Standard', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('548', '1', '74', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('549', '2', '74', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('550', '3', '74', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('551', '4', '74', 'Skinless, boneless, red meat off, belly off, fat off', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('552', '5', '74', 'IQF 1kg/bag 5 kg bulk or interleaved 5 kg/block x 2/ctn', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('553', '22', '74', '120-170, 170-220, 220up', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('554', '6', '74', 'Europe, Middle East, North America, Asia, South America, Africa', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('555', '23', '74', 'HACCP,BRC, FDA, IFS,KOSHER, Europe Standard', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('556', '1', '75', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('557', '2', '75', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('558', '3', '75', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('559', '4', '75', 'Skinless, boneless, red meat off, belly off, fat off', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('560', '22', '75', '120-170, 170-220, 220up', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('561', '5', '75', 'IQF 1kg/bag, 5 kg bulk or interleaved 5 kg/block x 2/ctn', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('562', '6', '75', 'Europe, Middle East, North America, Asia, South America, Africa', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('563', '23', '75', 'HACCP,BRC, FDA, IFS,KOSHER, Europe Standard', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('564', '1', '22', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('565', '2', '22', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('566', '3', '22', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('567', '4', '22', 'Skinless, boneless, red meat on, belly on, fat on', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('568', '5', '22', 'IQF 1kg/bag, 5 kg bulk or interleaved 5 kg/block x 2/ctn', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('569', '6', '22', 'Russia, the Middle East, Eastern Europe, Africa', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('570', '22', '22', '170-220, 220up', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('571', '23', '22', 'HACCP,BRC, FDA, IFS,KOSHER, Europe Standard', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('576', '1', '1', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('577', '2', '1', '10', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('578', '3', '1', '83', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('579', '22', '1', '120-170g, 170-220g, 220g up.', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('580', '1', '3', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('581', '2', '3', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('582', '3', '3', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('583', '5', '3', 'IQF 1kg/PE x 10/cart', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('584', '22', '3', '120-170 , 170-220 , 220 - up (g/pc)', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('592', '1', '76', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('593', '2', '76', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('594', '3', '76', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('600', '1', '77', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('601', '2', '77', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('602', '3', '77', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('603', '8', '77', 'IQF 10 kg/ Bulk/cart', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('604', '22', '77', '100-150 g/ piece', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('609', '1', '4', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('610', '2', '4', '1', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('611', '3', '4', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('612', '5', '4', 'White Meat, First Gr', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('613', '22', '4', ' 100cm', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('614', '4', '4', '	cá Basa nguyên miếng fillet, không da, không xương, bỏ mỡ, bỏ thịt đỏ, bỏ bụng, còn dè hoặc bỏ dè, vanh gọn theo chu vi miếng fillet.', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('615', '1', '78', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('616', '2', '78', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('617', '3', '78', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('618', '5', '78', 'IQF 0.5kg/bag*20/carton', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('619', '22', '78', '0.5kg/bag', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('620', '1', '79', '90-150, 150-220', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('621', '2', '79', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('622', '3', '79', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('623', '22', '79', '2,5 - 3cm', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('624', '8', '79', '1 kg/túi, 1 kg/khay xốp/túi', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('625', '1', '80', '500-700 gr, 600-800 gr, 700-900 gr', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('626', '2', '80', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('627', '3', '80', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('628', '22', '80', '500-700 gr, 600-800 gr, 700-900 gr.', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('629', '8', '80', 'IQF 1miếng/bag x 10kg/thùng. IQF 10kg bulk/thùng. 5kg/block semi', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('634', '1', '81', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('635', '2', '81', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('636', '3', '81', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('637', '22', '81', '0.5kg/khay x 10kg/carton --> hút chân không', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('638', '8', '81', 'IQF 0.5kg/túi * 20/thùng --> hút chân không', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('639', '1', '5', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('640', '2', '5', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('641', '3', '5', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('650', '1', '27', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('651', '2', '27', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('652', '3', '27', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('653', '8', '27', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('654', '22', '27', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('655', '1', '6', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('656', '2', '6', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('657', '3', '6', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('658', '5', '6', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('659', '22', '6', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('685', '1', '58', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('686', '2', '58', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('687', '3', '58', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('688', '8', '58', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('689', '22', '58', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('717', '1', '14', '170 – 225', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('718', '2', '14', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('719', '3', '14', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('720', '4', '14', '90% Basa fish, 10% glazing', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('721', '5', '14', 'IQF, 1kg/box x 10 boxes/CTN.', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('722', '23', '14', 'HACCP,BRC, FDA, IFS,KOSHER, Europe Standard', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('733', '1', '41', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('734', '2', '41', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('735', '3', '41', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('736', '22', '41', '120 – 180', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('737', '1', '42', '800-1200', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('738', '2', '42', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('739', '3', '42', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('740', '22', '42', '100% Basa fish', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('741', '1', '62', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('742', '2', '62', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('743', '3', '62', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('744', '22', '62', '500grs/ PE bag', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('745', '8', '62', '20bags/CTN', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('746', '1', '61', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('747', '2', '61', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('748', '3', '61', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('749', '22', '61', '500grs/ PE bag', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('750', '8', '61', '20bags/CTN', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('751', '1', '18', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('752', '2', '18', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('753', '3', '18', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('754', '22', '18', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('755', '5', '18', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('756', '1', '17', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('757', '2', '17', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('758', '3', '17', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('759', '5', '17', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('760', '22', '17', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('761', '1', '16', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('762', '2', '16', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('763', '3', '16', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('764', '5', '16', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('765', '22', '16', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('766', '1', '15', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('767', '2', '15', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('768', '3', '15', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('769', '5', '15', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('770', '22', '15', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('771', '1', '83', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('772', '2', '83', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('773', '3', '83', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('774', '5', '83', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('775', '22', '83', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('776', '1', '29', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('777', '2', '29', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('778', '3', '29', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('779', '5', '29', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('780', '22', '29', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('781', '1', '28', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('782', '2', '28', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('783', '3', '28', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('784', '5', '28', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('785', '22', '28', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('786', '1', '43', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('787', '2', '43', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('788', '3', '43', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('789', '5', '43', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('790', '22', '43', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('820', '1', '13', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('821', '2', '13', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('822', '3', '13', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('823', '4', '13', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('824', '5', '13', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('825', '6', '13', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('826', '22', '13', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('827', '23', '13', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('828', '1', '44', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('829', '2', '44', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('830', '3', '44', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('831', '5', '44', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('832', '22', '44', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('838', '1', '67', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('839', '2', '67', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('840', '3', '67', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('841', '8', '67', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('842', '22', '67', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('843', '1', '84', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('844', '2', '84', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('845', '3', '84', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('846', '5', '84', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('847', '22', '84', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('848', '1', '21', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('849', '2', '21', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('850', '3', '21', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('851', '22', '21', '60/120, 120/170, 170/220, 220 up (g/pc)', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('852', '5', '21', 'IQF or block, up to customer’s requirements', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('853', '1', '33', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('854', '2', '33', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('855', '3', '33', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('856', '22', '33', 'up to customer’s requirements', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('857', '5', '33', 'IQF, 1 kg/ bag x 10/ ctn, glaze max 20%', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('858', '1', '31', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('859', '2', '31', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('860', '3', '31', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('861', '22', '31', 'up to customers’ requirements', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('862', '8', '31', 'IQF or block, up to customer’s requirements', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('863', '1', '30', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('864', '2', '30', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('865', '3', '30', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('866', '8', '30', '16.5 lb or 7.5 kg/ block, no air pocket, no glaze packet', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('867', '22', '30', '48*25.5*6', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('873', '1', '46', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('874', '2', '46', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('875', '3', '46', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('876', '22', '46', '400/600, 600/800, 800/1,000, 1,000 up (g/pc)', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('892', '1', '86', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('893', '2', '86', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('894', '3', '86', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('895', '8', '86', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('896', '22', '86', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('897', '1', '85', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('898', '2', '85', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('899', '3', '85', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('900', '8', '85', 'IQF, 1 kg/ bag x 10/ ctn, glaze max 20%', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('901', '22', '85', '120-140g/ stick or up to customer’s requirements', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('902', '1', '87', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('903', '2', '87', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('904', '3', '87', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('905', '5', '87', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('906', '22', '87', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('907', '1', '88', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('908', '2', '88', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('909', '3', '88', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('910', '5', '88', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('911', '22', '88', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('912', '1', '24', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('913', '2', '24', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('914', '3', '24', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('915', '5', '24', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('916', '22', '24', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('917', '1', '23', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('918', '2', '23', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('919', '3', '23', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('920', '5', '23', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('921', '22', '23', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('922', '1', '37', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('923', '2', '37', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('924', '3', '37', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('925', '5', '37', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('926', '22', '37', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('927', '1', '36', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('928', '2', '36', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('929', '3', '36', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('930', '5', '36', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('931', '22', '36', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('932', '1', '35', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('933', '2', '35', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('934', '3', '35', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('935', '5', '35', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('936', '22', '35', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('942', '1', '34', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('943', '2', '34', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('944', '3', '34', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('945', '22', '34', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('946', '1', '45', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('947', '2', '45', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('948', '3', '45', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('949', '22', '45', '2.5 cm (thickness)', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('956', '1', '89', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('957', '2', '89', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('958', '3', '89', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('959', '5', '89', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('960', '22', '89', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('966', '1', '90', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('967', '2', '90', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('968', '3', '90', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('969', '5', '90', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('970', '22', '90', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('976', '1', '91', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('977', '2', '91', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('978', '3', '91', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('979', '5', '91', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('980', '22', '91', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('991', '1', '92', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('992', '2', '92', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('993', '3', '92', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('994', '8', '92', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('995', '22', '92', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1001', '1', '93', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1002', '2', '93', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1003', '3', '93', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1004', '8', '93', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1005', '22', '93', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1012', '1', '94', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1013', '2', '94', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1014', '3', '94', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1015', '5', '94', 'IQF, bag 10kg or bag 5kg or 1kg/PE + rider, 10 kg/carton with customer’s brand name and importer regulations.', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1016', '22', '94', '120/170; 170/220; 220+ (gr/pc)', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1017', '23', '94', 'HACCP,BRC, FDA, IFS,KOSHER, Europe Standard', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1024', '1', '95', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1025', '2', '95', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1026', '3', '95', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1027', '5', '95', 'IQF, bag 10kg or bag 5kg or 1kg/PE + rider, 10 kg/carton with customer’s brand name and importer regulations.', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1028', '22', '95', '120/170; 170/220; 220+ (gr/pc).', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1029', '23', '95', 'HACCP,BRC, FDA, IFS,KOSHER, Europe Standard', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1036', '1', '96', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1037', '2', '96', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1038', '3', '96', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1039', '5', '96', '1 x 10kg; 1 kg x 10 /carton with customer\'s brand name and importer regulations', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1040', '22', '96', '220+ (gr/pc)', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1041', '23', '96', 'HACCP,BRC, FDA, IFS,KOSHER, Europe Standard', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1047', '1', '97', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1048', '2', '97', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1049', '3', '97', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1050', '5', '97', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1051', '22', '97', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1057', '1', '98', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1058', '2', '98', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1059', '3', '98', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1060', '5', '98', 'block interleaved 5kg x 2 /carton with customer’s brand name and importer regulations', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1061', '22', '98', '120/170; 170/220; 220+ (gr/pc)', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1067', '1', '99', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1068', '2', '99', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1069', '3', '99', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1070', '5', '99', 'block interleaved 5kg x 2 /carton with customer’s brand name and importer regulations.', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1071', '22', '99', '120/170; 170/220; 220+ (gr/pc)', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1077', '1', '100', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1078', '2', '100', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1079', '3', '100', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1080', '5', '100', '55 gr/pc +/- 10g', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1081', '22', '100', 'IQF, bag 10kg or bag 5kg /carton with customer’s brand and importer’s regulations', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1087', '1', '101', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1088', '2', '101', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1089', '3', '101', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1090', '5', '101', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1091', '22', '101', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1097', '1', '102', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1098', '2', '102', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1099', '3', '102', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1100', '5', '102', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1101', '22', '102', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1107', '1', '103', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1108', '2', '103', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1109', '3', '103', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1110', '5', '103', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1111', '22', '103', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1117', '1', '104', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1118', '2', '104', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1119', '3', '104', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1120', '8', '104', 'IQF 1 kg/PE bag + header card, 10 kgs/master Carton', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1121', '22', '104', '120-170 (gr/pc)', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1127', '1', '105', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1128', '2', '105', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1129', '3', '105', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1130', '8', '105', '65 gr/pc +/- 5g (50mm x 66mm x 15mm); 100 gr/pc +/- 5g (50mm x 106mm x 15mm); 125 gr/pc +/- 5g (50mm x 132mm x 15mm)', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1131', '22', '105', 'IQF 1 kg/PE bag + header card, 10 kgs/master Carton', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1137', '1', '106', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1138', '2', '106', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1139', '3', '106', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1140', '5', '106', 'IQF 1kg/bag x 10/ctn or 10 kg bulk or interleaved 5 kg/block x 2/ctn', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1141', '22', '106', '60/120, 120/170, 170/220 and 220 up', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1147', '1', '107', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1148', '2', '107', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1149', '3', '107', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1150', '5', '107', 'IQF 1kg/bag x 10/ctn or 10 kg bulk or interleaved 5 kg/block x 2/ctn', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1151', '22', '107', '60/120, 120/170, 170/220 and 220 up', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1157', '1', '108', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1158', '2', '108', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1159', '3', '108', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1160', '5', '108', 'IQF 1kg/bag x 10/ctn or 10 kg bulk or interleaved 5 kg/block x 2/ctn', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1161', '22', '108', '60/120, 120/170, 170/220 and 220 up', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1167', '1', '109', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1168', '2', '109', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1169', '3', '109', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1170', '5', '109', '5kg/block x 2/ctn', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1171', '22', '109', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1177', '1', '110', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1178', '2', '110', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1179', '3', '110', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1180', '5', '110', '7.5 kg/block x 3/carton or IQF 1kg/bag x 10/ctn', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1181', '22', '110', '7.5 kg/block', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1187', '1', '111', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1188', '2', '111', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1189', '3', '111', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1190', '8', '111', '400gr/box x 10/carton', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1191', '22', '111', '40gr', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1197', '1', '112', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1198', '2', '112', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1199', '3', '112', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1200', '8', '112', 'IQF 10kg bulk/ carton', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1201', '22', '112', '75-80 (g/pc) without breadcrumbs and 100-120 (g/pc) with breadcrumbs', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1207', '1', '113', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1208', '2', '113', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1209', '3', '113', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1210', '8', '113', '4pcs/box x 20/carton', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1211', '22', '113', '100gr', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1213', '1', '114', '1000', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1215', '1', '115', '50000', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1217', '1', '116', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1223', '1', '117', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1224', '2', '117', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1225', '3', '117', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1226', '5', '117', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1227', '22', '117', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1233', '1', '118', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1234', '2', '118', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1235', '3', '118', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1236', '5', '118', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1237', '22', '118', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1243', '1', '119', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1244', '2', '119', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1245', '3', '119', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1246', '8', '119', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1247', '22', '119', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1253', '1', '120', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1254', '2', '120', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1255', '3', '120', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1256', '8', '120', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1257', '22', '120', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1259', '1', '121', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1261', '1', '122', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1267', '1', '123', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1268', '2', '123', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1269', '3', '123', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1270', '5', '123', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1271', '22', '123', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1277', '1', '26', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1278', '2', '26', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1279', '3', '26', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1280', '5', '26', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1281', '22', '26', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1287', '1', '25', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1288', '2', '25', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1289', '3', '25', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1290', '5', '25', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1291', '22', '25', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1297', '1', '40', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1298', '2', '40', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1299', '3', '40', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1300', '8', '40', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1301', '22', '40', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1302', '1', '39', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1303', '2', '39', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1304', '3', '39', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1305', '5', '39', ' IQF 10kg Bulk/carto', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1306', '22', '39', '800-1000 , 1000-1200 , 1200 up (g/pc)', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1307', '1', '60', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1308', '2', '60', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1309', '3', '60', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1310', '8', '60', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1311', '22', '60', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1312', '1', '82', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1313', '2', '82', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1314', '3', '82', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1315', '8', '82', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1316', '22', '82', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1322', '1', '124', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1323', '2', '124', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1324', '3', '124', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1325', '8', '124', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1326', '22', '124', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1327', '1', '57', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1328', '2', '57', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1329', '3', '57', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1330', '8', '57', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1331', '22', '57', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1332', '1', '56', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1333', '2', '56', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1334', '3', '56', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1335', '8', '56', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1336', '22', '56', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1337', '1', '55', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1338', '2', '55', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1339', '3', '55', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1340', '8', '55', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1341', '22', '55', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1342', '1', '54', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1343', '2', '54', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1344', '3', '54', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1345', '8', '54', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1346', '22', '54', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1347', '1', '53', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1348', '2', '53', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1349', '3', '53', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1350', '8', '53', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1351', '22', '53', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1352', '1', '68', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1353', '1', '71', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1354', '1', '38', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1355', '2', '38', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1356', '3', '38', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1357', '5', '38', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1358', '22', '38', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1359', '1', '47', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1360', '2', '47', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1361', '3', '47', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1362', '5', '47', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1363', '22', '47', 'call', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1364', '1', '48', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1365', '2', '48', '0', null, null);
INSERT INTO `product_custom_field_datas` VALUES ('1366', '3', '48', '0', null, null);

-- ----------------------------
-- Table structure for product_custom_fields
-- ----------------------------
DROP TABLE IF EXISTS `product_custom_fields`;
CREATE TABLE `product_custom_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `field_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `input_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default` text COLLATE utf8_unicode_ci NOT NULL,
  `not_null` tinyint(4) NOT NULL DEFAULT '1',
  `sort` int(10) unsigned NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of product_custom_fields
-- ----------------------------
INSERT INTO `product_custom_fields` VALUES ('1', 'Cân nặng', 'text', 'input', 'gram', '', '0', '1', '', '2016-03-14 07:14:03', '2016-03-19 10:37:32');
INSERT INTO `product_custom_fields` VALUES ('2', 'Tỉ lệ mạ băng', 'number', 'input', '%', '', '0', '2', '', '2016-03-19 08:45:12', '2016-03-19 08:46:14');
INSERT INTO `product_custom_fields` VALUES ('3', 'Độ ẩm', 'number', 'input', '', '', '0', '3', '', '2016-03-19 08:46:07', '2016-03-19 08:46:07');
INSERT INTO `product_custom_fields` VALUES ('4', 'Specifications', 'text', 'input', '', '', '0', '4', 'lbl_specifications', '2016-04-04 08:34:27', '2016-04-05 09:31:15');
INSERT INTO `product_custom_fields` VALUES ('5', 'Packing', 'text', 'input', '', '', '0', '5', 'lbl_packing', '2016-04-04 08:36:33', '2016-04-05 09:32:51');
INSERT INTO `product_custom_fields` VALUES ('6', 'Markets', 'text', 'input', '', '', '0', '6', 'lbl_markets', '2016-04-04 08:37:54', '2016-04-04 08:58:58');
INSERT INTO `product_custom_fields` VALUES ('7', 'Supply capacity', 'text', 'input', '', '', '0', '7', 'lbl_supply_capacity', '2016-04-04 08:38:21', '2016-04-04 08:59:03');
INSERT INTO `product_custom_fields` VALUES ('8', 'Packaging design', 'text', 'input', '', '', '0', '8', 'lbl_packaging_design', '2016-04-04 08:39:11', '2016-04-04 08:59:07');
INSERT INTO `product_custom_fields` VALUES ('9', 'Color', 'text', 'input', '', '', '0', '9', 'lbl_color', '2016-04-04 08:39:52', '2016-04-04 08:59:11');
INSERT INTO `product_custom_fields` VALUES ('10', 'Acid', 'number', 'input', '% max', '', '0', '10', 'lbl_acid', '2016-04-04 08:41:19', '2016-04-04 08:59:16');
INSERT INTO `product_custom_fields` VALUES ('11', 'Fatty Acid', 'number', 'input', '% max', '', '0', '11', 'lbl_fatty_acid', '2016-04-04 08:41:49', '2016-04-04 08:59:21');
INSERT INTO `product_custom_fields` VALUES ('12', 'Fat', 'text', 'input', '% min', '', '0', '12', 'lbl_fat', '2016-04-04 08:42:38', '2016-04-04 08:59:25');
INSERT INTO `product_custom_fields` VALUES ('13', 'TRIMMED', 'text', 'input', '', '', '0', '13', 'lbl_trimmed', '2016-04-04 08:46:11', '2016-04-04 08:59:31');
INSERT INTO `product_custom_fields` VALUES ('14', 'Bock dimension', 'text', 'input', 'cm', '', '0', '14', 'lbl_bock_dimension', '2016-04-04 08:47:28', '2016-04-04 08:59:36');
INSERT INTO `product_custom_fields` VALUES ('15', 'Self life', 'number', 'input', 'month(s)', '', '0', '15', 'lbl_self_life', '2016-04-04 08:49:07', '2016-04-04 08:59:40');
INSERT INTO `product_custom_fields` VALUES ('16', 'Crude Protein', 'number', 'input', 'min', '', '0', '16', 'lbl_crude_protein', '2016-04-04 08:50:44', '2016-04-04 08:59:45');
INSERT INTO `product_custom_fields` VALUES ('17', 'Crude Fat', 'number', 'input', '%', '', '0', '17', 'lbl_crude_fat', '2016-04-04 08:51:59', '2016-04-04 08:59:49');
INSERT INTO `product_custom_fields` VALUES ('18', 'NaCl', 'number', 'input', '%', '', '0', '18', 'lbl_NaCl', '2016-04-04 08:54:34', '2016-04-04 08:59:54');
INSERT INTO `product_custom_fields` VALUES ('19', 'Protein', 'number', 'input', '%', '', '0', '19', 'lbl_protein', '2016-04-04 08:55:06', '2016-04-04 08:59:59');
INSERT INTO `product_custom_fields` VALUES ('20', 'Odour', 'number', 'input', '', '', '0', '20', 'lbl_odour', '2016-04-04 08:56:21', '2016-04-04 09:00:03');
INSERT INTO `product_custom_fields` VALUES ('21', 'Ingredient', 'text', 'input', '', '', '0', '21', 'lbl_ingredient', '2016-04-04 08:56:52', '2016-04-04 09:00:08');
INSERT INTO `product_custom_fields` VALUES ('22', 'Size', 'text', 'input', '', '', '0', '0', 'lbl_size', '2016-04-05 09:32:20', '2016-04-05 09:32:35');
INSERT INTO `product_custom_fields` VALUES ('23', 'Certificate', 'text', 'input', '', '', '0', '0', 'lbl_certificate', '2016-04-05 09:37:22', '2016-04-05 09:37:22');

-- ----------------------------
-- Table structure for product_media_categories
-- ----------------------------
DROP TABLE IF EXISTS `product_media_categories`;
CREATE TABLE `product_media_categories` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of product_media_categories
-- ----------------------------
INSERT INTO `product_media_categories` VALUES ('1', 'Đại diện', 'IMG', 'AVATAR', '', '0', '0', '2016-03-14 07:12:59', '2016-04-07 14:56:25');
INSERT INTO `product_media_categories` VALUES ('2', 'Chi tiết', 'VIDEO', 'SLIDE|GRID', '', '0', '1', '2016-03-19 08:44:18', '2016-04-07 14:56:26');

-- ----------------------------
-- Table structure for product_medias
-- ----------------------------
DROP TABLE IF EXISTS `product_medias`;
CREATE TABLE `product_medias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(10) unsigned NOT NULL,
  `media_category_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of product_medias
-- ----------------------------
INSERT INTO `product_medias` VALUES ('2', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/1efbbf29d05a1a9af9e3c26b8ce8c6c7/1298696458-Fille-Trang.jpg', '1', '1', '2', null, null);
INSERT INTO `product_medias` VALUES ('3', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/1efbbf29d05a1a9af9e3c26b8ce8c6c7/1298696501-fille-hong.jpg', '1', '1', '74', null, null);
INSERT INTO `product_medias` VALUES ('4', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/1efbbf29d05a1a9af9e3c26b8ce8c6c7/1298696481-Fillet-vang.jpg', '1', '1', '75', null, null);
INSERT INTO `product_medias` VALUES ('5', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/1efbbf29d05a1a9af9e3c26b8ce8c6c7/1299298851-phi-le-do-1.jpg', '1', '1', '22', null, null);
INSERT INTO `product_medias` VALUES ('6', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/010c0bcc5fccdf86a9a75964766573a5/ca_fillet.jpg', '1', '1', '1', null, null);
INSERT INTO `product_medias` VALUES ('7', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/ab89acbc1a8b625a74038d1a66622dc4/image005.png', '1', '1', '3', null, null);
INSERT INTO `product_medias` VALUES ('10', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/605df19c7e25da2ecf7f30f340b55d11/1.png', '1', '1', '76', null, null);
INSERT INTO `product_medias` VALUES ('12', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/605df19c7e25da2ecf7f30f340b55d11/BREADEDBASAFILLET-Y.jpg', '1', '1', '77', null, null);
INSERT INTO `product_medias` VALUES ('14', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/ad711d4dac9af02edbf04c95d762b6ba/057968212702.jpg', '1', '1', '4', null, null);
INSERT INTO `product_medias` VALUES ('15', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/ad711d4dac9af02edbf04c95d762b6ba/Pangasius-Rose-Roll.jpg', '1', '1', '78', null, null);
INSERT INTO `product_medias` VALUES ('16', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/ad711d4dac9af02edbf04c95d762b6ba/490876265580.jpg', '1', '1', '79', null, null);
INSERT INTO `product_medias` VALUES ('17', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/ad711d4dac9af02edbf04c95d762b6ba/619436773917.jpg', '1', '1', '80', null, null);
INSERT INTO `product_medias` VALUES ('19', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/ad711d4dac9af02edbf04c95d762b6ba/950102045239.jpg', '1', '1', '81', null, null);
INSERT INTO `product_medias` VALUES ('20', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/ad711d4dac9af02edbf04c95d762b6ba/724011185276.jpg', '1', '1', '5', null, null);
INSERT INTO `product_medias` VALUES ('22', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5dae336c17dc37c1a3b9b4baa567bc62/PANGASIUSPORTIONS.jpg', '1', '1', '27', null, null);
INSERT INTO `product_medias` VALUES ('23', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/1efbbf29d05a1a9af9e3c26b8ce8c6c7/Pangasius-Rose-Roll.jpg', '1', '1', '6', null, null);
INSERT INTO `product_medias` VALUES ('24', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5dae336c17dc37c1a3b9b4baa567bc62/ROLLROSEFISH.jpg', '2', '1', '6', null, null);
INSERT INTO `product_medias` VALUES ('30', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5dae336c17dc37c1a3b9b4baa567bc62/PANGASIUS_WITH_CITRONELLA_CHILI.jpg', '1', '1', '58', null, null);
INSERT INTO `product_medias` VALUES ('37', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/8ad8dca4f34a6851a91323a5491dbe1a/FrozenBasaFillets.jpg', '1', '1', '14', null, null);
INSERT INTO `product_medias` VALUES ('40', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/8ad8dca4f34a6851a91323a5491dbe1a/FrozenSliceBasa.jpg', '1', '1', '41', null, null);
INSERT INTO `product_medias` VALUES ('41', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/8ad8dca4f34a6851a91323a5491dbe1a/FrozenWholeBasa.jpg', '1', '1', '42', null, null);
INSERT INTO `product_medias` VALUES ('42', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/8ad8dca4f34a6851a91323a5491dbe1a/FrozenBasaFishBallWithDill.jpg', '1', '1', '62', null, null);
INSERT INTO `product_medias` VALUES ('43', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/8ad8dca4f34a6851a91323a5491dbe1a/FrozenBasaFishBallWithChilli.jpg', '1', '1', '61', null, null);
INSERT INTO `product_medias` VALUES ('44', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/601007b979f29b4904f5ddae736f5774/17_2013-08-10-PORTION.jpg', '1', '1', '18', null, null);
INSERT INTO `product_medias` VALUES ('45', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/601007b979f29b4904f5ddae736f5774/5_2013-09-06-well_trimmed.jpg', '1', '1', '17', null, null);
INSERT INTO `product_medias` VALUES ('46', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/601007b979f29b4904f5ddae736f5774/24_2013-08-10-Halftrimmed.jpg', '1', '1', '16', null, null);
INSERT INTO `product_medias` VALUES ('47', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/601007b979f29b4904f5ddae736f5774/UN-TRIMMED.jpg', '1', '1', '15', null, null);
INSERT INTO `product_medias` VALUES ('48', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/601007b979f29b4904f5ddae736f5774/Rollrose.jpg', '1', '1', '83', null, null);
INSERT INTO `product_medias` VALUES ('49', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/601007b979f29b4904f5ddae736f5774/Loin.jpg', '1', '1', '29', null, null);
INSERT INTO `product_medias` VALUES ('50', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/601007b979f29b4904f5ddae736f5774/Skewered.jpg', '1', '1', '28', null, null);
INSERT INTO `product_medias` VALUES ('51', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/601007b979f29b4904f5ddae736f5774/22_2013-09-06-nguyen_con.jpg', '1', '1', '43', null, null);
INSERT INTO `product_medias` VALUES ('59', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/870431734e9ae0ae4f08feda2f95bd6f/PangasiusFillets1.jpg', '1', '1', '13', null, null);
INSERT INTO `product_medias` VALUES ('60', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/870431734e9ae0ae4f08feda2f95bd6f/24_2013-08-10-Halftrimmed.jpg', '2', '1', '13', null, null);
INSERT INTO `product_medias` VALUES ('61', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/870431734e9ae0ae4f08feda2f95bd6f/PangasiusFillets3.jpg', '3', '1', '13', null, null);
INSERT INTO `product_medias` VALUES ('62', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/870431734e9ae0ae4f08feda2f95bd6f/PangasiusFillets4.jpg', '4', '1', '13', null, null);
INSERT INTO `product_medias` VALUES ('63', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/870431734e9ae0ae4f08feda2f95bd6f/PangasiusWhole.jpg', '1', '1', '44', null, null);
INSERT INTO `product_medias` VALUES ('65', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/870431734e9ae0ae4f08feda2f95bd6f/Value-addPangasius1.jpg', '1', '1', '67', null, null);
INSERT INTO `product_medias` VALUES ('66', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/870431734e9ae0ae4f08feda2f95bd6f/Value-addPangasius2.jpg', '2', '1', '67', null, null);
INSERT INTO `product_medias` VALUES ('67', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/333eca0944a456a72c2a7162814f22dd/FROZENPANGASIUSFILLETUNTRIMMED.jpg', '1', '1', '84', null, null);
INSERT INTO `product_medias` VALUES ('68', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/333eca0944a456a72c2a7162814f22dd/FROZENPANGASIUSFILLETWELLTRIMMED.jpg', '1', '1', '21', null, null);
INSERT INTO `product_medias` VALUES ('69', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/333eca0944a456a72c2a7162814f22dd/PANGASIUS_LOIN.jpg', '1', '1', '33', null, null);
INSERT INTO `product_medias` VALUES ('70', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/333eca0944a456a72c2a7162814f22dd/PANGASIUS_LOIN.jpg', '1', '1', '31', null, null);
INSERT INTO `product_medias` VALUES ('71', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/333eca0944a456a72c2a7162814f22dd/PANGASIUSINDUSTRIALCOMPRESSEDBLOCK.jpg', '1', '1', '30', null, null);
INSERT INTO `product_medias` VALUES ('73', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/333eca0944a456a72c2a7162814f22dd/whole.jpg', '1', '1', '46', null, null);
INSERT INTO `product_medias` VALUES ('77', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/333eca0944a456a72c2a7162814f22dd/MARINATEDPANGASIUS.jpg', '1', '1', '86', null, null);
INSERT INTO `product_medias` VALUES ('78', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/333eca0944a456a72c2a7162814f22dd/PANGASIUSSKEWER.jpg', '1', '1', '85', null, null);
INSERT INTO `product_medias` VALUES ('79', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/b614cd85a57b0b96431ec814ef1a2f0c/PangasiusWelltrimmedFillets.jpg', '1', '1', '87', null, null);
INSERT INTO `product_medias` VALUES ('80', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/b614cd85a57b0b96431ec814ef1a2f0c/PangasiusSemitrimmedFillets.jpg', '1', '1', '88', null, null);
INSERT INTO `product_medias` VALUES ('81', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/b614cd85a57b0b96431ec814ef1a2f0c/PangasiusUntrimmedFillets.jpg', '1', '1', '24', null, null);
INSERT INTO `product_medias` VALUES ('82', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/b614cd85a57b0b96431ec814ef1a2f0c/Untrimmedbellyon.jpg', '1', '1', '23', null, null);
INSERT INTO `product_medias` VALUES ('83', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/b614cd85a57b0b96431ec814ef1a2f0c/PangasiusRolls.jpg', '1', '1', '37', null, null);
INSERT INTO `product_medias` VALUES ('84', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/b614cd85a57b0b96431ec814ef1a2f0c/Strip.jpg', '1', '1', '36', null, null);
INSERT INTO `product_medias` VALUES ('85', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/b614cd85a57b0b96431ec814ef1a2f0c/IndustrialBlock.jpg', '1', '1', '35', null, null);
INSERT INTO `product_medias` VALUES ('87', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/b614cd85a57b0b96431ec814ef1a2f0c/PangasiusCut.jpg', '1', '1', '34', null, null);
INSERT INTO `product_medias` VALUES ('88', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/333eca0944a456a72c2a7162814f22dd/PANGASIUSSTEAK.jpg', '2', '1', '45', null, null);
INSERT INTO `product_medias` VALUES ('89', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/b614cd85a57b0b96431ec814ef1a2f0c/PangasiusSteaks.jpg', '2', '1', '89', null, null);
INSERT INTO `product_medias` VALUES ('91', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/b614cd85a57b0b96431ec814ef1a2f0c/Chunk.jpg', '1', '1', '90', null, null);
INSERT INTO `product_medias` VALUES ('93', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/b614cd85a57b0b96431ec814ef1a2f0c/Slice.jpg', '1', '1', '91', null, null);
INSERT INTO `product_medias` VALUES ('96', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/b614cd85a57b0b96431ec814ef1a2f0c/PangasiusBreadedFingers.jpg', '1', '1', '92', null, null);
INSERT INTO `product_medias` VALUES ('98', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/b614cd85a57b0b96431ec814ef1a2f0c/PangasiusBreadedFillets.jpg', '1', '1', '93', null, null);
INSERT INTO `product_medias` VALUES ('100', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/49134004f74c371c321b822b83801822/White_meat_Fillet.jpg', '1', '1', '94', null, null);
INSERT INTO `product_medias` VALUES ('102', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/49134004f74c371c321b822b83801822/Lightpinkmeat.jpg', '1', '1', '95', null, null);
INSERT INTO `product_medias` VALUES ('104', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/49134004f74c371c321b822b83801822/Untrimmedfilet.jpg', '1', '1', '96', null, null);
INSERT INTO `product_medias` VALUES ('106', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/49134004f74c371c321b822b83801822/PANGASIUSUNTRIMMED.jpg', '1', '1', '97', null, null);
INSERT INTO `product_medias` VALUES ('108', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/49134004f74c371c321b822b83801822/frozenPangasius-block.jpg', '1', '1', '98', null, null);
INSERT INTO `product_medias` VALUES ('110', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/49134004f74c371c321b822b83801822/Frozenpangasiusfillet-block.jpg', '1', '1', '99', null, null);
INSERT INTO `product_medias` VALUES ('112', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/49134004f74c371c321b822b83801822/FrozenPangasiusLoins.jpg', '1', '1', '100', null, null);
INSERT INTO `product_medias` VALUES ('114', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/49134004f74c371c321b822b83801822/PANGASIUSSTEAK.jpg', '1', '1', '101', null, null);
INSERT INTO `product_medias` VALUES ('116', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/49134004f74c371c321b822b83801822/PANGASIUSROLLWITHSKIN.jpg', '1', '1', '103', null, null);
INSERT INTO `product_medias` VALUES ('118', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/49134004f74c371c321b822b83801822/BreadedPangasiusFillet.jpg', '1', '1', '104', null, null);
INSERT INTO `product_medias` VALUES ('119', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/49134004f74c371c321b822b83801822/BreadedPangasiusPortionCutting.jpg', '1', '1', '105', null, null);
INSERT INTO `product_medias` VALUES ('121', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/434afd37f92ed4866da1538903ac77ca/yellow_pangasius_swai_fish_fillet-300x211.jpg', '1', '1', '106', null, null);
INSERT INTO `product_medias` VALUES ('123', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/434afd37f92ed4866da1538903ac77ca/pink_pangasius_swai_fish_fillet-1-300x209.jpg', '1', '1', '107', null, null);
INSERT INTO `product_medias` VALUES ('125', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/434afd37f92ed4866da1538903ac77ca/pangasius-white-fillet-300x217.jpg', '1', '1', '108', null, null);
INSERT INTO `product_medias` VALUES ('127', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/434afd37f92ed4866da1538903ac77ca/Pangasiusfinnuggets-270x200.jpg', '1', '1', '109', null, null);
INSERT INTO `product_medias` VALUES ('129', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/434afd37f92ed4866da1538903ac77ca/BELLYre-1-300x209.jpg', '1', '1', '110', null, null);
INSERT INTO `product_medias` VALUES ('131', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/434afd37f92ed4866da1538903ac77ca/pangasius_swai_fish_crispy_in_happy-300x209.jpg', '1', '1', '111', null, null);
INSERT INTO `product_medias` VALUES ('133', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/434afd37f92ed4866da1538903ac77ca/pangasius_swai_fish_burger_1-300x208.jpg', '1', '1', '112', null, null);
INSERT INTO `product_medias` VALUES ('135', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/434afd37f92ed4866da1538903ac77ca/Provocake_pangasius_swai_fish_0-300x209.jpg', '1', '1', '113', null, null);
INSERT INTO `product_medias` VALUES ('137', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/434afd37f92ed4866da1538903ac77ca/COLLAGENre-300x209.jpg', '1', '1', '114', null, null);
INSERT INTO `product_medias` VALUES ('139', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/434afd37f92ed4866da1538903ac77ca/fish-meal_1-300x165.jpg', '1', '1', '115', null, null);
INSERT INTO `product_medias` VALUES ('141', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/434afd37f92ed4866da1538903ac77ca/oil_1-300x199.jpg', '1', '1', '116', null, null);
INSERT INTO `product_medias` VALUES ('143', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/eb50175de7aef6dfe822832872f9c423/Pangasiusredmeaton.jpg', '1', '1', '117', null, null);
INSERT INTO `product_medias` VALUES ('145', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/eb50175de7aef6dfe822832872f9c423/PangasiusRoll3.jpg', '1', '1', '118', null, null);
INSERT INTO `product_medias` VALUES ('147', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/eb50175de7aef6dfe822832872f9c423/PangasiusSteaks.jpg', '1', '1', '119', null, null);
INSERT INTO `product_medias` VALUES ('149', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/eb50175de7aef6dfe822832872f9c423/PangasiusSkewer.jpg', '1', '1', '120', null, null);
INSERT INTO `product_medias` VALUES ('151', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/eb50175de7aef6dfe822832872f9c423/FishMeal.jpg', '1', '1', '121', null, null);
INSERT INTO `product_medias` VALUES ('153', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/eb50175de7aef6dfe822832872f9c423/Fishoil.jpg', '1', '1', '122', null, null);
INSERT INTO `product_medias` VALUES ('155', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5dae336c17dc37c1a3b9b4baa567bc62/PANGASIUSFILLET.jpg', '2', '1', '123', null, null);
INSERT INTO `product_medias` VALUES ('157', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5dae336c17dc37c1a3b9b4baa567bc62/ROLLROSEFISH.jpg', '1', '1', '26', null, null);
INSERT INTO `product_medias` VALUES ('159', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5dae336c17dc37c1a3b9b4baa567bc62/BLOCKFROZEN.jpg', '1', '1', '25', null, null);
INSERT INTO `product_medias` VALUES ('161', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/601007b979f29b4904f5ddae736f5774/1_2013-08-10-CHUNK.jpg', '1', '1', '40', null, null);
INSERT INTO `product_medias` VALUES ('162', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/605df19c7e25da2ecf7f30f340b55d11/gallery3.jpg', '1', '1', '39', null, null);
INSERT INTO `product_medias` VALUES ('163', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5dae336c17dc37c1a3b9b4baa567bc62/FISHBURGER.jpg', '1', '1', '60', null, null);
INSERT INTO `product_medias` VALUES ('164', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5dae336c17dc37c1a3b9b4baa567bc62/PANGASIUSBOLOGNA.jpg', '1', '1', '82', null, null);
INSERT INTO `product_medias` VALUES ('166', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5dae336c17dc37c1a3b9b4baa567bc62/PANGASIUS_WITH_CITRONELLA_CHILI.jpg', '1', '1', '124', null, null);
INSERT INTO `product_medias` VALUES ('167', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5dae336c17dc37c1a3b9b4baa567bc62/BREADEDPANGASIUSFILLET.jpg', '1', '1', '57', null, null);
INSERT INTO `product_medias` VALUES ('168', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5dae336c17dc37c1a3b9b4baa567bc62/PANGASIUSPASTEWITHCITRONELLA.jpg', '1', '1', '56', null, null);
INSERT INTO `product_medias` VALUES ('169', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5dae336c17dc37c1a3b9b4baa567bc62/PANGASIUSBALL.jpg', '1', '1', '55', null, null);
INSERT INTO `product_medias` VALUES ('170', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5dae336c17dc37c1a3b9b4baa567bc62/PANGASIUSNETSPRINGROLL.jpg', '1', '1', '54', null, null);
INSERT INTO `product_medias` VALUES ('171', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5dae336c17dc37c1a3b9b4baa567bc62/SNAILWITHPANGASIUSSTUFFING.jpg', '1', '1', '53', null, null);
INSERT INTO `product_medias` VALUES ('172', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5dae336c17dc37c1a3b9b4baa567bc62/FISHMEAL.jpg', '1', '1', '68', null, null);
INSERT INTO `product_medias` VALUES ('173', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5dae336c17dc37c1a3b9b4baa567bc62/FISHOIL.jpg', '1', '1', '71', null, null);
INSERT INTO `product_medias` VALUES ('174', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5dae336c17dc37c1a3b9b4baa567bc62/Roll_pangasius_dongaseafood.jpg', '1', '1', '38', null, null);
INSERT INTO `product_medias` VALUES ('175', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5dae336c17dc37c1a3b9b4baa567bc62/pangasius_Slice_faquimex.jpg', '1', '1', '47', null, null);
INSERT INTO `product_medias` VALUES ('176', '', '', '/vpa_ecom/storage/upload/cabc5acdccd6998fcc04d01b0a23c77f/5dae336c17dc37c1a3b9b4baa567bc62/Frozen_Pangasius__chunk__3_Cm.jpg', '1', '1', '48', null, null);

-- ----------------------------
-- Table structure for product_prices
-- ----------------------------
DROP TABLE IF EXISTS `product_prices`;
CREATE TABLE `product_prices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=368 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of product_prices
-- ----------------------------
INSERT INTO `product_prices` VALUES ('137', '19', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('138', '20', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('152', '32', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('169', '49', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('170', '50', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('171', '51', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('172', '52', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('179', '59', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('183', '63', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('184', '64', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('185', '65', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('186', '66', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('189', '69', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('190', '70', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('192', '72', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('194', '2', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('195', '74', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('196', '75', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('197', '22', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('199', '1', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('200', '3', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('203', '76', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('205', '77', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('207', '4', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('208', '78', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('209', '79', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('210', '80', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('212', '81', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('213', '5', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('215', '27', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('216', '6', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('222', '58', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('230', '14', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('233', '41', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('234', '42', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('235', '62', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('236', '61', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('237', '18', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('238', '17', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('239', '16', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('240', '15', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('241', '83', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('242', '29', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('243', '28', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('244', '43', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('249', '13', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('250', '44', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('252', '67', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('253', '84', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('254', '21', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('255', '33', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('256', '31', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('257', '30', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('259', '46', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('263', '86', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('264', '85', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('265', '87', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('266', '88', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('267', '24', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('268', '23', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('269', '37', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('270', '36', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('271', '35', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('273', '34', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('274', '45', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('277', '89', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('279', '90', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('281', '91', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('284', '92', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('286', '93', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('288', '94', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('290', '95', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('292', '96', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('294', '97', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('296', '98', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('298', '99', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('300', '100', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('302', '101', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('304', '102', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('306', '103', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('308', '104', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('310', '105', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('312', '106', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('314', '107', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('316', '108', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('318', '109', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('320', '110', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('322', '111', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('324', '112', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('326', '113', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('328', '114', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('330', '115', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('332', '116', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('334', '117', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('336', '118', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('338', '119', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('340', '120', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('342', '121', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('344', '122', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('346', '123', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('348', '26', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('350', '25', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('352', '40', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('353', '39', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('354', '60', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('355', '82', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('357', '124', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('358', '57', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('359', '56', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('360', '55', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('361', '54', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('362', '53', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('363', '68', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('364', '71', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('365', '38', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('366', '47', '0', '', null, null);
INSERT INTO `product_prices` VALUES ('367', '48', '0', '', null, null);

-- ----------------------------
-- Table structure for product_promotions
-- ----------------------------
DROP TABLE IF EXISTS `product_promotions`;
CREATE TABLE `product_promotions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desc` text COLLATE utf8_unicode_ci NOT NULL,
  `start_at` date NOT NULL,
  `end_at` date NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of product_promotions
-- ----------------------------

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8_unicode_ci NOT NULL,
  `public` tinyint(4) NOT NULL DEFAULT '0',
  `stocking` tinyint(4) NOT NULL DEFAULT '0',
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `new` tinyint(4) NOT NULL DEFAULT '0',
  `sort` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_alias_unique` (`alias`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', 'Pangasius white meat', 'pangasius-white-meat', 'Sản phẩm c&aacute; basa phi l&ecirc;', '1', '1', '0', '0', '1', '1', '2016-03-14 08:12:25', '2016-04-04 17:47:28');
INSERT INTO `products` VALUES ('2', 'Pangasius fillet white well trimmed', 'pangasius-fillet-white-well-trimmed', '', '1', '1', '0', '0', '1', '1', '2016-03-14 08:39:06', '2016-04-05 08:54:59');
INSERT INTO `products` VALUES ('3', 'Pangasius Fillet Welltrimmed', 'pangasius-fillet-welltrimmed', 'Pangasius Fillet Welltrimmed', '1', '1', '0', '0', '1', '1', '2016-03-19 19:20:51', '2016-04-05 10:42:36');
INSERT INTO `products` VALUES ('4', 'BASA FILLETS', 'basa-fillets', '', '1', '1', '1', '1', '1', '1', '2016-03-22 22:38:08', '2016-03-22 22:38:08');
INSERT INTO `products` VALUES ('5', 'Pangasius piece', 'pangasius-piece', '', '1', '1', '1', '0', '1', '4', '2016-03-22 22:41:05', '2016-04-05 11:23:17');
INSERT INTO `products` VALUES ('6', 'Pangasius Roll Rose', 'pangasius-roll-rose', '', '1', '1', '1', '0', '1', '2', '2016-03-22 22:42:09', '2016-03-22 22:42:09');
INSERT INTO `products` VALUES ('13', 'PANGASIUS FILLET', 'pangasius-fillet', '<small>PANGASIUS FILLET</small>', '1', '1', '0', '0', '0', '1', '2016-04-04 11:07:37', '2016-04-04 11:07:37');
INSERT INTO `products` VALUES ('14', 'Frozen Basa Fillets', 'frozen-basa-fillets', 'White meat, well-trimmed', '1', '1', '0', '0', '0', '1', '2016-04-04 11:10:00', '2016-04-04 11:10:00');
INSERT INTO `products` VALUES ('15', 'Un-trimmed', 'un-trimmed', 'Un-trimmed', '1', '1', '0', '0', '0', '1', '2016-04-04 11:12:27', '2016-04-05 12:22:56');
INSERT INTO `products` VALUES ('16', 'Half Trimmed', 'half-trimmed', 'Half trimmed', '1', '1', '0', '0', '0', '1', '2016-04-04 11:13:28', '2016-04-05 12:21:56');
INSERT INTO `products` VALUES ('17', 'Well-Trimmed', 'well-trimmed', 'Well-Trimmed', '1', '1', '0', '0', '0', '1', '2016-04-04 11:14:14', '2016-04-05 12:21:20');
INSERT INTO `products` VALUES ('18', 'Portion', 'portion', 'Portion', '1', '1', '1', '0', '0', '1', '2016-04-04 11:14:47', '2016-04-04 11:14:47');
INSERT INTO `products` VALUES ('19', 'Basa Vina Ruby Swai', 'basa-vina-ruby-swai', 'Basa', '1', '1', '0', '0', '0', '1', '2016-04-04 11:16:00', '2016-04-04 11:16:00');
INSERT INTO `products` VALUES ('20', 'Basa Vina Pearl Swai', 'basa-vina-pearl-swai', 'Basa Vina pearl swai', '1', '1', '0', '0', '0', '1', '2016-04-04 11:16:38', '2016-04-04 11:16:38');
INSERT INTO `products` VALUES ('21', 'Frozen Pangasius Fillet Well Trimmed', 'frozen-pangasius-fillet-well-trimmed', 'Color meat: white, light pink...', '1', '1', '0', '0', '0', '1', '2016-04-04 11:18:17', '2016-04-05 12:51:39');
INSERT INTO `products` VALUES ('22', 'Pangasius Fillet Un Trimmed', 'pangasius-fillet-un-trimmed', 'Pangasius Fillet Un Trimmed', '1', '1', '0', '0', '0', '1', '2016-04-04 11:19:06', '2016-04-05 09:53:28');
INSERT INTO `products` VALUES ('23', 'Untrimmed Belly On', 'untrimmed-belly-on', 'Untrimmed belly on', '1', '1', '0', '0', '0', '1', '2016-04-04 11:19:45', '2016-04-05 13:20:22');
INSERT INTO `products` VALUES ('24', 'Pangasius Untrimmed Fillets', 'pangasius-untrimmed-fillets', 'Pangasius Untrimmed Fillets', '1', '1', '0', '0', '0', '1', '2016-04-04 11:23:20', '2016-04-05 13:19:20');
INSERT INTO `products` VALUES ('25', 'BLOCK FROZEN', 'block-frozen-tafishco', 'BLOCK FROZEN', '1', '0', '0', '0', '0', '2', '2016-04-04 11:23:53', '2016-04-05 17:39:32');
INSERT INTO `products` VALUES ('26', 'ROLL ROSE FISH', 'roll-rose-fish-tafishco', 'ROLL ROSE FISH', '1', '0', '0', '0', '0', '2', '2016-04-04 11:24:09', '2016-04-05 17:39:01');
INSERT INTO `products` VALUES ('27', 'Pangasius Portion', 'pangasius-portion', 'Pangasius Porstion', '1', '1', '0', '1', '0', '3', '2016-04-04 11:24:30', '2016-04-04 11:57:04');
INSERT INTO `products` VALUES ('28', 'Skewered', 'skewered', 'Skewered', '1', '1', '0', '0', '0', '2', '2016-04-04 11:24:52', '2016-04-05 12:27:46');
INSERT INTO `products` VALUES ('29', 'Loin', 'loin', 'Loin', '1', '1', '0', '0', '0', '2', '2016-04-04 11:25:11', '2016-04-05 12:26:54');
INSERT INTO `products` VALUES ('30', 'Pangasius Industrial compressed Block', 'pangasius-industrial-compressed-block', 'Bock dimension: 48*25.5*6 cm', '1', '1', '0', '0', '0', '3', '2016-04-04 11:26:33', '2016-04-05 12:55:13');
INSERT INTO `products` VALUES ('31', 'Pangasius Portion Cut', 'pangasius-portion-cut', 'Color meat: white, light pink,&nbsp;light yellow', '1', '1', '0', '0', '0', '3', '2016-04-04 11:28:17', '2016-04-05 12:54:10');
INSERT INTO `products` VALUES ('32', 'Pangasius Roll-Medallion', 'pangasius-rollmedallion', 'Size: 40/60, 60/80, 70/90 (g/pc)', '1', '1', '0', '0', '0', '3', '2016-04-04 11:29:06', '2016-04-04 11:56:27');
INSERT INTO `products` VALUES ('34', 'Pangasius Steaks-Cut', 'pangasius-steakscut', 'Pangasius Steaks/Cut', '1', '1', '0', '0', '0', '2', '2016-04-04 11:30:21', '2016-04-05 13:24:47');
INSERT INTO `products` VALUES ('35', 'Industrial Block', 'industrial-block', 'Industrial Block', '1', '1', '0', '1', '0', '2', '2016-04-04 11:30:43', '2016-04-05 13:23:14');
INSERT INTO `products` VALUES ('36', 'Strip', 'strip', 'Strip', '1', '1', '0', '0', '0', '2', '2016-04-04 11:32:13', '2016-04-05 13:22:22');
INSERT INTO `products` VALUES ('37', 'Pangasius Rolls', 'pangasius-rolls', 'Pangasius Rolls', '1', '1', '0', '0', '0', '2', '2016-04-04 11:32:34', '2016-04-05 13:21:11');
INSERT INTO `products` VALUES ('38', 'ROLL PANGASIUS', 'roll-pangasius-dongaseafood', 'ROLL PANGASIUS', '1', '1', '0', '0', '0', '2', '2016-04-04 11:32:49', '2016-04-05 17:56:11');
INSERT INTO `products` VALUES ('39', 'Whole Pangasius', 'whole-pangasius-tafishco', 'Whole Pangasius', '1', '0', '0', '0', '0', '2', '2016-04-04 11:33:49', '2016-04-05 17:41:19');
INSERT INTO `products` VALUES ('40', 'CHUNK OR STEAK', 'chunk-or-steak-tafishco', 'CHUNK OR STEAK', '1', '0', '0', '0', '0', '3', '2016-04-04 11:34:36', '2016-04-05 17:40:54');
INSERT INTO `products` VALUES ('41', 'Frozen Slice Basa', 'frozen-slice-basa', 'Headless, gutted, gilled, fin off', '1', '1', '0', '0', '0', '3', '2016-04-04 11:35:18', '2016-04-05 12:08:40');
INSERT INTO `products` VALUES ('42', 'Frozen Whole Basa', 'frozen-whole-basa', 'Size: 800-1200', '1', '1', '0', '1', '0', '3', '2016-04-04 11:35:42', '2016-04-05 12:08:46');
INSERT INTO `products` VALUES ('43', 'Hgt', 'hgt', 'Hgt', '1', '1', '0', '0', '0', '2', '2016-04-04 11:36:04', '2016-04-05 12:28:28');
INSERT INTO `products` VALUES ('44', 'Pangasius Whole', 'pangasius-whole', 'Pangasius Whole', '1', '1', '0', '0', '0', '2', '2016-04-04 11:36:39', '2016-04-04 11:36:39');
INSERT INTO `products` VALUES ('45', 'Pangasius steak', 'pangasius-steak', 'Size: 2.5 cm (thickness)', '1', '1', '0', '0', '0', '2', '2016-04-04 11:37:23', '2016-04-05 13:24:52');
INSERT INTO `products` VALUES ('46', 'Frozen Whole Pangasius', 'frozen-whole-pangasius', 'Frozen Whole Pangasius', '1', '1', '0', '0', '0', '3', '2016-04-04 11:38:11', '2016-04-05 12:56:35');
INSERT INTO `products` VALUES ('47', 'Slice', 'slice-faquimex', 'Slice', '1', '1', '0', '0', '0', '2', '2016-04-04 11:38:26', '2016-04-05 17:57:20');
INSERT INTO `products` VALUES ('48', 'Chunk', 'chunk', 'Chunk', '1', '1', '0', '1', '0', '2', '2016-04-04 11:38:45', '2016-04-04 11:38:45');
INSERT INTO `products` VALUES ('49', 'Pangasius Roll With Skin', 'pangasius-roll-with-skin', 'Pangasius Roll With Skin', '1', '1', '0', '0', '0', '2', '2016-04-04 11:39:42', '2016-04-04 11:39:42');
INSERT INTO `products` VALUES ('50', 'Pangasius Fillets Skin-on', 'pangasius-fillets-skin-on', 'Pangasius Fillets Skin-on', '1', '1', '0', '0', '0', '2', '2016-04-04 11:40:15', '2016-04-04 11:40:15');
INSERT INTO `products` VALUES ('51', 'Headless-Tail Off Gutted Pangasius Fish', 'headless-tail-off-gutted-pangasius-fish', 'Headless, Tail Off Gutted Pangasius Fish', '1', '1', '0', '0', '0', '2', '2016-04-04 11:41:47', '2016-04-04 11:41:47');
INSERT INTO `products` VALUES ('52', 'Fish Tofu', 'fish-tofu', 'Fish Tofu', '1', '1', '0', '0', '0', '4', '2016-04-04 11:43:06', '2016-04-04 11:43:06');
INSERT INTO `products` VALUES ('53', 'Snail With Pangasius Stuffing', 'snail-with-pangasius-stuffing-tafishco', 'Snail With Pangasius Stuffing', '1', '1', '0', '0', '0', '4', '2016-04-04 11:43:42', '2016-04-05 17:47:37');
INSERT INTO `products` VALUES ('54', 'Pangasius Net Spring Roll', 'pangasius-net-spring-roll-tafishco', 'Pangasius Net Spring Roll', '1', '1', '0', '0', '0', '4', '2016-04-04 11:44:08', '2016-04-05 17:47:18');
INSERT INTO `products` VALUES ('55', 'Pangasius Ball', 'pangasius-ball-tafishco', 'Pangasius Ball', '1', '1', '0', '0', '0', '4', '2016-04-04 11:44:30', '2016-04-05 17:46:53');
INSERT INTO `products` VALUES ('56', 'Pangasius Paste With Citronella', 'pangasius-paste-with-citronella-tafishco', 'Pangasius Paste With Citronella', '1', '1', '0', '1', '0', '4', '2016-04-04 11:45:11', '2016-04-05 17:46:34');
INSERT INTO `products` VALUES ('57', 'Breaded Pangasius Fillet', 'breaded-pangasius-fillet-tafishco', 'Breaded Pangasius Fillet', '1', '1', '0', '0', '0', '4', '2016-04-04 11:45:36', '2016-04-05 17:46:04');
INSERT INTO `products` VALUES ('59', 'Pangasius Pologna', 'pangasius-pologna', 'Pangasius Pologna', '1', '1', '0', '0', '0', '4', '2016-04-04 11:46:46', '2016-04-04 11:46:46');
INSERT INTO `products` VALUES ('60', 'Fish burger', 'fish-burger-tafishco', 'Fish burger', '1', '0', '0', '0', '0', '4', '2016-04-04 11:47:11', '2016-04-05 17:42:23');
INSERT INTO `products` VALUES ('61', 'Frozen Basa Fish Ball With Chili', 'frozen-basa-fish-ball-with-chili', 'Net Weight: 500grs/ PE bag', '1', '1', '0', '0', '0', '4', '2016-04-04 11:47:53', '2016-04-04 11:47:53');
INSERT INTO `products` VALUES ('62', 'Frozen Basa Fish Ball With Dill', 'frozen-basa-fish-ball-with-dill', 'Frozen Basa Fish Ball With Dill<br />\nSelf life: 18 month', '1', '1', '0', '0', '0', '4', '2016-04-04 11:48:37', '2016-04-04 11:48:37');
INSERT INTO `products` VALUES ('67', 'Value-Add Pangasius', 'value-add-pangasius', 'Value-Add Pangasius', '1', '1', '0', '0', '0', '4', '2016-04-04 11:52:06', '2016-04-05 12:40:20');
INSERT INTO `products` VALUES ('68', 'Fish Meal', 'fish-meal-tafishco', 'Fish meal', '1', '1', '0', '0', '0', '5', '2016-04-04 11:52:43', '2016-04-05 17:48:04');
INSERT INTO `products` VALUES ('69', 'Pangasius Fishmeal', 'pangasius-fishmeal', 'Pangasius Fishmeal', '1', '1', '0', '0', '0', '5', '2016-04-04 11:53:08', '2016-04-04 11:53:08');
INSERT INTO `products` VALUES ('70', 'Amigen 1000-Amigen 5000', 'amigen-1000-amigen-5000', 'Amigen 1000, Amigen 5000<br />\nIngredient: 100% hydrolyzed collagen from fish skin', '1', '1', '0', '0', '0', '5', '2016-04-04 11:54:11', '2016-04-04 11:54:11');
INSERT INTO `products` VALUES ('71', 'Fish Oil', 'fish-oil-tafishco', 'Fish Oil', '1', '1', '0', '0', '0', '6', '2016-04-04 11:54:48', '2016-04-05 17:48:33');
INSERT INTO `products` VALUES ('74', 'Pangasius fillet light pink well trimmed', 'pangasius-fillet-light-pink-well-trimmed', 'Pangasius fillet light pink well trimmed', '1', '1', '0', '0', '0', '1', '2016-04-05 09:48:38', '2016-04-05 09:48:38');
INSERT INTO `products` VALUES ('75', 'Pangasius fillet light yellow well trimmed', 'pangasius-fillet-light-yellow-well-trimmed', 'Pangasius fillet light yellow well trimmed', '1', '1', '0', '0', '0', '1', '2016-04-05 09:51:05', '2016-04-05 09:51:05');
INSERT INTO `products` VALUES ('76', 'Pangasius Nugget', 'pangasius-nugget', '<h2>Pangasius Nugget</h2>\n', '1', '1', '0', '0', '0', '2', '2016-04-05 11:04:15', '2016-04-05 11:04:15');
INSERT INTO `products` VALUES ('77', 'White Breaded Panga Fillet', 'white-breaded-panga-fillet', '<h2>White Breaded Panga Fillet</h2>\n', '1', '1', '0', '0', '0', '4', '2016-04-05 11:11:33', '2016-04-05 11:11:33');
INSERT INTO `products` VALUES ('78', 'Pangasius rose rolling', 'pangasius-rose-rolling', '<h2>Pangasius rose rolling</h2>\n', '1', '1', '0', '0', '0', '2', '2016-04-05 11:18:30', '2016-04-05 11:18:30');
INSERT INTO `products` VALUES ('79', 'Basa-cut', 'basa-cut', '<h2>Basa-cut</h2>\n', '1', '1', '0', '0', '0', '3', '2016-04-05 11:19:42', '2016-04-05 11:19:42');
INSERT INTO `products` VALUES ('80', 'Pangasius sawn butterfly', 'pangasius-sawn-butterfly', '<h2>Pangasius sawn butterfly</h2>\n', '1', '1', '0', '0', '0', '3', '2016-04-05 11:21:12', '2016-04-05 11:21:12');
INSERT INTO `products` VALUES ('82', 'PANGASIUS BOLOGNA', 'pangasius-bologna-tafishco', '<h2>PANGASIUS BOLOGNA</h2>\n', '1', '0', '0', '0', '0', '3', '2016-04-05 11:51:58', '2016-04-05 17:42:46');
INSERT INTO `products` VALUES ('83', 'Roll Rose', 'roll-rose', 'Roll Rose', '1', '1', '0', '0', '0', '2', '2016-04-05 12:26:07', '2016-04-05 12:26:07');
INSERT INTO `products` VALUES ('84', 'Frozen Pangasius Fillet Untrimmed', 'frozen-pangasius-fillet-untrimmed', 'Frozen Pangasius Fillet Untrimmed', '1', '1', '0', '0', '0', '2', '2016-04-05 12:50:28', '2016-04-05 12:50:28');
INSERT INTO `products` VALUES ('85', 'Pangasius Skewer', 'pangasius-skewer', 'Pangasius Skewer', '1', '1', '0', '0', '0', '4', '2016-04-05 13:00:33', '2016-04-05 13:02:44');
INSERT INTO `products` VALUES ('86', 'Marinated Pangasius', 'marinated-pangasius', 'Marinated Pangasius', '1', '1', '0', '0', '0', '4', '2016-04-05 13:01:54', '2016-04-05 13:02:28');
INSERT INTO `products` VALUES ('87', 'Pangasius Welltrimmed Fillets', 'pangasius-welltrimmed-fillets', '<h2>Pangasius Welltrimmed Fillets</h2>\n', '1', '1', '0', '0', '0', '1', '2016-04-05 13:17:25', '2016-04-05 13:17:25');
INSERT INTO `products` VALUES ('88', 'Pangasius Semitrimmed Fillets', 'pangasius-semitrimmed-fillets', '<h2>Pangasius Semitrimmed Fillets</h2>\n', '1', '1', '0', '0', '0', '1', '2016-04-05 13:18:30', '2016-04-05 13:18:30');
INSERT INTO `products` VALUES ('89', 'Pangasius steak', 'pangasius-steak-an-phu', 'Pangasius steak An Ph&uacute;', '1', '0', '0', '0', '0', '2', '2016-04-05 13:34:45', '2016-04-05 13:34:55');
INSERT INTO `products` VALUES ('90', 'Chunk', 'chunk-an-phu', 'Chunk', '1', '0', '0', '0', '0', '2', '2016-04-05 14:06:20', '2016-04-05 14:06:29');
INSERT INTO `products` VALUES ('91', 'Slice', 'slice-an-phu', 'Slice', '1', '0', '0', '0', '0', '2', '2016-04-05 14:07:39', '2016-04-05 14:07:45');
INSERT INTO `products` VALUES ('92', 'Pangasius Breaded Fingers', 'pangasius-breaded-fingers-an-phu', '<h2>Pangasius Breaded Fingers</h2>\n', '1', '0', '0', '0', '0', '4', '2016-04-05 14:09:02', '2016-04-05 14:09:21');
INSERT INTO `products` VALUES ('93', 'Pangasius Breaded Fillets', 'pangasius-breaded-fillets-an-phu', '<h2>Pangasius Breaded Fillets</h2>\n', '1', '0', '0', '0', '0', '4', '2016-04-05 14:10:29', '2016-04-05 14:10:35');
INSERT INTO `products` VALUES ('94', 'Frozen Pangasius White Meat', 'frozen-pangasius-white-meat-southvina', 'Frozen Pangasius White Meat', '1', '0', '0', '0', '0', '1', '2016-04-05 14:20:22', '2016-04-05 14:20:31');
INSERT INTO `products` VALUES ('95', 'Light pink meat Pangasius Fillet', 'light-pink-meat-pangasius-fillet-southvina', '<h2>Light pink meat Pangasius Fillet</h2>\n', '1', '0', '0', '0', '0', '1', '2016-04-05 14:22:06', '2016-04-05 14:22:23');
INSERT INTO `products` VALUES ('96', 'Untrimmed filet', 'untrimmed-filet-southvina', 'Untrimmed filet', '1', '0', '0', '0', '0', '1', '2016-04-05 14:28:03', '2016-04-05 14:28:17');
INSERT INTO `products` VALUES ('97', 'Pangasius Untrimmed Fillets', 'pangasius-untrimmed-fillets-southvina', 'Pangasius Untrimmed Fillets', '1', '0', '0', '0', '0', '2', '2016-04-05 14:29:48', '2016-04-05 14:29:59');
INSERT INTO `products` VALUES ('98', 'frozen Pangasius-block', 'frozen-pangasius-block-southvina', '<h2>frozen Pangasius-block</h2>\n', '1', '0', '0', '0', '0', '2', '2016-04-05 14:31:27', '2016-04-05 14:31:34');
INSERT INTO `products` VALUES ('99', 'Frozen pangasius fillet - block', 'frozen-pangasius-fillet-block-southvina', 'Frozen pangasius fillet - block', '1', '0', '0', '0', '0', '2', '2016-04-05 14:33:10', '2016-04-05 14:33:19');
INSERT INTO `products` VALUES ('100', 'Frozen Pangasius Loins', 'frozen-pangasius-loins-southvina', '<h2>Frozen Pangasius Loins</h2>\n', '1', '0', '0', '0', '0', '2', '2016-04-05 14:36:02', '2016-04-05 14:36:10');
INSERT INTO `products` VALUES ('101', 'Pangasius Steak', 'pangasius-steak-southvina', 'Pangasius Steak', '1', '0', '0', '0', '0', '2', '2016-04-05 14:46:16', '2016-04-05 14:46:23');
INSERT INTO `products` VALUES ('102', 'Pangasius Fillets Skin-on', 'pangasius-fillets-skin-on-southvina', 'Pangasius Fillets Skin-on', '1', '0', '0', '0', '0', '2', '2016-04-05 14:47:36', '2016-04-05 14:47:43');
INSERT INTO `products` VALUES ('103', 'Pangasius Roll With Skin', 'pangasius-roll-with-skin-southvina', 'Pangasius Roll With Skin', '1', '0', '0', '0', '0', '2', '2016-04-05 14:49:05', '2016-04-05 14:49:11');
INSERT INTO `products` VALUES ('104', 'Breaded Pangasius Fillet', 'breaded-pangasius-fillet-southvina', '<h2>Breaded Pangasius Fillet</h2>\n', '1', '0', '0', '0', '0', '4', '2016-04-05 14:50:45', '2016-04-05 14:51:07');
INSERT INTO `products` VALUES ('105', 'Breaded Pangasius Portion Cutting', 'breaded-pangasius-portion-cutting-southvina', '<h2>Breaded Pangasius Portion Cutting</h2>\n', '1', '0', '0', '0', '0', '4', '2016-04-05 14:52:34', '2016-04-05 14:52:51');
INSERT INTO `products` VALUES ('106', 'Light yellow Pangasius fillet', 'light-yellow-pangasius-fillet-vinh-hoan', '<h2>Light yellow Pangasius fillet</h2>\n', '1', '0', '0', '0', '0', '2', '2016-04-05 15:04:26', '2016-04-05 15:04:33');
INSERT INTO `products` VALUES ('107', 'Light pink Pangasius fillet', 'light-pink-pangasius-fillet-vinh-hoan', '<h2>Light pink Pangasius fillet</h2>\n', '1', '0', '0', '0', '0', '2', '2016-04-05 15:05:23', '2016-04-05 15:05:38');
INSERT INTO `products` VALUES ('108', 'White Pangasius fillet', 'white-pangasius-fillet-vinh-hoan', '<h2>White Pangasius fillet</h2>\n', '1', '0', '0', '0', '0', '2', '2016-04-05 15:08:29', '2016-04-05 15:08:36');
INSERT INTO `products` VALUES ('109', 'Pangasius fin nuggets', 'pangasius-fin-nuggets-vinh-hoan', '<h2>Pangasius fin nuggets</h2>\n', '1', '0', '0', '0', '0', '2', '2016-04-05 15:15:23', '2016-04-05 15:15:30');
INSERT INTO `products` VALUES ('110', 'Pangasius belly nugget', 'pangasius-belly-nugget-vinh-hoan', '<h2>Pangasius belly nugget</h2>\n', '1', '0', '0', '0', '0', '2', '2016-04-05 15:16:28', '2016-04-05 15:16:35');
INSERT INTO `products` VALUES ('111', 'Crispy N Happy', 'crispy-n-happy-vinh-hoan', 'Crispy N Happy', '1', '0', '0', '0', '0', '4', '2016-04-05 15:18:07', '2016-04-05 15:18:18');
INSERT INTO `products` VALUES ('112', 'Fish Burgers', 'fish-burgers-vinh-hoan', 'Fish Burgers', '1', '0', '0', '0', '0', '4', '2016-04-05 15:19:21', '2016-04-05 15:19:27');
INSERT INTO `products` VALUES ('113', 'Provocake', 'provocake-vinh-hoan', '<h2>Provocake</h2>\n', '1', '0', '0', '0', '0', '4', '2016-04-05 15:21:11', '2016-04-05 15:22:08');
INSERT INTO `products` VALUES ('114', 'Amigen 1000, Amigen 5000 - Natural hydrolyzed collagen powder from Pangasius fish skin', 'amigen-1000-amigen-5000-natural-hydrolyzed-collagen-powder-from-pangasius-fish-skin-vinh-hoan', '<h2>Amigen 1000, Amigen 5000 - Natural hydrolyzed collagen powder from Pangasius fish skin</h2>\n', '1', '0', '0', '0', '0', '5', '2016-04-05 15:23:46', '2016-04-05 15:23:55');
INSERT INTO `products` VALUES ('115', 'Pangasius fish meal', 'pangasius-fish-meal-vinh-hoan', '<h2>Pangasius fish meal</h2>\n', '1', '0', '0', '0', '0', '5', '2016-04-05 15:25:51', '2016-04-05 15:25:58');
INSERT INTO `products` VALUES ('116', 'Pangasius fish oil', 'pangasius-fish-oil-vinh-hoan', '<h2>Pangasius fish oil</h2>\n', '1', '0', '0', '0', '0', '6', '2016-04-05 15:26:46', '2016-04-05 15:26:53');
INSERT INTO `products` VALUES ('117', 'Pangasius Red Meat On', 'pangasius-red-meat-on-navico', 'Pangasius Red Meat On', '1', '0', '0', '0', '0', '1', '2016-04-05 15:29:03', '2016-04-05 15:29:08');
INSERT INTO `products` VALUES ('118', 'Pangasius Roll', 'pangasius-roll-navico', '<h2>Pangasius Roll</h2>\n', '1', '0', '0', '0', '0', '2', '2016-04-05 15:30:04', '2016-04-05 15:30:12');
INSERT INTO `products` VALUES ('119', 'Pangasius Steaks', 'pangasius-steaks-navico', '<h2>Pangasius Steaks</h2>\n', '1', '0', '0', '0', '0', '3', '2016-04-05 15:31:34', '2016-04-05 15:31:43');
INSERT INTO `products` VALUES ('120', 'Pangasius Skewer', 'pangasius-skewer-navico', '<h2>Pangasius Skewer</h2>\n', '1', '0', '0', '0', '0', '4', '2016-04-05 15:33:22', '2016-04-05 15:33:29');
INSERT INTO `products` VALUES ('121', 'Fish Meal', 'fish-meal-navico', '<h2>Fish Meal</h2>\n', '1', '0', '0', '0', '0', '5', '2016-04-05 15:34:22', '2016-04-05 15:35:00');
INSERT INTO `products` VALUES ('122', 'Fish Oil', 'fish-oil-navico', '<h2>Fish Oil</h2>\n', '1', '0', '0', '0', '0', '6', '2016-04-05 15:35:53', '2016-04-05 15:35:59');
INSERT INTO `products` VALUES ('123', 'Pangasius Fillet', 'pangasius-fillet-tafishco', '<h2>Pangasius Fillet</h2>\n', '1', '0', '0', '0', '0', '1', '2016-04-05 17:36:31', '2016-04-05 17:36:52');
INSERT INTO `products` VALUES ('124', 'Pangasius With Citronella and Chili', 'pangasius-with-citronella-and-chili-tafishco', '', '1', '0', '0', '0', '0', '4', '2016-04-05 17:44:02', '2016-04-05 17:44:34');
