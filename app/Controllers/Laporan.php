<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GajiModel;
use App\Models\KaryawanModel;

class Laporan extends BaseController
{
    public function index()
    {
        $data = ['title' => 'Laporan'];
        return view('laporan/index', $data);
    }

    public function laporanGaji()
    {
        $gajiModel = new GajiModel();
        $periode = $this->request->getGet('periode') ?? date('Y-m');
        
        $data = [
            'title' => 'Laporan Gaji',
            'periode' => $periode,
            'gaji_list' => $gajiModel->getGajiByPeriode($periode),
            'rekap' => $gajiModel->getRekapGajiPeriode($periode),
        ];
        return view('laporan/gaji', $data);
    }

    public function gajiPDF($periode)
    {
        $gajiModel = new GajiModel();
        $data = [
            'gaji_list' => $gajiModel->getGajiByPeriode($periode),
            'rekap' => $gajiModel->getRekapGajiPeriode($periode),
            'periode' => $periode,
        ];

        $html = view('laporan/gaji_pdf', $data);

        $this->response->setContentType('text/html');
        return $this->response->setBody($html);
    }

}
