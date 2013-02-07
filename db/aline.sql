-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-02-2013 a las 10:50:08
-- Versión del servidor: 5.5.29
-- Versión de PHP: 5.3.10-1ubuntu3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `aline`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_post` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `orden` int(10) unsigned NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `width` int(11) NOT NULL,
  `heigth` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `clicks` int(11) NOT NULL,
  `activo` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `slug`) VALUES
(1, 'Prueba', 'prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE IF NOT EXISTS `configuracion` (
  `titulo` varchar(50) NOT NULL DEFAULT 'Nombre de página',
  `logo` varchar(50) DEFAULT NULL,
  `correo_admin` varchar(50) NOT NULL,
  `nombre_admin` varchar(25) DEFAULT NULL,
  `plantilla` int(2) NOT NULL,
  `twitter` varchar(25) DEFAULT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `google` varchar(50) DEFAULT NULL,
  `no_articulos` int(3) NOT NULL DEFAULT '4',
  `categorias` varchar(50) DEFAULT NULL,
  `logo_ancho` int(10) NOT NULL DEFAULT '0',
  `logo_alto` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`titulo`, `logo`, `correo_admin`, `nombre_admin`, `plantilla`, `twitter`, `facebook`, `google`, `no_articulos`, `categorias`, `logo_ancho`, `logo_alto`) VALUES
('fau', 'banner_huitzi13.png', 'fau.ortiz.9@gmail.com', 'fau', 3, 'fau09', '09fau09', 'fabian@newemage.com', 4, '1', 50, 179);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_menu`
--

CREATE TABLE IF NOT EXISTS `item_menu` (
  `idItem` int(11) NOT NULL AUTO_INCREMENT,
  `idmenu` int(4) NOT NULL,
  `idpost` int(4) NOT NULL DEFAULT '0',
  `titulo` varchar(255) NOT NULL,
  `slug` text NOT NULL,
  `padre` int(11) NOT NULL DEFAULT '0',
  `tipo` int(11) NOT NULL DEFAULT '0' COMMENT '1 = Home | 2 = Contact | 3 = Page | 4 = Articulo | 5 = Blog | 6 = URL Externa',
  `orden` int(11) NOT NULL DEFAULT '0',
  `id_css` varchar(255) DEFAULT NULL,
  `clase` varchar(255) DEFAULT NULL,
  `atri` text NOT NULL,
  `is_logged` varchar(50) NOT NULL DEFAULT 'no',
  `url` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idItem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `id_css` varchar(255) DEFAULT NULL,
  `clase` varchar(255) DEFAULT NULL,
  `atributos` text NOT NULL,
  `id_post` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `titulo`, `descripcion`, `id_css`, `clase`, `atributos`, `id_post`) VALUES
(27, 'Main Menu', '', NULL, 'nav nav-pills', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_autor` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `slug` text NOT NULL,
  `contenido` longtext NOT NULL,
  `fecha` date NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `fecha_despublicacion` date NOT NULL,
  `estado` int(11) NOT NULL COMMENT '{1--publico} {2--en espera}{3--papelera}',
  `etiquetas` text NOT NULL,
  `tipo` int(2) NOT NULL COMMENT '1 = post |  2 = page',
  `plantilla` int(2) NOT NULL DEFAULT '1',
  `pag_inicio` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`id`, `id_autor`, `id_categoria`, `titulo`, `slug`, `contenido`, `fecha`, `fecha_publicacion`, `fecha_despublicacion`, `estado`, `etiquetas`, `tipo`, `plantilla`, `pag_inicio`) VALUES
(1, 2, 1, 'asdads', 'adsads', '<p>\n	asdadad</p>', '2013-01-28', '2013-01-28', '0000-00-00', 1, '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `pass` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `perfil` int(1) NOT NULL COMMENT '{1--admin} {2--editor} {3--suscriptor}',
  `estado` int(2) NOT NULL DEFAULT '0' COMMENT '1 = activo | 0 = Inactivo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `usuario`, `pass`, `email`, `perfil`, `estado`) VALUES
(2, 'fabian', 'ortiz', 'fau09', '72c3364465bbdf009e54b70d73881caf', 'fabian@newemage.com', 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
