 DROP DATABASE evimerce;

CREATE DATABASE evimerce;
USE evimerce;

ALTER DATABASE evimerce CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE products (
	id INT PRIMARY KEY NOT NULL UNIQUE AUTO_INCREMENT,
    isVisible BOOLEAN DEFAULT TRUE,
    name VARCHAR(255) NOT NULL,
    price INT NOT NULL DEFAULT 0,
    description TEXT, 
	shortDescription TEXT(300), 
    stock INT NOT NULL DEFAULT 0,
    onSale BOOLEAN DEFAULT FALSE,
    saleDiscound FLOAT DEFAULT 0,
    category INT
);

ALTER TABLE products CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE products MODIFY name VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE products MODIFY description TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE products MODIFY shortDescription TEXT(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
