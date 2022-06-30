-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2016 at 06:51 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `SUBJ_ID` int(11) NOT NULL,
  `SUBJ_CODE` varchar(30) NOT NULL,
  `SUBJ_DESCRIPTION` varchar(255) NOT NULL,
  `UNIT` int(2) NOT NULL,
  `PRE_REQUISITE` varchar(30) NOT NULL DEFAULT 'None',
  `COURSE_ID` int(11) NOT NULL,
  `AY` varchar(30) NOT NULL,
  `SEMESTER` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`SUBJ_ID`, `SUBJ_CODE`, `SUBJ_DESCRIPTION`, `UNIT`, `PRE_REQUISITE`, `COURSE_ID`, `AY`, `SEMESTER`) VALUES
(500, 'Spiral Filipino', 'Filipino for Grade 7 - Spiral Filipino', 3, '', 47, '2013-2014', 'First'),
(501, 'Spiral English', 'English for Grade 7', 3, '', 47, '2013-2014', 'First'),
(502, 'Spiral Mathematics', 'Mathematics for Grade 7 - Spiral Math', 3, '', 47, '2013-2014', 'First'),
(503, 'Spiral Science', 'Science for Grade 7', 3, '', 47, '2013-2014', 'First'),
(504, 'Spiral T.L.E', 'T.L.E for Grade 7', 3, '', 47, '2013-2014', 'First'),
(505, 'Spiral A.P', 'Araling Panlipunan for Grade 7', 3, '', 47, '2013-2014', 'First'),
(506, 'Spiral Religion', 'rekligion for Grade 7', 3, '', 47, '2013-2014', 'First'),
(507, 'Spiral EsP.', 'EsP. for Grade 7', 3, '', 47, '2013-2014', 'First'),
(508, 'MAPEH', 'MAPEH for Grade 8 ', 3, '', 48, '2013-2014', 'First'),
(509, 'MAPEH', 'MAPEH for Grade 7', 3, '', 47, '2013-2014', 'First'),
(510, 'Religion', 'Religion for Grade 8', 3, '', 48, '2013-2014', 'First'),
(511, 'Spiral Filipino', 'Filipino for Grade 8 ', 3, '', 48, '2013-2014', 'First'),
(512, 'Spiral English', 'English for Grade 8', 3, '', 48, '2013-2014', 'First'),
(513, 'Spiral Mathematics', 'Mathematics for Grade 8 ', 3, '', 48, '2013-2014', 'First'),
(514, 'Spiral Science', 'Science for Grade ', 3, '', 48, '2013-2014', 'First'),
(515, 'Spiral T.L.E.', 'T.L.E for Grade 7 ', 3, '', 48, '2013-2014', 'First'),
(516, 'Spiral A.P.', 'Araling Panlipunan for Grade 8', 3, '', 48, '2013-2014', 'First'),
(517, 'Spiral EsP.', 'EsP. for Grade 7', 3, '', 48, '2013-2014', 'First'),
(518, 'Spiral Filipino', 'Filipino for Grade 9', 3, '', 49, '2013-2014', 'First'),
(519, 'Spiral English', 'English for Grade 9', 3, '', 49, '2013-2014', 'First'),
(520, 'Spiral Mathematics', 'Mathematics for Grade 9', 3, '', 49, '2013-2014', 'First'),
(521, 'Spiral Science', 'Science for Grade 9', 3, '', 49, '2013-2014', 'First'),
(522, 'Spiral A.P.', 'Araling Panlipunan for Grade 9', 3, '', 49, '2013-2014', 'First'),
(523, 'Spiral T.L.E.', 'T.L.E for Grade 9', 3, '', 49, '2013-2014', 'First'),
(524, 'Spiral MAPEH', 'MAPEH for Grade 9', 3, '', 49, '2013-2014', 'First'),
(525, 'Values Education', 'Values Education for Grade 9', 3, '', 49, '2013-2014', 'First'),
(526, 'Computer', 'Computer for grade 9', 3, '', 49, '2013-2014', 'First'),
(527, 'Religion IV', 'Religion for Grade 10', 3, '', 50, '2013-2014', 'First'),
(528, 'Spiral Filipino', 'Filipino for Grade 10', 3, '', 50, '2013-2014', 'First'),
(529, 'Spiral Mathematics', 'Mathematics for Grade 10', 3, '', 50, '2013-2014', 'First'),
(530, 'Spiral Science', 'Science for Grade 10', 3, '', 50, '2013-2014', 'First'),
(531, 'Spiral T.L.E.', 'T.L.E for Grade 10', 3, '', 50, '2013-2014', 'First'),
(532, 'Spiral MAPEH', 'MAPEH for Grade 10', 3, '', 50, '2013-2014', 'First'),
(533, 'Values Education', 'Values Education for Grade 10', 3, '', 50, '2013-2014', 'First'),
(534, 'CAT', 'Citizens Advancement Training', 3, '', 50, '2013-2014', 'First'),
(535, 'Computer', 'Computer for grade 10', 3, '', 50, '2013-2014', 'First'),
(536, 'hjgjhggh', 'gj', 3, '', 51, '2013-2014', 'First');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`SUBJ_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `SUBJ_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=537;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
