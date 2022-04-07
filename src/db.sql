CREATE TABLE IF NOT EXISTS user (
    user_id varchar(32),
    password varchar(64),
    type varchar(15),
    
    CONSTRAINT pkey PRIMARY KEY(user_id)
);

CREATE TABLE IF NOT EXISTS student (
    user_id varchar(32),
    fname varchar(64),
    lname varchar(64),
    regno varchar(9),
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
    name varchar(32),
    num_events numeric(10),
    regno varchar(9),
    description varchar(512),

    CONSTRAINT club_uid FOREIGN KEY(user_id) REFERENCES user(user_id)
);

CREATE TABLE IF NOT EXISTS club_domain (
    user_id varchar(32),
    domain_offering varchar(32),
    seats_remaining numeric(10),

    CONSTRAINT domain_uid FOREIGN KEY(user_id) REFERENCES user(user_id),
);

