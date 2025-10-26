-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Okt 2025 pada 08.57
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipbs_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_about`
--

CREATE TABLE `tbl_about` (
  `about_id` int(11) NOT NULL,
  `about_image` varchar(100) DEFAULT NULL,
  `about_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_about`
--

INSERT INTO `tbl_about` (`about_id`, `about_image`, `about_description`) VALUES
(1, 'about.png', '<p>SIPSB dikelola oleh Kementrian Lingkungan Hidup dan Kehutanan sebagai upaya pemerintah dalam melakukan pemeringkatan bank sampah teraktif di kota makassar.</p>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(200) DEFAULT NULL,
  `category_slug` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `category_slug`) VALUES
(4, 'R3', 'r3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `comment_id` int(11) NOT NULL,
  `comment_date` timestamp NULL DEFAULT current_timestamp(),
  `comment_name` varchar(60) DEFAULT NULL,
  `comment_email` varchar(90) DEFAULT NULL,
  `comment_message` text DEFAULT NULL,
  `comment_status` int(11) DEFAULT 0,
  `comment_parent` int(11) DEFAULT 0,
  `comment_post_id` int(11) DEFAULT NULL,
  `comment_image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_home`
--

CREATE TABLE `tbl_home` (
  `home_id` int(11) NOT NULL,
  `home_caption_1` varchar(200) DEFAULT NULL,
  `home_caption_2` varchar(200) DEFAULT NULL,
  `home_bg_heading` varchar(50) DEFAULT NULL,
  `home_bg_testimonial` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_home`
--

INSERT INTO `tbl_home` (`home_id`, `home_caption_1`, `home_caption_2`, `home_bg_heading`, `home_bg_testimonial`) VALUES
(1, 'SISTEM INFORMASI PERANGKINGAN BANK SAMPAH TERAKTIF DI KOTA MAKASSAR', 'SIPBS', 'Picsart_24-09-25_19-17-56-380.jpg', 'PicsArt_07-17-11_26_292.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_inbox`
--

CREATE TABLE `tbl_inbox` (
  `inbox_id` int(11) NOT NULL,
  `inbox_name` varchar(50) DEFAULT NULL,
  `inbox_email` varchar(80) DEFAULT NULL,
  `inbox_subject` varchar(200) DEFAULT NULL,
  `inbox_message` text DEFAULT NULL,
  `inbox_created_at` timestamp NULL DEFAULT current_timestamp(),
  `inbox_status` varchar(2) DEFAULT '0' COMMENT '0=Unread, 1=Read'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_navbar`
--

CREATE TABLE `tbl_navbar` (
  `navbar_id` int(11) NOT NULL,
  `navbar_name` varchar(50) DEFAULT NULL,
  `navbar_slug` varchar(200) DEFAULT NULL,
  `navbar_parent_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_navbar`
--

INSERT INTO `tbl_navbar` (`navbar_id`, `navbar_name`, `navbar_slug`, `navbar_parent_id`) VALUES
(1, 'Beranda', NULL, 0),
(2, 'Tentang', 'about', 0),
(3, 'Berita', 'blog', 0),
(4, 'Kontak', 'contact', 0),
(5, 'Masuk', 'login', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_post`
--

CREATE TABLE `tbl_post` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(250) DEFAULT NULL,
  `post_description` text DEFAULT NULL,
  `post_contents` longtext DEFAULT NULL,
  `post_image` varchar(40) DEFAULT NULL,
  `post_date` timestamp NULL DEFAULT current_timestamp(),
  `post_last_update` datetime DEFAULT NULL,
  `post_category_id` int(11) DEFAULT NULL,
  `post_tags` varchar(225) DEFAULT NULL,
  `post_slug` varchar(250) DEFAULT NULL,
  `post_status` int(11) DEFAULT NULL COMMENT '1=Publish, 0=Unpublish',
  `post_views` int(11) DEFAULT 0,
  `post_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_post`
--

INSERT INTO `tbl_post` (`post_id`, `post_title`, `post_description`, `post_contents`, `post_image`, `post_date`, `post_last_update`, `post_category_id`, `post_tags`, `post_slug`, `post_status`, `post_views`, `post_user_id`) VALUES
(2, 'Penerapan Prinsip Reduce Reuse Recycle (3R) pada Bank Sampah', '', '<p></p><div style=\"text-align: center;\"><img src=\"http://localhost/sipbs/assets/images/PicsArt_07-17-06_38_05vv1.jpg\" class=\"img-thumbnail\" style=\"width: 100%;\"><br></div><div style=\"text-align: center;\"><br></div><div style=\"text-align: center;\"><br></div><div style=\"text-align: left;\">Definisi 3R adalah singkatan dari Reduce, Reuse, dan Recycle, yang merupakan konsep penting dalam manajemen limbah dan pelestarian lingkungan. Berikut adalah penjelasan singkat tentang masing-masing komponen 3R:</div><div style=\"text-align: left;\"><br></div><ol><li style=\"text-align: left;\">Reduce (Mengurangi): Mengurangi produksi limbah dengan mengurangi penggunaan barang-barang sekali pakai atau mengambil langkah-langkah untuk mengurangi konsumsi sumber daya alam. Ini bisa mencakup praktik seperti membeli produk dengan kemasan minimal, menggunakan energi lebih efisien, atau menghindari pemborosan sumber daya.</li><li style=\"text-align: left;\">Reuse (Menggunakan Ulang): Menggunakan kembali barang-barang atau bahan-bahan yang masih dapat digunakan setelah pemakaian awalnya. Contoh termasuk mengisi ulang botol air minum, mendaur ulang kemasan, atau mendonasikan barang-barang bekas yang masih berfungsi daripada membeli yang baru.</li><li style=\"text-align: left;\">Recycle (Mendaur Ulang): Proses mengubah bahan-bahan bekas menjadi bahan baru yang dapat digunakan kembali. Ini melibatkan pengumpulan, pemrosesan, dan pemurnian limbah untuk menghasilkan produk baru. Mendaur ulang membantu mengurangi penggunaan sumber daya alam yang langka dan mengurangi dampak negatif pada lingkungan.</li></ol><p></p>', '99e3bca4cbd0742b05cf64654c646ad3.jpg', '2024-09-16 07:55:05', '2024-09-25 19:54:04', 4, 'reduce-reuse-recycle', 'penerapan-prinsip-reduce-reuse-recycle--3r--pada-bank-sampah', 1, 3, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_post_views`
--

CREATE TABLE `tbl_post_views` (
  `view_id` int(11) NOT NULL,
  `view_date` timestamp NULL DEFAULT current_timestamp(),
  `view_ip` varchar(50) DEFAULT NULL,
  `view_post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_post_views`
--

INSERT INTO `tbl_post_views` (`view_id`, `view_date`, `view_ip`, `view_post_id`) VALUES
(1, '2024-09-19 14:50:27', '::1', 2),
(2, '2024-09-25 11:47:25', '::1', 2),
(3, '2024-09-27 16:04:45', '::1', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_site`
--

CREATE TABLE `tbl_site` (
  `site_id` int(11) NOT NULL,
  `site_name` varchar(100) DEFAULT NULL,
  `site_title` varchar(200) DEFAULT NULL,
  `site_description` text DEFAULT NULL,
  `site_favicon` varchar(50) DEFAULT NULL,
  `site_logo_header` varchar(50) DEFAULT NULL,
  `site_logo_footer` varchar(50) DEFAULT NULL,
  `site_logo_big` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_site`
--

INSERT INTO `tbl_site` (`site_id`, `site_name`, `site_title`, `site_description`, `site_favicon`, `site_logo_header`, `site_logo_footer`, `site_logo_big`) VALUES
(1, 'Sistem Informasi Perangkingan Bank Sampah', 'SIPBS', '', 'PicsArt_07-16-08_36_28_(1)11.png', 'logo-black1.png', 'favicon.png', 'logo-black1 - Copy (2).png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_tags`
--

CREATE TABLE `tbl_tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_tags`
--

INSERT INTO `tbl_tags` (`tag_id`, `tag_name`) VALUES
(5, 'reduce-reuse-recycle');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_testimonial`
--

CREATE TABLE `tbl_testimonial` (
  `testimonial_id` int(11) NOT NULL,
  `testimonial_name` varchar(50) DEFAULT NULL,
  `testimonial_content` text DEFAULT NULL,
  `testimonial_image` varchar(50) DEFAULT NULL,
  `testimonial_created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_testimonial`
--

INSERT INTO `tbl_testimonial` (`testimonial_id`, `testimonial_name`, `testimonial_content`, `testimonial_image`, `testimonial_created_at`) VALUES
(1, 'Ahmad Ruslandia Papua - Research', 'Metode TOPSIS dan VIKOR Adalah Metode Dalam Pengambilan Keputusan untuk Pemeringkatan Bank Sampah Teraktif Di Kota Makassar ', 'eeb3737fcdd91891cb5b26f27015088f.jpg', '2020-01-03 03:31:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(60) DEFAULT NULL,
  `user_password` varchar(40) DEFAULT NULL,
  `user_level` varchar(10) DEFAULT NULL,
  `user_status` varchar(10) DEFAULT '1',
  `user_photo` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_level`, `user_status`, `user_photo`) VALUES
(3, 'Ahmad Ruslandia Papua', 'ruslandiaamin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '1', '1', 'picture.jpg'),
(4, 'user', 'user@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', '2', '1', '88d9fcfe21415467cb9209c471f82b88.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_visitors`
--

CREATE TABLE `tbl_visitors` (
  `visit_id` int(11) NOT NULL,
  `visit_date` timestamp NULL DEFAULT current_timestamp(),
  `visit_ip` varchar(50) DEFAULT NULL,
  `visit_platform` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_visitors`
--

INSERT INTO `tbl_visitors` (`visit_id`, `visit_date`, `visit_ip`, `visit_platform`) VALUES
(541424, '2024-09-15 16:34:50', '::1', 'Chrome'),
(541425, '2024-09-16 16:04:15', '::1', 'Chrome'),
(541426, '2024-09-17 16:19:09', '::1', 'Chrome'),
(541427, '2024-09-19 12:09:36', '::1', 'Chrome'),
(541428, '2024-09-19 16:10:18', '::1', 'Chrome'),
(541429, '2024-09-21 15:24:06', '::1', 'Chrome'),
(541430, '2024-09-21 16:13:27', '::1', 'Chrome'),
(541431, '2024-09-23 10:48:54', '::1', 'Chrome'),
(541432, '2024-09-24 03:25:16', '::1', 'Chrome'),
(541433, '2024-09-25 09:00:38', '::1', 'Chrome'),
(541434, '2024-09-25 16:10:55', '::1', 'Chrome'),
(541435, '2024-09-27 05:54:55', '::1', 'Chrome'),
(541436, '2024-09-27 16:04:45', '::1', 'Chrome'),
(541437, '2024-09-30 03:42:53', '::1', 'Chrome'),
(541438, '2024-09-30 16:28:24', '::1', 'Chrome'),
(541439, '2024-10-12 08:54:27', '::1', 'Edge'),
(541440, '2024-10-12 16:05:58', '::1', 'Edge'),
(541441, '2024-10-14 06:19:08', '::1', 'Edge'),
(541442, '2024-12-23 07:36:52', '::1', 'Chrome'),
(541443, '2025-09-18 06:21:16', '::1', 'Chrome'),
(541444, '2025-10-18 11:35:05', '::1', 'Chrome'),
(541445, '2025-10-23 14:54:04', '::1', 'Chrome'),
(541446, '2025-10-25 01:18:14', '::1', 'Chrome'),
(541447, '2025-10-26 06:00:09', '::1', 'Chrome');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_alternative`
--

CREATE TABLE `tb_alternative` (
  `kode_alternative` varchar(16) NOT NULL,
  `nama_alternative` varchar(256) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nama_pengelola` varchar(255) DEFAULT NULL,
  `nomor_telepon` bigint(20) DEFAULT NULL,
  `rank_vikor` int(11) DEFAULT NULL,
  `total_vikor` double DEFAULT NULL,
  `rank_topsis` int(11) DEFAULT NULL,
  `total_topsis` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_alternative`
--

INSERT INTO `tb_alternative` (`kode_alternative`, `nama_alternative`, `keterangan`, `alamat`, `nama_pengelola`, `nomor_telepon`, `rank_vikor`, `total_vikor`, `rank_topsis`, `total_topsis`) VALUES
('A02', 'Pelita Harapan', 'BSU', 'Jl. Pelita Raya', 'Surasmi', 6285255796911, 3, 0.31884057971014, 2, 0.47013296475043),
('A03', 'Kreatif Pemuda', 'BSU', 'Jl. Pendidikan', 'Arkan Ahmad', 6285399959635, 1, 0, 1, 0.53712701688421),
('A04', 'Kemapertika', 'BSU', 'Jl. Perintis Kemerdekaan', 'Suryani', 6289623145656, 5, 1, 5, 0.12847513232688),
('A01', 'Pelita Bangsa', 'BSU', 'Jl. Pelita Raya', 'Rosmini', 6281356656456, 2, 0.094202898550725, 3, 0.43185895779372),
('A05', 'Teratai Pampang', 'BSU', 'Jl. Pampang', 'Tima Khilala', 6282196978181, 4, 0.58695652173913, 4, 0.41961122757593);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_crips`
--

CREATE TABLE `tb_crips` (
  `kode_crips` int(11) NOT NULL,
  `kode_criteria` varchar(16) DEFAULT NULL,
  `nama_crips` varchar(255) DEFAULT NULL,
  `nilai` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_crips`
--

INSERT INTO `tb_crips` (`kode_crips`, `kode_criteria`, `nama_crips`, `nilai`) VALUES
(505, 'C1', '<= 2 Jam', 1),
(506, 'C1', '> 2 Jam s.d. 4 Jam', 2),
(507, 'C1', '> 4 Jam s.d.  6 Jam', 3),
(508, 'C1', '> 6 Jam s.d. 8 Jam', 4),
(509, 'C1', '>= 8 Jam', 5),
(518, 'C5', '> 80 KG/ Minggu', 5),
(519, 'C5', '> 60 KG s.d. 80 KG/ Minggu', 4),
(520, 'C5', '> 40 KG s.d. 60 KG/ Minggu', 3),
(521, 'C5', '<= 20 KG/ Minggu', 1),
(522, 'C5', '> 20 KG s.d. 40 KG/ Minggu', 2),
(523, 'C4', '>= 20 Karyawan', 5),
(524, 'C4', '> 15 Karyawan s.d. 20 Karyawan', 4),
(525, 'C4', '> 10 Karyawan s.d. 15 Karyawan', 3),
(526, 'C4', '> 5 Karyawan s.d. 10 Karyawan', 2),
(527, 'C4', '<= 5 Karyawan', 1),
(528, 'C3', '>=200 Rumah Tangga', 5),
(529, 'C3', '> 150 Rumah Tangga s.d. 200 Rumah Tangga', 4),
(530, 'C3', '> 50 Rumah Tangga s.d. 100 Rumah Tangga', 2),
(531, 'C3', '<= 50 Rumah Tangga', 1),
(532, 'C3', '> 100 Rumah Tangga s.d. 150 Rumah Tangga', 3),
(533, 'C2', '5 Hari', 5),
(534, 'C2', '4 Hari', 4),
(535, 'C2', '3 Hari', 3),
(536, 'C2', '2 Hari', 2),
(537, 'C2', '1 Hari', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_criteria`
--

CREATE TABLE `tb_criteria` (
  `kode_criteria` varchar(16) NOT NULL,
  `nama_criteria` varchar(256) DEFAULT NULL,
  `atribut` varchar(16) DEFAULT NULL,
  `bobot` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_criteria`
--

INSERT INTO `tb_criteria` (`kode_criteria`, `nama_criteria`, `atribut`, `bobot`) VALUES
('C1', 'Jam Operasional', 'benefit', 4),
('C2', 'Jadwal Operasional', 'benefit', 4),
('C3', 'Jumlah Nasabah', 'benefit', 4),
('C4', 'Jumlah Tenaga Kerja', 'benefit', 3),
('C5', 'Jumlah Sampah yang Dikumpulkan', 'benefit', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rel_alternative`
--

CREATE TABLE `tb_rel_alternative` (
  `ID` int(11) NOT NULL,
  `kode_alternative` varchar(16) DEFAULT NULL,
  `kode_criteria` varchar(16) DEFAULT NULL,
  `kode_crips` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_rel_alternative`
--

INSERT INTO `tb_rel_alternative` (`ID`, `kode_alternative`, `kode_criteria`, `kode_crips`) VALUES
(66, 'A04', 'C1', 505),
(75, 'A05', 'C4', 525),
(74, 'A05', 'C3', 530),
(64, 'A03', 'C5', 519),
(58, 'A02', 'C5', 522),
(63, 'A03', 'C4', 527),
(57, 'A02', 'C4', 527),
(62, 'A03', 'C3', 531),
(56, 'A02', 'C3', 528),
(61, 'A03', 'C2', 536),
(55, 'A02', 'C2', 537),
(60, 'A03', 'C1', 509),
(54, 'A02', 'C1', 505),
(73, 'A05', 'C2', 536),
(52, 'A01', 'C5', 520),
(51, 'A01', 'C4', 526),
(50, 'A01', 'C3', 531),
(49, 'A01', 'C2', 536),
(48, 'A01', 'C1', 507),
(67, 'A04', 'C2', 537),
(68, 'A04', 'C3', 531),
(69, 'A04', 'C4', 526),
(70, 'A04', 'C5', 521),
(72, 'A05', 'C1', 508),
(76, 'A05', 'C5', 521);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_about`
--
ALTER TABLE `tbl_about`
  ADD PRIMARY KEY (`about_id`);

--
-- Indeks untuk tabel `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeks untuk tabel `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indeks untuk tabel `tbl_home`
--
ALTER TABLE `tbl_home`
  ADD PRIMARY KEY (`home_id`);

--
-- Indeks untuk tabel `tbl_inbox`
--
ALTER TABLE `tbl_inbox`
  ADD PRIMARY KEY (`inbox_id`);

--
-- Indeks untuk tabel `tbl_navbar`
--
ALTER TABLE `tbl_navbar`
  ADD PRIMARY KEY (`navbar_id`);

--
-- Indeks untuk tabel `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indeks untuk tabel `tbl_post_views`
--
ALTER TABLE `tbl_post_views`
  ADD PRIMARY KEY (`view_id`);

--
-- Indeks untuk tabel `tbl_site`
--
ALTER TABLE `tbl_site`
  ADD PRIMARY KEY (`site_id`);

--
-- Indeks untuk tabel `tbl_tags`
--
ALTER TABLE `tbl_tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indeks untuk tabel `tbl_testimonial`
--
ALTER TABLE `tbl_testimonial`
  ADD PRIMARY KEY (`testimonial_id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `tbl_visitors`
--
ALTER TABLE `tbl_visitors`
  ADD PRIMARY KEY (`visit_id`);

--
-- Indeks untuk tabel `tb_alternative`
--
ALTER TABLE `tb_alternative`
  ADD PRIMARY KEY (`kode_alternative`);

--
-- Indeks untuk tabel `tb_crips`
--
ALTER TABLE `tb_crips`
  ADD PRIMARY KEY (`kode_crips`);

--
-- Indeks untuk tabel `tb_criteria`
--
ALTER TABLE `tb_criteria`
  ADD PRIMARY KEY (`kode_criteria`);

--
-- Indeks untuk tabel `tb_rel_alternative`
--
ALTER TABLE `tb_rel_alternative`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_about`
--
ALTER TABLE `tbl_about`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_home`
--
ALTER TABLE `tbl_home`
  MODIFY `home_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_inbox`
--
ALTER TABLE `tbl_inbox`
  MODIFY `inbox_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_navbar`
--
ALTER TABLE `tbl_navbar`
  MODIFY `navbar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_post`
--
ALTER TABLE `tbl_post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_post_views`
--
ALTER TABLE `tbl_post_views`
  MODIFY `view_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_site`
--
ALTER TABLE `tbl_site`
  MODIFY `site_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_tags`
--
ALTER TABLE `tbl_tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_testimonial`
--
ALTER TABLE `tbl_testimonial`
  MODIFY `testimonial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_visitors`
--
ALTER TABLE `tbl_visitors`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=541448;

--
-- AUTO_INCREMENT untuk tabel `tb_crips`
--
ALTER TABLE `tb_crips`
  MODIFY `kode_crips` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=538;

--
-- AUTO_INCREMENT untuk tabel `tb_rel_alternative`
--
ALTER TABLE `tb_rel_alternative`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
