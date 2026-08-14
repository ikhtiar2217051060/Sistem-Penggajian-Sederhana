<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar { min-height: 100vh; background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%); }
        .sidebar .nav-link { color: #ecf0f1; padding: 12px 20px; transition: all 0.3s; border-left: 3px solid transparent; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(255,255,255,0.1); border-left-color: #3498db; color: #fff; }
        .sidebar .nav-link i { width: 25px; }
        .sidebar .sidebar-brand { color: #fff; font-size: 1.2rem; font-weight: 700; padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .content-wrapper { background: #f8f9fa; min-height: 100vh; }
        .top-navbar { background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.08); padding: 15px 30px; }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 p-0 sidebar">
                <div class="sidebar-brand"><i class="fas fa-money-bill-wave me-2"></i>Payroll System</div>
                <ul class="nav flex-column mt-2">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('dashboard') ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('karyawan') ?>"><i class="fas fa-users"></i> Data Karyawan</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('departemen') ?>"><i class="fas fa-building"></i> Departemen</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('jabatan') ?>"><i class="fas fa-id-badge"></i> Jabatan</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?= base_url('penggajian') ?>"><i class="fas fa-wallet"></i> Penggajian</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('laporan') ?>"><i class="fas fa-chart-bar"></i> Laporan</a></li>
                </ul>
            </div>
            <div class="col-md-10 content-wrapper">
                <div class="top-navbar d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-secondary"><?= $title ?></h5>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> <?= session('nama_lengkap') ?>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="p-4">
                    <div class="card card-custom">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-bold">Detail Penggajian - <?= $gaji['nama_lengkap'] ?> (Periode: <?= date('F Y', strtotime($gaji['periode'] . '-01')) ?>)</h6>
                            <div>
                                <a href="<?= base_url('penggajian/slip/' . $gaji['id']) ?>" class="btn btn-success btn-sm" target="_blank"><i class="fas fa-receipt me-1"></i>Slip Gaji</a>
                                <a href="<?= base_url('penggajian') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i>Kembali</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h6 class="fw-bold text-muted mb-3">INFORMASI KARYAWAN</h6>
                                    <table class="table table-borderless">
                                        <tr><td class="text-muted">Nama</td><td>: <?= $gaji['nama_lengkap'] ?></td></tr>
                                        <tr><td class="text-muted">NIP</td><td>: <?= $gaji['nip'] ?></td></tr>
                                        <tr><td class="text-muted">Departemen</td><td>: <?= $gaji['nama_departemen'] ?? '-' ?></td></tr>
                                        <tr><td class="text-muted">Jabatan</td><td>: <?= $gaji['nama_jabatan'] ?? '-' ?></td></tr>
                                        <tr><td class="text-muted">Periode</td><td>: <?= date('F Y', strtotime($gaji['periode'] . '-01')) ?></td></tr>
                                        <tr><td class="text-muted">Tanggal Gaji</td><td>: <?= date('d F Y', strtotime($gaji['tanggal_gaji'])) ?></td></tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-bold text-muted mb-3">INFORMASI PEMBAYARAN</h6>
                                    <table class="table table-borderless">
                                        <tr><td class="text-muted">Metode</td><td>: <?= ucfirst(str_replace('_', ' ', $gaji['metode_pembayaran'])) ?></td></tr>
                                        <tr><td class="text-muted">Bank</td><td>: <?= $gaji['nama_bank'] ?? '-' ?></td></tr>
                                        <tr><td class="text-muted">No Rekening</td><td>: <?= $gaji['no_rekening'] ?? '-' ?></td></tr>
                                        <tr><td class="text-muted">Status</td><td>: <span class="badge bg-<?= $gaji['status'] == 'dibayar' ? 'success' : 'warning' ?>"><?= ucfirst(str_replace('_', ' ', $gaji['status'])) ?></span></td></tr>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <h6 class="fw-bold text-muted mb-3">RINCIAN GAJI</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead><tr><th>Keterangan</th><th class="text-end">Jumlah</th></tr></thead>
                                    <tbody>
                                        <tr><td colspan="2" class="fw-bold bg-light">PENDAPATAN</td></tr>
                                        <tr><td>Gaji Pokok</td><td class="text-end text-success">Rp <?= number_format($gaji['gaji_pokok'], 0, ',', '.') ?></td></tr>
                                        <tr><td>Tunjangan Jabatan</td><td class="text-end text-success">Rp <?= number_format($gaji['tunjangan_jabatan'], 0, ',', '.') ?></td></tr>
                                        <tr><td>Tunjangan Makan</td><td class="text-end text-success">Rp <?= number_format($gaji['tunjangan_makan'], 0, ',', '.') ?></td></tr>
                                        <tr><td>Tunjangan Transport</td><td class="text-end text-success">Rp <?= number_format($gaji['tunjangan_transport'], 0, ',', '.') ?></td></tr>
                                        <tr><td>Tunjangan Lain</td><td class="text-end text-success">Rp <?= number_format($gaji['tunjangan_lain'], 0, ',', '.') ?></td></tr>
                                        <?php 
                                            $total_pendapatan = $gaji['gaji_pokok'] + $gaji['tunjangan_jabatan'] + $gaji['tunjangan_makan'] + $gaji['tunjangan_transport'] + $gaji['tunjangan_lain'];
                                        ?>
                                        <tr class="fw-bold"><td>Total Pendapatan</td><td class="text-end">Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></td></tr>
                                        <tr><td colspan="2" class="fw-bold bg-light">POTONGAN</td></tr>
                                        <tr><td>Potongan Absen (Alfa)</td><td class="text-end text-danger">Rp <?= number_format($gaji['potongan_absen'], 0, ',', '.') ?></td></tr>
                                        <tr><td>Potongan Keterlambatan</td><td class="text-end text-danger">Rp <?= number_format($gaji['potongan_keterlambatan'], 0, ',', '.') ?></td></tr>
                                        <tr><td>Potongan Lain</td><td class="text-end text-danger">Rp <?= number_format($gaji['potongan_lain'], 0, ',', '.') ?></td></tr>
                                        <tr><td>Potongan PPH (5%)</td><td class="text-end text-danger">Rp <?= number_format($gaji['potongan_pph'], 0, ',', '.') ?></td></tr>
                                        <?php 
                                            $total_potongan = $gaji['potongan_absen'] + $gaji['potongan_keterlambatan'] + $gaji['potongan_lain'] + $gaji['potongan_pph'];
                                        ?>
                                        <tr class="fw-bold"><td>Total Potongan</td><td class="text-end text-danger">Rp <?= number_format($total_potongan, 0, ',', '.') ?></td></tr>
                                        <tr class="fw-bold fs-5"><td>TOTAL GAJI DITERIMA</td><td class="text-end fw-bold text-success">Rp <?= number_format($gaji['total_gaji'], 0, ',', '.') ?></td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
