
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-12-2014 a las 12:31:52
-- Versión del servidor: 5.1.67
-- Versión de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `u485306295_menta`
--

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`id`, `fromUser`, `toUser`, `message`, `sent`, `recd`) VALUES
(1, 'marcela', 'rober', 'hola roberto', '2014-11-16 22:57:57', 1),
(2, 'marcela', 'marcela', 'yo misma', '2014-11-16 22:58:28', 1),
(3, 'rober', 'marcela', 'hola marce', '2014-11-16 22:59:03', 1),
(4, 'rober', 'marcela', 'como va?', '2014-11-16 22:59:07', 1),
(5, 'marcela', 'rober', 'hola', '2014-11-17 17:52:56', 1),
(6, 'rober', 'marcela', 'como estas?', '2014-11-17 17:53:05', 1),
(7, 'marcela', 'rober', 'bien', '2014-11-17 17:53:10', 1),
(8, 'rober', 'marcela', 'jejej', '2014-11-17 17:53:14', 1),
(9, 'rober', 'marcela', ':D', '2014-11-17 17:53:16', 1),
(10, 'rober', 'marcela', 'Marce!! funciona!', '2014-11-17 17:53:37', 1),
(11, 'rober', 'marcela', ':) si te llega este mensaje decime "Me llego Edu!"', '2014-11-19 13:03:42', 1),
(12, 'rober', 'marcela', 'hola, te llega?', '2014-11-21 11:12:16', 1),
(13, 'marcela', 'rober', 'holaaaa', '2014-11-21 11:12:39', 1),
(14, 'gbarbosa', 'rober', 'prueba', '2014-11-21 11:24:28', 1),
(15, 'gbarbosa', 'marcela', 'prueba', '2014-11-21 11:24:31', 1),
(16, 'rober', 'gbarbosa', 'hola profe', '2014-11-21 11:24:50', 1),
(17, 'marcela', 'gbarbosa', 'hola profe!', '2014-11-21 11:24:50', 1),
(18, 'rober', 'gbarbosa', 'el mail de registro es hotmail puede ser?', '2014-11-21 11:25:09', 1),
(19, 'gbarbosa', 'marcela', 'buenas', '2014-11-21 11:25:18', 1),
(20, 'gbarbosa', 'marcela', 'todo muy bien!', '2014-11-21 11:25:27', 1),
(21, 'gbarbosa', 'rober', 'si si', '2014-11-21 11:25:27', 1),
(22, 'gbarbosa', 'rober', 'me confundi', '2014-11-21 11:25:30', 1),
(23, 'marcela', 'gbarbosa', 'que bueno', '2014-11-21 11:25:38', 1),
(24, 'rober', 'gbarbosa', 'ok, marcela tambien esta online', '2014-11-21 11:25:44', 1),
(25, 'gbarbosa', 'rober', 'abri 2 chats', '2014-11-21 11:25:48', 1),
(26, 'marcela', 'gbarbosa', 'llueve no? je', '2014-11-21 11:25:48', 1),
(27, 'gbarbosa', 'rober', 'y me duplico un mensaje', '2014-11-21 11:25:55', 1),
(28, 'gbarbosa', 'marcela', 'un poco :)', '2014-11-21 11:26:05', 1),
(29, 'marcela', 'gbarbosa', ':)', '2014-11-21 11:26:11', 1),
(30, 'rober', 'gbarbosa', 'puede ser una captura?', '2014-11-21 11:26:22', 1),
(31, 'gbarbosa', 'rober', 'te puse a vos "si si" y le salió a Marcela', '2014-11-21 11:26:27', 1),
(32, 'gbarbosa', 'marcela', 'ahi salió duplicado un mensaje', '2014-11-21 11:26:42', 1),
(33, 'gbarbosa', 'marcela', 'el "si si" se lo puse a Roberto', '2014-11-21 11:26:50', 1),
(34, 'rober', 'marcela', 'te anda bien a vos?', '2014-11-21 11:26:53', 1),
(35, 'gbarbosa', 'marcela', 'y te salió a vos..', '2014-11-21 11:26:53', 1),
(36, 'gbarbosa', 'rober', 'dale', '2014-11-21 11:26:57', 1),
(37, 'rober', 'marcela', 'marce estas?', '2014-11-21 11:27:37', 1),
(38, 'marcela', 'rober', 'si', '2014-11-21 11:27:42', 1),
(39, 'rober', 'marcela', 'ok', '2014-11-21 11:28:12', 1),
(40, 'marcela', 'gbarbosa', 'ah si, salio un mensaje de roberto', '2014-11-21 11:28:25', 1),
(41, 'marcela', 'rober', 'salio un mensaje tuyo en el chat  con el profe', '2014-11-21 11:28:51', 1),
(42, 'rober', 'marcela', 'ok.. hay un error al parecer', '2014-11-21 11:29:08', 1),
(43, 'gbarbosa', 'marcela', 'ahi les envie la captura', '2014-11-21 11:29:27', 1),
(44, 'marcela', 'gbarbosa', 'bueno, prueba fallida', '2014-11-21 11:29:29', 1),
(45, 'gbarbosa', 'marcela', 'no no', '2014-11-21 11:29:35', 1),
(46, 'gbarbosa', 'marcela', 'sirve la prueba!!!', '2014-11-21 11:29:40', 1),
(47, 'gbarbosa', 'rober', 'ahi les envie la captura', '2014-11-21 11:29:43', 1),
(48, 'marcela', 'gbarbosa', 'jeje', '2014-11-21 11:29:43', 1),
(49, 'rober', 'marcela', 'marce, hace una captura', '2014-11-21 11:29:43', 1),
(50, 'marcela', 'rober', 'ya envio una captura', '2014-11-21 11:29:56', 1),
(51, 'gbarbosa', 'marcela', 'habria que ver que pasa', '2014-11-21 11:30:00', 1),
(52, 'rober', 'gbarbosa', 'ok, gracias.. vamos a revisarlo', '2014-11-21 11:30:02', 1),
(53, 'rober', 'marcela', 'gracias', '2014-11-21 11:30:09', 1),
(54, 'gbarbosa', 'marcela', '}', '2014-11-21 11:30:11', 1),
(55, 'marcela', 'gbarbosa', 'si, nos vamos a fijar', '2014-11-21 11:30:11', 1),
(56, 'gbarbosa', 'rober', 'perfecto', '2014-11-21 11:30:17', 1),
(57, 'rober', 'marcela', 'asi tenemos capturas y es mas facil encontrarlo', '2014-11-21 11:30:20', 1),
(58, 'gbarbosa', 'rober', 'igual parece que funciona bastante bien', '2014-11-21 11:30:25', 1),
(59, 'rober', 'gbarbosa', 'si, con mas de una ventana parece haber una pifia', '2014-11-21 11:30:41', 1),
(60, 'marcela', 'gbarbosa', 'gracias por la captura', '2014-11-21 11:30:50', 1),
(61, 'gbarbosa', 'marcela', 'ok, volvemos a probar en otro momento', '2014-11-21 11:30:56', 1),
(62, 'gbarbosa', 'rober', 'sip', '2014-11-21 11:31:01', 1),
(63, 'marcela', 'gbarbosa', 'listo', '2014-11-21 11:31:05', 1),
(64, 'gbarbosa', 'rober', 'igual me paso solo 1 vez', '2014-11-21 11:31:07', 1),
(65, 'gbarbosa', 'rober', 'volvemos a probar otro dia', '2014-11-21 11:31:13', 1),
(66, 'gbarbosa', 'rober', 'me avisan y listo', '2014-11-21 11:31:16', 1),
(67, 'rober', 'gbarbosa', 'lo vamos a revisar', '2014-11-21 11:31:18', 1),
(68, 'gbarbosa', 'rober', 'no hay problema', '2014-11-21 11:31:21', 1),
(69, 'gbarbosa', 'marcela', 'buen finde!!!', '2014-11-21 11:31:27', 1),
(70, 'rober', 'gbarbosa', 'recibida la captura', '2014-11-21 11:31:45', 1),
(71, 'gbarbosa', 'rober', 'joya', '2014-11-21 11:31:55', 1),
(72, 'gbarbosa', 'rober', 'bueno.. chauuuu', '2014-11-21 11:31:58', 1),
(73, 'rober', 'gbarbosa', 'adios', '2014-11-21 11:32:03', 1),
(74, 'rober', 'gbarbosa', 'y gracias', '2014-11-21 11:32:05', 1),
(75, 'rober', 'marcela', 'listo marce', '2014-11-21 11:32:26', 1),
(76, 'rober', 'marcela', 'hola', '2014-11-21 12:54:34', 1),
(77, 'marcela', 'rober', 'holaaa', '2014-11-21 20:17:05', 1),
(78, 'rober', 'marcela', 'holllllllaaaa', '2014-11-21 20:17:48', 1),
(79, 'rober', 'rober', 'hola', '2014-11-21 20:18:15', 1),
(80, 'rober', 'marcela', ':)', '2014-11-21 20:18:27', 1),
(81, 'marcela', 'rober', 'mensaje', '2014-11-21 20:19:07', 1),
(82, 'rober', 'marcela', '....', '2014-11-21 20:20:05', 1),
(83, 'marcela', 'rober', ':)', '2014-11-21 20:20:44', 1),
(84, 'marcela', 'rober', '10.20', '2014-11-21 20:20:59', 1);

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `nombre_perfil`, `avatar_perfil`, `prestigio_perfil`, `id_usuario`, `id_rol`, `fechmod`, `debaja`) VALUES
(1, 'Marcela', NULL, 3, 1, 1, '2014-10-20 14:23:35', 0),
(2, 'administrador', '', 0, 2, 2, '2014-10-20 16:50:37', 0),
(3, 'edu', NULL, 0, 3, 1, '2014-10-21 02:39:08', 0),
(4, 'Rober', NULL, 0, 4, 1, '2014-10-26 13:43:36', 0),
(5, 'Gbarbosa', NULL, 0, 5, 1, '2014-11-21 16:20:33', 0),
(6, 'Jemc', NULL, 0, 6, 1, '2014-11-25 17:06:30', 0);

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `url_usuario`, `email_usuario`, `clave_usuario`, `cookie_usuario`, `vence_cookie`, `fechmod`, `debaja`) VALUES
(1, 'marcela', 'marcelapanasia@gmail.com', '0659c7992e268962384eb17fafe88364', NULL, NULL, '2014-10-20 14:23:35', 0),
(2, 'admin', 'admin@admin.com', '0659c7992e268962384eb17fafe88364', NULL, NULL, '2014-10-20 16:49:40', 0),
(3, 'roberto', 'edu@gmail.com', '0659c7992e268962384eb17fafe88364', NULL, NULL, '2014-10-20 17:18:05', 0),
(4, 'rober', 'msn.roberto.ds@gmail.com', '0659c7992e268962384eb17fafe88364', NULL, NULL, '2014-10-26 13:43:36', 0),
(5, 'gbarbosa', 'barbosa_g@hotmail.com', '0659c7992e268962384eb17fafe88364', NULL, NULL, '2014-11-21 16:20:33', 0),
(6, 'jemc', 'jon.corrales77@gmail.com', '8dd77b9e4af688215a9092d12f386a49', NULL, NULL, '2014-11-25 17:06:30', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
