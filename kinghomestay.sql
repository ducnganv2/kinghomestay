-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2025 at 04:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kinghomestay`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `sr_no` int(11) NOT NULL,
  `section` varchar(50) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`sr_no`, `section`, `title`, `content`, `icon`, `display_order`, `status`) VALUES
(1, 'intro', '', 'Chào mừng bạn đến với KingHomestay - điểm đến lý tưởng tại thành phố biển Nha Trang. Chúng tôi tự hào là không gian kết hợp độc đáo giữa homestay chất lượng và quán coffee hiện đại, mang đến trải nghiệm hoàn hảo cho cả khách du lịch và cộng đồng dân địa phương.', NULL, 1, 1),
(2, 'intro', '', 'Với triết lý \"Nghỉ ngơi - Thư giãn - Kết nối\", KingHomestay không chỉ là nơi lưu trú mà còn là không gian giao lưu văn hóa, nơi bạn có thể tận hưởng ly cà phê thơm ngon trong không gian ấm cúng, gặp gỡ bạn bè mới và tạo nên những kỷ niệm đáng nhớ.', NULL, 2, 1),
(3, 'feature', 'Homestay Chất Lượng', 'Phòng nghỉ được thiết kế hiện đại, thoáng mát với đầy đủ tiện nghi. Không gian riêng tư nhưng vẫn ấm cúng như ở nhà, phù hợp cho khách du lịch muốn khám phá vẻ đẹp Nha Trang với giá cả hợp lý.', 'home.svg', 1, 1),
(4, 'feature', 'Quán Coffee Hiện Đại', 'Coffee shop ngay tại homestay với menu đa dạng từ cà phê truyền thống đến các loại đồ uống hiện đại. Không gian thoải mái, view đẹp, là điểm hẹn lý tưởng cho cả khách lưu trú và dân địa phương.', 'lounge.svg', 2, 1),
(5, 'feature', 'Trải Nghiệm Du Lịch', 'Vị trí thuận lợi gần các điểm du lịch nổi tiếng. Đội ngũ nhân viên nhiệt tình tư vấn lịch trình, địa điểm tham quan và ẩm thực địa phương. Tạo điều kiện tốt nhất để bạn khám phá Nha Trang.', 'plane.svg', 3, 1),
(6, 'feature', 'Không Gian Cộng Đồng', 'Nơi gặp gỡ và kết nối giữa du khách và người dân bản địa. Tổ chức các sự kiện văn hóa, workshop nhỏ, tạo môi trường giao lưu thân thiện và chia sẻ câu chuyện du lịch.', 'hand.svg', 4, 1),
(7, 'mission', 'Sứ Mệnh', 'Mang đến trải nghiệm lưu trú và thư giãn đẳng cấp, kết nối du khách với văn hóa địa phương thông qua không gian homestay thân thiện và quán coffee ấm cúng. Chúng tôi cam kết tạo nên những kỷ niệm đáng nhớ cho mỗi vị khách.', NULL, 1, 1),
(8, 'vision', 'Mục Tiêu', 'Trở thành điểm đến hàng đầu tại Nha Trang cho những ai tìm kiếm sự kết hợp hoàn hảo giữa nghỉ ngơi và trải nghiệm văn hóa. Xây dựng cộng đồng yêu du lịch và cà phê, nơi mọi người đều cảm thấy được chào đón.', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_cred`
--

CREATE TABLE `admin_cred` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_cred`
--

INSERT INTO `admin_cred` (`sr_no`, `admin_name`, `admin_pass`) VALUES
(1, 'holden', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `total_pay` int(11) NOT NULL,
  `room_no` varchar(100) DEFAULT NULL,
  `user_name` varchar(100) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`sr_no`, `booking_id`, `room_name`, `price`, `total_pay`, `room_no`, `user_name`, `phonenum`, `address`) VALUES
(1, 1, 'Phòng Cơ Bản 3', 1200000, 2400000, NULL, 'Hung', '123', 'ad'),
(2, 2, 'Phòng Cao Cấp', 2000000, 4000000, 'a2', 'amey', '123', 'ad'),
(3, 3, 'Phòng Tổng Thống', 10000000, 10000000, NULL, 'amey', '123', 'ad'),
(21, 21, 'Phòng Cơ Bản 3', 1200000, 7200000, NULL, 'Hùng', '12345', 'qweqweqweqwe'),
(22, 22, 'Phòng Cao Cấp', 2000000, 4000000, NULL, 'Hùng', '12345', 'qweqweqweqwe'),
(23, 23, 'Phòng Cơ Bản 3', 1200000, 18000000, NULL, 'Trung', '123', 'ad');

-- --------------------------------------------------------

--
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `arrival` int(11) NOT NULL DEFAULT 0,
  `refund` int(11) DEFAULT NULL,
  `booking_status` varchar(100) NOT NULL DEFAULT 'pending',
  `order_id` varchar(150) NOT NULL,
  `trans_id` varchar(200) DEFAULT NULL,
  `trans_amt` int(11) DEFAULT NULL,
  `trans_status` varchar(100) NOT NULL DEFAULT 'pending',
  `trans_resp_msg` varchar(200) DEFAULT NULL,
  `rate_review` int(11) DEFAULT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_order`
--

INSERT INTO `booking_order` (`booking_id`, `user_id`, `room_id`, `check_in`, `check_out`, `arrival`, `refund`, `booking_status`, `order_id`, `trans_id`, `trans_amt`, `trans_status`, `trans_resp_msg`, `rate_review`, `datentime`) VALUES
(1, 2, 3, '2024-12-12', '2024-12-14', 0, NULL, 'pending', 'ORD_21055700', NULL, 0, 'pending', NULL, NULL, '2024-11-30 01:50:12'),
(2, 2, 3, '2024-12-03', '2024-12-04', 1, NULL, 'booked', 'ORD_24215693', '20220720111212800110168128204225279', 600, 'TXN_SUCCESS', 'Txn Success', NULL, '2024-11-30 02:14:44'),
(3, 2, 3, '2024-12-13', '2024-12-17', 0, 1, 'cancelled', 'ORD_26312547', '20220720111212800110168165603901976', 1800, 'TXN_SUCCESS', 'Txn Success', NULL, '2024-11-30 02:19:00'),
(21, 7, 3, '2024-12-01', '2024-12-07', 0, 0, 'cancelled', 'ORD_74731476', NULL, NULL, 'TXN_SUCCESS', NULL, NULL, '2024-12-01 11:25:29'),
(22, 7, 4, '2024-12-29', '2024-12-31', 0, NULL, 'booked', 'ORD_72382450', NULL, NULL, 'TXN_SUCCESS', NULL, NULL, '2024-12-01 11:32:34'),
(23, 2, 3, '2025-11-12', '2025-11-27', 0, NULL, 'pending', 'ORD_23327895', NULL, NULL, 'pending', NULL, NULL, '2025-11-03 10:40:57');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`sr_no`, `image`) VALUES
(4, 'bg1.jpg'),
(5, 'bg2.jpg'),
(6, 'bg3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `pn1` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `email`, `fb`, `insta`, `tw`, `iframe`) VALUES
(1, 'Đồi La San, Nha Trang - Khánh Hòa', 'https://maps.app.goo.gl/8r94PYsR6d7w5NcT9', 84999123678, 'service@kinghomestay.vn', '', '', '', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15594.827632050672!2d109.19187064292139!3d12.268102707779382!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317067ed2e2fef6f%3A0xf55b13520cbddf4e!2zxJDhu5NpIExhIFNhbg!5e0!3m2!1svi!2s!4v1762567768916!5m2!1svi!2s');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `description`) VALUES
(13, 'wifi.svg', 'Wi-Fi', 'Kết nối Internet tốc độ cao, miễn phí trong toàn bộ khu vực homestay, giúp bạn dễ dàng làm việc, học tập hoặc giải trí trực tuyến.'),
(14, 'air.svg', 'Máy lạnh', 'Cung cấp không gian mát mẻ, dễ chịu và thoải mái trong suốt kỳ nghỉ, giúp bạn thư giãn hoặc làm việc hiệu quả ngay trong phòng.'),
(15, 'bath.svg', 'Bồn tắm', 'Thư giãn trong bồn tắm rộng rãi với nước ấm, giúp bạn xua tan mệt mỏi và tận hưởng khoảnh khắc nghỉ ngơi trọn vẹn ngay tại phòng.'),
(17, 'garden.svg', 'Sân vườn', 'Góc xanh nhỏ xinh được chăm chút tỉ mỉ, mang lại cảm giác thư thái và gần gũi thiên nhiên giữa lòng thành phố biển.'),
(18, 'lounge.svg', 'Khu lounge', 'Không gian chung ấm cúng với sofa và ánh sáng tự nhiên, là nơi lý tưởng để đọc sách, trò chuyện hoặc thưởng thức cà phê sáng.'),
(19, 'tv.svg', 'Phòng Xem Phim', 'Thưởng thức những bộ phim yêu thích trong không gian ấm cúng, với màn hình lớn và ghế ngồi thoải mái, giúp bạn giải trí và thư giãn ngay tại homestay.');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(13, 'Phòng Ngủ'),
(14, 'Ban Công'),
(15, 'Nhà Bếp'),
(17, 'Ghế Sofa'),
(18, 'View Biển'),
(19, 'Đèn Chùm');

-- --------------------------------------------------------

--
-- Table structure for table `rating_review`
--

CREATE TABLE `rating_review` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(200) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating_review`
--

INSERT INTO `rating_review` (`sr_no`, `booking_id`, `room_id`, `user_id`, `rating`, `review`, `seen`, `datentime`) VALUES
(4, 21, 5, 2, 5, 'Dịch vụ tuyệt vời, không gian đẳng cấp và được trang bị đầy đủ tiện nghi hiện đại. Rất phù hợp cho những dịp đặc biệt hoặc nghỉ dưỡng cao cấp.', 1, '2022-08-20 00:22:25'),
(5, 22, 4, 5, 3, 'Chất lượng dịch vụ xuất sắc, phòng rộng rãi, đầy đủ tiện nghi. Không gian sang trọng và thoải mái, rất đáng giá cho kỳ nghỉ.', 1, '2022-08-20 00:22:30'),
(6, 1, 3, 6, 4, 'Tương tự như “Phòng Cơ bản”, nhưng một số chi tiết như ánh sáng hoặc nội thất cần được cải thiện để mang lại trải nghiệm tốt hơn.', 1, '2022-08-20 00:22:34'),
(8, 21, 5, 7, 5, 'Nhân viên phục vụ rất chuyên nghiệp, mang lại cảm giác thoải mái và đáng nhớ cho kỳ nghỉ.', 1, '2022-08-20 00:22:25'),
(9, 22, 3, 8, 4, 'Dịch vụ ổn định, phòng sạch sẽ và gọn gàng. Tuy nhiên, tiện nghi chỉ ở mức cơ bản, phù hợp cho những ai cần chỗ ở ngắn hạn.', 1, '2022-08-20 00:22:34'),
(10, 1, 6, 2, 5, 'Phòng đẳng cấp, dịch vụ chu đáo, không gian sang trọng. Tuy nhiên, giá thành hơi cao so với những gì nhận được.', 1, '2022-08-20 00:22:34'),
(12, 1, 3, 7, 5, 'Rất tốt, đỉnh nóc kịch trần, bay phấp pha phấp phới.\r\nHãy gửi voucher discount về cho tôi vì đã để lại bình luận tốt!', 0, '2024-12-01 11:33:41');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` varchar(350) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `description`, `status`, `removed`) VALUES
(1, 'Phòng Cơ Bản 1', 34, 800000, 56, 2, 1, 'Phòng đơn giản, phù hợp với những khách hàng cần chỗ nghỉ ngắn hạn. Được trang bị các tiện nghi cơ bản như giường thoải mái, bàn làm việc nhỏ, và Wi-Fi miễn phí.', 1, 1),
(2, 'Phòng Cơ Bản 2', 40, 1000000, 30, 2, 1, 'Nâng cấp nhẹ so với Phòng Cơ Bản 1, mang đến không gian rộng rãi hơn và thêm các tiện ích như TV màn hình phẳng và minibar.', 1, 1),
(3, 'Phòng Mây', 45, 1390000, 1, 2, 1, 'Tận hưởng khoảnh khắc bình yên trong căn phòng có ban công hướng biển tuyệt đẹp, nơi bạn có thể đón bình minh mỗi sáng. Phòng được thiết kế  với nội thất gỗ ấm cúng, cùng đầy đủ tiện nghi hiện đại. Không gian mang đến cảm giác gần gũi và thư giãn tối đa cho cả gia đình.', 1, 0),
(4, 'Phòng Gác', 18, 650000, 1, 2, 1, 'Không gian gác mái được thiết kế với trần gỗ và ánh sáng vàng ấm, mang hơi thở cổ điển và gần gũi. Phòng được trang bị đầy đủ tiện nghi, là lựa chọn hoàn hảo cho du khách yêu thích phong cách mộc mạc và yên bình.', 1, 0),
(5, 'Phòng Ký Ức', 50, 1390000, 1, 2, 1, 'Tận hưởng không gian thanh lịch trong căn phòng thiết kế phong cách Pháp cổ, nơi những chi tiết nội thất tinh tế mang đến vẻ đẹp cổ điển và sang trọng. Cửa sổ lớn đón ánh sáng tự nhiên, tạo cảm giác ấm cúng và thư giãn. Phòng được trang bị đầy đủ tiện nghi hiện đại, là lựa chọn lý tưởng để cả gia đình nghỉ ngơi và tận hưởng những khoảnh khắc bình y', 1, 0),
(6, 'Phòng Biển', 28, 790000, 1, 6, 3, 'Thư giãn trong căn phòng tầm trung gọn gàng và tiện nghi, với nội thất cơ bản phù hợp nhu cầu nghỉ ngơi của cả gia đình. Cửa sổ lớn giúp không gian luôn thoáng sáng, tạo cảm giác dễ chịu và gần gũi. Phòng đầy đủ các tiện nghi cần thiết để bạn có kỳ nghỉ thoải mái mà không quá cầu kỳ.', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_facilities`
--

INSERT INTO `room_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
(138, 4, 13),
(153, 6, 13),
(154, 6, 14),
(155, 6, 19),
(156, 5, 13),
(157, 5, 14),
(158, 5, 15),
(159, 5, 17),
(160, 5, 18),
(161, 5, 19),
(162, 3, 13),
(163, 3, 14),
(164, 3, 15),
(165, 3, 19);

-- --------------------------------------------------------

--
-- Table structure for table `room_features`
--

CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_features`
--

INSERT INTO `room_features` (`sr_no`, `room_id`, `features_id`) VALUES
(100, 4, 13),
(101, 4, 19),
(112, 6, 13),
(113, 6, 17),
(114, 6, 18),
(115, 5, 13),
(116, 5, 17),
(117, 5, 18),
(118, 3, 13),
(119, 3, 14),
(120, 3, 17),
(121, 3, 18);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`sr_no`, `room_id`, `image`, `thumb`) VALUES
(33, 6, 'img1.jpg', 0),
(34, 4, 'img2.jpg', 1),
(36, 6, 'img3.jpg', 1),
(37, 3, 'img4.jpg', 1),
(38, 5, 'img5.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `site_about` varchar(250) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'King Homestay', 'Trải nghiệm dịch vụ đặt homestay trực tuyến nhanh chóng, tiện lợi với đa dạng lựa chọn tại Nha Trang.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `team_details`
--

CREATE TABLE `team_details` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_details`
--

INSERT INTO `team_details` (`sr_no`, `name`, `picture`) VALUES
(16, 'Hùng', 'chill-guy1.png'),
(17, 'Trung', 'chill-guy2.png'),
(18, 'Huy', 'chill-guy3.png'),
(19, 'Dũng', 'chill-guy4.png'),
(20, 'Đăng', 'chill-guy5.png'),
(21, 'Đạt', 'chill-guy6.png'),
(22, 'Hưng', 'chill-guy7.png'),
(23, 'Hiếu', 'chill-guy8.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(120) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `pincode` int(11) NOT NULL,
  `dob` date NOT NULL,
  `profile` varchar(100) NOT NULL DEFAULT 'avt.jpg',
  `password` varchar(200) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(200) DEFAULT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `password`, `is_verified`, `token`, `t_expire`, `status`, `datentime`) VALUES
(2, 'Trung', 'trung@gmail.com', 'ad', '123', 123324, '2022-06-12', 'chill-guy2.png', '12345', 1, NULL, NULL, 1, '2024-11-30 16:05:59'),
(5, 'Huy', 'huy@gmail.com', 'asd', '1234', 123, '2005-12-30', 'chill-guy3.png', '12345', 1, '24ffd287a4c2eda5f2b424be2824f997', NULL, 1, '2024-11-30 02:37:19'),
(6, 'Hiếu', 'hieu@gmail.com', 'asd', '1123', 123, '2005-12-22', 'chill-guy6.png', '12345', 1, 'ef6dc7ba39cf4bf844244d3ef927a3e7', NULL, 1, '2024-11-30 02:40:42'),
(7, 'Hùng', 'hung@gmail.com', 'qweqweqweqwe', '12345', 123, '1995-12-28', 'chill-guy1.png', '12345', 0, '5c9f04397ff3e693f7cbfccea1044483', NULL, 1, '2024-11-30 02:42:37'),
(8, 'Đạt', 'dat@gmail.com', 'a', '12', 1, '2005-12-01', 'chill-guy5.png', '12345', 0, '250dd45640f7d810313b27e758a267af', NULL, 1, '2024-11-30 02:55:39'),
(9, 'trung', '123123@asdasdasd', '1123123123', '1231111111111', 123, '2222-02-12', 'chill-guy.png', '123', 0, NULL, NULL, 1, '2024-12-01 11:56:05'),
(11, 'test', 'test@gmail.com', '123123', '1231231455555', 123123, '1111-11-11', 'chill-guy.png', '12345', 0, NULL, NULL, 1, '2024-12-01 13:05:25'),
(19, 'Huy', 'huynhhuy.079996@gmail.com', '41/21 Lang Liêu', '0385151309', 123, '2004-09-07', 'avt.jpg', '12345', 0, NULL, NULL, 1, '2025-11-13 08:58:46');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_queries`
--

INSERT INTO `user_queries` (`sr_no`, `name`, `email`, `subject`, `message`, `datentime`, `seen`) VALUES
(11, 'Hung', 'hung@gmail.com', 'Tôi muốn đặt phòng', 'Cần hỗ trợ đặt phòng Tổng Thống.', '2024-11-29 00:00:00', 1),
(13, 'Trung', 'trung@gmail.com', 'Yêu cầu hoàn tiền', 'Cần hỗ trợ hoàn tiền do huỷ đột xuất.', '2024-12-06 10:10:48', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_review`
--
ALTER TABLE `rating_review`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `facilities id` (`facilities_id`),
  ADD KEY `room id` (`room_id`);

--
-- Indexes for table `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `features id` (`features_id`),
  ADD KEY `rm id` (`room_id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `team_details`
--
ALTER TABLE `team_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `rating_review`
--
ALTER TABLE `rating_review`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `team_details`
--
ALTER TABLE `team_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`);

--
-- Constraints for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD CONSTRAINT `booking_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`),
  ADD CONSTRAINT `booking_order_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `rating_review`
--
ALTER TABLE `rating_review`
  ADD CONSTRAINT `rating_review_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`),
  ADD CONSTRAINT `rating_review_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `rating_review_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`);

--
-- Constraints for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `features id` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `rm id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
