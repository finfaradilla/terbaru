<?php

namespace App\Controllers\DataMaster;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DataMaster\MasterDokterModel;

class MasterDokter extends BaseController
{
    protected $Validation;
    protected $Model;
    public function __construct()
    {
        $this->session = session();
        $this->Model = new MasterDokterModel();
        $this->Validation = \Config\Services::validation();
    }

    public function save()
    {
        $kode = $this->request->getVar('kode');
        $nama = $this->request->getVar('nama');
        $tarif = $this->request->getVar('tarif');
        $valid = $this->validate([
            'kode' => [
                'rules' => 'required|min_length[7]|max_length[20]|is_unique[master_dokter.kode]',
                'errors' => [
                    'required' => 'Kode Poli Wajib Diisi.',
                    'min_length' => 'Minimal Mengisikan 7 Karakter.',
                    'max_length' => 'Maksimal Mengisikan 20 Karakter.',
                    'is_unique' => "Kode " . $kode . " Sudah Terdaftar"
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan Wajib Diisi.',
                ]
            ],
            'tarif' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Keterangan Wajib Diisi.',
                    'numeric' => 'Tarif Harus Angka'
                ]
            ],
        ]);

        if(!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->Validation->getErrors());
        }
        $data = [
            'kode' => $kode,
            'nama' => $nama,
            'tarif' => $tarif,
        ];
        $this->Model->save($data);
        $this->session->setFlashdata('validation', [
            'type' => 'success',
            'pesan' => 'Dokter <strong>'. $nama . '</strong> Berhasil Ditambah'
        ]);
        return redirect()->to('Dashboard/master_dokter')->withInput();
    }

    public function delete()
    {
        $kode = $this->request->getVar('kode');
        $response = $this->Model->where('kode', $kode)->delete();
        $this->session->setFlashdata('validation', [
            'type' => 'warning',
            'pesan' => 'Kode Dokter <strong>'. $kode . '</strong> Berhasil Dihapus'
        ]);
        return true;
    }

    public function edit($id)
    {
        $getData = $this->Model->find($id);
        $data = [
            'title' => 'Edit '. $getData['kode'],
            'name' => 'master_dokter',
            'menu_open' => true,
            'data_dokter' => $getData,
        ];
        return view('Dashboard/data_master/master_dokter_edit', $data);
    }
    public function update()
    {
        $kode = $this->request->getVar('kode');
        $nama = $this->request->getVar('nama');
        $tarif = $this->request->getVar('tarif');
        $valid = $this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Wajib Diisi.',
                ]
            ],
            'tarif' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Tarif Wajib Diisi.',
                    'numeric' => 'Tarif Harus Angka'
                ]
            ],
        ]);
        if(!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->Validation->getErrors());
        }
        $data = [
            'nama' => $nama,
            'tarif' => $tarif,
        ];
        $this->Model->where('kode', $kode)->set($data)->update();
        return redirect()->to('Dashboard/master_dokter')->with('validation', [
            'type' => 'success',
            'pesan' => 'Dokter <strong>'. $kode . '</strong> Berhasil Di Perbarui'
        ]);
    }
}
