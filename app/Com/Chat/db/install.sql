CREATE TABLE `chat_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `attribs` text COLLATE utf8_unicode_ci NOT NULL,
  `protected` tinyint(4) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `chat_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chat_group_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `attribs` text COLLATE utf8_unicode_ci NOT NULL,
  `last_online` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `offline` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `chat_users_chat_group_id_foreign` (`chat_group_id`),
  KEY `chat_users_user_id_foreign` (`user_id`),
  CONSTRAINT `chat_users_chat_group_id_foreign` FOREIGN KEY (`chat_group_id`) REFERENCES `chat_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `chat_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `chat_customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_pic` text COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `active` tinyint(4) NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `attribs` text COLLATE utf8_unicode_ci NOT NULL,
  `last_online` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `offline` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `chat_messages` (
  `from_user` int(10) unsigned NOT NULL,
  `to_user` int(10) unsigned NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `seen` tinyint(4) NOT NULL,
  `request` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `chat_lists` (
  `user_id` int(10) unsigned NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `type` text COLLATE utf8_unicode_ci NOT NULL,
  `attribs` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `systems`(`code`, `attribs`) VALUES ('chat', '{\"start_time\":\"\", \"end_time\":\"\", \"sound_user_online\":\"\", \"sound_new_message\":\"\"}');
