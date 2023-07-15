<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillImport extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id','total_price','date_create','status'
    ] ;
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }


    public function detail_bill_import()
    {
        return $this->hasMany(BillDetailImport::class,'bill_import_id');
    }

   
}
