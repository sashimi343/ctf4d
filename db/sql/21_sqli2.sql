DROP DATABASE IF EXISTS sqli_2;
CREATE DATABASE sqli_2;

GRANT SELECT ON sqli_2.* TO sqli_2_user@'%' IDENTIFIED BY 'Def@u1lPs+5qli' WITH GRANT OPTION;
FLUSH PRIVILEGES;

USE sqli_2;

CREATE TABLE users(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(32) NOT NULL UNIQUE,
    encrypted_password CHAR(64),
    name VARCHAR(64) NOT NULL
);

INSERT INTO users(user_id, encrypted_password, name) VALUES
    ('admin', SHA2('y2ntMEbY2suPVirV', 256), 'FLAG{B!@ck_Li5t_isn7_Perf3cT}'),
    ('user', SHA2('password', 256), 'test user'),
    ('test', SHA2('test', 256), 'test user')
;
