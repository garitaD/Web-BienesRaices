# Web-BienesRaices
Base de datos en mysql
-- -----------------------------------------------------
-- Table `bienes_raices`.`vendedores`
-- -----------------------------------------------------
CREATE DATABASE bienes_raices;
USE bienes_raices;
-- -----------------------------------------------------
-- TABLA DE VENDORES
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bienes_raices`.`vendedores` (
  `idVendedor` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `apellido` VARCHAR(45) NULL,
  `telefono` VARCHAR(10) NULL,
  PRIMARY KEY (`idVendedor`))
ENGINE = InnoDB;

INSERT INTO vendedores(nombre, apellido, telefono) VALUES ("Daniel", "Garita", "8899-9988");
INSERT INTO vendedores(nombre, apellido, telefono) VALUES ("Andres", "Barquero", "8877-12443");


-- -----------------------------------------------------
-- TABLA DE PRODUCTOS
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bienes_raices`.`propiedades` (
  `idPropiedades` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(60) NULL,
  `precio` DECIMAL(10,2) NULL,
  `imagen` VARCHAR(200) NULL,
  `descripcion` LONGTEXT NULL,
   `habitaciones` INT(1) NULL,
    `wc` INT(1) NULL,
     `estacionamiento` INT(11) NULL,
	
  `creado` DATE NULL,
  `idVendedor` INT(11) NULL,
  PRIMARY KEY (`idPropiedades`),
  INDEX `idVendedor_idx` (`idVendedor` ASC),
  CONSTRAINT `idVendedor`
    FOREIGN KEY (`idVendedor`)
    REFERENCES `bienes_raices`.`vendedores` (`idVendedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE `bienes_raices`.`usuarios` (
  `idUsuarios` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(60) NULL,
  `password` CHAR(60) NULL,
  PRIMARY KEY (`idUsuarios`));
  
select * from usuarios;
