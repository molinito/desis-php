USE votacion;

DROP TABLE IF EXISTS `regiones`;

CREATE TABLE `regiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region` varchar(64) NOT NULL,
  `abreviatura` varchar(4) NOT NULL,
  `capital` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `provincias`;

CREATE TABLE `provincias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provincia` varchar(64) NOT NULL,
  `region_id` int(11) NOT NULL REFERENCES regiones(id),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `comunas`;

CREATE TABLE `comunas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comuna` varchar(64) NOT NULL,
  `provincia_id` int(11) NOT NULL REFERENCES provincias(id),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `candidatos`;

CREATE TABLE `candidatos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `votos`;

CREATE TABLE `votos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comuna_id` int(11) NOT NULL REFERENCES comunas(id),
  `candidato_id` int(11) NOT NULL REFERENCES candidatos(id),
  `fecha` DATE NOT NULL,
  `nombre_apellido` VARCHAR(100) NOT NULL,
  `alias` VARCHAR(50) NOT NULL,
  `rut` VARCHAR(12) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `medios` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
