-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jul 2019 pada 02.58
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_training`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tcertificate`
--

CREATE TABLE `tcertificate` (
  `fcertificateid` int(11) NOT NULL,
  `fcertificatenumber` varchar(255) NOT NULL,
  `ftrainplanid` int(11) NOT NULL,
  `fusercertif` bigint(20) NOT NULL,
  `fmediaid` int(11) NOT NULL,
  `fcertificatestatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tcertificate`
--

INSERT INTO `tcertificate` (`fcertificateid`, `fcertificatenumber`, `ftrainplanid`, `fusercertif`, `fmediaid`, `fcertificatestatus`, `created_at`, `updated_at`) VALUES
(2, 'CERT-001', 1, 8, 0, 1, '2019-07-07 02:30:40', NULL),
(3, 'Cert-0012', 1, 8, 0, 1, '2019-07-07 09:05:02', '2019-07-07 09:23:11'),
(4, 'CERT-003', 1, 8, 2, 1, '2019-07-07 09:33:00', NULL),
(5, '123456', 1, 8, 3, 1, '2019-07-07 09:34:58', NULL),
(8, 'qwerty', 1, 8, 5, 1, '2019-07-07 09:43:05', NULL),
(9, 'qwerty144', 1, 8, 8, 0, '2019-07-07 09:44:34', '2019-07-07 10:15:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmedia`
--

CREATE TABLE `tmedia` (
  `fmediaid` int(11) UNSIGNED NOT NULL,
  `fmediaoriginalname` varchar(200) DEFAULT NULL,
  `fmediatype` varchar(10) DEFAULT NULL,
  `fmediapath` varchar(300) DEFAULT NULL,
  `fuserid` int(11) DEFAULT NULL,
  `fmediatimestamp` timestamp NULL DEFAULT NULL,
  `fmediastatus` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tmedia`
--

INSERT INTO `tmedia` (`fmediaid`, `fmediaoriginalname`, `fmediatype`, `fmediapath`, `fuserid`, `fmediatimestamp`, `fmediastatus`) VALUES
(1, 'module_5874583f789d58b7718dcf32f812daab.JPG', 'image/jpeg', '/assets/backend/media/uploads/module_5874583f789d58b7718dcf32f812daab.JPG', 1, '0000-00-00 00:00:00', 1),
(2, 'module_67ea46486d387976e8ae614024c9cc98.JPG', 'image/jpeg', '/assets/backend/media/uploads/module_67ea46486d387976e8ae614024c9cc98.JPG', 1, '0000-00-00 00:00:00', 1),
(3, 'module_6774b4e2c08b592d76c2ba5b4cbacd5d.JPG', 'image/jpeg', '/assets/backend/media/uploads/module_6774b4e2c08b592d76c2ba5b4cbacd5d.JPG', 1, '0000-00-00 00:00:00', 1),
(4, 'module_64dcb4385cd6e9a3880a77ea0d465a5d.JPG', 'image/jpeg', '/assets/backend/media/uploads/module_64dcb4385cd6e9a3880a77ea0d465a5d.JPG', 1, '0000-00-00 00:00:00', 1),
(5, 'module_39711027dd95d6a5dfda24d14af71c4f.JPG', 'image/jpeg', '/assets/backend/media/uploads/module_39711027dd95d6a5dfda24d14af71c4f.JPG', 1, '0000-00-00 00:00:00', 1),
(6, 'module_05530d032def5c26549c04ef1fcfaa22.JPG', 'image/jpeg', '/assets/backend/media/uploads/module_05530d032def5c26549c04ef1fcfaa22.JPG', 1, '0000-00-00 00:00:00', 1),
(7, 'module_ca63f5bbe511c317fa0ab37a4c173669.JPG', 'image/jpeg', '/assets/backend/media/uploads/module_ca63f5bbe511c317fa0ab37a4c173669.JPG', 1, '0000-00-00 00:00:00', 1),
(8, 'module_82e705462e010c472729f5b8382f31f3.jpg', 'image/jpeg', '/assets/backend/media/uploads/module_82e705462e010c472729f5b8382f31f3.jpg', 1, '0000-00-00 00:00:00', 1),
(9, 'module_7ae4eb7de077fa246a4850c2a387a450.pdf', 'applicatio', '/assets/backend/media/uploads/module_7ae4eb7de077fa246a4850c2a387a450.pdf', 11, '0000-00-00 00:00:00', 1),
(10, 'module_2cdbfbe9a2c526f4c160e85ead713500.pdf', 'applicatio', '/assets/backend/media/uploads/module_2cdbfbe9a2c526f4c160e85ead713500.pdf', 11, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmodule`
--

CREATE TABLE `tmodule` (
  `fmoduleid` int(11) NOT NULL,
  `fmodulename` varchar(255) NOT NULL,
  `fmediaid` int(11) NOT NULL,
  `fmodulestatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tmodule`
--

INSERT INTO `tmodule` (`fmoduleid`, `fmodulename`, `fmediaid`, `fmodulestatus`, `created_at`, `updated_at`) VALUES
(2, 'module', 7, 1, '2019-07-06 02:11:39', '2019-07-07 19:05:07'),
(7, 'xxx', 10, 1, '2019-07-07 18:37:46', '2019-07-07 19:04:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tposition`
--

CREATE TABLE `tposition` (
  `fpositionid` int(11) NOT NULL,
  `fpositionname` varchar(100) NOT NULL,
  `fpositionstatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tposition`
--

INSERT INTO `tposition` (`fpositionid`, `fpositionname`, `fpositionstatus`, `created_at`, `updated_at`) VALUES
(1, 'Manager', 1, NULL, NULL),
(3, 'IT Staff', 1, '2019-07-05 20:51:14', '2019-07-05 20:56:57'),
(4, 'Member biasa', 1, '2019-07-06 23:00:38', NULL),
(6, 'guru', 1, '2019-07-07 18:15:18', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trole`
--

CREATE TABLE `trole` (
  `froleid` int(11) NOT NULL,
  `frolename` varchar(100) NOT NULL,
  `frolestatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `trole`
--

INSERT INTO `trole` (`froleid`, `frolename`, `frolestatus`) VALUES
(1, 'Super Admin', 1),
(2, 'Member', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ttrainingmeta`
--

CREATE TABLE `ttrainingmeta` (
  `ftrainingmetaid` int(11) NOT NULL,
  `ftrainplanid` int(11) NOT NULL,
  `fmetakey` varchar(255) NOT NULL,
  `fmetavalue` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ttrainingplan`
--

CREATE TABLE `ttrainingplan` (
  `ftrainplanid` bigint(20) NOT NULL,
  `ftrainplanname` varchar(100) NOT NULL,
  `ftraintypeid` bigint(20) NOT NULL,
  `ftrainmember` text NOT NULL,
  `ftrainstartdate` date NOT NULL,
  `ftrainenddate` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ftrainingstatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ttrainingplan`
--

INSERT INTO `ttrainingplan` (`ftrainplanid`, `ftrainplanname`, `ftraintypeid`, `ftrainmember`, `ftrainstartdate`, `ftrainenddate`, `created_at`, `updated_at`, `ftrainingstatus`) VALUES
(1, 'Trainplane', 1, 'a:1:{i:0;a:4:{s:7:\"fuserid\";s:1:\"8\";s:9:\"fusername\";s:7:\"Aldiyan\";s:11:\"fpositionid\";s:1:\"3\";s:13:\"fpositionname\";s:8:\"IT Staff\";}}', '2019-06-18', '2019-07-05', '2019-07-06 20:26:23', '2019-07-06 17:00:00', 1),
(2, 'eee network', 1, 'a:2:{i:0;a:4:{s:7:\"fuserid\";s:1:\"8\";s:9:\"fusername\";s:7:\"Aldiyan\";s:11:\"fpositionid\";s:1:\"3\";s:13:\"fpositionname\";s:8:\"IT Staff\";}i:1;a:4:{s:7:\"fuserid\";s:1:\"9\";s:9:\"fusername\";s:5:\"roman\";s:11:\"fpositionid\";s:1:\"1\";s:13:\"fpositionname\";s:7:\"Manager\";}}', '2019-07-14', '2019-07-31', '2019-07-06 21:46:52', '2019-07-06 22:57:16', 1),
(3, 'Train to Bus2', 1, 'a:1:{i:0;a:4:{s:7:\"fuserid\";s:1:\"8\";s:9:\"fusername\";s:7:\"Aldiyan\";s:11:\"fpositionid\";s:1:\"3\";s:13:\"fpositionname\";s:8:\"IT Staff\";}}', '2019-06-01', '2019-08-23', '2019-07-07 09:24:08', '2019-07-06 17:00:00', 1),
(4, '1234', 1, 'a:1:{i:0;a:4:{s:7:\"fuserid\";s:1:\"8\";s:9:\"fusername\";s:7:\"Aldiyan\";s:11:\"fpositionid\";s:1:\"1\";s:13:\"fpositionname\";s:7:\"Manager\";}}', '2019-07-01', '2019-07-15', '2019-07-07 09:34:41', NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ttrainingtype`
--

CREATE TABLE `ttrainingtype` (
  `ftraintypeid` int(11) NOT NULL,
  `ftraintypename` varchar(100) NOT NULL,
  `ftraintypestatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ttrainingtype`
--

INSERT INTO `ttrainingtype` (`ftraintypeid`, `ftraintypename`, `ftraintypestatus`, `created_at`, `updated_at`) VALUES
(1, 'IT Industry', 1, '2019-07-06 08:40:55', '2019-07-06 08:41:47'),
(2, 'Youtube', 1, '2019-07-07 19:05:19', '2019-07-07 19:05:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tusers`
--

CREATE TABLE `tusers` (
  `fuserid` int(10) UNSIGNED NOT NULL,
  `froleid` int(11) NOT NULL,
  `fusername` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuseremail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuserpassword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuseraddress` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fnik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fnpwp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fusersoftskill` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuserhardskill` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuserbirthdate` date NOT NULL,
  `fremembermetoken` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fuserstatus` int(11) NOT NULL,
  `fporgotcode` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tusers`
--

INSERT INTO `tusers` (`fuserid`, `froleid`, `fusername`, `fuseremail`, `fuserpassword`, `fuseraddress`, `fnik`, `fnpwp`, `fusersoftskill`, `fuserhardskill`, `fuserbirthdate`, `fremembermetoken`, `fuserstatus`, `fporgotcode`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin@123.com', 'fcea920f7412b5da7be0cf42b8c93759', 'Jl.Widuri no.94 Banyuwangi', '9000000009', '9000000009', 'menulis', 'hardskill', '1999-01-05', NULL, 1, NULL, '2019-07-04 17:00:00', NULL),
(8, 2, 'Aldiyan', 'aldian@train.com', 'e10adc3949ba59abbe56e057f20f883e', 'jl. widuri', '9929299', '99999999', '', '', '2019-07-23', NULL, 1, NULL, '2019-07-06 18:15:45', NULL),
(9, 2, 'roman', 'wildan00x@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'jl.endah', '999999', '999999', '', '', '2019-07-09', NULL, 1, '', '2019-07-06 18:22:00', NULL),
(11, 1, 'Hanum', 'hanum@yahoo.co.id', 'e10adc3949ba59abbe56e057f20f883e', 'Banyuwangi', '', '', '', '', '2019-06-30', NULL, 1, NULL, '2019-07-07 17:23:15', NULL),
(12, 2, '123456', 'yy@yyy.com', 'e10adc3949ba59abbe56e057f20f883e', '12345', '1234567', '123456', '', '', '2019-07-22', NULL, 1, NULL, '2019-07-07 18:13:36', NULL),
(13, 1, 'yuyu', 'rrrrr@tttttt.com', 'e10adc3949ba59abbe56e057f20f883e', '123456qwe', '', '', '', '', '2019-07-01', NULL, 1, NULL, '2019-07-07 18:14:12', NULL),
(14, 2, '123456', 'rrrr@ee.com', 'e10adc3949ba59abbe56e057f20f883e', '123456', '123456', '12345', '', '', '2019-07-22', NULL, 1, NULL, '2019-07-07 19:25:02', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `tcertificate`
--
ALTER TABLE `tcertificate`
  ADD PRIMARY KEY (`fcertificateid`);

--
-- Indeks untuk tabel `tmedia`
--
ALTER TABLE `tmedia`
  ADD PRIMARY KEY (`fmediaid`);

--
-- Indeks untuk tabel `tmodule`
--
ALTER TABLE `tmodule`
  ADD PRIMARY KEY (`fmoduleid`);

--
-- Indeks untuk tabel `tposition`
--
ALTER TABLE `tposition`
  ADD PRIMARY KEY (`fpositionid`);

--
-- Indeks untuk tabel `trole`
--
ALTER TABLE `trole`
  ADD PRIMARY KEY (`froleid`);

--
-- Indeks untuk tabel `ttrainingplan`
--
ALTER TABLE `ttrainingplan`
  ADD PRIMARY KEY (`ftrainplanid`);

--
-- Indeks untuk tabel `ttrainingtype`
--
ALTER TABLE `ttrainingtype`
  ADD PRIMARY KEY (`ftraintypeid`);

--
-- Indeks untuk tabel `tusers`
--
ALTER TABLE `tusers`
  ADD PRIMARY KEY (`fuserid`),
  ADD UNIQUE KEY `users_email_unique` (`fuseremail`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tcertificate`
--
ALTER TABLE `tcertificate`
  MODIFY `fcertificateid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tmedia`
--
ALTER TABLE `tmedia`
  MODIFY `fmediaid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tmodule`
--
ALTER TABLE `tmodule`
  MODIFY `fmoduleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tposition`
--
ALTER TABLE `tposition`
  MODIFY `fpositionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `trole`
--
ALTER TABLE `trole`
  MODIFY `froleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ttrainingplan`
--
ALTER TABLE `ttrainingplan`
  MODIFY `ftrainplanid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ttrainingtype`
--
ALTER TABLE `ttrainingtype`
  MODIFY `ftraintypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tusers`
--
ALTER TABLE `tusers`
  MODIFY `fuserid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
