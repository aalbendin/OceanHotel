-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-04-2017 a las 17:23:34
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `oceanhotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cognoms` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dataNaixament` date DEFAULT NULL,
  `nif` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comanda`
--

CREATE TABLE `comanda` (
  `id` int(11) NOT NULL,
  `dataEntrada` date DEFAULT NULL,
  `dataSortida` date DEFAULT NULL,
  `clientId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estat`
--

CREATE TABLE `estat` (
  `id` int(11) NOT NULL,
  `descripcio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fos_group`
--

CREATE TABLE `fos_group` (
  `id` int(11) NOT NULL,
  `name` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'cristian', 'cristian', 'csosac@gmail.com', 'csosac@gmail.com', 1, NULL, '$2y$13$s/EjvX/Wxv1/xnMvwWP0nuS9WY/iqs6TkAww1MZgECiKxSxQUX8tS', '2017-04-27 16:42:05', NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}'),
(2, 'yaritza', 'yaritza', 'csosac@gmaiil.com', 'csosac@gmaiil.com', 1, NULL, '$2y$13$s/EjvX/Wxv1/xnMvwWP0nuS9WY/iqs6TkAww1MZgECiKxSxQUX8tS', '2017-04-26 16:57:54', NULL, NULL, 'a:2:{i:0;s:10:"ROLE_ADMIN";i:1;s:16:"ROLE_TREBALLADOR";}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fos_user_user_group`
--

CREATE TABLE `fos_user_user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacio`
--

CREATE TABLE `habitacio` (
  `id` int(11) NOT NULL,
  `numHabitacio` int(11) DEFAULT NULL,
  `places` int(11) DEFAULT NULL,
  `preu` decimal(10,2) DEFAULT NULL,
  `tipusHabitacioId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalitat`
--

CREATE TABLE `modalitat` (
  `id` int(11) NOT NULL,
  `descripcio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `preu` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `comandaId` int(11) DEFAULT NULL,
  `habitacioId` int(11) DEFAULT NULL,
  `modalitatId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasca`
--

CREATE TABLE `tasca` (
  `id` int(11) NOT NULL,
  `descripcio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dataAlta` date DEFAULT NULL,
  `tipusTascaId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipus_habitacio`
--

CREATE TABLE `tipus_habitacio` (
  `id` int(11) NOT NULL,
  `imatge` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipus_tasca`
--

CREATE TABLE `tipus_tasca` (
  `id` int(11) NOT NULL,
  `descripcio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipusTreballadorId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipus_treballador`
--

CREATE TABLE `tipus_treballador` (
  `id` int(11) NOT NULL,
  `descripcio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipus_treballador`
--

INSERT INTO `tipus_treballador` (`id`, `descripcio`) VALUES
(1, 'servei de neteja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `treball`
--

CREATE TABLE `treball` (
  `id` int(11) NOT NULL,
  `dataInici` date DEFAULT NULL,
  `dataFi` date DEFAULT NULL,
  `tascaId` int(11) DEFAULT NULL,
  `treballadorId` int(11) DEFAULT NULL,
  `estatId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `treballador`
--

CREATE TABLE `treballador` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cognoms` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dataNaiximent` date DEFAULT NULL,
  `nif` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usuariId` int(11) DEFAULT NULL,
  `tipusTreballadorId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `treballador`
--

INSERT INTO `treballador` (`id`, `nom`, `cognoms`, `dataNaiximent`, `nif`, `usuariId`, `tipusTreballadorId`) VALUES
(3, 'ab', 'ab', '2017-01-19', '64578976J', 1, 1),
(4, 'df', 'fwe', '2017-01-18', 'wefw', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C744045564B64DCC` (`userId`);

--
-- Indices de la tabla `comanda`
--
ALTER TABLE `comanda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_45C50E54EA1CE9BE` (`clientId`);

--
-- Indices de la tabla `estat`
--
ALTER TABLE `estat`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fos_group`
--
ALTER TABLE `fos_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_4B019DDB5E237E06` (`name`);

--
-- Indices de la tabla `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`);

--
-- Indices de la tabla `fos_user_user_group`
--
ALTER TABLE `fos_user_user_group`
  ADD PRIMARY KEY (`user_id`,`group_id`),
  ADD KEY `IDX_B3C77447A76ED395` (`user_id`),
  ADD KEY `IDX_B3C77447FE54D947` (`group_id`);

--
-- Indices de la tabla `habitacio`
--
ALTER TABLE `habitacio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_824A9B5E49830C04` (`tipusHabitacioId`);

--
-- Indices de la tabla `modalitat`
--
ALTER TABLE `modalitat`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_188D2E3B13D2B360` (`comandaId`),
  ADD KEY `IDX_188D2E3B6958FBAE` (`habitacioId`),
  ADD KEY `IDX_188D2E3B195C7A48` (`modalitatId`);

--
-- Indices de la tabla `tasca`
--
ALTER TABLE `tasca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6B389ED7B800629B` (`tipusTascaId`);

--
-- Indices de la tabla `tipus_habitacio`
--
ALTER TABLE `tipus_habitacio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipus_tasca`
--
ALTER TABLE `tipus_tasca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_91DFFA584EECB35D` (`tipusTreballadorId`);

--
-- Indices de la tabla `tipus_treballador`
--
ALTER TABLE `tipus_treballador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `treball`
--
ALTER TABLE `treball`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C705E8F6F373C551` (`tascaId`),
  ADD KEY `IDX_C705E8F639DDA05A` (`treballadorId`),
  ADD KEY `IDX_C705E8F67E0084BB` (`estatId`);

--
-- Indices de la tabla `treballador`
--
ALTER TABLE `treballador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CDE520CB4EFB8111` (`usuariId`),
  ADD KEY `IDX_CDE520CB4EECB35D` (`tipusTreballadorId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `comanda`
--
ALTER TABLE `comanda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estat`
--
ALTER TABLE `estat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `fos_group`
--
ALTER TABLE `fos_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `habitacio`
--
ALTER TABLE `habitacio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `modalitat`
--
ALTER TABLE `modalitat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tasca`
--
ALTER TABLE `tasca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipus_habitacio`
--
ALTER TABLE `tipus_habitacio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipus_tasca`
--
ALTER TABLE `tipus_tasca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipus_treballador`
--
ALTER TABLE `tipus_treballador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `treball`
--
ALTER TABLE `treball`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `treballador`
--
ALTER TABLE `treballador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `FK_C744045564B64DCC` FOREIGN KEY (`userId`) REFERENCES `fos_user` (`id`);

--
-- Filtros para la tabla `comanda`
--
ALTER TABLE `comanda`
  ADD CONSTRAINT `FK_45C50E54EA1CE9BE` FOREIGN KEY (`clientId`) REFERENCES `client` (`id`);

--
-- Filtros para la tabla `fos_user_user_group`
--
ALTER TABLE `fos_user_user_group`
  ADD CONSTRAINT `FK_B3C77447A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_B3C77447FE54D947` FOREIGN KEY (`group_id`) REFERENCES `fos_group` (`id`);

--
-- Filtros para la tabla `habitacio`
--
ALTER TABLE `habitacio`
  ADD CONSTRAINT `FK_824A9B5E49830C04` FOREIGN KEY (`tipusHabitacioId`) REFERENCES `tipus_habitacio` (`id`);

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `FK_188D2E3B13D2B360` FOREIGN KEY (`comandaId`) REFERENCES `comanda` (`id`),
  ADD CONSTRAINT `FK_188D2E3B195C7A48` FOREIGN KEY (`modalitatId`) REFERENCES `modalitat` (`id`),
  ADD CONSTRAINT `FK_188D2E3B6958FBAE` FOREIGN KEY (`habitacioId`) REFERENCES `habitacio` (`id`);

--
-- Filtros para la tabla `tasca`
--
ALTER TABLE `tasca`
  ADD CONSTRAINT `FK_6B389ED7B800629B` FOREIGN KEY (`tipusTascaId`) REFERENCES `tipus_tasca` (`id`);

--
-- Filtros para la tabla `tipus_tasca`
--
ALTER TABLE `tipus_tasca`
  ADD CONSTRAINT `FK_91DFFA584EECB35D` FOREIGN KEY (`tipusTreballadorId`) REFERENCES `tipus_treballador` (`id`);

--
-- Filtros para la tabla `treball`
--
ALTER TABLE `treball`
  ADD CONSTRAINT `FK_C705E8F639DDA05A` FOREIGN KEY (`treballadorId`) REFERENCES `treballador` (`id`),
  ADD CONSTRAINT `FK_C705E8F67E0084BB` FOREIGN KEY (`estatId`) REFERENCES `estat` (`id`),
  ADD CONSTRAINT `FK_C705E8F6F373C551` FOREIGN KEY (`tascaId`) REFERENCES `tasca` (`id`);

--
-- Filtros para la tabla `treballador`
--
ALTER TABLE `treballador`
  ADD CONSTRAINT `FK_CDE520CB4EECB35D` FOREIGN KEY (`tipusTreballadorId`) REFERENCES `tipus_treballador` (`id`),
  ADD CONSTRAINT `FK_CDE520CB4EFB8111` FOREIGN KEY (`usuariId`) REFERENCES `fos_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
