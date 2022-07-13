-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2022 at 11:37 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webbylab_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `format` varchar(255) NOT NULL,
  `stars` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `year`, `format`, `stars`) VALUES
(1, 'Blazing Saddles', 1974, 'VHS', 's:82:\"Mel Brooks, Clevon Little, Harvey Korman, Gene Wilder, Slim Pickens, Madeline Kahn\";'),
(2, 'Casablanca', 1942, 'DVD', 's:58:\"Humphrey Bogart, Ingrid Bergman, Claude Rains, Peter Lorre\";'),
(3, 'Charade', 1953, 'DVD', 's:72:\"Audrey Hepburn, Cary Grant, Walter Matthau, James Coburn, George Kennedy\";'),
(4, 'Cool Hand Luke', 1967, 'VHS', 's:44:\"Paul Newman, George Kennedy, Strother Martin\";'),
(5, 'Butch Cassidy and the Sundance Kid', 1969, 'VHS', 's:43:\"Paul Newman, Robert Redford, Katherine Ross\";'),
(6, 'The Sting', 1973, 'DVD', 's:57:\"Robert Redford, Paul Newman, Robert Shaw, Charles Durning\";'),
(7, 'The Muppet Movie', 1979, 'DVD', 's:93:\"Jim Henson, Frank Oz, Dave Geolz, Mel Brooks, James Coburn, Charles Durning, Austin Pendleton\";'),
(8, 'Get Shorty ', 1995, 'DVD', 's:69:\"John Travolta, Danny DeVito, Renne Russo, Gene Hackman, Dennis Farina\";'),
(9, 'My Cousin Vinny', 1992, 'DVD', 's:82:\"Joe Pesci, Marrisa Tomei, Fred Gwynne, Austin Pendleton, Lane Smith, Ralph Macchio\";'),
(10, 'Gladiator', 2000, 'Blu-Ray', 's:46:\"Russell Crowe, Joaquin Phoenix, Connie Nielson\";'),
(11, 'Star Wars', 1977, 'Blu-Ray', 's:74:\"Harrison Ford, Mark Hamill, Carrie Fisher, Alec Guinness, James Earl Jones\";'),
(12, 'Raiders of the Lost Ark', 1981, 'DVD', 's:26:\"Harrison Ford, Karen Allen\";'),
(13, 'Serenity', 2005, 'Blu-Ray', 's:138:\"Nathan Fillion, Alan Tudyk, Adam Baldwin, Ron Glass, Jewel Staite, Gina Torres, Morena Baccarin, Sean Maher, Summer Glau, Chiwetel Ejiofor\";'),
(14, 'Hooisers', 1986, 'VHS', 's:44:\"Gene Hackman, Barbara Hershey, Dennis Hopper\";'),
(15, 'WarGames', 1983, 'VHS', 's:71:\"Matthew Broderick, Ally Sheedy, Dabney Coleman, John Wood, Barry Corbin\";'),
(16, 'Spaceballs', 1987, 'DVD', 's:78:\"Bill Pullman, John Candy, Mel Brooks, Rick Moranis, Daphne Zuniga, Joan Rivers\";'),
(17, 'Young Frankenstein', 1974, 'VHS', 's:64:\"Gene Wilder, Kenneth Mars, Terri Garr, Gene Hackman, Peter Boyle\";'),
(18, 'Real Genius', 1985, 'VHS', 's:59:\"Val Kilmer, Gabe Jarret, Michelle Meyrink, William Atherton\";'),
(19, 'Top Gun', 1986, 'DVD', 's:69:\"Tom Cruise, Kelly McGillis, Val Kilmer, Anthony Edwards, Tom Skerritt\";'),
(20, 'MASH', 1970, 'DVD', 's:77:\"Donald Sutherland, Elliot Gould, Tom Skerritt, Sally Kellerman, Robert Duvall\";'),
(21, 'The Russians Are Coming, The Russians Are Coming', 1966, 'VHS', 's:53:\"Carl Reiner, Eva Marie Saint, Alan Arkin, Brian Keith\";'),
(22, 'Jaws', 1975, 'DVD', 's:59:\"Roy Scheider, Robert Shaw, Richard Dreyfuss, Lorraine Gary \";'),
(23, '2001', 1968, 'DVD', 's:59:\"Keir Dullea, Gary Lockwood, William Sylvester, Douglas Rain\";'),
(24, 'Harvey', 1950, 'DVD', 's:55:\"James Stewart, Josephine Hull, Peggy Dow, Charles Drake\";'),
(25, 'Knocked Up', 2007, 'Blu-Ray', 's:51:\"Seth Rogen, Katherine Heigl, Paul Rudd, Leslie Mann\";');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$exs4wGyuN.LMpKBsaJcmYOJowRCZjOHrbgXNkO/OHEMKX9khRJG06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
