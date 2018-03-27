CREATE TABLE `SITE_DB`.`item_client_contexts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,

  `context` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,

  PRIMARY KEY  (`id`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `item_client_contexts_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `SITE_DB`.`items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
