-- a) Adicionar a coluna RA na tabela Aluno
ALTER TABLE Aluno 
ADD RA VARCHAR(20) UNIQUE;

-- b) Inserir 10 registros em cada tabela

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
    
-- c) Alterar o semestre de todas as turmas para 5
UPDATE Turma 
SET Semestre = 5;

