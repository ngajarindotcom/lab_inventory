<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'code', 'name', 'category_id', 'item_type_id', 'power_type_id', 
        'item_kind_id', 'brand', 'specification', 'unit_id', 'stock', 'note'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'code' => 'required|is_unique[items.code]',
        'name' => 'required',
        'category_id' => 'required',
        'item_type_id' => 'required',
        'unit_id' => 'required',
        'stock' => 'required|numeric'
    ];

    protected $validationMessages = [
        'code' => [
            'required' => 'Kode barang harus diisi',
            'is_unique' => 'Kode barang sudah digunakan'
        ],
        'name' => [
            'required' => 'Nama barang harus diisi'
        ],
        'category_id' => [
            'required' => 'Kategori harus dipilih'
        ],
        'item_type_id' => [
            'required' => 'Tipe barang harus dipilih'
        ],
        'unit_id' => [
            'required' => 'Satuan harus dipilih'
        ],
        'stock' => [
            'required' => 'Stok harus diisi',
            'numeric' => 'Stok harus berupa angka'
        ]
    ];

    public function getAllItems()
    {
        return $this->select('items.*, categories.name as category_name, item_types.name as item_type_name, units.name as unit_name')
            ->join('categories', 'categories.id = items.category_id')
            ->join('item_types', 'item_types.id = items.item_type_id')
            ->join('units', 'units.id = items.unit_id')
            ->orderBy('items.name', 'ASC')
            ->findAll();
    }

    public function getItemById($id)
    {
        return $this->select('items.*, categories.name as category_name, item_types.name as item_type_name, 
                            power_types.name as power_type_name, item_kinds.name as item_kind_name, units.name as unit_name')
            ->join('categories', 'categories.id = items.category_id', 'left')
            ->join('item_types', 'item_types.id = items.item_type_id', 'left')
            ->join('power_types', 'power_types.id = items.power_type_id', 'left')
            ->join('item_kinds', 'item_kinds.id = items.item_kind_id', 'left')
            ->join('units', 'units.id = items.unit_id', 'left')
            ->where('items.id', $id)
            ->first();
    }

    public function getItemByCode($code)
    {
        return $this->where('code', $code)->first();
    }

    public function increaseStock($itemId, $quantity)
    {
        $item = $this->find($itemId);
        if ($item) {
            $newStock = $item['stock'] + $quantity;
            return $this->update($itemId, ['stock' => $newStock]);
        }
        return false;
    }

    public function decreaseStock($itemId, $quantity)
    {
        $item = $this->find($itemId);
        if ($item && $item['stock'] >= $quantity) {
            $newStock = $item['stock'] - $quantity;
            return $this->update($itemId, ['stock' => $newStock]);
        }
        return false;
    }
}