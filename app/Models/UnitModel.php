<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitModel extends Model
{
    protected $table = 'units';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'symbol', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getAllUnits()
    {
        return $this->orderBy('name', 'ASC')->findAll();
    }

    public function getUnitById($id)
    {
        return $this->find($id);
    }
}