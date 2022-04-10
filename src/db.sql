DROP TABLE user;
DROP TABLE student;
DROP TABLE student_interest;
DROP TABLE club;
DROP TABLE clublisting;
DROP TABLE answers;
DROP TABLE registered_club;
DROP TABLE club_domain;

CREATE TABLE IF NOT EXISTS user (
    user_id varchar(32),
    password varchar(32),
    type varchar(15),
    
    CONSTRAINT pkey PRIMARY KEY(user_id)
);

CREATE TABLE IF NOT EXISTS student (
    user_id varchar(32),
    fname varchar(64),
    lname varchar(64),
    regno varchar(9) PRIMARY KEY,
    age numeric(10),
    year_of_study numeric(10),

    CONSTRAINT student_uid FOREIGN KEY(user_id) REFERENCES user(user_id)
);

CREATE TABLE IF NOT EXISTS student_interest (
    user_id varchar(32),
    domains_of_interest varchar(32),

    CONSTRAINT interest_uid FOREIGN KEY(user_id) REFERENCES user(user_id)
);

CREATE TABLE IF NOT EXISTS club (
    user_id varchar(32),
    name varchar(32) PRIMARY KEY,
    num_events numeric(10),
    regno varchar(9),
    linkforimage varchar(512),
    description varchar(512),

    CONSTRAINT club_uid FOREIGN KEY(user_id) REFERENCES user(user_id)
);

CREATE TABLE if not exists clublisting(
    name varchar(32),
    question1 varchar(512),
    question2 varchar(512),
    question3 varchar(512),
    CONSTRAINT clublisting_name FOREIGN KEY(name) REFERENCES club(name)
);

CREATE TABLE IF NOT EXISTS  answers(
    name varchar(32),
    regno varchar(9),
    answer1 varchar(512),
    answer2 varchar(512),
    answer3 varchar(512),
    CONSTRAINT answers_name FOREIGN KEY(name) REFERENCES club(name),
    CONSTRAINT answers_regno FOREIGN KEY(regno) REFERENCES student(regno)
);

-- create table in sql to register students and club theyve registered in
CREATE TABLE IF NOT EXISTS registered_club(
    user_id varchar(32),
    name varchar(32),
    regno varchar(9),

    CONSTRAINT registered_uid FOREIGN KEY(user_id) REFERENCES user(user_id),
    CONSTRAINT registered_name FOREIGN KEY(name) REFERENCES club(name),
    CONSTRAINT registered_key PRIMARY KEY(user_id, name)
);

CREATE TABLE IF NOT EXISTS club_domain (
    user_id varchar(32),
    domain_offering varchar(32),
    seats_remaining numeric(10),
    CONSTRAINT domain_uid FOREIGN KEY(user_id) REFERENCES user(user_id)
);

