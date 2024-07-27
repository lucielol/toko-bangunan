-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 26, 2024 at 01:47 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tokobangunan`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `deskripsi` text,
  `tanggal_dibuat` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `deskripsi`, `tanggal_dibuat`) VALUES
(2, 'Semen', 'Berbagai macam semen yang dijual di toko kami', '2024-07-25 18:01:07'),
(3, 'Alat & Bahan Bangunan', 'Berbagai macam alat dan bahan bangunan.', '2024-07-26 07:22:25');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `deskripsi` text,
  `harga` decimal(10,2) NOT NULL,
  `stok` int NOT NULL,
  `kategori_id` int DEFAULT NULL,
  `tanggal_dibuat` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `gambar_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `deskripsi`, `harga`, `stok`, `kategori_id`, `tanggal_dibuat`, `gambar_url`) VALUES
(1, 'Tiga Roda Portland Cement Type I', 'Indocement memproduksi PC Tipe I, PC Tipe I merupakan semen berkualitas tinggi yang cocok untuk berbagai macam aplikasi, seperti konstruksi gedung bertingkat, jembatan, dan jalan. SNI 2049:2015 ASTM C150-12 EN 197-1:2011', 78000.00, 20, 2, '2024-07-25 18:03:13', NULL),
(4, 'Semen Holcim', 'Semen paling bagus', 60000.00, 20, 2, '2024-07-26 07:20:46', 'https://mataharijaya.co.id/wp-content/uploads/2019/10/jual-semen-holcim-600x750.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `nomor_telepon` varchar(20) DEFAULT NULL,
  `alamat` text,
  `tanggal_dibuat` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `nama_lengkap`, `nomor_telepon`, `alamat`, `tanggal_dibuat`) VALUES
(1, 'revoalfaresi', '$2y$10$y4A.H5ZmIXPDEd6j0SSaYe1pbvuEzxW9PNUu6t9tYRKHdlB53id4i', 'revoalfaresi21@gmail.com', 'Moch Revo Alfaresi', '085156072066', 'Jl. Muhammad Ramdan Blok Lebak No.364 Kec. Jamblang Kab. Cirebon 45156', '2024-07-25 17:46:23'),
(2, 'ucupadingrat', '$2y$10$3BmpkaR8GAVYqf4C43EbqO0LsmYrrkK50rBR9ovf4KhD9OAmcga0i', 'ucupadiningrat21@gmail.com', 'Ahmad Maulana Yusuf', '08123457283', 'Perum', '2024-07-26 06:02:40'),
(3, 'ahmadanim', '$2y$10$aANnaAOGXgD9l12KI2tlWOQld60a.lKjEI5mbkyP4tqYfrZhiMZ5m', 'ahmadanim@gmail.com', 'Ahmad Anim Falahuddin', '082120450002', 'Cirebon', '2024-07-26 07:15:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
