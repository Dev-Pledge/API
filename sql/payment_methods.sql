USE api;

CREATE TABLE payment_methods
(
  payment_method_id VARCHAR(50)  NOT NULL
    PRIMARY KEY,
  user_id           VARCHAR(50)  NULL,
  organisation_id   VARCHAR(50)  NULL,
  gateway           VARCHAR(200) NOT NULL,
  name              VARCHAR(50)  NOT NULL,
  data              JSON         NULL,
  created           DATETIME     NOT NULL,
  modified          DATETIME     NOT NULL
)
  ENGINE = InnoDB
  CHARSET = utf8;

CREATE INDEX payment_methods_user_id_created_index
  ON payment_methods (user_id, created);

CREATE INDEX payment_methods_organisation_id_created_index
  ON payment_methods (organisation_id, created);

