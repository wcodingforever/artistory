DROP TABLE IF EXISTS `loginSessionTable`;
CREATE TABLE `loginSessionTable` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    `username` varchar(20) DEFAULT NULL,
    `password` varchar(64) DEFAULT NULL,
    `session` varchar(64) DEFAULT NULL,
    `timestamp` datetime
);