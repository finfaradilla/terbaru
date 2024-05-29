<?php

namespace App\Controllers\DataMaster;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DataMaster\MasterSupplierModel;

class MasterSupplier extends BaseController
{
    protected $Validation;
    protected $Model;
    public function __construct()
    {
        $this->session = session();
        $this->Model = new MasterSupplierModel();
        $this->Validation = \Config\Services::validation();
    }

    public function save()
    {
        $kode = $this->request->getVar('kode');
        $valid = $this->validate([
            'kode' => [
                'rules' => 'required|min_length[5]|max_length[20]|is_unique[master_supplier.kode]',
                'errors' => [
                    'required' => 'Kode Supplier Wajib Diisi.',
                    'min_length' => 'Kode Supplier Minimal Mengisikan 5 Karakter.',
                    'max_length' => 'Kode Supplier Maksimal Mengisikan 20 Karakter.',
                    'is_unique' => "Kode Supplier " . $kode . " Sudah Terdaftar"
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Wajib Diisi.',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Wajib Diisi.',
                ]
            ],
            'sales' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sales Wajib Diisi.',
                ]
            ],
            'no_tlp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No Telp Wajib Diisi.',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'No Telp Wajib Diisi.',
                    'valid_email' => 'Email Tidak Valid.',
                ]
            ],
        ]);

        if(!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->Validation->getErrors());
        }
        $data = [
            'kode' => $kode,
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'sales' => $this->request->getVar('sales'),
            'no_tlp' => $this->request->getVar('no_tlp'),
            'email' => $this->request->getVar('email'),
        ];
        $this->Model->save($data);
        $this->session->setFlashdata('validation', [
            'type' => 'success',
            'pesan' => 'Kode Supplier <strong>'. $kode . '</strong> Berhasil Ditambah'
        ]);
        return redirect()->to('Dashboard/master_supplier')->withInput();
    }

    public function delete()
    {
        $kode = $this->request->getVar('kode');
        $response = $this->Model->where('kode', $kode)->delete();
        $this->session->setFlashdata('validation', [
            'type' => 'warning',
            'pesan' => 'Kode Supplier <strong>'. $kode . '</strong> Berhasil Dihapus'
        ]);
        return true;
    }

    public function edit($id)
    {
        $getData = $this->Model->find($id);
        $data = [
            'title' => 'Edit '. $getData['kode'],
            'name' => 'master_supplier',
            'menu_open' => true,
            'data_supplier' => $getData,
        ];
        return view('Dashboard/data_master/master_supplier_edit', $data);
    }

    public function update()
    {
        $kode = $this->request->getVar('kode');
        $valid = $this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Wajib Diisi.',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Wajib Diisi.',
                ]
            ],
            'sales' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sales Wajib Diisi.',
                ]
            ],
            'no_tlp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No Telp Wajib Diisi.',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'No Telp Wajib Diisi.',
                    'valid_email' => 'Email Tidak Valid.',
                ]
            ],
        ]);
        if(!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->Validation->getErrors());
        }
        $data = [
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'sales' => $this->request->getVar('sales'),
            'no_tlp' => $this->request->getVar('no_tlp'),
            'email' => $this->request->getVar('email'),
        ];
        $this->Model->where('kode', $kode)->set($data)->update();
        return redirect()->to('Dashboard/master_supplier')->with('validation', [
            'type' => 'success',
            'pesan' => 'Kode Supplier <strong>'. $kode . '</strong> Berhasil Di Perbarui'
        ]);
    }
}