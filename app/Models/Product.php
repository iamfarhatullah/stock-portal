<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quantity', 'price'];

    
    public function warehouseDetails()
    {
        return $this->hasMany(WarehouseDetail::class);
    }

    public function stockRecords()
    {
        return $this->hasMany(StocksRecord::class);
    }
}
