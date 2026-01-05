CREATE DATABASE uas_web;
USE uas_web;

CREATE TABLE books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100),
  author VARCHAR(100)
);

INSERT INTO books VALUES
(NULL,'Pemrograman Web','Anonim'),
(NULL,'PHP Dasar','Joant');
