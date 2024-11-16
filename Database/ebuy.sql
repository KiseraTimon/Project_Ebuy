create Database Ebuy;
use Ebuy;


create Table users
(
	userID int not null auto_increment primary key,
	fName varchar(100) not null,
    lName varchar(100) not null,
    uname varchar(100) not null unique,
	email varchar(100) not null unique,
    passw VARCHAR(255) NOT NULL,
	contactphone int not null unique,
	address text, 
    profilePic LONGBLOB,
    accountType varchar(10) not null 
);

create Table Products
(
	productID int not null auto_increment primary key,
    productName varchar(100) not null,
    productDesc TEXT not null, 
    price int not null,
    quantity int not null,
    category varchar(50) not null,
    userID int, foreign key(userID) references users (userID) ON delete SET null
    
);

-- DROP Table transactions;
create Table transactions
(
	transactionID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    userID INT NOT NULL,
    code VARCHAR(20) NOT NULL,
    totalPrice INT NOT NULL,
    purchaseDate DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE testimonials
(
	testID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    dispname VARCHAR(30) NOT NULL,
    tests TEXT NOT NULL,
    testreview INT NOT NULL,
    userID INT NOT NULL
);

ALTER TABLE testimonials
ADD FOREIGN KEY (userID) REFERENCES users(userID);

CREATE TABLE favorites
(
	favID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    productID INT NOT NULL,
    userID INT NOT NULL
);

ALTER TABLE favorites
ADD FOREIGN KEY (productID) REFERENCES Products(productID);

ALTER TABLE favorites
ADD FOREIGN KEY (userID) REFERENCES users(userID);

CREATE TABLE categories
(
	categoryID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(100) NOT NULL
);

CREATE TABLE subcategories
(
	subcatID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    subcat VARCHAR(100) NOT NULL,
    categoryID INT NOT NULL
);

ALTER TABLE subcategories
ADD FOREIGN KEY (categoryID) REFERENCES categories(categoryID);

ALTER TABLE Products
ADD COLUMN subcategory VARCHAR(255) NOT NULL AFTER category;

INSERT INTO subcategories (subcatID, subcat, categoryID) VALUES
-- Accessories
('1','Jewelry', 1),
('2','Watches', 1),
('3','Headwear', 1),
('4','Bags', 1),
('5','Sunglasses', 1),
('6','Belts', 1),

-- Antiques
('7','Vintage Clothing', 2),
('8','Antique Furniture', 2),
('9','Classic Electronics', 2),
('10','Retro Home Decor', 2),

-- Art & Collectibles
('11','Paintings', 3),
('12','Sculptures', 3),
('13','Photography', 3),
('14','Antique Books', 3),
('15','Antique Furniture', 3),
('16','Antique decorations', 3),
('17','Armoires', 3),


-- Audio Systems
('18','Amplifiers', 4),
('19','Audio Receivers', 4),
('20','Headphones', 4),
('21','Microphones', 4),
('22','Mixers', 4),
('23','Speakers', 4),
('24','Soundbars', 4),

-- Automotive Tools
('25','Socket Set', 5),
('26','Power Tools', 5),
('27','Repair Kits', 5),
('28','Diagnostic Tools', 5),
('29','Vehicle Parts', 3),

-- Bags
('30','Backpacks', 6),
('31','Shoulder bags', 6),
('32','Clutches', 6),
('33','Crossbody', 6),
('34','Suitcases', 6),
('35','DUffel bags', 6),
('36','Handbags', 6),
('37','Fanny packs', 6),


-- Bathroom
('38','Bath Mats', 7),
('39','Shower Curtains', 7),
('40','Towels', 7),
('41','Bathroom Storage', 7),
('42','Dispensers', 7),
('43','Racks', 7),
('44','Trash cans', 7),

-- Bedding & Linens
('45','Mattress', 8),
('46','Pillows', 8),
('47','Comforters', 8),
('48','Pillow cases', 8),
('49','Bed sheets', 8),
('50','Mattress covers', 8),
('51','Blankets', 8),
('52','Throw pillows', 8),

-- Books
('53','Biography', 9),
('54','Business & economics', 9),
('55','Comics', 9),
('56','Cookbooks', 9),
('57','Crime', 9),
('58','Fantasy', 9),
('59','Fiction', 9),
('60','Health & wellness', 9),
('61','History', 9),
('62','Mystery', 9),
('63','Science', 9),
('64','Sci-fi', 9),
('65','Self-help', 9),
('66','Romance', 9),
('67','Textbooks', 9),
('68','Thriller', 9),
('69','Travel', 9),

-- Building & Construction
('70','Construction Equipment', 10),
('71','Electrical Supplies', 10),
('72','Exterior Finishing', 10),
('73','Flooring Materials', 10),
('74','Hand Tools', 10),
('75','Heavy machinery', 10),
('76','HVAC', 10),
('77','Interior Finishing', 10),
('78','Jua Kali', 10),
('79','Paint Supplies', 10),
('80','Panels', 10),
('81','Planning & Design', 10),
('82','Plumbing', 10),
('83','Power Tools', 10),
('84','Roofing', 10),

-- Cameras & Photography
('85','Cameras', 11),
('86','Camera Accessories', 11),
('87','Lenses', 11),
('88','Sensors', 11),
('89','Tripods', 11),

-- Cleaning Supplies
('90','Brooms & Mops', 12),
('91','Cleaning Sprays', 12),
('92','Disinfectants', 12),
('93','Gloves', 12),
('94','Microfiber', 12),
('95','Sponges', 12),
('96','Trash Bags', 12),
('97','Vacuum Cleaners', 12),

-- Clothing
('98','Denims', 13),
('99','Dresses', 13),
('100','Hoodies', 13),
('101','Jackets', 13),
('102','Jeans', 13),
('103','Leggings', 13),
('104','Shirts', 13),
('105','Shorts', 13),
('106','Skirts', 13),
('107','Sweaters', 13),
('108','T-shirts', 13),
('109','Outerwear', 13),

-- Digital Art
('110','3D Models', 14),
('111','Digital Illustrations', 14),
('112','Digital Paintings', 14),
('113','Digital Sculpture', 14),
('114','Graphic Design', 14),
('115','Pixel Art', 14),
('116','Vector Graphics', 14),

-- DIY & Home Improvement
('117','Carpets & rags', 15),
('118','Insulation', 15),
('119','Hand Tools', 15),
('120','Paint & Wall Treatments', 15),
('121','Panels & materials', 15),
('122','Power Tools', 15),
('123','Lighting', 15),

-- Educational Supplies
('124','Art Supplies', 16),
('125','Early Learning Toys', 16),
('126','Learning Aids', 16),
('127','Science Kits', 16),
('128','Stationery', 16),
('129','Teacher Supplies', 16),

-- Electronics
('130','Desktop Computers', 17),
('131','Laptops', 17),
('132','Smartphones', 17),
('133','Tablets', 17),
('134','Wearables', 17),

-- Emergency
('135','First Aid Kits', 18),
('136','Safety Equipment', 18),
('137','Fire Safety', 18),
('138','Emergency Response Supplies', 18),

-- Fashion
('139','Men’s Fashion', 19),
('140','Women’s Fashion', 19),
('141','Kids’ Fashion', 19),

-- Flowers & Gifts
('142','Bouquets', 20),
('143','Gift Baskets', 20),
('144','Indoor Plants', 20),
('145','Seasonal Gifts', 20),

-- Food & Beverage
('146','Alcoholic Drinks', 21),
('147','Gourmet Snacks', 21),
('148','Organic Foods', 21),
('149','Soft Drinks', 21),
('150','Wine & Champagne', 21),

-- Footwear
('151','Casual Shoes', 22),
('152','Formal Shoes', 22),
('153','Sports Shoes', 22),
('154','Slippers & Sandals', 22),

-- Furniture
('155','Home Furniture', 23),
('156','Industrial Furniture', 23),
('157','Office Furniture', 23),
('158','Outdoor Furniture', 23),

-- Gaming
('159','Board Games', 24),
('160','Card Games', 24),
('161','Outdoor Games', 24),
('162','Video Games', 24),

-- Gardening
('163','Agricultural Supplies', 25),
('164','Farming Tools', 25),
('165','Garden Tools', 25),
('166','Outdoor Furniture', 25),
('167','Plants & Seeds', 25),
('168','Watering Equipment', 25),

-- Haircare
('169','Shampoos', 26),
('170','Conditioners', 26),
('171','Hair Oils', 26),
('172','Hair Styling Equipment', 26),

-- Health & Personal Care
('173','Skincare', 27),
('174','Bath & Body', 27),
('175','Dental Care', 27),
('176','Vitamins & Supplements', 27),

-- Home & Kitchen
('177','Kitchen Appliances', 28),
('178','Cookware & Bakeware', 28),
('179','Furniture', 28),
('180','Home Decor', 28),

-- Industrial Tools
('181','Welding Equipment', 29),
('182','Machinery', 29),
('183','Fasteners', 29),
('184','Safety Equipment', 29),

-- Labs
('185','Scientific Instruments', 30),
('186','Lab Supplies', 30),
('187','Lab Equipment', 30),
('188','Protective Gear', 30),

-- Landscaping
('189','Garden Tools', 31),
('190','Irrigation Supplies', 31),
('191','Landscaping Equipment', 31),
('192','Outdoor Decor', 31),

-- Lighting
('193','Ambient Lights', 32),
('194','Ceiling Lights', 32),
('195','Outdoor Lighting', 32),
('196','Smart Lighting', 32),
('197','Table Lamps', 32),

-- Luggage Handling
('198','Backpacks', 33),
('199','Luggage Tags & Locks', 33),
('200','Travel Accessories', 33),
('201','Suitcases', 33),

-- Martial Arts
('202','Protective Gear', 34),
('203','Training Equipment', 34),
('204','Uniforms', 34),

-- Outdoor & Adventure
('205','Camping Gear', 35),
('206','Fishing Gear', 35),
('207','Hiking Equipment', 35),
('208','Outdoor Clothing', 35),

-- Party Supplies
('209','Balloons', 36),
('210','Decorations', 36),
('211','Invitations', 36),
('212','Party Favors', 36),

-- Security
('213','CCTV Cameras', 37),
('214','Home Security Systems', 37),
('215','Locks & Safes', 37),
('216','Personal Safety', 37),

-- Smart Essentials
('217','Home Automation', 38),
('218','Smart Cameras', 38),
('219','Smart Speakers', 38),
('220','Smart Thermostats', 38),

-- Storage & Organization
('221','Bins & Baskets', 39),
('222','Cabinet Organizers', 39),
('223','Closet Organizers', 39),
('224','Shelving Units', 39),

-- Others
('225','Clearance', 40),
('226','Gift Cards', 40),
('227','Miscellaneous', 40),
('228','Limited Edition Items', 40);

ALTER TABLE products
ADD COLUMN images TEXT NOT NULL;

ALTER TABLE products
ADD COLUMN availability VARCHAR(20) NOT NULL;

ALTER TABLE products
ADD COLUMN pricestatus VARCHAR(30) NOT NULL AFTER price;

-- DROP TABLE orders;
CREATE TABLE orders
(
    -- Order Details
    orderID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

    -- Buyer Details
    buyerUID INT NOT NULL,
    fname VARCHAR(100) NOT NULL,
    lname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    phone INT NOT NULL,
    
    -- Product Details
    totalPrice INT NOT NULL,
    itemNames TEXT NOT NULL,
    itemQuantities TEXT NOT NULL,
    itemPrices TEXT NOT NULL,
    itemTotalPrices TEXT NOT NULL,

    -- Seller Details
    sellerUID TEXT NOT NULL,
    status VARCHAR(20) NOT NULL
);
