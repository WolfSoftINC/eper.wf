--
-- Table structure for table `want_buy`
--

CREATE TABLE IF NOT EXISTS `want_buy` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `dr` int(11) NOT NULL,
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;