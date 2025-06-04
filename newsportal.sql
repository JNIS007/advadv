-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2025 at 10:33 AM
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
  `Title` varchar(200) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Img_url` varchar(150) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `Title`, `Description`, `Img_url`, `status`) VALUES
(3, 'Health & Porter Policy', '<h2>Our Inclination toward Guide and Porter</h2> <p>We have recruited porters and guides from local communities as part of our commitment to social and economic development. We provide comprehensive training to our staff and trekkers, taking full responsibility for their well-being.</p> <h3>Training Programs Include:</h3> <ul> <li>Intensive Wilderness First Aid</li> <li>Trekking Guide Training</li> <li>Co-Trekking Workshop &amp; Adventure Meet</li> <li>English and Other Major Languages</li> <li>Conservation &amp; Biodiversity</li> <li>Rock &amp; Ice Climbing &amp; Mountaineering (for expedition leaders)</li> </ul> <p>We always respect our porters and their hard work. We believe in equality and mutual respect. Our guides and porters are essential to creating memorable trip experiences.</p>', 'postimages/CMS/683bee535737e_packinglist.png', 1),
(4, 'Education', '<h2>Our Educational Mission</h2> <p>We are always pushing toward the progress, prosperity and success of our clients. We don&#39;t want only business rather a need the progress of society and our clients. Advanced Adventures is seeking the way to provide better education in the community.</p> <h3>Our Key Focus Areas:</h3> <ul> <li>Supporting underprivileged children&#39;s education</li> <li>Providing scholarships and educational resources</li> <li>Promoting literacy in rural communities</li> <li>Offering educational infrastructure support</li> <li>Empowering communities through knowledge</li> </ul>', 'postimages/CMS/683bee8e9ca5d_termsandconditions.png', 1);

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
  `P_id` int(11) DEFAULT NULL,
  `PageTitle` varchar(200) DEFAULT NULL,
  `Keywords` text DEFAULT NULL,
  `MetaAuthor` text DEFAULT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `other`
--

INSERT INTO `other` (`id`, `Detailed_Itinerary`, `Important_Note`, `Useful_Information`, `Inc`, `Exc`, `faq`, `Recommended_Package`, `is_active`, `chart_data`, `created_at`, `P_id`, `PageTitle`, `Keywords`, `MetaAuthor`, `Description`) VALUES
(1, 'Day 01: Arrival in Kathmandu| Altitude: 1350m / 4428ft| Meals: Welcome Dinner| Description: Upon arrival in Kathmandu, our representative will greet and transfer you to your hotel. Later, a trip briefing is held at our office, followed by a welcome dinner with cultural program. Overnight in Kathmandu.| Day 02: Fly to Tumlingtar, Drive to Num| Altitude: 1560m / 5118ft| Meals: Breakfast, Lunch, Dinner| Description: Morning flight to Tumlingtar (approx. 35 min), followed by a scenic drive through terraced fields and hills to the village of Num. Overnight in a tea house.| Day 03: Trek to Seduwa| Altitude: 1530m / 5019ft| Meals: Breakfast, Lunch, Dinner| Description: A steep descent to Arun River and a strenuous climb up to Seduwa. Permit check-in at Makalu Barun National Park office. Overnight at a local teahouse.| Day 04: Trek to Tashigaon| Altitude: 2065m / 6774ft| Meals: Breakfast, Lunch, Dinner| Description: Walk through lush forests and small villages. Tashigaon is the last permanent settlement en route to the Base Camp. Overnight stay in Tashigaon.| Day 05: Trek to Khongma Danda| Altitude: 3500m / 11480ft| Meals: Breakfast, Lunch, Dinner| Description: A challenging day with steep ascents through rhododendron forests. Reach Khongma Danda for breathtaking views. Overnight in teahouse.', 'Activities: Climbing, Trekking, Sightseeing |Meals: Full board during trek, Breakfast in Kathmandu |Accommodation: 3-star hotel in Kathmandu, Tea houses & Tents during trek |Group Size: Minimum 2 participants |', 'Best Season: March to May & September to November|Trek Duration: 15–21 days normally (short version: 5–10 days access trek)|Trek Grade: Strenuous|Maximum Altitude: 4870m (Makalu Base Camp)|Permits Required: Makalu Barun National Park Entry, TIMS Card|Communication: Spotty after Num; satellite phones used for emergencies', 'Airport transfers & domestic flights|3 nights hotel in Kathmandu with breakfast|All meals during the trek|Trekking permits and national park fees|English-speaking licensed guide and porter|First aid kit and basic safety gear', 'International airfare|Travel insurance|Personal trekking gear|Tips for guide and porter|Extra nights due to flight delays or weather', 'Q: Is prior trekking experience required? A: Yes, this trek is ideal for those with previous high-altitude trekking experience. Q: How cold does it get? A: Temperatures can drop to -10°C or lower at Base Camp during early mornings and nights. Q: Is it possible to do a solo trek? A: It\\\'s not recommended due to the remoteness. Solo trekkers are advised to hire a guide. Q: Can I charge my devices along the trail? A: Limited charging available till Tashigaon; carry a power bank or solar charger.', 'Nagarkot|Solukhumbu Trek|Aama Yangri Trek', 1, '[{\"outline\":\"Day 01\",\"height\":\"1350\"},{\"outline\":\"Day 02\",\"height\":\"1900\"},{\"outline\":\"Day 03\",\"height\":\"2460\"},{\"outline\":\"Day 04\",\"height\":\"1350\"}]', '2025-06-02 15:54:44', 1, NULL, NULL, NULL, NULL),
(2, '<p>Day 01: Drive from Kathmandu to Kyirong| Altitude: 2700m / 8858ft| Meals: Breakfast, Lunch, Dinner| Description: Early morning drive through scenic countryside to Rasuwagadhi, cross the Nepal-Tibet border, and continue to Kyirong. Overnight at guesthouse.| Day 02: Drive to Tingri| Altitude: 4300m / 14,108ft| Meals: Breakfast, Lunch, Dinner| Description: A scenic drive through high mountain passes with panoramic views of the Himalayas, including Shishapangma and Everest ranges. Overnight in Tingri.| Day 03: Drive to Shigatse via Sakya Monastery| Altitude: 3900m / 12,795ft| Meals: Breakfast, Lunch, Dinner| Description: Visit the ancient Sakya Monastery en route to Shigatse, Tibet\\\\&#39;s second-largest city. Explore the local market and culture. Overnight in Shigatse.| Day 04: Drive to Gyantse| Altitude: 3950m / 12,959ft| Meals: Breakfast, Lunch, Dinner| Description: Morning visit to Tashilhunpo Monastery, then drive to Gyantse. Visit Kumbum Stupa and Pelkor Chode Monastery. Overnight stay in Gyantse.|Day 05: Drive to Lhasa via Yamdrok Lake| Altitude: 3650m / 11,975ft| Meals: Breakfast, Lunch, Dinner| Description: A breathtaking journey through high passes like Karo La and Khamba La, and the stunning turquoise Yamdrok Lake. Arrive in Lhasa. Overnight in Lhasa.| Day 06: Lhasa Sightseeing (Potala Palace &amp; Jokhang Temple)| Altitude: 3650m / 11,975ft| Meals: Breakfast| Description: Visit Potala Palace, former residence of the Dalai Lama, and Jokhang Temple, Tibet\\\\&#39;s holiest shrine. Explore Barkhor Street for shopping and local food.| Day 07: Lhasa Sightseeing (Drepung &amp; Sera Monastery)| Altitude: 3650m / 11,975ft| Meals: Breakfast| Description: Guided tour to Drepung Monastery and Sera Monastery to witness Buddhist debates and rituals. Rest of the day at leisure. Overnight in Lhasa.| Day 08: Departure from Lhasa| Altitude: 3650m / 11,975ft| Meals: Breakfast| Description: After breakfast, transfer to Lhasa Airport or train station for onward journey. End of Tibet Overland Tour.</p>', '<p>High Altitude Consideration: Acclimatization is crucial due to elevations over 3,000m|Potala Palace Entry: Requires advance permit and is strictly time-bound|Photography Restrictions: Not allowed in certain monasteries and military zones|Border Regulations: Subject to sudden changes</p>', '<p>Best Season: April to October|Tour Duration: 8 Days|Maximum Altitude: 5,200m (passes en route)|Tour Grade: Moderate (high-altitude driving)|Travel Mode: Private vehicle from Kathmandu|Permits Required: Tibet Travel Permit, Chinese Visa, Alien Travel Permit|Communication: Internet available in Lhasa and major towns</p>', '<p>All ground transportation in Tibet and Nepal|Tibet travel permits &amp; visa support|English-speaking Tibetan guide|3-star standard accommodations|Breakfast in Nepal and Tibet; Full board in Bhutan if included|Sightseeing entrance fees|Airport transfers</p>', '<p>International airfare|Chinese visa processing cost|Travel insurance|Tips for guide and driver|Personal expenses</p>', '<p>Q: Is it safe to travel to Tibet by road? A: Yes, the overland route is well-maintained and considered safe, though the altitude requires acclimatization. Q: Do I need a special visa for Tibet? A: Yes, a Chinese visa and a Tibet Travel Permit are both required. Your agency will handle the permit. Q: Can I take photos inside monasteries? A: In most places, photography is not allowed inside monasteries. Always ask your guide first. Q: Is vegetarian food available? A: Yes, vegetarian meals are available, especially in Lhasa and larger towns.</p>', '<p>Makalu Trek|Nagarot|Shivapuri</p>', 1, '[{\"outline\":\"Day 01\",\"height\":\"1350\"},{\"outline\":\"Day 02\",\"height\":\"2700\"},{\"outline\":\"Day 03\",\"height\":\"4000\"},{\"outline\":\"Day 04\",\"height\":\"2900\"},{\"outline\":\"Day 05\",\"height\":\"1350\"}]', '2025-06-02 15:54:44', 2, 'lk', 'k', ';', 'jjnjk'),
(7, '<p><strong>Day 01: Arrival in Kathmandu</strong><strong>|</strong><br /> <strong>Altitude:</strong> 1350m / 4428ft|<br /> <strong>Meals:</strong> Welcome Dinner|<br /> <strong>Description:</strong> Upon arrival in Kathmandu, our representative will greet and transfer you to your hotel. Later, a trip briefing is held at our office, followed by a welcome dinner with cultural program. Overnight in Kathmandu.|</p> <p><strong>Day 02: Fly to Tumlingtar, Drive to Num</strong><strong>|</strong><br /> <strong>Altitude:</strong> 1560m / 5118ft|<br /> <strong>Meals:</strong> Breakfast, Lunch, Dinner|<br /> <strong>Description:</strong> Morning flight to Tumlingtar (approx. 35 min), followed by a scenic drive through terraced fields and hills to the village of Num. Overnight in a tea house.|</p> <p><strong>Day 03: Trek to Seduwa</strong><strong>|</strong><br /> <strong>Altitude:</strong> 1530m / 5019ft|<br /> <strong>Meals:</strong> Breakfast, Lunch, Dinner|<br /> <strong>Description:</strong> A steep descent to Arun River and a strenuous climb up to Seduwa. Permit check-in at Makalu Barun National Park office. Overnight at a local teahouse.</p> <p><strong>Day 04: Trek to Tashigaon</strong><strong>|</strong><br /> <strong>Meals:</strong> Breakfast, Lunch, Dinner|<br /> <strong>Description:</strong> Walk through lush forests and small villages. Tashigaon is the last permanent settlement en route to the Base Camp. Overnight stay in Tashigaon.</p> <p><strong>Day 05: Trek to Khongma Danda</strong><strong>|</strong><br /> <strong>Meals:</strong> Breakfast, Lunch, Dinner|<br /> <strong>Description:</strong> A challenging day with steep ascents through rhododendron forests. Reach| Khongma Danda for breathtaking views. Overnight in teahouse.</p>', '<p><strong>High Altitude Consideration: </strong>Acclimatization is crucial due to elevations over 3,000m.|</p> <p> </p> <p><strong>Potala Palace Entry:</strong> Requires advance permit and is strictly time-bound.|</p> <p> </p> <p><strong>Photography Restrictions:</strong> Not allowed in certain monasteries and military zones.|</p> <p> </p> <p><strong>Border Regulations: </strong>Subject to sudden changes; carry multiple copies of permits and ID.|</p> <p> </p> <p><strong>Travel Insurance:</strong> Strongly recommended to cover emergency evacuation and illness.|</p> <p> </p> <p><strong>Chinese Visa Requirement:</strong> Must obtain before entering Tibet; Tibet Permit is separate.|</p> <p> </p> <p><strong>Cultural Sensitivity:</strong> Respect local customs, especially in religious sites.</p>', '<p><strong>Best Season:</strong> March to May & September to November|</p> <p> </p> <p><strong>Trek Duration:</strong> 15–21 days normally (short version: 5–10 days access trek)|</p> <p> </p> <p><strong>Trek Grade:</strong> Strenuous|</p> <p> </p> <p><strong>Maximum Altitude:</strong> 4870m (Makalu Base Camp)|</p> <p> </p> <p><strong>Permits Required:</strong> Makalu Barun National Park Entry, TIMS Card|</p> <p> </p> <p><strong>Communication:</strong> Spotty after Num; satellite phones used for emergencies</p>', '<p>Airport transfers & domestic flights|</p> <p>3 nights hotel in Kathmandu with breakfast|</p> <p>All meals during the trek|</p> <p>Trekking permits and national park fees|</p> <p>English-speaking licensed guide and porter|</p> <p>First aid kit and basic safety gear</p>', '<p>International airfare|</p> <p>Travel insurance|</p> <p>Personal trekking gear|</p> <p>Tips for guide and porter</p>', '<p><strong>Q: Is prior trekking experience required?</strong><strong> </strong><br /> A: Yes, this trek is ideal for those with previous high-altitude trekking experience.</p> <p><strong>Q: How cold does it get?</strong><strong> </strong><br /> A: Temperatures can drop to -10°C or lower at Base Camp during early mornings and nights.</p> <p><strong>Q: Is it possible to do a solo trek?</strong><strong> </strong><br /> A: It\\\'s not recommended due to the remoteness. Solo trekkers are advised to hire a guide.</p> <p><strong>Q: Can I charge my devices along the trail?</strong><strong> </strong><br /> A: Limited charging available till Tashigaon; carry a power bank or solar charger.</p>', '<p>Rara | Makalu </p>', 1, '[{\"outline\":\"Day 01\",\"height\":\"1230\"}]', '2025-06-02 15:54:44', 8, 'Chorr', 'Gada', 'Bhate', 'Choorrrr'),
(8, '<p><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Altitude:</span></span></strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"> 1350m / 4428ft</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span><br> <span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"><strong>Meals:</strong> Welcome Dinner</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span><br> <span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"><strong>Description:</strong> Upon arrival in Kathmandu, our representative will greet and transfer you to your hotel. Later, a trip briefing is held at our office, followed by a welcome dinner with cultural program. Overnight in Kathmandu.</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></span></span></p> <p><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Day 02: Fly to Tumlingtar, Drive to Num</span></span></strong><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></strong><br> <span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"><strong>Altitude:</strong> 1560m / 5118ft</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span><br> <span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"><strong>Meals:</strong> Breakfast, Lunch, Dinner</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span><br> <span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"><strong>Description:</strong> Morning flight to Tumlingtar (approx. 35 min), followed by a scenic drive through terraced fields and hills to the village of Num. Overnight in a tea house.</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></span></span></p> <p><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Day 03: Trek to Seduwa</span></span></strong><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></strong><br> <span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"><strong>Altitude:</strong> 1530m / 5019ft</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span><br> <span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"><strong>Meals:</strong> Breakfast, Lunch, Dinner</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span><br> <span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"><strong>Description:</strong> A steep descent to Arun River and a strenuous climb up to Seduwa. Permit check-in at Makalu Barun National Park office. Overnight at a local teahouse.</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></span></span></p> <p><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Day 04: Trek to Tashigaon</span></span></strong><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></strong><br> <span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"><strong>Altitude:</strong> 2065m / 6774ft</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span><br> <span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"><strong>Meals:</strong> Breakfast, Lunch, Dinner</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span><br> <span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"><strong>Description:</strong> Walk through lush forests and small villages. Tashigaon is the last permanent settlement en route to the Base Camp. Overnight stay in Tashigaon.</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></span></span></p> <p><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Day 05: Trek to Khongma Danda</span></span></strong><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></strong><br> <span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"><strong>Altitude:</strong> 3500m / 11480ft</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span><br> <span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"><strong>Meals:</strong> Breakfast, Lunch, Dinner</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span><br> <span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"><strong>Description:</strong> A challenging day with steep ascents through rhododendron forests. Reach</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"> Khongma Danda for breathtaking views. Overnight in teahouse.</span></span></span></span></p>', '<p><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">High Altitude Consideration:</span></span></strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"> Acclimatization is crucial due to elevations over 3,000m.|</span></span></span></span></p> <p><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Potala Palace Entry</span></span></strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">: Requires advance permit and is strictly time-bound. |</span></span></span></span></p> <p><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Photography Restrictions</span></span></strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">: Not allowed in certain monasteries and military zones. |</span></span></span></span></p> <p><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Border Regulations</span></span></strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">: Subject to sudden changes; carry multiple copies of permits and ID.|</span></span></span></span></p> <p><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Travel Insurance</span></span></strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">: Strongly recommended to cover emergency evacuation and illness. |</span></span></span></span></p> <p><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Chinese Visa Requirement</span></span></strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">: Must obtain before entering Tibet; Tibet Permit is separate. |</span></span></span></span></p> <p><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Cultural Sensitivity</span></span></strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">: Respect local customs, especially in religious sites.</span></span></span></span></p>', '<p style=\\\"margin-left:24px\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Best Season:</span></span></strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"> March to May &amp; September to November</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></span></span></p> <p style=\\\"margin-left:24px\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Trek Duration:</span></span></strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"> 15&ndash;21 days normally (short version: 5&ndash;10 days access trek)</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></span></span></p> <p style=\\\"margin-left:24px\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Trek Grade:</span></span></strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"> Strenuous</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></span></span></p> <p style=\\\"margin-left:24px\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Maximum Altitude:</span></span></strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"> 4870m (Makalu Base Camp)</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></span></span></p> <p style=\\\"margin-left:24px\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Permits Required:</span></span></strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"> Makalu Barun National Park Entry, TIMS Card</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></span></span></p> <p style=\\\"margin-left:24px\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Communication:</span></span></strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\"> Spotty after Num; satellite phones used for emergencies</span></span></span></span></p>', '<p style=\\\"margin-left:24px\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Airport transfers &amp; domestic flights</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></span></span></p> <p style=\\\"margin-left:24px\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">3 nights hotel in Kathmandu with breakfast</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></span></span></p> <p style=\\\"margin-left:24px\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">All meals during the trek</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></span></span></p> <p style=\\\"margin-left:24px\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Trekking permits and national park fees</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></span></span></p> <p style=\\\"margin-left:24px\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">English-speaking licensed guide and porter</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></span></span></p> <p style=\\\"margin-left:24px\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">First aid kit and basic safety gear</span></span></span></span></p>', '<p style=\\\"margin-left:24px\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">International airfare</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></span></span></p> <p style=\\\"margin-left:24px\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Travel insurance</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></span></span></p> <p style=\\\"margin-left:24px\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Personal trekking gear</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></span></span></p> <p style=\\\"margin-left:24px\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Tips for guide and porter</span></span><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">|</span></span></span></span></p> <p style=\\\"margin-left:24px\\\"><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Extra nights due to flight delays or weather</span></span></span></span></p>', '<p><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Q: Is prior trekking experience required?</span></span></strong><strong> </strong><br> <span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">A: Yes, this trek is ideal for those with previous high-altitude trekking experience.</span></span> </span></span></p> <p><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Q: How cold does it get?</span></span></strong><strong> </strong><br> <span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">A: Temperatures can drop to -10&deg;C or lower at Base Camp during early mornings and nights.</span></span> </span></span></p> <p><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Q: Is it possible to do a solo trek?</span></span></strong><strong> </strong><br> <span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">A: It&#39;s not recommended due to the remoteness. Solo trekkers are advised to hire a guide.</span></span> </span></span></p> <p><span style=\\\"font-size:11pt\\\"><span style=\\\"font-family:Calibri,sans-serif\\\"><strong><span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">Q: Can I charge my devices along the trail?</span></span></strong><strong> </strong><br> <span style=\\\"font-size:12.0pt\\\"><span style=\\\"font-family:&quot;Times New Roman&quot;,serif\\\">A: Limited charging available till Tashigaon; carry a power bank or solar charger.</span></span></span></span></p>', '<p>Rara | Tara | Bara</p>', 1, '[{\"outline\":\"Day 01\",\"height\":\"1230\"}]', '2025-06-02 15:54:44', 9, 'About Adventure', 'Ram', 'HRI', 'KRISH');

-- --------------------------------------------------------

--
-- Table structure for table `popularposts`
--

CREATE TABLE `popularposts` (
  `id` int(11) NOT NULL,
  `PostTitle` longtext DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `PostDetails` longtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT 1,
  `PostUrl` mediumtext DEFAULT NULL,
  `PostImage` varchar(255) DEFAULT NULL,
  `postedBy` varchar(255) DEFAULT NULL,
  `lastUpdatedBy` varchar(255) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Days` int(11) DEFAULT NULL,
  `DestID` int(11) DEFAULT NULL,
  `selected` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `popularposts`
--

INSERT INTO `popularposts` (`id`, `PostTitle`, `CategoryId`, `PostDetails`, `PostingDate`, `UpdationDate`, `Is_Active`, `PostUrl`, `PostImage`, `postedBy`, `lastUpdatedBy`, `Price`, `Days`, `DestID`, `selected`) VALUES
(8, 'Test', 4, 'This is a test.\r\n', '2025-05-26 08:58:08', NULL, 1, 'Test', 'ac8cf16df444dea0417d3da8bbde5d3c.PNG', 'admin', NULL, 200.00, 12, 1, 0),
(9, 'Another Test', 4, 'This is Test Post\r\n', '2025-05-28 09:46:14', NULL, 1, 'Another-Test', '4a47a0db6e60853dedfcfdf08a5ca249.png', 'admin', NULL, 123.00, 44, 1, 0);

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
(1, 'Trekking in Nepal in Mountains', '<p><em>Trekking</em></p>\r\n', '2025-05-07 09:55:29', '2025-06-04 07:54:48', 1, 1),
(2, 'Tibet Tour', '<p>Tours in<strong> Tibet</strong></p>\r\n', '2025-05-07 10:11:37', '2025-06-04 07:55:39', 1, 2),
(3, 'Visit Pakistan', '<p>This is an educational tour.</p>\r\n', '2025-05-14 09:34:49', '2025-05-15 09:52:24', 1, 3),
(4, 'Tours in Nepal', 'Tours in NepalTours in NepalTours in Nepal', '2025-05-23 03:05:59', '2025-05-26 07:37:53', 1, 1);

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
  `DestID` int(11) DEFAULT NULL,
  `selected` int(11) DEFAULT 0,
  `sort_order` int(11) DEFAULT 0,
  `SubCategoryId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblposts`
--

INSERT INTO `tblposts` (`id`, `PostTitle`, `CategoryId`, `PostDetails`, `PostingDate`, `UpdationDate`, `Is_Active`, `PostUrl`, `PostImage`, `postedBy`, `lastUpdatedBy`, `Price`, `Days`, `DestID`, `selected`, `sort_order`, `SubCategoryId`) VALUES
(1, 'Makalu Base Camp Trek', 1, 'Makalu Base Camp Trek is a journey to the foot of the world’s fifth highest mountain, offering unspoiled Himalayan wilderness, high-altitude terrains, and rare glimpses of wildlife and cultural diversity. This off-the-beaten-path trek is ideal for experienced trekkers looking for solitude and challenge.', '2025-05-07 09:58:06', '2025-06-03 13:14:12', 1, 'Makalu-Base-Camp-Trek', 'de48d1e11ec27a47b84ebea35854024a.jpg', 'admin', NULL, 1000, 5, 1, 1, 2, 1),
(2, 'Tibet Overland Tour', 2, 'This Overland journey to Tibet offers an insight into the historical and cultural wonders of this ancient land. Mingle with fellow adventurers from around the globe, all eager to discover the magic of Tibet. Whether you&#39;re a solo traveler, a couple, or part of a larger group, this experience welcomes all. Our adventure begins in Kathmandu, Nepal, where you&#39;ll embark on a journey through the towering peaks of the Himalayas and the awe-inspiring vastness of the Tibetan Plateau. Cross the border at Kerung, the gateway between Nepal and Tibet. As you travel, marvel at the majestic mountainscapes and immerse yourself in the rich Buddhist culture. Visit the mystical Tashilhunpo Monastery in Shigatse, the Kumbum Stupa in Gyantse, and soak in the turquoise serenity of Yamdrok Tso Lake.\r\n', '2025-05-07 10:13:19', '2025-06-02 16:38:16', 1, 'Tibet-Overland-Tour', 'adfd1b7b8c14ec250ad4af09825be8e1.jpg', 'admin', 'admin', 5000, 8, 2, 1, 1, NULL),
(8, 'Test', 4, 'This is a test.\r\n', '2025-05-26 08:58:08', '2025-06-03 13:14:55', 1, 'Test', 'ac8cf16df444dea0417d3da8bbde5d3c.PNG', 'admin', NULL, 200, 12, 1, 0, 4, 3),
(9, 'Another Test', 4, 'This is Test Post\r\n', '2025-05-28 09:46:14', '2025-06-03 13:16:24', 1, 'Another-Test', '4a47a0db6e60853dedfcfdf08a5ca249.png', 'admin', NULL, 123, 44, 1, 0, 3, 4),
(10, 'Test1', 4, 'Tested\r\n', '2025-06-04 07:03:16', '2025-06-04 08:29:00', 1, 'Test1', 'f4cab5d793d627287b274cd8976ef051.PNG', 'admin', 'admin', 1230, 12, 1, 0, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubcategory`
--

CREATE TABLE `tblsubcategory` (
  `id` int(11) NOT NULL,
  `CategoryId` int(11) NOT NULL,
  `Subcategory` varchar(255) NOT NULL,
  `SubCatDescription` text DEFAULT NULL,
  `Is_Active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsubcategory`
--

INSERT INTO `tblsubcategory` (`id`, `CategoryId`, `Subcategory`, `SubCatDescription`, `Is_Active`) VALUES
(1, 1, 'Visit Mountains', '<p>This is mountain tour.</p>\r\n', 1),
(3, 4, 'Ram Ram Ram Ram', '<p>Ram gaya Bani ma oooooo haer Ram</p>\r\n', 1),
(4, 4, 'Ram', '<p>kk</p>\r\n', 1);

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
  `PostDetails` longtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT 1,
  `PostUrl` mediumtext DEFAULT NULL,
  `PostImage` varchar(255) DEFAULT NULL,
  `postedBy` varchar(255) DEFAULT NULL,
  `lastUpdatedBy` varchar(255) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Days` int(11) DEFAULT NULL,
  `DestID` int(11) DEFAULT NULL,
  `selected` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `topposts`
--

INSERT INTO `topposts` (`id`, `PostTitle`, `CategoryId`, `PostDetails`, `PostingDate`, `UpdationDate`, `Is_Active`, `PostUrl`, `PostImage`, `postedBy`, `lastUpdatedBy`, `Price`, `Days`, `DestID`, `selected`) VALUES
(2, 'Tibet Overland Tour', 2, 'This Overland journey to Tibet offers an insight into the historical \r\nand cultural wonders of this ancient land. Mingle with fellow \r\nadventurers from around the globe, all eager to discover the magic of \r\nTibet. Whether you\'re a solo traveler, a couple, or part of a larger \r\ngroup, this experience welcomes all.\r\n\r\nOur adventure begins in Kathmandu, Nepal, where you\'ll embark on a \r\njourney through the towering peaks of the Himalayas and the \r\nawe-inspiring vastness of the Tibetan Plateau. Cross the border at \r\nKerung, the gateway between Nepal and Tibet. As you travel, marvel at \r\nthe majestic mountainscapes and immerse yourself in the rich Buddhist \r\nculture. Visit the mystical Tashilhunpo Monastery in Shigatse, the \r\nKumbum Stupa in Gyantse, and soak in the turquoise serenity of Yamdrok \r\nTso Lake.', '2025-05-07 10:13:19', '2025-06-01 07:05:34', 1, 'Tibet-Overland-Tour', 'adfd1b7b8c14ec250ad4af09825be8e1.jpg', 'admin', NULL, 5000.00, 8, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `travel_guide`
--

CREATE TABLE `travel_guide` (
  `id` int(11) NOT NULL,
  `Title` varchar(500) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Img_url` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `travel_guide`
--

INSERT INTO `travel_guide` (`id`, `Title`, `Description`, `Img_url`, `status`) VALUES
(3, 'Nepal Visa', '<p>If you plan to travel to Nepal, a visa is a mandatory document for international travellers to enter the country. Fortunately, obtaining a Nepal visa is a straightforward process. You can easily acquire a Nepal visa on arrival, which is a quick and simple procedure. To streamline the process, you can fill out an online form, print it, and bring it with you when you arrive.</p> <p>You can download the visa form from this link:&nbsp;Nepal Visa Form.</p> <p>Alternatively, you can also obtain a Nepal visa from the Nepalese Embassy or Nepalese Diplomatic Missions abroad before your trip.</p> <h2>The cost of Nepal visa fees is as follows:</h2> <ul> <li>15&ndash;Day Visa: US$ 30</li> <li>30&ndash;Day Visa: US$ 50</li> <li>90&ndash;Day Visa: US$ 125</li> </ul> <p>However, nationals of certain countries, including Nigeria, Ghana, Zimbabwe, Swaziland, Cameroon, Somalia, Liberia, Ethiopia, Iraq, Palestine, Afghanistan, and Syria, as well as refugees with travel documents, must obtain a Nepal visa before their arrival.</p> <h2>Gratis Visa (Free Visa)</h2> <p>A Gratis Visa is issued free of charge to the following categories of applicants:</p> <ul> <li>Children below 10 years old.</li> <li>SAARC citizens (except Afghanistan) for up to 30 days once in a given visa year.</li> <li>Non-Residential Nepalese (NRN) card holders (issued by MoFA/Nepalese diplomatic missions abroad).</li> <li>Chinese nationals.</li> </ul> <p>Additionally, officials from China, Brazil, Russia, and Thailand do not require an entry visa due to reciprocal visa waiver agreements.</p>', 'postimages/travel-guide/683be82121398_nepalvisa.png', 1),
(4, 'Nepal Travel Guide', '<p>Nepal is a land of wonder, where every day feels like a new, exciting chapter. Whether you&rsquo;re exploring ancient paths, trying tasty new foods, or just watching the sun paint the mountains with gold, you&rsquo;ll feel like you&rsquo;ve discovered a secret, happy place. It&rsquo;s a place that stays in your heart long after you leave.</p> <p>And the best part? Whether you&#39;re a kid, a grown-up, or a grandparent, Nepal has something amazing for everyone. You can trek stunning trails, learn about ancient cultures, or simply relax and soak in the peaceful beauty. It&rsquo;s a place where everyone finds their joy, making it a trip you&rsquo;ll never forget.</p> <h2>Top Reasons to Visit Nepal</h2> <ul> <li><strong>Trekking in the Himalayas:</strong>&nbsp;Home to 8 of the world&#39;s 10 highest peaks including Mount Everest, with trails for all levels.</li> <li><strong>Adventure Sports:</strong>&nbsp;White-water rafting, canyoning, paragliding, bungee jumping, and more.</li> <li><strong>Climbing:</strong>&nbsp;Scale some of the world&#39;s most iconic summits.</li> <li><strong>Diverse Landscapes:</strong>&nbsp;From towering mountains to lush plains.</li> <li><strong>Wildlife:</strong>&nbsp;National parks like Chitwan and Sagarmatha host rare species like tigers, rhinos, and snow leopards.</li> <li><strong>Flora and Fauna:</strong>&nbsp;Explore rhododendron forests and birdwatching havens.</li> <li><strong>Rich Cultural Heritage:</strong>&nbsp;Over 101 ethnic groups with unique languages and festivals.</li> <li><strong>Ancient Temples and Monasteries:</strong>&nbsp;Visit UNESCO sites like Pashupatinath and Boudhanath.</li> <li><strong>Living Culture:</strong>&nbsp;Festivals, dances, arts, and architecture.</li> <li><strong>Birthplace of Buddha:</strong>&nbsp;Lumbini is a key Buddhist pilgrimage site.</li> <li><strong>Spiritual Atmosphere:</strong>&nbsp;Peaceful settings and meditation-friendly surroundings.</li> <li><strong>Meditation and Yoga:</strong>&nbsp;Numerous retreats and learning centers.</li> <li><strong>Friendly People:</strong>&nbsp;Renowned for hospitality and warmth.</li> <li><strong>Delicious Cuisine:</strong>&nbsp;Try dal bhat, momos, thukpa, and more.</li> <li><strong>Affordable Travel:</strong>&nbsp;Budget-friendly with great value.</li> <li><strong>Unique Experiences:</strong>&nbsp;Homestays, cultural immersion, and offbeat adventures.</li> </ul> <h2>Geography and Climate</h2> <p>Nepal&#39;s geography ranges from the high Himalayas in the north to the Terai plains in the south. This diversity creates climates from arctic in the mountains to tropical in the Terai. The Kathmandu Valley enjoys a moderate climate. The monsoon season (June&ndash;September) brings significant rainfall.</p> <h2>Nature</h2> <p>Nepal boasts rich biodiversity with 10 national parks, 3 wildlife reserves, 6 conservation areas, and 1 hunting reserve. Chitwan and Sagarmatha National Parks are UNESCO Natural World Heritage Sites.</p> <h2>People</h2> <p>Nepal is home to over 101 ethnic groups and 92 languages. Its population can be broadly categorized as:</p> <ul> <li><strong>Northern Himalayan People:</strong>&nbsp;Sherpas, Dolpa-pas, Lopas, Baragaonlis, Manangis (Tibetan-speaking groups).</li> <li><strong>Middle Hills and Valley People:</strong>&nbsp;Magars, Gurungs, Tamangs, Sunuwars, Newars, Thakalis, Chepangs, Brahmins, Chhetris, Thakuris, and others.</li> <li><strong>Terai People:</strong>&nbsp;Tharus, Darai, Kumhal, Majhi, and others speaking North Indian dialects.</li> </ul> <p>Kathmandu Valley is a cultural hub with the Newars as its original inhabitants.</p> <h2>Culture</h2> <p>Nepali culture blends Indo-Aryan and Tibetan-Mongolian influences. Religion and festivals shape daily life.</p> <ul> <li><strong>Religion:</strong>&nbsp;Hinduism and Buddhism dominate, with minorities practicing Islam, Christianity, Jainism, Sikhism, Bon, and others. Nepal is a secular state with high religious tolerance.</li> <li><strong>Customs:</strong>&nbsp;Vary across ethnic groups. Traditional marriages are evolving in urban areas. The concept of &quot;jutho&quot; (purity) is still practiced. Patriarchy is prevalent, though gender roles are shifting in cities.</li> </ul> <h2>Time Zone</h2> <p>Nepal is 5 hours and 45 minutes ahead of GMT (UTC+5:45).</p>', 'postimages/travel-guide/683c28b82e7e5_683be871e32f5_nepaltravelguide.png', 1);

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
-- Indexes for table `popularposts`
--
ALTER TABLE `popularposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postcatid` (`CategoryId`),
  ADD KEY `subadmin` (`postedBy`),
  ADD KEY `fk_dest_popular` (`DestID`);

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
  ADD KEY `fk_destination` (`DestID`),
  ADD KEY `fk_subcategory` (`SubCategoryId`);

--
-- Indexes for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CategoryId` (`CategoryId`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `topposts`
--
ALTER TABLE `topposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postcatid` (`CategoryId`),
  ADD KEY `subadmin` (`postedBy`),
  ADD KEY `fk_dest_top` (`DestID`);

--
-- Indexes for table `travel_guide`
--
ALTER TABLE `travel_guide`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `other`
--
ALTER TABLE `other`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `popularposts`
--
ALTER TABLE `popularposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `topposts`
--
ALTER TABLE `topposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `travel_guide`
--
ALTER TABLE `travel_guide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Constraints for table `popularposts`
--
ALTER TABLE `popularposts`
  ADD CONSTRAINT `fk_dest_popular` FOREIGN KEY (`DestID`) REFERENCES `tbldest` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tblpostdetails`
--
ALTER TABLE `tblpostdetails`
  ADD CONSTRAINT `tblpostdetails_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `tblposts` (`id`);

--
-- Constraints for table `tblposts`
--
ALTER TABLE `tblposts`
  ADD CONSTRAINT `fk_destination` FOREIGN KEY (`DestID`) REFERENCES `tbldest` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_subcategory` FOREIGN KEY (`SubCategoryId`) REFERENCES `tblsubcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  ADD CONSTRAINT `tblsubcategory_ibfk_1` FOREIGN KEY (`CategoryId`) REFERENCES `tblcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `topposts`
--
ALTER TABLE `topposts`
  ADD CONSTRAINT `fk_dest_top` FOREIGN KEY (`DestID`) REFERENCES `tbldest` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
