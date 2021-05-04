CREATE TABLE `holerite`.`documento` (
  `documento_id` INT NOT NULL,
  `documento_name` VARCHAR(512) NULL,
  `documento_adicionado` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `funcionario_id` INT NOT NULL,
  `documento_mes` INT NOT NULL,
  `documento_ano` INT NOT NULL,
  `documento_status` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`documento_id`));


ALTER TABLE `holerite`.`funcionario` 
ADD COLUMN `funcionario_rua` TEXT NULL AFTER `funcionario_status`,
ADD COLUMN `funcionario_bairro` VARCHAR(128) NULL AFTER `funcionario_rua`,
ADD COLUMN `funcionario_estado` VARCHAR(64) NULL AFTER `funcionario_bairro`,
ADD COLUMN `funcionario_cidade` VARCHAR(128) NULL AFTER `funcionario_estado`,
ADD COLUMN `funcionario_cep` VARCHAR(16) NULL AFTER `funcionario_cidade`,
ADD COLUMN `funcionario_telefone` VARCHAR(128) NULL AFTER `funcionario_cep`;

CREATE TABLE `holerite`.`noticias` (
  `news_id` INT NOT NULL AUTO_INCREMENT,
  `news_title` VARCHAR(128) NULL,
  `news_subtitle` VARCHAR(256) NULL,
  `news_text` TEXT NULL,
  `news_status` INT NULL,
  `news_from` INT NULL,
  `news_created` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`news_id`));

ALTER TABLE `holerite`.`noticias` 
ADD COLUMN `news_attachment` VARCHAR(255) NULL AFTER `news_created`;
