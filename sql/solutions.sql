USE api;

CREATE TABLE solutions
(
  solution_id               VARCHAR(50) NOT NULL
    PRIMARY KEY,
  solution_group_id         VARCHAR(50) NULL,
  problem_solution_group_id VARCHAR(50) NULL,
  user_id                   VARCHAR(50) NOT NULL,
  problem_id                VARCHAR(50) NOT NULL,
  name                      VARCHAR(50) NOT NULL,
  open_source_location      TEXT        NULL,
  data                      JSON        NULL,
  created                   DATETIME    NOT NULL,
  modified                  DATETIME    NOT NULL
)
  ENGINE = InnoDB;

CREATE INDEX solutions_problem_id_user_id_index
  ON solutions (problem_id, user_id);

CREATE INDEX solutions_problem_id_created_index
  ON solutions (problem_id, created);

CREATE INDEX solutions_problem_id_index
  ON solutions (problem_id);

