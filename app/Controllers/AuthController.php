<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form', 'url']);
    }

    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        $data = [
            'title' => 'Login | Lab Asset Management'
        ];

        return view('auth/login', $data);
    }

    public function attemptLogin()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->userModel->getUserByUsername($username);

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Username atau password salah');
        }

        $sessionData = [
            'userId' => $user['id'],
            'username' => $user['username'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'isLoggedIn' => true
        ];

        session()->set($sessionData);

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}