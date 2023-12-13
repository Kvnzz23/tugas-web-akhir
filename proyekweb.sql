-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 08:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyekweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin2`
--

CREATE TABLE `admin2` (
  `id_admin` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `passwordd` varchar(20) NOT NULL,
  `statuss` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin2`
--

INSERT INTO `admin2` (`id_admin`, `username`, `passwordd`, `statuss`) VALUES
(4, 'admin123', 'admin123', 'pekerja');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mhs` int(5) NOT NULL,
  `nim` varchar(9) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `id_wali` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mhs`, `nim`, `nama`, `jenis_kelamin`, `jurusan`, `alamat`, `id_wali`) VALUES
(2, '170204', 'parjo', 'laki laki', 'TEKNIK INFORMATIKA', 'jl kedasih 15a', 12);

-- --------------------------------------------------------

--
-- Table structure for table `wali_mhs`
--

CREATE TABLE `wali_mhs` (
  `id_wali` int(10) NOT NULL,
  `nama_wali` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wali_mhs`
--

INSERT INTO `wali_mhs` (`id_wali`, `nama_wali`, `jenis_kelamin`, `alamat`) VALUES
(11, 'kevin', 'laki', 'jl Rinjani Utara'),
(12, 'kevin', 'lakiiiiiiiiiiii', 'jl rinjaniiiiiiiiiiiiiiiiiiiiiiiiiiii'),
(15, 'hilna', 'perempuan', 'jl kedasih no 13a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin2`
--
ALTER TABLE `admin2`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mhs`),
  ADD KEY `id_wali` (`id_wali`);

--
-- Indexes for table `wali_mhs`
--
ALTER TABLE `wali_mhs`
  ADD PRIMARY KEY (`id_wali`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin2`
--
ALTER TABLE `admin2`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mhs` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wali_mhs`
--
ALTER TABLE `wali_mhs`
  MODIFY `id_wali` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`id_wali`) REFERENCES `wali_mhs` (`id_wali`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
