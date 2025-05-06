<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemKindModel extends Model
{
    protected $table = 'item_kinds';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getAllItemKinds()
    {
        return $this->orderBy('name', 'ASC')->findAll();
    }

    public function getItemKindById($id)
    {
        return $this->find($id);
    }
}