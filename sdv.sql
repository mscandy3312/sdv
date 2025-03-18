-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-03-2025 a las 05:48:34
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sdv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Electrónicos', 'Productos electrónicos y gadgets', 1, '2025-02-27 06:45:12', '2025-02-27 06:45:12'),
(2, 'Ropa', 'Todo tipo de prendas de vestir', 1, '2025-02-27 06:45:12', '2025-02-27 06:45:12'),
(3, 'Hogar', 'Artículos para el hogar', 1, '2025-02-27 06:45:12', '2025-02-27 06:45:12'),
(4, 'Deportes', 'Equipamiento deportivo', 1, '2025-02-27 06:45:12', '2025-02-27 06:45:12'),
(5, 'Libros', 'Libros y material de lectura', 1, '2025-02-27 06:45:12', '2025-02-27 06:45:12'),
(6, 'Juguetes', 'Juguetes y juegos', 1, '2025-02-27 06:45:12', '2025-02-27 06:45:12'),
(7, 'Alimentos', 'Productos alimenticios', 1, '2025-02-27 06:45:12', '2025-02-27 06:45:12'),
(8, 'Bebidas', 'Bebidas y refrescos', 1, '2025-02-27 06:45:12', '2025-02-27 06:45:12'),
(9, 'Muebles', 'Muebles para el hogar y oficina', 1, '2025-02-27 06:45:12', '2025-02-27 06:45:12'),
(11, 'Mascotas', 'Productos para mascotas', 1, '2025-02-27 06:45:12', '2025-02-27 06:45:12'),
(12, 'Belleza', 'Productos de belleza y cuidado personal', 1, '2025-02-27 06:45:12', '2025-02-27 06:45:12'),
(13, 'Herramientas', 'Herramientas y equipamiento', 1, '2025-02-27 06:45:12', '2025-02-27 06:45:12'),
(14, 'Automotriz', 'Accesorios y productos para vehículos', 1, '2025-02-27 06:45:12', '2025-02-27 06:45:12'),
(15, 'Música', 'Instrumentos y equipos musicales', 1, '2025-02-27 06:45:12', '2025-02-27 06:45:12'),
(17, 'Sex Shop', 'Productos coketones', 1, '2025-03-15 12:32:30', '2025-03-15 12:34:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `last name` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `comments` varchar(200) NOT NULL,
  `phone` int(10) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `name`, `last name`, `address`, `comments`, `phone`, `email`) VALUES
(0, 'Juan', '', 'Nila Rd', '', 2147483647, 'jcarlos61200@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `dni` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`, `dni`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cristina Vásquez', 'beatriz.gallegos@example.org', '995551586', 'Travessera Carolina, 8, 5º A, 94392, Os Luis de San Pedro', '53824026', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(2, 'Sra. Rosa Mireles Tercero', 'ander71@example.net', '+34 946676171', 'Calle Arias, 67, 62º B, 20687, Lozano de Ulla', '71063986', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(3, 'Daniela Delrío', 'ander.robledo@example.org', '+34 900 382261', 'Rúa Álvaro, 12, 78º B, 85349, Os Jaramillo', '83056741', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(4, 'Sara Nieves', 'hmedrano@example.com', '973 994724', 'Passeig Abril, 999, 6º F, 29545, O Oliva del Penedès', '08187221', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(5, 'Alejandra Abreu', 'amireles@example.org', '+34 961 506020', 'Carrer Izan, 671, 6º A, 90338, La Hinojosa del Mirador', '27010217', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(6, 'Alonso Cerda', 'juarez.veronica@example.org', '+34 955179702', 'Travessera Medina, 502, 6º B, 70077, La Velázquez del Pozo', '38252659', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(7, 'Encarnación Villa', 'isaac37@example.com', '971-699917', 'Rúa Ainhoa, 50, 97º A, 91276, A Aguilar', '04134765', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(8, 'César Leiva Hijo', 'enrique67@example.com', '+34 924 025896', 'Calle Cruz, 39, 5º E, 77841, Tapia Medio', '46170842', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(9, 'Srta. Pilar Esparza Hijo', 'gloria89@example.com', '+34 914-052265', 'Ruela Arribas, 131, 50º A, 60667, L\' Escudero del Bages', '16623427', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(10, 'Diana Cavazos', 'qmillan@example.com', '991 32 1696', 'Rúa Sergio, 62, Entre suelo 4º, 42890, Bautista de Arriba', '72995321', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(11, 'Adriana Valdivia Segundo', 'meza.berta@example.org', '+34 950-067678', 'Calle Barajas, 16, Entre suelo 5º, 90398, A Barraza de Ulla', '45806440', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(12, 'Gabriel Nieves', 'cpadilla@example.org', '+34 967 484639', 'Rúa Segura, 738, 74º A, 28729, El Vásquez del Vallès', '67820799', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(13, 'Verónica Valero Tercero', 'gcarrasquillo@example.com', '+34 915897547', 'Avinguda Francisco, 971, Bajo 9º, 78438, La Ceja', '51416740', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(14, 'Luis Sisneros', 'vicente.salma@example.net', '+34 942369046', 'Camiño Dario, 43, 9º E, 06328, Casanova de Ulla', '99103109', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(15, 'Marta Campos Hijo', 'marc92@example.net', '+34 947 93 2874', 'Plaça Orosco, 175, 8º E, 99240, L\' Porras del Bages', '88596744', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(16, 'Jordi Juan', 'naia.muniz@example.com', '+34 903-78-6811', 'Carrer Gallardo, 9, Bajo 9º, 06379, As Varela Alta', '11012995', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(17, 'Miguel Ángel Vergara', 'alonso.gallegos@example.org', '989 83 7503', 'Praza Ainara, 3, Entre suelo 5º, 93050, Arce del Bages', '27838909', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(18, 'Jimena Gracia', 'mariacarmen39@example.org', '+34 916-09-8789', 'Travesía Yeray, 21, 9º A, 00598, Barajas Baja', '85354290', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(19, 'Aitor Nieto', 'scollazo@example.org', '+34 981544214', 'Ronda Salma, 3, Bajo 8º, 44507, El Valadez', '22190550', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(20, 'Dña Josefa Preciado', 'jordi.madrigal@example.com', '942 735498', 'Plaça Blasco, 43, 98º D, 19694, L\' Pérez del Mirador', '61631793', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(21, 'Aaron Jimínez', 'ruiz.luis@example.org', '912-005980', 'Carrer Noa, 595, Bajo 9º, 17788, As Redondo', '73763128', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(22, 'Ing. Eric Mejía', 'wcollado@example.org', '913-265289', 'Rúa Naiara, 112, Bajo 0º, 63811, Luján del Barco', '89949363', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(23, 'África Navarro Hijo', 'jose98@example.net', '916 63 7049', 'Plaza Enríquez, 61, 80º F, 11380, Pagan del Vallès', '32208277', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(24, 'Noa Córdova', 'ubermejo@example.net', '985582558', 'Plaça Jorge, 3, 08º 0º, 26422, Vall Vila', '89494287', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(25, 'Ing. Manuel Carmona Segundo', 'abril23@example.com', '+34 953-502474', 'Plaça Pedro, 333, 1º B, 16755, San Romero de las Torres', '54867169', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(26, 'Lucía Canales Tercero', 'ines.briseno@example.org', '+34 990-877860', 'Ronda Rafael, 649, 95º B, 02140, Avilés de Lemos', '74046048', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(27, 'Beatriz Chapa', 'ismael70@example.org', '980 052996', 'Ruela Trejo, 67, 8º B, 95192, La Chavarría del Mirador', '98709750', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(28, 'Dr. Asier Delapaz Segundo', 'kzuniga@example.org', '+34 903316840', 'Ruela Montalvo, 3, 87º A, 52562, Tapia del Penedès', '39189493', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(29, 'Dr. Pablo Corrales Hijo', 'noelia33@example.net', '+34 993916307', 'Plaza Rodrigo, 887, 28º F, 90093, A Delrío', '82641656', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(30, 'Adrián Lara', 'lbarraza@example.net', '+34 964-916871', 'Praza Márquez, 94, 92º A, 31613, Orta del Pozo', '81020359', 1, '2025-02-27 06:46:17', '2025-02-27 06:46:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_02_26_014241_create_categories_table', 1),
(6, '2025_02_26_014302_create_products_table', 1),
(7, '2025_02_26_014328_create_customers_table', 1),
(8, '2025_02_26_014343_create_sales_table', 1),
(9, '2025_02_26_014413_create_sale_details_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `description`, `price`, `stock`, `image`, `category_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PRD-0001', 'Smartphone XYZ', 'Descripción detallada de Smartphone XYZ', 599.99, 43, 'images/products/product_1.jpg', 1, 1, '2025-02-27 06:45:13', '2025-02-27 06:46:17'),
(2, 'PRD-0002', 'Laptop Pro', 'Descripción detallada de Laptop Pro', 1299.99, 0, 'images/products/product_2.jpg', 1, 1, '2025-02-27 06:45:14', '2025-03-17 08:01:43'),
(3, 'PRD-0003', 'Tablet Ultra', 'Descripción detallada de Tablet Ultra', 399.99, 36, 'images/products/product_3.jpg', 1, 1, '2025-02-27 06:45:15', '2025-02-27 06:46:17'),
(4, 'PRD-0004', 'Smartwatch Elite', 'Descripción detallada de Smartwatch Elite', 199.99, 45, 'images/products/product_4.jpg', 1, 1, '2025-02-27 06:45:16', '2025-02-27 06:45:16'),
(5, 'PRD-0005', 'Auriculares Bluetooth', 'Descripción detallada de Auriculares Bluetooth', 79.99, 53, 'images/products/product_5.jpg', 1, 1, '2025-02-27 06:45:17', '2025-03-17 04:16:47'),
(6, 'PRD-0006', 'Camisa Casual', 'Descripción detallada de Camisa Casual', 29.99, 100, 'images/products/product_6.jpg', 2, 1, '2025-02-27 06:45:17', '2025-02-27 06:45:17'),
(7, 'PRD-0007', 'Jeans Clásicos', 'Descripción detallada de Jeans Clásicos', 49.99, 63, 'images/products/product_7.jpg', 2, 1, '2025-02-27 06:45:18', '2025-02-27 06:46:18'),
(8, 'PRD-0008', 'Vestido Elegante', 'Descripción detallada de Vestido Elegante', 89.99, 37, 'images/products/product_8.jpg', 2, 1, '2025-02-27 06:45:19', '2025-02-27 06:46:17'),
(9, 'PRD-0009', 'Chaqueta de Cuero', 'Descripción detallada de Chaqueta de Cuero', 129.99, 27, 'images/products/product_9.jpg', 2, 1, '2025-02-27 06:45:20', '2025-02-27 06:46:17'),
(11, 'PRD-0011', 'Juego de Sábanas', 'Descripción detallada de Juego de Sábanas', 39.99, 56, 'images/products/product_11.jpg', 3, 1, '2025-02-27 06:45:22', '2025-02-27 06:46:18'),
(12, 'PRD-0012', 'Lámpara de Mesa', 'Descripción detallada de Lámpara de Mesa', 45.99, 36, 'images/products/product_12.jpg', 3, 1, '2025-02-27 06:45:23', '2025-02-27 06:46:17'),
(13, 'PRD-0013', 'Set de Toallas', 'Descripción detallada de Set de Toallas', 34.99, 56, 'images/products/product_13.jpg', 3, 1, '2025-02-27 06:45:24', '2025-02-27 06:46:17'),
(14, 'PRD-0014', 'Cortinas Decorativas', 'Descripción detallada de Cortinas Decorativas', 59.99, 29, 'images/products/product_14.jpg', 3, 1, '2025-02-27 06:45:25', '2025-02-27 06:46:18'),
(15, 'PRD-0015', 'Almohadas Memory Foam', 'Descripción detallada de Almohadas Memory Foam', 29.99, 75, 'images/products/product_15.jpg', 3, 1, '2025-02-27 06:45:25', '2025-02-27 06:46:17'),
(16, 'PRD-0016', 'Balón de Fútbol', 'Descripción detallada de Balón de Fútbol', 19.99, 40, 'images/products/product_16.jpg', 4, 1, '2025-02-27 06:45:26', '2025-02-27 06:45:26'),
(17, 'PRD-0017', 'Raqueta de Tenis', 'Descripción detallada de Raqueta de Tenis', 89.99, 17, 'images/products/product_17.jpg', 4, 1, '2025-02-27 06:45:27', '2025-02-27 06:46:18'),
(18, 'PRD-0018', 'Mochila Deportiva', 'Descripción detallada de Mochila Deportiva', 39.99, 33, 'images/products/product_18.jpg', 4, 1, '2025-02-27 06:45:28', '2025-02-27 06:46:18'),
(19, 'PRD-0019', 'Pesas Ajustables', 'Descripción detallada de Pesas Ajustables', 149.99, 18, 'images/products/product_19.jpg', 4, 1, '2025-02-27 06:45:29', '2025-02-27 06:46:17'),
(20, 'PRD-0020', 'Bicicleta de Montaña', 'Descripción detallada de Bicicleta de Montaña', 499.99, 0, 'images/products/product_20.jpg', 4, 1, '2025-02-27 06:45:30', '2025-03-17 08:16:02'),
(21, 'PRD-0021', 'Producto Libros 1', 'Descripción detallada de Producto Libros 1', 88.85, 80, 'images/products/product_21.jpg', 5, 1, '2025-02-27 06:45:31', '2025-02-27 06:46:18'),
(22, 'PRD-0022', 'Producto Libros 2', 'Descripción detallada de Producto Libros 2', 70.61, 42, 'images/products/product_22.jpg', 5, 1, '2025-02-27 06:45:31', '2025-02-27 06:46:18'),
(23, 'PRD-0023', 'Producto Libros 3', 'Descripción detallada de Producto Libros 3', 75.73, 74, 'images/products/product_23.jpg', 5, 1, '2025-02-27 06:45:32', '2025-02-27 06:46:17'),
(24, 'PRD-0024', 'Producto Libros 4', 'Descripción detallada de Producto Libros 4', 66.31, 28, 'images/products/product_24.jpg', 5, 1, '2025-02-27 06:45:33', '2025-02-27 06:46:17'),
(25, 'PRD-0025', 'Producto Libros 5', 'Descripción detallada de Producto Libros 5', 46.80, 56, 'images/products/product_25.jpg', 5, 1, '2025-02-27 06:45:34', '2025-02-27 06:46:18'),
(26, 'PRD-0026', 'Producto Juguetes 1', 'Descripción detallada de Producto Juguetes 1', 66.29, 84, 'images/products/product_26.jpg', 6, 1, '2025-02-27 06:45:34', '2025-02-27 06:46:18'),
(27, 'PRD-0027', 'Producto Juguetes 2', 'Descripción detallada de Producto Juguetes 2', 48.20, 50, 'images/products/product_27.jpg', 6, 1, '2025-02-27 06:45:35', '2025-02-27 06:46:18'),
(28, 'PRD-0028', 'Producto Juguetes 3', 'Descripción detallada de Producto Juguetes 3', 54.25, 60, 'images/products/product_28.jpg', 6, 1, '2025-02-27 06:45:36', '2025-02-27 06:46:17'),
(29, 'PRD-0029', 'Producto Juguetes 4', 'Descripción detallada de Producto Juguetes 4', 22.48, 46, 'images/products/product_29.jpg', 6, 1, '2025-02-27 06:45:37', '2025-02-27 06:46:18'),
(30, 'PRD-0030', 'Producto Juguetes 5', 'Descripción detallada de Producto Juguetes 5', 74.14, 33, 'images/products/product_30.jpg', 6, 1, '2025-02-27 06:45:38', '2025-02-27 06:45:38'),
(31, 'PRD-0031', 'Producto Alimentos 1', 'Descripción detallada de Producto Alimentos 1', 79.26, 74, 'images/products/product_31.jpg', 7, 1, '2025-02-27 06:45:39', '2025-02-27 06:46:17'),
(32, 'PRD-0032', 'Producto Alimentos 2', 'Descripción detallada de Producto Alimentos 2', 86.56, 30, 'images/products/product_32.jpg', 7, 1, '2025-02-27 06:45:40', '2025-02-27 06:46:17'),
(33, 'PRD-0033', 'Producto Alimentos 3', 'Descripción detallada de Producto Alimentos 3', 65.17, 39, 'images/products/product_33.jpg', 7, 1, '2025-02-27 06:45:40', '2025-02-27 06:46:17'),
(34, 'PRD-0034', 'Producto Alimentos 4', 'Descripción detallada de Producto Alimentos 4', 37.11, 42, 'images/products/product_34.jpg', 7, 1, '2025-02-27 06:45:41', '2025-02-27 06:45:41'),
(35, 'PRD-0035', 'Producto Alimentos 5', 'Descripción detallada de Producto Alimentos 5', 95.45, 22, 'images/products/product_35.jpg', 7, 1, '2025-02-27 06:45:42', '2025-02-27 06:46:17'),
(36, 'PRD-0036', 'Producto Bebidas 1', 'Descripción detallada de Producto Bebidas 1', 73.93, 35, 'images/products/product_36.jpg', 8, 1, '2025-02-27 06:45:43', '2025-02-27 06:46:18'),
(37, 'PRD-0037', 'Producto Bebidas 2', 'Descripción detallada de Producto Bebidas 2', 79.74, 60, 'images/products/product_37.jpg', 8, 1, '2025-02-27 06:45:44', '2025-02-27 06:45:44'),
(38, 'PRD-0038', 'Producto Bebidas 3', 'Descripción detallada de Producto Bebidas 3', 89.97, 41, 'images/products/product_38.jpg', 8, 1, '2025-02-27 06:45:45', '2025-02-27 06:46:18'),
(39, 'PRD-0039', 'Producto Bebidas 4', 'Descripción detallada de Producto Bebidas 4', 37.04, 43, 'images/products/product_39.jpg', 8, 1, '2025-02-27 06:45:46', '2025-02-27 06:46:17'),
(40, 'PRD-0040', 'Producto Bebidas 5', 'Descripción detallada de Producto Bebidas 5', 33.16, 55, 'images/products/product_40.jpg', 8, 1, '2025-02-27 06:45:47', '2025-02-27 06:46:17'),
(41, 'PRD-0041', 'Producto Muebles 1', 'Descripción detallada de Producto Muebles 1', 64.83, 6, 'images/products/product_41.jpg', 9, 1, '2025-02-27 06:45:47', '2025-02-27 06:46:18'),
(42, 'PRD-0042', 'Producto Muebles 2', 'Descripción detallada de Producto Muebles 2', 97.50, 12, 'images/products/product_42.jpg', 9, 1, '2025-02-27 06:45:48', '2025-02-27 06:46:18'),
(43, 'PRD-0043', 'Producto Muebles 3', 'Descripción detallada de Producto Muebles 3', 47.34, 90, 'images/products/product_43.jpg', 9, 1, '2025-02-27 06:45:49', '2025-02-27 06:46:18'),
(44, 'PRD-0044', 'Producto Muebles 4', 'Descripción detallada de Producto Muebles 4', 86.80, 68, 'images/products/product_44.jpg', 9, 1, '2025-02-27 06:45:50', '2025-02-27 06:46:17'),
(45, 'PRD-0045', 'Producto Muebles 5', 'Descripción detallada de Producto Muebles 5', 26.70, 59, 'images/products/product_45.jpg', 9, 1, '2025-02-27 06:45:50', '2025-02-27 06:46:17'),
(46, 'PRD-0046', 'Producto Jardín 1', 'Descripción detallada de Producto Jardín 1', 80.11, 25, 'images/products/product_46.jpg', 17, 1, '2025-02-27 06:45:51', '2025-03-15 12:32:30'),
(47, 'PRD-0047', 'Producto Jardín 2', 'Descripción detallada de Producto Jardín 2', 38.80, 86, 'images/products/product_47.jpg', 17, 1, '2025-02-27 06:45:52', '2025-03-15 12:32:30'),
(48, 'PRD-0048', 'Producto Jardín 3', 'Descripción detallada de Producto Jardín 3', 26.98, 58, 'images/products/product_48.jpg', 17, 1, '2025-02-27 06:45:53', '2025-03-15 12:32:30'),
(49, 'PRD-0049', 'Producto Jardín 4', 'Descripción detallada de Producto Jardín 4', 70.79, 54, 'images/products/product_49.jpg', 17, 1, '2025-02-27 06:45:54', '2025-03-15 12:32:30'),
(50, 'PRD-0050', 'Producto Jardín 5', 'Descripción detallada de Producto Jardín 5', 97.91, 47, 'images/products/product_50.jpg', 17, 1, '2025-02-27 06:45:55', '2025-03-15 12:32:30'),
(51, 'PRD-0051', 'Producto Mascotas 1', 'Descripción detallada de Producto Mascotas 1', 41.91, 70, 'images/products/product_51.jpg', 11, 1, '2025-02-27 06:45:56', '2025-02-27 06:46:18'),
(52, 'PRD-0052', 'Producto Mascotas 2', 'Descripción detallada de Producto Mascotas 2', 20.57, 78, 'images/products/product_52.jpg', 11, 1, '2025-02-27 06:45:56', '2025-02-27 06:46:17'),
(53, 'PRD-0053', 'Producto Mascotas 3', 'Descripción detallada de Producto Mascotas 3', 47.90, 7, 'images/products/product_53.jpg', 11, 1, '2025-02-27 06:45:57', '2025-02-27 06:46:18'),
(54, 'PRD-0054', 'Producto Mascotas 4', 'Descripción detallada de Producto Mascotas 4', 61.00, 35, 'images/products/product_54.jpg', 11, 1, '2025-02-27 06:45:58', '2025-02-27 06:46:17'),
(55, 'PRD-0055', 'Producto Mascotas 5', 'Descripción detallada de Producto Mascotas 5', 25.56, 85, 'images/products/product_55.jpg', 11, 1, '2025-02-27 06:45:59', '2025-02-27 06:46:17'),
(56, 'PRD-0056', 'Producto Belleza 1', 'Descripción detallada de Producto Belleza 1', 62.60, 64, 'images/products/product_56.jpg', 12, 1, '2025-02-27 06:46:00', '2025-02-27 06:46:17'),
(57, 'PRD-0057', 'Producto Belleza 2', 'Descripción detallada de Producto Belleza 2', 83.47, 46, 'images/products/product_57.jpg', 12, 1, '2025-02-27 06:46:01', '2025-02-27 06:46:17'),
(58, 'PRD-0058', 'Producto Belleza 3', 'Descripción detallada de Producto Belleza 3', 83.81, 76, 'images/products/product_58.jpg', 12, 1, '2025-02-27 06:46:02', '2025-02-27 06:46:17'),
(59, 'PRD-0059', 'Producto Belleza 4', 'Descripción detallada de Producto Belleza 4', 56.52, 66, 'images/products/product_59.jpg', 12, 1, '2025-02-27 06:46:03', '2025-02-27 06:46:18'),
(60, 'PRD-0060', 'Producto Belleza 5', 'Descripción detallada de Producto Belleza 5', 49.08, 16, 'images/products/product_60.jpg', 12, 1, '2025-02-27 06:46:04', '2025-02-27 06:46:17'),
(61, 'PRD-0061', 'Producto Herramientas 1', 'Descripción detallada de Producto Herramientas 1', 20.57, 75, 'images/products/product_61.jpg', 13, 1, '2025-02-27 06:46:04', '2025-02-27 06:46:17'),
(62, 'PRD-0062', 'Producto Herramientas 2', 'Descripción detallada de Producto Herramientas 2', 55.97, 89, 'images/products/product_62.jpg', 13, 1, '2025-02-27 06:46:05', '2025-02-27 06:46:17'),
(63, 'PRD-0063', 'Producto Herramientas 3', 'Descripción detallada de Producto Herramientas 3', 72.59, 46, 'images/products/product_63.jpg', 13, 1, '2025-02-27 06:46:06', '2025-02-27 06:46:06'),
(64, 'PRD-0064', 'Producto Herramientas 4', 'Descripción detallada de Producto Herramientas 4', 81.99, 76, 'images/products/product_64.jpg', 13, 1, '2025-02-27 06:46:07', '2025-02-27 06:46:17'),
(65, 'PRD-0065', 'Producto Herramientas 5', 'Descripción detallada de Producto Herramientas 5', 29.62, 21, 'images/products/product_65.jpg', 13, 1, '2025-02-27 06:46:07', '2025-02-27 06:46:17'),
(66, 'PRD-0066', 'Producto Automotriz 1', 'Descripción detallada de Producto Automotriz 1', 69.77, 25, 'images/products/product_66.jpg', 14, 1, '2025-02-27 06:46:08', '2025-02-27 06:46:18'),
(67, 'PRD-0067', 'Producto Automotriz 2', 'Descripción detallada de Producto Automotriz 2', 82.44, 72, 'images/products/product_67.jpg', 14, 1, '2025-02-27 06:46:09', '2025-02-27 06:46:18'),
(68, 'PRD-0068', 'Producto Automotriz 3', 'Descripción detallada de Producto Automotriz 3', 84.16, 91, 'images/products/product_68.jpg', 14, 1, '2025-02-27 06:46:10', '2025-02-27 06:46:10'),
(69, 'PRD-0069', 'Producto Automotriz 4', 'Descripción detallada de Producto Automotriz 4', 97.54, 73, 'images/products/product_69.jpg', 14, 1, '2025-02-27 06:46:11', '2025-02-27 06:46:18'),
(70, 'PRD-0070', 'Producto Automotriz 5', 'Descripción detallada de Producto Automotriz 5', 52.34, 71, 'images/products/product_70.jpg', 14, 1, '2025-02-27 06:46:12', '2025-02-27 06:46:18'),
(71, 'PRD-0071', 'Producto Música 1', 'Descripción detallada de Producto Música 1', 87.11, 9, 'images/products/product_71.jpg', 15, 1, '2025-02-27 06:46:13', '2025-02-27 06:46:18'),
(72, 'PRD-0072', 'Producto Música 2', 'Descripción detallada de Producto Música 2', 39.75, 6, 'images/products/product_72.jpg', 15, 1, '2025-02-27 06:46:14', '2025-02-27 06:46:18'),
(73, 'PRD-0073', 'Producto Música 3', 'Descripción detallada de Producto Música 3', 29.90, 25, 'images/products/product_73.jpg', 15, 1, '2025-02-27 06:46:15', '2025-02-27 06:46:18'),
(74, 'PRD-0074', 'Producto Música 4', 'Descripción detallada de Producto Música 4', 38.07, 25, 'images/products/product_74.jpg', 15, 1, '2025-02-27 06:46:16', '2025-02-27 06:46:16'),
(75, 'PRD-0075', 'Producto Música 5', 'Descripción detallada de Producto Música 5', 80.73, 67, 'images/products/product_75.jpg', 15, 1, '2025-02-27 06:46:17', '2025-02-27 06:46:18'),
(76, '3312', 'sporky', 'sadvASDF  DS SDF', 50.00, 6, 'productos/a8kql5hCS5wjJekF10T1WBNuPJIFpqfzbeWA5EvG.png', 1, 1, '2025-03-14 13:03:22', '2025-03-14 13:03:22'),
(77, 'PRD-002', 'Laptop', 'Laptop gaimer', 106000.00, 990, 'productos/lc0GPGgOc36qOfgnF72eOmk6PqT1tlm09SBrLz65.webp', 1, 1, '2025-03-17 08:25:28', '2025-03-17 10:26:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `status` enum('PENDING','PAID','CANCELLED') NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `clients_id` int(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sales`
--

INSERT INTO `sales` (`id`, `code`, `user_id`, `total`, `tax`, `status`, `created_at`, `updated_at`, `clients_id`) VALUES
(1, 'SALE-0001', 1, 284.09, 51.14, 'PAID', '2025-02-27 06:46:17', '2025-02-27 06:46:17', 0),
(2, 'SALE-0002', 1, 179.73, 32.35, 'PAID', '2025-02-22 06:46:17', '2025-02-27 06:46:17', 0),
(3, 'SALE-0003', 1, 3500.27, 630.05, 'PAID', '2025-02-17 06:46:17', '2025-02-27 06:46:17', 0),
(4, 'SALE-0004', 1, 597.10, 107.48, 'PAID', '2025-02-19 06:46:17', '2025-02-27 06:46:17', 0),
(5, 'SALE-0005', 1, 396.74, 71.41, 'PAID', '2025-02-10 06:46:17', '2025-02-27 06:46:17', 0),
(6, 'SALE-0006', 1, 712.85, 128.31, 'PAID', '2025-02-24 06:46:17', '2025-02-27 06:46:17', 0),
(7, 'SALE-0007', 1, 652.32, 117.42, 'PAID', '2025-02-12 06:46:17', '2025-02-27 06:46:17', 0),
(8, 'SALE-0008', 1, 587.90, 105.82, 'PAID', '2025-02-26 06:46:17', '2025-02-27 06:46:17', 0),
(9, 'SALE-0009', 1, 332.76, 59.90, 'PAID', '2025-02-11 06:46:17', '2025-02-27 06:46:17', 0),
(10, 'SALE-0010', 1, 432.80, 77.90, 'PAID', '2025-02-14 06:46:17', '2025-02-27 06:46:17', 0),
(11, 'SALE-0011', 1, 809.32, 145.68, 'PAID', '2025-02-19 06:46:17', '2025-02-27 06:46:17', 0),
(12, 'SALE-0012', 1, 354.10, 63.74, 'PAID', '2025-02-01 06:46:17', '2025-02-27 06:46:17', 0),
(13, 'SALE-0013', 1, 489.55, 88.12, 'PAID', '2025-02-26 06:46:17', '2025-02-27 06:46:17', 0),
(14, 'SALE-0014', 1, 641.78, 115.52, 'PAID', '2025-02-25 06:46:17', '2025-02-27 06:46:17', 0),
(15, 'SALE-0015', 1, 521.44, 93.86, 'PAID', '2025-02-14 06:46:17', '2025-02-27 06:46:17', 0),
(16, 'SALE-0016', 1, 263.37, 47.41, 'PAID', '2025-02-15 06:46:17', '2025-02-27 06:46:17', 0),
(17, 'SALE-0017', 1, 1076.71, 193.81, 'PAID', '2025-02-07 06:46:17', '2025-02-27 06:46:17', 0),
(18, 'SALE-0018', 1, 429.94, 77.39, 'PAID', '2025-01-31 06:46:17', '2025-02-27 06:46:17', 0),
(19, 'SALE-0019', 1, 759.91, 136.78, 'PAID', '2025-02-04 06:46:17', '2025-02-27 06:46:17', 0),
(20, 'SALE-0020', 1, 2610.41, 469.87, 'PAID', '2025-02-24 06:46:17', '2025-02-27 06:46:17', 0),
(21, 'SALE-0021', 1, 293.73, 52.87, 'PAID', '2025-02-06 06:46:17', '2025-02-27 06:46:17', 0),
(22, 'SALE-0022', 1, 38.80, 6.98, 'PAID', '2025-02-25 06:46:17', '2025-02-27 06:46:17', 0),
(23, 'SALE-0023', 1, 202.80, 36.50, 'PAID', '2025-02-13 06:46:17', '2025-02-27 06:46:17', 0),
(24, 'SALE-0024', 1, 253.11, 45.56, 'PAID', '2025-01-30 06:46:17', '2025-02-27 06:46:17', 0),
(25, 'SALE-0025', 1, 381.80, 68.72, 'PAID', '2025-02-24 06:46:17', '2025-02-27 06:46:17', 0),
(26, 'SALE-0026', 1, 812.07, 146.17, 'PAID', '2025-02-26 06:46:17', '2025-02-27 06:46:17', 0),
(27, 'SALE-0027', 1, 463.93, 83.51, 'PAID', '2025-02-25 06:46:17', '2025-02-27 06:46:17', 0),
(28, 'SALE-0028', 1, 253.79, 45.68, 'PAID', '2025-02-20 06:46:17', '2025-02-27 06:46:17', 0),
(29, 'SALE-0029', 1, 1908.15, 343.47, 'PAID', '2025-02-21 06:46:17', '2025-02-27 06:46:17', 0),
(30, 'SALE-0030', 1, 291.39, 52.45, 'PAID', '2025-02-13 06:46:17', '2025-02-27 06:46:17', 0),
(31, 'SALE-0031', 1, 206.46, 37.16, 'PAID', '2025-02-04 06:46:17', '2025-02-27 06:46:17', 0),
(32, 'SALE-0032', 1, 597.02, 107.46, 'PAID', '2025-02-15 06:46:17', '2025-02-27 06:46:17', 0),
(33, 'SALE-0033', 1, 715.40, 128.77, 'PAID', '2025-02-06 06:46:17', '2025-02-27 06:46:17', 0),
(34, 'SALE-0034', 1, 578.87, 104.20, 'PAID', '2025-02-16 06:46:17', '2025-02-27 06:46:17', 0),
(35, 'SALE-0035', 1, 466.50, 83.97, 'PAID', '2025-02-13 06:46:17', '2025-02-27 06:46:17', 0),
(36, 'SALE-0036', 1, 709.02, 127.62, 'PAID', '2025-02-22 06:46:17', '2025-02-27 06:46:17', 0),
(37, 'SALE-0037', 1, 561.52, 101.07, 'PAID', '2025-02-18 06:46:17', '2025-02-27 06:46:18', 0),
(38, 'SALE-0038', 1, 91.90, 16.54, 'PAID', '2025-02-18 06:46:18', '2025-02-27 06:46:18', 0),
(39, 'SALE-0039', 1, 322.92, 58.13, 'PAID', '2025-02-16 06:46:18', '2025-02-27 06:46:18', 0),
(40, 'SALE-0040', 1, 194.49, 35.01, 'PAID', '2025-02-17 06:46:18', '2025-02-27 06:46:18', 0),
(41, 'SALE-0041', 1, 179.97, 32.39, 'PAID', '2025-01-28 06:46:18', '2025-02-27 06:46:18', 0),
(42, 'SALE-0042', 1, 970.14, 174.63, 'PAID', '2025-02-23 06:46:18', '2025-02-27 06:46:18', 0),
(43, 'SALE-0043', 1, 187.20, 33.70, 'PAID', '2025-02-11 06:46:18', '2025-02-27 06:46:18', 0),
(44, 'SALE-0044', 1, 1330.04, 239.41, 'PAID', '2025-02-13 06:46:18', '2025-02-27 06:46:18', 0),
(45, 'SALE-0045', 1, 1157.92, 208.43, 'PAID', '2025-02-14 06:46:18', '2025-02-27 06:46:18', 0),
(46, 'SALE-0046', 1, 1377.86, 248.01, 'PAID', '2025-02-23 06:46:18', '2025-02-27 06:46:18', 0),
(47, 'SALE-0047', 1, 269.94, 48.59, 'PAID', '2025-02-20 06:46:18', '2025-02-27 06:46:18', 0),
(48, 'SALE-0048', 1, 751.72, 135.31, 'PAID', '2025-02-23 06:46:18', '2025-02-27 06:46:18', 0),
(49, 'SALE-0049', 1, 910.59, 163.91, 'PAID', '2025-01-28 06:46:18', '2025-02-27 06:46:18', 0),
(50, 'SALE-0050', 1, 87.11, 15.68, 'PAID', '2025-02-16 06:46:18', '2025-02-27 06:46:18', 0),
(56, 'V-20250316-0051', 5, 1299.99, 234.00, 'PAID', '2025-03-17 04:15:50', '2025-03-17 04:15:50', 0),
(57, 'V-20250316-0052', 5, 79.99, 14.40, 'PAID', '2025-03-17 04:16:47', '2025-03-17 04:16:47', 0),
(58, 'V-20250316-0053', 5, 1299.99, 234.00, 'PAID', '2025-03-17 04:18:40', '2025-03-17 04:18:40', 0),
(59, 'V-20250316-0054', 5, 1299.99, 234.00, 'PAID', '2025-03-17 04:31:14', '2025-03-17 04:31:14', 0),
(60, 'V-20250316-0055', 5, 1299.99, 234.00, 'PAID', '2025-03-17 04:33:23', '2025-03-17 04:33:23', 0),
(61, 'V-20250316-0056', 5, 1299.99, 234.00, 'PAID', '2025-03-17 04:34:19', '2025-03-17 04:34:19', 0),
(62, 'V-20250316-0057', 5, 14999.86, 2699.97, 'PAID', '2025-03-17 05:12:05', '2025-03-17 05:12:05', 0),
(63, 'V-20250317-0058', 5, 1799.98, 324.00, 'PAID', '2025-03-17 07:29:43', '2025-03-17 07:29:43', 0),
(64, 'V-20250317-0059', 5, 18199.86, 3275.97, 'PAID', '2025-03-17 08:01:43', '2025-03-17 08:01:43', 0),
(65, 'V-20250317-0060', 5, 3999.92, 719.99, 'PAID', '2025-03-17 08:16:02', '2025-03-17 08:16:02', 0),
(66, 'V-20250317-0061', 5, 1060000.00, 190800.00, 'PAID', '2025-03-17 10:26:46', '2025-03-17 10:26:46', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sale_details`
--

CREATE TABLE `sale_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sale_details`
--

INSERT INTO `sale_details` (`id`, `sale_id`, `product_id`, `quantity`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 25, 2, 46.80, 93.60, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(2, 1, 28, 2, 54.25, 108.50, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(3, 1, 64, 1, 81.99, 81.99, '2025-02-27 06:46:17', '2025-02-27 06:46:17'),
(5, 2, 72, 1, 39.75, 39.75, '2025-02-22 06:46:17', '2025-02-22 06:46:17'),
(6, 3, 1, 5, 599.99, 2999.95, '2025-02-17 06:46:17', '2025-02-17 06:46:17'),
(7, 3, 40, 2, 33.16, 66.32, '2025-02-17 06:46:17', '2025-02-17 06:46:17'),
(8, 3, 44, 5, 86.80, 434.00, '2025-02-17 06:46:17', '2025-02-17 06:46:17'),
(9, 4, 23, 4, 75.73, 302.92, '2025-02-19 06:46:17', '2025-02-19 06:46:17'),
(10, 4, 39, 4, 37.04, 148.16, '2025-02-19 06:46:17', '2025-02-19 06:46:17'),
(11, 4, 47, 3, 38.80, 116.40, '2025-02-19 06:46:17', '2025-02-19 06:46:17'),
(12, 4, 65, 1, 29.62, 29.62, '2025-02-19 06:46:17', '2025-02-19 06:46:17'),
(13, 5, 13, 5, 34.99, 174.95, '2025-02-10 06:46:17', '2025-02-10 06:46:17'),
(14, 5, 36, 3, 73.93, 221.79, '2025-02-10 06:46:17', '2025-02-10 06:46:17'),
(15, 6, 9, 3, 129.99, 389.97, '2025-02-24 06:46:17', '2025-02-24 06:46:17'),
(16, 6, 47, 4, 38.80, 155.20, '2025-02-24 06:46:17', '2025-02-24 06:46:17'),
(17, 6, 50, 1, 97.91, 97.91, '2025-02-24 06:46:17', '2025-02-24 06:46:17'),
(18, 6, 66, 1, 69.77, 69.77, '2025-02-24 06:46:17', '2025-02-24 06:46:17'),
(19, 7, 33, 4, 65.17, 260.68, '2025-02-12 06:46:17', '2025-02-12 06:46:17'),
(20, 7, 50, 4, 97.91, 391.64, '2025-02-12 06:46:17', '2025-02-12 06:46:17'),
(21, 8, 31, 5, 79.26, 396.30, '2025-02-26 06:46:17', '2025-02-26 06:46:17'),
(22, 8, 53, 4, 47.90, 191.60, '2025-02-26 06:46:17', '2025-02-26 06:46:17'),
(23, 9, 13, 4, 34.99, 139.96, '2025-02-11 06:46:17', '2025-02-11 06:46:17'),
(24, 9, 27, 4, 48.20, 192.80, '2025-02-11 06:46:17', '2025-02-11 06:46:17'),
(25, 10, 54, 5, 61.00, 305.00, '2025-02-14 06:46:17', '2025-02-14 06:46:17'),
(26, 10, 55, 5, 25.56, 127.80, '2025-02-14 06:46:17', '2025-02-14 06:46:17'),
(27, 11, 8, 3, 89.99, 269.97, '2025-02-19 06:46:17', '2025-02-19 06:46:17'),
(28, 11, 54, 2, 61.00, 122.00, '2025-02-19 06:46:17', '2025-02-19 06:46:17'),
(29, 11, 57, 5, 83.47, 417.35, '2025-02-19 06:46:17', '2025-02-19 06:46:17'),
(30, 12, 24, 4, 66.31, 265.24, '2025-02-01 06:46:17', '2025-02-01 06:46:17'),
(31, 12, 65, 3, 29.62, 88.86, '2025-02-01 06:46:17', '2025-02-01 06:46:17'),
(32, 13, 50, 5, 97.91, 489.55, '2025-02-26 06:46:17', '2025-02-26 06:46:17'),
(33, 14, 45, 5, 26.70, 133.50, '2025-02-25 06:46:17', '2025-02-25 06:46:17'),
(34, 14, 60, 4, 49.08, 196.32, '2025-02-25 06:46:17', '2025-02-25 06:46:17'),
(35, 14, 66, 1, 69.77, 69.77, '2025-02-25 06:46:17', '2025-02-25 06:46:17'),
(36, 14, 75, 3, 80.73, 242.19, '2025-02-25 06:46:17', '2025-02-25 06:46:17'),
(37, 15, 11, 2, 39.99, 79.98, '2025-02-14 06:46:17', '2025-02-14 06:46:17'),
(38, 15, 31, 3, 79.26, 237.78, '2025-02-14 06:46:17', '2025-02-14 06:46:17'),
(39, 15, 33, 1, 65.17, 65.17, '2025-02-14 06:46:17', '2025-02-14 06:46:17'),
(40, 15, 59, 1, 56.52, 56.52, '2025-02-14 06:46:17', '2025-02-14 06:46:17'),
(41, 15, 64, 1, 81.99, 81.99, '2025-02-14 06:46:17', '2025-02-14 06:46:17'),
(42, 16, 29, 3, 22.48, 67.44, '2025-02-15 06:46:17', '2025-02-15 06:46:17'),
(43, 16, 55, 3, 25.56, 76.68, '2025-02-15 06:46:17', '2025-02-15 06:46:17'),
(44, 16, 72, 3, 39.75, 119.25, '2025-02-15 06:46:17', '2025-02-15 06:46:17'),
(45, 17, 32, 5, 86.56, 432.80, '2025-02-07 06:46:17', '2025-02-07 06:46:17'),
(46, 17, 52, 2, 20.57, 41.14, '2025-02-07 06:46:17', '2025-02-07 06:46:17'),
(47, 17, 62, 5, 55.97, 279.85, '2025-02-07 06:46:17', '2025-02-07 06:46:17'),
(48, 17, 75, 4, 80.73, 322.92, '2025-02-07 06:46:17', '2025-02-07 06:46:17'),
(49, 18, 12, 3, 45.99, 137.97, '2025-01-31 06:46:17', '2025-01-31 06:46:17'),
(50, 18, 15, 5, 29.99, 149.95, '2025-01-31 06:46:17', '2025-01-31 06:46:17'),
(51, 18, 43, 3, 47.34, 142.02, '2025-01-31 06:46:17', '2025-01-31 06:46:17'),
(53, 19, 13, 5, 34.99, 174.95, '2025-02-04 06:46:17', '2025-02-04 06:46:17'),
(54, 19, 54, 5, 61.00, 305.00, '2025-02-04 06:46:17', '2025-02-04 06:46:17'),
(55, 20, 3, 4, 399.99, 1599.96, '2025-02-24 06:46:17', '2025-02-24 06:46:17'),
(56, 20, 42, 4, 97.50, 390.00, '2025-02-24 06:46:17', '2025-02-24 06:46:17'),
(57, 20, 52, 5, 20.57, 102.85, '2025-02-24 06:46:17', '2025-02-24 06:46:17'),
(58, 20, 69, 5, 97.54, 487.70, '2025-02-24 06:46:17', '2025-02-24 06:46:17'),
(59, 20, 73, 1, 29.90, 29.90, '2025-02-24 06:46:17', '2025-02-24 06:46:17'),
(60, 21, 50, 3, 97.91, 293.73, '2025-02-06 06:46:17', '2025-02-06 06:46:17'),
(61, 22, 47, 1, 38.80, 38.80, '2025-02-25 06:46:17', '2025-02-25 06:46:17'),
(62, 23, 47, 2, 38.80, 77.60, '2025-02-13 06:46:17', '2025-02-13 06:46:17'),
(63, 23, 56, 2, 62.60, 125.20, '2025-02-13 06:46:17', '2025-02-13 06:46:17'),
(64, 24, 5, 1, 79.99, 79.99, '2025-01-30 06:46:17', '2025-01-30 06:46:17'),
(65, 24, 32, 2, 86.56, 173.12, '2025-01-30 06:46:17', '2025-01-30 06:46:17'),
(66, 25, 35, 4, 95.45, 381.80, '2025-02-24 06:46:17', '2025-02-24 06:46:17'),
(67, 26, 19, 2, 149.99, 299.98, '2025-02-26 06:46:17', '2025-02-26 06:46:17'),
(68, 26, 52, 2, 20.57, 41.14, '2025-02-26 06:46:17', '2025-02-26 06:46:17'),
(69, 26, 54, 1, 61.00, 61.00, '2025-02-26 06:46:17', '2025-02-26 06:46:17'),
(70, 26, 64, 5, 81.99, 409.95, '2025-02-26 06:46:17', '2025-02-26 06:46:17'),
(71, 27, 36, 1, 73.93, 73.93, '2025-02-25 06:46:17', '2025-02-25 06:46:17'),
(72, 27, 42, 4, 97.50, 390.00, '2025-02-25 06:46:17', '2025-02-25 06:46:17'),
(73, 28, 51, 3, 41.91, 125.73, '2025-02-20 06:46:17', '2025-02-20 06:46:17'),
(74, 28, 60, 2, 49.08, 98.16, '2025-02-20 06:46:17', '2025-02-20 06:46:17'),
(75, 28, 73, 1, 29.90, 29.90, '2025-02-20 06:46:17', '2025-02-20 06:46:17'),
(76, 29, 1, 2, 599.99, 1199.98, '2025-02-21 06:46:17', '2025-02-21 06:46:17'),
(77, 29, 7, 5, 49.99, 249.95, '2025-02-21 06:46:17', '2025-02-21 06:46:17'),
(78, 29, 55, 1, 25.56, 25.56, '2025-02-21 06:46:17', '2025-02-21 06:46:17'),
(79, 29, 58, 1, 83.81, 83.81, '2025-02-21 06:46:17', '2025-02-21 06:46:17'),
(80, 29, 66, 5, 69.77, 348.85, '2025-02-21 06:46:17', '2025-02-21 06:46:17'),
(81, 30, 12, 1, 45.99, 45.99, '2025-02-13 06:46:17', '2025-02-13 06:46:17'),
(82, 30, 60, 5, 49.08, 245.40, '2025-02-13 06:46:17', '2025-02-13 06:46:17'),
(83, 31, 51, 3, 41.91, 125.73, '2025-02-04 06:46:17', '2025-02-04 06:46:17'),
(84, 31, 75, 1, 80.73, 80.73, '2025-02-04 06:46:17', '2025-02-04 06:46:17'),
(85, 32, 7, 4, 49.99, 199.96, '2025-02-15 06:46:17', '2025-02-15 06:46:17'),
(86, 32, 41, 5, 64.83, 324.15, '2025-02-15 06:46:17', '2025-02-15 06:46:17'),
(87, 32, 61, 1, 20.57, 20.57, '2025-02-15 06:46:17', '2025-02-15 06:46:17'),
(88, 32, 70, 1, 52.34, 52.34, '2025-02-15 06:46:17', '2025-02-15 06:46:17'),
(89, 33, 62, 5, 55.97, 279.85, '2025-02-06 06:46:17', '2025-02-06 06:46:17'),
(90, 33, 71, 5, 87.11, 435.55, '2025-02-06 06:46:17', '2025-02-06 06:46:17'),
(91, 34, 24, 5, 66.31, 331.55, '2025-02-16 06:46:17', '2025-02-16 06:46:17'),
(92, 34, 67, 3, 82.44, 247.32, '2025-02-16 06:46:17', '2025-02-16 06:46:17'),
(93, 35, 18, 5, 39.99, 199.95, '2025-02-13 06:46:17', '2025-02-13 06:46:17'),
(94, 35, 21, 3, 88.85, 266.55, '2025-02-13 06:46:17', '2025-02-13 06:46:17'),
(95, 36, 31, 5, 79.26, 396.30, '2025-02-22 06:46:17', '2025-02-22 06:46:17'),
(96, 36, 41, 4, 64.83, 259.32, '2025-02-22 06:46:17', '2025-02-22 06:46:17'),
(97, 36, 45, 2, 26.70, 53.40, '2025-02-22 06:46:17', '2025-02-22 06:46:17'),
(98, 37, 26, 4, 66.29, 265.16, '2025-02-18 06:46:17', '2025-02-18 06:46:17'),
(99, 37, 27, 1, 48.20, 48.20, '2025-02-18 06:46:17', '2025-02-18 06:46:17'),
(100, 37, 50, 2, 97.91, 195.82, '2025-02-18 06:46:17', '2025-02-18 06:46:17'),
(101, 37, 70, 1, 52.34, 52.34, '2025-02-18 06:46:17', '2025-02-18 06:46:17'),
(102, 38, 7, 1, 49.99, 49.99, '2025-02-18 06:46:18', '2025-02-18 06:46:18'),
(103, 38, 51, 1, 41.91, 41.91, '2025-02-18 06:46:18', '2025-02-18 06:46:18'),
(104, 39, 75, 4, 80.73, 322.92, '2025-02-16 06:46:18', '2025-02-16 06:46:18'),
(105, 40, 41, 3, 64.83, 194.49, '2025-02-17 06:46:18', '2025-02-17 06:46:18'),
(106, 41, 14, 3, 59.99, 179.97, '2025-01-28 06:46:18', '2025-01-28 06:46:18'),
(107, 42, 17, 4, 89.99, 359.96, '2025-02-23 06:46:18', '2025-02-23 06:46:18'),
(108, 42, 26, 2, 66.29, 132.58, '2025-02-23 06:46:18', '2025-02-23 06:46:18'),
(109, 42, 42, 2, 97.50, 195.00, '2025-02-23 06:46:18', '2025-02-23 06:46:18'),
(110, 42, 59, 5, 56.52, 282.60, '2025-02-23 06:46:18', '2025-02-23 06:46:18'),
(111, 43, 25, 4, 46.80, 187.20, '2025-02-11 06:46:18', '2025-02-11 06:46:18'),
(112, 44, 5, 5, 79.99, 399.95, '2025-02-13 06:46:18', '2025-02-13 06:46:18'),
(113, 44, 38, 5, 89.97, 449.85, '2025-02-13 06:46:18', '2025-02-13 06:46:18'),
(114, 44, 43, 4, 47.34, 189.36, '2025-02-13 06:46:18', '2025-02-13 06:46:18'),
(115, 44, 53, 2, 47.90, 95.80, '2025-02-13 06:46:18', '2025-02-13 06:46:18'),
(116, 44, 69, 2, 97.54, 195.08, '2025-02-13 06:46:18', '2025-02-13 06:46:18'),
(117, 45, 26, 5, 66.29, 331.45, '2025-02-14 06:46:18', '2025-02-14 06:46:18'),
(118, 45, 36, 2, 73.93, 147.86, '2025-02-14 06:46:18', '2025-02-14 06:46:18'),
(119, 45, 66, 5, 69.77, 348.85, '2025-02-14 06:46:18', '2025-02-14 06:46:18'),
(120, 45, 67, 4, 82.44, 329.76, '2025-02-14 06:46:18', '2025-02-14 06:46:18'),
(121, 46, 20, 2, 499.99, 999.98, '2025-02-23 06:46:18', '2025-02-23 06:46:18'),
(122, 46, 21, 4, 88.85, 355.40, '2025-02-23 06:46:18', '2025-02-23 06:46:18'),
(123, 46, 29, 1, 22.48, 22.48, '2025-02-23 06:46:18', '2025-02-23 06:46:18'),
(124, 47, 7, 3, 49.99, 149.97, '2025-02-20 06:46:18', '2025-02-20 06:46:18'),
(125, 47, 18, 3, 39.99, 119.97, '2025-02-20 06:46:18', '2025-02-20 06:46:18'),
(126, 48, 7, 4, 49.99, 199.96, '2025-02-23 06:46:18', '2025-02-23 06:46:18'),
(127, 48, 14, 3, 59.99, 179.97, '2025-02-23 06:46:18', '2025-02-23 06:46:18'),
(128, 48, 18, 4, 39.99, 159.96, '2025-02-23 06:46:18', '2025-02-23 06:46:18'),
(129, 48, 22, 3, 70.61, 211.83, '2025-02-23 06:46:18', '2025-02-23 06:46:18'),
(130, 49, 11, 2, 39.99, 79.98, '2025-01-28 06:46:18', '2025-01-28 06:46:18'),
(131, 49, 17, 4, 89.99, 359.96, '2025-01-28 06:46:18', '2025-01-28 06:46:18'),
(132, 49, 70, 5, 52.34, 261.70, '2025-01-28 06:46:18', '2025-01-28 06:46:18'),
(133, 49, 72, 3, 39.75, 119.25, '2025-01-28 06:46:18', '2025-01-28 06:46:18'),
(134, 49, 73, 3, 29.90, 89.70, '2025-01-28 06:46:18', '2025-01-28 06:46:18'),
(135, 50, 71, 1, 87.11, 87.11, '2025-02-16 06:46:18', '2025-02-16 06:46:18'),
(136, 56, 2, 1, 1299.99, 1299.99, '2025-03-17 04:15:50', '2025-03-17 04:15:50'),
(137, 57, 5, 1, 79.99, 79.99, '2025-03-17 04:16:47', '2025-03-17 04:16:47'),
(138, 58, 2, 1, 1299.99, 1299.99, '2025-03-17 04:18:40', '2025-03-17 04:18:40'),
(139, 59, 2, 1, 1299.99, 1299.99, '2025-03-17 04:31:14', '2025-03-17 04:31:14'),
(140, 60, 2, 1, 1299.99, 1299.99, '2025-03-17 04:33:23', '2025-03-17 04:33:23'),
(141, 61, 2, 1, 1299.99, 1299.99, '2025-03-17 04:34:19', '2025-03-17 04:34:19'),
(142, 62, 2, 10, 1299.99, 12999.90, '2025-03-17 05:12:05', '2025-03-17 05:12:05'),
(143, 62, 20, 4, 499.99, 1999.96, '2025-03-17 05:12:05', '2025-03-17 05:12:05'),
(144, 63, 2, 1, 1299.99, 1299.99, '2025-03-17 07:29:43', '2025-03-17 07:29:43'),
(145, 63, 20, 1, 499.99, 499.99, '2025-03-17 07:29:43', '2025-03-17 07:29:43'),
(146, 64, 2, 14, 1299.99, 18199.86, '2025-03-17 08:01:43', '2025-03-17 08:01:43'),
(147, 65, 20, 8, 499.99, 3999.92, '2025-03-17 08:16:02', '2025-03-17 08:16:02'),
(148, 66, 77, 10, 106000.00, 1060000.00, '2025-03-17 10:26:46', '2025-03-17 10:26:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `Legal Compliance` varchar(200) NOT NULL,
  `General Supplier Profile` varchar(200) NOT NULL,
  `Price` int(15) NOT NULL,
  `Technical Capability` varchar(200) NOT NULL,
  `Technology and Infrastructure` varchar(200) NOT NULL,
  `Performance and Service Level` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `Legal Compliance`, `General Supplier Profile`, `Price`, `Technical Capability`, `Technology and Infrastructure`, `Performance and Service Level`) VALUES
(0, 'fwgfadfgaefgafedg', 'fegeFGAEFG', 'AEFGAEDFGAEFG', 2147483647, 'VGCBMNFZSGRHDGFRH', 'GDHDGFHDFGHDGFH', 'GFDXH SGFRHSGFRH');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', '2025-02-27 06:45:11', '$2y$10$z332dJiMXI.tcwa98zf8X.tI8i7XfHmVXbdNj5HApREkH1xv7e7nm', NULL, '2025-02-27 06:45:11', '2025-02-27 06:45:11'),
(2, 'Juan Vendedor', 'juan@example.com', '2025-02-27 06:45:11', '$2y$10$RcDp4QVN.qWIjCAc3JdHl.CAhTxhr/lV6Qgq7ncoenE0XNtSe4HnS', NULL, '2025-02-27 06:45:12', '2025-02-27 06:45:12'),
(3, 'María Supervisora', 'maria@example.com', '2025-02-27 06:45:11', '$2y$10$KDVg1QCBr066WJrNURe3IO3PcMKwZ1L1enxHF7ksRjfQka7ALBrUG', NULL, '2025-02-27 06:45:12', '2025-02-27 06:45:12'),
(4, 'Carlos Vendedor', 'carlos@example.com', '2025-02-27 06:45:12', '$2y$10$XKmcmcfpwa4oyS4321Pn2.U5JR9.K2WLAT6CxTH3ey1GgjBLln9Ra', NULL, '2025-02-27 06:45:12', '2025-02-27 06:45:12'),
(5, 'Juan Carlos Andres Hernandez', 'jcarlos61200@gmail.com', NULL, '$2y$10$7RlFjmluPpu6gSmsGDUMcOO80Dx3vi/vVcVRTxJR9J9rctqCBRhL2', NULL, '2025-02-27 07:14:55', '2025-02-27 07:14:55'),
(6, 'prueba', 'andy12044@hotmail.com', NULL, '$2y$10$NUKa157554cMpi.q76tshOOfY7bb/MkFLXxiwH2L2mQR8848A4LuO', NULL, '2025-03-16 12:00:22', '2025-03-16 12:00:22');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD UNIQUE KEY `customers_dni_unique` (`dni`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_code_unique` (`code`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sales_code_unique` (`code`),
  ADD KEY `sales_user_id_foreign` (`user_id`),
  ADD KEY `clients_id` (`clients_id`);

--
-- Indices de la tabla `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_details_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_details_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `sale_details`
--
ALTER TABLE `sale_details`
  ADD CONSTRAINT `sale_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `sale_details_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
