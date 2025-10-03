-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 03, 2025 at 12:10 PM
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
  `full_name` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `total_price` decimal(12,2) DEFAULT NULL,
  `status` enum('Pending','Confirmed','Cancelled') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `hotel_id`, `destination_id`, `check_in`, `check_out`, `full_name`, `phone_number`, `total_price`, `status`) VALUES
(3, 1, 4, 2, '2025-10-09', '2025-10-10', 'Muhamad Fauzan', '081949362067', '9395098.00', 'Pending'),
(4, 1, 5, 2, '2025-10-09', '2025-10-10', 'Muhamad raihan', '0860923477', '6080111.00', 'Pending'),
(5, 1, 1, 1, '2025-10-16', '2025-10-19', 'Miftah Irsyad Tamam', '083242323423423', '1111425.00', 'Pending'),
(6, 1, 7, 3, '2025-10-30', '2025-10-31', 'Daniel Valent Poly', '087234423255', '1608574.00', 'Pending'),
(7, 1, 3, 1, '2025-10-04', '2025-10-07', 'Joel Christo', '0852445386334', '1444038.00', 'Pending'),
(8, 1, 8, 3, '2025-10-01', '2025-10-02', 'Miftah Irsyad Tamam', '087234423255', '2598983.00', 'Pending'),
(9, 1, 1, 1, '2025-12-10', '2026-01-12', 'Muhamad Fauzan', '0860923477', '12225675.00', 'Pending'),
(10, 1, 12, 4, '2025-10-10', '2025-10-25', 'deva wardana', '08532832342421', '60000000.00', 'Pending'),
(11, 1, 10, 5, '2025-10-31', '2025-11-02', 'Osa Nafila', '08234255289012', '8836966.00', 'Pending'),
(12, 1, 10, 5, '2025-10-24', '2025-10-25', 'fajar', '0834354352242', '4418483.00', 'Pending'),
(13, 1, 11, 7, '2025-10-28', '2025-10-29', 'ghanan', '0853242723421123', '2134437.00', 'Pending'),
(14, 1, 4, 2, '2025-10-29', '2025-11-01', 'joel', '08241242342424', '28185294.00', 'Pending'),
(15, 1, 1, 1, '2025-10-02', '2025-10-04', 'Daniel Valent Poly', '08532832342421', '2963800.00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `message_id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` text,
  `sent_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `destination_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `description` text,
  `price` decimal(10,2) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`destination_id`, `name`, `location`, `description`, `price`, `image_url`) VALUES
(1, 'Indonesia', 'Indonesia', 'Indonesia is the world’s largest archipelago,\r\nhome to pristine beaches and lush landscapes.\r\nRich culture and traditions await every visitor,\r\nmaking it a truly unforgettable destination.', '7000000.00', 'asset/image/1756357046_indo.jpeg'),
(2, 'Jepang', 'Jepang', 'Japan is a fascinating destination where tradition meets modernity. From ancient temples and cherry blossoms to advanced technology and vibrant cities, Japan offers unique cultural experiences and breathtaking scenery for every traveler.', '10000000.00', 'asset/image/1756357827_jepang.jpeg'),
(3, 'China', 'China', 'China is a vast destination rich in history and culture. From the Great Wall and ancient temples to modern cities and stunning natural landscapes, it offers travelers a blend of tradition and innovation.\r\n', '8000000.00', 'asset/image/1756357882_china.jpeg'),
(4, 'Zwitzerland', 'Zwitzerland', 'Switzerland is a breathtaking destination known for its majestic Alps, crystal-clear lakes, and charming villages. With world-class skiing, scenic train rides, and rich cultural heritage, it’s a perfect place for nature and adventure lovers.\r\n', '11000000.00', 'asset/image/1756357959_zwitzerland.jpeg'),
(5, 'France', 'Europe', 'France is a country in Western Europe with its capital in Paris. It is well known for its culture, art, fashion, cuisine, and landmarks like the Eiffel Tower, making it the world’s most visited tourist destination.', '10.00', 'asset/image/1758779037_perancis.png'),
(7, 'Germany', 'Europe', 'Germany is a country in Central Europe with its capital in Berlin. It is known for its strong economy, rich history, culture, and innovations, as well as landmarks like the Brandenburg Gate and Neuschwanstein Castle.', '1.00', 'asset/image/1758779239_Jerman.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `hotel_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT NULL,
  `reviews` int DEFAULT NULL,
  `image_hotel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` text,
  `price` decimal(12,2) NOT NULL,
  `destination_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(9, 'Holiday Inn SHANGHAI NANJING ROAD by IHG, an IHG Hotel', 'No. 595 Jiujiang Road, Huangpu District, Huangpu, Shanghai, 200001', 'Huangpu', '3.6', 187, 'asset/hotels/1758856611_holidayan.jpg', 'Holiday Inn SHANGHAI NANJING ROAD, an IHG Hotel is a hotel with great comfort and excellent service according to most hotels guests.', '2282219.00', 3),
(10, 'Hotel Tourisme Avenue', '66, Avenue de La Motte Picquet, Vaugirard, Paris, Island of France, France, 75015', 'Vaugirard', '4.2', 950, 'asset/hotels/1759365242_avenue.jpg', 'Hôtel Tourisme Avenue is a hotel with great comfort and excellent service according to most hotels guests.', '4418483.00', 5),
(11, 'ibis Berlin Hauptbahnhof', 'Invalidenstraße 53, 10557 Berlin, Jerman', 'Moabit', '3.8', 949, 'asset/hotels/1759365941_ibis.jpg', 'Splendid service together with wide range of facilities provided will make you complain for nothing during your stay at ibis Berlin Hauptbahnhof.', '2134437.00', 7),
(12, 'Hotel Victoria Lauberhorn Wengen, a Faern Collection Hotel', 'Dorfstrasse 1, Wengen City Center, Wengen, Switzerland, 3823', 'Wengen', '3.9', 645, 'asset/hotels/1759366758_wengen.jpg', 'Splendid service together with wide range of facilities provided will make you complain for nothing during your stay at Hotel Falken.', '4000000.00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'xborg123122', 'hafizkun@gamil.com', '$2y$10$S3.eXPP0RXcwCp1qkkY0HeN/QukRuMcuW.SHGAz5ZScqYaJJEZiAy'),
(2, 'zanshere', 'zan@gmail.com', '$2y$10$U/4bvbKNicfc7lWnW8zyi.NrJYxg0qzhxVUcXsv1xbziQcJB0671S'),
(3, 'user', 'user@gmail.com', '$2y$10$Fofw7a3WDlrdEuqgdjMQ4uQraZZ8aUL3VyNr8/MHav2g6T7T24jw.'),
(4, 'hahaha', 'hihihi@gmail.com', '$2y$10$jwjkNU2fZo.hL99PfisbCOAl8WxmczshAbbiV7IWdSER2KtX7iX32'),
(5, 'yosep', 'tamam@gmail.com', '$2y$10$5wQNSAAusnZoBiQrzc/RQ.CmWrd.X6iU2pdvVgUG7y0sM70tZLLt6'),
(6, 'pak gani', 'pagani@gmail.com', '$2y$10$kM2cqk390E5RM0gBaR.aGumUs0IiW.Iv1pvTkyePGQAU9rC0MeiCa');

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
  MODIFY `booking_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `message_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `destination_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotel_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `hotels_ibfk_1` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`destination_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
