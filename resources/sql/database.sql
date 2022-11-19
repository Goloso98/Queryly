DROP SCHEMA IF EXISTS lbaw2294 CASCADE;
CREATE SCHEMA lbaw2294;
SET search_path TO lbaw2294;

DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS roles CASCADE;
DROP TABLE IF EXISTS posts CASCADE;
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
    isDeleted BOOLEAN NOT NULL DEFAULT FALSE
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
    CONSTRAINT post_title CHECK ((postType = 'question' AND title IS NOT NULL) OR (postType = 'answer' AND title IS NULL)),
    CONSTRAINT correctness CHECK ((postType = 'question' AND isCorrect IS NULL) OR (postType = 'answer' AND isCorrect IS NOT NULL))
);

CREATE TABLE stars (
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
DECLARE notified_user INTEGER;
BEGIN
    IF NEW.postType = 'answer' THEN
        SELECT userID INTO notified_user FROM posts WHERE posts.id = NEW.parentPost;
        WITH inserted AS (
            INSERT INTO notifications (userID, isRead, notificationDate)
            VALUES (notified_user, FALSE, CURRENT_TIMESTAMP)
            RETURNING id
        ) INSERT INTO new_answers SELECT inserted.id, NEW.id, NEW.parentPost FROM inserted;
    END IF;
    RETURN NEW;
END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER answer_trigger
    AFTER INSERT OR UPDATE ON posts
    FOR EACH ROW
    EXECUTE PROCEDURE add_answer_notification();

-- QUESTION TAG NOTIFICATIONS
CREATE OR REPLACE FUNCTION add_question_notification() RETURNS TRIGGER AS
$BODY$
DECLARE notified_user INTEGER;
BEGIN
    SELECT userID INTO notified_user FROM user_tags WHERE NEW.tagID = user_tags.tagID;
    WITH inserted AS (
        INSERT INTO notifications (userID, isRead, notificationDate)
        VALUES (notified_user, FALSE, CURRENT_TIMESTAMP)
        RETURNING id
    )
    INSERT INTO new_questions SELECT inserted.id, NEW.postID FROM inserted;
    RETURN NEW;
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

INSERT INTO users(name, email, username, password, birthday) VALUES (
  'John Doe',
  'admin@example.com',
  'johndoe',
  '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',
  '2003-02-26 09:06:47'
); -- Password is 1234. Generated using Hash::make('1234')

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