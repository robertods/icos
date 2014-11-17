-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generaci√≥n: 17-11-2014 a las 03:06:13
-- Versi√≥n del servidor: 5.6.20
-- Versi√≥n de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `menta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alerta`
--

CREATE TABLE IF NOT EXISTS `alerta` (
`id_alerta` int(11) NOT NULL,
  `mensaje_alerta` varchar(255) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `visto` int(11) NOT NULL DEFAULT '0',
  `debaja` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `alerta`
--

INSERT INTO `alerta` (`id_alerta`, `mensaje_alerta`, `id_producto`, `id_usuario`, `visto`, `debaja`) VALUES
(1, 'Han publicado un RELOJ que puede interesarte!', 1, 4, 0, 0),
(7, 'rober desea un producto que quiz√É¬°s podr√É¬≠as tener...1', 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE IF NOT EXISTS `calificacion` (
`id_calificacion` int(11) NOT NULL,
  `puntaje` int(11) NOT NULL,
  `debaja` int(11) NOT NULL DEFAULT '0',
  `fechmod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
`id_categoria` int(11) NOT NULL,
  `descripcion_categoria` varchar(255) NOT NULL,
  `tipo` int(11) NOT NULL DEFAULT '0',
  `debaja` int(11) NOT NULL DEFAULT '0',
  `fechmod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `descripcion_categoria`, `tipo`, `debaja`, `fechmod`) VALUES
(1, 'Arte y antiguedades', 0, 0, '2014-10-26 20:18:36'),
(2, 'Bebes', 0, 0, '2014-11-14 16:27:57'),
(3, 'Camaras y accesorios', 0, 0, '2014-11-14 16:27:57'),
(4, 'Celulares y telefonia', 0, 0, '2014-11-14 16:28:52'),
(5, 'Coleccionismo', 0, 0, '2014-11-14 16:28:52'),
(6, 'Computacion y accesorios', 0, 0, '2014-11-14 16:31:23'),
(7, 'Consolas y videojuegos', 0, 0, '2014-11-14 16:31:23'),
(8, 'Deportes ', 0, 0, '2014-11-14 16:32:04'),
(9, 'Electrodomesticos', 0, 0, '2014-11-14 16:32:04'),
(10, 'Electronica, audio y video', 0, 0, '2014-11-14 16:35:05'),
(11, 'Hogar, muebles y jardin', 0, 0, '2014-11-14 16:35:05'),
(12, 'Industriales y oficinas', 0, 0, '2014-11-14 16:36:43'),
(13, 'Instrumentos musicales', 0, 0, '2014-11-14 16:36:43'),
(14, 'Joyas y relojes', 0, 0, '2014-11-14 16:37:11'),
(15, 'Juegos y juguetes', 0, 0, '2014-11-14 16:37:11'),
(16, 'Libros, textos y revistas', 0, 0, '2014-11-14 16:37:45'),
(17, 'Musica y peliculas', 0, 0, '2014-11-14 16:37:45'),
(18, 'Ocio y cultura', 0, 0, '2014-11-14 16:38:00'),
(19, 'Propiedades', 0, 0, '2014-11-14 16:38:00'),
(20, 'Salud y belleza', 0, 0, '2014-11-14 16:38:24'),
(21, 'Vehiculos y accesorios', 0, 0, '2014-11-14 16:38:24'),
(22, 'Vestuario y calzado', 0, 0, '2014-11-14 16:38:49'),
(23, '---- Otra categoria ---- ', 0, 0, '2014-11-14 16:38:49'),
(24, 'Asesoria juridica', 1, 0, '2014-10-26 20:19:55'),
(25, 'Comunicacion y publicidad', 1, 0, '2014-11-14 16:40:16'),
(26, 'Cuidador', 1, 0, '2014-11-14 16:40:16'),
(27, 'Deportes', 1, 0, '2014-11-14 16:43:07'),
(28, 'Educacion y docencia', 1, 0, '2014-11-14 16:43:07'),
(29, 'Familia y hogar', 1, 0, '2014-11-14 16:48:10'),
(30, 'Limpieza', 1, 0, '2014-11-14 16:48:10'),
(31, 'Mano de obra, mantenimiento y jardin', 1, 0, '2014-11-14 16:48:42'),
(32, 'Medicina, salud y belleza', 1, 0, '2014-11-14 16:48:42'),
(33, 'Musica', 1, 0, '2014-11-14 16:50:37'),
(34, 'Negocios y finanzas ', 1, 0, '2014-11-14 16:50:37'),
(35, 'Psicologia', 1, 0, '2014-11-14 16:50:37'),
(36, 'Tecnologia ', 1, 0, '2014-11-14 16:50:37'),
(37, 'Turismo y viajes', 1, 0, '2014-11-14 16:50:37'),
(38, '---- Otra categoria ---- ', 1, 0, '2014-11-14 17:13:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
`id` int(10) unsigned NOT NULL,
  `fromUser` varchar(255) NOT NULL DEFAULT '',
  `toUser` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`id`, `fromUser`, `toUser`, `message`, `sent`, `recd`) VALUES
(1, 'marcela', 'rober', 'hola roberto', '2014-11-16 22:57:57', 1),
(2, 'marcela', 'marcela', 'yo misma', '2014-11-16 22:58:28', 1),
(3, 'rober', 'marcela', 'hola marce', '2014-11-16 22:59:03', 1),
(4, 'rober', 'marcela', 'como va?', '2014-11-16 22:59:07', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denuncia`
--

CREATE TABLE IF NOT EXISTS `denuncia` (
`id_denuncia` int(11) NOT NULL,
  `detalle_denuncia` varchar(255) NOT NULL,
  `tipo_denuncia` int(11) NOT NULL,
  `id_usuario_demandado` int(11) DEFAULT NULL,
  `id_usuario_demandante` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_propuesta` int(11) DEFAULT NULL,
  `fecha_denuncia` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `denuncia`
--

INSERT INTO `denuncia` (`id_denuncia`, `detalle_denuncia`, `tipo_denuncia`, `id_usuario_demandado`, `id_usuario_demandante`, `id_producto`, `id_propuesta`, `fecha_denuncia`) VALUES
(1, 'prueba primer denuncia a usuario 4, yo soy robert', 2, NULL, 4, NULL, NULL, '2014-11-01 16:08:27'),
(2, 'primer prueba!!!', 2, 4, 4, NULL, NULL, '2014-11-01 16:09:27'),
(3, 'segunda prueba', 1, 4, 4, 1, NULL, '2014-11-01 16:09:27'),
(4, 'tercer prueba', 1, 4, 4, NULL, 1, '2014-11-01 16:09:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deseado_etiqueta`
--

CREATE TABLE IF NOT EXISTS `deseado_etiqueta` (
`id_deseo_etiq` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_etiqueta` int(11) NOT NULL,
  `debaja` int(11) NOT NULL DEFAULT '0',
  `fechmod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `deseado_etiqueta`
--

INSERT INTO `deseado_etiqueta` (`id_deseo_etiq`, `id_producto`, `id_etiqueta`, `debaja`, `fechmod`) VALUES
(1, 1, 75, 0, '2014-11-15 19:34:26'),
(2, 1, 76, 0, '2014-11-15 19:34:26'),
(3, 1, 77, 0, '2014-11-15 19:34:26'),
(4, 2, 72, 0, '2014-11-15 19:36:48'),
(5, 2, 73, 0, '2014-11-15 19:36:48'),
(6, 2, 93, 0, '2014-11-15 19:36:48'),
(7, 3, 37, 0, '2014-11-15 19:40:57'),
(8, 3, 94, 0, '2014-11-15 19:40:57'),
(10, 4, 48, 0, '2014-11-15 19:49:10'),
(11, 4, 91, 0, '2014-11-15 19:49:10'),
(12, 4, 92, 0, '2014-11-15 19:49:10'),
(13, 5, 48, 0, '2014-11-15 19:58:49'),
(14, 5, 95, 0, '2014-11-15 19:58:49'),
(15, 5, 98, 0, '2014-11-15 19:58:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta`
--

CREATE TABLE IF NOT EXISTS `etiqueta` (
`id_etiqueta` int(11) NOT NULL,
  `descripcion_etiqueta` varchar(255) NOT NULL,
  `debaja` int(11) NOT NULL DEFAULT '0',
  `fechmod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=99 ;

--
-- Volcado de datos para la tabla `etiqueta`
--

INSERT INTO `etiqueta` (`id_etiqueta`, `descripcion_etiqueta`, `debaja`, `fechmod`) VALUES
(1, 'heladera', 0, '2014-10-13 04:32:44'),
(2, 'etiq4', 0, '2014-10-13 04:32:58'),
(3, 'reloj', 0, '2014-10-13 04:32:58'),
(6, 'etiqueta3', 0, '2014-11-10 00:01:18'),
(7, 'etiqueta2', 0, '2014-11-10 00:02:51'),
(8, 'etiqueta1', 0, '2014-11-10 00:06:16'),
(9, 'qwerty', 0, '2014-11-10 00:33:03'),
(10, 'rtweb', 0, '2014-11-10 00:33:03'),
(11, 'geo', 0, '2014-11-10 02:04:45'),
(12, 'etiq1', 0, '2014-11-10 02:04:45'),
(13, 'uno', 0, '2014-11-10 02:08:33'),
(14, 'dos', 0, '2014-11-10 02:08:33'),
(15, 'jump', 0, '2014-11-10 02:08:33'),
(16, 'qwe', 0, '2014-11-10 02:10:05'),
(17, 'tgb', 0, '2014-11-10 02:10:05'),
(18, 'ghjk', 0, '2014-11-10 02:13:25'),
(19, 'power', 0, '2014-11-10 02:13:25'),
(20, 'dc', 0, '2014-11-10 02:13:25'),
(21, 'electrodomestico', 0, '2014-11-11 01:24:54'),
(22, 'servicio', 0, '2014-11-11 01:37:48'),
(23, 'ramos', 0, '2014-11-11 01:37:48'),
(24, 'mejia', 0, '2014-11-11 01:37:48'),
(25, 'uu', 0, '2014-11-12 14:26:46'),
(26, 'gg', 0, '2014-11-13 21:14:29'),
(27, 'ss', 0, '2014-11-13 22:31:25'),
(28, 'fff', 0, '2014-11-13 22:38:08'),
(29, 'd', 0, '2014-11-13 22:39:50'),
(30, 'h', 0, '2014-11-13 22:42:16'),
(31, 'eeee', 0, '2014-11-13 22:44:50'),
(32, 'ert', 0, '2014-11-14 01:53:32'),
(33, 'aaa', 0, '2014-11-14 01:58:58'),
(34, 'wwwww', 0, '2014-11-14 02:00:40'),
(35, 'ddd', 0, '2014-11-14 02:02:18'),
(36, 'sss', 0, '2014-11-14 02:33:02'),
(37, 'figuritas', 0, '2014-11-14 17:34:33'),
(38, 'ff', 0, '2014-11-14 18:52:09'),
(39, 'rojo', 0, '2014-11-15 17:02:42'),
(40, 'memoria', 0, '2014-11-15 17:02:42'),
(41, 'pulsera', 0, '2014-11-15 17:38:09'),
(42, 'agujas', 0, '2014-11-15 17:38:09'),
(43, 'acero', 0, '2014-11-15 17:38:09'),
(44, 'xbox', 0, '2014-11-15 17:38:09'),
(45, 'consola', 0, '2014-11-15 17:38:09'),
(46, 'negra', 0, '2014-11-15 17:38:09'),
(47, 'ffdsfsfsd', 0, '2014-11-15 17:41:50'),
(48, 'libro', 0, '2014-11-15 17:41:50'),
(49, 'padre', 0, '2014-11-15 17:41:50'),
(50, 'pobre', 0, '2014-11-15 17:41:50'),
(51, 'rico', 0, '2014-11-15 17:41:50'),
(52, 'pelota', 0, '2014-11-15 17:52:20'),
(53, 'mundial', 0, '2014-11-15 17:52:20'),
(54, 'futbol', 0, '2014-11-15 17:52:20'),
(55, 'clases', 0, '2014-11-15 17:52:20'),
(56, 'juvenil', 0, '2014-11-15 17:52:20'),
(57, 'dfgdf', 0, '2014-11-15 17:56:07'),
(58, 'dghg', 0, '2014-11-15 17:56:07'),
(59, 'bebe', 0, '2014-11-15 17:56:07'),
(60, 'baboso', 0, '2014-11-15 17:56:07'),
(61, 'tranquilo', 0, '2014-11-15 17:56:07'),
(62, 'peladito', 0, '2014-11-15 17:56:07'),
(63, 'dormilon', 0, '2014-11-15 17:56:08'),
(64, 'sdfgs', 0, '2014-11-15 17:58:38'),
(65, 'gd', 0, '2014-11-15 17:58:38'),
(66, 'g', 0, '2014-11-15 17:58:38'),
(67, 'drn', 0, '2014-11-15 17:58:38'),
(68, 'cd', 0, '2014-11-15 17:58:38'),
(69, 'musica', 0, '2014-11-15 17:58:38'),
(70, 'rock', 0, '2014-11-15 17:58:38'),
(71, 'tango', 0, '2014-11-15 17:58:38'),
(72, 'pc', 0, '2014-11-15 18:32:58'),
(73, 'windows', 0, '2014-11-15 18:32:58'),
(74, 'xp', 0, '2014-11-15 18:32:58'),
(75, 'mac', 0, '2014-11-15 18:32:58'),
(76, 'osx', 0, '2014-11-15 18:32:58'),
(77, 'lion', 0, '2014-11-15 18:32:58'),
(78, 'macbook', 0, '2014-11-15 18:36:36'),
(79, 'seven', 0, '2014-11-15 18:36:36'),
(80, 'anillo', 0, '2014-11-15 18:45:36'),
(81, 'oro', 0, '2014-11-15 18:45:36'),
(82, 'lindo', 0, '2014-11-15 18:45:36'),
(83, 'trompeta', 0, '2014-11-15 18:45:36'),
(84, 'jazz', 0, '2014-11-15 18:45:36'),
(85, 'plateada', 0, '2014-11-15 18:45:36'),
(86, 'saxofon', 0, '2014-11-15 18:49:36'),
(87, 'plateado', 0, '2014-11-15 18:49:36'),
(88, 'collar', 0, '2014-11-15 18:49:36'),
(89, 'piedra', 0, '2014-11-15 18:49:36'),
(90, 'nueva', 0, '2014-11-15 19:34:26'),
(91, 'tecnico', 0, '2014-11-15 19:36:48'),
(92, 'sinderman', 0, '2014-11-15 19:36:48'),
(93, '8.1', 0, '2014-11-15 19:36:48'),
(94, 'hijitus', 0, '2014-11-15 19:40:57'),
(95, 'matematica', 0, '2014-11-15 19:49:10'),
(96, 'frances', 0, '2014-11-15 19:58:48'),
(97, 'particular', 0, '2014-11-15 19:58:48'),
(98, 'nuevo', 0, '2014-11-15 19:58:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_producto_propuesto`
--

CREATE TABLE IF NOT EXISTS `lista_producto_propuesto` (
  `id_lista_producto_propuesto` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lista_producto_propuesto`
--

INSERT INTO `lista_producto_propuesto` (`id_lista_producto_propuesto`, `id_producto`) VALUES
(1, 2),
(1, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
`id_perfil` int(11) NOT NULL,
  `nombre_perfil` varchar(140) DEFAULT NULL,
  `avatar_perfil` varchar(200) DEFAULT NULL,
  `prestigio_perfil` int(11) NOT NULL DEFAULT '0',
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL DEFAULT '1',
  `fechmod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `debaja` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `nombre_perfil`, `avatar_perfil`, `prestigio_perfil`, `id_usuario`, `id_rol`, `fechmod`, `debaja`) VALUES
(1, 'Marcela', NULL, 3, 1, 1, '2014-10-20 14:23:35', 0),
(2, 'administrador', '', 0, 2, 2, '2014-10-20 16:50:37', 0),
(3, 'edu', NULL, 0, 3, 1, '2014-10-21 02:39:08', 0),
(4, 'Rober', NULL, 0, 4, 1, '2014-10-26 13:43:36', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
`id_producto` int(11) NOT NULL,
  `titulo_producto` varchar(140) DEFAULT NULL,
  `foto_principal` int(11) DEFAULT NULL,
  `descripcion_producto` varchar(255) DEFAULT NULL,
  `url_producto` varchar(255) NOT NULL,
  `ubicacion_producto` point DEFAULT NULL,
  `disponible_producto` int(11) DEFAULT '1',
  `id_categoria` int(11) DEFAULT NULL,
  `es_servicio` int(255) NOT NULL DEFAULT '0',
  `debaja` int(11) NOT NULL DEFAULT '0',
  `fechmod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `titulo_producto`, `foto_principal`, `descripcion_producto`, `url_producto`, `ubicacion_producto`, `disponible_producto`, `id_categoria`, `es_servicio`, `debaja`, `fechmod`, `id_usuario`) VALUES
(1, 'pc con windows ', 1, 'pc', 'pc-con-windows-', '\0\0\0\0\0\0\0\0\0\0ŸGM¿≠cá≤ÆUA¿', 1, 6, 0, 0, '2014-11-15 19:34:26', 4),
(2, 'tecnica digitales', 1, 'libro', 'tecnica-digitales', '\0\0\0\0\0\0\0\0\0\0‹øFM¿<Ö$›‘UA¿', 1, 16, 0, 0, '2014-11-15 19:36:48', 1),
(3, 'mac book', 1, 'sdf', 'mac-book', '\0\0\0\0\0\0\0\0\0\0L]HM¿†Ô≠ı‹UA¿', 1, 6, 0, 0, '2014-11-15 19:40:57', 1),
(4, 'matematica 3', 1, 'sdaf', 'matematica-3', '\0\0\0\0\0\0\0\0\0\0ºﬁGM¿æœNÓUA¿', 1, 16, 0, 0, '2014-11-15 19:49:10', 4),
(5, 'clases de frances', 1, 'dadasdasd', 'clases-de-frances', '\0\0\0\0\0\0\0\0\0\0ñıGM¿Ç=HñÚUA¿', 1, 28, 1, 0, '2014-11-15 19:58:49', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_deseado`
--

CREATE TABLE IF NOT EXISTS `producto_deseado` (
`id_producto_deseado` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `es_servicio` int(11) NOT NULL DEFAULT '0',
  `id_producto` int(11) NOT NULL,
  `fechmod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `debaja` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `producto_deseado`
--

INSERT INTO `producto_deseado` (`id_producto_deseado`, `id_categoria`, `es_servicio`, `id_producto`, `fechmod`, `debaja`) VALUES
(1, 6, 0, 1, '2014-11-15 19:34:26', 0),
(2, 6, 0, 2, '2014-11-15 19:36:48', 0),
(3, 5, 0, 3, '2014-11-15 19:40:57', 0),
(4, 16, 0, 4, '2014-11-15 19:49:10', 0),
(5, 16, 0, 5, '2014-11-15 19:58:49', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_etiqueta`
--

CREATE TABLE IF NOT EXISTS `producto_etiqueta` (
`id_prod_etiq` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_etiqueta` int(11) NOT NULL,
  `fechmod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `debaja` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `producto_etiqueta`
--

INSERT INTO `producto_etiqueta` (`id_prod_etiq`, `id_producto`, `id_etiqueta`, `fechmod`, `debaja`) VALUES
(1, 1, 72, '2014-11-15 19:34:26', 0),
(2, 1, 73, '2014-11-15 19:34:26', 0),
(3, 1, 74, '2014-11-15 19:34:26', 0),
(4, 1, 90, '2014-11-15 19:34:26', 0),
(8, 2, 48, '2014-11-15 19:36:48', 0),
(9, 2, 91, '2014-11-15 19:36:48', 0),
(10, 2, 92, '2014-11-15 19:36:48', 0),
(11, 3, 75, '2014-11-15 19:40:57', 0),
(12, 3, 76, '2014-11-15 19:40:57', 0),
(13, 3, 78, '2014-11-15 19:40:57', 0),
(14, 4, 48, '2014-11-15 19:49:10', 0),
(15, 4, 95, '2014-11-15 19:49:10', 0),
(17, 5, 55, '2014-11-15 19:58:49', 0),
(18, 5, 96, '2014-11-15 19:58:49', 0),
(19, 5, 97, '2014-11-15 19:58:49', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propuesta`
--

CREATE TABLE IF NOT EXISTS `propuesta` (
`id_propuesta` int(11) NOT NULL,
  `debaja` int(11) NOT NULL DEFAULT '0',
  `fechmod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_producto_ofrecido` int(11) NOT NULL,
  `id_usuario_propone` int(11) NOT NULL,
  `id_lista_producto_propuesto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `propuesta`
--

INSERT INTO `propuesta` (`id_propuesta`, `debaja`, `fechmod`, `id_producto_ofrecido`, `id_usuario_propone`, `id_lista_producto_propuesto`, `id_categoria`) VALUES
(1, 0, '2014-10-20 17:20:12', 1, 2, 1, 1),
(2, 0, '2014-10-25 16:58:56', 1, 3, 2, 1),
(5, 0, '2014-11-14 21:08:26', 5, 1, 2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
`id_rol` int(11) NOT NULL,
  `tipo_rol` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `tipo_rol`) VALUES
(1, 'usuario'),
(2, 'administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_denuncia`
--

CREATE TABLE IF NOT EXISTS `tipo_denuncia` (
`id_tipo_denuncia` int(11) NOT NULL,
  `nombre_tipo_denuncia` varchar(114) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipo_denuncia`
--

INSERT INTO `tipo_denuncia` (`id_tipo_denuncia`, `nombre_tipo_denuncia`) VALUES
(1, 'tipo1'),
(2, 'tipo2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trueque`
--

CREATE TABLE IF NOT EXISTS `trueque` (
`id_trueque` int(11) NOT NULL,
  `estado_trueque` int(11) NOT NULL DEFAULT '0',
  `fecha_finalizado_trueque` datetime NOT NULL,
  `fecha_acuerdo_trueque` datetime NOT NULL,
  `id_usuario_propone` int(11) NOT NULL,
  `id_usuario_ofrece` int(11) NOT NULL,
  `id_propuesta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`id_usuario` int(11) NOT NULL,
  `url_usuario` varchar(140) NOT NULL,
  `email_usuario` varchar(255) NOT NULL,
  `clave_usuario` varchar(255) NOT NULL,
  `cookie_usuario` varchar(255) DEFAULT NULL,
  `vence_cookie` varchar(255) DEFAULT NULL,
  `fechmod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `debaja` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `url_usuario`, `email_usuario`, `clave_usuario`, `cookie_usuario`, `vence_cookie`, `fechmod`, `debaja`) VALUES
(1, 'marcela', 'marcelapanasia@gmail.com', '0659c7992e268962384eb17fafe88364', NULL, NULL, '2014-10-20 14:23:35', 0),
(2, 'admin', 'admin@admin.com', '0659c7992e268962384eb17fafe88364', NULL, NULL, '2014-10-20 16:49:40', 0),
(3, 'roberto', 'edu@gmail.com', '0659c7992e268962384eb17fafe88364', NULL, NULL, '2014-10-20 17:18:05', 0),
(4, 'rober', 'msn.roberto.ds@gmail.com', '0659c7992e268962384eb17fafe88364', NULL, NULL, '2014-10-26 13:43:36', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_tmp`
--

CREATE TABLE IF NOT EXISTS `usuario_tmp` (
`id_usuario` int(11) NOT NULL,
  `url_usuario` varchar(140) NOT NULL,
  `email_usuario` varchar(255) NOT NULL,
  `clave_usuario` varchar(255) NOT NULL,
  `autorizacion` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- √çndices para tablas volcadas
--

--
-- Indices de la tabla `alerta`
--
ALTER TABLE `alerta`
 ADD PRIMARY KEY (`id_alerta`);

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
 ADD PRIMARY KEY (`id_calificacion`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
 ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `denuncia`
--
ALTER TABLE `denuncia`
 ADD PRIMARY KEY (`id_denuncia`);

--
-- Indices de la tabla `deseado_etiqueta`
--
ALTER TABLE `deseado_etiqueta`
 ADD PRIMARY KEY (`id_deseo_etiq`);

--
-- Indices de la tabla `etiqueta`
--
ALTER TABLE `etiqueta`
 ADD PRIMARY KEY (`id_etiqueta`);

--
-- Indices de la tabla `lista_producto_propuesto`
--
ALTER TABLE `lista_producto_propuesto`
 ADD PRIMARY KEY (`id_lista_producto_propuesto`,`id_producto`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
 ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
 ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `producto_deseado`
--
ALTER TABLE `producto_deseado`
 ADD PRIMARY KEY (`id_producto_deseado`);

--
-- Indices de la tabla `producto_etiqueta`
--
ALTER TABLE `producto_etiqueta`
 ADD PRIMARY KEY (`id_prod_etiq`);

--
-- Indices de la tabla `propuesta`
--
ALTER TABLE `propuesta`
 ADD PRIMARY KEY (`id_propuesta`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
 ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tipo_denuncia`
--
ALTER TABLE `tipo_denuncia`
 ADD PRIMARY KEY (`id_tipo_denuncia`);

--
-- Indices de la tabla `trueque`
--
ALTER TABLE `trueque`
 ADD PRIMARY KEY (`id_trueque`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id_usuario`), ADD UNIQUE KEY `email_usuario` (`email_usuario`), ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario_tmp`
--
ALTER TABLE `usuario_tmp`
 ADD PRIMARY KEY (`id_usuario`), ADD UNIQUE KEY `email_usuario` (`email_usuario`), ADD UNIQUE KEY `id_usuario` (`id_usuario`), ADD UNIQUE KEY `url_usuario` (`url_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alerta`
--
ALTER TABLE `alerta`
MODIFY `id_alerta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
MODIFY `id_calificacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `denuncia`
--
ALTER TABLE `denuncia`
MODIFY `id_denuncia` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `deseado_etiqueta`
--
ALTER TABLE `deseado_etiqueta`
MODIFY `id_deseo_etiq` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `etiqueta`
--
ALTER TABLE `etiqueta`
MODIFY `id_etiqueta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `producto_deseado`
--
ALTER TABLE `producto_deseado`
MODIFY `id_producto_deseado` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `producto_etiqueta`
--
ALTER TABLE `producto_etiqueta`
MODIFY `id_prod_etiq` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `propuesta`
--
ALTER TABLE `propuesta`
MODIFY `id_propuesta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipo_denuncia`
--
ALTER TABLE `tipo_denuncia`
MODIFY `id_tipo_denuncia` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `trueque`
--
ALTER TABLE `trueque`
MODIFY `id_trueque` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuario_tmp`
--
ALTER TABLE `usuario_tmp`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
