CREATE TABLE IF NOT EXISTS `mui_opts` (
  `opt_type` varchar(32) NOT NULL,
  `opt_label` varchar(32) DEFAULT NULL,
  `opt_val` varchar(32) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
