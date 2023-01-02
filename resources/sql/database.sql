DROP SCHEMA IF EXISTS lbaw2294 CASCADE;
CREATE SCHEMA lbaw2294;
SET search_path TO lbaw2294;

DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS roles CASCADE;
DROP TABLE IF EXISTS posts CASCADE;
DROP TABLE IF EXISTS user_questions CASCADE;
DROP TABLE IF EXISTS reports CASCADE;
DROP TABLE IF EXISTS stars CASCADE;
DROP TABLE if EXISTS comments CASCADE;
DROP TABLE if EXISTS tags CASCADE;
DROP TABLE if EXISTS user_tags CASCADE;
DROP TABLE if EXISTS question_tags CASCADE;
DROP TABLE if EXISTS badges CASCADE;
DROP TABLE if EXISTS user_badges CASCADE;
DROP TABLE if EXISTS notifications CASCADE;
DROP TABLE if EXISTS new_answers CASCADE;
DROP TABLE if EXISTS new_questions CASCADE;
DROP TABLE if EXISTS new_comments CASCADE;
DROP TABLE if EXISTS new_badges CASCADE;
DROP TABLE if EXISTS new_stars CASCADE;
DROP TABLE if EXISTS contacts CASCADE;

DROP TYPE if EXISTS post_type CASCADE;
DROP TYPE if EXISTS user_role CASCADE;
DROP TYPE if EXISTS report_type CASCADE;

CREATE TYPE post_type AS ENUM ('question', 'answer');
CREATE TYPE user_role AS ENUM ('Moderator', 'Administrator');
CREATE TYPE report_type AS ENUM ('post', 'comment');

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    "name" VARCHAR,
    email VARCHAR UNIQUE NOT NULL,
    username VARCHAR UNIQUE NOT NULL,
    "password" VARCHAR NOT NULL,
    remember_token VARCHAR NOT NULL DEFAULT FALSE,
    birthday DATE NOT NULL,
    isDeleted BOOLEAN NOT NULL DEFAULT FALSE,
    isBlocked BOOLEAN NOT NULL DEFAULT FALSE,
    avatar TEXT NOT NULL DEFAULT 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD//gA7Q1JFQVRPUjogZ2QtanBlZyB2MS4wICh1c2luZyBJSkcgSlBFRyB2ODApLCBxdWFsaXR5ID0gOTAK/9sAQwADAgIDAgIDAwMDBAMDBAUIBQUEBAUKBwcGCAwKDAwLCgsLDQ4SEA0OEQ4LCxAWEBETFBUVFQwPFxgWFBgSFBUU/9sAQwEDBAQFBAUJBQUJFA0LDRQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQU/8AAEQgBLAEsAwERAAIRAQMRAf/EAB8AAAEFAQEBAQEBAAAAAAAAAAABAgMEBQYHCAkKC//EALUQAAIBAwMCBAMFBQQEAAABfQECAwAEEQUSITFBBhNRYQcicRQygZGhCCNCscEVUtHwJDNicoIJChYXGBkaJSYnKCkqNDU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6g4SFhoeIiYqSk5SVlpeYmZqio6Slpqeoqaqys7S1tre4ubrCw8TFxsfIycrS09TV1tfY2drh4uPk5ebn6Onq8fLz9PX29/j5+v/EAB8BAAMBAQEBAQEBAQEAAAAAAAABAgMEBQYHCAkKC//EALURAAIBAgQEAwQHBQQEAAECdwABAgMRBAUhMQYSQVEHYXETIjKBCBRCkaGxwQkjM1LwFWJy0QoWJDThJfEXGBkaJicoKSo1Njc4OTpDREVGR0hJSlNUVVZXWFlaY2RlZmdoaWpzdHV2d3h5eoKDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uLj5OXm5+jp6vLz9PX29/j5+v/aAAwDAQACEQMRAD8A/RCrICgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAhuruCyiMlxNHBH/AHpGCj9aAMC8+Imh2hIFy1ww7Qxk/qcCnZiujOf4r6aD8tpdsPUhR/7NT5WLmHxfFTSnOHguo/cop/8AZqXKw5jYsPGui6gQsd/Gjn+GbMZ/XAosx3RtKwZQQQQeQR3pDFoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgCK7u4bG3ee4lWGFBlnc4AoA888QfFCSQtDpKeWnT7RKMsfovb8fyFUo9yHLscNeX1xqExluZ5LiQ/xSMSaskgoAKACgAoA09I8Sajobg2ly6J3iY7kP8AwE0rXHex6N4b+ItpqzJb3oWyujwCT+7c+x7fQ/nUNFJnX0igoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgClrGr22h2L3V0+2NeAB1Y9gB60A3Y8c8SeKLvxJdb5j5cCn93Ap+Vff3PvWiVjNu5j0xBQAUAFABQAUAFABQB2/gvx6+nNHY6i5e0PypM3Ji9j6r/KpaKTPUFYOoZSGUjII6GoLFoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAjnnjtYJJpXCRRqWZj0AHU0AeLeLPEsviTUTJylrHlYYz2Hqfc1olYzbuYlMQUAFABQAUAFABQAUAFABQB6F8OPFhV10i7fKn/j3du3+x/h+XpUNdSk+h6NUlhQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFAHn3xR18xxx6VC2C4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A8O8T64/iHV5ro5EX3IlP8KDp/j+NaJWM27mVTEFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFAHpnww8Qm4tn0uZsvCN8JPdO4/A/z9qiSLi+h3lSUFABQAUAFABQAUAFABQByPxL1g6foYtUbEt22w/7g5b+g/GmtyZHktaEBQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAXdG1N9H1S2vI85icEgd16EfiMik9QPeIpUniSSNtyOoZWHcHkGszUfQAUAFABQAUAFABQAUAeR/Ey/N34kaEHKW0apj3PzE/qB+FXHYh7nJ1RIUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQB7L8PtQN/4Xtgxy8BMJ/Dp+hFZvc0Wx0dIYUAFABQAUAFABQAUAeEeJLj7T4g1KQnObhwPoGIH6CtFsZMzs0wDNABmgAzQAZoAM0AGaADNABmgAzQAZoAM0AGaADNABmgAzQAZoAM0AGaADNABmgAzQAZoAM0AGaADNABmgAzQB6V8JbgtZ6jBnhJEcD6gj/wBlFRIuJ31SUFABQAUAFABQAUAFACYHpQAYHoKADA9BQAYHoKADA9BQAYHoKADA9BQAYHoKADA9BQAYHoKADA9BQAYHoKADA9BQAYHoKADA9BQAYHoKADA9BQAYHoKADA9BQAYHoKADA9BQAYHoKADA9BQAYHoKADA9BQAYHoKADA9BQAYHoKADA9BQAuMUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFABQAUAFAH//Z'
);

CREATE TABLE roles (
    userID INTEGER NOT NULL REFERENCES "users" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    userRole user_role NOT NULL
);

CREATE TABLE posts (
    id SERIAL PRIMARY KEY,
    userID INTEGER NOT NULL REFERENCES "users" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    postDate DATE NOT NULL DEFAULT now(),
    postType post_type NOT NULL,
    title VARCHAR,
    postText VARCHAR NOT NULL,
    parentPost INTEGER REFERENCES "posts" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    isCorrect BOOLEAN,
    edited BOOLEAN NOT NULL DEFAULT FALSE,
    CONSTRAINT post_title CHECK ((postType = 'question' AND title IS NOT NULL) OR (postType = 'answer' AND title IS NULL)),
    CONSTRAINT correctness CHECK ((postType = 'question' AND isCorrect IS NULL) OR (postType = 'answer' AND isCorrect IS NOT NULL))
);

CREATE TABLE user_questions(
    userID INTEGER NOT NULL REFERENCES "users" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    postID INTEGER NOT NULL REFERENCES "posts" (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE stars (
    id SERIAL PRIMARY KEY,
    postID INTEGER NOT NULL REFERENCES "posts" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    userID INTEGER NOT NULL REFERENCES "users" (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE comments (
    id SERIAL PRIMARY KEY,
    postID INTEGER NOT NULL REFERENCES "posts" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    userID INTEGER NOT NULL REFERENCES "users" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    commentText VARCHAR NOT NULL,
    commentDate DATE NOT NULL DEFAULT now()
);

CREATE TABLE reports (
    id SERIAL PRIMARY KEY,
    reportType report_type NOT NULL,
    userID INTEGER REFERENCES "users" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    postID INTEGER REFERENCES "posts" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    commentID INTEGER REFERENCES "comments" (id) ON UPDATE CASCADE ON DELETE CASCADE
    CONSTRAINT post_report CHECK ((reportType = 'post' AND postID IS NOT NULL) OR (reportType = 'comment' AND postID IS NULL)),
    CONSTRAINT comment_report CHECK ((reportType = 'comment' AND commentID IS NOT NULL) OR (reportType = 'post' AND commentID IS NULL))
);

CREATE TABLE tags (
    id SERIAL PRIMARY KEY,
    tagName VARCHAR UNIQUE NOT NULL
);

CREATE TABLE user_tags (
    userID INTEGER NOT NULL REFERENCES "users" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    tagID INTEGER NOT NULL REFERENCES "tags" (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE question_tags (
    postID INTEGER NOT NULL REFERENCES "posts" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    tagID INTEGER NOT NULL REFERENCES "tags" (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE badges (
    id SERIAL PRIMARY KEY,
    badgeName VARCHAR UNIQUE NOT NULL
);

CREATE TABLE user_badges (
    userID INTEGER NOT NULL REFERENCES "users" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    badgeID INTEGER NOT NULL REFERENCES "badges" (id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- text will be defined in laravel code
CREATE TABLE notifications (
    id SERIAL PRIMARY KEY,
    userID INTEGER NOT NULL REFERENCES "users" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    isRead BOOLEAN NOT NULL,
    notificationDate DATE NOT NULL
);

CREATE TABLE new_answers (
    notificationID INTEGER NOT NULL REFERENCES "notifications" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    postID INTEGER NOT NULL REFERENCES "posts" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    questionID INTEGER NOT NULL REFERENCES "posts" (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE new_questions (
    notificationID INTEGER NOT NULL REFERENCES "notifications" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    postID INTEGER NOT NULL REFERENCES "posts" (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE new_comments (
    notificationID INTEGER NOT NULL REFERENCES "notifications" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    commentID INTEGER NOT NULL REFERENCES "comments" (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE new_badges (
    notificationID INTEGER NOT NULL REFERENCES "notifications" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    badgeID INTEGER NOT NULL REFERENCES "badges" (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE new_stars (
    notificationID INTEGER NOT NULL REFERENCES "notifications" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    postID INTEGER NOT NULL REFERENCES "posts" (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE contacts (
    id SERIAL PRIMARY KEY,
    "name" VARCHAR NOT NULL,
    email VARCHAR NOT NULL,
    "message" TEXT NOT NULL
);

-- TRIGGERS

DROP FUNCTION IF EXISTS add_answer_notification CASCADE;
DROP FUNCTION IF EXISTS add_question_notification CASCADE;
DROP FUNCTION IF EXISTS add_comment_notification CASCADE;
DROP FUNCTION IF EXISTS add_star_notification CASCADE;

-- ANSWER NOTIFICATIONS
CREATE FUNCTION add_answer_notification() RETURNS TRIGGER AS
$BODY$
DECLARE
    notified_user INTEGER;
BEGIN
    IF NEW.postType = 'question' THEN
        INSERT INTO user_questions (userid, postid)
        VALUES (NEW.userid, NEW.id);
    END IF;
    IF NEW.postType = 'answer' THEN
        FOR notified_user IN SELECT DISTINCT userid FROM user_questions WHERE postid = NEW.parentPost AND userid != NEW.userid
        LOOP
            WITH inserted AS (
                INSERT INTO notifications (userID, isRead, notificationDate)
                VALUES (notified_user, FALSE, CURRENT_TIMESTAMP)
                RETURNING id
            ) INSERT INTO new_answers(notificationid, postid, questionid) SELECT inserted.id, NEW.id, NEW.parentPost FROM inserted;
        END LOOP;
    END IF;
    RETURN NULL;
END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER answer_trigger
    AFTER INSERT ON posts
    FOR EACH ROW
    EXECUTE PROCEDURE add_answer_notification();

-- POST EDITED
CREATE FUNCTION set_post_edited() RETURNS TRIGGER AS
$BODY$
DECLARE notified_user INTEGER;
BEGIN
    NEW.edited = TRUE;
    RETURN NEW;
END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER post_edited_trigger
    BEFORE UPDATE ON posts
    FOR EACH ROW
    EXECUTE PROCEDURE set_post_edited();

-- QUESTION TAG NOTIFICATIONS
CREATE OR REPLACE FUNCTION add_question_notification() RETURNS TRIGGER AS
$BODY$
DECLARE
    post_owner INTEGER;
    notified_user INTEGER;
BEGIN
    SELECT userid INTO post_owner FROM posts WHERE id = NEW.postid LIMIT 1;
	
	FOR notified_user IN SELECT DISTINCT userid
		FROM user_tags
		WHERE userid != post_owner AND tagid = NEW.tagid
	LOOP
		-- notified_user
		-- NEW.postid
		-- get if there is any notification already
		-- select do notification para ter o userid e do new_question para saber o postid
		IF NOT EXISTS(SELECT FROM new_questions LEFT JOIN notifications ON notificationid = id WHERE postid = NEW.postid AND userid = notified_user LIMIT 1)
		THEN
			WITH inserted AS (
				INSERT INTO notifications (userID, isRead, notificationDate)
            		VALUES (notified_user, FALSE, CURRENT_TIMESTAMP)
            		RETURNING id
			) INSERT INTO new_questions(notificationID, postID) SELECT inserted.id, NEW.postID FROM inserted;
		END IF;
	END LOOP;
	RETURN NULL;
END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER add_question_notification
    AFTER INSERT OR UPDATE ON question_tags
    FOR EACH ROW
    EXECUTE PROCEDURE add_question_notification();

-- COMMENT NOTIFICATIONS
CREATE OR REPLACE FUNCTION add_comment_notification() RETURNS TRIGGER AS
$BODY$
BEGIN
    WITH inserted AS (
        INSERT INTO notifications (userID, isRead, notificationDate)
        VALUES (NEW.userID, FALSE, CURRENT_TIMESTAMP)
        RETURNING id
    )
    INSERT INTO new_comments SELECT inserted.id, NEW.id FROM inserted;
    RETURN NEW;
END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER add_comment_notification
    AFTER INSERT OR UPDATE ON comments
    FOR EACH ROW
    EXECUTE PROCEDURE add_comment_notification();

-- STAR NOTIFICATIONS
CREATE OR REPLACE FUNCTION add_star_notification() RETURNS TRIGGER AS
$BODY$
DECLARE notified_user INTEGER;
BEGIN
    SELECT userID INTO notified_user FROM posts WHERE NEW.postID = posts.id;
    WITH inserted AS (
        INSERT INTO notifications (userID, isRead, notificationDate)
        VALUES (notified_user, FALSE, CURRENT_TIMESTAMP)
        RETURNING id
    )
    INSERT INTO new_stars SELECT inserted.id, NEW.postID FROM inserted;
    RETURN NEW;
END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER add_star_notification
    AFTER INSERT OR UPDATE ON stars
    FOR EACH ROW
    EXECUTE PROCEDURE add_star_notification();

-- PERFORMANCE INDEXES

-- TAGS
CREATE INDEX search_tags ON tags USING hash(tagName);

-- FTS INDEXES

DROP INDEX IF EXISTS search_user;
DROP INDEX IF EXISTS search_post;
DROP INDEX IF EXISTS search_comment;

-- USER SEARCH
ALTER TABLE users
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION user_search_update() RETURNS TRIGGER AS $$
BEGIN
    NEW.tsvectors = (
        (setweight(to_tsvector('english', NEW.name), 'A')) ||
        (setweight(to_tsvector('english', NEW.username), 'B'))
    );
    RETURN NEW;
END $$
LANGUAGE plpgsql;

CREATE TRIGGER user_search_update
    BEFORE INSERT OR UPDATE ON users
    FOR EACH ROW
    EXECUTE PROCEDURE user_search_update();

CREATE INDEX search_user ON users USING GIN (tsvectors);

-- POST SEARCH
ALTER TABLE posts
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION post_search_update() RETURNS TRIGGER AS $$
DECLARE usernameAux VARCHAR;
BEGIN
    SELECT username INTO usernameAux FROM users
    WHERE NEW.userID = users.id;

    IF (NEW.postType = 'question') THEN
        NEW.tsvectors = (
            (setweight(to_tsvector('english', NEW.title), 'A')) ||
            (setweight(to_tsvector('english', NEW.postText), 'A')) ||
            (setweight(to_tsvector('english', usernameAux), 'B'))
        );
    END IF;
    IF (NEW.postType = 'answer') THEN
        NEW.tsvectors = (
            (setweight(to_tsvector('english', NEW.postText), 'A')) ||
            (setweight(to_tsvector('english', usernameAux), 'B'))
        );
    END IF;
    RETURN NEW;
END $$
LANGUAGE plpgsql;

CREATE TRIGGER post_search_update
    BEFORE INSERT OR UPDATE ON posts
    FOR EACH ROW
    EXECUTE PROCEDURE post_search_update();

CREATE INDEX search_post ON posts USING GIN (tsvectors);

-- COMMENT SEARCH
ALTER TABLE comments
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION comment_search_update() RETURNS TRIGGER AS $$
BEGIN
    NEW.tsvectors = ((setweight(to_tsvector('english', NEW.commentText), 'A')));
    RETURN NEW;
END $$
LANGUAGE plpgsql;

CREATE TRIGGER comment_search_update
    BEFORE INSERT OR UPDATE ON comments
    FOR EACH ROW
    EXECUTE PROCEDURE comment_search_update();

CREATE INDEX search_comment ON comments USING GIN (tsvectors);

-- TRANSACTIONS
DROP FUNCTION IF EXISTS show_own_questions(INTEGER) CASCADE;
DROP FUNCTION IF EXISTS show_own_answers(INTEGER) CASCADE;
DROP FUNCTION IF EXISTS show_own_comments(INTEGER) CASCADE;
DROP FUNCTION IF EXISTS show_badges(INTEGER) CASCADE;
DROP FUNCTION IF EXISTS show_tags(INTEGER) CASCADE;
DROP FUNCTION IF EXISTS show_top_questions(INTEGER) CASCADE;
DROP FUNCTION IF EXISTS show_all_questions(INTEGER) CASCADE;
DROP FUNCTION IF EXISTS insert_question(INTEGER, VARCHAR, VARCHAR, post_type) CASCADE;
DROP FUNCTION IF EXISTS insert_answer(INTEGER, VARCHAR, INTEGER, BOOLEAN, post_type) CASCADE;
DROP FUNCTION IF EXISTS insert_comment(INTEGER, INTEGER, VARCHAR) CASCADE;


-- SEE OWN QUESTIONS
CREATE OR REPLACE FUNCTION show_own_questions(ui INTEGER) RETURNS INTEGER AS $$
    BEGIN
        SET TRANSACTION ISOLATION LEVEL SERIALIZABLE READ ONLY;
        SELECT posts.id, posts.postDate, posts.title, posts.postText, COUNT(stars)
        FROM posts
        INNER JOIN users ON posts.userID = users.id
        INNER JOIN stars ON posts.id = stars.postID
        WHERE posts.postType = 'question' AND users.id = ui
        ORDER BY posts.postDate;
    END $$
LANGUAGE plpgsql;

-- SEE OWN ANSWERS
CREATE OR REPLACE FUNCTION show_own_answers(ui INTEGER) RETURNS INTEGER AS $$
    BEGIN
        SET TRANSACTION ISOLATION LEVEL SERIALIZABLE READ ONLY;
        SELECT posts.id, posts.postDate, posts.parentPost, posts.postText, COUNT(stars), posts.isCorrect
        FROM posts
        INNER JOIN users ON posts.userID = users.id
        INNER JOIN stars ON posts.id = stars.postID
        WHERE posts.postType = 'answer' AND users.id = ui
        ORDER BY posts.postDate;
    END $$
LANGUAGE plpgsql;

-- SEE OWN COMMENTS
CREATE OR REPLACE FUNCTION show_own_comments(ui INTEGER) RETURNS INTEGER AS $$
    BEGIN
        SET TRANSACTION ISOLATION LEVEL SERIALIZABLE READ ONLY;
        SELECT comments.id, comments.commentDate, comments.commentText, comments.postID
        FROM comments
        INNER JOIN users ON comments.userID = users.id
        WHERE users.id = ui
        ORDER BY comments.commentDate;
    END $$
LANGUAGE plpgsql;

-- SEE OWN BADGES
CREATE OR REPLACE FUNCTION show_badges(ui INTEGER) RETURNS INTEGER AS $$
    BEGIN
        SET TRANSACTION ISOLATION LEVEL SERIALIZABLE READ ONLY;
        SELECT badges.*
        FROM badges
        INNER JOIN user_badges ON user_badges.badgeID = badges.id
        WHERE user_badges.userID = ui
        ORDER BY badges.id;
    END $$
LANGUAGE plpgsql;

-- SEE OWN TAGS
CREATE OR REPLACE FUNCTION show_tags(ui INTEGER) RETURNS INTEGER AS $$
    BEGIN
        SET TRANSACTION ISOLATION LEVEL SERIALIZABLE READ ONLY;
        SELECT tags.*
        FROM tags
        INNER JOIN user_tags ON user_tags.tagID = tags.id
        WHERE user_tags.userID = ui
        ORDER BY tags.id;
    END $$
LANGUAGE plpgsql;

-- SEE TOP QUESTIONS
CREATE OR REPLACE FUNCTION show_top_questions() RETURNS INTEGER AS $$
    BEGIN
        SET TRANSACTION ISOLATION LEVEL SERIALIZABLE READ ONLY;
        SELECT posts.id, posts.postDate, posts.title, posts.postText, COUNT(stars)
        FROM posts
        INNER JOIN users ON posts.userID = users.id
        INNER JOIN stars ON posts.id = stars.postID
        WHERE posts.postType = 'question'
        ORDER BY COUNT(stars)
        LIMIT 50;
    END $$
LANGUAGE plpgsql;

-- SEE ALL QUESTIONS
CREATE OR REPLACE FUNCTION show_all_questions() RETURNS INTEGER AS $$
    BEGIN
        SET TRANSACTION ISOLATION LEVEL SERIALIZABLE READ ONLY;
        SELECT posts.id, posts.postDate, posts.title, posts.postText, COUNT(stars)
        FROM posts
        INNER JOIN users ON posts.userID = users.id
        INNER JOIN stars ON posts.id = stars.postID
        WHERE posts.postType = 'question'
        ORDER BY posts.postDate;
    END $$
LANGUAGE plpgsql;

-- INSERT A QUESTION
CREATE OR REPLACE FUNCTION insert_question(ui INTEGER, ptitle VARCHAR, ptext VARCHAR, ptype post_type) RETURNS INTEGER AS $$
    BEGIN
        SET TRANSACTION ISOLATION LEVEL REPEATABLE READ;
        IF (pType = 'question') THEN
          INSERT INTO posts (userID, title, postText)
          VALUES (ui, ptitle, ptext);
        END IF;
    END $$
LANGUAGE plpgsql;

-- INSERT AN ANSWER
CREATE OR REPLACE FUNCTION insert_answer(ui INTEGER, ptext VARCHAR, pparent INTEGER, correct BOOLEAN, ptype post_type) RETURNS INTEGER AS $$
    BEGIN
        SET TRANSACTION ISOLATION LEVEL REPEATABLE READ;
        IF (ptype = 'answer') THEN
          INSERT INTO posts (userID, postText, parentPost, isCorrect)
          VALUES (ui, ptext, pparent, correct);
        END IF;
    END $$
LANGUAGE plpgsql;

-- INSERT A COMMENT
CREATE OR REPLACE FUNCTION insert_comment(pi INTEGER, ui INTEGER, ctext VARCHAR) RETURNS INTEGER AS $$
    BEGIN
        SET TRANSACTION ISOLATION LEVEL REPEATABLE READ;
        INSERT INTO comments (postID, userID, commentText)
        VALUES (pi, ui, ctext);
    END $$
LANGUAGE plpgsql;

-- POPULATION
-- Super User
INSERT INTO users(name, email, username, password, birthday) VALUES ('John Doe','admin@example.com','johndoe','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','2003-02-26 09:06:47');
INSERT INTO roles(userID, userRole) VALUES (1,'Administrator');
INSERT INTO roles(userID, userRole) VALUES (1,'Moderator');

--Administrators
INSERT INTO users(name, email, username, password, birthday) VALUES ('Deena Buckley','deena_buckley@example.com','DeenaBuckley','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','07/07/93');
INSERT INTO roles(userID, userRole) VALUES (2,'Administrator');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Pattie Perkins','pattie_perkins@example.com','PattiePerkins','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','03/01/99');
INSERT INTO roles(userID, userRole) VALUES (3,'Administrator');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Susannah Griffith','susannah_griffith@example.com','SusannahGriffith','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','02/03/02');
INSERT INTO roles(userID, userRole) VALUES (4,'Administrator');

--Moderators
INSERT INTO users(name, email, username, password, birthday) VALUES ('Anaya Salas','anaya_salas@example.com','AnayaSalas','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','04/03/94');
INSERT INTO roles(userID, userRole) VALUES (5,'Moderator');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Tallulah Hayes','tallulah_hayes@example.com','TallulahHayes','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','03/12/84');
INSERT INTO roles(userID, userRole) VALUES (6,'Moderator');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Leyton Harding','leyton_harding@example.com','LeytonHarding','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','08/08/92');
INSERT INTO roles(userID, userRole) VALUES (7,'Moderator');

--Generic User
INSERT INTO users(name, email, username, password, birthday) VALUES ('Jonah Kaufman','jonah_kaufman@example.com','JonahKaufman','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','10/13/93');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Poppie Bartlett','poppie_bartlett@example.com','PoppieBartlett','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','09/14/85');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Natalia Wheeler','natalia_wheeler@example.com','NataliaWheeler','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','06/17/99');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Carl Nelson','carl_nelson@example.com','CarlNelson','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','12/28/07');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Ruth Bates','ruth_bates@example.com','RuthBates','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','05/09/87');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Robbie Mcintosh','robbie_mcintosh@example.com','RobbieMcintosh','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','02/27/86');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Annabelle Andersen','annabelle_andersen@example.com','AnnabelleAndersen','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','04/01/03');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Angel Warren','angel_warren@example.com','AngelWarren','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','11/27/92');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Diego King','diego_king@example.com','DiegoKing','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','09/03/89');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Richard Barrett','richard_barrett@example.com','RichardBarrett','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','09/14/96');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Katie Calhoun','katie_calhoun@example.com','KatieCalhoun','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','06/11/93');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Hugo Serrano','hugo_serrano@example.com','HugpSerrano','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','10/11/09');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Isacco Pyott', 'ipyott0@example.com', 'ipyott0', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', '08/05/97');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Brad Surby', 'bsurby1@example.com', 'bsurby1', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', '03/25/94');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Chrissie Leif', 'cleif2@example.com', 'cleif2', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', '02/18/95');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Pete Weston', 'pweston3@example.com', 'pweston3', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', '06/02/96');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Kennie Remon', 'kremon4@example.com', 'kremon4', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', '09/15/94');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Charlene Blazynski', 'cblazynski5@example.com', 'cblazynski5', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', '09/29/99');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Annabal Chaffey', 'achaffey6@example.com', 'achaffey6', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', '05/08/90');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Julie Swainston', 'jswainston7@example.com', 'jswainston7', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', '02/08/86');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Omar Bangs', 'obangs8@example.com', 'obangs8', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', '07/25/88');
INSERT INTO users(name, email, username, password, birthday) VALUES ('Lauraine Bushell', 'lbushell9@example.com', 'lbushell9', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', '01/20/94');
--22

--questions
--1
INSERT INTO posts (userID, postType, title, postText) VALUES (1, 'question', 'Dialogue', 'How do you write dialogue?');
INSERT INTO user_questions (userID, postID) VALUES (1,1);
INSERT INTO user_questions (userID, postID) VALUES (8,1);
INSERT INTO user_questions (userID, postID) VALUES (22,1);
--2
INSERT INTO posts (userID, postType, title, postText) VALUES (5, 'question', 'Rabbits', 'How many types of rabbit are there?');
INSERT INTO user_questions (userID, postID) VALUES (5,2); 
INSERT INTO user_questions (userID, postID) VALUES (25,2);
INSERT INTO user_questions (userID, postID) VALUES (10,2);  
--3
INSERT INTO posts (userID, postType, title, postText) VALUES (10, 'question', 'Latin', 'How do you write the verb to be in latin?');
INSERT INTO user_questions (userID, postID) VALUES (10,3);
INSERT INTO user_questions (userID, postID) VALUES (7,3);
INSERT INTO user_questions (userID, postID) VALUES (19,3);
--4
INSERT INTO posts (userID, postType, title, postText) VALUES (6, 'question', 'Photography', 'Are there any good places to take photos in Porto?');
INSERT INTO user_questions (userID, postID) VALUES (6,4);
INSERT INTO user_questions (userID, postID) VALUES (17,4);
INSERT INTO user_questions (userID, postID) VALUES (28,4);
--5
INSERT INTO posts (userID, postType, title, postText) VALUES (5, 'question', 'Day of independence', 'When is the portuguese day of independence?');
INSERT INTO user_questions (userID, postID) VALUES (5,5);
INSERT INTO user_questions (userID, postID) VALUES (24,5);
INSERT INTO user_questions (userID, postID) VALUES (20,5);
--6
INSERT INTO posts (userID, postType, title, postText) VALUES (7, 'question', 'Colombian arepas', 'I cannot seem to make arepas right any time. The cheese always overflows! Does anyone know what I am doing wrong?');
INSERT INTO user_questions (userID, postID) VALUES (7,6);
INSERT INTO user_questions (userID, postID) VALUES (26,6);
INSERT INTO user_questions (userID, postID) VALUES (16,6);
--7
INSERT INTO posts (userID, postType, title, postText) VALUES (8, 'question', 'Importing in javascript', 'How do you import another document in a javascript file?');
INSERT INTO user_questions (userID, postID) VALUES (8,7);
INSERT INTO user_questions (userID, postID) VALUES (10,7);
INSERT INTO user_questions (userID, postID) VALUES (18,7);
--8
INSERT INTO posts (userID, postType, title, postText) VALUES (2, 'question', 'Plants', 'What are the benefits of having plants in your home?');
INSERT INTO user_questions (userID, postID) VALUES (2,8);
--9
INSERT INTO posts (userID, postType, title, postText) VALUES (3, 'question', 'Cooking', 'What are some easy recipes for a beginner cook?');
INSERT INTO user_questions (userID, postID) VALUES (3,9); 
--10
INSERT INTO posts (userID, postType, title, postText) VALUES (4, 'question', 'Exercise', 'What are some good exercises to do at home without any equipment?');
INSERT INTO user_questions (userID, postID) VALUES (4,10); 
--11
INSERT INTO posts (userID, postType, title, postText) VALUES (7, 'question', 'Investing', 'What are some good strategies for beginner investors?');
INSERT INTO user_questions (userID, postID) VALUES (7,11); 
--12
INSERT INTO posts (userID, postType, title, postText) VALUES (8, 'question', 'Career advice', 'What are some tips for networking and finding a job in a new industry?');
INSERT INTO user_questions (userID, postID) VALUES (8,12); 
--13
INSERT INTO posts (userID, postType, title, postText) VALUES (2, 'question', 'Gardening', 'What are some good plants to grow in containers?');
INSERT INTO user_questions (userID, postID) VALUES (2,13); 
--14
INSERT INTO posts (userID, postType, title, postText) VALUES (3, 'question', 'DIY', 'What are some easy DIY home improvement projects?');
INSERT INTO user_questions (userID, postID) VALUES (3,14); 
--15
INSERT INTO posts (userID, postType, title, postText) VALUES (4, 'question', 'Travel', 'What are some must-see destinations in Europe?');
INSERT INTO user_questions (userID, postID) VALUES (4,15); 
--16
INSERT INTO posts (userID, postType, title, postText) VALUES (5, 'question', 'Finance', 'What are some good tips for saving money?');
INSERT INTO user_questions (userID, postID) VALUES (5,16); 
--17
INSERT INTO posts (userID, postType, title, postText) VALUES (6, 'question', 'Career development', 'What are some good ways to improve your skills and advance in your career?');
INSERT INTO user_questions (userID, postID) VALUES (6,17); 
--18
INSERT INTO posts (userID, postType, title, postText) VALUES (7, 'question', 'Technology', 'What are some good resources for learning about new technologies?');
INSERT INTO user_questions (userID, postID) VALUES (7,17); 
--19
INSERT INTO posts (userID, postType, title, postText) VALUES (8, 'question', 'Parenting', 'What are some good strategies for balancing work and family life?');
INSERT INTO user_questions (userID, postID) VALUES (8,19); 
--20
INSERT INTO posts (userID, postType, title, postText) VALUES (2, 'question', 'Personal growth', 'What are some good ways to set and achieve personal goals?');
INSERT INTO user_questions (userID, postID) VALUES (2,20); 
--21
INSERT INTO posts (userID, postType, title, postText) VALUES (3, 'question', 'Photography', 'What are some good tips for taking better photos?');
INSERT INTO user_questions (userID, postID) VALUES (3,21);
--22
INSERT INTO posts (userID, postType, title, postText) VALUES (4, 'question', 'Fashion', 'What are some good tips for building a versatile and stylish wardrobe?');
INSERT INTO user_questions (userID, postID) VALUES (4,22);
INSERT INTO user_questions (userID, postID) VALUES (27,22);
INSERT INTO user_questions (userID, postID) VALUES (15,22);
--23
INSERT INTO posts (userID, postType, title, postText) VALUES (5, 'question', 'Food', 'What are some good healthy eating habits to adopt?');
INSERT INTO user_questions (userID, postID) VALUES (5,23);
INSERT INTO user_questions (userID, postID) VALUES (19,23);
INSERT INTO user_questions (userID, postID) VALUES (27,23);
--24
INSERT INTO posts (userID, postType, title, postText) VALUES (6, 'question', 'Music', 'What are some good tips for learning to play an instrument?');
INSERT INTO user_questions (userID, postID) VALUES (6,24);
--25
INSERT INTO posts (userID, postType, title, postText) VALUES (7, 'question', 'Writing', 'What are some good tips for improving your writing skills?');
INSERT INTO user_questions (userID, postID) VALUES (7,25); 
--26
INSERT INTO posts (userID, postType, title, postText) VALUES (8, 'question', 'Art', 'What are some good tips for improving your drawing skills?');
INSERT INTO user_questions (userID, postID) VALUES (8,26); 
--27
INSERT INTO posts (userID, postType, title, postText) VALUES (2, 'question', 'Sports', 'What are some good tips for improving your physical fitness?');
INSERT INTO user_questions (userID, postID) VALUES (2,27); 
--28
INSERT INTO posts (userID, postType, title, postText) VALUES (3, 'question', 'Pet care', 'What are some good tips for taking care of a new pet?');
INSERT INTO user_questions (userID, postID) VALUES (3,28); 
--29
INSERT INTO posts (userID, postType, title, postText) VALUES (4, 'question', 'Nature', 'What are some good ways to appreciate and protect the natural world?');
INSERT INTO user_questions (userID, postID) VALUES (4,29);
INSERT INTO user_questions (userID, postID) VALUES (7,29);
INSERT INTO user_questions (userID, postID) VALUES (11,29);
--30
INSERT INTO posts (userID, postType, title, postText) VALUES (5, 'question', 'Travel', 'What are some good tips for budget travel?');
INSERT INTO user_questions (userID, postID) VALUES (5,30);
--31
INSERT INTO posts (userID, postType, title, postText) VALUES (6, 'question', 'Home organization', 'What are some good strategies for keeping your home organized and clutter-free?');
INSERT INTO user_questions (userID, postID) VALUES (6,31);
--32
INSERT INTO posts (userID, postType, title, postText) VALUES (7, 'question', 'Gardening', 'What are some good tips for starting a vegetable garden?');
INSERT INTO user_questions (userID, postID) VALUES (7,32);
INSERT INTO user_questions (userID, postID) VALUES (19,32);
INSERT INTO user_questions (userID, postID) VALUES (26,32);
--33
INSERT INTO posts (userID, postType, title, postText) VALUES (8, 'question', 'Cooking', 'What are some good tips for cooking healthy meals?');
INSERT INTO user_questions (userID, postID) VALUES (8,33);
INSERT INTO user_questions (userID, postID) VALUES (23,33);
INSERT INTO user_questions (userID, postID) VALUES (26,33);
--34
INSERT INTO posts (userID, postType, title, postText) VALUES (2, 'question', 'Finance', 'What are some good strategies for saving for retirement?');
INSERT INTO user_questions (userID, postID) VALUES (2,34);
--35
INSERT INTO posts (userID, postType, title, postText) VALUES (3, 'question', 'Technology', 'What are some good tips for staying safe online?');
INSERT INTO user_questions (userID, postID) VALUES (3,35);
--36
INSERT INTO posts (userID, postType, title, postText) VALUES (4, 'question', 'Parenting', 'What are some good strategies for disciplining children?');
INSERT INTO user_questions (userID, postID) VALUES (4,36);
--37
INSERT INTO posts (userID, postType, title, postText) VALUES (5, 'question', 'Personal growth', 'What are some good ways to reduce stress and improve mental health?');
INSERT INTO user_questions (userID, postID) VALUES (5,37);
INSERT INTO user_questions (userID, postID) VALUES (12,37);
INSERT INTO user_questions (userID, postID) VALUES (17,37);
--38
INSERT INTO posts (userID, postType, title, postText) VALUES (6, 'question', 'Photography', 'What are some good tips for taking great photos with a smartphone?');
INSERT INTO user_questions (userID, postID) VALUES (6,38);
--39
INSERT INTO posts (userID, postType, title, postText) VALUES (7, 'question', 'Fashion', 'What are some good tips for dressing for success in the workplace?');
INSERT INTO user_questions (userID, postID) VALUES (7,39);
--40
INSERT INTO posts (userID, postType, title, postText) VALUES (8, 'question', 'Food', 'What are some good tips for cooking for a large group?');
INSERT INTO user_questions (userID, postID) VALUES (8,40);
--41
INSERT INTO posts (userID, postType, title, postText) VALUES (2, 'question', 'Music', 'What are some good tips for learning to sing?');
INSERT INTO user_questions (userID, postID) VALUES (2,41);
--42
INSERT INTO posts (userID, postType, title, postText) VALUES (3, 'question', 'Writing', 'What are some good tips for writing a great essay?');
INSERT INTO user_questions (userID, postID) VALUES (3,42);
--43
INSERT INTO posts (userID, postType, title, postText) VALUES (4, 'question', 'Art', 'What are some good tips for creating great compositions in art?');
INSERT INTO user_questions (userID, postID) VALUES (4,43);
--44
INSERT INTO posts (userID, postType, title, postText) VALUES (5, 'question', 'Sports', 'What are some good tips for improving your golf game?');
INSERT INTO user_questions (userID, postID) VALUES (5,44);
--45
INSERT INTO posts (userID, postType, title, postText) VALUES (6, 'question', 'Pet care', 'What are some good tips for training a new puppy?');
INSERT INTO user_questions (userID, postID) VALUES (6,45);
--46
INSERT INTO posts (userID, postType, title, postText) VALUES (7, 'question', 'Nature', 'What are some good ways to get involved in conservation efforts?');
INSERT INTO user_questions (userID, postID) VALUES (7,46);
--47
INSERT INTO posts (userID, postType, title, postText) VALUES (8, 'question', 'Travel', 'What are some good tips for packing light?');
INSERT INTO user_questions (userID, postID) VALUES (8,47);
--48
INSERT INTO posts (userID, postType, title, postText) VALUES (1, 'question', 'Home organization', 'What are some good ways to organize your closet?');
INSERT INTO user_questions (userID, postID) VALUES (1,48);
--49
INSERT INTO posts (userID, postType, title, postText) VALUES (1, 'question', 'Gardening', 'What are some good tips for growing herbs?');
INSERT INTO user_questions (userID, postID) VALUES (1,49);
--50
INSERT INTO posts (userID, postType, title, postText) VALUES (1, 'question', 'Cooking', 'What are some good tips for cooking with a slow cooker?');
INSERT INTO user_questions (userID, postID) VALUES (1,50);
--51
INSERT INTO posts (userID, postType, title, postText) VALUES (1, 'question', 'Finance', 'What are some good strategies for paying off debt?');
INSERT INTO user_questions (userID, postID) VALUES (1,51);

-- answers
INSERT INTO posts(userID, postType, postText, parentPost, isCorrect) VALUES (1, 'answer', 'Use the keyword import, followed by the name of your class inside curly brackets, them write from "file". Like this: import { className } from "file". ', 7, FALSE);
INSERT INTO posts(userID, postType, postText, parentPost, isCorrect) VALUES (2, 'answer', 'You write it using quotes.', 1, TRUE);
INSERT INTO posts(userID, postType, postText, parentPost, isCorrect) VALUES (3, 'answer', 'sum, es, est, sumus, estis, sant', 3, FALSE);
INSERT INTO posts(userID, postType, postText, parentPost, isCorrect) VALUES (4, 'answer', 'It is on the 1st of december', 5, TRUE);
INSERT INTO posts(userID, postType, postText, parentPost, isCorrect) VALUES (5, 'answer', 'I think you use the keyword import.', 7, FALSE);
INSERT INTO posts(userID, postType, postText, parentPost, isCorrect) VALUES (6, 'answer', 'Some easy recipes for a beginner cook might include pasta with marinara sauce, grilled cheese sandwiches, or scrambled eggs. Other simple dishes might include baked salmon, stir fry, or tacos.', 9, FALSE);
INSERT INTO posts(userID, postType, postText, parentPost, isCorrect) VALUES (7, 'answer', 'Some good exercises to do at home without any equipment include push-ups, sit-ups, squats, lunges, and burpees. You can also do bodyweight exercises like planks, mountain climbers, and jump squats.', 10, FALSE);
INSERT INTO posts(userID, postType, postText, parentPost, isCorrect) VALUES (8, 'answer', 'Some good strategies for beginner investors might include starting with a diversified portfolio of mutual funds or ETFs, considering a robo-advisor to manage your investments, and learning about different investment.', 11, FALSE);
INSERT INTO posts(userID, postType, postText, parentPost, isCorrect) VALUES (9, 'answer', 'Some tips for networking and finding a job in a new industry include attending industry events and conferences, reaching out to connections and asking for introductions, and joining professional organizations.', 12, FALSE);
INSERT INTO posts(userID, postType, postText, parentPost, isCorrect) VALUES (10, 'answer', 'You can make a simple pasta dish. Its simple and suitable for begginers! You will need pasta, tomato sauce, and any desired toppings (such as cheese, vegetables, or meat). Boil the pasta according to package instructions, then drain and mix with the tomato sauce.', 9, FALSE);
INSERT INTO posts(userID, postType, postText, parentPost, isCorrect) VALUES (11, 'answer', 'Make a basic grilled cheese sandwich, you will need bread, butter, and cheese. Spread butter on one side of each slice of bread, then place cheese between the slices.', 9, FALSE);
INSERT INTO posts(userID, postType, postText, parentPost, isCorrect) VALUES (12, 'answer', 'Scrambled eggs are really simple! You will need eggs, milk (optional), and butter or oil. Beat the eggs in a bowl, then stir in a splash of milk if desired. Heat a pan over medium heat and add a small amount of butter or oil.', 9, FALSE);
INSERT INTO posts(userID, postType, postText, parentPost, isCorrect) VALUES (13, 'answer', 'Try to make baked salmon, you will need a salmon fillet, olive oil, salt, and pepper. Preheat your oven to 400°F. Place the salmon in a baking dish and brush with olive oil. Sprinkle with salt and pepper.', 9, FALSE);
INSERT INTO posts(userID, postType, postText, parentPost, isCorrect) VALUES (14, 'answer', 'I always love to make tacos, it is so simple! You will need taco shells or tortillas, your choice of filling (such as ground beef, chicken, or beans), and any desired toppings (such as cheese, lettuce, and tomato).', 40, FALSE);
INSERT INTO posts(userID, postType, postText, parentPost, isCorrect) VALUES (15, 'answer', 'Some good tips for organizing your closet include getting rid of items you no longer wear, organizing by category (such as tops, bottoms, shoes), and using storage solutions like hangers, bins, and shelves. ', 48, FALSE);
INSERT INTO posts(userID, postType, postText, parentPost, isCorrect) VALUES (16, 'answer', 'To grow herbs, you will need a sunny spot with well-draining soil, a container or garden bed, and herb seeds or plants.', 49, FALSE);
INSERT INTO posts(userID, postType, postText, parentPost, isCorrect) VALUES (17, 'answer', 'To make a healthy meal, you can start by including a variety of vegetables, whole grains, and lean protein sources. You can also try using healthy cooking techniques like grilling, baking, or steaming.', 33, FALSE);
INSERT INTO posts(userID, postType, postText, parentPost, isCorrect) VALUES (18, 'answer', 'To pay off debt, you can start by making a budget and identifying your highest-interest debts. Consider making extra payments towards those debts or consolidating them to get a lower interest rate.', 51, FALSE);
INSERT INTO posts(userID, postType, postText, parentPost, isCorrect) VALUES (19, 'answer', 'To stay safe online, you can start by using strong, unique passwords and enabling two-factor authentication on your accounts. You should also be cautious when clicking on links or downloading attachments.', 35, FALSE);
INSERT INTO posts(userID, postType, postText, parentPost, isCorrect) VALUES (20, 'answer', 'Some good strategies for disciplining children include setting clear expectations and consequences, consistently enforcing rules, and praising good behavior.', 36, FALSE);

-- comments TO DO
INSERT INTO comments(postID, userID, commentText) VALUES (1, 1,'It has been solved');
INSERT INTO comments(postID, userID, commentText) VALUES (2, 5,'Thank you!');
INSERT INTO comments(postID, userID, commentText) VALUES (3, 10, 'I appreciate the answers!');
INSERT INTO comments(postID, userID, commentText) VALUES (4, 6, 'This was a great suggestion, thank you!');
INSERT INTO comments(postID, userID, commentText) VALUES (5, 5, 'Now I know!');
INSERT INTO comments(postID, userID, commentText) VALUES (6, 7, 'This was really helpful, thank you!');
INSERT INTO comments(postID, userID, commentText) VALUES (7, 8, 'It works now!');
INSERT INTO comments(postID, userID, commentText) VALUES (8, 2, 'I think this is a really important point to consider!');
INSERT INTO comments(postID, userID, commentText) VALUES (9, 3, 'I agree, this is a great tip!');
INSERT INTO comments(postID, userID, commentText) VALUES (10, 4, 'I had never thought of this before, thank you!');
INSERT INTO comments(postID, userID, commentText) VALUES (11, 7, 'This was really helpful, thank you!');
INSERT INTO comments(postID, userID, commentText) VALUES (12, 8, 'I totally agree!');
INSERT INTO comments(postID, userID, commentText) VALUES (13, 2, 'This was a really helpful suggestion, thank you!');
INSERT INTO comments(postID, userID, commentText) VALUES (14, 3, 'I had never thought of this before, thank you for the suggestion!');
INSERT INTO comments(postID, userID, commentText) VALUES (15, 4, 'Thanks for your opinions!');
INSERT INTO comments(postID, userID, commentText) VALUES (16, 5, 'This was a really helpful suggestion, thank you!');
INSERT INTO comments(postID, userID, commentText) VALUES (17, 6, 'I agree, this is a great tip!');
INSERT INTO comments(postID, userID, commentText) VALUES (18, 7, 'I had never thought of this before, thank you for the suggestion!');
INSERT INTO comments(postID, userID, commentText) VALUES (19, 8, 'This was really helpful, thank you!');
INSERT INTO comments(postID, userID, commentText) VALUES (20, 2, 'Appreciated');
INSERT INTO comments(postID, userID, commentText) VALUES (21, 3, 'This was a really helpful suggestion, thank you!');
INSERT INTO comments(postID, userID, commentText) VALUES (22, 4,' I will buy them all.');
INSERT INTO comments(postID, userID, commentText) VALUES (23, 5,' Thank you!');
INSERT INTO comments(postID, userID, commentText) VALUES (24, 6, 'I will try them all!');
INSERT INTO comments(postID, userID, commentText) VALUES (25, 7, 'This was a great suggestion, thank you!');
INSERT INTO comments(postID, userID, commentText) VALUES (26, 8, 'I tried this and it worked really well for me!');
INSERT INTO comments(postID, userID, commentText) VALUES (27, 2, 'This was really helpful, thank you!');
INSERT INTO comments(postID, userID, commentText) VALUES (28, 3, 'I totally agree with this answer!');
INSERT INTO comments(postID, userID, commentText) VALUES (29, 4, 'I think this is a really important point to consider!');
INSERT INTO comments(postID, userID, commentText) VALUES (30, 5, 'This is a great tip!');
INSERT INTO comments(postID, userID, commentText) VALUES (31, 6, 'I had never thought of this before, thank you!');
INSERT INTO comments(postID, userID, commentText) VALUES (32, 7, 'This was really helpful, thank you!');
INSERT INTO comments(postID, userID, commentText) VALUES (33, 8, 'I totally value your comment!');
INSERT INTO comments(postID, userID, commentText) VALUES (34, 2, 'This was a really helpful suggestion, thank you!');
INSERT INTO comments(postID, userID, commentText) VALUES (35, 3, 'I had never thought of this before, thank you for the suggestion!');
INSERT INTO comments(postID, userID, commentText) VALUES (36, 4, 'I totally agree with this comment!');
INSERT INTO comments(postID, userID, commentText) VALUES (37, 5, 'This was a really helpful suggestion, thank you!');
INSERT INTO comments(postID, userID, commentText) VALUES (38, 6, 'I agree, this is a great tip!');
INSERT INTO comments(postID, userID, commentText) VALUES (39, 7, 'I had never thought of this before, thank you for the suggestion!');
INSERT INTO comments(postID, userID, commentText) VALUES (40, 8, 'This was really helpful, thank you!');
INSERT INTO comments(postID, userID, commentText) VALUES (41, 2, 'I totally agree with this comment!');
INSERT INTO comments(postID, userID, commentText) VALUES (42, 3, 'This was a really helpful suggestion, thank you!');
INSERT INTO comments(postID, userID, commentText) VALUES (43, 4,' It has been solved');
INSERT INTO comments(postID, userID, commentText) VALUES (44, 5,' Thank you!');
INSERT INTO comments(postID, userID, commentText) VALUES (45, 6, 'I totally agree with this answer!');
INSERT INTO comments(postID, userID, commentText) VALUES (46, 7, 'This was a great suggestion, thank you!');
INSERT INTO comments(postID, userID, commentText) VALUES (47, 8, 'I tried this and it worked really well for me!');
INSERT INTO comments(postID, userID, commentText) VALUES (48, 1, 'This was really helpful, thank you!');
INSERT INTO comments(postID, userID, commentText) VALUES (49, 1, 'Thanks!');
INSERT INTO comments(postID, userID, commentText) VALUES (50, 1, 'I think this is a really important point to consider!');
INSERT INTO comments(postID, userID, commentText) VALUES (51, 1, 'I agree, this is a great tip!');

--stars
INSERT INTO stars (postID, userID) VALUES (1,1);
INSERT INTO stars (postID, userID) VALUES (7,1);
INSERT INTO stars (postID, userID) VALUES (48,1);
INSERT INTO stars (postID, userID) VALUES (49,1);
INSERT INTO stars (postID, userID) VALUES (50,1);
INSERT INTO stars (postID, userID) VALUES (51,1);
INSERT INTO stars (postID, userID) VALUES (52,1);
INSERT INTO stars (postID, userID) VALUES (1,2);
INSERT INTO stars (postID, userID) VALUES (8,2);
INSERT INTO stars (postID, userID) VALUES (13,2);
INSERT INTO stars (postID, userID) VALUES (20,2);
INSERT INTO stars (postID, userID) VALUES (27,2);
INSERT INTO stars (postID, userID) VALUES (34,2);
INSERT INTO stars (postID, userID) VALUES (41,2);
INSERT INTO stars (postID, userID) VALUES (53,2);
INSERT INTO stars (postID, userID) VALUES (3,3);
INSERT INTO stars (postID, userID) VALUES (9,3);
INSERT INTO stars (postID, userID) VALUES (14,3);
INSERT INTO stars (postID, userID) VALUES (21,3);
INSERT INTO stars (postID, userID) VALUES (28,3);
INSERT INTO stars (postID, userID) VALUES (35,3);
INSERT INTO stars (postID, userID) VALUES (42,3);
INSERT INTO stars (postID, userID) VALUES (54,3);
INSERT INTO stars (postID, userID) VALUES (5,4);
INSERT INTO stars (postID, userID) VALUES (10,4);
INSERT INTO stars (postID, userID) VALUES (15,4);
INSERT INTO stars (postID, userID) VALUES (22,4);
INSERT INTO stars (postID, userID) VALUES (29,4);
INSERT INTO stars (postID, userID) VALUES (36,4);
INSERT INTO stars (postID, userID) VALUES (43,4);
INSERT INTO stars (postID, userID) VALUES (55,4);
INSERT INTO stars (postID, userID) VALUES (2,5);
INSERT INTO stars (postID, userID) VALUES (5,5);
INSERT INTO stars (postID, userID) VALUES (7,5);
INSERT INTO stars (postID, userID) VALUES (16,5);
INSERT INTO stars (postID, userID) VALUES (23,5);
INSERT INTO stars (postID, userID) VALUES (30,5);
INSERT INTO stars (postID, userID) VALUES (37,5);
INSERT INTO stars (postID, userID) VALUES (44,5);
INSERT INTO stars (postID, userID) VALUES (56,5);
INSERT INTO stars (postID, userID) VALUES (4,6);
INSERT INTO stars (postID, userID) VALUES (9,6);
INSERT INTO stars (postID, userID) VALUES (17,6);
INSERT INTO stars (postID, userID) VALUES (24,6);
INSERT INTO stars (postID, userID) VALUES (31,6);
INSERT INTO stars (postID, userID) VALUES (38,6);
INSERT INTO stars (postID, userID) VALUES (45,6);
INSERT INTO stars (postID, userID) VALUES (57,6);
INSERT INTO stars (postID, userID) VALUES (6,7);
INSERT INTO stars (postID, userID) VALUES (10,7);
INSERT INTO stars (postID, userID) VALUES (11,7);
INSERT INTO stars (postID, userID) VALUES (18,7);
INSERT INTO stars (postID, userID) VALUES (25,7);
INSERT INTO stars (postID, userID) VALUES (32,7);
INSERT INTO stars (postID, userID) VALUES (39,7);
INSERT INTO stars (postID, userID) VALUES (46,7);
INSERT INTO stars (postID, userID) VALUES (58,7);
INSERT INTO stars (postID, userID) VALUES (7,8);
INSERT INTO stars (postID, userID) VALUES (11,8);
INSERT INTO stars (postID, userID) VALUES (12,8);
INSERT INTO stars (postID, userID) VALUES (19,8);
INSERT INTO stars (postID, userID) VALUES (26,8);
INSERT INTO stars (postID, userID) VALUES (33,8);
INSERT INTO stars (postID, userID) VALUES (40,8);
INSERT INTO stars (postID, userID) VALUES (47,8);
INSERT INTO stars (postID, userID) VALUES (59,8);
INSERT INTO stars (postID, userID) VALUES (12,9);
INSERT INTO stars (postID, userID) VALUES (60,9);
INSERT INTO stars (postID, userID) VALUES (3,10);
INSERT INTO stars (postID, userID) VALUES (9,10);
INSERT INTO stars (postID, userID) VALUES (61,10);
INSERT INTO stars (postID, userID) VALUES (9,11);
INSERT INTO stars (postID, userID) VALUES (62,11);
INSERT INTO stars (postID, userID) VALUES (9,12);
INSERT INTO stars (postID, userID) VALUES (63,12);
INSERT INTO stars (postID, userID) VALUES (9,13);
INSERT INTO stars (postID, userID) VALUES (64,13);
INSERT INTO stars (postID, userID) VALUES (40,14);
INSERT INTO stars (postID, userID) VALUES (65,14);
INSERT INTO stars (postID, userID) VALUES (48,15);
INSERT INTO stars (postID, userID) VALUES (66,15);
INSERT INTO stars (postID, userID) VALUES (49,16);
INSERT INTO stars (postID, userID) VALUES (67,16);
INSERT INTO stars (postID, userID) VALUES (33,17);
INSERT INTO stars (postID, userID) VALUES (68,17);
INSERT INTO stars (postID, userID) VALUES (51,18);
INSERT INTO stars (postID, userID) VALUES (69,18);
INSERT INTO stars (postID, userID) VALUES (35,19);
INSERT INTO stars (postID, userID) VALUES (70,19);
INSERT INTO stars (postID, userID) VALUES (36,20);
INSERT INTO stars (postID, userID) VALUES (71,20);

--badges
INSERT INTO badges(badgeName) VALUES ('Posted 5 questions'); --1
INSERT INTO badges(badgeName) VALUES ('Posted 10 questions'); --2
INSERT INTO badges(badgeName) VALUES ('Posted 15 questions'); --3
INSERT INTO badges(badgeName) VALUES ('Posted 20 questions'); --4
INSERT INTO badges(badgeName) VALUES ('Answered 5 questions'); --5
INSERT INTO badges(badgeName) VALUES ('Answered 10 questions'); --6
INSERT INTO badges(badgeName) VALUES ('Answered 15 questions'); --7
INSERT INTO badges(badgeName) VALUES ('Answered 20 questions'); --8
INSERT INTO badges(badgeName) VALUES ('1 correct answer!'); --9
INSERT INTO badges(badgeName) VALUES ('5 correct answers!'); --10
INSERT INTO badges(badgeName) VALUES ('10 correct answers!'); --11
INSERT INTO badges(badgeName) VALUES ('15 correct answers!'); --12
INSERT INTO badges(badgeName) VALUES ('20 correct answers!'); --13
INSERT INTO badges(badgeName) VALUES ('Someone liked a post you made!'); --14
INSERT INTO badges(badgeName) VALUES ('5 people liked a post you made!'); --15
INSERT INTO badges(badgeName) VALUES ('10 people liked a post you made!'); --16
INSERT INTO badges(badgeName) VALUES ('15 people liked a post you made!'); --17
INSERT INTO badges(badgeName) VALUES ('20 people liked a post you made!'); --18


--tags
--1
INSERT INTO tags(tagName) VALUES ('python');
--2
INSERT INTO tags(tagName) VALUES ('java');
--3
INSERT INTO tags(tagName) VALUES ('C');
--4
INSERT INTO tags(tagName) VALUES ('html');
--5
INSERT INTO tags(tagName) VALUES ('php');
--6
INSERT INTO tags(tagName) VALUES ('code');
--7
INSERT INTO tags(tagName) VALUES ('food');
--8
INSERT INTO tags(tagName) VALUES ('cats');
--9
INSERT INTO tags(tagName) VALUES ('dogs');
--10
INSERT INTO tags(tagName) VALUES ('pets');
--11
INSERT INTO tags(tagName) VALUES ('animals');
--12
INSERT INTO tags(tagName) VALUES ('help');
--13
INSERT INTO tags(tagName) VALUES ('advice');
--14
INSERT INTO tags(tagName) VALUES ('gym');
--15
INSERT INTO tags(tagName) VALUES ('workout');
--16
INSERT INTO tags(tagName) VALUES ('parenting');
--17
INSERT INTO tags(tagName) VALUES ('art');
--18
INSERT INTO tags(tagName) VALUES ('music');
--19
INSERT INTO tags(tagName) VALUES ('school');
--20
INSERT INTO tags(tagName) VALUES ('plants');


--user tags
INSERT INTO user_tags (userID, tagID) VALUES (1,1);
INSERT INTO user_tags (userID, tagID) VALUES (1,2);
INSERT INTO user_tags (userID, tagID) VALUES (1,3);
INSERT INTO user_tags (userID, tagID) VALUES (1,4);
INSERT INTO user_tags (userID, tagID) VALUES (1,5);
INSERT INTO user_tags (userID, tagID) VALUES (1,6);
INSERT INTO user_tags (userID, tagID) VALUES (1,7);
INSERT INTO user_tags (userID, tagID) VALUES (1,8);
INSERT INTO user_tags (userID, tagID) VALUES (1,9);
INSERT INTO user_tags (userID, tagID) VALUES (1,10);
INSERT INTO user_tags (userID, tagID) VALUES (1,11);
INSERT INTO user_tags (userID, tagID) VALUES (1,12);
INSERT INTO user_tags (userID, tagID) VALUES (1,13);
INSERT INTO user_tags (userID, tagID) VALUES (1,14);
INSERT INTO user_tags (userID, tagID) VALUES (1,15);
INSERT INTO user_tags (userID, tagID) VALUES (1,16);
INSERT INTO user_tags (userID, tagID) VALUES (1,17);
INSERT INTO user_tags (userID, tagID) VALUES (1,18);
INSERT INTO user_tags (userID, tagID) VALUES (1,19);
INSERT INTO user_tags (userID, tagID) VALUES (1,20);
INSERT INTO user_tags (userID, tagID) VALUES (2,20);
INSERT INTO user_tags (userID, tagID) VALUES (2,13);
INSERT INTO user_tags (userID, tagID) VALUES (2,14);
INSERT INTO user_tags (userID, tagID) VALUES (2,15);
INSERT INTO user_tags (userID, tagID) VALUES (2,18);
INSERT INTO user_tags (userID, tagID) VALUES (3,8);
INSERT INTO user_tags (userID, tagID) VALUES (3,9);
INSERT INTO user_tags (userID, tagID) VALUES (3,10);
INSERT INTO user_tags (userID, tagID) VALUES (3,11);
INSERT INTO user_tags (userID, tagID) VALUES (3,13);
INSERT INTO user_tags (userID, tagID) VALUES (4,11);
INSERT INTO user_tags (userID, tagID) VALUES (4,15);
INSERT INTO user_tags (userID, tagID) VALUES (4,20);
INSERT INTO user_tags (userID, tagID) VALUES (5,3);
INSERT INTO user_tags (userID, tagID) VALUES (5,6);
INSERT INTO user_tags (userID, tagID) VALUES (5,11);
INSERT INTO user_tags (userID, tagID) VALUES (5,20);
INSERT INTO user_tags (userID, tagID) VALUES (6,15);
INSERT INTO user_tags (userID, tagID) VALUES (6,20);
INSERT INTO user_tags (userID, tagID) VALUES (6,3);
INSERT INTO user_tags (userID, tagID) VALUES (6,1);
INSERT INTO user_tags (userID, tagID) VALUES (7,1);
INSERT INTO user_tags (userID, tagID) VALUES (7,9);
INSERT INTO user_tags (userID, tagID) VALUES (7,16);
INSERT INTO user_tags (userID, tagID) VALUES (7,17);
INSERT INTO user_tags (userID, tagID) VALUES (8,14);
INSERT INTO user_tags (userID, tagID) VALUES (8,5);
INSERT INTO user_tags (userID, tagID) VALUES (8,9);
INSERT INTO user_tags (userID, tagID) VALUES (8,17);

--question-tags
INSERT INTO question_tags (postID, tagID) VALUES (1,12);
INSERT INTO question_tags (postID, tagID) VALUES (1,13);
INSERT INTO question_tags (postID, tagID) VALUES (1,17);
INSERT INTO question_tags (postID, tagID) VALUES (2,10);
INSERT INTO question_tags (postID, tagID) VALUES (2,11);
INSERT INTO question_tags (postID, tagID) VALUES (3,12);
INSERT INTO question_tags (postID, tagID) VALUES (3,19);
INSERT INTO question_tags (postID, tagID) VALUES (4,13);
INSERT INTO question_tags (postID, tagID) VALUES (4,17);
INSERT INTO question_tags (postID, tagID) VALUES (5,12);
INSERT INTO question_tags (postID, tagID) VALUES (5,19);
INSERT INTO question_tags (postID, tagID) VALUES (6,7);
INSERT INTO question_tags (postID, tagID) VALUES (6,12);
INSERT INTO question_tags (postID, tagID) VALUES (6,13);
INSERT INTO question_tags (postID, tagID) VALUES (7,2);
INSERT INTO question_tags (postID, tagID) VALUES (7,6);
INSERT INTO question_tags (postID, tagID) VALUES (8,13);
INSERT INTO question_tags (postID, tagID) VALUES (8,20);
INSERT INTO question_tags (postID, tagID) VALUES (9,7);
INSERT INTO question_tags (postID, tagID) VALUES (9,13);
INSERT INTO question_tags (postID, tagID) VALUES (10,15);
INSERT INTO question_tags (postID, tagID) VALUES (11,13);
INSERT INTO question_tags (postID, tagID) VALUES (12,13);
INSERT INTO question_tags (postID, tagID) VALUES (13,20);
INSERT INTO question_tags (postID, tagID) VALUES (16,13);
INSERT INTO question_tags (postID, tagID) VALUES (17,13);
INSERT INTO question_tags (postID, tagID) VALUES (18,6);
INSERT INTO question_tags (postID, tagID) VALUES (18,12);
INSERT INTO question_tags (postID, tagID) VALUES (19,12);
INSERT INTO question_tags (postID, tagID) VALUES (19,16);
INSERT INTO question_tags (postID, tagID) VALUES (20,12);
INSERT INTO question_tags (postID, tagID) VALUES (20,13);
INSERT INTO question_tags (postID, tagID) VALUES (21,12);
INSERT INTO question_tags (postID, tagID) VALUES (21,17);
INSERT INTO question_tags (postID, tagID) VALUES (22,12);
INSERT INTO question_tags (postID, tagID) VALUES (22,13);
INSERT INTO question_tags (postID, tagID) VALUES (23,7);
INSERT INTO question_tags (postID, tagID) VALUES (23,12);
INSERT INTO question_tags (postID, tagID) VALUES (23,13);
INSERT INTO question_tags (postID, tagID) VALUES (24,17);
INSERT INTO question_tags (postID, tagID) VALUES (24,18);
INSERT INTO question_tags (postID, tagID) VALUES (25,13);
INSERT INTO question_tags (postID, tagID) VALUES (25,17);