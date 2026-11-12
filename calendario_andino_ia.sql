-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2026 a las 02:56:15
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `calendario_andino_ia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agricultores`
--

CREATE TABLE `agricultores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comunidad_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `experiencia_anios` int(10) UNSIGNED DEFAULT 0,
  `telefono_alternativo` varchar(20) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `agricultores`
--

INSERT INTO `agricultores` (`id`, `usuario_id`, `comunidad_id`, `fecha_nacimiento`, `experiencia_anios`, `telefono_alternativo`, `observaciones`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 0, NULL, NULL, '2026-11-12 04:20:46', '2026-11-12 04:20:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alertas`
--

CREATE TABLE `alertas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parcela_id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tipo` enum('sequia','helada','lluvia','temperatura','otro') NOT NULL,
  `nivel` enum('informativo','moderado','alto','critico') DEFAULT 'informativo',
  `titulo` varchar(150) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_generacion` datetime NOT NULL,
  `leida` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED DEFAULT NULL,
  `accion` varchar(100) NOT NULL,
  `tabla_afectada` varchar(100) DEFAULT NULL,
  `registro_id` bigint(20) UNSIGNED DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `direccion_ip` varchar(45) DEFAULT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunidades`
--

CREATE TABLE `comunidades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `distrito` varchar(100) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `departamento` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comunidades`
--

INSERT INTO `comunidades` (`id`, `nombre`, `distrito`, `provincia`, `departamento`, `created_at`, `updated_at`) VALUES
(1, 'Comunidad de Prueba', 'Coracora', 'Parinacochas', 'Ayacucho', '2026-11-12 04:20:45', '2026-11-12 04:20:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cultivos`
--

CREATE TABLE `cultivos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `dias_ciclo` int(10) UNSIGNED DEFAULT NULL,
  `temperatura_minima` decimal(5,2) DEFAULT NULL,
  `temperatura_maxima` decimal(5,2) DEFAULT NULL,
  `precipitacion_minima_mm` decimal(8,2) DEFAULT NULL,
  `precipitacion_maxima_mm` decimal(8,2) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cultivos`
--

INSERT INTO `cultivos` (`id`, `nombre`, `descripcion`, `dias_ciclo`, `temperatura_minima`, `temperatura_maxima`, `precipitacion_minima_mm`, `precipitacion_maxima_mm`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Papa', 'Cultivo andino de tubérculo', 150, NULL, NULL, NULL, NULL, 1, '2026-11-11 20:47:32', '2026-11-11 20:47:32'),
(2, 'Maíz', 'Cultivo andino de grano', 180, NULL, NULL, NULL, NULL, 1, '2026-11-11 20:47:32', '2026-11-11 20:47:32'),
(3, 'Quinua', 'Cultivo andino de grano', 150, NULL, NULL, NULL, NULL, 1, '2026-11-11 20:47:32', '2026-11-11 20:47:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_climaticos`
--

CREATE TABLE `datos_climaticos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parcela_id` bigint(20) UNSIGNED NOT NULL,
  `fuente_id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `temperatura_media` decimal(5,2) DEFAULT NULL,
  `temperatura_minima` decimal(5,2) DEFAULT NULL,
  `temperatura_maxima` decimal(5,2) DEFAULT NULL,
  `precipitacion_mm` decimal(8,2) DEFAULT NULL,
  `humedad_relativa` decimal(5,2) DEFAULT NULL,
  `velocidad_viento` decimal(6,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_satelitales`
--

CREATE TABLE `datos_satelitales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parcela_id` bigint(20) UNSIGNED NOT NULL,
  `fuente_id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `humedad_suelo` decimal(8,5) DEFAULT NULL,
  `latitud` decimal(10,7) DEFAULT NULL,
  `longitud` decimal(10,7) DEFAULT NULL,
  `resolucion_km` decimal(8,2) DEFAULT NULL,
  `identificador_producto` varchar(150) DEFAULT NULL,
  `calidad_dato` varchar(50) DEFAULT NULL,
  `unidad` varchar(30) DEFAULT NULL,
  `datos_originales` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`datos_originales`)),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fuentes_datos`
--

CREATE TABLE `fuentes_datos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `fuentes_datos`
--

INSERT INTO `fuentes_datos` (`id`, `nombre`, `tipo`, `descripcion`, `url`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'NASA SMAP', 'Satelital', 'Datos de humedad superficial del suelo', 'https://nsidc.org/data/smap', 1, '2026-11-11 20:47:33', '2026-11-11 20:47:33'),
(2, 'NASA POWER', 'Meteorologica', 'Datos meteorológicos y climatológicos', 'https://power.larc.nasa.gov/', 1, '2026-11-11 20:47:33', '2026-11-11 20:47:33'),
(3, 'SENAMHI', 'Meteorologica', 'Información meteorológica del Perú', 'https://www.senamhi.gob.pe/', 1, '2026-11-11 20:47:33', '2026-11-11 20:47:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos_ia`
--

CREATE TABLE `modelos_ia` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `version` varchar(50) NOT NULL,
  `algoritmo` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `metricas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metricas`)),
  `fecha_entrenamiento` datetime DEFAULT NULL,
  `estado` enum('entrenamiento','activo','inactivo') DEFAULT 'inactivo',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parcelas`
--

CREATE TABLE `parcelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agricultor_id` bigint(20) UNSIGNED NOT NULL,
  `comunidad_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `latitud` decimal(10,7) NOT NULL,
  `longitud` decimal(10,7) NOT NULL,
  `altitud_msnm` decimal(8,2) DEFAULT NULL,
  `area_hectareas` decimal(10,2) DEFAULT NULL,
  `tipo_suelo` varchar(100) DEFAULT NULL,
  `sistema_cultivo` enum('secano','riego','mixto') DEFAULT 'secano',
  `descripcion` text DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pronosticos`
--

CREATE TABLE `pronosticos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parcela_id` bigint(20) UNSIGNED NOT NULL,
  `fuente_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_emision` datetime NOT NULL,
  `fecha_pronosticada` date NOT NULL,
  `temperatura_minima` decimal(5,2) DEFAULT NULL,
  `temperatura_maxima` decimal(5,2) DEFAULT NULL,
  `precipitacion_mm` decimal(8,2) DEFAULT NULL,
  `probabilidad_lluvia` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recomendaciones`
--

CREATE TABLE `recomendaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parcela_id` bigint(20) UNSIGNED NOT NULL,
  `cultivo_id` bigint(20) UNSIGNED NOT NULL,
  `variedad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `modelo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha_evaluacion` datetime NOT NULL,
  `fecha_siembra_desde` date NOT NULL,
  `fecha_siembra_hasta` date NOT NULL,
  `nivel_confianza` decimal(5,2) DEFAULT NULL,
  `riesgo_sequia` enum('bajo','medio','alto') DEFAULT NULL,
  `riesgo_helada` enum('bajo','medio','alto') DEFAULT NULL,
  `recomendacion` text NOT NULL,
  `justificacion` text DEFAULT NULL,
  `estado` enum('pendiente','validada','rechazada') DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `siembras`
--

CREATE TABLE `siembras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parcela_id` bigint(20) UNSIGNED NOT NULL,
  `variedad_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_siembra` date NOT NULL,
  `fecha_cosecha` date DEFAULT NULL,
  `cantidad_semilla_kg` decimal(10,2) DEFAULT NULL,
  `rendimiento_kg` decimal(12,2) DEFAULT NULL,
  `resultado` enum('pendiente','bueno','regular','malo') DEFAULT 'pendiente',
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `dni` char(8) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('administrador','tecnico','agricultor') NOT NULL DEFAULT 'agricultor',
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `dni`, `email`, `telefono`, `password`, `rol`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Fermín', 'Huayta', NULL, 'fermin@ejemplo.com', NULL, '$2y$12$OKJO40k527o4OG8aeIHo0uLRaf0pI.wmkqcCFFeVhCRv5wbJNzEz6', 'agricultor', 1, '2026-11-12 04:20:46', '2026-11-12 04:20:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variedades`
--

CREATE TABLE `variedades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cultivo_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `dias_maduracion` int(10) UNSIGNED DEFAULT NULL,
  `resistencia_sequia` varchar(50) DEFAULT NULL,
  `resistencia_helada` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agricultores`
--
ALTER TABLE `agricultores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_id` (`usuario_id`),
  ADD KEY `comunidad_id` (`comunidad_id`);

--
-- Indices de la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parcela_id` (`parcela_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `comunidades`
--
ALTER TABLE `comunidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cultivos`
--
ALTER TABLE `cultivos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `datos_climaticos`
--
ALTER TABLE `datos_climaticos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_clima_fecha` (`parcela_id`,`fecha`),
  ADD KEY `fuente_id` (`fuente_id`);

--
-- Indices de la tabla `datos_satelitales`
--
ALTER TABLE `datos_satelitales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_satelite_fecha` (`parcela_id`,`fecha`),
  ADD KEY `fuente_id` (`fuente_id`);

--
-- Indices de la tabla `fuentes_datos`
--
ALTER TABLE `fuentes_datos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `modelos_ia`
--
ALTER TABLE `modelos_ia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `parcelas`
--
ALTER TABLE `parcelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_parcela_gps` (`latitud`,`longitud`),
  ADD KEY `agricultor_id` (`agricultor_id`),
  ADD KEY `comunidad_id` (`comunidad_id`);

--
-- Indices de la tabla `pronosticos`
--
ALTER TABLE `pronosticos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_pronostico_fecha` (`parcela_id`,`fecha_pronosticada`),
  ADD KEY `fuente_id` (`fuente_id`);

--
-- Indices de la tabla `recomendaciones`
--
ALTER TABLE `recomendaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_recomendacion_parcela` (`parcela_id`,`fecha_evaluacion`),
  ADD KEY `cultivo_id` (`cultivo_id`),
  ADD KEY `variedad_id` (`variedad_id`),
  ADD KEY `modelo_id` (`modelo_id`);

--
-- Indices de la tabla `siembras`
--
ALTER TABLE `siembras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parcela_id` (`parcela_id`),
  ADD KEY `variedad_id` (`variedad_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `variedades`
--
ALTER TABLE `variedades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_variedad` (`cultivo_id`,`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agricultores`
--
ALTER TABLE `agricultores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `alertas`
--
ALTER TABLE `alertas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comunidades`
--
ALTER TABLE `comunidades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cultivos`
--
ALTER TABLE `cultivos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `datos_climaticos`
--
ALTER TABLE `datos_climaticos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `datos_satelitales`
--
ALTER TABLE `datos_satelitales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fuentes_datos`
--
ALTER TABLE `fuentes_datos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `modelos_ia`
--
ALTER TABLE `modelos_ia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `parcelas`
--
ALTER TABLE `parcelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pronosticos`
--
ALTER TABLE `pronosticos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recomendaciones`
--
ALTER TABLE `recomendaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `siembras`
--
ALTER TABLE `siembras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `variedades`
--
ALTER TABLE `variedades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agricultores`
--
ALTER TABLE `agricultores`
  ADD CONSTRAINT `agricultores_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `agricultores_ibfk_2` FOREIGN KEY (`comunidad_id`) REFERENCES `comunidades` (`id`);

--
-- Filtros para la tabla `alertas`
--
ALTER TABLE `alertas`
  ADD CONSTRAINT `alertas_ibfk_1` FOREIGN KEY (`parcela_id`) REFERENCES `parcelas` (`id`),
  ADD CONSTRAINT `alertas_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `auditoria_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `datos_climaticos`
--
ALTER TABLE `datos_climaticos`
  ADD CONSTRAINT `datos_climaticos_ibfk_1` FOREIGN KEY (`parcela_id`) REFERENCES `parcelas` (`id`),
  ADD CONSTRAINT `datos_climaticos_ibfk_2` FOREIGN KEY (`fuente_id`) REFERENCES `fuentes_datos` (`id`);

--
-- Filtros para la tabla `datos_satelitales`
--
ALTER TABLE `datos_satelitales`
  ADD CONSTRAINT `datos_satelitales_ibfk_1` FOREIGN KEY (`parcela_id`) REFERENCES `parcelas` (`id`),
  ADD CONSTRAINT `datos_satelitales_ibfk_2` FOREIGN KEY (`fuente_id`) REFERENCES `fuentes_datos` (`id`);

--
-- Filtros para la tabla `parcelas`
--
ALTER TABLE `parcelas`
  ADD CONSTRAINT `parcelas_ibfk_1` FOREIGN KEY (`agricultor_id`) REFERENCES `agricultores` (`id`),
  ADD CONSTRAINT `parcelas_ibfk_2` FOREIGN KEY (`comunidad_id`) REFERENCES `comunidades` (`id`);

--
-- Filtros para la tabla `pronosticos`
--
ALTER TABLE `pronosticos`
  ADD CONSTRAINT `pronosticos_ibfk_1` FOREIGN KEY (`parcela_id`) REFERENCES `parcelas` (`id`),
  ADD CONSTRAINT `pronosticos_ibfk_2` FOREIGN KEY (`fuente_id`) REFERENCES `fuentes_datos` (`id`);

--
-- Filtros para la tabla `recomendaciones`
--
ALTER TABLE `recomendaciones`
  ADD CONSTRAINT `recomendaciones_ibfk_1` FOREIGN KEY (`parcela_id`) REFERENCES `parcelas` (`id`),
  ADD CONSTRAINT `recomendaciones_ibfk_2` FOREIGN KEY (`cultivo_id`) REFERENCES `cultivos` (`id`),
  ADD CONSTRAINT `recomendaciones_ibfk_3` FOREIGN KEY (`variedad_id`) REFERENCES `variedades` (`id`),
  ADD CONSTRAINT `recomendaciones_ibfk_4` FOREIGN KEY (`modelo_id`) REFERENCES `modelos_ia` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `siembras`
--
ALTER TABLE `siembras`
  ADD CONSTRAINT `siembras_ibfk_1` FOREIGN KEY (`parcela_id`) REFERENCES `parcelas` (`id`),
  ADD CONSTRAINT `siembras_ibfk_2` FOREIGN KEY (`variedad_id`) REFERENCES `variedades` (`id`);

--
-- Filtros para la tabla `variedades`
--
ALTER TABLE `variedades`
  ADD CONSTRAINT `variedades_ibfk_1` FOREIGN KEY (`cultivo_id`) REFERENCES `cultivos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
