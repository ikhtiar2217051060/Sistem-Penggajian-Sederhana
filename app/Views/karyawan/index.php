<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <style>
        .sidebar { min-height: 100vh; background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%); }
        .sidebar .nav-link { color: #ecf0f1; padding: 12px 20px; transition: all 0.3s; border-left: 3px solid transparent; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(255,255,255,0.1); border-left-color: #3498db; color: #fff; }
        .sidebar .nav-link i { width: 25px; }
        .sidebar .sidebar-brand { color: #fff; font-size: 1.2rem; font-weight: 700; padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .content-wrapper { background: #f8f9fa; min-height: 100vh; }
        .top-navbar { background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.08); padding: 15px 30px; }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
        .table thead th { background: #2c3e50; color: #fff; font-weight: 600; }
        .badge-status-aktif { background: #27ae60; }
        .badge-status-cuti { background: #f39c12; }
        .badge-status-resign { background: #e74c3c; }
        .badge-status-mutasi { background: #3498db; }
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
                        <div class="alert alert-success alert-dismissible fade show"><i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('message') ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
                    <?php endif; ?>
                    <div class="card card-custom">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0 fw-bold">Daftar Karyawan</h6>
                            <div class="d-flex align-items-center gap-2">
                                <div class="input-group input-group-sm w-auto">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    <input type="search" class="form-control" placeholder="Cari..." data-table-search="#tableKaryawan">
                                </div>
                                <a href="<?= base_url('karyawan/create') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus me-1"></i>Tambah Karyawan</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="tableKaryawan">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NIP</th>
                                            <th>Nama Lengkap</th>
                                            <th>Departemen</th>
                                            <th>Jabatan</th>
                                            <th>Status</th>
                                            <th>Akun</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($karyawan as $key => $row): ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $row['nip'] ?></td>
                                            <td><?= $row['nama_lengkap'] ?></td>
                                            <td><?= $row['nama_departemen'] ?? '-' ?></td>
                                            <td><?= $row['nama_jabatan'] ?? '-' ?></td>
                                            <td><span class="badge badge-status-<?= $row['status_kerja'] ?>"><?= ucfirst(str_replace('_', ' ', $row['status_kerja'])) ?></span></td>
                                            <td><?= $row['has_account'] ? '<span class="badge bg-success">Ada</span>' : '<span class="badge bg-warning">Belum</span>' ?></td>
                                            <td>
                                                <a href="<?= base_url('karyawan/detail/' . $row['id']) ?>" class="btn btn-sm btn-info btn-action" title="Detail"><i class="fas fa-eye"></i></a>
                                                <a href="<?= base_url('karyawan/akun/' . $row['id']) ?>" class="btn btn-sm btn-success btn-action" title="<?= $row['has_account'] ? 'Update Akun' : 'Buat Akun' ?>"><i class="fas fa-user-plus"></i></a>
                                                <a href="<?= base_url('karyawan/edit/' . $row['id']) ?>" class="btn btn-sm btn-warning btn-action" title="Edit"><i class="fas fa-edit"></i></a>
                                                <a href="<?= base_url('karyawan/delete/' . $row['id']) ?>" class="btn btn-sm btn-danger btn-action" title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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
