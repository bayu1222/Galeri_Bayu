-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2024 at 02:10 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sosmed`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `albumId` int(11) NOT NULL,
  `namaAlbum` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl` date NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`albumId`, `namaAlbum`, `deskripsi`, `tgl`, `userId`) VALUES
(2, 'AlbumTest', 'Album percobaan sql', '2024-01-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `fotoId` int(11) NOT NULL,
  `judulFoto` varchar(255) NOT NULL,
  `dekripsiFoto` text NOT NULL,
  `tgl_upload` date NOT NULL,
  `directory` varchar(255) NOT NULL,
  `albumId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`fotoId`, `judulFoto`, `dekripsiFoto`, `tgl_upload`, `directory`, `albumId`, `userId`) VALUES
(6, 'foto', 'foto\r\n', '2024-01-31', 'uploads/logo.jpg', 1, 1),
(7, 'perpus', 'perpustakaan\r\n', '2024-02-03', 'uploads/Screenshot (76).png', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `komentarfoto`
--

CREATE TABLE `komentarfoto` (
  `komentarId` int(11) NOT NULL,
  `fotoId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tgl_komen` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `likefoto`
--

CREATE TABLE `likefoto` (
  `likeId` int(11) NOT NULL,
  `fotoId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `tgl_like` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likefoto`
--

INSERT INTO `likefoto` (`likeId`, `fotoId`, `userId`, `tgl_like`) VALUES
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 6, 1, '2024-01-31'),
(0, 7, 1, '2024-02-03'),
(0, 7, 1, '2024-02-05');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `username`, `password`, `email`, `nama_lengkap`, `alamat`) VALUES
(1, 'user', 'user', 'user@gmail.com', 'username', 'Majalengka'),
(2, 'admin', 'admin', 'bayu@mail.com', 'bayu', 'Wonosobo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`albumId`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`fotoId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `albumId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `fotoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
