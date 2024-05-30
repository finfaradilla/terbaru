<?php

namespace App\Controllers\DataMaster;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DataMaster\MasterKamarModel;

class MasterKamar extends BaseController
{
    protected $Validation;
    protected $Model;
    public function __construct()
    {
        $this->session = session();
        $this->Model = new MasterKamarModel();
        $this->Validation = \Config\Services::validation();
    }

    public function save()
    {
        $kode = $this->request->getVar('kode');
        $valid = $this->validate([
            'kode' => [
                'rules' => 'required|min_length[5]|max_length[20]|is_unique[master_kamar.kode]',
                'errors' => [
                    'required' => 'Kode Kamar Wajib Diisi.',
                    'min_length' => 'Kode Kamar Minimal Mengisikan 5 Karakter.',
                    'max_length' => 'Kode Kamar Maksimal Mengisikan 20 Karakter.',
                    'is_unique' => "Kode Kamar " . $kode . " Sudah Terdaftar"
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Kamar Wajib Diisi.',
                ]
            ],
            'kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelas Kamar Wajib Diisi.',
                ]
            ],
            'tarif' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Tarif Kamar Wajib Diisi.',
                    'numeric' => 'Tarif Kamar Harus Angka.',
                ]
            ],
        ]);

        if(!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->Validation->getErrors());
        }
        $data = [
            'kode' => $kode,
            'nama' => $this->request->getVar('nama'),
            'kelas' => $this->request->getVar('kelas'),
            'tarif' => $this->request->getVar('tarif'),
        ];
        $this->Model->save($data);
        $this->session->setFlashdata('validation', [
            'type' => 'success',
            'pesan' => 'Kode Kamar <strong>'. $kode . '</strong> Berhasil Ditambah'
        ]);
        return redirect()->to('Dashboard/master_kamar')->withInput();
    }

    public function delete()
    {
        $kode = $this->request->getVar('kode');
        $response = $this->Model->where('kode', $kode)->delete();
        $this->session->setFlashdata('validation', [
            'type' => 'warning',
            'pesan' => 'Kode Kamar <strong>'. $kode . '</strong> Berhasil Dihapus'
        ]);
        return true;
    }

    public function edit($id)
    {
        $getData = $this->Model->find($id);
        $data = [
            'title' => 'Edit '. $getData['kode'],
            'name' => 'master_kamar',
            'menu_open' => true,
            'data_kamar' => $getData,
        ];
        return view('Dashboard/data_master/master_kamar_edit', $data);
    }

    public function update()
    {
        $kode = $this->request->getVar('kode');
        $valid = $this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Kamar Wajib Diisi.',
                ]
            ],
            'kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelas Kamar Wajib Diisi.',
                ]
            ],
            'tarif' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Tarif Kamar Wajib Diisi.',
                    'numeric' => 'Tarif Kamar Harus Angka.',
                ]
            ],
        ]);
        if(!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->Validation->getErrors());
        }
        $data = [
            'kode' => $kode,
            'nama' => $this->request->getVar('nama'),
            'kelas' => $this->request->getVar('kelas'),
            'tarif' => $this->request->getVar('tarif'),
        ];
        $this->Model->where('kode', $kode)->set($data)->update();
        return redirect()->to('Dashboard/master_kamar')->with('validation', [
            'type' => 'success',
            'pesan' => 'Kode Kamar <strong>'. $kode . '</strong> Berhasil Di Perbarui'
        ]);
    }
}