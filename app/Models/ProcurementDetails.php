<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcurementDetails extends Model
{
    use HasFactory;

    protected $fillable = ['procurement_id', 'product_id', 'quantity'];

    public function procurement()
    {
        return $this->belongsTo(Procurement::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
