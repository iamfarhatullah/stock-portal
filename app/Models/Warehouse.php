<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'cost',
        'units',
        'warehouse_id',
        'date', 
    ];

    public function details()
    {
        return $this->hasMany(WarehouseDetail::class);
    }


    // public function stockRecords()
    // {
    //     return $this->hasMany(StocksRecord::class);
    // }
}
