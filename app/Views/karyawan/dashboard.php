<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar { min-height: 100vh; background: linear-gradient(180deg, #1b5e20 0%, #2e7d32 100%); }
        .sidebar .nav-link { color: #e8f5e9; padding: 12px 20px; transition: all 0.3s; border-left: 3px solid transparent; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(255,255,255,0.1); border-left-color: #4caf50; color: #fff; }
        .sidebar .nav-link i { width: 25px; }
        .sidebar .sidebar-brand { color: #fff; font-size: 1.2rem; font-weight: 700; padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .content-wrapper { background: #f8f9fa; min-height: 100vh; }
        .top-navbar { background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.08); padding: 15px 30px; }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
        .stat-card { border-radius: 12px; padding: 20px; color: #fff; position: relative; overflow: hidden; }
        .stat-card .stat-icon { font-size: 2.5rem; opacity: 0.3; position: absolute; right: 15px; top: 15px; }
        .stat-card .stat-value { font-size: 1.8rem; font-weight: 700; }
        .stat-card .stat-label { font-size: 0.9rem; opacity: 0.9; }
        .bg-green { background: linear-gradient(135deg, #1b5e20, #4caf50); }
        .bg-blue { background: linear-gradient(135deg, #0d47a1, #2196f3); }
        .bg-orange { background: linear-gradient(135deg, #e65100, #ff9800); }
        .bg-purple { background: linear-gradient(135deg, #4a148c, #9c27b0); }
        .bg-red { background: linear-gradient(135deg, #b71c1c, #f44336); }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Karyawan -->
            <div class="col-md-2 p-0 sidebar">
                <div class="sidebar-brand"><i class="fas fa-user me-2"></i>Portal Karyawan</div>
                <ul class="nav flex-column mt-2">
                    <li class="nav-item"><a class="nav-link active" href="<?= base_url('karyawan/dashboard') ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('karyawan/gaji') ?>"><i class="fas fa-receipt"></i> Slip Gaji</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('ganti-password') ?>"><i class="fas fa-key"></i> Ganti Password</a></li>
                </ul>
            </div>

            <!-- Content -->
            <div class="col-md-10 content-wrapper">
                <div class="top-navbar d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-secondary"><?= $title ?></h5>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> <?= session('nama_lengkap') ?>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= base_url('ganti-password') ?>"><i class="fas fa-key me-2"></i>Ganti Password</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>

                <div class="p-4">
                    <?php if (session()->getFlashdata('message')): ?>
                        <div class="alert alert-<?= strpos(session()->getFlashdata('message'), 'berhasil') !== false ? 'success' : 'danger' ?> alert-dismissible fade show">
                            <i class="fas fa-<?= strpos(session()->getFlashdata('message'), 'berhasil') !== false ? 'check-circle' : 'exclamation-circle' ?> me-2"></i>
                            <?= session()->getFlashdata('message') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Profil Card -->
                    <div class="card card-custom mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="me-4">
                                    <?php if (!empty($karyawan['foto'])): ?>
                                        <img src="<?= base_url('uploads/foto_karyawan/' . $karyawan['foto']) ?>" class="rounded-circle" width="80" height="80" style="object-fit:cover">
                                    <?php else: ?>
                                        <div class="rounded-circle bg-green d-flex align-items-center justify-content-center" style="width:80px;height:80px;font-size:2rem;color:#fff">
                                            <?= strtoupper(substr($karyawan['nama_lengkap'], 0, 1)) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1"><?= $karyawan['nama_lengkap'] ?></h5>
                                    <p class="text-muted mb-0"><?= $karyawan['nip'] ?> | <?= $karyawan['nama_jabatan'] ?? '-' ?> | <?= $karyawan['nama_departemen'] ?? '-' ?></p>
                                    <span class="badge bg-success mt-1"><?= ucfirst(str_replace('_', ' ', $karyawan['status_kerja'])) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistik -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <div class="stat-card bg-orange">
                                <i class="fas fa-money-bill-wave stat-icon"></i>
                                <div class="stat-label">Gaji Terakhir</div>
                                <div class="stat-value"><?= $gaji_terakhir ? 'Rp ' . number_format($gaji_terakhir['total_gaji'], 0, ',', '.') : '-' ?></div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="stat-card bg-purple">
                                <i class="fas fa-wallet stat-icon"></i>
                                <div class="stat-label">Total Gaji</div>
                                <div class="stat-value"><?= $total_periode_gaji ?> Periode</div>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi -->
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="card card-custom">
                                <div class="card-header bg-white border-0">
                                    <h6 class="mb-0 fw-bold">Informasi</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless table-sm">
                                        <tr><td class="text-muted">Tanggal Masuk</td><td><?= date('d F Y', strtotime($karyawan['tanggal_masuk'])) ?></td></tr>
                                        <tr><td class="text-muted">Status</td><td><?= ucfirst(str_replace('_', ' ', $karyawan['status_kerja'])) ?></td></tr>
                                        <tr><td class="text-muted">Pernikahan</td><td><?= ucfirst(str_replace('_', ' ', $karyawan['status_pernikahan'])) ?></td></tr>
                                        <tr><td class="text-muted">Tanggungan</td><td><?= $karyawan['jumlah_tanggungan'] ?> orang</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <a href="<?= base_url('karyawan/gaji') ?>" class="text-decoration-none">
                                <div class="card card-custom p-3 text-center hover-shadow">
                                    <i class="fas fa-receipt text-primary fs-2 mb-2"></i>
                                    <h6 class="fw-bold">Lihat Slip Gaji</h6>
                                    <small class="text-muted">Lihat & cetak slip gaji Anda</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
