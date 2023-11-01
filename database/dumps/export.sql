CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `home_page` varchar(255) DEFAULT NULL,
  `text` text NOT NULL,
  `extra` longtext DEFAULT NULL,
  `level` smallint(5) unsigned NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `user_name` (`user_name`),
  KEY `email` (`email`),
  KEY `created_at` (`created_at`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

INSERT INTO `comments` VALUES (1, NULL, 'Foxy_Mama', 'farber@sbcglobal.net', 'https://foxymama.site/forber', 'Pellentesque in orci eu est volutpat egestas id non felis. Phasellus lorem arcu, lobortis vehicula dolor at, eleifend molestie ex. Vivamus porta malesuada quam vel blandit. Sed leo magna, imperdiet ac pharetra in, convallis in ex.', NULL, 1, '2023-10-09 14:48:12', '2023-10-09 14:48:12');
INSERT INTO `comments` VALUES (2, 1, 'Skunk27', 'webdragon@sbcglobal.net', NULL, 'Integer in fringilla magna. Fusce vulputate augue nec nibh consectetur, non imperdiet purus auctor. Vivamus consectetur, velit eget mattis hendrerit, ligula turpis rutrum mauris, eu posuere turpis nunc at nulla.', NULL, 2, '2023-10-10 12:55:33', '2023-10-10 12:55:33');
INSERT INTO `comments` VALUES (3, 2, 'Munchkin', 'kodeman@yahoo.com', NULL, 'Maecenas nec porta nibh. Suspendisse feugiat vestibulum lorem vel mattis. Nullam urna turpis, placerat sed interdum id, pellentesque suscipit tellus. Nunc tempus ipsum mi. Praesent vitae venenatis erat, at porttitor nisi.', NULL, 3, '2023-10-10 16:50:40', '2023-10-10 16:50:40');
INSERT INTO `comments` VALUES (4, NULL, 'Cupcake', 'emmanuel@msn.com', 'https://cupcake.name', 'Praesent pharetra sit amet sapien vitae dictum. Mauris varius vestibulum augue. Nam at erat sed erat molestie interdum sed in quam. Proin suscipit aliquet libero vel fermentum.', NULL, 1, '2023-10-11 10:12:37', '2023-10-11 10:12:37');
INSERT INTO `comments` VALUES (5, 4, 'Fun_97Dip', 'rande@optonline.net', NULL, 'Donec dui dui, ornare ac turpis ut, mollis facilisis justo. Vivamus at congue orci. Nullam a semper velit. Maecenas magna nulla, pretium vel tempus sed, imperdiet a dolor.', NULL, 2, '2023-10-12 12:53:36', '2023-10-12 12:53:36');
INSERT INTO `comments` VALUES (6, 5, 'Tater_19', 'gordonjcp@optonline.net', NULL, 'The longest word in any of the major English language dictionaries is pneumonoultramicroscopicsilicovolcanoconiosis, a word that refers to a lung disease contracted from the inhalation of very fine silica particles, specifically from a volcano; medically, it is the same as silicosis.', NULL, 3, '2023-10-12 15:54:26', '2023-10-12 15:54:26');
INSERT INTO `comments` VALUES (7, NULL, 'Chewbacca', 'pappp@verizon.net', 'https://chewbacca.com/pappp', 'Nullam lorem nisl, aliquam sit amet nisi eu, tristique suscipit felis. Vivamus non orci lacinia, fringilla dui sit amet, suscipit eros. Nulla a nunc lacus. Nam vel commodo lorem. Curabitur in tristique arcu. Aliquam erat volutpat.', NULL, 1, '2023-10-13 12:55:01', '2023-10-13 12:55:01');
INSERT INTO `comments` VALUES (8, 7, 'Fattykins', 'kourai@sbcglobal.net', NULL, 'The longest word in any of the major English language dictionaries is pneumonoultramicroscopicsilicovolcanoconiosis, a word that refers to a lung disease contracted from the inhalation of very fine silica particles, specifically from a volcano; medically, it is the same as silicosis.', NULL, 2, '2023-10-13 18:56:24', '2023-10-13 18:56:24');
INSERT INTO `comments` VALUES (9, 8, 'Gummy_Pop', 'jrkorson@live.com', NULL, 'Duis enim ipsum, vulputate vel sapien facilisis, luctus scelerisque ante. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.', NULL, 3, '2023-10-13 22:27:07', '2023-10-13 22:27:07');
INSERT INTO `comments` VALUES (10, NULL, 'Scarlet_97', 'mbalazin@gmail.com', 'https://myspace.com/mbalazin', 'The longest word in any of the major English language dictionaries is pneumonoultramicroscopicsilicovolcanoconiosis, a word that refers to a lung disease contracted from the inhalation of very fine silica particles, specifically from a volcano; medically, it is the same as silicosis.', NULL, 1, '2023-10-16 10:58:10', '2023-10-16 10:58:10');
INSERT INTO `comments` VALUES (11, 10, 'Genius', 'sacraver@verizon.net', NULL, 'Suspendisse gravida nibh purus, eu sodales ipsum accumsan at. Quisque in eros ut nisi fermentum euismod. Cras scelerisque dui convallis leo venenatis, in mattis erat fringilla.', NULL, 2, '2023-10-16 12:59:17', '2023-10-16 12:59:17');
INSERT INTO `comments` VALUES (12, 11, 'Tata2', 'tamas@mac.com', NULL, 'Aliquam tristique tristique lacus, vel porttitor dui iaculis molestie. Fusce congue maximus nisl, eu convallis ex ornare eget. Donec lobortis eros massa, sit amet finibus risus convallis ut. Sed quis felis in justo feugiat maximus.', NULL, 3, '2023-10-16 13:00:06', '2023-10-16 13:00:06');
