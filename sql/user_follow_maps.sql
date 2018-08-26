USE api;

CREATE TABLE user_follow_maps
(
  user_id   VARCHAR(50) NOT NULL,
  entity_id VARCHAR(50) NOT NULL,
  entity    VARCHAR(50) NOT NULL,
  created   DATETIME    NOT NULL,
  PRIMARY KEY (user_id, entity_id)
)
  ENGINE = InnoDB;

CREATE INDEX user_follow_maps_user_id_entity_index
  ON user_follow_maps (user_id, entity);

CREATE INDEX user_id_created_index
  ON user_follow_maps (user_id, created);

CREATE INDEX user_id_index
  ON user_follow_maps (user_id);

CREATE INDEX id_created_index
  ON user_follow_maps (entity_id, created);

CREATE INDEX id_index
  ON user_follow_maps (entity_id);