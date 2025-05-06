<?php

namespace App\Controllers;

use App\Models\ItemTypeModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class ItemTypeController extends BaseController
{
    protected $itemTypeModel;

    public function __construct()
    {
        $this->itemTypeModel = new ItemTypeModel();
        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Tipe Barang | Lab Asset Management',
            'itemTypes' => $this->itemTypeModel->getAllItemTypes()
        ];

        return view('item_type/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Tipe Barang | Lab Asset Management'
        ];

        return view('item_type/create', $data);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|is_unique[item_types.name]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ];

        $this->itemTypeModel->save($data);

        return redirect()->to('/item-types')->with('message', 'Tipe barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $itemType = $this->itemTypeModel->getItemTypeById($id);
        if (!$itemType) {
            throw new PageNotFoundException();
        }

        $data = [
            'title' => 'Edit Tipe Barang | Lab Asset Management',
            'itemType' => $itemType
        ];

        return view('item_type/edit', $data);
    }

    public function update($id)
    {
        $itemType = $this->itemTypeModel->getItemTypeById($id);
        if (!$itemType) {
            throw new PageNotFoundException();
        }

        $rules = [
            'name' => "required|is_unique[item_types.name,id,$id]",
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ];

        $this->itemTypeModel->update($id, $data);

        return redirect()->to('/item-types')->with('message', 'Tipe barang berhasil diperbarui');
    }

    public function delete($id)
    {
        $itemType = $this->itemTypeModel->getItemTypeById($id);
        if (!$itemType) {
            throw new PageNotFoundException();
        }

        $this->itemTypeModel->delete($id);

        return redirect()->to('/item-types')->with('message', 'Tipe barang berhasil dihapus');
    }
}