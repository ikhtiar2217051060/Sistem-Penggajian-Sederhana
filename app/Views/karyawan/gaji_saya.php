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
        .table thead th { background: #1b5e20; color: #fff; font-weight: 600; }
        .gaji-card { transition: all 0.3s; cursor: pointer; }
        .gaji-card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.15); }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 p-0 sidebar">
                <div class="sidebar-brand"><i class="fas fa-user me-2"></i>Portal Karyawan</div>
                <ul class="nav flex-column mt-2">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('karyawan/dashboard') ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?= base_url('karyawan/gaji') ?>"><i class="fas fa-receipt"></i> Slip Gaji</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('ganti-password') ?>"><i class="fas fa-key"></i> Ganti Password</a></li>
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
                            <li><a class="dropdown-item" href="<?= base_url('ganti-password') ?>"><i class="fas fa-key me-2"></i>Ganti Password</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="p-4">
                    <?php if (session()->getFlashdata('message')): ?>
                        <div class="alert alert-success alert-dismissible fade show"><i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('message') ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
                    <?php endif; ?>

                    <!-- Summary -->
                    <div class="row mb-4">
                        <div class="col-md-4 mb-3">
                            <div class="card card-custom bg-success text-white p-4">
                                <h6 class="opacity-75">Total Gaji Sepanjang Masa</h6>
                                <h3 class="fw-bold">Rp <?= number_format($total_gaji_all, 0, ',', '.') ?></h3>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card card-custom bg-primary text-white p-4">
                                <h6 class="opacity-75">Total Periode Gaji</h6>
                                <h3 class="fw-bold"><?= $total_periode_gaji ?> Periode</h3>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card card-custom bg-warning text-white p-4">
                                <h6 class="opacity-75">Gaji Terakhir</h6>
                                <h3 class="fw-bold"><?= !empty($gaji) ? 'Rp ' . number_format($gaji[0]['total_gaji'], 0, ',', '.') : '-' ?></h3>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Gaji -->
                    <div class="card card-custom">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0 fw-bold">Daftar Slip Gaji</h6>
                            <div class="input-group input-group-sm w-auto">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="search" class="form-control" placeholder="Cari..." data-table-search="#tableSlipGaji">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="tableSlipGaji">
                                    <thead><tr><th>#</th><th>Periode</th><th>Tanggal Gaji</th><th>Total Gaji</th><th>Potongan</th><th>Gaji Bersih</th><th>Status</th><th>Aksi</th></tr></thead>
                                    <tbody>
                                        <?php foreach($gaji as $key => $row): 
                                            $gajiPokok = $row['gaji_pokok'] ?? 0;
                                            $tunjanganJabatan = $row['tunjangan_jabatan'] ?? 0;
                                            $tunjanganMakan = $row['tunjangan_makan'] ?? 0;
                                            $tunjanganTransport = $row['tunjangan_transport'] ?? 0;
                                            $tunjanganLain = $row['tunjangan_lain'] ?? 0;
                                            $totalPendapatan = $gajiPokok + $tunjanganJabatan + $tunjanganMakan + $tunjanganTransport + $tunjanganLain;
                                            $potonganAbsen = $row['potongan_absen'] ?? 0;
                                            $potonganKeterlambatan = $row['potongan_keterlambatan'] ?? 0;
                                            $potonganLainTotal = $row['potongan_lain'] ?? 0;
                                            $potonganPPH = $row['potongan_pph'] ?? 0;
                                            $totalPotongan = $potonganAbsen + $potonganKeterlambatan + $potonganLainTotal + $potonganPPH;
                                        ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td class="fw-bold"><?= date('F Y', strtotime(($row['periode'] ?? '') . '-01')) ?></td>
                                            <td><?= date('d/m/Y', strtotime($row['tanggal_gaji'] ?? '')) ?></td>
                                            <td>Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></td>
                                            <td class="text-danger">Rp <?= number_format($totalPotongan, 0, ',', '.') ?></td>
                                            <td class="fw-bold text-success">Rp <?= number_format($row['total_gaji'] ?? 0, 0, ',', '.') ?></td>
                                            <td><span class="badge bg-<?= ($row['status'] ?? '') == 'dibayar' ? 'success' : 'warning' ?>"><?= ucfirst(str_replace('_', ' ', $row['status'] ?? '')) ?></span></td>
                                            <td>
                                                <a href="<?= base_url('karyawan/gaji/slip/' . ($row['id'] ?? '')) ?>" class="btn btn-sm btn-success" target="_blank"><i class="fas fa-receipt me-1"></i>Slip</a>
                                                <a href="<?= base_url('karyawan/gaji/slip/' . ($row['id'] ?? '')) ?>" class="btn btn-sm btn-outline-secondary" target="_blank"><i class="fas fa-print me-1"></i>Cetak</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php if (empty($gaji)): ?>
                                        <tr><td colspan="9" class="text-center text-muted">Belum ada data gaji</td></tr>
                                        <?php endif; ?>
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
