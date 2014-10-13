-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2014 a las 08:59:47
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

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
  `mensaje_alerta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `debaja` int(11) NOT NULL DEFAULT '0',
  `fechmod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denuncia`
--

CREATE TABLE IF NOT EXISTS `denuncia` (
`id_denuncia` int(11) NOT NULL,
  `detalle_denuncia` varchar(255) NOT NULL,
  `tipo_denuncia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta`
--

CREATE TABLE IF NOT EXISTS `etiqueta` (
`id_etiqueta` int(11) NOT NULL,
  `descripcion_etiqueta` varchar(255) NOT NULL,
  `debaja` int(11) NOT NULL DEFAULT '0',
  `fechmod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `etiqueta`
--

INSERT INTO `etiqueta` (`id_etiqueta`, `descripcion_etiqueta`, `debaja`, `fechmod`) VALUES
(1, 'etiq1', 0, '2014-10-13 04:32:44'),
(2, 'etiq2', 0, '2014-10-13 04:32:58'),
(3, 'etiq3', 0, '2014-10-13 04:32:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE IF NOT EXISTS `mensaje` (
`id_mensaje` int(11) NOT NULL,
  `detalle_mensaje` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `nombre_perfil`, `avatar_perfil`, `prestigio_perfil`, `id_usuario`, `id_rol`, `fechmod`, `debaja`) VALUES
(2, 'Edu', '', 0, 6, 1, '2014-10-12 05:22:18', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
`id_producto` int(11) NOT NULL,
  `titulo_producto` varchar(140) DEFAULT NULL,
  `fotos_producto` varchar(255) DEFAULT NULL,
  `descripcion_producto` varchar(255) DEFAULT NULL,
  `url_producto` varchar(255) NOT NULL,
  `ubicacion_producto` point DEFAULT NULL,
  `disponible` int(11) DEFAULT NULL,
  `tipo_producto` varchar(255) NOT NULL,
  `debaja` int(11) NOT NULL DEFAULT '0',
  `fechmod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `titulo_producto`, `fotos_producto`, `descripcion_producto`, `url_producto`, `ubicacion_producto`, `disponible`, `tipo_producto`, `debaja`, `fechmod`) VALUES
(1, 'test1', 'test1', 'd1', 'test1', NULL, NULL, '', 0, '2014-10-12 19:07:38'),
(2, 'test2', 'test2', 'd2', 'test2', NULL, NULL, '', 0, '2014-10-12 19:07:38'),
(3, 'test3', 'test3', 'd3', 'test3', NULL, NULL, '', 0, '2014-10-12 19:09:13');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `producto_etiqueta`
--

INSERT INTO `producto_etiqueta` (`id_prod_etiq`, `id_producto`, `id_etiqueta`, `fechmod`, `debaja`) VALUES
(1, 1, 2, '2014-10-13 04:33:34', 0),
(2, 1, 3, '2014-10-13 04:33:34', 0),
(3, 2, 2, '2014-10-13 04:33:46', 0),
(4, 3, 1, '2014-10-13 04:33:46', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propuesta`
--

CREATE TABLE IF NOT EXISTS `propuesta` (
`id_propuesta` int(11) NOT NULL,
  `debaja` int(11) NOT NULL DEFAULT '0',
  `fechmod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `nombre_tipo_denuncia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trueque`
--

CREATE TABLE IF NOT EXISTS `trueque` (
`id_trueque` int(11) NOT NULL,
  `estado_trueque` varchar(255) NOT NULL,
  `fecha_finalizado_trueque` datetime NOT NULL,
  `fecha_acuerdo_trueque` datetime NOT NULL
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `url_usuario`, `email_usuario`, `clave_usuario`, `cookie_usuario`, `vence_cookie`, `fechmod`, `debaja`) VALUES
(2, 'asd', 'asd@asd', 'asd', NULL, NULL, '2014-10-06 02:50:53', 0),
(4, 'eduardo', 'rdsrds@yahoo.com.ar', '0659c7992e268962384eb17fafe88364', '', '2013-10-12 01:59:09', '2014-10-11 20:23:49', 0),
(6, 'roberto', 'msn.roberto.ds@gmail.com', '0659c7992e268962384eb17fafe88364', NULL, NULL, '2014-10-12 05:22:18', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuario_tmp`
--

INSERT INTO `usuario_tmp` (`id_usuario`, `url_usuario`, `email_usuario`, `clave_usuario`, `autorizacion`, `fecha_registro`) VALUES
(1, 'marcela', 'marcelapanasia@gmail.com', 'ef73781effc5774100f87fe2f437a435', 'f7fbc93e447ed6d37bb73c2f19bea9471e546710', '2014-10-11 15:37:40');

--
-- Índices para tablas volcadas
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
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
 ADD PRIMARY KEY (`id_mensaje`);

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
MODIFY `id_alerta` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
MODIFY `id_calificacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `denuncia`
--
ALTER TABLE `denuncia`
MODIFY `id_denuncia` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `etiqueta`
--
ALTER TABLE `etiqueta`
MODIFY `id_etiqueta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `producto_etiqueta`
--
ALTER TABLE `producto_etiqueta`
MODIFY `id_prod_etiq` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `propuesta`
--
ALTER TABLE `propuesta`
MODIFY `id_propuesta` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipo_denuncia`
--
ALTER TABLE `tipo_denuncia`
MODIFY `id_tipo_denuncia` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `trueque`
--
ALTER TABLE `trueque`
MODIFY `id_trueque` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `usuario_tmp`
--
ALTER TABLE `usuario_tmp`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
