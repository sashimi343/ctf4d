DROP DATABASE IF EXISTS sqli;
CREATE DATABASE sqli;

GRANT SELECT ON sqli.* TO sqli_user@'%' IDENTIFIED BY 'S9L1_P@ssw0rd' WITH GRANT OPTION;
FLUSH PRIVILEGES;

USE sqli;

CREATE TABLE users(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(32) NOT NULL UNIQUE,
    encrypted_password CHAR(64),
    name VARCHAR(64) NOT NULL
);

INSERT INTO users(user_id, encrypted_password, name) VALUES
    ('admin', SHA2('6gQxY-mj3V', 256), 'FLAG{S9L_1nj3ction_k0w@ii}'),
    ('user', SHA2('password', 256), 'test user'),
    ('test', SHA2('test', 256), 'test user')
;
