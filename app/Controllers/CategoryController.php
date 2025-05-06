<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class CategoryController extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Kategori Barang | Lab Asset Management',
            'categories' => $this->categoryModel->getAllCategories()
        ];

        return view('category/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kategori | Lab Asset Management'
        ];

        return view('category/create', $data);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|is_unique[categories.name]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ];

        $this->categoryModel->save($data);

        return redirect()->to('/categories')->with('message', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $category = $this->categoryModel->getCategoryById($id);
        if (!$category) {
            throw new PageNotFoundException();
        }

        $data = [
            'title' => 'Edit Kategori | Lab Asset Management',
            'category' => $category
        ];

        return view('category/edit', $data);
    }

    public function update($id)
    {
        $category = $this->categoryModel->getCategoryById($id);
        if (!$category) {
            throw new PageNotFoundException();
        }

        $rules = [
            'name' => "required|is_unique[categories.name,id,$id]",
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ];

        $this->categoryModel->update($id, $data);

        return redirect()->to('/categories')->with('message', 'Kategori berhasil diperbarui');
    }

    public function delete($id)
    {
        $category = $this->categoryModel->getCategoryById($id);
        if (!$category) {
            throw new PageNotFoundException();
        }

        $this->categoryModel->delete($id);

        return redirect()->to('/categories')->with('message', 'Kategori berhasil dihapus');
    }
}