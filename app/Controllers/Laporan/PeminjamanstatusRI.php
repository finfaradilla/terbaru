<?php

namespace App\Controllers\Laporan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Laporan\PeminjamanstatusRIModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
            // if ($value['tanggal_keluar'] != null) {
            //     $dataPasien = $this->Model->getPasienById($value['id_pasien']);
            //     $dataKamar = $this->Model->getKamarById($value['id_kamar']);
            //     $dataDokter =  $this->Model->getDokterById($value['id_dokter']);
            //     $dataValue[] = [
            //         'no' => $no++,
            //         'no_rm' => $dataPasien['no_rm'],
            //         'nama_pasien' => $dataPasien['nama'],
            //         'alamat' => $dataPasien['alamat'],
            //         'kamar' => $dataKamar['nama'],
            //         'diagnosa' => $value['keluhan'],
            //         'dokter' => $dataDokter['nama'],
            //         'tanggal_masuk' => $value['tanggal_masuk'],
            //         'tanggal_keluar' => $value['tanggal_keluar'],
            //     ];
            // }
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
        };

        if (count($dataValue) <= 0) {
            return redirect()->to('Laporan/PeminjamanstatusRI')->with('validation', [
                'type' => 'danger',
                'pesan' => 'Data Kosong. Kamu Tidak Dapat Merubah Ke Excel'
            ]);
        }

        // Membuat spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menambahkan header kolom Excel
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'No. RM');
        $sheet->setCellValue('C1', 'Nama Pasien');
        $sheet->setCellValue('D1', 'Alamat');
        $sheet->setCellValue('E1', 'Kamar');
        $sheet->setCellValue('F1', 'Diagnosa');
        $sheet->setCellValue('G1', 'Dokter Jaga');
        $sheet->setCellValue('H1', 'Tanggal Masuk');
        $sheet->setCellValue('I1', 'Tanggal Keluar');

        // Loop data dan tambahkan ke Excel
        $rowNumber = 2;
        foreach ($dataValue as $row) {
            $sheet->setCellValue('A' . $rowNumber, $row['no']);
            $sheet->setCellValue('B' . $rowNumber, $row['no_rm']);
            $sheet->setCellValue('C' . $rowNumber, $row['nama_pasien']);
            $sheet->setCellValue('D' . $rowNumber, $row['alamat']);
            $sheet->setCellValue('E' . $rowNumber, $row['kamar']);
            $sheet->setCellValue('F' . $rowNumber, $row['diagnosa']);
            $sheet->setCellValue('G' . $rowNumber, $row['dokter']);
            $sheet->setCellValue('H' . $rowNumber, $row['tanggal_masuk']);
            $sheet->setCellValue('I' . $rowNumber, $row['tanggal_keluar']);
            $rowNumber++;
        }

        // Nama file Excel
        $filename = 'laporan_rawat_inap_' . date('Y-m-d') . '.xlsx';

        // Header untuk file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Tulis file Excel ke output
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
}