<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetailImport extends Model
{
    use HasFactory;
    protected $fillable = [
        'bill_import_id','product_id','quantity','price'
    ] ;
    protected $primaryKey = 'id';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
