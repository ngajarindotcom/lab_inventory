<?php

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\ItemOutModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class ItemOutController extends BaseController
{
    protected $itemModel;
    protected $itemOutModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->itemOutModel = new ItemOutModel();
        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Barang Keluar | Lab Asset Management',
            'itemOuts' => $this->itemOutModel->getAllItemOut()
        ];

        return view('item_out/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Barang Keluar | Lab Asset Management',
            'items' => $this->itemModel->getAllItems()
        ];

        return view('item_out/create', $data);
    }

    public function store()
    {
        $rules = [
            'item_id' => 'required',
            'quantity' => 'required|numeric',
            'date' => 'required|valid_date',
            'recipient' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $itemId = $this->request->getPost('item_id');
        $quantity = $this->request->getPost('quantity');

        // Cek stok tersedia
        $item = $this->itemModel->find($itemId);
        if ($item['stock'] < $quantity) {
            return redirect()->back()->withInput()->with('error', 'Stok tidak mencukupi');
        }

        $data = [
            'item_id' => $itemId,
            'quantity' => $quantity,
            'date' => $this->request->getPost('date'),
            'recipient' => $this->request->getPost('recipient'),
            'note' => $this->request->getPost('note'),
            'created_by' => session()->get('userId')
        ];

        $this->itemOutModel->save($data);
        $this->itemModel->decreaseStock($itemId, $quantity);

        return redirect()->to('/item-out')->with('message', 'Barang keluar berhasil ditambahkan');
    }

    public function edit($id)
    {
        $itemOut = $this->itemOutModel->getItemOutById($id);
        if (!$itemOut) {
            throw new PageNotFoundException();
        }

        $data = [
            'title' => 'Edit Barang Keluar | Lab Asset Management',
            'itemOut' => $itemOut,
            'items' => $this->itemModel->getAllItems()
        ];

        return view('item_out/edit', $data);
    }

    public function update($id)
    {
        $itemOut = $this->itemOutModel->getItemOutById($id);
        if (!$itemOut) {
            throw new PageNotFoundException();
        }

        $rules = [
            'item_id' => 'required',
            'quantity' => 'required|numeric',
            'date' => 'required|valid_date',
            'recipient' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Kembalikan stok sebelumnya
        $this->itemModel->increaseStock($itemOut['item_id'], $itemOut['quantity']);

        $itemId = $this->request->getPost('item_id');
        $quantity = $this->request->getPost('quantity');

        // Cek stok tersedia
        $item = $this->itemModel->find($itemId);
        if ($item['stock'] < $quantity) {
            $this->itemModel->decreaseStock($itemOut['item_id'], $itemOut['quantity']);
            return redirect()->back()->withInput()->with('error', 'Stok tidak mencukupi');
        }

        $data = [
            'item_id' => $itemId,
            'quantity' => $quantity,
            'date' => $this->request->getPost('date'),
            'recipient' => $this->request->getPost('recipient'),
            'note' => $this->request->getPost('note')
        ];

        $this->itemOutModel->update($id, $data);
        $this->itemModel->decreaseStock($itemId, $quantity);

        return redirect()->to('/item-out')->with('message', 'Barang keluar berhasil diperbarui');
    }

    public function delete($id)
    {
        $itemOut = $this->itemOutModel->getItemOutById($id);
        if (!$itemOut) {
            throw new PageNotFoundException();
        }

        $this->itemModel->increaseStock($itemOut['item_id'], $itemOut['quantity']);
        $this->itemOutModel->delete($id);

        return redirect()->to('/item-out')->with('message', 'Barang keluar berhasil dihapus');
    }

    public function report()
    {
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        if ($startDate && $endDate) {
            $itemOuts = $this->itemOutModel->getItemOutByDateRange($startDate, $endDate);
        } else {
            $itemOuts = $this->itemOutModel->getAllItemOut();
        }

        $data = [
            'title' => 'Laporan Barang Keluar | Lab Asset Management',
            'itemOuts' => $itemOuts,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];

        return view('item_out/report', $data);
    }

    public function exportPdf()
    {
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        if ($startDate && $endDate) {
            $itemOuts = $this->itemOutModel->getItemOutByDateRange($startDate, $endDate);
        } else {
            $itemOuts = $this->itemOutModel->getAllItemOut();
        }

        $data = [
            'title' => 'Laporan Barang Keluar',
            'itemOuts' => $itemOuts,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];

        $html = view('item_out/export_pdf', $data);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporan-barang-keluar.pdf', ['Attachment' => 0]);
    }

    public function exportExcel()
    {
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        if ($startDate && $endDate) {
            $itemOuts = $this->itemOutModel->getItemOutByDateRange($startDate, $endDate);
        } else {
            $itemOuts = $this->itemOutModel->getAllItemOut();
        }

        $data = [
            'title' => 'Laporan Barang Keluar',
            'itemOuts' => $itemOuts,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];

        return view('item_out/export_excel', $data);
    }
}