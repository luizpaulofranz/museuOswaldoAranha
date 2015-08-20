-- phpMyAdmin SQL Dump
-- version 4.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 20/08/2015 às 11:38
-- Versão do servidor: 5.5.44-0ubuntu0.14.04.1
-- Versão do PHP: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `museuOswaldoAranha`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
`idAdministrador` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `conteudo`
--

CREATE TABLE IF NOT EXISTS `conteudo` (
`idConteudo` int(11) NOT NULL,
  `titulo` varchar(80) NOT NULL,
  `slug` varchar(80) NOT NULL,
  `data` datetime NOT NULL,
  `conteudo` longtext NOT NULL,
  `resumo` varchar(255) DEFAULT NULL,
  `idTipoConteudo` int(11) NOT NULL,
  `idAdministrador` int(11) NOT NULL,
  `rascunho` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `media`
--

CREATE TABLE IF NOT EXISTS `media` (
`idMedia` int(11) NOT NULL,
  `descricao` varchar(145) DEFAULT NULL,
  `urlPath` varchar(200) NOT NULL,
  `nome` varchar(75) NOT NULL,
  `dataUpload` date NOT NULL,
  `idConteudo` int(11) DEFAULT NULL,
  `destaque` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipoConteudo`
--

CREATE TABLE IF NOT EXISTS `tipoConteudo` (
`idTipoConteudo` int(11) NOT NULL,
  `descricao` varchar(80) NOT NULL,
  `slug` varchar(80) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `administrador`
--
ALTER TABLE `administrador`
 ADD PRIMARY KEY (`idAdministrador`);

--
-- Índices de tabela `ci_sessions`
--
ALTER TABLE `ci_sessions`
 ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `conteudo`
--
ALTER TABLE `conteudo`
 ADD PRIMARY KEY (`idConteudo`), ADD KEY `fk_conteudo_tipoConteudo1_idx` (`idTipoConteudo`), ADD KEY `fk_conteudo_administrador1_idx` (`idAdministrador`);

--
-- Índices de tabela `media`
--
ALTER TABLE `media`
 ADD PRIMARY KEY (`idMedia`), ADD KEY `fk_media_conteudo1_idx` (`idConteudo`);

--
-- Índices de tabela `tipoConteudo`
--
ALTER TABLE `tipoConteudo`
 ADD PRIMARY KEY (`idTipoConteudo`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
MODIFY `idAdministrador` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `conteudo`
--
ALTER TABLE `conteudo`
MODIFY `idConteudo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de tabela `media`
--
ALTER TABLE `media`
MODIFY `idMedia` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de tabela `tipoConteudo`
--
ALTER TABLE `tipoConteudo`
MODIFY `idTipoConteudo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `conteudo`
--
ALTER TABLE `conteudo`
ADD CONSTRAINT `fk_conteudo_administrador1` FOREIGN KEY (`idAdministrador`) REFERENCES `administrador` (`idAdministrador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_conteudo_tipoConteudo1` FOREIGN KEY (`idTipoConteudo`) REFERENCES `tipoConteudo` (`idTipoConteudo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `media`
--
ALTER TABLE `media`
ADD CONSTRAINT `fk_media_conteudo1` FOREIGN KEY (`idConteudo`) REFERENCES `conteudo` (`idConteudo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
