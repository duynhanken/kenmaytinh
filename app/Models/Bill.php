<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable = [
        'bill_number','customer_id','name','address','phone','desc','total_price','date_create','voucher_id','price_checkout','status'
    ] ;
    protected $primaryKey = 'id';


    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }

   
    public function detail_bill()
    {
        return $this->hasMany(BillDetail::class,'bill_id');
    }


    public function voucher()
    {
        return $this->hasOne(Voucher::class,'id','voucher_id');
    }
    public static function boot()
    {
        parent::boot();
        static::creating(function($model){
            $model->bill_number = sprintf('HD-%03d', now()->timestamp) ;
        });
    }

    public function getBillNumber()
   {
       return sprintf('HD-%03d', now()->timestamp);
   }
}
