-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2020 at 09:42 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umkm_ppkm`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nomor_telp_admin` varchar(15) NOT NULL,
  `alamat_admin` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nomor_telp_admin`, `alamat_admin`, `id_user`) VALUES
(1, '082121212121', 'Bandung', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_banner`
--

CREATE TABLE `tb_banner` (
  `id_banner` int(11) NOT NULL,
  `nama_banner` text NOT NULL,
  `foto_banner` text NOT NULL,
  `id_umkm` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_banner`
--

INSERT INTO `tb_banner` (`id_banner`, `nama_banner`, `foto_banner`, `id_umkm`) VALUES
(1, 'Banner pertamaku', 'cart.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_transaksi`
--

CREATE TABLE `tb_detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jumlah_produk` int(11) NOT NULL,
  `jumlah_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_transaksi`
--

INSERT INTO `tb_detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_produk`, `jumlah_produk`, `jumlah_harga`) VALUES
(2, 2, 6, 2, 30000),
(3, 2, 3, 3, 45000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_foto`
--

CREATE TABLE `tb_foto` (
  `id_foto` int(11) NOT NULL,
  `foto` text NOT NULL,
  `keterangan_foto` text,
  `id_umkm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_foto`
--

INSERT INTO `tb_foto` (`id_foto`, `foto`, `keterangan_foto`, `id_umkm`) VALUES
(3, 'product_4.png', NULL, 1),
(4, 'product_5.png', NULL, 1),
(5, 'product_6.png', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_informasi`
--

CREATE TABLE `tb_informasi` (
  `id_informasi` int(11) NOT NULL,
  `judul_informasi` varchar(100) NOT NULL,
  `isi_informasi` text NOT NULL,
  `gambar` text NOT NULL,
  `status_informasi` enum('aktif','tidak aktif','','') NOT NULL,
  `id_umkm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_informasi`
--

INSERT INTO `tb_informasi` (`id_informasi`, `judul_informasi`, `isi_informasi`, `gambar`, `status_informasi`, `id_umkm`) VALUES
(1, 'UMKM Terfavorit Jawa Barat', 'Penghargaan sebagai UMKM Terfavorit di Jawa Barat\r\n                  ', 'Belt_on_a_Dress.jpg', 'aktif', 1),
(2, 'Warung Terbaik Se-Sukapura raya', '                                        \r\n                                    Pemerintah Jawa Barat menyelenggarakan pameran UMKM se-Jawa Barat. Pameran ini diadakan setiap tahun dan ada penghargaan untuk beberapa kategori. Di tahun ini, UMKM JUARA memperoleh award sebagai UMKM Tergiat se-Jawa Barat. Award ini diberikan tidak secara-cara cuma, tetapi dengan berbagai pertimbangan dimana UMKM JUARA sangat aktif mengikuti kegiatan yang diselanggaran oleh pemerintahan Jawa Barat.', '', 'aktif', 2),
(4, 'Warung Terbaik Se-dunia', 'Nantikan diskon besar-besaran di market online kami pada 15 Juli sebagai perayaan ulang tahun yang pertama. Jangan sampai ketinggalan dan Kehabisan!!\r\n                                    ', '', 'aktif', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_produk`
--

CREATE TABLE `tb_kategori_produk` (
  `id_kategori_produk` int(11) NOT NULL,
  `nama_kategori_produk` varchar(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori_produk`
--

INSERT INTO `tb_kategori_produk` (`id_kategori_produk`, `nama_kategori_produk`, `keterangan`) VALUES
(1, 'Makanan', ''),
(2, 'Minuman', 'contoh : air mineral, juz, dll'),
(3, 'Pakaian', ''),
(4, 'Sembako', ''),
(5, 'Peralatan sekolah', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_umkm`
--

CREATE TABLE `tb_kategori_umkm` (
  `id_kategori_umkm` int(11) NOT NULL,
  `nama_kategori_umkm` varchar(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori_umkm`
--

INSERT INTO `tb_kategori_umkm` (`id_kategori_umkm`, `nama_kategori_umkm`, `keterangan`) VALUES
(1, 'Kuliner', 'UMKM yang menjual berbagai kuliner'),
(2, 'Pakaian', 'UMKM yang menjual berbagai pakaian'),
(3, 'Kerajinan', 'UMKM yang menjual berbagai kerajinan'),
(4, 'Peralatan Sekolah', 'UMKM yang menjual berbagai peralatan sekolah'),
(5, 'Sembako', 'UMKM yang menjual berbagai sembako');

-- --------------------------------------------------------

--
-- Table structure for table `tb_keranjang`
--

CREATE TABLE `tb_keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_konsumen` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_keranjang`
--

INSERT INTO `tb_keranjang` (`id_keranjang`, `id_konsumen`, `id_produk`, `jumlah_barang`) VALUES
(2, 1, 3, 2),
(4, 1, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_konsumen`
--

CREATE TABLE `tb_konsumen` (
  `id_konsumen` int(11) NOT NULL,
  `nama_konsumen` varchar(100) NOT NULL,
  `username_konsumen` varchar(20) NOT NULL,
  `password_konsumen` text NOT NULL,
  `email_konsumen` varchar(50) NOT NULL,
  `foto_konsumen` text NOT NULL,
  `nomor_telp_konsumen` varchar(15) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tanggal_join` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_konsumen` enum('aktif','tidak aktif','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_konsumen`
--

INSERT INTO `tb_konsumen` (`id_konsumen`, `nama_konsumen`, `username_konsumen`, `password_konsumen`, `email_konsumen`, `foto_konsumen`, `nomor_telp_konsumen`, `jenis_kelamin`, `tanggal_lahir`, `tanggal_join`, `status_konsumen`) VALUES
(1, 'Nining Parwati', 'nining', 'd844d7002741826f01a93f58e67effa1', 'niningparwati04@gmail.com', '', '082121358799', '', '0000-00-00', '2020-06-03 07:25:11', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kontak`
--

CREATE TABLE `tb_kontak` (
  `id_kontak` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `website` text,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `nama_bank` varchar(20) NOT NULL,
  `pemilik_rekening` varchar(50) NOT NULL,
  `nomor_rekening` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kontak`
--

INSERT INTO `tb_kontak` (`id_kontak`, `email`, `alamat`, `telepon`, `website`, `facebook`, `instagram`, `nama_bank`, `pemilik_rekening`, `nomor_rekening`) VALUES
(1, 'umkmppkm@gmail.com', 'Telkom University', '08123456700', 'umkmppkm.com', 'UMKM PPKM', 'umkmppkm.id', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_market`
--

CREATE TABLE `tb_market` (
  `id_market` int(11) NOT NULL,
  `nama_market` varchar(50) NOT NULL,
  `alamat_market` text NOT NULL,
  `link_market` varchar(255) NOT NULL,
  `id_umkm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_market`
--

INSERT INTO `tb_market` (`id_market`, `nama_market`, `alamat_market`, `link_market`, `id_umkm`) VALUES
(1, 'UMKM Bandoeng Cabang 1', 'Sukapura', 'www.umkmbandoeng.com/cabang-satu', 1),
(2, 'UMKM Bandoeng Cabang 2', 'Soekarno Hatta', 'www.umkmbandoeng.com/cabang-dua', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengiriman`
--

CREATE TABLE `tb_pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_umkm` int(11) NOT NULL,
  `no_resi` text,
  `status_pengiriman` enum('belum_dikirim','dikirim') NOT NULL DEFAULT 'belum_dikirim'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengiriman`
--

INSERT INTO `tb_pengiriman` (`id_pengiriman`, `id_transaksi`, `id_umkm`, `no_resi`, `status_pengiriman`) VALUES
(1, 2, 2, 'JNT747832672', 'dikirim'),
(2, 2, 1, 'JNT884342823', 'dikirim');

-- --------------------------------------------------------

--
-- Table structure for table `tb_portofolio`
--

CREATE TABLE `tb_portofolio` (
  `id_portofolio` int(11) NOT NULL,
  `judul_portofolio` varchar(100) NOT NULL,
  `foto_portofolio` text NOT NULL,
  `keterangan` text NOT NULL,
  `alamat` text NOT NULL,
  `tanggal` date NOT NULL,
  `id_umkm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_portofolio`
--

INSERT INTO `tb_portofolio` (`id_portofolio`, `judul_portofolio`, `foto_portofolio`, `keterangan`, `alamat`, `tanggal`, `id_umkm`) VALUES
(1, 'Penghargaan UMKM Terfavorit', 'Administrator.png', 'penghargaan yang didapatkan pada saat award UMKM di Provinsi Jawa Barat', 'Bandung', '2019-01-20', 1),
(2, 'BEST UMKM SE-JAWA BARAT', 'management2.png', 'UMKM JUARA menjadi pemenang penghargaan UMKM ter-baik di acara UMKM Contest', 'Sukapuraaaa', '2020-06-25', 2),
(4, 'wsfvhdjfvkkk', 'management3.png', '                         gsdgsdgsdgsgdshsdhbshsh             ', 'Sukapuraaaa', '2020-06-04', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `foto_produk` text NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `id_umkm` int(11) NOT NULL,
  `id_kategori_produk` int(11) NOT NULL,
  `status_produk` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `nama_produk`, `foto_produk`, `deskripsi_produk`, `harga_produk`, `stok`, `id_umkm`, `id_kategori_produk`, `status_produk`) VALUES
(1, 'Bubur Ayam', '748926d1-a998-4250-873a-a100b01277d1_43.jpeg', 'bubur ayam murah meriah', 10000, 9, 1, 1, '1'),
(2, 'Nasi Tumpeng', '4-makanan-khas-indonesia-yang-paling-diburu-di-luar-negeri-gOjMyZizaf.jpg', 'nasi tumpeng nusantara', 50000, 5, 1, 1, '1'),
(3, 'Pizza Lokal', '', 'Menjual pizza dengan hasil karya lokal', 15000, 7, 1, 1, '1'),
(4, 'Pizza Kueh Kering', 'IMG_20512.jpg', 'berbagai kue kering khas lebaran', 30000, 7, 1, 1, '1'),
(5, 'Nasi Liwet', 'umkm1.PNG', 'berbagai macam nasi liwet lezat', 35000, 20, 1, 1, '1'),
(6, 'Gulaku', '', 'Gula pasir 250g', 15000, 97, 2, 4, '1'),
(7, 'Bimoli Minyak', 'filter.png', '                                  Minyak goreng 1 liter                                ', 25000, 23, 2, 4, '1'),
(8, 'Choki Choki', '', '                                  Selai coklat stick                                 ', 1500, 31, 2, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_promo`
--

CREATE TABLE `tb_promo` (
  `id_promo` int(11) NOT NULL,
  `id_umkm` int(11) DEFAULT NULL,
  `nama_promo` text NOT NULL,
  `kode_promo` text NOT NULL,
  `besar_promo` int(11) NOT NULL,
  `minimal_belanja` int(11) DEFAULT NULL,
  `maksimum_potongan` int(11) NOT NULL,
  `status_promo` enum('aktif','tidak aktif','expired') DEFAULT NULL,
  `foto_promo` text,
  `berlaku_sampai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_promo`
--

INSERT INTO `tb_promo` (`id_promo`, `id_umkm`, `nama_promo`, `kode_promo`, `besar_promo`, `minimal_belanja`, `maksimum_potongan`, `status_promo`, `foto_promo`, `berlaku_sampai`) VALUES
(1, 2, 'Promo Kedua', 'HJKL001SASS', 7, 0, 0, 'aktif', 'pay-per-click.png', '2020-06-30'),
(2, 1, 'Promo Kedua', 'KSJK789XMS', 5, 100000, 15000, 'aktif', 'promo_kedua.png', '2020-07-23');

-- --------------------------------------------------------

--
-- Table structure for table `tb_slide`
--

CREATE TABLE `tb_slide` (
  `id_slide` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `gambar` text NOT NULL,
  `deskripsi` text NOT NULL,
  `url` text NOT NULL,
  `status` enum('aktif','tidak aktif','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_konsumen` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `id_promo` int(11) DEFAULT NULL,
  `besar_diskon` int(11) DEFAULT NULL,
  `provinsi` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `detail_alamat` text NOT NULL,
  `ekspedisi_pengiriman` varchar(255) NOT NULL,
  `estimasi_pengiriman` varchar(255) NOT NULL,
  `ongkos_kirim` int(11) NOT NULL,
  `bukti_pembayaran` text NOT NULL,
  `resi` varchar(255) NOT NULL,
  `tanggal_transaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('menunggu pembayaran','menunggu konfirmasi','diproses','dikirim','diterima','dana dikirim','selesai','ditolak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_konsumen`, `total_harga`, `id_promo`, `besar_diskon`, `provinsi`, `kota`, `detail_alamat`, `ekspedisi_pengiriman`, `estimasi_pengiriman`, `ongkos_kirim`, `bukti_pembayaran`, `resi`, `tanggal_transaksi`, `status`) VALUES
(2, 1, 105000, NULL, 0, '', '', '', '', '', 0, '', '', '2020-06-23 04:38:12', 'dana dikirim');

-- --------------------------------------------------------

--
-- Table structure for table `tb_umkm`
--

CREATE TABLE `tb_umkm` (
  `id_umkm` int(11) NOT NULL,
  `nama_umkm` varchar(100) NOT NULL,
  `alamat_umkm` text NOT NULL,
  `kota_asal` text NOT NULL,
  `provinsi_asal` text NOT NULL,
  `deskripsi_umkm` text NOT NULL,
  `nomor_telp_umkm` varchar(15) NOT NULL,
  `id_kategori_umkm` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_umkm`
--

INSERT INTO `tb_umkm` (`id_umkm`, `nama_umkm`, `alamat_umkm`, `kota_asal`, `provinsi_asal`, `deskripsi_umkm`, `nomor_telp_umkm`, `id_kategori_umkm`, `id_user`) VALUES
(1, 'UMKM Bandoeng', 'Bandung', '', '', 'UMKM menjual berbagai jenis makanan', '08123123123', 1, 2),
(2, 'UMKM Juara', 'Cimahi', 'Bandung', 'Jawa Barat', 'UMKM menjual berbagai jenis pakaian hagshah kaksjkaj nsnjs nansajn nasnsa nkaknksa asaokqwok ooxkaouw nksaaoka dnjnxia kkaoKOW JDJASJDA makmksmak', '085321321321', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto_user` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tanggal_join` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `level` enum('Admin','UMKM','','') NOT NULL,
  `status` enum('aktif','tidak aktif','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_lengkap`, `username`, `password`, `email`, `foto_user`, `tanggal_lahir`, `tanggal_join`, `level`, `status`) VALUES
(1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', '', '0000-00-00', '2020-06-01 01:27:44', 'Admin', 'aktif'),
(2, 'Farah Fitriafida', 'farah', '9b0f4d720720fd55436ac7f07ac8a840', 'umkmbandoeng@gmail.com', '', '0000-00-00', '2020-06-02 01:39:16', 'UMKM', 'aktif'),
(3, 'Fitria', 'nia', '8728075abafefc9ed2c8e5e610c64917', 'umkmjuara@gmail.com', '', '2020-06-09', '2020-06-03 00:19:09', 'UMKM', 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_banner`
--
ALTER TABLE `tb_banner`
  ADD PRIMARY KEY (`id_banner`),
  ADD KEY `fk_umkm` (`id_umkm`);

--
-- Indexes for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `tb_foto`
--
ALTER TABLE `tb_foto`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `id_umkm` (`id_umkm`);

--
-- Indexes for table `tb_informasi`
--
ALTER TABLE `tb_informasi`
  ADD PRIMARY KEY (`id_informasi`),
  ADD KEY `id_umkm` (`id_umkm`);

--
-- Indexes for table `tb_kategori_produk`
--
ALTER TABLE `tb_kategori_produk`
  ADD PRIMARY KEY (`id_kategori_produk`);

--
-- Indexes for table `tb_kategori_umkm`
--
ALTER TABLE `tb_kategori_umkm`
  ADD PRIMARY KEY (`id_kategori_umkm`);

--
-- Indexes for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_konsumen` (`id_konsumen`),
  ADD KEY `id_barang` (`id_produk`);

--
-- Indexes for table `tb_konsumen`
--
ALTER TABLE `tb_konsumen`
  ADD PRIMARY KEY (`id_konsumen`);

--
-- Indexes for table `tb_kontak`
--
ALTER TABLE `tb_kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indexes for table `tb_market`
--
ALTER TABLE `tb_market`
  ADD PRIMARY KEY (`id_market`),
  ADD KEY `id_umkm` (`id_umkm`);

--
-- Indexes for table `tb_pengiriman`
--
ALTER TABLE `tb_pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`),
  ADD KEY `fk_transaksi` (`id_transaksi`),
  ADD KEY `fk_umkm` (`id_umkm`);

--
-- Indexes for table `tb_portofolio`
--
ALTER TABLE `tb_portofolio`
  ADD PRIMARY KEY (`id_portofolio`),
  ADD KEY `id_umkm` (`id_umkm`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_umkm` (`id_umkm`),
  ADD KEY `id_kategori_produk` (`id_kategori_produk`);

--
-- Indexes for table `tb_promo`
--
ALTER TABLE `tb_promo`
  ADD PRIMARY KEY (`id_promo`),
  ADD KEY `fk_umkm` (`id_umkm`);

--
-- Indexes for table `tb_slide`
--
ALTER TABLE `tb_slide`
  ADD PRIMARY KEY (`id_slide`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_konsumen` (`id_konsumen`),
  ADD KEY `id_promo` (`id_promo`);

--
-- Indexes for table `tb_umkm`
--
ALTER TABLE `tb_umkm`
  ADD PRIMARY KEY (`id_umkm`),
  ADD KEY `id_kategori_umkm` (`id_kategori_umkm`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_banner`
--
ALTER TABLE `tb_banner`
  MODIFY `id_banner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_foto`
--
ALTER TABLE `tb_foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_informasi`
--
ALTER TABLE `tb_informasi`
  MODIFY `id_informasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_kategori_produk`
--
ALTER TABLE `tb_kategori_produk`
  MODIFY `id_kategori_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_kategori_umkm`
--
ALTER TABLE `tb_kategori_umkm`
  MODIFY `id_kategori_umkm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_konsumen`
--
ALTER TABLE `tb_konsumen`
  MODIFY `id_konsumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_kontak`
--
ALTER TABLE `tb_kontak`
  MODIFY `id_kontak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_market`
--
ALTER TABLE `tb_market`
  MODIFY `id_market` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pengiriman`
--
ALTER TABLE `tb_pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_portofolio`
--
ALTER TABLE `tb_portofolio`
  MODIFY `id_portofolio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_promo`
--
ALTER TABLE `tb_promo`
  MODIFY `id_promo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_slide`
--
ALTER TABLE `tb_slide`
  MODIFY `id_slide` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_umkm`
--
ALTER TABLE `tb_umkm`
  MODIFY `id_umkm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD CONSTRAINT `tb_admin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Constraints for table `tb_banner`
--
ALTER TABLE `tb_banner`
  ADD CONSTRAINT `tb_banner_ibfk_1` FOREIGN KEY (`id_umkm`) REFERENCES `tb_umkm` (`id_umkm`);

--
-- Constraints for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD CONSTRAINT `tb_detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `tb_transaksi` (`id_transaksi`),
  ADD CONSTRAINT `tb_detail_transaksi_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`);

--
-- Constraints for table `tb_foto`
--
ALTER TABLE `tb_foto`
  ADD CONSTRAINT `tb_foto_ibfk_1` FOREIGN KEY (`id_umkm`) REFERENCES `tb_umkm` (`id_umkm`);

--
-- Constraints for table `tb_informasi`
--
ALTER TABLE `tb_informasi`
  ADD CONSTRAINT `tb_informasi_ibfk_1` FOREIGN KEY (`id_umkm`) REFERENCES `tb_umkm` (`id_umkm`);

--
-- Constraints for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD CONSTRAINT `tb_keranjang_ibfk_1` FOREIGN KEY (`id_konsumen`) REFERENCES `tb_konsumen` (`id_konsumen`),
  ADD CONSTRAINT `tb_keranjang_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`);

--
-- Constraints for table `tb_market`
--
ALTER TABLE `tb_market`
  ADD CONSTRAINT `tb_market_ibfk_1` FOREIGN KEY (`id_umkm`) REFERENCES `tb_umkm` (`id_umkm`);

--
-- Constraints for table `tb_pengiriman`
--
ALTER TABLE `tb_pengiriman`
  ADD CONSTRAINT `tb_pengiriman_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `tb_transaksi` (`id_transaksi`),
  ADD CONSTRAINT `tb_pengiriman_ibfk_2` FOREIGN KEY (`id_umkm`) REFERENCES `tb_umkm` (`id_umkm`);

--
-- Constraints for table `tb_portofolio`
--
ALTER TABLE `tb_portofolio`
  ADD CONSTRAINT `tb_portofolio_ibfk_1` FOREIGN KEY (`id_umkm`) REFERENCES `tb_umkm` (`id_umkm`);

--
-- Constraints for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD CONSTRAINT `tb_produk_ibfk_1` FOREIGN KEY (`id_umkm`) REFERENCES `tb_umkm` (`id_umkm`),
  ADD CONSTRAINT `tb_produk_ibfk_2` FOREIGN KEY (`id_kategori_produk`) REFERENCES `tb_kategori_produk` (`id_kategori_produk`);

--
-- Constraints for table `tb_promo`
--
ALTER TABLE `tb_promo`
  ADD CONSTRAINT `tb_promo_ibfk_1` FOREIGN KEY (`id_umkm`) REFERENCES `tb_umkm` (`id_umkm`);

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`id_konsumen`) REFERENCES `tb_konsumen` (`id_konsumen`),
  ADD CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`id_promo`) REFERENCES `tb_promo` (`id_promo`);

--
-- Constraints for table `tb_umkm`
--
ALTER TABLE `tb_umkm`
  ADD CONSTRAINT `tb_umkm_ibfk_1` FOREIGN KEY (`id_kategori_umkm`) REFERENCES `tb_kategori_umkm` (`id_kategori_umkm`),
  ADD CONSTRAINT `tb_umkm_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
