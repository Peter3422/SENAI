CREATE DATABASE sistemaWMS;
USE sistemaWMS;

CREATE TABLE produto(
	codigo    INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome      VARCHAR(50),
    descricao VARCHAR(200));