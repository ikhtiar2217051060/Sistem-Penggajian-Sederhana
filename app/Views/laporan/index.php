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
        .report-card { cursor: pointer; transition: all 0.3s; }
        .report-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0,0,0,0.15); }
        .report-icon { width: 80px; height: 80px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: #fff; margin: 0 auto 15px; }
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
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('penggajian') ?>"><i class="fas fa-wallet"></i> Penggajian</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?= base_url('laporan') ?>"><i class="fas fa-chart-bar"></i> Laporan</a></li>
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
                    <h5 class="fw-bold mb-4">Menu Laporan</h5>
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <a href="<?= base_url('laporan/gaji') ?>" class="text-decoration-none">
                                <div class="card card-custom report-card text-center p-4">
                                    <div class="report-icon bg-gradient-primary">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <h5 class="fw-bold text-dark">Laporan Gaji</h5>
                                    <p class="text-muted">Lihat rekap gaji karyawan per periode dengan rincian pendapatan dan potongan.</p>
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
