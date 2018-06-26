CREATE TABLE `users` (
 `email` varchar(50) NOT NULL,
 `password` varchar(16) NOT NULL,
 `activation_code` varchar(60) NOT NULL,
 `status` enum('0','1') NOT NULL,
 `user_type` enum('admin','normal_user') NOT NULL,
 UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1