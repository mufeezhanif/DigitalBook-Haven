-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2023 at 04:01 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebooks`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `itemname` varchar(60) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `image` varchar(600) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `compa`
--

CREATE TABLE `compa` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(155) DEFAULT NULL,
  `contact` int(11) DEFAULT NULL,
  `subjects` varchar(50) DEFAULT NULL,
  `topicname` varchar(254) DEFAULT NULL,
  `filename` varchar(500) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `compkids`
--

CREATE TABLE `compkids` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(155) DEFAULT NULL,
  `contact` int(11) DEFAULT NULL,
  `topicname` varchar(244) DEFAULT NULL,
  `filename` longtext DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `commentid` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `useremail` varchar(255) DEFAULT NULL,
  `suggestion` varchar(255) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `method` varchar(60) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `total_products` varchar(1500) NOT NULL,
  `total_price` int(11) NOT NULL,
  `placed_on` varchar(255) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `card_name` varchar(100) DEFAULT NULL,
  `card_number` int(11) DEFAULT NULL,
  `exp_month` varchar(160) DEFAULT NULL,
  `exp_year` int(11) DEFAULT NULL,
  `cvv` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(122) NOT NULL,
  `author` varchar(122) NOT NULL,
  `description` mediumtext NOT NULL,
  `price` int(40) NOT NULL,
  `imgname` mediumtext NOT NULL,
  `p_id` int(11) NOT NULL,
  `filename` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `name`, `category`, `author`, `description`, `price`, `imgname`, `p_id`, `filename`) VALUES
(27, 'A Reader’s Guide to Contemporary Literary Theory', 'literature', 'Peter Brooker', 'A Reader’s Guide to Contemporary\r\nLiterary Theory (1985) now appears in a new fifth edition. Some\r\nlittle while after revising the second edition in 1989, Raman prematurely\r\nand tragically died of a brain tumour. He was much loved and highly\r\nrespected – not least for the remarkable achievement of producing a short,\r\nclear, informative and unpolemical volume on a diverse and difficult\r\nsubject. A third edition appeared in 1993, brought up-to-date by Peter\r\nWiddowson, and in 1997 he was joined by Peter Brooker in an extensive\r\nreworking of the fourth edition (debts to other advisers who assisted them\r\non those occasions are acknowledged in previous Prefaces). Now, in 2005,\r\nand as witness to its continuing success and popularity, the moment for\r\nfurther revision of A Reader’s Guide has arrived once more.\r\nTwenty years is a long time in contemporary literary theory, and the\r\nterrain, not surprisingly, has undergone substantial change since Raman\r\nSelden first traversed it. As early as the third edition, it was noted that, in\r\nthe nature of things, the volume was beginning to have two rather more\r\nclearly identifiable functions than it had when the project was initiated.\r\nThe earlier chapters were taking on a historical cast in outlining movements\r\nfrom which newer developments had received their impetus but had then\r\nsuperseded, while the later ones attempted to take stock of precisely those\r\nnewer developments, to mark out the coordinates of where we live and\r\npractise theory and criticism now. This tendency was strengthened in the\r\nreordering and restructuring of the fourth edition, and the present version\r\ncontinues to reflect it, so that the last five chapters – including a new concluding one on what it might mean to be ‘Post-Theory’ – now comprise\r\nhalf the book. The Introduction reflects, amongst other things, on the issues\r\nwhich lie behind the current revisions,', 14, '1989683125Capture.JPG', 48, '1989683125contemporary-literary-theory-5th-edition.pdf'),
(28, 'The Other History of DC Universe', 'comic', 'ANDREA CUCCHI', 'THE OTHER HISTORY OF THE DC UNIVERSE #1 4\r\nPUNCHLINE SPECIAL #1 7\r\nSTRANGE ADVENTURES\r\nDIRECTOR’S CUT #1 24\r\nAcademy Award-winning screenwriter John Ridley examines the\r\nmythology of the DC Universe in a compelling new miniseries that\r\nreframes the iconic moments of DC history as seen through the eyes of\r\nDC super heroes who come from traditionally disenfranchised groups.\r\nFrom the pages of “The Joker War,” it’s the first solo adventure of\r\nPunchline. Learn how teenage Alexis Kaye became radicalized by a\r\nmadman!', 24, '697297467Capture.JPG', 48, '697297467Reading Graphically_ Comics and Graphic Novels for Readers from K.pdf'),
(29, 'Captain America', 'novel', 'Someone', 'Captain America was the first Marvel Comics character adapted into another medium\r\nwith the release of the 1944 movie serial Captain America. Since then, the character\r\nhas been featured in several other films and television series, including Chris Evans in\r\n2011’s Captain America and The Avengers in 2012. ', 10, '860628744dhfdsf.JPG', 48, '860628744Reading Graphically_ Comics and Graphic Novels for Readers from K.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `review` longtext DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `username`, `email`, `review`, `user_id`, `pid`) VALUES
(1, 'Mufeez', 'mufeez.hanif123@gmail.com', 'Such a nice Comic, ', 46, 28),
(2, 'John', 'mufeez.hanif123@gmail.com', 'I would love to read it 100 times, it is a great guide to read literature ', 46, 27);

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `usercontact` varchar(255) DEFAULT NULL,
  `useremail` varchar(255) DEFAULT NULL,
  `userpassword` varchar(255) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`userid`, `username`, `usercontact`, `useremail`, `userpassword`, `gender`, `user_type`) VALUES
(46, 'Muhammad Mufeez Hanif', '03182993401', 'mufeez.hanif123@gmail.com', '12', 'Male', 'user'),
(47, 'Admin', '031245789687', 'admin@abc.com', '12', 'Male', 'admin'),
(48, 'Publisher', '03215698936', 'publisher@abc.com', '12', 'Male', 'publisher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compa`
--
ALTER TABLE `compa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compkids`
--
ALTER TABLE `compkids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`commentid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `compa`
--
ALTER TABLE `compa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `compkids`
--
ALTER TABLE `compkids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `commentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1011;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `userdata` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
