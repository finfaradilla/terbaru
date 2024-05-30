<?php

namespace App\Controllers\DataMaster;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DataMaster\MasterObatModel;
use App\Models\DataMaster\MasterSupplierModel;

class MasterObat extends BaseController
{
    protected $Validation;
    protected $Model;
    public function __construct()
    {
        $this->session = session();
        $this->Model = new MasterObatModel();
        $this->ModelSupplier = new MasterSupplierModel();
        $this->Validation = \Config\Services::validation();
    }

    public function save()
    {
        $kode = $this->request->getVar('kode');
        $valid = $this->validate([
            'kode' => [
                'rules' => 'required|min_length[7]|max_length[20]|is_unique[master_obat.kode]',
                'errors' => [
                    'required' => 'Kode Obat Wajib Diisi.',
                    'min_length' => 'Kode Obat Minimal Mengisikan 7 Karakter.',
                    'max_length' => 'Kode Obat Maksimal Mengisikan 20 Karakter.',
                    'is_unique' => "Kode Obat " . $kode . " Sudah Terdaftar"
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Obat Wajib Diisi.',
                ]
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Satuan Wajib Diisi.',
                ]
            ],
            'type' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Type Wajib Diisi.',
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
            'stok' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Stok Wajib Diisi.',
                    'numeric' => 'Stok Harus Angka.',
                ]
            ],
            'exp_date' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Exp Date Wajib Diisi.',
                ]
            ],
            'supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Supplier Wajib Diisi.',
                ]
            ],
        ]);

        if(!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->Validation->getErrors());
        }
        $data = [
            'kode' => $kode,
            'nama' => $this->request->getVar('nama'),
            'satuan' => $this->request->getVar('satuan'),
            'type' => $this->request->getVar('type'),
            'harga_modal' => $this->request->getVar('harga_modal'),
            'harga_jual' => $this->request->getVar('harga_jual'),
            'stok' => $this->request->getVar('stok'),
            'exp_date' => $this->request->getVar('exp_date'),
            'supplier' => $this->request->getVar('supplier'),
        ];
        $this->Model->save($data);
        $this->session->setFlashdata('validation', [
            'type' => 'success',
            'pesan' => 'Kode Obat <strong>'. $kode . '</strong> Berhasil Ditambah'
        ]);
        return redirect()->to('Dashboard/master_obat')->withInput();
    }

    public function delete()
    {
        $kode = $this->request->getVar('kode');
        $response = $this->Model->where('kode', $kode)->delete();
        $this->session->setFlashdata('validation', [
            'type' => 'warning',
            'pesan' => 'Kode Obat <strong>'. $kode . '</strong> Berhasil Dihapus'
        ]);
        return true;
    }

    public function edit($id)
    {
        $getData = $this->Model->find($id);
        $data = [
            'title' => 'Edit '. $getData['kode'],
            'name' => 'master_obat',
            'menu_open' => true,
            'data_obat' => $getData,
            'data_supplier' => $this->ModelSupplier->findAll(),
        ];
        return view('Dashboard/data_master/master_obat_edit', $data);
    }

    public function update()
    {
        $kode = $this->request->getVar('kode');
        $valid = $this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Obat Wajib Diisi.',
                ]
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Satuan Wajib Diisi.',
                ]
            ],
            'type' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Type Wajib Diisi.',
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
            'stok' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Stok Wajib Diisi.',
                    'numeric' => 'Stok Harus Angka.',
                ]
            ],
            'exp_date' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Exp Date Wajib Diisi.',
                ]
            ],
            'supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Supplier Wajib Diisi.',
                ]
            ],
        ]);
        if(!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->Validation->getErrors());
        }
        $data = [
            'nama' => $this->request->getVar('nama'),
            'satuan' => $this->request->getVar('satuan'),
            'type' => $this->request->getVar('type'),
            'harga_modal' => $this->request->getVar('harga_modal'),
            'harga_jual' => $this->request->getVar('harga_jual'),
            'stok' => $this->request->getVar('stok'),
            'exp_date' => $this->request->getVar('exp_date'),
            'supplier' => $this->request->getVar('supplier'),
        ];
        $this->Model->where('kode', $kode)->set($data)->update();
        return redirect()->to('Dashboard/master_obat')->with('validation', [
            'type' => 'success',
            'pesan' => 'Kode Obat <strong>'. $kode . '</strong> Berhasil Di Perbarui'
        ]);
    }
}
