-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Apr 2021 pada 06.12
-- Versi server: 10.1.32-MariaDB
-- Versi PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_angga`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_editsementara`
--

CREATE TABLE `g_editsementara` (
  `id` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_invoice`
--

CREATE TABLE `g_invoice` (
  `idInvoice` varchar(255) NOT NULL,
  `customer` varchar(30) NOT NULL,
  `dateInvoice` date NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `notice` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `g_invoice`
--

INSERT INTO `g_invoice` (`idInvoice`, `customer`, `dateInvoice`, `totalPrice`, `notice`, `status`) VALUES
('20210325dba32b584b', 'Umum', '2021-03-26', 12000, '', 1),
('2021032668ed8d2164', 'Umum', '2021-03-26', 26000, '', 1),
('20210329f07064586d', '', '0000-00-00', 0, '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_invoice_det`
--

CREATE TABLE `g_invoice_det` (
  `idInvoiceDet` int(11) NOT NULL,
  `idInvoice` varchar(50) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `priceIn` int(11) NOT NULL,
  `qtyProduct` int(11) NOT NULL,
  `disc` int(11) NOT NULL,
  `totalPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `g_invoice_det`
--

INSERT INTO `g_invoice_det` (`idInvoiceDet`, `idInvoice`, `idProduct`, `priceIn`, `qtyProduct`, `disc`, `totalPrice`) VALUES
(4, '20210325dba32b584b', 1, 12000, 1, 0, 12000),
(5, '2021032668ed8d2164', 2, 13000, 2, 0, 26000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_jenistopup`
--

CREATE TABLE `g_jenistopup` (
  `id` int(11) NOT NULL,
  `topupName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `g_jenistopup`
--

INSERT INTO `g_jenistopup` (`id`, `topupName`) VALUES
(1, 'DANA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_log`
--

CREATE TABLE `g_log` (
  `idLog` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `user` varchar(20) NOT NULL,
  `log` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `g_log`
--

INSERT INTO `g_log` (`idLog`, `datetime`, `user`, `log`) VALUES
(1, '2018-11-24 13:27:10', 'admin', 'admin menambahkan Data Jenis baru'),
(2, '2018-11-24 13:28:56', 'admin', 'admin menambahkan Data Produk baru'),
(3, '2018-11-24 13:29:38', 'admin', 'admin menambahkan Data Produk baru'),
(4, '2018-11-24 15:09:56', 'admin', 'admin mengubah Data Produk'),
(5, '2018-11-24 15:13:23', 'admin', 'admin menghapus Data Produk'),
(6, '2018-11-24 15:38:27', 'admin', 'admin menambahkan Data Supplier baru'),
(7, '2018-11-24 15:47:04', 'admin', 'admin mengubah Data Supplier'),
(8, '2018-11-24 15:54:09', 'admin', 'admin menghapus Data Jenis'),
(9, '2018-11-24 15:55:31', 'admin', 'admin menghapus Data Supplier'),
(10, '2018-11-24 21:48:51', 'admin', 'admin menambahkan Data Jenis baru'),
(11, '2018-11-24 21:49:03', 'admin', 'admin mengubah Data Produk'),
(12, '2018-11-24 21:49:29', 'admin', 'admin menambahkan Data Produk baru'),
(13, '2018-11-24 21:50:09', 'admin', 'admin menambahkan Data Supplier baru'),
(14, '2018-11-28 16:18:54', 'admin', 'admin menambahkan Data Produk baru'),
(15, '2018-12-05 09:34:21', 'admin', 'admin mengubah Data Produk'),
(16, '2018-12-11 16:12:50', 'admin', 'admin menambahkan Data Retur baru'),
(17, '2018-12-11 16:28:24', 'admin', 'admin menambahkan Data Retur baru'),
(18, '2021-03-21 10:49:25', 'admin', 'admin menambahkan Data Produk baru'),
(19, '2021-03-21 10:51:04', 'admin', 'admin menambahkan Data Supplier baru'),
(20, '2021-03-28 11:06:56', 'admin', 'admin menambahkan Data Retur baru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_preorder`
--

CREATE TABLE `g_preorder` (
  `idPreorder` varchar(16) NOT NULL,
  `dateorder` date NOT NULL,
  `daterelease` date NOT NULL,
  `namaBarang` varchar(255) NOT NULL,
  `jml` int(11) NOT NULL,
  `totalBayar` int(11) NOT NULL,
  `dp` int(11) NOT NULL,
  `pelunasan` int(11) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `g_preorder`
--

INSERT INTO `g_preorder` (`idPreorder`, `dateorder`, `daterelease`, `namaBarang`, `jml`, `totalBayar`, `dp`, `pelunasan`, `customer`, `no_hp`, `status`, `keterangan`) VALUES
('6F660DFB', '2021-04-01', '2021-04-03', 'Garskin Laptop', 1, 35000, 15000, 20000, 'Rian', '08571225556', 1, 'OKE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_products`
--

CREATE TABLE `g_products` (
  `idProduct` int(11) NOT NULL,
  `jenisProduct` varchar(50) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `harga1` int(11) NOT NULL,
  `harga2` int(11) NOT NULL,
  `harga3` int(11) NOT NULL,
  `productStock` int(11) NOT NULL,
  `productIndex` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `g_products`
--

INSERT INTO `g_products` (`idProduct`, `jenisProduct`, `productName`, `harga1`, `harga2`, `harga3`, `productStock`, `productIndex`) VALUES
(1, 'Softcase', 'Sofcase Samsung M10', 7000, 8000, 9000, 5, 1),
(2, 'Softcase', 'Sofcase Samsung M20', 7000, 8000, 9000, 18, 1),
(3, 'Softcase', 'Oppo A5', 12500, 13000, 15000, 5, 1),
(4, 'Hardcase', 'Oppo Reno5', 12500, 13000, 15000, 5, 1),
(5, 'Softcase', 'Oppo Reno 4F', 12500, 13000, 15000, 5, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_purchase`
--

CREATE TABLE `g_purchase` (
  `purchaseOrder` varchar(11) NOT NULL,
  `idSupplier` int(11) NOT NULL,
  `date` date NOT NULL,
  `totalItem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `g_purchase`
--

INSERT INTO `g_purchase` (`purchaseOrder`, `idSupplier`, `date`, `totalItem`) VALUES
('PO-10001', 2, '2018-11-28', 4),
('PO-10002', 2, '2021-03-28', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_purchase_det`
--

CREATE TABLE `g_purchase_det` (
  `idProductsIn` int(11) NOT NULL,
  `purchaseOrder` varchar(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `notice` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `g_purchase_det`
--

INSERT INTO `g_purchase_det` (`idProductsIn`, `purchaseOrder`, `idProduct`, `qty`, `notice`) VALUES
(3, 'PO-10001', 3, 1, 'Ok'),
(4, 'PO-10001', 1, 3, 'Ok'),
(5, 'PO-10002', 2, 10, 'OKE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_retur`
--

CREATE TABLE `g_retur` (
  `idRetur` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `idSupplier` int(11) NOT NULL,
  `date` date NOT NULL,
  `qty` int(11) NOT NULL,
  `notice` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_supplier`
--

CREATE TABLE `g_supplier` (
  `idSupplier` int(11) NOT NULL,
  `supplierName` varchar(50) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `supplierIndex` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `g_supplier`
--

INSERT INTO `g_supplier` (`idSupplier`, `supplierName`, `contact`, `supplierIndex`) VALUES
(1, 'A', '085711', 0),
(2, 'Angga', '0861116111', 1),
(3, 'PT. Maju Jaya', '+628574114774', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_topup`
--

CREATE TABLE `g_topup` (
  `idTopup` varchar(16) NOT NULL,
  `idjenistopup` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `idnumber` varchar(255) NOT NULL,
  `nominal` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `customer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `g_topup`
--

INSERT INTO `g_topup` (`idTopup`, `idjenistopup`, `date`, `idnumber`, `nominal`, `bayar`, `customer`) VALUES
('78350E20', 'GOPAY', '2021-04-04', '0857132588', 25000, 27000, 'Umum'),
('CAC456F3', 'DIAMOND', '2021-04-04', '2135181', 200, 150000, 'Umum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_type`
--

CREATE TABLE `g_type` (
  `idType` int(11) NOT NULL,
  `kodeType` varchar(5) NOT NULL,
  `typeName` varchar(50) NOT NULL,
  `typeIndex` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `g_type`
--

INSERT INTO `g_type` (`idType`, `kodeType`, `typeName`, `typeIndex`) VALUES
(1, 'SFT01', 'Softcase', 1),
(2, 'JLC01', 'JellyCase', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `g_users`
--

CREATE TABLE `g_users` (
  `idUsers` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `g_users`
--

INSERT INTO `g_users` (`idUsers`, `user`, `password`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `g_editsementara`
--
ALTER TABLE `g_editsementara`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_invoice`
--
ALTER TABLE `g_invoice`
  ADD PRIMARY KEY (`idInvoice`);

--
-- Indeks untuk tabel `g_invoice_det`
--
ALTER TABLE `g_invoice_det`
  ADD PRIMARY KEY (`idInvoiceDet`);

--
-- Indeks untuk tabel `g_jenistopup`
--
ALTER TABLE `g_jenistopup`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `g_log`
--
ALTER TABLE `g_log`
  ADD PRIMARY KEY (`idLog`);

--
-- Indeks untuk tabel `g_preorder`
--
ALTER TABLE `g_preorder`
  ADD PRIMARY KEY (`idPreorder`);

--
-- Indeks untuk tabel `g_products`
--
ALTER TABLE `g_products`
  ADD PRIMARY KEY (`idProduct`);

--
-- Indeks untuk tabel `g_purchase`
--
ALTER TABLE `g_purchase`
  ADD PRIMARY KEY (`purchaseOrder`);

--
-- Indeks untuk tabel `g_purchase_det`
--
ALTER TABLE `g_purchase_det`
  ADD PRIMARY KEY (`idProductsIn`);

--
-- Indeks untuk tabel `g_retur`
--
ALTER TABLE `g_retur`
  ADD PRIMARY KEY (`idRetur`);

--
-- Indeks untuk tabel `g_supplier`
--
ALTER TABLE `g_supplier`
  ADD PRIMARY KEY (`idSupplier`);

--
-- Indeks untuk tabel `g_topup`
--
ALTER TABLE `g_topup`
  ADD PRIMARY KEY (`idTopup`);

--
-- Indeks untuk tabel `g_type`
--
ALTER TABLE `g_type`
  ADD PRIMARY KEY (`idType`);

--
-- Indeks untuk tabel `g_users`
--
ALTER TABLE `g_users`
  ADD PRIMARY KEY (`idUsers`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `g_editsementara`
--
ALTER TABLE `g_editsementara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `g_invoice_det`
--
ALTER TABLE `g_invoice_det`
  MODIFY `idInvoiceDet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `g_jenistopup`
--
ALTER TABLE `g_jenistopup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `g_log`
--
ALTER TABLE `g_log`
  MODIFY `idLog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `g_products`
--
ALTER TABLE `g_products`
  MODIFY `idProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `g_purchase_det`
--
ALTER TABLE `g_purchase_det`
  MODIFY `idProductsIn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `g_retur`
--
ALTER TABLE `g_retur`
  MODIFY `idRetur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `g_supplier`
--
ALTER TABLE `g_supplier`
  MODIFY `idSupplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `g_type`
--
ALTER TABLE `g_type`
  MODIFY `idType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `g_users`
--
ALTER TABLE `g_users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
