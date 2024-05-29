<?php

namespace App\Controllers\DataMaster;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DataMaster\MasterPenunjangModel;

class MasterPenunjang extends BaseController
{
    protected $Validation;
    protected $Model;
    public function __construct()
    {
        $this->session = session();
        $this->Model = new MasterPenunjangModel();
        $this->Validation = \Config\Services::validation();
    }

    public function save()
    {
        $kode = $this->request->getVar('kode');
        $valid = $this->validate([
            'kode' => [
                'rules' => 'required|min_length[7]|max_length[20]|is_unique[master_penunjang.kode]',
                'errors' => [
                    'required' => 'Kode Penunjang Wajib Diisi.',
                    'min_length' => 'Kode Penunjang Minimal Mengisikan 7 Karakter.',
                    'max_length' => 'Kode Penunjang Maksimal Mengisikan 20 Karakter.',
                    'is_unique' => "Kode Penunjang " . $kode . " Sudah Terdaftar"
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan Wajib Diisi.',
                ]
            ],
            'harga_modal' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga Modal Wajib Diisi.',
                    'numeric' => 'Harga Modal Harus Angka.',
                ]
            ],
            'harga_jual' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga Jual Wajib Diisi.',
                    'numeric' => 'Harga Jual Harus Angka.',
                ]
            ],
        ]);

        if(!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->Validation->getErrors());
        }
        $data = [
            'kode' => $kode,
            'keterangan' => $this->request->getVar('keterangan'),
            'harga_modal' => $this->request->getVar('harga_modal'),
            'harga_jual' => $this->request->getVar('harga_jual'),
        ];
        $this->Model->save($data);
        $this->session->setFlashdata('validation', [
            'type' => 'success',
            'pesan' => 'Kode Penunjang <strong>'. $kode . '</strong> Berhasil Ditambah'
        ]);
        return redirect()->to('Dashboard/master_penunjang')->withInput();
    }

    public function delete()
    {
        $kode = $this->request->getVar('kode');
        $response = $this->Model->where('kode', $kode)->delete();
        $this->session->setFlashdata('validation', [
            'type' => 'warning',
            'pesan' => 'Kode Penunjang <strong>'. $kode . '</strong> Berhasil Dihapus'
        ]);
        return true;
    }

    public function edit($id)
    {
        $getData = $this->Model->find($id);
        $data = [
            'title' => 'Edit '. $getData['kode'],
            'name' => 'master_penunjang',
            'menu_open' => true,
            'data_penunjang' => $getData,
        ];
        return view('Dashboard/data_master/master_penunjang_edit', $data);
    }

    public function update()
    {
        $kode = $this->request->getVar('kode');
        $valid = $this->validate([
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan Wajib Diisi.',
                ]
            ],
            'harga_modal' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga Modal Wajib Diisi.',
                    'numeric' => 'Harga Modal Harus Angka.',
                ]
            ],
            'harga_jual' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga Jual Wajib Diisi.',
                    'numeric' => 'Harga Jual Harus Angka.',
                ]
            ],
        ]);
        if(!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->Validation->getErrors());
        }
        $data = [
            'keterangan' => $this->request->getVar('keterangan'),
            'harga_modal' => $this->request->getVar('harga_modal'),
            'harga_jual' => $this->request->getVar('harga_jual'),
        ];
        $this->Model->where('kode', $kode)->set($data)->update();
        return redirect()->to('Dashboard/master_penunjang')->with('validation', [
            'type' => 'success',
            'pesan' => 'Kode Penunjang <strong>'. $kode . '</strong> Berhasil Di Perbarui'
        ]);
    }
}