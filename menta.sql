-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2014 a las 18:27:56
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
  `mensaje_alerta` varchar(255) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `visto` int(11) NOT NULL DEFAULT '0',
  `debaja` int(11) NOT NULL DEFAULT '0'
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_producto_propuesto`
--

CREATE TABLE IF NOT EXISTS `lista_producto_propuesto` (
  `id_propuesta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
`id_producto` int(11) NOT NULL,
  `titulo_producto` varchar(140) DEFAULT NULL,
  `foto_principal` int(11) DEFAULT NULL,
  `descripcion_producto` varchar(200) DEFAULT NULL,
  `url_producto` varchar(255) NOT NULL,
  `ubicacion_producto` point DEFAULT NULL,
  `disponible_producto` int(11) DEFAULT '1',
  `id_categoria` int(11) DEFAULT NULL,
  `es_servicio` int(255) NOT NULL DEFAULT '0',
  `debaja` int(11) NOT NULL DEFAULT '0',
  `fechmod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propuesta`
--

CREATE TABLE IF NOT EXISTS `propuesta` (
`id_propuesta` int(11) NOT NULL,
  `id_producto_ofrecido` int(11) NOT NULL,
  `id_usuario_propone` int(11) NOT NULL,
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
  `nombre_tipo_denuncia` varchar(114) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tipo_denuncia`
--

INSERT INTO `tipo_denuncia` (`id_tipo_denuncia`, `nombre_tipo_denuncia`) VALUES
(1, 'Sospechoso'),
(2, 'Estafa'),
(3, 'Datos Falsos'),
(4, 'Peligroso');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
 ADD PRIMARY KEY (`id_propuesta`,`id_producto`);

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
MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `denuncia`
--
ALTER TABLE `denuncia`
MODIFY `id_denuncia` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `deseado_etiqueta`
--
ALTER TABLE `deseado_etiqueta`
MODIFY `id_deseo_etiq` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `etiqueta`
--
ALTER TABLE `etiqueta`
MODIFY `id_etiqueta` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `producto_deseado`
--
ALTER TABLE `producto_deseado`
MODIFY `id_producto_deseado` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `producto_etiqueta`
--
ALTER TABLE `producto_etiqueta`
MODIFY `id_prod_etiq` int(11) NOT NULL AUTO_INCREMENT;
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
MODIFY `id_tipo_denuncia` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `trueque`
--
ALTER TABLE `trueque`
MODIFY `id_trueque` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario_tmp`
--
ALTER TABLE `usuario_tmp`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
