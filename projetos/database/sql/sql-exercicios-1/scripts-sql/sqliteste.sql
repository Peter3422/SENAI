-- cria o banco de dados
drop database rh;
CREATE DATABASE RH;
USE RH;
-- int de numero inteiro
-- primary key pq é chave primaria(nao se repete)
-- not null pq nao pode ser nulo, tem que cikicar valor obrigatorio
-- auto_incremente incrementa o valor, pois é sequencial e nao se repete
-- Projeto(codProj, tipo, descricao)
create table projeto(
	CodProj int primary key not null auto_increment,
    tipo varchar(50),
    descricao varchar(50)) ENGINE=InnoDB;

-- categoria(CodCat, Salario)
create table categoria(
	CodCat int primary key not null auto_increment,
    salario float) ENGINE=InnoDB;

-- foreign key é chave estrangeira foreign key(campo lado n) References lado 1(campo lado 1)
-- empregado(CodEmp, nome, codcat)
create table empregado(
	CodEmp int primary key not null auto_increment,
    tipo varchar(50),
    CodCat int,
    foreign key (CodCat) references categoria(CodCat)) ENGINE=InnoDB;

-- ProjetoEmpregado(codigo, CodProj, CodEmp, DataInicio, TempoAloc)
create table projetoEmpregado(
	Codigo int not null,
    CodProj int,
    CodEmp int,
    DataInicio date,
    TempoAloc time,
    foreign key (CodProj) references projeto(CodProj),
    foreign key (CodEmp) references empregado(CodEmp)) ENGINE=InnoDB;

create table teste(
	codigo int primary key not null) ENGINE=InnoDB;
    
alter table teste
	add nome varchar(50);
    
alter table teste
	change nome nome varchar(200);
    
alter table teste
	drop nome;
         
drop table teste;

insert into projeto(tipo, descricao)
			values("Novo Desenvolvimento","Sistema de Faltas"),
				  ("Alteração","Sistema Financeiro"),
                  ("Novo Desenvolvimento","Sistema de Faltas");
                  
insert into categoria(salario)
			values(4000),(9000);
            
insert into empregado(nome, CodCat)
			values("João",1),
				  ("josé",1),
				  ("Kelly",2);
                  
insert into empregado(nome, CodCat)
			values("Barreto",3);
            