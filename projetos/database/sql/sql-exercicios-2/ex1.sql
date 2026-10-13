CREATE TABLE peca (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255),
    peca_pai INT,
    preco DECIMAL(10, 2),
    data_insercao DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE carro (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255),
    marca VARCHAR(255),
    data_insercao DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE componente (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    id_peca INT,
    id_carro INT,
    FOREIGN KEY (id_peca) REFERENCES peca(ID),
    FOREIGN KEY (id_carro) REFERENCES carro(ID)
);

INSERT INTO peca (nome, peca_pai, preco) VALUES 
('Cilindro', NULL, 50.00),
('Parafuso', NULL, 5.00),
('Correia', NULL, 20.00),
('Bateria', NULL, 150.00),
('Cabo', NULL, 15.00);

INSERT INTO carro (nome, marca) VALUES 
('Fusca', 'Volkswagen'),
('Civic', 'Honda'),
('Mustang', 'Ford'),
('Corolla', 'Toyota'),
('Onix', 'Chevrolet');

UPDATE peca 
SET preco = preco * 0.10 
WHERE nome LIKE 'C%';

DELETE FROM peca 
WHERE preco < 10;

UPDATE peca 
SET nome = 'Bolt' 
WHERE nome = 'Parafuso';

UPDATE peca 
SET preco = preco * 1.50 
WHERE ID IN (SELECT id_peca FROM componente WHERE id_carro IN (SELECT ID FROM carro WHERE marca = 'Volkswagen'));

DELETE FROM peca 
WHERE ID IN (SELECT id_peca FROM componente WHERE id_carro IN (SELECT ID FROM carro WHERE marca = 'Ford'));