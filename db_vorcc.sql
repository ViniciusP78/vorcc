-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 20/06/2018 às 14h32min
-- Versão do Servidor: 5.5.20
-- Versão do PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `db_vorcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cotacao`
--

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cotacao_item`
--

CREATE TABLE IF NOT EXISTS `tb_cotacao_item` (
  `cd_cotacao_item` int(11) NOT NULL AUTO_INCREMENT,
  `id_cotacao` int(11) NOT NULL,
  `id_lista_item` int(11) NOT NULL,
  `vl_cotacao` int(11) NOT NULL,
  PRIMARY KEY (`cd_cotacao_item`),
  KEY `id_cotacao` (`id_cotacao`),
  KEY `id_lista_item` (`id_lista_item`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_empresa`
--

CREATE TABLE IF NOT EXISTS `tb_empresa` (
  `cd_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `nm_empresa` varchar(45) NOT NULL,
  `nr_cnpj` int(11) NOT NULL,
  `dt_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bool_fornecedor` tinyint(1) NOT NULL,
  `vl_pin` varchar(45) NOT NULL,
  PRIMARY KEY (`cd_empresa`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

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

CREATE TABLE IF NOT EXISTS `tb_lista` (
  `cd_lista` int(11) NOT NULL AUTO_INCREMENT,
  `nm_lista` varchar(45) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  PRIMARY KEY (`cd_lista`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_empresa` (`id_empresa`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_lista`
--

INSERT INTO `tb_lista` (`cd_lista`, `nm_lista`, `id_usuario`, `id_empresa`) VALUES
(1, 'Lista', 24, 19),
(2, 'lista', 24, 19);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_lista_item`
--

CREATE TABLE IF NOT EXISTS `tb_lista_item` (
  `cd_lista_item` int(11) NOT NULL AUTO_INCREMENT,
  `nm_lista_item` varchar(45) NOT NULL,
  `nm_lista_item_desc` varchar(255) DEFAULT NULL,
  `nm_lista_item_qtd` int(11) NOT NULL,
  `id_lista` int(11) NOT NULL,
  PRIMARY KEY (`cd_lista_item`),
  KEY `id_lista` (`id_lista`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `tb_lista_item`
--

INSERT INTO `tb_lista_item` (`cd_lista_item`, `nm_lista_item`, `nm_lista_item_desc`, `nm_lista_item_qtd`, `id_lista`) VALUES
(1, 'Produto1', NULL, 12, 1),
(2, 'Produto2', NULL, 4, 1),
(3, 'Produto3', NULL, 23, 1),
(4, 'Produto4', NULL, 17, 1),
(5, 'aadd', NULL, -4, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `cd_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nm_usuario` varchar(45) NOT NULL,
  `nr_cpf` int(11) NOT NULL,
  `nm_login` varchar(45) NOT NULL,
  `nm_senha` varchar(32) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  PRIMARY KEY (`cd_usuario`),
  KEY `id_empresa` (`id_empresa`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Extraindo dados da tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`cd_usuario`, `nm_usuario`, `nr_cpf`, `nm_login`, `nm_senha`, `id_empresa`) VALUES
(22, 'Abner Lima ', 45454, 'Abner', '202CB962AC59075B964B07152D234B70', 14),
(23, 'Lima Abner', 6666788, 'bucheq', '6e11873b9d9d94a44058bef5747735ce', 14),
(24, 'liticia', 585858, 'leleh50', '202CB962AC59075B964B07152D234B70', 19);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
