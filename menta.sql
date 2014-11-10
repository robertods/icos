-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generaci√≥n: 10-11-2014 a las 03:25:56
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `alerta`
--

INSERT INTO `alerta` (`id_alerta`, `mensaje_alerta`, `id_producto`, `id_usuario`, `visto`, `debaja`) VALUES
(1, 'Han publicado un RELOJ que puede interesarte!', 1, 4, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `descripcion_categoria`, `tipo`, `debaja`, `fechmod`) VALUES
(1, 'informatica', 0, 0, '2014-10-26 20:18:36'),
(2, 'Instrumentos', 0, 0, '2014-10-26 20:19:13'),
(3, 'Audio y Video', 0, 0, '2014-10-26 20:19:13'),
(4, 'Muebles', 0, 0, '2014-10-26 20:19:28'),
(5, 'Otros', 0, 0, '2014-10-26 20:19:28'),
(6, 'Plomero', 1, 0, '2014-10-26 20:19:55'),
(7, 'Gasista', 1, 0, '2014-10-26 20:19:55'),
(8, 'Electricista', 1, 0, '2014-10-26 20:20:16'),
(9, 'Pintor', 1, 0, '2014-10-26 20:20:16'),
(10, 'Otros', 1, 0, '2014-10-26 20:20:25');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Estructura de tabla para la tabla `etiqueta`
--

CREATE TABLE IF NOT EXISTS `etiqueta` (
`id_etiqueta` int(11) NOT NULL,
  `descripcion_etiqueta` varchar(255) NOT NULL,
  `debaja` int(11) NOT NULL DEFAULT '0',
  `fechmod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

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
(20, 'dc', 0, '2014-11-10 02:13:25');

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
(1, 'Marcela', NULL, 3, 1, 2, '2014-10-20 14:23:35', 0),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `titulo_producto`, `foto_principal`, `descripcion_producto`, `url_producto`, `ubicacion_producto`, `disponible_producto`, `id_categoria`, `es_servicio`, `debaja`, `fechmod`, `id_usuario`) VALUES
(1, 'heladera nueva', 1, 'heladera nueva de fabrica', 'heladera', NULL, 1, NULL, 0, 0, '2014-10-12 19:07:38', 1),
(2, 'cocina', 2, 'mochila roja', 'test1', NULL, 1, NULL, 0, 1, '2014-10-12 19:07:38', 4),
(3, 'microondas', 1, 'd3', 'test3', NULL, 1, NULL, 0, 1, '2014-10-12 19:09:13', 4),
(4, 'celular motorola', NULL, 'celular con android..3', 'celular', NULL, 1, NULL, 0, 0, '2014-10-14 23:02:48', 3),
(5, 'prueba nro 1', 3, 'es el primer producto desde la web', 'prueba-nro-uno', NULL, 1, 2, 0, 0, '2014-11-10 00:29:27', 4),
(7, 'test2', 2, 'bla bla blaa 2', 'test-2', '\0\0\0\0\0\0\0\0\0\0@2M¿óñ!YMA¿', 1, 3, 0, 0, '2014-11-10 00:33:27', 4),
(10, 'test2', 2, 'bla bla blaa 2', 'test-2', '\0\0\0\0\0\0\0\0\0\0@2M¿óñ!YMA¿', 1, 3, 0, 0, '2014-11-10 00:41:12', 4),
(11, 'trees3', 1, 'dgdgdf gdgd et t trtertet', 'trees-3', '\0\0\0\0\0\0\0\0\0\0T÷0M¿b“ÎóFMA¿', 1, 6, 1, 0, '2014-11-10 02:04:45', 4),
(12, 'prueba completa', 1, 'corregido errores', 'prueba-completa', '\0\0\0\0\0\0\0\0\0\0Ïß0M¿‚ÀÂô0MA¿', 1, 4, 0, 0, '2014-11-10 02:13:25', 4),
(13, 'prueba completa', 1, 'corregido errores', 'prueba-completa', '\0\0\0\0\0\0\0\0\0\0Ïß0M¿‚ÀÂô0MA¿', 1, 4, 0, 0, '2014-11-10 02:14:28', 4),
(14, 'prueba completa', 1, 'corregido errores', 'prueba-completa', '\0\0\0\0\0\0\0\0\0\0Ïß0M¿‚ÀÂô0MA¿', 1, 4, 0, 0, '2014-11-10 02:17:23', 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `producto_etiqueta`
--

INSERT INTO `producto_etiqueta` (`id_prod_etiq`, `id_producto`, `id_etiqueta`, `fechmod`, `debaja`) VALUES
(1, 1, 2, '2014-10-13 04:33:34', 0),
(2, 1, 3, '2014-10-13 04:33:34', 0),
(3, 2, 2, '2014-10-13 04:33:46', 0),
(4, 3, 1, '2014-10-13 04:33:46', 0),
(5, 7, 9, '2014-11-10 00:33:27', 0),
(7, 10, 9, '2014-11-10 00:41:12', 0),
(8, 11, 9, '2014-11-10 02:04:45', 0),
(9, 12, 2, '2014-11-10 02:13:25', 0),
(10, 13, 2, '2014-11-10 02:14:28', 0),
(11, 14, 2, '2014-11-10 02:17:23', 0),
(12, 14, 9, '2014-11-10 02:17:23', 0),
(13, 14, 13, '2014-11-10 02:17:23', 0),
(14, 14, 18, '2014-11-10 02:17:23', 0),
(15, 14, 19, '2014-11-10 02:17:23', 0),
(16, 14, 20, '2014-11-10 02:17:23', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `propuesta`
--

INSERT INTO `propuesta` (`id_propuesta`, `debaja`, `fechmod`, `id_producto_ofrecido`, `id_usuario_propone`, `id_lista_producto_propuesto`, `id_categoria`) VALUES
(1, 0, '2014-10-20 17:20:12', 1, 2, 1, 1),
(2, 1, '2014-10-25 16:58:56', 1, 3, 2, 1);

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
(1, 'marcela', 'marcelapanasia@gmail.com', 'ef73781effc5774100f87fe2f437a435', NULL, NULL, '2014-10-20 14:23:35', 0),
(2, 'admin', 'admin@admin.com', '0659c7992e268962384eb17fafe88364', NULL, NULL, '2014-10-20 16:49:40', 0),
(3, 'roberto', 'edu@gmail.com', 'ef73781effc5774100f87fe2f437a435', NULL, NULL, '2014-10-20 17:18:05', 0),
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
MODIFY `id_alerta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
MODIFY `id_calificacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `denuncia`
--
ALTER TABLE `denuncia`
MODIFY `id_denuncia` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `etiqueta`
--
ALTER TABLE `etiqueta`
MODIFY `id_etiqueta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `producto_etiqueta`
--
ALTER TABLE `producto_etiqueta`
MODIFY `id_prod_etiq` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `propuesta`
--
ALTER TABLE `propuesta`
MODIFY `id_propuesta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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
