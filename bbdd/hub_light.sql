-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: hl999.dinaserver.com:3306
-- Generation Time: Jul 19, 2021 at 12:57 PM
-- Server version: 10.1.48-MariaDB-0+deb9u2
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hub_light`
--

-- --------------------------------------------------------

--
-- Table structure for table `analitiques_generals`
--

CREATE TABLE `analitiques_generals` (
  `id` int(11) NOT NULL,
  `usuaris_suspes` int(11) NOT NULL DEFAULT '0',
  `usuaris_actius` int(11) NOT NULL DEFAULT '0',
  `usuaris_enperill` int(11) NOT NULL DEFAULT '0',
  `contenido_total` int(11) NOT NULL DEFAULT '0',
  `missatges_totals` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Dumping data for table `analitiques_generals`
--

INSERT INTO `analitiques_generals` (`id`, `usuaris_suspes`, `usuaris_actius`, `usuaris_enperill`, `contenido_total`, `missatges_totals`, `created_at`, `updated_at`) VALUES
(14, 0, 2, 0, 2, 3, '2021-05-27 21:36:33', '2021-05-27 20:27:15'),
(15, 0, 2, 0, 6, 6, '2021-05-28 04:15:54', '2021-05-28 17:38:58'),
(16, 0, 2, 0, 9, 41, '2021-05-29 04:57:20', '2021-05-29 12:14:58'),
(17, 0, 2, 0, 9, 45, '2021-05-30 04:44:54', '2021-05-30 18:06:39'),
(18, 0, 2, 0, 27, 66, '2021-05-31 04:13:01', '2021-06-19 18:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `avis`
--

CREATE TABLE `avis` (
  `id` int(10) UNSIGNED NOT NULL,
  `explicacio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gravetat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `avis`
--

INSERT INTO `avis` (`id`, `explicacio`, `gravetat`, `created_at`, `updated_at`) VALUES
(1, 'Uno o varios comentarios ofensivos', '2', '2021-05-05 16:09:25', '2021-05-05 16:09:25'),
(2, 'Contenido inapropiado', '5', '2021-05-05 17:30:52', '2021-05-05 17:30:52');

-- --------------------------------------------------------

--
-- Table structure for table `avis_usuari`
--

CREATE TABLE `avis_usuari` (
  `id` int(11) NOT NULL,
  `id_usuari` int(10) UNSIGNED NOT NULL,
  `id_avis` int(10) UNSIGNED NOT NULL,
  `acceptat` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `removed` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `avis_usuari`
--

INSERT INTO `avis_usuari` (`id`, `id_usuari`, `id_avis`, `acceptat`, `removed`, `created_at`, `updated_at`) VALUES
(292, 5, 2, '0', '0', '2021-05-29 07:21:18', '2021-05-29 07:21:18'),
(293, 5, 2, '0', '0', '2021-05-29 07:21:19', '2021-05-29 07:21:19'),
(294, 5, 2, '0', '0', '2021-05-29 07:22:08', '2021-05-29 07:22:08'),
(295, 14, 1, '0', '0', '2021-05-29 09:28:36', '2021-05-29 09:28:36'),
(296, 14, 1, '0', '0', '2021-05-29 09:28:38', '2021-05-29 09:28:38'),
(321, 34, 1, '1', '0', '2021-06-08 04:53:18', '2021-06-08 04:53:28'),
(322, 34, 2, '1', '0', '2021-06-08 04:53:20', '2021-06-08 04:53:26'),
(323, 46, 1, '1', '0', '2021-06-17 08:58:29', '2021-06-17 08:58:38'),
(324, 46, 2, '1', '0', '2021-06-17 08:58:31', '2021-06-17 08:58:37'),
(325, 39, 1, '1', '0', '2021-06-17 11:55:45', '2021-06-17 11:55:54'),
(326, 39, 2, '1', '0', '2021-06-17 11:55:47', '2021-06-17 11:55:52'),
(328, 41, 2, '1', '0', '2021-06-17 14:15:28', '2021-06-17 14:18:56'),
(330, 41, 1, '1', '0', '2021-06-17 14:19:31', '2021-06-17 14:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `contingut`
--

CREATE TABLE `contingut` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `portada` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_copyright` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `majoria_edat` tinyint(1) NOT NULL DEFAULT '0',
  `reportat` tinyint(1) NOT NULL DEFAULT '0',
  `propietari` int(10) UNSIGNED NOT NULL,
  `tipus_contingut` int(10) UNSIGNED NOT NULL,
  `drets_autor` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contingut`
--

INSERT INTO `contingut` (`id`, `titulo`, `portada`, `link_copyright`, `url`, `descripcio`, `majoria_edat`, `reportat`, `propietari`, `tipus_contingut`, `drets_autor`, `created_at`, `updated_at`) VALUES
(86, 'Κata Τon Daimona Εaytoy', '1622154219-AngelNovo2.jpg', NULL, '1622154219-AngelNovo2.mp3', 'Una de las canciones de rotting christ', 0, 0, 14, 3, 2, '2021-05-27 20:23:39', '2021-06-17 14:23:31'),
(88, 'Zombie Conductor', NULL, NULL, '1622203067-Llabreso.jpg', 'Es un zombie que conduce', 0, 0, 5, 1, 2, '2021-05-28 09:57:47', '2021-05-28 09:57:47'),
(91, 'Nito burrito', NULL, NULL, '1622203693-Llabreso.jpg', NULL, 0, 0, 5, 1, 2, '2021-05-28 10:08:13', '2021-05-28 10:08:13'),
(94, 'Una partidita mas', NULL, NULL, '1622204335-AngelNovo2.jpg', 'Venga ma, solo una mas', 0, 0, 14, 1, 2, '2021-05-28 10:18:55', '2021-05-28 10:18:55'),
(95, 'Walking de felicidad', '1622204456-Llabreso.jpg', NULL, '1622204456-Llabreso.mp4', NULL, 0, 0, 5, 4, 2, '2021-05-28 10:20:56', '2021-05-28 10:20:56'),
(96, 'Power', NULL, NULL, '1622223356-Llabreso.png', NULL, 0, 0, 5, 1, 2, '2021-05-28 15:35:56', '2021-05-28 15:35:56'),
(99, 'Andorra', NULL, NULL, '1622224180-Llabreso.jpg', NULL, 0, 0, 5, 1, 2, '2021-05-28 15:49:40', '2021-05-28 15:49:40'),
(100, 'Nito no burrito', NULL, NULL, '1622224292-Llabreso.jpg', NULL, 0, 0, 5, 1, 2, '2021-05-28 15:51:32', '2021-05-28 15:51:32'),
(101, 'Solaire Millonario', NULL, NULL, '1622224382-Llabreso.jpg', 'Solaire millonario tira monedas a un vagamundo y pasa esto', 0, 0, 5, 1, 2, '2021-05-28 15:53:02', '2021-05-28 15:53:02'),
(102, 'Shadow of the tomb raider', NULL, NULL, '1622271768-AngelNovo2.png', 'Esta fué mi escena preferida de todo el juego', 0, 0, 14, 1, 2, '2021-05-29 05:02:48', '2021-05-29 05:02:48'),
(103, 'Ay joliiiin', NULL, NULL, '1622272887-AngelNovo2.jpg', 'Otia un pájaro con brazos', 0, 0, 14, 1, 2, '2021-05-29 05:21:27', '2021-05-29 05:21:27'),
(104, '✨✨✨', NULL, NULL, '1622277614-Carmen.jpg', NULL, 0, 0, 37, 1, 2, '2021-05-29 06:40:14', '2021-05-29 06:40:14'),
(105, 'Jaja no kapasao', NULL, NULL, '1622278567-Carmen.jpg', NULL, 0, 0, 37, 1, 2, '2021-05-29 06:56:07', '2021-05-29 06:56:07'),
(106, 'God hug life', NULL, NULL, '1622278615-LeoAlcaraz.jpg', NULL, 0, 0, 36, 1, 2, '2021-05-29 06:56:55', '2021-05-29 06:56:55'),
(107, 'Super Smash Canción', '1622278857-Llabreso.jpg', NULL, '1622278857-Llabreso.mp3', 'Es la canción de super smash', 0, 0, 5, 3, 2, '2021-05-29 07:00:57', '2021-05-29 07:00:57'),
(108, 'Freezing moon', '1622279143-AngelNovo2.jpg', NULL, '1622279143-AngelNovo2.mp3', 'Mayhem', 0, 0, 14, 3, 2, '2021-05-29 07:05:43', '2021-05-29 07:05:43'),
(109, 'Complain me', '1622280966-LeoAlcaraz.jpg', NULL, '1622280966-LeoAlcaraz.mp3', NULL, 0, 0, 36, 3, 2, '2021-05-29 07:36:06', '2021-05-29 07:36:06'),
(115, 'test email con espacio', NULL, NULL, '1622284055-testemail.jpg', '-Noo, los hombres que miran-Joan', 1, 0, 39, 1, 2, '2021-05-29 08:27:35', '2021-05-31 05:59:41'),
(123, 'No sé qué anime és', NULL, NULL, '1622404462-Silvia.jpg', 'Meme', 0, 0, 41, 1, 2, '2021-05-30 17:54:22', '2021-05-30 17:54:22'),
(125, 'Sad momento', NULL, NULL, '1622578789-Carmen.jpg', NULL, 0, 0, 37, 1, 2, '2021-06-01 18:19:49', '2021-06-01 18:19:49'),
(129, 'Playa de mallorca', NULL, NULL, '1622806964-PacoeldelBar.jpg', NULL, 0, 0, 35, 1, 2, '2021-06-04 09:42:44', '2021-06-04 09:42:44'),
(130, 'Faro Mallorca', NULL, NULL, '1622807279-PacoeldelBar.jpg', NULL, 0, 0, 35, 1, 2, '2021-06-04 09:47:59', '2021-06-04 09:47:59'),
(131, 'Paraiso de Mallorca', NULL, NULL, '1622807389-PacoeldelBar.png', NULL, 0, 0, 35, 1, 2, '2021-06-04 09:49:49', '2021-06-04 09:49:49'),
(133, 'Kvote', NULL, NULL, '1622817607-Llabreso3.0.jpg', NULL, 0, 0, 42, 1, 2, '2021-06-04 12:40:07', '2021-06-04 12:40:07'),
(136, 'Abs color', NULL, NULL, '1623845758-ManuelAaaa.png', 'Colorines', 0, 0, 46, 1, 2, '2021-06-16 10:15:58', '2021-06-16 10:15:58'),
(141, 'Ajedrez', NULL, NULL, '1623846049-ManuelAaaa.jpg', 'Un tablero de ajedrez', 0, 0, 46, 1, 2, '2021-06-16 10:20:49', '2021-06-16 11:49:29'),
(176, 'Historia de miedo', '1623850038-PruebaLlabreso.jpg', NULL, '1623850038-PruebaLlabreso.pdf', 'Casi lloro de miedo', 0, 0, 44, 2, 2, '2021-06-16 11:27:18', '2021-06-16 11:27:18'),
(181, 'Lara croft', NULL, NULL, '1623876749-Angel_Novo.jpg', 'Lara', 0, 0, 47, 1, 2, '2021-06-16 18:52:29', '2021-06-16 18:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `contingut_tag`
--

CREATE TABLE `contingut_tag` (
  `id_contingut` int(10) UNSIGNED NOT NULL,
  `id_tag` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contingut_tag`
--

INSERT INTO `contingut_tag` (`id_contingut`, `id_tag`, `created_at`, `updated_at`) VALUES
(86, 78, '2021-05-27 20:23:39', '2021-05-27 20:23:39'),
(86, 79, '2021-05-27 20:23:39', '2021-05-27 20:23:39'),
(86, 80, '2021-05-27 20:23:39', '2021-05-27 20:23:39'),
(94, 88, '2021-05-28 10:18:55', '2021-05-28 10:18:55'),
(94, 89, '2021-05-28 10:18:55', '2021-05-28 10:18:55'),
(95, 90, '2021-05-28 10:20:56', '2021-05-28 10:20:56'),
(95, 91, '2021-05-28 10:20:56', '2021-05-28 10:20:56'),
(96, 77, '2021-05-28 15:35:57', '2021-05-28 15:35:57'),
(96, 92, '2021-05-28 15:35:57', '2021-05-28 15:35:57'),
(96, 93, '2021-05-28 15:35:57', '2021-05-28 15:35:57'),
(99, 94, '2021-05-28 15:49:40', '2021-05-28 15:49:40'),
(99, 95, '2021-05-28 15:49:40', '2021-05-28 15:49:40'),
(100, 83, '2021-05-28 15:51:32', '2021-05-28 15:51:32'),
(101, 83, '2021-05-28 15:53:02', '2021-05-28 15:53:02'),
(102, 96, '2021-05-29 05:02:48', '2021-05-29 05:02:48'),
(102, 97, '2021-05-29 05:02:48', '2021-05-29 05:02:48'),
(107, 99, '2021-05-29 07:00:57', '2021-05-29 07:00:57'),
(107, 100, '2021-05-29 07:00:57', '2021-05-29 07:00:57'),
(108, 101, '2021-05-29 07:05:43', '2021-05-29 07:05:43'),
(108, 102, '2021-05-29 07:05:43', '2021-05-29 07:05:43'),
(109, 103, '2021-05-29 07:36:06', '2021-05-29 07:36:06'),
(115, 108, '2021-05-29 08:27:35', '2021-05-29 08:27:35'),
(115, 109, '2021-05-29 08:27:35', '2021-05-29 08:27:35'),
(129, 119, '2021-06-04 09:42:44', '2021-06-04 09:42:44'),
(130, 119, '2021-06-04 09:47:59', '2021-06-04 09:47:59'),
(130, 122, '2021-06-04 09:47:59', '2021-06-04 09:47:59'),
(130, 123, '2021-06-04 09:47:59', '2021-06-04 09:47:59'),
(130, 124, '2021-06-04 09:47:59', '2021-06-04 09:47:59'),
(131, 119, '2021-06-04 09:49:49', '2021-06-04 09:49:49'),
(131, 122, '2021-06-04 09:49:49', '2021-06-04 09:49:49'),
(133, 127, '2021-06-04 12:40:07', '2021-06-04 12:40:07'),
(136, 95, '2021-06-16 10:15:58', '2021-06-16 10:15:58'),
(136, 129, '2021-06-16 10:15:58', '2021-06-16 10:15:58'),
(141, 131, '2021-06-16 10:20:49', '2021-06-16 10:20:49'),
(181, 158, '2021-06-16 18:52:29', '2021-06-16 18:52:29'),
(181, 159, '2021-06-16 18:52:29', '2021-06-16 18:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `dret_autor`
--

CREATE TABLE `dret_autor` (
  `id_dret` int(10) UNSIGNED NOT NULL,
  `tipus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icona` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dret_autor`
--

INSERT INTO `dret_autor` (`id_dret`, `tipus`, `icona`, `created_at`, `updated_at`) VALUES
(1, 'All rights reserved', '', NULL, '2021-06-17 14:28:07'),
(2, 'Creative commons zero', 'Licencia-Z.png', NULL, NULL),
(3, 'Creative Commons Attribution-NonCommercial', 'Licencia-AnC.png', NULL, NULL),
(4, 'Creative Commons Attribution-NonCommercial-ShareAlike', 'Licencia-AnCSA.png', NULL, NULL),
(5, 'Creative Commons Attribution-NonCommercial-NoDerivatives', 'Licencia-AnCnD.png', NULL, NULL),
(6, 'Creative Commons Attribution-NoDerivatives', 'Licencia-AnD.png', NULL, NULL),
(7, 'Creative Commons Attribution-ShareAlike', 'Licencia-AS.png', NULL, NULL),
(8, 'Creative Commons Attribution', 'Licencia-A.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `estadistiques`
--

CREATE TABLE `estadistiques` (
  `id_estadistica` int(10) UNSIGNED NOT NULL,
  `q_comentaris` int(11) NOT NULL DEFAULT '0',
  `q_likes` int(11) NOT NULL DEFAULT '0',
  `q_seguidors` int(11) NOT NULL DEFAULT '0',
  `q_seguits` int(11) NOT NULL DEFAULT '0',
  `q_likes_mensuals` int(11) NOT NULL DEFAULT '0',
  `q_comentaris_mensuals` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estadistiques_contingut`
--

CREATE TABLE `estadistiques_contingut` (
  `id_estadistica` int(10) UNSIGNED NOT NULL,
  `q_comentaris` int(11) NOT NULL DEFAULT '0',
  `q_likes` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grup`
--

CREATE TABLE `grup` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suspes` tinyint(1) NOT NULL,
  `xat` int(10) UNSIGNED NOT NULL,
  `estadistica` int(10) UNSIGNED NOT NULL,
  `tipus_usuari` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grups_usuaris`
--

CREATE TABLE `grups_usuaris` (
  `id_usuari` int(10) UNSIGNED NOT NULL,
  `id_grup` int(10) UNSIGNED NOT NULL,
  `es_admin` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interaccio`
--

CREATE TABLE `interaccio` (
  `id` int(11) NOT NULL,
  `id_usuari` int(10) UNSIGNED NOT NULL,
  `id_contingut` int(10) UNSIGNED NOT NULL,
  `guardat` char(1) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '0',
  `megusta` char(1) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '0',
  `comentario` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `visto` char(1) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `interaccio`
--

INSERT INTO `interaccio` (`id`, `id_usuari`, `id_contingut`, `guardat`, `megusta`, `comentario`, `visto`, `created_at`, `updated_at`) VALUES
(33, 5, 88, '0', '0', NULL, '1', '2021-05-28 10:06:50', '2021-06-11 12:22:29'),
(35, 5, 86, '0', '1', NULL, '1', '2021-05-28 10:09:04', '2021-06-17 14:29:20'),
(37, 14, 91, '0', '1', 'Hehe nito burrito', '1', '2021-05-28 10:13:16', '2021-05-29 09:02:08'),
(38, 14, 88, '0', '1', 'Otia un zombie conductor', '1', '2021-05-28 10:13:19', '2021-06-11 12:22:29'),
(40, 14, 95, '0', '1', NULL, '1', '2021-05-28 10:28:56', '2021-06-08 13:19:08'),
(41, 33, 91, '0', '1', 'Soy yo!', '1', '2021-05-28 12:20:49', '2021-05-28 15:37:20'),
(42, 33, 88, '0', '1', NULL, '1', '2021-05-28 12:25:15', '2021-06-11 12:22:29'),
(43, 14, 101, '0', '1', 'Solaire goes brr', '1', '2021-05-29 04:57:23', '2021-06-17 08:52:09'),
(44, 14, 100, '0', '1', 'Soy fan de priscila', '1', '2021-05-29 04:58:09', '2021-05-31 10:49:23'),
(45, 14, 96, '0', '1', NULL, '1', '2021-05-29 05:23:07', '2021-05-31 10:49:20'),
(46, 14, 104, '0', '1', NULL, '1', '2021-05-29 06:45:36', '2021-05-29 06:48:43'),
(47, 38, 88, '0', '1', NULL, '1', '2021-05-29 06:46:15', '2021-06-11 12:22:29'),
(48, 37, 103, '0', '1', 'JAJAJJAJAJAJAJAJA\nMe encanta', '1', '2021-05-29 06:54:06', '2021-05-29 07:23:53'),
(49, 37, 102, '0', '1', NULL, '1', '2021-05-29 06:54:44', '2021-05-29 07:23:56'),
(50, 37, 94, '0', '1', NULL, '1', '2021-05-29 06:54:48', '2021-05-29 07:08:07'),
(52, 37, 86, '0', '0', NULL, '1', '2021-05-29 06:54:54', '2021-06-17 14:29:20'),
(56, 14, 105, '0', '1', 'Hahahha', '0', '2021-05-29 06:58:45', '2021-05-29 06:58:57'),
(57, 14, 106, '0', '1', 'Hahahahhahagag', '1', '2021-05-29 06:59:23', '2021-05-29 07:22:02'),
(58, 14, 107, '0', '1', NULL, '1', '2021-05-29 07:09:13', '2021-05-29 08:42:37'),
(60, 36, 99, '0', '0', 'No enseñes eso. Allí viven mis monos', '1', '2021-05-29 07:21:36', '2021-06-02 07:45:00'),
(61, 5, 106, '0', '1', NULL, '0', '2021-05-29 07:39:41', '2021-05-29 07:39:41'),
(62, 5, 102, '0', '1', NULL, '1', '2021-05-29 07:40:10', '2021-06-10 08:54:25'),
(63, 5, 109, '0', '1', 'This canción mola mucho', '1', '2021-05-29 07:40:27', '2021-05-29 08:17:03'),
(64, 14, 109, '0', '1', NULL, '1', '2021-05-29 07:40:29', '2021-05-29 08:17:03'),
(65, 5, 94, '0', '0', NULL, '0', '2021-05-29 07:40:54', '2021-05-29 07:40:54'),
(70, 36, 88, '0', '1', NULL, '1', '2021-05-29 15:11:44', '2021-06-11 12:22:29'),
(71, 14, 123, '0', '1', 'Es naruto', '1', '2021-05-30 17:54:57', '2021-06-15 06:28:23'),
(72, 41, 103, '0', '1', NULL, '1', '2021-05-30 17:57:03', '2021-06-10 08:54:27'),
(75, 35, 109, '0', '1', NULL, '0', '2021-06-04 09:51:25', '2021-06-04 09:51:25'),
(76, 5, 129, '0', '0', NULL, '0', '2021-06-04 09:53:58', '2021-06-16 12:39:10'),
(77, 5, 131, '0', '1', NULL, '0', '2021-06-08 13:21:08', '2021-06-08 13:21:08'),
(78, 43, 133, '0', '1', NULL, '1', '2021-06-10 08:54:16', '2021-06-16 11:38:32'),
(80, 14, 125, '0', '1', NULL, '0', '2021-06-12 16:39:17', '2021-06-12 16:39:17'),
(81, 46, 133, '0', '1', 'Muy chulo el dibujo', '1', '2021-06-16 10:23:05', '2021-06-16 11:38:35'),
(82, 35, 133, '0', '1', NULL, '1', '2021-06-16 10:25:30', '2021-06-16 11:38:36'),
(83, 44, 133, '0', '1', NULL, '1', '2021-06-16 10:26:00', '2021-06-16 11:38:38'),
(84, 44, 109, '0', '1', 'Es un musicote', '0', '2021-06-16 10:27:45', '2021-06-16 10:38:28'),
(85, 44, 131, '0', '1', 'Yo he estado alli', '0', '2021-06-16 10:27:59', '2021-06-16 10:28:15'),
(86, 44, 129, '0', '1', NULL, '0', '2021-06-16 10:28:45', '2021-06-16 10:28:45'),
(88, 5, 133, '0', '1', 'Buenos colores', '1', '2021-06-16 10:32:56', '2021-06-16 11:38:39'),
(89, 44, 88, '0', '0', 'Pues efectivamente, es un zombie que conduce', '1', '2021-06-16 10:34:14', '2021-06-16 11:46:38'),
(90, 44, 91, '0', '1', NULL, '1', '2021-06-16 10:38:40', '2021-06-16 11:46:41'),
(91, 46, 109, '0', '1', NULL, '0', '2021-06-16 10:43:08', '2021-06-16 10:43:08'),
(92, 46, 91, '0', '1', NULL, '1', '2021-06-16 10:43:39', '2021-06-16 11:46:43'),
(94, 5, 176, '0', '1', NULL, '0', '2021-06-16 12:38:48', '2021-06-16 12:38:48'),
(95, 50, 136, '0', '1', NULL, '0', '2021-06-17 13:45:28', '2021-06-17 13:45:28'),
(97, 50, 108, '0', '0', NULL, '1', '2021-06-17 14:01:12', '2021-06-19 05:18:27'),
(98, 51, 107, '0', '1', NULL, '0', '2021-06-17 14:49:29', '2021-06-17 14:49:29'),
(99, 51, 176, '0', '1', NULL, '0', '2021-06-17 14:55:07', '2021-06-17 14:55:07'),
(100, 51, 115, '0', '1', NULL, '0', '2021-06-18 07:00:31', '2021-06-18 07:00:31'),
(101, 52, 129, '0', '0', NULL, '0', '2021-06-19 18:56:28', '2021-06-19 18:56:52');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2021_04_22_201544_general', 1),
(4, '2021_04_22_205414_create_users_table', 1),
(5, '2021_04_22_212023_xat', 1),
(6, '2021_04_22_212230_avis', 1),
(7, '2021_04_22_212326_grup', 1),
(8, '2021_04_22_213724_contingut', 1),
(9, '2021_04_22_214435_missatge', 1),
(10, '2021_04_22_214918_nm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `missatge`
--

CREATE TABLE `missatge` (
  `id` int(10) UNSIGNED NOT NULL,
  `missatge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_enviat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_xat` int(10) UNSIGNED NOT NULL,
  `id_usuari` int(10) UNSIGNED NOT NULL,
  `id_contingut` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `missatge`
--

INSERT INTO `missatge` (`id`, `missatge`, `data_enviat`, `id_xat`, `id_usuari`, `id_contingut`, `created_at`, `updated_at`) VALUES
(38, 'Heeeey', '2021-05-27 22:10:43', 12, 14, NULL, '2021-05-27 20:10:43', '2021-05-27 20:10:43'),
(39, 'Jodete', '2021-05-27 22:14:42', 12, 5, NULL, '2021-05-27 20:14:42', '2021-05-27 20:14:42'),
(41, 'Nice pic', '2021-05-27 22:15:06', 12, 14, NULL, '2021-05-27 20:15:06', '2021-05-27 20:15:06'),
(42, '', '2021-05-28 12:29:01', 12, 14, 95, '2021-05-28 10:29:01', '2021-05-28 10:29:01'),
(43, '', '2021-05-28 12:29:44', 12, 14, 95, '2021-05-28 10:29:44', '2021-05-28 10:29:44'),
(44, 'xd', '2021-05-28 12:29:52', 12, 14, NULL, '2021-05-28 10:29:52', '2021-05-28 10:29:52'),
(45, 'Hola paquito', '2021-05-28 14:20:35', 13, 33, NULL, '2021-05-28 12:20:35', '2021-05-28 12:20:35'),
(46, '', '2021-05-28 14:23:30', 13, 33, 91, '2021-05-28 12:23:30', '2021-05-28 12:23:30'),
(47, '', '2021-05-28 17:12:44', 12, 14, 95, '2021-05-28 15:12:44', '2021-05-28 15:12:44'),
(48, 'Hola', '2021-05-28 19:15:03', 12, 5, NULL, '2021-05-28 17:15:02', '2021-05-28 17:15:02'),
(49, '', '2021-05-29 07:21:41', 12, 14, 103, '2021-05-29 05:21:41', '2021-05-29 05:21:41'),
(50, 'Tengo curiosidad, de donde sacas esas fotos?', '2021-05-29 07:28:25', 12, 14, NULL, '2021-05-29 05:28:25', '2021-05-29 05:28:25'),
(51, 'Uee carmen que tal todo', '2021-05-29 08:48:12', 14, 14, NULL, '2021-05-29 06:48:12', '2021-05-29 06:48:12'),
(52, 'Ueeee', '2021-05-29 08:48:22', 14, 37, NULL, '2021-05-29 06:48:22', '2021-05-29 06:48:22'),
(53, 'Todo bien jajaja', '2021-05-29 08:48:26', 14, 37, NULL, '2021-05-29 06:48:26', '2021-05-29 06:48:26'),
(54, '', '2021-05-29 08:48:27', 14, 14, 104, '2021-05-29 06:48:27', '2021-05-29 06:48:27'),
(55, 'Me gusta la foto de perfil', '2021-05-29 08:48:39', 14, 37, NULL, '2021-05-29 06:48:39', '2021-05-29 06:48:39'),
(56, 'Nice foto', '2021-05-29 08:48:40', 14, 14, NULL, '2021-05-29 06:48:40', '2021-05-29 06:48:40'),
(57, 'La del pato?', '2021-05-29 08:48:55', 14, 14, NULL, '2021-05-29 06:48:55', '2021-05-29 06:48:55'),
(58, 'Grasiaas grasiaas', '2021-05-29 08:48:57', 14, 37, NULL, '2021-05-29 06:48:57', '2021-05-29 06:48:57'),
(59, 'Si jajajajjaa', '2021-05-29 08:49:01', 14, 37, NULL, '2021-05-29 06:49:01', '2021-05-29 06:49:01'),
(60, 'Que te parece de momento?', '2021-05-29 08:49:42', 14, 14, NULL, '2021-05-29 06:49:42', '2021-05-29 06:49:42'),
(61, 'Guayyy', '2021-05-29 08:49:51', 14, 37, NULL, '2021-05-29 06:49:51', '2021-05-29 06:49:51'),
(62, 'Esta muy bien hecho eh', '2021-05-29 08:49:57', 14, 37, NULL, '2021-05-29 06:49:57', '2021-05-29 06:49:57'),
(63, 'Salir del chat y todo es raro en movil', '2021-05-29 08:50:17', 14, 37, NULL, '2021-05-29 06:50:17', '2021-05-29 06:50:17'),
(64, 'Si lo pongo de lado mejor xd', '2021-05-29 08:50:51', 14, 37, NULL, '2021-05-29 06:50:51', '2021-05-29 06:50:51'),
(65, 'UIeeee', '2021-05-29 09:11:07', 15, 14, NULL, '2021-05-29 07:11:07', '2021-05-29 07:11:07'),
(66, 'Buenas tardes señores:)', '2021-05-29 09:11:11', 15, 5, NULL, '2021-05-29 07:11:11', '2021-05-29 07:11:11'),
(67, 'Ueee leo', '2021-05-29 09:13:39', 16, 14, NULL, '2021-05-29 07:13:39', '2021-05-29 07:13:39'),
(68, '', '2021-05-29 09:13:46', 15, 14, 106, '2021-05-29 07:13:46', '2021-05-29 07:13:46'),
(69, '', '2021-05-29 09:14:00', 15, 14, 106, '2021-05-29 07:14:00', '2021-05-29 07:14:00'),
(70, 'Nice foto bro', '2021-05-29 09:15:08', 15, 5, NULL, '2021-05-29 07:15:08', '2021-05-29 07:15:08'),
(71, '', '2021-05-29 09:15:15', 16, 14, 106, '2021-05-29 07:15:15', '2021-05-29 07:15:15'),
(72, 'Nice foto bro', '2021-05-29 09:15:44', 16, 14, NULL, '2021-05-29 07:15:44', '2021-05-29 07:15:44'),
(73, 'Bon dia', '2021-05-29 09:22:28', 16, 36, NULL, '2021-05-29 07:22:28', '2021-05-29 07:22:28'),
(74, 'Bon dia', '2021-05-29 09:22:38', 15, 36, NULL, '2021-05-29 07:22:38', '2021-05-29 07:22:38'),
(75, 'Voy a probar lo de la canción a ver', '2021-05-29 09:23:03', 15, 36, NULL, '2021-05-29 07:23:03', '2021-05-29 07:23:03'),
(76, 'que tal todo?', '2021-05-29 09:29:14', 16, 14, NULL, '2021-05-29 07:29:14', '2021-05-29 07:29:14'),
(77, 'hahahaha', '2021-05-29 09:29:33', 14, 14, NULL, '2021-05-29 07:29:33', '2021-05-29 07:29:33'),
(78, 'Tens un don mágico per trobar bugs', '2021-05-29 09:38:04', 15, 5, NULL, '2021-05-29 07:38:04', '2021-05-29 07:38:04'),
(79, 'xdddd', '2021-05-29 09:39:55', 15, 36, NULL, '2021-05-29 07:39:55', '2021-05-29 07:39:55'),
(80, 'pues he encontrado otro fallo xd', '2021-05-29 09:40:19', 16, 36, NULL, '2021-05-29 07:40:19', '2021-05-29 07:40:19'),
(81, 'en plan\nel chat', '2021-05-29 09:40:32', 16, 36, NULL, '2021-05-29 07:40:32', '2021-05-29 07:40:32'),
(82, 'tienes que entrar en el mensaje como 2 veces para ver el mensaje', '2021-05-29 09:40:52', 16, 36, NULL, '2021-05-29 07:40:52', '2021-05-29 07:40:52'),
(83, 'alomejor es mi conexión\nno se', '2021-05-29 09:41:24', 16, 36, NULL, '2021-05-29 07:41:24', '2021-05-29 07:41:24'),
(84, 'buenas tarders', '2021-05-29 10:55:43', 12, 14, NULL, '2021-05-29 08:55:42', '2021-05-29 08:55:42'),
(85, '', '2021-05-29 10:55:59', 12, 14, 109, '2021-05-29 08:55:58', '2021-05-29 08:55:58'),
(86, '', '2021-05-29 10:56:39', 12, 5, 94, '2021-05-29 08:56:39', '2021-05-29 08:56:39'),
(87, '', '2021-05-29 10:56:39', 12, 5, 94, '2021-05-29 08:56:39', '2021-05-29 08:56:39'),
(90, '', '2021-05-29 10:57:54', 12, 5, 94, '2021-05-29 08:57:54', '2021-05-29 08:57:54'),
(91, '', '2021-05-29 10:57:55', 12, 5, 94, '2021-05-29 08:57:55', '2021-05-29 08:57:55'),
(97, 'asdadsa', '2021-05-29 11:06:02', 12, 14, NULL, '2021-05-29 09:06:02', '2021-05-29 09:06:02'),
(98, '', '2021-05-29 13:08:29', 12, 5, 94, '2021-05-29 11:08:29', '2021-05-29 11:08:29'),
(99, '', '2021-05-29 13:09:24', 12, 5, 86, '2021-05-29 11:09:24', '2021-05-29 11:09:24'),
(100, '', '2021-05-29 13:13:50', 12, 5, 106, '2021-05-29 11:13:50', '2021-05-29 11:13:50'),
(101, 'Fotico', '2021-05-29 13:13:58', 12, 5, NULL, '2021-05-29 11:13:57', '2021-05-29 11:13:57'),
(103, 'a', '2021-05-29 13:39:17', 12, 5, NULL, '2021-05-29 11:39:16', '2021-05-29 11:39:16'),
(104, '', '2021-05-29 13:39:59', 12, 5, 102, '2021-05-29 11:39:59', '2021-05-29 11:39:59'),
(105, 'Si, es un fallo y no sabemos como arreglarlo xd', '2021-05-29 14:14:58', 16, 14, NULL, '2021-05-29 12:14:58', '2021-05-29 12:14:58'),
(106, 'Heey', '2021-05-30 20:00:38', 17, 14, NULL, '2021-05-30 18:00:38', '2021-05-30 18:00:38'),
(107, '', '2021-05-30 20:01:49', 17, 14, 109, '2021-05-30 18:01:49', '2021-05-30 18:01:49'),
(108, 'Esta canción la ha hecho un amigo', '2021-05-30 20:02:07', 17, 14, NULL, '2021-05-30 18:02:07', '2021-05-30 18:02:07'),
(109, 'Que pasada tío', '2021-05-30 20:04:57', 17, 41, NULL, '2021-05-30 18:04:57', '2021-05-30 18:04:57'),
(110, 'Gracias hehe', '2021-05-30 20:06:39', 17, 14, NULL, '2021-05-30 18:06:39', '2021-05-30 18:06:39'),
(111, '', '2021-05-31 08:07:04', 12, 5, 115, '2021-05-31 06:07:03', '2021-05-31 06:07:03'),
(113, '', '2021-05-31 09:53:00', 12, 5, 109, '2021-05-31 07:52:59', '2021-05-31 07:52:59'),
(114, '', '2021-05-31 10:22:27', 12, 5, 109, '2021-05-31 08:22:25', '2021-05-31 08:22:25'),
(115, '', '2021-05-31 10:22:27', 18, 5, 109, '2021-05-31 08:22:25', '2021-05-31 08:22:25'),
(116, 'Hola que pasa', '2021-06-08 15:19:55', 12, 5, NULL, '2021-06-08 13:19:55', '2021-06-08 13:19:55'),
(117, '', '2021-06-08 15:20:05', 15, 5, 131, '2021-06-08 13:20:05', '2021-06-08 13:20:05'),
(118, 'hola', '2021-06-10 10:59:50', 19, 43, NULL, '2021-06-10 08:59:50', '2021-06-10 08:59:50'),
(119, 'hey', '2021-06-10 11:01:08', 19, 14, NULL, '2021-06-10 09:01:08', '2021-06-10 09:01:08'),
(120, 'Pero en principio ya está', '2021-06-12 18:42:54', 16, 14, NULL, '2021-06-12 16:42:54', '2021-06-12 16:42:54'),
(121, 'Prueba', '2021-06-16 10:50:19', 12, 5, NULL, '2021-06-16 08:50:19', '2021-06-16 08:50:19'),
(122, 'Hey', '2021-06-17 10:45:49', 12, 14, NULL, '2021-06-17 08:45:49', '2021-06-17 08:45:49'),
(123, 'Cochino', '2021-06-17 10:45:57', 12, 5, NULL, '2021-06-17 08:45:57', '2021-06-17 08:45:57'),
(124, 'HOla', '2021-06-17 10:46:24', 18, 5, NULL, '2021-06-17 08:46:24', '2021-06-17 08:46:24'),
(125, 'Hey', '2021-06-17 10:46:49', 18, 14, NULL, '2021-06-17 08:46:49', '2021-06-17 08:46:49'),
(126, 'dihfjidgfd', '2021-06-17 10:46:57', 18, 5, NULL, '2021-06-17 08:46:57', '2021-06-17 08:46:57'),
(127, 'Te llega?', '2021-06-17 10:47:03', 18, 14, NULL, '2021-06-17 08:47:03', '2021-06-17 08:47:03'),
(128, 'gdfgdfg', '2021-06-17 10:47:07', 18, 5, NULL, '2021-06-17 08:47:07', '2021-06-17 08:47:07'),
(129, 'sdfdufd', '2021-06-17 10:47:21', 12, 5, NULL, '2021-06-17 08:47:21', '2021-06-17 08:47:21'),
(130, 'ghgjyhjh', '2021-06-17 10:47:26', 12, 5, NULL, '2021-06-17 08:47:26', '2021-06-17 08:47:26'),
(131, 'te llega?', '2021-06-17 10:47:33', 12, 14, NULL, '2021-06-17 08:47:33', '2021-06-17 08:47:33'),
(132, 'Hola?', '2021-06-17 10:47:47', 12, 14, NULL, '2021-06-17 08:47:47', '2021-06-17 08:47:47'),
(133, 'fghfgyh', '2021-06-17 10:48:08', 12, 5, NULL, '2021-06-17 08:48:08', '2021-06-17 08:48:08'),
(134, '', '2021-06-17 10:48:46', 12, 14, 125, '2021-06-17 08:48:46', '2021-06-17 08:48:46'),
(135, '', '2021-06-17 10:48:55', 12, 14, 125, '2021-06-17 08:48:55', '2021-06-17 08:48:55'),
(136, '', '2021-06-17 10:48:55', 18, 14, 125, '2021-06-17 08:48:55', '2021-06-17 08:48:55'),
(137, 'dfgf', '2021-06-17 10:49:06', 12, 5, NULL, '2021-06-17 08:49:06', '2021-06-17 08:49:06'),
(138, '', '2021-06-17 10:49:51', 12, 14, 123, '2021-06-17 08:49:51', '2021-06-17 08:49:51'),
(139, '', '2021-06-17 10:50:15', 12, 14, 109, '2021-06-17 08:50:15', '2021-06-17 08:50:15'),
(140, '', '2021-06-17 10:50:56', 12, 14, 125, '2021-06-17 08:50:56', '2021-06-17 08:50:56'),
(141, '', '2021-06-17 10:51:17', 12, 14, 106, '2021-06-17 08:51:17', '2021-06-17 08:51:17'),
(142, '', '2021-06-17 10:51:52', 12, 14, 105, '2021-06-17 08:51:52', '2021-06-17 08:51:52'),
(143, '', '2021-06-17 10:52:12', 12, 14, 101, '2021-06-17 08:52:12', '2021-06-17 08:52:12'),
(144, '', '2021-06-17 10:52:33', 12, 14, 100, '2021-06-17 08:52:33', '2021-06-17 08:52:33'),
(145, '', '2021-06-17 10:52:44', 12, 5, 131, '2021-06-17 08:52:44', '2021-06-17 08:52:44'),
(146, 'Hola', '2021-06-17 15:50:50', 20, 50, NULL, '2021-06-17 13:50:50', '2021-06-17 13:50:50'),
(147, 'Heey!', '2021-06-17 15:50:57', 20, 14, NULL, '2021-06-17 13:50:57', '2021-06-17 13:50:57'),
(148, 'Heey!', '2021-06-17 15:50:57', 20, 14, NULL, '2021-06-17 13:50:57', '2021-06-17 13:50:57'),
(149, '', '2021-06-17 15:59:34', 20, 14, 125, '2021-06-17 13:59:34', '2021-06-17 13:59:34');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('test@test2', '$2y$10$y0SgPNSH.dSNc0KgUCvsd.QNrRMY9aN3lmv.QsGKQM.TGccoAltjG', '2021-05-01 18:53:03');

-- --------------------------------------------------------

--
-- Table structure for table `seguidors`
--

CREATE TABLE `seguidors` (
  `id` int(11) NOT NULL,
  `id_usuari` int(10) UNSIGNED NOT NULL,
  `id_seguit` int(10) UNSIGNED NOT NULL,
  `acceptat` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seguidors`
--

INSERT INTO `seguidors` (`id`, `id_usuari`, `id_seguit`, `acceptat`, `created_at`, `updated_at`) VALUES
(9, 14, 5, '1', '2021-05-27 20:09:52', '2021-05-27 20:10:34'),
(10, 35, 33, '1', '2021-05-28 12:19:33', '2021-05-28 12:20:05'),
(11, 35, 33, '1', '2021-05-28 12:19:36', '2021-05-28 12:20:08'),
(12, 14, 37, '1', '2021-05-29 06:45:08', '2021-05-29 06:47:51'),
(13, 5, 36, '1', '2021-05-29 06:47:35', '2021-05-29 06:59:47'),
(14, 5, 38, '1', '2021-05-29 06:48:39', '2021-05-29 07:00:36'),
(15, 14, 36, '1', '2021-05-28 22:00:00', '2021-05-28 22:00:00'),
(16, 41, 5, '1', '2021-05-30 17:53:23', '2021-05-31 05:33:11'),
(17, 41, 5, '1', '2021-05-30 17:53:26', '2021-05-31 10:47:57'),
(18, 41, 14, '1', '2021-05-30 17:55:43', '2021-05-30 18:00:01'),
(21, 33, 5, '1', '2021-05-31 05:32:20', '2021-05-31 05:33:13'),
(22, 35, 5, '1', '2021-06-04 09:41:33', '2021-06-04 09:54:04'),
(23, 35, 5, '1', '2021-06-04 09:41:37', '2021-06-04 09:54:06'),
(24, 5, 37, '0', '2021-06-05 14:28:46', '2021-06-05 14:28:46'),
(25, 14, 43, '1', '2021-06-10 08:57:26', '2021-06-10 08:58:58'),
(26, 44, 46, '1', '2021-06-16 10:41:36', '2021-06-16 10:42:44'),
(27, 50, 46, '0', '2021-06-17 13:46:08', '2021-06-17 13:46:08'),
(28, 50, 14, '1', '2021-06-17 13:47:31', '2021-06-17 13:49:42');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(74, 'thor', '2021-05-27 20:08:10', '2021-05-27 20:08:10'),
(75, 'rawr', '2021-05-27 20:09:14', '2021-05-27 20:09:14'),
(76, 'leon', '2021-05-27 20:09:14', '2021-05-27 20:09:14'),
(77, 'chainman saw', '2021-05-27 20:11:55', '2021-05-27 20:11:55'),
(78, 'rotting', '2021-05-27 20:22:57', '2021-05-27 20:22:57'),
(79, 'christ', '2021-05-27 20:23:39', '2021-05-27 20:23:39'),
(80, 'kata', '2021-05-27 20:23:39', '2021-05-27 20:23:39'),
(81, 'flip', '2021-05-27 20:26:04', '2021-05-27 20:26:04'),
(82, 'zombies', '2021-05-28 09:57:47', '2021-05-28 09:57:47'),
(83, 'dark souls', '2021-05-28 10:08:13', '2021-05-28 10:08:13'),
(84, 'zzz', '2021-05-28 10:15:41', '2021-05-28 10:15:41'),
(85, 'mimir', '2021-05-28 10:15:41', '2021-05-28 10:15:41'),
(86, 'sueño', '2021-05-28 10:15:41', '2021-05-28 10:15:41'),
(87, 'cama', '2021-05-28 10:15:41', '2021-05-28 10:15:41'),
(88, 'rambo', '2021-05-28 10:18:55', '2021-05-28 10:18:55'),
(89, 'gaming', '2021-05-28 10:18:55', '2021-05-28 10:18:55'),
(90, 'felicidad', '2021-05-28 10:20:56', '2021-05-28 10:20:56'),
(91, 'alegria', '2021-05-28 10:20:56', '2021-05-28 10:20:56'),
(92, 'power', '2021-05-28 15:35:57', '2021-05-28 15:35:57'),
(93, 'waifus', '2021-05-28 15:35:57', '2021-05-28 15:35:57'),
(94, 'paisage', '2021-05-28 15:48:26', '2021-05-28 15:48:26'),
(95, 'colorido', '2021-05-28 15:48:26', '2021-05-28 15:48:26'),
(96, 'tombraider', '2021-05-29 05:02:48', '2021-05-29 05:02:48'),
(97, 'laracroft', '2021-05-29 05:02:48', '2021-05-29 05:02:48'),
(99, 'banda sonora', '2021-05-29 07:00:57', '2021-05-29 07:00:57'),
(100, 'videojuegos', '2021-05-29 07:00:57', '2021-05-29 07:00:57'),
(101, 'mayhem', '2021-05-29 07:05:43', '2021-05-29 07:05:43'),
(102, 'freezing_moon', '2021-05-29 07:05:43', '2021-05-29 07:05:43'),
(103, 'music', '2021-05-29 07:36:06', '2021-05-29 07:36:06'),
(104, 'wav', '2021-05-29 07:57:58', '2021-05-29 07:57:58'),
(105, 'explosion', '2021-05-29 07:57:58', '2021-05-29 07:57:58'),
(106, 'video', '2021-05-29 07:59:39', '2021-05-29 07:59:39'),
(107, 'casianime', '2021-05-29 07:59:59', '2021-05-29 07:59:59'),
(108, 'watchmen', '2021-05-29 08:27:35', '2021-05-29 08:27:35'),
(109, 'azul', '2021-05-29 08:27:35', '2021-05-29 08:27:35'),
(110, 'audio', '2021-05-29 08:47:20', '2021-05-29 08:47:20'),
(111, 'between', '2021-05-29 08:50:57', '2021-05-29 08:50:57'),
(112, 'sumo', '2021-05-29 09:15:47', '2021-05-29 09:15:47'),
(113, 'troll', '2021-05-29 09:19:41', '2021-05-29 09:19:41'),
(114, ' meme', '2021-05-29 09:19:41', '2021-05-29 09:19:41'),
(115, 'test', '2021-05-29 09:32:38', '2021-05-29 09:32:38'),
(116, 'text', '2021-05-29 09:32:38', '2021-05-29 09:32:38'),
(117, 'meme', '2021-05-30 17:54:22', '2021-05-30 17:54:22'),
(118, 'anime', '2021-05-31 04:48:00', '2021-05-31 04:48:00'),
(119, 'paisaje', '2021-06-04 09:42:34', '2021-06-04 09:42:34'),
(122, 'playa', '2021-06-04 09:47:59', '2021-06-04 09:47:59'),
(123, 'mallorca', '2021-06-04 09:47:59', '2021-06-04 09:47:59'),
(124, 'faro', '2021-06-04 09:47:59', '2021-06-04 09:47:59'),
(126, 'mar', '2021-06-04 09:53:15', '2021-06-04 09:53:15'),
(127, 'el nombre del viento', '2021-06-04 12:40:07', '2021-06-04 12:40:07'),
(129, 'geometria', '2021-06-16 10:15:58', '2021-06-16 10:15:58'),
(130, 'mine', '2021-06-16 10:20:45', '2021-06-16 10:20:45'),
(131, 'juegos de mesa', '2021-06-16 10:20:49', '2021-06-16 10:20:49'),
(154, 'abstracto', '2021-06-16 11:15:49', '2021-06-16 11:15:49'),
(155, 'terror', '2021-06-16 11:21:52', '2021-06-16 11:21:52'),
(156, 'xamp', '2021-06-16 18:48:59', '2021-06-16 18:48:59'),
(157, 'info', '2021-06-16 18:48:59', '2021-06-16 18:48:59'),
(158, 'lara', '2021-06-16 18:52:29', '2021-06-16 18:52:29'),
(159, 'tomb', '2021-06-16 18:52:29', '2021-06-16 18:52:29'),
(161, 'cancion', '2021-06-17 12:17:34', '2021-06-17 12:17:34'),
(162, 'ig', '2021-06-17 12:20:02', '2021-06-17 12:20:02'),
(163, 'assasin', '2021-06-17 12:20:47', '2021-06-17 12:20:47'),
(164, 'animal', '2021-06-17 13:55:36', '2021-06-17 13:55:36');

-- --------------------------------------------------------

--
-- Table structure for table `tipus_contingut`
--

CREATE TABLE `tipus_contingut` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icona` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Descripcio` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `espai` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipus_contingut`
--

INSERT INTO `tipus_contingut` (`id`, `tipus`, `icona`, `created_at`, `updated_at`, `Descripcio`, `espai`) VALUES
(1, 'Imagen', '', NULL, '2021-06-17 14:26:16', 'jpg gif png jpeg svg', '4096'),
(2, 'Documento de texto', '', NULL, '2021-06-17 14:25:43', 'pdf txt', '4096'),
(3, 'Música', '', NULL, '2021-06-17 12:16:08', 'mp3 mpeg', '10000'),
(4, 'Video', '', NULL, '2021-05-17 15:00:18', 'mp4 ogg', '10000'),
(5, 'Otros', '', NULL, '2021-06-17 12:06:49', 'blend tga iris sgi rar zip gz tar.gz 7z css mng webp', '10000');

-- --------------------------------------------------------

--
-- Table structure for table `tipus_usuari`
--

CREATE TABLE `tipus_usuari` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipus_usuari`
--

INSERT INTO `tipus_usuari` (`id`, `tipus`, `created_at`, `updated_at`) VALUES
(1, 'usuari', '2021-05-01 15:45:26', '2021-05-01 15:45:26'),
(2, 'administrador', '2021-05-13 11:01:07', '2021-05-13 11:01:07'),
(3, 'superadministrador', '2021-05-13 11:01:41', '2021-05-13 11:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `alies` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'avatar.jpg',
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_naixement` timestamp NULL DEFAULT NULL,
  `data-registre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actiu` tinyint(1) NOT NULL DEFAULT '0',
  `deshabilitat` tinyint(1) NOT NULL DEFAULT '0',
  `suspes` tinyint(1) NOT NULL DEFAULT '0',
  `es_admin` tinyint(1) NOT NULL DEFAULT '0',
  `nivell_gravetat` int(11) NOT NULL DEFAULT '10',
  `grups_disponibles` int(11) NOT NULL DEFAULT '0',
  `recomenat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipus` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fondo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fondoDefault.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `email_verified_at`, `alies`, `foto`, `link`, `data_naixement`, `data-registre`, `actiu`, `deshabilitat`, `suspes`, `es_admin`, `nivell_gravetat`, `grups_disponibles`, `recomenat`, `tipus`, `remember_token`, `created_at`, `updated_at`, `fondo`) VALUES
(5, 'Llabreso', '$2y$10$NU6Mfo4r1ZumLPYIN8SBEuqTt66SdKYw1ArQyj4FVGcfjoAuNe.wK', 'joanllabresoliver@gmail.com', '2021-05-08 09:30:50', 'Llabreso', '1622154278-Llabreso.jpg', NULL, '2001-09-12 08:54:48', NULL, 1, 0, 0, 1, 10, 0, 'el nombre del viento; paraiso;playa; mallorca; playa;paisaje;gaming;rambo;music;laracroft;tombraider;cama;sueño;mimir;zzz;kata;christ;rotting;leon;rawr', 3, 'jyWdpZgvsm9NjHjE0N650xJb1XWN6hhtZlNbfT37AIlvJD42zBh8DvYFvbLZ', '2021-05-05 19:06:19', '2021-06-17 14:17:02', '1622153591-Llabreso.jpg'),
(14, 'AngelNovo2', '$2y$10$vlt9oHHX10tPq0VVrX3nkOk9kLRAbTEkx/uzTTs7hEVtv8xOLc49u', 'angelnovo15@gmail.com', '2021-05-26 22:00:00', 'AngelNovo', '1622153229-AngelNovo2.jpg', NULL, '2000-12-05 23:00:00', NULL, 0, 0, 0, 1, 10, 0, 'music;videojuegos;banda sonora;waifus;power;dark souls;alegria;felicidad;flip;chainman saw', 3, NULL, '2021-05-14 15:07:26', '2021-07-07 08:20:00', '1622153229-AngelNovo2.png'),
(33, 'Llabreso2.0', '$2y$10$Jvv2njCn22ADL40h2uy.tOFvXhd5RRLit3tBo0uL3UF8VSkMqP6Ca', 'joanllabresoliver+1@gmail.com', NULL, 'Llabres', '1622204799-Llabreso2.0.jpg', NULL, NULL, NULL, 0, 0, 0, 0, 10, 0, 'anime', 1, NULL, '2021-05-28 10:26:07', '2021-06-19 05:22:07', 'fondoDefault.jpg'),
(34, 'Angel2.0', '$2y$10$0t.KVCZLZ6ISNzJaGxTVAetu7orrEOGLrhfAMZvuucm4x1RHV0Eeu', 'angellluisnovo@paucasesnovescifp.cat', '2021-05-28 10:31:31', 'Angel2.0', 'avatar.jpg', NULL, NULL, NULL, 0, 0, 0, 0, 10, 0, NULL, 1, NULL, '2021-05-28 10:30:56', '2021-06-17 14:16:44', 'fondoDefault.jpg'),
(35, 'Paco el del Bar', '$2y$10$PPlBsCpO1.rYkY24ZsMjjukszSR8iTA/iS7F7wiWldckGxvw/7Yce', 'Ggpacoeldelbar@gmail.com', NULL, 'Paco el del bar', '1622806865-PacoeldelBar.jpg', NULL, NULL, NULL, 0, 0, 0, 0, 10, 0, 'el nombre del viento;music', 1, NULL, '2021-05-28 10:31:44', '2021-06-16 10:39:16', '1622806777-PacoeldelBar.jpg'),
(36, 'Leo Alcaraz', '$2y$10$ML4Llj/iL0C4YC2xdy9XX.4l06s.OqJYf6IcPyT4J9p/ASVH02Lfq', 'leoalcaraz77@gmail.com', NULL, 'Harry Patata', '1622279849-LeoAlcaraz.jpg', NULL, '2001-09-15 22:00:00', NULL, 0, 0, 0, 0, 10, 0, 'cama;sueño;mimir;zzz', 1, NULL, '2021-05-29 06:30:11', '2021-05-29 15:11:44', '1622279849-LeoAlcaraz.jpg'),
(37, 'Carmen', '$2y$10$.u6QPh7KpqJqG0vAkTQzQOkn6nVioFa/FJsxYIl3q9hD8LfYM1bMW', 'carmensugranes2002@gmail.com', NULL, 'Carmencia', '1622277506-Carmen.jpg', NULL, '2002-09-26 22:00:00', NULL, 0, 0, 0, 0, 10, 0, 'leon;rawr;kata;christ;rotting;cama;sueño;mimir;zzz;gaming;rambo;laracroft;tombraider', 1, NULL, '2021-05-29 06:31:22', '2021-06-09 07:50:26', '1622277506-Carmen.jpg'),
(38, 'Maria Rosa', '$2y$10$h3eaZ/HP3X.7by0WPOfV2.agNzuhQ29nvxqXZVG9e.JRarHNP89fG', 'mroliver40@gmail.com', '2021-05-30 04:44:39', 'Mr40', 'avatar.jpg', NULL, '1971-03-05 23:00:00', NULL, 0, 0, 0, 0, 10, 0, NULL, 1, NULL, '2021-05-29 06:45:07', '2021-06-11 13:45:30', 'fondoDefault.jpg'),
(39, 'test email', '$2y$10$0d7wPQYVLaZkXMVa76GjneHihm4P3Cldls1LbYWoB.8U7yZqNvX4u', 'angelnovo15+1@gmail.com', NULL, 'test', '1622283964-testemail.jpg', NULL, '2021-05-03 22:00:00', NULL, 0, 0, 0, 0, 10, 0, NULL, 1, NULL, '2021-05-29 08:21:14', '2021-06-17 11:56:09', '1622283983-testemail.jpg'),
(40, 'test', '$2y$10$0Dy6Ptwg42.iF0Xc93ApPeSWo/9ENbosZvx7/r9vm0P2C6DKzzoUW', 'angelnovo15+2@gmail.com', NULL, 'test', 'avatar.jpg', NULL, '2021-05-02 22:00:00', NULL, 0, 0, 0, 0, 10, 0, NULL, 1, NULL, '2021-05-29 12:16:43', '2021-05-29 12:16:47', 'fondoDefault.jpg'),
(41, 'Silvia', '$2y$10$65Ae7ewqFGSpZRbJkIsIV.yIaMZ9pdXWZzdk2WbIdQrhfvc2hk5WS', 'silviasanchez@paucasesnovescifp.cat', NULL, 'Malcriada', '1622404384-Silvia.gif', NULL, '1990-02-08 23:00:00', NULL, 1, 0, 0, 0, 3, 0, NULL, 1, NULL, '2021-05-30 17:47:26', '2021-06-17 14:19:36', 'fondoDefault.jpg'),
(42, 'Llabreso3.0', '$2y$10$KvFBOmfqIsWLZczkXdzK7OOmfmLJa175nD/tsOHaL91.6b5luPoZK', 'joanllabresoliver+2@gmail.com', NULL, 'OtroLlabreso', '1623850536-Llabreso3.0.jpg', NULL, '2021-06-03 22:00:00', NULL, 0, 0, 1, 0, 0, 0, NULL, 1, NULL, '2021-06-04 12:39:01', '2021-06-17 13:59:04', '1623850516-Llabreso3.0.jpg'),
(43, 'Cristian', '$2y$10$TfeuhaZBHKCPcl77799yreNqYASooD86ZNRAE.udE1C4WVq2uCwpe', 'cmartinez@clicktotravel.es', NULL, 'cmartinez', 'avatar.jpg', NULL, '1992-12-31 23:00:00', NULL, 0, 0, 0, 0, 10, 0, 'el nombre del viento', 1, NULL, '2021-06-10 08:53:31', '2021-06-14 17:04:58', 'fondoDefault.jpg'),
(44, 'Prueba Llabreso', '$2y$10$p2dA/BLWbjauQuMS9v91Cu4dTGm/hbcTptx060R9eckQ2.DXhuUpS', 'joanllabresoliver+3@gmail.com', NULL, 'Llab', '1623846711-PruebaLlabreso.jpg', NULL, '2021-06-10 22:00:00', NULL, 1, 0, 0, 0, 10, 0, 'playa;paisaje;music;el nombre del viento', 1, NULL, '2021-06-12 06:55:06', '2021-06-17 12:23:01', '1623846711-PruebaLlabreso.jpg'),
(45, 'Jddhbf', '$2y$10$KqPmrCl1fpgKMsbx57k2e.0v4f2ejNN35ZGHGLYotlsgqdCnbeA.m', 'jshx@hotmail.com', NULL, 'Dhhdhsjgd', 'avatar.jpg', NULL, '2008-06-09 22:00:00', NULL, 1, 0, 0, 0, 10, 0, NULL, 1, NULL, '2021-06-12 21:12:52', '2021-06-12 21:12:54', 'fondoDefault.jpg'),
(46, 'ManuelAaaa', '$2y$10$UddgUqK0LoFeIiqfxq2RY.rSXO3/UDoZlb7a2WlyAZ/CF/G8kYFku', 'joanllabresoliver+4@gmail.com', NULL, '3A', '1623845653-ManuelAaaa.png', NULL, '1992-06-05 22:00:00', NULL, 0, 0, 0, 0, 3, 0, 'music;el nombre del viento', 1, NULL, '2021-06-16 10:13:21', '2021-06-17 09:02:31', '1623845653-ManuelAaaa.jpg'),
(47, 'Angel_Novo', '$2y$10$1378BrYkbdvKac7O/fIGX.VvOccNF7bIzbT5/uPyXYWTGzqzkhUXW', 'angelnovo15+3@gmail.com', '2021-06-16 18:52:03', 'angel', 'avatar.jpg', NULL, '2021-05-31 22:00:00', NULL, 0, 0, 1, 0, 0, 0, NULL, 1, NULL, '2021-06-16 18:51:29', '2021-06-17 08:57:51', 'fondoDefault.jpg'),
(48, 'angel25', '$2y$10$Reo9TmJ6gZ1PKh6hBVI3BO/GTPoNXEk0H9hLOgZ8ty51x6Vrx3TnS', 'angelnovo15+5@gmail.com', NULL, 'Angel', 'avatar.jpg', NULL, '2021-05-31 22:00:00', NULL, 0, 0, 0, 0, 10, 0, NULL, 1, NULL, '2021-06-17 12:15:00', '2021-06-17 12:24:02', 'fondoDefault.jpg'),
(49, 'Organizate', '$2y$10$HH0GOMLnEfw5C7Pe.Xm9vuyn6sC6zbT/B679ZoRpjhk4t2KrWpNp6', 'joanllabresoliver+5@gmail.com', NULL, 'hbhghnh', 'avatar.jpg', NULL, '2021-06-02 22:00:00', NULL, 0, 0, 0, 0, 10, 0, NULL, 1, NULL, '2021-06-17 12:20:19', '2021-06-17 12:21:32', 'fondoDefault.jpg'),
(50, 'Prova', '$2y$10$TtL39l8UsEmPKyxlz.yI3Omdx6wqVSurpDe4jghU8uqJyS0Mwc5pC', 'joanllabres@paucasesnovescifp.cat', '2021-06-17 13:44:25', 'Prov', '1623945432-Prova.jpg', NULL, '2021-06-11 22:00:00', NULL, 0, 0, 0, 0, 10, 0, 'geometria;colorido', 1, NULL, '2021-06-17 13:43:24', '2021-06-17 14:06:57', '1623945432-Prova.jpg'),
(51, 'Ate', '$2y$10$n2p2y5ZH4DJaSroQcly/U.sCtbPMuCLgeTTGUwDVL8vdYj9wn7I0K', 'ate@paucasesnovescifp.cat', '2021-06-18 06:58:48', 'Ate', '1624006789-Ate.jpg', NULL, '2021-06-16 22:00:00', NULL, 1, 0, 0, 0, 10, 0, 'azul;watchmen;videojuegos;banda sonora', 1, NULL, '2021-06-17 14:48:06', '2021-06-18 07:00:31', 'fondoDefault.jpg'),
(52, 'junior', '$2y$10$vcx1w.PGsqC1eUpkAvnrae5oP/235XgP2WtIkb2bc530Lm8KzjAY6', 'novoangel@live.com', NULL, 'kamikaze', 'avatar.jpg', NULL, '1999-12-05 23:00:00', NULL, 1, 0, 0, 0, 10, 0, 'paisaje', 1, NULL, '2021-06-19 18:51:42', '2021-06-19 19:12:31', 'fondoDefault.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `xat`
--

CREATE TABLE `xat` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `xat`
--

INSERT INTO `xat` (`id`, `nom`, `url_foto`, `created_at`, `updated_at`) VALUES
(12, '', '', '2021-05-27 20:10:39', '2021-05-27 20:10:39'),
(13, '', '', '2021-05-28 12:20:24', '2021-05-28 12:20:24'),
(14, '', '', '2021-05-29 06:48:05', '2021-05-29 06:48:05'),
(15, '', '', '2021-05-29 07:10:56', '2021-05-29 07:10:56'),
(16, '', '', '2021-05-29 07:13:33', '2021-05-29 07:13:33'),
(17, '', '', '2021-05-30 18:00:34', '2021-05-30 18:00:34'),
(18, '', '', '2021-05-31 08:02:35', '2021-05-31 08:02:35'),
(19, '', '', '2021-06-10 08:59:45', '2021-06-10 08:59:45'),
(20, '', '', '2021-06-17 13:50:07', '2021-06-17 13:50:07'),
(21, '', '', '2021-06-17 14:51:07', '2021-06-17 14:51:07');

-- --------------------------------------------------------

--
-- Table structure for table `xat_grup`
--

CREATE TABLE `xat_grup` (
  `id_xat` int(10) UNSIGNED NOT NULL,
  `id_grup` int(10) UNSIGNED NOT NULL,
  `es_admin` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xat_usuaris`
--

CREATE TABLE `xat_usuaris` (
  `id_xat` int(10) UNSIGNED NOT NULL,
  `id_usuari` int(10) UNSIGNED NOT NULL,
  `lastseen` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `xat_usuaris`
--

INSERT INTO `xat_usuaris` (`id_xat`, `id_usuari`, `lastseen`, `created_at`, `updated_at`) VALUES
(12, 5, '145', '2021-05-27 20:10:39', '2021-06-17 08:52:48'),
(12, 14, '145', '2021-05-27 20:10:39', '2021-06-17 14:56:56'),
(13, 35, '0', '2021-05-28 12:20:24', '2021-05-28 12:20:24'),
(13, 33, '46', '2021-05-28 12:20:24', '2021-05-31 05:46:33'),
(14, 37, '77', '2021-05-29 06:48:05', '2021-06-06 12:38:57'),
(14, 14, '77', '2021-05-29 06:48:05', '2021-05-30 07:22:01'),
(15, 14, '117', '2021-05-29 07:10:56', '2021-06-19 05:19:05'),
(15, 36, '79', '2021-05-29 07:10:56', '2021-05-29 15:11:27'),
(15, 5, '117', '2021-05-29 07:10:56', '2021-06-16 07:25:50'),
(16, 36, '105', '2021-05-29 07:13:33', '2021-05-29 15:11:22'),
(16, 14, '120', '2021-05-29 07:13:33', '2021-06-12 16:42:55'),
(17, 41, '110', '2021-05-30 18:00:34', '2021-06-04 19:31:22'),
(17, 14, '110', '2021-05-30 18:00:34', '2021-05-30 18:06:39'),
(18, 14, '136', '2021-05-31 08:02:35', '2021-06-17 08:49:16'),
(18, 5, '136', '2021-05-31 08:02:35', '2021-06-17 08:49:21'),
(19, 14, '119', '2021-06-10 08:59:45', '2021-06-12 16:42:32'),
(19, 43, '119', '2021-06-10 08:59:45', '2021-06-10 09:01:12'),
(20, 14, '148', '2021-06-17 13:50:07', '2021-06-17 13:50:57'),
(20, 50, '150', '2021-06-17 13:50:07', '2021-06-17 14:00:38'),
(21, 5, '0', '2021-06-17 14:51:07', '2021-06-17 14:51:07'),
(21, 37, '0', '2021-06-17 14:51:07', '2021-06-17 14:51:07'),
(21, 43, '0', '2021-06-17 14:51:07', '2021-06-17 14:51:07'),
(21, 14, '0', '2021-06-17 14:51:07', '2021-06-17 14:51:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analitiques_generals`
--
ALTER TABLE `analitiques_generals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `avis_usuari`
--
ALTER TABLE `avis_usuari`
  ADD PRIMARY KEY (`id`),
  ADD KEY `avis_usuari_id_usuari_foreign` (`id_usuari`),
  ADD KEY `avis_usuari_id_avis_foreign` (`id_avis`);

--
-- Indexes for table `contingut`
--
ALTER TABLE `contingut`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contingut_tipus_contingut_foreign` (`tipus_contingut`),
  ADD KEY `contingut_drets_autor_foreign` (`drets_autor`),
  ADD KEY `contingut_propietari_foreign` (`propietari`);

--
-- Indexes for table `contingut_tag`
--
ALTER TABLE `contingut_tag`
  ADD PRIMARY KEY (`id_contingut`,`id_tag`),
  ADD KEY `tag_contingut_tag` (`id_tag`);

--
-- Indexes for table `dret_autor`
--
ALTER TABLE `dret_autor`
  ADD PRIMARY KEY (`id_dret`);

--
-- Indexes for table `estadistiques`
--
ALTER TABLE `estadistiques`
  ADD PRIMARY KEY (`id_estadistica`);

--
-- Indexes for table `estadistiques_contingut`
--
ALTER TABLE `estadistiques_contingut`
  ADD PRIMARY KEY (`id_estadistica`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `grup`
--
ALTER TABLE `grup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grup_estadistica_foreign` (`estadistica`),
  ADD KEY `grup_tipus_usuari_foreign` (`tipus_usuari`),
  ADD KEY `grup_xat_foreign` (`xat`);

--
-- Indexes for table `grups_usuaris`
--
ALTER TABLE `grups_usuaris`
  ADD KEY `grups_usuaris_id_usuari_foreign` (`id_usuari`),
  ADD KEY `grups_usuaris_id_grup_foreign` (`id_grup`);

--
-- Indexes for table `interaccio`
--
ALTER TABLE `interaccio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_usuari` (`id_usuari`,`id_contingut`),
  ADD KEY `usuari_interaccio` (`id_usuari`),
  ADD KEY `contingut_interaccio` (`id_contingut`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `missatge`
--
ALTER TABLE `missatge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `missatge_id_xat_foreign` (`id_xat`),
  ADD KEY `missatge_id_usuari_foreign` (`id_usuari`),
  ADD KEY `missatge_id_contingut_foreign` (`id_contingut`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `seguidors`
--
ALTER TABLE `seguidors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seguidors_id_usuari_foreign` (`id_usuari`),
  ADD KEY `seguidors_id_seguit_foreign` (`id_seguit`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipus_contingut`
--
ALTER TABLE `tipus_contingut`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipus_usuari`
--
ALTER TABLE `tipus_usuari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_tipus_foreign` (`tipus`);

--
-- Indexes for table `xat`
--
ALTER TABLE `xat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xat_grup`
--
ALTER TABLE `xat_grup`
  ADD KEY `xat_grup_id_xat_foreign` (`id_xat`),
  ADD KEY `xat_grup_id_grup_foreign` (`id_grup`);

--
-- Indexes for table `xat_usuaris`
--
ALTER TABLE `xat_usuaris`
  ADD KEY `xat_usuaris_id_usuari_foreign` (`id_usuari`),
  ADD KEY `xat_usuaris_id_xat_foreign` (`id_xat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analitiques_generals`
--
ALTER TABLE `analitiques_generals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `avis_usuari`
--
ALTER TABLE `avis_usuari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331;

--
-- AUTO_INCREMENT for table `contingut`
--
ALTER TABLE `contingut`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `dret_autor`
--
ALTER TABLE `dret_autor`
  MODIFY `id_dret` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `estadistiques`
--
ALTER TABLE `estadistiques`
  MODIFY `id_estadistica` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `estadistiques_contingut`
--
ALTER TABLE `estadistiques_contingut`
  MODIFY `id_estadistica` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grup`
--
ALTER TABLE `grup`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interaccio`
--
ALTER TABLE `interaccio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `missatge`
--
ALTER TABLE `missatge`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `seguidors`
--
ALTER TABLE `seguidors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `tipus_contingut`
--
ALTER TABLE `tipus_contingut`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tipus_usuari`
--
ALTER TABLE `tipus_usuari`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `xat`
--
ALTER TABLE `xat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avis_usuari`
--
ALTER TABLE `avis_usuari`
  ADD CONSTRAINT `avis_usuari_id_avis_foreign` FOREIGN KEY (`id_avis`) REFERENCES `avis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `avis_usuari_id_usuari_foreign` FOREIGN KEY (`id_usuari`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contingut`
--
ALTER TABLE `contingut`
  ADD CONSTRAINT `contingut_drets_autor_foreign` FOREIGN KEY (`drets_autor`) REFERENCES `dret_autor` (`id_dret`) ON DELETE CASCADE,
  ADD CONSTRAINT `contingut_propietari_foreign` FOREIGN KEY (`propietari`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contingut_tipus_contingut_foreign` FOREIGN KEY (`tipus_contingut`) REFERENCES `tipus_contingut` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contingut_tag`
--
ALTER TABLE `contingut_tag`
  ADD CONSTRAINT `contingut_tag` FOREIGN KEY (`id_contingut`) REFERENCES `contingut` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tag_contingut_tag` FOREIGN KEY (`id_tag`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grup`
--
ALTER TABLE `grup`
  ADD CONSTRAINT `grup_estadistica_foreign` FOREIGN KEY (`estadistica`) REFERENCES `estadistiques` (`id_estadistica`) ON DELETE CASCADE,
  ADD CONSTRAINT `grup_tipus_usuari_foreign` FOREIGN KEY (`tipus_usuari`) REFERENCES `tipus_usuari` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grup_xat_foreign` FOREIGN KEY (`xat`) REFERENCES `xat` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `grups_usuaris`
--
ALTER TABLE `grups_usuaris`
  ADD CONSTRAINT `grups_usuaris_id_grup_foreign` FOREIGN KEY (`id_grup`) REFERENCES `grup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grups_usuaris_id_usuari_foreign` FOREIGN KEY (`id_usuari`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `interaccio`
--
ALTER TABLE `interaccio`
  ADD CONSTRAINT `contingut_interaccio` FOREIGN KEY (`id_contingut`) REFERENCES `contingut` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuari_interaccio` FOREIGN KEY (`id_usuari`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `missatge`
--
ALTER TABLE `missatge`
  ADD CONSTRAINT `missatge_id_contingut_foreign` FOREIGN KEY (`id_contingut`) REFERENCES `contingut` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `missatge_id_usuari_foreign` FOREIGN KEY (`id_usuari`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `missatge_id_xat_foreign` FOREIGN KEY (`id_xat`) REFERENCES `xat` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `seguidors`
--
ALTER TABLE `seguidors`
  ADD CONSTRAINT `seguidors_id_seguit_foreign` FOREIGN KEY (`id_seguit`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `seguidors_id_usuari_foreign` FOREIGN KEY (`id_usuari`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_tipus_foreign` FOREIGN KEY (`tipus`) REFERENCES `tipus_usuari` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `xat_grup`
--
ALTER TABLE `xat_grup`
  ADD CONSTRAINT `xat_grup_id_grup_foreign` FOREIGN KEY (`id_grup`) REFERENCES `grup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `xat_grup_id_xat_foreign` FOREIGN KEY (`id_xat`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `xat_usuaris`
--
ALTER TABLE `xat_usuaris`
  ADD CONSTRAINT `xat_usuaris_id_usuari_foreign` FOREIGN KEY (`id_usuari`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `xat_usuaris_id_xat_foreign` FOREIGN KEY (`id_xat`) REFERENCES `xat` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
