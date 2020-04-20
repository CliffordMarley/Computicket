-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2019 at 01:34 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `computicket_db_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `boundary`
--

CREATE TABLE `boundary` (
  `boundary_id` int(11) NOT NULL,
  `boundary` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `boundary`
--

INSERT INTO `boundary` (`boundary_id`, `boundary`) VALUES
(1, 'International'),
(2, 'Local'),
(3, 'Both');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(200) NOT NULL,
  `manufacturer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `bus_id` varchar(10) NOT NULL,
  `type` enum('minibus','coaster','coach','double decker') NOT NULL,
  `num_seats` int(11) NOT NULL,
  `description` varchar(254) NOT NULL,
  `image` varchar(200) NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `company` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`bus_id`, `type`, `num_seats`, `description`, `image`, `stamp`, `company`) VALUES
('BT 3674', 'coach', 65, '', '', '2019-07-09 11:36:47', 'TVC3335'),
('DZ 8976', 'minibus', 16, '', '', '2019-07-10 09:23:58', 'TVC6746'),
('DZ 9865', 'minibus', 16, '', '', '2019-07-10 09:23:46', 'TVC6746'),
('KU 8498', 'minibus', 16, '', '', '2019-07-10 11:53:47', 'TVC3335'),
('KU 8765', 'coaster', 44, '', '', '2019-07-09 11:46:58', 'TVC1145'),
('LL 8745', 'coach', 65, '', '', '2019-07-09 11:47:42', 'TVC9759'),
('LL78600', 'coach', 65, '', '', '2019-07-09 11:35:52', 'TVC3335'),
('LL786267', 'coach', 65, '', '', '2019-07-09 11:33:59', 'TVC3335'),
('LL88598', 'coach', 0, 'Blue and White, 4 Wheel Drive', '', '2019-07-09 11:30:46', 'TVC3335'),
('LL89895', 'coach', 65, '', '', '2019-07-09 11:33:11', 'TVC3335'),
('LL9580', 'coach', 0, 'Black Top and Yellow Bottom, 4 Wheel Drive', '', '2019-07-09 11:31:55', 'TVC3335'),
('MHG 78329', 'coaster', 43, 'N/A', '', '2019-07-09 11:37:52', 'TVC9759'),
('MZ7844', 'coach', 65, '', '', '2019-07-10 19:40:49', 'TVC9759'),
('ZA 5665', 'coaster', 44, '', '', '2019-07-09 11:40:15', 'TVC1145'),
('ZA 5667', 'coaster', 44, '', '', '2019-07-09 11:42:40', 'TVC1145');

-- --------------------------------------------------------

--
-- Table structure for table `bus_reservation`
--

CREATE TABLE `bus_reservation` (
  `reservation_id` varchar(20) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `email_address` varchar(40) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `status` enum('Pending','Enroute','Fullfiled','Cancelled','Postponed') NOT NULL,
  `payment` enum('Pending','Paid','Exempted') NOT NULL,
  `seats_reserved` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `trip_id` int(11) DEFAULT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus_reservation`
--

INSERT INTO `bus_reservation` (`reservation_id`, `customer_name`, `email_address`, `phone_number`, `status`, `payment`, `seats_reserved`, `amount`, `trip_id`, `stamp`) VALUES
('BRID-1377', 'Clifford Mwale', 'cliffmwale97@gmail.com', '+265 88 518 005', 'Pending', 'Pending', 5, '9000', 21, '2019-07-12 08:19:18'),
('BRID-1804', 'Gift Sowoya', 'gift@computicket.mw', '+265 88 678 67 ', 'Pending', 'Pending', 3, '7500', 19, '2019-07-12 23:35:37'),
('BRID-1931', 'Clifford Mwale', 'cliffmwale97@gmail.com', '+265 88 518 005', 'Pending', 'Pending', 5, '9000', 21, '2019-07-12 08:20:26'),
('BRID-2016', 'Clifford Mwale', 'cliffmwale97@gmail.com', '+265 88 518 005', 'Pending', 'Pending', 1, '7000', 20, '2019-07-12 08:41:25'),
('BRID-2088', 'Clifford Mwale', 'cliffmwale97@gmail.com', '+265 88 518 005', 'Pending', 'Pending', 1, '7000', 20, '2019-07-12 08:45:52'),
('BRID-2308', 'Angello marco', 'angello@gmail.com', '+3 454 87287 83', 'Pending', 'Pending', 13, '91000', 20, '2019-07-12 13:10:58'),
('BRID-3902', 'Clifford Mwale', 'cliffmwale97@gmail.com', '+265 88 518 005', 'Pending', 'Pending', 5, '9000', 21, '2019-07-12 08:22:49'),
('BRID-3930', 'Clifford Mwale', 'cliffmwale97@gmail.com', '+265 88 518 005', 'Pending', 'Pending', 5, '35000', 20, '2019-07-12 08:23:02'),
('BRID-4266', 'Clifford Mwale', 'cliffmwale97@gmail.com', '+265 88 518 005', 'Pending', 'Pending', 5, '9000', 21, '2019-07-12 08:19:44'),
('BRID-5068', 'Mary Jean', 'maryjean@ymail.com', '+1 5726 68686 8', 'Pending', 'Pending', 3, '10500', 17, '2019-07-12 23:43:59'),
('BRID-5505', 'Stanislaus Sakwiya Jnr', 'stanislaussakwiyajnr@gmail.com', '+265 99 428 229', 'Pending', 'Pending', 2, '7000', 17, '2019-07-12 08:33:35'),
('BRID-5752', 'Katherine', 'kathy@gmail.com', '+265 99 4 78287', 'Pending', 'Pending', 12, '48000', 23, '2019-07-12 12:59:41'),
('BRID-6949', 'Clifford Mwale', 'cliffmwale97@gmail.com', '+265 88 518 005', 'Pending', 'Pending', 5, '9000', 21, '2019-07-12 08:19:11'),
('BRID-7246', 'Linda Mwale', 'lindamwale@gmail.com', '+265 99 388 239', 'Pending', 'Pending', 4, '7200', 21, '2019-07-12 21:40:50'),
('BRID-7271', 'Gift Sowoya', 'giftsowoya@computicket..mw', '+265 99 178 767', 'Pending', 'Pending', 5, '12500', 18, '2019-07-12 08:36:11'),
('BRID-7736', 'Cliffor', 'cliff@gmail.com', '+265 88 518 006', 'Pending', 'Pending', 1, '2500', 18, '2019-07-12 08:43:45'),
('BRID-7768', 'Clifford Mwale', 'cliffmwale97@gmail.com', '+265 88 518 005', 'Pending', 'Pending', 5, '9000', 21, '2019-07-12 08:22:20'),
('BRID-7780', 'Jane Ansah', 'janeansah@gmail.com', '+265 88 45 676 ', 'Pending', 'Pending', 4, '28000', 20, '2019-07-12 22:50:45'),
('BRID-8043', 'Clifford Mwale', 'cliffmwale97@gmail.com', '+265 88 518 005', 'Pending', 'Pending', 5, '9000', 21, '2019-07-12 08:21:31'),
('BRID-8354', 'Clifford Mwale', 'cliffmwale97@gmail.com', '+265 88 518 005', 'Pending', 'Pending', 3, '10500', 17, '2019-07-12 09:01:13'),
('BRID-8358', 'Susan Kamwendo', 'susamkamzy@gmail.com', '+265 99 456 986', 'Pending', 'Pending', 6, '42000', 20, '2019-07-12 08:23:58'),
('BRID-8822', 'Stanislaus Sakwiya', 'stanislaussakwiyajnr@gmail.com', '+265 99 428 229', 'Pending', 'Pending', 6, '42000', 20, '2019-07-12 08:32:28'),
('BRID-8834', 'Clifford Mwale', 'cliffmwale97@gmail.com', '+265 88 518 005', 'Pending', 'Pending', 5, '9000', 21, '2019-07-12 08:21:30'),
('BRID-9307', 'Clifford Mwale', 'cliffmwale97@gmail.com', '+265 88 518 005', 'Pending', 'Pending', 1, '2500', 18, '2019-07-12 08:42:26'),
('BRID-9997', 'Solomon Mwale', 'timkay@gmail.com', '+265 88 675 656', 'Pending', 'Pending', 1, '1800', 21, '2019-07-12 10:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `car_id` int(11) NOT NULL,
  `car_name` varchar(200) NOT NULL,
  `make` year(4) NOT NULL,
  `company` varchar(15) NOT NULL,
  `brand` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `unit` enum('Hour','Day','Week','Month') NOT NULL,
  `image_url` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `company_id` varchar(15) NOT NULL,
  `boundary` int(11) NOT NULL,
  `company_name` varchar(40) NOT NULL,
  `email_address` varchar(40) DEFAULT NULL,
  `phone` varchar(40) NOT NULL,
  `phy_address` varchar(40) DEFAULT NULL,
  `user_name` varchar(40) DEFAULT NULL,
  `authentication` varchar(40) DEFAULT NULL,
  `logo` varchar(40) DEFAULT NULL,
  `indulstry` int(11) NOT NULL,
  `status` enum('Active','Inactive','Suspended','Deleted') NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_details`
--

INSERT INTO `company_details` (`company_id`, `boundary`, `company_name`, `email_address`, `phone`, `phy_address`, `user_name`, `authentication`, `logo`, `indulstry`, `status`, `stamp`) VALUES
('ACC1663', 1, 'Sunbird Hotel', 'info@sunbirdhotel.mw', '+265 1779279397', 'Area 12, LL, Malawi', NULL, NULL, NULL, 2, 'Deleted', '2019-07-12 12:06:19'),
('ACC7504', 1, 'Splendors Hotel', 'info@splendor.mw', '+265 1 223 4456', 'Old Naisi, Zomba, MW', NULL, NULL, NULL, 2, 'Active', '2019-07-09 08:45:15'),
('ACC8775', 1, 'Cross Roads Hotels', 'desk@crossroadshotel.mw', '+265 127 787 7875', 'Area 3 Round About, LL, MW', NULL, NULL, NULL, 2, 'Active', '2019-07-09 01:20:09'),
('ACC9267', 1, 'Golden Peacock Hotel', 'enquiry@goldenpc.mw', '+265 1 456 6677', 'Area 13, City Center, LL, Malawi', NULL, NULL, NULL, 2, 'Active', '2019-07-07 08:49:59'),
('CRH4003', 1, 'Avis Car Hire', 'infodesk@aviscarhire.com', '+2651 684 8467', ' Area 3, LL, Malaw', NULL, NULL, NULL, 3, 'Deleted', '2019-07-12 12:07:43'),
('CRH5075', 1, 'Apex Car Hire', 'apex@apexcarhire.mw', '+2654578678', 'Libe, Blantyre, MW', NULL, NULL, NULL, 3, 'Active', '2019-07-08 20:34:34'),
('CRH9480', 1, 'Premier Car Hire', 'info@premierch.mw', '+26588 567 6756', 'Chinsapo 2, LL, MW', NULL, NULL, NULL, 3, 'Active', '2019-07-07 08:50:45'),
('TVC1145', 1, 'Errand Nation', 'info@erandnation.mw', '+2659987687756', 'Chilomoni, Blantyre, MW', NULL, NULL, NULL, 1, 'Active', '2019-07-08 05:19:14'),
('TVC3335', 1, 'City Tours And Travel', 'info@citytour.mw', '+26573668368', 'Area 3, LL, MW', NULL, NULL, NULL, 1, 'Active', '2019-07-07 07:50:55'),
('TVC6746', 1, 'ORAMA Travels', 'admin@admin.com', '09765554', 'Mchinji', NULL, NULL, NULL, 1, 'Active', '2019-07-12 08:00:57'),
('TVC6786', 1, 'JV-Class Travels', 'info@jvclass.mw', '+265 88 518 0058', 'Plot 1446, Area 22/A, LL , MW', NULL, NULL, NULL, 1, 'Active', '2019-07-10 09:28:49'),
('TVC7122', 1, 'National Bus Company', 'desk@bncservice.mw', '+26573848779', 'Zalewa, Blantyre, Malawi', NULL, NULL, NULL, 1, 'Active', '2019-07-07 06:36:44'),
('TVC9232', 1, 'UDK Bus Company', 'infodesk@udkbuses.mw', '+265 88 678 6787', 'MAlisa, Zomba, MW', NULL, NULL, NULL, 1, 'Active', '2019-07-10 11:39:45'),
('TVC9759', 1, 'SOSOSO Tours', 'sososo@simama.com', '+2659898948989', 'Area 21, Falls Estate, LL, MW', NULL, NULL, NULL, 1, 'Active', '2019-07-07 08:51:27');

-- --------------------------------------------------------

--
-- Table structure for table `computicket_staff`
--

CREATE TABLE `computicket_staff` (
  `employee_id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `pass_key` varchar(100) NOT NULL,
  `f_name` varchar(40) NOT NULL,
  `m_name` varchar(30) DEFAULT NULL,
  `l_name` varchar(40) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `address` varchar(200) NOT NULL,
  `role` int(2) NOT NULL,
  `position` varchar(50) NOT NULL,
  `status` enum('Active','Suspended','Deleted','Deactivated','Unconfirmed') NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `computicket_staff`
--

INSERT INTO `computicket_staff` (`employee_id`, `username`, `pass_key`, `f_name`, `m_name`, `l_name`, `phone_number`, `address`, `role`, `position`, `status`, `stamp`) VALUES
(1, 'cliffmwale97@gmail.com', '1234', 'Clifford', NULL, 'Mwale', '+265 88 518 005', 'Plot 1446, Area 22/A, LL. MW', 2, 'System Engineer', 'Active', '2019-07-09 08:04:52'),
(2, 'stansakwiya@gmail.com', '4321', 'Stanislaus', 'George', 'Sakwiya', '0994282291', 'Area 22/A, LL, MW', 1, 'Software Solutions Engineer', 'Active', '2019-07-12 11:07:37');

-- --------------------------------------------------------

--
-- Table structure for table `customer_registry`
--

CREATE TABLE `customer_registry` (
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `onames` varchar(120) NOT NULL,
  `gender` varchar(40) NOT NULL,
  `dob` datetime NOT NULL,
  `contact` varchar(100) NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `depot`
--

CREATE TABLE `depot` (
  `depot_id` int(11) NOT NULL,
  `depot_name` varchar(30) NOT NULL,
  `district` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`district_id`, `district_name`) VALUES
(1, 'BALAKA'),
(2, 'BLANTYRE'),
(3, 'CHITIPA'),
(4, 'CHIKHWAWA'),
(5, 'DEDZA'),
(6, 'DOWA'),
(7, 'KASUNGU'),
(8, 'KARONGA'),
(9, 'LILONGWE'),
(10, 'LIKOMA'),
(11, 'MACHINGA'),
(12, 'MANGOCHI'),
(13, 'MULANJE'),
(14, 'NKHATABAY'),
(15, 'NKHOTAKOTA'),
(16, 'NSANJE'),
(17, 'NENO'),
(18, 'PHALOMBE'),
(19, 'RUMPHI'),
(20, 'MZIMBA'),
(21, 'MZUZU'),
(22, 'MCHINJI'),
(23, 'THYOLO'),
(24, 'SALIMA'),
(25, 'ZOMBA'),
(26, 'NTCHISI'),
(27, 'NTCHEU');

-- --------------------------------------------------------

--
-- Table structure for table `hiring_data`
--

CREATE TABLE `hiring_data` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(254) NOT NULL,
  `pickup_point` varchar(254) NOT NULL,
  `payment` enum('Paid','Pending') NOT NULL,
  `discount_percentage` int(11) NOT NULL,
  `car` int(11) NOT NULL,
  `hire_status` enum('Pending','Car_With_Customer','Car_Delivered','Cancelled') NOT NULL,
  `comment` text NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `hotel_id` varchar(40) NOT NULL,
  `domain` varchar(15) NOT NULL,
  `hotel_name` varchar(40) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` varchar(40) DEFAULT NULL,
  `district` int(11) NOT NULL,
  `phy_address` varchar(200) NOT NULL,
  `status` varchar(15) NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `desc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotel_id`, `domain`, `hotel_name`, `email`, `phone`, `district`, `phy_address`, `status`, `stamp`, `desc`) VALUES
('.5d23beec17b934.78273279', 'ACC1663', 'Mount Sochie', 'info@sunbirdhotel.mw', '+265 99 428 2291', 2, '2<sup>nd</sup> Edward Road, Sochie, Blantyre', 'Active', '2019-07-09 01:26:35', NULL),
('.5d23bf7b4d7e71.37824351', 'ACC1663', 'Ku Chawe', 'info@sunbirdhotel.mw', '+265 99 577 7879', 25, 'Chawe, Zomba Plateau, Zomba ', 'Active', '2019-07-09 01:14:28', NULL),
('.5d23cdb017f3e3.37693185', 'ACC9267', 'Golden Peacock Hotel', 'info@gpchotel.mw', '+265 99 899 9076', 9, 'Area 13, LL, MW', 'Active', '2019-07-09 01:12:37', NULL),
('.5d23ce13e7f909.80020971', 'ACC7504', 'Platnum Hotel', 'help@platnumhotel.com', '+265 88 748 6647', 7, 'Nthimba, T/A Chamama, KU, MW', 'Active', '2019-07-09 01:27:19', NULL),
('.5d23e6fe613123.68805609', 'ACC1663', 'Nkopola Lodge', 'info@sunbirdhotel.mw', '+265 17 792 7939', 24, 'Nkopola, Salima, MW', 'Active', '2019-07-09 01:25:15', NULL),
('.5d23ec280cfc26.37374627', 'ACC8775', 'Cross Roads hotel Lilongwe', 'desk@crossroadshotel.mw', '+265 18 989 7880', 9, 'Area 3 Round About, LL, MW', 'Active', '2019-07-09 01:21:44', NULL),
('.5d23ec709a08f8.08310350', 'ACC8775', 'Cross Roads hotel Blantre', 'enquiry@crossroadshotel.mw', '+265 16 785 6733', 2, 'Blantyre Town, Along Chipembele Highway, BT, MW', 'Active', '2019-07-09 01:22:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hotelreservation`
--

CREATE TABLE `hotelreservation` (
  `ref_id` varchar(15) NOT NULL,
  `number_of_people` int(11) NOT NULL,
  `guest_list` text NOT NULL,
  `email_address` varchar(40) DEFAULT NULL,
  `phone_number` varchar(40) DEFAULT NULL,
  `checkin` date NOT NULL,
  `chechout` date NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment` text,
  `status` enum('checkedin','checkedout','cancelled','postponed') NOT NULL,
  `hotel_id` varchar(40) NOT NULL,
  `room_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `indulstry`
--

CREATE TABLE `indulstry` (
  `indulstry_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indulstry`
--

INSERT INTO `indulstry` (`indulstry_id`, `name`) VALUES
(1, 'Travel'),
(2, 'Accommodation'),
(3, 'Car Rentals'),
(4, 'Events Management');

-- --------------------------------------------------------

--
-- Table structure for table `mailing_list`
--

CREATE TABLE `mailing_list` (
  `id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mailing_list`
--

INSERT INTO `mailing_list` (`id`, `email`) VALUES
(0, 'cliffmwale97@gmail.com'),
(0, 'elaniveh@gmail.com'),
(0, 'ele@ymail.com'),
(0, 'malinga@gmail.com'),
(0, 'mwalepemphero@gmail.com'),
(0, 'rosemary@computicket.mw'),
(0, 'stansakwiya@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `mnf_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `method_id` int(11) NOT NULL,
  `method_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_type` int(11) NOT NULL,
  `room_number` varchar(15) NOT NULL,
  `desc` text,
  `floor` int(11) DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `hotel_id` varchar(40) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `status` enum('Available','Unavailable') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roomtype`
--

CREATE TABLE `roomtype` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(40) NOT NULL,
  `desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_logs`
--
-- Error reading structure for table computicket_db_main.transaction_logs: #1932 - Table 'computicket_db_main.transaction_logs' doesn't exist in engine
-- Error reading data for table computicket_db_main.transaction_logs: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `computicket_db_main`.`transaction_logs`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `trip_id` int(11) NOT NULL,
  `route` varchar(254) NOT NULL,
  `departure_date` date NOT NULL,
  `departure_time` time NOT NULL,
  `arrival_time` time NOT NULL,
  `lapse` int(11) NOT NULL,
  `status` varchar(40) NOT NULL,
  `bus_id` varchar(10) NOT NULL,
  `avail_seats` int(11) NOT NULL,
  `_price` decimal(10,0) NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `origin` int(11) DEFAULT NULL,
  `destination` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`trip_id`, `route`, `departure_date`, `departure_time`, `arrival_time`, `lapse`, `status`, `bus_id`, `avail_seats`, `_price`, `stamp`, `origin`, `destination`) VALUES
(17, 'KU-LL', '2019-07-25', '12:00:00', '15:00:00', 30000, 'Pending', 'ZA 5667', 36, '3500', '2019-07-12 23:43:59', 7, 9),
(18, 'MC-LL', '2019-07-25', '08:30:00', '10:30:00', 20000, 'Pending', 'DZ 9865', 6, '2500', '2019-07-12 22:46:42', 22, 9),
(19, 'LL-MC', '2019-07-26', '10:00:00', '12:00:00', 20000, 'Pending', 'DZ 9865', 13, '2500', '2019-07-12 23:35:37', 9, 22),
(20, 'LL-DZ-NU-BLK-BT', '2019-07-10', '21:00:00', '02:00:00', 60000, 'Pending', 'LL78600', 29, '7000', '2019-07-12 22:50:45', 9, 2),
(21, 'CH-NYIKA-MZ', '2019-07-03', '06:00:00', '08:00:00', 20000, 'Pending', 'LL 8745', 55, '1800', '2019-07-12 21:40:50', 3, 21),
(23, 'BT-BLK-NU-DZ', '2019-08-01', '12:00:00', '18:00:00', 40000, 'Pending', 'DZ 8976', 4, '4000', '2019-07-12 12:59:41', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` int(11) NOT NULL,
  `role` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`role_id`, `role`) VALUES
(2, 'Admin'),
(1, 'Operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boundary`
--
ALTER TABLE `boundary`
  ADD PRIMARY KEY (`boundary_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`,`brand_name`),
  ADD KEY `brand_ibfk_1` (`manufacturer`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`bus_id`),
  ADD KEY `company_details_bus` (`company`);

--
-- Indexes for table `bus_reservation`
--
ALTER TABLE `bus_reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `trip_id` (`trip_id`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `car_ibfk_1` (`brand`),
  ADD KEY `company_details_car` (`company`);

--
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD PRIMARY KEY (`company_id`),
  ADD UNIQUE KEY `company_name` (`company_name`),
  ADD UNIQUE KEY `TUC_company_details_1` (`email_address`,`phone`,`user_name`),
  ADD KEY `indulstry_company_details` (`indulstry`),
  ADD KEY `boundary_company_details` (`boundary`),
  ADD KEY `email_address` (`email_address`);

--
-- Indexes for table `computicket_staff`
--
ALTER TABLE `computicket_staff`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `customer_registry`
--
ALTER TABLE `customer_registry`
  ADD PRIMARY KEY (`contact`);

--
-- Indexes for table `depot`
--
ALTER TABLE `depot`
  ADD PRIMARY KEY (`depot_id`),
  ADD KEY `depot_ibfk_1` (`district`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `hiring_data`
--
ALTER TABLE `hiring_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hiring_data_ibfk_1` (`car`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotel_id`),
  ADD KEY `district_hotel` (`district`),
  ADD KEY `company_details_hotel` (`domain`);

--
-- Indexes for table `hotelreservation`
--
ALTER TABLE `hotelreservation`
  ADD PRIMARY KEY (`ref_id`),
  ADD KEY `hotel_hotelreservation` (`hotel_id`);

--
-- Indexes for table `indulstry`
--
ALTER TABLE `indulstry`
  ADD PRIMARY KEY (`indulstry_id`);

--
-- Indexes for table `mailing_list`
--
ALTER TABLE `mailing_list`
  ADD PRIMARY KEY (`id`,`email`);

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`mnf_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`method_id`),
  ADD UNIQUE KEY `method_name` (`method_name`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `hotel_room` (`hotel_id`),
  ADD KEY `roomtype_room` (`type_id`);

--
-- Indexes for table `roomtype`
--
ALTER TABLE `roomtype`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`trip_id`),
  ADD KEY `bus_id` (`bus_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boundary`
--
ALTER TABLE `boundary`
  MODIFY `boundary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `computicket_staff`
--
ALTER TABLE `computicket_staff`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `indulstry`
--
ALTER TABLE `indulstry`
  MODIFY `indulstry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `method_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `trip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brand`
--
ALTER TABLE `brand`
  ADD CONSTRAINT `brand_ibfk_1` FOREIGN KEY (`manufacturer`) REFERENCES `manufacturer` (`mnf_id`);

--
-- Constraints for table `bus`
--
ALTER TABLE `bus`
  ADD CONSTRAINT `company_details_bus` FOREIGN KEY (`company`) REFERENCES `company_details` (`company_id`);

--
-- Constraints for table `bus_reservation`
--
ALTER TABLE `bus_reservation`
  ADD CONSTRAINT `bus_reservation_ibfk_1` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`trip_id`);

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`brand`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `company_details_car` FOREIGN KEY (`company`) REFERENCES `company_details` (`company_id`);

--
-- Constraints for table `company_details`
--
ALTER TABLE `company_details`
  ADD CONSTRAINT `boundary_company_details` FOREIGN KEY (`boundary`) REFERENCES `boundary` (`boundary_id`),
  ADD CONSTRAINT `indulstry_company_details` FOREIGN KEY (`indulstry`) REFERENCES `indulstry` (`indulstry_id`);

--
-- Constraints for table `computicket_staff`
--
ALTER TABLE `computicket_staff`
  ADD CONSTRAINT `computicket_staff_ibfk_1` FOREIGN KEY (`role`) REFERENCES `user_roles` (`role_id`);

--
-- Constraints for table `depot`
--
ALTER TABLE `depot`
  ADD CONSTRAINT `depot_ibfk_1` FOREIGN KEY (`district`) REFERENCES `district` (`district_id`);

--
-- Constraints for table `hiring_data`
--
ALTER TABLE `hiring_data`
  ADD CONSTRAINT `hiring_data_ibfk_1` FOREIGN KEY (`car`) REFERENCES `car` (`car_id`);

--
-- Constraints for table `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `company_details_hotel` FOREIGN KEY (`domain`) REFERENCES `company_details` (`company_id`),
  ADD CONSTRAINT `district_hotel` FOREIGN KEY (`district`) REFERENCES `district` (`district_id`);

--
-- Constraints for table `hotelreservation`
--
ALTER TABLE `hotelreservation`
  ADD CONSTRAINT `hotel_hotelreservation` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `hotel_room` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`),
  ADD CONSTRAINT `roomtype_room` FOREIGN KEY (`type_id`) REFERENCES `roomtype` (`type_id`);

--
-- Constraints for table `trip`
--
ALTER TABLE `trip`
  ADD CONSTRAINT `trip_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`bus_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
