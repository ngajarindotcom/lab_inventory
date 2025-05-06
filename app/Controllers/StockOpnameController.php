<?php

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\StockOpnameModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class StockOpnameController extends BaseController
{
    protected $itemModel;
    protected $stockOpnameModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->stockOpnameModel = new StockOpnameModel();
        helper(['form']);
    }

    public function index()
    {
        $itemId = $this->request->getGet('item_id');
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        if ($itemId && $startDate && $endDate) {
            $stockOpnames = $this->stockOpnameModel->getStockOpnameByItemAndDateRange($itemId, $startDate, $endDate);
        } elseif ($startDate && $endDate) {
            $stockOpnames = $this->stockOpnameModel->getStockOpnameByDateRange($startDate, $endDate);
        } else {
            $stockOpnames = $this->stockOpnameModel->getAllStockOpnames();
        }

        $data = [
            'title' => 'Stok Opname | Lab Asset Management',
            'stockOpnames' => $stockOpnames,
            'items' => $this->itemModel->getAllItems(),
            'itemId' => $itemId,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];

        return view('stock_opname/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Stok Opname | Lab Asset Management',
            'items' => $this->itemModel->getAllItems()
        ];

        return view('stock_opname/create', $data);
    }

    public function store()
    {
        $rules = [
            'item_id' => 'required',
            'stock_actual' => 'required|numeric',
            'date' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $itemId = $this->request->getPost('item_id');
        $stockActual = $this->request->getPost('stock_actual');

        $item = $this->itemModel->find($itemId);
        $difference = $stockActual - $item['stock'];

        $data = [
            'item_id' => $itemId,
            'stock_system' => $item['stock'],
            'stock_actual' => $stockActual,
            'difference' => $difference,
            'date' => $this->request->getPost('date'),
            'note' => $this->request->getPost('note'),
            'created_by' => session()->get('userId')
        ];

        $this->stockOpnameModel->save($data);

        // Update stok barang
        $this->itemModel->update($itemId, ['stock' => $stockActual]);

        return redirect()->to('/stock-opname')->with('message', 'Stok opname berhasil ditambahkan');
    }

    public function edit($id)
    {
        $stockOpname = $this->stockOpnameModel->getStockOpnameById($id);
        if (!$stockOpname) {
            throw new PageNotFoundException();
        }

        $data = [
            'title' => 'Edit Stok Opname | Lab Asset Management',
            'stockOpname' => $stockOpname,
            'items' => $this->itemModel->getAllItems()
        ];

        return view('stock_opname/edit', $data);
    }

    public function update($id)
    {
        $stockOpname = $this->stockOpnameModel->getStockOpnameById($id);
        if (!$stockOpname) {
            throw new PageNotFoundException();
        }

        $rules = [
            'item_id' => 'required',
            'stock_actual' => 'required|numeric',
            'date' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Kembalikan stok sebelumnya
        $this->itemModel->update($stockOpname['item_id'], ['stock' => $stockOpname['stock_system']]);

        $itemId = $this->request->getPost('item_id');
        $stockActual = $this->request->getPost('stock_actual');

        $item = $this->itemModel->find($itemId);
        $difference = $stockActual - $item['stock'];

        $data = [
            'item_id' => $itemId,
            'stock_system' => $item['stock'],
            'stock_actual' => $stockActual,
            'difference' => $difference,
            'date' => $this->request->getPost('date'),
            'note' => $this->request->getPost('note')
        ];

        $this->stockOpnameModel->update($id, $data);

        // Update stok barang
        $this->itemModel->update($itemId, ['stock' => $stockActual]);

        return redirect()->to('/stock-opname')->with('message', 'Stok opname berhasil diperbarui');
    }

    public function delete($id)
    {
        $stockOpname = $this->stockOpnameModel->getStockOpnameById($id);
        if (!$stockOpname) {
            throw new PageNotFoundException();
        }

        // Kembalikan stok sebelumnya
        $this->itemModel->update($stockOpname['item_id'], ['stock' => $stockOpname['stock_system']]);

        $this->stockOpnameModel->delete($id);

        return redirect()->to('/stock-opname')->with('message', 'Stok opname berhasil dihapus');
    }

    public function report()
    {
        $itemId = $this->request->getGet('item_id');
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        if ($itemId && $startDate && $endDate) {
            $stockOpnames = $this->stockOpnameModel->getStockOpnameByItemAndDateRange($itemId, $startDate, $endDate);
        } elseif ($startDate && $endDate) {
            $stockOpnames = $this->stockOpnameModel->getStockOpnameByDateRange($startDate, $endDate);
        } else {
            $stockOpnames = $this->stockOpnameModel->getAllStockOpnames();
        }

        $data = [
            'title' => 'Laporan Stok Opname | Lab Asset Management',
            'stockOpnames' => $stockOpnames,
            'items' => $this->itemModel->getAllItems(),
            'itemId' => $itemId,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];

        return view('stock_opname/report', $data);
    }

    public function exportPdf()
    {
        $itemId = $this->request->getGet('item_id');
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        if ($itemId && $startDate && $endDate) {
            $stockOpnames = $this->stockOpnameModel->getStockOpnameByItemAndDateRange($itemId, $startDate, $endDate);
        } elseif ($startDate && $endDate) {
            $stockOpnames = $this->stockOpnameModel->getStockOpnameByDateRange($startDate, $endDate);
        } else {
            $stockOpnames = $this->stockOpnameModel->getAllStockOpnames();
        }

        $data = [
            'title' => 'Laporan Stok Opname',
            'stockOpnames' => $stockOpnames,
            'itemId' => $itemId,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];

        $html = view('stock_opname/export_pdf', $data);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporan-stok-opname.pdf', ['Attachment' => 0]);
    }

    public function exportExcel()
    {
        $itemId = $this->request->getGet('item_id');
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        if ($itemId && $startDate && $endDate) {
            $stockOpnames = $this->stockOpnameModel->getStockOpnameByItemAndDateRange($itemId, $startDate, $endDate);
        } elseif ($startDate && $endDate) {
            $stockOpnames = $this->stockOpnameModel->getStockOpnameByDateRange($startDate, $endDate);
        } else {
            $stockOpnames = $this->stockOpnameModel->getAllStockOpnames();
        }

        $data = [
            'title' => 'Laporan Stok Opname',
            'stockOpnames' => $stockOpnames,
            'itemId' => $itemId,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];

        return view('stock_opname/export_excel', $data);
    }
}