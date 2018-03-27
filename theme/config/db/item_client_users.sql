CREATE TABLE `SITE_DB`.`item_client_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,

  `user_id` int(11) NOT NULL,

  PRIMARY KEY  (`id`),
  KEY `client_id` (`client_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `item_client_users_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `SITE_DB`.`items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `item_client_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `SITE_DB`.`users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
