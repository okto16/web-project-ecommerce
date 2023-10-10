-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Okt 2023 pada 15.38
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_pupuk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE `invoice` (
  `idInvoice` int(11) NOT NULL,
  `idKonsumen` int(11) DEFAULT NULL,
  `namKonsumen` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `bukti_transfer` varchar(255) NOT NULL,
  `virtual_account` varchar(50) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `tgl_pesan` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `invoice`
--

INSERT INTO `invoice` (`idInvoice`, `idKonsumen`, `namKonsumen`, `alamat`, `bukti_transfer`, `virtual_account`, `bank`, `total_harga`, `tgl_pesan`, `status`) VALUES
(38416827, 2, 'yudi', 'Yogyakarta', '', '69023208650', 'bca', 82000, '2023-10-10 13:50:56', 'pending'),
(1324217986, 1, 'okto', 'Klaten', '', '69023169119', 'bca', 82000, '2023-09-13 18:36:45', 'pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `idAdmin` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`idAdmin`, `username`, `email`, `password`) VALUES
(1, 'admin1', 'admin1@gmail.com', '$2y$10$96RqxwtHyVBsfqIeX1LGU.pJIuIjBhyPtQGsveP5IOEXgtlJ1zJbK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_order`
--

CREATE TABLE `tbl_detail_order` (
  `idDetail` int(11) NOT NULL,
  `idInvoice` int(11) DEFAULT NULL,
  `idProduk` int(11) DEFAULT NULL,
  `namProduk` varchar(255) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total_Harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_detail_order`
--

INSERT INTO `tbl_detail_order` (`idDetail`, `idInvoice`, `idProduk`, `namProduk`, `harga`, `jumlah`, `total_Harga`) VALUES
(103, 1324217986, 3, 'Phonska Plus', 75000, 1, 75000),
(104, 1324217986, 4, 'PT PETROKIMIA GRESIK ZA 50 KG', 7000, 1, 7000),
(105, 38416827, 3, 'Phonska Plus', 75000, 1, 75000),
(106, 38416827, 4, 'PT PETROKIMIA GRESIK ZA 50 KG', 7000, 1, 7000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `idKat` int(5) NOT NULL,
  `namaKat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`idKat`, `namaKat`) VALUES
(1, 'Pupuk Bersubsidi'),
(2, 'Pupuk Nonsubsidi'),
(17, 'Obat Tanaman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kuota_pupuk`
--

CREATE TABLE `tbl_kuota_pupuk` (
  `id` int(11) NOT NULL,
  `Nik` int(11) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `idProduk` int(11) DEFAULT NULL,
  `namProduk` varchar(50) DEFAULT NULL,
  `jumlahKuota` int(11) NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kuota_pupuk`
--

INSERT INTO `tbl_kuota_pupuk` (`id`, `Nik`, `username`, `idProduk`, `namProduk`, `jumlahKuota`, `tahun`) VALUES
(1, 123, 'Okto', 1, 'Phonska', 1, 2012),
(2, 123, 'Okto', 2, 'Urea', 1, 2012),
(14, 124, 'saipul', 1, 'Phonska', 1, 2023);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_member`
--

CREATE TABLE `tbl_member` (
  `idKonsumen` int(5) NOT NULL,
  `Nik` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `namaKonsumen` varchar(50) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tlpn` varchar(20) NOT NULL,
  `statusAktif` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_member`
--

INSERT INTO `tbl_member` (`idKonsumen`, `Nik`, `username`, `password`, `namaKonsumen`, `alamat`, `email`, `tlpn`, `statusAktif`) VALUES
(1, 123, 'Okto', '$2y$10$mA49Xs/KOtDxEGmqAH8eGuMVBcAEkgO1HDqT3gwCkHwQSwhmDFV2.', 'Oktorino Bagas Aji', 'Klaten', 'oktorino.1406@students.amikom.ac.id', '12345678', 'Y'),
(2, 124, 'saipul', '$2y$10$FdO2aHl0qmyr2tjUMRKVKuqjKzg/lSibddaDUvUCYb4y/HaIVQvci', 'saipul', 'Yogyakarta', 'aisfa929@gmail.com', '2147483647', 'N'),
(3, 125, 'Logan', '$2y$10$mSRLDCtU.t7b9IsZA3pJTO/X04otIkuGwYWIiGjHG56wnqqOgxfh2', 'Logan', 'Yogyakarta', 'Logan@gmail.com', '123123123', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `idProduk` int(5) NOT NULL,
  `idKat` int(5) NOT NULL,
  `namProduk` varchar(50) NOT NULL,
  `foto` text NOT NULL,
  `harga` int(12) NOT NULL,
  `stok` int(5) NOT NULL,
  `berat` int(5) NOT NULL,
  `deskripsiProduk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_produk`
--

INSERT INTO `tbl_produk` (`idProduk`, `idKat`, `namProduk`, `foto`, `harga`, `stok`, `berat`, `deskripsiProduk`) VALUES
(1, 1, 'Phonska', 'Phonska.png', 125000, 3, 50000, 'N (Nitrogen) : 15%P2O5 (Fosfat) : 10%K (Kalium) : 12%S (Sulfur) : 10%'),
(2, 1, 'Urea', 'urea.png', 125000, 2, 50000, 'adar Air maksimal 0,50% Kadar Bireuet maksimal 1% Kadar Nitrogen minimal 46%'),
(3, 2, 'Phonska Plus', 'phonskaplus.png', 75000, 9, 25000, 'N (Nitrogen) : 15%P2O5 (Fosfat) : 15%K (Kalium) : 15%S (Sulfur) : 9%Zn (Zink) : 2.000 ppm'),
(4, 2, 'PT PETROKIMIA GRESIK ZA 50 KG', 'Za.png', 7000, 3, 50000, 'TKDN(%) : 82.12  BMP : n/a  TKDN + BMP : 82.12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_return`
--

CREATE TABLE `tbl_return` (
  `idReturn` int(11) NOT NULL,
  `idInvoice` int(11) DEFAULT NULL,
  `idProduk` int(11) DEFAULT NULL,
  `jumlahReturn` int(11) DEFAULT NULL,
  `totalHargaKembali` int(11) DEFAULT NULL,
  `alasanReturn` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`idInvoice`),
  ADD KEY `namKonsumen` (`namKonsumen`),
  ADD KEY `idKonsumen` (`idKonsumen`);

--
-- Indeks untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Indeks untuk tabel `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  ADD PRIMARY KEY (`idDetail`),
  ADD KEY `idProduk` (`idProduk`),
  ADD KEY `tbl_detail_order_ibfk_1` (`idInvoice`);

--
-- Indeks untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`idKat`);

--
-- Indeks untuk tabel `tbl_kuota_pupuk`
--
ALTER TABLE `tbl_kuota_pupuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `idProduk` (`idProduk`),
  ADD KEY `Nik` (`Nik`),
  ADD KEY `namProduk` (`namProduk`);

--
-- Indeks untuk tabel `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`idKonsumen`),
  ADD KEY `username` (`username`),
  ADD KEY `Nik` (`Nik`);

--
-- Indeks untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`idProduk`),
  ADD KEY `idKat` (`idKat`),
  ADD KEY `namProduk` (`namProduk`);

--
-- Indeks untuk tabel `tbl_return`
--
ALTER TABLE `tbl_return`
  ADD PRIMARY KEY (`idReturn`),
  ADD KEY `idProduk` (`idProduk`),
  ADD KEY `tbl_return_ibfk_1` (`idInvoice`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `invoice`
--
ALTER TABLE `invoice`
  MODIFY `idInvoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2123422148;

--
-- AUTO_INCREMENT untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  MODIFY `idDetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `idKat` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tbl_kuota_pupuk`
--
ALTER TABLE `tbl_kuota_pupuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `idKonsumen` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `idProduk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `tbl_return`
--
ALTER TABLE `tbl_return`
  MODIFY `idReturn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`idKonsumen`) REFERENCES `tbl_member` (`idKonsumen`);

--
-- Ketidakleluasaan untuk tabel `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  ADD CONSTRAINT `tbl_detail_order_ibfk_1` FOREIGN KEY (`idInvoice`) REFERENCES `invoice` (`idInvoice`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_order_ibfk_2` FOREIGN KEY (`idProduk`) REFERENCES `tbl_produk` (`idProduk`);

--
-- Ketidakleluasaan untuk tabel `tbl_kuota_pupuk`
--
ALTER TABLE `tbl_kuota_pupuk`
  ADD CONSTRAINT `tbl_kuota_pupuk_ibfk_1` FOREIGN KEY (`username`) REFERENCES `tbl_member` (`username`),
  ADD CONSTRAINT `tbl_kuota_pupuk_ibfk_2` FOREIGN KEY (`idProduk`) REFERENCES `tbl_produk` (`idProduk`),
  ADD CONSTRAINT `tbl_kuota_pupuk_ibfk_3` FOREIGN KEY (`Nik`) REFERENCES `tbl_member` (`Nik`),
  ADD CONSTRAINT `tbl_kuota_pupuk_ibfk_4` FOREIGN KEY (`namProduk`) REFERENCES `tbl_produk` (`namProduk`);

--
-- Ketidakleluasaan untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD CONSTRAINT `tbl_produk_ibfk_1` FOREIGN KEY (`idKat`) REFERENCES `tbl_kategori` (`idKat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_return`
--
ALTER TABLE `tbl_return`
  ADD CONSTRAINT `tbl_return_ibfk_1` FOREIGN KEY (`idInvoice`) REFERENCES `invoice` (`idInvoice`),
  ADD CONSTRAINT `tbl_return_ibfk_2` FOREIGN KEY (`idProduk`) REFERENCES `tbl_produk` (`idProduk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
