-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 31, 2024 at 01:45 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdu_ecommerce_2023`
--

-- --------------------------------------------------------

--
-- Table structure for table `bdu_admins`
--

CREATE TABLE `bdu_admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bdu_admins`
--

INSERT INTO `bdu_admins` (`id`, `name`, `password`) VALUES
(3, 'Sireat', '011c945f30ce2cbafc452f39840f025693339c42');

-- --------------------------------------------------------

--
-- Table structure for table `bdu_category`
--

CREATE TABLE `bdu_category` (
  `c_id` int(2) NOT NULL,
  `c_name` varchar(40) NOT NULL,
  `C_image` varchar(100) NOT NULL,
  `sub_category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bdu_category`
--

INSERT INTO `bdu_category` (`c_id`, `c_name`, `C_image`, `sub_category`) VALUES
(1, 'Computers & Laptops', 'computer&laptop.png', ''),
(2, 'Cameras & Photos', 'camera&photo.png', ''),
(3, 'Hardware', 'hardware.png', ''),
(4, 'Ipad & Phones', 'ipad&phones.png', ''),
(5, 'Accessories', 'accessories.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `bdu_contact`
--

CREATE TABLE `bdu_contact` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bdu_contact`
--

INSERT INTO `bdu_contact` (`id`, `name`, `email`, `number`, `message`) VALUES
(6, 'Sireat', 'sireatag@gmail.com', '918583228', 'hi'),
(9, 'Addisu', 'addisu@gmail.com', '920505163', 'hey');

-- --------------------------------------------------------

--
-- Table structure for table `bdu_customer`
--

CREATE TABLE `bdu_customer` (
  `cu_id` int(15) NOT NULL,
  `cu_fname` varchar(30) NOT NULL,
  `cu_mname` varchar(30) NOT NULL,
  `cu_lname` varchar(30) NOT NULL,
  `cu_email` varchar(30) NOT NULL,
  `cu_phone` varchar(15) NOT NULL,
  `cu_country` varchar(20) NOT NULL,
  `cu_city` varchar(20) NOT NULL,
  `cu_address` varchar(40) NOT NULL,
  `cu_pobox` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bdu_customer`
--

INSERT INTO `bdu_customer` (`cu_id`, `cu_fname`, `cu_mname`, `cu_lname`, `cu_email`, `cu_phone`, `cu_country`, `cu_city`, `cu_address`, `cu_pobox`) VALUES
(1, 'sireat', '', 'mihretu', 'sireatag@gmail.com', '0949973481', '', '', 'poly', 'poly'),
(2, 'samkia', '', 'tafere', '', '0946463327', '', '', ' frn ', ''),
(3, 'Addisu', '', 'mihretu', '', '920505163', '', '', '16', ''),
(4, 'Adoel', '', 'Ayenew', '', '0949973412', '', '', 'Gulelie', ''),
(5, 'ze\'an', '', 'mihretu', '', '936328543', '', '', 'gelan', ''),
(6, 'Losmedian', '', 'mihretu', '', '0910973481', '', '', 'Gulelie', ''),
(7, 'ze&#039;an', '', 'mihretu', '', '0936328543', '', '', 'gelan', '');

-- --------------------------------------------------------

--
-- Table structure for table `bdu_invoice_table`
--

CREATE TABLE `bdu_invoice_table` (
  `invoice_id` int(15) NOT NULL,
  `invoice_number` int(6) NOT NULL,
  `reference_number` int(4) NOT NULL,
  `cu_id` int(2) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bdu_invoice_table`
--

INSERT INTO `bdu_invoice_table` (`invoice_id`, `invoice_number`, `reference_number`, `cu_id`, `creation_date`) VALUES
(1, 1, 1, 1, '2024-01-24 05:47:05'),
(2, 2, 2, 1, '2024-01-30 04:17:45'),
(3, 3, 3, 1, '2024-01-30 04:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `bdu_order`
--

CREATE TABLE `bdu_order` (
  `o_id` int(2) NOT NULL,
  `cu_id` int(2) NOT NULL,
  `o_total_qty` int(3) NOT NULL,
  `o_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `o_status` int(2) NOT NULL,
  `o_total_price` float NOT NULL,
  `coupon_code` varchar(6) NOT NULL,
  `cu_email` varchar(30) NOT NULL,
  `discout` decimal(8,2) NOT NULL,
  `ordered_delivery_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_paid_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_number` varchar(10) NOT NULL,
  `order_remark` varchar(100) NOT NULL,
  `payment_type_code` varchar(20) NOT NULL,
  `shipment_status_cat_code` varchar(20) NOT NULL,
  `shipment_type_code` varchar(20) NOT NULL,
  `shipping_charge` float(8,2) NOT NULL,
  `total_wight` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bdu_order`
--

INSERT INTO `bdu_order` (`o_id`, `cu_id`, `o_total_qty`, `o_date`, `o_status`, `o_total_price`, `coupon_code`, `cu_email`, `discout`, `ordered_delivery_date`, `order_paid_date`, `order_number`, `order_remark`, `payment_type_code`, `shipment_status_cat_code`, `shipment_type_code`, `shipping_charge`, `total_wight`) VALUES
(1, 1, 2, '2024-01-24 05:47:05', 1, 900, '0', '1', '0.00', '2024-01-24 05:47:05', '2024-01-24 05:47:05', '1', '1', '1', '1', '3', 30.00, '1.00'),
(2, 1, 2, '2024-01-30 04:17:45', 1, 500, '0', '1', '0.00', '2024-01-30 04:17:45', '2024-01-30 04:17:45', '2', '1', '1', '1', '3', 30.00, '1.00'),
(3, 1, 2, '2024-01-30 04:20:37', 1, 500, '0', '1', '0.00', '2024-01-30 04:20:37', '2024-01-30 04:20:37', '3', '1', '1', '1', '3', 30.00, '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `bdu_order_detail`
--

CREATE TABLE `bdu_order_detail` (
  `od_id` int(2) NOT NULL,
  `o_id` int(2) NOT NULL,
  `od_qty` int(2) NOT NULL,
  `p_id` int(2) NOT NULL,
  `od_price` float NOT NULL,
  `order_number` varchar(10) NOT NULL,
  `sub_total_price` float(5,2) NOT NULL,
  `unit_price` float(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bdu_order_detail`
--

INSERT INTO `bdu_order_detail` (`od_id`, `o_id`, `od_qty`, `p_id`, `od_price`, `order_number`, `sub_total_price`, `unit_price`) VALUES
(1, 1, 2, 9, 900, '1', 450.00, 1.00),
(2, 2, 2, 1, 500, '2', 250.00, 1.00),
(3, 3, 2, 1, 500, '3', 250.00, 1.00);

-- --------------------------------------------------------

--
-- Table structure for table `bdu_payment_data`
--

CREATE TABLE `bdu_payment_data` (
  `payment_data_id` int(15) NOT NULL,
  `payment_type_code` int(4) NOT NULL DEFAULT 1,
  `bank_name` enum('CBE','United','Dashen','Abyssinia','Wegagen') NOT NULL DEFAULT 'CBE',
  `billed_by` varchar(30) NOT NULL,
  `reference_number` varchar(20) NOT NULL,
  `date_of_receipt` date NOT NULL,
  `invoice_id` int(15) NOT NULL,
  `state` enum('Unpaid','Paid') NOT NULL DEFAULT 'Unpaid',
  `verify_code` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bdu_payment_data`
--

INSERT INTO `bdu_payment_data` (`payment_data_id`, `payment_type_code`, `bank_name`, `billed_by`, `reference_number`, `date_of_receipt`, `invoice_id`, `state`, `verify_code`) VALUES
(3, 1, 'CBE', 'sireat mihretu', 'ghghhgh', '2015-09-08', 3, 'Paid', 'ec36ba3a6b7004a466cc237ab2484e64');

-- --------------------------------------------------------

--
-- Table structure for table `bdu_payment_detail`
--

CREATE TABLE `bdu_payment_detail` (
  `payment_detail_id` int(2) NOT NULL,
  `payment_data_id` int(2) NOT NULL,
  `sh_id` int(2) NOT NULL,
  `value` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bdu_payment_type`
--

CREATE TABLE `bdu_payment_type` (
  `payment_type_code` int(2) NOT NULL,
  `payment_type_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bdu_product`
--

CREATE TABLE `bdu_product` (
  `p_id` int(2) NOT NULL,
  `p_name` varchar(60) NOT NULL,
  `p_image` varchar(40) DEFAULT 'default_image.png',
  `p_image1` varchar(30) DEFAULT 'default_image.png',
  `p_image2` varchar(30) DEFAULT 'default_image.png',
  `p_image3` varchar(30) DEFAULT 'default_image.png',
  `p_color` varchar(10) DEFAULT 'black',
  `p_price` decimal(8,2) NOT NULL,
  `sale_price` decimal(8,2) NOT NULL,
  `p_status` varchar(24) NOT NULL DEFAULT 'Featured',
  `tag` varchar(60) NOT NULL,
  `weight` decimal(3,2) NOT NULL,
  `total_review` varchar(100) NOT NULL,
  `p_availability` enum('In Store','Out of Store') NOT NULL,
  `p_description` varchar(300) DEFAULT 'no description found for this product, please come later',
  `c_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bdu_product`
--

INSERT INTO `bdu_product` (`p_id`, `p_name`, `p_image`, `p_image1`, `p_image2`, `p_image3`, `p_color`, `p_price`, `sale_price`, `p_status`, `tag`, `weight`, `total_review`, `p_availability`, `p_description`, `c_id`) VALUES
(1, 'Huawei Media', 'Huawei_Media_Pad.png', 'Huawei_Media_Pad1.png', 'Huawei_Media_Pad2.png', 'Huawei_Media_Pad3.png', 'black', '225.00', '250.00', 'Featured', '', '0.00', '', 'In Store', 'no description found for this product, please come later', 4),
(2, 'Huawei Media', 'Sony.png', 'Sony1.png', 'Sony2.png', 'Sony3.png', 'white', '379.00', '250.00', 'Featured', '', '0.00', '', 'In Store', 'no description found for this product, please come later', 2),
(3, 'Huawei Media', 'Canon_STM.png', 'Canon_STM1.png', 'Canon_STM2.png', 'Canon_STM3.png', 'silver', '225.00', '250.00', 'On Sale', '', '0.00', '', 'In Store', 'no description found for this product, please come later', 2),
(4, 'Huawei Media', 'Lenovo_IdeaPad.png', 'Lenovo_IdeaPad1.png', 'Lenovo_IdeaPad2.png', 'Lenovo_IdeaPad3.png', 'silver', '379.00', '250.00', 'On Sale', '', '0.00', '', 'In Store', 'no description found for this product, please come later', 1),
(5, 'Huawei Media', 'Dell_Mouse.png', 'Dell_Mouse1.png', 'Dell_Mouse2.png', 'Dell_Mouse3.png', 'black', '209.00', '250.00', 'Best Rated', '', '0.00', '', 'In Store', 'no description found for this product, please come later', 3),
(6, 'Huawei Media', 'Hp_Probook.png', 'Hp_Probook1.png', 'Hp_Probook2.png', 'Hp_Probook3.png', 'silver', '300.00', '250.00', 'Best Rated', '', '0.00', '', 'In Store', 'no description found for this product, please come later', 1),
(7, 'Huawei Media', 'Mac_Book_Air.png', 'Mac_Book_Air1.png', 'Mac_Book_Air2.png', 'Mac_Book_Air3.png', 'gold', '209.00', '250.00', 'Best Rated', '', '0.00', '4.5', 'In Store', 'no description found for this product, please come later', 1),
(8, 'Huawei Media', 'accessory.png', 'accessory1.png', 'accessory2.png', 'accessory3.png', 'black', '150.00', '250.00', 'Featured', '', '0.00', '', 'In Store', 'no description found for this product, please come later', 5),
(9, 'Huawei Media', 'Iphone.png', 'Iphone1.png', 'Iphone2.png', 'Iphone3.png', 'white', '500.00', '250.00', 'On Sale', '', '0.00', '', 'In Store', 'no description found for this product, please come later', 4);

-- --------------------------------------------------------

--
-- Table structure for table `bdu_shipment`
--

CREATE TABLE `bdu_shipment` (
  `sh_id` int(15) NOT NULL,
  `billing_address` varchar(50) NOT NULL,
  `cu_id` int(15) NOT NULL,
  `delivery_cost` float DEFAULT 0,
  `disount` float(8,2) NOT NULL,
  `final_price` float(8,2) NOT NULL,
  `invoice_id` int(15) NOT NULL,
  `order_number` varchar(10) NOT NULL,
  `payment_type_code` varchar(20) NOT NULL,
  `price_total` float(5,2) NOT NULL,
  `qty_total` int(5) NOT NULL,
  `sh_type_code` varchar(30) NOT NULL,
  `sh_address` varchar(50) NOT NULL,
  `total_weight` float(3,2) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bdu_shipment`
--

INSERT INTO `bdu_shipment` (`sh_id`, `billing_address`, `cu_id`, `delivery_cost`, `disount`, `final_price`, `invoice_id`, `order_number`, `payment_type_code`, `price_total`, `qty_total`, `sh_type_code`, `sh_address`, `total_weight`, `time_created`) VALUES
(2, '1', 1, 30, 0.00, 930.00, 1, '1', '1', 900.00, 2, '3', '1', 1.00, '2024-01-24 05:47:05'),
(3, '1', 1, 30, 0.00, 530.00, 2, '2', '1', 500.00, 2, '3', '1', 1.00, '2024-01-30 04:17:45'),
(4, '1', 1, 30, 0.00, 530.00, 3, '3', '1', 500.00, 2, '3', '1', 1.00, '2024-01-30 04:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `bdu_shipment_address`
--

CREATE TABLE `bdu_shipment_address` (
  `ship_add_id` int(2) NOT NULL,
  `sh_id` int(2) NOT NULL,
  `subcity_id` int(6) NOT NULL,
  `city_id` int(6) NOT NULL,
  `country_id` int(6) NOT NULL,
  `region_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bdu_shipment_status`
--

CREATE TABLE `bdu_shipment_status` (
  `shipment_status_id` int(15) NOT NULL,
  `sh_id` int(15) NOT NULL,
  `ship_stat_cat_code` int(4) NOT NULL DEFAULT 1,
  `status_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `notes` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bdu_shipment_status`
--

INSERT INTO `bdu_shipment_status` (`shipment_status_id`, `sh_id`, `ship_stat_cat_code`, `status_time`, `notes`) VALUES
(1, 2, 2, '2024-01-24 05:47:05', ''),
(2, 3, 1, '2024-01-30 04:17:45', ''),
(3, 4, 2, '2024-01-30 04:20:37', '');

-- --------------------------------------------------------

--
-- Table structure for table `bdu_shipment_status_catalogue`
--

CREATE TABLE `bdu_shipment_status_catalogue` (
  `ship_stat_cat_code` varchar(30) NOT NULL,
  `ship_stat_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bdu_shipment_type`
--

CREATE TABLE `bdu_shipment_type` (
  `ship_type_code` varchar(30) NOT NULL,
  `ship_type_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bdu_status`
--

CREATE TABLE `bdu_status` (
  `st_id` int(11) NOT NULL,
  `st_name` enum('Ordered','Under REquest','Paid','Confirmed','Sent') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bdu_subscription`
--

CREATE TABLE `bdu_subscription` (
  `subscription_code` varchar(30) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `subscription_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bdu_subscription`
--

INSERT INTO `bdu_subscription` (`subscription_code`, `customer_email`, `subscription_date`) VALUES
('', '', '2023-07-03 08:44:03'),
('', 'sireatagh@gmail.com', '2023-07-03 13:05:17'),
('', 'sireatag@gmail.com', '2023-08-07 07:36:31');

-- --------------------------------------------------------

--
-- Table structure for table `bdu_user`
--

CREATE TABLE `bdu_user` (
  `u_id` int(2) NOT NULL,
  `u_name` varchar(30) NOT NULL,
  `u_email` varchar(30) NOT NULL,
  `u_password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bdu_user_account`
--

CREATE TABLE `bdu_user_account` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_fname` varchar(30) NOT NULL,
  `user_mname` varchar(30) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_status` enum('0','1') NOT NULL DEFAULT '0',
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bdu_user_account`
--

INSERT INTO `bdu_user_account` (`user_id`, `user_email`, `user_fname`, `user_mname`, `user_password`, `user_status`, `registration_date`) VALUES
(2, 'sireatag@gmail.com', 'sireat', 'mihretu', 'b_|~ñÄ|=È–wW»,•~;>æ¼Ñ¾N.Úmäh¯', '1', '2023-07-06 07:48:50'),
(5, 'samkia@gmail.com', 'Samkia', 'tafere', 'b_|~ñÄ|=È–wW»,•~;>æ¼Ñ¾N.Úmäh¯', '1', '2024-01-19 20:10:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bdu_admins`
--
ALTER TABLE `bdu_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bdu_category`
--
ALTER TABLE `bdu_category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `bdu_contact`
--
ALTER TABLE `bdu_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bdu_customer`
--
ALTER TABLE `bdu_customer`
  ADD PRIMARY KEY (`cu_id`);

--
-- Indexes for table `bdu_order`
--
ALTER TABLE `bdu_order`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `bdu_order_detail`
--
ALTER TABLE `bdu_order_detail`
  ADD PRIMARY KEY (`od_id`);

--
-- Indexes for table `bdu_payment_data`
--
ALTER TABLE `bdu_payment_data`
  ADD PRIMARY KEY (`payment_data_id`);

--
-- Indexes for table `bdu_product`
--
ALTER TABLE `bdu_product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `bdu_shipment`
--
ALTER TABLE `bdu_shipment`
  ADD PRIMARY KEY (`sh_id`);

--
-- Indexes for table `bdu_shipment_status`
--
ALTER TABLE `bdu_shipment_status`
  ADD PRIMARY KEY (`shipment_status_id`);

--
-- Indexes for table `bdu_status`
--
ALTER TABLE `bdu_status`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `bdu_user`
--
ALTER TABLE `bdu_user`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `bdu_user_account`
--
ALTER TABLE `bdu_user_account`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bdu_admins`
--
ALTER TABLE `bdu_admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bdu_category`
--
ALTER TABLE `bdu_category`
  MODIFY `c_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bdu_contact`
--
ALTER TABLE `bdu_contact`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bdu_customer`
--
ALTER TABLE `bdu_customer`
  MODIFY `cu_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `bdu_order`
--
ALTER TABLE `bdu_order`
  MODIFY `o_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `bdu_order_detail`
--
ALTER TABLE `bdu_order_detail`
  MODIFY `od_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `bdu_product`
--
ALTER TABLE `bdu_product`
  MODIFY `p_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bdu_shipment`
--
ALTER TABLE `bdu_shipment`
  MODIFY `sh_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=393;

--
-- AUTO_INCREMENT for table `bdu_user`
--
ALTER TABLE `bdu_user`
  MODIFY `u_id` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bdu_user_account`
--
ALTER TABLE `bdu_user_account`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
