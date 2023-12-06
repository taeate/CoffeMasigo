USE masigo;

SELECT * FROM post;
SELECT * FROM ci_sessions;
SELECT * FROM USER;

DELETE * FROM post;
DROP TABLE post;

CREATE TABLE USER(
id INT AUTO_INCREMENT PRIMARY KEY,
user_id VARCHAR(45),
username VARCHAR(45),
password_hash VARCHAR(255),
email VARCHAR(45),
profile_image VARCHAR(45) NOT NULL,
create_date TIMESTAMP,
introducation TEXT
);


CREATE TABLE post(
post_id INT AUTO_INCREMENT PRIMARY KEY,
user_id VARCHAR(45),
parent_post_id INT
title VARCHAR(45),
content TEXT,
create_date TIMESTAMP,
update_date TIMESTAMP,
channel_id INT,
views INT,
delete_status BOOLEAN
);


INSERT INTO post (user_id, parent_post_id, title, content, create_date, update_date, channel_id, in_notice, views, delete_status) 
VALUES 
('user1', NULL, 'Post Title 1', 'Content of the first post.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 1, FALSE, 100, FALSE),
('user2', 1, 'Post Title 2', 'Content of the second post.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 2, TRUE, 150, FALSE),
('user3', NULL, 'Post Title 3', 'Content of the third post.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 3, FALSE, 200, FALSE),
('user4', 2, 'Post Title 4', 'Content of the fourth post.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 4, TRUE, 250, FALSE),
('user5', NULL, 'Post Title 5', 'Content of the fifth post.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 5, FALSE, 300, FALSE),
('user6', 3, 'Post Title 6', 'Content of the sixth post.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 1, FALSE, 350, FALSE),
('user7', NULL, 'Post Title 7', 'Content of the seventh post.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 2, TRUE, 400, FALSE),
('user8', 4, 'Post Title 8', 'Content of the eighth post.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 3, FALSE, 450, FALSE),
('user9', NULL, 'Post Title 9', 'Content of the ninth post.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 4, TRUE, 500, FALSE),
('user10', 5, 'Post Title 10', 'Content of the tenth post.', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 5, FALSE, 550, FALSE);





CREATE TABLE `ci_sessions` (
    `id` VARCHAR(128) NOT NULL,
    `ip_address` VARCHAR(45) NOT NULL,
    `timestamp` INT(10) UNSIGNED DEFAULT 0 NOT NULL,
    `data` BLOB NOT NULL,
    PRIMARY KEY (id),
    KEY `ci_sessions_timestamp` (`timestamp`)
);

CREATE TABLE `comment` (
  comment_id INT AUTO_INCREMENT PRIMARY KEY,
  parent_comment_id INT,
  post_id INT,
  user_id VARCHAR(45),
  comment_content TEXT,
  create_date TIMESTAMP,
  update_date TIMESTAMP,
  delete_status BOOLEAN
);


ALTER TABLE post
ADD FOREIGN KEY (user_id) REFERENCES USER(user_id);


ALTER TABLE COMMENT
ADD FOREIGN KEY (post_id) REFERENCES post(post_id);


ALTER TABLE COMMENT
ADD FOREIGN KEY (user_id) REFERENCES USER(user_id);

ALTER TABLE post
ADD FOREIGN KEY (parent_post_id) REFERENCES post(post_id);


ALTER TABLE COMMENT
ADD FOREIGN KEY (parent_comment_id) REFERENCES COMMENT(comment_id);


SHOW TABLES;

SELECT * FROM post;
SELECT * FROM ci_sessions;
SELECT * FROM USER;
SELECT * FROM COMMENT;
SELECT * FROM post WHERE delete_status = TRUE;



DELETE FROM post;
DELETE FROM ci_sessions;
DELETE FROM COMMENT;
