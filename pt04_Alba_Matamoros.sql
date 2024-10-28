-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2024 a las 20:54:03
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
-- Base de datos: `pt04_alba_matamoros`
--
DROP DATABASE IF EXISTS `pt04_alba_matamoros`;
CREATE DATABASE IF NOT EXISTS `pt04_alba_matamoros` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pt04_alba_matamoros`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personatges`
--

CREATE TABLE IF NOT EXISTS `personatges` (
  `id_personatge` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `cos` varchar(100) NOT NULL,
  `usuari_id` int(11) NOT NULL,
  PRIMARY KEY (`id_personatge`),
  KEY `usuari_id` (`usuari_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `personatges`:
--   `usuari_id`
--       `usuaris` -> `id_usuari`
--

--
-- Volcado de datos para la tabla `personatges`
--

INSERT INTO `personatges` (`id_personatge`, `nom`, `cos`, `usuari_id`) VALUES
(9, 'Monkey D. Luffy', 'Un joven pirata de cuerpo elástico que sueña con ser el Rey de los Piratas.', 14),
(10, 'Roronoa Zoro', 'Un espadachín musculoso que aspira a ser el mejor del mundo.', 15),
(11, 'Nami', 'La navegante ágil con un talento excepcional para la cartografía y un amor por el tesoro.', 16),
(12, 'Usopp', 'Un francotirador delgado con una imaginación desbordante y un deseo de ser un gran guerrero.', 17),
(14, 'Tony Tony Chopper', 'Un pequeño reno que se convirtió en humano y es un talentoso médico.', 15),
(15, 'Nico Robin', 'La arqueóloga esbelta que busca desentrañar los secretos de la historia antigua.', 16),
(16, 'Franky', 'Un carpintero cyborg excéntrico que quiere construir el mejor barco del mundo.', 17),
(18, 'Trafalgar D. Water Law', 'Un médico pirata delgado con habilidades únicas y ambiciones desafiantes.', 15),
(20, 'Portgas D. Ace', 'El hermano de Luffy, un poderoso usuario del fuego que aspira a ser libre.', 15),
(21, 'Boa Hancock', 'La emperatriz de Amazon Lily, famosa por su belleza y su amor por Luffy.', 16),
(22, 'Kozuki Oden', 'Un antiguo samurái que sueña con un mundo lleno de libertad y aventuras.', 17),
(23, 'Sabo', 'El hermano de Luffy, un luchador por la libertad y el comandante del Ejército Revolucionario.', 14),
(24, 'Bartholomew Kuma', 'Un antiguo miembro de los Shichibukai con el poder de la Fruta del Diablo que le permite mover objet', 15),
(25, 'Dracule Mihawk', 'El espadachín más fuerte del mundo, conocido por su habilidad y su imponente espada.', 16),
(26, 'Nefertari Vivi', 'La princesa de Arabasta que lucha por su pueblo y la paz en el mundo.', 17),
(27, 'Donquixote Doflamingo', 'Un villano carismático que manipula a otros y busca poder en el mundo subterráneo.', 15),
(28, 'Eustass Kid', 'Un capitán pirata con un carácter feroz y un fuerte deseo de fama y fortuna.', 16),
(29, 'Yamato', 'Hija de Kaido que busca unirse a Luffy y vivir aventuras.', 17),
(30, 'Sengoku', 'El ex almirante de la Marina conocido por su sabiduría y su fuerte sentido de justicia.', 14),
(31, 'Smoker', 'Un marino que utiliza el poder del humo para capturar piratas.', 15),
(32, 'Toki', 'La mujer que puede enviar a otros a través del tiempo, con un gran deseo de proteger a su familia.', 16),
(33, 'Crocodile', 'Un ex Shichibukai con el poder de manipular la arena y un ambicioso plan para controlar el mundo.', 17),
(34, 'Sanji', 'El cocinero atlético que sueña con encontrar el All Blue y es conocido por sus patadas.', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

CREATE TABLE IF NOT EXISTS `usuaris` (
  `id_usuari` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `cognoms` varchar(100) NOT NULL,
  `correu` varchar(100) NOT NULL,
  `usuari` varchar(30) NOT NULL,
  `contrasenya` varchar(255) NOT NULL,
  PRIMARY KEY (`id_usuari`),
  UNIQUE KEY `correu` (`correu`),
  UNIQUE KEY `usuari` (`usuari`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `usuaris`:
--

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`id_usuari`, `nom`, `cognoms`, `correu`, `usuari`, `contrasenya`) VALUES
(14, 'Alba', 'Matamoros', 'a.matamoros@sapalomera.cat', 'amatamoros', '$2y$10$8Kn1I8wrQWQ9FA4GV4PkWujJaLUJGGknl0bqoUunZTracQ6Tv9xsi'),
(15, 'Pedro', 'Pica', 'p.pica@sapalomera.cat', 'ppica', '$2y$10$T4wMuW7uKVd2BtQRn2v5w.4eKFr875zm33cVPFrvtXDoRvpqVKj1i'),
(16, 'Piter', 'Pan', 'p.pan@sapalomera.cat', 'ppan', '$2y$10$jYKa2jKaqXhAI0spRNp6eOV97H/XH6UfIV4t3UwGiI773kMI7HWAm'),
(17, 'mary', 'Jane', 'm.jane@sapalomera.cat', 'mjane', '$2y$10$.7q0zRTlaRctCHAqEgEk1.9kHXXXXZW/QMykfZ5xgHlfL9RBaKzxO');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `personatges`
--
ALTER TABLE `personatges`
  ADD CONSTRAINT `personatges_ibfk_1` FOREIGN KEY (`usuari_id`) REFERENCES `usuaris` (`id_usuari`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
