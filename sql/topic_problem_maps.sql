USE api;

CREATE TABLE topic_problem_maps
(
  topic      VARCHAR(50) NOT NULL,
  problem_id VARCHAR(50)  NOT NULL,
  created    DATETIME     NOT NULL,
  PRIMARY KEY (topic, problem_id)
)
  ENGINE = InnoDB
  CHARSET = utf8;

CREATE INDEX topic_index
  ON topic_problem_maps (topic);

CREATE INDEX topic_created_index
  ON topic_problem_maps (topic,created);

CREATE INDEX problem_id_created_index
  ON topic_problem_maps (problem_id,created);

CREATE INDEX problem_id_index
  ON topic_problem_maps (problem_id);