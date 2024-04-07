SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP DATABASE IF EXISTS `rentakar`;
CREATE DATABASE IF NOT EXISTS `rentakar` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `rentakar`;
CREATE TABLE `dlugosc_wypozyczenia` (
`id` int(10) unsigned
,`ilosc_dni` int(7)
);

CREATE TABLE `klienci` (
  `id` int(10) UNSIGNED NOT NULL,
  `imie` varchar(20) DEFAULT NULL,
  `nazwisko` varchar(30) DEFAULT NULL,
  `pesel` varchar(11) DEFAULT NULL,
  `nr_telefonu` varchar(9) DEFAULT NULL,
  `data_ur` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

TRUNCATE TABLE `klienci`;
INSERT INTO `klienci` (`id`, `imie`, `nazwisko`, `pesel`, `nr_telefonu`, `data_ur`) VALUES
(1, 'Aldona', 'Bajerska', '95061446144', '785126485', '1995-06-14'),
(2, 'Tymoteusz', 'Ciesielski', '99081690338', '789612468', '1999-08-16'),
(3, 'Kornel', 'Zywiec', '85121806256', '843216978', '1985-12-18'),
(4, 'Teodor', 'Sokolnicki', '83102893956', '248659326', '1983-10-28'),
(5, 'Alan', 'Niksa', '01210107152', '175496238', '2001-01-01'),
(6, 'Hieronim', 'Krokosz', '03271246333', '784126953', '2003-07-12'),
(7, 'Zofia', 'Knapek', '92042530742', '789654123', '1992-04-25'),
(8, 'Marcel', 'Bala', '96093040353', '123456789', '1996-09-30'),
(9, 'Paulina', 'Predka', '99091961882', '987654321', '1999-09-19'),
(10, 'Waclaw', 'Nogiec', '79042636579', '147258369', '1979-04-26'),
(11, 'Marlena', 'Miara', '97030797341', '369258147', '1997-03-07'),
(12, 'Edward', 'Gontarek', '02220247715', '321654987', '2002-02-02'),
(13, 'Kamila', 'Jaroszewska', '85051912740', '753951486', '1985-05-19'),
(14, 'Marzena', 'Stasiewicz', '94081473541', '963258456', '1994-08-14'),
(15, 'Magda', 'Maj', '03230385420', '555777482', '2003-03-03'),
(16, 'Karol', 'Strojek', '93011389013', '654564454', '1993-01-13'),
(17, 'Jaroslaw', 'Drapal', '82062202259', '784256115', '1982-06-22'),
(18, 'Alojzy', 'Kesik', '80101019617', '986512444', '1980-10-10'),
(19, 'Bogumil', 'Antonik', '70071461273', '784256333', '1970-07-14'),
(20, 'Gracjan', 'Mackiewicz', '99111929753', '456812596', '1999-11-19'),
(21, 'Daria', 'Jelonek', '82101273266', '787989585', '1982-10-12'),
(22, 'Tobiasz', 'Uss', '87051949474', '126786456', '1987-05-19'),
(23, 'Seweryn', 'Golas', '04240446653', '323232111', '2004-04-04'),
(24, 'Henryk', 'Rodzynek', '05250550914', '845845787', '2005-05-05'),
(25, 'Wincenty', 'Piwko', '96060613618', '956659231', '1996-06-06');
CREATE TABLE `klienci_duzymi_literami` (
`duze` varchar(51)
);

CREATE TABLE `pracownicy` (
  `id` int(10) UNSIGNED NOT NULL,
  `imie` varchar(20) DEFAULT NULL,
  `nazwisko` varchar(30) DEFAULT NULL,
  `pesel` varchar(11) DEFAULT NULL,
  `plec` varchar(1) DEFAULT NULL,
  `data_ur` date DEFAULT NULL,
  `mail` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

TRUNCATE TABLE `pracownicy`;
INSERT INTO `pracownicy` (`id`, `imie`, `nazwisko`, `pesel`, `plec`, `data_ur`, `mail`) VALUES
(1, 'Bartosz', 'Czosynka', '80061862515', 'M', '1980-06-18', 'bartoszczosynka@yahoo.com'),
(2, 'Antonina', 'Kotyrba', '90100496662', 'K', '1990-10-04', 'antoninakotyrba@interia.eu'),
(3, 'Lucyna', 'Kosiba', '93121133269', 'K', '1993-12-11', 'lucynakosiba@outlook.com'),
(4, 'Janusz', 'Ksiazkiewicz', '00210817959', 'M', '2000-11-08', 'januszksiazkiewicz@gmail.com'),
(5, 'Agata', 'Konczyk', '79081996766', 'K', '1979-08-19', 'agatakonczyk@yahoo.com'),
(6, 'Ireneusz', 'Olechnowicz', '82080991371', 'M', '1982-08-09', 'ireneuszolechnowicz@outlook.com'),
(7, 'Rafal', 'Linka', '88040744574', 'M', '1988-04-07', 'rafallinka@interia.eu'),
(8, 'Sara', 'Wadolowska', '93020618643', 'K', '1993-02-06', 'sarawadolowska@yahoo.com'),
(9, 'Bogumil', 'Wlodkowski', '96071979876', 'M', '1996-07-19', 'bogumilwlodkowski@o2.pl'),
(10, 'Czeslaw', 'Niemen', '94110263596', 'M', '1994-11-02', 'czeslawniemen@yahoo.com'),
(11, 'Artur', 'Buczak', '04270792818', 'M', '2004-07-07', 'arturbuczak@gmail.com'),
(12, 'Maria', 'Jarzebska', '81050442426', 'K', '1981-05-04', 'mariajarzebska@interia.eu'),
(13, 'Matylda', 'Bogusz', '89090895461', 'K', '1989-09-08', 'matyldabogusz@wp.pl'),
(14, 'Bohdan', 'Goluchowski', '94020614612', 'M', '1994-02-06', 'bohdangoluchowski@wp.pl'),
(15, 'Dominik', 'Brodowski', '87041687496', 'M', '1987-04-16', 'dominikbrodowski@interia.eu'),
(16, 'Zbigniew', 'Sochocki', '03282094813', 'M', '2003-08-20', 'zbigniewsochocki@outlook.com'),
(17, 'Iwona', 'Kruszewska', '93091288888', 'K', '1993-09-10', 'iwonakruszewska@yahoo.com'),
(18, 'Stanislaw', 'Hawryluk', '06211169675', 'M', '2006-11-11', 'stanislawhawryluk@o2.pl'),
(19, 'Norbert', 'Hawryluk', '04040762397', 'M', '2004-04-07', 'norberthawryluk@outlook.com'),
(20, 'Leokadia', 'Wicha', '05322019648', 'K', '2005-02-20', 'leokadiawicha@o2.pl'),
(21, 'Kajetan', 'Wojtyla', '92101613238', 'M', '1992-11-16', 'kajetanwojtyla@gmail.com'),
(22, 'Roksana', 'Rybka', '92120829264', 'K', '1992-12-08', 'roksanarybka@o2.pl'),
(23, 'Igor', 'Goryl', '93111537535', 'M', '1993-11-15', 'igorgoryl@yahoo.com'),
(24, 'Wieslawa', 'Brudna', '01311281722', 'K', '2001-01-12', 'wieslawabrudna@gmail.com'),
(25, 'Zygmunt', 'Firek', '01052275112', 'M', '2001-05-22', 'zygmuntfirek@outlook.com');
CREATE TABLE `pracownicy_mezczyzni` (
`imie` varchar(20)
,`nazwisko` varchar(30)
);

CREATE TABLE `samochody` (
  `id` int(10) UNSIGNED NOT NULL,
  `nr_rejestracyjny` varchar(8) DEFAULT NULL,
  `marka` varchar(20) DEFAULT NULL,
  `model` varchar(20) DEFAULT NULL,
  `rocznik` varchar(4) DEFAULT NULL,
  `cena_za_dzien` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

TRUNCATE TABLE `samochody`;
INSERT INTO `samochody` (`id`, `nr_rejestracyjny`, `marka`, `model`, `rocznik`, `cena_za_dzien`) VALUES
(1, 'NO1314K', 'Ford', 'Mondeo', '2010', 300),
(2, 'NO1076V', 'Toyota', 'Yaris', '2019', 297),
(3, 'NO456F5', 'Jaguar', 'F-pace', '2021', 550),
(4, 'NO915Y4', 'Honda', 'Jazz', '2009', 230),
(5, 'NO6721S', 'Opel', 'Astra', '2013', 250),
(6, 'NO5547R', 'Ford', 'Mondeo', '2017', 340),
(7, 'NO4594G', 'Kia', 'Ceed', '2017', 265),
(8, 'NO63N7P', 'BMW', '1', '2022', 460),
(9, 'NO7852D', 'Toyota', 'Aygo', '2023', 270),
(10, 'NO64R3L', 'Renault', 'Megane', '2016', 320),
(11, 'NO1503F', 'Toyota', 'Corolla', '2015', 190),
(12, 'NO42M9A', 'Seat', 'Leon', '2019', 316),
(13, 'NO6R404', 'Volkswagen', 'Golf', '2019', 340),
(14, 'NO6K940', 'Skoda', 'Fabia', '2016', 197),
(15, 'NO678H5', 'Mazda', '6', '2020', 339),
(16, 'NO90654', 'Peugeot', '308', '2013', 308),
(17, 'NO95D3O', 'Honda', 'Civic', '2012', 306),
(18, 'NO63G90', 'Porsche', '911', '2016', 409),
(19, 'NO67E3B', 'Mazda', 'MX-5', '1995', 207),
(20, 'NO347RP', 'Citroen', 'C5', '2019', 374),
(21, 'NO45F76', 'Fiat', '126p', '1980', 201),
(22, 'NO087BW', 'Audi', 'Q5', '2018', 311),
(23, 'NO970P3', 'Kia', 'Ceed', '2017', 367),
(24, 'NO57VE3', 'Volkswagen', 'Arteon', '2016', 407),
(25, 'NO784FT', 'Ford', 'Transit', '2007', 305);
CREATE TABLE `wszyscy_klienci` (
`id` int(10) unsigned
,`imie` varchar(20)
,`nazwisko` varchar(30)
);

CREATE TABLE `wypozyczenia` (
  `id` int(10) UNSIGNED NOT NULL,
  `pracownicy_id` int(10) UNSIGNED NOT NULL,
  `klienci_id` int(10) UNSIGNED NOT NULL,
  `samochody_id` int(10) UNSIGNED NOT NULL,
  `data_wypozyczenia` date DEFAULT NULL,
  `data_zwrotu` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

TRUNCATE TABLE `wypozyczenia`;
INSERT INTO `wypozyczenia` (`id`, `pracownicy_id`, `klienci_id`, `samochody_id`, `data_wypozyczenia`, `data_zwrotu`) VALUES
(1, 5, 1, 3, '2023-09-12', '2023-09-20'),
(2, 15, 25, 6, '2023-01-01', '2023-02-01'),
(3, 11, 17, 9, '2023-02-23', '2023-02-25'),
(4, 1, 22, 2, '2023-03-21', '2023-03-23'),
(5, 8, 16, 4, '2023-12-22', '2023-12-24'),
(6, 23, 7, 8, '2023-10-17', '2023-10-20'),
(7, 6, 2, 10, '2023-07-10', '2023-07-14'),
(8, 2, 1, 12, '2023-05-18', '2023-05-22'),
(9, 25, 6, 20, '2023-08-08', '2023-08-10'),
(10, 4, 4, 24, '2023-09-13', '2023-09-14'),
(11, 17, 1, 6, '2023-08-09', '2023-08-14'),
(12, 3, 11, 14, '2023-11-15', '2023-11-19'),
(13, 12, 17, 18, '2023-03-15', '2023-04-01'),
(14, 6, 12, 22, '2023-05-08', '2023-05-10'),
(15, 22, 20, 1, '2023-11-01', '2023-11-15'),
(16, 14, 24, 23, '2023-04-19', '2023-04-21'),
(17, 7, 25, 17, '2023-06-13', '2023-06-16'),
(18, 24, 10, 15, '2023-05-15', '2023-05-16'),
(19, 9, 3, 6, '2023-07-14', '2023-07-18'),
(20, 10, 2, 3, '2023-08-19', '2023-08-23'),
(21, 17, 18, 21, '2023-02-26', '2023-03-03'),
(22, 18, 21, 19, '2023-06-29', '2023-07-06'),
(23, 13, 18, 13, '2023-10-10', '2023-11-11'),
(24, 5, 16, 9, '2023-06-04', '2023-06-10'),
(25, 14, 20, 7, '2023-02-13', '2023-02-17'),
(26, 24, 19, 25, '2023-12-02', '2023-12-12'),
(27, 8, 22, 23, '2023-09-13', '2023-09-19'),
(28, 25, 14, 24, '2023-04-19', '2023-04-23'),
(29, 9, 12, 12, '2023-05-15', '2023-05-19'),
(30, 8, 13, 1, '2023-11-19', '2023-11-21'),
(31, 1, 18, 18, '2023-07-14', '2023-07-23'),
(32, 19, 10, 16, '2023-06-21', '2023-06-27'),
(33, 12, 19, 17, '2023-04-28', '2023-05-01'),
(34, 3, 14, 8, '2023-06-30', '2023-07-10'),
(35, 9, 17, 12, '2023-08-13', '2023-08-15'),
(36, 16, 13, 23, '2023-09-01', '2023-09-02'),
(37, 20, 19, 21, '2023-12-01', '2023-12-04'),
(38, 17, 25, 22, '2023-06-08', '2023-06-15'),
(39, 13, 2, 14, '2023-02-18', '2023-03-16'),
(40, 16, 6, 19, '2023-08-15', '2023-10-15'),
(41, 4, 4, 20, '2023-06-13', '2023-06-20');
DROP TABLE IF EXISTS `dlugosc_wypozyczenia`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dlugosc_wypozyczenia`  AS SELECT `wypozyczenia`.`id` AS `id`, to_days(`wypozyczenia`.`data_zwrotu`) - to_days(`wypozyczenia`.`data_wypozyczenia`) AS `ilosc_dni` FROM `wypozyczenia` ;
DROP TABLE IF EXISTS `klienci_duzymi_literami`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `klienci_duzymi_literami`  AS SELECT ucase(concat(`klienci`.`imie`,' ',`klienci`.`nazwisko`)) AS `duze` FROM `klienci` ;
DROP TABLE IF EXISTS `pracownicy_mezczyzni`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pracownicy_mezczyzni`  AS SELECT `pracownicy`.`imie` AS `imie`, `pracownicy`.`nazwisko` AS `nazwisko` FROM `pracownicy` WHERE `pracownicy`.`plec` = 'M' ;
DROP TABLE IF EXISTS `wszyscy_klienci`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `wszyscy_klienci`  AS SELECT `klienci`.`id` AS `id`, `klienci`.`imie` AS `imie`, `klienci`.`nazwisko` AS `nazwisko` FROM `klienci` ;


ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `pracownicy`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `samochody`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `wypozyczenia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wypozyczenia_FKIndex1` (`pracownicy_id`),
  ADD KEY `wypozyczenia_FKIndex2` (`klienci_id`),
  ADD KEY `wypozyczenia_FKIndex3` (`samochody_id`);


ALTER TABLE `klienci`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

ALTER TABLE `pracownicy`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

ALTER TABLE `samochody`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

ALTER TABLE `wypozyczenia`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;


ALTER TABLE `wypozyczenia`
  ADD CONSTRAINT `wypozyczenia_ibfk_1` FOREIGN KEY (`pracownicy_id`) REFERENCES `pracownicy` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  ADD CONSTRAINT `wypozyczenia_ibfk_2` FOREIGN KEY (`klienci_id`) REFERENCES `klienci` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  ADD CONSTRAINT `wypozyczenia_ibfk_3` FOREIGN KEY (`samochody_id`) REFERENCES `samochody` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
