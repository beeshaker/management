/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE TABLE IF NOT EXISTS `complaints` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `issuedesc` text,
  `issue` varchar(255) DEFAULT NULL,
  `incharge` int(11) DEFAULT NULL,
  `authorizer` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `cost` varchar(50) DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `type` varchar(50) NOT NULL DEFAULT '0',
  `enddate` date DEFAULT NULL,
  `priority` varchar(50) DEFAULT NULL,
  `solution` text,
  `p_id` int(11) DEFAULT NULL,
  `image` text,
  PRIMARY KEY (`c_id`),
  KEY `FK_complaints_property` (`p_id`),
  KEY `FK_complaints_employees` (`incharge`),
  KEY `FK_complaints_customer` (`client_id`),
  CONSTRAINT `FK_complaints_customer` FOREIGN KEY (`client_id`) REFERENCES `customer` (`u_id`),
  CONSTRAINT `FK_complaints_employees` FOREIGN KEY (`incharge`) REFERENCES `employees` (`e_id`),
  CONSTRAINT `FK_complaints_property` FOREIGN KEY (`p_id`) REFERENCES `property` (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `complaints` DISABLE KEYS */;
INSERT INTO `complaints` (`c_id`, `client_id`, `issuedesc`, `issue`, `incharge`, `authorizer`, `status`, `cost`, `startdate`, `type`, `enddate`, `priority`, `solution`, `p_id`, `image`) VALUES
	(5, 1, 'Change tube lights', 'Electricals', 4, 'Authorized', 'Archive', '15000', '2019-07-18', 'Operational', '2019-07-20', 'Low', 'Bought New Tube lights \r\nRelapced them', 2, 'images/1.PNG'),
	(10, 1, 'Garden Hose', 'Plumbing', 4, 'Authorized', 'Archive', '500', '2019-07-19', 'Operational', '2019-07-21', 'High', 'Changed hose', 1, 'images/1.PNG'),
	(12, 1, 'This is a plumbing issue that has decreased', 'Plumbing', 4, 'Authorized', 'Archive', '', '2019-07-22', 'Equipment', '2019-12-07', 'Medium', '', 1, 'images/1.PNG'),
	(14, 1, 'Change Garden Hose', 'Plumbing', 4, 'Authorized', 'Archive', '1500', '2019-08-02', 'Equipment', '2019-08-07', 'Low', 'installed new house', 1, 'images/1.PNG'),
	(22, 1, 'Water Pipe Burst ', 'Plumbing', 4, 'Pending', 'Complete', '15000', '2019-08-15', 'Operational', '2019-08-21', 'Low', 'Fixed the pipe', 1, 'images/1.PNG'),
	(25, 1, 'Tubelight is blown', 'Electricals', 4, 'Pending', 'Archive', '1000', '2019-08-19', 'Operational', '2019-08-19', 'Low', 'Bought New tubelights', 2, 'images/flute-removebg-preview.png'),
	(26, 1, 'Gutter is blocked', 'Water blockage ', 4, 'Pending', 'Incomplete', '10000', '2019-08-20', 'Operational', '2019-08-20', 'High', 'Gutter has beeen unblocked', 2, 'images/desktop.jpg'),
	(27, 1, ' water hose is changed', 'Water blockage ', 4, 'Pending', 'Complete', '10000', '2019-08-20', 'Operational', '2019-09-25', 'High', 'changed', 2, 'images/'),
	(28, 1, 'toilet is blocked', 'Plumbing', 4, 'Pending', 'Incomplete', NULL, '2019-08-20', 'Operational', NULL, 'High', NULL, 2, 'images/3.PNG'),
	(32, 1, '123', 'Plumbing', 4, 'Pending', 'Incomplete', NULL, '2019-08-22', 'Operational', NULL, 'High', NULL, 2, 'images/'),
	(33, 3, 'Water Blockage', 'Plumbing', 4, 'Pending', 'Incomplete', NULL, '2019-09-02', 'Equipment', NULL, 'Low', NULL, 20, 'images/Capture.PNG'),
	(34, 3, 'water Blockage', 'Plumbing', 4, 'Pending', 'Incomplete', NULL, '2019-09-02', 'Equipment', NULL, 'Medium', NULL, 20, 'images/Capture.PNG'),
	(35, 3, 'water blockage', 'Plumbing', 4, 'Pending', 'Incomplete', NULL, '2019-09-02', 'Operational', NULL, 'Medium', NULL, 20, 'images/Capture.PNG'),
	(39, 5, 'qwertyuiop[pokjhgfdcxsz', 'Electricals', NULL, 'Pending', 'Incomplete', NULL, '2019-09-25', 'Equipment', NULL, NULL, NULL, 20, 'images/'),
	(40, 5, 't', 'Plumbing', NULL, 'Pending', 'Incomplete', NULL, '2019-09-25', 'Equipment', NULL, NULL, NULL, 20, 'images/'),
	(41, 5, 'qwertyuiop', 'Plumbing', 4, 'Pending', 'Incomplete', NULL, '2019-09-25', 'Operational', NULL, 'High', NULL, 20, 'images/Capture.PNG'),
	(42, 5, 'asdfghjk', 'Electricals', 4, 'Pending', 'Incomplete', NULL, '2019-09-25', 'Operational', NULL, 'High', NULL, 20, 'images/'),
	(43, 5, 'dfghjk', 'Plumbing', 4, 'Pending', 'Incomplete', NULL, '2019-09-25', 'Operational', NULL, 'High', NULL, 20, 'images/'),
	(44, 5, 'qwerty', 'Plumbing', 4, 'Pending', 'Incomplete', NULL, '2019-09-25', 'Operational', NULL, 'High', NULL, 20, 'images/Capture.PNG'),
	(45, 1, '2', '2', 4, 'Pending', 'Incomplete', NULL, '2019-09-25', 'Operational', NULL, 'High', NULL, 20, 'images/Capture.PNG'),
	(46, 1, '1', 'Plumbing', 4, 'Pending', 'Incomplete', NULL, '2019-09-25', 'Operational', NULL, 'High', NULL, 1, 'images/Capture.PNG'),
	(47, 1, '12345', 'Plumbing', 4, 'Pending', 'Incomplete', NULL, '2019-09-25', 'Operational', NULL, 'High', NULL, 2, 'images/'),
	(48, 1, 'g', 'Plumbing', 4, 'Pending', 'Incomplete', NULL, '2019-09-25', 'Decsion Making', NULL, 'Medium', NULL, 3, 'images/'),
	(49, 1, 'wdetfrgy67u8i', 'Plumbing', 4, 'Pending', 'Incomplete', NULL, '2019-09-30', 'Operational', NULL, 'Low', NULL, 1, 'images/'),
	(50, 1, 'fhgdtshyajk', 'Electricals', NULL, 'Pending', 'Incomplete', NULL, '2019-10-02', '0', NULL, NULL, NULL, 1, 'images/');
/*!40000 ALTER TABLE `complaints` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `customer` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `semail` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `sphone` varchar(50) DEFAULT NULL,
  `unum` int(11) DEFAULT NULL,
  `owner` varchar(50) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  PRIMARY KEY (`u_id`),
  KEY `FK_customer_property` (`pid`),
  CONSTRAINT `FK_customer_property` FOREIGN KEY (`pid`) REFERENCES `property` (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` (`u_id`, `fname`, `lname`, `email`, `semail`, `password`, `phone`, `sphone`, `unum`, `owner`, `pid`) VALUES
	(1, 'Roocha', 'Thakkar', 'katirarj@gmail.com', NULL, '1234', '3217752369', NULL, 2, 'owner', 1),
	(3, 'John', 'Doe', 'johna@jacob.com', NULL, '1234', '706526724', NULL, 3, NULL, NULL),
	(4, 'John', 'Xavier', 'johna@jacob.com', NULL, '1234', '0706526724', NULL, 5, NULL, NULL),
	(5, 'JIGAR', 'THAKKER', 'thakkerjg@gmail.com', NULL, '1234', '0706526724', NULL, 5, NULL, NULL),
	(6, 'Tatti', 'Tatti', 'katirarj@gmail.com', 'katirarj@gmail.com', '1234', '0706526724', '0706526724', 10, 'Owner', 2);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `employees` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`e_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` (`e_id`, `fname`, `lname`, `type`, `email`, `password`, `phone`) VALUES
	(4, 'Abhishek', 'Shah', 'emp', 'abhishekshah546@gmail.com ', '1234', '1452586'),
	(5, 'emp2', 'emp2', 'senior', 'emp2', '1234', '7524555'),
	(6, 'Jane', 'Njeri', 'emp', 'jane@njeri.com', '1234', '706526724'),
	(7, 'qwertyu', 'fgbhjk', 'emp', 'vgbhn@gmail.com', '123654', '0706526724');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `login` (
  `l_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`l_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` (`l_id`, `email`, `password`, `type`) VALUES
	(1, 'abhishekshah546@gmail.com ', '1234', 'emp'),
	(2, 'emp2', '1234', 'senior'),
	(3, 'katirarj@gmail.com', '1234', 'customer'),
	(4, 'reception', '1234', 'reception'),
	(6, 'johna@jacob.com', '1234', 'customer'),
	(7, 'jane@njeri.com', '1234', 'emp'),
	(8, 'johna@jacob.com', '1234', 'customer'),
	(9, 'thakkerjg@gmail.com', '1234', 'customer'),
	(12, 'vgbhn@gmail.com', '123654', 'emp');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `property` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `incharge` varchar(50) DEFAULT NULL,
  `chair` varchar(50) DEFAULT NULL,
  `numofhouses` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `property` DISABLE KEYS */;
INSERT INTO `property` (`p_id`, `name`, `location`, `type`, `incharge`, `chair`, `numofhouses`) VALUES
	(1, 'Nishapa Investments Ltd', '', 'Commercial', '4', 'Doocha', 'N/A'),
	(2, 'Fashions Plaza Ltd', '', 'Commercial', '4', NULL, 'N/A'),
	(3, 'Saffron Heights Ltd', '', 'Residential', '4', NULL, '20'),
	(4, 'Finchely Management Ltd', NULL, 'Residential', NULL, NULL, '12'),
	(5, 'Petal Investments Ltd', NULL, 'Commercial', NULL, NULL, '18'),
	(6, 'Rambha C. P. Shah', NULL, 'Residential', NULL, NULL, '10'),
	(7, 'Satyam Apartments Management Ltd', NULL, 'Residential', NULL, NULL, '21'),
	(8, 'Savla Plaza - Tapping Investments', NULL, 'Commercial', NULL, NULL, '12'),
	(9, 'Brookside Terraces - Brookside Drive Ltd', NULL, 'Residential', NULL, NULL, '48'),
	(10, 'The Residences General Mathenge Ltd', NULL, 'Residential', NULL, NULL, '47'),
	(11, 'Solitaire on General Mathenge Management co. Ltd', NULL, 'Residential', NULL, NULL, '24'),
	(12, 'Kaputei Court', NULL, 'Residential', NULL, NULL, '6'),
	(13, 'Raphta Royal', NULL, 'Residential', NULL, NULL, '12'),
	(14, 'Radiatben', NULL, 'Residential', NULL, NULL, '1'),
	(15, 'Nishit s Proverty- SVBP', NULL, 'Commercial', NULL, NULL, '1'),
	(16, 'Sheffieled Properties', NULL, 'Commercial', NULL, NULL, '10'),
	(17, 'Supreme Properties', NULL, 'Commercial', NULL, NULL, '12'),
	(18, 'Shaima Developers', NULL, 'Commercial', NULL, NULL, '5'),
	(19, 'Thika Warehouses', NULL, 'Commercial', NULL, NULL, '10'),
	(20, 'Rameshchandra N. Shah', NULL, 'Commercial', NULL, NULL, '5');
/*!40000 ALTER TABLE `property` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
