-- Criação das tabelas

CREATE TABLE Medicos (
    CRM INT PRIMARY KEY NOT NULL,
    nome VARCHAR(100),
    idade INT,
    especialidade VARCHAR(50),
    cidade VARCHAR(100),
    numero INT
) ENGINE=InnoDB;

CREATE TABLE Ambulatorios (
    numeroA INT PRIMARY KEY NOT NULL,
    andar INT,
    capacidade INT
) ENGINE=InnoDB;

CREATE TABLE Pacientes (
    CodP INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100),
    idade INT,
    cidade VARCHAR(100),
    RG VARCHAR(20),
    doenca VARCHAR(100)
) ENGINE=InnoDB;

CREATE TABLE Consultas (
    CRM INT,
    CodP INT,
    data DATE,
    hora TIME,
    PRIMARY KEY (CRM, CodP, data, hora),
    FOREIGN KEY (CRM) REFERENCES Medicos(CRM),
    FOREIGN KEY (CodP) REFERENCES Pacientes(CodP)
) ENGINE=InnoDB;

-- a) Inserir 3 médicos na tabela de médicos
INSERT INTO Medicos (CRM, nome, idade, especialidade, cidade, numero)
VALUES 
    (101, 'Dr. João', 45, 'Cardiologia', 'São Paulo', 1),
    (102, 'Dra. Maria', 38, 'Pediatria', 'Rio de Janeiro', 2),
    (103, 'Dr. Carlos', 50, 'Ortopedia', 'Belo Horizonte', 3);
    
-- b) Cadastrar 4 ambulatórios
INSERT INTO Ambulatorios (numeroA, andar, capacidade)
VALUES 
    (1, 1, 10),
    (2, 2, 15),
    (3, 3, 20),
    (4, 4, 25);

-- c) Cadastrar 2 pacientes
INSERT INTO Pacientes (nome, idade, cidade, RG, doenca)
VALUES 
    ('Ana Souza', 30, 'São Paulo', '123456789', 'Alergia'),
    ('Pedro Oliveira', 25, 'Rio de Janeiro', '987654321', 'Asma');

-- d) Cadastrar 3 consultas
INSERT INTO Consultas (CRM, CodP, data, hora)
VALUES 
    (101, 1, '2024-10-01', '09:00:00'),
    (102, 2, '2024-10-02', '10:00:00'),
    (103, 1, '2024-10-03', '11:00:00');

-- e) Alterar o número do ambulatório de todos os médicos para 3
UPDATE Medicos 
SET numero = 3;

-- f) Alterar o nome do paciente 1 para Pedro da Silva
UPDATE Pacientes 
SET nome = 'Pedro da Silva' 
WHERE CodP = 1;