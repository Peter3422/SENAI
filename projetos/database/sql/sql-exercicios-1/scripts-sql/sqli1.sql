-- a) Criação das Tabelas e Chaves

CREATE TABLE Aluno (
    ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100),
    RA VARCHAR(20) UNIQUE
) ENGINE=InnoDB;

CREATE TABLE Turma (
    ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    Curso VARCHAR(100),
    Semestre INT
) ENGINE=InnoDB;

CREATE TABLE Classe (
    ID_Aluno INT,
    ID_Turma INT,
    PRIMARY KEY (ID_Aluno, ID_Turma),
    FOREIGN KEY (ID_Aluno) REFERENCES Aluno(ID),
    FOREIGN KEY (ID_Turma) REFERENCES Turma(ID)
) ENGINE=InnoDB;

CREATE TABLE Faculdade (
    ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    Nome VARCHAR(100)
) ENGINE=InnoDB;

-- b) Exclusão da Tabela Faculdade

DROP TABLE IF EXISTS Faculdade;

-- c) Adição da Coluna RA na Tabela Aluno

ALTER TABLE Aluno 
ADD RA VARCHAR(20) UNIQUE;

-- d) Inserção de 10 Registros em Cada Tabela

-- Inserindo Registros na Tabela Aluno
INSERT INTO Aluno (nome, RA)
VALUES 
    ("Alice", "RA001"),
    ("Bruno", "RA002"),
    ("Carla", "RA003"),
    ("Daniel", "RA004"),
    ("Eduarda", "RA005"),
    ("Fernando", "RA006"),
    ("Gabriela", "RA007"),
    ("Hugo", "RA008"),
    ("Isabela", "RA009"),
    ("João", "RA010");
    
UPDATE Turma 
SET Semestre = 5;