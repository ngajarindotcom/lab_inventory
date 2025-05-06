<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemOutModel extends Model
{
    protected $table = 'item_out';
    protected $primaryKey = 'id';
    protected $allowedFields = ['item_id', 'quantity', 'date', 'recipient', 'note', 'created_by'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getAllItemOut()
    {
        return $this->select('item_out.*, items.name as item_name, items.code as item_code, users.name as created_by_name')
            ->join('items', 'items.id = item_out.item_id')
            ->join('users', 'users.id = item_out.created_by')
            ->orderBy('item_out.date', 'DESC')
            ->findAll();
    }

    public function getItemOutById($id)
    {
        return $this->select('item_out.*, items.name as item_name, items.code as item_code, users.name as created_by_name')
            ->join('items', 'items.id = item_out.item_id')
            ->join('users', 'users.id = item_out.created_by')
            ->where('item_out.id', $id)
            ->first();
    }

    public function getItemOutByDateRange($startDate, $endDate)
    {
        return $this->select('item_out.*, items.name as item_name, items.code as item_code, users.name as created_by_name')
            ->join('items', 'items.id = item_out.item_id')
            ->join('users', 'users.id = item_out.created_by')
            ->where('item_out.date >=', $startDate)
            ->where('item_out.date <=', $endDate)
            ->orderBy('item_out.date', 'DESC')
            ->findAll();
    }
}