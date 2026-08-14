<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Gaji <?= date('F Y', strtotime($periode . '-01')) ?></title>
    <style>
        /* Modern reset & base styles */
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 15px;
            color: #222;
            background-color: #fff;
        }

        .header {
            text-align: center;
            margin-bottom: 12px;
        }

        .header h2 {
            margin: 0 0 3px 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .header p {
            margin: 0;
            font-size: 12px;
            color: #555;
        }

        .table-report {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin: 10px 0;
        }

        .table-report th,
        .table-report td {
            border: 1px solid #333;
            padding: 5px 6px; /* Dikurangi sedikit agar lebih hemat ruang */
            font-size: 10px;  /* Font diturunkan ke 10px agar pas untuk baris banyak */
            vertical-align: middle;
            word-wrap: break-word;
        }

        .table-report th {
            background: #2c3e50 !important;
            color: #fff !important;
            text-align: center;
            font-weight: bold;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .table-report td:nth-child(4),
        .table-report td:nth-child(5),
        .table-report td:nth-child(6),
        .table-report tfoot td:nth-child(4),
        .table-report tfoot td:nth-child(5),
        .table-report tfoot td:nth-child(6) {
            text-align: right;
        }

        .table-report .total-row {
            font-weight: bold;
            background: #f0f0f0 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .footer-info {
            text-align: right;
            margin-top: 15px;
            font-size: 10px;
            color: #666;
        }

        /* CONFIGURASI KHUSUS CETAK / SIMPAN PDF */
        @page {
            size: A4 portrait; /* atau 'landscape' jika kolom terlalu rapat */
            margin: 10mm;      /* Margin kertas PDF 10mm */
        }

        @media print {
            html, body {
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
            }

            .table-report {
                page-break-inside: avoid; /* Mencegah tabel terpotong terpisah */
            }

            /* Memastikan warna background header & total tetap tercetak di PDF */
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>LAPORAN GAJI</h2>
        <p>Periode: <?= date('F Y', strtotime($periode . '-01')) ?></p>
    </div>

    <table class="table-report">
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 15%;">NIP</th>
                <th style="width: 25%;">Nama</th>
                <th style="width: 18%;">Gaji + Tunjangan</th>
                <th style="width: 17%;">Potongan</th>
                <th style="width: 20%;">Gaji Bersih</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_pendapatan = 0;
            $total_potongan = 0;
            $total_gaji = 0;
            foreach ($gaji_list as $key => $row):
                $pendapatan = $row['gaji_pokok'] + $row['tunjangan_jabatan'] + $row['tunjangan_makan'] + $row['tunjangan_transport'] + $row['tunjangan_lain'];
                $potongan = $row['potongan_absen'] + $row['potongan_keterlambatan'] + $row['potongan_lain'] + $row['potongan_pph'];
                $total_pendapatan += $pendapatan;
                $total_potongan += $potongan;
                $total_gaji += $row['total_gaji'];
            ?>
                <tr>
                    <td style="text-align: center;"><?= $key + 1 ?></td>
                    <td><?= $row['nip'] ?></td>
                    <td><?= $row['nama_lengkap'] ?></td>
                    <td>Rp <?= number_format($pendapatan, 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($potongan, 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($row['total_gaji'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="3" style="text-align:right;">TOTAL</td>
                <td>Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></td>
                <td>Rp <?= number_format($total_potongan, 0, ',', '.') ?></td>
                <td>Rp <?= number_format($total_gaji, 0, ',', '.') ?></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer-info">
        Dicetak pada: <?= date('d F Y H:i') ?>
    </div>
</body>

</html>