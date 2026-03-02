DROP DATABASE IF EXISTS blogpp;

-- 1. izveidot datubāzi
CREATE DATABASE blogpp;

-- 2. izmantot datubāzi
USE blogpp;

-- 3. iezveidot tabulu
CREATE TABLE posts (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	content VARCHAR(1000) NOT NULL
);

-- 4. ielikt saturu post tabulā
INSERT INTO posts
(content)
VALUES
("Lieldienas tuvojas!"),
("Mākonis sver aptuveni miljons tonnu."),
("Vai ūdens ir slapjš?");

SELECT * FROM posts;