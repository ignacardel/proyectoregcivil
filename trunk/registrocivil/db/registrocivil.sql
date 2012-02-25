-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 25, 2012 at 04:59 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `registrocivil`
--

-- --------------------------------------------------------

--
-- Table structure for table `adquisicion_nacionalidad`
--

CREATE TABLE IF NOT EXISTS `adquisicion_nacionalidad` (
  `id` varchar(50) NOT NULL,
  `tipoid` varchar(3) NOT NULL,
  `acta_no` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `fecha_nac` date NOT NULL,
  `edo_civil` varchar(1) NOT NULL,
  `profesion` varchar(50) NOT NULL,
  `nombre_padre` varchar(50) NOT NULL,
  `id_padre` varchar(50) NOT NULL,
  `tipoid_padre` varchar(3) NOT NULL,
  `origen_padre` varchar(50) NOT NULL,
  `nombre_madre` varchar(50) NOT NULL,
  `id_madre` varchar(50) NOT NULL,
  `tipoid_madre` varchar(3) NOT NULL,
  `origen_madre` varchar(50) NOT NULL,
  `origen` varchar(50) NOT NULL,
  `direccion_completa` varchar(200) NOT NULL,
  `fk_autoridad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_autoridad` (`fk_autoridad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `autoridad`
--

CREATE TABLE IF NOT EXISTS `autoridad` (
  `ci` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  PRIMARY KEY (`ci`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `naturalizacion`
--

CREATE TABLE IF NOT EXISTS `naturalizacion` (
  `id` varchar(50) NOT NULL,
  `tipoid` varchar(3) NOT NULL,
  `acta_no` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `contenido` text NOT NULL,
  `fk_autoridad` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `tomo` int(11) NOT NULL,
  `folio` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_autoridad` (`fk_autoridad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `renuncia_nacionalidad`
--

CREATE TABLE IF NOT EXISTS `renuncia_nacionalidad` (
  `id` varchar(50) NOT NULL,
  `tipoid` varchar(3) NOT NULL,
  `acta_no` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `fecha_nac` date NOT NULL,
  `edo_civil` varchar(1) NOT NULL,
  `profesion` varchar(50) NOT NULL,
  `domicilio` varchar(200) NOT NULL,
  `testigo1` varchar(50) NOT NULL,
  `testigo2` varchar(50) NOT NULL,
  `nac_testigo1` varchar(50) NOT NULL,
  `nac_testigo2` varchar(50) NOT NULL,
  `id_testigo1` varchar(50) NOT NULL,
  `tipoid_testigo1` varchar(3) NOT NULL,
  `id_testigo2` varchar(50) NOT NULL,
  `tipoid_testigo2` varchar(3) NOT NULL,
  `fk_autoridad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_autoridad` (`fk_autoridad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adquisicion_nacionalidad`
--
ALTER TABLE `adquisicion_nacionalidad`
  ADD CONSTRAINT `adquisicion_nacionalidad_ibfk_1` FOREIGN KEY (`fk_autoridad`) REFERENCES `autoridad` (`ci`);

--
-- Constraints for table `naturalizacion`
--
ALTER TABLE `naturalizacion`
  ADD CONSTRAINT `naturalizacion_ibfk_1` FOREIGN KEY (`fk_autoridad`) REFERENCES `autoridad` (`ci`);

--
-- Constraints for table `renuncia_nacionalidad`
--
ALTER TABLE `renuncia_nacionalidad`
  ADD CONSTRAINT `renuncia_nacionalidad_ibfk_1` FOREIGN KEY (`fk_autoridad`) REFERENCES `autoridad` (`ci`);
