-- MySQL Script generated by MySQL Workbench
-- Sun Oct 24 22:52:57 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema Book_Commerce
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Book_Commerce
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Book_Commerce` DEFAULT CHARACTER SET utf8 ;
USE `Book_Commerce` ;

-- -----------------------------------------------------
-- Table `Book_Commerce`.`item_inventory`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Book_Commerce`.`item_inventory` ;

CREATE TABLE IF NOT EXISTS `Book_Commerce`.`item_inventory` (
  `item_id` INT NOT NULL AUTO_INCREMENT,
  `item_name` VARCHAR(250) NOT NULL,
  `stock` INT NOT NULL,
  PRIMARY KEY (`item_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Book_Commerce`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Book_Commerce`.`user` ;

CREATE TABLE IF NOT EXISTS `Book_Commerce`.`user` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `contact` INT(10) NOT NULL,
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Book_Commerce`.`order`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Book_Commerce`.`order` ;

CREATE TABLE IF NOT EXISTS `Book_Commerce`.`order` (
  `order_id` INT NOT NULL AUTO_INCREMENT,
  `payment_type` VARCHAR(45) NOT NULL,
  `quantity` INT NOT NULL,
  `user_user_id` INT NOT NULL,
  `item_inventory_item_id` INT NOT NULL,
  PRIMARY KEY (`order_id`),
  CONSTRAINT `fk_order_user`
    FOREIGN KEY (`user_user_id`)
    REFERENCES `Book_Commerce`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_order_item_inventory1`
    FOREIGN KEY (`item_inventory_item_id`)
    REFERENCES `Book_Commerce`.`item_inventory` (`item_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;