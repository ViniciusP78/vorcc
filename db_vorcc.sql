-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 24-Jun-2018 às 03:20
-- Versão do servidor: 10.1.31-MariaDB
-- PHP Version: 7.2.3

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

CREATE TABLE `tb_cotacao` (
  `cd_cotacao` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_lista` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_cotacao`
--

INSERT INTO `tb_cotacao` (`cd_cotacao`, `id_usuario`, `id_empresa`, `id_lista`) VALUES
(22, 34, 33, 9),
(21, 34, 33, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cotacao_item`
--

CREATE TABLE `tb_cotacao_item` (
  `cd_cotacao_item` int(11) NOT NULL,
  `id_cotacao` int(11) NOT NULL,
  `id_lista_item` int(11) NOT NULL,
  `vl_cotacao` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_cotacao_item`
--

INSERT INTO `tb_cotacao_item` (`cd_cotacao_item`, `id_cotacao`, `id_lista_item`, `vl_cotacao`) VALUES
(49, 22, 26, 170),
(48, 22, 27, 410),
(47, 22, 28, 230);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_empresa`
--

CREATE TABLE `tb_empresa` (
  `cd_empresa` int(11) NOT NULL,
  `nm_empresa` varchar(45) NOT NULL,
  `nr_cnpj` int(11) NOT NULL,
  `dt_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bool_fornecedor` tinyint(1) NOT NULL,
  `vl_pin` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_empresa`
--

INSERT INTO `tb_empresa` (`cd_empresa`, `nm_empresa`, `nr_cnpj`, `dt_criacao`, `bool_fornecedor`, `vl_pin`) VALUES
(32, 'comprador', 123, '2018-06-17 19:49:28', 0, 'Q7UdRt!1$Ong@Dtlr9du5w0gPCM7rI#l'),
(33, 'fornecedor', 123, '2018-06-17 19:49:52', 1, '#SUSWETzE$mbzgjKL3TAeM&+3FQzo@uD');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_lista`
--

CREATE TABLE `tb_lista` (
  `cd_lista` int(11) NOT NULL,
  `nm_lista` varchar(45) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_lista`
--

INSERT INTO `tb_lista` (`cd_lista`, `nm_lista`, `id_usuario`, `id_empresa`) VALUES
(9, 'TÃªnis', 33, 32);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_lista_item`
--

CREATE TABLE `tb_lista_item` (
  `cd_lista_item` int(11) NOT NULL,
  `nm_lista_item` varchar(45) NOT NULL,
  `nm_lista_item_desc` varchar(255) DEFAULT NULL,
  `nm_lista_item_qtd` int(11) NOT NULL,
  `id_lista` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_lista_item`
--

INSERT INTO `tb_lista_item` (`cd_lista_item`, `nm_lista_item`, `nm_lista_item_desc`, `nm_lista_item_qtd`, `id_lista`) VALUES
(28, 'TÃªnis da Adidas', NULL, 10, 9),
(27, 'Chuteira da Nike', NULL, 14, 9),
(26, 'All-Star', NULL, 12, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `cd_usuario` int(11) NOT NULL,
  `nm_usuario` varchar(45) NOT NULL,
  `nr_cpf` int(11) NOT NULL,
  `nm_login` varchar(45) NOT NULL,
  `nm_senha` varchar(32) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `nr_acesso` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`cd_usuario`, `nm_usuario`, `nr_cpf`, `nm_login`, `nm_senha`, `id_empresa`, `nr_acesso`) VALUES
(34, 'fornecedor', 123, 'fornecedor', '202cb962ac59075b964b07152d234b70', 33, '1'),
(33, 'comprador', 123, 'comprador', '202cb962ac59075b964b07152d234b70', 32, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_cotacao`
--
ALTER TABLE `tb_cotacao`
  ADD PRIMARY KEY (`cd_cotacao`),
  ADD KEY `id_lista` (`id_lista`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Indexes for table `tb_cotacao_item`
--
ALTER TABLE `tb_cotacao_item`
  ADD PRIMARY KEY (`cd_cotacao_item`),
  ADD KEY `id_cotacao` (`id_cotacao`),
  ADD KEY `id_lista_item` (`id_lista_item`);

--
-- Indexes for table `tb_empresa`
--
ALTER TABLE `tb_empresa`
  ADD PRIMARY KEY (`cd_empresa`);

--
-- Indexes for table `tb_lista`
--
ALTER TABLE `tb_lista`
  ADD PRIMARY KEY (`cd_lista`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Indexes for table `tb_lista_item`
--
ALTER TABLE `tb_lista_item`
  ADD PRIMARY KEY (`cd_lista_item`),
  ADD KEY `id_lista` (`id_lista`);

--
-- Indexes for table `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`cd_usuario`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_cotacao`
--
ALTER TABLE `tb_cotacao`
  MODIFY `cd_cotacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_cotacao_item`
--
ALTER TABLE `tb_cotacao_item`
  MODIFY `cd_cotacao_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tb_empresa`
--
ALTER TABLE `tb_empresa`
  MODIFY `cd_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tb_lista`
--
ALTER TABLE `tb_lista`
  MODIFY `cd_lista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_lista_item`
--
ALTER TABLE `tb_lista_item`
  MODIFY `cd_lista_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `cd_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
