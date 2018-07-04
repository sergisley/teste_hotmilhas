-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.19 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para hotmilhas
CREATE DATABASE IF NOT EXISTS `hotmilhas` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `hotmilhas`;

-- Copiando estrutura para tabela hotmilhas.quizzes
CREATE TABLE IF NOT EXISTS `quizzes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `question` varchar(400) NOT NULL,
  `description` text,
  `txt_answer_1` varchar(400) NOT NULL,
  `txt_answer_2` varchar(400) NOT NULL,
  `txt_answer_3` varchar(400) NOT NULL,
  `txt_answer_4` varchar(400) NOT NULL,
  `txt_answer_5` varchar(400) NOT NULL,
  `vlr_answer_1` int(11) NOT NULL DEFAULT '0',
  `vlr_answer_2` int(11) NOT NULL DEFAULT '0',
  `vlr_answer_3` int(11) NOT NULL DEFAULT '0',
  `vlr_answer_4` int(11) NOT NULL DEFAULT '0',
  `vlr_answer_5` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela hotmilhas.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '0',
  `email` varchar(200) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
