-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 17-Jun-2018 às 15:09
-- Versão do servidor: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_vorcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cotacao`
--

DROP TABLE IF EXISTS `tb_cotacao`;
CREATE TABLE IF NOT EXISTS `tb_cotacao` (
  `cd_cotacao` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_empresa_lista` int(11) NOT NULL,
  `id_lista` int(11) NOT NULL,
  PRIMARY KEY (`cd_cotacao`),
  KEY `id_lista` (`id_lista`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_empresa` (`id_empresa`),
  KEY `id_empresa_lista` (`id_empresa_lista`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cotacao_item`
--

DROP TABLE IF EXISTS `tb_cotacao_item`;
CREATE TABLE IF NOT EXISTS `tb_cotacao_item` (
  `cd_cotacao_item` int(11) NOT NULL AUTO_INCREMENT,
  `id_cotacao` int(11) NOT NULL,
  `id_lista_item` int(11) NOT NULL,
  `vl_cotacao` int(11) NOT NULL,
  PRIMARY KEY (`cd_cotacao_item`),
  KEY `id_cotacao` (`id_cotacao`),
  KEY `id_lista_item` (`id_lista_item`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_empresa`
--

DROP TABLE IF EXISTS `tb_empresa`;
CREATE TABLE IF NOT EXISTS `tb_empresa` (
  `cd_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `nm_empresa` varchar(45) NOT NULL,
  `nr_cnpj` int(11) NOT NULL,
  `dt_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bool_fornecedor` tinyint(1) NOT NULL,
  `vl_pin` varchar(45) NOT NULL,
  PRIMARY KEY (`cd_empresa`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_empresa`
--

INSERT INTO `tb_empresa` (`cd_empresa`, `nm_empresa`, `nr_cnpj`, `dt_criacao`, `bool_fornecedor`, `vl_pin`) VALUES
(18, 'Sex Shop do Abner', 5555, '2018-06-04 10:58:18', 1, 'IJjRqP+iH80@WYBC+FkABrzKwX!ng4Kp'),
(13, 'Sex Shop do Abner', 12312, '2018-05-28 11:55:36', 1, 'generateRandomString'),
(14, 'Sex Shop do Abner', 98, '2018-05-28 11:59:45', 1, '&RFCJ1hTsuOg7&FG46+7aSxxMza@BfHa'),
(15, 'popo123', 123, '2018-05-28 12:02:46', 0, '&r01TqVBcll$P@VKCreNeyTBUsu8%Zw@'),
(16, 'ABNER', 123, '2018-05-28 12:13:15', 0, 'DO%KJJJiDSk*ZWdkN2ecH5M5Qew*J8!o'),
(17, 'Apple Shop do Abner', 696969, '2018-06-04 10:30:36', 1, 'wWxam3ZT&f8yo#!F%hu$QUwYdLdehwon'),
(19, 'Uso Pessoal', 9909090, '2018-06-04 11:43:38', 0, 'PsSM+GFYzB7R+CRxMyCHlN#h43Y+LWW#');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_lista`
--

DROP TABLE IF EXISTS `tb_lista`;
CREATE TABLE IF NOT EXISTS `tb_lista` (
  `cd_lista` int(11) NOT NULL AUTO_INCREMENT,
  `nm_lista` varchar(45) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  PRIMARY KEY (`cd_lista`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_empresa` (`id_empresa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_lista_item`
--

DROP TABLE IF EXISTS `tb_lista_item`;
CREATE TABLE IF NOT EXISTS `tb_lista_item` (
  `cd_lista_item` int(11) NOT NULL AUTO_INCREMENT,
  `nm_lista_item` varchar(45) NOT NULL,
  `nm_lista_item_desc` varchar(255) DEFAULT NULL,
  `nm_lista_item_qtd` int(11) NOT NULL,
  `id_lista` int(11) NOT NULL,
  PRIMARY KEY (`cd_lista_item`),
  KEY `id_lista` (`id_lista`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

DROP TABLE IF EXISTS `tb_usuario`;
CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `cd_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nm_usuario` varchar(45) NOT NULL,
  `nr_cpf` int(11) NOT NULL,
  `nm_login` varchar(45) NOT NULL,
  `nm_senha` varchar(32) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  PRIMARY KEY (`cd_usuario`),
  KEY `id_empresa` (`id_empresa`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`cd_usuario`, `nm_usuario`, `nr_cpf`, `nm_login`, `nm_senha`, `id_empresa`) VALUES
(22, 'Abner Lima ', 45454, 'Abner', 'b2f5ff47436671b6e533d8dc3614845d', 14),
(23, 'Lima Abner', 6666788, 'bucheq', '6e11873b9d9d94a44058bef5747735ce', 14),
(24, 'liticia', 585858, 'leleh50', '1906ad9d4ce4b6b7b8d3990001f204c3', 19);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
