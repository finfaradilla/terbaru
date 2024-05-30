<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PasienModel;

class Pasien extends BaseController
{

    public function __construct()
    {
        $this->session = session();
        $this->Model = new PasienModel();
        $this->Validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'Pasien',
            'name' => 'pasien',
            'data_pasien' => $this->Model->findAll(),
        ];
        return view('Dashboard/pasien/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Pasien',
            'name' => 'pasien',
        ];
        return view('Dashboard/pasien/tambah', $data);
    }

    public function simpan()
    {
        $valid = $this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan Wajib Diisi.',
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin Wajib Diisi.',
                ]
            ],
            'gol_darah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Golongan Darah Wajib Diisi.',
                ]
            ],
            'tgl_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Lahir Wajib Diisi.',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Wajib Diisi.',
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status Wajib Diisi.',
                ]
            ],
            'no_ktp' => [
                'rules' => 'required|numeric|is_unique[pasien.no_ktp]',
                'errors' => [
                    'required' => 'No KTP Wajib Diisi.',
                    'numeric' => 'No KTP Harus Angka',
                    'is_unique' => 'No KTP Sudah Terdaftar',
                ]
            ],
            'pekerjaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pekerjaan Wajib Diisi.',
                ]
            ],
            'bpjs' => [
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'No BJPS Harus Angka'
                ]
            ],
            'no_tlp' => [
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'No Telp Harus Angka'
                ]
            ],
        ]);

        if(!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->Validation->getErrors());
        }
        $data = [
            'no_ktp' => $this->request->getVar('no_ktp'),
            'nama' => $this->request->getVar('nama'),
            'gol_darah' => $this->request->getVar('gol_darah'),
            'status' => $this->request->getVar('status'),
            'bpjs' => $this->request->getVar('bpjs'),
            'no_rm' => random_int(999, 999999),
            'status' => $this->request->getVar('status'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tgl_lahir' => $this->request->getVar('tgl_lahir'),
            'alamat' => $this->request->getVar('alamat'),
            'no_tlp' => $this->request->getVar('no_tlp'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
        ];
        $this->Model->save($data);
        return redirect()->to('Pasien/index')->with('validation', [
            'type' => 'success',
            'pesan' => 'Data '.$this->request->getVar('nama').' Berhasil Ditambahkan'
        ]);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Pasien Edit',
            'name' => 'pasien',
            'data_pasien' => $this->Model->find($id),
        ];
        return view('Dashboard/pasien/edit', $data);
    }
}
