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

create Table Transactions
(
	transactionID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    userID INT NOT NULL,
    productID INT NOT NULL,
    purchaseDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    quantity INT NOT NULL,
    FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE,
    FOREIGN KEY (productID) REFERENCES Products(productID) ON DELETE CASCADE
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