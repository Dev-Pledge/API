USE api;

CREATE TABLE topic_problem_maps
(
  topic      VARCHAR(100) NOT NULL,
  problem_id VARCHAR(50)  NOT NULL,
  PRIMARY KEY (topic, problem_id)
)
  ENGINE = InnoDB;
