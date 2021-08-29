-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 29 Agu 2021 pada 18.36
-- Versi server: 10.5.8-MariaDB-log
-- Versi PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anisaflora`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alamat_user`
--

CREATE TABLE `alamat_user` (
  `id_alamat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jenis_alamat` varchar(100) NOT NULL,
  `nama_penerima` varchar(50) NOT NULL,
  `notlp` varchar(12) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `alamat` longtext NOT NULL,
  `kodepos` int(25) NOT NULL,
  `status` int(1) NOT NULL COMMENT '0 = alamat tambahan'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `blog`
--

CREATE TABLE `blog` (
  `id_blog` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `isi` longtext NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `id_kategori` int(11) NOT NULL,
  `gambar1` varchar(225) NOT NULL,
  `gambar2` varchar(225) DEFAULT NULL,
  `gambar3` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `blog`
--

INSERT INTO `blog` (`id_blog`, `judul`, `isi`, `tanggal`, `id_kategori`, `gambar1`, `gambar2`, `gambar3`) VALUES
(300, 'Bunga baru', '<p>Ini adalah bunga baru saya</p>', '2021-07-05', 1, 'banner_keripik_1.jpg', 'banner_keripik_2.jpg', 'banner_keripik_3.jpg'),
(301, 'Blog baru', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed turpis sed lorem dignissim vulputate nec cursus ante. Nunc sit amet tempor magna. Donec eros sem, porta eget leo et, varius eleifend mauris. Donec eu leo congue, faucibus quam eu, viverra mauris. Nulla consectetur lorem mi, at sce', '2021-12-03', 5, '4.jpg', NULL, NULL),
(302, 'Bunga hias', '<p style=\"text-align:justify\">Aliquam faucibus scelerisque placerat. Vestibulum vel libero eu nulla varius pretium eget eu magna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean dictum faucibus felis, ac vestibulum risus mollis in. Phasellus neque', '2021-07-05', 6, '8.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `gambar` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`id_cart`, `id_user`, `id_produk`, `nama`, `harga`, `qty`, `gambar`) VALUES
(56, 3, 17, 'Longsleeve Nipon Wave', 75000, 5, 'V.jpg'),
(57, 3, 16, 'Longsleeve Summer Comeback', 75000, 3, 'N.jpg'),
(58, 3, 14, 'Sweatshirt Kazuko Fleece Maroon', 140000, 3, 'G.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inbox`
--

CREATE TABLE `inbox` (
  `id_inbox` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nohp` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pesan` longtext NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL COMMENT 'jika 1 blm dibaca, jika 0 sdh dibaca'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inbox`
--

INSERT INTO `inbox` (`id_inbox`, `nama`, `nohp`, `email`, `pesan`, `tanggal`, `status`) VALUES
(1, 'anisaa', '089646373773', 'dwialdian2@gmail.com', 'hhfgh', '2021-08-25 03:04:33', 0),
(2, 'Aldian', '089646373773', 'suseno@gmail.com', 'ututy', '2021-08-25 03:04:42', 0),
(3, 'HADI IRWANSYAH', '089646373773', 'aldiandwi78@gmail.com', 'gdfgdg', '2021-08-25 03:06:29', 0),
(4, 'ABUN SETIAWAN', '081936346937', 'admin@gmail.com', 'twtwrt', '2021-08-25 03:06:36', 0),
(5, 'COBA', '081936346937', 'aldiandwi78@gmail.com', 'fssg', '2021-08-25 03:07:15', 0),
(6, 'anisaa', '081936346937', 'aldiandwi78@gmail.com', 'rwrwr', '2021-08-25 03:07:21', 0),
(7, 'ABUN SETIAWAN', '081936346937', 'anisaflorasidoarjo@gmail.com', 'tyty', '2021-08-25 03:07:27', 0),
(8, 'anisaa', '089646373773', 'suseno@gmail.com', 'tteye', '2021-08-25 03:08:38', 0),
(9, 'HADI IRWANSYAH', '081936346937', 'anisaflorasidoarjo@gmail.com', 'tret', '2021-08-25 03:08:45', 0),
(10, 'Aldian', '081936346937', 'anisaflorasidoarjo@gmail.com', 'tryrty', '2021-08-25 03:08:52', 1),
(11, 'anisaa', '089646373773', 'aldian@gmail.com', 'gfgfdg', '2021-08-25 03:08:55', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `gambar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `gambar`) VALUES
(1, 'T SHIRT', 't_shirt.jpg'),
(2, 'COACH', 'COACH.jpg'),
(4, 'SWEETSHIRT', 'Sweeter.jpg'),
(5, 'LONG SLEEVE', 'long_sleeve.jpg'),
(6, 'HOODIE', 'hoodie.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar_blog`
--

CREATE TABLE `komentar_blog` (
  `id_komentar` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `komentar` longtext NOT NULL,
  `status` int(1) NOT NULL COMMENT 'jika 0 komentar, 1 balas',
  `id_blog` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `komentar_blog`
--

INSERT INTO `komentar_blog` (`id_komentar`, `nama`, `email`, `komentar`, `status`, `id_blog`) VALUES
(1, 'anisaa', 'dwialdian2@gmail.com', 'afdfddd', 0, 302),
(2, 'Aldian', 'aldian@gmail.com', 'ghdg', 0, 302);

-- --------------------------------------------------------

--
-- Struktur dari tabel `loginuser`
--

CREATE TABLE `loginuser` (
  `id_user` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `notlp` varchar(12) NOT NULL,
  `provinsi` varchar(225) DEFAULT NULL,
  `kabataukota` varchar(225) DEFAULT NULL,
  `kodepos` int(50) DEFAULT NULL,
  `alamat` longtext DEFAULT NULL,
  `password` varchar(225) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `tanggal` varchar(25) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1 akun aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `loginuser`
--

INSERT INTO `loginuser` (`id_user`, `username`, `email`, `notlp`, `provinsi`, `kabataukota`, `kodepos`, `alamat`, `password`, `gambar`, `tanggal`, `status`) VALUES
(3, 'aldian', 'aldiandwi78@gmail.com', '081936346937', 'Jawa Timur', 'Kabupaten Sidoarjo', 799, 'Graha kita semua hahahaha', '$2y$10$maDtUbdekBRyCldIqTEUruA02CSUQRaIub.G7pHgtpK7YEhYGmfDG', 'E.jpg', '2021-07-21 02:07:57', 1),
(5, 'admin', 'admin@gmail.com', '064846868468', 'Jawa Barat', 'Kota Bandung', 811, 'Graha asri sukodono', '$2y$10$maDtUbdekBRyCldIqTEUruA02CSUQRaIub.G7pHgtpK7YEhYGmfDG', 'default.jpg', '2021-07-22 10:36:17', 1),
(6, 'anisa', 'anisaflorasidoarjo@gmail.com', '123456789123', 'Bali', 'Kabupaten Tabanan', 811, 'gedangan', '$2y$10$bYVgQ89hgcGBiyXejC6/G.mn2qwcHQQgTf6HnpD1bXfzFME.xE3w.', 'default.jpg', '2021-07-24 02:14:53', 1),
(8, 'algis', 'algis@gmail.com', '081245673853', 'Kalimantan Timur', 'Kota Balikpapan', 799, 'Graha sukodono indah', '$2y$10$SMBwOCOFeIO0aH8kO8705eY.Cx7wdL5oBw3Ieoc7iNGn.rnX9Xakq', 'default.jpg', '2021-07-25 05:26:38', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `loginuser_token`
--

CREATE TABLE `loginuser_token` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `waktu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `loginuser_token`
--

INSERT INTO `loginuser_token` (`id`, `email`, `token`, `waktu`) VALUES
(1, 'aldiandwi78@gmail.com', 'K3z7YkS1RNrx1drhc+fWhzISQ+xnd9N+BqnOobQLgqc=', 1627402869),
(2, 'aldiandwi78@gmail.com', 'ZznBNbagQ8ly7nEiJaMr0C7iVtI7F9bZEgezrQh0pBQ=', 1627403112),
(3, 'aldiandwi78@gmail.com', 'TzEN7DBMQQC+cdfcpatjmFMGrPoxUuqP5Bf3ifIURH0=', 1627403155),
(4, 'aldiandwi78@gmail.com', 'AFkWynQVohIIIBasxkG6NIrmv0NbpVKPHp0V02/kI+M=', 1627403181),
(5, 'aldiandwi78@gmail.com', 'x6Vngxs4UeK8zgjEGjNehmV+8OXR2tFzKSf+OeAD174=', 1627404825),
(6, 'aldiandwi78@gmail.com', 'LmAEsC/t9kjCkYLMD+L6lfeFL8pWQiwfVizPzv+Uu3M=', 1627406738);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `isi_produk` longtext NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `berat` varchar(50) DEFAULT NULL,
  `diskon_harga` int(50) DEFAULT NULL,
  `harga` int(50) NOT NULL,
  `stok` int(225) NOT NULL,
  `gambar1` varchar(50) NOT NULL,
  `gambar2` varchar(50) DEFAULT NULL,
  `gambar3` varchar(50) DEFAULT NULL,
  `gambar4` varchar(50) DEFAULT NULL,
  `gambar5` varchar(50) DEFAULT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `isi_produk`, `tanggal`, `berat`, `diskon_harga`, `harga`, `stok`, `gambar1`, `gambar2`, `gambar3`, `gambar4`, `gambar5`, `id_kategori`) VALUES
(1, 'Erigo T-Shirt Good Ending Cotton Combed Navy', '<p style=\"text-align:justify\">T-Shirt Erigo saat ini merupakan salah satu lini pakaian terbaik dan berkualitas tinggi di antara Local Brand Indonesia. Dibuat dengan bahan cotton yang nyaman untuk mene', '2021-07-10', '200 Gram', 180000, 63000, 80, 'T.jpg', 'T1.jpg', 'T2.jpg', NULL, NULL, 1),
(2, 'Erigo T-Shirt Newport', '<p style=\"text-align:justify\">T-Shirt Erigo saat ini merupakan salah satu lini pakaian terbaik dan berkualitas tinggi di antara Local Brand Indonesia. Dibuat dengan bahan cotton yang nyaman untuk mene', '2021-07-10', '200 Gram', NULL, 65000, 50, 'S.jpg', 'S1.jpg', 'S2.jpg', 'S3.jpg', NULL, 1),
(3, 'Erigo T-Shirt Ghost', '<p style=\"text-align:justify\">T-Shirt Erigo saat ini merupakan salah satu lini pakaian terbaik dan berkualitas tinggi di antara Local Brand Indonesia. Dibuat dengan bahan cotton yang nyaman untuk mene', '2021-07-10', '200 Gram', 100000, 80000, 100, 'F.jpg', 'F1.jpg', 'F2.jpg', 'F3.jpg', 'F4.jpg', 1),
(4, 'Coach Jacket Fuku Ride Taslan Black', '<p style=\"text-align:justify\">Coach Jacket Erigo saat ini merupakan salah satu lini pakaian terbaik dan berkualitas tinggi di antara Local Brand Indonesia. Jaket berkerah dengan kancing jepret, saku f', '2021-07-10', '300 Gram', 200000, 140000, 250, 'A.jpg', 'A1.jpg', 'A2.jpg', 'A3.jpg', 'A4.jpg', 2),
(5, 'Coach Jacket Hakodate Taslan Khaki', '<p style=\"text-align:justify\">&quot;Coach Jacket Erigo saat ini merupakan salah satu lini pakaian terbaik dan berkualitas tinggi di antara Local Brand Indonesia. Jaket berkerah dengan kancing jepret, ', '2021-07-10', '300 Gram', NULL, 160000, 200, 'B.jpg', 'B2.jpg', 'B3.jpg', NULL, NULL, 2),
(6, 'Coach Jacket Safuboi Taslan Darkgrey', '<p style=\"text-align:justify\">Coach Jacket Erigo saat ini merupakan salah satu lini pakaian terbaik dan berkualitas tinggi di antara Local Brand Indonesia. Jaket berkerah dengan kancing jepret, saku f</p>', '2021-07-10', '300 Gram', NULL, 160000, 150, 'C.jpg', 'C1.jpg', 'C2.jpg', 'C3.jpg', 'C4.jpg', 2),
(9, 'Erigo Hoodie Dyvette Fleece Olive ', '<p style=\"text-align:justify\">Hoodie Erigo saat ini merupakan salah satu lini pakaian terbaik dan berkualitas tinggi di antara Local Brand Indonesia. Dengan model loose-fit berlengan panjang memiliki ', '2021-07-10', '300 Gram', 250000, 150000, 150, 'H.jpg', 'H1.jpg', 'H3.jpg', 'H4.jpg', NULL, 6),
(10, 'Erigo Hoodie Alsava Fleece Red', '<p style=\"text-align:justify\">Hoodie Erigo saat ini merupakan salah satu lini pakaian terbaik dan berkualitas tinggi di antara Local Brand Indonesia. Dengan model loose-fit berlengan panjang memiliki ', '2021-07-10', '300 Gram', NULL, 160000, 130, 'O.jpg', 'O1.jpg', 'O2.jpg', NULL, NULL, 6),
(11, 'Erigo Hoodie College Fleece Navy', '<p style=\"text-align:justify\">Hoodie Erigo saat ini merupakan salah satu lini pakaian terbaik dan berkualitas tinggi di antara Local Brand Indonesia. Dengan model loose-fit berlengan panjang memiliki ', '2021-07-10', '300 Gram', NULL, 180000, 250, 'D.jpg', 'D1.jpg', 'D2.jpg', 'D3.jpg', NULL, 6),
(12, 'Sweatshirt Huxly Fleece Navy', '<p style=\"text-align:justify\">Sweatshirt Erigo saat ini merupakan salah satu lini pakaian terbaik dan berkualitas tinggi di antara Local Brand Indonesia. Dengan model loose-fit berlengan panjang tanpa', '2021-07-10', '300 Gram', 200000, 120000, 10, 'E.jpg', 'E1.jpg', 'E2.jpg', 'E3.jpg', 'E4.jpg', 4),
(13, 'Sweatshirt Yoshi Fleece Emerald', '<p style=\"text-align:justify\">Sweatshirt Erigo saat ini merupakan salah satu lini pakaian terbaik dan berkualitas tinggi di antara Local Brand Indonesia. Dengan model loose-fit berlengan panjang tanpa', '2021-07-10', '300 Gram', NULL, 160000, 10, 'R.jpg', 'R1.jpg', 'R2.jpg', NULL, NULL, 4),
(14, 'Sweatshirt Kazuko Fleece Maroon', '<p style=\"text-align:justify\">Sweatshirt Erigo saat ini merupakan salah satu lini pakaian terbaik dan berkualitas tinggi di antara Local Brand Indonesia. Dengan model loose-fit berlengan panjang tanpa</p>', '2021-07-10', '300 Gram', NULL, 140000, 2, 'G.jpg', 'G1.jpg', 'G2.jpg', NULL, NULL, 4),
(15, 'Erigo Longsleeve Good Quality', '<p style=\"text-align:justify\">Long Sleeve Erigo saat ini merupakan salah satu lini pakaian terbaik dan berkualitas tinggi di antara Local Brand Indonesia. Dibuat dengan printed design yang minimalis d</p>', '2021-07-10', '200 Gram', NULL, 70000, 200, 'L.jpg', 'L1.jpg', 'L2.jpg', 'L3.jpg', 'L4.jpg', 5),
(16, 'Longsleeve Summer Comeback', '<p style=\"text-align:justify\">Long Sleeve Erigo saat ini merupakan salah satu lini pakaian terbaik dan berkualitas tinggi di antara Local Brand Indonesia. Dibuat dengan printed design yang minimalis d</p>', '2021-07-10', '200 Gram', NULL, 75000, 100, 'N.jpg', 'N1.jpg', 'N2.jpg', NULL, NULL, 5),
(17, 'Longsleeve Nipon Wave', '<p>Long Sleeve Erigo saat ini merupakan salah satu lini pakaian terbaik dan berkualitas tinggi di antara Local Brand Indonesia. Dibuat dengan printed design yang minimalis dan hype! Kaos ini lebih nyaman dengan dilengkapi ujung lengan yang elastis. Kombinasikan dengan jogger pants atau denim pants dan kamu siap untuk berpergian!</p>', '2021-07-10', '200 Gram', NULL, 75000, 150, 'V.jpg', 'V1.jpg', 'V2.jpg', 'V3.jpg', NULL, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider`
--

CREATE TABLE `slider` (
  `id_slider` int(11) NOT NULL,
  `gambar` varchar(30) NOT NULL,
  `isi1` varchar(30) NOT NULL,
  `isi2` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `slider`
--

INSERT INTO `slider` (`id_slider`, `gambar`, `isi1`, `isi2`) VALUES
(50, 'slide5.jpg', 'Anisa flora store', 'Selamat datang di Store annisa'),
(53, 'slide3.jpg', 'Anisa flora store', 'Selamat datang di Store annisa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gambar` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` int(1) NOT NULL COMMENT '1:admin 2:user',
  `cookie` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `gambar`, `password`, `level`, `cookie`) VALUES
(23, 'aldiandwi', 'dwialdian2@gmail.com', 'default.jpg', 'efe22ffef1c540d813c4076d0f76aa2bcc2fb887', 1, NULL),
(85, 'ANISA FLORA', 'anisaflorasidoarjo@gmail.com', 'visa.png', 'efe22ffef1c540d813c4076d0f76aa2bcc2fb887', 1, NULL),
(89, 'suseno', 'suseno@gmail.com', 'default.jpg', 'e41903aab956d15c448b1294cb2cb7e5af33f92c', 2, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`) VALUES
(1, 'anisaflorasidoarjo@gmail.com', 'Y+b57vy7lrnUeXfWT9s6XZpqG1BeHxyM4TIU9NgL4N8='),
(2, 'anisaflorasidoarjo@gmail.com', 'u5zOi6JWVfg5e3OIMLfMBBL6VamDJk+7hMOOavzQVG4='),
(3, 'anisaflorasidoarjo@gmail.com', 'TFnIYWy9d0jQQHo/XRYdWK7RN5OBziLhEr31aAj/wMQ=');

-- --------------------------------------------------------

--
-- Struktur dari tabel `visitor`
--

CREATE TABLE `visitor` (
  `ip` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `hits` int(10) NOT NULL,
  `online` varchar(50) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `visitor`
--

INSERT INTO `visitor` (`ip`, `date`, `hits`, `online`, `time`) VALUES
('127.0.0.1', '2020-09-30', 24, '1601487836', '2020-09-30 17:54:48'),
('::1', '2020-10-01', 44, '1601579517', '2020-10-01 05:09:20'),
('::1', '2020-10-02', 7, '1601659668', '2020-10-02 08:41:49'),
('::1', '2020-10-03', 9, '1601751700', '2020-10-03 04:49:09'),
('127.0.0.1', '2020-10-03', 2, '1601726544', '2020-10-03 12:29:08'),
('::1', '2020-10-04', 41, '1601838688', '2020-10-04 07:44:53'),
('::1', '2020-10-05', 146, '1601910305', '2020-10-05 05:12:01'),
('::1', '2020-10-06', 7, '1602005487', '2020-10-06 05:48:23'),
('127.0.0.1', '2020-10-07', 1, '1602050170', '2020-10-07 07:56:10'),
('::1', '2020-10-08', 3, '1602175429', '2020-10-08 09:52:26'),
('::1', '2020-10-11', 1, '1602430423', '2020-10-11 17:33:43'),
('::1', '2020-10-12', 10, '1602524964', '2020-10-12 04:56:59'),
('::1', '2020-10-13', 2, '1602607833', '2020-10-13 11:41:39'),
('::1', '2020-10-14', 1, '1602694387', '2020-10-14 18:53:07'),
('::1', '2020-10-15', 3, '1602788808', '2020-10-15 19:11:08'),
('::1', '2020-10-16', 1, '1602828917', '2020-10-16 08:15:17'),
('::1', '2020-10-17', 9, '1602963008', '2020-10-17 11:24:53'),
('::1', '2020-10-18', 2, '1603044313', '2020-10-18 19:21:33'),
('::1', '2020-10-19', 7, '1603131307', '2020-10-19 07:13:21'),
('::1', '2020-10-20', 19, '1603217116', '2020-10-20 08:25:11'),
('::1', '2020-10-21', 22, '1603269775', '2020-10-21 06:16:17'),
('::1', '2020-10-22', 22, '1603388389', '2020-10-22 05:29:29'),
('::1', '2020-10-23', 3, '1603461759', '2020-10-23 11:07:09'),
('::1', '2020-10-24', 4, '1603559635', '2020-10-24 09:49:40'),
('::1', '2020-10-26', 2, '1603731806', '2020-10-26 04:24:23'),
('::1', '2020-10-27', 1, '1603782027', '2020-10-27 08:00:27'),
('::1', '2020-10-30', 1, '1604029643', '2020-10-30 04:47:23'),
('::1', '2020-11-03', 6, '1604416345', '2020-11-03 09:18:55'),
('::1', '2020-11-04', 1, '1604517200', '2020-11-04 20:13:20'),
('::1', '2020-11-06', 1, '1604671683', '2020-11-06 15:08:03'),
('127.0.0.1', '2020-11-22', 1, '1606068414', '2020-11-22 19:06:54'),
('127.0.0.1', '2020-11-23', 2, '1606136815', '2020-11-23 14:06:43'),
('127.0.0.1', '2020-11-28', 3, '1606582077', '2020-11-28 17:47:32'),
('127.0.0.1', '2020-12-05', 8, '1607150603', '2020-12-05 05:02:04'),
('::1', '2020-12-09', 37, '1607540015', '2020-12-09 09:36:17'),
('::1', '2020-12-10', 144, '1607611276', '2020-12-10 03:59:28'),
('::1', '2020-12-12', 8, '1607807484', '2020-12-12 21:47:20'),
('::1', '2020-12-13', 2, '1607861305', '2020-12-13 12:43:38'),
('::1', '2020-12-24', 1, '1608793685', '2020-12-24 08:08:05'),
('::1', '2021-01-05', 147, '1609869501', '2021-01-05 11:27:30'),
('127.0.0.1', '2021-01-05', 6, '1609849704', '2021-01-05 11:29:08'),
('::1', '2021-01-06', 337, '1609962871', '2021-01-06 12:33:34'),
('::1', '2021-01-07', 238, '1610047953', '2021-01-07 08:35:22'),
('::1', '2021-01-08', 256, '1610131111', '2021-01-08 08:15:59'),
('::1', '2021-01-09', 277, '1610219792', '2021-01-09 08:24:59'),
('::1', '2021-01-11', 16, '1610352851', '2021-01-11 07:15:34'),
('::1', '2021-01-27', 47, '1611749620', '2021-01-27 08:50:42'),
('127.0.0.1', '2021-01-27', 1, '1611734297', '2021-01-27 08:58:17'),
('::1', '2021-01-28', 96, '1611858467', '2021-01-28 08:46:23'),
('::1', '2021-01-30', 88, '1612030735', '2021-01-30 12:32:38'),
('::1', '2021-01-31', 157, '1612112952', '2021-01-31 05:54:41'),
('::1', '2021-02-01', 62, '1612204730', '2021-02-01 14:38:34'),
('::1', '2021-02-02', 2, '1612259479', '2021-02-02 10:51:04'),
('::1', '2021-02-04', 2, '1612463533', '2021-02-04 10:15:16'),
('::1', '2021-02-05', 1, '1612531158', '2021-02-05 14:19:18'),
('::1', '2021-03-01', 2, '1614627727', '2021-03-01 19:41:48'),
('::1', '2021-03-06', 1, '1615045646', '2021-03-06 15:47:26'),
('::1', '2021-03-21', 3, '1616354872', '2021-03-21 19:27:17'),
('::1', '2021-03-25', 8, '1616687866', '2021-03-25 15:57:31'),
('::1', '2021-03-26', 1, '1616776813', '2021-03-26 16:40:13'),
('::1', '2021-03-29', 1, '1617016202', '2021-03-29 11:10:02'),
('::1', '2021-04-26', 12, '1619465089', '2021-04-26 18:40:51'),
('::1', '2021-04-28', 1, '1619628978', '2021-04-28 16:56:18'),
('::1', '2021-04-30', 7, '1619778815', '2021-04-30 09:59:19'),
('::1', '2021-05-02', 5, '1619978796', '2021-05-02 17:49:18'),
('::1', '2021-05-03', 165, '1620069770', '2021-05-03 16:52:44'),
('::1', '2021-05-04', 41, '1620153819', '2021-05-04 15:03:20'),
('::1', '2021-05-05', 3, '1620231725', '2021-05-05 16:01:39'),
('::1', '2021-05-06', 5, '1620331399', '2021-05-06 14:21:54'),
('::1', '2021-05-07', 10, '1620411592', '2021-05-07 12:37:42'),
('::1', '2021-05-08', 1, '1620491708', '2021-05-08 16:35:08'),
('::1', '2021-05-09', 5, '1620583389', '2021-05-09 12:22:37'),
('127.0.0.1', '2021-05-10', 1, '1620656813', '2021-05-10 14:26:53'),
('::1', '2021-05-10', 2, '1620658874', '2021-05-10 15:00:51'),
('::1', '2021-05-11', 1, '1620757489', '2021-05-11 18:24:49'),
('::1', '2021-05-13', 1, '1620915026', '2021-05-13 14:10:26'),
('::1', '2021-05-14', 1, '1621003662', '2021-05-14 14:47:42'),
('::1', '2021-05-15', 2, '1621104087', '2021-05-15 17:29:13'),
('::1', '2021-05-16', 1, '1621177616', '2021-05-16 15:06:56'),
('127.0.0.1', '2021-05-16', 1, '1621179394', '2021-05-16 15:36:34'),
('::1', '2021-05-17', 1, '1621274670', '2021-05-17 18:04:30'),
('::1', '2021-05-18', 6, '1621354907', '2021-05-18 10:01:31'),
('::1', '2021-05-19', 3, '1621416298', '2021-05-19 09:24:49'),
('::1', '2021-05-22', 9, '1621713852', '2021-05-22 08:42:27'),
('::1', '2021-05-27', 1, '1622107191', '2021-05-27 09:19:51'),
('::1', '2021-05-30', 4, '1622376999', '2021-05-30 12:16:22'),
('::1', '2021-06-12', 2, '1623500689', '2021-06-12 12:24:02'),
('::1', '2021-06-16', 10, '1623864622', '2021-06-16 07:57:18'),
('::1', '2021-06-19', 6, '1624134394', '2021-06-19 15:29:43'),
('::1', '2021-06-21', 1, '1624277080', '2021-06-21 12:04:40'),
('::1', '2021-06-23', 1, '1624470974', '2021-06-23 17:56:14'),
('::1', '2021-06-24', 1, '1624540416', '2021-06-24 13:13:36'),
('::1', '2021-06-25', 2, '1624640423', '2021-06-25 08:46:36'),
('::1', '2021-06-26', 1, '1624701434', '2021-06-26 09:57:14'),
('::1', '2021-06-27', 3, '1624805531', '2021-06-27 09:52:29'),
('::1', '2021-06-28', 4, '1624912630', '2021-06-28 10:15:01'),
('::1', '2021-06-29', 3, '1624969184', '2021-06-29 08:39:08'),
('::1', '2021-06-30', 5, '1625085024', '2021-06-30 09:10:25'),
('::1', '2021-07-01', 3, '1625156314', '2021-07-01 16:18:26'),
('127.0.0.1', '2021-07-01', 1, '1625158014', '2021-07-01 16:46:54'),
('::1', '2021-07-02', 2, '1625254892', '2021-07-02 15:16:40'),
('127.0.0.1', '2021-07-02', 1, '1625241082', '2021-07-02 15:51:22'),
('::1', '2021-07-03', 3, '1625331081', '2021-07-03 10:02:28'),
('::1', '2021-07-04', 5, '1625427314', '2021-07-04 14:49:25'),
('::1', '2021-07-05', 2, '1625503256', '2021-07-05 10:18:58'),
('::1', '2021-07-06', 1, '1625571294', '2021-07-06 11:34:54'),
('::1', '2021-07-07', 3, '1625672657', '2021-07-07 13:46:19'),
('::1', '2021-07-08', 1, '1625682967', '2021-07-08 01:36:07'),
('127.0.0.1', '2021-07-10', 3, '1625923599', '2021-07-10 18:25:14'),
('127.0.0.1', '2021-07-15', 1, '1626346931', '2021-07-15 18:02:11'),
('127.0.0.1', '2021-07-16', 2, '1626445715', '2021-07-16 21:28:23'),
('::1', '2021-07-18', 1, '1626620783', '2021-07-18 15:06:23'),
('127.0.0.1', '2021-08-07', 1, '1628273132', '2021-08-07 01:05:32'),
('127.0.0.1', '2021-08-08', 1, '1628433373', '2021-08-08 21:36:13'),
('127.0.0.1', '2021-08-17', 8, '1629218651', '2021-08-17 23:28:46'),
('127.0.0.1', '2021-08-18', 46, '1629308892', '2021-08-18 02:02:11'),
('127.0.0.1', '2021-08-19', 3, '1629393765', '2021-08-19 00:21:22'),
('127.0.0.1', '2021-08-20', 142, '1629478722', '2021-08-20 00:11:53'),
('::1', '2021-08-20', 1, '1629475844', '2021-08-20 16:10:44'),
('127.0.0.1', '2021-08-21', 47, '1629490863', '2021-08-21 00:02:16'),
('127.0.0.1', '2021-08-22', 15, '1629651504', '2021-08-22 23:16:00'),
('::1', '2021-08-22', 6, '1629652334', '2021-08-22 16:47:43'),
('127.0.0.1', '2021-08-23', 126, '1629734930', '2021-08-23 00:00:26'),
('::1', '2021-08-23', 3, '1629716952', '2021-08-23 11:08:34'),
('127.0.0.1', '2021-08-25', 320, '1629884778', '2021-08-25 00:03:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wishlist`
--

CREATE TABLE `wishlist` (
  `id_wishlist` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(225) NOT NULL,
  `harga` int(11) NOT NULL,
  `tgl` date NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `wishlist`
--

INSERT INTO `wishlist` (`id_wishlist`, `id_user`, `id_produk`, `nama_produk`, `harga`, `tgl`, `gambar`) VALUES
(1, 3, 2, 'Erigo T-Shirt Newport', 65000, '2021-08-11', 'S.jpg'),
(2, 5, 4, 'Coach Jacket Fuku Ride Taslan Black', 140000, '2021-08-11', 'A.jpg'),
(3, 5, 5, 'Coach Jacket Hakodate Taslan Khaki', 160000, '2021-08-11', 'B.jpg'),
(4, 3, 5, 'Coach Jacket Hakodate Taslan Khaki', 160000, '2021-08-11', 'B.jpg'),
(5, 3, 17, 'Longsleeve Nipon Wave', 75000, '2021-08-29', 'V.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alamat_user`
--
ALTER TABLE `alamat_user`
  ADD PRIMARY KEY (`id_alamat`);

--
-- Indeks untuk tabel `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id_blog`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`id_inbox`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `komentar_blog`
--
ALTER TABLE `komentar_blog`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_blog` (`id_blog`);

--
-- Indeks untuk tabel `loginuser`
--
ALTER TABLE `loginuser`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `loginuser_token`
--
ALTER TABLE `loginuser_token`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id_wishlist`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alamat_user`
--
ALTER TABLE `alamat_user`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `blog`
--
ALTER TABLE `blog`
  MODIFY `id_blog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `inbox`
--
ALTER TABLE `inbox`
  MODIFY `id_inbox` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `komentar_blog`
--
ALTER TABLE `komentar_blog`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `loginuser`
--
ALTER TABLE `loginuser`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `loginuser_token`
--
ALTER TABLE `loginuser_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `slider`
--
ALTER TABLE `slider`
  MODIFY `id_slider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id_wishlist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
