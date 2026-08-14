-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2026 at 08:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `status_hadir` enum('hadir','sakit','izin','alfa') DEFAULT 'hadir',
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `id_karyawan`, `tanggal`, `jam_masuk`, `jam_keluar`, `status_hadir`, `keterangan`, `created_at`, `updated_at`) VALUES
(37, 1, '2026-07-13', '07:30:00', '17:00:00', 'hadir', '', '2026-07-13 11:29:26', '2026-07-14 11:37:38'),
(38, 2, '2026-07-13', '07:30:00', '17:00:00', 'hadir', '', '2026-07-13 11:33:45', '2026-07-14 11:37:54'),
(39, 3, '2026-07-15', '07:30:00', '17:00:00', 'hadir', '', '2026-07-14 23:32:26', '2026-07-14 23:35:19'),
(40, 4, '2026-07-15', '07:30:00', '17:00:00', 'hadir', '', '2026-07-14 23:37:17', '2026-07-14 23:37:17'),
(41, 5, '2026-07-15', '07:30:00', '17:00:00', 'hadir', '', '2026-07-14 23:37:54', '2026-07-14 23:37:54'),
(42, 6, '2026-07-15', '07:30:00', '17:00:00', 'hadir', '', '2026-07-14 23:38:30', '2026-07-14 23:38:30'),
(43, 7, '2026-07-15', '07:30:00', '17:00:00', 'hadir', '', '2026-07-14 23:39:20', '2026-07-14 23:39:20'),
(44, 8, '2026-07-15', '07:30:00', '17:00:00', 'hadir', '', '2026-07-14 23:39:59', '2026-07-14 23:39:59'),
(45, 9, '2026-07-15', '07:30:00', '17:00:00', 'hadir', '', '2026-07-14 23:40:31', '2026-07-14 23:40:31'),
(46, 10, '2026-07-15', '07:30:00', '17:00:00', 'hadir', '', '2026-07-14 23:40:58', '2026-07-14 23:40:58'),
(47, 3, '2026-07-14', '08:01:00', '17:00:00', 'hadir', '', '2026-07-14 23:42:01', '2026-07-14 23:51:41'),
(48, 3, '2026-07-22', '08:00:00', '17:00:00', 'hadir', '', '2026-07-22 05:45:39', '2026-07-22 05:45:39'),
(49, 3, '2026-07-01', '08:00:00', '17:00:00', 'hadir', '', '2026-07-22 05:49:07', '2026-07-22 05:49:07'),
(50, 3, '2026-07-02', '07:30:00', '17:00:00', 'hadir', '', '2026-07-22 05:49:41', '2026-07-22 05:49:41'),
(51, 3, '2026-07-03', '00:00:00', '00:00:00', 'sakit', '', '2026-07-22 05:50:28', '2026-07-22 05:50:28'),
(52, 3, '2026-07-06', '07:45:00', '17:00:00', 'hadir', '', '2026-07-22 05:50:57', '2026-07-22 05:50:57');

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id` int(11) NOT NULL,
  `nama_departemen` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id`, `nama_departemen`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Manajemen', 'Departemen Manajemen Perusahaan', '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(2, 'IT', 'Departemen Teknologi Informasi', '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(3, 'Keuangan', 'Departemen Keuangan', '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(4, 'HRD', 'Departemen Sumber Daya Manusia', '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(5, 'Marketing', 'Departemen Pemasaran', '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(6, 'Produksi', 'Departemen Produksi', '2026-07-13 11:15:28', '2026-07-13 11:15:28');

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `periode` varchar(7) NOT NULL,
  `tanggal_gaji` date DEFAULT NULL,
  `gaji_pokok` decimal(12,2) NOT NULL DEFAULT 0.00,
  `tunjangan_jabatan` decimal(12,2) DEFAULT 0.00,
  `tunjangan_makan` decimal(12,2) DEFAULT 0.00,
  `tunjangan_transport` decimal(12,2) DEFAULT 0.00,
  `tunjangan_lain` decimal(12,2) DEFAULT 0.00,
  `potongan_absen` decimal(12,2) DEFAULT 0.00,
  `potongan_keterlambatan` decimal(12,2) DEFAULT 0.00,
  `potongan_lain` decimal(12,2) DEFAULT 0.00,
  `potongan_pph` decimal(12,2) DEFAULT 0.00,
  `total_gaji` decimal(12,2) NOT NULL DEFAULT 0.00,
  `metode_pembayaran` enum('transfer','tunai','cek') DEFAULT 'transfer',
  `status` enum('belum_dibayar','dibayar') DEFAULT 'belum_dibayar',
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`id`, `id_karyawan`, `periode`, `tanggal_gaji`, `gaji_pokok`, `tunjangan_jabatan`, `tunjangan_makan`, `tunjangan_transport`, `tunjangan_lain`, `potongan_absen`, `potongan_keterlambatan`, `potongan_lain`, `potongan_pph`, `total_gaji`, `metode_pembayaran`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(15, 3, '2026-07', '2026-07-25', 8000000.00, 1500000.00, 50000.00, 50000.00, 0.00, 0.00, 0.00, 0.00, 480000.00, 9120000.00, 'transfer', 'dibayar', '', '2026-07-23 06:38:24', '2026-07-23 07:07:40');

-- --------------------------------------------------------

--
-- Table structure for table `history_gaji`
--

CREATE TABLE `history_gaji` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_gaji` int(11) DEFAULT NULL,
  `perubahan` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `id_departemen` int(11) DEFAULT NULL,
  `gaji_pokok` decimal(12,2) NOT NULL DEFAULT 0.00,
  `tunjangan_jabatan` decimal(12,2) DEFAULT 0.00,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`, `id_departemen`, `gaji_pokok`, `tunjangan_jabatan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Direktur Utama', 1, 20000000.00, 5000000.00, '', '2026-07-13 11:15:28', '2026-07-14 23:30:50'),
(2, 'Manager IT', 2, 15000000.00, 3000000.00, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(3, 'Staf IT', 2, 8000000.00, 1500000.00, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(4, 'Manager Keuangan', 3, 14000000.00, 2500000.00, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(5, 'Staf Keuangan', 3, 7000000.00, 1200000.00, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(6, 'Manager HRD', 4, 13000000.00, 2500000.00, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(7, 'Staf HRD', 4, 6500000.00, 1000000.00, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(8, 'Manager Marketing', 5, 13000000.00, 2500000.00, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(9, 'Staf Marketing', 5, 6500000.00, 1000000.00, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(10, 'Manager Produksi', 6, 14000000.00, 2800000.00, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(11, 'Operator Produksi', 6, 5500000.00, 800000.00, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_departemen` int(11) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `status_kerja` enum('aktif','cuti','resign','mutasi') DEFAULT 'aktif',
  `npwp` varchar(20) DEFAULT NULL,
  `no_rekening` varchar(50) DEFAULT NULL,
  `nama_bank` varchar(50) DEFAULT NULL,
  `status_pernikahan` enum('belum_menikah','menikah','cerai') DEFAULT 'belum_menikah',
  `jumlah_tanggungan` int(11) DEFAULT 0,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nip`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `alamat`, `no_telepon`, `email`, `id_departemen`, `id_jabatan`, `tanggal_masuk`, `status_kerja`, `npwp`, `no_rekening`, `nama_bank`, `status_pernikahan`, `jumlah_tanggungan`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'EMP-001', 'Budi Santoso', 'Jakarta', '1985-03-15', 'Laki-laki', 'Islam', 'Jl. Merdeka No. 10, Jakarta', '081234567890', 'budi@company.com', 1, 1, '2020-01-15', 'aktif', NULL, NULL, NULL, 'menikah', 2, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(2, 'EMP-002', 'Dewi Lestari', 'Bandung', '1990-07-22', 'Perempuan', 'Islam', 'Jl. Asia Afrika No. 25, Bandung', '081234567891', 'dewi@company.com', 2, 2, '2021-03-01', 'aktif', NULL, NULL, NULL, 'menikah', 1, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(3, 'EMP-003', 'Andi Wijaya', 'Surabaya', '1992-11-10', 'Laki-laki', 'Kristen', 'Jl. Raya Darmo No. 5, Surabaya', '081234567892', 'andi@company.com', 2, 3, '2022-06-15', 'aktif', NULL, NULL, NULL, 'belum_menikah', 0, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(4, 'EMP-004', 'Siti Rahayu', 'Yogyakarta', '1988-05-20', 'Perempuan', 'Islam', 'Jl. Malioboro No. 12, Yogyakarta', '081234567893', 'siti@company.com', 3, 4, '2020-08-01', 'aktif', NULL, NULL, NULL, 'menikah', 3, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(5, 'EMP-005', 'Rudi Hartono', 'Semarang', '1995-01-08', 'Laki-laki', 'Islam', 'Jl. Pandanaran No. 8, Semarang', '081234567894', 'rudi@company.com', 3, 5, '2023-01-10', 'aktif', NULL, NULL, NULL, 'belum_menikah', 0, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(6, 'EMP-006', 'Maria Gunawan', 'Medan', '1991-09-14', 'Perempuan', 'Katolik', 'Jl. Sisingamangaraja No. 15, Medan', '081234567895', 'maria@company.com', 4, 6, '2021-04-20', 'aktif', NULL, NULL, NULL, 'menikah', 2, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(7, 'EMP-007', 'Fajar Nugroho', 'Malang', '1993-12-03', 'Laki-laki', 'Islam', 'Jl. Ijen No. 20, Malang', '081234567896', 'fajar@company.com', 4, 7, '2022-09-01', 'aktif', NULL, NULL, NULL, 'menikah', 1, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(8, 'EMP-008', 'Rina Wati', 'Bali', '1994-04-18', 'Perempuan', 'Hindu', 'Jl. Sunset Road No. 30, Bali', '081234567897', 'rina@company.com', 5, 8, '2021-11-15', 'aktif', NULL, NULL, NULL, 'belum_menikah', 0, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(9, 'EMP-009', 'Eko Prasetyo', 'Solo', '1989-08-25', 'Laki-laki', 'Islam', 'Jl. Slamet Riyadi No. 7, Solo', '081234567898', 'eko@company.com', 5, 9, '2022-02-01', 'aktif', NULL, NULL, NULL, 'menikah', 2, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(10, 'EMP-010', 'Hendra Kurniawan', 'Bekasi', '1996-06-30', 'Laki-laki', 'Islam', 'Jl. Ahmad Yani No. 45, Bekasi', '081234567899', 'hendra@company.com', 6, 10, '2023-05-01', 'aktif', NULL, NULL, NULL, 'belum_menikah', 0, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28');

-- --------------------------------------------------------

--
-- Table structure for table `konfigurasi_potongan`
--

CREATE TABLE `konfigurasi_potongan` (
  `id` int(11) NOT NULL,
  `nama_potongan` varchar(100) NOT NULL,
  `jenis` enum('tetap','persen') NOT NULL,
  `nilai` decimal(12,2) DEFAULT 0.00,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konfigurasi_potongan`
--

INSERT INTO `konfigurasi_potongan` (`id`, `nama_potongan`, `jenis`, `nilai`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Potongan Telat', 'tetap', 50000.00, 'Potongan Rp 50.000 per keterlambatan', '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(2, 'Potongan Alfa', 'tetap', 100000.00, 'Potongan Rp 100.000 per hari alfa', '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(3, 'Potongan BPJS Kesehatan', 'persen', 1.00, 'Potongan BPJS Kesehatan 1%', '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(4, 'Potongan BPJS Ketenagakerjaan', 'persen', 2.00, 'Potongan BPJS Ketenagakerjaan 2%', '2026-07-13 11:15:28', '2026-07-13 11:15:28');

-- --------------------------------------------------------

--
-- Table structure for table `lembur`
--

CREATE TABLE `lembur` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `durasi_jam` decimal(5,2) DEFAULT 0.00,
  `upah_lembur` decimal(12,2) DEFAULT 0.00,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lembur`
--

INSERT INTO `lembur` (`id`, `id_karyawan`, `tanggal`, `jam_mulai`, `jam_selesai`, `durasi_jam`, `upah_lembur`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 3, '2025-07-01', '17:00:00', '19:00:00', 2.00, 200000.00, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(2, 3, '2025-07-03', '17:00:00', '18:30:00', 1.50, 150000.00, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(3, 10, '2025-07-04', '17:00:00', '20:00:00', 3.00, 300000.00, NULL, '2026-07-13 11:15:28', '2026-07-13 11:15:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `role` enum('admin','karyawan') DEFAULT 'karyawan',
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_karyawan`, `username`, `email`, `password`, `nama_lengkap`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'admin', 'admin@payroll.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin', 'aktif', '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(2, 1, 'EMP-001', 'budi@company.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Budi Santoso', 'karyawan', 'aktif', '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(3, 2, 'EMP-002', 'dewi@company.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Dewi Lestari', 'karyawan', 'aktif', '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(4, 3, 'EMP-003', 'andi@company.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Andi Wijaya', 'karyawan', 'aktif', '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(5, 4, 'EMP-004', 'siti@company.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Siti Rahayu', 'karyawan', 'aktif', '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(6, 5, 'EMP-005', 'rudi@company.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Rudi Hartono', 'karyawan', 'aktif', '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(7, 6, 'EMP-006', 'maria@company.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Maria Gunawan', 'karyawan', 'aktif', '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(8, 7, 'EMP-007', 'fajar@company.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Fajar Nugroho', 'karyawan', 'aktif', '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(9, 8, 'EMP-008', 'rina@company.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Rina Wati', 'karyawan', 'aktif', '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(10, 9, 'EMP-009', 'eko@company.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Eko Prasetyo', 'karyawan', 'aktif', '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(11, 10, 'EMP-010', 'hendra@company.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Hendra Kurniawan', 'karyawan', 'aktif', '2026-07-13 11:15:28', '2026-07-13 11:15:28'),
(12, NULL, 'EMP-011', 'irfan@mail.com', '$2y$10$ckpRk3REQDWMOR58h0cl6OOv2LHeEjDyp.bgCJfGhLOZ6NZcybO1y', 'Irfan Rizki', 'karyawan', 'aktif', '2026-07-14 11:14:55', '2026-07-14 11:14:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_absensi` (`id_karyawan`,`tanggal`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_gaji` (`id_karyawan`,`periode`);

--
-- Indexes for table `history_gaji`
--
ALTER TABLE `history_gaji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `id_gaji` (`id_gaji`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_departemen` (`id_departemen`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `id_departemen` (`id_departemen`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `konfigurasi_potongan`
--
ALTER TABLE `konfigurasi_potongan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lembur`
--
ALTER TABLE `lembur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `history_gaji`
--
ALTER TABLE `history_gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `konfigurasi_potongan`
--
ALTER TABLE `konfigurasi_potongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lembur`
--
ALTER TABLE `lembur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `gaji_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `history_gaji`
--
ALTER TABLE `history_gaji`
  ADD CONSTRAINT `history_gaji_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `history_gaji_ibfk_2` FOREIGN KEY (`id_gaji`) REFERENCES `gaji` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD CONSTRAINT `jabatan_ibfk_1` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id_departemen`) REFERENCES `departemen` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `karyawan_ibfk_2` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `lembur`
--
ALTER TABLE `lembur`
  ADD CONSTRAINT `lembur_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
