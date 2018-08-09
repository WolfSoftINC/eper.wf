--
-- Table structure for table `delivery`
--

CREATE TABLE IF NOT EXISTS `delivery` (
  `delivery_id` int(11) NOT NULL,
  `basket_id` int(10) NOT NULL,
  `user_id` int(7) NOT NULL,
  `country` int(3) NOT NULL,
  `city` int(5) NOT NULL,
  `address` VARCHAR(128) NOT NULL,
  `dr` int(11) NOT NULL,
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;