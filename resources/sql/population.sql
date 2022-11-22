-- POPULATION

INSERT INTO users (name, email, username, password, birthday, isDeleted) VALUES ('Isacco Pyott', 'ipyott0@telegraph.co.uk', 'ipyott0', 'xQwZAbeT', '2017-09-03 08:02:38', FALSE);
INSERT INTO users (name, email, username, password, birthday, isDeleted) VALUES ('Brad Surby', 'bsurby1@nydailynews.com', 'bsurby1', '6TRj9xvhUn', '2009-06-28 07:43:14', FALSE);
INSERT INTO users (name, email, username, password, birthday, isDeleted) VALUES ('Chrissie Leif', 'cleif2@marriott.com', 'cleif2', 'csYU4DG', '2017-04-22 21:40:55', FALSE);
INSERT INTO users (name, email, username, password, birthday, isDeleted) VALUES ('Pete Weston', 'pweston3@noaa.gov', 'pweston3', '3KCsCJFTL', '2017-06-22 19:02:26', FALSE);
INSERT INTO users (name, email, username, password, birthday, isDeleted) VALUES ('Kennie Remon', 'kremon4@cbsnews.com', 'kremon4', 'JnhODyh9T1lf', '2013-02-07 04:56:07', FALSE);
INSERT INTO users (name, email, username, password, birthday, isDeleted) VALUES ('Charlene Blazynski', 'cblazynski5@accuweather.com', 'cblazynski5', 'MmQ5LYk', '2008-05-04 18:11:19', FALSE);
INSERT INTO users (name, email, username, password, birthday, isDeleted) VALUES ('Annabal Chaffey', 'achaffey6@unesco.org', 'achaffey6', 'F4brguw', '2001-08-27 15:13:28', FALSE);
INSERT INTO users (name, email, username, password, birthday, isDeleted) VALUES ('Julie Swainston', 'jswainston7@webnode.com', 'jswainston7', 'POBXHsfmkI', '2013-03-19 16:49:16', FALSE);
INSERT INTO users (name, email, username, password, birthday, isDeleted) VALUES ('Omar Bangs', 'obangs8@nsw.gov.au', 'obangs8', '1bkTtAIZFd6Q', '2012-04-11 10:44:55', FALSE);
INSERT INTO users (name, email, username, password, birthday, isDeleted) VALUES ('Lauraine Bushell', 'lbushell9@gravatar.com', 'lbushell9', 'pMy1LL', '2003-02-26 09:06:47', FALSE);

INSERT INTO posts (userID, postType, title, postText) VALUES (5, 'question', 'suspendisse accumsan tortor quis turpis sed ante vivamus tortor duis mattis', 'integer tincidunt ante vel ipsum praesent blandit lacinia erat vestibulum sed magna at nunc commodo placerat praesent blandit nam nulla integer pede justo lacinia eget tincidunt');
INSERT INTO posts (userID, postType, title, postText) VALUES (10, 'question', '', 'erat vestibulum sed magna at nunc commodo placerat praesent blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus vel pede morbi porttitor lorem id ligula suspendisse ornare');
INSERT INTO posts (userID, postType, title, postText) VALUES (6, 'question', 'id pretium iaculis diam erat fermentum justo nec condimentum neque sapien placerat', 'sed justo pellentesque viverra pede ac diam cras pellentesque volutpat dui maecenas tristique est et tempus semper est quam pharetra magna ac consequat metus sapien ut nunc vestibulum ante ipsum');
INSERT INTO posts (userID, postType, title, postText) VALUES (5, 'question', 'vel enim sit amet nunc viverra dapibus nulla suscipit ligula', 'pretium quis lectus suspendisse potenti in eleifend quam a odio in hac habitasse platea dictumst maecenas ut massa quis augue luctus');
INSERT INTO posts (userID, postType, title, postText) VALUES (7, 'question', 'accumsan tellus nisi eu orci mauris lacinia sapien quis libero nullam sit amet turpis elementum', 'at velit eu est congue elementum in hac habitasse platea dictumst morbi vestibulum velit id pretium iaculis diam erat fermentum justo nec condimentum neque sapien placerat ante nulla');
INSERT INTO posts (userID, postType, title, postText) VALUES (8, 'question', 'eget tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat', 'nunc donec quis orci eget orci vehicula condimentum curabitur in libero ut massa volutpat convallis morbi odio odio elementum eu interdum eu tincidunt in leo maecenas pulvinar lobortis est phasellus sit');
INSERT INTO posts (userID, postType, title, postText) VALUES (8, 'question', 'nunc commodo placerat praesent blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus vel pede morbi', 'lobortis est phasellus sit amet erat nulla tempus vivamus in felis eu sapien cursus vestibulum proin eu mi nulla ac enim in tempor turpis nec euismod scelerisque quam turpis adipiscing lorem vitae mattis nibh ligula nec sem duis aliquam convallis nunc proin');
INSERT INTO posts (userID, postType, title, postText) VALUES (7, 'question', 'ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien', 'quam sollicitudin vitae consectetuer eget rutrum at lorem integer tincidunt ante vel ipsum praesent blandit lacinia erat vestibulum sed magna at nunc commodo placerat praesent blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus vel pede morbi');
INSERT INTO posts (userID, postType, title, postText) VALUES (10, 'question', 'pharetra magna ac consequat metus sapien ut nunc vestibulum ante ipsum', 'convallis nunc proin at turpis a pede posuere nonummy integer non velit donec diam neque vestibulum eget vulputate ut ultrices vel augue vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin');
INSERT INTO posts (userID, postType, title, postText) VALUES (3, 'question', 'magna at nunc commodo', 'cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus etiam vel augue vestibulum rutrum rutrum neque aenean auctor gravida sem praesent id');

INSERT INTO posts (userID, postType, postText, parentPost, isCorrect) VALUES (2, 'answer', 'convallis nulla neque libero convallis eget eleifend luctus ultricies eu nibh quisque id justo sit amet sapien dignissim vestibulum vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae nulla dapibus dolor vel est donec odio justo sollicitudin ut suscipit a feugiat et', 8, FALSE);
INSERT INTO posts (userID, postType, postText, parentPost, isCorrect) VALUES (7, 'answer', 'pulvinar sed nisl nunc rhoncus dui vel sem sed sagittis nam congue risus semper porta volutpat quam pede lobortis ligula sit amet eleifend pede libero quis orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum', 8, FALSE);
INSERT INTO posts (userID, postType, postText, parentPost, isCorrect) VALUES (1, 'answer', 'id ligula suspendisse ornare consequat lectus in est risus auctor sed tristique in tempus sit amet sem fusce consequat nulla nisl nunc nisl duis bibendum felis', 7, FALSE);
INSERT INTO posts (userID, postType, postText, parentPost, isCorrect) VALUES (7, 'answer', 'penatibus et magnis dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus etiam vel augue vestibulum rutrum rutrum neque aenean auctor gravida sem praesent id massa id', 1, TRUE);
INSERT INTO posts (userID, postType, postText, parentPost, isCorrect) VALUES (6, 'answer', 'quam sollicitudin vitae consectetuer eget rutrum at lorem integer tincidunt ante vel ipsum praesent blandit lacinia erat vestibulum sed magna at nunc commodo placerat praesent blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus vel pede morbi porttitor lorem id', 10, FALSE);
INSERT INTO posts (userID, postType, postText, parentPost, isCorrect) VALUES (8, 'answer', 'vulputate vitae nisl aenean lectus pellentesque eget nunc donec quis orci eget orci vehicula condimentum curabitur in libero ut massa volutpat convallis morbi odio odio elementum eu interdum eu tincidunt in leo maecenas pulvinar lobortis est phasellus sit', 3, FALSE);
INSERT INTO posts (userID, postType, postText, parentPost, isCorrect) VALUES (7, 'answer', 'lobortis ligula sit amet eleifend pede libero quis orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient montes', 9, FALSE);
INSERT INTO posts (userID, postType, postText, parentPost, isCorrect) VALUES (7, 'answer', 'dolor morbi vel lectus in quam fringilla rhoncus mauris enim leo rhoncus sed vestibulum sit amet cursus id turpis integer aliquet massa id lobortis convallis tortor risus dapibus augue vel accumsan tellus nisi eu orci mauris lacinia sapien quis libero nullam sit amet turpis elementum', 1, FALSE);
INSERT INTO posts (userID, postType, postText, parentPost, isCorrect) VALUES (9, 'answer', 'congue diam id ornare imperdiet sapien urna pretium nisl ut volutpat sapien arcu sed augue aliquam erat volutpat in congue etiam justo etiam pretium iaculis justo', 5, TRUE);
INSERT INTO posts (userID, postType, postText, parentPost, isCorrect) VALUES (5, 'answer', 'quam sollicitudin vitae consectetuer eget rutrum at lorem integer tincidunt ante vel ipsum praesent blandit lacinia erat vestibulum sed magna at nunc commodo placerat praesent blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus vel pede', 7, FALSE);

INSERT INTO tags (tagName) VALUES ('initiative');
INSERT INTO tags (tagName) VALUES ('Open-architected');
INSERT INTO tags (tagName) VALUES ('Up-sized');
INSERT INTO tags (tagName) VALUES ('project');
INSERT INTO tags (tagName) VALUES ('artificial intelligence');
INSERT INTO tags (tagName) VALUES ('client-driven');
INSERT INTO tags (tagName) VALUES ('open system');
INSERT INTO tags (tagName) VALUES ('Configurable');
INSERT INTO tags (tagName) VALUES ('encryption');
INSERT INTO tags (tagName) VALUES ('Triple-buffered');

INSERT INTO user_tags (userID, tagID) VALUES (1, 1);
INSERT INTO user_tags (userID, tagID) VALUES (2, 2);
INSERT INTO user_tags (userID, tagID) VALUES (3, 3);
INSERT INTO user_tags (userID, tagID) VALUES (4, 4);
INSERT INTO user_tags (userID, tagID) VALUES (5, 5);
INSERT INTO user_tags (userID, tagID) VALUES (6, 6);
INSERT INTO user_tags (userID, tagID) VALUES (7, 7);
INSERT INTO user_tags (userID, tagID) VALUES (8, 8);
INSERT INTO user_tags (userID, tagID) VALUES (9, 9);
INSERT INTO user_tags (userID, tagID) VALUES (10, 10);

INSERT INTO question_tags (postID, tagID) VALUES (1, 1);
INSERT INTO question_tags (postID, tagID) VALUES (2, 2);
INSERT INTO question_tags (postID, tagID) VALUES (3, 3);
INSERT INTO question_tags (postID, tagID) VALUES (4, 4);
INSERT INTO question_tags (postID, tagID) VALUES (5, 5);
INSERT INTO question_tags (postID, tagID) VALUES (6, 6);
INSERT INTO question_tags (postID, tagID) VALUES (7, 7);
INSERT INTO question_tags (postID, tagID) VALUES (8, 8);
INSERT INTO question_tags (postID, tagID) VALUES (9, 9);
INSERT INTO question_tags (postID, tagID) VALUES (10, 10);

INSERT INTO roles (userID, userRole) VALUES (1, 'Moderator');
INSERT INTO roles (userID, userRole) VALUES (1, 'Administrator');

INSERT INTO comments (postID, userID, commentText) VALUES (1, 1, 'question');

INSERT INTO stars (postId, userID) VALUES (1,1);