USE api;

CREATE TABLE comments
(
  comment_id        VARCHAR(50) NOT NULL
    PRIMARY KEY,
  parent_comment_id VARCHAR(50) NULL,
  comment           TINYTEXT    NOT NULL,
  entity_id         VARCHAR(50) NOT NULL,
  user_id           VARCHAR(50) NULL,
  organisation_id   VARCHAR(50) NULL,
  modified          DATETIME    NOT NULL,
  created           DATETIME    NOT NULL
)
  ENGINE = InnoDB
  CHARSET = utf8;

CREATE INDEX comment_created_parent
  ON comments (parent_comment_id, created);

CREATE INDEX comment_created_entity
  ON comments (entity_id, created);

CREATE INDEX comment_entity_user_id_created_parent
  ON comments (user_id, entity_id, parent_comment_id, created);
