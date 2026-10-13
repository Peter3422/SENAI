CREATE TABLE empregado (
    codigo INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255),
    salario DECIMAL(10, 2),
    departamento_id INT,
    idade INT,
    FOREIGN KEY (departamento_id) REFERENCES departamento(codigo)
);

CREATE TABLE departamento (
    codigo INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255)
);

CREATE TABLE projeto (
    codigo INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255)
);

CREATE TABLE empregado_projeto (
    empregado_codigo INT,
    projeto_codigo INT,
    FOREIGN KEY (empregado_codigo) REFERENCES empregado(codigo),
    FOREIGN KEY (projeto_codigo) REFERENCES projeto(codigo)
);

SELECT nome FROM empregado WHERE departamento_id = (SELECT codigo FROM departamento WHERE nome = 'Pesquisa');

SELECT e.nome, e.salario FROM empregado e 
JOIN empregado_projeto ep ON e.codigo = ep.empregado_codigo 
JOIN projeto p ON ep.projeto_codigo = p.codigo 
WHERE p.nome = 'AATOM';

SELECT e.nome, p.nome FROM empregado e 
JOIN empregado_projeto ep ON e.codigo = ep.empregado_codigo 
JOIN projeto p ON ep.projeto_codigo = p.codigo 
WHERE YEAR(p.data_inicio) = 2009; 

SELECT * FROM empregado WHERE idade < 30;

SELECT empregado_codigo FROM empregado_projeto WHERE projeto_codigo = (SELECT codigo FROM projeto WHERE nome = 'A');

SELECT nome, salario FROM empregado WHERE departamento_id = 001;

SELECT ep.projeto_codigo, ep.empregado_codigo FROM empregado_projeto ep 
JOIN projeto p ON ep.projeto_codigo = p.codigo 
WHERE YEAR(p.data_inicio) = 2009; 