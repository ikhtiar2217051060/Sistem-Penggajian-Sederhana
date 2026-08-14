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
                    <li class="nav-item"><a class="nav-link active" href="<?= base_url('karyawan') ?>"><i class="fas fa-users"></i> Data Karyawan</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('departemen') ?>"><i class="fas fa-building"></i> Departemen</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('jabatan') ?>"><i class="fas fa-id-badge"></i> Jabatan</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('penggajian') ?>"><i class="fas fa-wallet"></i> Penggajian</a></li>
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
                    <?php if (session()->getFlashdata('message')): ?>
                        <div class="alert alert-danger alert-dismissible fade show"><i class="fas fa-exclamation-circle me-2"></i><?= session()->getFlashdata('message') ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
                    <?php endif; ?>
                    <div class="card card-custom">
                        <div class="card-header bg-white border-0">
                            <h6 class="mb-0 fw-bold">
                                <?= $existing_user ? 'Update Akun Karyawan' : 'Buat Akun Karyawan Baru' ?>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h6 class="fw-bold text-muted">INFORMASI KARYAWAN</h6>
                                    <table class="table table-borderless">
                                        <tr><td class="text-muted" style="width:120px">Nama</td><td>: <?= $karyawan['nama_lengkap'] ?></td></tr>
                                        <tr><td class="text-muted">NIP</td><td>: <?= $karyawan['nip'] ?></td></tr>
                                        <tr><td class="text-muted">Departemen</td><td>: <?= $karyawan['nama_departemen'] ?? '-' ?></td></tr>
                                        <tr><td class="text-muted">Jabatan</td><td>: <?= $karyawan['nama_jabatan'] ?? '-' ?></td></tr>
                                    </table>
                                </div>
                                <?php if ($existing_user): ?>
                                <div class="col-md-6">
                                    <h6 class="fw-bold text-muted">AKUN EKSISTING</h6>
                                    <table class="table table-borderless">
                                        <tr><td class="text-muted" style="width:120px">Username</td><td>: <?= $existing_user['username'] ?></td></tr>
                                        <tr><td class="text-muted">Email</td><td>: <?= $existing_user['email'] ?></td></tr>
                                        <tr><td class="text-muted">Role</td><td>: <span class="badge bg-primary"><?= ucfirst($existing_user['role']) ?></span></td></tr>
                                        <tr><td class="text-muted">Status</td><td>: <span class="badge bg-success"><?= ucfirst($existing_user['status']) ?></span></td></tr>
                                    </table>
                                </div>
                                <?php endif; ?>
                            </div>
                            <hr>
                            <form action="<?= base_url('karyawan/akun') ?>" method="post">
                                <input type="hidden" name="id_karyawan" value="<?= $karyawan['id'] ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Username</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                <input type="text" class="form-control" name="username" value="<?= $existing_user['username'] ?? $karyawan['nip'] ?>" placeholder="Masukkan username" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                <input type="email" class="form-control" name="email" value="<?= $existing_user['email'] ?? $karyawan['email'] ?>" placeholder="Masukkan email" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                <input type="password" class="form-control" name="password" placeholder="Masukkan password (min 6 karakter)" required>
                                            </div>
                                            <small class="text-muted">Minimal 6 karakter. Default password untuk karyawan baru: password</small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Role</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
                                                <select class="form-control" name="role" required>
                                                    <option value="karyawan" selected>Karyawan</option>
                                                    <option value="admin">Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Catatan:</strong> Akun karyawan dapat login dan mengakses portal karyawan untuk melihat slip gaji saja.
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="<?= base_url('karyawan') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i>Kembali</a>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i><?= $existing_user ? 'Update' : 'Buat' ?> Akun</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
