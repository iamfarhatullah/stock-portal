<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'date', 'paid_amount', 'units_ordered'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

?>