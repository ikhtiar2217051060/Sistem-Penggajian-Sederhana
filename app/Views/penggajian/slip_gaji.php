<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji - <?= $gaji['nama_lengkap'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @page {
            size: A4 portrait;
            margin: 8mm;
        }

        @media print {
            html, body {
                width: 100% !important;
                height: auto !important;
                margin: 0 !important;
                padding: 0 !important;
                background: #fff !important;
                font-size: 11px !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .no-print {
                display: none !important;
            }
            .slip-container {
                box-shadow: none !important;
                border: 1.5px solid #2c3e50 !important;
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                border-radius: 6px !important;
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }
            .slip-header {
                padding: 12px 15px !important;
                background: #2c3e50 !important;
                color: #fff !important;
            }
            .slip-header h2 {
                font-size: 1.25rem !important;
                margin: 0 !important;
            }
            .slip-header p {
                font-size: 0.8rem !important;
                margin: 2px 0 0 !important;
            }
            .slip-body {
                padding: 12px 15px !important;
            }
            .employee-info-row {
                margin-bottom: 8px !important;
            }
            .table-sm td, .table-sm th {
                padding: 2px 4px !important;
                font-size: 0.8rem !important;
            }
            .slip-table {
                margin: 6px 0 !important;
            }
            .slip-table th, .slip-table td {
                padding: 4px 8px !important;
                font-size: 0.8rem !important;
            }
            .slip-total {
                font-size: 0.92rem !important;
            }
            .slip-footer {
                padding: 6px !important;
                margin-top: 6px !important;
                font-size: 0.75rem !important;
            }
        }

        .slip-container {
            max-width: 750px;
            margin: 20px auto;
            background: #fff;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .slip-header {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: #fff;
            padding: 18px 24px;
            text-align: center;
        }
        .slip-header h2 { margin: 0; font-weight: 700; font-size: 1.5rem; }
        .slip-header p { margin: 3px 0 0; opacity: 0.9; font-size: 0.85rem; }
        .slip-body { padding: 18px 24px; }
        .slip-table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        .slip-table th, .slip-table td { padding: 5px 10px; border: 1px solid #dee2e6; font-size: 0.88rem; }
        .slip-table th { background: #2c3e50; color: #fff; font-weight: 600; }
        .slip-table .sub-header { background: #f8f9fa; font-weight: 600; }
        .slip-total { font-size: 1rem; font-weight: 700; }
        .slip-footer { text-align: center; padding: 10px; border-top: 2px dashed #dee2e6; color: #666; font-size: 0.8rem; margin-top: 8px; }
    </style>
</head>
<body>
    <div class="no-print text-center my-3">
        <button class="btn btn-primary" onclick="window.print()"><i class="fas fa-print me-2"></i>Cetak Slip Gaji</button>
    </div>

    <div class="slip-container">
        <div class="slip-header">
            <h2><i class="fas fa-money-bill-wave me-2"></i>SLIP GAJI</h2>
            <p>PT. Payroll System Indonesia</p>
            <p>Periode: <?= date('F Y', strtotime($gaji['periode'] . '-01')) ?></p>
        </div>

        <div class="slip-body">
            <div class="row employee-info-row mb-3">
                <div class="col-6">
                    <table class="table table-borderless table-sm mb-0">
                        <tr><td class="text-muted" style="width:120px">Nama</td><td>: <strong><?= $gaji['nama_lengkap'] ?></strong></td></tr>
                        <tr><td class="text-muted">NIP</td><td>: <?= $gaji['nip'] ?></td></tr>
                        <tr><td class="text-muted">Departemen</td><td>: <?= $gaji['nama_departemen'] ?? '-' ?></td></tr>
                        <tr><td class="text-muted">Jabatan</td><td>: <?= $gaji['nama_jabatan'] ?? '-' ?></td></tr>
                    </table>
                </div>
                <div class="col-6">
                    <table class="table table-borderless table-sm mb-0">
                        <tr><td class="text-muted" style="width:130px">Tanggal Gaji</td><td>: <?= date('d F Y', strtotime($gaji['tanggal_gaji'])) ?></td></tr>
                        <tr><td class="text-muted">Status Pernikahan</td><td>: <?= ucfirst(str_replace('_', ' ', $gaji['status_pernikahan'])) ?></td></tr>
                        <tr><td class="text-muted">Jumlah Tanggungan</td><td>: <?= $gaji['jumlah_tanggungan'] ?> orang</td></tr>
                        <tr><td class="text-muted">Metode Bayar</td><td>: <?= ucfirst(str_replace('_', ' ', $gaji['metode_pembayaran'])) ?></td></tr>
                    </table>
                </div>
            </div>

            <table class="slip-table">
                <thead><tr><th colspan="2">RINCIAN GAJI</th></tr></thead>
                <tbody>
                    <tr class="sub-header"><td colspan="2">PENDAPATAN</td></tr>
                    <tr><td>Gaji Pokok</td><td class="text-end">Rp <?= number_format($gaji['gaji_pokok'], 0, ',', '.') ?></td></tr>
                    <tr><td>Tunjangan Jabatan</td><td class="text-end">Rp <?= number_format($gaji['tunjangan_jabatan'], 0, ',', '.') ?></td></tr>
                    <tr><td>Tunjangan Makan</td><td class="text-end">Rp <?= number_format($gaji['tunjangan_makan'], 0, ',', '.') ?></td></tr>
                    <tr><td>Tunjangan Transport</td><td class="text-end">Rp <?= number_format($gaji['tunjangan_transport'], 0, ',', '.') ?></td></tr>
                    <tr><td>Tunjangan Lain</td><td class="text-end">Rp <?= number_format($gaji['tunjangan_lain'], 0, ',', '.') ?></td></tr>
                    <?php $total_pendapatan = $gaji['gaji_pokok'] + $gaji['tunjangan_jabatan'] + $gaji['tunjangan_makan'] + $gaji['tunjangan_transport'] + $gaji['tunjangan_lain']; ?>
                    <tr class="fw-bold"><td>Total Pendapatan</td><td class="text-end">Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></td></tr>

                    <tr class="sub-header"><td colspan="2">POTONGAN</td></tr>
                    <tr><td>Potongan Absen (Alfa)</td><td class="text-end text-danger">Rp <?= number_format($gaji['potongan_absen'], 0, ',', '.') ?></td></tr>
                    <tr><td>Potongan Keterlambatan</td><td class="text-end text-danger">Rp <?= number_format($gaji['potongan_keterlambatan'], 0, ',', '.') ?></td></tr>
                    <tr><td>Potongan Lain</td><td class="text-end text-danger">Rp <?= number_format($gaji['potongan_lain'], 0, ',', '.') ?></td></tr>
                    <tr><td>Potongan PPH</td><td class="text-end text-danger">Rp <?= number_format($gaji['potongan_pph'], 0, ',', '.') ?></td></tr>
                    <?php $total_potongan = $gaji['potongan_absen'] + $gaji['potongan_keterlambatan'] + $gaji['potongan_lain'] + $gaji['potongan_pph']; ?>
                    <tr class="fw-bold"><td>Total Potongan</td><td class="text-end text-danger">Rp <?= number_format($total_potongan, 0, ',', '.') ?></td></tr>

                    <tr class="slip-total"><td>TOTAL GAJI DITERIMA (TAKE HOME PAY)</td><td class="text-end text-success">Rp <?= number_format($gaji['total_gaji'], 0, ',', '.') ?></td></tr>
                </tbody>
            </table>

            <div class="slip-footer">
                <p class="mb-1">Slip gaji ini diterbitkan secara otomatis oleh sistem</p>
                <p class="mb-0"><small>Dicetak pada: <?= date('d F Y H:i') ?></small></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
