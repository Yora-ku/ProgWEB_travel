-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 11, 2025 at 10:59 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travelhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `hotel_id` int DEFAULT NULL,
  `destination_id` int DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `full_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_price` decimal(12,2) DEFAULT NULL,
  `status` enum('Pending','Confirmed','Cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `guests` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `hotel_id`, `destination_id`, `check_in`, `check_out`, `full_name`, `phone_number`, `total_price`, `status`, `created_at`, `guests`) VALUES
(3, 1, 4, 2, '2025-10-09', '2025-10-10', 'Muhamad Fauzan', '081949362067', '9395098.00', 'Pending', '2025-10-06 20:08:06', 0),
(4, 1, 5, 2, '2025-10-09', '2025-10-10', 'Muhamad raihan', '0860923477', '6080111.00', 'Pending', '2025-10-06 20:08:06', 0),
(5, 1, 1, 1, '2025-10-16', '2025-10-19', 'Miftah Irsyad Tamam', '083242323423423', '1111425.00', 'Pending', '2025-10-06 20:08:06', 0),
(6, 1, 7, 3, '2025-10-30', '2025-10-31', 'Daniel Valent Poly', '087234423255', '1608574.00', 'Pending', '2025-10-06 20:08:06', 0),
(7, 1, 3, 1, '2025-10-04', '2025-10-07', 'Joel Christo', '0852445386334', '1444038.00', 'Pending', '2025-10-06 20:08:06', 0),
(8, 1, 8, 3, '2025-10-01', '2025-10-02', 'Miftah Irsyad Tamam', '087234423255', '2598983.00', 'Pending', '2025-10-06 20:08:06', 0),
(9, 1, 1, 1, '2025-12-10', '2026-01-12', 'Muhamad Fauzan', '0860923477', '12225675.00', 'Pending', '2025-10-06 20:08:06', 0),
(10, 1, 12, 4, '2025-10-10', '2025-10-25', 'deva wardana', '08532832342421', '60000000.00', 'Pending', '2025-10-06 20:08:06', 0),
(11, 1, 10, 5, '2025-10-31', '2025-11-02', 'Osa Nafila', '08234255289012', '8836966.00', 'Pending', '2025-10-06 20:08:06', 0),
(12, 1, 10, 5, '2025-10-24', '2025-10-25', 'fajar', '0834354352242', '4418483.00', 'Pending', '2025-10-06 20:08:06', 0),
(13, 1, 11, 7, '2025-10-28', '2025-10-29', 'ghanan', '0853242723421123', '2134437.00', 'Pending', '2025-10-06 20:08:06', 0),
(14, 1, 4, 2, '2025-10-29', '2025-11-01', 'joel', '08241242342424', '28185294.00', 'Pending', '2025-10-06 20:08:06', 0),
(15, 1, 1, 1, '2025-10-02', '2025-10-04', 'Daniel Valent Poly', '08532832342421', '2963800.00', 'Pending', '2025-10-06 20:08:06', 0),
(16, 1, 12, 4, '2027-02-12', '2027-02-17', 'mark lee', '0822131', '60000000.00', 'Confirmed', '2025-10-06 20:28:06', 0),
(17, 1, 13, 8, '2027-02-12', '2027-02-13', 'lee jen', '0219313', '23800000.00', 'Confirmed', '2025-10-08 17:50:00', 4),
(24, 11, 12, 4, '2025-10-29', '2025-10-30', 'joel', '08654678', '4000000.00', 'Pending', '2025-10-11 17:35:33', 1),
(26, 3, 11, 7, '2025-10-31', '2025-11-03', 'Daniel Valent Poly', '08532832342421', '19209933.00', 'Pending', '2025-10-11 17:52:34', 3);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `message_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_general_ci,
  `sent_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `destination_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`destination_id`, `name`, `location`, `description`, `price`, `created_at`, `image_url`) VALUES
(1, 'Indonesia', 'Indonesia', 'Indonesia is the world’s largest archipelago,\r\nhome to pristine beaches and lush landscapes.\r\nRich culture and traditions await every visitor,\r\nmaking it a truly unforgettable destination.', '7000000.00', '2025-10-06 20:04:01', 'asset/image/1756357046_indo.jpeg'),
(2, 'Jepang', 'Jepang', 'Japan is a fascinating destination where tradition meets modernity. From ancient temples and cherry blossoms to advanced technology and vibrant cities, Japan offers unique cultural experiences and breathtaking scenery for every traveler.', '10000000.00', '2025-10-06 20:04:01', 'asset/image/1759931680_4b2b28f3-dfa3-4bb6-a8c4-addfab83352f.png'),
(3, 'China', 'China', 'China is a vast destination rich in history and culture. From the Great Wall and ancient temples to modern cities and stunning natural landscapes, it offers travelers a blend of tradition and innovation.\r\n', '8000000.00', '2025-10-06 20:04:01', 'asset/image/1756357882_china.jpeg'),
(4, 'Zwitzerland', 'Zwitzerland', 'Switzerland is a breathtaking destination known for its majestic Alps, crystal-clear lakes, and charming villages. With world-class skiing, scenic train rides, and rich cultural heritage, it’s a perfect place for nature and adventure lovers.\r\n', '11000000.00', '2025-10-06 20:04:01', 'asset/image/1759931586_39659f82-4106-47c9-a49b-feda761479db.jfif'),
(5, 'France', 'Europe', 'France is famous for its rich cultural heritage, art, fashion, cuisine, and landmarks such as the Eiffel Tower, which is an important symbol of the country.', '10.00', '2025-10-06 20:04:01', 'asset/image/1759931425_8c18cf16-4a1a-40ff-9f9c-2f44f6ad595e.jfif'),
(7, 'London', 'Inggris', 'London is the capital of England and the United Kingdom, and it is the largest metropolitan area in the UK. It is located along the River Thames.', '1.00', '2025-10-06 20:04:01', 'asset/image/1759930965_646f1853-5a7e-49f9-87f0-4981b938d278.png'),
(8, 'South Korean', 'Asian', 'there are many idols', '7000.00', '2025-10-06 20:04:01', 'asset/image/1759755098_korsel.png');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `hotel_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT NULL,
  `reviews` int DEFAULT NULL,
  `image_hotel` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `price` decimal(12,2) NOT NULL,
  `destination_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`hotel_id`, `name`, `address`, `city`, `rating`, `reviews`, `image_hotel`, `description`, `price`, `destination_id`) VALUES
(1, 'Sovereign Bali Hotel', 'Jl. Raya Tuban, Lingkungan Griya No.2, Bali 80361', ' Tuban', '5.0', 700, 'asset/hotels/1756359404_sovereignhotel.jpg', 'Sovereign Bali Hotel is a stylish 4-star hotel near Ngurah Rai Airport, offering modern rooms, a pool, spa, and easy access to Bali’s top attractions—perfect for both leisure and business travelers.\r\n', '370475.00', 1),
(2, 'D’Primahotel Seminyak', 'Jl. Kayu Jati No.16, Kec. Kuta Utara, Kabupaten Badung, Bali 80361', 'Seminyak', '4.5', 600, 'asset/hotels/1756366820_dprimahotelseminyak.jpg', 'D’Primahotel Seminyak is a cozy hotel in the heart of Seminyak, Bali, offering modern rooms, a relaxing atmosphere, and easy access to beaches, shopping, and nightlife—ideal for a comfortable island getaway.', '527990.00', 1),
(3, 'favehotel PGC Cililitan', 'Jl. Mayjend Sutoyo no.76, Cililitan, Jakarta Timur, Jakarta, 13640', 'Cililitan', '4.0', 450, 'asset/hotels/1758772559_cililitan.jpeg', 'For you, travelers who wish to travel comfortably on a budget, favehotel PGC Cililitan is the perfect place to stay that provides decent facilities as well as great services.', '481346.00', 1),
(4, 'Hyatt Centric Ginza Tokyo', '6-6-7 Ginza, Chou-ku, Tokyo, Chuo, Kanto, Japan, 104-0061', 'Ginza', '4.4', 339, 'asset/hotels/1758772995_ginza.jpg', 'Be ready to get the unforgettable stay experience by its exclusive service, completed by a full range of facilities to cater all your needs.', '9395098.00', 2),
(5, 'sequence MIYASHITA PARK', '6-20-10 MIYASHITA PARK North, Jingumae, Tokyo, Shibuya, Kanto, Japan, 150-0001', 'Shibuya', '3.6', 874, 'asset/hotels/1758777253_miyashita.jpg', 'Be ready to get the unforgettable stay experience by its exclusive service, completed by a full range of facilities to cater all your needs.', '6080111.00', 2),
(6, 'Shinjuku Washington Hotel Main', '3-2-9 Nishishinjuku, Shinjuku-ku, Tokyo, Shinjuku, Kanto, Japan, 160-0023', 'Shinjuku', '3.0', 2666, 'asset/hotels/1758777521_Shinjuku.jpg', 'Be ready to get the unforgettable stay experience by its exclusive service, completed by a full range of facilities to cater all your needs.', '2247691.00', 2),
(7, 'Central Hotel Shanghai', 'No 555 Jiujiang Road, Huangpu, Shanghai, 200001', 'Huangpu', '3.8', 1013, 'asset/hotels/1758855040_huangpu.jpg', 'Be ready to get the unforgettable stay experience by its exclusive service, completed by a full range of facilities to cater all your needs.', '1608574.00', 3),
(8, 'Shanghai Marriott Marquis City Centre', '555 Xizang Rd (M), Peoples Square, Huangpu, Shanghai, 200003', 'Huangpu', '4.0', 1028, 'asset/hotels/1758855769_Huangpu_centre.jpg', 'The highest quality service accompanying its extensive facilities will make you get the ultimate holiday experience.', '2598983.00', 3),
(10, 'Hotel Tourisme Avenue', '66, Avenue de La Motte Picquet, Vaugirard, Paris, Island of France, France, 75015', 'Vaugirard', '4.2', 950, 'asset/hotels/1759365242_avenue.jpg', 'Hôtel Tourisme Avenue is a hotel with great comfort and excellent service according to most hotels guests.', '4418483.00', 5),
(11, 'ibis Berlin Hauptbahnhof', 'Invalidenstraße 53, 10557 Berlin, Jerman', 'Moabit', '3.8', 949, 'asset/hotels/1759365941_ibis.jpg', 'Splendid service together with wide range of facilities provided will make you complain for nothing during your stay at ibis Berlin Hauptbahnhof.', '2134437.00', 7),
(12, 'Hotel Victoria Lauberhorn Wengen, a Faern Collection Hotel', 'Dorfstrasse 1, Wengen City Center, Wengen, Switzerland, 3823', 'Wengen', '3.9', 645, 'asset/hotels/1759366758_wengen.jpg', 'Splendid service together with wide range of facilities provided will make you complain for nothing during your stay at Hotel Falken.', '4000000.00', 4),
(13, 'voco Seoul Myeongdong By IHG', '52, Taegye-ro, Jung-gu, Seoul, Myeong-dong, Seoul, Korea Selatan, 04634', 'Seoul', '0.4', 7, 'asset/hotels/1759920421_voco Seoul Myeongdong By IHG.png', 'ggatauu', '1700000.00', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'xborg123122', 'hafizkun@gamil.com', '$2y$10$S3.eXPP0RXcwCp1qkkY0HeN/QukRuMcuW.SHGAz5ZScqYaJJEZiAy', 'admin', '2025-10-06 20:09:10'),
(2, 'zanshere', 'zan@gmail.com', '$2y$10$U/4bvbKNicfc7lWnW8zyi.NrJYxg0qzhxVUcXsv1xbziQcJB0671S', 'admin', '2025-10-06 20:09:10'),
(3, 'user', 'user@gmail.com', '$2y$10$Fofw7a3WDlrdEuqgdjMQ4uQraZZ8aUL3VyNr8/MHav2g6T7T24jw.', 'admin', '2025-10-06 20:09:10'),
(4, 'hahaha', 'hihihi@gmail.com', '$2y$10$jwjkNU2fZo.hL99PfisbCOAl8WxmczshAbbiV7IWdSER2KtX7iX32', 'admin', '2025-10-06 20:09:10'),
(5, 'yosep', 'tamam@gmail.com', '$2y$10$5wQNSAAusnZoBiQrzc/RQ.CmWrd.X6iU2pdvVgUG7y0sM70tZLLt6', 'admin', '2025-10-06 20:09:10'),
(6, 'pak gani', 'pagani@gmail.com', '$2y$10$kM2cqk390E5RM0gBaR.aGumUs0IiW.Iv1pvTkyePGQAU9rC0MeiCa', 'admin', '2025-10-06 20:09:10'),
(7, 'user1', 'leejeno@gmail.com', '$2y$10$NTKiD3iwQUtSdp.EKToQ1OrONyE2m4HjNjDelKcJ9jnn00noPKBqe', 'admin', '2025-10-06 20:09:10'),
(8, 'admin', 'nana@gmail.com', '$2y$10$/fesGhzzk2KT9Ox50/P3lulFFL2jdW6LwnCPkWL1fiMSBEIf4TMMq', 'admin', '2025-10-06 20:09:10'),
(9, 'oca', 'marklee@gmail.com', '$2y$10$vYL/F1CVNhBtBlgAEeiOKeWE6qKO.sTovk4vo6xTQ.iEDgbXi2gWu', 'admin', '2025-10-06 20:24:32'),
(10, 'mark', 'nini@gmail.com', '$2y$10$sash34BzTr1Wx911vsbOserkgE09MbHASWZ.g7kLNgXab4KEusP2S', 'user', '2025-10-06 20:27:12'),
(11, 'userr', 'cortis@gmail.com', '$2y$10$TNjGkc0.NleH9CSQBLocR.tHYPr5ee7q9DOVa847dg4DN8a.XIiUy', 'user', '2025-10-08 17:48:03'),
(12, 'joel', 'joel@gmail.com', '$2y$10$oievkRKiBrHltiZMjEmFb.vGhwASszq0wvWKl1brdEDcZpDe8j93C', 'user', '2025-10-09 08:35:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `hotel_id` (`hotel_id`),
  ADD KEY `destination_id` (`destination_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`destination_id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotel_id`),
  ADD KEY `destination_id` (`destination_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `message_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `destination_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotel_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`hotel_id`),
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`destination_id`);

--
-- Constraints for table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `hotels_ibfk_1` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`destination_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
