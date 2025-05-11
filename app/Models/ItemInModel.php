<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemInModel extends Model
{
    protected $table = 'item_in';
    protected $primaryKey = 'id';
    protected $allowedFields = ['item_id', 'quantity', 'date', 'note', 'created_by'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getAllItemIn()
    {
        return $this->select('item_in.*, items.name as item_name, items.code as item_code, users.name as created_by_name')
            ->join('items', 'items.id = item_in.item_id')
            ->join('users', 'users.id = item_in.created_by')
            ->orderBy('item_in.date', 'DESC')
            ->findAll();
    }

    public function getItemInById($id)
    {
        return $this->select('item_in.*, items.name as item_name, items.code as item_code, users.name as created_by_name')
            ->join('items', 'items.id = item_in.item_id')
            ->join('users', 'users.id = item_in.created_by')
            ->where('item_in.id', $id)
            ->first();
    }

    public function getItemInByDateRange($startDate, $endDate)
    {
        return $this->select('item_in.*, items.name as item_name, items.code as item_code, users.name as created_by_name')
            ->join('items', 'items.id = item_in.item_id')
            ->join('users', 'users.id = item_in.created_by')
            ->where('item_in.date >=', $startDate)
            ->where('item_in.date <=', $endDate)
            ->orderBy('item_in.date', 'DESC')
            ->findAll();
    }

    public function getRecentItemInWithItemName()
    {
        return $this->select('item_in.*, items.name AS item_name, items.code AS item_code')
                ->join('items', 'items.id = item_in.item_id')
                ->orderBy('item_in.created_at', 'DESC')
                ->limit(5)
                ->findAll();
    }

}