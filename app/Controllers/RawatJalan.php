<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\RawatJalanModel;

class RawatJalan extends BaseController
{

    public function __construct()
    {
        $this->session = session();
        $this->Model = new RawatJalanModel();
        $this->Validation = \Config\Services::validation();
    }

    public function index()
    {
        $getData = $this->Model->findAll();
        $rwtjlnData = [];
        foreach ($getData as $key => $value) {
            $rwtjlnData[] = [
                'data_pasien' => $this->Model->getPasienById($value['id_pasien']),
                'data_dokter' => $this->Model->getDokterById($value['id_dokter']),
                'data_poli' => $this->Model->getPoliById($value['id_poli']),
                'data_rawat_jalan' => $value,
            ];
        };
        $data = [
            'title' => 'Rawat Jalan',
            'name' => 'rawat_jalan',
            'data' => $rwtjlnData,
        ];
        return view('Dashboard/rawat_jalan/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Rawat Jalan',
            'name' => 'rawat_jalan',
            'data_pasien' => $this->Model->getAllPasien(),
            'data_dokter' => $this->Model->getAllDokter(),
            'data_poli' => $this->Model->getAllPoli(),
        ];
        return view('Dashboard/rawat_jalan/tambah', $data);
    }

    public function tambahRJ($id)
    {
        if (!isset($id)) {
            return redirect()->to('RawatJalan/tambah');
        }
        $data = [
            'title' => 'Tambah Rawat Jalan',
            'name' => 'rawat_jalan',
            'data_pasien' => $this->Model->getAllPasien(),
            'data_dokter' => $this->Model->getAllDokter(),
            'data_poli' => $this->Model->getAllPoli(),
            'id_pasien' => $id,
        ];
        return view('Dashboard/rawat_jalan/tambah', $data);
    }

    public function simpan()
    {
        $valid = $this->validate([
            'pasien' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pasien Wajib Diisi.',
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Wajib Diisi.',
                ]
            ],
            'jam' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam Wajib Diisi.',
                ]
            ],
            'type' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Type Wajib Diisi.',
                ]
            ],
            'administrasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Administrasi Wajib Diisi.',
                ]
            ],
            'poli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Poli Wajib Diisi.',
                ]
            ],
            'dokter' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Dokter Wajib Diisi.',
                ]
            ],
        ]);
        
        if(!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->Validation->getErrors());
        }
        $data = [
            'no_pendaftaran' => "DFT".time().' - '.random_int(99999, 99999999),
            'id_pasien' => $this->request->getVar('pasien'),
            'tanggal' => $this->request->getVar('tanggal'),
            'jam' => $this->request->getVar('jam'),
            'keluhan' => $this->request->getVar('keluhan'),
            'type' => $this->request->getVar('type'),
            'administrasi' => $this->request->getVar('administrasi'),
            'id_poli' => $this->request->getVar('poli'),
            'id_dokter' => $this->request->getVar('dokter'),
        ];
        $this->Model->save($data);
        return redirect()->to('RawatJalan/index')->with('validation', [
            'type' => 'success',
            'pesan' => 'Data Rawat Jalan Berhasil Ditambahkan'
        ]);
    }

    public function update()
    {
        $valid = $this->validate([
            'pasien' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pasien Wajib Diisi.',
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Wajib Diisi.',
                ]
            ],
            'jam' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam Wajib Diisi.',
                ]
            ],
            'type' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Type Wajib Diisi.',
                ]
            ],
            'administrasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Administrasi Wajib Diisi.',
                ]
            ],
            'poli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Poli Wajib Diisi.',
                ]
            ],
            'dokter' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Dokter Wajib Diisi.',
                ]
            ],
        ]);
        if(!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->Validation->getErrors());
        }
        $id = $this->request->getVar('id_rawat_jalan');
        $data = [
            'id_pasien' => $this->request->getVar('pasien'),
            'tanggal' => $this->request->getVar('tanggal'),
            'jam' => $this->request->getVar('jam'),
            'keluhan' => $this->request->getVar('keluhan'),
            'type' => $this->request->getVar('type'),
            'administrasi' => $this->request->getVar('administrasi'),
            'id_poli' => $this->request->getVar('poli'),
            'id_dokter' => $this->request->getVar('dokter'),
        ];
        if ($this->Model->update($id, $data)) {
            return redirect()->to('RawatJalan/index')->with('validation', [
                'type' => 'success',
                'pesan' => 'Data Berhasil Diupdate'
            ]);
        }
        return redirect()->to('RawatJalan/index')->with('validation', [
            'type' => 'danger',
            'pesan' => 'Data Gagal Di Update'
        ]);
    }

    public function edit($id)
    {
        $getData = $this->Model->find($id);
        $data = [
            'title' => 'Rawat Jalan Edit',
            'name' => 'rawat_jalan',
            'data' => [
                'data_semua_pasien' => $this->Model->getAllPasien(),
                'data_semua_poli' => $this->Model->getAllPoli(),
                'data_semua_dokter' => $this->Model->getAllDokter(),
                'data_pasien' => $this->Model->getPasienById($getData['id_pasien']),
                'data_dokter' => $this->Model->getDokterById($getData['id_dokter']),
                'data_poli' => $this->Model->getPoliById($getData['id_poli']),
                'data_rawat_jalan' => $getData,
            ],
        ];
        return view('Dashboard/rawat_jalan/edit', $data);
    }

    public function delete()
    {
        $kode = $this->request->getVar('kode');
        $data_pasien = $this->Model->find($kode);
        $response = $this->Model->where('id', $kode)->delete();
        $this->session->setFlashdata('validation', [
            'type' => 'warning',
            'pesan' => 'Rawat Jalan <strong>'. $kode . '</strong> Berhasil Dihapus'
        ]);
        return true;
    }
}