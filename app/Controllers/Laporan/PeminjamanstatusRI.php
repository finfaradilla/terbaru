<?php

namespace App\Controllers\Laporan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Laporan\PeminjamanstatusRIModel;

class PeminjamanstatusRI extends BaseController
{

    public function __construct()
    {
        $this->session = session();
        $this->Model = new PeminjamanstatusRIModel();
    }

    public function index()
    {
        $getData = $this->Model->findAll();
        $dataValue = [];
        foreach ($getData as $key => $value) {
            $dataValue[] = [
                'data_laporan' => $value,
                'data_pasien' => $this->Model->getPasienById($value['id_pasien']),
                'data_kamar' => $this->Model->getKamarById($value['id_kamar']),
                'data_dokter' => $this->Model->getDokterById($value['id_dokter']),
            ];
        };
        $data = [
            'title' => 'Laporan Peminjaman Status (RI)',
            'name' => 'peminjaman_status_ri',
            'menu_open_laporan' => true,
            'data' => $dataValue,
        ];
        return view('Dashboard/laporan/peminjaman_status_ri', $data);
    }

    public function exportCSV()
    {
        $getData = $this->Model->findAll();
        $dataValue = [];
        $no = 1;
        foreach ($getData as $key => $value) {
            if ($value['tanggal_keluar'] != null) {
                $dataPasien = $this->Model->getPasienById($value['id_pasien']);
                $dataKamar = $this->Model->getKamarById($value['id_kamar']);
                $dataDokter =  $this->Model->getDokterById($value['id_dokter']);
                $dataValue[] = [
                    'no' => $no++,
                    'no_rm' => $dataPasien['no_rm'],
                    'nama_pasien' => $dataPasien['nama'],
                    'alamat' => $dataPasien['alamat'],
                    'kamar' => $dataKamar['nama'],
                    'diagnosa' => $value['keluhan'],
                    'dokter' => $dataDokter['nama'],
                    'tanggal_masuk' => $value['tanggal_masuk'],
                    'tanggal_keluar' => $value['tanggal_keluar'],
                ];
            }
        };

        if (count($dataValue) <= 0) {
            return redirect()->to('Laporan/PeminjamanstatusRI')->with('validation', [
                'type' => 'danger',
                'pesan' => 'Data Kosong. Kamu Tidak Dapat Merubah KE CSV'
            ]);
        }

        // Nama file CSV
        $filename = 'laporan_rawat_inap_' . date('Y-m-d') . '.csv';

        // Header untuk file CSV
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="' . $filename . '"');

        // Buka file output
        $output = fopen('php://output', 'w');

        // Menambahkan header kolom CSV
        fputcsv($output, array('No', 'No. RM', 'Nama Pasien', 'Alamat', 'Kamar', 'Diagnosa', 'Dokter Jaga', 'Tanggal Masuk', 'Tanggal Keluar')); // sesuaikan dengan kolom tabel Anda

        // Loop data dan tambahkan ke CSV
        foreach ($dataValue as $row) {
            fputcsv($output, $row);
        }

        // Tutup file output
        fclose($output);
        exit();
        return redirect()->to('Laporan/PeminjamanstatusRI')->with('validation', [
            'type' => 'success',
            'pesan' => 'Berhasil Mendownload CSV <strong>'.$filename.'</strong>'
        ]);
    }
}