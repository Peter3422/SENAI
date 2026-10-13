-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 06-Nov-2024 às 19:29
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `senai`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidato`
--

DROP TABLE IF EXISTS `candidato`;
CREATE TABLE IF NOT EXISTS `candidato` (
  `id_cand` int NOT NULL AUTO_INCREMENT,
  `nome_cand` varchar(50) NOT NULL,
  `idade_cand` varchar(3) NOT NULL,
  `partido_cand` varchar(30) NOT NULL,
  PRIMARY KEY (`id_cand`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `candidato`
--

INSERT INTO `candidato` (`id_cand`, `nome_cand`, `idade_cand`, `partido_cand`) VALUES
(1, 'Carlos Silva', '35', 'PT'),
(2, 'Maria Oliveira', '42', 'PSDB'),
(3, 'João Santos', '29', 'PSB'),
(4, 'Ana Costa', '38', 'PL'),
(5, 'Pedro Almeida', '45', 'MDB'),
(6, 'Lucia Martins', '31', 'DEM'),
(7, 'Felipe Rocha', '50', 'PDT'),
(8, 'Julia Mendes', '27', 'REDE'),
(9, 'Roberto Ferreira', '33', 'PPS'),
(10, 'Mariana Lima', '41', 'PV'),
(11, 'Gabriel Souza', '36', 'PSOL'),
(12, 'Isabela Pereira', '39', 'PROS'),
(13, 'Lucas Andrade', '34', 'Agir'),
(14, 'Fernanda Lima', '28', 'Avante'),
(15, 'Ricardo Gomes', '55', 'Cidadania'),
(16, 'Patrícia Alves', '47', 'DC'),
(17, 'Thiago Martins', '52', 'PCB'),
(18, 'Renata Costa', '44', 'PCO'),
(19, 'Eduardo Santos', '30', 'PSTU'),
(20, 'Sofia Ribeiro', '48', 'NOVO'),
(21, 'Júlio César', '53', 'Republicanos'),
(22, 'Clara Nascimento', '37', 'Solidariedade'),
(23, 'Felipe Torres', '40', 'Podemos'),
(24, 'Ana Beatriz', '34', 'PT'),
(25, 'Roberto Carlos', '41', 'PSDB'),
(26, 'Juliana Silva', '29', 'PSB'),
(27, 'Fernando Alves', '37', 'PL'),
(28, 'Camila Oliveira', '45', 'MDB'),
(29, 'Thiago Lima', '32', 'DEM'),
(30, 'Mariana Costa', '39', 'PDT'),
(31, 'Lucas Pereira', '27', 'REDE'),
(32, 'Sofia Martins', '36', 'PPS'),
(33, 'Gustavo Santos', '43', 'PV'),
(34, 'Tatiane Rocha', '30', 'PSOL'),
(35, 'Daniel Ferreira', '48', 'PROS'),
(36, 'Larissa Nunes', '33', 'Agir'),
(37, 'Vinícius Almeida', '29', 'Avante'),
(38, 'Patrícia Gomes', '50', 'Cidadania'),
(39, 'Eduardo Ribeiro', '46', 'DC'),
(40, 'Cláudio Silva', '52', 'PCB'),
(41, 'Marcelly Souza', '40', 'PCO'),
(42, 'André Lima', '31', 'PSTU'),
(43, 'Bruna Costa', '38', 'NOVO'),
(44, 'Felipe Dias', '54', 'Republicanos'),
(45, 'Isabela Santos', '35', 'Solidariedade'),
(46, 'Rafael Martins', '42', 'Podemos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `eleitor`
--

DROP TABLE IF EXISTS `eleitor`;
CREATE TABLE IF NOT EXISTS `eleitor` (
  `id_eleitor` int NOT NULL AUTO_INCREMENT,
  `cpf_eleitor` varchar(30) NOT NULL,
  `nome_eleitor` varchar(50) NOT NULL,
  `idade_eleitor` varchar(3) NOT NULL,
  PRIMARY KEY (`id_eleitor`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `eleitor`
--

INSERT INTO `eleitor` (`id_eleitor`, `cpf_eleitor`, `nome_eleitor`, `idade_eleitor`) VALUES
(1, '123.456.789-01', 'ANA MAYTA CELSO', '17'),
(2, '234.567.890-12', 'ANTHONY JOSÉ DE SOUSA LIMA', '17'),
(3, '345.678.901-23', 'ARIELSON GOMES VIEIRA', '17'),
(4, '456.789.012-34', 'BEATRIZ LUNA DIAS GONZALES', '17'),
(5, '567.890.123-45', 'FILIPE BRANDÃO ERIÇA', '17'),
(6, '678.901.234-56', 'GABRIEL MUNHOZ PETERLINI', '17'),
(7, '789.012.345-67', 'ISABELLY CASALE BUENO', '17'),
(8, '890.123.456-78', 'ISABELLY DE OLIVEIRA', '17'),
(9, '901.234.567-89', 'JOÃO PEDRO DA CRUZ MENDES', '17'),
(10, '012.345.678-90', 'KAUE BAER', '17'),
(11, '123.456.789-02', 'KAYKY BUENO RODRIGUES', '17'),
(12, '234.567.890-13', 'LEONARDO TOMAZZINI DA SILVA', '17'),
(13, '345.678.901-24', 'MARIA CRISTINA MEDINA LAURA', '17'),
(14, '456.789.012-35', 'MATHEUS CAETANO DA SILVA', '17'),
(15, '567.890.123-46', 'MILENA DE SOUSA LIMA', '17'),
(16, '678.901.234-57', 'NICOLE SANTANA DA SILVA', '17'),
(17, '789.012.345-68', 'PEDRO LUCAS PEREIRA BOM', '17'),
(18, '890.123.456-79', 'RAFAEL TAYLOR POSSIGNOLO', '17'),
(19, '901.234.567-80', 'RAYANY SILVA RAMOS', '17'),
(20, '012.345.678-91', 'THIAGO BATISTA PEREIRA', '17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `votos`
--

DROP TABLE IF EXISTS `votos`;
CREATE TABLE IF NOT EXISTS `votos` (
  `vot_cod` int NOT NULL AUTO_INCREMENT,
  `vot_ele_cod` int NOT NULL,
  `vot_voto` int NOT NULL,
  PRIMARY KEY (`vot_cod`),
  KEY `vot_ele_cod` (`vot_ele_cod`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `votos`
--

INSERT INTO `votos` (`vot_cod`, `vot_ele_cod`, `vot_voto`) VALUES
(1, 3, -1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
