<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\RawatInapModel;

class RawatInap extends BaseController
{

    public function __construct()
    {
        $this->session = session();
        $this->Model = new RawatInapModel();
        $this->Validation = \Config\Services::validation();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        $getData = $this->Model->findAll();
        $rwtjlnData = [];
        foreach ($getData as $key => $value) {
            $rwtjlnData[] = [
                'data_pasien' => $this->Model->getPasienById($value['id_pasien']),
                'data_dokter' => $this->Model->getDokterById($value['id_dokter']),
                'data_kamar' => $this->Model->getKamarById($value['id_kamar']),
                'data_rawat_inap' => $value,
            ];
        };
        $data = [
            'title' => 'Rawat Inap',
            'name' => 'rawat_inap',
            'data' => $rwtjlnData,
        ];
        return view('Dashboard/rawat_inap/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Rawat Inap',
            'name' => 'rawat_inap',
            'data_pasien' => $this->Model->getAllPasien(),
            'data_dokter' => $this->Model->getAllDokter(),
            'data_poli' => $this->Model->getAllPoli(),
            'data_kamar' => $this->Model->getAllKamar(),
        ];
        return view('Dashboard/rawat_inap/tambah', $data);
    }

    public function tambahRI($id)
    {
        if (!isset($id)) {
            return redirect()->to('RawatInap/tambah');
        }
        $data = [
            'title' => 'Tambah Rawat Inap',
            'name' => 'rawat_inap',
            'data_pasien' => $this->Model->getAllPasien(),
            'data_dokter' => $this->Model->getAllDokter(),
            'data_poli' => $this->Model->getAllPoli(),
            'data_kamar' => $this->Model->getAllKamar(),
            'id_pasien' => $id,
        ];
        return view('Dashboard/rawat_inap/tambah', $data);
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
            'keluhan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keluhan Wajib Diisi.',
                ]
            ],
            'type' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Type Wajib Diisi.',
                ]
            ],
            'kamar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kamar Wajib Diisi.',
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
            'tgl_masuk' => $this->request->getVar('tanggal'),
            'jam_masuk' => $this->request->getVar('jam'),
            'keluhan' => $this->request->getVar('keluhan'),
            'type' => $this->request->getVar('type'),
            'id_kamar' => $this->request->getVar('kamar'),
            'id_dokter' => $this->request->getVar('dokter'),
        ];
        $this->Model->save($data);
        return redirect()->to('RawatInap/index')->with('validation', [
            'type' => 'success',
            'pesan' => 'Data Rawat Inap Berhasil Ditambahkan'
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
            'keluhan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keluhan Wajib Diisi.',
                ]
            ],
            'type' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Type Wajib Diisi.',
                ]
            ],
            'kamar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kamar Wajib Diisi.',
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
        $id = $this->request->getVar('id_rawat_inap');
        $data = [
            'id_pasien' => $this->request->getVar('pasien'),
            'tgl_masuk' => $this->request->getVar('tanggal'),
            'jam_masuk' => $this->request->getVar('jam'),
            'keluhan' => $this->request->getVar('keluhan'),
            'type' => $this->request->getVar('type'),
            'id_kamar' => $this->request->getVar('kamar'),
            'id_dokter' => $this->request->getVar('dokter'),
        ];
        if ($this->Model->update($id, $data)) {
            return redirect()->to('RawatInap/index')->with('validation', [
                'type' => 'success',
                'pesan' => 'Data Berhasil Diupdate'
            ]);
        }
        return redirect()->to('RawatInap/index')->with('validation', [
            'type' => 'danger',
            'pesan' => 'Data Gagal Di Update'
        ]);
    }

    public function edit($id)
    {
        $getData = $this->Model->find($id);
        $data = [
            'title' => 'Rawat Inap Edit',
            'name' => 'rawat_inap',
            'data' => [
                'data_semua_pasien' => $this->Model->getAllPasien(),
                'data_semua_kamar' => $this->Model->getAllKamar(),
                'data_semua_dokter' => $this->Model->getAllDokter(),
                'data_pasien' => $this->Model->getPasienById($getData['id_pasien']),
                'data_dokter' => $this->Model->getDokterById($getData['id_dokter']),
                'data_kamar' => $this->Model->getKamarById($getData['id_kamar']),
                'data_rawat_inap' => $getData,
            ],
        ];
        return view('Dashboard/rawat_inap/edit', $data);
    }

    public function delete()
    {
        $kode = $this->request->getVar('kode');
        $data_rawat_inap = $this->Model->find($kode);
        $response = $this->Model->where('id', $kode)->delete();
        $this->session->setFlashdata('validation', [
            'type' => 'warning',
            'pesan' => 'Rawat Inap <strong>'. $data_rawat_inap['no_pendaftaran'] . '</strong> Berhasil Dihapus'
        ]);
        return true;
    }

    public function pulangkan()
    {
        $id = $this->request->getVar('kode');
        $getData = $this->Model->find($id);
        $data = [
            'tgl_keluar' => date("Y-m-d", time()),
            'jam_keluar' => date("H").':'.date("i"),
        ];
        if ($this->Model->update($id, $data)) {
            $this->session->setFlashdata('validation', [
                'type' => 'success',
                'pesan' => 'Rawat Inap <strong>'. $getData['no_pendaftaran'] . '</strong> Berhasil Di Pulangkan'
            ]);
            return true;
        } else {
            $this->session->setFlashdata('validation', [
                'type' => 'danger',
                'pesan' => 'Rawat Inap <strong>'. $getData['no_pendaftaran'] . '</strong> Gagal Di Pulangkan'
            ]);
            return false;
        }
    }
}