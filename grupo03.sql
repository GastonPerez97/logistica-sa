-- MySQL Script generated by MySQL Workbench
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema grupo03
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema grupo03
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `grupo03` ;
USE `grupo03` ;

-- -----------------------------------------------------
-- Table `grupo03`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(50) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `dni` VARCHAR(45) NOT NULL,
  `birthdate` DATE NOT NULL,
  `fecha_alta` DATE NOT NULL,
  `activado` BIT NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `dni_UNIQUE` (`dni` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`rol` (
  `id_rol` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(100) NULL,
  PRIMARY KEY (`id_rol`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`usuario_rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`usuario_rol` (
  `id_usuario` INT NOT NULL,
  `id_rol` INT NOT NULL,
  PRIMARY KEY (`id_usuario`, `id_rol`),
  INDEX `rol_FK_idx` (`id_rol` ASC),
  CONSTRAINT `usuario_rol_FK`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `grupo03`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `rol_FK`
    FOREIGN KEY (`id_rol`)
    REFERENCES `grupo03`.`rol` (`id_rol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`tipo_licencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`tipo_licencia` (
  `id_tipo_licencia` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(100) NULL,
  PRIMARY KEY (`id_tipo_licencia`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`chofer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`chofer` (
  `id_chofer` INT NOT NULL AUTO_INCREMENT,
  `numero_licencia` VARCHAR(45) NOT NULL,
  `id_tipo_licencia` INT NOT NULL,
  `id_usuario` INT,
  PRIMARY KEY (`id_chofer`),
  UNIQUE INDEX `license_number_UNIQUE` (`numero_licencia` ASC),
  INDEX `id_tipo_licencia_INDEX` (`id_tipo_licencia` ASC),
  CONSTRAINT `tipo_licencia_FK`
    FOREIGN KEY (`id_tipo_licencia`)
    REFERENCES `grupo03`.`tipo_licencia` (`id_tipo_licencia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `usuario_chofer_FK`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `grupo03`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `grupo03`.`marca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`marca` (
  `id_marca` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_marca`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`modelo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`modelo` (
  `id_modelo` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `id_marca` INT NOT NULL,
  PRIMARY KEY (`id_modelo`),
  INDEX `id_marca_INDEX` (`id_marca` ASC),
  CONSTRAINT `marca_FK`
    FOREIGN KEY (`id_marca`)
    REFERENCES `grupo03`.`marca` (`id_marca`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`unidad_de_transporte`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`unidad_de_transporte` (
  `id_unidad_de_transporte` INT NOT NULL AUTO_INCREMENT,
  `patente` VARCHAR(45) NOT NULL,
  `posicion_actual` VARCHAR(150) NOT NULL DEFAULT 'Sin posicion actual',
  `anio_fabricacion` TINYINT NOT NULL DEFAULT '0',
  `numero_chasis` VARCHAR(45) NOT NULL,
  `id_marca` INT NOT NULL DEFAULT '10000',
  `id_modelo` INT NOT NULL DEFAULT '10000',
  `activo` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_unidad_de_transporte`),
  UNIQUE INDEX `patente_UNIQUE` (`patente` ASC),
  UNIQUE INDEX `numero_chasis_UNIQUE` (`numero_chasis` ASC),
  INDEX `id_marca_INDEX` (`id_marca` ASC),
  INDEX `id_modelo_INDEX` (`id_modelo` ASC),
  CONSTRAINT `marca_transporte_FK`
    FOREIGN KEY (`id_marca`)
    REFERENCES `grupo03`.`marca` (`id_marca`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `modelo_transporte_FK`
    FOREIGN KEY (`id_modelo`)
    REFERENCES `grupo03`.`modelo` (`id_modelo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`service`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`service` (
  `id_service` INT NOT NULL AUTO_INCREMENT,
  `fecha_service` DATE NOT NULL,
  `detalle` VARCHAR(150) NOT NULL,
  `costo` DECIMAL(10,2) UNSIGNED NOT NULL,
  `kilometraje_actual_unidad` INT UNSIGNED NOT NULL,
  `interno` BIT NOT NULL,
  `id_usuario` INT NOT NULL,
  `id_unidad_de_transporte` INT NOT NULL,
  PRIMARY KEY (`id_service`),
  INDEX `id_usuario_INDEX` (`id_usuario` ASC),
  INDEX `id_unidad_de_transporte_INDEX` (`id_unidad_de_transporte` ASC),
  CONSTRAINT `usuario_service_FK`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `grupo03`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `unidad_de_transporte_FK`
    FOREIGN KEY (`id_unidad_de_transporte`)
    REFERENCES `grupo03`.`unidad_de_transporte` (`id_unidad_de_transporte`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`tipo_remolque`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`tipo_remolque` (
  `id_tipo_remolque` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `peso_maximo` INT NOT NULL,
  PRIMARY KEY (`id_tipo_remolque`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`remolque`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`remolque` (
  `id_remolque` INT NOT NULL AUTO_INCREMENT,
  `id_tipo_remolque` INT NOT NULL,
  PRIMARY KEY (`id_remolque`),
  INDEX `id_tipo_remolque_INDEX` (`id_tipo_remolque` ASC),
  CONSTRAINT `unidad_de_transporte_remolque_FK`
    FOREIGN KEY (`id_remolque`)
    REFERENCES `grupo03`.`unidad_de_transporte` (`id_unidad_de_transporte`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `tipo_remolque_FK`
    FOREIGN KEY (`id_tipo_remolque`)
    REFERENCES `grupo03`.`tipo_remolque` (`id_tipo_remolque`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`tipo_vehiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`tipo_vehiculo` (
  `id_tipo_vehiculo` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_tipo_vehiculo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`viaje`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`viaje` (
  `id_viaje` INT NOT NULL AUTO_INCREMENT,
  `consumo_combustible_previsto` DECIMAL(10,2) NOT NULL,
  `consumo_combustible_real` DECIMAL(10,2) ZEROFILL NULL,
  `kilometros_previstos` DECIMAL(10,2) NOT NULL,
  `kilometros_reales` DECIMAL(10,2) ZEROFILL NULL,
  `origen` VARCHAR(150) NOT NULL,
  `destino` VARCHAR(150) NOT NULL,
  `fecha_salida_estimada` DATETIME NOT NULL,
  `fecha_salida` DATETIME NULL,
  `fecha_llegada_estimada` DATETIME NOT NULL,
  `fecha_llegada` DATETIME NULL,
  `id_cliente` INT NOT NULL,
  PRIMARY KEY (`id_viaje`),
  INDEX `id_cliente_INDEX` (`id_cliente` ASC),
    CONSTRAINT `id_cliente_FK`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `grupo03`.`cliente` (`id_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`tipo_carga`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`tipo_carga` (
  `id_tipo_carga` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_tipo_carga`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`carga`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`carga` (
  `id_carga` INT NOT NULL AUTO_INCREMENT,
  `peso` DECIMAL(10,2) ZEROFILL NOT NULL,
  `fragil` BIT NOT NULL,
  `refrigerada` BIT NOT NULL,
  `temperatura` INT NULL,
  `id_tipo_carga` INT NOT NULL,
  `id_viaje` INT NOT NULL,
  PRIMARY KEY (`id_carga`),
  INDEX `id_tipo_carga_INDEX` (`id_tipo_carga` ASC),
  INDEX `id_viaje_INDEX` (`id_viaje` ASC),
  CONSTRAINT `viaje_carga_FK`
    FOREIGN KEY (`id_viaje`)
    REFERENCES `grupo03`.`viaje` (`id_viaje`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `tipo_carga_FK`
    FOREIGN KEY (`id_tipo_carga`)
    REFERENCES `grupo03`.`tipo_carga` (`id_tipo_carga`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`desvio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`desvio` (
  `id_desvio` INT NOT NULL AUTO_INCREMENT,
  `razon` VARCHAR(100) NOT NULL,
  `tiempo` TIME NOT NULL,
  PRIMARY KEY (`id_desvio`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`viaje_desvio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`viaje_desvio` (
  `id_viaje` INT NOT NULL,
  `id_desvio` INT NOT NULL,
  PRIMARY KEY (`id_viaje`, `id_desvio`),
  INDEX `desvio_FK_idx` (`id_desvio` ASC),
  CONSTRAINT `viaje_desvio_FK`
    FOREIGN KEY (`id_viaje`)
    REFERENCES `grupo03`.`viaje` (`id_viaje`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `desvio_FK`
    FOREIGN KEY (`id_desvio`)
    REFERENCES `grupo03`.`desvio` (`id_desvio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`carga_combustible`
-- -----------------------------------------------------
CREATE TABLE `grupo03`.`carga_combustible` (
 `id_carga_combustible` INT(11) NOT NULL AUTO_INCREMENT ,
 `lugar` VARCHAR(100) NOT NULL ,
 `cantidad` DECIMAL(10,2) NOT NULL ,
 `importe` DECIMAL(10,2) NOT NULL ,
 PRIMARY KEY (`id_carga_combustible`)) 
 ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`viaje_carga_combustible`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`viaje_carga_combustible` (
  `id_viaje` INT NOT NULL,
  `id_carga_combustible` INT NOT NULL,
  PRIMARY KEY (`id_viaje`, `id_carga_combustible`),
  INDEX `carga_combustible_FK_idx` (`id_carga_combustible` ASC),
  CONSTRAINT `viaje_carga_combustible_FK`
    FOREIGN KEY (`id_viaje`)
    REFERENCES `grupo03`.`viaje` (`id_viaje`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `carga_combustible_FK`
    FOREIGN KEY (`id_carga_combustible`)
    REFERENCES `grupo03`.`carga_combustible` (`id_carga_combustible`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`posicion`
-- -----------------------------------------------------
CREATE TABLE `grupo03`.`posicion` (
 `id_posicion` INT(11) NOT NULL AUTO_INCREMENT ,
 `latitud` DECIMAL(10, 8) NOT NULL ,
 `longitud` DECIMAL(11, 8) NOT NULL ,
 PRIMARY KEY (`id_posicion`)) 
 ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`viaje_posicion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`viaje_posicion` (
  `id_viaje` INT NOT NULL,
  `id_posicion` INT NOT NULL,
  PRIMARY KEY (`id_viaje`, `id_posicion`),
  INDEX `posicion_FK_idx` (`id_posicion` ASC),
  CONSTRAINT `viaje_posicion_FK`
    FOREIGN KEY (`id_viaje`)
    REFERENCES `grupo03`.`viaje` (`id_viaje`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `posicion_FK`
    FOREIGN KEY (`id_posicion`)
    REFERENCES `grupo03`.`posicion` (`id_posicion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`viaje_chofer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`viaje_chofer` (
  `id_viaje` INT NOT NULL,
  `id_chofer` INT NOT NULL,
  PRIMARY KEY (`id_viaje`, `id_chofer`),
  INDEX `chofer_FK_idx` (`id_chofer` ASC),
  CONSTRAINT `viaje_chofer_FK`
    FOREIGN KEY (`id_viaje`)
    REFERENCES `grupo03`.`viaje` (`id_viaje`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `chofer_FK`
    FOREIGN KEY (`id_chofer`)
    REFERENCES `grupo03`.`chofer` (`id_chofer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`cliente` (
  `id_cliente` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(50) NOT NULL,
  `cuit` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(45) NOT NULL,
  `denominacion` VARCHAR(45) NOT NULL,
  `contacto1` VARCHAR(45) NULL,
  `contacto2` VARCHAR(45) NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `cuit_UNIQUE` (`cuit` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`factura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`factura` (
  `id_factura` INT NOT NULL AUTO_INCREMENT,
  `numero_factura` VARCHAR(45) NOT NULL,
  `fecha_facturacion` DATE NOT NULL,
  `fecha_pago` DATE NULL,
  `id_cliente` INT NOT NULL,
  `id_viaje` INT NOT NULL,
  PRIMARY KEY (`id_factura`),
  INDEX `id_cliente_INDEX` (`id_cliente` ASC),
  INDEX `id_viaje_INDEX` (`id_viaje` ASC),
  CONSTRAINT `cliente_FK`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `grupo03`.`cliente` (`id_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `viaje_factura_FK`
    FOREIGN KEY (`id_viaje`)
    REFERENCES `grupo03`.`viaje` (`id_viaje`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`viaje_unidad_de_transporte`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`viaje_unidad_de_transporte` (
  `id_viaje` INT NOT NULL,
  `id_unidad_de_transporte` INT NOT NULL,
  PRIMARY KEY (`id_viaje`, `id_unidad_de_transporte`),
  INDEX `id_unidad_de_transporte_idx` (`id_unidad_de_transporte` ASC),
  CONSTRAINT `viaje_transporte_FK`
    FOREIGN KEY (`id_viaje`)
    REFERENCES `grupo03`.`viaje` (`id_viaje`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `unidad_de_transporte_viaje_FK`
    FOREIGN KEY (`id_unidad_de_transporte`)
    REFERENCES `grupo03`.`unidad_de_transporte` (`id_unidad_de_transporte`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`vehiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`vehiculo` (
  `id_vehiculo` INT NOT NULL,
  `numero_motor` VARCHAR(45) NOT NULL,
  `kilometraje` DECIMAL(10,2) NOT NULL,
  `id_tipo_vehiculo` INT NOT NULL,
  PRIMARY KEY (`id_vehiculo`),
  UNIQUE INDEX `numero_motor_UNIQUE` (`numero_motor` ASC),
  INDEX `id_tipo_vehiculo_INDEX` (`id_tipo_vehiculo` ASC),
  INDEX `unidad_de_transporte_FK_idx` (`id_vehiculo` ASC),
  CONSTRAINT `unidad_de_transporte_vehiculo_FK`
    FOREIGN KEY (`id_vehiculo`)
    REFERENCES `grupo03`.`unidad_de_transporte` (`id_unidad_de_transporte`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `tipo_vehiculo_FK`
    FOREIGN KEY (`id_tipo_vehiculo`)
    REFERENCES `grupo03`.`tipo_vehiculo` (`id_tipo_vehiculo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo03`.`factura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo03`.`factura` (
  `id_factura` INT NOT NULL AUTO_INCREMENT,
  `numero_factura` VARCHAR(45) NOT NULL,
  `fecha_facturacion` DATE NOT NULL,
  `fecha_pago` DATE NULL,
  `id_cliente` INT NOT NULL,
  `id_viaje` INT NOT NULL,
  PRIMARY KEY (`id_factura`),
  INDEX `id_cliente_INDEX` (`id_cliente` ASC),
  INDEX `id_viaje_INDEX` (`id_viaje` ASC),
  CONSTRAINT `cliente_FK`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `grupo03`.`cliente` (`id_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `viaje_factura_FK`
    FOREIGN KEY (`id_viaje`)
    REFERENCES `grupo03`.`viaje` (`id_viaje`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `grupo03`.`proforma`
-- -----------------------------------------------------
CREATE TABLE `grupo03`.`proforma` (
  `id_proforma` INT NOT NULL AUTO_INCREMENT,
  `fecha_carga_proforma` DATE NOT NULL,
  `id_viaje` INT NOT NULL,
  `viatico_estimado` INT NOT NULL,
  `peaje_y_pesaje_estimado` INT NOT NULL,
  `extras_estimado` INT NULL,
  `hazard_estimado` INT NULL,
  `reefer_estimado` INT NULL,
  `fee_estimado` INT NOT NULL,
  `viatico_real` INT NULL,
  `peaje_y_pesaje_real` INT NULL,
  `extras_real` INT NULL,
  `hazard_real` INT NULL,
  `reefer_real` INT NULL,
  `fee_real` INT NULL,
  PRIMARY KEY (`id_proforma`),
  INDEX `id_viaje_INDEX` (`id_viaje` ASC),
  CONSTRAINT `viaje_FK`
    FOREIGN KEY (`id_viaje`)
    REFERENCES `grupo03`.`viaje` (`id_viaje`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



-- -----------------------------------------------------
-- INSERTS
-- -----------------------------------------------------
-- INSERT INTO usuario (id_usuario, email, dni, password, nombre, apellido, birthdate, fecha_alta, activado) VALUES (2, 'mail@test.com', 124567, '81dc9bdb52d04dc20036dbd8313ed055', 'Jorge', 'Perez', '1960-12-11', '2020-11-17', b'1');
-- INSERT INTO `grupo03`.`tipo_vehiculo` (`id_tipo_vehiculo`, `nombre`) VALUES ('1', 'camion');
-- INSERT INTO `grupo03`.`marca` (`id_marca`, `nombre`) VALUES ('1', 'fiat');
-- INSERT INTO `grupo03`.`modelo` (`id_modelo`, `nombre`, `id_marca`) VALUES ('1', 'cargo', '1');
-- INSERT INTO `grupo03`.`unidad_de_transporte` (`id_unidad_de_transporte`, `patente`, `posicion_actual`, `anio_fabricacion`, `numero_chasis`, `id_marca`, `id_modelo`) VALUES ('1', 'abc123', 'acb', '94', '234423342', '1', '1');
-- INSERT INTO `grupo03`.`vehiculo` (`id_vehiculo`, `numero_motor`, `kilometraje`, `id_tipo_vehiculo`) VALUES ('1', '23423', '60000', '1');
-- INSERT INTO `grupo03`.`service` (`id_service`, `fecha_service`, `detalle`, `costo`, `kilometraje_actual_unidad`, `interno`, `id_usuario`, `id_unidad_de_transporte`) VALUES ('1', '1111-11-11', 'cambio de aceite', '15000', '65000', b'0', '2', b'1');

-- (contraseña usuario id 1: 1234) 
INSERT INTO rol (id_rol, nombre, descripcion) VALUES (1, 'Administrador', 'AdminDesc'), (2, 'Supervisor', 'SupervisorDesc'), (3, 'Encargado de Taller', 'EncargadoTallerDesc'), (4, 'Chofer', 'ChoferDesc');
INSERT INTO usuario (id_usuario, email, dni, password, nombre, apellido, birthdate, fecha_alta, activado) VALUES (1, 'mail@mail.com', 1234567, '81dc9bdb52d04dc20036dbd8313ed055', 'Juan', 'Perez', '1960-11-11', '2020-11-17', b'1');
INSERT INTO usuario_rol (id_usuario, id_rol) VALUES (1, 1), (1, 2), (1, 3), (1, 4);



-- EQUIPOS: -- 

-- MARCAS: -- 
INSERT INTO marca (id_marca, nombre) VALUES (2, 'IVECO'), (3, 'SCANIA'), (4, 'M.BENZ'), (10000, 'No especificado');

-- MODELOS: -- 
INSERT INTO modelo (id_modelo, nombre, id_marca) VALUES (2, 'Cursor', 2),
													   (3, 'G310', 3),
													   (4, 'G410', 3),
                                                       (5, 'G460', 3), 
                                                       (6, 'Actros 1846', 4),
                                                       (10000, 'No especificado', 10000);
                                                       
-- TIPO DE REMOLQUE/ARRASTRE --

INSERT INTO tipo_remolque (id_tipo_remolque, nombre, peso_maximo) VALUES (1, 'Araña', '100000'),
																		 (2, 'Jaula', '150000'),
																		 (3, 'Tanque', '15000'),
																		 (4, 'Granel', '30000'),
																		 (5, 'CarCarrier', '200000');

-- TRACTORES/UNIDADES DE TRANSPORTE: --

INSERT INTO unidad_de_transporte (id_unidad_de_transporte, id_marca, id_modelo, patente, numero_chasis, anio_fabricacion)
			VALUES (2, 2, 2, 'AA123CD', 'L53879558', '95'),
					(3, 2, 2, 'AA124DC', 'R69904367', '92'),
					(4, 2, 2, 'AD200XS', 'R57193968', '95'),
					(5, 2, 2, 'AA211ZX', 'N82836641', '98'),
					(6, 2, 2, 'AC452WE', 'R28204636', '96'),
					(7, 2, 2, 'AA233SS', 'K26139668', '91'),
					(8, 2, 2, 'AB900QW', 'F44301415', '92'),
					(9, 2, 2, 'AC342WW', 'D44260023', '95'),
					(10, 3, 3, 'AA150QW', 'I82039512', '97'),
					(11, 3, 4, 'AB198QZ', 'V18389741', '96'),
					(12, 3, 5, 'AC246QD', 'O62500687', '95'),
					(13, 3, 3, 'AD294QW', 'T27510702', '93'),
					(14, 3, 4, 'AA342QZ', 'C72582865', '99'),
					(15, 3, 5, 'AB390QD', 'Z32041290', '95'),
					(16, 3, 3, 'AC438QW', 'W54712451', '91'),
					(17, 3, 4, 'AD486QZ', 'L56284263', '94'),
					(18, 3, 5, 'AA534QD', 'A21357689', '90'),
					(19, 4, 6, 'AB582QW', 'V17800122', '96'),
					(20, 4,	6, 'AC630QZ', 'G88648319', '95'),
					(21, 4,	6, 'AD678QD', 'C23849041', '90'),
					(22, 4,	6, 'AA726QW', 'C54650513', '94'),
					(23, 4,	6, 'AB774QZ', 'J46753468', '93'),
					(24, 4,	6, 'AC822QD', 'J60916748', '95'),
					(25, 4,	6, 'AD870QW', 'M30207594', '97'),
					(26, 4,	6, 'AA918QZ', 'C31256965', '90'),
					(27, 4,	6, 'AB966QD', 'B32632699', '93'),
					(28, 4,	6, 'AC989QW', 'F64092078', '90');

-- UNIDAD DE TRANSPORTE, REMOLQUES: --                    
INSERT INTO unidad_de_transporte (id_unidad_de_transporte, patente, numero_chasis) 
								VALUES (100, 'AA100AS', '585822'),
										(101, 'AC125AD', '605737'),
										(102, 'AB135AG', '705687'),
										(103, 'AD166AS', '815082'),
										(104, 'AA189AD', '775167'),
										(105, 'AC208AG', '642287'),
										(106, 'AB230AS', '678666'),
										(107, 'AD252AD', '758967'),
										(108, 'AA274AG', '498515'),
										(109, 'AC296AS', '882174'),
										(110, 'AB318AD', '595287'),
										(111, 'AD340AG', '549916'),
										(112, 'AA362AS', '831768'),
										(113, 'AC383AD', '535330'),
										(114, 'AB405AG', '583419'),
										(115, 'AD427AS', '703673'),
										(116, 'AA449AD', '884654'),
										(117, 'AC471AG', '510019'),
										(118, 'AB493AS', '595948'),
										(119, 'AD515AD', '704640'),
										(120, 'AA537AG', '752105'),
										(121, 'AC559AS', '554550'),
										(122, 'AB581AD', '761560'),
										(123, 'AD602AG', '555608'),
										(124, 'AA624AS', '852157'),
										(125, 'AC646AD', '710797'),
										(126, 'AB668AG', '815072'),
										(127, 'AD690AS', '495851'),
										(128, 'AA712AD', '468708'),
										(129, 'AC734AG', '661897'),
										(130, 'AB756AS', '616372'),
										(131, 'AD778AD', '873758'),
										(132, 'AA800AG', '820810'),
										(133, 'AC821AS', '731202'),
										(134, 'AB843AD', '670323'),
										(135, 'AD865AG', '747642'),
										(136, 'AA887AS', '777450'),
										(137, 'AC909AD', '485098'),
										(138, 'AB931AG', '806730'),
										(139, 'AD953AS', '729910'),
										(140, 'AA975AD', '726457'),
										(141, 'AC997AG', '730861'),
										(142, 'AD100AZ', '730027'),
										(143, 'AD100AQ', '730502'),
										(144, 'AD100ER', '730978'),
										(145, 'AD101EF', '731453'),
										(146, 'AD102HG', '731929'),
										(147, 'AD103LO', '732404'),
										(148, 'AD104WE', '732880'),
										(149, 'AD105ZP', '733355');

-- REMOLQUE/ARRASTRE --
INSERT INTO remolque (id_remolque, id_tipo_remolque) VALUES (100, 1),
															(101, 1),
															(102, 1),
															(103, 1),
															(104, 1),
															(105, 1),
															(106, 1),
															(107, 1),
															(108, 1),
															(109, 2),
															(110, 2),
															(111, 2),
															(112, 2),
															(113, 2),
															(114, 3),
															(115, 3),
															(116, 3),
															(117, 3),
															(118, 3),
															(119, 3),
															(120, 3),
															(121, 3),
															(122, 4),
															(123, 4),
															(124, 4),
															(125, 4),
															(126, 4),
															(127, 4),
															(128, 4),
															(129, 4),
															(130, 4),
															(131, 4),
															(132, 4),
															(133, 1),
															(134, 1),
															(135, 1),
															(136, 1),
															(137, 1),
															(138, 1),
															(139, 1),
															(140, 1),
															(141, 1),
															(142, 5),
															(143, 5),
															(144, 5),
															(145, 5),
															(146, 5),
															(147, 5),
															(148, 5),
															(149, 5);
															
-- VEHICULOS --
INSERT INTO vehiculo (id_vehiculo, numero_motor, kilometraje, id_tipo_vehiculo)
					VALUES (2, '53879558', 6000, 1),
							(3, '69904367', 62000, 1),
							(4, '57193968', 64000, 1),
							(5, '82836641', 16000, 1),
							(6, '28204636', 56000, 1),
							(7, '26139668', 6000, 1),
							(8, '44301415', 46000, 1),
							(9, '44260023', 16000, 1),
							(10, '82039512', 26000, 1),
							(11, '18389741', 36000, 1),
							(12, '62500687', 46000, 1),
							(13, '27510702', 56000, 1),
							(14, '72582865', 66000, 1),
							(15, '32041290', 86000, 1),
							(16, '54712451', 9000, 1),
							(17, '56284263', 2000, 1),
							(18, '21357689', 36000, 1),
							(19, '17800122', 64000, 1),
							(20, '88648319', 65000, 1),
							(21, '23849041', 60030, 1),
							(22, '54650513', 60300, 1),
							(23, '46753468', 60100, 1),
							(24, '60916748', 60100, 1),
							(25, '30207594', 60500, 1),
							(26, '31256965', 60200, 1),
							(27, '32632699', 66000, 1),
							(28, '64092078', 67000, 1);
							
-- TIPO CARGA --
INSERT INTO `grupo03`.`tipo_carga` (`nombre`, `descripcion`) 
	 VALUES ('Ganel', 'Ganel'),
			('Liquida', 'Liquida'),
			('20\'\'', '20 Toneladas'),
            ('40\'\'', '40 Toneladas'),
			('Jaula', 'jaula'),
			('CarCarrier', 'CarCarrier');

-- ROL --	
INSERT INTO `grupo03`.`rol` (`nombre`, `descripcion`)
	 VALUES ('Administrador','AdminDescrip'),
			('Supervisor','SupervisorDescrip'),
			('Encargado de Taller','EncargadoTallerDescrip'),
			('Chofer','ChoferDescrip'),
			('Mecanico','MecanicoDescrip');



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
