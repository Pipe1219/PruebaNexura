-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-09-2024 a las 06:53:30
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_nexura_luis_martinez`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_areas`
--

CREATE TABLE `t_areas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `t_areas`
--

INSERT INTO `t_areas` (`id`, `nombre`) VALUES
(9, 'Compras y Abastecimiento'),
(12, 'Comunicación y Relaciones Públicas'),
(1, 'Dirección y Administración'),
(11, 'Estrategia y Planificación'),
(2, 'Finanzas y Contabilidad'),
(13, 'Gestión de Proyectos'),
(7, 'Investigación y Desarrollo (I+D)'),
(10, 'Legal y Cumplimiento'),
(5, 'Operaciones y Producción'),
(3, 'Recursos Humanos (RRHH)'),
(14, 'Seguridad y Salud Ocupacional'),
(8, 'Servicio al Cliente'),
(6, 'Tecnología de la Información (TI)'),
(4, 'Ventas y Marketing');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_empleado`
--

CREATE TABLE `t_empleado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `sexo` char(1) NOT NULL,
  `area_id` int(11) NOT NULL,
  `boletin` char(1) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `t_empleado`
--

INSERT INTO `t_empleado` (`id`, `nombre`, `email`, `sexo`, `area_id`, `boletin`, `descripcion`) VALUES
(2, 'Juan Sebastián Rodríguez', 'JuanSebastian01@gmail.com', 'M', 11, 'S', 'Desarrollar y coordinar estrategias y planes para asegurar el crecimiento sostenible y la alineación de la empresa con sus objetivos a largo plazo.'),
(3, 'Ana María Gómez', 'gomezana02@hotmail.com', 'F', 8, 'N', 'Proporcionar un excelente servicio al cliente, resolver consultas y problemas de los clientes de manera eficiente y efectiva, y contribuir a la satisfacción y lealtad del cliente.'),
(4, 'Carlos Andrés González Campo', 'gonzales1999@gmail.com', 'M', 2, 'S', 'Gestionar y supervisar las finanzas y contabilidad de la empresa para asegurar la precisión de los informes financieros, el cumplimiento normativo y la eficiencia en el uso de los recursos financieros.'),
(5, 'Mariana Torres', 'torresm44@hotmail.com', 'F', 14, 'S', 'Garantizar la seguridad y salud de los empleados mediante la implementación de políticas, procedimientos y programas que cumplan con las normativas legales y promuevan un entorno laboral seguro.'),
(6, 'Miguel Ángel Pérez', 'miguelaperez@gmail.com', 'M', 4, 'S', 'Desarrollar e implementar estrategias de ventas y marketing para promover productos o servicios, atraer clientes, aumentar la participación en el mercado y alcanzar los objetivos de ingresos de la empresa.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_empleado_rol`
--

CREATE TABLE `t_empleado_rol` (
  `empleado_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `t_empleado_rol`
--

INSERT INTO `t_empleado_rol` (`empleado_id`, `rol_id`) VALUES
(2, 8),
(2, 8),
(3, 2),
(3, 7),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(5, 4),
(5, 5),
(4, 3),
(4, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_roles`
--

CREATE TABLE `t_roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `t_roles`
--

INSERT INTO `t_roles` (`id`, `nombre`) VALUES
(6, 'Análisis y Ciencia de Datos'),
(1, 'Desarrollo de Software'),
(5, 'Gestión de Proyectos y Productos'),
(2, 'Infraestructura y Operaciones'),
(7, 'Innovación y Desarrollo Tecnológico'),
(3, 'Seguridad de la Información'),
(4, 'Soporte y Mantenimiento'),
(8, 'UX/UI y Diseño');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_areas`
--
ALTER TABLE `t_areas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_nombre_area` (`nombre`);

--
-- Indices de la tabla `t_empleado`
--
ALTER TABLE `t_empleado`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD KEY `fk_area` (`area_id`);

--
-- Indices de la tabla `t_empleado_rol`
--
ALTER TABLE `t_empleado_rol`
  ADD KEY `fk_empleado` (`empleado_id`),
  ADD KEY `fk_roles` (`rol_id`);

--
-- Indices de la tabla `t_roles`
--
ALTER TABLE `t_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_nombre_rol` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `t_areas`
--
ALTER TABLE `t_areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `t_empleado`
--
ALTER TABLE `t_empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `t_roles`
--
ALTER TABLE `t_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_empleado`
--
ALTER TABLE `t_empleado`
  ADD CONSTRAINT `fk_area` FOREIGN KEY (`area_id`) REFERENCES `t_areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_empleado_rol`
--
ALTER TABLE `t_empleado_rol`
  ADD CONSTRAINT `fk_empleado` FOREIGN KEY (`empleado_id`) REFERENCES `t_empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_roles` FOREIGN KEY (`rol_id`) REFERENCES `t_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
