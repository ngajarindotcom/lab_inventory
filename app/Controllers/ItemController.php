<?php

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\CategoryModel;
use App\Models\ItemTypeModel;
use App\Models\PowerTypeModel;
use App\Models\ItemKindModel;
use App\Models\UnitModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class ItemController extends BaseController
{
    protected $itemModel;
    protected $categoryModel;
    protected $itemTypeModel;
    protected $powerTypeModel;
    protected $itemKindModel;
    protected $unitModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->categoryModel = new CategoryModel();
        $this->itemTypeModel = new ItemTypeModel();
        $this->powerTypeModel = new PowerTypeModel();
        $this->itemKindModel = new ItemKindModel();
        $this->unitModel = new UnitModel();
        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Data Barang | Lab Asset Management',
            'items' => $this->itemModel->getAllItems()
        ];

        return view('item/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Barang | Lab Asset Management',
            'categories' => $this->categoryModel->getAllCategories(),
            'itemTypes' => $this->itemTypeModel->getAllItemTypes(),
            'powerTypes' => $this->powerTypeModel->getAllPowerTypes(),
            'itemKinds' => $this->itemKindModel->getAllItemKinds(),
            'units' => $this->unitModel->getAllUnits()
        ];

        return view('item/create', $data);
    }

    public function store()
    {
        if (!$this->validate($this->itemModel->validationRules, $this->itemModel->validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'code' => $this->request->getPost('code'),
            'name' => $this->request->getPost('name'),
            'category_id' => $this->request->getPost('category_id'),
            'item_type_id' => $this->request->getPost('item_type_id'),
            'power_type_id' => $this->request->getPost('power_type_id'),
            'item_kind_id' => $this->request->getPost('item_kind_id'),
            'brand' => $this->request->getPost('brand'),
            'specification' => $this->request->getPost('specification'),
            'unit_id' => $this->request->getPost('unit_id'),
            'stock' => $this->request->getPost('stock'),
            'note' => $this->request->getPost('note')
        ];

        $this->itemModel->save($data);

        return redirect()->to('/items')->with('message', 'Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = $this->itemModel->getItemById($id);
        if (!$item) {
            throw new PageNotFoundException();
        }

        $data = [
            'title' => 'Edit Barang | Lab Asset Management',
            'item' => $item,
            'categories' => $this->categoryModel->getAllCategories(),
            'itemTypes' => $this->itemTypeModel->getAllItemTypes(),
            'powerTypes' => $this->powerTypeModel->getAllPowerTypes(),
            'itemKinds' => $this->itemKindModel->getAllItemKinds(),
            'units' => $this->unitModel->getAllUnits()
        ];

        return view('item/edit', $data);
    }

    public function update($id)
    {
        $item = $this->itemModel->getItemById($id);
        if (!$item) {
            throw new PageNotFoundException();
        }

        $rules = $this->itemModel->validationRules;
        $rules['code'] = "required|is_unique[items.code,id,$id]";

        if (!$this->validate($rules, $this->itemModel->validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'code' => $this->request->getPost('code'),
            'name' => $this->request->getPost('name'),
            'category_id' => $this->request->getPost('category_id'),
            'item_type_id' => $this->request->getPost('item_type_id'),
            'power_type_id' => $this->request->getPost('power_type_id'),
            'item_kind_id' => $this->request->getPost('item_kind_id'),
            'brand' => $this->request->getPost('brand'),
            'specification' => $this->request->getPost('specification'),
            'unit_id' => $this->request->getPost('unit_id'),
            'stock' => $this->request->getPost('stock'),
            'note' => $this->request->getPost('note')
        ];

        $this->itemModel->update($id, $data);

        return redirect()->to('/items')->with('message', 'Barang berhasil diperbarui');
    }

    public function delete($id)
    {
        $item = $this->itemModel->getItemById($id);
        if (!$item) {
            throw new PageNotFoundException();
        }

        $this->itemModel->delete($id);

        return redirect()->to('/items')->with('message', 'Barang berhasil dihapus');
    }

    public function detail($id)
    {
        $item = $this->itemModel->getItemById($id);
        if (!$item) {
            throw new PageNotFoundException();
        }

        $data = [
            'title' => 'Detail Barang | Lab Asset Management',
            'item' => $item
        ];

        return view('item/detail', $data);
    }
}