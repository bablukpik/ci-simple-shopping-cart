/* A customer is placing an order for buying a few products*/
CREATE TABLE `customers` (
  `id` int(11) primary key auto_increment,
  `name` varchar(20) NOT NULL,
  `email` varchar(80) NOT NULL,
  `address` varchar(80) NOT NULL,
  `phone` varchar(20) NOT NULL
);

CREATE TABLE `products` (
  `id` int(11) primary key auto_increment,
  `name` varchar(250) DEFAULT NULL,
  `unit_price` varchar(250) DEFAULT NULL,
  `total_unit` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL
);

CREATE TABLE `orders` (
  `id` int(11) primary key auto_increment,
  `productid` int(11) NOT NULL,
  `date` date NOT NULL,
  `customerid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  foreign key(customerid) references customers(id),
  foreign key(productid) references products(id)
);
