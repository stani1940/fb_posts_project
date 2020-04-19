-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13 апр 2020 в 16:34
-- Версия на сървъра: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fb_posts`
--

-- --------------------------------------------------------

--
-- Структура на таблица `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_content` text NOT NULL,
  `date_added` datetime NOT NULL,
  `comment_edit` datetime DEFAULT NULL,
  `comment_delete` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `post_id`, `comment_content`, `date_added`, `comment_edit`, `comment_delete`) VALUES
(1, 25, 1, 'За протокола Лихтенщайн има много мощна индустрия за размерите си. Има повече индустрия от нас на глава от населението. Ако имаш пломба е много вероятно материалът за нея да е произведен в Лихтенщайн. Освен това вярвам всички сме чували за компанията Hilti (и да, има завод) и сме виждали основният ѝ продукт. Вярно, не става за ядене…', '2020-03-29 23:33:22', NULL, NULL),
(2, 25, 1, 'dsadsadas', '2020-03-31 17:43:55', NULL, NULL),
(3, 23, 20, 'Засрамиха се !!!!', '2020-04-09 00:00:00', NULL, NULL),
(4, 24, 1, 'Червени боклуци', '2020-04-09 15:36:36', NULL, NULL),
(5, 24, 1, 'Браво на другарите!!!', '2020-04-09 15:39:01', NULL, NULL),
(13, 24, 25, 'toshkotoshkotoshkotoshkotoshkotoshko', '2020-04-09 19:28:04', NULL, NULL),
(12, 24, 25, 'toshkotoshkotoshkotoshkotoshkotoshko', '2020-04-09 19:28:01', NULL, NULL),
(10, 24, 1, 'user_iduser_iduser_iduser_iduser_iduser_iduser_iduser_id', '2020-04-09 18:52:54', NULL, NULL),
(19, 24, 3, 'Браво на НАП', '2020-04-12 22:50:00', NULL, NULL),
(14, 24, 25, 'stanistanistanistanistanistani', '2020-04-09 19:29:13', NULL, NULL),
(15, 25, 25, 'sadsadasdasdasd', '2020-04-09 20:08:19', NULL, NULL),
(16, 24, 2, 'Ефектни и ефективни', '2020-04-09 22:17:19', NULL, NULL),
(17, 24, 21, 'ksndwidnw', '2020-04-09 22:51:17', NULL, NULL),
(18, 27, 4, 'Да бе да', '2020-04-12 21:23:11', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура на таблица `like_posts`
--

CREATE TABLE `like_posts` (
  `like_id` int(11) NOT NULL,
  `like_count` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `like_posts`
--

INSERT INTO `like_posts` (`like_id`, `like_count`, `user_id`, `post_id`) VALUES
(25, 1, 27, 1),
(20, 1, 25, 25),
(22, 1, 27, 4),
(23, 1, 24, 3),
(24, 1, 24, 2);

-- --------------------------------------------------------

--
-- Структура на таблица `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(300) NOT NULL,
  `post_content` longtext NOT NULL,
  `post_url` mediumtext NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `date_edit` datetime DEFAULT NULL,
  `post_delete` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `posts`
--

INSERT INTO `posts` (`post_id`, `post_title`, `post_content`, `post_url`, `image`, `date_added`, `date_edit`, `post_delete`, `user_id`) VALUES
(1, 'Никой не яде компютърни програми', 'Много се коментира за тази статия в Дума, и аз ще дам своите 2 стотинки по темата, понеже ми е близка до сърцето ( и джоба), и често говоря за данъци и заплати по конференции.\r\n\r\nНакратко, статията има няколко основни тези:\r\n\r\n    Програмистите не произвеждаме никакъв продукт\r\n    Взимаме много пари, така че може да си позволим да плащаме по-големи данъци\r\n    Чужди компании интелектуално обезкръвявават нацията, понеже работим за тях\r\n\r\nОще от първата теза става ясно, че хората смятащи я за вярна са амеби с тежка форма на кретенизъм. Все още не е ясно дали това е генетично заболяване или следствие от тежка травма на главата но има голяма корелация между завършилите „Карл Маркс“ и подкрепящите подобни идеи.\r\n\r\n\r\n                                                                ', 'https://www.duma.bg/nikoy-ne-yade-kompyutarni-programi-n208763', 'uploads/ai.jpg', '2020-03-29 23:29:43', '2020-04-09 17:25:48', NULL, 25),
(2, 'Използване на UV лампи за дезинфекция в домашни условия', 'Ще се опитам да съм много кратък. UV лампите може да са изключително ефективен начин да избиете всякакви вируси, дори в домашни условия НО, има няколко големи НО:\r\nСпектър\r\n\r\nUV спектъра е разделен на 3 основни категории A,B и C. Разликата между тях е честотната им лента.\r\n\r\nUV-A е с дължина на вълната между 315–400 нанометра, и това е основното UV което получаваме от слънцето. Тази светлина НЯМА анти бактериално или анти микробно действие.\r\n\r\nUV-B е с дължина на вълната 280–315 нанометра, и голяма част от този спектър се абсорбират от атмосферата, до земната повърхност пристига много малко количество. Те имат много слабо анти бактериално или анти микробно действие. Този спектър е необходим за образуването на Витамин D в тялото и той е виновен за слънчевите изгаряния и тена.\r\n\r\nUV-C е с дължина на вълната от 100–280 нанометра. Този спектър НЕ достига до земната повърхност, понеже е напълно абсорбиран от атмосферата. UV-C са изключително ефективни срещу всичко живо. Тази светлина могат да унищожат почти всяка бактерия или вирус, както и човешките клетки.\r\n\r\nТоест, ако искате да правите подобни неща, в идеалният случай, ви трябва лампа която излъчва ~254 нанометра. Такива са налични комерсиално, приличат на флуоресцентни лампи, но без бялото вътрешно покритие. Монтират се на стандартни фасунги, работят със стандартно напрежение и стандартен баласт. Накратко, просто я завивате и я пускате.\r\nЕфективност\r\n\r\nТози метод се използва с огромен успех от десетилетия за дезинфекция на операционни помещения, вода и какво ли още не. Понеже UV-C е много енергично, то буквално разбива „микроба“ и не му остава шанс да оцелее и развие „имунитет“.\r\n\r\n', 'https://gatakka.eu/?p=1849', 'uploads/uv_neon.jpg', '2020-03-31 18:16:44', NULL, NULL, 23),
(3, 'Как се декриптира криптиран компютър', 'Разбира се, че говоря за случая с атаката към НАП, последващите арести и конфискации на компютри. От фирмата обявиха, че няма да си декриптират компютрите, понеже в тях имало информация на техни контрагенти, и те са длъжни да я опазят. Не мога да коментирам юридическата част на този въпрос, явно по закон може. Това което искам да коментирам е информацията на ГДБОП, че са успели да декриптират тези машини.\r\n\r\nУау, честно. Това е впечатляващо. Казвам го без никакъв сарказъм. Да успееш да декриптираш криптирана файлова система за няколко дни е нещо изключително. Доста хора които се занимаваме със сигурност/криптография сме доста любопитни КАК са успели! И тук ще опиша няколко хипотези, които може да са спомогнали този процес. Искам да кажа, че това е мое мнение, спекулация и хипотетични разсъждения, нямам никаква „вътрешна“ информация. Използвам този конкретен случая за да обясня какви са принципните техники за подобен тип атаки.\r\nЛошо настроена криптография\r\n\r\n', 'https://www.mediapool.bg/kak-se-dekriptira-kriptiran-kompyutar-news296128.html', 'uploads/hacker.jpg', '2020-03-31 18:16:44', NULL, NULL, 25),
(4, 'Опасно ли е 5G?', 'Предполагам все от вас е чул термина 5G, но не всеки го разбира. Някой го асоциирате с по-бързи скорости, други с „факти„, че всички ще хванем рак, птиците ще измрат , ще настъпи 2-ри Чернобил…\r\n\r\nА така ли е? Преди да се опитам да дам яснота на този въпрос, нека да дам малко информация, за хората без технически познания.\r\nКакво точно е 5G?\r\n\r\n5G (5-th generation) е следващият стандарт за клетъчни мрежи. Тоест, това е стандарта който определя работни честоти, компресия, идентификация и всеки следващ стандарта може да направи устройство способно да комуникира с тази мрежа. Основното предимство на тази генерация е, че (на теория) може да работи със скорости над 1 Gb/s, забавянето на мрежата (latency) е под 10ms, има подобрена сигурност и един куп други дребни но важни неща.\r\n\r\nКазано по-просто, мрежата позволява по-бързи скорости на повече устройства на квадратен метър. И ето тук започват първите неразбирания. Щом е по-бърза значи е по-мощна, щом е по-мощна значи има повече „радиация“, значи е по-опасна… Ами не е точно така.\r\n\r\n\r\n ', 'https://gatakka.eu/?p=1810', 'uploads/5g.jpg', '2020-03-31 18:26:06', NULL, NULL, 23),
(20, 'Депутатите се отказаха от възнагражденията си по време на извънредното положение ', 'След продължителни дебати народните представители постигнаха консенсус.\r\n От 1-и април до отмяната на извънредното положение, вместо да получават повече пари заради скока на средната заплата в обществения сектор през последното тричесечие и да се разписват срещу най-малко 4248 лв., законотворците няма да вземат нито лев. Осигуровките и данъците обаче ще им бъдат внасяни, информира Dnes.bg\r\n\r\nА техните заплати ще отиват по сметката на здравното министерство за мерки срещу разпространението  на коронавируса.\r\nБез пари ще работят и министрите, както и шефове на изпълнителни и държавни агенции\r\n\r\nМярката обаче не засяга президента, който получава най-висока номинална заплата в страната - сумата е равна на две депутатски заплати.\r\n\r\nОкончателният вариант на решението за заплатите дойде от депутати от ГЕРБ, които промениха първоначалното си предложение те да бъдат замразени на нивото от 2019 г., когато са се разписвали за 3747 лв. основна сума.', 'https://www.investor.bg/ikonomika-i-politika/332/a/deputatite-se-otkazaha-ot-vyznagrajdeniiata-si-po-vreme-na-izvynrednoto-polojenie-301955/', 'uploads/wallet.jpg', '2020-04-06 21:57:15', NULL, NULL, 24),
(21, 'Защо мярката 60 на 40 ще си позволят много малък брой фирми ', 'Не бяха коментирани условията за покриване на възнаграждения на затворени фирми, посочи Мария Минчева, директор на правния отдел на БСК', 'https://www.investor.bg/nachalo/0/a/zashto-miarkata-60-na-40-shte-si-pozvoliat-mnogo-malyk-broi-firmi-301913/', 'uploads/bussiness_room.jpg', '2020-04-06 22:14:30', NULL, NULL, 24),
(25, 'Оптимизма на Wall Street продължава да нараства', 'По-слабият темп на нарастване на броят заразени с корона вирус поддържа инвеститорските настроения. ', 'https://www.investor.bg/sasht/337/a/optimizma-na-wall-street-prodyljava-da-narastva-302024/', 'uploads/dollar.jpg', '2020-04-07 18:38:19', NULL, NULL, 24);

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `second_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_register_date` datetime NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT 1,
  `user_banned` int(11) DEFAULT NULL,
  `img_path` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `second_name`, `last_name`, `user_email`, `user_password`, `user_register_date`, `user_type`, `user_banned`, `img_path`) VALUES
(23, 'Stanislav', 'Dobromirov', 'Ginev', 'stanislav1940@abv.bg', '$2y$10$WTAb8mSyg0ba3GPWPINlTeh8164volW/lnaCZixAHTS5hf0l0.PZy', '2020-04-03 10:49:42', 1, NULL, 'images/avatar_1.jpg'),
(24, 'Dimityr', 'Alexandrov', 'Georgiev', 'd@gmail.com', '$2y$10$9Ci19kR19lJHVXSASBitZeC5GlLYANpFlX3BuhnOgkidxaVrP9VXK', '2020-04-03 11:10:05', 2, NULL, 'images/avatar_3.png'),
(25, 'Toshko', 'Cvetanov', 'Tanchev', 't.tanchevv@abv.bg', '$2y$10$hizjQ2JQ1bLa.PdtE5IuEu/5VOz2MFR3Rl1IWoZ7qhd6MsHfFMpSe', '2020-04-09 16:13:58', 1, NULL, 'images/asd.jpg'),
(27, 'Georgi', 'Petrov', 'Dimitrov', 's@gmail.com', '$2y$10$JfCZM.5hBkS4iK6/IwLUBuPL7BiRDQJreN301hZj3n4A/AsQf0UJO', '2020-04-12 20:14:35', 2, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `like_posts`
--
ALTER TABLE `like_posts`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `like_posts`
--
ALTER TABLE `like_posts`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
