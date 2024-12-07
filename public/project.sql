CREATE DATABASE portfolio_db

USE portfolio_db;

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image_url VARCHAR(255),
);

INSERT INTO `projects` (title, description, image_url) 
VALUES ('Project 1', 'This is a description for Project 1', 'assets/images/project1.jpg'), 
('Project 2', 'This is a description for Project 2', 'assets/images/project2.jpg');

CREATE DATABASE contact_msg

USE contact_msg

CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL);

CREATE DATABASE web_user

USE DATABASE web_user

CREATE TABLE profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE);
