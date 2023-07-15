<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id','customer_id','quantity','price'
    ] ;
    protected $primaryKey = 'id';

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
