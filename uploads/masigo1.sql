
CREATE DATABASE masigo;

USE masigo;

DROP DATABASE masigo;

SHOW TABLES;

SELECT * FROM COMMENT;
SELECT * FROM USER;

SELECT * FROM POST;



-- 회원 정보를 저장하는 테이블
CREATE TABLE USER (
    idx INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(45) UNIQUE NOT NULL,
    username VARCHAR(255) NOT NULL,
    password_salt VARCHAR(255) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
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
    expiration_timestamp TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES USER(user_id)
);

-- 게시글 정보를 저장하는 테이블
CREATE TABLE POST (
    post_id INT PRIMARY KEY AUTO_INCREMENT,
    user_idx INT,
    parent_post_id INT,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    channel_id INT,
    is_notice TINYINT,
    views INT DEFAULT 0,
    delete_status TINYINT,
    FOREIGN KEY (user_id) REFERENCES USER(user_id),
    FOREIGN KEY (channel_id) REFERENCES CHANNEL(channel_id),
    FOREIGN KEY (parent_post_id) REFERENCES POST(post_id)
);

CREATE TABLE POST (
    post_id INT PRIMARY KEY AUTO_INCREMENT,
    user_idx INT, -- 이제 USER 테이블의 idx 컬럼을 참조
    parent_post_id INT,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    channel_id INT,
    is_notice TINYINT,
    views INT DEFAULT 0,
    delete_status TINYINT,
    FOREIGN KEY (user_idx) REFERENCES USER(idx), -- 수정된 외래 키 정의
    -- 다른 FOREIGN KEY 정의는 해당 CHANNEL 테이블과 관계 설정이 올바른지 확인해야 함
    FOREIGN KEY (parent_post_id) REFERENCES POST(post_id)
);

-- 이 쿼리는 USER 테이블에 데이터가 이미 존재한다고 가정합니다.
-- USER 테이블에 있는 idx 값을 사용하여 POST 테이블에 데이터를 넣습니다.
-- 여기서는 USER 테이블에 위의 쿼리로 데이터를 추가했다고 가정하고 1과 2를 idx 값으로 사용합니다.





-- 댓글 정보를 저장하는 테이블
CREATE TABLE COMMENT (
    comment_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    post_id INT,
    parent_comment_id INT,
    comment_content TEXT,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES USER(user_id),
    FOREIGN KEY (post_id) REFERENCES POST(post_id),
    FOREIGN KEY (parent_comment_id) REFERENCES COMMENT(comment_id)
);

CREATE TABLE COMMENT (
    comment_id INT PRIMARY KEY AUTO_INCREMENT,
    user_idx INT NOT NULL,
    post_id INT NOT NULL,
    parent_comment_id INT,
    comment_content TEXT NOT NULL,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_idx) REFERENCES USER(idx),
    FOREIGN KEY (post_id) REFERENCES POST(post_id),
    FOREIGN KEY (parent_comment_id) REFERENCES COMMENT(comment_id)
);
 ALTER TABLE COMMENT ADD CONSTRAINT fk_parent_comment FOREIGN KEY (parent_comment_id) REFERENCES COMMENT(comment_id);

-- 테스트
INSERT INTO USER (user_id, username, password_salt, password_hash, email, profile_image, introduction, user_type) VALUES
('user1', 'JaneDoe', 'randomsalt1', 'hashedpassword1', 'jane.doe@example.com', 'jane_profile.jpg', 'Hello, this is Jane.', 'normal'),
('user2', 'JohnSmith', 'randomsalt2', 'hashedpassword2', 'john.smith@example.com', 'john_profile.jpg', 'Hi, I am John.', 'admin');

INSERT INTO POST (user_idx, title, content, channel_id, is_notice, views, delete_status) VALUES
(1, 'First Post Title', 'Content of the first post.', 1, 0, 10, 0),
(2, 'Second Post Title', 'Content of the second post.', 1, 1, 20, 0);

INSERT INTO COMMENT (user_idx, post_id, comment_content) VALUES
(1, 1, 'This is a comment on the first post.'),
(2, 1, 'Another comment on the first post.'),
(1, 2, 'Commenting on the second post.');


-- Assuming the first two comments have IDs 1 and 2 respectively
INSERT INTO COMMENT (user_idx, post_id, parent_comment_id, comment_content) VALUES
(2, 1, 1, 'This is a nested reply to the first comment.');

INSERT INTO COMMENT (user_idx, post_id, parent_comment_id, comment_content)
VALUES
(사용자_idx, 2, 1, '여기에 대댓글 내용을 입력');

INSERT INTO COMMENT (user_idx, post_id, parent_comment_id, comment_content)
VALUES
(2, 2, 6, '이것은 원 댓글에 대한 대댓글입니다.');


-- 2번 글 작성한 user
SELECT u.*
FROM USER u
JOIN POST p ON u.idx = p.user_idx
WHERE p.post_id = 2;

SELECT u.*
FROM USER u
JOIN COMMENT c1 ON u.idx = c1.user_idx  -- 댓글의 작성자
JOIN COMMENT c2 ON c1.comment_id = c2.parent_comment_id -- 댓글의 댓글
WHERE c2.post_id = 2;


-- 채널 정보를 저장하는 테이블
CREATE TABLE CHANNEL (
    channel_id INT PRIMARY KEY AUTO_INCREMENT,
    channel_name VARCHAR(255) NOT NULL
);



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

CREATE TABLE UPLOADFILE (
    upload_file_id INT PRIMARY KEY AUTO_INCREMENT,
    post_id INT,
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    FOREIGN KEY (post_id) REFERENCES POST(post_id)
);
