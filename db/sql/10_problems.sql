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
    ('flag_is_right_there', 'FLAG is "Right" there!!', 2, 20, 'SaveTheSource'),
    ('base192', '定番の難読化', 7, 30, 'BASE=6666'),
    ('http_header', 'Study HTTP', 2, 30, 'RFC2616_HTTP1.1'),
    ('click_500', 'Click 500 times', 3, 50, 'var_JS=sugoi;'),
    ('then_fall_caesar', 'ブルータス、お前もか', 7, 50, 'SI-ZA-ANGO'),
    ('13th_cipher', '13番目の暗号', 7, 70, 'consectetur'),
    ('riddle_game', '隠しページ探し', 2, 70, 'G00D-o1d+g@m3!'),
    ('strings', '実行ファイルを解析してみよう', 5, 70, '$cmd_strings'),
    ('todays_snack', '今日のおやつは……', 2, 100, 'i_am_CookieM0nst3r!'),
    ('sqli', 'SQL Injection', 2, 100, 'S9L_1nj3ction_k0w@ii'),
    ('six_chars_world', '記号プログラミング入門', 3, 100, 'JSF*ck'),
    ('click_1000', 'Click 1,000 times', 3, 150, 'JS-is-awesome!XD'),
    ('call', 'call/my/name', 2, 200, '/REST/ful/API?'),
    ('cpattack', 'Chosen-Plaintext Attack', 7, 200, '|/igen3re'),
    ('priv_escalation', 'Privilege Escalation', 2, 200, 'CWE-639_4uth0rizat1on-6ypa$$|ng'),
    ('sqli_reloaded', 'SQL Injection Reloaded', 2, 200, 'B!@ck_Li5t_isn7_Perf3cT'),
    ('sqli_revolutions', 'SQL Injection Revolutions', 2, 300, 'F0rmat-5tr!n9_&_SQ|_i')
;
