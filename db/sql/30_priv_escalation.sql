DROP DATABASE IF EXISTS priv_escalation;
CREATE DATABASE priv_escalation;

GRANT SELECT, INSERT ON priv_escalation.* TO peuser@'%' IDENTIFIED BY 'Ps4Priv>Esca1at!on' WITH GRANT OPTION;
FLUSH PRIVILEGES;

USE priv_escalation;

CREATE TABLE accounts(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(32) NOT NULL UNIQUE,
    encrypted_password CHAR(64) NOT NULL,
    name VARCHAR(64) NOT NULL,
    account_type CHAR(1) NOT NULL DEFAULT 'U',
    is_default TINYINT NOT NULL DEFAULT 0
);

CREATE TABLE posts(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    author_id INTEGER,
    author_name VARCHAR(64) NOT NULL,
    body TEXT,
    FOREIGN KEY (author_id) REFERENCES accounts(id)
);

INSERT INTO accounts(user_id, encrypted_password, name, account_type, is_default) VALUES
    ('admin', SHA2('uSWD%#8ZwfepT)fW', 256), 'Admin', 'A', 1),
    ('jabberwock', SHA2('mx22,kjJ4S$kNJ&3', 256), 'Jabberwock', 'A', 1),
    ('alice', SHA2('!.sU_b!-bV(F+Ah5)', 256), 'Alice', 'U', 1)
;

INSERT INTO posts(author_id, author_name, body) VALUES
    (1, 'Admin', 'CTFの息抜きに雑談ができる掲示板を作成しました。\n上のメニューからアカウントを作成後、書き込みが可能になります。\nフラグ自体やそのヒントの書き込みはお止めください。'),
    (2, 'Jabberwock＠力が欲しいか', 'この掲示板脆弱すぎワロスｗｗｗｗｗｗｗ誰でも管理者になれるぞｗｗｗｗｗｗｗｗｗｗ\nおまいらも試してみろｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗ'),
    (3, 'Alice', '>>2\n通報しますた')
;
