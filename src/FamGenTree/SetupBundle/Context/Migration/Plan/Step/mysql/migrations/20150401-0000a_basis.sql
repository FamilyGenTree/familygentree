CREATE TABLE `###PREFIX###config` (
  id_config    INT AUTO_INCREMENT NOT NULL,
  section      VARCHAR(50)        NOT NULL,
  config_key   VARCHAR(255)       NOT NULL,
  config_value LONGTEXT DEFAULT NULL,
  UNIQUE INDEX `###PREFIX###uniq_section_config_key` (section, config_key),
  PRIMARY KEY (id_config)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_unicode_ci
  ENGINE = InnoDB;

CREATE TABLE `###PREFIX###user` (
  id_user               INT AUTO_INCREMENT              NOT NULL,
  username              VARCHAR(100)                    NOT NULL,
  username_canonical    VARCHAR(100)                    NOT NULL,
  realname              VARCHAR(100) DEFAULT NULL,
  email                 VARCHAR(255)                    NOT NULL,
  email_canonical       VARCHAR(255)                    NOT NULL,
  roles                 LONGTEXT                        NOT NULL
  COMMENT '(DC2Type:array)',
  password              VARCHAR(100) DEFAULT NULL,
  salt                  VARCHAR(100) DEFAULT NULL,
  password_algorithm    VARCHAR(15) DEFAULT 'bcrypt_10' NOT NULL,
  password_requested_at DATETIME     DEFAULT NULL,
  enabled               TINYINT(1)                      NOT NULL,
  locked                TINYINT(1)                      NOT NULL,
  last_login            DATETIME     DEFAULT NULL,
  expired               TINYINT(1)                      NOT NULL,
  expires_at            DATETIME     DEFAULT NULL,
  confirmation_token    VARCHAR(255) DEFAULT NULL,
  credentials_expired   TINYINT(1)                      NOT NULL,
  credentials_expire_at DATETIME     DEFAULT NULL,
  UNIQUE INDEX `###PREFIX###uniq_username_canonical` (username_canonical),
  UNIQUE INDEX `###PREFIX###uniq_email_canonical` (email_canonical),
  PRIMARY KEY (id_user)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_unicode_ci
  ENGINE = InnoDB;
