DROP DATABASE IF EXISTS research;
CREATE DATABASE research;
USE research; -- Select the "research" database

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    address TEXT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);


CREATE TABLE researchinfo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    research_title VARCHAR(255) NOT NULL,
    project_id INT NOT NULL,
    sponsor_agency VARCHAR(255) NOT NULL,
    principal_investigator VARCHAR(255) NOT NULL,
    sanctioned_amount DECIMAL(10, 2) NOT NULL,
    department VARCHAR(255) NOT NULL,
    co_investigator VARCHAR(255) NOT NULL,
    thrust_area VARCHAR(255) NOT NULL,
    address TEXT NOT NULL
);