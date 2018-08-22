USE api;

CREATE TABLE payments
(
  payment_id      VARCHAR(50)                              NOT NULL
    PRIMARY KEY,
  user_id         VARCHAR(50)                              NULL,
  organisation_id VARCHAR(50)                              NULL,
  value           DECIMAL(11, 4) DEFAULT '0.0000'          NULL,
  currency        ENUM ('GBP', 'USD', 'EUR') DEFAULT 'USD' NULL,
  gateway         VARCHAR(200)                             NOT NULL,
  reference       VARCHAR(200)                             NOT NULL,
  data            JSON                                     NULL,
  created         DATETIME                                 NOT NULL,
  modified        DATETIME                                 NOT NULL
)
  ENGINE = InnoDB;

CREATE INDEX payments_user_id_created_index
  ON payments (user_id, created);

CREATE INDEX payments_organisation_id_created_index
  ON payments (organisation_id, created);

CREATE INDEX payments_reference_index
  ON payments (reference);