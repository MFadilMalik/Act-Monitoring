-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Apr 2020 pada 10.53
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `act_monitor`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_guru`
--

CREATE TABLE `data_guru` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_siswa`
--

CREATE TABLE `data_siswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_siswa`
--

INSERT INTO `data_siswa` (`id`, `nama`, `username`, `password`) VALUES
(1, '11806708 Muhamad Fadil Malik', '11806708', '11806708'),
(2, '18181818 Lele', '18181818', '18181818');

--
-- Trigger `data_siswa`
--
DELIMITER $$
CREATE TRIGGER `edit_data` AFTER UPDATE ON `data_siswa` FOR EACH ROW UPDATE user
SET
nama = NEW.nama,
password = NEW.password
WHERE
username = NEW.username
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_jadwal`
--

CREATE TABLE `detail_jadwal` (
  `idKegiatan` int(11) NOT NULL,
  `nis` varchar(8) NOT NULL,
  `hari` varchar(225) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` varchar(225) NOT NULL,
  `jam_akhir` varchar(225) NOT NULL,
  `aktifitas` varchar(225) NOT NULL,
  `mapel` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_jadwal`
--

INSERT INTO `detail_jadwal` (`idKegiatan`, `nis`, `hari`, `tanggal`, `jam_mulai`, `jam_akhir`, `aktifitas`, `mapel`) VALUES
(2, '11806708', 'Kamis', '2020-04-24', '04:45', '05:00', 'Sholat subuh', 'PAI'),
(3, '18181818', 'Senin', '2020-04-06', '07:00', '08:00', 'Upacara', 'PPKN'),
(4, '11806708', 'Jumat', '2020-04-25', '03:00', '04:00', 'Sahur', 'PAI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `upload_data`
--

CREATE TABLE `upload_data` (
  `id` int(11) NOT NULL,
  `FILE_NAME` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `akses` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `akses`) VALUES
(1, 'ADMIN-1', 'admin', 'admin', 'Administrator'),
(3, '11806708 Muhamad Fadil Malik', '11806708', '11806708', 'Peserta Didik'),
(4, '18181818 Lele', '18181818', '18181818', 'Peserta Didik'),
(5, 'ADMIN-2', 'adm', 'adm', 'Administrator'),
(6, 'GURU-1', 'pakbu', '201605pakbu', 'Guru');

--
-- Trigger `user`
--
DELIMITER $$
CREATE TRIGGER `add_siswa` AFTER INSERT ON `user` FOR EACH ROW IF (NEW.akses = "Peserta Didik") THEN
	INSERT INTO data_siswa SET
	nama = NEW.nama,
	username = NEW.username,
	password = NEW.password;
 END IF
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_guru`
--
ALTER TABLE `data_guru`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_jadwal`
--
ALTER TABLE `detail_jadwal`
  ADD PRIMARY KEY (`idKegiatan`);

--
-- Indeks untuk tabel `upload_data`
--
ALTER TABLE `upload_data`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_guru`
--
ALTER TABLE `data_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `detail_jadwal`
--
ALTER TABLE `detail_jadwal`
  MODIFY `idKegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `upload_data`
--
ALTER TABLE `upload_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
