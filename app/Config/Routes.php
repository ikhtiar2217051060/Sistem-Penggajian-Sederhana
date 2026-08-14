<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Auth Routes
$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::processLogin');
$routes->get('logout', 'Auth::logout');
$routes->get('ganti-password', 'Auth::gantiPassword', ['filter' => 'auth']);
$routes->post('ganti-password', 'Auth::prosesGantiPassword', ['filter' => 'auth']);

// Dashboard
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);

// ============================================
// ADMIN ONLY ROUTES
// ============================================

// Departemen Routes (Admin)
$routes->get('departemen', 'Departemen::index', ['filter' => 'admin']);
$routes->get('departemen/create', 'Departemen::create', ['filter' => 'admin']);
$routes->post('departemen/store', 'Departemen::store', ['filter' => 'admin']);
$routes->get('departemen/edit/(:num)', 'Departemen::edit/$1', ['filter' => 'admin']);
$routes->post('departemen/update/(:num)', 'Departemen::update/$1', ['filter' => 'admin']);
$routes->get('departemen/delete/(:num)', 'Departemen::delete/$1', ['filter' => 'admin']);

// Jabatan Routes (Admin)
$routes->get('jabatan', 'Jabatan::index', ['filter' => 'admin']);
$routes->get('jabatan/create', 'Jabatan::create', ['filter' => 'admin']);
$routes->post('jabatan/store', 'Jabatan::store', ['filter' => 'admin']);
$routes->get('jabatan/edit/(:num)', 'Jabatan::edit/$1', ['filter' => 'admin']);
$routes->post('jabatan/update/(:num)', 'Jabatan::update/$1', ['filter' => 'admin']);
$routes->get('jabatan/delete/(:num)', 'Jabatan::delete/$1', ['filter' => 'admin']);

// Karyawan Routes (Admin)
$routes->get('karyawan', 'Karyawan::index', ['filter' => 'admin']);
$routes->get('karyawan/create', 'Karyawan::create', ['filter' => 'admin']);
$routes->post('karyawan/store', 'Karyawan::store', ['filter' => 'admin']);
$routes->get('karyawan/detail/(:num)', 'Karyawan::detail/$1', ['filter' => 'admin']);
$routes->get('karyawan/edit/(:num)', 'Karyawan::edit/$1', ['filter' => 'admin']);
$routes->post('karyawan/update/(:num)', 'Karyawan::update/$1', ['filter' => 'admin']);
$routes->get('karyawan/delete/(:num)', 'Karyawan::delete/$1', ['filter' => 'admin']);
$routes->get('karyawan/akun/(:num)', 'Karyawan::buatAkun/$1', ['filter' => 'admin']);
$routes->post('karyawan/akun', 'Karyawan::simpanAkun', ['filter' => 'admin']);

// Penggajian Routes (Admin)
$routes->get('penggajian', 'Penggajian::index', ['filter' => 'admin']);
$routes->get('penggajian/create', 'Penggajian::create', ['filter' => 'admin']);
$routes->post('penggajian/store', 'Penggajian::store', ['filter' => 'admin']);
$routes->get('penggajian/detail/(:num)', 'Penggajian::detail/$1', ['filter' => 'admin']);
$routes->get('penggajian/edit/(:num)', 'Penggajian::edit/$1', ['filter' => 'admin']);
$routes->post('penggajian/update/(:num)', 'Penggajian::update/$1', ['filter' => 'admin']);
$routes->get('penggajian/delete/(:num)', 'Penggajian::delete/$1', ['filter' => 'admin']);
$routes->get('penggajian/slip/(:num)', 'Penggajian::slip/$1', ['filter' => 'auth']);
$routes->get('penggajian', 'Penggajian::index', ['filter' => 'admin']);
$routes->get('penggajian/create', 'Penggajian::create', ['filter' => 'admin']);
$routes->post('penggajian/store', 'Penggajian::store', ['filter' => 'admin']);
$routes->get('penggajian/detail/(:num)', 'Penggajian::detail/$1', ['filter' => 'admin']);
$routes->get('penggajian/edit/(:num)', 'Penggajian::edit/$1', ['filter' => 'admin']);
$routes->post('penggajian/update/(:num)', 'Penggajian::update/$1', ['filter' => 'admin']);
$routes->get('penggajian/delete/(:num)', 'Penggajian::delete/$1', ['filter' => 'admin']);
$routes->get('penggajian/slip/(:num)', 'Penggajian::slip/$1', ['filter' => 'auth']);

// Laporan Routes (Admin)
$routes->get('laporan', 'Laporan::index', ['filter' => 'admin']);
$routes->get('laporan/gaji', 'Laporan::laporanGaji', ['filter' => 'admin']);
$routes->get('laporan/gaji-pdf/(:any)', 'Laporan::gajiPDF/$1', ['filter' => 'admin']);

// ============================================
// KARYAWAN ROUTES (User Karyawan)
// ============================================

// Dashboard Karyawan
$routes->get('karyawan/dashboard', 'KaryawanDashboard::index', ['filter' => 'karyawan']);

// Slip Gaji Karyawan
$routes->get('karyawan/gaji', 'KaryawanGaji::index', ['filter' => 'karyawan']);
$routes->get('karyawan/gaji/slip/(:num)', 'KaryawanGaji::slip/$1', ['filter' => 'karyawan']);
