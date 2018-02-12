DROP DATABASE IF EXISTS sqli_3;
CREATE DATABASE sqli_3;

GRANT SELECT, EXECUTE ON sqli_3.* TO sqli_3_user@'%' IDENTIFIED BY 'P4SS=4-5Q1_!' WITH GRANT OPTION;
FLUSH PRIVILEGES;

USE sqli_3;

CREATE FUNCTION encrypt_password(password VARCHAR(32))
    RETURNS CHAR(64) DETERMINISTIC
    RETURN SHA2(CONCAT('$@l7-', MD5(password)), 256)
;

CREATE TABLE users(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(32) NOT NULL UNIQUE,
    encrypted_password CHAR(64),
    name VARCHAR(64) NOT NULL
);

INSERT INTO users(user_id, encrypted_password, name) VALUES
    ('admin', encrypt_password('fV~gCv5DqP6gA3v4'), 'FLAG{F0rmat-5tr!n9_&_SQ|_i}'),
    ('user', encrypt_password('password'), 'test user'),
    ('test', encrypt_password('test'), 'test user')
;
