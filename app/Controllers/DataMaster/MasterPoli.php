<?php

namespace App\Controllers\DataMaster;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DataMaster\MasterPoliModel;

class MasterPoli extends BaseController
{
    protected $Validation;
    protected $Model;
    public function __construct()
    {
        $this->session = session();
        $this->Model = new MasterPoliModel();
        $this->Validation = \Config\Services::validation();
    }

    public function save()
    {
        $kode = $this->request->getVar('kode_poli');
        $valid = $this->validate([
            'kode_poli' => [
                'rules' => 'required|min_length[7]|max_length[20]|is_unique[master_dokter.kode]',
                'errors' => [
                    'required' => 'Kode Poli Wajib Diisi.',
                    'min_length' => 'Minimal Mengisikan 7 Karakter.',
                    'max_length' => 'Maksimal Mengisikan 20 Karakter.',
                    'is_unique' => "Kode " . $kode . " Sudah Terdaftar"
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
            'kode' => $this->request->getVar('kode_poli'),
            'keterangan' => $this->request->getVar('keterangan'),
        ];
        $this->Model->save($data);
        $this->session->setFlashdata('validation', [
            'type' => 'success',
            'pesan' => 'Kode Poli <strong>'. $this->request->getVar('kode_poli') . '</strong> Berhasil Ditambah'
        ]);
        return redirect()->to('Dashboard/master_poli')->withInput();
    }

    public function delete()
    {
        $kode = $this->request->getVar('kode_poli');
        $response = $this->Model->where('kode', $kode)->delete();
        $this->session->setFlashdata('validation', [
            'type' => 'warning',
            'pesan' => 'Kode Poli <strong>'. $this->request->getVar('kode_poli') . '</strong> Berhasil Dihapus'
        ]);
        return true;
    }

    public function edit($id)
    {
        $getData = $this->Model->find($id);
        $data = [
            'title' => 'Edit '. $getData['kode'],
            'name' => 'master_poli',
            'menu_open' => true,
            'data_poli' => $getData,
        ];
        return view('Dashboard/data_master/master_poli_edit', $data);
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
        return redirect()->to('Dashboard/master_poli')->with('validation', [
            'type' => 'success',
            'pesan' => 'Kode Poli <strong>'. $kode . '</strong> Berhasil Di Perbarui'
        ]);
    }
}
