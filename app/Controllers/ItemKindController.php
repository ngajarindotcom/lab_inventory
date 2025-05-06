<?php

namespace App\Controllers;

use App\Models\ItemKindModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class ItemKindController extends BaseController
{
    protected $itemKindModel;

    public function __construct()
    {
        $this->itemKindModel = new ItemKindModel();
        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Jenis Barang | Lab Asset Management',
            'itemKinds' => $this->itemKindModel->getAllItemKinds()
        ];

        return view('item_kind/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Jenis Barang | Lab Asset Management'
        ];

        return view('item_kind/create', $data);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|is_unique[item_kinds.name]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ];

        $this->itemKindModel->save($data);

        return redirect()->to('/item-kinds')->with('message', 'Jenis barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $itemKind = $this->itemKindModel->getItemKindById($id);
        if (!$itemKind) {
            throw new PageNotFoundException();
        }

        $data = [
            'title' => 'Edit Jenis Barang | Lab Asset Management',
            'itemKind' => $itemKind
        ];

        return view('item_kind/edit', $data);
    }

    public function update($id)
    {
        $itemKind = $this->itemKindModel->getItemKindById($id);
        if (!$itemKind) {
            throw new PageNotFoundException();
        }

        $rules = [
            'name' => "required|is_unique[item_kinds.name,id,$id]",
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ];

        $this->itemKindModel->update($id, $data);

        return redirect()->to('/item-kinds')->with('message', 'Jenis barang berhasil diperbarui');
    }

    public function delete($id)
    {
        $itemKind = $this->itemKindModel->getItemKindById($id);
        if (!$itemKind) {
            throw new PageNotFoundException();
        }

        $this->itemKindModel->delete($id);

        return redirect()->to('/item-kinds')->with('message', 'Jenis barang berhasil dihapus');
    }
}