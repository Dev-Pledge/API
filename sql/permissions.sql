USE api;

CREATE TABLE permissions
(
  permission_id VARCHAR(50)                                     NOT NULL
    PRIMARY KEY,
  user_id       VARCHAR(50)                                     NOT NULL,
  resource      VARCHAR(200)                                    NOT NULL,
  resource_id   VARCHAR(50)                                     NULL,
  action        ENUM ('create','read', 'update', 'delete') DEFAULT 'read' NULL,
  CONSTRAINT permissions_user_id_resource_resource_id_uindex
  UNIQUE (user_id, resource, resource_id)
)
  ENGINE = InnoDB;

CREATE INDEX permissions_user_id_resource_index
  ON permissions (user_id, resource);