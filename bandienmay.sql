-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 30, 2020 lúc 08:37 AM
-- Phiên bản máy phục vụ: 10.4.8-MariaDB
-- Phiên bản PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bandienmay`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_estonian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `email`, `password`) VALUES
(2, 'Quách Việt Cường', 'cuong@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `product_name` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_prire` varchar(50) COLLATE utf8_estonian_ci NOT NULL,
  `product_image` varchar(50) COLLATE utf8_estonian_ci NOT NULL,
  `product_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `product_name`, `product_id`, `product_prire`, `product_image`, `product_total`) VALUES
(157, 'laptop 3', 18, '1400000', 'mk4.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) COLLATE utf8_estonian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(2, 'Tủ lạnh'),
(3, 'Máy giặt'),
(4, 'Điện thoại'),
(5, 'Tivi'),
(19, 'Laptop');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  `customer_phone` varchar(50) COLLATE utf8_estonian_ci NOT NULL,
  `customer_address` varchar(200) COLLATE utf8_estonian_ci NOT NULL,
  `customer_note` text COLLATE utf8_estonian_ci NOT NULL,
  `customer_email` varchar(150) COLLATE utf8_estonian_ci NOT NULL,
  `customer_password` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  `customer_delivery` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `customer_name`, `customer_phone`, `customer_address`, `customer_note`, `customer_email`, `customer_password`, `customer_delivery`) VALUES
(16, 'Cường', '0827739038', 'nguyễn văn lượng', 'a', 'cuong@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
(17, 'Cường 1', '0827739038', 'nguyễn văn lượng', 'a', 'cuong1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
(18, 'Cường 2', '0827739038', 'nguyễn văn lượng', '1', 'cuong2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0),
(19, 'Việt Cường', '0827739038', 'nguyễn văn lượng, vinhome', 'as', 'vietcuong@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
(20, 'Việt Cường', '0827739038', 'nguyễn văn lượng, vinhome', 'as', 'thanhungpham2601@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
(21, 'cường', '0827739038', 'nguyễn văn lượng', 'aaa', 'cuong3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0),
(22, 'cường 4', '0827739038', 'nguyễn văn lượng', 'aaa', 'cuong4@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0),
(23, 'dkmm', '1111111111', 'a', 'a', 'dkm@gmail.com', '202cb962ac59075b964b07152d234b70', 0),
(24, 'aaaa', '1111', 'a', 'a', 'clg@gmail.com', '202cb962ac59075b964b07152d234b70', 0),
(25, 'a', 'a', 'a', 'a', 'a@gmail.com', '202cb962ac59075b964b07152d234b70', 0),
(26, 'a', 'a', 'a', 'a', 'a@gmail.com', '202cb962ac59075b964b07152d234b70', 0),
(27, 'b', 'b', 'b', 'a', 'b@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(28, 'c', 'c', 'c', 'a', 'c@gmai.com', '202cb962ac59075b964b07152d234b70', 1),
(29, 'd', 'd', 'd', 'a', 'd@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1),
(39, '', '', '', '', '', '', 0),
(40, 'cuong 1 ', '0827739031', 'nguyễn văn lượng', 'a', 'c1c1c1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_news`
--

CREATE TABLE `tbl_news` (
  `news_id` int(11) NOT NULL,
  `news_name` varchar(100) COLLATE utf8_estonian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_news`
--

INSERT INTO `tbl_news` (`news_id`, `news_name`) VALUES
(1, 'Kiến thức về máy lạnh'),
(2, 'Kiến thức về máy giặt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_news_post`
--

CREATE TABLE `tbl_news_post` (
  `news_post_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `news_post_name` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  `short_description` text COLLATE utf8_estonian_ci NOT NULL,
  `contents` text COLLATE utf8_estonian_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_estonian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_news_post`
--

INSERT INTO `tbl_news_post` (`news_post_id`, `news_id`, `news_post_name`, `short_description`, `contents`, `image`) VALUES
(1, 1, 'Lorem Ipsum 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'mk8.jpg'),
(2, 2, 'Lorem Ipsum 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'mk8.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_total` int(11) NOT NULL,
  `order_cart_id` varchar(50) COLLATE utf8_estonian_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL,
  `cancel_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `product_id`, `order_total`, `order_cart_id`, `customer_id`, `date_time`, `status`, `cancel_order`) VALUES
(20, 16, 1, '34060', 16, '2019-11-08 04:44:56', 1, 2),
(23, 11, 3, '73313', 18, '2019-11-04 03:43:19', 0, 0),
(24, 12, 2, '73313', 18, '2019-11-04 03:43:19', 0, 0),
(25, 16, 2, '73313', 18, '2019-11-04 03:43:20', 0, 0),
(26, 16, 3, '9830', 19, '2019-11-05 02:31:45', 0, 0),
(27, 12, 2, '9830', 19, '2019-11-05 02:31:45', 0, 0),
(28, 16, 3, '33740', 20, '2019-11-08 03:56:33', 0, 0),
(29, 12, 2, '33740', 20, '2019-11-08 03:56:33', 0, 0),
(30, 11, 2, '49293', 22, '2019-11-05 03:30:18', 0, 0),
(31, 16, 1, '49293', 22, '2019-11-05 03:30:18', 0, 0),
(32, 12, 2, '89311', 16, '2019-11-08 04:41:25', 1, 2),
(33, 11, 3, '89311', 16, '2019-11-08 04:41:25', 1, 2),
(34, 18, 3, '15285', 16, '2019-11-08 04:47:36', 0, 2),
(35, 20, 2, '15285', 16, '2019-11-08 04:47:36', 0, 2),
(36, 13, 1, '27298', 16, '2019-11-09 02:39:56', 0, 2),
(37, 21, 2, '27298', 16, '2019-11-09 02:39:56', 0, 2),
(38, 15, 1, '27298', 16, '2019-11-09 02:39:56', 0, 2),
(39, 13, 1, '84989', 16, '2019-11-09 02:39:28', 0, 0),
(40, 12, 1, '96575', 24, '2019-11-09 03:11:43', 0, 0),
(41, 15, 1, '33159', 24, '2019-11-09 03:13:18', 0, 0),
(42, 20, 1, '16174', 25, '2019-11-09 03:13:49', 0, 0),
(43, 20, 1, '12941', 26, '2019-11-09 03:15:20', 0, 0),
(44, 18, 1, '81890', 27, '2019-11-09 03:15:44', 0, 0),
(45, 15, 1, '48136', 28, '2019-11-09 03:18:09', 0, 0),
(46, 12, 2, '87369', 29, '2019-11-09 03:24:37', 0, 0),
(47, 13, 1, '87369', 29, '2019-11-09 03:24:37', 0, 0),
(48, 12, 2, '66592', 30, '2019-11-09 03:25:44', 0, 0),
(49, 13, 1, '66592', 30, '2019-11-09 03:25:44', 0, 0),
(50, 18, 1, '38472', 31, '2019-11-09 03:26:27', 0, 0),
(51, 13, 1, '58113', 32, '2019-11-09 03:29:53', 0, 0),
(52, 19, 1, '29791', 33, '2019-11-09 03:34:58', 0, 0),
(54, 18, 1, '23096', 16, '2019-11-29 04:47:35', 0, 0),
(55, 16, 1, '32185', 16, '2019-12-03 02:36:51', 0, 0),
(56, 12, 2, '52262', 16, '2019-12-03 02:39:06', 0, 0),
(57, 13, 1, '52262', 16, '2019-12-03 02:39:06', 0, 0),
(58, 13, 1, '34732', 16, '2019-12-03 02:39:30', 0, 0),
(59, 13, 1, '54856', 16, '2019-12-03 02:40:58', 0, 0),
(60, 19, 1, '82160', 16, '2019-12-03 02:42:22', 0, 0),
(61, 12, 1, '45445', 16, '2019-12-03 02:43:49', 0, 0),
(62, 18, 1, '30344', 16, '2019-12-03 02:48:46', 0, 0),
(63, 19, 1, '196', 16, '2019-12-03 02:55:47', 0, 0),
(64, 13, 1, '93018', 16, '2019-12-03 03:00:27', 0, 0),
(65, 19, 1, '64631', 16, '2019-12-03 03:03:15', 0, 0),
(66, 18, 1, '87732', 16, '2019-12-03 03:04:45', 0, 0),
(67, 19, 1, '77453', 16, '2019-12-03 03:07:02', 0, 0),
(68, 19, 1, '26255', 16, '2019-12-03 03:07:34', 0, 0),
(69, 19, 2, '52278', 40, '2019-12-03 03:11:15', 0, 0),
(70, 12, 1, '90087', 16, '2019-12-03 03:19:34', 0, 0),
(71, 17, 1, '90087', 16, '2019-12-03 03:19:34', 0, 0),
(72, 19, 2, '10574', 16, '2019-12-03 03:27:55', 0, 0),
(73, 18, 1, '7165', 16, '2019-12-16 09:50:44', 0, 0),
(74, 18, 1, '79362', 16, '2019-12-16 09:51:36', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_detail_image_slider_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8_estonian_ci NOT NULL,
  `product_short_description` text COLLATE utf8_estonian_ci NOT NULL,
  `product_full_description` text COLLATE utf8_estonian_ci NOT NULL,
  `product_price` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  `product_sale_price` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  `product_active` int(11) NOT NULL,
  `product_hot` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_image` varchar(50) COLLATE utf8_estonian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `category_id`, `product_detail_image_slider_id`, `product_name`, `product_short_description`, `product_full_description`, `product_price`, `product_sale_price`, `product_active`, `product_hot`, `product_quantity`, `product_image`) VALUES
(11, 2, 0, 'tu lanh 1', 'a', 'a', '12000000', '11000000', 0, 0, 2, 'k2.jpg'),
(12, 4, 0, 'dien thoai 1', 'a', 'a', '1500000', '900000', 0, 1, 1, 'mk2.jpg'),
(13, 3, 0, 'may giat 1', 'a', 'a', '1500000', '900000', 0, 0, 1, 'm8.jpg'),
(15, 5, 0, 'tivi 1', 'a', 'a', '1500000', '900000', 0, 0, 1, 'm4.jpg'),
(16, 19, 0, 'laptop 1 ', 'a', 'a', '1500000', '900000', 0, 0, 1, 'mk6.jpg'),
(17, 19, 0, 'laptop 2', 'a', 'a', '1500000', '1200000', 0, 0, 1, 'mk5.jpg'),
(18, 19, 0, 'laptop 3', 'a', 'a', '1500000', '1400000', 0, 0, 1, 'mk4.jpg'),
(19, 19, 0, 'laptop 4', 'a', 'a', '1500000', '1000000', 0, 0, 1, 'mk5.jpg'),
(20, 2, 0, 'tu lanh 2', 'a', 'a', '7000000', '6000000', 0, 0, 1, 'm7.jpg'),
(21, 2, 0, 'tu lanh 3', 'a', 'a', '5100000', '5000000', 0, 0, 1, 'm7.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product_detail_image_slider`
--

CREATE TABLE `tbl_product_detail_image_slider` (
  `product_detail_image_slider_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_detail_image_slider_1` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  `product_detail_image_slider_2` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  `product_detail_image_slider_3` varchar(100) COLLATE utf8_estonian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `slider_id` int(11) NOT NULL,
  `slider_image` varchar(100) COLLATE utf8_estonian_ci NOT NULL,
  `slider_caption` text COLLATE utf8_estonian_ci NOT NULL,
  `slider_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_slider`
--

INSERT INTO `tbl_slider` (`slider_id`, `slider_image`, `slider_caption`, `slider_active`) VALUES
(1, 'b2.jpg', 'slider khuyến mãi', 1),
(2, 'b3.jpg', 'slider 50%', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_transaction`
--

CREATE TABLE `tbl_transaction` (
  `transaction_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_total` int(11) NOT NULL,
  `transaction_code` varchar(50) COLLATE utf8_estonian_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `cancel_order` int(11) NOT NULL DEFAULT 0,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`transaction_id`, `customer_id`, `product_id`, `product_total`, `transaction_code`, `status`, `cancel_order`, `date_time`) VALUES
(3, 16, 16, 1, '34060', 1, 2, '2019-11-04 03:16:18'),
(4, 17, 11, 2, '92596', 0, 0, '2019-11-04 03:21:11'),
(5, 17, 16, 3, '92596', 0, 0, '2019-11-04 03:21:11'),
(6, 18, 11, 3, '73313', 0, 0, '2019-11-04 03:43:19'),
(7, 18, 12, 2, '73313', 0, 0, '2019-11-04 03:43:19'),
(8, 18, 16, 2, '73313', 0, 0, '2019-11-04 03:43:20'),
(9, 19, 16, 3, '9830', 0, 0, '2019-11-05 02:31:45'),
(10, 19, 12, 2, '9830', 0, 0, '2019-11-05 02:31:45'),
(11, 20, 16, 3, '33740', 0, 0, '2019-11-05 02:33:36'),
(12, 20, 12, 2, '33740', 0, 0, '2019-11-05 02:33:36'),
(13, 22, 11, 2, '49293', 0, 0, '2019-11-05 03:30:18'),
(14, 22, 16, 1, '49293', 0, 0, '2019-11-05 03:30:18'),
(15, 16, 12, 2, '89311', 1, 2, '2019-11-08 03:27:33'),
(16, 16, 11, 3, '89311', 1, 2, '2019-11-08 03:27:33'),
(17, 16, 18, 3, '15285', 0, 2, '2019-11-08 04:46:10'),
(18, 16, 20, 2, '15285', 0, 2, '2019-11-08 04:46:10'),
(19, 16, 13, 1, '27298', 0, 2, '2019-11-09 02:37:02'),
(20, 16, 21, 2, '27298', 0, 2, '2019-11-09 02:37:02'),
(21, 16, 15, 1, '27298', 0, 2, '2019-11-09 02:37:02'),
(22, 16, 13, 1, '84989', 0, 0, '2019-11-09 02:39:28'),
(23, 24, 12, 1, '96575', 0, 0, '2019-11-09 03:11:43'),
(24, 24, 15, 1, '33159', 0, 0, '2019-11-09 03:13:18'),
(25, 25, 20, 1, '16174', 0, 0, '2019-11-09 03:13:49'),
(26, 26, 20, 1, '12941', 0, 0, '2019-11-09 03:15:20'),
(27, 27, 18, 1, '81890', 0, 0, '2019-11-09 03:15:44'),
(28, 28, 15, 1, '48136', 0, 0, '2019-11-09 03:18:09'),
(29, 29, 12, 2, '87369', 0, 0, '2019-11-09 03:24:37'),
(30, 29, 13, 1, '87369', 0, 0, '2019-11-09 03:24:37'),
(31, 30, 12, 2, '66592', 0, 0, '2019-11-09 03:25:44'),
(32, 30, 13, 1, '66592', 0, 0, '2019-11-09 03:25:44'),
(33, 31, 18, 1, '38472', 0, 0, '2019-11-09 03:26:27'),
(34, 32, 13, 1, '58113', 0, 0, '2019-11-09 03:29:53'),
(35, 33, 19, 1, '29791', 0, 0, '2019-11-09 03:34:58'),
(36, 34, 19, 1, '32621', 1, 0, '2019-11-09 03:35:34'),
(37, 16, 18, 1, '23096', 0, 0, '2019-11-29 04:47:35'),
(38, 16, 16, 1, '32185', 0, 0, '2019-12-03 02:36:51'),
(39, 16, 12, 2, '52262', 0, 0, '2019-12-03 02:39:06'),
(40, 16, 13, 1, '52262', 0, 0, '2019-12-03 02:39:06'),
(41, 16, 13, 1, '34732', 0, 0, '2019-12-03 02:39:30'),
(42, 16, 13, 1, '54856', 0, 0, '2019-12-03 02:40:58'),
(43, 16, 19, 1, '82160', 0, 0, '2019-12-03 02:42:22'),
(44, 16, 12, 1, '45445', 0, 0, '2019-12-03 02:43:49'),
(45, 16, 18, 1, '30344', 0, 0, '2019-12-03 02:48:46'),
(46, 16, 19, 1, '196', 0, 0, '2019-12-03 02:55:47'),
(47, 16, 13, 1, '93018', 0, 0, '2019-12-03 03:00:27'),
(48, 16, 19, 1, '64631', 0, 0, '2019-12-03 03:03:15'),
(49, 16, 18, 1, '87732', 0, 0, '2019-12-03 03:04:45'),
(50, 16, 19, 1, '77453', 0, 0, '2019-12-03 03:07:02'),
(51, 16, 19, 1, '26255', 0, 0, '2019-12-03 03:07:34'),
(52, 40, 19, 2, '52278', 0, 0, '2019-12-03 03:11:15'),
(53, 16, 12, 1, '90087', 0, 0, '2019-12-03 03:19:34'),
(54, 16, 17, 1, '90087', 0, 0, '2019-12-03 03:19:34'),
(55, 16, 19, 2, '10574', 0, 0, '2019-12-03 03:27:55'),
(56, 16, 18, 1, '7165', 0, 0, '2019-12-16 09:50:44'),
(57, 16, 18, 1, '79362', 0, 0, '2019-12-16 09:51:36');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`news_id`);

--
-- Chỉ mục cho bảng `tbl_news_post`
--
ALTER TABLE `tbl_news_post`
  ADD PRIMARY KEY (`news_post_id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `tbl_product_detail_image_slider`
--
ALTER TABLE `tbl_product_detail_image_slider`
  ADD PRIMARY KEY (`product_detail_image_slider_id`);

--
-- Chỉ mục cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Chỉ mục cho bảng `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_news_post`
--
ALTER TABLE `tbl_news_post`
  MODIFY `news_post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `tbl_product_detail_image_slider`
--
ALTER TABLE `tbl_product_detail_image_slider`
  MODIFY `product_detail_image_slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
