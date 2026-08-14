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
        .profile-header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; padding: 30px; border-radius: 12px; margin-bottom: 20px; }
        .table thead th { background: #2c3e50; color: #fff; font-weight: 600; }
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
                    <div class="profile-header">
                        <div class="row">
                            <div class="col-md-8">
                                <h3 class="fw-bold mb-2"><?= $karyawan['nama_lengkap'] ?></h3>
                                <p class="mb-1"><i class="fas fa-id-card me-2"></i>NIP: <?= $karyawan['nip'] ?></p>
                                <p class="mb-1"><i class="fas fa-building me-2"></i><?= $karyawan['nama_departemen'] ?? '-' ?> - <?= $karyawan['nama_jabatan'] ?? '-' ?></p>
                                <p class="mb-0"><span class="badge bg-light text-dark"><?= ucfirst(str_replace('_', ' ', $karyawan['status_kerja'])) ?></span></p>
                            </div>
                            <div class="col-md-4 text-end">
                                <a href="<?= base_url('karyawan/edit/' . $karyawan['id']) ?>" class="btn btn-light btn-sm me-2"><i class="fas fa-edit me-1"></i>Edit</a>
                                <a href="<?= base_url('karyawan') ?>" class="btn btn-light btn-sm"><i class="fas fa-arrow-left me-1"></i>Kembali</a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-custom">
                                <div class="card-header bg-white border-0"><h6 class="mb-0 fw-bold">Informasi Pribadi</h6></div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr><td class="text-muted" style="width:150px">Tempat Lahir</td><td>: <?= $karyawan['tempat_lahir'] ?? '-' ?></td></tr>
                                        <tr><td class="text-muted">Tanggal Lahir</td><td>: <?= date('d F Y', strtotime($karyawan['tanggal_lahir'])) ?? '-' ?></td></tr>
                                        <tr><td class="text-muted">Jenis Kelamin</td><td>: <?= $karyawan['jenis_kelamin'] ?></td></tr>
                                        <tr><td class="text-muted">Agama</td><td>: <?= $karyawan['agama'] ?? '-' ?></td></tr>
                                        <tr><td class="text-muted">Alamat</td><td>: <?= $karyawan['alamat'] ?? '-' ?></td></tr>
                                        <tr><td class="text-muted">No Telepon</td><td>: <?= $karyawan['no_telepon'] ?? '-' ?></td></tr>
                                        <tr><td class="text-muted">Email</td><td>: <?= $karyawan['email'] ?? '-' ?></td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-custom">
                                <div class="card-header bg-white border-0"><h6 class="mb-0 fw-bold">Informasi Pekerjaan</h6></div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr><td class="text-muted" style="width:150px">Departemen</td><td>: <?= $karyawan['nama_departemen'] ?? '-' ?></td></tr>
                                        <tr><td class="text-muted">Jabatan</td><td>: <?= $karyawan['nama_jabatan'] ?? '-' ?></td></tr>
                                        <tr><td class="text-muted">Gaji Pokok</td><td>: Rp <?= number_format($karyawan['gaji_pokok'] ?? 0, 0, ',', '.') ?></td></tr>
                                        <tr><td class="text-muted">Tunjangan Jabatan</td><td>: Rp <?= number_format($karyawan['tunjangan_jabatan'] ?? 0, 0, ',', '.') ?></td></tr>
                                        <tr><td class="text-muted">Tanggal Masuk</td><td>: <?= date('d F Y', strtotime($karyawan['tanggal_masuk'])) ?? '-' ?></td></tr>
                                        <tr><td class="text-muted">NPWP</td><td>: <?= $karyawan['npwp'] ?? '-' ?></td></tr>
                                        <tr><td class="text-muted">Rekening Bank</td><td>: <?= $karyawan['nama_bank'] ?? '-' ?> (<?= $karyawan['no_rekening'] ?? '-' ?>)</td></tr>
                                        <tr><td class="text-muted">Status Pernikahan</td><td>: <?= ucfirst(str_replace('_', ' ', $karyawan['status_pernikahan'])) ?></td></tr>
                                        <tr><td class="text-muted">Jumlah Tanggungan</td><td>: <?= $karyawan['jumlah_tanggungan'] ?? 0 ?> orang</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[data-table-search]').forEach(function (input) {
                input.addEventListener('input', function () {
                    var table = document.querySelector(this.dataset.tableSearch);
                    if (!table) return;
                    var query = this.value.trim().toLowerCase();
                    var rows = table.tBodies.length ? table.tBodies[0].rows : table.rows;
                    Array.from(rows).forEach(function (row) {
                        row.style.display = !query || row.textContent.toLowerCase().indexOf(query) !== -1 ? '' : 'none';
                    });
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
