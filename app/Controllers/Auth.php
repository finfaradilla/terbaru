<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AuthModels;
use CodeIgniter\I18n\Time;

class Auth extends BaseController
{
    protected $Validation;
    public function __construct()
    {
        $this->AuthModel = new AuthModels();
        $this->session = session();
        $this->Validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'Login',
            'name' => 'login',
        ];
        return view('Auth/login',$data);
    }

    public function login()
    {
        $data = [
            'title' => 'Login',
            'name' => 'login',
        ];
        return view('Auth/login', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Daftar Akun',
            'name' => 'register',
        ];
        return view('Auth/register', $data);
    }

    public function forgot_password()
    {
        $data = [
            'title' => 'Lupa Password',
            'name' => 'forgot_password',
        ];
        return view('Auth/forgot_password', $data);
    }

    public function auth_login()
    {
        $valid = $this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email Wajib Diisi.',
                    'valid_email' => 'Email Tidak Valid.'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[150]',
                'errors' => [
                    'required' => 'Password Wajib Diisi.',
                    'min_length' => 'Minimal Mengisikan 5 Karakter.',
                    'max_length' => 'Maksimal Mengisikan 150 Karakter.',
                ]
            ],
        ]);

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $getData = $this->AuthModel->where('email', $email)->first();
        if(!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->Validation->getErrors());
        }
        if($getData) {
            if ($getData['password'] === $password) {
                $sessionData = [
                    'email' => $getData['email'],
                    'name' => $getData['name'],
                    'role' => $getData['id_role'],
                    'isloggin' => true,
                ];
                $this->session->set($sessionData);
                return redirect()->to('/Dashboard');
            } else {
                $this->session->setFlashdata('errors', [
                    'password' => 'Password Salah'
                ]);
            }
        } else {
            $this->session->setFlashdata('errors', [
                'email' => 'Email Tidak Terdaftar'
            ]);
        }
        return redirect()->to('Auth/')->withInput();
    }


    public function auth_register()
    {
        $valid = $this->validate([
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email Wajib Diisi.',
                    'valid_email' => 'Email Tidak Valid.',
                    'is_unique' => 'Email Sudah Terdaftar.',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[150]',
                'errors' => [
                    'required' => 'Password Wajib Diisi.',
                    'min_length' => 'Minimal Mengisikan 5 Karakter.',
                    'max_length' => 'Maksimal Mengisikan 150 Karakter.',
                ]
            ],
            'name' => [
                'rules' => 'required|min_length[3]|max_length[150]',
                'errors' => [
                    'required' => 'Nama Wajib Diisi.',
                    'min_length' => 'Minimal Mengisikan 3 Karakter.',
                    'max_length' => 'Maksimal Mengisikan 150 Karakter.',
                ]
            ],
        ]);
        if(!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->Validation->getErrors());
        }
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            //Ini Adalah Password Yang Di Encryp
            // 'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        ];
        $this->AuthModel->save($data);
        $this->session->setFlashdata('validation', [
            'type' => 'success',
            'pesan' => '<strong>'. $this->request->getVar('email') . '</strong> Berhasil Terdaftar'
        ]);
        return redirect()->to('Auth/')->withInput();
    }

    public function auth_forgot_password()
    {
        $valid = $this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email Wajib Diisi.',
                    'valid_email' => 'Email Tidak Valid.',
                ]
            ],
        ]);
        if(!$valid) {
            return redirect()->back()->withInput()->with('errors', $this->Validation->getErrors());
        }

        $email = $this->request->getPost('email');
        $user = $this->AuthModel->where('email', $email)->first();
        if (!$user) {
            return redirect()->back()->withInput()->with('errors', [
                'email' => 'Email Tidak Terdaftar'
            ]);
        }
        $token = bin2hex(random_bytes(50));
        $this->AuthModel->update($user['id'], ['reset_token' => $token, 'reset_expiry' => Time::now()->addHours(1)]);
        $this->sendResetEmail($email, $token);
        return redirect()->back()->with('validation', [
            'type' => 'success',
            'pesan' => 'Reset Password Berhasil Dikirim Ke Email <strong>'.$email.'</strong>',
        ]);
    }

    private function sendResetEmail($email, $token)
    {
        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setFrom('no-reply@e-klinik.com', 'E-Klinik');
        $emailService->setSubject('Password Reset Request');
        $emailService->setMessage(view('Auth/email_forgot_password', ['token' => $token]));
        $emailService->send();
    }
    
    public function reset_password($token)
    {
        $user = $this->AuthModel->where('reset_token', $token)->where('reset_expiry >=', Time::now())->first();
        if (!$user) {
            return redirect()->to('Auth/forgot_password')->with('validation', [
                'type' => 'error',
                'pesan' => 'Token Tidak Benar Atau Token Expired',
            ]);
        }
        $data = [
            'title' => 'Reset Password',
            'name' => 'reset_password',
            'email' => $user['email'],
            'token' => $token,
        ];
        return view('Auth/reset_password', $data);
    }

    public function auth_reset_password()
    {
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');

        // dd($token);
        $valid = $this->validate([
            'password' => [
                'rules' => 'required|min_length[5]|max_length[150]',
                'errors' => [
                    'required' => 'Password Wajib Diisi.',
                    'min_length' => 'Minimal Mengisikan 5 Karakter.',
                    'max_length' => 'Maksimal Mengisikan 150 Karakter.',
                ]
            ],
        ]);
        if(!$valid) {
            return redirect()->to('Auth/reset_password/'.$token)->withInput()->with('errors', $this->Validation->getErrors());
        }
        $user = $this->AuthModel->where('reset_token', $token)
                          ->where('reset_expiry >=', Time::now())
                          ->first();

        if (!$user) {
            return redirect()->to('Auth/reset_password/'.$token)->withInput()->with('validation', [
                'type' => 'error',
                'pesan' => 'Token Tidak Benar Atau Token Expired',
            ]);
        }

        $this->AuthModel->update($user['id'], [
            'password' => $password,
            'reset_token' => null,
            'reset_expiry' => null
            // Ini Adalah Password Encryp
            // 'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        return redirect()->to('Auth/')->with('validation', [
            'type' => 'success',
            'pesan' => 'Password Berhasil Di Perbarui',
        ]);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('Auth/login');
    }
}
