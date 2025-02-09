CREATE DATABASE a3;

USE a3;

CREATE TABLE MEMBER (
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(id),
    regDate DATETIME NOT NULL,
    loginId CHAR(100) NOT NULL,
    loginPw CHAR(100) NOT NULL,
    nickname CHAR(100) NOT NULL
);

CREATE TABLE article (
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(id),
    regDate DATETIME NOT NULL,
    memberId INT(10) UNSIGNED NOT NULL,
`title``member``memberId``body`    BODY TEXT NOT NULL,
    writer CHAR(100) NOT NULL
);