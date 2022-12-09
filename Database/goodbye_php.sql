-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 09, 2021 lúc 11:12 AM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `goodbye_php`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user.jpg',
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `decentralization` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'customer',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookstore`
--

CREATE TABLE `bookstore` (
  `id` int(11) NOT NULL,
  `name_book` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kind_of_book` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `describe_book` text COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `price_book` float NOT NULL,
  `sale_book` float NOT NULL DEFAULT 0,
  `status_book` int(11) NOT NULL DEFAULT 1,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `judge`
--

CREATE TABLE `judge` (
  `id` int(11) NOT NULL,
  `id_account` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name_orderer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_orderer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_orderer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number_orderer` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `note_orderer` text COLLATE utf8_unicode_ci NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `total` float NOT NULL,
  `status` int(11) DEFAULT NULL,
  `note_order` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `response_at` datetime DEFAULT NULL,
  `feedback_at` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_bookstore` int(11) NOT NULL,
  `name_book` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `preventive_order`
--

CREATE TABLE `preventive_order` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name_orderer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_orderer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_orderer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number_orderer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note_orderer` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_quantity` int(11) NOT NULL,
  `total` float NOT NULL,
  `status` int(11) DEFAULT NULL,
  `note_order` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `response_at` datetime DEFAULT NULL,
  `feedback_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `preventive_order_details`
--

CREATE TABLE `preventive_order_details` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_bookstore` int(11) NOT NULL,
  `name_book` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bookstore`
--
ALTER TABLE `bookstore`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `judge`
--
ALTER TABLE `judge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kf_judge2` (`id_account`),
  ADD KEY `kf_judge22` (`id_book`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kf_user_id2` (`id_user`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kf_bookor` (`id_bookstore`),
  ADD KEY `kf_orderor` (`id_order`);

--
-- Chỉ mục cho bảng `preventive_order`
--
ALTER TABLE `preventive_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sad` (`id_user`);

--
-- Chỉ mục cho bảng `preventive_order_details`
--
ALTER TABLE `preventive_order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kf_book_pre` (`id_bookstore`),
  ADD KEY `kf_pe_order` (`id_order`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `bookstore`
--
ALTER TABLE `bookstore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `judge`
--
ALTER TABLE `judge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `preventive_order`
--
ALTER TABLE `preventive_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `preventive_order_details`
--
ALTER TABLE `preventive_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `judge`
--
ALTER TABLE `judge`
  ADD CONSTRAINT `kf_judge` FOREIGN KEY (`id_account`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kf_judge22` FOREIGN KEY (`id_book`) REFERENCES `bookstore` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `kf_user_id2` FOREIGN KEY (`id_user`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `kf_bookor` FOREIGN KEY (`id_bookstore`) REFERENCES `bookstore` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kf_orderor` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `preventive_order`
--
ALTER TABLE `preventive_order`
  ADD CONSTRAINT `sad` FOREIGN KEY (`id_user`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `preventive_order_details`
--
ALTER TABLE `preventive_order_details`
  ADD CONSTRAINT `kf_book_pre` FOREIGN KEY (`id_bookstore`) REFERENCES `bookstore` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kf_pe_order` FOREIGN KEY (`id_order`) REFERENCES `preventive_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
