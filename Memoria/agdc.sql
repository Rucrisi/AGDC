-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-03-2025 a las 20:42:11
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agdc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutinas`
--

CREATE TABLE `rutinas` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rutinas`
--

INSERT INTO `rutinas` (`id`, `title`, `description`) VALUES
(1, 'Lunes - Piernas ', '1. Sentadillas: 4x10\r\n2. Zancadas: 3x12  \r\n3. Peso muerto rumano: 4x8  \r\n4. Prensa de piernas: 4x10  \r\n5. Elevaciones de talones: 3x20  \r\n6. Subidas banco mancuernas: 3x10\r\n'),
(2, 'Martes - Pecho y Tríceps', '1. Press de banca: 4x10\r\n2. Press inclinado mancuernas: 4x8\r\n3. Fondos en paralelas: 3x10\r\n4. Aperturas con mancuernas: 3x12\r\n5. Press cerrado: 3x10\r\n6. Extensión tríceps en polea: 3x15\r\n'),
(3, 'Miércoles - Espalda', '1. Jalón al pecho: 4x10\r\n2. Remo con barra: 4x8\r\n3. Peso muerto: 3x6\r\n4. Remo mancuerna una mano: 3x10\r\n5. Pull-over: 3x12\r\n6. Face pulls: 3x15\r\n'),
(4, 'Jueves - Hombros y Bíceps', '1. Press militar: 4x10\r\n2. Elevaciones laterales: 3x12\r\n3. Elevaciones frontales: 3x12\r\n4. Curl con barra: 3x10\r\n5. Curl martillo: 3x12\r\n6. Curl concentrado: 3x10'),
(5, 'Viernes - Full Body', '1. Sentadillas con salto: 4x10\r\n2. Plancha: 3x1min\r\n3. Dominadas: 3xMax\r\n4. Flexiones: 4x12\r\n5. Burpees: 3x15\r\n6. Abdominales bicicleta: 3x20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutinas_en`
--

CREATE TABLE `rutinas_en` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rutinas_en`
--

INSERT INTO `rutinas_en` (`id`, `title`, `description`) VALUES
(1, 'Monday - Legs', '1. Squats: 4x10\r\n2. Lunges: 3x12  \r\n3. Romanian Deadlift: 4x8  \r\n4. Leg Press: 4x10  \r\n5. Calf Raises: 3x20  \r\n6. Dumbbell Step-ups: 3x10'),
(2, 'Tuesday - Chest & Triceps', '1. Bench Press: 4x10  \r\n2. Incline Dumbbell Press: 4x8  \r\n3. Dips: 3x10  \r\n4. Dumbbell Flyes: 3x12  \r\n5. Close-Grip Press: 3x10  \r\n6. Triceps Pushdown: 3x15'),
(3, 'Wednesday - Back', '1. Lat Pulldown: 4x10  \r\n2. Barbell Row: 4x8  \r\n3. Deadlift: 3x6  \r\n4. One-arm Dumbbell Row: 3x10  \r\n5. Pullover: 3x12  \r\n6. Face Pulls: 3x15'),
(4, 'Thursday - Shoulders & Biceps', '1. Military Press: 4x10  \r\n2. Lateral Raises: 3x12  \r\n3. Front Raises: 3x12  \r\n4. Barbell Curl: 3x10  \r\n5. Hammer Curl: 3x12  \r\n6. Concentration Curl: 3x10'),
(5, 'Friday - Full Body', '1. Jump Squats: 4x10  \r\n2. Plank: 3x1min  \r\n3. Pull-ups: 3xMax  \r\n4. Push-ups: 4x12  \r\n5. Burpees: 3x15  \r\n6. Bicycle Crunches: 3x20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Admin', 'admin@correo.com', '$2y$10$1I/tDtj7T1D4Zno9fH2abOQFsKSi1V1j6v.dLrrbE8Z/7KuzhD3kW'),
(2, 'Rubén Crispín', 'ruben.crispin@correo.com', '$2y$10$o/yZg8/8u96NrrtY2INXJ.JrB4GZuAdXePQqmlq8UoRX9DEIrh69O'),
(3, 'Arturo Galán', 'arturo.galan@correo.com', '$2y$10$scN2duO2r7bxBg2ZxHZLEOqf4R0sHMs8lNb5T6K/r0w.SHaG91zgS'),
(4, 'Juan Sotos', 'juan.sotos@correo.es', '$2y$10$WOdpzoaiCDsDrgsg3fnHFuPCtJ.Hcbu/2DJkhUDbmnAuC7bDvz86a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rutina`
--

CREATE TABLE `usuario_rutina` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rutina_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_rutina`
--

INSERT INTO `usuario_rutina` (`id`, `user_id`, `rutina_id`) VALUES
(56, 1, 1),
(67, 3, 1),
(69, 3, 3),
(71, 3, 5),
(72, 1, 2),
(73, 1, 3),
(80, 1, 4),
(81, 1, 5),
(84, 2, 2),
(85, 2, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `rutinas`
--
ALTER TABLE `rutinas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rutinas_en`
--
ALTER TABLE `rutinas_en`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `usuario_rutina`
--
ALTER TABLE `usuario_rutina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `rutina_id` (`rutina_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `rutinas`
--
ALTER TABLE `rutinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rutinas_en`
--
ALTER TABLE `rutinas_en`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario_rutina`
--
ALTER TABLE `usuario_rutina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario_rutina`
--
ALTER TABLE `usuario_rutina`
  ADD CONSTRAINT `usuario_rutina_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuario_rutina_ibfk_2` FOREIGN KEY (`rutina_id`) REFERENCES `rutinas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
