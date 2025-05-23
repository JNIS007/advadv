-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2025 at 02:09 PM
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
-- Database: `newsportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` int(11) NOT NULL,
  `PageName` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `ImageURL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `PageName`, `PageTitle`, `Description`, `PostingDate`, `UpdationDate`, `ImageURL`) VALUES
(1, 'Responsible Tourism in Nepal with Advanced Adventures', 'Responsible Tourism in Nepal with Advanced Adventures', '<p>Advanced Adventures Nepal: Travel with Purpose At Advanced Adventures Nepal, we believe that travel has the power to transform lives&mdash;not just for those who journey, but for the communities and environments they encounter. We are passionate about responsible tourism, a philosophy that guides every step we take. As guests in the regions we explore, we strive to tread lightly, leaving behind only positive impacts and meaningful connections. Our commitment to responsible travel ensures that every adventure enriches both travelers and the destinations they visit. This section of our website offers a glimpse into how we bring responsible travel to life, ensuring that our journeys are as sustainable as they are unforgettable. Our Commitment to Responsible Tourism</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><img alt=\"\" src=\"https://goodies.icons8.com/web/common/autocomplete/domains/icons.svg\" style=\"float:left; height:20px; width:20px\" />&nbsp;&nbsp;<span style=\"color:#3498db\">Porter Welfare</span>: </strong> The health and safety of our porters are non-negotiable. We adhere to the International Porter Protection Guidelines (IPPG) and have proudly supported initiatives like the Lukla Porter Clothing Bank in Khumbu, ensuring our porters are equipped and cared for.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Carbon Neutrality: </strong> We are dedicated to combating climate change. Through our partnership with Climate Care, we offset our annual carbon emissions by funding impactful projects that reduce greenhouse gases across Nepal.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>3. Cultural Exchange:</strong>  We believe travel is a bridge between cultures. Our Trip Dossiers provide in-depth insights into local customs, while our experienced guides foster meaningful connections through engaging, on-the-ground discussions.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>4. Integrated Approach:</strong>  Responsible tourism is at the heart of everything we do. From crafting itineraries to managing resources, we ensure sustainability is woven into every aspect of our operations.</p>\r\n\r\n<p>Your Role in Responsible Travel As our valued partners, you play a vital role in shaping the impact of our journeys. Here&rsquo;s how you can join us in creating a positive legacy:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Supporting Local Economies:</strong></p>\r\n\r\n<ul>\r\n	<li>&nbsp;Shop Local: Immerse yourself in Nepal&rsquo;s vibrant culture by purchasing handcrafted goods. Your support helps sustain traditional skills and empowers local artisans.</li>\r\n	<li>&nbsp;Gratuities: A heartfelt tip goes a long way in Nepal. Your generosity is a meaningful way to show appreciation for exceptional service.</li>\r\n	<li>Bargaining: Engage in bargaining with respect and humour, keeping in mind the value of small sums to local livelihoods.</li>\r\n	<li>Strategic Giving: Instead of giving directly to beggars, consider donating to reputable local charities.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>This approach fosters long-term community development. Respecting Culture and Community:</p>\r\n\r\n<ul>\r\n	<li>&nbsp;Learn the Language: A few words in Nepali can open doors to deeper connections and enrich your travel experience.</li>\r\n	<li>&nbsp;Cultural Sensitivity: Always ask for permission before taking photos, honoring personal privacy and cultural norms.</li>\r\n	<li>&nbsp;Leave It Better: Strive to leave every place cleaner and more beautiful than you found it.</li>\r\n	<li>Traditions: Respect local customs, dress codes, and social norms. Your mindfulness helps preserve Nepal&rsquo;s rich cultural heritage.</li>\r\n	<li>Ethical Souvenirs: Choose sustainable crafts and avoid purchasing items made from endangered species or ancient artifacts.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Protecting the Environment:</strong></p>\r\n\r\n<ul>\r\n	<li>Wildlife Etiquette: Observe animals from a distance and never disturb or feed them. Say no to exploitative wildlife tourism.</li>\r\n	<li>Preserve Flora: Protect Nepal&rsquo;s diverse ecosystems by leaving plants and natural habitats undisturbed.</li>\r\n	<li>&nbsp;Sustainable Fuel: We use only kerosene and gas for cooking, minimizing our environmental footprint. Please avoid collecting firewood.</li>\r\n	<li>&nbsp;Water Conservation: Use water sparingly, especially in areas where it is scarce, and always ask before using village wells or pumps.</li>\r\n	<li>Waste Management: Dispose of waste responsibly, using designated facilities and bringing any litter to your guide&rsquo;s attention.</li>\r\n	<li>&nbsp;Eco-Friendly Products: Opt for biodegradable detergents and shampoos, and use them sparingly to protect water sources.</li>\r\n	<li>&nbsp;Offset Your Impact: Consider contributing to organizations like Climate Care to offset the environmental impact of your travels. Join Us in Making a Difference Together, we can protect Nepal&rsquo;s awe-inspiring landscapes, uplift its vibrant communities, and create travel experiences that leave a lasting, positive legacy. At Advanced Adventures Nepal, we invite you to travel with purpose&mdash;because the world is worth caring for. Let&rsquo;s explore responsibly, one step at a time.</li>\r\n</ul>\r\n', '2025-05-15 11:23:36', '2025-05-15 16:59:56', 'uploads/trump.jpg'),
(2, 'Health & Porter Policy', 'Health & Porter Policy', '<p>hi</p>\r\n', '2025-05-15 11:27:44', '2025-05-15 12:36:56', 'null'),
(3, 'Education', 'Education', NULL, '2025-05-15 11:27:44', NULL, 'null'),
(4, 'Social Awareness', 'Social Awareness', '<p>Hello</p>\r\n', '2025-05-15 11:29:22', '2025-05-15 12:33:02', 'uploads/2.PNG'),
(5, 'Post-Quake Relief', 'Post-Quake Relief', NULL, '2025-05-15 11:29:22', NULL, NULL),
(6, 'Environment', 'Environment', NULL, '2025-05-15 11:31:47', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `other`
--

CREATE TABLE `other` (
  `id` int(11) NOT NULL,
  `Detailed_Itinerary` longtext DEFAULT NULL,
  `Important_Note` longtext DEFAULT NULL,
  `Useful_Information` longtext DEFAULT NULL,
  `Inc` longtext DEFAULT NULL,
  `Exc` longtext DEFAULT NULL,
  `faq` longtext DEFAULT NULL,
  `Recommended_Package` longtext DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `chart_data` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `P_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `other`
--

INSERT INTO `other` (`id`, `Detailed_Itinerary`, `Important_Note`, `Useful_Information`, `Inc`, `Exc`, `faq`, `Recommended_Package`, `is_active`, `chart_data`, `created_at`, `P_id`) VALUES
(1, 'Day 01: Arrival in Kathmandu| Altitude: 1350m / 4428ft| Meals: Welcome Dinner| Description: Upon arrival in Kathmandu, our representative will greet and transfer you to your hotel. Later, a trip briefing is held at our office, followed by a welcome dinner with cultural program. Overnight in Kathmandu.| Day 02: Fly to Tumlingtar, Drive to Num| Altitude: 1560m / 5118ft| Meals: Breakfast, Lunch, Dinner| Description: Morning flight to Tumlingtar (approx. 35 min), followed by a scenic drive through terraced fields and hills to the village of Num. Overnight in a tea house.| Day 03: Trek to Seduwa| Altitude: 1530m / 5019ft| Meals: Breakfast, Lunch, Dinner| Description: A steep descent to Arun River and a strenuous climb up to Seduwa. Permit check-in at Makalu Barun National Park office. Overnight at a local teahouse.| Day 04: Trek to Tashigaon| Altitude: 2065m / 6774ft| Meals: Breakfast, Lunch, Dinner| Description: Walk through lush forests and small villages. Tashigaon is the last permanent settlement en route to the Base Camp. Overnight stay in Tashigaon.| Day 05: Trek to Khongma Danda| Altitude: 3500m / 11480ft| Meals: Breakfast, Lunch, Dinner| Description: A challenging day with steep ascents through rhododendron forests. Reach Khongma Danda for breathtaking views. Overnight in teahouse.', 'Activities: Climbing, Trekking, Sightseeing |Meals: Full board during trek, Breakfast in Kathmandu |Accommodation: 3-star hotel in Kathmandu, Tea houses & Tents during trek |Group Size: Minimum 2 participants |', 'Best Season: March to May & September to November|Trek Duration: 15–21 days normally (short version: 5–10 days access trek)|Trek Grade: Strenuous|Maximum Altitude: 4870m (Makalu Base Camp)|Permits Required: Makalu Barun National Park Entry, TIMS Card|Communication: Spotty after Num; satellite phones used for emergencies', 'Airport transfers & domestic flights|3 nights hotel in Kathmandu with breakfast|All meals during the trek|Trekking permits and national park fees|English-speaking licensed guide and porter|First aid kit and basic safety gear', 'International airfare|Travel insurance|Personal trekking gear|Tips for guide and porter|Extra nights due to flight delays or weather', 'Q: Is prior trekking experience required? A: Yes, this trek is ideal for those with previous high-altitude trekking experience. Q: How cold does it get? A: Temperatures can drop to -10°C or lower at Base Camp during early mornings and nights. Q: Is it possible to do a solo trek? A: It\\\'s not recommended due to the remoteness. Solo trekkers are advised to hire a guide. Q: Can I charge my devices along the trail? A: Limited charging available till Tashigaon; carry a power bank or solar charger.', 'Nagarkot|Solukhumbu Trek|Aama Yangri Trek', 1, '[{\"outline\":\"Day 01\",\"height\":\"1350\"},{\"outline\":\"Day 02\",\"height\":\"1900\"},{\"outline\":\"Day 03\",\"height\":\"2460\"},{\"outline\":\"Day 04\",\"height\":\"1350\"}]', '2025-05-07 10:04:09', 1),
(2, 'Day 01: Drive from Kathmandu to Kyirong| Altitude: 2700m / 8858ft| Meals: Breakfast, Lunch, Dinner| Description: Early morning drive through scenic countryside to Rasuwagadhi, cross the Nepal-Tibet border, and continue to Kyirong. Overnight at guesthouse.| Day 02: Drive to Tingri| Altitude: 4300m / 14,108ft| Meals: Breakfast, Lunch, Dinner| Description: A scenic drive through high mountain passes with panoramic views of the Himalayas, including Shishapangma and Everest ranges. Overnight in Tingri.| Day 03: Drive to Shigatse via Sakya Monastery| Altitude: 3900m / 12,795ft| Meals: Breakfast, Lunch, Dinner| Description: Visit the ancient Sakya Monastery en route to Shigatse, Tibet\\\'s second-largest city. Explore the local market and culture. Overnight in Shigatse.| Day 04: Drive to Gyantse| Altitude: 3950m / 12,959ft| Meals: Breakfast, Lunch, Dinner| Description: Morning visit to Tashilhunpo Monastery, then drive to Gyantse. Visit Kumbum Stupa and Pelkor Chode Monastery. Overnight stay in Gyantse.|Day 05: Drive to Lhasa via Yamdrok Lake| Altitude: 3650m / 11,975ft| Meals: Breakfast, Lunch, Dinner| Description: A breathtaking journey through high passes like Karo La and Khamba La, and the stunning turquoise Yamdrok Lake. Arrive in Lhasa. Overnight in Lhasa.| Day 06: Lhasa Sightseeing (Potala Palace & Jokhang Temple)| Altitude: 3650m / 11,975ft| Meals: Breakfast| Description: Visit Potala Palace, former residence of the Dalai Lama, and Jokhang Temple, Tibet\\\'s holiest shrine. Explore Barkhor Street for shopping and local food.| Day 07: Lhasa Sightseeing (Drepung & Sera Monastery)| Altitude: 3650m / 11,975ft| Meals: Breakfast| Description: Guided tour to Drepung Monastery and Sera Monastery to witness Buddhist debates and rituals. Rest of the day at leisure. Overnight in Lhasa.| Day 08: Departure from Lhasa| Altitude: 3650m / 11,975ft| Meals: Breakfast| Description: After breakfast, transfer to Lhasa Airport or train station for onward journey. End of Tibet Overland Tour.', 'High Altitude Consideration: Acclimatization is crucial due to elevations over 3,000m|Potala Palace Entry: Requires advance permit and is strictly time-bound|Photography Restrictions: Not allowed in certain monasteries and military zones|Border Regulations: Subject to sudden changes', 'Best Season: April to October|Tour Duration: 8 Days|Maximum Altitude: 5,200m (passes en route)|Tour Grade: Moderate (high-altitude driving)|Travel Mode: Private vehicle from Kathmandu|Permits Required: Tibet Travel Permit, Chinese Visa, Alien Travel Permit|Communication: Internet available in Lhasa and major towns', 'All ground transportation in Tibet and Nepal|Tibet travel permits & visa support|English-speaking Tibetan guide|3-star standard accommodations|Breakfast in Nepal and Tibet; Full board in Bhutan if included|Sightseeing entrance fees|Airport transfers', 'International airfare|Chinese visa processing cost|Travel insurance|Tips for guide and driver|Personal expenses', 'Q: Is it safe to travel to Tibet by road? A: Yes, the overland route is well-maintained and considered safe, though the altitude requires acclimatization. Q: Do I need a special visa for Tibet? A: Yes, a Chinese visa and a Tibet Travel Permit are both required. Your agency will handle the permit. Q: Can I take photos inside monasteries? A: In most places, photography is not allowed inside monasteries. Always ask your guide first. Q: Is vegetarian food available? A: Yes, vegetarian meals are available, especially in Lhasa and larger towns.', 'Makalu Trek|Nagarot|Shivapuri', 1, '[{\"outline\":\"Day 01\",\"height\":\"1350\"},{\"outline\":\"Day 02\",\"height\":\"2700\"},{\"outline\":\"Day 03\",\"height\":\"4000\"},{\"outline\":\"Day 04\",\"height\":\"2900\"},{\"outline\":\"Day 05\",\"height\":\"1350\"}]', '2025-05-07 10:19:53', 2);

-- --------------------------------------------------------

--
-- Table structure for table `popularposts`
--

CREATE TABLE `popularposts` (
  `id` int(11) NOT NULL,
  `PostTitle` longtext DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `PostDetails` longtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL,
  `PostUrl` mediumtext DEFAULT NULL,
  `PostImage` varchar(255) DEFAULT NULL,
  `postedBy` varchar(255) DEFAULT NULL,
  `lastUpdatedBy` varchar(255) DEFAULT NULL,
  `Price` decimal(10,0) DEFAULT NULL,
  `Days` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL,
  `AdminUserName` varchar(255) DEFAULT NULL,
  `AdminPassword` varchar(255) DEFAULT NULL,
  `AdminEmailId` varchar(255) DEFAULT NULL,
  `userType` int(11) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `AdminUserName`, `AdminPassword`, `AdminEmailId`, `userType`, `CreationDate`, `UpdationDate`) VALUES
(1, 'admin', 'f925916e2754e5e03f75dd58a5733251', 'phpgurukulofficial@gmail.com', 1, '2024-01-09 18:30:00', '2024-01-31 05:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL,
  `DestId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Description`, `PostingDate`, `UpdationDate`, `Is_Active`, `DestId`) VALUES
(1, 'Trekking in nepal in mountains', 'trekking', '2025-05-07 09:55:29', NULL, 1, 1),
(2, 'Tibet Tour', 'Tours in Tibet', '2025-05-07 10:11:37', NULL, 1, 2),
(3, 'Visit Pakistan', '<p>This is an educational tour.</p>\r\n', '2025-05-14 09:34:49', '2025-05-15 09:52:24', 1, 3),
(4, 'Tours in Nepal', 'Tours in NepalTours in NepalTours in Nepal', '2025-05-23 03:05:59', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcomments`
--

CREATE TABLE `tblcomments` (
  `id` int(11) NOT NULL,
  `postId` int(11) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `comment` mediumtext DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbldest`
--

CREATE TABLE `tbldest` (
  `Id` int(11) NOT NULL,
  `DestName` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbldest`
--

INSERT INTO `tbldest` (`Id`, `DestName`, `Description`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(1, 'Nepal', '<p>Tours inside Nepal</p>\r\n', '2025-05-07 09:55:12', '2025-05-14 09:59:29', 1),
(2, 'Tibet', '<p><em>Tibet</em> tour</p>\r\n', '2025-05-07 10:11:11', '2025-05-14 10:09:28', 1),
(3, 'Pakistan', '<p>Pakistan is country of <strong>fools</strong>. If you Want to go then you can go.</p>\r\n', '2025-05-14 09:33:41', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `Description` longtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageName`, `PageTitle`, `Description`, `PostingDate`, `UpdationDate`) VALUES
(1, 'aboutus', 'About News Portal', '<font color=\"#7b8898\" face=\"Mercury SSm A, Mercury SSm B, Georgia, Times, Times New Roman, Microsoft YaHei New, Microsoft Yahei, å¾®è½¯é›…é»‘, å®‹ä½“, SimSun, STXihei, åŽæ–‡ç»†é»‘, serif\"><span style=\"font-size: 26px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></font><br>', '2024-01-14 18:30:00', '2024-01-31 05:44:12'),
(2, 'contactus', 'Contact Details', '<p><br></p><p><b>Address :&nbsp; </b>New Delhi India</p><p><b>Phone Number : </b>9849708921</p><p><b>Email -id : </b>rajumainali1111@gmail.com</p>', '2024-01-15 18:30:00', '2025-04-28 02:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `tblpostdetails`
--

CREATE TABLE `tblpostdetails` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `cost_per_person` decimal(10,2) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpostdetails`
--

INSERT INTO `tblpostdetails` (`id`, `post_id`, `start_date`, `end_date`, `cost_per_person`, `is_active`) VALUES
(10, 1, '2025-05-17', '2025-05-31', 8700.00, 1),
(11, 2, '2025-05-24', '2025-05-30', 8500.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblposts`
--

CREATE TABLE `tblposts` (
  `id` int(11) NOT NULL,
  `PostTitle` longtext DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `PostDetails` longtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL,
  `PostUrl` mediumtext DEFAULT NULL,
  `PostImage` varchar(255) DEFAULT NULL,
  `postedBy` varchar(255) DEFAULT NULL,
  `lastUpdatedBy` varchar(255) DEFAULT NULL,
  `Price` decimal(10,0) DEFAULT NULL,
  `Days` int(11) DEFAULT NULL,
  `DestID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblposts`
--

INSERT INTO `tblposts` (`id`, `PostTitle`, `CategoryId`, `PostDetails`, `PostingDate`, `UpdationDate`, `Is_Active`, `PostUrl`, `PostImage`, `postedBy`, `lastUpdatedBy`, `Price`, `Days`, `DestID`) VALUES
(1, 'Makalu Base Camp Trek', 1, 'Makalu Base Camp Trek is a journey to the foot of the world’s fifth highest mountain, offering unspoiled Himalayan wilderness, high-altitude terrains, and rare glimpses of wildlife and cultural diversity. This off-the-beaten-path trek is ideal for experienced trekkers looking for solitude and challenge.', '2025-05-07 09:58:06', NULL, 1, 'Makalu-Base-Camp-Trek', 'de48d1e11ec27a47b84ebea35854024a.jpg', 'admin', NULL, 1000, 5, 1),
(2, 'Tibet Overland Tour', 2, 'This Overland journey to Tibet offers an insight into the historical \r\nand cultural wonders of this ancient land. Mingle with fellow \r\nadventurers from around the globe, all eager to discover the magic of \r\nTibet. Whether you\'re a solo traveler, a couple, or part of a larger \r\ngroup, this experience welcomes all.\r\n\r\nOur adventure begins in Kathmandu, Nepal, where you\'ll embark on a \r\njourney through the towering peaks of the Himalayas and the \r\nawe-inspiring vastness of the Tibetan Plateau. Cross the border at \r\nKerung, the gateway between Nepal and Tibet. As you travel, marvel at \r\nthe majestic mountainscapes and immerse yourself in the rich Buddhist \r\nculture. Visit the mystical Tashilhunpo Monastery in Shigatse, the \r\nKumbum Stupa in Gyantse, and soak in the turquoise serenity of Yamdrok \r\nTso Lake.', '2025-05-07 10:13:19', '2025-05-23 10:49:18', 1, 'Tibet-Overland-Tour', 'adfd1b7b8c14ec250ad4af09825be8e1.jpg', 'admin', NULL, 5000, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `userId` int(11) NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `emailId` varchar(255) DEFAULT NULL,
  `conatctNo` bigint(11) DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `regDate` int(11) DEFAULT NULL,
  `isActive` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `topposts`
--

CREATE TABLE `topposts` (
  `id` int(11) NOT NULL,
  `PostTitle` longtext DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `PostDetails` longtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL,
  `PostUrl` mediumtext DEFAULT NULL,
  `PostImage` varchar(255) DEFAULT NULL,
  `postedBy` varchar(255) DEFAULT NULL,
  `lastUpdatedBy` varchar(255) DEFAULT NULL,
  `Price` decimal(10,0) DEFAULT NULL,
  `Days` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `topposts`
--

INSERT INTO `topposts` (`id`, `PostTitle`, `CategoryId`, `PostDetails`, `PostingDate`, `UpdationDate`, `Is_Active`, `PostUrl`, `PostImage`, `postedBy`, `lastUpdatedBy`, `Price`, `Days`, `type`) VALUES
(1, 'Makalu Base Camp Trek', 1, 'Makalu Base Camp Trek is a journey to the foot of the world’s fifth highest mountain, offering unspoiled Himalayan wilderness, high-altitude terrains, and rare glimpses of wildlife and cultural diversity. This off-the-beaten-path trek is ideal for experienced trekkers looking for solitude and challenge.', '2025-05-07 09:58:06', NULL, 1, 'Makalu-Base-Camp-Trek', 'de48d1e11ec27a47b84ebea35854024a.jpg', 'admin', NULL, 1000, 5, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other`
--
ALTER TABLE `other`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_other_posts` (`P_id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `AdminUserName` (`AdminUserName`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_dest` (`DestId`);

--
-- Indexes for table `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `postId` (`postId`);

--
-- Indexes for table `tbldest`
--
ALTER TABLE `tbldest`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpostdetails`
--
ALTER TABLE `tblpostdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `tblposts`
--
ALTER TABLE `tblposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `postcatid` (`CategoryId`),
  ADD KEY `subadmin` (`postedBy`),
  ADD KEY `fk_destination` (`DestID`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `other`
--
ALTER TABLE `other`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblcomments`
--
ALTER TABLE `tblcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbldest`
--
ALTER TABLE `tbldest`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblpostdetails`
--
ALTER TABLE `tblpostdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblposts`
--
ALTER TABLE `tblposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `other`
--
ALTER TABLE `other`
  ADD CONSTRAINT `fk_other_posts` FOREIGN KEY (`P_id`) REFERENCES `tblposts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_post` FOREIGN KEY (`P_id`) REFERENCES `tblposts` (`id`);

--
-- Constraints for table `tblpostdetails`
--
ALTER TABLE `tblpostdetails`
  ADD CONSTRAINT `tblpostdetails_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `tblposts` (`id`);

--
-- Constraints for table `tblposts`
--
ALTER TABLE `tblposts`
  ADD CONSTRAINT `fk_destination` FOREIGN KEY (`DestID`) REFERENCES `tbldest` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
