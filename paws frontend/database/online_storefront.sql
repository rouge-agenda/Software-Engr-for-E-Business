-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 26, 2025 at 07:29 PM
-- Server version: 5.7.24
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_storefront`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `custID` int(9) UNSIGNED NOT NULL,
  `fName` varchar(50) NOT NULL,
  `lName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zipcode` int(9) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custID`, `fName`, `lName`, `email`, `password`, `street`, `city`, `state`, `zipcode`, `phone`) VALUES
(80265, 'Racheal', 'Oili-Sinclair', 'bigpuppylux@gmail.com', '$2y$10$xKUPBDJBU/lPcvQX4GuWOukFrx8hS0I2bntgCpgUuuBmOAPh8CdL.', '4056 Howard Street', 'Grand Rapids', 'Michigan', 49505, '616-901-7639'),
(90234, 'Dilllon', 'Maldune', 'dmaldune39@yahoo.com', '$2y$10$I8zPK25GPoosziEcamq7xOKi7Smll/E.IZt4fy8/fEdZAK3Tz6oD2', '220 Upland Avenue', 'Lima', 'Ohio', 45801, '5673283585');

-- --------------------------------------------------------
--
-- Table structure for table `orderline`
--

CREATE TABLE `orderline` (
  `orderID` int(9) UNSIGNED NOT NULL,
  `productID` int(9) UNSIGNED NOT NULL,
  `quantity` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderline.`
--

INSERT INTO `orderline` (`orderID`, `productID`, `quantity`) VALUES
(1, 361, 1),
(1, 4928, 2),
(2, 9033, 1),
(4, 4747, 1),
(4, 8009, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(9) UNSIGNED NOT NULL,
  `custID` int(9) UNSIGNED NOT NULL,
  `orderdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `completed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `custID`, `orderdate`, `completed`) VALUES
(1, 90234, '2025-10-22 13:25:21', 1),
(2, 80265, '2025-10-24 06:33:11', 1),
(4, 80265, '2025-10-28 13:29:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(9) UNSIGNED NOT NULL,
  `productName` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(5,2) UNSIGNED NOT NULL,
  `category` int(1) NOT NULL COMMENT 'corresponds to toys -1,food -2, accessories -3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `description`, `price`, `category`) VALUES
(361, 'Salmon Oil Treats', 'Sustainable salmon oil treats for coat and\r\njoint health. 8-ounce bag. ', '15.00', 2),
(588, 'Insect Protein Kibble', 'Grain-free kibble with black soldier fly\r\nprotein. Eco-friendly protein source and\r\nideal for allergy-prone pets. 4-pound bag', '30.00', 2),
(2311, 'Herbal Calming Chews', 'Plant-based chews with chamomile for\r\nanxiety relief. Great for storm and\r\nfirework seasons. Package of 30 chews.\r\n', '18.00', 2),
(2488, 'Eco-Spin Disc', 'Recycled plastic disc for playing fetch. Has LED lights for nighttime play.', '20.00', 1),
(3759, 'Recycled Felt Bed', 'Orthopedic bed from sustainable\r\nmaterials. Machine-washable and blends\r\ninto home décor. Orthopedic support\r\nthat is ideal for senior pets.\r\n', '50.00', 3),
(4551, 'Memory Agility Cube', 'Stackable wooden cubes with touch pads that dispenses treats. Great brain booster for senior pets.', '30.00', 1),
(4747, 'Recycled ID Tag\r\n', 'Identification tag from recycled metal for\r\ndogs and cats. Sustainable and durable\r\nfor daily wear.\r\n', '10.00', 3),
(4928, 'Allergy Shield Kibble', 'Hypoallergenic dry food with duck and\r\nquinoa. Includes probiotics for gut health. 5 pound bag.\r\n', '25.00', 2),
(5696, 'GeoFence Collar', 'Solar-charged GPS collar. App tracks\r\nactivity and sleep. Solar-charged and\r\nintegrates with smart home devices.\r\n', '45.00', 3),
(5882, 'Coconut Bowl Feeder\r\n', 'Hand-carved coconut shell bowl on\r\nbamboo stand. Non-tip design for messy\r\neaters.\r\n', '22.00', 3),
(8009, 'Pumpkin Puree Cups', 'Organic pumpkin for digestion support in\r\ndogs and cats. Natural digestive aid that is popular for pets with sensitive stomachs. Package of 4 cups.\r\n', '12.00', 2),
(8406, 'SootheStep Booties\r\n', 'Grippy silicone booties. Protects from hot\r\nandcold surfaces. Stylish urban paw\r\nprotection. Set of 4 booties.', '18.00', 3),
(9033, 'Snuffle Puzzle Mat', 'Textured mat with hidden treat pockets. Made from recycled ocean plastic. Great for mental stimulation. Includes app to track pet progress.', '25.00', 1),
(9820, 'Smart Tease Wand', 'Rechargeable wand for cat play. Motion-sensor tech engages cats.', '25.00', 1),
(9821, 'Bubble Chase Launcher', 'Battery-powered bubble launcher with unscented bubbles. Promotes exercise.', '35.00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`custID`);

--
-- Indexes for table `orderline`
--
ALTER TABLE `orderline`
  ADD PRIMARY KEY (`orderID`,`productID`) USING BTREE,
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `custID` (`custID`) USING BTREE;

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `custID` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90235;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9822;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderline`
--
ALTER TABLE `orderline`
  ADD CONSTRAINT `orderline_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderline_ibfk_2` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`custID`) REFERENCES `customer` (`custID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
