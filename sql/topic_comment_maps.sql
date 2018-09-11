USE api;

CREATE TABLE topic_comment_maps
(
  topic      VARCHAR(50) NOT NULL,
  comment_id VARCHAR(50) NOT NULL,
  created    DATETIME    NOT NULL,
  PRIMARY KEY (topic, comment_id)
)
  ENGINE = InnoDB
  CHARSET = utf8;

CREATE INDEX topic_created_index
  ON topic_comment_maps (topic, created);

CREATE INDEX topic
  ON topic_comment_maps (topic);

CREATE INDEX comment_id_created_index
  ON topic_comment_maps (comment_id, created);

CREATE INDEX comment_id
  ON topic_comment_maps (comment_id);
