DROP TABLE IF EXISTS `fileuploadtable`;
CREATE TABLE `fileuploadtable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `usernameID` int(11) DEFAULT NULL,
  `filename` varchar(40) DEFAULT NULL,
  `filepath` varchar(70) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `likes` int(11) NOT NULL,
  `loves` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;