-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2016 at 11:23 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(60) CHARACTER SET utf8 NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `role_admin` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `img_path` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `phone`, `address`, `role_admin`, `status`, `img_path`, `createdAt`, `updatedAt`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'trieunguyenthanh@gmail.com', '0975091304', 'Hà Nội', -1, 1, NULL, '2016-11-29 13:25:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ansewers`
--

CREATE TABLE `ansewers` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `level_user` tinyint(3) NOT NULL,
  `create_time` datetime NOT NULL,
  `like_ansewer` int(10) UNSIGNED DEFAULT NULL,
  `content` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `id_hoadon` int(11) NOT NULL,
  `id_dh` int(11) NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `id_hd` int(11) NOT NULL,
  `id_sach` int(10) UNSIGNED NOT NULL,
  `TenKH` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `SDT` int(11) NOT NULL,
  `Email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `DiaChi` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `GhiChu` text COLLATE utf8_unicode_ci NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `ThanhTien` int(11) NOT NULL,
  `TrangThai` int(11) NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loaisach`
--

CREATE TABLE `loaisach` (
  `id_loai` int(11) NOT NULL,
  `TenLoai` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loaisach`
--

INSERT INTO `loaisach` (`id_loai`, `TenLoai`, `create_time`, `update_time`) VALUES
(1, 'Sách Văn Học', '2016-10-17 00:00:00', NULL),
(2, 'Sách kinh tế', '2016-10-17 00:00:00', NULL),
(3, 'Sách khoa học tự nhiên', '2016-10-17 00:00:00', NULL),
(4, 'Sách Lịch Sử - địa lý', '2016-10-17 00:00:00', NULL),
(5, 'Sách công nghệ thông tin', '2016-10-17 00:00:00', NULL),
(6, 'Sách giáo dục', '2016-10-17 00:00:00', NULL),
(7, 'Sách kĩ thuật', '2016-10-17 00:00:00', NULL),
(8, 'Sách pháp luật', '2016-10-17 00:00:00', NULL),
(9, 'Sách y dược', '2016-10-17 00:00:00', NULL),
(10, 'Sách kĩ năng hay', '2016-10-17 00:00:00', NULL),
(11, 'Truyện tranh', '2016-10-17 00:00:00', NULL),
(12, 'Sách tiếng anh', '2016-10-17 00:00:00', NULL),
(13, 'Sách truyện văn học thiếu nhi', '2016-10-17 00:00:00', NULL),
(14, 'Truyện cổ tích', '2016-10-17 00:00:00', NULL),
(15, 'Truyện kể cho bé', '2016-10-17 00:00:00', NULL),
(16, 'Truyện tranh thiếu nhi', '2016-10-17 00:00:00', NULL),
(17, 'Truyện ngắn', '2016-10-17 00:00:00', NULL),
(18, 'Truyện cười', '2016-10-17 00:00:00', NULL),
(19, 'Tiểu thuyết tình cảm lãng mạn', '2016-10-17 00:00:00', NULL),
(20, 'Truyện ngôn tình', '2016-10-17 00:00:00', NULL),
(21, 'Sách học tiếng hàn', '2016-10-17 00:00:00', NULL),
(22, 'Sách học tiếng nhật', '2016-10-17 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nhaxuatban`
--

CREATE TABLE `nhaxuatban` (
  `id_nxb` int(11) NOT NULL,
  `TenNXB` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `SDTNXB` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `DiaChiNXB` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `logo_NXB` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nhaxuatban`
--

INSERT INTO `nhaxuatban` (`id_nxb`, `TenNXB`, `SDTNXB`, `DiaChiNXB`, `logo_NXB`, `create_time`, `update_time`) VALUES
(1, 'Nghệ Thuật Quân Đội', '79889879', 'Hà Nội', 'truong-dai-hoc-van-hoa-nghe-thuat-quan-doi.png', '2016-12-13 14:34:27', '2016-12-13 18:43:03'),
(2, 'Văn Học', '0975091304', 'Hà Nội', 'nxbvh.png', '2016-12-13 14:37:51', '2016-12-13 18:43:19'),
(3, 'Giáo Dục Việt Nam', '0975091304', 'Hà Nội', 'gd.png', '2016-12-13 14:41:00', '0000-00-00 00:00:00'),
(4, 'Kim Đồng', '0975091304', 'Hà Nội', 'kim-dong.jpg', '2016-12-13 14:42:04', '0000-00-00 00:00:00'),
(5, 'Nhà Xuất Bản Trẻ', '0975091304', 'Hà Nội', 'Vote_logo-30-nam_NXBTRE.jpg', '2016-12-13 14:43:31', '0000-00-00 00:00:00'),
(6, 'Thành phố Hồ Chí Minh', '0975091304', 'Hồ Chí Minh', 'tphcm.jpg', '2016-12-13 14:44:32', '0000-00-00 00:00:00'),
(7, 'Nhà xuất bản Tri Thức', '0975091304', 'Hà Nội', 'Logonxb_vuong.png', '2016-12-13 14:45:43', '0000-00-00 00:00:00'),
(8, 'Nhà xuất bản Sự Thật', '79889879', 'Hà Nội', 'stlogo.png', '2016-12-17 10:21:26', '0000-00-00 00:00:00'),
(9, 'Nhà xuất bản Nghệ Thuật Quân Đội', '79889879', 'Hà Nội', 'truong-dai-hoc-van-hoa-nghe-thuat-quan-doi.png', '2016-12-17 10:22:46', '0000-00-00 00:00:00'),
(10, 'Nhà xuất bản Thanh Hóa', '79889879', 'Thanh Hóa', 'Logonxb_vuong.png', '2016-12-17 10:23:52', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime NOT NULL,
  `id_book` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `like_comment` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sach`
--

CREATE TABLE `sach` (
  `id` int(11) NOT NULL,
  `TenSach` varchar(200) CHARACTER SET utf8 NOT NULL,
  `id_nxb` int(11) NOT NULL,
  `id_tg` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `HinhAnh` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `GiaCu` int(11) NOT NULL,
  `GiaMoi` int(11) DEFAULT NULL,
  `id_loai` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `SoTrang` int(11) NOT NULL,
  `SoLuotXem` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sach`
--

INSERT INTO `sach` (`id`, `TenSach`, `id_nxb`, `id_tg`, `status`, `HinhAnh`, `GiaCu`, `GiaMoi`, `id_loai`, `SoLuong`, `SoTrang`, `SoLuotXem`, `create_time`, `date_time`) VALUES
(1, 'Chí Phèo', 1, 2, 1, '300x250.gif', 12000, 0, 1, 5, 300, 0, '2016-12-20 19:08:18', '2016-12-20 23:19:58'),
(2, 'Tắt Đèn', 3, 1, 1, 'tat-den.jpg', 12000, NULL, 1, 5, 300, 0, '2016-12-20 23:20:40', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tacgia`
--

CREATE TABLE `tacgia` (
  `id_tg` int(11) NOT NULL,
  `TenTG` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `SDTTG` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `DiaChiTG` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `img_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tacgia`
--

INSERT INTO `tacgia` (`id_tg`, `TenTG`, `SDTTG`, `DiaChiTG`, `img_path`, `create_time`, `update_time`) VALUES
(1, 'Ngô Tất Tố', '0975091304', 'Hà Nội', '300x300.jpg', '2016-10-14 19:46:05', '0000-00-00 00:00:00'),
(2, 'Nam Cao', '0975091304', 'Hà Nội', '300x250.gif', '2016-10-14 20:12:27', '0000-00-00 00:00:00'),
(3, 'Nguyễn Tuân', '0975091999', 'Hà Nội', '300x300.jpg', '2016-10-14 20:56:34', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id_tk` int(11) NOT NULL,
  `TenDangNhap` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `MatKhau` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `TenHienThi` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `DiaChi` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `SDT` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Quyen` int(11) NOT NULL,
  `Trang_thai` tinyint(4) NOT NULL,
  `authen_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ansewers`
--
ALTER TABLE `ansewers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`id_hoadon`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id_hd`);

--
-- Indexes for table `loaisach`
--
ALTER TABLE `loaisach`
  ADD PRIMARY KEY (`id_loai`);

--
-- Indexes for table `nhaxuatban`
--
ALTER TABLE `nhaxuatban`
  ADD PRIMARY KEY (`id_nxb`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tacgia`
--
ALTER TABLE `tacgia`
  ADD PRIMARY KEY (`id_tg`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id_tk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ansewers`
--
ALTER TABLE `ansewers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  MODIFY `id_hoadon` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id_hd` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loaisach`
--
ALTER TABLE `loaisach`
  MODIFY `id_loai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `nhaxuatban`
--
ALTER TABLE `nhaxuatban`
  MODIFY `id_nxb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sach`
--
ALTER TABLE `sach`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tacgia`
--
ALTER TABLE `tacgia`
  MODIFY `id_tg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id_tk` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
