--database for ecouncil version 1.0
CREATE TABLE users (
  user_id             INT(8) NOT NULL AUTO_INCREMENT,
  user_username       VARCHAR(30) NOT NULL,
  user_pass           VARCHAR(255) NOT NULL,
  user_firstname      VARCHAR(255) NOT NULL,
  user_lastname	      VARCHAR(255) NOT NULL,
  user_email          VARCHAR(255) NOT NULL,
  user_level          ENUM('administrator', 'student', 'professor', 'moderator'),
  UNIQUE INDEX user_name_unique (user_username),
  PRIMARY KEY (user_id)
) TYPE=INNODB;

CREATE TABLE student (
  student_id          INT(8) NOT NULL,
  countpost	      INT(8) NOT NULL default 5,
  countsolution	      INT(8) NOT NULL default 1,
  countvotesolution   INT(8) NOT NULL default 1,
  PRIMARY KEY (student_id),
  CONSTRAINT user_student_id FOREIGN KEY(student_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE
) TYPE=INNODB;

CREATE TABLE categories (
  cat_id              INT(8) NOT NULL AUTO_INCREMENT,
  cat_name            VARCHAR(255) NOT NULL,
  UNIQUE INDEX cat_name_unique (cat_name),
  PRIMARY KEY (cat_id)
) TYPE=INNODB;

CREATE TABLE subjects (
  subject_id          INT(8) NOT NULL AUTO_INCREMENT,
  subject_name        VARCHAR(255) NOT NULL,
  subject_date        DATETIME NOT NULL,
  subject_cat         VARCHAR(255) NOT NULL,
  subject_by          INT(8) NOT NULL,
  subject_description VARCHAR(255) NOT NULL,
  subject_checked     ENUM('0','1') NOT NULL default '0',
  subject_vote_count  INT(8) NOT NULL default 0,
  PRIMARY KEY (subject_id),
  CONSTRAINT subject_has_category FOREIGN KEY(subject_cat) REFERENCES categories(cat_id)ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT subject_posted_by FOREIGN KEY(subject_by) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE
) TYPE=INNODB;

CREATE TABLE comments (
  comment_id          INT(8) NOT NULL AUTO_INCREMENT,
  comment_content     TEXT NOT NULL,
  comment_date        DATETIME NOT NULL,
  comment_subject     INT(8) NOT NULL,
  comment_by          INT(8) NOT NULL,
  comment_checked     ENUM('0','1') NOT NULL,
  PRIMARY KEY (post_id),
  CONSTRAINT comment_has_subject FOREIGN KEY(comment_subject) REFERENCES subjects(subject_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT comment_postes_by FOREIGN KEY(comment_by) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE
) TYPE=INNODB;

CREATE TABLE sessions (
  session_id         INT(8) NOT NULL AUTO_INCREMENT,
  session_name       ENUM('Forum','Post_Solution','Vote_Solution'),
  start_date         DATETIME NOT NULL,
  end_date           DATETIME NOT NULL,
  activity_status   ENUM('0','1') NOT NULL,
  extention          DATEDIFF NOT NULL,
  PRIMARY KEY (session_id)
) TYPE=INNODB;

CREATE TABLE solutions (
  solution_id        INT(8) NOT NULL AUTO_INCREMENT,
  solution_content   TEXT NOT NULL,
  solution_date      DATETIME NOT NULL,
  solution_subject   INT(8) NOT NULL,
  solution_by        INT(8) NOT NULL,
  solution_vote_count INT(8) NOT NULL default 0,
  PRIMARY KEY (solution_id),
  CONSTRAINT solution_at_subject FOREIGN KEY(solution_subject) REFERENCES subject(subject_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT solution_posted_by FOREIGN KEY(solution_by) REFERENCES student(student_id) ON DELETE CASCADE ON UPDATE CASCADE
) TYPE=INNODB;

CREATE TABLE submittedsolutions (
  sub_solution       INT(8) NOT NULL,
  sub_student        INT(8) NOT NULL,
  onsubject	         INT(8) NOT NULL,
  countsolutions	   INT(8) NOT NULL default 1,
  PRIMARY KEY (sub_student,sub_solution),
  CONSTRAINT SUBSLTIN FOREIGN KEY(sub_solution) REFERENCES solutions(solution_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT SUBSTDNT FOREIGN KEY(sub_student) REFERENCES student(student_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT ONSUBJCT FOREIGN KEY(onsubject) REFERENCES subjects(subject_id) ON DELETE CASCADE ON UPDATE CASCADE
) TYPE=INNODB;

CREATE TABLE announcements (
  announcement_id    INT(8) NOT NULL AUTO_INCREMENT,
  announcement_content TEXT NOT NULL,
  announcement_date  DATETIME NOT NULL,
  announcement_by    INT(8) NOT NULL,
  announcement_category VARCHAR(255) NOT NULL,
  PRIMARY KEY (announcement_id),
  CONSTRAINT announcement_posted_by FOREIGN KEY(announcement_by) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE
) TYPE=INNODB;

CREATE TABLE social_hour_subject (
  sh_subject_id      INT(8) NOT NULL AUTO_INCREMENT,
  sh_subject_content TEXT NOT NULL,
  sh_subject_date    DATETIME NOT NULL,
  announcement_by    INT(8) NOT NULL,
  sh_subject_vote_count INT(8) NOT NULL default 0,
  PRIMARY KEY (announcements_id),
  CONSTRAINT announcements_posted_by FOREIGN KEY(announcement_by) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE
) TYPE=INNODB;

CREATE TABLE results (
  result_id          INT(8) NOT NULL AUTO_INCREMENT,
  result_content     TEXT NOT NULL,
  result_date        DATETIME NOT NULL,
  PRIMARY KEY (resut_id)
) TYPE=INNODB;

--ALTER TABLE topics ADD FOREIGN KEY(topic_session) REFERENCES sessions(session_id) ON DELETE CASCADE ON UPDATE CASCADE;

--ΕΙΣΑΓΩΓΗ ΧΡΗΣΤΩΝ ΣΤΗ ΒΑΣΗ

INSERT INTO users (user_id, user_name, user_pass, user_firstname, user_lastname, user_email, user_date ,user_level)
		VALUES (null,'papgeorge', 'abcd123', 'Giorgos', 'Papadopoulos' 'gpap@gmail.com', '2018-10-11 12:07', 'administrator');

INSERT INTO users (user_id, user_name, user_pass, user_firstname, user_lastname, user_email, user_date ,user_level)
		VALUES (null,'alekosta', '1a2b3c4d', 'Kostantinos', 'Alexioy' 'alkostakis95@yahoo.com', '2018-10-11 11:32', 'administrator');

INSERT INTO users (user_id, user_name, user_pass, user_firstname, user_lastname, user_email, user_date ,user_level)
		VALUES (null, 'ioandimi', '123hjk987', 'Ioannou', 'Dimitrios' 'dimioan@gmail.com', '2018-10-11 10:29', 'professor');

INSERT INTO users (user_id, user_name, user_pass, user_firstname, user_lastname, user_email, user_date ,user_level)
		VALUES (null, 'georandr', '456lhj345', 'Georgiou', 'Andreas' 'georgiouand@upatras.gr', '2018-10-11 13:07', 'professor');

INSERT INTO users (user_id, user_name, user_pass, user_firstname, user_lastname, user_email, user_date ,user_level)
		VALUES (null, 'dimimaria', 'sadpf987f', 'Dimitriou', 'Maria' 'mariadimi@gmail.com', '2018-10-11 10:27', 'moderator');

INSERT INTO users (user_id, user_name, user_pass, user_firstname, user_lastname, user_email, user_date ,user_level)
		VALUES (null, 'pappan', 'adsfo7098d', 'Pappas', 'Panagiotis' 'papaspan@gmail.com', '2018-10-11 10:45', 'moderator');

INSERT INTO student (user_id, user_name, user_pass, user_firstname, user_lastname, user_email, user_date)
		VALUES (null, 'papadesp', 'asdfdsf9we', 'Papadopoulou', 'Despina' 'despapa@gmail.com', '2018-10-11 10:19');

INSERT INTO student (user_id, user_name, user_pass, user_firstname, user_lastname, user_email, user_date)
		VALUES (null, 'anagnandre', 'lkj345435', 'Anagnostou', 'Andreas' 'anagnostouand@gmail.com', '2018-10-11 10:27');

INSERT INTO studet (user_id, user_name, user_pass, user_firstname, user_lastname, user_email, user_date)
		VALUES (null, 'dimimaria', 'sadpf987f', 'Dimitriou', 'Maria' 'mariadimi@gmail.com', '2018-10-11 10:18');

INSERT INTO student (user_id, user_name, user_pass, user_firstname, user_lastname, user_email, user_date ,user_level)
		VALUES (null,'papagianal', 'lkjhkjh233', 'Papagianis', 'Alexandros' 'papalex@outlook.com', '2018-10-11 10:14');

--ΕΙΣΑΓΩΓΗ categories ΓΙΑ ΤΑ subject

INSERT INTO categories (cat_id, cat_name, cat_description) VALUES ('null', 'Υλικοτεχνικά Προβλήματα', 'Προβλήματα που αφορούν τις υλικοτεχνικές υποδομές,όπως εξοπλισμός εργαστηρίων, παροχές κτλ');

INSERT INTO categories (cat_id, cat_name, cat_description) VALUES ('null', 'Πρόγραμμα Μαθημάτων', 'Προβλήματα που αφορούν τον εβδομαδιαίο προγραμματισμό διεξαγωγής μαθημάτων');

INSERT INTO categories (cat_id, cat_name, cat_description) VALUES ('null', 'Πρόγραμμα Εξεταστικής', 'Προβλήματα που αφορούν τον προγραμματισμό διεξαγωγής των εξετάσεων');
