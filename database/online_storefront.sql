-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 27, 2025 at 10:57 PM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

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
  `custID` int UNSIGNED NOT NULL,
  `fName` varchar(50) NOT NULL,
  `lName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zipcode` int NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custID`, `fName`, `lName`, `email`, `password`, `street`, `city`, `state`, `zipcode`, `phone`) VALUES
(80265, 'Racheal', 'Oili-Sinclair', 'bigpuppylux@gmail.com', 'Ilovemydog123', '4056 Howard Street', 'Grand Rapids', 'Michigan', 49505, '616-901-7639'),
(90234, 'Dilllon', 'Maldune', 'dmaldune39@yahoo.com', '$^xxjicats', '220 Upland Avenue', 'Lima', 'Ohio', 45801, '5673283585'),
(90235, 'test', 'test', 'test@test.com', 'test', 'testaddress', 'testcity', 'teststate', 0, 'testphone');

-- --------------------------------------------------------

--
-- Table structure for table `orderline`
--

CREATE TABLE `orderline` (
  `orderID` int UNSIGNED NOT NULL,
  `productID` int UNSIGNED NOT NULL,
  `quantity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int UNSIGNED NOT NULL,
  `custID` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int UNSIGNED NOT NULL,
  `productName` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(5,2) UNSIGNED NOT NULL,
  `category` int NOT NULL COMMENT 'corresponds to toys -1,food -2, accessories -3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `description`, `price`, `category`) VALUES
(361, 'Salmon Oil Treats', 'Sustainable salmon oil treats for coat and\r\njoint health. 8-ounce bag. ', 15.00, 2),
(588, 'Insect Protein Kibble', 'Grain-free kibble with black soldier fly\r\nprotein. Eco-friendly protein source and\r\nideal for allergy-prone pets. 4-pound bag', 30.00, 2),
(2311, 'Herbal Calming Chews', 'Plant-based chews with chamomile for\r\nanxiety relief. Great for storm and\r\nfirework seasons. Package of 30 chews.\r\n', 18.00, 2),
(2488, 'Eco-Spin Disc', 'Recycled plastic disc for fetch play. LED lights enhance nighttime fetch.', 20.00, 1),
(3759, 'Recycled Felt Bed', 'Orthopedic bed from sustainable\r\nmaterials. Machine-washable and blends\r\ninto home décor. Orthopedic support\r\nthat is ideal for senior pets.\r\n', 50.00, 3),
(4551, 'Memory Agility Cube', 'Stackable wooden cubes with touch-sensitive pads that dispenses treats when pawed in sequence. Brain-boosting for senior pets.', 30.00, 1),
(4747, 'Recycled ID Tag\r\n', 'Identification tag from recycled metal for\r\ndogs and cats. Sustainable and durable\r\nfor daily wear.\r\n', 10.00, 3),
(4928, 'Allergy Shield Kibble', 'Hypoallergenic dry food with duck and\r\nquinoa. Includes probiotics for gut health. 5 pound bag.\r\n', 25.00, 2),
(5696, 'GeoFence Collar', 'Solar-charged GPS collar. App tracks\r\nactivity and sleep. Solar-charged and\r\nintegrates with smart home devices.\r\n', 45.00, 3),
(5882, 'Coconut Bowl Feeder\r\n', 'Hand-carved coconut shell bowl on\r\nbamboo stand. Non-tip design for messy\r\neaters.\r\n', 22.00, 3),
(8009, 'Pumpkin Puree Cups', 'Organic pumpkin for digestion support in\r\ndogs and cats. Natural digestive aid that is popular for pets with sensitive stomachs. Package of 4 cups.\r\n', 12.00, 2),
(8406, 'SootheStep Booties\r\n', 'Grippy silicone booties. Protects from hot\r\nandcold surfaces. Stylish urban paw\r\nprotection. Set of 4 booties.', 18.00, 3),
(9033, 'Snuffle Puzzle Mat', 'Textured mat with hidden treat pockets for foraging. Made from recycled ocean plastic. Combines mental stimulation with eco-materials. App integration tracks pet progress.', 25.00, 1),
(9820, 'Smart Tease Wand', 'Rechargeable wand for cat play. Motion-sensor tech engages cats.', 25.00, 1),
(9821, 'Bubble Chase Launcher', 'Battery-powered bubble launcher with unscented bubbles. Promotes exercise.', 35.00, 1);

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
  ADD UNIQUE KEY `custID` (`custID`);

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
  MODIFY `custID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90236;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9822;

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
