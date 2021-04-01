-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.33-log - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para meta
DROP DATABASE IF EXISTS `meta`;
CREATE DATABASE IF NOT EXISTS `meta` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `meta`;

-- Copiando estrutura para tabela meta.account
DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifier',
  `username` varchar(32) NOT NULL DEFAULT '',
  `sha_pass_hash` varchar(40) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `joindate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_ip` varchar(15) NOT NULL DEFAULT '127.0.0.1',
  `online` int(10) unsigned NOT NULL DEFAULT '0',
  `locale` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `os` varchar(3) NOT NULL DEFAULT '',
  `totaltime` int(10) unsigned NOT NULL DEFAULT '0',
  `recruiter` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Account System';

-- Copiando dados para a tabela meta.account: ~2 rows (aproximadamente)
DELETE FROM `account`;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` (`id`, `username`, `sha_pass_hash`, `email`, `joindate`, `last_ip`, `online`, `locale`, `os`, `totaltime`, `recruiter`) VALUES
	(1, 'A123', 'e4dbb00fb886718f0dffd124f6adb957aac9fc4d', 'a123@hotmail.com', '2021-03-22 21:44:17', '127.0.0.1', 0, 0, '', 0, 0),
	(2, 'B123', '4021d39489de46daf8889193e62dd2b7a139f02d', 'b123@gmail.com', '2021-03-31 17:02:03', '127.0.0.1', 0, 0, '', 0, 0),
	(3, 'C123', 'b28d436d075fd14bd1d52620dcce7f9e2c58c437', 'c123@gmail.com', '2021-03-31 20:48:31', '127.0.0.1', 0, 0, '', 0, 0);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;

-- Copiando estrutura para tabela meta.account_data
DROP TABLE IF EXISTS `account_data`;
CREATE TABLE IF NOT EXISTS `account_data` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `vp` int(32) DEFAULT '0',
  `dp` int(32) DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1231241319 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela meta.account_data: 2 rows
DELETE FROM `account_data`;
/*!40000 ALTER TABLE `account_data` DISABLE KEYS */;
INSERT INTO `account_data` (`id`, `vp`, `dp`) VALUES
	(2, 0, 0),
	(1, 0, 0),
	(3, 0, 0);
/*!40000 ALTER TABLE `account_data` ENABLE KEYS */;

-- Copiando estrutura para tabela meta.disabled_pages
DROP TABLE IF EXISTS `disabled_pages`;
CREATE TABLE IF NOT EXISTS `disabled_pages` (
  `filename` varchar(255) DEFAULT NULL,
  UNIQUE KEY `filename` (`filename`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela meta.disabled_pages: 0 rows
DELETE FROM `disabled_pages`;
/*!40000 ALTER TABLE `disabled_pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `disabled_pages` ENABLE KEYS */;

-- Copiando estrutura para tabela meta.disabled_plugins
DROP TABLE IF EXISTS `disabled_plugins`;
CREATE TABLE IF NOT EXISTS `disabled_plugins` (
  `foldername` varchar(255) DEFAULT NULL,
  UNIQUE KEY `foldername` (`foldername`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela meta.disabled_plugins: ~0 rows (aproximadamente)
DELETE FROM `disabled_plugins`;
/*!40000 ALTER TABLE `disabled_plugins` DISABLE KEYS */;
/*!40000 ALTER TABLE `disabled_plugins` ENABLE KEYS */;

-- Copiando estrutura para tabela meta.news
DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT '0',
  `body` text,
  `author` varchar(100) DEFAULT '0',
  `image` varchar(100) DEFAULT '0',
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela meta.news: 6 rows
DELETE FROM `news`;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id`, `title`, `body`, `author`, `image`, `date`) VALUES
	(1, 'Boas vindas', 'Seja bem-vindo(a) ao META, um fórum de jogos para compartilhamento de informações entre os usuários. Segue abaixo um texto qualquer simplesmente pra preencher isto aqui:\r\n\r\nEm um episódio da série televisiva Black Mirror, por exemplo, um aplicativo pareava pessoas para relacionamentos com base em estatísticas e restringia as possibilidades para apenas as que a máquina indicava – tornando o usuário passivo na escolha. Paralelamente, esse é o objetivo da indústria cultural para os pensadores da Escola de Frankfurt: produzir conteúdos a partir do padrão de gosto do público, para direcioná-lo, torná-lo homogêneo e, logo, facilmente atingível.', 'Erictemponi', 'styles/global/images/icons2/0-1-2.gif', '2020-02-08 14:11:07'),
	(2, 'A Ira do Lich Rei', 'A Profissão de Inscription (Inscrição) é similar à profissão de Enchanting (Encantamento) de itens, porém, a Inscription também encantará feitiços. Por exemplo, um "Inscriptor" pode aprimorar um feitiço Fireball, dando-lhe a habilidade de fazer com que o alvo fique em Daze por 3 segundos, ou fazer com que a habilidade Shadowbolt cause 50 pontos de dano Shadow a mais. Com a criação desta nova profissão, o nivel máximo de qualquer profissão foi aumentado de 375 para 450, com novas receitas/manuais para cada profissão.', 'Gustavo', 'styles/global/images/icons2/1-11-6.gif', '2021-03-31 15:24:43'),
	(3, 'Abracadabra', 'A Profissão de Inscription (Inscrição) é similar à profissão de Enchanting (Encantamento) de itens, porém, a Inscription também encantará feitiços. Por exemplo, um "Inscriptor" pode aprimorar um feitiço Fireball, dando-lhe a habilidade de fazer com que o alvo fique em Daze por 3 segundos, ou fazer com que a habilidade Shadowbolt cause 50 pontos de dano Shadow a mais. Com a criação desta nova profissão, o nivel máximo de qualquer profissão foi aumentado de 375 para 450, com novas receitas/manuais para cada profissão.', 'José', 'styles/global/images/icons2/1-11-1.gif', '2021-03-31 15:24:43'),
	(4, 'Flu fla va ka te', 'A Profissão de Inscription (Inscrição) é similar à profissão de Enchanting (Encantamento) de itens, porém, a Inscription também encantará feitiços. Por exemplo, um "Inscriptor" pode aprimorar um feitiço Fireball, dando-lhe a habilidade de fazer com que o alvo fique em Daze por 3 segundos, ou fazer com que a habilidade Shadowbolt cause 50 pontos de dano Shadow a mais. Com a criação desta nova profissão, o nivel máximo de qualquer profissão foi aumentado de 375 para 450, com novas receitas/manuais para cada profissão.', 'Guilherme', 'styles/global/images/icons2/0-2-9.gif', '2021-03-31 15:24:43'),
	(5, 'Watchdogs 5', 'A Profissão de Inscription (Inscrição) é similar à profissão de Enchanting (Encantamento) de itens, porém, a Inscription também encantará feitiços. Por exemplo, um "Inscriptor" pode aprimorar um feitiço Fireball, dando-lhe a habilidade de fazer com que o alvo fique em Daze por 3 segundos, ou fazer com que a habilidade Shadowbolt cause 50 pontos de dano Shadow a mais. Com a criação desta nova profissão, o nivel máximo de qualquer profissão foi aumentado de 375 para 450, com novas receitas/manuais para cada profissão.', 'Jean', 'styles/global/images/icons2/0-10-2.gif', '2021-03-31 15:24:43'),
	(6, 'Assassin\'s Creed', 'A Profissão de Inscription (Inscrição) é similar à profissão de Enchanting (Encantamento) de itens, porém, a Inscription também encantará feitiços. Por exemplo, um "Inscriptor" pode aprimorar um feitiço Fireball, dando-lhe a habilidade de fazer com que o alvo fique em Daze por 3 segundos, ou fazer com que a habilidade Shadowbolt cause 50 pontos de dano Shadow a mais. Com a criação desta nova profissão, o nivel máximo de qualquer profissão foi aumentado de 375 para 450, com novas receitas/manuais para cada profissão.', 'André', '', '2021-03-31 15:24:43'),
	(7, 'BláBlá Blá', 'A Profissão de Inscription (Inscrição) é similar à profissão de Enchanting (Encantamento) de itens, porém, a Inscription também encantará feitiços. Por exemplo, um "Inscriptor" pode aprimorar um feitiço Fireball, dando-lhe a habilidade de fazer com que o alvo fique em Daze por 3 segundos, ou fazer com que a habilidade Shadowbolt cause 50 pontos de dano Shadow a mais. Com a criação desta nova profissão, o nivel máximo de qualquer profissão foi aumentado de 375 para 450, com novas receitas/manuais para cada profissão.', 'André', '', '2021-03-31 15:24:43');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;

-- Copiando estrutura para tabela meta.news_comments
DROP TABLE IF EXISTS `news_comments`;
CREATE TABLE IF NOT EXISTS `news_comments` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `newsid` int(20) DEFAULT '0',
  `text` text,
  `poster` int(11) DEFAULT NULL,
  `ip` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela meta.news_comments: 4 rows
DELETE FROM `news_comments`;
/*!40000 ALTER TABLE `news_comments` DISABLE KEYS */;
INSERT INTO `news_comments` (`id`, `newsid`, `text`, `poster`, `ip`) VALUES
	(16, 2, 'ahahhahahaha', 1, '::1'),
	(13, 1, 'Comentário', 11, '::1'),
	(14, 2, 'Vai cagar', 11, '::1'),
	(15, 1, 'Heu ou tá tá falal', 1, '::1'),
	(17, 6, 'Gostei da postagem, parabéns', 1, '::1'),
	(18, 6, 'Muito bacana. Gostei demais', 2, '::1');
/*!40000 ALTER TABLE `news_comments` ENABLE KEYS */;

-- Copiando estrutura para tabela meta.password_reset
DROP TABLE IF EXISTS `password_reset`;
CREATE TABLE IF NOT EXISTS `password_reset` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `account_id` int(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela meta.password_reset: 0 rows
DELETE FROM `password_reset`;
/*!40000 ALTER TABLE `password_reset` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset` ENABLE KEYS */;

-- Copiando estrutura para tabela meta.site_links
DROP TABLE IF EXISTS `site_links`;
CREATE TABLE IF NOT EXISTS `site_links` (
  `position` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT '0',
  `url` varchar(150) DEFAULT '0',
  `shownWhen` enum('notlogged','logged','always') DEFAULT NULL,
  UNIQUE KEY `position` (`position`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela meta.site_links: 3 rows
DELETE FROM `site_links`;
/*!40000 ALTER TABLE `site_links` DISABLE KEYS */;
INSERT INTO `site_links` (`position`, `title`, `url`, `shownWhen`) VALUES
	(1, 'Início', '?p=home', 'always'),
	(2, 'Registrar', '?p=register', 'notlogged'),
	(3, 'Minha Conta', '?p=account', 'logged');
/*!40000 ALTER TABLE `site_links` ENABLE KEYS */;

-- Copiando estrutura para tabela meta.slider_images
DROP TABLE IF EXISTS `slider_images`;
CREATE TABLE IF NOT EXISTS `slider_images` (
  `position` int(10) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  UNIQUE KEY `position` (`position`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela meta.slider_images: 2 rows
DELETE FROM `slider_images`;
/*!40000 ALTER TABLE `slider_images` DISABLE KEYS */;
INSERT INTO `slider_images` (`position`, `path`, `link`) VALUES
	(1, 'styles/global/slideshow/images/1.jpg', ''),
	(2, 'styles/global/slideshow/images/2.jpg', '');
/*!40000 ALTER TABLE `slider_images` ENABLE KEYS */;

-- Copiando estrutura para tabela meta.template
DROP TABLE IF EXISTS `template`;
CREATE TABLE IF NOT EXISTS `template` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  `applied` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela meta.template: 1 rows
DELETE FROM `template`;
/*!40000 ALTER TABLE `template` DISABLE KEYS */;
INSERT INTO `template` (`id`, `name`, `path`, `applied`) VALUES
	(1, 'Default', 'default', '1');
/*!40000 ALTER TABLE `template` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
