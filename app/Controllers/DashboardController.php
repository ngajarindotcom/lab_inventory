<?php

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\ItemInModel;
use App\Models\ItemOutModel;
use App\Models\StockOpnameModel;

class DashboardController extends BaseController
{
    protected $itemModel;
    protected $itemInModel;
    protected $itemOutModel;
    protected $stockOpnameModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->itemInModel = new ItemInModel();
        $this->itemOutModel = new ItemOutModel();
        $this->stockOpnameModel = new StockOpnameModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard | Lab Asset Management',
            'totalItems' => $this->itemModel->countAll(),
            'totalItemIn' => $this->itemInModel->countAll(),
            'totalItemOut' => $this->itemOutModel->countAll(),
            'totalStockOpname' => $this->stockOpnameModel->countAll(),
            'recentItems' => $this->itemModel->orderBy('created_at', 'DESC')->limit(5)->findAll(),
            'recentItemIn' => $this->itemInModel->orderBy('created_at', 'DESC')->limit(5)->findAll(),
            'recentItemOut' => $this->itemOutModel->orderBy('created_at', 'DESC')->limit(5)->findAll(),
        ];

        return view('dashboard/index', $data);
    }
}