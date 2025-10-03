-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 03, 2025 at 07:13 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `contact`, `address`, `email_verified_at`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mr Admin', 'admin@test.com', 'admin', '01751473384', 'Dhaka, Uttara', NULL, '68de8720209c31759414048.png', '$2y$12$ZGhZSJpa/CtjT6omKsFKr.HrsKBCE7EhfQx8JrPRrO6OrKvBdYqRS', NULL, NULL, '2025-10-02 14:07:28');

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_password_resets`
--

INSERT INTO `admin_password_resets` (`id`, `email`, `code`, `status`, `created_at`) VALUES
(14, 'admin@test.com', '782343', 1, '2023-10-10 06:26:31'),
(15, 'admin@test.com', '326901', 1, '2023-11-11 08:37:37'),
(16, 'admin@test.com', '272340', 1, '2023-11-11 08:38:17'),
(17, 'admin@test.com', '636482', 1, '2023-11-12 10:24:22'),
(18, 'admin@test.com', '508426', 1, '2024-05-22 14:03:41'),
(19, 'admin@test.com', '772988', 1, '2024-05-30 14:31:47'),
(20, 'admin@test.com', '350121', 1, '2024-06-10 12:14:45');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` bigint UNSIGNED NOT NULL,
  `unique_id` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `flat_id` int UNSIGNED NOT NULL,
  `category_id` int UNSIGNED NOT NULL,
  `month` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(28,8) NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_categories`
--

CREATE TABLE `bill_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bill_categories`
--

INSERT INTO `bill_categories` (`id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Electricity', '2025-09-26 12:57:29', '2025-09-26 13:01:33'),
(2, 1, 'Gas bill', '2025-09-26 13:02:09', '2025-09-26 13:02:09'),
(3, 1, 'Water bill', '2025-09-26 13:02:17', '2025-09-26 13:02:17'),
(4, 1, 'Utility Charges', '2025-09-26 13:02:35', '2025-09-26 13:02:35'),
(5, 2, 'Electricity', '2025-09-26 12:57:29', '2025-09-26 13:01:33'),
(6, 2, 'Gas bill', '2025-09-26 13:02:09', '2025-09-26 13:02:09'),
(7, 2, 'Water bill', '2025-09-26 13:02:17', '2025-09-26 13:02:17'),
(8, 2, 'Utility Charges', '2025-09-26 13:02:35', '2025-09-26 13:02:35');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flats`
--

CREATE TABLE `flats` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `flat_no` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` int NOT NULL DEFAULT '0',
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flats`
--

INSERT INTO `flats` (`id`, `user_id`, `flat_no`, `tenant_id`, `details`, `due_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 'A-101', 5, '3 Bedrooms, 3 Attached Baths, 1 Drawing Room, 1 Dining, Kitchen, Balcony', 0.00000000, '2025-09-26 08:58:00', '2025-10-01 13:23:27'),
(2, 1, 'A-202', 3, '2 Bedrooms, 2 Attached Baths, 1 Living Room, Kitchen, Balcony', 0.00000000, '2025-09-26 08:59:11', '2025-09-28 15:21:17'),
(4, 2, 'B-404', 0, '3 Bedrooms, 2 Attached Baths, 1 Common Bath, Living Room, Kitchen, Balcony', 0.00000000, '2025-09-26 09:02:25', '2025-09-26 09:02:25'),
(5, 2, 'C-505', 0, '2 Bedrooms, 1 Attached Bath, 1 Common Bath, Living Room, Kitchen, Balcony', 0.00000000, '2025-09-26 09:02:50', '2025-09-26 09:02:50'),
(6, 2, 'D - 606', 0, '3 Bedrooms, 3 Attached Baths, 1 Drawing Room, 1 Dining, Kitchen, Balcony', 0.00000000, '2025-09-27 11:28:08', '2025-09-27 11:28:08'),
(7, 1, 'H-101', 7, 'Test Details', 0.00000000, '2025-10-02 09:21:55', '2025-10-02 09:24:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_10_02_171610_create_admin_password_resets_table', 0),
(2, '2025_10_02_171610_create_admins_table', 0),
(3, '2025_10_02_171610_create_bill_categories_table', 0),
(4, '2025_10_02_171610_create_bills_table', 0),
(5, '2025_10_02_171610_create_failed_jobs_table', 0),
(6, '2025_10_02_171610_create_flats_table', 0),
(7, '2025_10_02_171610_create_notification_templates_table', 0),
(8, '2025_10_02_171610_create_password_resets_table', 0),
(9, '2025_10_02_171610_create_settings_table', 0),
(10, '2025_10_02_171610_create_tenants_table', 0),
(11, '2025_10_02_171610_create_users_table', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subj` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sms_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shortcodes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email_status` tinyint(1) NOT NULL DEFAULT '1',
  `sms_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `act`, `name`, `subj`, `email_body`, `sms_body`, `shortcodes`, `email_status`, `sms_status`, `created_at`, `updated_at`) VALUES
(1, 'PASS_RESET_CODE', 'Password - Reset - Code', 'Password Reset', '<div style=\"font-family: Montserrat, sans-serif;\">We have received a request to reset the password for your account on&nbsp;<span style=\"font-weight: bolder;\">{{time}} .<br></span></div><div style=\"font-family: Montserrat, sans-serif;\">Requested From IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>.</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><div>Your account recovery code is:&nbsp;&nbsp;&nbsp;<font size=\"6\"><span style=\"font-weight: bolder;\">{{code}}</span></font></div><div><br></div></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\" color=\"#CC0000\">If you do not wish to reset your password, please disregard this message.&nbsp;</font><br></div><div><font size=\"4\" color=\"#CC0000\"><br></font></div>', 'Your account recovery code is: {{code}}', '{\"code\":\"Verification code for password reset\",\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, 0, '2021-11-03 12:00:00', '2022-03-20 20:47:05'),
(2, 'PASS_RESET_DONE', 'Password - Reset - Confirmation', 'You have reset your password', '<p style=\"font-family: Montserrat, sans-serif;\">You have successfully reset your password.</p><p style=\"font-family: Montserrat, sans-serif;\">You changed from&nbsp; IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{time}}</span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><font color=\"#ff0000\">If you did not change that, please contact us as soon as possible.</font></span></p>', 'Your password has been changed successfully', '{\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-05 03:46:35'),
(3, 'DEFAULT', 'Default Template', '{{subject}}', '{{message}}', '{{message}}', '{\"subject\":\"Subject\",\"message\":\"Message\"}', 1, 1, '2019-09-14 13:14:22', '2021-11-04 09:38:55'),
(4, 'BILL_CREATED', 'Bill Created', 'A new bill has been created', '<p>A new bill has been created.</p><p>The details are provided below</p><p>&nbsp;</p><p><strong>Bill Id</strong> : {{bill_id}}</p><p><strong>Flat No</strong> : {{flat_no}}&nbsp;</p><p><strong>Creator</strong> : {{creator}}</p><p><strong>Bill Type</strong> : {{bill_type}}</p><p><strong>Month</strong> : {{month}}</p><p><strong>Amount</strong> : {{amount}}</p><p><strong>Status</strong> : {{status}}</p><p>&nbsp;</p><p><strong>Total Due</strong> :{{total_due}}</p><p>&nbsp;</p><p><strong>Notes</strong> :</p><p>{{notes}}</p>', 'A new bill has been created.\nThe details are provided below\n\nBill Id : {{bill_id}}\nFlat No : {{flat_no}} \nCreator : {{creator}}\nBill Type : {{bill_type}}\nMonth : {{month}}\nAmount : {{amount}}\nStatus : {{status}}\nTotal Due :{{total_due}}', '{\"bill_id\":\"Bill Unique Id\",\"flat_no\":\"Flat No\",\"creator\":\"Bill Creator\",\"bill_type\":\"Bill Category\",\"month\":\"Billing Month Name\",\"amount\":\"Bill Amount\",\"status\":\"Bill Status\",\"total_due\":\"The sum of all pending bill due\",\"notes\":\"Notes by bill creator\"}', 1, 0, '2021-11-03 12:00:00', '2025-10-01 14:08:51'),
(5, 'BILL_PAID', 'Bill Paid', 'A bill has been successfully paid', '<p>A bill has been successfully paid</p><p>The details are provided below</p><p>&nbsp;</p><p><strong>Bill Id</strong> : {{bill_id}}</p><p><strong>Flat No</strong> : {{flat_no}}&nbsp;</p><p><strong>Creator</strong> : {{creator}}</p><p><strong>Bill Type</strong> : {{bill_type}}</p><p><strong>Month</strong> : {{month}}</p><p><strong>Amount</strong> : {{amount}}</p><p><strong>Status</strong> : {{status}}</p><p>&nbsp;</p><p><strong>Total Due</strong> :{{total_due}}</p><p>&nbsp;</p><p><strong>Notes</strong> :</p><p>{{notes}}</p>', 'A bill has been successfully paid\r\nThe details are provided below\r\n\r\nBill Id : {{bill_id}}\r\nFlat No : {{flat_no}} \r\nCreator : {{creator}}\r\nBill Type : {{bill_type}}\r\nMonth : {{month}}\r\nAmount : {{amount}}\r\nStatus : {{status}}\r\nTotal Due :{{total_due}}', '{\"bill_id\":\"Bill Unique Id\",\"flat_no\":\"Flat No\",\"creator\":\"Bill Creator\",\"bill_type\":\"Bill Category\",\"month\":\"Billing Month Name\",\"amount\":\"Bill Amount\",\"status\":\"Bill Status\",\"total_due\":\"The sum of all pending bill due\",\"notes\":\"Notes by bill creator\"}', 1, 0, '2021-11-03 12:00:00', '2025-10-01 15:12:16'),
(6, 'NEW_USER', 'New User (House Owner)', 'A new user (house owner) has been successfully created', '<p>We are pleased to inform you that your account as a house owner has been successfully created. You can now access your account and begin using the system with the following details:</p><p>&nbsp;</p><ul><li><strong>Username: </strong>{{username}}</li><li><strong>Password: </strong>{{password}}</li></ul><p>&nbsp;</p><p>Please make sure to change your password upon your first login for security reasons.</p><p>&nbsp;</p><p>Best regards,</p>', 'We are pleased to inform you that your account as a house owner has been successfully created. You can now access your account and begin using the system with the following details:\r\n\r\nUsername: {{username}}\r\nPassword: {{password}}\r\n\r\nPlease make sure to change your password upon your first login for security reasons.\r\n\r\nBest regards,', '{\"username\":\"Username for the new user (houser owner)\",\"password\":\"Assigned password when creating the user\"}', 1, 0, '2021-11-03 12:00:00', '2025-10-02 14:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `code`, `created_at`) VALUES
('demouser@gmail.com', '991338', '2025-09-30 10:12:28');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `site_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_page_item` int UNSIGNED NOT NULL DEFAULT '20',
  `email_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sms_body` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_from` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sms_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `universal_shortcodes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `enforce_ssl` tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'enforce ssl',
  `ea` tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'email alert',
  `sa` tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'sms alert',
  `active_theme` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'primary',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `per_page_item`, `email_from`, `email_template`, `sms_body`, `sms_from`, `mail_config`, `sms_config`, `universal_shortcodes`, `enforce_ssl`, `ea`, `sa`, `active_theme`, `created_at`, `updated_at`) VALUES
(1, 'Invento Test - Flat & Bill Management', 20, 'info@softphinix.com', '<title></title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\r\n<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n<style type=\"text/css\">\r\n    @media screen {\r\n		@font-face {\r\n		  font-family: \'Lato\';\r\n		  font-style: normal;\r\n		  font-weight: 400;\r\n		  src: local(\'Lato Regular\'), local(\'Lato-Regular\'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format(\'woff\');\r\n		}\r\n		\r\n		@font-face {\r\n		  font-family: \'Lato\';\r\n		  font-style: normal;\r\n		  font-weight: 700;\r\n		  src: local(\'Lato Bold\'), local(\'Lato-Bold\'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format(\'woff\');\r\n		}\r\n		\r\n		@font-face {\r\n		  font-family: \'Lato\';\r\n		  font-style: italic;\r\n		  font-weight: 400;\r\n		  src: local(\'Lato Italic\'), local(\'Lato-Italic\'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format(\'woff\');\r\n		}\r\n		\r\n		@font-face {\r\n		  font-family: \'Lato\';\r\n		  font-style: italic;\r\n		  font-weight: 700;\r\n		  src: local(\'Lato Bold Italic\'), local(\'Lato-BoldItalic\'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format(\'woff\');\r\n		}\r\n    }\r\n    \r\n\r\n    body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }\r\n    table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }\r\n    img { -ms-interpolation-mode: bicubic; }\r\n\r\n    img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }\r\n    table { border-collapse: collapse !important; }\r\n    body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }\r\n\r\n    a[x-apple-data-detectors] {\r\n        color: inherit !important;\r\n        text-decoration: none !important;\r\n        font-size: inherit !important;\r\n        font-family: inherit !important;\r\n        font-weight: inherit !important;\r\n        line-height: inherit !important;\r\n    }\r\n\r\n    div[style*=\"margin: 16px 0;\"] { margin: 0 !important; }\r\n</style>\r\n\r\n\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n\r\n    <tbody><tr>\r\n        <td bgcolor=\"black\" align=\"center\">\r\n            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\">\r\n                <tbody><tr>\r\n                    <td align=\"center\" valign=\"top\" style=\"padding: 40px 10px 40px 10px;\">\r\n                        <a href=\"#0\" target=\"_blank\">\r\n                            <img alt=\"Logo\" src=\"https://invento.com.bd/wp-content/uploads/2023/11/invento-logo-color.svg\" width=\"180\" height=\"180\" style=\"display: block;  font-family: \'Lato\', Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;\" border=\"0\">\r\n                        </a>\r\n                    </td>\r\n                </tr>\r\n            </tbody></table>\r\n        </td>\r\n    </tr>\r\n\r\n    <tr>\r\n        <td bgcolor=\"black\" align=\"center\" style=\"padding: 0px 10px 0px 10px;\">\r\n            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\">\r\n                <tbody><tr>\r\n                    <td bgcolor=\"#ffffff\" align=\"center\" valign=\"top\" style=\"padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;\">\r\n                      <h1 style=\"font-size: 22px; font-weight: 400; margin: 0; border-bottom: 1px solid #727272; width: max-content;\">Hello {{fullname}} ({{username}})</h1>\r\n                    </td>\r\n                </tr>\r\n            </tbody></table>\r\n        </td>\r\n    </tr>\r\n\r\n    <tr>\r\n        <td bgcolor=\"#f4f4f4\" align=\"center\" style=\"padding: 0px 10px 0px 10px;\">\r\n            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\">\r\n\r\n              <tbody><tr>\r\n                <td bgcolor=\"#ffffff\" align=\"left\" style=\"padding: 20px 30px 40px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px; text-align: center;\">\r\n                  <p style=\"margin: 0;\">{{message}}</p>\r\n                </td>\r\n              </tr>\r\n            </tbody></table>\r\n        </td>\r\n    </tr>\r\n\r\n    <tr>\r\n        <td bgcolor=\"#f4f4f4\" align=\"center\" style=\"padding: 30px 10px 0px 10px;\">\r\n            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"black\" align=\"center\" style=\"padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;\">\r\n                    <h2 style=\"font-size: 20px; font-weight: 400; color: white; margin: 0;\">©{{site_name}} All Rights Reserved.</h2>\r\n                  </td>\r\n                </tr>\r\n            </tbody></table>\r\n        </td>\r\n    </tr>\r\n</tbody></table>', 'hi {{fullname}} ({{username}}), {{message}}', 'PhinEx', '{\"name\":\"php\"}', '{\"name\":\"custom\",\"nexmo\":{\"api_key\":\"------\",\"api_secret\":\"------\"},\"twilio\":{\"account_sid\":\"-----------------------\",\"auth_token\":\"-----------------------\",\"from\":\"----------------------\"},\"custom\":{\"method\":\"get\",\"url\":\"https:\\/\\/hostname\\/demo-api-v1\",\"headers\":{\"name\":[\"api_key\",\"Demo Api\"],\"value\":[\"test_api\",\"Demo Api\"]},\"body\":{\"name\":[\"from_number\",\"Demo body Api\"],\"value\":[\"565754\",\"Demo body API\"]}}}', '{\n    \"site_name\":\"Name of your site\"\n}', 0, 1, 0, 'primary', NULL, '2025-10-02 14:10:31');

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`id`, `user_id`, `name`, `email`, `contact`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Arif Hossain', 'arif.hossain@example.com', '+8801712345678', 0, '2025-09-26 05:42:49', '2025-10-02 09:18:32'),
(2, 2, 'Nusrat Jahan', 'nusrat.jahan@example.com', '+8801811122233', 1, '2025-09-26 05:44:22', '2025-09-28 15:23:08'),
(3, 1, 'Tanvir Alam', 'tanvir.alam@example.com', '+8801911223344', 1, '2025-09-26 05:44:40', '2025-09-28 13:33:47'),
(4, 2, 'Farzana Akter', 'farzana.akter@example.com', '+8801711334455', 1, '2025-09-26 05:45:01', '2025-09-28 15:23:01'),
(5, 1, 'Reza Karim', 'reza.karim@example.com', '+8801811445566', 1, '2025-09-26 05:45:22', '2025-09-28 13:32:21'),
(6, 2, 'Md Masud Alam', 'tasfin10@gmail.com', '01751473384', 1, '2025-09-28 13:33:29', '2025-09-28 15:22:55'),
(7, 1, 'Sabbi Khan', 'sabbir@gmail.com', '+8801236987456', 1, '2025-10-02 08:42:08', '2025-10-02 09:24:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `firstname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `flat_count` int UNSIGNED NOT NULL DEFAULT '0',
  `assigned_tenant_count` int UNSIGNED NOT NULL DEFAULT '0',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ver_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'stores verification code',
  `ver_code_send_at` datetime DEFAULT NULL COMMENT 'verification send time',
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `country_code`, `country_name`, `mobile`, `address`, `flat_count`, `assigned_tenant_count`, `password`, `ver_code`, `ver_code_send_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Sherrinford', 'Willum', 'demouser', 'demouser@gmail.com', 'BD', 'Bangladesh', '880123456789', '{\"city\":null,\"country\":\"Bangladesh\"}', 3, 3, '$2y$12$ohbXM0zRRWc7ydVfb1qmqeEOcU8kZkuapwbzGtVofwYNDb7htvu.y', '628388', '2023-12-09 11:54:35', NULL, '2023-11-09 12:39:56', '2025-10-02 09:24:36'),
(2, 'Demo', 'Two', 'demouser2', 'demotwo@gmail.com', 'AF', 'Afghanistan', '93123456789', NULL, 3, 3, '$2y$12$/KbLSCE76YS7DotaxE9XJuOHXeh1r6O2lADxbn/TuSdQNM5K0arxG', '938614', '2023-12-02 22:53:05', NULL, '2023-12-02 16:53:04', '2025-09-28 15:23:08'),
(3, 'Demo', 'Three', 'demouser3', 'demothree@demo.com', 'BH', 'Bahrain', '97312345678', NULL, 0, 0, '$2y$10$9iV79hrH/TxCjRvajYu9OuLFS25dZAtgrvutJiQSNuOW7ulWk9uEq', NULL, NULL, NULL, '2023-12-05 16:06:26', '2024-06-02 07:14:28'),
(4, 'Demo', 'Four', 'demouser4', 'demofour@demo.com', 'KW', 'Kuwait', '96512345678', NULL, 0, 0, '$2y$10$WMIdOJ01QcjUW9CSk1vjx.j6n4cWwD4V/T2O82ckTFYVg5m0dnUXK', NULL, NULL, NULL, '2023-12-05 16:07:25', '2023-12-05 16:07:25'),
(5, 'Demo', 'Five', 'demouser5', 'demofive@demo.com', 'MT', 'Malta', '35612345678', NULL, 0, 0, '$2y$10$mHk3S8SI3O7MCKlhvxLi7u4Px4v9ZXWm6Ux.pLPSe4wRB6Hm7dZVW', NULL, NULL, NULL, '2023-12-05 16:09:35', '2023-12-05 16:09:35'),
(10, 'Demo', 'Six', 'demouser6', 'demosix@demo.com', 'TM', 'Turkmenistan', '993123456789', NULL, 0, 0, '$2y$10$i3XurA7Zxy3h1dWiUP12b.s.Tcn0a9Do2gBUbmujUwz4bpvti1A7e', NULL, NULL, NULL, '2023-12-05 17:19:44', '2024-06-06 08:35:08'),
(11, 'Demo', 'Seven', 'demouser7', 'demoseven@demo.com', 'ZA', 'South Africa', '2712345678', '{\"city\":null,\"state\":null,\"zip\":null,\"country\":\"South Africa\"}', 0, 0, '$2y$10$.DrLjmLxOzvlmEqgHmf7zeiDiFV5WOoAEyDhwaj9HjbZHYnNfDw3i', NULL, NULL, NULL, '2023-12-05 17:20:42', '2025-09-30 12:18:29'),
(12, 'Demo', 'Eight', 'demouser8', 'demoeight@demo.com', 'GW', 'Guinea-Bissau', '245123456', '{\"city\":null,\"state\":null,\"zip\":null,\"country\":\"Guinea-Bissau\"}', 0, 0, '$2y$12$PtWx7UXReJCOZSKLtY0DF.XyYNwbXuYUlc939litmFND4zoN3F46a', NULL, NULL, NULL, '2025-09-30 14:56:30', '2025-09-30 15:08:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_categories`
--
ALTER TABLE `bill_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `flats`
--
ALTER TABLE `flats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bill_categories`
--
ALTER TABLE `bill_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flats`
--
ALTER TABLE `flats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
