DROP DATABASE IF EXISTS score_board;
CREATE DATABASE score_board;

USE score_board;

CREATE TABLE genres (
    id INTEGER PRIMARY KEY,
    name VARCHAR(64) NOT NULL UNIQUE
);

CREATE TABLE problems (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    unique_name VARCHAR(32) NOT NULL UNIQUE,
    title VARCHAR(256) NOT NULL,
    genre_id INTEGER,
    point INTEGER,
    flag VARCHAR(256) NOT NULL,
    FOREIGN KEY (genre_id) REFERENCES genres (id)
);

INSERT INTO genres (id, name)
VALUES
    (1, 'Pactice'),
    (2, 'Web'),
    (3, 'Programming'),
    (4, 'Network/Forensic'),
    (5, 'Binary/Reversing'),
    (6, 'Misc')
;

INSERT INTO problems (unique_name, title, genre_id, point, flag)
VALUES
    ('welcome', 'Welcome to CTF for D', 1, 10, 'welcome2ctf4d'),
    ('flag_is_right_there', 'FLAG is right there!!', 2, 20, 'SaveTheSource')
;