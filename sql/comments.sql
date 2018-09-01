USE api;

CREATE TABLE comments
(
  comment_id VARCHAR(50) NOT NULL
    PRIMARY KEY,
  comment    TINYTEXT    NOT NULL,
  entity_id  VARCHAR(50) NOT NULL,
  user_id    VARCHAR(50) NULL,
  organisation_id VARCHAR(50) NULL,
  modified   DATETIME    NOT NULL,
  created    DATETIME    NOT NULL
)
  ENGINE = InnoDB
  CHARSET = utf8;

CREATE INDEX comment_created_entity
  ON comments (entity_id, created);
