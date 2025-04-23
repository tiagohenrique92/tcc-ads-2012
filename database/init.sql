SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `sistema` DEFAULT CHARACTER SET utf8 ;
USE `sistema` ;

-- -----------------------------------------------------
-- Table `sistema`.`caixa`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistema`.`caixa` (
  `idcaixa` INT(11) NOT NULL AUTO_INCREMENT ,
  `datacaixa` DATE NOT NULL ,
  `valor` FLOAT(10,2) NULL DEFAULT NULL ,
  `status` CHAR(1) NOT NULL ,
  PRIMARY KEY (`idcaixa`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema`.`uf`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistema`.`uf` (
  `iduf` INT(11) NOT NULL AUTO_INCREMENT ,
  `sigla` CHAR(2) NOT NULL ,
  `nome` VARCHAR(30) NOT NULL ,
  PRIMARY KEY (`iduf`) )
ENGINE = InnoDB
AUTO_INCREMENT = 28
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema`.`cidade`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistema`.`cidade` (
  `idcid` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(200) NOT NULL ,
  `iduf` INT(11) NOT NULL ,
  PRIMARY KEY (`idcid`) ,
  INDEX `iduf` (`iduf` ASC) ,
  CONSTRAINT `cidade_ibfk_1`
    FOREIGN KEY (`iduf` )
    REFERENCES `sistema`.`uf` (`iduf` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 5598
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema`.`cliente`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistema`.`cliente` (
  `idcli` INT(11) NOT NULL AUTO_INCREMENT ,
  `idcid` INT(11) NOT NULL ,
  `nome` VARCHAR(200) NOT NULL ,
  `cnpjcpf` VARCHAR(25) NULL DEFAULT NULL ,
  `ierg` VARCHAR(20) NULL DEFAULT NULL ,
  `endereco` VARCHAR(130) NULL DEFAULT NULL ,
  `bairro` VARCHAR(100) NULL DEFAULT NULL ,
  `cep` VARCHAR(10) NOT NULL ,
  `fone` VARCHAR(20) NULL DEFAULT NULL ,
  `celular` VARCHAR(20) NULL DEFAULT NULL ,
  `email` VARCHAR(130) NULL DEFAULT NULL ,
  `contato` VARCHAR(30) NULL DEFAULT NULL ,
  `status` CHAR(1) NOT NULL ,
  `tipo` CHAR(1) NOT NULL ,
  PRIMARY KEY (`idcli`) ,
  UNIQUE INDEX `cnpjcpf` (`cnpjcpf` ASC) ,
  INDEX `idcid` (`idcid` ASC) ,
  CONSTRAINT `cliente_ibfk_2`
    FOREIGN KEY (`idcid` )
    REFERENCES `sistema`.`cidade` (`idcid` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema`.`fornecedor`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistema`.`fornecedor` (
  `idfor` INT(11) NOT NULL AUTO_INCREMENT ,
  `idcid` INT(11) NOT NULL ,
  `razsoc` VARCHAR(150) NOT NULL ,
  `fantasia` VARCHAR(100) NOT NULL ,
  `endereco` VARCHAR(60) NOT NULL ,
  `bairro` VARCHAR(30) NOT NULL ,
  `cep` VARCHAR(10) NULL DEFAULT NULL ,
  `fone` VARCHAR(20) NULL DEFAULT NULL ,
  `ierg` VARCHAR(20) NOT NULL ,
  `cnpjcpf` VARCHAR(25) NOT NULL ,
  `status` CHAR(1) NOT NULL ,
  `celular` VARCHAR(20) NULL DEFAULT NULL ,
  `email` VARCHAR(150) NULL DEFAULT NULL ,
  `contato` VARCHAR(30) NOT NULL ,
  `tipo` CHAR(1) NULL DEFAULT NULL ,
  PRIMARY KEY (`idfor`) ,
  INDEX `idcid` (`idcid` ASC) ,
  CONSTRAINT `fornecedor_ibfk_2`
    FOREIGN KEY (`idcid` )
    REFERENCES `sistema`.`cidade` (`idcid` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema`.`prazo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistema`.`prazo` (
  `idprazo` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(60) NOT NULL ,
  `status` CHAR(1) NOT NULL ,
  PRIMARY KEY (`idprazo`) )
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema`.`compra`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistema`.`compra` (
  `idcompra` INT(11) NOT NULL AUTO_INCREMENT ,
  `datacompra` DATE NOT NULL ,
  `totalcompra` FLOAT(10,2) NULL ,
  `status` CHAR(2) NOT NULL ,
  `idfor` INT(11) NOT NULL ,
  `prazo_idprazo` INT(11) NULL ,
  PRIMARY KEY (`idcompra`) ,
  INDEX `idfor` (`idfor` ASC) ,
  INDEX `fk_compra_prazo1_idx` (`prazo_idprazo` ASC) ,
  CONSTRAINT `compra_ibfk_1`
    FOREIGN KEY (`idfor` )
    REFERENCES `sistema`.`fornecedor` (`idfor` ),
  CONSTRAINT `fk_compra_prazo1`
    FOREIGN KEY (`prazo_idprazo` )
    REFERENCES `sistema`.`prazo` (`idprazo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema`.`funcionario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistema`.`funcionario` (
  `idfun` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(20) NOT NULL ,
  `endereco` VARCHAR(60) NULL DEFAULT NULL ,
  `bairro` VARCHAR(30) NULL DEFAULT NULL ,
  `cep` VARCHAR(10) NULL DEFAULT NULL ,
  `fone` VARCHAR(20) NULL DEFAULT NULL ,
  `rg` VARCHAR(20) NULL DEFAULT NULL ,
  `cpf` VARCHAR(25) NULL DEFAULT NULL ,
  `salario` FLOAT(10,2) NULL DEFAULT NULL ,
  `dataadm` DATE NULL DEFAULT NULL ,
  `datadem` DATE NULL DEFAULT NULL ,
  `status` CHAR(20) NULL DEFAULT NULL ,
  PRIMARY KEY (`idfun`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema`.`iprazo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistema`.`iprazo` (
  `iditemprazo` INT(11) NOT NULL AUTO_INCREMENT ,
  `idprazo` INT(11) NOT NULL ,
  `dias` INT(11) NOT NULL ,
  PRIMARY KEY (`iditemprazo`, `idprazo`) ,
  INDEX `idprazo` (`idprazo` ASC) ,
  CONSTRAINT `iprazo_ibfk_1`
    FOREIGN KEY (`idprazo` )
    REFERENCES `sistema`.`prazo` (`idprazo` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema`.`produto`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistema`.`produto` (
  `idpro` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(60) NOT NULL ,
  `precocompra` FLOAT(10,2) NOT NULL ,
  `precovenda` FLOAT(10,2) NOT NULL ,
  `barras` INT(11) NULL DEFAULT NULL ,
  `qtde` INT(11) NOT NULL ,
  `status` CHAR(1) NOT NULL ,
  PRIMARY KEY (`idpro`) )
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema`.`itemcompra`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistema`.`itemcompra` (
  `idcompra` INT(11) NOT NULL ,
  `idpro` INT(11) NOT NULL ,
  `qtde` INT(11) NOT NULL ,
  `precocompra` FLOAT(10,2) NOT NULL ,
  `precovenda` CHAR(20) NULL ,
  `total` FLOAT(10,2) NOT NULL ,
  PRIMARY KEY (`idcompra`, `idpro`) ,
  INDEX `idpro` (`idpro` ASC) ,
  CONSTRAINT `itemcompra_ibfk_1`
    FOREIGN KEY (`idcompra` )
    REFERENCES `sistema`.`compra` (`idcompra` ),
  CONSTRAINT `itemcompra_ibfk_2`
    FOREIGN KEY (`idpro` )
    REFERENCES `sistema`.`produto` (`idpro` ))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema`.`venda`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistema`.`venda` (
  `idvenda` INT(11) NOT NULL AUTO_INCREMENT ,
  `datavenda` DATE NULL DEFAULT NULL ,
  `totalvenda` FLOAT(10,2) NULL DEFAULT NULL ,
  `status` CHAR(2) NULL DEFAULT NULL ,
  `idcli` INT(11) NOT NULL ,
  `prazo_idprazo` INT(11) NULL ,
  PRIMARY KEY (`idvenda`) ,
  INDEX `idcli` (`idcli` ASC) ,
  INDEX `fk_venda_prazo1_idx` (`prazo_idprazo` ASC) ,
  CONSTRAINT `venda_ibfk_1`
    FOREIGN KEY (`idcli` )
    REFERENCES `sistema`.`cliente` (`idcli` ),
  CONSTRAINT `fk_venda_prazo1`
    FOREIGN KEY (`prazo_idprazo` )
    REFERENCES `sistema`.`prazo` (`idprazo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema`.`itemvenda`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistema`.`itemvenda` (
  `idvenda` INT(11) NOT NULL ,
  `idpro` INT(11) NOT NULL ,
  `qtde` INT(11) NULL DEFAULT NULL ,
  `precovenda` FLOAT(10,2) NULL DEFAULT NULL ,
  `total` FLOAT(10,2) NULL DEFAULT NULL ,
  PRIMARY KEY (`idvenda`, `idpro`) ,
  INDEX `idpro` (`idpro` ASC) ,
  CONSTRAINT `itemvenda_ibfk_1`
    FOREIGN KEY (`idvenda` )
    REFERENCES `sistema`.`venda` (`idvenda` ),
  CONSTRAINT `itemvenda_ibfk_2`
    FOREIGN KEY (`idpro` )
    REFERENCES `sistema`.`produto` (`idpro` ))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema`.`nivel`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistema`.`nivel` (
  `idnivel` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(25) NOT NULL ,
  `descricao` VARCHAR(180) NOT NULL ,
  PRIMARY KEY (`idnivel`) )
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema`.`parcelapag`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistema`.`parcelapag` (
  `idparc` INT(11) NOT NULL AUTO_INCREMENT ,
  `idcompra` INT(11) NOT NULL ,
  `numparc` INT(11) NOT NULL ,
  `totparc` INT(11) NOT NULL ,
  `datavenc` DATE NOT NULL ,
  `datapag` DATE NULL DEFAULT NULL ,
  `valorparc` FLOAT(10,2) NOT NULL ,
  `valorpago` FLOAT(10,2) NULL DEFAULT NULL ,
  `status` CHAR(2) NOT NULL ,
  `idcaixa` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idparc`) ,
  INDEX `idcompra` (`idcompra` ASC) ,
  CONSTRAINT `parcelapag_ibfk_1`
    FOREIGN KEY (`idcompra` )
    REFERENCES `sistema`.`compra` (`idcompra` ))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema`.`parcelarec`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistema`.`parcelarec` (
  `idparc` INT(11) NOT NULL AUTO_INCREMENT ,
  `numparc` INT(11) NULL DEFAULT NULL ,
  `totparc` INT(11) NULL DEFAULT NULL ,
  `datavenc` DATE NULL DEFAULT NULL ,
  `datapag` DATE NULL DEFAULT NULL ,
  `valorparc` FLOAT(10,2) NULL DEFAULT NULL ,
  `valorrec` FLOAT(10,2) NULL DEFAULT NULL ,
  `status` CHAR(2) NULL ,
  `idvenda` INT(11) NOT NULL ,
  `idcaixa` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idparc`) ,
  INDEX `idvenda` (`idvenda` ASC) ,
  CONSTRAINT `parcelarec_ibfk_1`
    FOREIGN KEY (`idvenda` )
    REFERENCES `sistema`.`venda` (`idvenda` ))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sistema`.`usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sistema`.`usuario` (
  `idusuario` INT(11) NOT NULL AUTO_INCREMENT ,
  `idnivel` INT(11) NOT NULL ,
  `login` VARCHAR(20) NOT NULL ,
  `senha` VARCHAR(200) NOT NULL ,
  `nome` VARCHAR(30) NOT NULL ,
  `editor` INT(11) NOT NULL ,
  `status` CHAR(1) NOT NULL ,
  PRIMARY KEY (`idusuario`) ,
  UNIQUE INDEX `login` (`login` ASC) ,
  INDEX `idnivel` (`idnivel` ASC) ,
  CONSTRAINT `usuario_ibfk_1`
    FOREIGN KEY (`idnivel` )
    REFERENCES `sistema`.`nivel` (`idnivel` ))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;

USE `sistema`;

DELIMITER $$
USE `sistema`$$


CREATE
DEFINER=`root`@`localhost`
TRIGGER `sistema`.`at_parcpag_compra_canc`
AFTER UPDATE ON `sistema`.`compra`
FOR EACH ROW
begin
	if new.status = 'C' then
		update parcelapag set status = 'C', idcaixa = (select max(idcaixa) as idcaixa from caixa) where idcompra = new.idcompra;
		update itemcompra set qtde = 0, total = 0 where idcompra = new.idcompra;
	end if;
end$$


DELIMITER ;

DELIMITER $$
USE `sistema`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `sistema`.`at_pro_venda_delete`
AFTER DELETE ON `sistema`.`itemvenda`
FOR EACH ROW
begin
   update produto set qtde = (qtde + old.qtde) where idpro = old.idpro;
end$$

USE `sistema`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `sistema`.`at_pro_venda_insert`
AFTER INSERT ON `sistema`.`itemvenda`
FOR EACH ROW
begin
   update produto set qtde = (qtde - new.qtde) where idpro = new.idpro;
end$$

USE `sistema`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `sistema`.`at_pro_venda_update`
AFTER UPDATE ON `sistema`.`itemvenda`
FOR EACH ROW
begin
   update produto set qtde = ((qtde + old.qtde) - new.qtde) where idpro = new.idpro;
end$$


DELIMITER ;

DELIMITER $$
USE `sistema`$$


CREATE
DEFINER=`root`@`localhost`
TRIGGER `sistema`.`at_compra_paga`
AFTER UPDATE ON `sistema`.`parcelapag`
FOR EACH ROW
begin
	declare numparc int;
	if new.status = 'PG' then
		set numparc = (select count(*) as total_parc from parcelapag where status = 'AB' and idcompra = new.idcompra group by idcompra);
		if (numparc is null) then
			update compra set status = 'PG' where idcompra = new.idcompra;
		else
			update compra set status = 'PA' where idcompra = new.idcompra;
		end if;
	end if;
end$$


DELIMITER ;

DELIMITER $$
USE `sistema`$$


CREATE
DEFINER=`root`@`localhost`
TRIGGER `sistema`.`at_venda_paga`
AFTER UPDATE ON `sistema`.`parcelarec`
FOR EACH ROW
begin
	declare numparc int;
	if new.status = 'PG' then
		set numparc = (select count(*) as total_parc from parcelarec where status = 'AB' and idvenda = new.idvenda group by idvenda);
		if (numparc is null) then
			update venda set status = 'PG' where idvenda = new.idvenda;
		else
			update venda set status = 'PA' where idvenda = new.idvenda;
		end if;
	end if;
end$$


DELIMITER ;

DELIMITER $$
USE `sistema`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `sistema`.`at_parcrec_vend_canc`
AFTER UPDATE ON `sistema`.`venda`
FOR EACH ROW
begin
	if new.status = 'C' then
		update parcelarec set status = 'C', idcaixa = (select max(idcaixa) as idcaixa from caixa) where idvenda = new.idvenda;
		update itemvenda set qtde = 0, total = 0 where idvenda = new.idvenda;
	end if;
end$$


DELIMITER ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
