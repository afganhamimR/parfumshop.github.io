-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 06:01 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokoparfum`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(12) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin1', '12345', 'Oreki Houtaro');

-- --------------------------------------------------------

--
-- Table structure for table `jasa_pengiriman`
--

CREATE TABLE `jasa_pengiriman` (
  `id_jasa` int(11) NOT NULL,
  `nama_jasa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jasa_pengiriman`
--

INSERT INTO `jasa_pengiriman` (`id_jasa`, `nama_jasa`) VALUES
(1, 'Paxel'),
(2, 'JNE Express'),
(3, 'SiCepat\r\n'),
(4, 'J&T');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Magelang', 17000),
(2, 'Madiun', 12000),
(3, 'Surabaya', 15000),
(4, 'Malang', 17000),
(5, 'Semarang', 19000),
(6, 'Bandung', 20000),
(7, 'Jakarta', 21000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telp_pelanggan` varchar(25) NOT NULL,
  `alamat_pelanggan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telp_pelanggan`, `alamat_pelanggan`) VALUES
(1, 'rofiqi@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Rofiqi Hamim', '085700528900', 'Jl. Pattimura blok 9, Patihan Wetan, Jenangan, Ponorogo'),
(3, 'ferdi@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'ferdian sinaga', '085700568976', 'Jl. Ukel, Banjar, sekaten, Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(2, 3, 'Rofiqi Hamim', 'BCA', 727000, '2023-06-04', '04062023 212326bukti.jpg'),
(3, 4, 'Rofiqi Hamim', 'Bank Mandiri', 1961000, '2023-06-05', '05062023 210848bukti.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelangganbeli` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `id_jasa` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `nama_jasa` varchar(100) NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'pending',
  `resi_pengiriman` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelangganbeli`, `id_ongkir`, `id_jasa`, `tanggal_pembelian`, `total_pembelian`, `nama_kota`, `tarif`, `alamat_pengiriman`, `nama_jasa`, `status_pembelian`, `resi_pengiriman`) VALUES
(3, 1, 4, 2, '2023-06-04', 727000, 'Malang', 17000, 'Jl. merbabu, keniten, boyolali, malang 98765', 'JNE Express', 'sudah kirim pembayaran', ''),
(4, 1, 7, 2, '2023-06-05', 1961000, 'Jakarta', 21000, 'jl. jendral sudirman, muara indah, ciliwung, jakarta selatan', 'JNE Express', 'sudah kirim pembayaran', ''),
(5, 1, 3, 4, '2023-06-05', 50000, 'Surabaya', 15000, 'jl. merbabu, soetomo, rengasdengklok, surabaya 11234', 'J&T', 'pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_product`
--

CREATE TABLE `pembelian_product` (
  `id_pembelian_product` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `subberat` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_product`
--

INSERT INTO `pembelian_product` (`id_pembelian_product`, `id_pembelian`, `id_product`, `jumlah`, `nama`, `harga`, `berat`, `subberat`, `subharga`) VALUES
(4, 3, 5, 2, 'Zara Peony Woman', 355000, 90, 180, 710000),
(5, 4, 6, 1, 'Lelido Victory Man', 165000, 100, 100, 165000),
(6, 4, 5, 5, 'Zara Peony Woman', 355000, 90, 450, 1775000),
(7, 5, 7, 1, 'YVES RYAN PLEASURE FRAGRANCE MIST', 35000, 100, 100, 35000);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `nama_product` varchar(100) NOT NULL,
  `harga_product` int(11) NOT NULL,
  `berat_product` int(11) NOT NULL,
  `gambar_product` varchar(100) NOT NULL,
  `deksripsi_product` text NOT NULL,
  `stok_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `nama_product`, `harga_product`, `berat_product`, `gambar_product`, `deksripsi_product`, `stok_produk`) VALUES
(5, 'Zara Peony Woman', 355000, 90, 'peony-woman-90-ml.jpg', 'Parfum ini sangat cocok di pakai oleh wanita yang sering pergi keluar', 43),
(6, 'Lelido Victory Man', 165000, 100, 'victory-man-.jpg', 'Parfum dengan wangi yang elegan.', 49),
(7, 'YVES RYAN PLEASURE FRAGRANCE MIST', 35000, 100, 'pleasure-fragrance-mist-100-ml.jpg', 'Dengan keharuman woody dan aromatic membuat anda merasa segar dan percaya diri sepanjang hari.', 49),
(8, 'BONJOUR SHINNY STAR FRAGRANCE MIST', 35000, 100, 'shinny-star-fragrance-mist-100-ml.jpg', 'dengan keharuman khas perancis membuat anda lebih segar setiap hari', 50),
(9, 'YVES RYAN SWEET ESCAPE FRAGRANCE MIST', 80000, 250, 'sweet-escape-fragrance-mist-.jpg', 'Parfum dengan keharuman tahan lama.        ', 50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `jasa_pengiriman`
--
ALTER TABLE `jasa_pengiriman`
  ADD PRIMARY KEY (`id_jasa`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_product`
--
ALTER TABLE `pembelian_product`
  ADD PRIMARY KEY (`id_pembelian_product`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jasa_pengiriman`
--
ALTER TABLE `jasa_pengiriman`
  MODIFY `id_jasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembelian_product`
--
ALTER TABLE `pembelian_product`
  MODIFY `id_pembelian_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
