create table pledges
(
  pledge_id       VARCHAR(50)                              NOT NULL
    primary key,
  user_id         VARCHAR(50)                              NOT NULL,
  organisation_id VARCHAR(50)                              NULL,
  problem_id      VARCHAR(50)                              NOT NULL,
  kudos_points    INT DEFAULT '0'                          NULL,
  value           DECIMAL(11, 4) DEFAULT '0.0000'          NOT NULL,
  currency        ENUM ('GBP', 'USD', 'EUR') DEFAULT 'USD' NULL,
  comment         VARCHAR(400)                             NULL,
  data            JSON                                     NULL,
  created         DATETIME                                 NOT NULL,
  modified        DATETIME                                 NOT NULL
);