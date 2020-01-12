-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 11, 2020 at 10:24 AM
-- Server version: 8.0.18
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thelifepassport`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`, `created_at`, `updated_at`) VALUES
(1, 'AF', 'Afghanistan', NULL, NULL),
(2, 'AL', 'Albania', NULL, NULL),
(3, 'DZ', 'Algeria', NULL, NULL),
(4, 'DS', 'American Samoa', NULL, NULL),
(5, 'AD', 'Andorra', NULL, NULL),
(6, 'AO', 'Angola', NULL, NULL),
(7, 'AI', 'Anguilla', NULL, NULL),
(8, 'AQ', 'Antarctica', NULL, NULL),
(9, 'AG', 'Antigua and Barbuda', NULL, NULL),
(10, 'AR', 'Argentina', NULL, NULL),
(11, 'AM', 'Armenia', NULL, NULL),
(12, 'AW', 'Aruba', NULL, NULL),
(13, 'AU', 'Australia', NULL, NULL),
(14, 'AT', 'Austria', NULL, NULL),
(15, 'AZ', 'Azerbaijan', NULL, NULL),
(16, 'BS', 'Bahamas', NULL, NULL),
(17, 'BH', 'Bahrain', NULL, NULL),
(18, 'BD', 'Bangladesh', NULL, NULL),
(19, 'BB', 'Barbados', NULL, NULL),
(20, 'BY', 'Belarus', NULL, NULL),
(21, 'BE', 'Belgium', NULL, NULL),
(22, 'BZ', 'Belize', NULL, NULL),
(23, 'BJ', 'Benin', NULL, NULL),
(24, 'BM', 'Bermuda', NULL, NULL),
(25, 'BT', 'Bhutan', NULL, NULL),
(26, 'BO', 'Bolivia', NULL, NULL),
(27, 'BA', 'Bosnia and Herzegovina', NULL, NULL),
(28, 'BW', 'Botswana', NULL, NULL),
(29, 'BV', 'Bouvet Island', NULL, NULL),
(30, 'BR', 'Brazil', NULL, NULL),
(31, 'IO', 'British Indian Ocean Territory', NULL, NULL),
(32, 'BN', 'Brunei Darussalam', NULL, NULL),
(33, 'BG', 'Bulgaria', NULL, NULL),
(34, 'BF', 'Burkina Faso', NULL, NULL),
(35, 'BI', 'Burundi', NULL, NULL),
(36, 'KH', 'Cambodia', NULL, NULL),
(37, 'CM', 'Cameroon', NULL, NULL),
(38, 'CA', 'Canada', NULL, NULL),
(39, 'CV', 'Cape Verde', NULL, NULL),
(40, 'KY', 'Cayman Islands', NULL, NULL),
(41, 'CF', 'Central African Republic', NULL, NULL),
(42, 'TD', 'Chad', NULL, NULL),
(43, 'CL', 'Chile', NULL, NULL),
(44, 'CN', 'China', NULL, NULL),
(45, 'CX', 'Christmas Island', NULL, NULL),
(46, 'CC', 'Cocos (Keeling) Islands', NULL, NULL),
(47, 'CO', 'Colombia', NULL, NULL),
(48, 'KM', 'Comoros', NULL, NULL),
(49, 'CD', 'Democratic Republic of the Congo', NULL, NULL),
(50, 'CG', 'Republic of the Congo', NULL, NULL),
(51, 'CK', 'Cook Islands', NULL, NULL),
(52, 'CR', 'Costa Rica', NULL, NULL),
(53, 'HR', 'Croatia (Hrvatska)', NULL, NULL),
(54, 'CU', 'Cuba', NULL, NULL),
(55, 'CY', 'Cyprus', NULL, NULL),
(56, 'CZ', 'Czech Republic', NULL, NULL),
(57, 'DK', 'Denmark', NULL, NULL),
(58, 'DJ', 'Djibouti', NULL, NULL),
(59, 'DM', 'Dominica', NULL, NULL),
(60, 'DO', 'Dominican Republic', NULL, NULL),
(61, 'TP', 'East Timor', NULL, NULL),
(62, 'EC', 'Ecuador', NULL, NULL),
(63, 'EG', 'Egypt', NULL, NULL),
(64, 'SV', 'El Salvador', NULL, NULL),
(65, 'GQ', 'Equatorial Guinea', NULL, NULL),
(66, 'ER', 'Eritrea', NULL, NULL),
(67, 'EE', 'Estonia', NULL, NULL),
(68, 'ET', 'Ethiopia', NULL, NULL),
(69, 'FK', 'Falkland Islands (Malvinas)', NULL, NULL),
(70, 'FO', 'Faroe Islands', NULL, NULL),
(71, 'FJ', 'Fiji', NULL, NULL),
(72, 'FI', 'Finland', NULL, NULL),
(73, 'FR', 'France', NULL, NULL),
(74, 'FX', 'France, Metropolitan', NULL, NULL),
(75, 'GF', 'French Guiana', NULL, NULL),
(76, 'PF', 'French Polynesia', NULL, NULL),
(77, 'TF', 'French Southern Territories', NULL, NULL),
(78, 'GA', 'Gabon', NULL, NULL),
(79, 'GM', 'Gambia', NULL, NULL),
(80, 'GE', 'Georgia', NULL, NULL),
(81, 'DE', 'Germany', NULL, NULL),
(82, 'GH', 'Ghana', NULL, NULL),
(83, 'GI', 'Gibraltar', NULL, NULL),
(84, 'GK', 'Guernsey', NULL, NULL),
(85, 'GR', 'Greece', NULL, NULL),
(86, 'GL', 'Greenland', NULL, NULL),
(87, 'GD', 'Grenada', NULL, NULL),
(88, 'GP', 'Guadeloupe', NULL, NULL),
(89, 'GU', 'Guam', NULL, NULL),
(90, 'GT', 'Guatemala', NULL, NULL),
(91, 'GN', 'Guinea', NULL, NULL),
(92, 'GW', 'Guinea-Bissau', NULL, NULL),
(93, 'GY', 'Guyana', NULL, NULL),
(94, 'HT', 'Haiti', NULL, NULL),
(95, 'HM', 'Heard and Mc Donald Islands', NULL, NULL),
(96, 'HN', 'Honduras', NULL, NULL),
(97, 'HK', 'Hong Kong', NULL, NULL),
(98, 'HU', 'Hungary', NULL, NULL),
(99, 'IS', 'Iceland', NULL, NULL),
(100, 'IN', 'India', NULL, NULL),
(101, 'IM', 'Isle of Man', NULL, NULL),
(102, 'ID', 'Indonesia', NULL, NULL),
(103, 'IR', 'Iran (Islamic Republic of)', NULL, NULL),
(104, 'IQ', 'Iraq', NULL, NULL),
(105, 'IE', 'Ireland', NULL, NULL),
(106, 'IL', 'Israel', NULL, NULL),
(107, 'IT', 'Italy', NULL, NULL),
(108, 'CI', 'Ivory Coast', NULL, NULL),
(109, 'JE', 'Jersey', NULL, NULL),
(110, 'JM', 'Jamaica', NULL, NULL),
(111, 'JP', 'Japan', NULL, NULL),
(112, 'JO', 'Jordan', NULL, NULL),
(113, 'KZ', 'Kazakhstan', NULL, NULL),
(114, 'KE', 'Kenya', NULL, NULL),
(115, 'KI', 'Kiribati', NULL, NULL),
(116, 'KP', 'Korea, Democratic People\'s Republic of', NULL, NULL),
(117, 'KR', 'Korea, Republic of', NULL, NULL),
(118, 'XK', 'Kosovo', NULL, NULL),
(119, 'KW', 'Kuwait', NULL, NULL),
(120, 'KG', 'Kyrgyzstan', NULL, NULL),
(121, 'LA', 'Lao People\'s Democratic Republic', NULL, NULL),
(122, 'LV', 'Latvia', NULL, NULL),
(123, 'LB', 'Lebanon', NULL, NULL),
(124, 'LS', 'Lesotho', NULL, NULL),
(125, 'LR', 'Liberia', NULL, NULL),
(126, 'LY', 'Libyan Arab Jamahiriya', NULL, NULL),
(127, 'LI', 'Liechtenstein', NULL, NULL),
(128, 'LT', 'Lithuania', NULL, NULL),
(129, 'LU', 'Luxembourg', NULL, NULL),
(130, 'MO', 'Macau', NULL, NULL),
(131, 'MK', 'North Macedonia', NULL, NULL),
(132, 'MG', 'Madagascar', NULL, NULL),
(133, 'MW', 'Malawi', NULL, NULL),
(134, 'MY', 'Malaysia', NULL, NULL),
(135, 'MV', 'Maldives', NULL, NULL),
(136, 'ML', 'Mali', NULL, NULL),
(137, 'MT', 'Malta', NULL, NULL),
(138, 'MH', 'Marshall Islands', NULL, NULL),
(139, 'MQ', 'Martinique', NULL, NULL),
(140, 'MR', 'Mauritania', NULL, NULL),
(141, 'MU', 'Mauritius', NULL, NULL),
(142, 'TY', 'Mayotte', NULL, NULL),
(143, 'MX', 'Mexico', NULL, NULL),
(144, 'FM', 'Micronesia, Federated States of', NULL, NULL),
(145, 'MD', 'Moldova, Republic of', NULL, NULL),
(146, 'MC', 'Monaco', NULL, NULL),
(147, 'MN', 'Mongolia', NULL, NULL),
(148, 'ME', 'Montenegro', NULL, NULL),
(149, 'MS', 'Montserrat', NULL, NULL),
(150, 'MA', 'Morocco', NULL, NULL),
(151, 'MZ', 'Mozambique', NULL, NULL),
(152, 'MM', 'Myanmar', NULL, NULL),
(153, 'NA', 'Namibia', NULL, NULL),
(154, 'NR', 'Nauru', NULL, NULL),
(155, 'NP', 'Nepal', NULL, NULL),
(156, 'NL', 'Netherlands', NULL, NULL),
(157, 'AN', 'Netherlands Antilles', NULL, NULL),
(158, 'NC', 'New Caledonia', NULL, NULL),
(159, 'NZ', 'New Zealand', NULL, NULL),
(160, 'NI', 'Nicaragua', NULL, NULL),
(161, 'NE', 'Niger', NULL, NULL),
(162, 'NG', 'Nigeria', NULL, NULL),
(163, 'NU', 'Niue', NULL, NULL),
(164, 'NF', 'Norfolk Island', NULL, NULL),
(165, 'MP', 'Northern Mariana Islands', NULL, NULL),
(166, 'NO', 'Norway', NULL, NULL),
(167, 'OM', 'Oman', NULL, NULL),
(168, 'PK', 'Pakistan', NULL, NULL),
(169, 'PW', 'Palau', NULL, NULL),
(170, 'PS', 'Palestine', NULL, NULL),
(171, 'PA', 'Panama', NULL, NULL),
(172, 'PG', 'Papua New Guinea', NULL, NULL),
(173, 'PY', 'Paraguay', NULL, NULL),
(174, 'PE', 'Peru', NULL, NULL),
(175, 'PH', 'Philippines', NULL, NULL),
(176, 'PN', 'Pitcairn', NULL, NULL),
(177, 'PL', 'Poland', NULL, NULL),
(178, 'PT', 'Portugal', NULL, NULL),
(179, 'PR', 'Puerto Rico', NULL, NULL),
(180, 'QA', 'Qatar', NULL, NULL),
(181, 'RE', 'Reunion', NULL, NULL),
(182, 'RO', 'Romania', NULL, NULL),
(183, 'RU', 'Russian Federation', NULL, NULL),
(184, 'RW', 'Rwanda', NULL, NULL),
(185, 'KN', 'Saint Kitts and Nevis', NULL, NULL),
(186, 'LC', 'Saint Lucia', NULL, NULL),
(187, 'VC', 'Saint Vincent and the Grenadines', NULL, NULL),
(188, 'WS', 'Samoa', NULL, NULL),
(189, 'SM', 'San Marino', NULL, NULL),
(190, 'ST', 'Sao Tome and Principe', NULL, NULL),
(191, 'SA', 'Saudi Arabia', NULL, NULL),
(192, 'SN', 'Senegal', NULL, NULL),
(193, 'RS', 'Serbia', NULL, NULL),
(194, 'SC', 'Seychelles', NULL, NULL),
(195, 'SL', 'Sierra Leone', NULL, NULL),
(196, 'SG', 'Singapore', NULL, NULL),
(197, 'SK', 'Slovakia', NULL, NULL),
(198, 'SI', 'Slovenia', NULL, NULL),
(199, 'SB', 'Solomon Islands', NULL, NULL),
(200, 'SO', 'Somalia', NULL, NULL),
(201, 'ZA', 'South Africa', NULL, NULL),
(202, 'GS', 'South Georgia South Sandwich Islands', NULL, NULL),
(203, 'SS', 'South Sudan', NULL, NULL),
(204, 'ES', 'Spain', NULL, NULL),
(205, 'LK', 'Sri Lanka', NULL, NULL),
(206, 'SH', 'St. Helena', NULL, NULL),
(207, 'PM', 'St. Pierre and Miquelon', NULL, NULL),
(208, 'SD', 'Sudan', NULL, NULL),
(209, 'SR', 'Suriname', NULL, NULL),
(210, 'SJ', 'Svalbard and Jan Mayen Islands', NULL, NULL),
(211, 'SZ', 'Swaziland', NULL, NULL),
(212, 'SE', 'Sweden', NULL, NULL),
(213, 'CH', 'Switzerland', NULL, NULL),
(214, 'SY', 'Syrian Arab Republic', NULL, NULL),
(215, 'TW', 'Taiwan', NULL, NULL),
(216, 'TJ', 'Tajikistan', NULL, NULL),
(217, 'TZ', 'Tanzania, United Republic of', NULL, NULL),
(218, 'TH', 'Thailand', NULL, NULL),
(219, 'TG', 'Togo', NULL, NULL),
(220, 'TK', 'Tokelau', NULL, NULL),
(221, 'TO', 'Tonga', NULL, NULL),
(222, 'TT', 'Trinidad and Tobago', NULL, NULL),
(223, 'TN', 'Tunisia', NULL, NULL),
(224, 'TR', 'Turkey', NULL, NULL),
(225, 'TM', 'Turkmenistan', NULL, NULL),
(226, 'TC', 'Turks and Caicos Islands', NULL, NULL),
(227, 'TV', 'Tuvalu', NULL, NULL),
(228, 'UG', 'Uganda', NULL, NULL),
(229, 'UA', 'Ukraine', NULL, NULL),
(230, 'AE', 'United Arab Emirates', NULL, NULL),
(231, 'GB', 'United Kingdom', NULL, NULL),
(232, 'US', 'United States', NULL, NULL),
(233, 'UM', 'United States minor outlying islands', NULL, NULL),
(234, 'UY', 'Uruguay', NULL, NULL),
(235, 'UZ', 'Uzbekistan', NULL, NULL),
(236, 'VU', 'Vanuatu', NULL, NULL),
(237, 'VA', 'Vatican City State', NULL, NULL),
(238, 'VE', 'Venezuela', NULL, NULL),
(239, 'VN', 'Vietnam', NULL, NULL),
(240, 'VG', 'Virgin Islands (British)', NULL, NULL),
(241, 'VI', 'Virgin Islands (U.S.)', NULL, NULL),
(242, 'WF', 'Wallis and Futuna Islands', NULL, NULL),
(243, 'EH', 'Western Sahara', NULL, NULL),
(244, 'YE', 'Yemen', NULL, NULL),
(245, 'ZM', 'Zambia', NULL, NULL),
(246, 'ZW', 'Zimbabwe', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `divorce_docs`
--

CREATE TABLE `divorce_docs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divorce_docs`
--

INSERT INTO `divorce_docs` (`id`, `user_id`, `title`, `url`, `created_at`, `updated_at`) VALUES
(2, 1, 'aa8a64171179acdc85e523207a82cbd943e32a210953a16d6a7843c0bd853f66.css', 'http://api-tlp.localhost/storage/divorce_agreement/aa8a64171179acdc85e523207a82cbd943e32a210953a16d6a7843c0bd853f66.css', '2020-01-05 10:05:04', '2020-01-05 10:05:04');

-- --------------------------------------------------------

--
-- Table structure for table `marriage_statuses`
--

CREATE TABLE `marriage_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_married` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0=>No,1=>Yes,2=>Skipped',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `marriage_statuses`
--

INSERT INTO `marriage_statuses` (`id`, `user_id`, `is_married`, `created_at`, `updated_at`) VALUES
(3, 1, '1', '2020-01-05 09:16:38', '2020-01-05 09:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_10_28_073956_add_extra_field_to_users_table', 2),
(4, '2019_10_28_122953_add_role_field_to_users_table', 3),
(5, '2019_10_28_131018_add_is_active_field_to_users_table', 4),
(6, '2019_12_22_101615_create_social_media_table', 5),
(7, '2019_12_22_101947_create_personal_details_steps_table', 5),
(8, '2019_12_22_102859_create_countries_table', 5),
(9, '2019_12_22_110450_create_users_personal_details_completions_table', 6),
(10, '2019_12_25_134431_create_user_phones_table', 7),
(11, '2019_12_25_134455_create_user_emails_table', 7),
(12, '2019_12_25_134521_create_user_socail_media_table', 7),
(13, '2019_12_25_134537_create_user_employers_table', 8),
(14, '2019_12_25_170259_create_personal_info', 9),
(15, '2019_12_25_184759_add_password_to_user_emails_table', 10),
(16, '2019_12_25_185312_add_username_password_to_user_socail_media_table', 11),
(18, '2019_12_28_163010_create_spouse_phones_table', 12),
(19, '2019_12_28_163017_create_spouse_emails_table', 12),
(20, '2019_12_28_163035_create_spouse_social_media_table', 13),
(21, '2019_12_28_163056_create_spouse_employers_table', 13),
(22, '2019_12_29_070352_create_marriage_statuses_table', 14),
(23, '2019_12_29_071919_add_user_id_to_marriage_statuses_table', 14),
(24, '2019_12_28_161608_create_spouse_infos_table', 15),
(25, '2019_12_29_142118_create_previous_marriage_statuses_table', 16),
(26, '2019_12_29_142510_create_previous_spouse_infos_table', 17),
(27, '2019_12_29_143459_create_previous_spouse_phones_table', 17),
(29, '2019_12_31_131220_add_address_divorce_agreement_alimony_amount_to_previous_spouse_infos_table', 18),
(32, '2020_01_04_085740_create_divorce_docs_table', 19),
(33, '2020_01_04_143556_add_sequence_to_personal_details_steps', 20),
(34, '2020_01_05_034429_add_is_completed_to_users_personal_details_completions', 21),
(35, '2020_01_05_073317_add_is_visited_to_users_personal_details_completions', 22);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('mdprawez.musharraf@gmail.com', '$2y$10$ScKK95zKiWEDlnhhhyp7d.RVdIDXJCAFnxkP87rWOVnpQjC4HyZoi', '2020-01-07 12:01:43');

-- --------------------------------------------------------

--
-- Table structure for table `personal_details_steps`
--

CREATE TABLE `personal_details_steps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `step` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` tinyint(4) NOT NULL,
  `sequence` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_details_steps`
--

INSERT INTO `personal_details_steps` (`id`, `step`, `slug`, `percentage`, `sequence`, `created_at`, `updated_at`) VALUES
(1, 'Your personal details', 'personal_details', 10, 1, NULL, NULL),
(2, 'Are you married?', 'spouse', 10, 2, NULL, NULL),
(3, 'Were you previously married?', 'previous_spouse', 10, 3, NULL, NULL),
(4, 'Would you like to add close family members including children?', 'family_members', 10, 4, NULL, NULL),
(5, 'Would you like any close friends contacted?', 'close_friends', 10, 5, NULL, NULL),
(6, 'Do you have any home assistants?', 'home_assistants', 10, 6, NULL, NULL),
(7, 'Do you have a personal representative for your estate?', 'estate_representative', 10, 7, NULL, NULL),
(8, 'Does your spouse/life partner/signifcant other have a personal representative of their estate?', 'spouse_estate_representative', 10, 8, NULL, NULL),
(9, 'Do you belong to any professional, religious, non-profit, civic or social organizations?', 'religious_organization', 10, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_info`
--

CREATE TABLE `personal_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `legal_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `dob` date DEFAULT NULL,
  `country_id` bigint(20) DEFAULT NULL,
  `passport_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_birth_place` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_birth_place` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_info`
--

INSERT INTO `personal_info` (`id`, `user_id`, `legal_name`, `nickname`, `home_address`, `dob`, `country_id`, `passport_number`, `father_name`, `father_birth_place`, `mother_name`, `mother_birth_place`, `created_at`, `updated_at`) VALUES
(1, 1, 'Md Prawez', 'Musharraf', 'Vedific Learning Solutions Pvt. Ltd.\r\nPlot No 45-46, Udyog Vihar Phase-1', '1985-01-15', 100, 'ASCFGVBH', 'Md Musharraf Ali', 'Sultanganj, Bhagagpur', 'Hamida Begum', 'Bhagalpur, Bihar', '2020-01-05 04:43:51', '2020-01-07 11:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `previous_marriage_statuses`
--

CREATE TABLE `previous_marriage_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_previously_married` enum('0','1','2') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0=>No, 1=>Yes, 2=>Skipped',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `previous_marriage_statuses`
--

INSERT INTO `previous_marriage_statuses` (`id`, `user_id`, `is_previously_married`, `created_at`, `updated_at`) VALUES
(2, 1, '1', '2020-01-05 10:04:38', '2020-01-05 10:04:38');

-- --------------------------------------------------------

--
-- Table structure for table `previous_spouse_infos`
--

CREATE TABLE `previous_spouse_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `legal_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marriage_date` date DEFAULT NULL,
  `marriage_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `divorce_date` date DEFAULT NULL,
  `divorce_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `divorce_agreement_doc` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alimony_amount` decimal(8,2) DEFAULT NULL,
  `is_alimony_paid` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=> No, 1=>Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `previous_spouse_infos`
--

INSERT INTO `previous_spouse_infos` (`id`, `user_id`, `legal_name`, `marriage_date`, `marriage_location`, `divorce_date`, `divorce_location`, `email`, `address`, `divorce_agreement_doc`, `alimony_amount`, `is_alimony_paid`, `created_at`, `updated_at`) VALUES
(2, 1, 'Md Prawez', '2020-01-14', 'Bhagalpur', '2020-01-08', 'Bhagalpur updated', 'prawez.musharraf@digivive.com', 'Vedific Learning Solutions Pvt. Ltd.\r\nPlot No 45-46, Udyog Vihar Phase-1', '', '12.00', '1', '2020-01-05 10:05:04', '2020-01-05 10:05:04');

-- --------------------------------------------------------

--
-- Table structure for table `previous_spouse_phones`
--

CREATE TABLE `previous_spouse_phones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_primary` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `previous_spouse_phones`
--

INSERT INTO `previous_spouse_phones` (`id`, `user_id`, `phone`, `is_primary`, `created_at`, `updated_at`) VALUES
(5, 1, '8130779797', '0', '2020-01-05 10:05:04', '2020-01-05 10:05:04'),
(6, 1, '9560290787', '0', '2020-01-05 10:05:04', '2020-01-05 10:05:04');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=>Inactive, 1=>active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Facebook', '1', '2019-12-24 18:30:00', NULL),
(2, 'Twitter', '1', '2019-12-24 18:30:00', NULL),
(3, 'Instagram', '1', '2019-12-24 18:30:00', NULL),
(4, 'LinkedIn', '1', '2019-12-24 18:30:00', NULL),
(5, 'Youtube', '1', '2019-12-24 18:30:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `spouse_emails`
--

CREATE TABLE `spouse_emails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_primary` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spouse_emails`
--

INSERT INTO `spouse_emails` (`id`, `user_id`, `email`, `password`, `is_primary`, `created_at`, `updated_at`) VALUES
(10, 1, 'mdprawez.musharraf@gmail.com', 'Classic@123', '0', '2020-01-05 09:23:39', '2020-01-05 09:23:39'),
(11, 1, 'prawez.musharraf@digivive.com', '12345678', '0', '2020-01-05 09:23:39', '2020-01-05 09:23:39');

-- --------------------------------------------------------

--
-- Table structure for table `spouse_employers`
--

CREATE TABLE `spouse_employers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `employer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employer_phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employer_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `computer_username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `computer_password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `benefits_used` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spouse_employers`
--

INSERT INTO `spouse_employers` (`id`, `user_id`, `employer_name`, `employer_phone`, `employer_address`, `computer_username`, `computer_password`, `benefits_used`, `created_at`, `updated_at`) VALUES
(7, 1, 'Convexdigital Software Solution Pvt Ltd', '1234567890', 'Vedific Learning Solutions Pvt. Ltd.\r\nPlot No 45-46, Udyog Vihar Phase-1', 'Vedific', 'Vedific', 'Nothing', '2020-01-05 09:23:39', '2020-01-05 09:23:39');

-- --------------------------------------------------------

--
-- Table structure for table `spouse_infos`
--

CREATE TABLE `spouse_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `legal_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `country_id` bigint(20) NOT NULL,
  `passport_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_birth_place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_birth_place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marriage_date` date NOT NULL,
  `marriage_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spouse_infos`
--

INSERT INTO `spouse_infos` (`id`, `user_id`, `legal_name`, `nickname`, `home_address`, `dob`, `country_id`, `passport_number`, `father_name`, `father_birth_place`, `mother_name`, `mother_birth_place`, `marriage_date`, `marriage_location`, `created_at`, `updated_at`) VALUES
(4, 1, 'Md Prawez', 'Musharraf', 'Vedific Learning Solutions Pvt. Ltd.\r\nPlot No 45-46, Udyog Vihar Phase-1', '2020-01-06', 100, 'ASCFGVBH', 'Md Musharraf Ali', 'Haryana', 'Hamida Begum', 'Haryana', '2020-01-07', 'Bhagalpur', '2020-01-05 09:23:26', '2020-01-05 09:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `spouse_phones`
--

CREATE TABLE `spouse_phones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_primary` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spouse_phones`
--

INSERT INTO `spouse_phones` (`id`, `user_id`, `phone`, `is_primary`, `created_at`, `updated_at`) VALUES
(13, 1, '8130779797', '0', '2020-01-05 09:23:39', '2020-01-05 09:23:39'),
(14, 1, '9560290787', '0', '2020-01-05 09:23:39', '2020-01-05 09:23:39');

-- --------------------------------------------------------

--
-- Table structure for table `spouse_social_media`
--

CREATE TABLE `spouse_social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `social_id` bigint(20) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_primary` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spouse_social_media`
--

INSERT INTO `spouse_social_media` (`id`, `user_id`, `social_id`, `username`, `password`, `is_primary`, `created_at`, `updated_at`) VALUES
(10, 1, 1, 'mdprawez.musharraf@gmail.com', '12345678', '0', '2020-01-05 09:23:39', '2020-01-05 09:23:39'),
(11, 1, 2, 'md.prawez', '12345678', '0', '2020-01-05 09:23:39', '2020-01-05 09:23:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1=>Admin, 2=>User',
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone_number`, `role`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Md Prawez Musharraf', 'mdprawez.musharraf@gmail.com', '2019-10-28 13:11:31', '$2y$10$m2P94u83GiF1/ExWUb2w8.apWcDnjPTEpHA/8lvlHjPNXiGKkr8GG', '8130779797', 2, 1, 'iErmJmzSx4mv7sxD0PKnH2yBr7EZ2uCUWJg5Ag94MFXLPsbTsI1NyCyR9NEI', '2019-10-28 13:11:18', '2019-10-28 13:16:30'),
(2, 'Prawez Test', 'prawez@yopmail.com', NULL, '$2y$10$eL6qvytV3.cu2CAdZ8BXw.8/y.ISnHdAdkzrcG5xrF.XWaL4HosY6', '9939251483', 2, 0, NULL, '2020-01-05 10:18:56', '2020-01-05 10:18:56');

-- --------------------------------------------------------

--
-- Table structure for table `users_personal_details_completions`
--

CREATE TABLE `users_personal_details_completions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `step_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_visited` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_filled` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=>No, 1=>Yes',
  `is_completed` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=>Not Completed, 1=>Completed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_personal_details_completions`
--

INSERT INTO `users_personal_details_completions` (`id`, `step_id`, `user_id`, `is_visited`, `is_filled`, `is_completed`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1', '1', '0', '2020-01-05 04:43:51', '2020-01-07 11:40:28'),
(5, 2, 1, '1', '0', '0', '2020-01-05 05:00:33', '2020-01-07 11:40:28'),
(6, 3, 1, '1', '0', '0', '2020-01-05 05:12:45', '2020-01-07 12:29:39');

-- --------------------------------------------------------

--
-- Table structure for table `user_emails`
--

CREATE TABLE `user_emails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_primary` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_emails`
--

INSERT INTO `user_emails` (`id`, `user_id`, `email`, `password`, `is_primary`, `created_at`, `updated_at`) VALUES
(100, 1, 'mdprawez.musharraf@gmail.com', 'Classic@123', '0', '2020-01-07 11:40:28', '2020-01-07 11:40:28'),
(101, 1, 'prawez.musharraf@digivivie.com', 'Classic@123', '0', '2020-01-07 11:40:28', '2020-01-07 11:40:28'),
(102, 1, 'mdprawez.musharraf@gmail.com', 'Classic@123', '0', '2020-01-07 11:40:28', '2020-01-07 11:40:28'),
(103, 1, 'mdprawez.musharraf@gmail.com', 'Classic@123', '0', '2020-01-07 11:40:28', '2020-01-07 11:40:28'),
(104, 1, 'prawez.musharraf@digivive.com', 'Classic@123', '0', '2020-01-07 11:40:28', '2020-01-07 11:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_employers`
--

CREATE TABLE `user_employers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `employer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employer_phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employer_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `computer_username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `computer_password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `benefits_used` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_employers`
--

INSERT INTO `user_employers` (`id`, `user_id`, `employer_name`, `employer_phone`, `employer_address`, `computer_username`, `computer_password`, `benefits_used`, `created_at`, `updated_at`) VALUES
(37, 1, 'Convexdigital Software Solution Pvt Ltd', '1234567890', 'Noida sec 62, UP', 'm.prawez', '12345678', 'Nothing taken', '2020-01-07 11:40:28', '2020-01-07 11:40:28'),
(38, 1, 'Convexdigital Software Solution Pvt Ltd', '1234567890', 'Vedific Learning Solutions Pvt. Ltd.\r\nPlot No 45-46, Udyog Vihar Phase-1', 'Vedific', 'Vedific', 'Nothing', '2020-01-07 11:40:28', '2020-01-07 11:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_phones`
--

CREATE TABLE `user_phones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_primary` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_phones`
--

INSERT INTO `user_phones` (`id`, `user_id`, `phone`, `is_primary`, `created_at`, `updated_at`) VALUES
(73, 1, '8130779797', '0', '2020-01-07 11:40:28', '2020-01-07 11:40:28'),
(74, 1, '9990506393', '0', '2020-01-07 11:40:28', '2020-01-07 11:40:28'),
(75, 1, '8130779797', '0', '2020-01-07 11:40:28', '2020-01-07 11:40:28'),
(76, 1, '9990506393', '0', '2020-01-07 11:40:28', '2020-01-07 11:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_socail_media`
--

CREATE TABLE `user_socail_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `social_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_primary` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_socail_media`
--

INSERT INTO `user_socail_media` (`id`, `user_id`, `social_id`, `username`, `password`, `is_primary`, `created_at`, `updated_at`) VALUES
(77, 1, 1, 'mdprawez.musharraf@gmail.com', 'Classic@123', '0', '2020-01-07 11:40:28', '2020-01-07 11:40:28'),
(78, 1, 2, 'mdmusharraf', 'Classic@123', '0', '2020-01-07 11:40:28', '2020-01-07 11:40:28'),
(79, 1, 3, 'md.prawez', 'Classic@123', '0', '2020-01-07 11:40:28', '2020-01-07 11:40:28'),
(80, 1, 1, 'mdprawez.musharraf@gmail.com', 'Classic@123', '0', '2020-01-07 11:40:28', '2020-01-07 11:40:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divorce_docs`
--
ALTER TABLE `divorce_docs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `divorce_docs_user_id_foreign` (`user_id`);

--
-- Indexes for table `marriage_statuses`
--
ALTER TABLE `marriage_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marriage_statuses_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_details_steps`
--
ALTER TABLE `personal_details_steps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_info`
--
ALTER TABLE `personal_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_info_user_id_foreign` (`user_id`);

--
-- Indexes for table `previous_marriage_statuses`
--
ALTER TABLE `previous_marriage_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `previous_marriage_statuses_user_id_foreign` (`user_id`);

--
-- Indexes for table `previous_spouse_infos`
--
ALTER TABLE `previous_spouse_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `previous_spouse_infos_user_id_foreign` (`user_id`);

--
-- Indexes for table `previous_spouse_phones`
--
ALTER TABLE `previous_spouse_phones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `previous_spouse_phones_user_id_foreign` (`user_id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spouse_emails`
--
ALTER TABLE `spouse_emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spouse_emails_user_id_foreign` (`user_id`);

--
-- Indexes for table `spouse_employers`
--
ALTER TABLE `spouse_employers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spouse_employers_user_id_foreign` (`user_id`);

--
-- Indexes for table `spouse_infos`
--
ALTER TABLE `spouse_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spouse_infos_user_id_foreign` (`user_id`);

--
-- Indexes for table `spouse_phones`
--
ALTER TABLE `spouse_phones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spouse_phones_user_id_foreign` (`user_id`);

--
-- Indexes for table `spouse_social_media`
--
ALTER TABLE `spouse_social_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spouse_social_media_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_personal_details_completions`
--
ALTER TABLE `users_personal_details_completions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_personal_details_completions_user_id_foreign` (`user_id`),
  ADD KEY `users_personal_details_completions_step_id_foreign` (`step_id`);

--
-- Indexes for table `user_emails`
--
ALTER TABLE `user_emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_emails_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_employers`
--
ALTER TABLE `user_employers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_employers_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_phones`
--
ALTER TABLE `user_phones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_phones_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_socail_media`
--
ALTER TABLE `user_socail_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_socail_media_user_id_foreign` (`user_id`),
  ADD KEY `user_socail_media_social_id_foreign` (`social_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `divorce_docs`
--
ALTER TABLE `divorce_docs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `marriage_statuses`
--
ALTER TABLE `marriage_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `personal_details_steps`
--
ALTER TABLE `personal_details_steps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_info`
--
ALTER TABLE `personal_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `previous_marriage_statuses`
--
ALTER TABLE `previous_marriage_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `previous_spouse_infos`
--
ALTER TABLE `previous_spouse_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `previous_spouse_phones`
--
ALTER TABLE `previous_spouse_phones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `spouse_emails`
--
ALTER TABLE `spouse_emails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `spouse_employers`
--
ALTER TABLE `spouse_employers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `spouse_infos`
--
ALTER TABLE `spouse_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `spouse_phones`
--
ALTER TABLE `spouse_phones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `spouse_social_media`
--
ALTER TABLE `spouse_social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_personal_details_completions`
--
ALTER TABLE `users_personal_details_completions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_emails`
--
ALTER TABLE `user_emails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `user_employers`
--
ALTER TABLE `user_employers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user_phones`
--
ALTER TABLE `user_phones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `user_socail_media`
--
ALTER TABLE `user_socail_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `divorce_docs`
--
ALTER TABLE `divorce_docs`
  ADD CONSTRAINT `divorce_docs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `marriage_statuses`
--
ALTER TABLE `marriage_statuses`
  ADD CONSTRAINT `marriage_statuses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `personal_info`
--
ALTER TABLE `personal_info`
  ADD CONSTRAINT `personal_info_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `previous_marriage_statuses`
--
ALTER TABLE `previous_marriage_statuses`
  ADD CONSTRAINT `previous_marriage_statuses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `previous_spouse_infos`
--
ALTER TABLE `previous_spouse_infos`
  ADD CONSTRAINT `previous_spouse_infos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `previous_spouse_phones`
--
ALTER TABLE `previous_spouse_phones`
  ADD CONSTRAINT `previous_spouse_phones_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `spouse_emails`
--
ALTER TABLE `spouse_emails`
  ADD CONSTRAINT `spouse_emails_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `spouse_employers`
--
ALTER TABLE `spouse_employers`
  ADD CONSTRAINT `spouse_employers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `spouse_infos`
--
ALTER TABLE `spouse_infos`
  ADD CONSTRAINT `spouse_infos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `spouse_phones`
--
ALTER TABLE `spouse_phones`
  ADD CONSTRAINT `spouse_phones_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `spouse_social_media`
--
ALTER TABLE `spouse_social_media`
  ADD CONSTRAINT `spouse_social_media_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users_personal_details_completions`
--
ALTER TABLE `users_personal_details_completions`
  ADD CONSTRAINT `users_personal_details_completions_step_id_foreign` FOREIGN KEY (`step_id`) REFERENCES `personal_details_steps` (`id`),
  ADD CONSTRAINT `users_personal_details_completions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_emails`
--
ALTER TABLE `user_emails`
  ADD CONSTRAINT `user_emails_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_employers`
--
ALTER TABLE `user_employers`
  ADD CONSTRAINT `user_employers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_phones`
--
ALTER TABLE `user_phones`
  ADD CONSTRAINT `user_phones_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_socail_media`
--
ALTER TABLE `user_socail_media`
  ADD CONSTRAINT `user_socail_media_social_id_foreign` FOREIGN KEY (`social_id`) REFERENCES `social_media` (`id`),
  ADD CONSTRAINT `user_socail_media_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
