<?php

namespace App\Controllers\DataMaster;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DataMaster\MasterTindakanModel;

class MasterTindakan extends BaseController
{
    protected $Validation;
    protected $Model;
    public function __construct()
    {
        $this->session = session();
        $this->Model = new MasterTindakanModel();
        $this->Validation = \Config\Services::validation();
    }

    public function save()
    {
        $kode = $this->request->getVar('kode_tindakan');
        $valid = $this->validate([
            'kode_tindakan' => [
                'rules' => 'required|min_length[7]|max_length[20]|is_unique[master_tindakan.kode]',
                'errors' => [
                    'required' => 'Kode Tindakan Wajib Diisi.',
                    'min_length' => 'Kode Tindakan Minimal Mengisikan 7 Karakter.',
                    'max_length' => 'Kode Tindakan Maksimal Mengisikan 20 Karakter.',
                    'is_unique' => "Kode Tindakan " . $kode . " Sudah Terdaftar"
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan Wajib Diisi.',
                ]
            ],
            'tarif' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Keterangan Wajib Diisi.',
                    'numeric' => 'Tarif Harus Angka.',
                ]
            ],
        ]);

        if(!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->Validation->getErrors());
        }
        $data = [
            'kode' => $kode,
            'keterangan' => $this->request->getVar('keterangan'),
            'tarif' => $this->request->getVar('tarif'),
        ];
        $this->Model->save($data);
        $this->session->setFlashdata('validation', [
            'type' => 'success',
            'pesan' => 'Kode Tindakan <strong>'. $kode . '</strong> Berhasil Ditambah'
        ]);
        return redirect()->to('Dashboard/master_tindakan')->withInput();
    }

    public function delete()
    {
        $kode = $this->request->getVar('kode');
        $response = $this->Model->where('kode', $kode)->delete();
        $this->session->setFlashdata('validation', [
            'type' => 'warning',
            'pesan' => 'Kode Tindakan <strong>'. $kode . '</strong> Berhasil Dihapus'
        ]);
        return true;
    }

    public function edit($id)
    {
        $getData = $this->Model->find($id);
        $data = [
            'title' => 'Edit '. $getData['kode'],
            'name' => 'master_tindakan',
            'menu_open' => true,
            'data_tindakan' => $getData,
        ];
        return view('Dashboard/data_master/master_tindakan_edit', $data);
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
            'tarif' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Keterangan Wajib Diisi.',
                    'numeric' => 'Tarif Harus Angka.',
                ]
            ],
        ]);
        if(!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->Validation->getErrors());
        }
        $data = [
            'keterangan' => $this->request->getVar('keterangan'),
            'tarif' => $this->request->getVar('tarif'),
        ];
        $this->Model->where('kode', $kode)->set($data)->update();
        return redirect()->to('Dashboard/master_tindakan')->with('validation', [
            'type' => 'success',
            'pesan' => 'Kode Tindakan <strong>'. $kode . '</strong> Berhasil Di Perbarui'
        ]);
    }
}