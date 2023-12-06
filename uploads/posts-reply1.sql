
CREATE DATABASE posts;

USE posts;

DROP DATABASE posts;

SHOW TABLES;

SELECT * FROM COMMENT;
SELECT * FROM USER;

SELECT * FROM post;



-- 회원 정보를 저장하는 테이블
CREATE TABLE USER (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    password_salt VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    profile_image VARCHAR(255),
    introduction TEXT,
    user_type ENUM('admin', 'normal') NOT NULL
);

ALTER TABLE USER
ADD CONSTRAINT unique_email UNIQUE (email);


CREATE TABLE SESSION (
    session_id VARCHAR(255) PRIMARY KEY,
    user_id INT,
    DATA TEXT,
    expiration_timestamp TIMESTAMP
);

-- 게시글 정보를 저장하는 테이블
CREATE TABLE POST (
    post_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    parent_post_id INT,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modification_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    channel_id INT,
    is_notice TINYINT,
    FOREIGN KEY (user_id) REFERENCES USER(user_id),
    FOREIGN KEY (channel_id) REFERENCES CHANNEL(channel_id),
    FOREIGN KEY (parent_post_id) REFERENCES POST(post_id)
);



ALTER TABLE POST
ADD FOREIGN KEY (user_id) REFERENCES USER(user_id);

ALTER TABLE POST
ADD FOREIGN KEY (channel_id) REFERENCES CHANNEL(channel_id);

ALTER TABLE POST
ADD FOREIGN KEY (parent_post_id) REFERENCES POST(post_id);

ALTER TABLE POST
ADD delete_status TINYINT(1) DEFAULT 0;


-- 댓글 정보를 저장하는 테이블
CREATE TABLE COMMENT (
    comment_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    post_id INT,
    parent_comment_id INT,
    comment_content TEXT,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modification_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES USER(user_id),
    FOREIGN KEY (post_id) REFERENCES POST(post_id),
    FOREIGN KEY (parent_comment_id) REFERENCES COMMENT(comment_id)
);


-- 댓글 정보를 저장하는 테이블
CREATE TABLE COMMENT (
    comment_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    post_id INT,
    comment_content TEXT,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modification_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES USER(user_id),
    FOREIGN KEY (post_id) REFERENCES POST(post_id)
);

-- 답글 정보를 저장하는 테이블
CREATE TABLE REPLY (
    reply_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    post_id INT,
    parent_comment_id INT,
    reply_content TEXT,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modification_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES USER(user_id),
    FOREIGN KEY (post_id) REFERENCES POST(post_id),
    FOREIGN KEY (parent_comment_id) REFERENCES COMMENT(comment_id)
);



ALTER TABLE COMMENT
ADD delete_status TINYINT(1) DEFAULT 0;

ALTER TABLE COMMENT
CHANGE COLUMN comment_text comment_content TEXT;



-- 채널 정보를 저장하는 테이블
CREATE TABLE CHANNEL (
    channel_id INT PRIMARY KEY AUTO_INCREMENT,
    channel_name VARCHAR(255) NOT NULL
);

-- channel_id 열에 인덱스 추가
CREATE INDEX idx_channel_id ON POST (channel_id);


-- 추천 및 좋아요 정보를 저장하는 테이블
CREATE TABLE LIKES (
    post_id INT PRIMARY KEY,
    likes INT DEFAULT 0,
    FOREIGN KEY (post_id) REFERENCES POST(post_id)
);

-- 글작성시 파일첨부 테이블
CREATE TABLE UPLOADFILE(
    upload_file_id INT PRIMARY KEY AUTO_INCREMENT,
    post_id INT,
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    FOREIGN KEY (post_id) REFERENCES POST(post_id)
);
