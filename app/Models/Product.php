<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    public $timestamps  =false;
    protected $fillable = [
        'number',
        'name',
        'slug',
        'brand_id',
        'ram_id',
        'cpu_id',
        'hard_driver_id',
        'graphics_card_id',
        'main_board_id',
        'image',
        'desc',
        'quantity',
        'in_price',
        'out_price',
        'status',
    ];


   
    public function Brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function Cpu()
    {
        return $this->belongsTo(Cpu::class);
    }

    public function Harddriver()
    {
        return $this->belongsTo(HardDriver::class);
    }

    public function Ram()
    {
        return $this->belongsTo(Ram::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public static function boot()
    {
        parent::boot();
        static::creating(function($model){
            $model->number = sprintf('SP-%03d', now()->timestamp) ;
        });
    }
}
