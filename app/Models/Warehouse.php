<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'cost',
        'units',
        'date', 
    ];

    public function details()
    {
        return $this->hasMany(WarehouseDetail::class);
    }
}
