<?php

namespace App\Models;

use CodeIgniter\Model;

class PowerTypeModel extends Model
{
    protected $table = 'power_types';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getAllPowerTypes()
    {
        return $this->orderBy('name', 'ASC')->findAll();
    }

    public function getPowerTypeById($id)
    {
        return $this->find($id);
    }
}