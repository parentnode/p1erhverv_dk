CREATE TABLE `SITE_DB`.`item_client_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,

  `product_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,

  PRIMARY KEY  (`id`),
  KEY `client_id` (`client_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `item_client_products_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `SITE_DB`.`items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `item_client_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `SITE_DB`.`items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
