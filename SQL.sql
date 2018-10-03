DROP DATABASE IF EXISTS WebShopDB;
CREATE DATABASE WebShopDB;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
	name VARCHAR(256) NOT NULL,
	hash TEXT NOT NULL,
	address TEXT NOT NULL,
	PRIMARY KEY(name)
);

DROP TABLE IF EXISTS products;
CREATE TABLE products (
	product_name VARCHAR(256) NOT NULL,
	price DOUBLE NOT NULL
);

DROP TABLE IF EXISTS loginattempts;
CREATE TABLE loginattempts (
	name VARCHAR(256) NOT NULL,
	attempts INT(11)
);

DROP TABLE IF EXISTS itemsincart;
CREATE TABLE itemsincart(
	product_name VARCHAR(256) NOT NULL,
	name VARCHAR(256) NOT NULL
);



INSERT INTO products 
	VALUES
		('lion', 399),
		('tiger', 599),
		('bird', 79),
		('giraffe', 899),
		('lemur', 129);
		
	
	