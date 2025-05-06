<?php

namespace App\Controllers;

use App\Models\PowerTypeModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class PowerTypeController extends BaseController
{
    protected $powerTypeModel;

    public function __construct()
    {
        $this->powerTypeModel = new PowerTypeModel();
        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Jenis Daya | Lab Asset Management',
            'powerTypes' => $this->powerTypeModel->getAllPowerTypes()
        ];

        return view('power_type/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Jenis Daya | Lab Asset Management'
        ];

        return view('power_type/create', $data);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|is_unique[power_types.name]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ];

        $this->powerTypeModel->save($data);

        return redirect()->to('/power-types')->with('message', 'Jenis daya berhasil ditambahkan');
    }

    public function edit($id)
    {
        $powerType = $this->powerTypeModel->getPowerTypeById($id);
        if (!$powerType) {
            throw new PageNotFoundException();
        }

        $data = [
            'title' => 'Edit Jenis Daya | Lab Asset Management',
            'powerType' => $powerType
        ];

        return view('power_type/edit', $data);
    }

    public function update($id)
    {
        $powerType = $this->powerTypeModel->getPowerTypeById($id);
        if (!$powerType) {
            throw new PageNotFoundException();
        }

        $rules = [
            'name' => "required|is_unique[power_types.name,id,$id]",
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ];

        $this->powerTypeModel->update($id, $data);

        return redirect()->to('/power-types')->with('message', 'Jenis daya berhasil diperbarui');
    }

    public function delete($id)
    {
        $powerType = $this->powerTypeModel->getPowerTypeById($id);
        if (!$powerType) {
            throw new PageNotFoundException();
        }

        $this->powerTypeModel->delete($id);

        return redirect()->to('/power-types')->with('message', 'Jenis daya berhasil dihapus');
    }
}