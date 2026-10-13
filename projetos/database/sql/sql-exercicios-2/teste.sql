CREATE DATABASE escola;
USE escola;

CREATE TABLE aluno(
    ra INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50)) ENGINE=innOD8;
    
    CREATE TABLE disciplina(
        codigo INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        nome VARCHAR(50)) ENGINE=innOD8;
        
        CREATE TABLE nota(
            codigo INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            raAluno INT,
            codigoDisciplina INT,
            nota INT,
            FOREIGN KEY (raAluno) REFERENCES aluno(ra),
            FOREIGN KEY (codigoDisciplina) REFERENCES disciplina(codigo)) ENGINE=innOD8;
            
            INSERT INTO aluno(nome)
            VALUES ("Barreto"),("Filipe"), ("Rafael");
            
              INSERT INTO aluno(nome)
            VALUES ("BCD"),("LGMC"), ("PWBE");
            
            INSERT INTO nota(raAluno, codigoDisciplina, nota)
            VALUES(1,1,85),(1,2,88),(1,3,95),
                  (1,1,95),(2,2,75),(2,3,99),
                  (1,1,99),(3,2,85),(3,3,90);
                  
                  SELECT * 
                  FROM aluno;
                  
                  SELECT nome
                  FROM aluno;
                  
                  SELECT *
                  FROM aluno
                  WHERE ra = 2;
                  
                  SELECT *
                  FROM aluno
                  WHERE nome LIKE "%a%";
                  
                  SELECT *
                  FROM aluno
                  WHERE nome LIKE "F%";
                  
                  SELECT *
                  FROM nota
                  WHERE nota BETWEEN 60 AND 80;
                  
                  SELECT *
                  FROM nota
                  JOIN aluno
                  ON nota.raAluno = aluno.ra
                  JOIN disciplina
                  ON nota.codigoDisciplina = disciplina.codigo
                  ORDER BY nota.nota;
                  
                  UPDATE  aluno
                  SET nome = "Filipe"
                  WHERE nome = "Filipe";
