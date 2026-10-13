-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 02-Out-2024 às 20:04
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
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `cli_cod` int NOT NULL AUTO_INCREMENT,
  `cli_nome` varchar(100) DEFAULT NULL,
  `cli_idade` int DEFAULT NULL,
  `cli_celular` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cli_cod`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`cli_cod`, `cli_nome`, `cli_idade`, `cli_celular`) VALUES
(6, 'asdasd', 12312, '(12) 31221-3123'),
(5, 'asdasd', 12312, '(12) 31221-3123'),
(7, 'asdasd', 12312, '(12) 31221-3123'),
(8, 'asdasd', 21, '(12) 31221-3123'),
(9, 'asdasd', 12312, '(12) 31221-3123'),
(10, 'asdasd', 12312, '(12) 31221-3123'),
(11, 'asdasd', 12312, '(12) 31221-3123'),
(12, 'asdasd', 12312, '(12) 31221-3123'),
(13, 'asdasd', 12312, '(12) 31221-3123'),
(14, 'asdasd', 12312, '(12) 31221-3123'),
(15, 'asdasd', 12312, '(12) 31221-3123'),
(16, 'asdasd', 12312, '(12) 31221-3123'),
(17, 'asdasd', 12312, '(12) 31221-3123'),
(18, 'asdasd', 12312, '(12) 31221-3123'),
(19, 'asdasd', 12312, '(12) 31221-3123'),
(20, 'asdasd', 12312, '(12) 31221-3123'),
(21, 'asdasd', 12312, '(12) 31221-3123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
