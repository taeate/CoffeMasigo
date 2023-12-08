SHOW DATABASES;

CREATE DATABASE article;

USE article;

SHOW TABLES;

CREATE TABLE crud (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(30) NOT NULL,
content TEXT NOT NULL
);

INSERT INTO `crud` (title, content) VALUES ("테스트데이터1", "테스트데이터2");


SELECT * FROM crud;

DROP DATABASE article;