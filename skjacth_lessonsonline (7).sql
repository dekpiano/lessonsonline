-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2024 at 12:19 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skjacth_lessonsonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_courses`
--

CREATE TABLE `tb_courses` (
  `CourseID` int(11) NOT NULL COMMENT 'รหัสเฉพาะของคอร์ส',
  `CourseCode` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Code คอร์ส',
  `CourseName` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT ' ชื่อคอร์ส',
  `CourseDescription` longtext COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'รายละเอียดคอร์ส',
  `CourseStartDate` date NOT NULL COMMENT 'วันที่เริ่มต้น',
  `CourseEndDate` date NOT NULL COMMENT 'วันที่สิ้นสุด',
  `CourseDuration` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ระยะเวลาคอร์ส',
  `CourseDifficultyLevel` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ระดับความยาก',
  `CourseType` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ประเภทคอร์ส',
  `CourseImage` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'ลิงก์ไปยังรูปภาพ',
  `CourseStatus` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถานะของคอร์ส',
  `TeacherID` int(11) DEFAULT NULL COMMENT 'รหัสผู้สอน (FK)',
  `CourseDateCreated` datetime DEFAULT current_timestamp() COMMENT 'วันที่สร้าง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_courses`
--

INSERT INTO `tb_courses` (`CourseID`, `CourseCode`, `CourseName`, `CourseDescription`, `CourseStartDate`, `CourseEndDate`, `CourseDuration`, `CourseDifficultyLevel`, `CourseType`, `CourseImage`, `CourseStatus`, `TeacherID`, `CourseDateCreated`) VALUES
(1, 'Course_0001', 'การทำงานของคอมพิวเตอร์', '<div>1. การรับข้อมูลขาเข้า (Input)</div><div><br></div><div>2. ความสามารถในการประมวลผล (Processing)</div><div><br></div><div>3. ความสามารถในการแสดงผล (Output)</div><div><br></div><div>4. การเก็บข้อมูล (Storage)</div>', '2024-03-22', '2024-03-30', '20', '', 'คอมพิวเตอร์', '1711074016-3297.jpg', 'Active', 7, '2024-03-22 09:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `tb_enrollments`
--

CREATE TABLE `tb_enrollments` (
  `EnrollmentID` int(11) NOT NULL COMMENT 'รหัสการลงทะเบียน',
  `CourseID` int(11) DEFAULT NULL COMMENT 'รหัสคอร์ส',
  `UserID` int(11) DEFAULT NULL COMMENT 'รหัสผู้ใช้',
  `EnrollDate` datetime DEFAULT NULL COMMENT 'วันและเวลาที่ลงทะเบียน',
  `EnrollStatus` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'สถานะการลงทะเบียน',
  `EnrollProgress` int(5) NOT NULL DEFAULT 0 COMMENT 'ความคืบหน้าของผู้ใช้',
  `EnrollCompletionDate` date NOT NULL COMMENT 'วันที่และเวลาที่ผู้ใช้เสร็จสิ้นคอร์ส',
  `EnrollCertificate` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ใบรับรองการเสร็จสิ้นคอร์ส'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_enrollments`
--

INSERT INTO `tb_enrollments` (`EnrollmentID`, `CourseID`, `UserID`, `EnrollDate`, `EnrollStatus`, `EnrollProgress`, `EnrollCompletionDate`, `EnrollCertificate`) VALUES
(1, 1, 8, '2024-03-22 13:36:38', 'active', 0, '0000-00-00', ''),
(2, 1, 3, '2024-03-22 14:37:39', 'active', 0, '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lessons`
--

CREATE TABLE `tb_lessons` (
  `LessonID` int(11) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `LessonCode` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `LessonNo` int(11) NOT NULL,
  `LessonTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `LessonContent` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `LessonVideoURL` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LessonStudyTime` int(2) NOT NULL COMMENT 'เวลาที่ใช้เรียน',
  `LessonDateCreated` datetime DEFAULT current_timestamp(),
  `TeacherID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_lessons`
--

INSERT INTO `tb_lessons` (`LessonID`, `CourseID`, `LessonCode`, `LessonNo`, `LessonTitle`, `LessonContent`, `LessonVideoURL`, `LessonStudyTime`, `LessonDateCreated`, `TeacherID`) VALUES
(1, 1, 'Lesson_0001', 1, 'การใช้คอมพิวเตอร์', '<p><iframe frameborder=\"0\" src=\"//www.youtube.com/embed/KsuaUFFWGKA\" width=\"640\" height=\"360\" class=\"note-video-clip\"></iframe><br></p>', '', 5, '2024-03-22 09:26:09', 7),
(2, 1, 'Lesson_0002', 2, 'หลักการทำงานของระบบคอมพิวเตอร์', '<p><iframe frameborder=\"0\" src=\"//www.youtube.com/embed/usz0hDOO2DA\" width=\"640\" height=\"360\" class=\"note-video-clip\"></iframe><br></p>', '', 5, '2024-03-22 09:27:27', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tb_lesson_progress`
--

CREATE TABLE `tb_lesson_progress` (
  `LessProID` int(11) NOT NULL COMMENT 'รหัสตาราง',
  `EnrollmentID` int(11) NOT NULL COMMENT 'รหัสลงทะเบียนเรียน',
  `LessonID` int(11) NOT NULL COMMENT 'รหัสบทเรียน',
  `LessProStatus` enum('ยังไม่เริ่ม','กำลังเรียน','เรียนสำเร็จ') COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถานะของบทเรียนสำหรับผู้เรียนนี้',
  `LessProProgress` decimal(5,2) NOT NULL COMMENT 'เปอร์เซ็นต์ความคืบหน้าในบทเรียนนี้',
  `LessProLastAccessed` datetime NOT NULL COMMENT 'วันที่และเวลาที่ผู้เรียนเข้าถึงบทเรียนนี้ล่าสุด',
  `LessProTimeSpent` int(5) NOT NULL COMMENT 'เวลาเรียนของบทเรียน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_lesson_progress`
--

INSERT INTO `tb_lesson_progress` (`LessProID`, `EnrollmentID`, `LessonID`, `LessProStatus`, `LessProProgress`, `LessProLastAccessed`, `LessProTimeSpent`) VALUES
(1, 1, 1, 'เรียนสำเร็จ', '0.00', '2024-03-22 09:49:41', 5),
(2, 1, 2, 'ยังไม่เริ่ม', '0.00', '2024-03-22 09:49:43', 5),
(3, 2, 1, 'กำลังเรียน', '0.00', '2024-03-22 12:01:58', 5),
(4, 2, 2, 'เรียนสำเร็จ', '0.00', '2024-03-22 09:27:11', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_options`
--

CREATE TABLE `tb_options` (
  `OptID` int(3) NOT NULL COMMENT 'รหัสตัวเลือก',
  `OptQuestionID` int(3) NOT NULL COMMENT 'รหัสคำถาม',
  `OptChoice` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ตัวเลือก',
  `OptAnswer` int(1) NOT NULL COMMENT 'เฉลย'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_options`
--

INSERT INTO `tb_options` (`OptID`, `OptQuestionID`, `OptChoice`, `OptAnswer`) VALUES
(1, 1, 'เครื่องคำนวณอัตโนมัติ', 0),
(2, 1, 'เครื่องใช้สำนักงานอัตโนมัติรุ่นใหม่', 0),
(3, 1, 'อุปกรณ์อิเล็คทรอนิกส์อย่างหนึ่ง', 1),
(4, 1, 'เป็นแผงวงจรอิเล็กทรอนิกส์อย่างหนึ่ง', 0),
(5, 2, 'การถอนเงินจากเครื่อง atm', 0),
(6, 2, 'การจับจ่ายซื้อของในห้างสรรพสินค้าโดยใช้บัตรเครดิต', 0),
(7, 2, 'การสำรองที่นั่งเครื่องบินสื่อสาร’', 0),
(8, 2, 'ถูกทุกข้อ', 1),
(9, 3, 'Digital', 1),
(10, 3, 'Analog', 0),
(11, 3, 'Calculate', 0),
(12, 3, 'Numerical', 0),
(13, 4, 'ความคิด', 1),
(14, 4, 'ความจำ', 0),
(15, 4, 'การควบคุมตนเอง', 0),
(16, 4, 'การเปรียบเทียบเชิงตรรกะ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_questions`
--

CREATE TABLE `tb_questions` (
  `QuestionID` int(11) NOT NULL,
  `QuestionLessonID` int(11) NOT NULL,
  `QuestionText` text COLLATE utf8_unicode_ci NOT NULL,
  `CorrectAnswer` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_questions`
--

INSERT INTO `tb_questions` (`QuestionID`, `QuestionLessonID`, `QuestionText`, `CorrectAnswer`) VALUES
(1, 1, 'ข้อใดคือความหมายของคอมพิวเตอร์', ''),
(2, 1, 'คอมพิวเตอร์ได้เข้ามามีบทบาทที่เกี่ยวข้องกับชีวิตประจำวันของเราอย่างไร?', ''),
(3, 2, 'ครื่องคอมพิวเตอร์ส่วนใหญ่ทำงานด้วยระบบใด?', ''),
(4, 2, 'สิ่งใดที่ไม่มีในเครื่องคอมพิวเตอร์?', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_useranswers`
--

CREATE TABLE `tb_useranswers` (
  `UserAnswerID` int(11) NOT NULL COMMENT 'รหัสคำตอบ',
  `QuestionID` int(11) DEFAULT NULL COMMENT 'รหัสคำถาม',
  `UserID` int(11) DEFAULT NULL COMMENT 'รหัสผู้ใช้',
  `UserAnswerCategory` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ประเภทการสอบ',
  `UserAnswerExamRound` int(1) NOT NULL COMMENT 'รอบที่่สอบ',
  `UserAnswerGiven` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ข้อที่ตอบ',
  `UserAnswerIsCorrect` int(1) NOT NULL COMMENT 'ตอบถูกหรือไม่',
  `UserAnswerDate` datetime DEFAULT current_timestamp() COMMENT 'วันที่ตอบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_useranswers`
--

INSERT INTO `tb_useranswers` (`UserAnswerID`, `QuestionID`, `UserID`, `UserAnswerCategory`, `UserAnswerExamRound`, `UserAnswerGiven`, `UserAnswerIsCorrect`, `UserAnswerDate`) VALUES
(1, 1, 3, 'หลังเรียน', 1, 'อุปกรณ์อิเล็คทรอนิกส์อย่างหนึ่ง', 1, '2024-03-22 10:30:01'),
(2, 2, 3, 'หลังเรียน', 1, 'การถอนเงินจากเครื่อง atm', 0, '2024-03-22 10:30:01'),
(3, 1, 8, 'หลังเรียน', 1, 'เครื่องคำนวณอัตโนมัติ', 0, '2024-03-22 13:38:45'),
(4, 2, 8, 'หลังเรียน', 1, 'การถอนเงินจากเครื่อง atm', 0, '2024-03-22 13:38:45'),
(5, 1, 8, 'หลังเรียน', 2, 'อุปกรณ์อิเล็คทรอนิกส์อย่างหนึ่ง', 1, '2024-03-22 13:38:51'),
(6, 2, 8, 'หลังเรียน', 2, 'การถอนเงินจากเครื่อง atm', 0, '2024-03-22 13:38:51'),
(7, 3, 3, 'หลังเรียน', 1, 'Digital', 1, '2024-03-22 15:28:57'),
(8, 4, 3, 'หลังเรียน', 1, 'ความคิด', 1, '2024-03-22 15:28:57'),
(9, 3, 8, 'หลังเรียน', 1, 'Analog', 0, '2024-03-22 15:39:46'),
(10, 4, 8, 'หลังเรียน', 1, 'ความคิด', 1, '2024-03-22 15:39:46'),
(11, 1, 3, 'หลังเรียน', 2, 'เครื่องใช้สำนักงานอัตโนมัติรุ่นใหม่', 0, '2024-03-22 18:02:38'),
(12, 2, 3, 'หลังเรียน', 2, 'การถอนเงินจากเครื่อง atm', 0, '2024-03-22 18:02:38');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `UserID` int(11) NOT NULL,
  `UserCode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `UserGender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `UserPrefix` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `UserFirstName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `UserLastName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `UserIdCard` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `UserBirthday` date NOT NULL,
  `UserPhone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserType` enum('student','teacher','admin') COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateCreated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`UserID`, `UserCode`, `UserGender`, `UserPrefix`, `UserFirstName`, `UserLastName`, `UserIdCard`, `UserBirthday`, `UserPhone`, `Username`, `Password`, `Email`, `UserType`, `DateCreated`) VALUES
(1, 'User_0001', '', 'นาย', 'วชิรวิทย์', 'แกล้วการไถ', '', '2024-03-04', '0910518473', 'dekpiano@skj.ac.th', '$2y$10$Uz9L6PXtrcqD7l83Ma1s4eKE09htCu4wS1zLXH3vDZRCDvg19uiEi', 'dekpiano@skj.ac.th', 'teacher', '2024-03-04 10:56:59'),
(2, 'User_0002', '', 'เด็กหญิง', 'วชิรวิทย์', 'แกล้วการไถ', '', '2024-03-14', '0910518473', 'nuntakarn.j@skj.ac.th', '$2y$10$NldPnaFtHbEnRM9I.Nl7E.k6u1cmb2qB.7UM3rkuCIr0z7sBqt9he', 'nuntakarn.j@skj.ac.th', 'student', '2024-03-04 11:06:28'),
(3, 'User_0003', '', 'เด็กชาย', 'ใจดี', 'มีสุข', '', '2023-11-16', '0910518473', 'user1@gmail.com', '$2y$10$TtoZfefLE/gAQtE1vd.YfeHzJLFp6.HcubVqp/RKtmb8xL5SFGbh2', 'user1@gmail.com', 'student', '2024-03-07 05:21:34'),
(4, 'User_0004', '', 'Mr.', 'Admin', 'นะฮ้ะ', '', '2019-03-13', '0910515151', 'admin@admin.com', '$2y$10$TtoZfefLE/gAQtE1vd.YfeHzJLFp6.HcubVqp/RKtmb8xL5SFGbh2', 'admin@admin.com', 'admin', '2024-03-07 17:03:17'),
(5, 'User_0005', '', '', '', '', '', '0000-00-00', '', '', '$2y$10$6UnZ/lRN5XC8bKx.VXU5tuUbp9w4tdKUeVj/x9VA1e6vqkcppthz2', '', 'teacher', '2024-03-07 11:55:08'),
(6, 'User_0006', '', '', '', '', '', '0000-00-00', '', '', '$2y$10$.GGW3W/CqlAfb8DIIzN1keOx6XQt/Aq7Oh7pmhuH/Fzt3ENZ/jQxq', '', 'teacher', '2024-03-07 11:57:28'),
(7, 'User_0007', '', 'เด็กชาย', 'สมสี', 'สามสิบ', '', '2024-03-15', '00000000', 'teacher1@gmail.com', '$2y$10$tSy8GhphjxPw1DQ4F2GZ4OKq11aYwwimZ.nA2ysRPrakx0T7WS3aa', 'teacxher1@gmail.com', 'teacher', '2024-03-07 11:58:53'),
(8, 'User_0008', 'หญิง', 'เด็กหญิง', 'สมชาย', 'มาสาย', '1600100429753', '2024-03-06', '0910518473', 'user3@gmail.com', '$2y$10$b4jTMvUUTC4B8baYLd3xi.mogTHij/2ai/RJVVn95d.QYDt9n1FR.', 'user3@gmail.com', 'student', '2024-03-09 10:25:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_courses`
--
ALTER TABLE `tb_courses`
  ADD PRIMARY KEY (`CourseID`),
  ADD KEY `TeacherID` (`TeacherID`);

--
-- Indexes for table `tb_enrollments`
--
ALTER TABLE `tb_enrollments`
  ADD PRIMARY KEY (`EnrollmentID`),
  ADD KEY `CourseID` (`CourseID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `tb_lessons`
--
ALTER TABLE `tb_lessons`
  ADD PRIMARY KEY (`LessonID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indexes for table `tb_lesson_progress`
--
ALTER TABLE `tb_lesson_progress`
  ADD PRIMARY KEY (`LessProID`);

--
-- Indexes for table `tb_options`
--
ALTER TABLE `tb_options`
  ADD PRIMARY KEY (`OptID`);

--
-- Indexes for table `tb_questions`
--
ALTER TABLE `tb_questions`
  ADD PRIMARY KEY (`QuestionID`);

--
-- Indexes for table `tb_useranswers`
--
ALTER TABLE `tb_useranswers`
  ADD PRIMARY KEY (`UserAnswerID`),
  ADD KEY `QuestionID` (`QuestionID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_courses`
--
ALTER TABLE `tb_courses`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสเฉพาะของคอร์ส', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_enrollments`
--
ALTER TABLE `tb_enrollments`
  MODIFY `EnrollmentID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการลงทะเบียน', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_lessons`
--
ALTER TABLE `tb_lessons`
  MODIFY `LessonID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_lesson_progress`
--
ALTER TABLE `tb_lesson_progress`
  MODIFY `LessProID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสตาราง', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_options`
--
ALTER TABLE `tb_options`
  MODIFY `OptID` int(3) NOT NULL AUTO_INCREMENT COMMENT 'รหัสตัวเลือก', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_questions`
--
ALTER TABLE `tb_questions`
  MODIFY `QuestionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_useranswers`
--
ALTER TABLE `tb_useranswers`
  MODIFY `UserAnswerID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสคำตอบ', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_courses`
--
ALTER TABLE `tb_courses`
  ADD CONSTRAINT `tb_courses_ibfk_1` FOREIGN KEY (`TeacherID`) REFERENCES `tb_users` (`UserID`);

--
-- Constraints for table `tb_enrollments`
--
ALTER TABLE `tb_enrollments`
  ADD CONSTRAINT `tb_enrollments_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `tb_courses` (`CourseID`),
  ADD CONSTRAINT `tb_enrollments_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `tb_users` (`UserID`);

--
-- Constraints for table `tb_lessons`
--
ALTER TABLE `tb_lessons`
  ADD CONSTRAINT `tb_lessons_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `tb_courses` (`CourseID`);

--
-- Constraints for table `tb_useranswers`
--
ALTER TABLE `tb_useranswers`
  ADD CONSTRAINT `tb_useranswers_ibfk_1` FOREIGN KEY (`QuestionID`) REFERENCES `tb_questions` (`QuestionID`),
  ADD CONSTRAINT `tb_useranswers_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `tb_users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
