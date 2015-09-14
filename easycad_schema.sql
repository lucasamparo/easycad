-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 14-Set-2015 às 09:35
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
  KEY `MatriculaCertificado` (`idMatricula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `idCurso` int(11) NOT NULL AUTO_INCREMENT,
  `idEvento` int(11) DEFAULT NULL,
  `nomeCurso` varchar(255) DEFAULT NULL,
  `conteudo` text,
  `valor` double DEFAULT NULL,
  `cargaHoraria` int(11) DEFAULT NULL,
  `dataCurso` date DEFAULT NULL,
  PRIMARY KEY (`idCurso`),
  KEY `CursoEvento` (`idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `telefone` varchar(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tipo` enum('PF','PJ') DEFAULT NULL,
  PRIMARY KEY (`idEntidade`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula`
--

CREATE TABLE IF NOT EXISTS `matricula` (
  `idMatricula` int(11) NOT NULL AUTO_INCREMENT,
  `idEntidade` int(11) DEFAULT NULL,
  `idCurso` int(11) DEFAULT NULL,
  `dataHoraMatricula` datetime DEFAULT NULL,
  PRIMARY KEY (`idMatricula`),
  KEY `matriculaEntidade_idx` (`idEntidade`),
  KEY `matriculaCurso_idx` (`idCurso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
