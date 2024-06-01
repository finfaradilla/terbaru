<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ManajemenUserModel;

class ManajemenUser extends BaseController
{

    public function __construct()
    {
        $this->session = session();
        $this->Model = new ManajemenUserModel();
        $this->Validation = \Config\Services::validation();
        
    }

    public function index()
    {
        $getData = $this->Model->findAll();
        $rwtjlnData = [];
        foreach ($getData as $key => $value) {
            $rwtjlnData[] = [
                'data_role' => $this->Model->getRoleById($value['id_role']),
                'data_manajemen_user' => $value,
            ];
        };
        $data = [
            'title' => 'Rawat Manajemen User',
            'name' => 'manajemen_user',
            'data' => $rwtjlnData,
        ];
        // dd($data);
        return view('Dashboard/manajemen_user/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Manajemen User',
            'name' => 'manajemen_user',
            'data_role' => $this->Model->getAllRole(),
        ];
        return view('Dashboard/manajemen_user/tambah', $data);
    }

    public function simpan()
    {
        $valid = $this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pasien Wajib Diisi.',
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[users.email]',
                'errors' => [
                    'required' => 'Tanggal Wajib Diisi.',
                    'is_unique' => 'Email Sudah Terdaftar.',
                ]
            ],
            'no_hp' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Nomor HP Wajib Diisi.',
                    'numeric' => 'Nomor HP Harus Angka.',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password Wajib Diisi.',
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role Wajib Diisi.',
                ]
            ],
        ]);
        
        if(!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->Validation->getErrors());
        }

        $img = $this->request->getFile('image');
        $image = "uploads/default/default.png";
        if ($img->isValid()){
            $newName = $img->getRandomName();
            $img->move(FCPATH . 'uploads/img/profile/', $newName);
            $image = 'uploads/img/profile/'.$newName;
        };

        $data = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'name' => $this->request->getVar('name'),
            'id_role' => $this->request->getVar('role'),
            'no_hp' => $this->request->getVar('no_hp'),
            'image' => $image,
        ];
        $this->Model->save($data);
        return redirect()->to('ManajemenUser/index')->with('validation', [
            'type' => 'success',
            'pesan' => 'Data User Berhasil Ditambahkan'
        ]);
    }

    public function update()
    {
        $valid = $this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pasien Wajib Diisi.',
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Wajib Diisi.',
                ]
            ],
            'no_hp' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Nomor HP Wajib Diisi.',
                    'numeric' => 'Nomor HP Harus Angka.',
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role Wajib Diisi.',
                ]
            ],
            'image' => [
                'rules' => 'is_image[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]|max_size[image,10240]',
                'errors' => [
                    'uploaded' => 'File hanya Boleh Image',
                    'is_image' => 'File hanya Boleh Image',
                    'mime_in' => 'File Format Hanya Boleh jpg, jpeg, gif, png, webp',
                    'max_size' => 'Max Ukuran File 10MB',
                ]
            ],
        ]);
        
        $id = $this->request->getVar('id_manajemen_user');
        $image_old = $this->request->getVar('image_old');
        $img = $this->request->getFile('image');
        $image = null;
        if(!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->Validation->getErrors());
        }
        if ($img->isValid()){
            $newName = $img->getRandomName();
            $img->move(FCPATH . 'uploads/img/profile/', $newName);
            $image = 'uploads/img/profile/'.$newName;
            if (file_exists($image_old)) {
                unlink($image_old);
            }
        } else {
            $image = $image_old;
        }
        $data = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'name' => $this->request->getVar('name'),
            'id_role' => $this->request->getVar('role'),
            'no_hp' => $this->request->getVar('no_hp'),
            'image' => $image,
        ];
        if ($this->Model->update($id, $data)) {
            return redirect()->to('ManajemenUser/index')->with('validation', [
                'type' => 'success',
                'pesan' => 'Data Berhasil Diupdate'
            ]);
        }
        return redirect()->to('ManajemenUser/index')->with('validation', [
            'type' => 'danger',
            'pesan' => 'Data Gagal Di Update'
        ]);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Manajemen User Edit',
            'name' => 'manajemen_user',
            'data_user' => $this->Model->find($id),
            'data_role' => $this->Model->getAllRole(),
        ];
        return view('Dashboard/manajemen_user/edit', $data);
    }

    public function delete()
    {
        $kode = $this->request->getVar('kode');
        $data_user = $this->Model->find($kode);
        if (file_exists($data_user['image'])) {
            unlink($data_user['image']);
        }
        $response = $this->Model->where('id', $kode)->delete();
        $this->session->setFlashdata('validation', [
            'type' => 'warning',
            'pesan' => 'Manajemen User <strong>'. $data_user['email'] . '</strong> Berhasil Dihapus'
        ]);
        return true;
    }
}