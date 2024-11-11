-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3309
-- Tiempo de generación: 06-11-2024 a las 14:37:59
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
-- Base de datos: `nutri_foods`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_saludables`
--

CREATE TABLE `productos_saludables` (
  `id_productos_saludables` int(11) NOT NULL,
  `img` varchar(45) DEFAULT NULL,
  `nombre_producto` varchar(45) NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos_saludables`
--

INSERT INTO `productos_saludables` (`id_productos_saludables`, `img`, `nombre_producto`, `precio`, `descripcion`, `categoria`) VALUES
(1, 'assets/img/granola.png', 'Granola Orgánica', 450, 'Mezcla de avena, frutos secos y miel natural.', 'Desayuno'),
(2, 'assets/img/pan_integral.jpg', 'Pan Integral', 120, 'Hecho con harina de trigo integral 100%.', 'Panadería'),
(3, 'assets/img/leche_almendra.png', 'Leche Almendras', 250, 'Bebida vegetal a base de almendras.', 'Bebidas'),
(4, 'assets/img/miel_natural.jpeg', 'Miel Natural', 300, 'Miel pura de abejas orgánica.', 'Endulzantes'),
(5, 'assets/img/jugo_naranja.jpg', 'Jugo de Naranja', 180, 'Jugo 100% natural sin azúcar añadida.', 'Bebidas'),
(6, 'assets/img/avena_integral.jpeg', 'Avena Integral', 200, 'Avena sin procesar, ideal para desayunos.', 'Cereales'),
(7, 'assets/img/avena_quinua.jpg', 'Avena con Quinoa', 500, 'Combinación de avena integral con quinoa, rica en fibra y proteínas.', 'Cereales'),
(8, 'assets/img/barra_energetica.jpg', 'Barra Nutricional', 150, 'Barra energética con semillas de chía, linaza y almendras.', 'Snacks'),
(9, 'assets/img/jugo_verde.jpg', 'Jugo Verde Detox', 350, 'Jugo prensado en frío con espinacas, pepino, manzana y jengibre.', 'Bebidas'),
(10, 'assets/img/matequilla.jpg', 'Mantequilla de Maní', 250, 'Mantequilla de maní 100% natural, sin azúcar añadida.', 'Untables'),
(11, 'assets/img/semilla.png', 'Semillas de Chía', 180, 'Fuente rica en omega-3, ideal para smoothies y yogures.', 'Superalimentos'),
(12, 'assets/img/chocolate.jpg', 'Chocolate Orgánico 85%', 300, 'Chocolate oscuro elaborado con cacao orgánico, sin lácteos.', 'Snacks');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos_saludables`
--
ALTER TABLE `productos_saludables`
  ADD PRIMARY KEY (`id_productos_saludables`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
