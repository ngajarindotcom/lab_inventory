<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form']);
    }

    public function index()
    {
        if (session()->get('role') != 'admin') {
            throw new PageNotFoundException();
        }

        $data = [
            'title' => 'Manajemen User | Lab Asset Management',
            'users' => $this->userModel->getAllUsers()
        ];

        return view('user/index', $data);
    }

    public function create()
    {
        if (session()->get('role') != 'admin') {
            throw new PageNotFoundException();
        }

        $data = [
            'title' => 'Tambah User | Lab Asset Management'
        ];

        return view('user/create', $data);
    }

    public function store()
    {
        if (session()->get('role') != 'admin') {
            throw new PageNotFoundException();
        }

        $rules = [
            'username' => 'required|is_unique[users.username]|min_length[5]',
            'password' => 'required|min_length[6]',
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]',
            'role' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role')
        ];

        $this->userModel->save($data);

        return redirect()->to('/users')->with('message', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        if (session()->get('role') != 'admin') {
            throw new PageNotFoundException();
        }

        $user = $this->userModel->getUserById($id);
        if (!$user) {
            throw new PageNotFoundException();
        }

        $data = [
            'title' => 'Edit User | Lab Asset Management',
            'user' => $user
        ];

        return view('user/edit', $data);
    }

    public function update($id)
    {
        if (session()->get('role') != 'admin') {
            throw new PageNotFoundException();
        }

        $user = $this->userModel->getUserById($id);
        if (!$user) {
            throw new PageNotFoundException();
        }

        $rules = [
            'username' => "required|is_unique[users.username,id,$id]|min_length[5]",
            'name' => 'required',
            'email' => "required|valid_email|is_unique[users.email,id,$id]",
            'role' => 'required'
        ];

        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role')
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = $this->request->getPost('password');
        }

        $this->userModel->update($id, $data);

        return redirect()->to('/users')->with('message', 'User berhasil diperbarui');
    }

    public function delete($id)
    {
        if (session()->get('role') != 'admin') {
            throw new PageNotFoundException();
        }

        $user = $this->userModel->getUserById($id);
        if (!$user) {
            throw new PageNotFoundException();
        }

        if ($user['id'] == session()->get('userId')) {
            return redirect()->to('/users')->with('error', 'Tidak dapat menghapus akun sendiri');
        }

        $this->userModel->delete($id);

        return redirect()->to('/users')->with('message', 'User berhasil dihapus');
    }
}