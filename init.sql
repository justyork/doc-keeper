CREATE TABLE uploads
(
    id            INT AUTO_INCREMENT PRIMARY KEY,
    title         VARCHAR(255)         NOT NULL,
    email         VARCHAR(255)         NOT NULL,
    description   TEXT                 NOT NULL,
    datetime      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    author        VARCHAR(100)         NOT NULL,
    subject       INT                  NOT NULL,
    subtopic      INT                  NOT NULL,
    standard      INT                  NOT NULL,
    resource_type INT                  NOT NULL,
    file_path     VARCHAR(255),
    file_url      VARCHAR(255),
    file_type     ENUM ('file', 'url') NOT NULL,
    CONSTRAINT chk_file_or_url CHECK (file_path IS NOT NULL OR file_url IS NOT NULL)
);


CREATE TABLE subjects
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE subtopics
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(255) NOT NULL,
    subject_id INT          NOT NULL
);

ALTER TABLE subtopics
    ADD CONSTRAINT fk_subject_id FOREIGN KEY (subject_id) REFERENCES subjects (id);
CREATE TABLE standards
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(255) NOT NULL,
    subtopic_id INT          NOT NULL
);
ALTER TABLE standards
    ADD CONSTRAINT fk_subtopic_id FOREIGN KEY (subtopic_id) REFERENCES subtopics (id);

CREATE TABLE resource_types
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

ALTER TABLE uploads
    ADD CONSTRAINT fk_subject FOREIGN KEY (subject) REFERENCES subjects (id),
    ADD CONSTRAINT fk_subtopic FOREIGN KEY (subtopic) REFERENCES subtopics (id),
    ADD CONSTRAINT fk_standard FOREIGN KEY (standard) REFERENCES standards (id),
    ADD CONSTRAINT fk_resource_type FOREIGN KEY (resource_type) REFERENCES resource_types (id);


INSERT INTO subjects (name)
VALUES ('Math'),
       ('Science'),
       ('History');

INSERT INTO subtopics (name, subject_id)
VALUES ('Algebra', 1),
       ('Physics', 2),
       ('World Wars', 3);

INSERT INTO standards (name, subtopic_id)
VALUES ('Standard 1', 1),
       ('Standard 2', 2),
       ('Standard 3', 3);

INSERT INTO resource_types (name)
VALUES ('PDF'),
       ('Video'),
       ('Document');


