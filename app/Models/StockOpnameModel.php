<?php

namespace App\Models;

use CodeIgniter\Model;

class StockOpnameModel extends Model
{
    protected $table = 'stock_opnames';
    protected $primaryKey = 'id';
    protected $allowedFields = ['item_id', 'stock_system', 'stock_actual', 'difference', 'date', 'note', 'created_by'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getAllStockOpnames()
    {
        return $this->select('stock_opnames.*, items.name as item_name, items.code as item_code, users.name as created_by_name')
            ->join('items', 'items.id = stock_opnames.item_id')
            ->join('users', 'users.id = stock_opnames.created_by')
            ->orderBy('stock_opnames.date', 'DESC')
            ->findAll();
    }

    public function getStockOpnameById($id)
    {
        return $this->select('stock_opnames.*, items.name as item_name, items.code as item_code, users.name as created_by_name')
            ->join('items', 'items.id = stock_opnames.item_id')
            ->join('users', 'users.id = stock_opnames.created_by')
            ->where('stock_opnames.id', $id)
            ->first();
    }

    public function getStockOpnameByDateRange($startDate, $endDate)
    {
        return $this->select('stock_opnames.*, items.name as item_name, items.code as item_code, users.name as created_by_name')
            ->join('items', 'items.id = stock_opnames.item_id')
            ->join('users', 'users.id = stock_opnames.created_by')
            ->where('stock_opnames.date >=', $startDate)
            ->where('stock_opnames.date <=', $endDate)
            ->orderBy('stock_opnames.date', 'DESC')
            ->findAll();
    }

    public function getStockOpnameByItemAndDateRange($itemId, $startDate, $endDate)
    {
        return $this->select('stock_opnames.*, items.name as item_name, items.code as item_code, users.name as created_by_name')
            ->join('items', 'items.id = stock_opnames.item_id')
            ->join('users', 'users.id = stock_opnames.created_by')
            ->where('stock_opnames.item_id', $itemId)
            ->where('stock_opnames.date >=', $startDate)
            ->where('stock_opnames.date <=', $endDate)
            ->orderBy('stock_opnames.date', 'DESC')
            ->findAll();
    }
}