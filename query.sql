DROP DATABASE evimerce;

CREATE DATABASE evimerce;
USE evimerce;

CREATE TABLE products (
	id INT PRIMARY KEY NOT NULL UNIQUE AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    price INT NOT NULL DEFAULT 0,
    description TEXT, 
    stock INT NOT NULL DEFAULT 0,
    category INT
);
