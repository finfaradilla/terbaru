<?php

namespace App\Controllers\DataMaster;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DataMaster\MasterDiagnosaModel;

class MasterDiagnosa extends BaseController
{
    protected $Validation;
    protected $Model;
    public function __construct()
    {
        $this->session = session();
        $this->Model = new MasterDiagnosaModel();
        $this->Validation = \Config\Services::validation();
    }

    public function save()
    {
        $kode = $this->request->getVar('kode');
        $valid = $this->validate([
            'kode' => [
                'rules' => 'required|min_length[7]|max_length[20]|is_unique[master_diagnosa.kode]',
                'errors' => [
                    'required' => 'Kode Diagnosa Wajib Diisi.',
                    'min_length' => 'Kode Diagnosa Minimal Mengisikan 7 Karakter.',
                    'max_length' => 'Kode Diagnosa Maksimal Mengisikan 20 Karakter.',
                    'is_unique' => "Kode Diagnosa " . $kode . " Sudah Terdaftar"
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan Wajib Diisi.',
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
            'pesan' => 'Kode Diagnosa <strong>'. $kode . '</strong> Berhasil Ditambah'
        ]);
        return redirect()->to('Dashboard/master_diagnosa')->withInput();
    }

    public function delete()
    {
        $kode = $this->request->getVar('kode');
        $response = $this->Model->where('kode', $kode)->delete();
        $this->session->setFlashdata('validation', [
            'type' => 'warning',
            'pesan' => 'Kode Diagnosa <strong>'. $kode . '</strong> Berhasil Dihapus'
        ]);
        return true;
    }

    public function edit($id)
    {
        $getData = $this->Model->find($id);
        $data = [
            'title' => 'Edit '. $getData['kode'],
            'name' => 'master_diagnosa',
            'menu_open' => true,
            'data_diagnosa' => $getData,
        ];
        return view('Dashboard/data_master/master_diagnosa_edit', $data);
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
        ]);
        if(!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->Validation->getErrors());
        }
        $data = [
            'keterangan' => $this->request->getVar('keterangan'),
        ];
        $this->Model->where('kode', $kode)->set($data)->update();
        return redirect()->to('Dashboard/master_diagnosa')->with('validation', [
            'type' => 'success',
            'pesan' => 'Kode Diagnosa <strong>'. $kode . '</strong> Berhasil Di Perbarui'
        ]);
    }
}
