<?php
namespace App\Controllers;
use App\Models\PenggunaModel;

class Login extends BaseController
{
    public function index()
    {
        return view('displayLogin');
    }

    public function auth()
    {
        $session = session();
        $userModel = new PenggunaModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'id_pengguna'    => $user['id_pengguna'],
                'username'       => $user['username'],
                'nama_depan'     => $user['nama_depan'],
                'nama_belakang'  => $user['nama_belakang'],
                'role'           => $user['role'],
                'isLoggedIn'     => true
            ]);

            // Arahkan sesuai role
            if ($user['role'] == 'Admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/client/dashboard');
            }
        }
        $session->setFlashdata('error', 'Username atau password salah!');
        return redirect()->back();
    
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
