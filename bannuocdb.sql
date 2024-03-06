-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2023 at 01:51 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bannuocdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cthoadon`
--

CREATE TABLE `cthoadon` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_sanpham` int(10) UNSIGNED NOT NULL,
  `id_hoadon` int(10) UNSIGNED NOT NULL,
  `so_luong` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cthoadon`
--

INSERT INTO `cthoadon` (`id`, `id_sanpham`, `id_hoadon`, `so_luong`) VALUES
(5, 6, 7, 2),
(6, 7, 7, 4),
(7, 8, 7, 3),
(8, 5, 7, 2),
(9, 4, 8, 1),
(10, 2, 8, 1),
(11, 1, 8, 4),
(12, 8, 9, 7),
(13, 4, 10, 1),
(14, 9, 10, 1),
(15, 8, 10, 1),
(16, 1, 10, 1),
(17, 3, 10, 4),
(18, 11, 10, 4),
(19, 10, 10, 1),
(20, 1, 11, 2),
(21, 3, 11, 2),
(22, 6, 11, 8),
(23, 4, 11, 3),
(24, 5, 11, 2),
(25, 3, 12, 5),
(28, 8, 15, 1),
(29, 7, 15, 4),
(30, 9, 15, 1),
(31, 5, 16, 1),
(32, 4, 16, 1),
(33, 6, 16, 1),
(34, 5, 17, 1),
(35, 4, 17, 1),
(36, 6, 17, 1),
(37, 5, 18, 1),
(38, 4, 18, 1),
(39, 6, 18, 1),
(40, 5, 19, 1),
(41, 4, 19, 1),
(42, 6, 19, 1),
(43, 10, 24, 1),
(44, 11, 24, 1),
(45, 3, 24, 1),
(46, 12, 24, 1),
(47, 5, 25, 1),
(48, 6, 26, 1),
(49, 5, 26, 4),
(51, 3, 28, 5),
(52, 6, 29, 1),
(53, 6, 30, 1),
(54, 11, 31, 1),
(55, 12, 32, 1),
(56, 3, 33, 1),
(57, 10, 34, 1),
(58, 1, 35, 1),
(59, 8, 36, 1),
(60, 6, 37, 1),
(61, 4, 37, 1),
(62, 6, 39, 3),
(63, 6, 40, 1),
(64, 7, 40, 1),
(65, 6, 41, 1),
(66, 4, 41, 1),
(67, 1, 42, 1),
(68, 7, 43, 1),
(69, 8, 43, 1),
(70, 7, 44, 1),
(71, 8, 44, 1),
(74, 4, 46, 3),
(75, 6, 46, 4),
(76, 9, 46, 6),
(77, 5, 46, 4),
(78, 1, 46, 1),
(80, 5, 48, 1),
(81, 4, 52, 1),
(82, 4, 53, 1),
(83, 9, 54, 1),
(85, 5, 56, 1),
(86, 4, 57, 1),
(87, 6, 58, 1),
(88, 5, 59, 1),
(89, 4, 60, 1),
(90, 5, 61, 1),
(91, 9, 62, 1),
(92, 1, 63, 1),
(93, 1, 64, 3),
(94, 4, 65, 1),
(95, 3, 66, 1),
(96, 1, 67, 1),
(97, 11, 67, 1),
(98, 1, 68, 2),
(99, 2, 68, 6),
(100, 3, 68, 2),
(101, 6, 69, 1),
(102, 7, 69, 1),
(103, 8, 69, 1),
(104, 9, 69, 1),
(105, 1, 70, 1),
(106, 10, 70, 1),
(107, 11, 70, 1),
(108, 12, 70, 1),
(109, 1, 71, 2),
(110, 5, 71, 2),
(111, 6, 71, 2),
(112, 4, 71, 2),
(113, 1, 72, 1),
(114, 3, 72, 1),
(115, 6, 72, 7),
(116, 8, 73, 3),
(118, 4, 75, 7),
(119, 5, 76, 2),
(120, 6, 76, 1),
(121, 7, 76, 2),
(122, 5, 77, 1),
(123, 6, 77, 3),
(124, 1, 77, 4),
(125, 2, 77, 6),
(126, 26, 81, 1),
(127, 27, 81, 1),
(129, 5, 83, 1),
(130, 6, 83, 1),
(131, 4, 83, 1),
(132, 8, 83, 2),
(133, 7, 83, 2),
(134, 9, 83, 2),
(135, 1, 84, 1),
(136, 2, 84, 1),
(137, 3, 84, 1),
(138, 6, 84, 1),
(139, 29, 84, 3),
(140, 31, 84, 2),
(143, 27, 87, 4),
(144, 8, 88, 3),
(145, 46, 88, 3),
(146, 2, 89, 2),
(147, 49, 89, 2),
(148, 26, 90, 1),
(149, 28, 90, 1),
(150, 13, 90, 1),
(153, 7, 92, 1),
(154, 35, 93, 2),
(155, 35, 94, 1),
(156, 5, 95, 2),
(157, 6, 95, 2),
(158, 7, 95, 2),
(159, 8, 95, 1),
(160, 2, 95, 2),
(161, 27, 96, 1),
(162, 26, 96, 3),
(163, 2, 97, 2),
(164, 3, 97, 1),
(165, 1, 97, 2),
(166, 35, 98, 1),
(167, 40, 98, 1),
(168, 6, 99, 1),
(169, 46, 99, 2),
(170, 6, 100, 1),
(171, 39, 100, 2),
(172, 46, 101, 1),
(173, 1, 101, 1),
(174, 2, 101, 1),
(175, 14, 101, 1),
(176, 18, 101, 2),
(177, 22, 101, 1),
(178, 26, 102, 2),
(179, 5, 103, 1),
(180, 6, 103, 1),
(181, 7, 103, 1),
(182, 1, 103, 1),
(183, 26, 103, 1),
(184, 36, 103, 7),
(185, 37, 103, 2),
(186, 38, 103, 1),
(187, 39, 103, 1),
(188, 34, 104, 1),
(189, 2, 105, 11),
(190, 11, 105, 1),
(191, 9, 105, 3),
(192, 9, 106, 1),
(193, 8, 106, 1),
(194, 6, 107, 1),
(195, 7, 107, 1),
(198, 26, 109, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ctphieunhap`
--

CREATE TABLE `ctphieunhap` (
  `id_phieunhap` int(10) UNSIGNED NOT NULL,
  `id_sp` int(10) UNSIGNED NOT NULL,
  `so_luong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ctphieunhap`
--

INSERT INTO `ctphieunhap` (`id_phieunhap`, `id_sp`, `so_luong`) VALUES
(2, 52, 50),
(3, 53, 10),
(4, 54, 10);

-- --------------------------------------------------------

--
-- Table structure for table `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten_danhmuc` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `danhmuc`
--

INSERT INTO `danhmuc` (`id`, `ten_danhmuc`) VALUES
(1, 'Hóa đơn'),
(2, 'Thống kê'),
(5, 'Khách hàng'),
(7, 'Sản phẩm'),
(8, 'Thể loại'),
(9, 'Phiếu nhập'),
(10, 'Tài khoản'),
(11, 'Danh mục'),
(12, 'Nhà cung cấp'),
(13, 'Nhân viên'),
(14, 'Đổi mật khẩu');

-- --------------------------------------------------------

--
-- Table structure for table `hinhanhsp`
--

CREATE TABLE `hinhanhsp` (
  `id` int(10) UNSIGNED NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  `id_sp` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hinhanhsp`
--

INSERT INTO `hinhanhsp` (`id`, `hinh_anh`, `id_sp`) VALUES
(1, 'AoThun1.jpg', 1),
(2, 'AoThun2.jpg', 2),
(3, 'AoThun3.jpg', 3),
(4, 'AoThun_4.jpg', 4),
(5, 'AoThun_5.jpg', 5),
(6, 'AoThun_6.jpg', 6),
(7, 'AoPoLo1.jpg', 7),
(8, 'AoPoLo2.jpg', 8),
(9, 'AoPoLo3.jpg', 9),
(10, 'AoPoLo4.jpg', 10),
(11, 'AoPoLo5.jpg', 11),
(12, 'AoPoLo6.jpg', 12),
(13, 'AoSoMi1.jpg', 13),
(14, 'AoSoMi2.jpg', 14),
(15, 'AoSoMi3.jpg', 15),
(16, 'AoSoMi4.jpg', 16),
(17, 'AoSoMi5.jpg', 17),
(18, 'AoSoMi6.jpg', 18),
(19, 'QuanJean1.jpg', 19),
(20, 'QuanJean2.jpg', 20),
(21, 'QuanJean3.jpg', 21),
(22, 'QuanJean4.jpg', 22),
(23, 'QuanJean5.jpg', 23),
(24, 'QuanJean6.jpg', 24),
(25, 'QuanTay1.jpg', 25),
(26, 'QuanTay2.jpg', 26),
(27, 'QuanTay3.jpg', 27),
(28, 'QuanTay4.jpg', 28),
(29, 'QuanTay5.jpg', 29),
(30, 'QuanTay6.jpg', 30),
(31, 'QuanKaKi1.jpg', 31),
(32, 'QuanKaKi2.jpg', 32),
(33, 'QuanKaKi3.jpg', 33),
(34, 'QuanKaKi4.jpg', 34),
(35, 'QuanKaKi5.jpg', 35),
(36, 'QuanKaKi6.jpg', 36),
(37, 'AoThun1_1.jpg', 1),
(38, 'AoThun1_2.jpg', 1),
(39, 'AoThun2_1.jpg', 2),
(40, 'AoThun2_2.jpg', 2),
(41, 'AoThun3_1.jpg', 3),
(42, 'AoThun3_2.jpg', 3),
(43, 'AoThun_4_1.jpg', 4),
(44, 'AoThun_4_2.jpg', 4),
(45, 'AoThun_5_1.jpg', 5),
(46, 'AoThun_5_2.jpg', 5),
(47, 'AoThun_6_1.jpg', 6),
(48, 'AoThun_6_2.jpg', 6),
(49, 'AoPolo1_1.jpg', 7),
(50, 'AoPolo1_2.jpg', 7),
(51, 'AoPolo2_2.jpg', 8),
(52, 'AoPolo2_2.jpg', 8),
(53, 'AoPoLo3_1.jpg', 9),
(54, 'AoPolo3_2.jpg', 9),
(55, 'AoPolo4_1.jpg', 10),
(56, 'AoPolo4_2.jpg', 10),
(57, 'AoPolo5_1.jpg', 11),
(58, 'AoPolo5_2.jpg', 11),
(59, 'AoPolo6_1.jpg', 12),
(60, 'AoPolo6_2.jpg', 12),
(61, 'AoSoMi1_1.jpg', 13),
(62, 'AoSoMi1_2.jpg', 13),
(63, 'AoSoMi2_1.jpg', 14),
(64, 'AoSoMi2_2.jpg', 14),
(65, 'AoSoMi3_1.jpg', 15),
(66, 'AoSoMi3_2.jpg', 15),
(67, 'AoSoMi4_1.jpg', 16),
(68, 'AoSoMi4_2.jpg', 16),
(69, 'AoSoMi5_1.jpg', 17),
(70, 'AoSoMi5_2.jpg', 17),
(71, 'AoSoMi6_1.jpg', 18),
(72, 'AoSoMi6_2.jpg', 18),
(73, 'QuanJean1_1.jpg', 19),
(74, 'QuanJean1_2.jpg', 19),
(75, 'QuanJean2_1.jpg', 20),
(76, 'QuanJean2_2.jpg', 20),
(77, 'QuanJean3_1.jpg', 21),
(78, 'QuanJean3_2.jpg', 21),
(79, 'QuanJean4_1.jpg', 22),
(80, 'QuanJean4_2.jpg', 22),
(81, 'QuanJean5_1.jpg', 23),
(82, 'QuanJean5_2.jpg', 23),
(83, 'QuanJean6_1.jpg', 24),
(84, 'QuanJean6_2.jpg', 24),
(85, 'QuanTay1_1.jpg', 25),
(86, 'QuanTay1_2.jpg', 25),
(87, 'QuanTay2_1.jpg', 26),
(88, 'QuanTay2_2.jpg', 26),
(89, 'QuanTay3_1.jpg', 27),
(90, 'QuanTay3_2.jpg', 27),
(91, 'QuanTay4_1.jpg', 28),
(92, 'QuanTay4_2.jpg', 28),
(93, 'QuanTay5_1.jpg', 29),
(94, 'QuanTay5_2.jpg', 29),
(95, 'QuanTay6_1.jpg', 30),
(96, 'QuanTay6_2.jpg', 30),
(97, 'QuanKaKi1_1.jpg', 31),
(98, 'QuanKaKi1_2.jpg', 31),
(99, 'QuanKaKi2_1.jpg', 32),
(100, 'QuanKaKi2_2.jpg', 32),
(101, 'QuanKaKi3_1.jpg', 33),
(102, 'QuanKaKi3_2.jpg', 33),
(103, 'QuanKaKi4_1.jpg', 34),
(104, 'QuanKaKi4_2.jpg', 34),
(105, 'QuanKaKi5_1.jpg', 35),
(106, 'QuanKaKi5_2.jpg', 35),
(107, 'QuanKaKi6_1.jpg', 36),
(108, 'QuanKaKi6_2.jpg', 36),
(109, '304802b33136a13eae5e157c125c7d72.jpg', 37),
(110, 'P06889_1_l.jpg', 37),
(111, 'stt-dutch-lady-cao-khoe-vi-dau-hop-170ml-loc-4-3-1.jpg', 38),
(112, '1e7dd84af654c8a39aed956345befd51.jpg', 38),
(113, 'sfdfsfsf.jpg', 39),
(114, 'loc-4-hop-sua-tuoi-tiet-trung-khong-duong-vinamilk-100-sua-tuoi-180ml-202104091038151238.jpg', 40),
(115, 'sua-tuoi-vinamilk-hop-180ml-co-duong.jpg', 40),
(116, 'sua-tuoi-tiet-trung-vinamilk-220ml-676.jpg', 41),
(117, 'kd_d30b9c547be84e288364ed86d4988d8d_grande.jpg', 41),
(118, '200d9e53691bd10126e6ebe688e9ce21.jpg', 42),
(119, '6-lon-nuoc-tang-luc-warrior-huong-dau-325ml-202103300854176447.jpg', 42),
(120, '1_13.jpg', 43),
(121, '6-chai-nuoc-tang-luc-warrior-nho-330ml-201908082348251932.jpg', 43),
(122, '24-chai-nuoc-tang-luc-warrior-nho-330ml-201908082349345412.jpg', 44),
(123, 'srete3.jpg', 45),
(124, 'Che-phin-5-Trung-Nguyen-331f.jpg', 45),
(125, 'erwrwr.jpg', 45),
(126, 'ca-phe-sua-nescafe-3-in-1-dam-da-hai-hoa-340g-202004251732202397.jpg', 46),
(127, 'a5749bf2284be7eea62cf4c4d1dc1648.jpg', 46),
(128, 'b43262f8b424190d50be66e9bf2ec128.png', 46),
(129, 'gh345f.jpg', 14),
(130, 'nuoc-ngot-mirinda-huong-xa-xi-330ml-202003101804043892.jpg', 14),
(131, '6-chai-nuoc-ngot-pepsi-cola-390ml-202103171112477714.jpg', 47),
(132, '8934588013065-1-4.jpg', 47),
(133, 'GfwJ61UW1YVW.jpeg', 47),
(134, 'fghtydfgs.jpg', 48),
(135, 'f139287a1444b271155f414261289.jpg', 48),
(136, '-202103311105034301.jpg', 48),
(137, '610no2LASdL.-SL1500--x0cp-2u-www.shophangmy.vn-1550810606.jpg', 49),
(138, 'downloasf.jpg', 49),
(139, 'nuoc_ngot_pepsi_light_thung_24__lon_x_330ml_3863a4a31705452ca6b8075c2e16013a_1024x1024.jpg', 49),
(140, 'nuoc_ngot_pepsi_light_loc_6__lon_x_330ml_96356e97abb648afb2a119cfddaaaf87_1024x1024.jpg', 50),
(141, 'nuoc_ngot_pepsi_light_thung_24__lon_x_330ml_3863a4a31705452ca6b8075c2e16013a_1024x1024.jpg', 50),
(149, '', 52),
(150, '', 53),
(151, '320mltwisterlonthung(1).jpg', 52),
(152, '99d02277a94ceb61595bb7d8d2dc(1).jpg', 53),
(153, '', 54),
(154, '', 55);

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_khachhang` int(10) UNSIGNED NOT NULL,
  `tong_tien` int(11) NOT NULL,
  `ngay_tao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_nhanvien` int(10) DEFAULT NULL,
  `trang_thai` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`id`, `id_khachhang`, `tong_tien`, `ngay_tao`, `id_nhanvien`, `trang_thai`) VALUES
(7, 1, 96300, '2021-05-13 09:49:40', NULL, 0),
(8, 1, 57450, '2021-05-13 09:50:03', NULL, 0),
(9, 1, 52500, '2021-05-13 09:50:03', NULL, 0),
(10, 1, 118500, '2021-05-13 09:50:03', NULL, 0),
(11, 2, 166500, '2021-05-13 09:50:03', NULL, 0),
(12, 2, 37500, '2021-05-13 09:50:03', NULL, 0),
(15, 2, 52800, '2021-05-13 09:50:03', 1, 1),
(16, 2, 29500, '2021-05-13 09:50:03', 1, 1),
(17, 2, 29500, '2021-05-13 09:50:03', 1, 1),
(18, 2, 29500, '2021-05-13 09:50:03', 1, 1),
(19, 2, 29500, '2021-05-13 09:50:03', 1, 1),
(24, 2, 36450, '2021-05-13 09:50:03', 1, 1),
(25, 2, 8500, '2021-05-13 09:50:03', 1, 1),
(26, 2, 44500, '2021-05-13 09:50:03', 1, 1),
(27, 2, 8500, '2021-05-13 09:50:03', 1, 1),
(28, 2, 37500, '2021-05-13 09:50:03', NULL, 0),
(29, 2, 10500, '2021-05-13 09:50:03', NULL, 0),
(30, 2, 10500, '2021-05-13 09:50:03', NULL, 0),
(31, 2, 10500, '2021-05-13 09:50:03', NULL, 0),
(32, 2, 8950, '2021-05-13 09:50:03', NULL, 0),
(33, 2, 7500, '2021-05-13 09:50:03', NULL, 0),
(34, 2, 9500, '2021-05-13 09:50:03', NULL, 0),
(35, 2, 9500, '2021-05-13 09:50:03', NULL, 0),
(36, 2, 7500, '2021-05-13 09:50:03', NULL, 0),
(37, 3, 21000, '2021-05-13 10:05:08', 1, 1),
(39, 3, 31500, '2021-05-13 09:50:03', NULL, 0),
(40, 3, 19450, '2021-05-13 09:50:03', NULL, 0),
(41, 3, 21000, '2021-05-13 09:50:03', NULL, 0),
(42, 3, 9500, '2021-05-13 09:50:03', NULL, 0),
(43, 3, 16450, '2021-05-13 09:50:03', NULL, 0),
(44, 3, 16450, '2021-05-13 09:50:03', NULL, 0),
(46, 4, 174000, '2021-05-13 09:50:03', 1, 1),
(48, 4, 8500, '2021-05-13 09:50:03', 1, 1),
(52, 4, 10500, '2021-05-13 09:50:03', 1, 1),
(53, 4, 10500, '2021-05-13 09:50:03', 1, 1),
(54, 4, 9500, '2021-05-13 09:50:03', 1, 1),
(56, 4, 8500, '2021-05-13 10:05:06', 1, 1),
(57, 4, 10500, '2021-05-13 10:05:04', 1, 1),
(58, 4, 10500, '2021-05-13 10:05:00', 1, 1),
(59, 4, 8500, '2021-05-13 10:04:58', 1, 1),
(60, 4, 10500, '2021-05-13 10:04:56', 1, 1),
(61, 4, 8500, '2021-05-13 10:04:50', 1, 1),
(62, 4, 9500, '2021-05-13 10:04:48', 1, 1),
(63, 4, 9500, '2021-05-13 10:04:46', 1, 1),
(64, 4, 28500, '2021-05-13 09:50:03', 1, 1),
(65, 4, 10500, '2021-05-13 09:50:03', 1, 1),
(66, 4, 7500, '2021-05-13 09:50:03', 1, 1),
(67, 4, 20000, '2021-05-13 09:50:03', 1, 1),
(68, 7, 87700, '2021-05-13 09:50:03', 1, 1),
(69, 6, 36450, '2021-05-13 09:50:03', 1, 1),
(70, 6, 38450, '2021-05-13 09:50:03', 1, 1),
(71, 6, 78000, '2021-05-13 09:50:03', 1, 1),
(72, 5, 90500, '2021-05-13 09:50:03', 1, 1),
(73, 5, 22500, '2021-05-13 09:50:03', 1, 1),
(75, 5, 73500, '2021-05-13 09:50:03', 1, 1),
(76, 5, 45400, '2021-05-13 09:50:03', 1, 1),
(77, 6, 131700, '2021-05-13 09:50:03', 1, 1),
(81, 6, 269000, '2021-05-13 09:50:03', 1, 1),
(83, 6, 81400, '2021-05-13 09:50:03', 1, 1),
(84, 6, 564450, '2021-05-13 09:50:03', 1, 1),
(87, 3, 1016000, '2021-05-13 10:02:43', 1, 1),
(88, 7, 232500, '2021-05-13 13:10:37', 1, 1),
(89, 7, 35800, '2021-05-13 13:11:28', 1, 1),
(90, 7, 42600, '2021-05-13 13:23:26', 1, 1),
(92, 9, 8950, '2021-05-13 13:48:02', NULL, 0),
(93, 9, 400000, '2021-05-13 13:50:00', 1, 1),
(94, 8, 200000, '2021-05-13 14:25:24', NULL, 0),
(95, 2, 81300, '2021-05-14 03:46:31', 1, 1),
(96, 1, 299000, '2021-05-14 03:47:21', NULL, 0),
(97, 1, 44400, '2021-05-14 03:48:33', NULL, 0),
(98, 1, 224200, '2021-05-14 03:49:07', NULL, 0),
(99, 1, 150500, '2021-05-14 03:52:56', NULL, 0),
(100, 3, 340500, '2021-05-14 03:57:38', 1, 1),
(101, 3, 136350, '2021-05-14 03:58:05', NULL, 0),
(102, 3, 30000, '2021-05-14 04:38:04', NULL, 0),
(103, 3, 408950, '2021-05-14 06:01:00', 1, 1),
(104, 3, 45000, '2021-05-14 06:40:59', NULL, 0),
(105, 3, 137450, '2021-05-14 08:04:48', NULL, 0),
(106, 6, 17000, '2021-05-14 13:22:17', NULL, 0),
(107, 6, 19950, '2021-05-14 14:18:36', NULL, 0),
(109, 10, 15000, '2021-05-15 02:54:50', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten_kh` varchar(191) NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  `ten_dangnhap` varchar(191) NOT NULL,
  `mat_khau` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `dia_chi` varchar(191) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `ngay_tao` timestamp NOT NULL DEFAULT current_timestamp(),
  `ngay_sua` timestamp NOT NULL DEFAULT current_timestamp(),
  `tong_tien_muahang` int(11) NOT NULL,
  `trangthai` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`id`, `ten_kh`, `hinh_anh`, `ten_dangnhap`, `mat_khau`, `email`, `dia_chi`, `phone`, `ngay_tao`, `ngay_sua`, `tong_tien_muahang`, `trangthai`) VALUES
(1, 'Nguyen Van P', '', 'user123', '12345', 'BBBBbbb@gmail.com', '321 Đồng Văn Cống, Quận 2', '098999999', '2021-05-10 14:12:04', '2021-05-10 12:35:47', 1042850, 1),
(2, 'Nguyen Van A', '', 'user1234', '123456', 'wewewew@gmail.com', '99 An Dương Vương, phường 16, quận 8, Thành phố Hồ Chí Minh', '0985123131', '2021-05-10 14:17:13', '2021-05-10 12:58:31', 575700, 0),
(3, 'Phan Hữu Cường', '', 'abcdef', 'abcdef', 'abdc@gmail.com', 'Đồng Nai', '0969295720', '2021-05-11 03:38:01', '2021-05-14 07:10:19', 2266050, 0),
(4, 'Phạm Nguyên', '', 'nguyen123', '124532', 'nugyen_pham123@yahoo.com', 'Huyện Nhà Bè, TP. Hồ Chí Minh', '075472323', '2021-05-11 03:40:51', '2021-05-10 22:12:47', 372500, 0),
(5, 'Tấn Trọng Bùi', '', 'buitan', '12345', 'ngocbau2015tqk@gmail.com', '99 An Dương Vương, phường 16, quận 8, Thành phố Hồ Chí Minh', '0969295720', '2021-05-12 09:15:51', '2021-05-12 11:15:12', 306900, 0),
(6, 'Nguyễn Ngọc Báu', '', 'admin', 'admin', 'ngocbau2015tqk@gmail.com', 'Tx. Ninh Hòa, Tỉnh KHánh Hòa', '0969295720', '2021-05-12 10:23:23', '2021-05-14 08:39:09', 2322794, 0),
(7, 'Bùi Tấn Âu', '', 'aubui17', '1234567', 'aubui17@gmail.com', '99 An Dương Vương, P16, Q8, Tp.HCM', '0387070222', '2021-05-12 10:25:12', '2021-05-13 13:24:39', 433600, 0),
(8, 'Nguyeenx Thij P', '', '4tgsgs', 'ư36tgsd', 'wrwrewrw@bgt', 'wrwrwrwrwrw', '0014245683', '2021-05-13 10:41:49', '2021-05-13 14:11:25', 200000, 0),
(9, '', '', 'abcbdfe', '123456', '575@dfdfdf.c', '', '6786786333', '2021-05-13 13:46:31', '2021-05-13 13:46:31', 408950, 0),
(10, '', '', 'asdfg', 'asdfg', 'abcs@gmail.com', '', '0969295720', '2021-05-15 02:51:36', '2021-05-15 02:51:36', 115000, 0),
(11, '', '', 'huynhdinhphuc', 'huynhdinhphuc123', 'huynhdinhphuccubes@gmail.com', '', '0383363223', '2023-11-16 00:23:45', '2023-11-16 00:23:45', 453500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten_ncc` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `web_site` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `ngay_tao` timestamp NOT NULL DEFAULT current_timestamp(),
  `ngay_sua` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nhacungcap`
--

INSERT INTO `nhacungcap` (`id`, `ten_ncc`, `email`, `web_site`, `logo`, `phone`, `ngay_tao`, `ngay_sua`) VALUES
(1, 'Công Ty Yody', 'yody@gmail.com', 'http://www.yody.com/', 'https://www.google.com.vn/url?sa=i&url=https%3A%2F%2F1000logos.net%2Fcoca-cola-logo%2F&psig=AOvVaw12lW3W89SleklNVXWrh4wK&ust=1617461914606000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCJjCi7Dp3-8CFQAAAAAdAAAAABAD', '0932898324', '2021-04-15 10:28:52', '2021-04-15 10:28:52'),
(2, 'Công Ty Elise', 'congtyElise@gmail.com', 'https://www.elisevietnam.com/', 'https://www.google.com.vn/url?sa=i&url=https%3A%2F%2F1000logos.net%2Fcoca-cola-logo%2F&psig=AOvVaw12lW3W89SleklNVXWrh4wK&ust=1617461914606000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCJjCi7Dp3-8CFQAAAAAdAAAAABAD', '091234567', '2021-04-15 10:30:31', '2021-04-15 10:30:31'),
(3, 'Công ty cổ phần Maison Retail Management International', 'MRMI_vietnam,@gmail.com', 'https://www.MRMI_vn.vn/product/index/Maison_Retail_Management_International', 'https://www.google.com.vn/url?sa=i&url=https%3A%2F%2Fworldvectorlogo.com%2Flogo%2Ftropicana-twister-soda&psig=AOvVaw0STYR7jBWWv22HP8-88aw4&ust=1617464416594000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCJDmrNXy3-8CFQAAAAAdAAAAABAD', '0924892442', '2021-04-15 10:31:44', '2021-04-15 10:31:44'),
(4, 'Công ty TNHH Thương mại thời trang 3C', 'thoitrang3C@gmail.com', 'https://www.tt3C.com.vn', 'https://www.thp.com.vn/wp-content/uploads/2017/01/cropped-thp.png', '0924832442', '2021-04-15 10:32:56', '2021-04-15 10:32:56'),
(5, 'Công ty cổ phần thời trang Bimart', 'Bimart@gmail.com', 'https://bimart.com.vn/', 'https://bimart.com.vn/templates/images/logo.png', '0384832442', '2021-04-15 10:33:54', '2021-04-15 10:33:54'),
(6, 'Công ty TNHH thời trang H&A', 'H&A@gmail.com', 'thoitrangH&A.com.vn', 'none', '0384832442', '2021-05-12 17:50:19', '2021-05-12 17:50:19'),
(7, 'Công ty thời trang Nam Linh', 'namlinh@mgail.com', 'namlinhvn.com', 'none', '0924892442', '2021-05-13 02:24:32', '2021-05-13 02:24:32'),
(8, 'SIXDO', 'sixdo@gmail.com', 'htttp:\\\\sixdo/com', 'none', '064534543423', '2021-05-13 02:24:32', '2021-05-13 02:24:32'),
(9, 'VMG', 'VMG@gmail.com', 'vmg.vn', 'none', '0924892442', '2021-05-13 02:35:24', '2021-05-13 02:35:24'),
(10, 'Công ty thời trang Việt', 'thoitrangviet@gmail.com', 'ttviet.vn', 'none', '064534543423', '2021-05-13 02:35:24', '2021-05-13 02:35:24'),
(11, 'Smaker Clothing', 'Smaker@gmail.com', 'Smaker.com', 'none', '054646332', '2021-05-13 02:36:52', '2021-05-13 02:36:52'),
(12, 'ClownZ', 'ClownZ@gmail.com', 'ClownZ.com', 'none', '0924832442', '2021-05-13 02:37:28', '2021-05-13 02:37:28'),
(13, 'Dirty Coins', 'dirtycoins@gmail.com', 'DC.com', 'none', '046342435', '2021-05-13 02:37:28', '2021-05-13 02:37:28'),
(14, 'Grimm DC', 'grimDC@gmail.com', 'grimdc.com', 'none', '023423242', '2021-05-13 02:39:05', '2021-05-13 02:39:05'),
(15, 'Hades ', 'hades@gmail.com', 'hades.com', 'none', '093434223', '2021-05-13 02:39:05', '2021-05-13 02:39:05'),
(16, 'Badhabits', 'badhabits@gmail.com', 'badhabit.com', 'none', '08953543333', '2021-05-13 02:40:48', '2021-05-13 02:40:48'),
(17, 'Have Fun With The Homie', 'hfwth@gmail.com', 'hfwth.com', 'none', '07687543', '2021-05-13 02:40:48', '2021-05-13 02:40:48'),
(18, 'Now Sagion', 'Now_SG@gmail.com', 'Now_SG.com', 'none', '05462542', '2021-05-13 02:42:00', '2021-05-13 02:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten_nv` varchar(191) NOT NULL,
  `ten_dangnhap` varchar(191) NOT NULL,
  `mat_khau` varchar(191) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  `email` varchar(191) NOT NULL,
  `ngay_tao` timestamp NOT NULL DEFAULT current_timestamp(),
  `ngay_sua` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`id`, `ten_nv`, `ten_dangnhap`, `mat_khau`, `phone`, `hinh_anh`, `email`, `ngay_tao`, `ngay_sua`) VALUES
(1, 'admin 1', 'admin', '', '0353535353', '4567', '355353@jkdsgsd.sdf', '2021-05-12 15:32:29', '2021-05-12 15:32:29'),
(2, 'quan ly', 'quanly', '', '', '', '', '2021-05-12 15:33:12', '2021-05-12 15:33:12'),
(3, 'phamducmanh', 'nhanvien', '', '0383363223', '', 'huynhdinhphuccubes@gmail.com', '2021-05-12 15:33:41', '2021-05-12 15:33:41'),
(4, 'sp11', '', '', '013032', '', 'ádjk', '2021-05-12 15:34:10', '2021-05-12 15:34:10'),
(5, 'sp13', '', '', 'xcv', '', 'cxv', '2021-05-12 15:34:47', '2021-05-12 15:34:47');

-- --------------------------------------------------------

--
-- Table structure for table `phieunhap`
--

CREATE TABLE `phieunhap` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_nv` int(10) UNSIGNED NOT NULL,
  `tong_tien` int(11) NOT NULL,
  `ngay_tao` timestamp NOT NULL DEFAULT current_timestamp(),
  `nguoi_nhan` varchar(50) NOT NULL,
  `sdt` int(11) NOT NULL,
  `diachi` varchar(50) NOT NULL,
  `ghichu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `phieunhap`
--

INSERT INTO `phieunhap` (`id`, `id_nv`, `tong_tien`, `ngay_tao`, `nguoi_nhan`, `sdt`, `diachi`, `ghichu`) VALUES
(2, 1, 275000, '2021-05-14 13:37:13', 'ABCDEF', 987654332, '23 fefdg ', 'test'),
(3, 1, 55000, '2021-05-14 14:10:15', 'ABCDEF', 987654332, '23 fefdg ', 'test'),
(4, 1, 110000, '2021-05-15 03:07:17', 'ABCDEF', 987654332, '23 fefdg ', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `quyen`
--

CREATE TABLE `quyen` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten_quyen` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quyen`
--

INSERT INTO `quyen` (`id`, `ten_quyen`) VALUES
(1, 'admin'),
(2, 'Quản lý'),
(3, 'Nhân viên'),
(4, 'Tự chọn'),
(6, 'ABC');

-- --------------------------------------------------------

--
-- Table structure for table `quyendahmuc`
--

CREATE TABLE `quyendahmuc` (
  `id_quyen` int(10) UNSIGNED NOT NULL,
  `id_danhmuc` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quyendahmuc`
--

INSERT INTO `quyendahmuc` (`id_quyen`, `id_danhmuc`) VALUES
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 11),
(3, 1),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(4, 1),
(4, 2),
(1, 1),
(1, 2),
(1, 5),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(6, 1),
(6, 2),
(6, 7),
(6, 8);

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten_sp` varchar(191) NOT NULL,
  `don_gia` int(11) NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  `noi_dung` varchar(191) NOT NULL,
  `id_the_loai` int(10) UNSIGNED NOT NULL,
  `id_nha_cc` int(10) UNSIGNED NOT NULL,
  `so_luong` tinyint(4) NOT NULL,
  `sl_da_ban` tinyint(4) NOT NULL,
  `ngay_tao` timestamp NOT NULL DEFAULT current_timestamp(),
  `ngay_sua` timestamp NOT NULL DEFAULT current_timestamp(),
  `trangthai` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id`, `ten_sp`, `don_gia`, `hinh_anh`, `noi_dung`, `id_the_loai`, `id_nha_cc`, `so_luong`, `sl_da_ban`, `ngay_tao`, `ngay_sua`, `trangthai`) VALUES
(1, 'ÁO THUN LOANG MÀU BALANCE NAM', 445000, 'AoThun1.jpg', 'Màu sắc: Họa tiết Tím cà', 1, 1, 26, 27, '2021-04-15 10:37:34', '0000-00-00 00:00:00', 0),
(2, 'ÁO THUN NAM DÀI TAY NAM\r\n\r\n', 222500, 'AoThun2.jpg', 'Màu sắc: Be sáng', 1, 1, 19, 31, '2021-04-15 10:39:21', '2021-04-15 10:39:21', 0),
(3, 'ÁO THUN TRƠN SLIM FIT NAM\r\n', 207000, 'AoThun3.jpg', 'Màu sắc: Đen', 1, 3, 43, 14, '2021-04-15 10:40:44', '2021-04-15 10:40:44', 0),
(4, 'ÁO THUN WONDER NỮ', 425000, 'AoThun_4.jpg', 'Màu sắc: Hồng tím\r\n\r\n', 1, 4, 32, 21, '2021-04-15 10:42:35', '2021-04-15 10:42:35', 0),
(5, 'ÁO THUN LADIES TAY DÀI NỮ\r\n', 237000, 'AoThun_5.jpg', 'Màu sắc: Xanh dương', 1, 5, 31, 20, '2021-04-15 10:43:51', '0000-00-00 00:00:00', 0),
(6, 'ÁO THUN CỔ CHÉO CHỮ V NỮ\r\n', 355000, 'AoThun_6.jpg', 'Màu sắc: Hồng tím', 1, 5, 21, 38, '2021-04-15 10:44:47', '0000-00-00 00:00:00', 0),
(7, 'ÁO POLO PHỐI KẺ NAM', 237000, 'AoPoLo1.jpg', 'Màu sắc: Xanh cổ vịt', 2, 5, 39, 19, '2021-04-15 10:45:58', '2021-04-15 10:45:58', 0),
(8, 'ÁO POLO SUÔNG NAM', 207000, 'AoPoLo2.jpg', 'Màu sắc: Họa tiết Bạc hà', 2, 4, 25, 30, '2021-04-15 10:47:36', '0000-00-00 00:00:00', 0),
(9, 'ÁO POLO KẺ NGANG NAM', 207000, 'AoPoLo3.jpg', 'Màu sắc: Kẻ Xanh dương đậm', 2, 8, 33, 18, '2021-04-15 10:51:33', '2021-04-15 10:51:33', 0),
(10, 'ÁO THUN CROPTOP CỔ VUÔNG NỮ\r\n', 490000, 'AoPoLo4.jpg', 'Màu sắc: Cam đỏ\r\n\r\n', 2, 13, 49, 3, '2021-04-15 10:53:07', '0000-00-00 00:00:00', 0),
(11, 'ÁO THUN ÔM DÁNG CROPTOP NỮ\r\n', 237000, 'AoPoLo5.jpg', 'Màu sắc: Đen', 2, 16, 47, 5, '2021-04-15 10:54:27', '2021-04-15 10:54:27', 0),
(12, 'ÁO CROPTOP LỤA HỌA TIẾT KẺ NGANG NỮ\r\n', 500000, 'AoPoLo6.jpg', 'Màu sắc: Họa tiết Xanh tím than\r\n\r\n', 2, 17, 49, 3, '2021-04-15 10:55:19', '2021-04-15 10:55:19', 0),
(13, 'ÁO SƠ MI HỌA TIẾT MONOGRAM NAM\r\n', 322000, 'AoSoMi1.jpg', 'Màu sắc: Họa tiết Xanh oliu', 3, 6, 49, 1, '2021-05-12 17:51:12', '2021-05-12 17:51:12', 0),
(14, 'ÁO SƠ MI NAM 2 TÚI\r\n', 297000, 'AoSoMi2.jpg', 'Màu sắc: Kẻ Đỏ tươi', 3, 14, 49, 1, '2021-05-12 17:56:00', '2021-05-12 17:56:00', 0),
(15, 'ÁO SƠ MI KHAKI TÚI NGỰC NAM\r\n', 500000, 'AoSoMi3.jpg', 'Màu sắc: Be vàng', 3, 2, 50, 0, '2021-05-12 17:56:00', '2021-05-12 17:56:00', 0),
(16, 'ÁO SƠ MI XẾP TÀ PEPLUM NỮ\r\n\r\n', 272500, 'AoSoMi4.jpg', 'Màu sắc: Xanh ghi đá', 3, 1, 50, 0, '2021-05-12 18:01:19', '2021-05-12 18:01:19', 0),
(17, 'ÁO SƠ MI ĐÍNH HOA NỮ\r\n', 287000, 'AoSoMi5.jpg', 'Màu sắc: Trắng', 3, 7, 50, 0, '2021-05-12 18:28:16', '2021-05-12 18:28:16', 0),
(18, 'ÁO SƠ MI LỤA CỔ KIỂU NỮ\r\n\r\n', 272500, 'AoSoMi6.jpg', 'Màu sắc: Xanh matcha', 3, 16, 48, 2, '2021-05-12 18:31:22', '2021-05-12 18:31:22', 0),
(19, 'QUẦN BÒ SLIM FIT NAM\r\n', 300000, 'QuanJean1.jpg', 'Màu sắc: Xanh ghi đá', 4, 17, 50, 0, '2021-05-12 18:31:22', '2021-05-12 18:31:22', 0),
(20, 'QUẦN BÒ REGULAR FIT NAM\r\n ', 250000, 'QuanJean2.jpg', 'Màu sắc: Xanh ghi đá\r\n\r\n', 4, 18, 50, 0, '2021-05-12 18:31:22', '2021-05-12 18:31:22', 0),
(21, 'QUẦN BÒ ĐEN DÁNG SLIM FIT NAM\r\n ', 320000, 'QuanJean3.jpg', 'Màu sắc: Đen', 4, 15, 50, 0, '2021-05-12 18:35:24', '2021-05-12 18:35:24', 0),
(22, 'QUẦN BÒ PHỐI TÚI SƯỜN NỮ\r\n', 260000, 'QuanJean4.jpg', 'Màu sắc: Xanh ghi đá', 4, 16, 49, 1, '2021-05-13 02:11:49', '2021-05-13 02:11:49', 0),
(23, 'QUẦN JEANS SKINNY BASIC NỮ\r\n', 350000, 'QuanJean5.jpg', 'Màu sắc: Đen', 4, 12, 50, 0, '2021-05-13 02:11:49', '2021-05-13 02:11:49', 0),
(24, 'QUẦN JEANS LOE XẺ GẤU NỮ\r\n', 450000, 'QuanJean6.jpg', 'Màu sắc: Xanh ghi đá\r\n\r\n', 4, 4, 50, 0, '2021-05-13 02:11:49', '2021-05-13 02:11:49', 0),
(25, 'QUẦN ÂU KẺ CARO NAM\r\n', 375000, 'QuanTay1.jpg', 'Màu sắc: Kẻ Ghi khói', 5, 16, 50, 0, '2021-05-13 02:11:49', '2021-05-13 02:11:49', 0),
(26, 'QUẦN DÀI KẺ DÁNG SLIM NAM\r\n', 337000, 'QuanTay2.jpg', 'Màu sắc: Kẻ Nâu socola\r\n\r\n', 5, 7, 34, 16, '2021-05-13 02:26:46', '2021-05-13 02:26:46', 0),
(27, 'QUẦN ÂU NAM DÁNG SLIM NAM\r\n', 254000, 'QuanTay3.jpg', 'Màu sắc: Ghi khói\r\n\r\n', 5, 7, 44, 6, '2021-05-13 02:26:46', '2021-05-13 02:26:46', 0),
(28, 'QUẦN TÂY DÀI ỐNG SUÔNG KÉO KHÓA NỮ\r\n', 500000, 'QuanTay4.jpg', 'Màu sắc: Trắng\r\n\r\n', 5, 8, 48, 2, '2021-05-13 02:31:10', '2021-05-13 02:31:10', 0),
(29, 'QUẦN TÂY SUÔNG CHIẾT LY NỮ\r\n', 450000, 'QuanTay5.jpg', 'Màu sắc: Ghi khói\r\n\r\n', 5, 8, 47, 3, '2021-05-13 02:31:10', '2021-05-13 02:31:10', 0),
(30, 'QUẦN TÂY ỐNG SUÔNG HỌA TIẾT KẺ NỮ\r\n', 350000, 'QuanTay6.jpg', 'Màu sắc: Kẻ Đen\r\n\r\n', 5, 10, 50, 0, '2021-05-13 02:44:00', '2021-05-13 02:44:00', 0),
(31, 'QUẦN TÂY NAM KHAKI DÁNG SLIM\r\n', 360000, 'QuanKaKi1.jpg', 'Màu sắc: Be vàng\r\n\r\n', 6, 10, 48, 2, '2021-05-13 02:44:00', '2021-05-13 02:44:00', 0),
(32, 'QUẦN TÂY NAM KHAKI DÂY KÉO RÚT\r\n', 230000, 'QuanKaKi2.jpg', 'Màu sắc: Đen\r\n\r\n', 6, 15, 50, 0, '2021-05-13 02:46:26', '2021-05-13 02:46:26', 0),
(33, 'QUẦN TÂY NAM KHAIKI GẤU BO\r\n', 187000, 'QuanKaKi3.jpg', 'Màu sắc: Xanh tím than\r\n\r\n', 6, 11, 49, 1, '2021-05-13 02:46:26', '2021-05-13 02:46:26', 0),
(34, 'QUẦN KAKI BAGGY DÂY LƯNG THẮT NƠ NỮ\r\n', 450000, 'QuanKaKi4.jpg', 'Màu sắc: Hồng nhạt\r\n\r\n', 6, 13, 49, 1, '2021-05-13 02:48:48', '2021-05-13 02:48:48', 0),
(35, 'QUẦN KAKI BAGGY VIỀN CHỈ ĐEN NỮ\r\n', 200000, 'QuanKaKi5.jpg', 'Màu sắc: Be', 6, 16, 46, 4, '2021-05-13 02:48:48', '2021-05-13 02:48:48', 0),
(36, 'QUẦN KAKI BAGGY PHỐI ĐAI NỮ\r\n', 500000, 'QuanKaKi6.jpg', 'Màu sắc: Trắng\r\n\r\n', 6, 14, 42, 8, '2021-05-13 02:52:03', '2021-05-13 02:52:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `taikhoang`
--

CREATE TABLE `taikhoang` (
  `trang_thai` tinyint(4) NOT NULL,
  `id_quyen` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `taikhoang`
--

INSERT INTO `taikhoang` (`trang_thai`, `id_quyen`, `username`, `pass`, `fullname`) VALUES
(0, 1, 'huynhdinhphuc', 'huynhdinhphuc123', 'Huynh Dinh Phuc'),
(0, 3, 'nhanvien', 'nhanvien', 'nhan vien'),
(0, 2, 'nhanvien10', '123', 'sp13'),
(0, 2, 'quanly', 'admin', 'quanly'),
(0, 6, 'vbm', 'admin', 'nv2');

-- --------------------------------------------------------

--
-- Table structure for table `theloai`
--

CREATE TABLE `theloai` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten_tl` varchar(191) NOT NULL,
  `tong_sp` int(11) NOT NULL,
  `ngay_tao` timestamp NOT NULL DEFAULT current_timestamp(),
  `ngay_sua` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `theloai`
--

INSERT INTO `theloai` (`id`, `ten_tl`, `tong_sp`, `ngay_tao`, `ngay_sua`) VALUES
(1, 'Áo thun', 999, '2021-04-15 10:23:25', '2021-04-15 10:23:25'),
(2, 'Áo polo', 370, '2021-04-15 10:24:24', '2021-04-15 10:24:24'),
(3, 'Áo sơ mi', 181, '2021-04-15 10:24:56', '2021-04-15 10:24:56'),
(4, 'Quần jeans', 380, '2021-04-15 10:25:25', '2021-04-15 10:25:25'),
(5, 'Quần tây', 92, '2021-04-15 10:25:50', '2021-04-15 10:25:50'),
(6, 'Quần kaki', 344, '2021-04-15 10:27:00', '2021-04-15 10:27:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cthoadon`
--
ALTER TABLE `cthoadon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sanpham` (`id_sanpham`),
  ADD KEY `cthoadon_ibfk_1` (`id_hoadon`);

--
-- Indexes for table `ctphieunhap`
--
ALTER TABLE `ctphieunhap`
  ADD KEY `id_sp` (`id_sp`),
  ADD KEY `ctphieunhap_ibfk_1` (`id_phieunhap`);

--
-- Indexes for table `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hinhanhsp`
--
ALTER TABLE `hinhanhsp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hinhanhsp_ibfk_1` (`id_sp`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_khachhang` (`id_khachhang`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nv` (`id_nv`);

--
-- Indexes for table `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quyendahmuc`
--
ALTER TABLE `quyendahmuc`
  ADD KEY `id_danhmuc` (`id_danhmuc`),
  ADD KEY `id_quyen` (`id_quyen`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nha_cc` (`id_nha_cc`),
  ADD KEY `id_the_loai` (`id_the_loai`);

--
-- Indexes for table `taikhoang`
--
ALTER TABLE `taikhoang`
  ADD PRIMARY KEY (`username`),
  ADD KEY `id_quyen` (`id_quyen`);

--
-- Indexes for table `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cthoadon`
--
ALTER TABLE `cthoadon`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `hinhanhsp`
--
ALTER TABLE `hinhanhsp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `nhacungcap`
--
ALTER TABLE `nhacungcap`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `phieunhap`
--
ALTER TABLE `phieunhap`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quyen`
--
ALTER TABLE `quyen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `theloai`
--
ALTER TABLE `theloai`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cthoadon`
--
ALTER TABLE `cthoadon`
  ADD CONSTRAINT `cthoadon_ibfk_1` FOREIGN KEY (`id_hoadon`) REFERENCES `hoadon` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cthoadon_ibfk_2` FOREIGN KEY (`id_sanpham`) REFERENCES `sanpham` (`id`);

--
-- Constraints for table `ctphieunhap`
--
ALTER TABLE `ctphieunhap`
  ADD CONSTRAINT `ctphieunhap_ibfk_1` FOREIGN KEY (`id_phieunhap`) REFERENCES `phieunhap` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ctphieunhap_ibfk_2` FOREIGN KEY (`id_sp`) REFERENCES `sanpham` (`id`);

--
-- Constraints for table `hinhanhsp`
--
ALTER TABLE `hinhanhsp`
  ADD CONSTRAINT `hinhanhsp_ibfk_1` FOREIGN KEY (`id_sp`) REFERENCES `sanpham` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`id_khachhang`) REFERENCES `khachhang` (`id`);

--
-- Constraints for table `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD CONSTRAINT `phieunhap_ibfk_1` FOREIGN KEY (`id_nv`) REFERENCES `nhanvien` (`id`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`id_nha_cc`) REFERENCES `nhacungcap` (`id`),
  ADD CONSTRAINT `sanpham_ibfk_2` FOREIGN KEY (`id_the_loai`) REFERENCES `theloai` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
