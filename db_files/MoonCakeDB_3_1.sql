DROP DATABASE IF EXISTS lunardelights ;

CREATE DATABASE IF NOT EXISTS lunardelights;
USE lunardelights;

CREATE USER IF NOT EXISTS 'lunaruser'@'%' IDENTIFIED BY 'ml9eRfRmNgcMUa3LfwzIWeTLI0wZIjXtr+Gi9+ELdDo=';
GRANT ALL PRIVILEGES ON *.* TO 'lunaruser'@'%' WITH GRANT OPTION;

FLUSH PRIVILEGES;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL primary key AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `FullName` varchar(50) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `PasswordSalt` varchar(265) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `RegistrationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Address` varchar(255) NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `OTP` varchar(12)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

CREATE TABLE `flavour` (
  `FlavourID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `CreatedDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

CREATE TABLE `mooncakes` (
  `MooncakeID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL,
  `FlavourID` int(11) NOT NULL,
  `ImageURL` varchar(255) DEFAULT NULL,
  `StockQuantity` int(11) NOT NULL,
  `CreatedDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Storage_Instructions` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `mooncakes` (`MooncakeID`, `Name`, `Description`, `Price`, `FlavourID`, `ImageURL`, `StockQuantity`, `CreatedDate`, `Storage_Instructions`) VALUES
(1, 'Signature Premium Collagen Yuzu Lemon Snowskin Mooncake with Yuzu Truffle', 'Indulge in a celestial experience with our \"Signature Premium Collagen Yuzu Lemon Snowskin Mooncake with Yuzu Truffle.\" This exquisite mooncake is a fusion of zesty yuzu lemon and luxurious collagen, creating a treat that delights the senses and nourishes the body. Encased in a velvety snowskin, each bite unveils a burst of tantalizing sweetness, as the yuzu truffle center adds an element of surprise and richness. Beyond its delectable taste, this mooncake embodies a perfect blend of indulgence and wellness, making it a unique delight for the Mid-Autumn Festival. Revel in the flavors and textures that dance in harmony, transcending traditional boundaries.', 19.00, 1, 'top_yuzu.png', 10, '2023-10-28 02:41:35', 'Refrigerate within 1-2 hours after purchase/ collection.\r\n\r\nDo not freeze.\r\n\r\nBest consumed on the same day of purchase or within 7 days of purchase.\r\n'),
(2, 'Signature Mao Shan Wang Snowskin Mooncake', 'Indulge in the unrivaled decadence of our \"Signature Mao Shan Wang Snowskin Mooncake,\" a regal masterpiece that captures the essence of the coveted \"Musang King\" durian. With each velvety bite, savor the distinctive custardy richness of this royal fruit, meticulously encased in our delicate snowskin. This mooncake is a true gastronomic triumph, a visual delight, and a perfect treat for any occasion, celebrating the essence of the Mid-Autumn Festival or simply delighting in the extraordinary flavor of Mao Shan Wang durian. Embrace the King of Durians and embark on an unforgettable culinary journey with our Signature Mao Shan Wang Snowskin Mooncake.', 30.00, 2, 'top_msw.png', 10, '2023-10-28 02:41:35', 'Refrigerate within 1-2 hours after purchase/ collection.\r\n\r\nDo not freeze.\r\n\r\nBest consumed on the same day of purchase or within 7 days of purchase.'),
(3, 'Signature Premium White Lotus Snowskin Mooncake with Macadamia Nuts (Reduced Sugar)', 'Delight in the delicate harmony of flavors with our \"Signature Premium White Lotus Snowskin Mooncake with Macadamia Nuts (Reduced Sugar).\" This exquisite creation fuses the classic charm of white lotus paste with the rich, buttery crunch of macadamia nuts, all embraced by a luscious, reduced-sugar snowskin. With every bite, experience a symphony of textures and tastes that redefine indulgence. This mooncake is a perfect embodiment of tradition and innovation, a delectable choice for those seeking a healthier yet equally sumptuous treat. Celebrate the Mid-Autumn Festival or any special occasion with this culinary masterpiece that combines heritage with modernity.', 19.00, 3, 'top_whitelotus1.png', 10, '2023-10-28 02:44:16', 'Refrigerate within 1-2 hours after purchase/ collection.\r\n\r\nDo not freeze.\r\n\r\nBest consumed on the same day of purchase or within 7 days of purchase.\r\n'),
(4, 'Signature Premium White Lotus Mooncake With Two Yolks', 'Indulge in the timeless elegance of our \"Signature Premium White Lotus Mooncake With Two Yolks.\" This classic mooncake exemplifies the finest traditions, featuring a velvety-smooth white lotus paste complemented by the luxurious richness of not one, but two luscious salted egg yolks. Every bite is a journey into the heart of tradition, where craftsmanship and premium ingredients unite to create an exquisite delight. The mooncake\'s symbolic significance and its ability to evoke a sense of nostalgia make it a cherished gift and a must-have during the Mid-Autumn Festival. Experience the epitome of mooncake perfection with this revered classic.', 19.00, 4, 'top_double.png', 10, '2023-10-28 02:44:16', 'Store in a cool and dry place, away from direct heat and sunlight.\r\n\r\nBest consumed within 10 days. Otherwise, please refrigerate and consume within 3 weeks.\r\n'),
(5, 'Signature Premium White Lotus Mooncake With Macadamia Nuts (Reduced Sugar)', 'Savor the delicate harmony of tradition and innovation with our \"Signature Premium White Lotus Mooncake With Macadamia Nuts (Reduced Sugar).\" This mooncake masterpiece pays homage to the classic with a reduced-sugar twist, offering a healthier indulgence without compromising on taste. Encased in the velvety embrace of white lotus paste, the mooncake surprises with the subtle crunch of premium macadamia nuts, providing a delightful contrast in texture and a nutty richness that perfectly balances the sweetness. It\'s a modern interpretation of a timeless delight, catering to those with a penchant for both tradition and well-being. Enjoy the enchanting fusion of flavors in each bite, as this mooncake captures the essence of celebration and wholesome delight during the Mid-Autumn Festival.', 18.00, 5, 'top_whitelotus2.png', 10, '2023-10-28 02:45:32', 'Store in a cool and dry place, away from direct heat and sunlight.\r\n\r\nBest consumed within 10 days. Otherwise, please refrigerate and consume within 3 weeks.\r\n'),
(6, 'Golden Pandan Mooncake With One Yolk (Reduced Sugar)', 'Elevate your Mid-Autumn Festival with our \"Golden Pandan Mooncake With One Yolk (Reduced Sugar).\" This delectable mooncake harmonizes the natural sweetness of pandan with a single golden yolk, all wrapped in a reduced-sugar pastry. The result is a delightful and healthier indulgence that doesn\'t compromise on taste. As you savor each bite, the fragrant pandan flavor and the richness of the yolk come together to create a perfect blend of traditional and contemporary flavors. Celebrate this special occasion with a mooncake that symbolizes the essence of togetherness and the joy of the season.', 19.00, 6, 'top_pandan.png', 10, '2023-10-28 02:45:32', 'Store in a cool and dry place, away from direct heat and sunlight.\r\n\r\nBest consumed within 10 days. Otherwise, please refrigerate and consume within 3 weeks.\r\n'),
(7, 'Traditional Deluxe Assorted Nuts Mooncake', 'Indulge in the timeless charm of our \"Traditional Deluxe Assorted Nuts Mooncake.\" This classic mooncake is a delightful combination of assorted nuts, roasted to perfection, and encased in a rich and flaky pastry. With every bite, you\'ll experience a delightful crunch and a medley of nutty flavors that blend seamlessly. As you share this mooncake with loved ones, you\'ll be celebrating tradition and the bounty of the harvest season. Embrace the warmth and togetherness of the Mid-Autumn Festival with this beloved delicacy that has stood the test of time.', 19.00, 7, 'special_assorted.png', 10, '2023-10-28 02:47:11', 'Store in a cool and dry place, away from direct heat and sunlight.\r\n\r\nBest consumed within 10 days. Otherwise, please refrigerate and consume within 3 weeks.\r\n'),
(8, 'Traditional Healthy Black & White Sesame Mooncake', 'Elevate your Mid-Autumn Festival celebrations with our \"Traditional Healthy Black & White Sesame Mooncake.\" This exquisite mooncake offers a harmonious blend of black and white sesame seeds, finely ground to create a delectable and health-conscious filling. The nutty aroma and subtle sweetness of sesame seeds come to life in every bite, making it a perfect treat for those looking for a guilt-free indulgence. Embrace the rich flavors and the cultural significance of this timeless delight, as you savor the delicate flavors of the black and white sesame seeds, a symbol of unity and balance. Celebrate this season with a mooncake that not only tantalizes your taste buds but also nourishes your soul.', 19.00, 8, 'special_sesame.png', 10, '2023-10-28 02:47:11', 'Store in a cool and dry place, away from direct heat and sunlight.\r\n\r\nBest consumed within 10 days. Otherwise, please refrigerate and consume within 3 weeks.\r\n'),
(9, 'White Lotus Snowskin With Champagne Truffle', 'Elevate your Mid-Autumn Festival with our \"White Lotus Snowskin With Champagne Truffle\'\' mooncake. This exquisite creation brings together the purity of white lotus paste and the luxurious essence of Champagne truffle. With a delicate snowskin exterior, each bite is a symphony of flavors, where the sweet lotus paste melds seamlessly with the rich, aromatic notes of Champagne truffle. Indulge in the perfect balance of sweetness and sophistication, making this mooncake a delightful choice for those who appreciate the finer things in life. Add a touch of opulence to your festivities as you savor this exquisite mooncake, an embodiment of luxury and tradition.', 19.00, 9, 'special_whitelotus.png', 10, '2023-10-28 02:50:03', 'Refrigerate within 1-2 hours after purchase/ collection.\r\n\r\nDo not freeze.\r\n\r\nBest consumed on the same day of purchase or within 7 days of purchase.'),
(10, 'Milk Tea Paste Snowskin With Peanut Butter Truffle', 'Experience the harmonious blend of flavors in our \"Milk Tea Paste Snowskin With Peanut Butter Truffle\'\' mooncake. This delectable treat combines the comforting taste of milk tea paste with the delightful surprise of a peanut butter truffle at its center. The snowskin delicately envelopes this flavorful union, offering a perfect balance of sweetness and nutty richness. With every bite, you\'ll be transported to a cozy teahouse, where the creamy milk tea and the nutty goodness of peanut butter come together in a delightful dance of taste. Indulge in this unique fusion of flavors, a modern twist on a traditional delight that\'s sure to delight your palate.', 19.00, 10, 'special_milktea.png', 10, '2023-10-28 02:50:03', 'Refrigerate within 1-2 hours after purchase/ collection.\r\n\r\nDo not freeze.\r\n\r\nBest consumed on the same day of purchase or within 7 days of purchase.\r\n'),
(11, 'Premium Organic Matcha Mooncake', 'Elevate your mooncake experience with our \"Premium Organic Matcha Mooncake.\" This new and innovative creation offers a taste of pure indulgence, featuring the finest organic matcha as its star ingredient. Each bite unveils the rich, earthy notes of matcha, beautifully complemented by a delicate and flavorful filling. Encased in a soft and luxurious mooncake skin, this delicacy is a testament to the art of blending traditional flavors with a modern twist. Treat yourself to the enchanting world of matcha, where authenticity meets innovation, and savor the essence of premium organic goodness in every bite.', 25.00, 11, 'new_matcha.png', 0, '2023-10-28 02:50:23', 'Store in a cool and dry place, away from direct heat and sunlight.\r\n\r\nBest consumed within 10 days. Otherwise, please refrigerate and consume within 3 weeks.\r\n'),
(12, 'Fuerte Avocado Snow Skin Mooncake', 'Introducing our brand-new creation, the \"Fuerte Avocado Snow Skin Mooncake.\" This innovative mooncake redefines indulgence with the bold and creamy flavors of Fuerte avocados. The mooncake boasts a lusciously smooth avocado paste encased in a delicate snow skin, offering a unique blend of sweet and buttery goodness. With its vibrant green color and delectable taste, this mooncake is a true celebration of nature\'s bounty. Experience a mooncake like no other, where the richness of avocados takes center stage, creating a delightful treat that\'s both wholesome and heavenly. Delve into the world of Fuerte avocados with every bite, and let your taste buds revel in the velvety luxury of this exquisite mooncake.', 25.00, 12, 'new_avocado.png', 10, '2023-10-28 02:54:48', 'Refrigerate within 1-2 hours after purchase/ collection.\r\n\r\nDo not freeze.\r\n\r\nBest consumed on the same day of purchase or within 7 days of purchase.'),
(13, 'Kyoto Hojicha Snow Skin Mooncake', 'Introducing our latest creation, the \"Kyoto Hojicha Snow Skin Mooncake.\" This mooncake is a testament to the harmonious marriage of tradition and innovation. With a delicate snow skin embracing a rich and aromatic Kyoto Hojicha filling, it offers a sublime taste experience. The meticulously roasted Hojicha green tea leaves give this mooncake a distinctive smoky flavor and a soothing earthy aroma that takes your palate on a journey to the serene landscapes of Kyoto. Every bite is a celebration of the art of tea-making, making this mooncake a true embodiment of Japanese culinary mastery. Indulge in the warm, toasty notes of Kyoto Hojicha and savor the essence of Japan with every bite of this new and exquisite mooncake.', 25.00, 13, 'new_hojicha.png', 10, '2023-10-28 02:54:48', 'Refrigerate within 1-2 hours after purchase/ collection.\r\n\r\nDo not freeze.\r\n\r\nBest consumed on the same day of purchase or within 7 days of purchase.'),
(14, 'Piedmont Hazelnut Snow Skin Mooncake', 'Introducing our brand-new creation, the \"Piedmont Hazelnut Snow Skin Mooncake.\" Crafted with utmost precision and care, this mooncake is a luxurious fusion of Italian and Chinese flavors. Inside the delicate snow skin, you\'ll discover a sumptuous Piedmont Hazelnut filling that offers a delightful crunch and a rich, nutty sweetness. Sourced from the renowned Piedmont region in Italy, these hazelnuts are celebrated for their exceptional quality and flavor. With each bite, you\'ll experience a symphony of textures and tastes, from the velvety snow skin to the exquisite hazelnut center. Elevate your mooncake experience with the exquisite blend of Chinese tradition and Italian sophistication found in our Piedmont Hazelnut Snow Skin Mooncake.', 25.00, 14, 'new_hazelnut.png', 10, '2023-10-28 02:56:22', 'Refrigerate within 1-2 hours after purchase/ collection.\r\n\r\nDo not freeze.\r\n\r\nBest consumed on the same day of purchase or within 7 days of purchase.\r\n'),
(15, 'Thai Young Coconut Snow Skin Mooncake', 'Introducing our newest creation, the \"Thai Young Coconut Snow Skin Mooncake.\" This delectable mooncake offers a taste of tropical paradise with every bite. Encased in a delicate and smooth snow skin, the mooncake reveals a luscious Thai Young Coconut filling that is fragrant, refreshing, and subtly sweet. The filling captures the essence of fresh, tender young coconuts from Thailand, known for their exceptional taste and natural sweetness. Each mouthful is a journey to the exotic landscapes of Thailand, with the mooncake\'s creamy and coconut-infused center delighting your taste buds. Experience the perfect harmony of traditional mooncakes and tropical indulgence with our Thai Young Coconut Snow Skin Mooncake.', 25.00, 15, 'new_coconut.png', 10, '2023-10-28 02:56:22', 'Refrigerate within 1-2 hours after purchase/ collection.\r\n\r\nDo not freeze.\r\n\r\nBest consumed on the same day of purchase or within 7 days of purchase.'),
(16, 'Traditional Pandan Double Yolk Mooncake', 'Introducing our \"Traditional Pandan Double Yolk Mooncake,\" a timeless delicacy that combines the rich tradition of mooncakes with an exquisite twist. This mooncake boasts a fragrant and vibrant green pandan-flavored pastry that envelops a luxurious surprise within – not one, but two golden egg yolks. The pandan\'s sweet and aromatic notes complement the savory, creamy yolks, creating a harmonious flavor profile that is both delightful and indulgent. With each bite, you\'ll savor the perfect balance of flavors and textures, making it an ideal gift or treat for celebrating special occasions and carrying forward the legacy of mooncake craftsmanship.', 25.00, 16, 'new_double.png', 10, '2023-10-28 02:57:54', 'Store in a cool and dry place, away from direct heat and sunlight.\r\n\r\nBest consumed within 10 days. Otherwise, please refrigerate and consume within 3 weeks.\r\n'),
(17, 'Signature Premium Collagen Yuzu Lemon Mooncake', 'Introducing our brand-new creation, the “Signature Premium Collagen Yuzu Lemon Mooncake”. It is an exceptional treat that combines the delicate flavors of Yuzu and the goodness of collagen in a delectable mooncake. Crafted with the finest ingredients, this mooncake offers a refreshing citrus twist to the traditional mooncake experience. The Yuzu\'s zesty notes blend harmoniously with the subtle sweetness of the mooncake, creating a delightful contrast that excites the palate. With the added benefit of collagen, each bite not only indulges your taste buds but also provides nourishment for your skin. This unique mooncake is the perfect fusion of flavor and wellness, making it a must-try for those seeking a mooncake that goes beyond tradition.', 19.00, 17, 'new_yuzu.png', 10, '2023-10-28 02:57:54', 'Store in a cool and dry place, away from direct heat and sunlight.\r\n\r\nBest consumed within 10 days. Otherwise, please refrigerate and consume within 3 weeks.\r\n');

-- --------------------------------------------------------


CREATE TABLE `order_details` (
  `OrderID` int(11) NOT NULL,
  `MooncakeID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Total_Price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------


CREATE TABLE `ratings` (
  `MooncakeID` int(11) NOT NULL,
  `Rating_Score` decimal(10,2) NOT NULL,
  `Reviews` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `ratings` (`MooncakeID`, `Rating_Score`, `Reviews`) VALUES
(1, 4.50, '434 ratings | 100+ reviews'),
(2, 4.50, '524 ratings | 100+ reviews'),
(3, 4.00, '329 ratings | 50+ reviews'),
(4, 4.50, '485 ratings | 100+ reviews'),
(5, 4.00, '367 ratings | 50+ reviews'),
(6, 4.00, '345 ratings | 50+ reviews'),
(7, 4.00, '334 ratings | 50+ reviews'),
(8, 4.00, '363 ratings | 50+ reviews'),
(9, 4.00, '378 ratings | 50+ reviews'),
(10, 4.00, '346 ratings | 50+ reviews'),
(11, 0.00, '0 ratings | 0 reviews'),
(12, 0.00, '0 ratings | 0 reviews'),
(13, 0.00, '0 ratings | 0 reviews'),
(14, 0.00, '0 ratings | 0 reviews'),
(15, 0.00, '0 ratings | 0 reviews'),
(16, 0.00, '0 ratings | 0 reviews'),
(17, 0.00, '0 ratings | 0 reviews');

-- --------------------------------------------------------


CREATE TABLE `users` (
  `UserID` int(11) NOT NULL primary key AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `FullName` varchar(50) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `PasswordSalt` varchar(265) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `RegistrationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Address` varchar(255) NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `OTP` varchar(12)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `admin` (`AdminID`, `Username`, `FullName`, `PasswordHash`, `PasswordSalt`, `Email`, `RegistrationDate`, `Address`, `Phone`, `OTP`) VALUES
(1, 'Damien', 'Damien', '$2b$15$n3EXoqV5W78NIlkGMWbYYuD2/8scIXT1H.K5kGsKXYX9YbSCCOjvC', '$2b$15$n3EXoqV5W78NIlkGMWbYYu', '1902946@sit.singaporetech.edu.sg', '2023-09-12 11:25:23', 'Singapore Lol', '91234567', ''),
(2, 'terrence', 'terrence', '$2b$15$n3EXoqV5W78NIlkGMWbYYuD2/8scIXT1H.K5kGsKXYX9YbSCCOjvC', '$2b$15$n3EXoqV5W78NIlkGMWbYYu', 'terrencelee1234@gmail.com', '2023-09-12 11:25:23', 'Singapore Lol', '91234567', '');

INSERT INTO `users` (`UserID`, `Username`, `FullName`, `PasswordHash`, `PasswordSalt`, `Email`, `RegistrationDate`, `Address`, `Phone`, `OTP`) VALUES
(1, 'John', 'John', '$2b$15$n3EXoqV5W78NIlkGMWbYYuD2/8scIXT1H.K5kGsKXYX9YbSCCOjvC', '$2b$15$n3EXoqV5W78NIlkGMWbYYu', 'terrencelee1234@gmail.com', '2023-09-12 11:25:23', 'Singapore Lol', '91234567', '');


CREATE TABLE `user_cart` (
  `CartID` int(11) NOT NULL primary key AUTO_INCREMENT,
  `UserID` int(11) DEFAULT NULL,
  `OrderID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `flavour`
--
ALTER TABLE `flavour`
  ADD PRIMARY KEY (`FlavourID`);

--
-- Indexes for table `mooncakes`
--
ALTER TABLE `mooncakes`
  ADD PRIMARY KEY (`MooncakeID`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`MooncakeID`);


--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `flavour`
--
ALTER TABLE `flavour`
  MODIFY `FlavourID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mooncakes`
--
ALTER TABLE `mooncakes`
  MODIFY `MooncakeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD CONSTRAINT `user_cart_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
COMMIT;
