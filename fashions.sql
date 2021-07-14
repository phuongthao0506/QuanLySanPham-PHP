-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th7 08, 2021 lúc 10:40 AM
-- Phiên bản máy phục vụ: 10.4.19-MariaDB
-- Phiên bản PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `fashions`
--
DROP SCHEMA IF EXISTS `fashions`;
CREATE SCHEMA IF NOT EXISTS `fashions` DEFAULT CHARACTER SET utf8;
USE `fashions`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `amount`, `quantity`, `image`, `type`) VALUES
(8, 'DN001', 'Đầm nữ xanh  dài', 200000, 200, 'DN1.jpeg', 2),
(10, 'DN002', 'Đầm trắng xẻ tà', 100000, 1200, 'DN2.jpeg', 2),
(23, 'DN003', 'Đầm hoa nhí', 150000, 900, 'DN3.jpeg', 2),
(24, 'DN004', 'Đầm sọc xanh trắng', 180000, 500, 'DN4.jpeg', 2),
(29, 'AN002', 'Áo croptop xanh', 100000, 180, 'AN2.jpeg', 1),
(26, 'DN005', 'Đầm trắng xoè', 300000, 200, 'DN5.jpeg', 2),
(27, 'AN001', 'Áo trắng tay bồng', 120000, 450, 'AN1.jpeg', 1),
(30, 'AN003', 'Áo tay ngắn cam', 200000, 400000, 'AN3.jpeg', 1),
(31, 'AN004', 'Áo vạt chéo', 230000, 130, 'AN4.jpeg', 1),
(32, 'AN005', 'Áo nâu nhún', 230000, 290, 'AN5.jpeg', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
