USE api;

CREATE TABLE pledges
(
  pledge_id         VARCHAR(50)                              NOT NULL
    PRIMARY KEY,
  user_id           VARCHAR(50)                              NOT NULL,
  organisation_id   VARCHAR(50)                              NULL,
  problem_id        VARCHAR(50)                              NOT NULL,
  kudos_points      INT DEFAULT '0'                          NULL,
  value             DECIMAL(11, 4) DEFAULT '0.0000'          NOT NULL,
  currency          ENUM ('GBP', 'USD', 'EUR') DEFAULT 'USD' NULL,
  comment           VARCHAR(400)                             NULL,
  data              JSON                                     NULL,
  payment_gateway   VARCHAR(100)                             NULL,
  payment_reference TEXT                                     NULL,
  solution_id       VARCHAR(50)                              NULL,
  refunded          TINYINT(1) DEFAULT '0'                   NULL,
  created           DATETIME                                 NOT NULL,
  modified          DATETIME                                 NOT NULL
)
  ENGINE = InnoDB;

CREATE INDEX pledges_problem_id_currency_index
  ON pledges (problem_id, currency);

CREATE INDEX pledges_problem_id_created_index
  ON pledges (problem_id, created);

CREATE INDEX pledges_problem_id_index
  ON pledges (problem_id);



