/*
 * Initial DB Nov 15, 2017
 */

DROP TABLE comments;
DROP TABLE votes;
DROP TABLE recipes;
DROP TABLE users;


CREATE TABLE users (
  id INTEGER NOT NULL AUTO_INCREMENT,
  username VARCHAR (300) NOT NULL UNIQUE,
  password VARCHAR (300) NOT NULL,
  creation DATETIME,
  isAdmin BOOLEAN,
  constraint userPK PRIMARY KEY (id)
);

CREATE TABLE recipes (
  id INTEGER NOT NULL AUTO_INCREMENT,
  title VARCHAR (300) NOT NULL,
  ingredients VARCHAR (800),
  description VARCHAR (1000), 
  creation DATETIME,
  creator INTEGER NOT NULL,
  constraint recPK PRIMARY KEY (id),
  constraint recFK FOREIGN KEY (creator) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE votes (
  id INTEGER NOT NULL AUTO_INCREMENT,
  post INTEGER NOT NULL, 
  user_id INTEGER NOT NULL,
  score INTEGER,
  constraint vPK PRIMARY KEY (id),
  constraint vFKa FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  constraint vFKb FOREIGN KEY (post) REFERENCES recipes(id) ON DELETE CASCADE
);

CREATE TABLE comments (
  id INTEGER NOT NULL AUTO_INCREMENT,
  comment VARCHAR (400),
  user_id INTEGER NOT NULL,
  post_id INTEGER NOT NULL,
  creation DATETIME,
  constraint cPK PRIMARY KEY (id),
  constraint cFKa FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  constraint cFKb FOREIGN KEY (post_id) REFERENCES recipes(id) ON DELETE CASCADE
);




