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
INSERT INTO users(name, email, username, password, birthday) VALUES (
    'John Doe',
    'admin@example.com',
    'johndoe',
    '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',
    '2003-02-26 09:06:47'
); -- Password is 1234. Generated using Hash::make('1234')

INSERT INTO roles(userID, userRole) VALUES (
    1,
    'Administrator'
);
INSERT INTO roles(userID, userRole) VALUES (
    1,
    'Moderator'
);

--Admins
INSERT INTO users(name, email, username, password, birthday) VALUES (
    'Admin One',
    'admin1@example.com',
    'admin1',
    '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',
    '1969-02-26 09:06:47'
);
INSERT INTO roles(userID, userRole) VALUES (
    2,
    'Administrator'
);
INSERT INTO users(name, email, username, password, birthday) VALUES (
    'Admin Two',
    'admin2@example.com',
    'admin2',
    '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',
    '1969-02-26 09:06:47'
);
INSERT INTO roles(userID, userRole) VALUES (
    3,
    'Administrator'
);
INSERT INTO users(name, email, username, password, birthday) VALUES (
    'Admin Three',
    'admin3@example.com',
    'admin3',
    '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',
    '1969-02-26 09:06:47'
);
INSERT INTO roles(userID, userRole) VALUES (
    4,
    'Administrator'
);

--Moderators
INSERT INTO users(name, email, username, password, birthday) VALUES (
    'Mod One',
    'mod1@example.com',
    'mod1',
    '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',
    '1969-02-26 09:06:47'
);
INSERT INTO roles(userID, userRole) VALUES (
    5,
    'Moderator'
);
INSERT INTO users(name, email, username, password, birthday) VALUES (
    'Mod Two',
    'mod2@example.com',
    'mod2',
    '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',
    '1969-02-26 09:06:47'
);
INSERT INTO roles(userID, userRole) VALUES (
    6,
    'Moderator'
);
INSERT INTO users(name, email, username, password, birthday) VALUES (
    'Mod Three',
    'mod3@example.com',
    'mod3',
    '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',
    '1969-02-26 09:06:47'
);
INSERT INTO roles(userID, userRole) VALUES (
    7,
    'Moderator'
);

--Generic User
INSERT INTO users(name, email, username, password, birthday) VALUES (
    'NPC One',
    'npc1@example.com',
    'npc1',
    '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',
    '1969-02-26 09:06:47'
);
INSERT INTO users(name, email, username, password, birthday) VALUES (
    'NPC Two',
    'npc2@example.com',
    'npc2',
    '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',
    '1969-02-26 09:06:47'
);
INSERT INTO users(name, email, username, password, birthday) VALUES (
    'NPC Three',
    'npc3@example.com',
    'npc3',
    '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',
    '1969-02-26 09:06:47'
);


INSERT INTO users (name, email, username, password, birthday) VALUES ('Isacco Pyott', 'ipyott0@telegraph.co.uk', 'ipyott0', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', '2017-09-03 08:02:38');
INSERT INTO users (name, email, username, password, birthday) VALUES ('Brad Surby', 'bsurby1@nydailynews.com', 'bsurby1', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', '2009-06-28 07:43:14');
INSERT INTO users (name, email, username, password, birthday) VALUES ('Chrissie Leif', 'cleif2@marriott.com', 'cleif2', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', '2017-04-22 21:40:55');
INSERT INTO users (name, email, username, password, birthday) VALUES ('Pete Weston', 'pweston3@noaa.gov', 'pweston3', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', '2017-06-22 19:02:26');
INSERT INTO users (name, email, username, password, birthday) VALUES ('Kennie Remon', 'kremon4@cbsnews.com', 'kremon4', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', '2013-02-07 04:56:07');
INSERT INTO users (name, email, username, password, birthday) VALUES ('Charlene Blazynski', 'cblazynski5@accuweather.com', 'cblazynski5', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', '2008-05-04 18:11:19');
INSERT INTO users (name, email, username, password, birthday) VALUES ('Annabal Chaffey', 'achaffey6@unesco.org', 'achaffey6', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', '2001-08-27 15:13:28');
INSERT INTO users (name, email, username, password, birthday) VALUES ('Julie Swainston', 'jswainston7@webnode.com', 'jswainston7', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', '2013-03-19 16:49:16');
INSERT INTO users (name, email, username, password, birthday) VALUES ('Omar Bangs', 'obangs8@nsw.gov.au', 'obangs8', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', '2012-04-11 10:44:55');
INSERT INTO users (name, email, username, password, birthday) VALUES ('Lauraine Bushell', 'lbushell9@gravatar.com', 'lbushell9', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', '2003-02-26 09:06:47');

--questions
INSERT INTO posts (userID, postType, title, postText) VALUES (1, 'question', 'Dialogue', 'How do you write dialogue?'); 
INSERT INTO posts (userID, postType, title, postText) VALUES (5, 'question', 'Rabbits', 'How many types of rabbit are there?');
INSERT INTO posts (userID, postType, title, postText) VALUES (10, 'question', 'Latin', 'How do you write the verb to be in latin?');
INSERT INTO posts (userID, postType, title, postText) VALUES (6, 'question', 'Photography', 'Are there any good places to take photos in Porto?');
INSERT INTO posts (userID, postType, title, postText) VALUES (5, 'question', 'Day of independence', 'When is the portuguese day of independence?');
INSERT INTO posts (userID, postType, title, postText) VALUES (7, 'question', 'Colombian arepas', 'I cannot seem to make arepas right any time. The cheese always overflows! Does anyone know what I am doing wrong?');
INSERT INTO posts (userID, postType, title, postText) VALUES (8, 'question', 'Importing in javascript', 'How do you import another document in a javascript file?');
INSERT INTO posts (userID, postType, title, postText) VALUES (8, 'question', 'Rabbits of the world', 'lobortis ligula sit amet eleifend pede libero quis orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes');
INSERT INTO posts (userID, postType, title, postText) VALUES (7, 'question', 'eleifend pede libero quis orci nullam molestie nibh in lectus', 'lobortis ligula sit amet eleifend pede libero quis orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes');
INSERT INTO posts (userID, postType, title, postText) VALUES (10, 'question', 'eleifend pede libero quis orci nullam molestie nibh in lectus', 'lobortis ligula sit amet eleifend pede libero quis orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes');
INSERT INTO posts (userID, postType, title, postText) VALUES (3, 'question', 'eleifend pede libero quis orci nullam molestie nibh in lectus', 'lobortis ligula sit amet eleifend pede libero quis orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes');
INSERT INTO posts (userID, postDate, postType, title, postText) VALUES (1, '2022-11-20', 'question', 'Ordering Test', 'Ordering Test text');

-- answers
INSERT INTO posts (userID, postType, postText, parentPost, isCorrect) VALUES (2, 'answer', 'convallis nulla neque libero convallis eget eleifend luctus ultricies eu nibh quisque id justo sit amet sapien dignissim vestibulum vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae nulla dapibus dolor vel est donec odio justo sollicitudin ut suscipit a feugiat et', 8, FALSE);
INSERT INTO posts (userID, postType, postText, parentPost, isCorrect) VALUES (7, 'answer', 'pulvinar sed nisl nunc rhoncus dui vel sem sed sagittis nam congue risus semper porta volutpat quam pede lobortis ligula sit amet eleifend pede libero quis orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum', 8, FALSE);
INSERT INTO posts (userID, postType, postText, parentPost, isCorrect) VALUES (1, 'answer', 'Use the keyword import, followed by the name of your class inside curly brackets, them write from "file". Like this: import { className } from "file". ', 7, FALSE);
INSERT INTO posts (userID, postType, postText, parentPost, isCorrect) VALUES (7, 'answer', 'You write it using quotes.', 1, TRUE);
INSERT INTO posts (userID, postType, postText, parentPost, isCorrect) VALUES (6, 'answer', 'quam sollicitudin vitae consectetuer eget rutrum at lorem integer tincidunt ante vel ipsum praesent blandit lacinia erat vestibulum sed magna at nunc commodo placerat praesent blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus vel pede morbi porttitor lorem id', 10, FALSE);
INSERT INTO posts (userID, postType, postText, parentPost, isCorrect) VALUES (8, 'answer', 'sum, es, est, sumus, estis, sant', 3, FALSE);
INSERT INTO posts (userID, postType, postText, parentPost, isCorrect) VALUES (7, 'answer', 'lobortis ligula sit amet eleifend pede libero quis orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes', 9, FALSE);
INSERT INTO posts (userID, postType, postText, parentPost, isCorrect) VALUES (7, 'answer', 'dolor morbi vel lectus in quam fringilla rhoncus mauris enim leo rhoncus sed vestibulum sit amet cursus id turpis integer aliquet massa id lobortis convallis tortor risus dapibus augue vel accumsan tellus nisi eu orci mauris lacinia sapien quis libero nullam sit amet turpis elementum', 1, FALSE);
INSERT INTO posts (userID, postType, postText, parentPost, isCorrect) VALUES (9, 'answer', 'It is on the 1st of december', 5, TRUE);
INSERT INTO posts (userID, postType, postText, parentPost, isCorrect) VALUES (5, 'answer', 'I think you use the keyword import.', 7, FALSE);

-- comments
INSERT INTO comments (postID, userID, commentText) VALUES (1,1,'It has been solved');
INSERT INTO comments (postID, userID, commentText) VALUES (15,1,'Thank you!');

--stars
INSERT INTO stars (postID, userID) VALUES (1,2);

--badges
INSERT INTO badges (badgeName) VALUES ('Posted 5 questions'); --1
INSERT INTO badges (badgeName) VALUES ('Posted 10 questions'); --2
INSERT INTO badges (badgeName) VALUES ('Posted 15 questions'); --3
INSERT INTO badges (badgeName) VALUES ('Posted 20 questions'); --4

INSERT INTO badges (badgeName) VALUES ('Answered 5 questions'); --5
INSERT INTO badges (badgeName) VALUES ('Answered 10 questions'); --6
INSERT INTO badges (badgeName) VALUES ('Answered 15 questions'); --7
INSERT INTO badges (badgeName) VALUES ('Answered 20 questions'); --8

INSERT INTO badges (badgeName) VALUES ('1 correct answer!'); --9
INSERT INTO badges (badgeName) VALUES ('5 correct answers!'); --10
INSERT INTO badges (badgeName) VALUES ('10 correct answers!'); --11
INSERT INTO badges (badgeName) VALUES ('15 correct answers!'); --12
INSERT INTO badges (badgeName) VALUES ('20 correct answers!'); --13


--tags
INSERT INTO tags (tagName) VALUES ('code');
INSERT INTO tags (tagName) VALUES ('cook');
INSERT INTO tags (tagName) VALUES ('animals');

--user tags
-- INSERT INTO user_tags (userID, tagID) VALUES (1,1);
-- INSERT INTO user_tags (userID, tagID) VALUES (1,2);
-- INSERT INTO user_tags (userID, tagID) VALUES (1,3);
