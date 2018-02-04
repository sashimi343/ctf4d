-- CTFのシステム運用上必要なDB
-- このDBだけはアタックされないようにする必要あり

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
    (1, 'Practice'),
    (2, 'Web'),
    (3, 'Programming'),
    (4, 'Network/Forensic'),
    (5, 'Binary/Reversing'),
    (6, 'Misc'),
    (7, 'Crypt')
;

INSERT INTO problems (unique_name, title, genre_id, point, flag)
VALUES
    ('welcome', 'Welcome to CTF for D', 1, 10, 'welcome2ctf4d'),
    ('flag_is_right_there', 'FLAG is right there!!', 2, 20, 'SaveTheSource'),
    ('base192', '定番の難読化', 7, 30, 'BASE=6666'),
    ('click_500', 'Click 500 times', 3, 50, 'var_JS=sugoi;'),
    ('then_fall_caesar', 'ブルータス、お前もか', 7, 50, 'SI-ZA-ANGO'),
    ('strings', '実行ファイルを解析してみよう', 5, 70, '$cmd_strings'),
    ('todays_snack', '今日のおやつは……', 2, 100, 'i_am_CookieM0nst3r!'),
    ('six_chars_world', '記号プログラミング入門', 3, 100, 'JSF*ck'),
    ('click_1000', 'Click 1,000 times', 3, 150, 'JS-is-awesome!XD'),
    ('call', 'call/my/name', 2, 200, '/REST/ful/API?')
;
