--GRANT ALL PRIVILEGES ON TABLE side_adzone TO jerry;
-- tables
-- Table: activity
CREATE TABLE activity (
    id serial  NOT NULL,
    nombre varchar(20)  NOT NULL,
    CONSTRAINT activity_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE activity TO adminjuez;

-- Table: allowcountry
CREATE TABLE allowcountry (
    id serial  NOT NULL,
    users_id int  NOT NULL,
    name varchar(20)  NOT NULL,
    CONSTRAINT allowcountry_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE allowcountry TO adminjuez;

-- Table: allowedlanguage
CREATE TABLE allowedlanguage (
    id serial  NOT NULL,
    language_id int  NOT NULL,
    marathonrepo_id int  NOT NULL,
    CONSTRAINT allowedlanguage_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE allowedlanguage TO adminjuez;

-- Table: answer
CREATE TABLE answer (
    id serial  NOT NULL,
    name varchar(20)  NOT NULL,
    CONSTRAINT answer_pk PRIMARY KEY (id)
);

----GRANT ALL PRIVILEGES ON TABLE answer TO adminjuez;

-- Table: inputcase
CREATE TABLE inputcase (
    id serial  NOT NULL,
    problems_id int  NOT NULL,
    filename varchar(50)  NOT NULL,
    md5 varchar(50)  NOT NULL,
    CONSTRAINT inputcase_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE inputcase TO adminjuez;

-- Table: jury
CREATE TABLE jury (
    id serial  NOT NULL,
    users_id int  NOT NULL,
    marathon_id int  NOT NULL,
    CONSTRAINT jury_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE jury TO adminjuez;

-- Table: juryclarification
CREATE TABLE juryclarification (
    id serial  NOT NULL,
    teams_id int  NOT NULL,
    jury_id int  NULL,
    marathon_id int  NOT NULL,
    text text  NOT NULL,
    time timestamp  NOT NULL,
    problems_id int  NOT NULL,
    CONSTRAINT juryclarification_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE juryclarification TO adminjuez;

-- Table: language
CREATE TABLE language (
    id serial  NOT NULL,
    name varchar(25)  NOT NULL,
    file varchar(25)  NOT NULL,
    howcompile varchar(30)  NOT NULL,
    howrun varchar(30)  NOT NULL,
    flags varchar(25)  NULL,
    CONSTRAINT language_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE language TO adminjuez;

-- Table: logs
CREATE TABLE logs (
    id serial  NOT NULL,
    users_id int  NOT NULL,
    activity_id int  NOT NULL,
    time timestamp  NOT NULL,
    ip varchar(30)  NOT NULL,
    CONSTRAINT logs_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE logs TO adminjuez;

-- Table: logsession
CREATE TABLE logsession (
    id serial  NOT NULL,
    users_id int  NOT NULL,
    error int  NOT NULL,
    time timestamp  NULL DEFAULT statement_timestamp(),
    ip varchar(30)  NOT NULL,
    CONSTRAINT logsession_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE logsession TO adminjuez;

-- Table: marathon
CREATE TABLE marathon (
    id serial  NOT NULL,
    name varchar(50)  NOT NULL,
    description varchar(150)  NOT NULL,
    date timestamp  NOT NULL,
    duration int  NOT NULL,
    timeshowanswer int  NOT NULL,
    startfreeze int  NOT NULL,
    endfreeze int  NOT NULL,
    penalty int  NOT NULL,
    marathonrepo_id int  NOT NULL,
    autostart boolean  NOT NULL,
    CONSTRAINT marathon_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE marathon TO adminjuez;

-- Table: marathoncases
CREATE TABLE marathoncases (
    id serial  NOT NULL,
    outputcase_id int  NOT NULL,
    md5submit varchar(50)  NOT NULL,
    answer_id int  NOT NULL,
    marathonreceived_id int  NOT NULL,
    filename varchar(25)  NOT NULL,
    CONSTRAINT marathoncases_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE marathoncases TO adminjuez;

-- Table: marathonreceived
CREATE TABLE marathonreceived (
    id serial  NOT NULL,
    marathon_id int  NOT NULL,
    teams_id int  NOT NULL,
    problems_id int  NOT NULL,
    answer_id int  NOT NULL,
    filename varchar(50)  NOT NULL,
    time timestamp  NOT NULL,
    verified boolean  NOT NULL,
    jury_id int  NULL,
    CONSTRAINT marathonreceived_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE marathonreceived TO adminjuez;

-- Table: marathonrepo
CREATE TABLE marathonrepo (
    id serial  NOT NULL,
    name varchar(50)  NOT NULL,
    description varchar(100)  NOT NULL,
    marathonrepoconfig_id int  NOT NULL,
    CONSTRAINT marathonrepo_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE marathonrepo TO adminjuez;

-- Table: marathonrepoconfig
CREATE TABLE marathonrepoconfig (
    id serial  NOT NULL,
    maxruntime int  NOT NULL,
    maxram int  NOT NULL,
    maxoutput int  NOT NULL,
    CONSTRAINT marathonrepoconfig_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE marathonrepoconfig TO adminjuez;

-- Table: marathonrepoid
CREATE TABLE marathonrepoid (
    id serial  NOT NULL,
    marathonrepo_id int  NOT NULL,
    problems_id int  NOT NULL,
    CONSTRAINT marathonrepoid_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE marathonrepoid TO adminjuez;

-- Table: outputcase
CREATE TABLE outputcase (
    id serial  NOT NULL,
    problems_id int  NOT NULL,
    filename varchar(50)  NOT NULL,
    inputcase_id int  NOT NULL,
    md5 varchar(50)  NOT NULL,
    CONSTRAINT outputcase_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE outputcase TO adminjuez;

-- Table: problems
CREATE TABLE problems (
    id serial  NOT NULL,
    name varchar(100)  NOT NULL,
    "level" int  NOT NULL,
    background text  NULL,
    description text  NOT NULL,
    keyword text  NULL,
    inputformat text  NOT NULL,
    outputformat text  NOT NULL,
    sampleinput text  NOT NULL,
    sampleoutput text  NOT NULL,
    hide boolean  NOT NULL,
    CONSTRAINT problems_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE problems TO adminjuez;

-- Table: received
CREATE TABLE received (
    id serial  NOT NULL,
    users_id int  NOT NULL,
    problems_id int  NOT NULL,
    filename varchar(50)  NOT NULL,
    answer_id int  NOT NULL,
    time timestamp  NOT NULL,
    runtime real  NULL,
    CONSTRAINT received_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE received TO adminjuez;

-- Table: repository
CREATE TABLE repository (
    id serial  NOT NULL,
    name varchar(50)  NOT NULL,
    description varchar(100)  NOT NULL,
    CONSTRAINT repository_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE repository TO adminjuez;

-- Table: repositoryid
CREATE TABLE repositoryid (
    id serial  NOT NULL,
    repository_id int  NOT NULL,
    problems_id int  NOT NULL,
    CONSTRAINT repositoryid_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE repositoryid TO adminjuez;

-- Table: role
CREATE TABLE role (
    id serial  NOT NULL,
    name varchar(25)  NOT NULL,
    CONSTRAINT role_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE role TO adminjuez;

-- Table: teamrequest
CREATE TABLE teamrequest (
    id serial  NOT NULL,
    teams_id int  NOT NULL,
    users_id int  NOT NULL,
    time timestamp  NOT NULL,
    CONSTRAINT teamrequest_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE teamrequest TO adminjuez;

-- Table: teams
CREATE TABLE teams (
    id serial  NOT NULL,
    name varchar(50)  NOT NULL,
    description varchar(50)  NOT NULL,
    users_id int  NOT NULL,
    "level" int  NOT NULL,
    progress int  NOT NULL,
    logo text  NOT NULL,
    CONSTRAINT teams_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE teams TO adminjuez;

-- Table: teamsallowed
CREATE TABLE teamsallowed (
    id serial  NOT NULL,
    marathon_id int  NOT NULL,
    teams_id int  NOT NULL,
    CONSTRAINT teamsallowed_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE teamsallowed TO adminjuez;

-- Table: userclarification
CREATE TABLE userclarification (
    id serial  NOT NULL,
    teams_id int  NOT NULL,
    marathon_id int  NOT NULL,
    text text  NOT NULL,
    time timestamp  NOT NULL,
    problems_id int  NOT NULL,
    CONSTRAINT userclarification_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE userclarification TO adminjuez;

-- Table: users
CREATE TABLE users (
    id serial  NOT NULL,
    name varchar(50)  NOT NULL,
    email varchar(50)  NOT NULL,
    pass varchar(32)  NOT NULL,
    teams_id int  NULL DEFAULT 0,
    role_id int  NOT NULL DEFAULT 0,
    "level" int  NOT NULL DEFAULT 0,
    progress int  NOT NULL,
    picture text  NULL,
    block boolean  NOT NULL,
    CONSTRAINT users_pk PRIMARY KEY (id)
);

--GRANT ALL PRIVILEGES ON TABLE users TO adminjuez;

GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO adminjuez;

GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO adminjuez;

CREATE UNIQUE INDEX users_idx_email on users (email ASC);


-- foreign keys
-- Reference:  allowcountry_users (table: allowcountry)


ALTER TABLE allowcountry ADD CONSTRAINT allowcountry_users 
    FOREIGN KEY (users_id)
    REFERENCES users (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  allowedlanguage_language (table: allowedlanguage)


ALTER TABLE allowedlanguage ADD CONSTRAINT allowedlanguage_language 
    FOREIGN KEY (language_id)
    REFERENCES language (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  allowedlanguage_marathonrepo (table: allowedlanguage)


ALTER TABLE allowedlanguage ADD CONSTRAINT allowedlanguage_marathonrepo 
    FOREIGN KEY (marathonrepo_id)
    REFERENCES marathonrepo (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  clarifications_marathon (table: userclarification)


ALTER TABLE userclarification ADD CONSTRAINT clarifications_marathon 
    FOREIGN KEY (marathon_id)
    REFERENCES marathon (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  exampleinput_problems (table: inputcase)


ALTER TABLE inputcase ADD CONSTRAINT exampleinput_problems 
    FOREIGN KEY (problems_id)
    REFERENCES problems (id)
    ON DELETE  CASCADE 
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  exampleoutput_problems (table: outputcase)


ALTER TABLE outputcase ADD CONSTRAINT exampleoutput_problems 
    FOREIGN KEY (problems_id)
    REFERENCES problems (id)
    ON DELETE  CASCADE 
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  jury_marathon (table: jury)


ALTER TABLE jury ADD CONSTRAINT jury_marathon 
    FOREIGN KEY (marathon_id)
    REFERENCES marathon (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  jury_users (table: jury)


ALTER TABLE jury ADD CONSTRAINT jury_users 
    FOREIGN KEY (users_id)
    REFERENCES users (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  juryclarification_jury (table: juryclarification)


ALTER TABLE juryclarification ADD CONSTRAINT juryclarification_jury 
    FOREIGN KEY (jury_id)
    REFERENCES jury (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  juryclarification_marathon (table: juryclarification)


ALTER TABLE juryclarification ADD CONSTRAINT juryclarification_marathon 
    FOREIGN KEY (marathon_id)
    REFERENCES marathon (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  logs_activity (table: logs)


ALTER TABLE logs ADD CONSTRAINT logs_activity 
    FOREIGN KEY (activity_id)
    REFERENCES activity (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  logs_users (table: logs)


ALTER TABLE logs ADD CONSTRAINT logs_users 
    FOREIGN KEY (users_id)
    REFERENCES users (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  logsession_users (table: logsession)


ALTER TABLE logsession ADD CONSTRAINT logsession_users 
    FOREIGN KEY (users_id)
    REFERENCES users (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  marathon_marathonrepo (table: marathon)


ALTER TABLE marathon ADD CONSTRAINT marathon_marathonrepo 
    FOREIGN KEY (marathonrepo_id)
    REFERENCES marathonrepo (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  marathoncases_answer (table: marathoncases)


ALTER TABLE marathoncases ADD CONSTRAINT marathoncases_answer 
    FOREIGN KEY (answer_id)
    REFERENCES answer (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  marathoncases_marathonreceived (table: marathoncases)


ALTER TABLE marathoncases ADD CONSTRAINT marathoncases_marathonreceived 
    FOREIGN KEY (marathonreceived_id)
    REFERENCES marathonreceived (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  marathoncases_outputcase (table: marathoncases)


ALTER TABLE marathoncases ADD CONSTRAINT marathoncases_outputcase 
    FOREIGN KEY (outputcase_id)
    REFERENCES outputcase (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  marathonreceived_answer (table: marathonreceived)


ALTER TABLE marathonreceived ADD CONSTRAINT marathonreceived_answer 
    FOREIGN KEY (answer_id)
    REFERENCES answer (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  marathonreceived_jury (table: marathonreceived)


ALTER TABLE marathonreceived ADD CONSTRAINT marathonreceived_jury 
    FOREIGN KEY (jury_id)
    REFERENCES jury (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  marathonreceived_marathon (table: marathonreceived)


ALTER TABLE marathonreceived ADD CONSTRAINT marathonreceived_marathon 
    FOREIGN KEY (marathon_id)
    REFERENCES marathon (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  marathonreceived_problems (table: marathonreceived)


ALTER TABLE marathonreceived ADD CONSTRAINT marathonreceived_problems 
    FOREIGN KEY (problems_id)
    REFERENCES problems (id)
    ON DELETE  CASCADE 
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  marathonreceived_teams (table: marathonreceived)


ALTER TABLE marathonreceived ADD CONSTRAINT marathonreceived_teams 
    FOREIGN KEY (teams_id)
    REFERENCES teams (id)
    ON DELETE  CASCADE 
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  marathonrepo_marathonrepoconfig (table: marathonrepo)


ALTER TABLE marathonrepo ADD CONSTRAINT marathonrepo_marathonrepoconfig 
    FOREIGN KEY (marathonrepoconfig_id)
    REFERENCES marathonrepoconfig (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  marathonrepoid_marathonrepo (table: marathonrepoid)


ALTER TABLE marathonrepoid ADD CONSTRAINT marathonrepoid_marathonrepo 
    FOREIGN KEY (marathonrepo_id)
    REFERENCES marathonrepo (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  marathonrepoid_problems (table: marathonrepoid)


ALTER TABLE marathonrepoid ADD CONSTRAINT marathonrepoid_problems 
    FOREIGN KEY (problems_id)
    REFERENCES problems (id)
    ON DELETE  CASCADE 
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  outputcase_inputcase (table: outputcase)


ALTER TABLE outputcase ADD CONSTRAINT outputcase_inputcase 
    FOREIGN KEY (inputcase_id)
    REFERENCES inputcase (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  received_answer (table: received)


ALTER TABLE received ADD CONSTRAINT received_answer 
    FOREIGN KEY (answer_id)
    REFERENCES answer (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  received_problems (table: received)


ALTER TABLE received ADD CONSTRAINT received_problems 
    FOREIGN KEY (problems_id)
    REFERENCES problems (id)
    ON DELETE  CASCADE 
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  received_users (table: received)


ALTER TABLE received ADD CONSTRAINT received_users 
    FOREIGN KEY (users_id)
    REFERENCES users (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  repositoryid_problems (table: repositoryid)


ALTER TABLE repositoryid ADD CONSTRAINT repositoryid_problems 
    FOREIGN KEY (problems_id)
    REFERENCES problems (id)
    ON DELETE  CASCADE 
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  repositoryid_repository (table: repositoryid)


ALTER TABLE repositoryid ADD CONSTRAINT repositoryid_repository 
    FOREIGN KEY (repository_id)
    REFERENCES repository (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  team_users (table: teams)


ALTER TABLE teams ADD CONSTRAINT team_users 
    FOREIGN KEY (users_id)
    REFERENCES users (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  teamrequest_team (table: teamrequest)


ALTER TABLE teamrequest ADD CONSTRAINT teamrequest_team 
    FOREIGN KEY (teams_id)
    REFERENCES teams (id)
    ON DELETE  CASCADE 
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  teamrequest_users (table: teamrequest)


ALTER TABLE teamrequest ADD CONSTRAINT teamrequest_users 
    FOREIGN KEY (users_id)
    REFERENCES users (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  teamsallowed_marathon (table: teamsallowed)


ALTER TABLE teamsallowed ADD CONSTRAINT teamsallowed_marathon 
    FOREIGN KEY (marathon_id)
    REFERENCES marathon (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  teamsallowed_teams (table: teamsallowed)


ALTER TABLE teamsallowed ADD CONSTRAINT teamsallowed_teams 
    FOREIGN KEY (teams_id)
    REFERENCES teams (id)
    ON DELETE  CASCADE 
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  userclarification_problems (table: userclarification)


ALTER TABLE userclarification ADD CONSTRAINT userclarification_problems 
    FOREIGN KEY (problems_id)
    REFERENCES problems (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  userclarification_teams (table: userclarification)


ALTER TABLE userclarification ADD CONSTRAINT userclarification_teams 
    FOREIGN KEY (teams_id)
    REFERENCES teams (id)
    ON DELETE  CASCADE 
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  users_role (table: users)


ALTER TABLE users ADD CONSTRAINT users_role 
    FOREIGN KEY (role_id)
    REFERENCES role (id)
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

-- Reference:  users_team (table: users)


ALTER TABLE users ADD CONSTRAINT users_team 
    FOREIGN KEY (teams_id)
    REFERENCES teams (id)
    ON DELETE  CASCADE 
    NOT DEFERRABLE 
    INITIALLY IMMEDIATE 
;

--
-- Data for Name: role;
--

INSERT INTO role VALUES (0, 'Root');
INSERT INTO role VALUES (1, 'User');
INSERT INTO role VALUES (2, 'Jury');
INSERT INTO role VALUES (3, 'Admin');

--
-- Data for Name: answer;
--

INSERT INTO answer VALUES (0, 'QUEUED/PENDING');
INSERT INTO answer VALUES (1, 'JUDGING');
INSERT INTO answer VALUES (2, 'TOO-LATE');
INSERT INTO answer VALUES (3, 'CORRECT');
INSERT INTO answer VALUES (4, 'COMPILER-ERROR');
INSERT INTO answer VALUES (5, 'TIMELIMIT');
INSERT INTO answer VALUES (6, 'RUN-ERROR');
INSERT INTO answer VALUES (7, 'NO-OUTPUT');
INSERT INTO answer VALUES (8, 'WRONG-ANSWER');
INSERT INTO answer VALUES (9, 'PRESENTATION-ERROR');
INSERT INTO answer VALUES (10, 'SKIP');

-- End of file.
