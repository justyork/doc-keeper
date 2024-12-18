CREATE DATABASE IF NOT EXISTS project;

USE project;
CREATE TABLE uploads (
     id INT AUTO_INCREMENT PRIMARY KEY,
     title VARCHAR(255) NOT NULL,
     description TEXT NOT NULL,
     datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
     author VARCHAR(100) NOT NULL,
     subject INT NOT NULL,
     subtopic INT NOT NULL,
     standard INT NOT NULL,
     resource_type INT NOT NULL,
     file_path VARCHAR(255),
     file_url VARCHAR(255),
     file_type ENUM('file', 'url') NOT NULL,
     CONSTRAINT chk_file_or_url CHECK (file_path IS NOT NULL OR file_url IS NOT NULL)
);


CREATE TABLE subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE subtopics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE standards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE resource_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

ALTER TABLE uploads
    ADD CONSTRAINT fk_subject FOREIGN KEY (subject) REFERENCES subjects(id),
    ADD CONSTRAINT fk_subtopic FOREIGN KEY (subtopic) REFERENCES subtopics(id),
    ADD CONSTRAINT fk_standard FOREIGN KEY (standard) REFERENCES standards(id),
    ADD CONSTRAINT fk_resource_type FOREIGN KEY (resource_type) REFERENCES resource_types(id);