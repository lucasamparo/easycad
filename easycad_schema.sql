-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 11-Dez-2015 às 20:49
-- Versão do servidor: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `easycad`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `certificado`
--

CREATE TABLE IF NOT EXISTS `certificado` (
  `idCertificado` int(11) NOT NULL AUTO_INCREMENT,
  `idMatricula` int(11) DEFAULT NULL,
  `codigo` varchar(12) DEFAULT NULL,
  `dataEmissao` date DEFAULT NULL,
  PRIMARY KEY (`idCertificado`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `MatriculaCertificado` (`idMatricula`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=98 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `idCurso` int(11) NOT NULL AUTO_INCREMENT,
  `idEvento` int(11) DEFAULT NULL,
  `nomeCurso` varchar(255) DEFAULT NULL,
  `local` varchar(255) NOT NULL,
  `conteudo` text,
  `valor` double DEFAULT NULL,
  `cargaHoraria` int(11) DEFAULT NULL,
  `corTexto` varchar(7) NOT NULL,
  `layout` enum('1','2') NOT NULL DEFAULT '1',
  `verso` enum('S','N') NOT NULL,
  `liberarCertificado` enum('S','N') NOT NULL,
  `ativo` enum('S','N') NOT NULL,
  `dataInicio` date DEFAULT NULL,
  `dataFim` date DEFAULT NULL,
  PRIMARY KEY (`idCurso`),
  KEY `CursoEvento` (`idEvento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `idEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `nomeFantasia` varchar(255) DEFAULT NULL,
  `razaoSocial` varchar(255) DEFAULT NULL,
  `responsavel` varchar(255) DEFAULT NULL,
  `login` varchar(30) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idEmpresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `entidade`
--

CREATE TABLE IF NOT EXISTS `entidade` (
  `idEntidade` int(11) NOT NULL AUTO_INCREMENT,
  `nomeEntidade` varchar(255) DEFAULT NULL,
  `cnpj_cpf` varchar(18) DEFAULT NULL,
  `telefone` varchar(18) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tipo` enum('PF','PJ') DEFAULT NULL,
  PRIMARY KEY (`idEntidade`),
  UNIQUE KEY `cnpj_cpf` (`cnpj_cpf`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
  `idEvento` int(11) NOT NULL AUTO_INCREMENT,
  `nomeEvento` varchar(255) DEFAULT NULL,
  `dataInicio` date DEFAULT NULL,
  `dateFim` date DEFAULT NULL,
  `modalidade` enum('P','O','PO','N') DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `cargaHoraria` int(11) DEFAULT NULL,
  `ativo` enum('S','N') NOT NULL,
  `corTexto` varchar(7) NOT NULL,
  `layout` enum('1','2') NOT NULL,
  `verso` enum('S','N') NOT NULL,
  `geraCertificado` enum('S','N') NOT NULL,
  `liberarCertificado` enum('S','N') NOT NULL,
  PRIMARY KEY (`idEvento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula`
--

CREATE TABLE IF NOT EXISTS `matricula` (
  `idMatricula` int(11) NOT NULL AUTO_INCREMENT,
  `idEntidade` int(11) DEFAULT NULL,
  `idCurso` int(11) DEFAULT NULL,
  `presenca` enum('P','A') NOT NULL DEFAULT 'A',
  `tipo` enum('P','A','C') NOT NULL,
  `dataHoraMatricula` datetime DEFAULT NULL,
  PRIMARY KEY (`idMatricula`),
  UNIQUE KEY `idEntidade` (`idEntidade`,`idCurso`),
  KEY `matriculaEntidade_idx` (`idEntidade`),
  KEY `matriculaCurso_idx` (`idCurso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `membros`
--

CREATE TABLE IF NOT EXISTS `membros` (
  `codMembro` int(11) NOT NULL AUTO_INCREMENT,
  `nomeMembro` varchar(255) NOT NULL,
  `ativo` enum('S','N') NOT NULL DEFAULT 'S',
  PRIMARY KEY (`codMembro`),
  UNIQUE KEY `nomeMembro` (`nomeMembro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vinculo`
--

CREATE TABLE IF NOT EXISTS `vinculo` (
  `idVinculo` int(11) NOT NULL AUTO_INCREMENT,
  `codMembro` int(11) NOT NULL,
  `funcao` varchar(255) NOT NULL,
  `dataAdmissao` date NOT NULL,
  `dataDemissao` date DEFAULT NULL,
  PRIMARY KEY (`idVinculo`),
  KEY `codMembro` (`codMembro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `certificado`
--
ALTER TABLE `certificado`
  ADD CONSTRAINT `MatriculaCertificado` FOREIGN KEY (`idMatricula`) REFERENCES `matricula` (`idMatricula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `CursoEvento` FOREIGN KEY (`idEvento`) REFERENCES `evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matriculaCurso` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `matriculaEntidade` FOREIGN KEY (`idEntidade`) REFERENCES `entidade` (`idEntidade`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `vinculo`
--
ALTER TABLE `vinculo`
  ADD CONSTRAINT `vinculo_ibfk_1` FOREIGN KEY (`codMembro`) REFERENCES `membros` (`codMembro`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
