CREATE TABLE `SITE_DB`.`item_client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,

  `name` varchar(100) NOT NULL,
  `html` text NOT NULL DEFAULT '',
  `secret_url_token` varchar(100) NOT NULL DEFAULT '',  

  `buy_button` int(11) NOT NULL DEFAULT 0,
  `instant_delivery` int(11) NOT NULL DEFAULT 0,
  `show_price` int(11) NOT NULL DEFAULT 0,

  `position` int(11) DEFAULT 0,

  PRIMARY KEY  (`id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `item_client_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `SITE_DB`.`items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
