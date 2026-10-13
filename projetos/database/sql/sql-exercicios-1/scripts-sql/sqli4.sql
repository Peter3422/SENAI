CREATE TABLE Fornecedor (
    codigo INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100),
    cidade VARCHAR(100)
) ENGINE=InnoDB;

CREATE TABLE Peca (
    codPeca INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    Nome VARCHAR(100),
    descricao VARCHAR(255)
) ENGINE=InnoDB;

CREATE TABLE Venda (
    codForn INT,
    codPeca INT,
    quantidade INT,
    data DATE,
    PRIMARY KEY (codForn, codPeca, data),
    FOREIGN KEY (codForn) REFERENCES Fornecedor(codigo),
    FOREIGN KEY (codPeca) REFERENCES Peca(codPeca)
) ENGINE=InnoDB;
