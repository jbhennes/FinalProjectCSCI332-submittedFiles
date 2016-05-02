-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 08, 2015 at 01:28 PM
-- Server version: 5.5.44-37.3-log
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jakeh420_CSCI332Project`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`jakeh420`@`localhost` PROCEDURE `sellProduct`(IN `id` INT, IN `amountToSell` INT)
begin
   set transaction isolation level serializable;
   START TRANSACTION;
   if (amountToSell) > 0 then
      update Products set amountInStock = (amountInStock - `amountToSell`) where productId = `id`;
   end if;
   commit;
end$$

--
-- Functions
--
CREATE DEFINER=`jakeh420`@`localhost` FUNCTION `repairFinished`(dateToReturn date) RETURNS varchar(10) CHARSET utf8
    DETERMINISTIC
BEGIN
    DECLARE status varchar(10);
 
    IF datetoReturn < CURDATE() THEN
 		SET status = 'COMPLETE';
    ELSEIF dateToReturn > CURDATE() THEN
        SET status = 'INCOMPLETE';
    END IF;
 
 RETURN (status);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Instructors`
--

CREATE TABLE IF NOT EXISTS `Instructors` (
  `instructorId` int(10) NOT NULL AUTO_INCREMENT,
  `instructorName` varchar(255) NOT NULL,
  `instructorAddress` varchar(255) NOT NULL,
  `instructorEmail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`instructorId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `Instructors`
--

INSERT INTO `Instructors` (`instructorId`, `instructorName`, `instructorAddress`, `instructorEmail`) VALUES
(1, 'DEFAULT INSTRUCTOR', 'N/A', 'N/A@N/A.N/A'),
(2, 'Mickey Reynolds', 'The Docks', 'NONE'),
(4, 'Reggie Puddinmeyer', '2 Ye''Please Way', 'PUDDinU@gmail.com'),
(5, 'Roy G. Biv', 'Rainbow Row', 'bowrow@funsingles.net'),
(6, 'Young Buck & G-Unit', 'On Yo Block, In Yo House!!', 'buckenuf4ya@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `Lessons`
--

CREATE TABLE IF NOT EXISTS `Lessons` (
  `lessonId` int(10) NOT NULL AUTO_INCREMENT,
  `patronId` int(10) NOT NULL,
  `instructorId` int(10) NOT NULL,
  `date` date NOT NULL,
  `time` time DEFAULT NULL,
  PRIMARY KEY (`lessonId`),
  KEY `FKLessonsPatron` (`patronId`),
  KEY `FKLessonsIstr` (`instructorId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `Lessons`
--

INSERT INTO `Lessons` (`lessonId`, `patronId`, `instructorId`, `date`, `time`) VALUES
(1, 15, 5, '2015-12-10', '13:30:00'),
(2, 1, 4, '2015-10-13', '16:45:00'),
(3, 15, 5, '2015-04-15', '16:30:00'),
(4, 18, 4, '2015-04-15', '13:30:00'),
(19, 18, 5, '2015-12-12', '12:35:00'),
(23, 18, 2, '2015-11-22', '09:45:00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `orderLessons`
--
CREATE TABLE IF NOT EXISTS `orderLessons` (
`orderId` int(10)
,`patronId` int(10)
,`orderDate` date
,`total` decimal(10,2)
,`priceTypeId` varchar(10)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `orderProducts`
--
CREATE TABLE IF NOT EXISTS `orderProducts` (
`orderId` int(10)
,`patronId` int(10)
,`orderDate` date
,`total` decimal(10,2)
,`priceTypeId` varchar(10)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `orderRepairs`
--
CREATE TABLE IF NOT EXISTS `orderRepairs` (
`orderId` int(10)
,`patronId` int(10)
,`orderDate` date
,`total` decimal(10,2)
,`priceTypeId` varchar(10)
);
-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE IF NOT EXISTS `Orders` (
  `orderId` int(10) NOT NULL AUTO_INCREMENT,
  `patronId` int(10) NOT NULL,
  `orderDate` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `priceTypeId` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`orderId`),
  KEY `fk__lessonorders` (`patronId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`orderId`, `patronId`, `orderDate`, `total`, `priceTypeId`) VALUES
(5, 1, '2014-12-13', '25.00', 'Lesson'),
(6, 15, '2013-11-22', '23.14', 'Repair'),
(8, 15, '2015-03-31', '17020.03', 'Lesson'),
(10, 18, '2015-11-29', '3001.00', 'Product'),
(11, 12, '2015-06-16', '345.09', 'Product'),
(12, 13, '2014-11-14', '112.45', 'Repair'),
(13, 1, '2015-11-22', '456.78', 'Product'),
(14, 13, '2015-11-24', '12.13', 'Product'),
(15, 12, '2014-11-14', '23.54', 'Lesson'),
(16, 18, '2015-11-22', '9.83', 'Product'),
(17, 18, '2015-03-31', '23367.42', 'Product'),
(19, 18, '2015-12-12', '45.00', 'Lesson'),
(23, 18, '2015-11-22', '1000.00', 'Lesson'),
(24, 18, '2015-11-22', '1000.00', 'Repair');

--
-- Triggers `Orders`
--
DROP TRIGGER IF EXISTS `insertLessonAfterOrders`;
DELIMITER //
CREATE TRIGGER `insertLessonAfterOrders` AFTER INSERT ON `Orders`
 FOR EACH ROW BEGIN
  IF (new.priceTypeId = 'Lesson') THEN
    INSERT into Lessons(lessonId, patronId, instructorId, date, time) VALUES (new.orderId, new.patronId, 1, new.orderDate, null);
  ELSEIF (new.priceTypeId = 'Repair') THEN
    INSERT into Repairs(repairId, technicianId, dateRecd, dateToReturn) VALUES (new.orderId, 1, new.orderDate, null);
  END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Patron`
--

CREATE TABLE IF NOT EXISTS `Patron` (
  `patronId` int(10) NOT NULL AUTO_INCREMENT,
  `patronName` varchar(255) NOT NULL,
  `patronAddress` varchar(255) DEFAULT NULL,
  `patronEmail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`patronId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `Patron`
--

INSERT INTO `Patron` (`patronId`, `patronName`, `patronAddress`, `patronEmail`) VALUES
(1, 'Joe Ritchie', '123 Retreating Rainbow Avenue', 'joeknows@gmail.com'),
(12, 'Joe George', '1001 eastview', 'ghddk@ndflsa.ned'),
(13, 'Dale Hawkins', '314 Pi Pkwy', 'gimmeeabreakdude@thafif.ned'),
(15, 'William Howard Taft', 'The Alley In Back', 'bathtubfun@gmail.com'),
(18, 'Young Buck and G-Unit', 'Ca$hville, Ten-A-Key, USA', 'buckenuf4ya@woah.com');

-- --------------------------------------------------------

--
-- Stand-in structure for view `patronOrderHistory`
--
CREATE TABLE IF NOT EXISTS `patronOrderHistory` (
`patronId` int(10)
,`patronName` varchar(255)
,`orderId` int(10)
,`orderDate` date
,`total` decimal(10,2)
,`priceTypeId` varchar(10)
);
-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE IF NOT EXISTS `Products` (
  `productId` int(10) NOT NULL AUTO_INCREMENT,
  `price` decimal(10,2) NOT NULL,
  `amountInStock` int(10) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`productId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`productId`, `price`, `amountInStock`, `description`) VALUES
(4, '2.75', 3000, '250 kOhm Potentiometer'),
(5, '10.00', 650, 'DR Strings Nickel .011'),
(6, '0.25', 280, '.060 Dunlop Pick'),
(8, '1600.00', 600, '1964 Fender Stratocaster');

-- --------------------------------------------------------

--
-- Stand-in structure for view `repairComplete`
--
CREATE TABLE IF NOT EXISTS `repairComplete` (
`repairId` int(10)
,`technicianName` varchar(255)
,`repairFinished(dateToReturn)` varchar(10)
);
-- --------------------------------------------------------

--
-- Table structure for table `Repairs`
--

CREATE TABLE IF NOT EXISTS `Repairs` (
  `repairId` int(10) NOT NULL AUTO_INCREMENT,
  `technicianId` int(10) NOT NULL,
  `dateRecd` date NOT NULL,
  `dateToReturn` date DEFAULT NULL,
  PRIMARY KEY (`repairId`),
  KEY `FKTechRepair` (`technicianId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `Repairs`
--

INSERT INTO `Repairs` (`repairId`, `technicianId`, `dateRecd`, `dateToReturn`) VALUES
(5, 2, '2013-02-23', '2013-05-06'),
(6, 2, '2015-12-23', '2016-01-15'),
(7, 3, '2013-02-23', '2015-03-28'),
(11, 3, '2015-05-05', '2015-05-07'),
(12, 5, '2013-02-23', '2013-02-26'),
(24, 2, '2015-11-22', '2015-11-22');

-- --------------------------------------------------------

--
-- Stand-in structure for view `technicianRepairHistory`
--
CREATE TABLE IF NOT EXISTS `technicianRepairHistory` (
`technicianId` int(10)
,`technicianName` varchar(255)
,`repairId` int(10)
,`dateRecd` date
,`dateToReturn` date
);
-- --------------------------------------------------------

--
-- Table structure for table `Technicians`
--

CREATE TABLE IF NOT EXISTS `Technicians` (
  `technicianId` int(10) NOT NULL AUTO_INCREMENT,
  `technicianName` varchar(255) NOT NULL,
  `technicianAddress` varchar(255) NOT NULL,
  `technicianPhone` char(9) DEFAULT NULL,
  PRIMARY KEY (`technicianId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Technicians`
--

INSERT INTO `Technicians` (`technicianId`, `technicianName`, `technicianAddress`, `technicianPhone`) VALUES
(1, 'DEFAULT TECHNICIAN', 'N/A', '000000000'),
(2, 'Tom Foolery', '1234 Round-The-Bend Rd.', '456987253'),
(3, 'George Gorgas', '18 YouShouldn''tKnow St.', '555-4682'),
(5, 'Millard Thrillmore', '1600 New Jersey Ave.', '800255777');

-- --------------------------------------------------------

--
-- Structure for view `orderLessons`
--
DROP TABLE IF EXISTS `orderLessons`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jakeh420`@`localhost` SQL SECURITY DEFINER VIEW `orderLessons` AS select `Orders`.`orderId` AS `orderId`,`Orders`.`patronId` AS `patronId`,`Orders`.`orderDate` AS `orderDate`,`Orders`.`total` AS `total`,`Orders`.`priceTypeId` AS `priceTypeId` from `Orders` where (`Orders`.`priceTypeId` = 'Lesson');

-- --------------------------------------------------------

--
-- Structure for view `orderProducts`
--
DROP TABLE IF EXISTS `orderProducts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jakeh420`@`localhost` SQL SECURITY DEFINER VIEW `orderProducts` AS select `Orders`.`orderId` AS `orderId`,`Orders`.`patronId` AS `patronId`,`Orders`.`orderDate` AS `orderDate`,`Orders`.`total` AS `total`,`Orders`.`priceTypeId` AS `priceTypeId` from `Orders` where (`Orders`.`priceTypeId` = 'Product');

-- --------------------------------------------------------

--
-- Structure for view `orderRepairs`
--
DROP TABLE IF EXISTS `orderRepairs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jakeh420`@`localhost` SQL SECURITY DEFINER VIEW `orderRepairs` AS select `Orders`.`orderId` AS `orderId`,`Orders`.`patronId` AS `patronId`,`Orders`.`orderDate` AS `orderDate`,`Orders`.`total` AS `total`,`Orders`.`priceTypeId` AS `priceTypeId` from `Orders` where (`Orders`.`priceTypeId` = 'Repair');

-- --------------------------------------------------------

--
-- Structure for view `patronOrderHistory`
--
DROP TABLE IF EXISTS `patronOrderHistory`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jakeh420`@`localhost` SQL SECURITY DEFINER VIEW `patronOrderHistory` AS select `Patron`.`patronId` AS `patronId`,`Patron`.`patronName` AS `patronName`,`Orders`.`orderId` AS `orderId`,`Orders`.`orderDate` AS `orderDate`,`Orders`.`total` AS `total`,`Orders`.`priceTypeId` AS `priceTypeId` from (`Patron` join `Orders`) where (`Patron`.`patronId` = `Orders`.`patronId`);

-- --------------------------------------------------------

--
-- Structure for view `repairComplete`
--
DROP TABLE IF EXISTS `repairComplete`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jakeh420`@`localhost` SQL SECURITY DEFINER VIEW `repairComplete` AS select `r1`.`repairId` AS `repairId`,`t1`.`technicianName` AS `technicianName`,`repairFinished`(`r1`.`dateToReturn`) AS `repairFinished(dateToReturn)` from (`Repairs` `r1` join `Technicians` `t1` on((`r1`.`technicianId` = `t1`.`technicianId`)));

-- --------------------------------------------------------

--
-- Structure for view `technicianRepairHistory`
--
DROP TABLE IF EXISTS `technicianRepairHistory`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jakeh420`@`localhost` SQL SECURITY DEFINER VIEW `technicianRepairHistory` AS select `Technicians`.`technicianId` AS `technicianId`,`Technicians`.`technicianName` AS `technicianName`,`Repairs`.`repairId` AS `repairId`,`Repairs`.`dateRecd` AS `dateRecd`,`Repairs`.`dateToReturn` AS `dateToReturn` from (`Technicians` join `Repairs`) where (`Technicians`.`technicianId` = `Repairs`.`technicianId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Lessons`
--
ALTER TABLE `Lessons`
  ADD CONSTRAINT `FKLessonsIstr` FOREIGN KEY (`instructorId`) REFERENCES `Instructors` (`instructorId`),
  ADD CONSTRAINT `FKLessonsPatron` FOREIGN KEY (`patronId`) REFERENCES `Patron` (`patronId`);

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `fk__lessonorders` FOREIGN KEY (`patronId`) REFERENCES `Patron` (`patronId`) ON DELETE CASCADE;

--
-- Constraints for table `Repairs`
--
ALTER TABLE `Repairs`
  ADD CONSTRAINT `FKTechRepair` FOREIGN KEY (`technicianId`) REFERENCES `Technicians` (`technicianId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
