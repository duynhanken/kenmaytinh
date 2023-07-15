<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'bill_id','product_id','quantity','price'
    ] ;
    protected $primaryKey = 'id';

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    
    public function bill()
    {
        return $this->belongsTo(Bill::class,'bill_id');
    }
}
