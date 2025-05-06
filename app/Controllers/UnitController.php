<?php

namespace App\Controllers;

use App\Models\UnitModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class UnitController extends BaseController
{
    protected $unitModel;

    public function __construct()
    {
        $this->unitModel = new UnitModel();
        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Satuan Barang | Lab Asset Management',
            'units' => $this->unitModel->getAllUnits()
        ];

        return view('unit/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Satuan | Lab Asset Management'
        ];

        return view('unit/create', $data);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|is_unique[units.name]',
            'symbol' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'symbol' => $this->request->getPost('symbol')
        ];

        $this->unitModel->save($data);

        return redirect()->to('/units')->with('message', 'Satuan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $unit = $this->unitModel->getUnitById($id);
        if (!$unit) {
            throw new PageNotFoundException();
        }

        $data = [
            'title' => 'Edit Satuan | Lab Asset Management',
            'unit' => $unit
        ];

        return view('unit/edit', $data);
    }

    public function update($id)
    {
        $unit = $this->unitModel->getUnitById($id);
        if (!$unit) {
            throw new PageNotFoundException();
        }

        $rules = [
            'name' => "required|is_unique[units.name,id,$id]",
            'symbol' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'symbol' => $this->request->getPost('symbol')
        ];

        $this->unitModel->update($id, $data);

        return redirect()->to('/units')->with('message', 'Satuan berhasil diperbarui');
    }

    public function delete($id)
    {
        $unit = $this->unitModel->getUnitById($id);
        if (!$unit) {
            throw new PageNotFoundException();
        }

        $this->unitModel->delete($id);

        return redirect()->to('/units')->with('message', 'Satuan berhasil dihapus');
    }
}