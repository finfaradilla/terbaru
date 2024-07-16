<?php

namespace App\Controllers\Laporan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Laporan\PeminjamanStatusRJModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PeminjamanStatusRJ extends BaseController
{

    public function __construct()
    {
        $this->session = session();
        $this->Model = new PeminjamanStatusRJModel();
    }

    public function index()
    {
        $getData = $this->Model->findAll();
        $dataValue = [];
        foreach ($getData as $key => $value) {
            $dataValue[] = [
                'data_laporan' => $value,
                'data_pasien' => $this->Model->getPasienById($value['id_pasien']),
                'data_dokter' => $this->Model->getDokterById($value['id_dokter']),
            ];
        };
        $data = [
            'title' => 'Laporan Peminjaman Status (RJ)',
            'name' => 'peminjaman_status_rj',
            'menu_open_laporan' => true,
            'data' => $dataValue,
        ];
        return view('Dashboard/laporan/peminjaman_status_rj', $data);
    }

    public function sudahKembali($id)
    {
        $getLaporan = $this->Model->find($id);
        if (count($getLaporan) <= 0 ) {
            return redirect()->to('Laporan/PeminjamanStatusRJ')->with('validation', [
                'type' => 'danger',
                'pesan' => 'Data Tidak Ditemukan'
            ]);
        }
        $getDataPasien = $this->Model->getPasienById($getLaporan['id_pasien']);
        if (count($getDataPasien) <= 0 ) {
            return redirect()->to('Laporan/PeminjamanStatusRJ')->with('validation', [
                'type' => 'danger',
                'pesan' => 'Data Pasien Tidak Ditemukan'
            ]);
        }
        $data = [
            'tanggal_kembali' => date("Y-m-d", time()),
            'jam_kembali' => date("H").':'.date("i"),
        ];
        $this->Model->update($id, $data);
        return redirect()->to('Laporan/PeminjamanStatusRJ')->with('validation', [
            'type' => 'success',
            'pesan' => 'Data Pasien <strong>'.$getDataPasien['nama']. '</strong> Berhaisl Di Kembalikan'
        ]);
    }

    // public function exportCSV()
    // {
    //     $getData = $this->Model->findAll();
    //     $dataValue = [];
    //     $no = 1;
    //     foreach ($getData as $key => $value) {
    //         $dataPasien = $this->Model->getPasienById($value['id_pasien']);
    //         $dataDokter = $this->Model->getDokterById($value['id_dokter']);
    //         $dataValue[] = [
    //             'no' => $no++,
    //             'no_rm' => $dataPasien['no_rm'],
    //             'nama_pasien' => $dataPasien['nama'],
    //             'keluhan' => $value['keluhan'],
    //             'poli' => $value['poli'],
    //             'dokter' => $dataDokter['nama'],
    //             'tgl_peminjaman' => $value['tanggal'] . " ". $value['jam'],
    //             'tgl_pengembalian' => ($value['tanggal_kembali'] != null) ? $value['tanggal_kembali'] . " ".$value['jam_kembali']  : '-',
    //         ];
    //     };

    //     if (count($dataValue) <= 0) {
    //         return redirect()->to('Laporan/PeminjamanStatusRJ')->with('validation', [
    //             'type' => 'danger',
    //             'pesan' => 'Data Kosong. Kamu Tidak Dapat Merubah KE CSV'
    //         ]);
    //     }
    //     $filename = 'laporan_rawat_jalan_' . date('Y-m-d') . '.csv';
    //     header('Content-Type: text/csv');
    //     header('Content-Disposition: attachment;filename="' . $filename . '"');
    //     $output = fopen('php://output', 'w');
    //     fputcsv($output, array('No', 'No. RM', 'Nama Pasien', 'Diagnosa', 'Poli', 'Dokter', 'Tanggal Peminjaman', 'Tanggal Pengembalian')); // sesuaikan dengan kolom tabel Anda
    //     foreach ($dataValue as $row) {
    //         fputcsv($output, $row);
    //     }
    //     fclose($output);
    //     exit();
    //     return redirect()->to('Laporan/PeminjamanStatusRJ')->with('validation', [
    //         'type' => 'success',
    //         'pesan' => 'Berhasil Mendownload CSV <strong>'.$filename.'</strong>'
    //     ]);
    // }

    public function exportCSV()
    {
        $getData = $this->Model->findAll();
        $dataValue = [];
        $no = 1;
        foreach ($getData as $key => $value) {
            $dataPasien = $this->Model->getPasienById($value['id_pasien']);
            $dataDokter = $this->Model->getDokterById($value['id_dokter']);
            $dataValue[] = [
                'no' => $no++,
                'no_rm' => $dataPasien['no_rm'],
                'nama_pasien' => $dataPasien['nama'],
                'keluhan' => $value['keluhan'],
                'poli' => $value['poli'],
                'dokter' => $dataDokter['nama'],
                'tgl_peminjaman' => $value['tanggal'] . " ". $value['jam'],
                'tgl_pengembalian' => ($value['tanggal_kembali'] != null) ? $value['tanggal_kembali'] . " ".$value['jam_kembali']  : '-',
            ];
        };

        if (count($dataValue) <= 0) {
            return redirect()->to('Laporan/PeminjamanStatusRJ')->with('validation', [
                'type' => 'danger',
                'pesan' => 'Data Kosong. Kamu Tidak Dapat Merubah KE Excel'
            ]);
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'No. RM');
        $sheet->setCellValue('C1', 'Nama Pasien');
        $sheet->setCellValue('D1', 'Diagnosa');
        $sheet->setCellValue('E1', 'Poli');
        $sheet->setCellValue('F1', 'Dokter');
        $sheet->setCellValue('G1', 'Tanggal Peminjaman');
        $sheet->setCellValue('H1', 'Tanggal Pengembalian');

        $rowNumber = 2;
        foreach ($dataValue as $row) {
            $sheet->setCellValue('A' . $rowNumber, $row['no']);
            $sheet->setCellValue('B' . $rowNumber, $row['no_rm']);
            $sheet->setCellValue('C' . $rowNumber, $row['nama_pasien']);
            $sheet->setCellValue('D' . $rowNumber, $row['keluhan']);
            $sheet->setCellValue('E' . $rowNumber, $row['poli']);
            $sheet->setCellValue('F' . $rowNumber, $row['dokter']);
            $sheet->setCellValue('G' . $rowNumber, $row['tgl_peminjaman']);
            $sheet->setCellValue('H' . $rowNumber, $row['tgl_pengembalian']);
            $rowNumber++;
        }

        $filename = 'laporan_rawat_jalan_' . date('Y-m-d') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }
}