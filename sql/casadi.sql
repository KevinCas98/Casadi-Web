-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2022 a las 16:09:31
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `casadi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `benefits`
--

CREATE TABLE `benefits` (
  `id` int(11) NOT NULL,
  `id_store` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `type_of_benefit` varchar(255) NOT NULL,
  `pin` int(8) NOT NULL,
  `conditions` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `benefits`
--

INSERT INTO `benefits` (`id`, `id_store`, `name`, `created_at`, `updated_at`, `updated_by`, `created_by`, `type_of_benefit`, `pin`, `conditions`) VALUES
(4, 5, '20% off', '2022-02-23 14:39:02', '2022-04-18 17:42:11', 3, 3, '', 6102, '20% off'),
(5, 6, '50% off', '2022-02-23 16:14:00', '2022-04-18 16:16:55', 3, 3, '', 3685, '50% off');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Gastronómico'),
(2, 'Moda'),
(3, 'Belleza'),
(4, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `collaborators`
--

CREATE TABLE `collaborators` (
  `id` int(11) NOT NULL,
  `id_institution` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `dni` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `collaborators`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `id_store` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cell_phone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `contacts`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dose`
--

CREATE TABLE `dose` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_vaccines` int(11) NOT NULL,
  `date_checked_dose` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dose`
--

INSERT INTO `dose` (`id`, `id_users`, `id_vaccines`, `date_checked_dose`) VALUES
(1, 4, 8, '2022-04-01 00:00:00'),
(2, 4, 7, '2022-04-02 00:00:00'),
(3, 4, 5, '2022-04-03 00:00:00'),
(4, 4, 6, '2022-04-04 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `checked` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `files`
--

INSERT INTO `files` (`id`, `id_user`, `name`, `path`, `checked`) VALUES
(1, 3, 'icono.png', 'icono.png', 0),
(2, 3, 'logo_rect.jpg', 'logo_rect.jpg', 0),
(3, 3, 'icono.png', 'icono.png', 0),
(4, 3, 'logo_rect.jpg', 'logo_rect.jpg', 0),
(5, 3, 'icono.png', 'icono.png', 1),
(6, 3, 'logo_rect.jpg', 'logo_rect.jpg', 1),
(7, 4, 'icono.png', 'icono.png', 1),
(8, 4, 'logo_rect.jpg', 'logo_rect.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institution`
--

CREATE TABLE `institution` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `institution`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `image`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(7, 'El gigantesco impacto que explica el misterio de la diferencia entre las dos caras de la Luna.', 'Dos rostros muy distintos \"Las mayores diferencias entre la cara visible y la cara oculta de la Luna tienen que ver con la apariencia y la composición química de estas regiones lunares\", le explicó a BBC Mundo José María Madiedo astrofísico del Instituto de Astrofísica de Andalucía (IAA-CSIC), experto en los impactos de asteroides en la Luna. Madiedo no participó en el nuevo estudio.', '14509591518629.jpg', '2022-04-13 16:09:16', 3, '2022-04-18 17:57:11', 3),
(8, 'La fascinante red de autopistas celestiales que descubrió un equipo de científicos', 'Si has sentido el placer de conducir velozmente por una carretera despejada, ahora imagina hacerlo surcando una vía expresa a través del espacio. En un reciente estudio, un grupo de astrónomos dice haber descubierto una red de “autopistas celestiales” que permitiría enviar naves a sitios remotos del sistema solar a una velocidad sin precedentes.', 'descarga.jpg', '2022-04-13 16:11:57', 3, '2022-04-19 14:50:25', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `record_benefits`
--

CREATE TABLE `record_benefits` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_benefits` int(11) NOT NULL,
  `date_record` datetime NOT NULL,
  `id_stores` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `record_benefits`
--

INSERT INTO `record_benefits` (`id`, `id_user`, `id_benefits`, `date_record`, `id_stores`) VALUES
(1, 3, 4, '2022-03-09 16:19:54', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `cuit` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `cell_phone` varchar(50) NOT NULL,
  `web` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `whatsapp` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `stores`
--

INSERT INTO `stores` (`id`, `id_category`, `created_at`, `updated_at`, `created_by`, `updated_by`, `name`, `cuit`, `address`, `image1`, `image2`, `cell_phone`, `web`, `instagram`, `whatsapp`, `phone`) VALUES
(5, 1, '2022-02-23 14:39:02', '2022-04-18 17:42:11', 3, 3, 'Mostaza', '27-32380453-4', 'Calle falsa S/N', 'logo_mostaza.png', 'mostaza_rec.jpg', '', '', '', '', ''),
(6, 1, '2022-02-23 16:14:00', '2022-04-18 16:16:55', 3, 3, 'Betos', '27-32380453-4', 'Calle falsa S/N', 'logo_betos.jpg', 'logo_rect.jpg', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_collaborator` int(11) DEFAULT NULL,
  `dni` varchar(255) NOT NULL,
  `date_checked` datetime DEFAULT NULL,
  `checked` tinyint(1) DEFAULT NULL,
  `checked_by` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `date_of_birth` varchar(30) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `user_name` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `type_of_card` varchar(255) DEFAULT NULL,
  `dose_quantity` int(255) DEFAULT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `device_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vaccines`
--

CREATE TABLE `vaccines` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vaccines`
--

INSERT INTO `vaccines` (`id`, `name`) VALUES
(1, 'Vacuna BioNTech, Pfizer'),
(2, 'Vacuna CanSino'),
(3, 'Vacuna Johnson & Johnson'),
(4, 'Vacuna Moderna'),
(5, 'Vacuna Oxford, AstraZeneca'),
(6, 'Vacuna Sputnik V'),
(7, 'Vacuna de Sinopharm BBIBP'),
(8, 'Vacuna de Sputnik Light');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `benefits`
--
ALTER TABLE `benefits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stores` (`id_store`),
  ADD KEY `collaborators` (`created_by`),
  ADD KEY `collaborators_update` (`updated_by`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `collaborators`
--
ALTER TABLE `collaborators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `institution` (`id_institution`),
  ADD KEY `rol` (`id_rol`) USING BTREE;

--
-- Indices de la tabla `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stores` (`id_store`);

--
-- Indices de la tabla `dose`
--
ALTER TABLE `dose`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`id_users`),
  ADD KEY `vaccines` (`id_vaccines`);

--
-- Indices de la tabla `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`id_user`);

--
-- Indices de la tabla `institution`
--
ALTER TABLE `institution`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `record_benefits`
--
ALTER TABLE `record_benefits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users` (`id_user`),
  ADD KEY `benefits` (`id_benefits`),
  ADD KEY `stores` (`id_stores`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories` (`id_category`),
  ADD KEY `collaborator` (`created_by`),
  ADD KEY `collaborators_update` (`updated_by`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collaborator` (`id_collaborator`),
  ADD KEY `collaborators` (`checked_by`);

--
-- Indices de la tabla `vaccines`
--
ALTER TABLE `vaccines`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `benefits`
--
ALTER TABLE `benefits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `collaborators`
--
ALTER TABLE `collaborators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `dose`
--
ALTER TABLE `dose`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `institution`
--
ALTER TABLE `institution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `record_benefits`
--
ALTER TABLE `record_benefits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `vaccines`
--
ALTER TABLE `vaccines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `benefits`
--
ALTER TABLE `benefits`
  ADD CONSTRAINT `benefits_ibfk_1` FOREIGN KEY (`id_store`) REFERENCES `stores` (`id`),
  ADD CONSTRAINT `benefits_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `collaborators` (`id`),
  ADD CONSTRAINT `benefits_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `collaborators` (`id`);

--
-- Filtros para la tabla `collaborators`
--
ALTER TABLE `collaborators`
  ADD CONSTRAINT `collaborators_ibfk_1` FOREIGN KEY (`id_institution`) REFERENCES `institution` (`id`),
  ADD CONSTRAINT `collaborators_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);

--
-- Filtros para la tabla `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`id_store`) REFERENCES `stores` (`id`);

--
-- Filtros para la tabla `dose`
--
ALTER TABLE `dose`
  ADD CONSTRAINT `dose_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `dose_ibfk_2` FOREIGN KEY (`id_vaccines`) REFERENCES `vaccines` (`id`);

--
-- Filtros para la tabla `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `record_benefits`
--
ALTER TABLE `record_benefits`
  ADD CONSTRAINT `record_benefits_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `record_benefits_ibfk_2` FOREIGN KEY (`id_benefits`) REFERENCES `benefits` (`id`),
  ADD CONSTRAINT `record_benefits_ibfk_3` FOREIGN KEY (`id_stores`) REFERENCES `stores` (`id`);

--
-- Filtros para la tabla `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `stores_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `stores_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `collaborators` (`id`),
  ADD CONSTRAINT `stores_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `collaborators` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_collaborator`) REFERENCES `collaborators` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`checked_by`) REFERENCES `collaborators` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
