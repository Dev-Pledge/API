use api;

create table problems
(
  problem_id        varchar(50)            NOT NULL
    primary key,
  user_id           varchar(50)            NOT NULL,
  title             varchar(67)            NOT NULL,
  specification     TEXT                   NULL,
  description       varchar(400)           NOT NULL,
  active_datetime   DATETIME               NULL,
  deadline_datetime DATETIME               NULL,
  deleted           TINYINT(1) default '0' NULL,
  data              JSON                   NULL,
  created           DATETIME               NOT NULL,
  modified          DATETIME               NOT NULL
);