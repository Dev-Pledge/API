use api;

CREATE TABLE organisations
(
  organisation_id VARCHAR(50)  NOT NULL
    PRIMARY KEY,
  name            VARCHAR(200) NOT NULL,
  data            JSON         NULL,
  created         DATETIME     NOT NULL,
  modified        DATETIME     NOT NULL,
  CONSTRAINT organisations_organisation_id_uindex
  UNIQUE (organisation_id),
  CONSTRAINT organisations_name_uindex
  UNIQUE (name)
)
  ENGINE = InnoDB;
