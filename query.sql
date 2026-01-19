 DROP DATABASE evimerce;

CREATE DATABASE evimerce;
USE evimerce;

ALTER DATABASE evimerce CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE users(
	id INT PRIMARY KEY NOT NULL UNIQUE AUTO_INCREMENT,
	username VARCHAR(30),
	password VARCHAR(60)
);

CREATE TABLE products (
	id INT PRIMARY KEY NOT NULL UNIQUE AUTO_INCREMENT,
    is_visible BOOLEAN DEFAULT TRUE,
    name VARCHAR(255) NOT NULL,
    price FLOAT NOT NULL DEFAULT 0,
    description TEXT, 
	short_description TEXT(300), 
    stock INT NOT NULL DEFAULT 0,
    on_sale BOOLEAN DEFAULT FALSE,
    sale_discound FLOAT DEFAULT 0,
    category INT
);

CREATE TABLE customers (
	id INT PRIMARY KEY NOT NULL UNIQUE AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    last_name VARCHAR(60),
    email VARCHAR(100) NOT NULL,
	dni VARCHAR(10),
    phone_number VARCHAR(12) NOT NULL,
    address VARCHAR(250) NOT NULL
);

CREATE TABLE orders (
	id INT PRIMARY KEY NOT NULL UNIQUE AUTO_INCREMENT,
    customer_id INT NOT NULL,
    order_date DATETIME NOT NULL DEFAULT NOW(),
    price INT NOT NULL  DEFAULT 0
);

ALTER TABLE products CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE products MODIFY name VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE products MODIFY description TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE products MODIFY short_description TEXT(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

INSERT INTO users (username, password) VALUES ("admin","st6rObYN0yR42");
INSERT INTO users (username, password) VALUES ("enrique","st16RxGjFMm8k");