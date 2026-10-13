create database sistemaEventos;
use sistemaEventos;

CREATE TABLE evento (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(200),
    dataHora TIMESTAMP,
    inicioVendas TIMESTAMP
);

CREATE TABLE setor (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(10),
    evento_id INT,
    ingressos INT,
    FOREIGN KEY (evento_id) REFERENCES evento(id)
);

CREATE TABLE usuario (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE vendas (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT,
    setor_id INT,
    quantidade INT,
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuario(id),
    FOREIGN KEY (setor_id) REFERENCES setor(id)
);



select * from evento;
select * from setor;