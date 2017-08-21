DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `profileId` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `phone` int(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `socialMedia` varchar(255) DEFAULT NULL,
  `interest` varchar(255) DEFAULT NULL,
  `regTime` datetime NOT NULL,
  PRIMARY KEY (`profileId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
