USE api;

CREATE TABLE problems
(
  problem_id        VARCHAR(50)            NOT NULL
    PRIMARY KEY,
  user_id           VARCHAR(50)            NULL,
  organisation_id   VARCHAR(50)            NULL,
  title             VARCHAR(67)            NOT NULL,
  specification     TEXT                   NULL,
  description       VARCHAR(400)           NOT NULL,
  active_datetime   DATETIME               NULL,
  deadline_datetime DATETIME               NULL,
  deleted           TINYINT(1) DEFAULT '0' NULL,
  data              JSON                   NULL,
  created           DATETIME               NOT NULL,
  modified          DATETIME               NOT NULL
)
  ENGINE = InnoDB
  CHARSET = utf8;

CREATE INDEX problems_user_id_problem_id_index
  ON problems (user_id, problem_id);

CREATE INDEX problems_organisation_id_problem_id_index
  ON problems (organisation_id, problem_id);

CREATE INDEX problems_created_index
  ON problems (created);

CREATE INDEX problems_modified_index
  ON problems (modified);

