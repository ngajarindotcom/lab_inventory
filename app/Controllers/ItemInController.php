<?php

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\ItemInModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class ItemInController extends BaseController
{
    protected $itemModel;
    protected $itemInModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->itemInModel = new ItemInModel();
        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Barang Masuk | Lab Asset Management',
            'itemIns' => $this->itemInModel->getAllItemIn()
        ];

        return view('item_in/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Barang Masuk | Lab Asset Management',
            'items' => $this->itemModel->getAllItems()
        ];

        return view('item_in/create', $data);
    }

    public function store()
    {
        $rules = [
            'item_id' => 'required',
            'quantity' => 'required|numeric',
            'date' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'item_id' => $this->request->getPost('item_id'),
            'quantity' => $this->request->getPost('quantity'),
            'date' => $this->request->getPost('date'),
            'note' => $this->request->getPost('note'),
            'created_by' => session()->get('userId')
        ];

        $this->itemInModel->save($data);
        $this->itemModel->increaseStock($data['item_id'], $data['quantity']);

        return redirect()->to('/item-in')->with('message', 'Barang masuk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $itemIn = $this->itemInModel->getItemInById($id);
        if (!$itemIn) {
            throw new PageNotFoundException();
        }

        $data = [
            'title' => 'Edit Barang Masuk | Lab Asset Management',
            'itemIn' => $itemIn,
            'items' => $this->itemModel->getAllItems()
        ];

        return view('item_in/edit', $data);
    }

    public function update($id)
    {
        $itemIn = $this->itemInModel->getItemInById($id);
        if (!$itemIn) {
            throw new PageNotFoundException();
        }

        $rules = [
            'item_id' => 'required',
            'quantity' => 'required|numeric',
            'date' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Kembalikan stok sebelumnya
        $this->itemModel->decreaseStock($itemIn['item_id'], $itemIn['quantity']);

        $data = [
            'item_id' => $this->request->getPost('item_id'),
            'quantity' => $this->request->getPost('quantity'),
            'date' => $this->request->getPost('date'),
            'note' => $this->request->getPost('note')
        ];

        $this->itemInModel->update($id, $data);
        $this->itemModel->increaseStock($data['item_id'], $data['quantity']);

        return redirect()->to('/item-in')->with('message', 'Barang masuk berhasil diperbarui');
    }

    public function delete($id)
    {
        $itemIn = $this->itemInModel->getItemInById($id);
        if (!$itemIn) {
            throw new PageNotFoundException();
        }

        $this->itemModel->decreaseStock($itemIn['item_id'], $itemIn['quantity']);
        $this->itemInModel->delete($id);

        return redirect()->to('/item-in')->with('message', 'Barang masuk berhasil dihapus');
    }

    public function report()
    {
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        if ($startDate && $endDate) {
            $itemIns = $this->itemInModel->getItemInByDateRange($startDate, $endDate);
        } else {
            $itemIns = $this->itemInModel->getAllItemIn();
        }

        $data = [
            'title' => 'Laporan Barang Masuk | Lab Asset Management',
            'itemIns' => $itemIns,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];

        return view('item_in/report', $data);
    }

    public function exportPdf()
    {
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        if ($startDate && $endDate) {
            $itemIns = $this->itemInModel->getItemInByDateRange($startDate, $endDate);
        } else {
            $itemIns = $this->itemInModel->getAllItemIn();
        }

        $data = [
            'title' => 'Laporan Barang Masuk',
            'itemIns' => $itemIns,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];

        $html = view('item_in/export_pdf', $data);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporan-barang-masuk.pdf', ['Attachment' => 0]);
    }

    public function exportExcel()
    {
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        if ($startDate && $endDate) {
            $itemIns = $this->itemInModel->getItemInByDateRange($startDate, $endDate);
        } else {
            $itemIns = $this->itemInModel->getAllItemIn();
        }

        $data = [
            'title' => 'Laporan Barang Masuk',
            'itemIns' => $itemIns,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];

        return view('item_in/export_excel', $data);
    }
}