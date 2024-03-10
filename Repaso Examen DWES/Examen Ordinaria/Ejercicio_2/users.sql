DROP TABLE IF EXISTS `usuarios`;
DROP TABLE IF EXISTS `auth_tokens`; 

CREATE TABLE `usuarios` (
  `id` MEDIUMINT NOT NULL AUTO_INCREMENT,
  `email`       varchar(255) NOT NULL ,
  `pass`        varchar(255) NOT NULL ,
  `activo`      int default 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- Todas las contraseñas son 1234

INSERT INTO usuarios (email, pass) VALUES (
  'jorge@dwes.es', '$2y$10$2IBLoO9c2NqscjxBqKSZhe0KUTs8FeCQpXi.H4S5N8qK2GbMAQX0a'
);

INSERT INTO usuarios (email, pass) VALUES (
  'paco@dwes.es', '$2y$10$oUK2psl33/ISPfWU/RnnheZcN5So6SPFTpmdD6S6WMudkLvHY7eaa'
);

CREATE TABLE `auth_tokens` (
    `id` MEDIUMINT NOT NULL AUTO_INCREMENT,
    `token` char(33),
    `id_user` MEDIUMINT not null,
    CONSTRAINT fk_id_user FOREIGN KEY (id_user) REFERENCES usuarios(id),
    PRIMARY KEY (`id`)
);

INSERT INTO auth_tokens (token, id_user) VALUES (
  'qwert', '1'
);

INSERT INTO auth_tokens (token, id_user) VALUES (
  'asdfg', '1'
);

INSERT INTO auth_tokens (token, id_user) VALUES (
  'zxcvb', '1'
);

INSERT INTO auth_tokens (token, id_user) VALUES (
  'qwert', '2'
);

INSERT INTO auth_tokens (token, id_user) VALUES (
  'asdfg', '2'
);

INSERT INTO auth_tokens (token, id_user) VALUES (
  'zxcvb', '2'
);