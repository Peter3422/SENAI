CREATE DATABASE IF NOT EXISTS dream_sleep_tracker;
USE dream_sleep_tracker;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE dados_sono (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    inicio DATETIME NOT NULL,
    fim DATETIME NOT NULL,
    duracao_minutos INT,
    fase VARCHAR(50),
    segmentos_json TEXT,
    registrado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE sonhos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    titulo VARCHAR(150),
    data DATE NOT NULL,
    hora TIME,
    descricao TEXT,
    emocao VARCHAR(100),
    nivel_clareza TINYINT,
    palavras_chave VARCHAR(255),
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE reflexoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sonho_id INT NOT NULL,
    texto TEXT,
    audio_path VARCHAR(255),
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sonho_id) REFERENCES sonhos(id)
);

CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(80) NOT NULL UNIQUE
);

CREATE TABLE sonho_tags (
    sonho_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (sonho_id, tag_id),
    FOREIGN KEY (sonho_id) REFERENCES sonhos(id),
    FOREIGN KEY (tag_id) REFERENCES tags(id)
);
