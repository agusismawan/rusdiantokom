-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2018 at 03:47 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pkl`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `status` int(11) NOT NULL,
  `level_akses` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`status`, `level_akses`) VALUES
(1, 'Administrator'),
(2, 'Kasir'),
(3, 'Manager'),
(4, 'Supplier');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(40) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_merk` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_jual` varchar(100) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `id_kategori`, `id_merk`, `id`, `stok`, `harga_jual`, `date_added`) VALUES
(18, 'M180BT', 'Speaker Advance', 18, 1, 5, 10, '300000', '2018-11-21 06:18:16'),
(19, 'K120', 'Keyboard Logitech K120 For Bussines', 17, 2, 0, 10, '130000', '2018-11-21 07:01:29'),
(31, 'CST11', 'Speaker Simbadda CST1100N+', 18, 5, 4, 9, '470000', '2018-11-21 07:01:46'),
(32, 'CST20', 'Speaker Simbadda CST2000n+', 18, 5, 4, 10, '335000', '2018-11-21 06:17:49'),
(33, 'CST19', 'Speaker Simbadda CST1900n+', 18, 5, 4, 10, '420000', '2018-11-21 06:17:49'),
(34, 'SGQ5', 'Speaker Sonicgear Quatro V ', 18, 3, 4, 10, '170000', '2018-11-21 06:17:49'),
(35, 'S19A', 'LED Monitor Samsung S19A100N', 19, 6, 4, 5, '745000', '2018-11-21 06:17:49'),
(37, 'NC-32', 'Cooling Pad Laptop Ace NC-32', 20, 8, 4, 10, '45000', '2018-11-21 06:17:49'),
(41, 'DW167', 'Speaker Dazumba Portable DW Mic', 18, 4, 5, 10, '345000', '2018-11-22 01:21:34');

-- --------------------------------------------------------

--
-- Table structure for table `detail_permintaan`
--

CREATE TABLE `detail_permintaan` (
  `dp_id` int(11) NOT NULL,
  `permintaan_id` bigint(11) UNSIGNED NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `dp_jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_permintaan`
--

INSERT INTO `detail_permintaan` (`dp_id`, `permintaan_id`, `kode_barang`, `dp_jumlah`) VALUES
(5, 5, 'CST11', 14),
(6, 5, 'CST20', 23);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(16, 'Mouse'),
(17, 'Keyboard'),
(18, 'Speaker'),
(19, 'Monitor'),
(20, 'Cooling Pad');

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE `merk` (
  `id_merk` int(11) NOT NULL,
  `nama_merk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merk`
--

INSERT INTO `merk` (`id_merk`, `nama_merk`) VALUES
(1, 'Advance'),
(2, 'Logitech'),
(3, 'Sonicgear'),
(4, 'Dazumba'),
(5, 'Simbadda'),
(6, 'Samsung'),
(7, 'Dell'),
(8, 'ACE');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pel` int(11) NOT NULL,
  `nama_pel` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `notlp` varchar(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permintaan`
--

CREATE TABLE `permintaan` (
  `permintaan_id` bigint(11) UNSIGNED NOT NULL,
  `permintaan_tgl` date NOT NULL,
  `permintaan_ket` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan`
--

INSERT INTO `permintaan` (`permintaan_id`, `permintaan_tgl`, `permintaan_ket`) VALUES
(5, '2018-11-23', '');

-- --------------------------------------------------------

--
-- Table structure for table `sub_transaksi`
--

CREATE TABLE `sub_transaksi` (
  `id_subtransaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `total_harga` varchar(20) NOT NULL,
  `no_invoice` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_transaksi`
--

INSERT INTO `sub_transaksi` (`id_subtransaksi`, `id_barang`, `id_transaksi`, `jumlah_beli`, `total_harga`, `no_invoice`) VALUES
(17, 8, 14, 1, '450000', '15/AF/2/18/02/18/21'),
(18, 6, 14, 2, '460000', '15/AF/2/18/02/18/21'),
(19, 6, 15, 2, '460000', '15/AF/4/18/07/57/25'),
(20, 8, 15, 1, '450000', '15/AF/4/18/07/57/25'),
(21, 7, 16, 1, '140000', '14/AF/2/18/08/22/18'),
(22, 18, 17, 1, '200000', '16/AF/2/18/02/50/42'),
(23, 19, 18, 1, '130000', '21/AF/2/18/08/04/22'),
(24, 31, 18, 1, '470000', '21/AF/2/18/08/04/22');

-- --------------------------------------------------------

--
-- Table structure for table `tempo`
--

CREATE TABLE `tempo` (
  `id_subtransaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `total_harga` varchar(20) NOT NULL,
  `trx` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tempo`
--

INSERT INTO `tempo` (`id_subtransaksi`, `id_barang`, `jumlah_beli`, `total_harga`, `trx`) VALUES
(3, 7, 1, '140000', '14/AF/2/18');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `kode_kasir` int(11) NOT NULL,
  `total_bayar` varchar(20) NOT NULL,
  `no_invoice` varchar(20) NOT NULL,
  `nama_pembeli` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tgl_transaksi`, `kode_kasir`, `total_bayar`, `no_invoice`, `nama_pembeli`) VALUES
(14, '2018-01-15 01:18:21', 2, '910000', '15/AF/2/18/02/18/21', 'athoul muwafiq'),
(15, '2018-01-15 06:57:25', 4, '910000', '15/AF/4/18/07/57/25', 'afiq'),
(16, '2018-11-14 07:22:18', 2, '140000', '14/AF/2/18/08/22/18', ''),
(17, '2018-11-16 01:50:42', 2, '200000', '16/AF/2/18/02/50/42', ''),
(18, '2018-11-21 07:04:22', 2, '600000', '21/AF/2/18/08/04/22', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `notlp` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `alamat`, `notlp`, `status`, `date_created`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', '', '', 1, '2017-12-12 00:44:45'),
(2, 'kasir', '8691e4fc53b99da544ce86e22acba62d13352eff', 'Avoni Putri', 'Melati Norowito', '085641212212', 2, '2018-11-20 07:46:36'),
(3, 'manager', '1a8565a9dc72048ba03b4156be3e569f22771f23', '', '', '', 3, '2018-11-19 06:29:23'),
(4, 'supplier', 'e2979e759574b094b7c50f54846af43ef8eff1a0', 'Wahana Komputer', '', '', 4, '2018-11-20 13:37:23'),
(5, 'platinum', 'eefc1767fec313f654053139e7d7aa4d786e6387', 'Platinum Komputer Semarang', '', '', 4, '2018-11-21 00:50:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`status`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `detail_permintaan`
--
ALTER TABLE `detail_permintaan`
  ADD PRIMARY KEY (`dp_id`),
  ADD KEY `permintaan_id` (`permintaan_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`id_merk`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pel`);

--
-- Indexes for table `permintaan`
--
ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`permintaan_id`),
  ADD KEY `permintaan_id` (`permintaan_id`);

--
-- Indexes for table `sub_transaksi`
--
ALTER TABLE `sub_transaksi`
  ADD PRIMARY KEY (`id_subtransaksi`);

--
-- Indexes for table `tempo`
--
ALTER TABLE `tempo`
  ADD PRIMARY KEY (`id_subtransaksi`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `detail_permintaan`
--
ALTER TABLE `detail_permintaan`
  MODIFY `dp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `merk`
--
ALTER TABLE `merk`
  MODIFY `id_merk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permintaan`
--
ALTER TABLE `permintaan`
  MODIFY `permintaan_id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_transaksi`
--
ALTER TABLE `sub_transaksi`
  MODIFY `id_subtransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tempo`
--
ALTER TABLE `tempo`
  MODIFY `id_subtransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
